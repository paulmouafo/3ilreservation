<?php

    $idsalle = $_GET['id'];

    require_once 'connect.php';
    global  $dbh;

    $req = $dbh->prepare('SELECT * FROM salle WHERE id = ? ');
    $req->execute(array($idsalle));
    $salle = $req->fetch();

    echo $salle['numero'];
?>
