<div class="col-lg-10 background">
    <div class="box">
        <br><h3 class="text-center" style="color: #1d1c1c;">Gestion de mes reservations </h3><br>

            <?php

                $idutilisateur = $_SESSION['idUtilisateur'];
                $tab = [];
                $i = 0;

                require_once '../controller/connect.php';
                /*$req = $dbh->prepare('SELECT * FROM reservation WHERE idutilisateur = ?');
                $req->execute(array($idutilisateur));*/

                $requette = $dbh->prepare('SELECT DISTINCT date FROM reservation WHERE idutilisateur = ?');
                $requette->execute(array($idutilisateur));
                while($reservation = $requette->fetch())
                {
                    echo '
                        
                       <div class="row">
                    ';
                    $dateReservation = $reservation['date'];
                    echo '
                        <hr class="md-4">
                        <h4 style="color: #1d1c1c">'.$dateReservation.'</h4>
                    ';
                    $req2 = $dbh->prepare('SELECT * FROM reservation WHERE date = ? AND idutilisateur = ?');
                    $req2->execute(array($dateReservation, $idutilisateur));
                    while($row = $req2->fetch())
                    {
                        $req3 = $dbh->prepare('SELECT * FROM salle WHERE id = ?');
                        $req3->execute(array($row['idsalle']));
                        $salle = $req3->fetch();

                        $requette2 = $dbh->prepare('SELECT id FROM reservation WHERE idutilisateur = ? AND idsalle = ? AND date = ? AND creneau = ?');
                        $requette2->execute(array($idutilisateur, $salle['id'], $dateReservation, $row['creneau'] ));
                        $idreservation = $requette2->fetch();
                        //var_dump($idreservation);

                        echo '
                                     <div class="col" style="padding-bottom: 15px;">
                                        <div class="card" style="width: 18rem; border-radius: 20px;  border: 2px solid green;">
                                            <img class="card-img-top" src="../img/salle1.jpg" alt="Card image cap" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">'.$salle['numero'].'</h5>
                                                <h6 class="card-title">'.$row['creneau'].'</h6>
                                                <p class="card-text" ></p>
                                                <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#exampleModalCenter" id="'.$idreservation['id'].'" onclick="updateModal(this.id)"> Supprimer </button>
                                            </div>
                                        </div>
                                    </div>
                                ';


                        echo '
                            <!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmer votre Suppression</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body" >
                                        <input type="hidden" id="idSalle" value="'.$salle['id'].'">
                                        <input type="hidden" id="creneauSalle" value="'.$row['creneau'].'">
                                        <input type="hidden" id="dateR" value="'.$dateReservation.'">
                                        <input type="hidden" id="iduser" value="'.$idutilisateur.'">
                                    
                                        <p>Salle : <span id="numeroSalle"></span></p>
                                        <p>Date : <span id="dateReservation"></span></p>
                                        <p>Heure : <span id="creneauReservation"></span></p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-danger" id="'.$idreservation['id'].'" onclick="confirmDeleteReservation(this.id)" >Supprimer</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        ';



                    }

                    echo '</div>';
                }
            ?>

<!--
        <div>
            <hr class="md-4">
            <h4 style="color: #1d1c1c">2020/10/01</h4>
            <div class="row">
                <?php
/*                        for($i=0; $i<4; $i++)
                        {
                            echo '
                                <div class="col" style="padding-bottom: 15px;">
                                    <div class="card" style="width: 18rem; border-radius: 20px;  border: 2px solid green;">
                                        <img class="card-img-top" src="../img/salle1.jpg" alt="Card image cap" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">11'.$i.'</h5>
                                            <h6 class="card-title">08h30-10h00</h6>
                                            <p class="card-text" ></p>
                                            <i class="fas fa-check" style="color: #0CA60C"></i>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                        */?>
            </div>
        </div>-->


    </div>
</div>

<script src="../js/deleteReservation.js"></script>