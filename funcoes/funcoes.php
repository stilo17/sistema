<?php 

/*Documentação das Funções do Arquivo
	1-sendEmail - 
		Função da seção model/comercial/sistema.php que envia um e-mail para comercial@brprev.com solicitando o envio de uma proposta 
	2-mes -	
		Função que escreve o nome do mês associado à um inteiro
	3-cardsLigacoes -
		Função que escreve o html dos cards da página model/com/estatisticas.php com as estatísticas relativas as ligações
	4-group_by-

	5-ligacoesUsuarios-

	6-ligacoesMes

	7-pegarNotificacoes

	8-array_notificacao

	9-formatarCorpo


*/

	
//1-sendEmail  ---------------------------------------------------------------------------------------------
function sendEmail($ente, $mensagem,$user){


    ini_set("SMTP", "smtplw.com.br");
    ini_set("sendmail_from", "comercial@brprev.com");

	$quebra_linha = "\n";
	$emailsender = "comercial@brprev.com";
	$nomeRemetente = "Sistema Comercial";
	$emailDestino = "comercial@brprev.com";
	$assunto = $user."-Proposta Comercial-".$ente;
	$mensagemHTML = $mensagem;


	$headers = "MIME-Version: 1.1\r\n";
	$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
	$headers .= "From: comercial@brprev.com\r\n"; // remetente
	$headers .= "Return-Path: comercial@brprev.com\r\n"; // return-path

	mail($emailDestino, $assunto,$mensagemHTML,$headers,"-r".$emailsender);
}


//2-mes  ---------------------------------------------------------------------------------------------
function mes($mes){

	$meses = array('Janeiro', 'Fevereiro','Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro', 'Outubro', 'Novembro', 'Dezembro');

	return $meses[(int)$mes-1];

}

//3-cardsLigacoes  ---------------------------------------------------------------------------------------------
function cardsLigacoes($totalLigacoes,$totalligacoesMes,$ligacoesSemana,$ligacoesHoje){

/*Estatísticas Globais
	1-Total de Ligações
	2-Ligações no Mês
	3-Ligações na Semana	
	4-Ligações Hoje
*/

$html = <<<HTML
<div class="container">
<h4>Estatísticas Gerais</h4>
<div class="row">
<div class="col-sm-3">
<div class="card text-center">
<div class="card-body">
<h5 class="card-title">Ano</h5>
<p class="card-text">{$totalLigacoes[0]['TOTAL']}</p>
</div>
</div>
</div>
<div class="col-sm-3">
<div class="card text-center">
<div class="card-body">
<h5 class="card-title">Mês</h5>
<p class="card-text">{$totalligacoesMes[0]['MES']}</p>
</div>
</div>
</div>
<div class="col-sm-3">
<div class="card text-center">
<div class="card-body">
<h5 class="card-title">Semana</h5>
<p class="card-text">{$ligacoesSemana[0]['LIGACOES']}</p>
</div>
</div>
</div>
<div class="col-sm-3">
<div class="card text-center">
<div class="card-body">
<h5 class="card-title">Hoje</h5>
<p class="card-text">{$ligacoesHoje[0]['LIGACOES']}</p>
</div>
</div>
</div>
</dov>
</div>
HTML;

echo $html;
}


//4-group_by  ---------------------------------------------------------------------------------------------
function group_by($key, $data) {
    $result = array();

    foreach($data as $val) {
        if(array_key_exists($key, $val)){
            $result[$val[$key]][] = $val;
        }else{
            $result[""][] = $val;
        }
    }

    return $result;
}


//5-ligacoesUsuarios  ---------------------------------------------------------------------------------------------
function ligacoesUsuarios($array){


	$linhas = '';

	foreach ($array as $usuario) {
		$linhas .= '<tr><td>'.$usuario['user'].'</td><td>'.$usuario['count(*)'].'</td></tr>';			
	}


$tabela =<<<HTML
<br>
<h4>Ligaçoes por Usuário</h4>
<div class="container">
<div class="row">
<table class="table table-sm table-hover text-center">
<thead>
<tr class="bg-info">
<td>Usuário</td><td>Quantidade</td>	
</tr>
</thead>
<tbody>{$linhas}</tbody>
</table>
</div>
</div>
HTML;

	echo $tabela;

}

//6-ligacoesMes  ---------------------------------------------------------------------------------------------
function ligacoesMes($array){

	$linhas = '';

	foreach ($array as $mes) {
		$linhas .= '<tr><td>'.mes($mes['MES']).'</td><td>'.$mes['LIGACOES'].'</td></tr>';			
	}


$tabela =<<<HTML
<br>
<h4>Ligaçoes por Mês</h4>
<div class="container">
<div class="row">
<table class="table table-sm table-hover text-center">
<thead>
<tr class="bg-info">
<td>Usuário</td><td>Quantidade</td>	
</tr>
</thead>
<tbody>{$linhas}</tbody>
</table>
</div>
</div>
HTML;

	echo $tabela;


}


//7-pegarNotificacoes  ---------------------------------------------------------------------------------------------
function pegarNotificacoes(){
//Pega as notificações do e-mail e transforma os dados em um array
        header("Content-type: text/html; charset=utf-8");


        $notificacoes = array();
        $host = "pop.brprev.com"; //aqui você deve informar o seu servidor de Email, pode ser imap.domínio ou pop.domínio 
        $usuario = "comercial@brprev.com";
        $senha = "@brprev2016@";
        $pasta = "{".$host.":143/novalidate-cert}INBOX";
         
        $inbox = imap_open($pasta, $usuario, $senha);
         
        if(!$inbox)
        { //FALHA NA CONEXÇÃO
                print_r(imap_errors());
        }
        else
        { //CONECTADO AO E-MAIL
         
                $MC = imap_check($inbox);

        // Fetch an overview for all messages in INBOX
                $result = imap_fetch_overview($inbox,"1:{$MC->Nmsgs}",0);
                
                foreach ($result as $overview) {
                        

                        if($overview->from == "nao-responda.cadprev@previdencia.gov.br"){

                                //É necessário criar um array que será posteriormente inserido em uma base de dados SQL;
                                // Esse arary precisa ter o overview da msg + corpo. Então 
                               //imap_qprint(imap_body($inbox,$overview->msgno));

                                array_push($notificacoes, array(
                                        'num'=>$overview->msgno,
                                        'from'=>imap_utf8($overview->from),
                                        'title'=>imap_utf8($overview->subject),
                                        'body'=>imap_qprint(imap_body($inbox,$overview->msgno)),
                                        'resp'=>0,
                                        'user'=>0
                                ));
                                imap_delete($inbox,$overview->msgno);
                        //        echo $overview->msgno."-";
                        //        echo $overview->from."-"; 
                        //        echo imap_utf8($overview->subject);
                        //        echo imap_qprint(imap_body($inbox,$overview->msgno)); //Pegando o corpo da MSG
                        //echo "#{$overview->msgno} ({$overview->date}) - From: {$overview->from}{$overview->subject}<br>";
                                # code...

                        }

                        
                }
        }

        imap_expunge($inbox);
        $inbox = imap_close($inbox);
        return $notificacoes;

}


//8-array_notificacao  ---------------------------------------------------------------------------------------------
function array_notificacao($textoNotificao){

	
	$pos = strpos($textoNotificao, "Exercício:"); //Retorna a posição da palavra "Exercício:"
	$notificacao = substr($textoNotificao, $pos); // Corta o texto a partir da Palavra "Exercicio:"
	
	//Separa as informações da notificação em um array
	return preg_split("/(.+:)/", $notificacao);
	
}


//9-formatarCorpo  ---------------------------------------------------------------------------------------------
function formatarCorpo($corpo){

	$pos = strpos($corpo, "Exercício:");
	$textoNot = substr($corpo, 0, $pos); //Parte Superior da Notificação
	$dadosNot = substr($corpo, $pos); //Parte Inferior da Notificação

	
	//Trabalhando a Parte Inferior
	$titulo = substr($textoNot,0,strpos($textoNot,"UF:")); // Título da Notificação
	$uf = substr($textoNot, strlen($titulo), strpos($textoNot,"Ente:") - strlen($titulo));
	$ente = substr($textoNot, strpos($textoNot,"Ente:"), strpos($textoNot,"Comunicamos ")-strpos($textoNot,"Ente:")); 



	//Trabalhando a Parte de baixo
	$exercicio = substr($dadosNot, 0, strpos($dadosNot,"Tipo de Documento:"));
	
	$tipoDoc = substr($dadosNot,strpos($dadosNot,'Tipo de Documento:'),strpos($dadosNot,'Item de Análise do Equilíbrio Financeiro e Atuarial:')-strlen($exercicio));
	
	$item = substr($dadosNot,strpos($dadosNot,'Item de Análise do Equilíbrio Financeiro e Atuarial:'), strpos($dadosNot,'Situação do Item de Análise:')-strpos($dadosNot,'Item de Análise do Equilíbrio Financeiro e Atuarial:'));
	
	$situacao = substr($dadosNot,strpos($dadosNot,'Situação do Item de Análise:'), strpos($dadosNot,'Data da Situação do Item de Análise:')-strpos($dadosNot,'Situação do Item de Análise:'));

	$dataSituacao = substr($dadosNot,strpos($dadosNot,'Data da Situação do Item de Análise:'), strpos($dadosNot,'Número da Notificação:')-strpos($dadosNot,'Data da Situação do Item de Análise:'));

	$numNot = substr($dadosNot,strpos($dadosNot,'Número da Notificação:'), strpos($dadosNot,'Prazo para Resposta:')-strpos($dadosNot,'Número da Notificação:'));

	$prazo = substr($dadosNot,strpos($dadosNot,'Prazo para Resposta:'),strpos($dadosNot,'Data Limite para Resposta:')-strpos($dadosNot,'Prazo para Resposta:'));

	$dataLimRes = substr($dadosNot,strpos($dadosNot,'Data Limite para Resposta:'),strpos($dadosNot,'Data de Envio da Resposta:')-strpos($dadosNot,'Data Limite para Resposta:'));

	$dataEnvioRes = substr($dadosNot,strpos($dadosNot,'Data de Envio da Resposta:'),strpos($dadosNot,'Para consultar')-strpos($dadosNot,'Data de Envio da Resposta:'));

	$textoFinal = substr($dadosNot,strpos($dadosNot,'Para consultar'));

	/*
	Exercício:
	Tipo de Documento:
	Item de Análise do Equilíbrio Financeiro e Atuarial:
	Situação do Item de Análise:
	Data da Situação do Item de Análise:
	Número da Notificação:
	Prazo para Resposta:
	Data Limite para Resposta:
	Data de Envio da Resposta:
	*/



	$texto = $titulo."<br>".$uf."<br>".$ente.'<br><br>';
	$texto .= $exercicio.'<br>'.$tipoDoc.'<br>'.$item.'<br>'.$situacao.'<br>'.$dataSituacao.'<br>'.$numNot.'<br>'.$prazo.'<br>'.$dataLimRes.'<br>'.$dataEnvioRes.'<br><br>'.$textoFinal;

	return array($exercicio,$ente,$numNot,$dataLimRes,$texto);

}

?>