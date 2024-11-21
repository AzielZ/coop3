<?php
		include('funcoes.php');
	  	include("valida_usuario.php");
        	valida_usuario('TRA_GER');


		if($_SESSION["valida"] != 1){
			header("Location:http://intranet.unimedpinda.com.br/coop/redireciona_coop.php");
			session_destroy();
		}

		if($_SESSION["senha"] == 'C0OP@M#D'){
			header("Location:http://intranet.unimedpinda.com.br/coop/home.php");

		}

		include('header.php'); 

		include('indicadoresLayout.php');

		include('footer.php');
	
?>

