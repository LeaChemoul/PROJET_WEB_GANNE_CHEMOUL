<?php

    $pagetitle = "Créneaux de soutenance";

    require_once "../Model/setup.inc.php";
    require_once "../Model/functions.inc.php";

    //Recupération des créneaux
    $listeCreneau = Array();
    $listeProfs = Array();
    $creneauBDD = getCreneaux($cnxDb);
    $profBDD = getProfesseurs($cnxDb);

    if($creneauBDD != FALSE){
        while ($row = $creneauBDD->fetch_assoc()) {
            $listeCreneau[$row["id"]]=["idProf" => $row ["idProf"],"dateDebut"=>$row["dateDebut"],"duree"=>$row["duree"],"exclusivite"=>$row["exclusivite"],"datePublic"=>$row["datePublic"],"libre"=>$row["libre"],"commentaireAvant"=>$row["commentaireAvant"],"aEuLieu"=>$row["aEuLieu"],"commentaireApres"=>$row["commentaireApres"],"note"=>$row["note"]];
        }
    }

    if($profBDD!= FALSE){
        while ($row = $profBDD->fetch_assoc()) {
            $listeProfs[$row["idProf"]]=["nom" => $row ["nom"],"prenom"=>$row["prenom"]];
        }
    }

    //DELETE
    if (isset($cmd) && $cmd == 'delete'){
        $item = filter_input(INPUT_GET, 'item',FILTER_SANITIZE_NUMBER_INT);
        deleteCreneau($cnxDb,$item);
    }

    //ADD
    if(isset($cmd) && $cmd=='add'){
        $duree=filter_input(INPUT_POST,'duree',FILTER_SANITIZE_NUMBER_FLOAT);
        $dateDebut = filter_input(INPUT_GET,'dateC','(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})');
        $date = $dateDebut->getTimestamp();
        $idProf = filter_input(INPUT_POST,'prof',FILTER_SANITIZE_NUMBER_FLOAT);
        $commAv =filter_input(INPUT_POST,'commentaireAvant',FILTER_SANITIZE_STRING);
        $commAp =filter_input(INPUT_POST,'commentaireApres',FILTER_SANITIZE_STRING);
        $lib = $_POST['libre'];
        $libre = ($lib == "Y")? true:false;
        $exclusif = $_POST['exclusif'];
        $aEuLieu = $_POST['exclusif'];
        $note = filter_input(INPUT_POST,'duree',FILTER_SANITIZE_NUMBER_FLOAT);


        addCreneau($cnxDb,$duree,$dateActuelle,$libre,$commAvant);
    }
    
    if (isset($cmd) && $cmd == 'update' && $item != 0){
        $duree = filter_input(INPUT_POST,'duree',FILTER_SANITIZE_NUMBER_FLOAT);

        updateCreneau($cnxDb,$item,$date,$duree,$idp,$exclusivite,$commAv,$libre,$aEulieu,$commAp,$note);
    }
