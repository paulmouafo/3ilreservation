
<div class="col-lg-2" style="background-color: #005067; color: white;">
    <br>
    <?php
        echo ' <h4 class="text-center">Filtres</h4> ';
        $_SESSION['date-filter'] = "";
        $_SESSION['creneau-filter'] = "";
        $_SESSION['idHoraire']= "";
    ?>
    <br>

    <?php
        if($_SESSION['role'] == 'admin')
        {
            echo '
                <br>
                <div class="form-group row">
                    <img src="../img/geste-barriere1.jpg" style="width: 90%; margin: auto">
                </div>
            ';
        }
    ?>

    <div class="form-group row">
        <label for="example-date-input" class="col-2 col-form-label">Date</label>
        <div class="col-10">
            <input class="form-control" type="date" id="date-input" onchange="pickDate(this.value)">
        </div>
    </div>
    <br>
    <div class="form-group row">
        <label class="col-2 col-form-label">Heure</label>
        <div class="col-10">
            <select class="form-control" id="creneau" disabled onchange="pickHours(this.value)">
                <option value="" selected>Choix du créneau</option>
                <?php
                    require_once '../controller/requettes.php';
                    use backEndAccueil as requete;
                    requete\filterHoursOption();
                ?>
            </select>
        </div>
    </div>
    <br>
    <div class="form-group row">
        <img src="../img/geste-barriere1.jpg" style="width: 90%; margin: auto">
    </div>

</div>

<script src="../js/filter.js"> </script>