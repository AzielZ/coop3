<!DOCTYPE html>
<html lang="pt-br">
<head>
          <meta charset="utf-8"/>
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          <meta name="description" content="">
          <meta name="author" content="">

          <link rel="shortcut icon" href="img/favicon.png">

          <title>ADMIN - Área do Cooperado</title>

          <!-- Bootstrap core CSS -->
          <link href="css/bootstrap.min.css" rel="stylesheet">

          <!-- Bootstrap theme -->
          <link href="css/bootstrap-theme.min.css" rel="stylesheet">

          <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
          <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

          <!-- Custom styles for this template -->
          <link href="css/dashboard.css" rel="stylesheet">
          <link href="css/style.css" rel="stylesheet"> 

		  <!-- Graficos utilizando Chart 
		  script src="Chart.min.js"></script>-->

	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

          <!-- PARA FUNCIONAR O DATATABLE -->
          <link href="datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">
		  
		  <!-- Graficos utilizando Google Chart -->
		  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		  
		  <!-- Graficos utilizando Google Chart -->
		  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
		  
          <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
          <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
          <script language="JavaScript" type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>

          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
          <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>          
          <![endif]-->

          <script language="JavaScript" type="text/javascript" src="js/cidades-estados-utf8.js"></script>

      </head>

    <body>

      <?php
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        #echo strftime( '%Y-%m-%e %T', strtotime('now')); 
        $data_padrao = date('d-m-Y H:i:s');
        include_once('funcoes.php');
      ?>

      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
			<a href="home_secret.php"><img src="img/logocoop.png"></a>
			<!-- <span class="navbar-brand"></span> -->
          </div>
		  
          <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-left">
	     <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Cadastrar <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header"></li>
                  <li><a href="cad_mensagem_secret.php"> Cadastrar Mensagem </a></li>
		  <li><a href="cad_usuario_secret.php"> Cadastrar Usuário </a></li>
		  <li><a href="redefinir_senha_secret.php"> Redefinir/Desbloquear senha</a></li>
		  <!-- <li><a href="#"> Cadastrar Politicas </a></li>
                  <li><a href="cad_sinistralidade.php"> Cadastrar Sinistralidade </a></li> -->
                </ul>
              </li>
	    <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-envelope' aria-hidden='true'></span> Políticas <span class="caret"></span></a>
                <ul class="dropdown-menu">
                </ul> 
              </li>-->
              <!-- <li><a href="ger_dados.php"><span class='glyphicon glyphicon-repeat' aria-hidden='true'></span> Processar Dados </a></li>-->			  
	  </ul>

            <ul class="nav navbar-nav navbar-right">
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="user" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-user' aria-hidden='true'></span> Olá, <?php echo $_SESSION["nomeusuario"]; ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="atu_senha_fun.php"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Alterar Senha</a></li>
                  <li><a href="redireciona_admin.php"><span class='glyphicon glyphicon-off' aria-hidden='true'></span> Sair</a></li>
                </ul>
              </li>
            </ul>

          </div>
        </div>
      </nav>