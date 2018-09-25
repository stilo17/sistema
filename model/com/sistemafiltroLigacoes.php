<?php 


require_once('../class/Sql.php');

$db = new Sql();
$tabela = "";


if(isset($_POST['lista'])){

	$listaObs = $db->listaObs(0,$_POST['lista']); 

}elseif(ifisset($_POST['entreDatas'])){

	$listaObs = $db->listaObs(1,$_POST['entreDatas']);
}



 ?>