<?php 

require_once("class/Sql.php");
require_once("funcoes/funcoes.php");

define('COMERCIAL', 'model/');
define('ADM','model/');
define('TECNICO','model/');


session_start();

	require_once("template/header.php");
	

	//Página que vai decidir qual parte do sistema será utilizado
	require_once('model/model.php');

	
	require_once("template/footer.php");
	

 ?>