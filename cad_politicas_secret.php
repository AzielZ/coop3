<?php
	  	include("valida_usuario.php");
        	valida_usuario('CAD_USU');
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
					<h3 class="panel-title">CADASTRO DE USUARIO PARA AREA DO COOPERADO</h3>
					</div>
					<div class="panel-body">

						<div>

							<div class="row">
								<div class="col-xs-6 col-md-6">
									<br>Nome:<br>
									<input type="text" id="nome" placeholder="Ex: Jos� Silva dos Santos" class="form-control" name="nome" maxlength="80">
								</div>
							</div>


							<div class="row">
								<div class="col-xs-6 col-md-4">
									<br>Cod. Funcionario(CRM):<br>
									<input type="text" id="codFunc" placeholder="*********" class="form-control" maxlength="20">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>
							</div>
							
														<div class="row">
								<div class="col-xs-6 col-md-4">
									<br>Senha:<br>
									<input type="password" id="senha" placeholder="*********" class="form-control" maxlength="20">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>
							</div>
							
														<div class="row">
								<div class="col-xs-6 col-md-4">
									<br>Confirmar Senha::<br>
									<input type="password" id="confirmSenha" placeholder="*********" class="form-control" maxlength="20">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>
							</div>

							<br><br><br>
							<button class="btn btn-success btn-lg" name="enviar" onclick="cadastraUsuario()"> Salvar</button>
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

    function cadastraUsuario(){

      	var password = document.getElementById("senha").value;
      	var confirm_password = document.getElementById("confirmSenha").value;
	var nome = document.getElementById("nome").value;
	var codFunc = document.getElementById("codFunc").value;

	infos = new FormData();

	infos.append('NOME', nome);
	infos.append('SENHA', password);
	infos.append('CODFUNC', codFunc);

	if(nome != "" && password != "" && confirm_password != ""){

	  if(password == confirm_password){
		$.ajax({
    			url: 'enviarCadastro.php',
   			type: 'POST',
    			data: infos,
			processData: false,
			contentType: false,
    			success: function(result){	
	
				console.log(result.length);

				if(result.length == 0){
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
  						text: 'Usuario j� cadastrado',
						showConfirmButton: false,
  						timer: 3000,
						width: '600px'
 					});
				}
				
         		},
   			error: function(err) {
				console.log('Erro ao enviar');
     			}
		});

	  }else{
		Swal.fire({
  			icon: 'error',
  			title: 'Senha',
  			text: 'Senhas diferentes',
			showConfirmButton: false,
  			timer: 1200,
			width: '600px'
 		});
	  }

	}else{
		Swal.fire({
  			icon: 'warning',
  			title: 'Cadastro',
 		  	text: 'Preencha todos os campos',
			showConfirmButton: false,
  			timer: 2000,
			width: '600px' 
		});

	}

    }

</script>