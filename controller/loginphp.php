<?php
    session_start();
    $_SESSION['login'] = false;

    if( isset($_POST['connexion']) ) {

        if(isset($_SESSION['token']) && isset($_SESSION['token_time']) &&  isset($_POST['token']))
        {
            //Si le jeton de la session correspond à celui du formulaire
            if($_SESSION['token'] == $_POST['token'])
            {
                //On stocke le timestamp qu'il était il y a 15 minutes
                $timestamp_ancien = time() - (10*60);
                //Si le jeton n'est pas expiré
                if($_SESSION['token_time'] >= $timestamp_ancien)
                {
                    require_once ('connect.php');
                    $login = $_POST['email'];
                    $password = $_POST['password'];
                    // hash_password($dbh);
                    $req = $dbh->prepare( 'SELECT * FROM utilisateur WHERE login = ? ' );
                    $req->execute( array( $login ) );
                    $utilisateur = $req->fetch();

                    if(empty($utilisateur))
                    {
                        echo "nom d'utilisateur incorrect ";
                    }else if( password_verify( $password, $utilisateur['password'] ) )
                    {
                        $_SESSION['idUtilisateur'] = $utilisateur['id'];
                        $_SESSION['role'] = $utilisateur['role'];
                        $_SESSION['login'] = true;
                        header('location: ../view/index2.php');
                    }else
                    {
                        echo 'mot de passe incorrect';
                    }

                }else
                {
                    echo 'Token time failed' ;
                }
            }else
            {
                echo "Token failed";
            }
        }
    }


    if(isset($_POST['deconnexion']))
    {
        $_SESSION['login'] = false;
        $dbh = NULL;
        unset($_SESSION['idUtilisateur']);
        unset($_SESSION['role']);
        session_destroy();
        header('location: ../index.php');
    }


    function hash_password($dbh)
    {
        $req = $dbh->prepare('SELECT * FROM utilisateur');
        $req->execute();

        while($result = $req->fetch())
        {
            $pass = password_hash($result['password'], PASSWORD_DEFAULT);

            $req2 = $dbh->prepare('UPDATE utilisateur SET password = ? WHERE id = ?');
            $req2->execute(array($pass, $result['id']));

            print_r($pass."-----".$result['id']);
            echo "</br></br>"."requette Okay      ";
        }
    }
?>