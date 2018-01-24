<?php

    $pagetitle = "Créneaux de soutenance";

    require_once "../Model/setup.inc.php";
    require_once "../Model/functions.inc.php";

    //DELETE
    if (isset($cmd) && $cmd == 'delete'){
        $item = filter_input(INPUT_GET, 'item',FILTER_SANITIZE_NUMBER_INT);
        deleteCreneau($cnxDb,$item);
    }

    //ADD
    if(isset($cmd) && $cmd=='add'){
        $dateDebut = new DateTime($_POST['dateC']);
        $date = $dateDebut->getTimestamp();
        $duree=filter_input(INPUT_POST,'duree',FILTER_SANITIZE_NUMBER_FLOAT);
        if(isset($_POST['exclu']))
            $exclusif = ($_POST['exclu'] == 'Y')? true:false;
        else $exclusif = false;
        if(isset($_POST['libre']))
            $lib = ($_POST['libre'] == 'Y')? true:false;
        else $lib = true;
        $libre = ($lib == "Y")? true:false;
        $idProf = filter_input(INPUT_POST,'prof',FILTER_SANITIZE_NUMBER_FLOAT);
        $commAv =$_POST['commentaireAvant'];
        if(isset($_POST['aEuLieu']))
            $aEuLieu = ($_POST['aEuLieu'] == 'Y')? true:false;
        else $aEuLieu = false;
        $commAp =filter_input(INPUT_POST,'commentaireApres',FILTER_SANITIZE_STRING);
        if($commAp == "")
            $commAp = NULL;
        $note = filter_input(INPUT_POST,'note',FILTER_SANITIZE_NUMBER_FLOAT);
        if($note == "")
            $note = NULL;
        addCreneau($cnxDb,$idProf,$duree,$date,$exclusif,$libre,$commAv,$aEuLieu,$commAp,$note);
    }

    //UPDATE
    if (isset($cmd) && $cmd == 'update' && $item != 0){
        $dateDebut = new DateTime($_POST['dateC']);
        $date = $dateDebut->getTimestamp();
        $duree=filter_input(INPUT_POST,'duree',FILTER_SANITIZE_NUMBER_FLOAT);
        if(isset($_POST['exclu']))
            $exclusif = ($_POST['exclu'] == 'Y')? true:false;
        else $exclusif = false;
        if(isset($_POST['libre']))
            $lib = ($_POST['libre'] == 'Y')? true:false;
        else $lib = true;
        $libre = ($lib == "Y")? true:false;
        $idProf = filter_input(INPUT_POST,'prof',FILTER_SANITIZE_NUMBER_FLOAT);
        $commAv =$_POST['commentaireAvant'];
        if(isset($_POST['aEuLieu']))
            $aEuLieu = ($_POST['aEuLieu'] == 'Y')? true:false;
        else $aEuLieu = false;
        $commAp =filter_input(INPUT_POST,'commentaireApres',FILTER_SANITIZE_STRING);
        if($commAp == "")
            $commAp = NULL;
        $note = filter_input(INPUT_POST,'note',FILTER_SANITIZE_NUMBER_FLOAT);
        if($note == "")
            $note = NULL;
        updateCreneau($cnxDb,$item,$date,$duree,$idProf,$exclusif,$commAv,$libre,$aEuLieu,$commAp,$note);
    }

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