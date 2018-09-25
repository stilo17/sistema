<?php 

set_time_limit(60);

require_once('../../funcoes/funcoes.php');
require_once('../../class/Notificacoes.php');

$listaNotificacoes = pegarNotificacoes();

$dbNot = new Notificacoes();

foreach ($listaNotificacoes as $not) {
	$dbNot->insertNot($not);
}

header('location:../../app.php?pg=tecnicoNotificacoes');

 ?>