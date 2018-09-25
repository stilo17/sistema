<?php 

require_once('Sql.php');

class Estatisticas extends Sql{

	public function __construct(){
		parent::__construct();
	}

	public function totalLigacoes(){
		//Essa função vai retornar um array com estatísticas das ligações

		//Total de Ligações
		$sth = $this->dbconn->prepare('SELECT count(*) as "TOTAL" from dbcontatos');
		$sth->execute();
		return $sth->fetchAll();
	}

	public function LigacoesMes(){
		//Essa função vai retornar a média de ligações por mês
		$sth = $this->dbconn->prepare("SELECT date_format(dataEntrada,'%m') as 'MES', count(dataEntrada) AS 'LIGACOES' 
										FROM dbcontatos 
										GROUP BY date_format(dataEntrada,'%m');");
		$sth->execute();
		return $sth->fetchAll();

	}

	public function totalLigacoesMes(){
		//Essa função vai retornar o total de ligações no mês atual
		$sth = $this->dbconn->prepare("SELECT count(*) as 'MES' 
										FROM dbcontatos 
										WHERE date_format(dataEntrada,'%m') = date_format(now(),'%m');");
		$sth->execute();
		return $sth->fetchAll();

	}		


	public function ligacoesSemanaAtual(){
		$sth = $this->dbconn->prepare("SELECT count(*) AS 'LIGACOES' FROM dbcontatos 
										WHERE date_format(dataEntrada,'%u') = date_format(NOW(),'%u')
										GROUP BY date_format(dataEntrada,'%u') ");
		$sth->execute();
		return $sth->fetchAll();
	}

	public function mediaLigacoesSemana(){
		$sth = $this->dbconn->prepare("SELECT count(*) / count(distinct date_format(dataEntrada,'%u')) AS 'MEDIA SEMANAL'
										FROM dbcontatos;");
		$sth->execute();

		return $sth->fetchAll();
	}

	public function ligacoesUsuariosMes(){
		$sth = $this->dbconn->prepare("SELECT date_format(dataentrada,'%c') AS 'MES' ,user AS 'USUARIO', count(*) AS 'CONTAGEM' 
								FROM dbcontatos 
								GROUP BY user,date_format(dataentrada,'%c');");
		$sth->execute();
		return $sth->fetchAll();
	
	}

	public function ligacoesHoje(){
		$sth = $this->dbconn->prepare("SELECT count(*) as 'LIGACOES' FROM dbcontatos WHERE date_format(dataEntrada,'%M %d %Y') = date_format(now(),'%M %d %Y');");
		$sth->execute();
		return $sth->fetchAll();
	}


	public function ligacoesUsuario(){
		$sth = $this->dbconn->prepare('SELECT user,count(*) FROM dbcontatos GROUP BY user;');
		$sth->execute();
		return $sth->fetchAll();
	}




}

?>