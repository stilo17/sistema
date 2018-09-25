<?php 
require_once('Notificacoes.php');

$db = new Notificacoes();

$id = $_POST['num'];

$db->respondido($id);


 ?>