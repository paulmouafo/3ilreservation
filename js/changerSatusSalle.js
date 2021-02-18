
function changeSatus(idCreneau)
{
    let date = document.getElementById('dateHoraire').value ;
    let idsalle = document.getElementById('idsalle').value ;
    let obj = {date: date, idSalle: idsalle, idCreneau: idCreneau, confirm: 2}

    $.ajax({
        url: "../controller/gestionSalle.php",
        type:"GET",
        data:obj
    }).done(function( arg ) {
        document.getElementById('configurationSalle').innerHTML = arg

    });
}