<?php
    require_once "setup.inc.php";

    function getCreneaux($cnxDb){
        $requeteBDD = "SELECT * FROM creneau";

        $creneauBDD = mysqli_query($cnxDb, $requeteBDD);

        return $creneauBDD;
    }

    function deleteCreneau($cnxDb,$item){
        $query = "DELETE FROM  creneau WHERE id = $item";
        if (mysqli_query($cnxDb,$query)){
            $message= "Le créneau a été supprimé avec succès";
        } else {
            $message = "Error: " . $query . "<br>" . mysqli_error($cnxDb);
        }
    }

    function addCreneau($cnxDb,$duree,$dateActuelle,$lib,$commentaireAvant){
    // création de la requête
    $query = "INSERT INTO creneau(idProf,dateDebut,duree,exclusivite,datePublic,libre,commentaireAvant,aEuLieu,commentaireApres,note) VALUES(idProf,DATE(),$duree,$dateActuelle,$lib,'$commentaireAvant',false,NULL,NULL) ";
        if (mysqli_query($cnxDb,$query)){
            $message= "Le créneau a été ajouté avec succès";
        } else{
            $message = "Error: " . $query . "<br>" . mysqli_error($cnxDb);
        };
    }

    function getCreneauByItem($cnxDb,$item){
        $query = "SELECT * FROM creneau WHERE id = $item ";
        if (!$result = mysqli_query($cnxDb,$query)){
            echo mysqli_error();
        }
        return mysqli_fetch_object($result);
    }