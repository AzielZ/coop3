<?php
	include_once('funcoes.php');

	$prestador = strtoupper($_GET['prestador']);
	$chave = $_GET['chave'];
	$client_ip = $_SERVER['REMOTE_ADDR'];

	$result = validaAPP($prestador);

	if ($result == 0 || $chave != md5($prestador)) {
		$dataCompleta = date('Y-m-d H:i:s');

		$message = "$dataCompleta login error APP from $client_ip invalid user $prestador\n";
		error_log($message, 3, "/var/log/coop_error.log", FILE_APPEND);

        	header("Location: http://intranet.unimedpinda.com.br/coop");
        	exit();
    	}

	
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          <meta name="description" content="">
          <meta name="author" content="">

          <link rel="shortcut icon" href="img/favicon.png">

          <title>Portal Transparência</title>

          <!-- Bootstrap core CSS -->
          <link href="css/bootstrap.min.css" rel="stylesheet">

          <!-- Bootstrap theme -->
          <link href="css/bootstrap-theme.min.css" rel="stylesheet">

          <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
          <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

          <!-- Custom styles for this template -->
          <link href="css/dashboard.css" rel="stylesheet">
          <link href="css/style.css" rel="stylesheet"> 

		  <!-- Graficos utilizando Chart -->
		  <script src="chart/Chart.min.js"></script>		  

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

<style>
.corbadge{
		color: green;
		background-color: white;
	 }
.verde{
		color: green;
	 }
.active{
		background-color: green;
	 }

a{
	font-size: 12px;
}

.add-css:focus,
.add-css:hover
{
	background-color: #72b051 !important;
}

.icon-bar{
	background-color: #fff !important;
}

</style>

<?php 
	include('indicadoresLayout.php');
?>
