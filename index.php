<?php 

session_start();
require_once("class/Sql.php");

$db = new Sql();

	require_once("template/login.php");
	
if(isset($_POST['entrar'])){

	$db->chechUser($_POST['user'], $_POST['pass']);

}
 ?>



