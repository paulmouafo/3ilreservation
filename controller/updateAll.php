<?php
    session_start();

    require_once '../controller/requettes.php';
    use backEndAccueil as requete;

    $filterCreneau = $_GET['filterCreneau'];
    $filterDate = $_GET['filterDate'];

    $_SESSION['date-filter'] = $filterDate;
    $_SESSION['creneau-filter'] = $filterCreneau;

    listeSalleFiltre($filterDate, $filterCreneau);

    function listeSalleFiltre($date, $idCreneau)
    {
        require'connect.php';

        $req = $dbh->prepare('SELECT * FROM creneau WHERE id = ?');
        $req->execute(array($idCreneau));
        while($row = $req->fetch())
        {
            $creneau = $row['heure_d'].'-'.$row['heure_f'];
            $_SESSION['creneau-filter'] = $creneau;
        }

        $sql = 'SELECT * FROM horaire WHERE date = ? AND creneau'.$idCreneau.' = ?';
        $req = $dbh->prepare($sql);
        $req->execute(array($date, 1));

        while($horaire = $req->fetch())
        {
            requete\afficheSalle($horaire);
            /*$req2 = $dbh->prepare('SELECT * FROM salle WHERE id = ?');
            $req2->execute(array(''.$horaire['idsalle']));
            while($salle = $req2->fetch())
            {
                requete\afficheSalle($salle);
            }*/
        }
    }
