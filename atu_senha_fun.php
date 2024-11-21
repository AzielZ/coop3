<?php
	  	include("valida_usuario.php");
        valida_usuario('ATU_SEN');
?>

<link rel="shortcut icon" href="img/favicon.png">
<div class="tudo">
	<div class="topo">
		<?php 
		include_once('header_admin.php'); 
		include_once('funcoes.php');
		?>
	</div>

	<div class="conteudo">

			<?php

					        $login=strtoupper($_SESSION["cdfuncionario"]);

				
								$resultado = alterarsenha($login,"","","3");
								if(OCIExecute($resultado)){
									$cont = 0;
									while(OCIFetch($resultado)){
											$cont++;
											$cdfuncionario = OCIResult($resultado,1);
											$nomecooperado = OCIResult($resultado,2);
											$senha = OCIResult($resultado,3);
									}
								}
								
			if(!isset($_POST["enviar"]))
			{

		?>
		
			<div class="container theme-showcase" role="main">
				<div class="panel panel-success">
					<div class="panel-heading">
					<h3 class="panel-title">PARA ATUALIZAR A SUA SENHA, PREENCHA OS DADOS SOLICITADOS:</h3>
					</div>
					<div class="panel-body">

						<form method="POST" action="atu_senha_fun.php">

							<input type="hidden" name="id_funcionario" value=<?php echo (" '$cdfuncionario'"); ?>>

							<div class="row">
								<div class="col-xs-6 col-md-6">
									<br>Nome:<br>
									<input type="text" placeholder="Ex: José Silva dos Santos" class="form-control" name="nome" maxlength="80" disabled value=<?php echo (" '$nomecooperado'"); ?>>
								</div>
							</div>


							<div class="row">
								<div class="col-xs-6 col-md-4">
									<br>Senha Atual:<br>
									<input type="password" placeholder="*********" class="form-control" name="senhaatual" maxlength="20" required>
								</div>

								<div class="col-xs-6 col-md-4">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>
							</div>
							
														<div class="row">
								<div class="col-xs-6 col-md-4">
									<br>Nova Senha:<br>
									<input type="password" placeholder="*********" class="form-control" name="novasenha1" maxlength="20" required>
								</div>

								<div class="col-xs-6 col-md-4">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>
							</div>
							
														<div class="row">
								<div class="col-xs-6 col-md-4">
									<br>Confirmar Nova Senha::<br>
									<input type="password" placeholder="*********" class="form-control" name="novasenha2" maxlength="20" required>
								</div>

								<div class="col-xs-6 col-md-4">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>
							</div>

							<br><br><br>
							<button type="submit" class="btn btn-success btn-lg" name="enviar"> Gravar</button>
							<a href='javascript:history.go(-1);'><button type='button' class='btn btn-default btn-lg'> Voltar</button></a>
						</form>
						<br>
					</div>
				</div>      
			</div>


				<?php

					} 
					else
					{
						$id_funcionario = strtoupper($_POST["id_funcionario"]);
						$nome       	= strtoupper($_POST["nome"]);
						$senhaatual     = strtoupper($_POST["senhaatual"]);
						$novasenha1   	= strtoupper($_POST["novasenha1"]);
						$novasenha2     = strtoupper($_POST["novasenha2"]);

						if(strtoupper($novasenha1) == strtoupper($novasenha2) && strtoupper($senha) == strtoupper($senhaatual))
						{		
							if (
    								!preg_match('/[0-9]/', $novasenha1) ||
    								!preg_match('/[A-Z]/', $novasenha1) ||
    								!preg_match('/[a-z]/', $novasenha1) ||
    								!preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/', $novasenha1) ||
   								stripos($novasenha1, "unimed") !== false
							) {				
					
							$resultado = alterarsenha(strtoupper($login),strtoupper($senhaatual),strtoupper($novasenha1),"1");
			   					   
							oci_execute($resultado, OCI_COMMIT_ON_SUCCESS);							
							echo "
								<SCRIPT LANGUAGE=JAVASCRIPT>
									alert(\"Senha alterada com sucesso!\");
								  	window.history.back(1);
								</SCRIPT>
							     ";
							}
							else{
								echo "
								<SCRIPT LANGUAGE=JAVASCRIPT>
									alert(\"Informe uma senha com letras maisculas e minusculas, com caracter especial e numeros\");
									window.history.back(1);
								</SCRIPT>
								";
							}
						}
						else
						{
							echo "
								<SCRIPT LANGUAGE=JAVASCRIPT>
									alert(\"Dados não conferem, por favor verifique!\");
									window.history.back(1);
								</SCRIPT>
							";
						}
					}
			?>

	</div>

	<div class="rodape">
		<?php include_once('footer.php'); ?>
	</div>
            
</div>