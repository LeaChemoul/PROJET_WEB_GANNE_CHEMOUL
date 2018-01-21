<?php
    include "../Controller/creneauController.php";
    require_once "header.inc.php";


/* @var $cmd type */
    //$cmd = @$_POST['cmd'];
    //$cmd = $_POST['cmd'];
    $cmd = filter_input(INPUT_GET, 'cmd');
    if (is_null($cmd)){
        $cmd = filter_input(INPUT_POST, 'cmd');
    }

    if (($cmd == 'add')&&(count($_POST)>5)){
        //récupération et protection des données envoyées
        $commentaireAvant = mysqli_real_escape_string($cnxDb,$_POST['commentaireAvant']);
        $date = $_POST['dateC'];
        $duree = $_POST['duree'];
        $timestamp = $date->getTimestamp();
        $dateActuelle = Date();
        $libre = mysqli_real_escape_string($cnxDb,$_POST['libre']);
        $lib = ($libre == 'Y')? true:false;

        addCreneau($cnxDb,$duree,$dateActuelle,$lib,$commentaireAvant);
    }
?>

<table width="100%">
    <th>

    </th>
    <?php if (!$listeCreneau){ ?>
        <tr>
            <td>
                Pas de créneaux.
            </td>
        </tr>
        <?php
    } 
    else {
        foreach ($listeCreneau as $key=>$unCreneau) { ?>
            <tr>
                <td>
                    <?php echo $unCreneau['dateDebut'] ?> (<?php echo gmdate("H:i:s", $unCreneau['duree']) ?>)
                </td>
                <td>
                    <?php echo "$unCreneau[idProf]" ?>
                </td>
                <td>
                    <?php echo "$unCreneau[exclusivite]" ?>
                </td>
                <td>
                    <?php echo "$unCreneau[datePublic]" ?>
                </td>
                <td>
                    <?php echo "$unCreneau[libre]" ?>
                </td>
                <td>
                    <?php echo "$unCreneau[commentaireApres]" ?>
                </td>
                <td>
                    <?php echo "$unCreneau[note]" ?>
                </td>
                <td>
                    <?php echo $unCreneau['commentaireAvant'] ?>
                </td>
                <td>
                    <a href="creneaux.php?cmd=delete&item=<?php echo $key ?>">Supprimer</a> -
                    <a href="editCreneau.php?cmd=update&item=<?php echo $key ?>">Modifier</a>
                </td>
            </tr>
            <?php
        }
    }
    ?>
    <tr>
        <td colspan="5" align="right">
            <a href="editCreneau.php?cmd=add">Ajouter</a>
        </td>
    </tr>
</table>