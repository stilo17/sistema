<?php 


if(isset($_GET['pg'])){

	


//REQUISIÇÕES ADMINISTRATIVO

//REQUISIÇÕES COMERCIAL

	if($_GET['pg'] == 'comercialSistema'){

		require_once('model/com/sistema.php');

	}

	if($_GET['pg'] == 'comercialEstatistica'){

		require_once('model/com/estatisticas.php');

	}
	
	if($_GET['pg'] == 'tecnicoNotificacoes'){

		require_once('model/tecnico/notificacoes.php');
	}
}else{

		require_once('home/home.php');

}

 ?>