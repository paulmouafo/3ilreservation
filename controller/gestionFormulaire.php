<?php

    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $role = $_POST['role'];
    $secretCode = $_POST['secretCode'];

       
    function InscrireUtilisateur($login, $mdp, $role, $secretCode)
    {
        require ('connect.php');
        $requette = $dbh->prepare("INSERT INTO utilisateur(login, password, role, code_secret) 
                                VALUES(:login, :password, :role, :code_secret)");
        $requette->execute(array(
            'login' => $login,
            'password' => password_hash($mdp, PASSWORD_DEFAULT),
            'role' => $role,
            'code_secret' => $secretCode
        ));

        header('location: ../view/index2.php');
    }

    try{
        if(isset($_POST)){
            InscrireUtilisateur($login, $mdp, $role, $secretCode);
        }
    }
    catch(Exception $e)
    {
        echo "Erreur de connexion: ".$e->getMessage()."<br/>";
        die(); // pour interrompre le traitement de la requette requette
    }

?>