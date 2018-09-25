//
//JAVASCRIPT DOS MÉTODOS DA SEÇÃO COMERCIAL --- Ligações
//

$(function(){
    		$('.telefone').mask('(000) 0000-0000');
    	
    		$('.deletar').click(function(){

                var id = $(this).val();
                var deletar;
    			deletar = confirm('Deletar observação?');
                
                if(deletar){                  

                    $.ajax({
                        method: "POST",
                        url: "model/com/sistemadeletarAlterarObs.php",
                        data:{idObs:id},
                        success:function(e){
                             alert('Observação Deletada com Sucesso!');
                             
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                                //alert(xhr.status);
                                //alert(thrownError);
                        }
                    }); // Fim Ajax
                } // Fim do If

                window.location.href = $(location).attr('href');

    		});//Fim do Click


            $("#lista").click(function(){
                alert('Lista');
            });


            $("#entreData").click(function(){
                alert('entreData');
            });


    	})//Fim JQUERY