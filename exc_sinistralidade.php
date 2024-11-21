<?php
	  	include("valida_usuario.php");
        valida_usuario('EXC_SIN');
?>

<link rel="shortcut icon" href="img/favicon.png">
<div class="tudo">
<?php 
  include_once('header_admin.php'); 
  include_once('funcoes.php');
?>
<!--INICIO HOME-->

<div class="conteudo">

      <?php


            $periodo = $_GET["id"];
			$valor = ' ';
			$login		= strtoupper($_SESSION["cdfuncionario"]);

			$resultado = sinistralidade($login, $periodo, $valor, "2");
			oci_execute($resultado, OCI_COMMIT_ON_SUCCESS);

              die('<script type="text/javascript">window.location.href="cad_sinistralidade.php";</script>');
?>