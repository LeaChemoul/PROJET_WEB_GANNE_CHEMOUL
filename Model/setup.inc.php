<?php include_once "config.inc.php";
 
$cnxDb = mysqli_connect($CFG->srvName, $CFG->login, $CFG->password, $CFG->dbName); if (!$cnxDb){
  die('Erreur de connexion (' . mysqli_connect_errno() . ') '             
          . mysqli_connect_error()); } 


