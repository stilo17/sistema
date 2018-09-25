<?php 


class Notificacoes extends PDO{

	public function __construct(){
		if($_SERVER['REMOTE_ADDR'] == '::1'){
			$this->dbconn = new PDO("mysql:dbname=ai_notificacoes;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}else{
			$this->dbconn = new PDO("mysql:dbname=brprev;host=186.202.152.239","brprev","brprevmp1983",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}
	}

	public function insertNot($not){

		$titulo = $not['title'];

		$sth = $this->dbconn->prepare('INSERT INTO notificacoes (num_msg, from_email,title,body,respondido,id_user) VALUES (:NUM,:DE, :TITLE,:BODY,:RESPONDIDO,:IDUSER);');
		$sth->bindParam(':NUM',$not['num']);
		$sth->bindParam(':DE',$not['from']);
		$sth->bindParam(':TITLE',$titulo);
		$sth->bindParam(':BODY',$not['body']);
		$sth->bindParam(':RESPONDIDO',$not['resp']);
		$sth->bindParam(':IDUSER',$not['user']);

		$sth->execute();
		
	}


	public function showALL(){

		$sth = $this->dbconn->prepare('SELECT * FROM notificacoes ORDER BY respondido, data_ins DESC;');
		$sth->execute();

		return $sth->fetchAll();
	}


	public function respondido($id){
		$sth = $this->dbconn->prepare('UPDATE notificacoes SET respondido = 1 WHERE id = :ID;');
		$sth->bindParam(':ID',$id);

		$sth->execute();

	}
}

 ?>