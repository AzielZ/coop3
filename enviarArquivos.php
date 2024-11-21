<?php	
	include_once('funcoes.php');

	$assunto = $_POST['ASSUNTO'];
	$mensagem = $_POST['MENSAGEM'];
	$dt_final = $_POST['DATAFIM'];
	$usuario = $_POST['USUARIO'];

	$codigo = mt_rand(0,99999);
	$nm_anexo = substr($_FILES["FILE"]["name"],0,1).$codigo. "." . pathinfo($_FILES["FILE"]["name"], PATHINFO_EXTENSION);

	/*$nome_anexo = $_FILES['FILE']['name'];
	$nm_anexo = utf8_decode($nome_anexo);*/

	$assuntoFormat = utf8_decode($assunto);
	$mensagemFormat = utf8_decode($mensagem);

	$file = pathinfo($_FILES['FILE']['name']);
	$file_extention = $file['extension'];

	if($file_extention == 'pdf'){

		move_uploaded_file($_FILES['FILE']['tmp_name'], 'anexos/'.$nm_anexo);	
			
		$ora_conecta = connect("wcooperado");
		$vresultado = 'Vazio';
	
		$stid = oci_parse($ora_conecta, "BEGIN pENVIA_ARQUIVO_MENSAGEM('$assuntoFormat', '$mensagemFormat', '$dt_final', '$usuario', '$nm_anexo', :vresultado); END;"); 
		oci_bind_by_name($stid, ':vresultado', $vresultado);

		oci_execute($stid);

        	echo "$vresultado";

		oci_free_statement($stid);
		oci_close($conn);

	}else{
		$vresultado = 4;
		echo "$vresultado";
	}

?>

