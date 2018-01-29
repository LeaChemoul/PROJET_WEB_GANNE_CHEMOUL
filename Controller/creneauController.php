<?php
    require_once "../Model/setup.inc.php";
    require_once "../Model/functions.inc.php";

    //DELETE------------------------------------------------------------------------------------------------------------
    if (isset($cmd) && $cmd == 'delete'){
        $item = filter_input(INPUT_GET, 'item',FILTER_SANITIZE_NUMBER_INT);
        deleteCreneau($cnxDb,$item);
    }

    //DELETE ALL
    if(isset($cmd) && $cmd == 'deleteAll'){
        if(isset($_POST['supprimer'])){
            foreach ($_POST['supprimer'] as $value){
                deleteCreneau($cnxDb,$value);
            }
        }
    }

    //Récupération POST-------------------------------------------------------------------------------------------------
    if(isset($cmd) && $cmd != 'deleteAll'){
        $dateDebut = date_create($_POST['dateC'])->format("Y-m-d\TH:i:s");
        $duree=filter_input(INPUT_POST,'duree',FILTER_SANITIZE_NUMBER_FLOAT);
        if(isset($_POST['exclu'])){
            if($_POST['exclu'] == 'Y')
                $exclusif = true;
            else
                $exclusif = false;
        }
        else $exclusif = false;
        if(!empty($_POST['aEuLieu'])){
            if($_POST['aEuLieu'] == 'Y')
                $aEuLieu = true;
            else
                $aEuLieu = false;
        }
        else $aEuLieu = false;
        if(isset($_POST['libre'])){
            if($_POST['libre'] == 'Y')
                $lib = true;
            else
                $lib = false;
        }
        else $lib = true;
        $idProf = filter_input(INPUT_POST,'prof',FILTER_SANITIZE_NUMBER_FLOAT);
        $commAv =$_POST['commentaireAvant'];
        if($aEuLieu ==true){
            $commAp =filter_input(INPUT_POST,'commentaireApres',FILTER_SANITIZE_STRING);
            if($commAp == "")
                $commAp = NULL;
            $note = filter_input(INPUT_POST,'note',FILTER_SANITIZE_NUMBER_FLOAT);
            if($note == "")
                $note = NULL;
        }else{
            $commAp = NULL;
            $note = NULL;
        }


    }
    //ADD---------------------------------------------------------------------------------------------------------------
    if(isset($cmd) && $cmd=='add'){
        addCreneau($cnxDb,$idProf,$duree,$dateDebut,$exclusif,$lib,$commAv,$aEuLieu,$commAp,$note);
    }

    //UPDATE------------------------------------------------------------------------------------------------------------
    if (isset($cmd) && $cmd == 'update' && $item != 0){
        updateCreneau($cnxDb,$item,$dateDebut,$duree,$idProf,$exclusif,$commAv,$lib,$aEuLieu,$commAp,$note);
    }

    //GESTION DE LA PAGINATION DE LA LISTE -----------------------------------------------------------------------------
    $messagesParPage = 5;
    $total = nbrPages($cnxDb);
    $nombrePages = ceil($total/$messagesParPage);
    if(isset($_GET['page']))
    {
        $pageActuelle=intval($_GET['page']);

        if($pageActuelle>$nombrePages)
        {
            $pageActuelle=$nombrePages;
        }
    }
    else // Sinon
    {
        $pageActuelle=1;
    }

    //Recupération des créneaux ----------------------------------------------------------------------------------------
    $listeCreneau = Array();
    $listeProfs = Array();
    $creneauBDD = getCreneauxPagination($cnxDb,$messagesParPage,$pageActuelle);
    $profBDD = getProfesseurs($cnxDb);

    if($creneauBDD != FALSE){
        while ($row = $creneauBDD->fetch_assoc()) {
            $listeCreneau[$row["id"]]=["idProf" => $row ["idProf"],"dateDebut"=>$row["dateDebut"],
                "duree"=>$row["duree"],"exclusivite"=>$row["exclusivite"],"datePublic"=>$row["datePublic"],
                "libre"=>$row["libre"],"commentaireAvant"=>$row["commentaireAvant"],"aEuLieu"=>$row["aEuLieu"],
                "commentaireApres"=>$row["commentaireApres"],"note"=>$row["note"]];
        }
    }

    if($profBDD!= FALSE){
        while ($row = $profBDD->fetch_assoc()) {
            $listeProfs[$row["idProf"]]=["nom" => $row ["nom"],"prenom"=>$row["prenom"]];
        }
    }


