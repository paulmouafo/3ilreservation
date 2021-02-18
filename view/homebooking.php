<?php
    // session_start();
?>

<br>
<h3 class="text-center" style="color: #1d1c1c">Liste des salles de TP </h3><br>

<div class="row align-items-center" id="salle">
    <?php
        require_once '../controller/requettes.php';
        use backEndAccueil as requete;
        requete\listeSalle();
    ?>
</div>

<?php
    echo '<input type="hidden" id="id_utilisateur" value="'.$_SESSION['idUtilisateur'].'">';
?>

<script>
    function idSalle(idSalle)
    {
        document.getElementById('idSalle').value = idSalle;
        let idutilisateur = document.getElementById('id_utilisateur').value ;
        document.getElementById('idUtilisateur').value = idutilisateur;

        let obj = {id: idSalle}
        $.ajax({
            url: "../controller/test.php",
            type:"GET",
            data:obj
        }).done(function( arg ) {
            document.getElementById('numeroSalle').innerText = arg;
        });
    }
</script>

<script src="../js/confirmReservation.js"></script>
