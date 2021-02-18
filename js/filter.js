
function pickDate(valeur)
{
    // document.getElementById('dateVal').value = valeur;
/*
    $(document).ready(function(){
        $("#dateVal").val(valeur);
    });*/

    let obj = {filterDate: valeur}
    $.ajax({
        url: "../controller/updateSalle.php",
        type:"GET",
        data:obj
    }).done(function( arg ) {
        document.getElementById('salle').innerHTML = arg;
    });

    creneau(valeur);

    let $groupe = document.getElementById('creneau');
    if($groupe.disabled)
    {
        $groupe.disabled = !$groupe.disabled;
    }
    //$('#date-val').val(val);
}

function pickHours(idCreneau)
{
    let date = document.getElementById('date-input').value ;

    let obj = {filterCreneau: idCreneau, filterDate: date }

    $.ajax({
        url: "../controller/updateAll.php",
        type:"GET",
        data:obj
    }).done(function( arg ) {
        document.getElementById('salle').innerHTML = arg;
    });

    document.getElementById('idCreneau').value = idCreneau;
}

function creneau(date)
{
    var obj = {optionCreneau: date}
    $.ajax({
        url: "../controller/updateCreneau.php",
        type:"GET",
        data:obj
    }).done(function( arg ) {
        document.getElementById('creneau').innerHTML = arg;
    });
}
