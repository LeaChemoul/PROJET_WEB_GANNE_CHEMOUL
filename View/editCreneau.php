<?php
 
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
    $unCreneau->dateDebut = '';
    $unCreneau->duree = '';
    $unCreneau->exclusivite = '';
    $unCreneau->libre = true;
    $unCreneau->commentaireAvant = '';


}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edition d'un créneau</title>
        <meta charset="utf-8">
        <meta name="description" content="165c. uniques"> </head>
 
    <body>
        <h2>Edition d'un créneau</h2>
        <form name="creneau" action="creneaux.php" method="POST">
            <input type="hidden" name="cmd" value="<?php echo $cmd ?>">
            <input type="hidden" name="item" value="<?php echo $item ?>">
            <table width="80%">
                <tr>
                    <td>
                        <b>Date de début</b>
                    </td>
                    <td>
                    <input type="datetime-local" name="dateC" value="<?php
                    echo date('Y-m-d\TH:i:s', strtotime($unCreneau->dateDebut));
                    ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Duree</b>
                    </td>
                    <td>
                        <input type="time" name="duree" value=<?php echo gmdate("H:i:s", $unCreneau->duree);?>>
                </tr>
                <tr>
                    <td>
                        <b>Créneau exclusif (pas d'autre créneau au même moment)</b>
                    </td>
                    <td>
                        <input type="checkbox" name="exclusif" <?php if ($unCreneau->exclusivite == true)echo "checked" ?>>
                    </td>
                </tr>
                <tr height="200">
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
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Enregistrer" />
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>

