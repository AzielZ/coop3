<?php
include_once('funcoes.php');
session_start();

function valida_usuario($tela) {
  $cdfunc = $_SESSION["cdfuncionario"];
  $groupfunc = $_SESSION["grupo"];

	$resultado = valida_session($cdfunc,$groupfunc,$tela,"1");
	if(OCIExecute($resultado)){
		$cont = 0;
		while(OCIFetch($resultado)){
				$cont++;
		}
	}
									
	if ($cont<1 || $cdfunc == NULL || $groupfunc == NULL)
	{
		if ($cdfunc == NULL ){
			//N�o h� usu�rio logado, manda pra p�gina de login do cooperado
			header("Location:redireciona_coop.php");
			session_destroy();
		} else if ($groupfunc == NULL){
			//N�o h� usu�rio logado, manda pra p�gina de login do cooperado
			header("Location:redireciona_coop.php");
			session_destroy();
		} else if ($groupfunc == 'SAMC'){
			//N�o h� usu�rio logado, manda pra p�gina de login do cooperado
			header("Location:redireciona_coop.php");
			session_destroy();
		} else if ($groupfunc == 'ADMIN'){
			//N�o h� usu�rio logado, manda pra p�gina de login do administrativo
			header("Location:redireciona_admin.php");
			session_destroy();
		}else if($groupfunc == 'SECRET'){
			//N�o h� usu�rio logado, manda pra p�gina de login do administrativo	
			header("Location:home_admin.php");
			/*session_destroy();*/
		} else {
			//N�o h� usu�rio logado, manda pra p�gina de login do administrativo
			header("Location:XXX.php");
		}
	}
}
?> 