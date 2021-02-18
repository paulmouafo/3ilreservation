
function updateModal(idReservation)
{
    let obj = {idreservation: idReservation, confirm: 0}

    $.ajax({
        url: "../controller/deleteReservation.php",
        type:"POST",
        data:obj
    }).done(function( arg ) {
        arg = JSON.parse(arg);
        document.getElementById('numeroSalle').innerText = arg.numeroSalle;
        document.getElementById('dateReservation').innerText = arg.dateReservation;
        document.getElementById('creneauReservation').innerText = arg.creneauReservation;
    });
}

function confirmDeleteReservation(idReservation)
{
    let obj = {idreservation: idReservation, confirm: 1}

    $.ajax({
        url: "../controller/deleteReservation.php",
        type:"POST",
        data:obj
    }).done(function( arg ) {
        //console.log(arg);
        location.reload(true);
    });
}