<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>BrPrev Atuarial</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!--Estilos Customizados-->
    <link rel="stylesheet" href="template/css/estilo.css">
    
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

<div class="wrapper">
    <!--sidebar-->
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <h3>BrPrev Atuarial</h3>
        </div>

        <ul class="list-unstyled components">
            <p>SEÇÕES</p>
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Notícias</a>
                    </li>
                    <li>
                        <a href="#">Agenda</a>
                    </li>
                </ul>
            </li>

            <li>
              <a href="#admSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Administrativo</a>
              <ul class="collapse list-unstyled" id="admSubmenu">
                <li>
                  <a href="">Documentos</a>
                </li>
                <li>
                  <a href="">Notas</a>
                </li>
              </ul>
            </li>

            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Comercial</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="app.php?pg=comercialSistema">Sistema</a>
                    </li>
                    <li>
                        <a href="app.php?pg=comercialEstatistica">Estatísticas</a>
                    </li>
                </ul>
            </li>

            <li>
              <a href="#tecnicoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Tecnico</a>
              <ul class="collapse list-unstyled" id="tecnicoSubmenu">
                <li>
                  <a href="">Municípios</a>
                </li>
                <li>
                  <a href="app.php?pg=tecnicoNotificacoes">Notificações</a>
                </li>
              </ul>
            </li>


        </ul>


    </nav>

    <!--Page Content-->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="btn btn-info" id="sidebarCollapse">
                    <i class="fas fa-align-left"></i>
                </button>
                <?php echo "Bem Vindo, ".$_SESSION['usuario'] ?>
            </div>
        </nav>