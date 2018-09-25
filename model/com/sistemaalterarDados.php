<?php 

require_once('../../class/Sql.php');

$db = new Sql();

$dados = array(
			$_POST['alterarDados'], //id
			$_POST['gestor'],
			
			array(
				$_POST['email1'],
				$_POST['email2'],
				$_POST['email3']
			),

			array(
				$_POST['telefone1'],
				$_POST['telefone2']
			)
		);



$db->alterInfo($dados[0],$dados[1],$dados[2],$dados[3]);
				

 ?>