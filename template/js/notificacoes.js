/*
Notificacoes
*/

$(function(){

	$('.responder').click(function(){
		var x = $(this).val();

		$.ajax({
			url:"model/tecnico/notificacoesmarcarResposta.php",
			method:'POST',
			data:{num:x},
			success: function(){
				window.location.reload();
			}
		});



	});

})