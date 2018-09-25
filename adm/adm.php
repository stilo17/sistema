

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Comercial Administrativo</title>

    <style type="text/css">
      
      thead{
          text-align: left;
          font-weight: bold;
      }

      #tabela{
        width:100%;
      }

      #tabela-data{
        width:5%;
      }

      #tabela-user{
        width:10%;
      }

      #tabela-ente{
        width:20%;
      }

      #tabela-uf{
        width:5%;
      }

      #tabela-obs{
        width:60%;
      }

    </style>


  </head>
  <body>
    <section>
      <br>
      <div class="container">
        <div class="row">
            
            <form class="form form-inline" action="">
              <div class="input-group">
                <input type="date" class="form-control ml-1" id="inicio">
                <input type="date" class="form-control ml-1" id="fim">
                <button type="button" class="btn btn-outline-primary ml-1" id="data">Filtrar</button>
              </div>
            </form>

        </div>

      </div>

    </section>

    <section>
        <br>
        <div class="container">
          <div class="row">
            <div id="tabela">

            </div>
          </div>  
        </div>
        
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>


    <script>
      $(function(){

        $('#data').click(function(){
          
          var dataInicio = $('#inicio').val();
          var dataFim = $('#fim').val();

          $.ajax({
            method:'POST',
            url:'filtrar.php',
            data:{inicio: dataInicio ,fim: dataFim},
            success:function(x){

                $('#tabela').html(x);


            }
          });


        })


      })


    </script>
  </body>
</html>