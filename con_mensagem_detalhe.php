<?php
	  	include("valida_usuario.php");
        valida_usuario('CON_DET');
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
							$id = $_POST["id_mensagem"];
					        $login=strtoupper($_SESSION["cdfuncionario"]);

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
		
			<div class="container theme-showcase" role="main">
				<div class="panel panel-success">
					<div class="panel-heading">
					<h3 class="panel-title">Detalhes da mensagem:</h3>
					</div>
					<div class="panel-body">

						<form method="POST" action="/coop/anexos/<?php echo ("$anexo"); ?>" target="_blank">

							<input type="hidden" name="id_mensagem" value=<?php echo (" '$id_mensagem'"); ?>>

							<div class="row">
								<div class="col-xs-6 col-md-3">
									<br>ID:<br>
									<input type="text" class="form-control" name="idMensagem" disabled value=<?php echo (" '$id_mensagem'"); ?>>
								</div>

								<div class="col-xs-6 col-md-9">
									<br>Assunto:<br>
									<input type="text" class="form-control" id="assunto" name="cpf" disabled value=<?php echo (" '$assunto'"); ?>>
								</div>
							</div>


							<div class="row">
								<div class="col-xs-6 col-md-6">
									<br>Data Inicio:<br>
									<input type="text" class="form-control" id="dtinicio" name="dtinicio" disabled value=<?php echo (" '$dtini'"); ?>>
								</div>
								<div class="col-xs-6 col-md-6">
									<br>Data Final:<br>
									<input type="text" class="form-control" id="dtfinal" name="dtfinal" disabled value=<?php echo (" '$dtfim'"); ?>>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-6 col-md-12">
									<br>Descrição da Mensagem:<br>
									<textarea cols="40" rows="8" class="form-control" name="observacao" disabled><?php echo (" $mensagem"); ?></textarea>
								</div>

							</div>
						
							<br><br><br>
							
							<div class="row">
								<div class="col-xs-6 col-md-6 esquerda">
									<a href='javascript:history.go(-1);'><button type='button' class='btn btn-default btn-lg'> Voltar</button></a>
								</div>
								<div class="col-xs-6 col-md-6 direita">
									<button type='submit' class='btn btn-success btn-lg'> Visualizar Anexo</button>
								</div>
							</div>

						</form>
						<br>
					</div>
				</div>      
			</div>

	</div>

	<div class="rodape">
		<?php include_once('footer.php'); ?>
	</div>
            
</div>