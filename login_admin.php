<?php include_once('funcoes.php');
session_start();
session_unset();
session_destroy();
$login = strtoupper($_POST['login']);
$senha = strtoupper($_POST['senha']);
$ipcliente = $_SERVER['REMOTE_ADDR'];
$enviar = $_POST['enviar'];

if (isset($enviar))
{
	if(!empty($_POST['g-recaptcha-response'])){

		$url = "https://www.google.com/recaptcha/api/siteverify";
		$secret = "6Le0DwMnAAAAAJ0f-MHeAq15Cgnqclm6GWvgmavX";
		$response = $_POST['g-recaptcha-response'];
		$variaveis = "secret=".$secret."&response=".$response;


		$ch = curl_init($url);
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $variaveis);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		$resposta = curl_exec($ch);

		$resultCaptcha = json_decode($resposta);

		session_start();
		$_SESSION["valida"] = $resultCaptcha->success;

		if($resultCaptcha->success == 1){

								$resultado = autenticausuario($login,$senha,"2");
								if(OCIExecute($resultado)){
									$cont = 0;
									while(OCIFetch($resultado)){
											$cont++;
											$cdfuncionario = OCIResult($resultado,1);
											$senhaok = OCIResult($resultado,3);
											$nomeusuario = OCIResult($resultado,5);
											$grupo = OCIResult($resultado,4);
											$bloqueado = OCIResult($resultado,6);
									}
								}
							}
		}
									
	if ($cont>0 && $bloqueado == 0)
	{
		
	$resultado = historico($cdfuncionario, $senhaok, $ipcliente, "S", "1");
	oci_execute($resultado, OCI_COMMIT_ON_SUCCESS);
		
	$_SESSION["cdfuncionario"] = $cdfuncionario;
	$_SESSION["nomeusuario"] = $nomeusuario;
	$_SESSION["grupo"] = $grupo;

	$reset = reset_fail_to_ban($login);
	oci_execute($reset, OCI_COMMIT_ON_SUCCESS);

	if ($grupo == 'ADMIN'){
		header("Location:home_admin.php");
	}else if($grupo == 'SECRET'){
		header("Location:home_secret.php");
	}else{
		header("Location:http://intranet.unimedpinda.com.br/coop/redireciona_admin.php");
	}
}
else
{
	$resultado = historico($login, $senha, $ipcliente, "N", "1");
	oci_execute($resultado, OCI_COMMIT_ON_SUCCESS);

	$client_ip = $_SERVER['REMOTE_ADDR'];
		$dataCompleta = date('Y-m-d H:i:s');

		$message = "$dataCompleta login error from $client_ip invalid user $login\n";
		error_log($message, 3, "/var/log/coop_error.log", FILE_APPEND);

		$qtdAcesso = fail_to_ban($login, $client_ip);

		if($qtdAcesso == 'Primeiro Acesso'){
			$_SESSION["cdfuncionario"] = $cdfuncionario;
			$_SESSION["nomeusuario"] = $nomeusuario;
			$_SESSION["grupo"] = $grupo;
			$_SESSION["senhaAnterior"] = $senhaAnt;
			
			header("Location:http://intranet.unimedpinda.com.br/coop/home.php");
			
		}

echo <<<HTML

		<html lang='pt-br'>

		<head>
			<meta charset='utf-8'>
			<meta http-equiv='X-UA-Compatible' content='IE=edge'>
			<meta name='viewport' content='width=device-width, initial-scale=1'>
			<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
			<meta name='description' content=''>
			<meta name='author' content=''>

			<link rel='shortcut icon' href='img/favicon.png'>

			<title>Área do Cooperado - Senha Inválida</title>

			<!-- Bootstrap core CSS -->
			<link href='css/bootstrap.min.css' rel='stylesheet'>
			<!-- Bootstrap theme -->
			<link href='css/bootstrap-theme.min.css' rel='stylesheet'>
			<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
			<link href='css/ie10-viewport-bug-workaround.css' rel='stylesheet'>

			<!-- Custom styles for this template -->
			<link href='css/dashboard.css' rel='stylesheet'>

			<link href='css/style.css' rel='stylesheet'>    

			<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
			<!--[if lt IE 9]><script src='js/ie8-responsive-file-warning.js'></script><![endif]-->
			<script language='JavaScript' type='text/javascript' src='js/ie-emulation-modes-warning.js'></script>

			<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
		<script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>          
		<![endif]-->

		<script language='JavaScript' type='text/javascript' src='js/cidades-estados-utf8.js'></script>

	</head>

	<body>

		<div class="container theme-showcase" role="main">
			<div class='panel panel-danger'> 
					<div class='panel-heading'><h3 class='panel-title'>Aviso</h3></div> 
					<div class='panel-body' align='center'> <p align='center'>Login e/ou senha incorretos.</p><br><br><a href='javascript:history.go(-1);'><button type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-arrow-left' aria-hidden='true'></span> Voltar</button></a>
					</div> 
			</div>
		</div>

	</body>

	</html>
HTML;
}
}

?>