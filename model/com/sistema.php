<?php 

$db = new Sql();
$listaEntes = $db->selectAll($_SESSION['usuario']);
$dadosCliente = '';
$historicoCliente = '';
$selectEntes = "<select name='id' class='form-control'>";


foreach ($listaEntes as $ente) {
	//Lista de Entes
	if(isset($_GET['id'])){

		if($_GET['id'] == $ente['id']){
			$selectEntes .= '<option value="'.$ente['id'].'" selected>'.$ente['estado'].'-'.$ente['ente']."</option>"; 
		}else{
			$selectEntes .= '<option value="'.$ente['id'].'">'.$ente['estado'].'-'.$ente['ente']."</option>"; 		
		}
	}else{
		$selectEntes .= '<option value="'.$ente['id'].'">'.$ente['estado'].'-'.$ente['ente']."</option>"; 		
	}
	
}

	$selectEntes .= "</select>";
 
 if(isset($_GET['go'])){
 	$dados = $db->selectEnte($_GET['id']);
 	$historicoCliente = $dados[0];
 	$dadosCliente = $dados[1];
 }

if (isset($_POST['cadastrar']) && isset($_GET['id'])) {
	
	$db->registerObs($_GET['id'],$_POST['observacao'],$_SESSION['usuario']);

}

if (isset($_POST['proposta']) && isset($_GET['id'])) {
	
	$db->registerObs($_GET['id'],$_POST['observacao'],$_SESSION['usuario']);
	sendEmail($dadosCliente[0]['ente'], $_POST['observacao'],$_SESSION['usuario']);
}


 ?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-5">
				<form action="" method="GET" class="form form-inline">
					<?php echo $selectEntes; ?>
					<input type="hidden" name='pg' value="<?php echo "comercialSistema" ?>">
					<button type="submit" name="go" class="btn btn-outline-success form-control ml-2">Go!</button>
				</form>			
			</div>
			<div class="col-sm-7">
				<form action="" class="form" method="POST">
					<textarea name="observacao" id="" cols="30" rows="3" class="form-control"></textarea>
					<button type="submit" class="btn btn-outline-secondary ml-1 mt-1 float-sm-right" name="proposta">Proposta</button>
					<button type="submit" class="btn btn-outline-primary mt-1 float-sm-right" name="cadastrar">Cadastrar</button>
				</form>
			</div>

		</div>
		<hr>
		<div class="row">
			<div class="col-sm-4">
				
				<?php if ($dadosCliente != ""): ?>
					<?php
						echo "<strong>Cidade:</strong>".$dadosCliente[0]['ente'].'<br>'; 
						echo "<strong>Estado:</strong>".$dadosCliente[0]['estado'].'<br>'; 
						echo "<strong>Gestor:</strong>".$dadosCliente[0]['gestor'].'<br>';
						echo "<strong>Email:</strong>".$dadosCliente[0]['email1'].'<br>';
						echo "<strong>Email:</strong>".$dadosCliente[0]['email2'].'<br>';
						echo "<strong>Email:</strong>".$dadosCliente[0]['email3'].'<br>';
						echo "<strong>Telefone:</strong>".$dadosCliente[0]['telefone1'].'<br>';
						echo "<strong>Telefone:</strong>".$dadosCliente[0]['telefone2'].'<br>';

					?>	
				

				<button class="btn btn-outline-primary mt-2" data-toggle="modal" data-target="#dadosCadastrais">Alterar Dados</button>
					<!--MODAL -->
					<div class="modal fade" id="dadosCadastrais" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel"><?php echo $dadosCliente[0]['ente'] ?></h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        <form action="model/com/sistemaalterarDados.php" class="form" method="POST">
					        	<div class="input-group">
					        		<input class="form-control" type="text" placeholder="Gestor" name="gestor" value="<?php echo $dadosCliente[0]['gestor']  ?>">
					        	</div><br>
								<div class="input-group">
									<input type="email" class="form-control" placeholder="Email" name="email1" value="<?php echo $dadosCliente[0]['email1']  ?>">
								</div><br>
								<div class="input-group">
									<input type="email" class="form-control" placeholder="Email 2" name="email2" value="<?php echo $dadosCliente[0]['email2']  ?>">
								</div><br>
								<div class="input-group">
									<input type="email" class="form-control" placeholder="Email 3" name="email3" value="<?php echo $dadosCliente[0]['email3']  ?>">
								</div><br>
								<div class="input-group">
									<input type="text" class="form-control telefone" placeholder="Telefone" name="telefone1" value="<?php echo $dadosCliente[0]['telefone1']  ?>">
								</div><br>
								<div class="input-group">
									<input type="text" class="form-control telefone" placeholder="Telefone 2" name="telefone2" value="<?php echo $dadosCliente[0]['telefone2']  ?>">
								</div><br>
								<button type="submit" name="alterarDados" value="<?php echo $_GET['id'] ?>" class="btn btn-primary">Alterar</button>
					        </form>
					      </div>
					    </div>
					  </div>
					</div>
				<?php endif ?>
			</div>
			<div class="col-sm-8">
				<?php if ($historicoCliente != ""): ?>
					<table class="table table-hover table-sm">
						<thead>
							<th>Data</th>
							<th>Observação</th>
							<th>Usuário</th>
							<th>Alterar/Deletar</th>
						</thead>
						<tbody>

							<?php foreach ($historicoCliente as $obs): ?>
								<tr>
									<td><?php echo date('d/m/Y H:i:s', strtotime($obs['dataEntrada'])); ?></td>
									<td><?php echo $obs['obs']; ?></td>
									<td><?php echo $obs['user']; ?></td>
									<td><button class="btn btn-primary"></button>/<button class="btn btn-danger deletar" value="<?php echo $obs['id'] ?>"></button></td>
								</tr>							
							<?php endforeach ?>

						</tbody>
					</table>
				<?php endif ?>
				
			</div>
		</div>

	</div>
</section>


