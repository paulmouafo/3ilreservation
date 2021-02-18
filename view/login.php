<?php
    session_start();

    $token = uniqid(rand(), true);

    $_SESSION['token'] = $token;

    $_SESSION['token_time'] = time();

    /*if($_SESSION['login'] == true)
    {
        header('location: ../view/index2.php');
    }*/

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../stylesheet/login.css">
        <title>3IL: Connexion</title>
    </head>
    <body>
        <section class="login-page">
            <form action="../controller/loginphp.php" method="post">
                <div class="box">
                    <div class="form-head">
                        <h2> Member Login</h2>
                    </div>
                    <div class="form-body">
                        <input type="text" name="email" id="" placeholder="User name" required>
                        <input type="password" name="password" id="" placeholder="Password" required>
                        <input type="hidden" name="token" value="<?php  echo $token;  ?>">
                    </div>
                    <div class="form-footer">
                        <button type="submit" name="connexion">Sign In</button>
                    </div>
                    <a href="pseudo.php" style="color: white; "> Connexion par code </a>
                </div>
            </form>
        </section>
    </body>
</html>