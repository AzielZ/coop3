<?php
	  	include("valida_usuario.php");
        valida_usuario('ATU_SEN');
?>

<link rel="shortcut icon" href="img/favicon.png">
<div class="tudo">
	<div class="topo">
		<?php 
		include_once('header.php'); 
		include_once('funcoes.php');
		?>
	</div>

	<div class="conteudo">

			<?php

					        $login=strtoupper($_SESSION["cdfuncionario"]);

				
								$resultado = atualizarcadastro("", "", $login, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "2");

								if(OCIExecute($resultado)){
									$cont = 0;
									while(OCIFetch($resultado)){
											$cont++;
											$nome = OCIResult($resultado,1);
											$cpf = OCIResult($resultado,2); 
											$crm = OCIResult($resultado,3);
											$tel_comerc_1 = OCIResult($resultado,4); 
											$tel_comerc_2 = OCIResult($resultado,5);
											$email_consult = OCIResult($resultado,6);
											$rua_comerc = OCIResult($resultado,7);
											$num_comerc = OCIResult($resultado,8);
											$bairro_comerc = OCIResult($resultado,9);
											$cep_comerc = OCIResult($resultado,10);
											$rua_resid = OCIResult($resultado,11);
											$num_resid = OCIResult($resultado,12);
											$bairro_resid = OCIResult($resultado,13);
											$cep_resid = OCIResult($resultado,14);
											$cel_resid_1 = OCIResult($resultado,15);
											$cel_resid_2 = OCIResult($resultado,16);
											$whatsapp_resid = OCIResult($resultado,17);
											$email_pessoal = OCIResult($resultado,18);
											//$anexo_alvara_localizacao = OCIResult($resultado,19);
											//$anexo_alvara_sanitario = OCIResult($resultado,20);
											//$anexo_registro_cnes = OCIResult($resultado,21);
											//$anexo_titulo_especialista = OCIResult($resultado,22);
											//$anexo_residencia_medica = OCIResult($resultado,23);
											//$anexo_rqe = OCIResult($resultado,24);
									}
								}
								
			if(!isset($_POST["enviar"]))
			{

		?>
		
			<div class="container theme-showcase" role="main">
				<div class="panel panel-success">
					<div class="panel-heading">
					<h3 class="panel-title">ATUALIZAÇÃO CADASTRAL DE MÉDICOS COOPERADOS</h3>
					</div>
					<div class="panel-body">
					
					<h4>Prezado cooperado, em <b>atendimento</b> as normativas, <b>RNs 277</b> e <b>405</b>, da Agência Nacional de Saúde Suplementar - ANS, mantenha seu cadastro sempre atualizado.</h4>
					
						<form method="POST" action="atu_cadastro.php">

							<input type="hidden" name="id_funcionario" value=<?php echo (" '$cdfuncionario'"); ?>>
							<input type="hidden" name="cpf" value=<?php echo (" '$cpf'"); ?>>
							<input type="hidden" name="crm" value=<?php echo (" '$crm'"); ?>>

							<div class="row">
								<div class="col-xs-12 col-md-6">
									<br>Nome:<br>
									<input type="text" placeholder="" class="form-control" name="nome" maxlength="150" value=<?php echo (" '$nome'"); ?>>
								</div>

								<div class="col-xs-12 col-md-3">
									<br>CPF:<br>
									<input type="text" class="form-control" id="campoCPF" placeholder="" name="t_cpf" maxlength="11" disabled value=<?php echo (" '$cpf'"); ?>>
								</div>
								
								<div class="col-xs-12 col-md-3">
									<br>CRM:<br>
									<input type="text" placeholder="" class="form-control" name="t_crm" maxlength="6" disabled value=<?php echo (" '$crm'"); ?>>
								</div>
							</div>


							<div class="row">
								<div class="col-xs-12 col-md-4">
									<br>Tel. Comercial 1:<br>
									<input type="text" placeholder="" class="form-control" name="tel_comerc_1" maxlength="24" value=<?php echo (" '$tel_comerc_1'"); ?>>
								</div>
								
								<div class="col-xs-12 col-md-4">
									<br>Tel. Comercial 2:<br>
									<input type="text" placeholder="" class="form-control" name="tel_comerc_2" maxlength="24" value=<?php echo (" '$tel_comerc_2'"); ?>>
								</div>

								<div class="col-xs-12 col-md-4">
									<br>Email (Consultório):<br>
									<input type="text" placeholder="" class="form-control" name="email_consult" maxlength="100" value=<?php echo (" '$email_consult'"); ?>>
								</div>
							</div>

							<br><br>
							
							<div class="row">
								<div class="col-xs-12 col-md-12">
									<h4><b><u>ENDEREÇO COMERCIAL</u>:</b></h4>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<br>Rua:<br>
									<input type="text" placeholder="" class="form-control" name="rua_comerc" maxlength="150" value=<?php echo (" '$rua_comerc'"); ?>>
								</div>
								
								<div class="col-xs-6 col-md-6">
									<br>Número:<br>
									<input type="text" placeholder="" class="form-control" name="num_comerc" maxlength="20" value=<?php echo (" '$num_comerc'"); ?>>
								</div>

								<div class="col-xs-6 col-md-6">
									<br>Bairro:<br>
									<input type="text" placeholder="" class="form-control" name="bairro_comerc" maxlength="100" value=<?php echo (" '$bairro_comerc'"); ?>>
								</div>
								
								<div class="col-xs-12 col-md-6">
									<br>CEP:<br>
									<input type="text" placeholder="" class="form-control" name="cep_comerc" maxlength="8" value=<?php echo (" '$cep_comerc'"); ?>>
								</div>
							</div>

							<br><br>
							
							<div class="row">
								<div class="col-xs-12 col-md-12">
									<h4><b><u>ENDEREÇO RESIDENCIAL</u>:</b></h4>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<br>Rua:<br>
									<input type="text" placeholder="" class="form-control" name="rua_resid" maxlength="150" value=<?php echo (" '$rua_resid'"); ?>>
								</div>
								
								<div class="col-xs-6 col-md-6">
									<br>Número:<br>
									<input type="text" placeholder="" class="form-control" name="num_resid" maxlength="20" value=<?php echo (" '$num_resid'"); ?>>
								</div>

								<div class="col-xs-6 col-md-6">
									<br>Bairro:<br>
									<input type="text" placeholder="" class="form-control" name="bairro_resid" maxlength="100" value=<?php echo (" '$bairro_resid'"); ?>>
								</div>
								
								<div class="col-xs-12 col-md-6">
									<br>CEP:<br>
									<input type="text" placeholder="" class="form-control" name="cep_resid" maxlength="8" value=<?php echo (" '$cep_resid'"); ?>>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<br>Tel. Celular 1:<br>
									<input type="text" placeholder="" class="form-control" name="cel_resid_1" maxlength="24" value=<?php echo (" '$cel_resid_1'"); ?>>
								</div>
								
								<div class="col-xs-6 col-md-6">
									<br>Tel. Celular 2:<br>
									<input type="text" placeholder="" class="form-control" name="cel_resid_2" maxlength="24" value=<?php echo (" '$cel_resid_2'"); ?>>
								</div>

								<div class="col-xs-6 col-md-6">
									<br>WhatsApp:<br>
									<input type="text" placeholder="" class="form-control" name="whatsapp_resid" maxlength="24" value=<?php echo (" '$whatsapp_resid'"); ?>>
								</div>
								
								<div class="col-xs-12 col-md-6">
									<br>Email (Pessoal):<br>
									<input type="text" placeholder="" class="form-control" name="email_pessoal" maxlength="100" value=<?php echo (" '$email_pessoal'"); ?>>
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
						$nome = strtoupper($_POST["nome"]); 
						$cpf = strtoupper($_POST["cpf"]);
						$crm = strtoupper($_POST["crm"]);
						$tel_comerc_1 = strtoupper($_POST["tel_comerc_1"]);
						$tel_comerc_2 = strtoupper($_POST["tel_comerc_2"]);
						$email_consult = strtoupper($_POST["email_consult"]);
						$rua_comerc = strtoupper($_POST["rua_comerc"]);
						$num_comerc = strtoupper($_POST["num_comerc"]);
						$bairro_comerc = strtoupper($_POST["bairro_comerc"]); 
						$cep_comerc = strtoupper($_POST["cep_comerc"]);
						$rua_resid = strtoupper($_POST["rua_resid"]);
						$num_resid = strtoupper($_POST["num_resid"]);
						$bairro_resid = strtoupper($_POST["bairro_resid"]);
						$cep_resid = strtoupper($_POST["cep_resid"]);
						$cel_resid_1 = strtoupper($_POST["cel_resid_1"]);
						$cel_resid_2 = strtoupper($_POST["cel_resid_2"]);
						$whatsapp_resid = strtoupper($_POST["whatsapp_resid"]);
						$email_pessoal = strtoupper($_POST["email_pessoal"]);

						if($id_funcionario == $id_funcionario)
						{
								$mensagem = 'Foi feita uma nova solicitação de atualização cadastral através da Área do Cooperado, segue abaixo os dados a serem atualizados: '."\n";
								
								$mensagem .= "\n".'Nome: '.$nome;
								$mensagem .= "\n".'CPF: '.$cpf;
								$mensagem .= "\n".'CRM: '.$crm;
								$mensagem .= "\n".'Telefone Comercial 1: '.$tel_comerc_1;
								$mensagem .= "\n".'Telefone Comercial 2: '.$tel_comerc_2;
								$mensagem .= "\n".'Email do Consultório: '.$email_consult."\n";
								
								$mensagem .= "\n"."*** ".'ENDEREÇO COMERCIAL:'." ***";
								$mensagem .= "\n".'Rua Consultório: '.$rua_comerc;
								$mensagem .= "\n".'Nº Consultório: '.$num_comerc;
								$mensagem .= "\n".'Bairro Consultório: '.$bairro_comerc;
								$mensagem .= "\n".'CEP Consultório: '.$cep_comerc."\n";
								
								$mensagem .= "\n"."*** ".'ENDEREÇO RESIDENCIAL:'." ***";
								$mensagem .= "\n".'Rua Residência: '.$rua_resid;
								$mensagem .= "\n".'Nº Residência: '.$num_resid;
								$mensagem .= "\n".'Bairro Residência: '.$bairro_resid;
								$mensagem .= "\n".'CEP Residência: '.$cep_resid;
								$mensagem .= "\n".'Celular Residência 1: '.$cel_resid_1;
								$mensagem .= "\n".'Celular Residência 2: '.$cel_resid_2;
								$mensagem .= "\n".'WhatsApp: '.$whatsapp_resid;
								$mensagem .= "\n".'Email Pessoal: '.$email_pessoal."\n";
								
								$mensagem .= "\n".'Atenciosamente,';
								$mensagem .= "\n".'Área do Cooperado.';
						
								// enviar o email
								mail( 'assessoriacoop@unimedpinda.com.br', 'Atualização Cadastral - Área do Cooperado - CRM: '.$crm, $mensagem );
								
								$resultado = atualizarcadastro($nome, $cpf, $crm, $tel_comerc_1, $tel_comerc_2, $email_consult, $rua_comerc, $num_comerc, $bairro_comerc, $cep_comerc, $rua_resid, $num_resid, $bairro_resid, $cep_resid, $cel_resid_1, $cel_resid_2, $whatsapp_resid, $email_pessoal, "", "", "", "", "", "", "1");
								oci_execute($resultado, OCI_COMMIT_ON_SUCCESS);
								echo  $resultado;
								echo "
									<SCRIPT LANGUAGE=JAVASCRIPT>
									alert(\"Cadastro atualizado com sucesso! Seus dados foram enviados para o setor responsável realizar a atualização em sistema.\");
									window.history.back(1);
									</SCRIPT>
								";
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