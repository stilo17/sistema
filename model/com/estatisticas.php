<?php 
require_once('class/Sql.php');
require_once('class/Estatisticas.php');
require_once('funcoes/funcoes.php');

$dbEstas = new Estatisticas();

$totalLigacoes = 	$dbEstas->totalLigacoes();
$ligacoesMes = 		$dbEstas->LigacoesMes();
$totalligacoesMes =	$dbEstas->totalLigacoesMes();
$ligacoesSemana = 	$dbEstas->ligacoesSemanaAtual();
$ligacoesHoje =		$dbEstas->ligacoesHoje();
$ligacoesUser =		$dbEstas->ligacoesUsuario();


//Imprime os cards das Ligações
cardsLigacoes($totalLigacoes,$totalligacoesMes,$ligacoesSemana,$ligacoesHoje);

ligacoesUsuarios($ligacoesUser);
ligacoesMes($ligacoesMes);
?>