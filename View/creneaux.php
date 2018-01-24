<?php
    include "../Controller/creneauController.php";
    require_once "header.inc.php";

    $cmd = filter_input(INPUT_GET, 'cmd');
    if (is_null($cmd)){
        $cmd = filter_input(INPUT_POST, 'cmd');
    }

    if (($cmd == 'add')&&(count($_POST)>5)){
        //récupération et protection des données envoyées
        $commentaireAvant = mysqli_real_escape_string($cnxDb,$_POST['commentaireAvant']);
        $date = new DateTime($_POST['dateC']);
        $duree = $_POST['duree'];
        $timestamp = $date->getTimestamp();
        $dateActuelle = time();
        echo  $dateActuelle;
        $libre = mysqli_real_escape_string($cnxDb,$_POST['libre']);
        $lib = ($libre == 'Y')? true:false;

        addCreneau($cnxDb,$duree,$dateActuelle,$lib,$commentaireAvant);
    }
?>

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
        <tr>
            <th>Créneau</th>
            <th>Date de début</th>
            <th>Durée</th>
            <th>Identifiant du professeur</th>
            <th>Exclusif sur l'horaire</th>
            <th>Date de publication</th>
            <th>Libre</th>
            <th>Commentaire</th>
            <th>A eu lieu</th>
            <th>Commentaire après soutenance</th>
            <th>Note</th>
            <th> </th>
        </tr>
        <?php
        foreach ($listeCreneau as $key=>$unCreneau) { ?>
            <tr>
                <td>
                    <?php echo "Créneau " . $nbr; $nbr = $nbr + 1; ?>
                </td>
                <td>
                    <?php echo $unCreneau['dateDebut'] ?> 
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
                <td
                    <?php if($unCreneau['aEuLieu']==true){ echo "Oui";} 
                            else{
                               echo "Non";   
                            }
                    ?>
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
</table>

<br/>
<br/>
<br/>

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


