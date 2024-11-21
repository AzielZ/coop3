<?php
	  	include("valida_usuario.php");
        valida_usuario('ATU_SEN');


							$id = $_POST["id_mensagem"];
					        $login=strtoupper($_SESSION["cdfuncionario"]);

							$resultado = mensagem($_SESSION["cdfuncionario"],$_SESSION["grupo"],$id,"4"); 
							oci_execute($resultado, OCI_COMMIT_ON_SUCCESS);	


							$resultado = mensagem($login,$_SESSION["grupo"],$id,"3");
							if(OCIExecute($resultado)){
								$cont = 0;
								while(OCIFetch($resultado)){
										$cont++;
										$id_mensagem = OCIResult($resultado,1);
										$assunto = OCIResult($resultado,2);
										$mensagem = OCIResult($resultado,3);
										$dtini = OCIResult($resultado,4);
										$dtfim = OCIResult($resultado,5);
										$lida = OCIResult($resultado,6);
										$anexo = OCIResult($resultado,7);
								};
							};							

?>
<html> 
<head>
<title>Mensagem</title> 
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
</head>
<body> 
<script> 
  window.location="http://intranet.unimedpinda.com.br/coop/anexos/<?php echo ("$anexo"); ?>" ; 
</script> 
</body> 
</html> 
