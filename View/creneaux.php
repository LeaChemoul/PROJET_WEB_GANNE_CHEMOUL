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
        <nav class="navbar">
            <ul class="nav navbar-nav">
              <li><a href="creneaux.php">Acceuil</a></li>
              <li><a href="editCreneau.php">Ajouter un créneau.</a></li>
            </ul>
        </nav>
        <div class="edition">
            <table width="100%">
                <?php
                $nbr = 1;
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
                            <th>Créneau</th>
                            <th>Date de début</th>
                            <th>Durée</th>
                            <th>Identifiant du professeur</th>
                            <th>Exclusif sur l'horaire</th>
                            <th>Date de publication</th>
                            <th>Libre</th>
                            <th>Commentaire</th>
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
                                    <?php echo "Créneau " . $nbr; $nbr = $nbr + 1; ?>
                                </td>
                                <td>
                                    <?php echo date('Y-m-d\TH:i:s', strtotime($unCreneau['dateDebut'])) ?>
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
                                    <?php echo "$unCreneau[datePublic]" ?>
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
                                    <?php echo "$unCreneau[commentaireApres]" ?>
                                </td>
                                <td>
                                    <?php echo "$unCreneau[note]" ?>
                                </td>
                                <td>
                                    <a href="creneaux.php?cmd=delete&item=<?php echo $key ?>">Supprimer</a>
                                    <a href="editCreneau.php?cmd=update&item=<?php echo $key ?>">Modifier</a>
                                </td>
                            </tr>
                            <?php
                        }
                        }
                        ?>
                        <tr>
                            <td>
                                <a href="editCreneau.php?cmd=add">Ajouter</a>
                            </td>
                        </tr>
                    </tbody>

            </table>

            <br/>
            <br/>
            <br/>
            <input type="button" class="btn btn-info" value="Afficher/Cacher les professeurs" onclick="masquer_div('professeur');" />
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
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                    </tr>
                    <?php
                    foreach ($listeProfs as $keyProf=>$unProf) { ?>
                        <tr>
                            <td>
                                <?php echo "$keyProf" ?>
                            </td>
                            <td>
                                <?php echo "$unProf[nom]" ?>
                            </td>
                            <td>
                                <?php echo "$unProf[prenom]"?>
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
    



