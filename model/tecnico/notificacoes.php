<?php 

require_once('funcoes/funcoes.php');
require_once('class/Sql.php');
require_once('class/Notificacoes.php');

$db_not = new Notificacoes();
$lista_not = $db_not->showALL();


 ?>
<section>
	<div class="container">
		<br>
		<a class="btn btn-primary" href="model/tecnico/notificacoesAtualizar.php" role="button">Atualizar</a>
	</div>
</section>
<br>
<section>
	<div class="container">	
		<div class="row">
			<table class='table table-hover table-sm'>
				<thead>
				<tr class="bg-info">
						<td>ID</td>
						<td>Exercício</td>
						<td>Ente</td>
						<td>Nº Not</td>
						<td>Data p/ Resposta</td>
						<td>Respondido</td>
						<td>Data</td>
						<td>Marcar/Ver</td>
				</tr>
				</thead>
				<body>
				<?php foreach ($lista_not as $not) {?>
					<tr>
						<?php $dadosNotificacao = formatarCorpo($not['body']); ?>
						<td><?php echo $not['id']; ?></td> 
						<td><?php echo str_replace('Exercício:', '', $dadosNotificacao[0]); ?></td>
						<td><?php echo str_replace('Ente:', '', $dadosNotificacao[1]); ?></td>
						<td><?php echo str_replace('Número da Notificação:', '',$dadosNotificacao[2]); ?></td>
						<td><?php echo str_replace('Data Limite para Resposta:','',$dadosNotificacao[3]); ?></td>
						<td>
							<?php 
								if($not['respondido'] == 0){
									echo "Não Respondido";
								}else{
									echo "Respondido";
								} 
							?>
							
						</td>
						<td><?php echo $not['data_ins']; ?></td>
						<td><button type="button" class="btn btn-outline-success responder" name="resp" value=<?php echo $not['id'] ?>></button>
							<button type="button" class="btn btn-outline-primary" name="ver" data-toggle="modal" data-target=<?php echo "#".$not['id'] ?>></button>
						</td>
					</tr>
				<?php } ?>	

				</body>
			</table>

			<!-- Modal ---->

			<?php foreach ($lista_not as $not) {?>
			<div class="modal fade" id=<?php echo $not['id'] ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel"><?php echo "Notificação ".$not['id'] ?></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        	<?php  echo $dadosNotificacao[4];?>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			      </div>
			    </div>
			  </div>
			</div>
			<?php } ?>

		</div>
	</div>
</section>