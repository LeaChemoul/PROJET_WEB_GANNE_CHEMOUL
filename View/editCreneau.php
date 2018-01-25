<?php
 
$pagetitle = "Edition d'un créneau";
require_once "header.inc.php";
include "../Model/setup.inc.php";
include "../Controller/creneauController.php";


/* $cmd = @$_REQUEST['cmd'];
 $item = @$_REQUEST['item'];
 */
$cmd = filter_input(INPUT_GET, 'cmd',FILTER_SANITIZE_STRING);
$item = filter_input(INPUT_GET, 'item',FILTER_SANITIZE_NUMBER_INT);
 
if ($cmd == 'update' && $item != 0){
    $unCreneau = getCreneauByItem($cnxDb,$item);
}
if (!isset($unCreneau)){
    $unCreneau = new stdClass();
    $date = new DateTime();
    $unCreneau->dateDebut = $date->format('Y-m-d H:i:s');;
    $unCreneau->duree = '-1';
    $unCreneau->exclusivite = false;
    $unCreneau->libre = true;
    $unCreneau->commentaireAvant = '';
    $unCreneau->commentaireApres = '';
    $unCreneau->note = '';
}
?>
<!DOCTYPE html>
<html>
    <body>
        <div id='bgimg'>
            <!-- background -->
        </div>
        <h1>Edition d'un créneau</h1>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Soutenance</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" style="">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="creneaux.php">Accueil</a>
                    </li>
                    <li class="nav-item active" >
                        <a class="nav-link" href="editCreneau.php">Ajouter un créneau <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="edition">
            <form name="creneau" action="creneaux.php" method="POST">
                <input type="hidden" name="cmd" value="<?php echo $cmd ?>">
                <input type="hidden" name="item" value="<?php echo $item ?>">
                <table width="80%">
                    <tr>
                        <td>
                            <b>Date de début</b>
                        </td>
                        <td>
                            <input type="datetime-local" name="dateC" required value="<?php
                            //echo date('Y-m-d\TH:i:s', strtotime($unCreneau->dateDebut));
                            $dateDebForm=new DateTime(($unCreneau->dateDebut));
                            echo $dateDebForm->format('Y-m-d\TH:i:s');
                            ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Duree</b>
                        </td>
                        <td>
                            <input type="time" name="duree" required value=<?php echo gmdate("H:i:s", $unCreneau->duree);?>>
                    </tr>
                    <tr>
                        <td>
                            <b>Professeur</b>
                        </td>
                        <td>
                            <?php if(!empty($listeProfs)){ ?>
                            <select name='prof'>
                                <?php foreach ($listeProfs as $keyP => $value){
                                    echo "<option value='".$keyP."'>".$value['nom']." ".$value['prenom']."</option>";
                                }
                                }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Créneau exclusif (pas d'autre créneau au même moment)</b>
                        </td>
                        <td>
                            <input type="checkbox" name="exclu" value = "Y" <?php if ($unCreneau->exclusivite == true)echo "checked" ?>>
                        </td>
                    </tr>
                    <tr height="100">
                        <td>
                            <b>Commentaire avant soutenance</b>
                        </td>
                        <td>
                            <textarea style="width : 100% ; height : 100%" name="commentaireAvant"><?php echo $unCreneau->commentaireAvant ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Libre</b>
                        </td>
                        <td>
                            <input type="radio" name="libre" value="Y" <?php if ($unCreneau->libre == true) echo "checked" ?> /> Oui
                            <input type="radio" name="libre" value="N" <?php if ($unCreneau->libre == false) echo "checked" ?> /> Non
                        </td>
                    </tr>
                    <tr height="100">
                        <td>
                            <b>Commentaire après soutenance</b>
                        </td>
                        <td>
                            <textarea style="width : 100% ; height : 100%" name="commentaireApres"><?php echo $unCreneau->commentaireApres ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Note de soutenance (/20)</b>
                        </td>
                        <td>
                            <input type="number" max=20 name="note" value=<?php echo $unCreneau->note;?>>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn btn-outline-danger" name="submit" value="Enregistrer" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </body>
</html>

