<?php 

class Sql extends PDO{

	public $dbconn;

	public function __construct(){

		if($_SERVER['REMOTE_ADDR'] == '::1'){
			$this->dbconn = new PDO("mysql:dbname=db_comercial;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}else{
			$this->dbconn = new PDO("mysql:dbname=;host=","","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}
	}

	public function chechUser($user, $pass){
		$sth = $this->dbconn->prepare('SELECT * FROM dbuser WHERE user = :USER and pass = :PASS');
		$sth->bindParam(":USER", $user);
		$senha = md5($pass);
		$sth->bindParam(":PASS", $senha);

		$sth->execute();

		$resultado = $sth->fetchAll();
		
		if(count($resultado) == 0) {
			return FALSE;
		}else{
			$_SESSION['usuario'] = $resultado[0]['user'];
			
			header('location:app.php');
			return TRUE;
		}
		

	}

	public function selectAll($usuario){

	if($usuario =="Pablo"){
		$sth = $this->dbconn->prepare('SELECT * FROM dbentes order by user,estado, ente ASC');
	}elseif ($usuario =="Josi") {
		$sth = $this->dbconn->prepare('SELECT * FROM dbentes WHERE user = 2 order by estado, ente ASC');
	}elseif ($usuario =="Dione"){
		$sth = $this->dbconn->prepare('SELECT * FROM dbentes WHERE user = 3 order by estado, ente ASC');
	}else{
		$sth = $this->dbconn->prepare('SELECT * FROM dbentes WHERE user = 4 order by estado, ente ASC');
	};	

		$sth->execute();
		return $sth->fetchAll();

	}


	public function selectEnte($id){

		$sth = $this->dbconn->prepare('SELECT * FROM dbcontatos Where id_ente = :ID order by dataEntrada ASC');
		$sth->bindParam(':ID',$id);
		$sth->execute();

		$sth1 = $this->dbconn->prepare('SELECT * FROM dbentes WHERE id = :ID');
		$sth1->bindParam(':ID',$id);
		$sth1->execute();

		return array($sth->fetchAll(), $sth1->fetchAll());
	}

	public function registerObs($idente,$obs,$user){
		$sth = $this->dbconn->prepare('INSERT INTO dbcontatos (id_ente,user,obs) VALUES (:ID_ENTE,:USER,:OBS)');
		$sth->bindParam(':ID_ENTE',$idente);
		$sth->bindParam(':USER',$user);
		$sth->bindParam(':OBS',$obs);
		$sth->execute();

		header("location:app.php?pg=comercialSistema&id=".$idente."&go=");
	}

	public function deleteObs($id, $usuario){
		
		$sth = $this->dbconn->prepare('
										DELETE FROM dbcontatos WHERE id=:ID AND user =:USUARIO;
									'
									);
		$sth->bindParam(':ID',$id);
		$sth->bindParam(':USUARIO',$usuario);
		$sth->execute();

		header('location:app.php?id='.$idCliente.'&go=');
		
	}

	public function alterInfo($id,$gestor,$email,$telefone){
		$sth = $this->dbconn->prepare('UPDATE dbentes 
										SET gestor = :GESTOR,
											email1 = :EMAIL1,
											email2 = :EMAIL2,
											email3 = :EMAIL3,
											telefone1 = :TELEFONE1,
											telefone2 = :TELEFONE2
										WHERE id = :ID ');
		$sth->bindParam(":ID",$id);
		$sth->bindParam(":GESTOR",$gestor);
		$sth->bindParam(":EMAIL1",$email[0]);
		$sth->bindParam(":EMAIL2",$email[1]);
		$sth->bindParam(":EMAIL3",$email[2]);
		$sth->bindParam(":TELEFONE1",$telefone[0]);
		$sth->bindParam(":TELEFONE2",$telefone[1]);

		$sth->execute();

		header("location:../../app.php?id=".$id."&pg=comercialSistema&go=");
	}


	public function listaObs($modo, $variavel){
		//$modo = 0 - Filtro por usuário
		if($modo == 0){
			
			$sth = $this->dbconn->prepare("SELECT * from dbcontatos WHERE user = :VARIAVEL;");
			$sth->bindParam(':VARIAVEL',$variavel);
			$sth->execute();

			return $sth->fetchAll();
		}else{ //$modo = 1 - Filtro por datas
			$sth = $this->dbconn->prepare("SELECT * from dbcontatos WHERE user = :VARIAVEL;");
			$sth->bindParam(':VARIAVEL',$variavel);
			$sth->execute();

			return $sth->fetchAll();
		}	
			
		
	}

	public function filtrarOBS($inicio, $fim){

		$sth = $this->dbconn->prepare("SELECT dbcontatos.*, dbentes.ente, dbentes.estado FROM dbcontatos
										INNER JOIN dbentes
										ON dbcontatos.id_ente = dbentes.id
										WHERE dbcontatos.dataEntrada BETWEEN :INICIO AND :FIM;");
		$sth->bindParam(':INICIO',$inicio);
		$sth->bindParam(':FIM',$fim);

		$sth->execute();
		return $sth->fetchAll();

	}

	public function showALL(){

		$sth = $this->dbconn->prepare('SELECT * FROM notificacoes ORDER BY respondido, data_ins DESC;');
		$sth->execute();

		return $sth->fetchAll();
	}



}

 ?>
