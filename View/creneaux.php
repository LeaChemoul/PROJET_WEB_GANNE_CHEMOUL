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
                                    <?php echo "$unCreneau[commentaireApres]" ?>
                                </td>
                                <td>
                                    <?php echo "$unCreneau[note]" ?>
                                </td>
                                <td>
                                    <a class="btn btn-link" href="creneaux.php?cmd=delete&item=<?php echo $key ?>">Supprimer</a>
                                    <a class="btn btn-link" href="editCreneau.php?cmd=update&item=<?php echo $key ?>">Modifier</a>
                                </td>
                            </tr>
                            <?php
                        }
                        }
                        ?>
                        <tr>
                            <td>
                                <a href="editCreneau.php?cmd=add" class="btn btn-outline-danger">Ajouter</a>
                            </td>
                            <td>
                                <input type="button" class="btn btn-outline-danger" value="Afficher/Cacher les professeurs" onclick="masquer_div('professeur');" />
                            <td>
                        </tr>
                    </tbody>

            </table>

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
    



