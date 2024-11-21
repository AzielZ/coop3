<?php	
	include_once('funcoes.php');

	$nome = $_POST['NOME'];
	$codFunc = $_POST['CODFUNC'];
	$senha = $_POST['SENHA'];

	$nomeFormat = utf8_decode($nome);
	$codFormat = utf8_decode($codFunc);

	$ora_conecta = connect("wcooperado");
	$vresultado = 'Vazio';

	$stid = oci_parse($ora_conecta, "BEGIN pCADASTRO_COOPERADO('$nomeFormat', '$codFormat', '$senha',:vresultado); END;"); 
	oci_bind_by_name($stid, ':vresultado', $vresultado);

	oci_execute($stid);

        echo "$vresultado";

	oci_free_statement($stid);
	oci_close($conn);
 
?>