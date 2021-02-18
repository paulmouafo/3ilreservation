<div id="formulaire">

    <br><h3 class="text-center" style="color: black"> Gestion des salles de TP </h3><br>

    <div id="configurationSalle" style="margin-left: 20px; margin-right: 20px;">

        <div class="row text-center">
            <h2 style="color: #0CA60C;"> Veillez choisir une salle pour pouvoir mettre a jour ses horaires !</h2>
        </div>

    </div>

</div>


<script>
    function horaireSalle(date)
    {
        let idsalle = document.getElementById('idsalle').value ;
        document.getElementById('dateHoraire').value = date;
        let obj = {date: date, idSalle: idsalle, confirm: 1}

        $.ajax({
            url: "../controller/gestionSalle.php",
            type:"GET",
            data:obj
        }).done(function( arg ) {
            document.getElementById('configurationSalle').innerHTML = arg
            //location.reload(true);
        });
    }
</script>
<script src="../js/changerSatusSalle.js"></script>

<script>
    function confirmer()
    {
        let idsalle = document.getElementById('idsalle').value ;
        let date = document.getElementById('dateHoraire').value ;
        let nbplace = document.getElementById('nbplaceSalle').value ;


        let obj = {date: date, idSalle: idsalle, nbplace: nbplace, confirm: 3}

        $.ajax({
            url: "../controller/gestionSalle.php",
            type:"GET",
            data:obj
        }).done(function( arg ) {
            location.reload(true);
        });
    }
</script>
