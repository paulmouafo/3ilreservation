<?php
    session_start();
    $_SESSION['login'] = "";
    if(($_SESSION['login'] == true ))
    {
        header('location: view/index2.php');
    }else
    {
        header('location: view/login.php');
    }
?>