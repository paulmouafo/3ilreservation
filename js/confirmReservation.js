
function confirmReservation(nbplace)
{
    let idUtilisateur = document.getElementById('idUtilisateur').value ;
    let idSalle = document.getElementById('idSalle').value ;
    let dateReservation = document.getElementById('dateReservation').value ;
    let creneauf = document.getElementById('creneauf').value ;

    let newNbplace = nbplace - 1;
    //alert('nbplace = '+nbplace+'   new nbplace = '+newNbplace);
    let obj = { dateReservation: dateReservation, idUtilisateur: idUtilisateur, idSalle: idSalle, creneauf: creneauf, nbplace: newNbplace }

    $.ajax({
        url: "../controller/confirmReservation.php",
        type:"GET",
        data:obj
    }).done(function( arg ) {
        document.getElementById('confirm').innerHTML = arg
        document.getElementById('annuler').style.display  = "none" ;
        document.getElementById(''+nbplace).style.display = "none";
        document.getElementById('quitter').style.visibility  = "visible"  ;

    });

}

function rafraichir()
{
    location.reload(true);
}