<?php

// Insciption
//echo json_encode($_POST);

// Inscription
$sucess = 0;
$msg = "Une erreur est survenu (signin.php)";
$data = [];

if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['mdp']) )
{
    $pseudo = htmlspecialchars(strip_tags($_POST['pseudo']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    if(strlen($pseudo) < 10)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            // Ajout de l'utilisateur en base de données a cet endroit
            $sucess = 1;
            $msg = "Utilisateur bien inscrit";
            $data['mdp'] = $mdp;
        }else
        {
            $msg = "Adresse email invalide";
        }
    }else{
        $msg = "Votre pseudo dois contenir moins de 10 caractères";
    }
}else
{
    $msg = "Veuillez renseigner tous les champs";
}

// Envoie des données a notre fichier script
$res = ["success" => $sucess, "msg" => $msg, "data" => $data];
echo json_encode($res);