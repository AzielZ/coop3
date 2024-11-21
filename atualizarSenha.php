<?php	
	include_once('funcoes.php');

	$codFunc = $_POST['CODFUNC']; 

	$codFormat = utf8_decode($codFunc);

	$ora_conecta = connect("wcooperado");
	$vresultado = 'Iniciando a respota';

	$procedure = "BEGIN WCOOPERADO.pATUALIZA_SENHA('$codFormat', :vresultado); END;";

	$stid = oci_parse($ora_conecta, $procedure); 
	oci_bind_by_name($stid, ':vresultado', $vresultado);

	oci_execute($stid);

        echo "$vresultado";

	oci_free_statement($stid);
	oci_close($conn);

?>