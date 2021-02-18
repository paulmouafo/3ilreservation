<?php
    
    namespace  backEndAccueil
    {
        // session_start();

        function listeSalle()
        {
            require'connect.php';
            $requette = $dbh->prepare('SELECT * FROM horaire');
            $requette->execute();
            while($horaire = $requette->fetch())
            {
               afficheSalle($horaire);
            }
        }


        function filterHoursOption()
        {
            require'connect.php';
            $requette = $dbh->prepare('SELECT * FROM creneau');
            $requette->execute();
            while($creneau = $requette->fetch())
            {
                echo ' <option value="'.$creneau['id'].'">'.$creneau['heure_d'].'-'.$creneau['heure_f'].'</option>  ';
            }
        }


        function afficheSalle($horaire)
        {
            require'connect.php';
            $requette = $dbh->prepare('SELECT * FROM salle WHERE id = ?');
            $requette->execute(array($horaire['idsalle']));
            $salle = $requette->fetch();

            if($horaire['nbplace'] == 1)
            {
                $message = 'place disponible';
                $color = '#209708';
                $bouton = 'enabled';
            }elseif($horaire['nbplace'] > 1)
            {
                $message = 'places disponibles';
                $color = '#209708';
                $bouton = 'enabled';
            }elseif($horaire['nbplace'] == 0 || $horaire['nbplace'] < 1)
            {
                $message = 'place disponible';
                $color = 'red';
                $bouton = 'disabled';
            }
            echo '
                    <div class="col" style="padding-bottom: 15px; ">
                        <div class="card" style="width: 18rem; border-radius: 20px; border-color: '.$color.';">
                            <img class="card-img-top" src="../img/salle1.jpg" alt="Card image cap" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                            <div class="card-body text-center">
                                <h5 class="card-title">'.$salle['numero'].'</h5>
                                <p class="card-text" style="color: '.$color.';">'.$horaire['nbplace'].' '.$message.'</p>
                                <input type="hidden" id="idHoraire" value="">
                                <input type="hidden" id="idCreneau" value="">
                                <button type="button" class="btn btn-primary" id="'.$salle['id'].'" data-toggle="modal" 
                                    data-target="#exampleModalCenter" '.$bouton.' onclick="idSalle(this.id)"> Reserver
                                </button>
                            </div>
                        </div>
                    </div>
                ';

            $active = 'disabled';

            if(!empty($_SESSION['date-filter']))
            {
                $dateReservation = $_SESSION['date-filter'];
                $active = 'enabled';
            }else
            {
                $dateReservation = 'Date non choisie';
                $creneauReservation = 'Pas de créneau a la datechoisie';
                $active = 'disabled';
            }

            if(!empty($_SESSION['creneau-filter']))
            {
                $creneauReservation = $_SESSION['creneau-filter'];
                $active = 'enabled';
            }else
            {
                $creneauReservation = 'Creneau vide';
                $active = 'disabled';
            }


            echo '
            
                <!-- Button trigger modal -->
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmer votre reservation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" >
                            
                            <input type="hidden" name="idUtilisateur" id="idUtilisateur" value="">
                            <input type="hidden" name="idSalle" id="idSalle" value="">
                            <input type="hidden" name="dateReservation" id="dateReservation" value="'.$dateReservation.'">
                            <input type="hidden" name="creneauf" id="creneauf" value="'.$creneauReservation.'">
                            
                            <div id="confirm">
                                <p>Salle : <span id="numeroSalle"></span> </p>
                                <p>Date : '.$dateReservation.'</p>
                                <p>Heure : '.$creneauReservation.'</p>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="quitter" style="visibility: hidden;" onclick="rafraichir()">Quitter</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="annuler">Annuler</button>
                        <button type="button" class="btn btn-primary" '.$active.' id="'.$horaire['nbplace'].'" onclick="confirmReservation(this.id)" >Confirmer</button>
                      </div>
                    </div>
                  </div>
                </div>
            ';
        }

        function filterCreneauOption($date)
        {
            require'connect.php';
            $requette = $dbh->prepare('SELECT * FROM horaire WHERE date = ?');
            $requette->execute(array($date));
            $creneau1 = 0;
            $creneau2 = 0;
            $creneau3 = 0;
            $creneau4 = 0;
            while($horaire = $requette->fetch())
            {
                if($horaire['creneau1'] == 1)
                {
                    $creneau1 = 1;
                }else if($horaire['creneau1'] == 0)
                {
                    $creneau1 = 0;
                }

                if($horaire['creneau2'] == 1)
                {
                    $creneau2 = 2;
                }else if($horaire['creneau2'] == 0)
                {
                    $creneau2 = 0;
                }

                if($horaire['creneau3'] == 1)
                {
                    $creneau3 = 3;
                }else if($horaire['creneau3'] == 0)
                {
                    $creneau3 = 0;
                }

                if($horaire['creneau4'] == 1)
                {
                    $creneau4 = 4;
                }else if($horaire['creneau4'] == 0)
                {
                    $creneau4 = 0;
                }
            }

            if($creneau1 == 1)
            {
                ajouterCreneau($creneau1);
            }
            if($creneau2 == 2)
            {
                ajouterCreneau($creneau2);
            }
            if($creneau3 == 3)
            {
                ajouterCreneau($creneau3);
            }
            if($creneau4 == 4)
            {
                ajouterCreneau($creneau4);
            }

        }

        function ajouterCreneau($idCreneau)
        {
            require'connect.php';
            $requette = $dbh->prepare('SELECT * FROM creneau WHERE id = ?');
            $requette->execute(array($idCreneau));
            while($creneau = $requette->fetch())
            {
                echo ' <option value="'.$creneau['id'].'">'.$creneau['heure_d'].'-'.$creneau['heure_f'].'</option>  ';
            }
        }

    }

?>
