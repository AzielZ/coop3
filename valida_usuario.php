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
			//Não há usuário logado, manda pra página de login do cooperado
			header("Location:redireciona_coop.php");
			session_destroy();
		} else if ($groupfunc == NULL){
			//Não há usuário logado, manda pra página de login do cooperado
			header("Location:redireciona_coop.php");
			session_destroy();
		} else if ($groupfunc == 'SAMC'){
			//Não há usuário logado, manda pra página de login do cooperado
			header("Location:redireciona_coop.php");
			session_destroy();
		} else if ($groupfunc == 'ADMIN'){
			//Não há usuário logado, manda pra página de login do administrativo
			header("Location:redireciona_admin.php");
			session_destroy();
		}else if($groupfunc == 'SECRET'){
			//Não há usuário logado, manda pra página de login do administrativo	
			header("Location:home_admin.php");
			/*session_destroy();*/
		} else {
			//Não há usuário logado, manda pra página de login do administrativo
			header("Location:XXX.php");
		}
	}
}
?>