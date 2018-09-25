<?php 

require_once('../class/Sql.php');

$db = new Sql();

$inicio = $_POST['inicio'];
$fim = $_POST['fim'];

$observacoes = $db->filtrarOBS($inicio, $fim);


$tabela = '<table class="table table-hover table-sm"><thead><tr class="table-active"><td id="tabela-data">Data</td><td id="tabela-user">Usuário</td><td id="tabela-ente">Ente</td><td id="tabela-uf">UF</td><td id="tabela-obs">Obs</td></tr></thead><tbody>';

foreach ($observacoes as $obs) {
	
	$tabela .= '<tr>';
	$date = date_create($obs['dataEntrada']);
	$tabela .= '<td>'.date_format($date,'d/m/Y').'</td>';
	$tabela .= '<td>'.$obs['user'].'</td>';
	$tabela .= '<td>'.$obs['ente'].'</td>';
	$tabela .= '<td>'.$obs['estado'].'</td>';
	$tabela .= '<td>'.$obs['obs'].'</td>';
	$tabela .= '<tr>';
}




$tabela .= '</tbody></table>';

echo $tabela;

 ?>
