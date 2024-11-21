<?php
	  	include("valida_usuario.php");
        	valida_usuario('CAD_USU');

		if($_SESSION["valida"] != 1){
			header("Location:http://intranet.unimedpinda.com.br/coop/redireciona_coop.php");
			session_destroy();
		}

?>
<!-- SweetAlert 2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="shortcut icon" href="img/favicon.png">
<div class="tudo">
	<div class="topo">
		<?php 
		include_once('header_secret.php'); 
		include_once('funcoes.php');
		?>
	</div> 

	<div class="conteudo">
		
			<div class="container theme-showcase" role="main">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">ATUALIZAR SENHA</h3>
						<h6>Ao atualizar a senha ser� feito o desbloqueio do usuario!</h6>
					</div>
					<div class="panel-body">
						<div>
							<div class="row">
								<div class="col-xs-6 col-md-4">
									<br>Cod. Funcionario(CRM):<br>
									<input type="text" id="codFunc" placeholder="*********" class="form-control" maxlength="6">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>
							</div>
							
							
							<br><br><br>
							<button class="btn btn-success btn-lg" name="enviar" onclick="atualizaSenha();"> Salvar</button>
							<a href='home_secret.php'><button type='button' class='btn btn-default btn-lg'> Voltar</button></a>
						</div>
						<br>
					</div>
				</div>      
			</div>

	</div>

	<div class="rodape">
		<?php include_once('footer.php'); ?>
	</div>
            
</div>


<script>

    function atualizaSenha(){

      	var codFunc = document.getElementById("codFunc").value;

	infos = new FormData();

	infos.append('CODFUNC', codFunc);

	if(codFunc != ""){

			$.ajax({
    			  url: 'atualizarSenha.php',
   			  type: 'POST',
    			  data: infos,
			  processData: false,
			  contentType: false,
    			  success: function(result){	
	
				console.log(result);

				if(result == 'deu bom'){
					Swal.fire({
  						icon: 'success',
  						title: 'Cadastro',
  						text: 'Cadastro realizado com sucesso',
						showConfirmButton: false,
  						timer: 3000,
						width: '600px'
 					});

					setTimeout(function() {
					  window.location.reload();
       					}, 3000);				
         			}else{
					Swal.fire({
  						icon: 'warning',
  						title: 'Cadastro',
  						text: 'N�o existe esse CRM',
						showConfirmButton: false,
  						timer: 3000,
						width: '600px'
 					});

					setTimeout(function() {
					  window.location.reload();
       					}, 3000);
				}
				},
   				error: function(err) {
					console.log('Erro ao enviar');
     				}
			});

	}else{
		Swal.fire({
  			icon: 'warning',
  			title: 'Cadastro',
 		  	text: 'Preencha o campo CRM',
			showConfirmButton: false,
  			timer: 2000,
			width: '600px' 
		});

	}

    }

</script> 