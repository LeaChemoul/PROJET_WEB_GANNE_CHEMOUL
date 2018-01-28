<?php
    require_once "setup.inc.php";

    //Récupération des créneaux
    function getCreneaux($cnxDb){
        $requeteBDD = "SELECT * FROM creneau";

        $creneauBDD = mysqli_query($cnxDb, $requeteBDD);

        return $creneauBDD;
    }

    function getCreneauxPagination($cnxDb,$messagesParPage,$pageActuelle){
        $premiereEntree=($pageActuelle-1)*$messagesParPage;
        $requeteBDD = "SELECT * FROM creneau ORDER BY id DESC LIMIT $messagesParPage OFFSET $premiereEntree";
        $creneauBDD = mysqli_query($cnxDb, $requeteBDD);
        return $creneauBDD;
    }
    
    //Récupération des professseurs
    function getProfesseurs($cnxDb){
        $requeteBDD = "SELECT * FROM professeur";

        $profBDD = mysqli_query($cnxDb, $requeteBDD);
        return $profBDD;
    }

    function deleteCreneau($cnxDb,$item){
        $query = "DELETE FROM  creneau WHERE id = $item";
        if (mysqli_query($cnxDb,$query)){
            $message= "Le créneau a été supprimé avec succès";
        } else {
            $message = "Error: " . $query . "<br>" . mysqli_error($cnxDb);
        }
    }

    function addCreneau($cnxDb,$idProf,$duree,$date,$excl,$lib,$commentaireAvant,$commApres, $note){
    //encodage pour la BDD
    $commentaireAvant = mysqli_real_escape_string($cnxDb,$commentaireAvant);
    $commApres = mysqli_real_escape_string($cnxDb,$commApres);
    $dateActuelle = date_create(date("Y-m-d H:i:s"))->format("Y-m-d\TH:i:s");
    // création de la requête
    $query = "INSERT INTO creneau(idProf,dateDebut,duree,exclusivite,datePublic,libre,commentaireAvant,commentaireApres,note) VALUES('$idProf','$date','$duree','$excl','$dateActuelle','$lib','$commentaireAvant','$commApres','$note') ";
        echo $query;
        if (mysqli_query($cnxDb,$query)){
            $message= "Le créneau a été ajouté avec succès";
        } else{
            $message = "Error: " . $query . "<br>" . mysqli_error($cnxDb);
        }
        echo $message;
    }

    function getCreneauByItem($cnxDb,$item){
        $query = "SELECT * FROM creneau WHERE id = $item ";
        if (!$result = mysqli_query($cnxDb,$query)){
            echo mysqli_error();
        }
        return mysqli_fetch_object($result);
    }
    
    function updateCreneau($cnxDb,$item,$date,$duree,$idp,$excl,$commA,$libre,$commAp,$note){
        $commA = mysqli_real_escape_string($cnxDb,$commA);
        $commAp = mysqli_real_escape_string($cnxDb,$commAp);
        $query = "UPDATE `creneau` SET `idProf` = '$idp', `dateDebut` = '$date', `duree` = '$duree', `exclusivite` = '$excl', `libre` = '$libre', `commentaireAvant` = '$commA', `commentaireApres` = '$commAp', `note` = '$note' WHERE `creneau`.`id` = $item";
        echo $query;
        if (mysqli_query($cnxDb,$query)){
            $message= "Le créneau a été modifié avec succès";
        } else{
            $message = "Error: " . $query . "<br>" . mysqli_error($cnxDb);
        }
        echo $message;
    }

    function nbrPages($cnxDb){
        $query = "SELECT COUNT(*) AS total FROM creneau";
        $resultat = mysqli_query($cnxDb,$query);
        $donnees = mysqli_fetch_assoc($resultat);
        $total = $donnees['total'];
        return $total;
    }