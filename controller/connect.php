<?php
    try {
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        global  $dbh;
        //On établit la connexion
        $dbh = new PDO("mysql:host=$servername;dbname=3ilreservation", $username, $password);

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    } catch(Exception $e)
    {
        echo "Erreur de connexion: ".$e->getMessage();
        die();
    }
?>