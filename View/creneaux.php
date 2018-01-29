<?php
    $pagetitle = "Carnet de rendez-vous";
    require_once "header.inc.php";

    $cmd = filter_input(INPUT_GET, 'cmd');
    $item = filter_input(INPUT_POST, 'item',FILTER_SANITIZE_NUMBER_INT);
    if (is_null($cmd)){
        $cmd = filter_input(INPUT_POST, 'cmd');
    }
    include "../Controller/creneauController.php";

?>
    <div class="container-full">
        <div id='bgimg'>
            <!-- background -->
        </div>
        <h1> Carnet de rendez-vous </h1>
        <h2> Créneaux de soutenance </h2>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Soutenance</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" style="">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="creneaux.php">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="editCreneau.php">Ajouter un créneau</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="edition">
            <form name="creneau" action="creneaux.php?cmd=deleteAll" method="POST">
                <table width="100%">
                        <?php
                        if(isset($_GET['page'])){
                            $nbr = ($_GET['page']-1)*$messagesParPage+1;
                        }else{
                            $nbr = 1;
                        }
                        if (!$listeCreneau){ ?>
                            <tr>
                                <td>
                                    Pas de créneaux.
                                </td>
                            </tr>
                            <?php
                        }
                        else {?>
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Créneau</th>
                                    <th>Date de début</th>
                                    <th>Durée</th>
                                    <th>Identifiant du professeur</th>
                                    <th>Exclusif sur l'horaire</th>
                                    <th>Date de publication</th>
                                    <th>Libre</th>
                                    <th>Commentaire</th>
                                    <th>La soutenance a eu lieu</th>
                                    <th>Commentaire après soutenance</th>
                                    <th>Note</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listeCreneau as $key=>$unCreneau) { ?>
                                    <tr>
                                        <td>
                                            <input id="checkBox" type="checkbox" name="supprimer[]" value="<?php echo $key ?>">
                                        </td>
                                        <td>
                                            <?php echo "Créneau " . $nbr; $nbr = $nbr + 1; ?>
                                        </td>
                                        <td>
                                            <?php echo date('Y-m-d H:i:s', strtotime($unCreneau['dateDebut'])) ?>
                                        </td>
                                        <td>
                                            <?php echo gmdate("H:i:s", $unCreneau['duree']) ?>
                                        </td>
                                        <td>
                                            <?php echo "$unCreneau[idProf]" ?>
                                        </td>
                                        <td>
                                            <?php if($unCreneau['exclusivite']==true){ echo "Oui";}
                                            else{
                                                echo "Non";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo date('Y-m-d H:i:s', strtotime($unCreneau['datePublic'])); ?>
                                        </td>
                                        <td>
                                            <?php if($unCreneau['libre']==true){ echo "Oui";}
                                            else{
                                                echo "Non";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $unCreneau['commentaireAvant'] ?>
                                        </td>
                                        <td>
                                            <?php if($unCreneau['aEuLieu']==true){ echo "Oui";}
                                            else{
                                                echo "Non";
                                            }?>
                                        </td>
                                        <td>
                                            <?php echo "$unCreneau[commentaireApres]" ?>
                                        </td>
                                        <td>
                                            <?php if($unCreneau["note"]==0) echo ""; else echo "$unCreneau[note]"; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-link" href="creneaux.php?page=1&cmd=delete&item=<?php echo $key ?>">Supprimer</a>
                                            <a class="btn btn-link" href="editCreneau.php?cmd=update&item=<?php echo $key ?>">Modifier</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                }

                                echo '<p align="center" style="color:white">Page : ';
                                for($i=1; $i<=$nombrePages; $i++)
                                {
                                    if($i==$pageActuelle)
                                    {
                                        echo ' [ '.$i.' ] ';
                                    }
                                    else //Sinon...
                                    {
                                        echo ' <a href="creneaux.php?page='.$i.'">'.$i.'</a> ';
                                    }
                                }
                                echo '</p>';
                                ?>
                                <tr>
                                    <td colspan="13">
                                        <a href="editCreneau.php?cmd=add" class="btn btn-outline-danger">Ajouter</a>
                                        <button type="submit" class="btn btn-outline-danger" value="Supprimer">Supprimer les éléments</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="13">
                                       <a href=""  class="btn btn-outline-danger" onclick="masquer_div('professeur');" >Afficher/Cacher les professeurs</a>
                                    </td>
                                </tr>
                            </tbody>
                </table>
             </form>


            <br/>
            <br/>
            <br/>
            <div id="professeur" style="display:none;">
                <table width="100%">
                <?php
                if (!$listeProfs){ ?>
                    <tr>
                        <td>
                            Pas de professeurs.
                        </td>
                    </tr>
                    <?php
                }
                else {?>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Identifiant</th>
                    </tr>
                    <?php
                    foreach ($listeProfs as $keyProf=>$unProf) { ?>
                        <tr>
                            <td>
                                <?php echo "$unProf[nom]" ?>
                            </td>
                            <td>
                                <?php echo "$unProf[prenom]"?>
                            </td>
                            <td>
                                <?php echo "$keyProf" ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            </div>


        </div>
    </div>
    



