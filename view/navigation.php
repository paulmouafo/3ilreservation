<!-- Navigation -->
<nav class="navbar navbar-expand-md sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index2.php"><img src="../img/logo-3il-groupe1.png" alt="Logo 3il"></a>
    </div>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link navbar-li" href="index2.php" >Accueil</a>
            </li>
            <li class="nav-item">
                <?php
                    if($_SESSION['role'] == 'etudiant')
                    {
                        echo ' <a class="nav-link navbar-li" href="managebooking.php" >Réservations</a>';
                    }
                ?>
            </li>
            <li class="nav-item">
                <form action="../controller/loginphp.php" method="post">
                    <button type="submit" class="btn btn-primary navbar-li-btn" name="deconnexion">Déconnexion</button>
                </form>
            </li>
        </ul>
    </div>
</nav>