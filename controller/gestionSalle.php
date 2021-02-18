<?php
    require_once 'connect.php';

    $idSalle = $_GET['idSalle'];
    $confirm = $_GET['confirm'];
    $date = "";
    $nbplace = 0;
    $disponible1 = 'check';
    $disponible2 = 'check';
    $disponible3 = 'check';
    $disponible4 = 'check';

    if($confirm == 0)
    {
        $active = 'disabled';

    }else if($confirm == 1)
    {
        $active = 'enabled';
        $date = $_GET['date'];

        $req = $dbh->prepare('SELECT * FROM horaire WHERE idsalle = ? AND date = ?');
        $req->execute(array($idSalle, $date));
        $horaire = $req->fetch();
        $nbplace = $horaire['nbplace'];

        if($horaire['creneau1'] == 1)
        {
            $disponible1 = 'check';
        }else{
            $disponible1 = 'times';
        }

        if($horaire['creneau2'] == 1)
        {
            $disponible2 = 'check';
        }else{
            $disponible2 = 'times';
        }

        if($horaire['creneau3'] == 1)
        {
            $disponible3 = 'check';
        }else{
            $disponible3 = 'times';
        }

        if($horaire['creneau4'] == 1)
        {
            $disponible4 = 'check';
        }else{
            $disponible4 = 'times';
        }



    }else if($confirm == 2)
    {

        $active = 'enabled';
        $idCreneau = $_GET['idCreneau'];
        $date = $_GET['date'];
        $disponible = "";

        $req = $dbh->prepare('SELECT * FROM horaire WHERE idsalle = ? AND date = ?');
        $req->execute(array($idSalle, $date));
        $horaire = $req->fetch();
        $nbplace = $horaire['nbplace'];

        $req = $dbh->prepare('UPDATE horaire SET creneau'.$idCreneau.' = ? WHERE idsalle = ? AND date = ?');

        if($horaire['creneau'.$idCreneau] == 1)
        {
            $req->execute(array(0, $idSalle, $date));
        }else if($horaire['creneau'.$idCreneau] == 0)
        {
            $req->execute(array(1, $idSalle, $date));
        }



        /*if($disponible.$idCreneau == 'times')
        {
            $disponible.$idCreneau = 'check';
        }else if($disponible.$idCreneau == 'check')
        {
            $disponible.$idCreneau = 'times';
        }*/

    }else if($confirm == 3)
    {
        $newNbplace = $_GET['nbplace'];
        $date = $_GET['date'];
        $req = $dbh->prepare('UPDATE horaire SET nbplace = ? WHERE idsalle = ? AND date = ?');
        $req->execute(array($newNbplace, $idSalle, $date));
    }


    echo '
        
        <div class="form-group row text-center ">
            <div class="form-group row">
                <label for="example-date-input" class="col-2 col-form-label">Date</label>
                <div class="col-10">
                    <input class="form-control" type="date" id="dateHoraire" value="'.$date.'" onchange="horaireSalle(this.value)">
                </div>
            </div>
            <pre>             </pre>
            <div class="form-group row">
                <label for="example-date-input" class="col-8 col-form-label">Place total</label>
                <div class="col-4">
                    <input class="form-control" type="text" id="nbplaceSalle" value="'.$nbplace.'" '.$active.'>
                </div>
            </div>
        </div>
        
        <input type="hidden" id="idsalle" value="'.$idSalle.'">
        
        <div class="row text-center">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Horaires</th>
                        <th scope="col">08h30 - 10h00</th>
                        <th scope="col">10h30 - 12h00</th>
                        <th scope="col">13h30 - 15h00</th>
                        <th scope="col">15h15 - 16h45</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-secondary">
                        <th scope="row">'.$date.'</th>
                        <td><button class="btn-outline-secondary" '.$active.' id="1" onclick="changeSatus(this.id)"><i class="fas fa-'.$disponible1.'" style="color: #0CA60C;"></i></button></td>
                        <td><button class="btn-outline-secondary" '.$active.' id="2" onclick="changeSatus(this.id)"><i class="fas fa-'.$disponible2.'" style="color: #0CA60C;"></i></button></td>
                        <td><button class="btn-outline-secondary" '.$active.' id="3" onclick="changeSatus(this.id)"><i class="fas fa-'.$disponible3.'" style="color: #0CA60C;"></i></button></td>
                        <td><button class="btn-outline-secondary" '.$active.' id="4" onclick="changeSatus(this.id)"><i class="fas fa-'.$disponible4.'" style="color: #0CA60C;"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="row float-right" style="margin: 10px;">
            <button type="button" class="btn btn-secondary" style="margin-right: 10px;" '.$active.'>Annuler</button>
            <button type="button" class="btn btn-primary" '.$active.' onclick="confirmer()">Enregistrer</button>
        </div>
    
    ';
?>


<!--<tr>
    <th scope="row">Mardi</th>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
</tr>
<tr class="table-secondary">
    <th scope="row">Mercredi</th>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
</tr>
<tr>
    <th scope="row">Jeudi</th>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
</tr>
<tr class="table-secondary">
    <th scope="row">Vendredi</th>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
    <td><button class="btn-outline-secondary" '.$active.'><i class="fas fa-check" style="color: #0CA60C;"></i></button></td>
</tr>-->