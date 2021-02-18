<?php

    filterHoursOption($_GET['optionCreneau']);

    function filterHoursOption($date)
    {
        require'connect.php';
        $requette = $dbh->prepare('SELECT * FROM horaire WHERE date = ?');
        $requette->execute(array($date));
        $creneau1 = 0;
        $creneau2 = 0;
        $creneau3 = 0;
        $creneau4 = 0;
        while($horaire = $requette->fetch())
        {
            if($horaire['creneau1'] == 1)
            {
                $creneau1 = 1;
            }else if($horaire['creneau1'] == 0)
            {
                $creneau1 = 0;
            }

            if($horaire['creneau2'] == 1)
            {
                $creneau2 = 2;
            }else if($horaire['creneau2'] == 0)
            {
                $creneau2 = 0;
            }

            if($horaire['creneau3'] == 1)
            {
                $creneau3 = 3;
            }else if($horaire['creneau3'] == 0)
            {
                $creneau3 = 0;
            }

            if($horaire['creneau4'] == 1)
            {
                $creneau4 = 4;
            }else if($horaire['creneau4'] == 0)
            {
                $creneau4 = 0;
            }
        }

        echo ' <option value="" selected>Choix du créneau</option>  ';
        if($creneau1 == 1)
        {
            ajouterCreneau($creneau1);
        }
        if($creneau2 == 2)
        {
            ajouterCreneau($creneau2);
        }
        if($creneau3 == 3)
        {
            ajouterCreneau($creneau3);
        }
        if($creneau4 == 4)
        {
            ajouterCreneau($creneau4);
        }
    }

    function ajouterCreneau($idCreneau)
    {
        require'connect.php';
        $requette = $dbh->prepare('SELECT * FROM creneau WHERE id = ?');
        $requette->execute(array($idCreneau));
        while($creneau = $requette->fetch())
        {
            echo ' <option value="'.$creneau['id'].'">'.$creneau['heure_d'].'-'.$creneau['heure_f'].'</option>  ';
        }
    }