<?php

    $pagetitle = "Créneaux de soutenance";

    require_once "../Model/setup.inc.php";
    require_once "../Model/functions.inc.php";

    //Recupération des créneaux
    $listeCreneau = Array();
    $creneauBDD = getCreneaux($cnxDb);

    if($creneauBDD != FALSE){
        while ($row = $creneauBDD->fetch_assoc()) {
            $listeCreneau[$row["id"]]=["idProf" => $row ["idProf"],"dateDebut"=>$row["dateDebut"],"duree"=>$row["duree"],"exclusivite"=>$row["exclusivite"],"datePublic"=>$row["datePublic"],"libre"=>$row["libre"],"commentaireAvant"=>$row["commentaireAvant"],"aEuLieu"=>$row["aEuLieu"],"commentaireApres"=>$row["commentaireApres"],"note"=>$row["note"]];
        }
    }


    //DELETE
    if (isset($cmd) && $cmd == 'delete'){
        $item = filter_input(INPUT_GET, 'item',FILTER_SANITIZE_NUMBER_INT);
        deleteCreneau($cnxDb,$item);
    }

    //ADD
    if(isset($cmd) && $cmd=='add'){
        $duree=filter_input(INPUT_GET,'duree',FILTER_SANITIZE_NUMBER_FLOAT);
        $dateActuelle=filter_input(INPUT_GET,'dateActuelle',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $libre=$_POST['lib']; //a modifier
        $commAvant=filter_input(INPUT_GET,'commentaireAvant',FILTER_SANITIZE_STRING);
        addCreneau($cnxDb,$duree,$dateActuelle,$libre,$commAvant);
    }
