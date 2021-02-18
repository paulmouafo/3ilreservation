

<div class="col-lg-2" style="background-color: #005067; color: white;">

    <br><button class="btn btn-info" onclick="ajouterUser()">Ajouter un étudiant</button><br>

    <br> <h4 class="text-center">Liste des salles</h4>  <br>

    <div class="form-group row" style="margin: 10px; color: #1d1c1c">
        <table class="table table-hover text-center">
            <thead>
            </thead>
            <tbody>
                <?php
                require_once '../controller/connect.php';
                $req = $dbh->prepare('SELECT * FROM salle');
                $req->execute();
                while($salle = $req->fetch())
                {
                    echo '
                        <tr class="table-secondary">
                            <th scope="col" id="'.$salle['id'].'" onclick="chooseSalle(this.id)" class="bg-">Salle '.$salle['numero'].'</th>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>
    <br>

</div>

<script>

    function chooseSalle(idsalle)
    {
        let obj = {idSalle: idsalle, confirm: 0}

        $.ajax({
            url: "../controller/gestionSalle.php",
            type:"GET",
            data:obj
        }).done(function( arg ) {
            document.getElementById('configurationSalle').innerHTML = arg

        });
    }

</script>

<script>
    function ajouterUser()
    {

        let form = '<div class="row">\n' +
            '\t\t<div class="col-lg-3">\n' +
            '\t\t</div>\n' +
            '\t\t\n' +
            '\t\t<div class="col-lg-6 transbox">\n' +
            '\t\t\t<h3 class="block-title" style="text-align: center; color: #1d1c1c;">Inscription Utilisateur</h3>\n' +
            '\t\t\t<form enctype="multipart/form-data" action="../controller/gestionFormulaire.php" class="form" method="POST">\n' +
            '\n' +
            '\t\t\t\t<div class="form-group row item1">\n' +
            '\t\t\t\t\t<label class="col-sm-4 col-form-label" for="login">Login</label>\n' +
            '\t\t\t\t\t<div class="col-sm-8 item2">\n' +
            '\t\t\t\t\t\t<input type="text" class="form-control" id="login" name="login" required placeholder="Login de l\'utlisateur...">\n' +
            '\t\t\t\t\t</div>\n' +
            '\t\t\t\t</div>\n' +
            '\t\t\t\n' +
            '\t\t\t\t<div class="form-group row item1">\n' +
            '\t\t\t\t\t<label class="col-sm-4 col-form-label" for="mdp">Mot de passe</label>\n' +
            '\t\t\t\t\t<div class="col-sm-8 item2">\n' +
            '\t\t\t\t\t\t<input type="text" class="form-control" id="mdp" name="mdp" required placeholder="Mot de passe utlisateur...">\n' +
            '\t\t\t\t\t</div>\n' +
            '\t\t\t\t</div>\n' +
            '\n' +
            '                <div class="form-group row item1">\n' +
            '\t\t\t\t\t<label class="col-sm-4 col-form-label" for="role">Role</label>\n' +
            '\t\t\t\t\t<div class="col-sm-8 item2">\n' +
            '\t\t\t\t\t\t<input type="text" class="form-control" id="role" name="role" required placeholder="Role de l\'utlisateur...">\n' +
            '\t\t\t\t\t</div>\n' +
            '\t\t\t\t</div>\n' +
            '\n' +
            '                <div class="form-group row item1">\n' +
            '\t\t\t\t\t<label class="col-sm-4 col-form-label" for="secretCode">Code secret</label>\n' +
            '\t\t\t\t\t<div class="col-sm-8 item2">\n' +
            '\t\t\t\t\t\t<input type="text" class="form-control" id="secretCode" name="secretCode" required placeholder="Code secret utlisateur...">\n' +
            '\t\t\t\t\t</div>\n' +
            '\t\t\t\t</div>\n' +
            '\t\t\t\n' +
            '\t\t\t\t<div class="form-group row item2">\n' +
            '\t\t\t\t\t<div class="col-sm-2">\n' +
            '\t\t\t\t\t\t<a href="homeadmin.php"><input type="button" class="btn btn-primary" value="Annuler"></a>\n' +
            '\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t<div class="col-sm-10">\n' +
            '\t\t\t\t\t\t<input type="submit" class=" btn btn-primary" value="inscrire" name="inscrireU">\n' +
            '\t\t\t\t\t</div>\n' +
            '\t\t\t\t</div>\t\n' +
            '\n' +
            '\t\t\t</form>\n' +
            '\t\t</div>\n' +
            '\n' +
            '\t\t<div class="col-lg-3">\t\n' +
            '\t\t</div>\n' +
            '\t</div>';

            document.getElementById('formulaire').innerHTML = form;

    }
</script>