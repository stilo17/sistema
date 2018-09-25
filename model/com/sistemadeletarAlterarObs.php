<?php 

require_once('../class/Sql.php');
session_start();

$db = new Sql();

//$id = $_GET['id'];
$idObs = $_POST['idObs'];
//echo $idObs.'-'.$_SESSION['usuario'];
$db->deleteObs($idObs,$_SESSION['usuario']);

 ?>