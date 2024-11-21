<?php
	include_once('funcoes.php');

	$excluir = $_POST['CODEXCLUIR'];
		
	$ora_conecta = connect("wcooperado");

	$vresultado = "Erro ao apaga mensagem ou invalida!";
	
	$stid = oci_parse($ora_conecta, "BEGIN pEXCLUI_ARQUIVO_MENSAGEM('$excluir', :P_TXRETORNO); END;");
	oci_bind_by_name($stid, ':P_TXRETORNO', $vresultado);

	oci_execute($stid);

	echo "$vresultado";
	
	oci_free_statement($stid);
	oci_close($ora_conecta);

?>