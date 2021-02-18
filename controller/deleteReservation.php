<?php

    $idreservation = $_POST['idreservation'];
    $confirm = $_POST['confirm'];

    if($confirm == 0)
    {
        updateModal($idreservation);
    }else if($confirm == 1)
    {
        confirmDeleteReservation($idreservation);
    }


    function updateModal($idreservation)
    {
        require_once 'connect.php';
        $req = $dbh->prepare('SELECT * FROM reservation WHERE id = ?');
        $req->execute(array($idreservation));
        $reservation = $req->fetch();

        $req2 = $dbh->prepare('SELECT * FROM salle WHERE id = ?');
        $req2->execute(array($reservation['idsalle']));
        $salle = $req2->fetch();

        $numeroSalle = $salle['numero'];
        $dateReservation = $reservation['date'];
        $creneauReservation = $reservation['creneau'];

        $tab = ['numeroSalle' => $numeroSalle, 'dateReservation' => $dateReservation, 'creneauReservation' => $creneauReservation ];
        echo json_encode($tab);
    }


    function confirmDeleteReservation($idreservation)
    {
        require_once 'connect.php';
        $req = $dbh->prepare('SELECT * FROM reservation WHERE id = ?');
        $req->execute(array($idreservation));
        $reservation = $req->fetch();

        $req2 = $dbh->prepare('SELECT * FROM salle WHERE id = ?');
        $req2->execute(array($reservation['idsalle']));
        $salle = $req2->fetch();

        $requette = $dbh->prepare('SELECT * FROM horaire WHERE idsalle = ? AND date = ?');
        $requette->execute(array($reservation['idsalle'], $reservation['date']));
        $horaire = $requette->fetch();

        $newNbplace = $horaire['nbplace'] + 1;
        echo 'nbplace = '.$horaire['nbplace'];
        echo 'new nbplace = '.$newNbplace;

        $req3 = $dbh->prepare('UPDATE horaire SET nbplace = ? WHERE id = ?');
        $req3->execute(array($newNbplace, $horaire['id']));

        $req4 = $dbh->prepare('DELETE FROM reservation WHERE id = ?');
        $req4->execute(array($idreservation));
    }

?>