<?php
	  	include("valida_usuario.php");
        valida_usuario('ATU_SEN');

	if($_SESSION["valida"] != 1){
			header("Location:http://intranet.unimedpinda.com.br/coop/redireciona_coop.php");
			session_destroy();
		}

?>
<!-- SweetAlert 2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style type="text/css">
	p{
		display: flex;
		align-items: center;
	}

	.fa-times{
		color: red;
	}

	.fa-check{
		color: green; 
	}

	#nCaracteres{
		margin: 0;
	}

	.input-container, .input-container2 {
  		position: relative;
  		display: inline-block;
	}

	#senha{
		padding-right: 30px;
	}

	.icone-span{
  		position: absolute;
  		top: 80%;
  		right: 25px;
  		transform: translateY(-50%);
  		font-size: 18px;

		cursor: pointer;
	}

	.icone-span2{
		position: absolute;
  		top: 19%;
  		right: 25px;
  		transform: translateY(-50%);
  		font-size: 18px;

		cursor: pointer;
	}

	#barraSenha {
  		height: 10px;
  		background-color: red;
  		width: 10%;
  		transition: width 0.3s ease;
	}

	.muito-fraca #barraSenha {
            background-color: red;
        }

	.fraca #barraSenha{
            background-color: orange;
        }

        .media #barraSenha{
            background-color: yellow;
        }

        .forte #barraSenha{
            background-color: blue;
        }

        .muito-forte #barraSenha{
            background-color: green;
        }
</style>

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

				
								$resultado = alterarsenha($login,"","","2");
								if(OCIExecute($resultado)){
									$cont = 0;
									while(OCIFetch($resultado)){
											$cont++;
											$cdfuncionario = OCIResult($resultado,1);
											$nomecooperado = OCIResult($resultado,7);
											$cpf = OCIResult($resultado,6);
											$senha = OCIResult($resultado,3);									}
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

						<form method="POST" action="atu_senha.php">

							<input type="hidden" id='id_funcionario' name="id_funcionario" value=<?php echo (" '$cdfuncionario'"); ?>>

							<div class="row">
								<div class="col-xs-6 col-md-6">
									<br>Nome:<br>
									<input type="text" id="nome" placeholder="Ex: José Silva dos Santos" class="form-control" name="nome" maxlength="80" disabled value=<?php echo (" '$nomecooperado'"); ?>>
								</div>

								<div class="col-xs-6 col-md-6">
									<br>CPF:<br>
									<input type="text" class="form-control" id="campoCPF" placeholder="Ex: 40089032190" name="cpf" maxlength="11" disabled value=<?php echo (" '$cpf'"); ?>>
								</div>
							</div>


							<div class="row">
								<div class="col-xs-6 col-md-4">
									<br>Senha Atual:<br>
									<div id="input-container3">
										<input type="password" id="senha3" placeholder="*********" class="form-control" name="senhaatual" maxlength="20" required>
										<span class="material-symbols-outlined icone-span" id="mostrarSenha3" onclick="toggleSenhaVisibility('senha3')">visibility</span>
									</div>
								</div>

								<div class="col-xs-6 col-md-4">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>
							</div>
							
														<div class="row">
								<div class="col-xs-6 col-md-4">
									<br>Nova Senha:<br>
									<div id="input-container">
										<input type="password" placeholder="*********" id="senha" oninput="verificarSenha()" class="form-control" name="novasenha1" maxlength="20" required>
										<span class="material-symbols-outlined icone-span" id="mostrarSenha" onclick="toggleSenhaVisibility('senha')">visibility</span>
									</div>
								</div>

								<div class="col-xs-6 col-md-4">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>
							</div>
							
														<div class="row">
								<div class="col-xs-6 col-md-4">
									<br>Confirmar Nova Senha::<br>
									<div id="input-container2">
										<input type="password" id="senha2" placeholder="*********" oninput="verificarSenha()" class="form-control" name="novasenha2" maxlength="20" required>
										<span class="material-symbols-outlined icone-span2" id="mostrarSenha2" onclick="toggleSenhaVisibility('senha2')">visibility</span>	
									</div>		
									<br>
									<div id="criterios">
										<p><b>A senha deve conter:</b></p>
        									<p>Caracter Especial (?!@#$%&):<i id="caracterEspecial" class="fas fa-times"></i></p>
    										<p>Número:<i id="numero" class="fas fa-times"></i></p>
    										<p>Letra Maiúscula:<i id="maiuscula" class="fas fa-times"></i></p>
    										<p>Letra Minúscula:<i id="minuscula" class="fas fa-times"></i></p>
										<p>Senha e Confirmar Senha Conferem:<i id="confirmarSenha" class="fas fa-times"></i></p>
			    							<p>Quantidade Mínima de Caracteres: <span id="caracteresMinimos">8</span><i id="verificaMinimo" style="display:none" class="fas fa-check"></i></p>
										<div id="barraSenhaContainer">
        										<div id="barraSenha" class="muito-fraca"></div>
        										<div id="forcaSenhaTexto">Muito Fraca</div>
    										</div>		
									</div>
								</div>

								<div class="col-xs-6 col-md-4">
								</div>

								<div class="col-xs-6 col-md-4">
								</div>
							</div>

							<br><br><br>
							<button type="submit" id="botao" class="btn btn-success btn-lg" name="enviar" disabled> Gravar</button>
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
						$cpf     		= $_POST["cpf"];
						$senhaatual     = strtoupper($_POST["senhaatual"]);
						$novasenha1   	= strtoupper($_POST["novasenha1"]);
						$novasenha2     = strtoupper($_POST["novasenha2"]);

						if(strtoupper($novasenha1) == strtoupper($novasenha2) && strtoupper($senha) == strtoupper($senhaatual))
						{	
							if (
   	 							!preg_match('/[0-9]/', $password) ||
    								!preg_match('/[A-Z]/', $password) ||
    								!preg_match('/[a-z]/', $password) ||
    								!preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/', $password) ||
   							 	stripos(strtoupper($password), "UNIMED") !== false ||
								stripos(strtoupper($password), $_POST["id_funcionario"]) !== false ||
								stripos(strtoupper($password), substr($nome,0,strpos($nome, ' '))) != false
							) {					
					
								$resultado = alterarsenha(strtoupper($login),strtoupper($senhaatual),strtoupper($novasenha1),"1");
			   					   
								oci_execute($resultado, OCI_COMMIT_ON_SUCCESS);							
								echo "
									<SCRIPT LANGUAGE=JAVASCRIPT>
									Swal.fire({
  									  icon: 'success',
  								          title: 'Senha',
  									  text: 'Senha atualizada com sucesso',
									  showConfirmButton: false,
  									  timer: 3000,
									  width: '600px'
 								 	});

									setTimeout(function() {
					  					window.location.href = 'http://intranet.unimedpinda.com.br/coop/redireciona_coop.php';
       									}, 2500);
									</SCRIPT>
								";
							}
						}
						else
						{
							echo "
								<SCRIPT LANGUAGE=JAVASCRIPT>
								Swal.fire({
  									icon: 'warning',
  									title: 'Senha Inválida',
  									text: 'A senha precisa ter letras maisculas e minusculas, caracter especial e numeros',
									showConfirmButton: false,
  									timer: 3000,
									width: '600px'
 								});

								setTimeout(function() {
					  					window.location.href = 'http://intranet.unimedpinda.com.br/coop/atu_senha.php';
       									}, 2500);

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


<script>
	function verificarSenha() {

		const dataAtual = new Date();
		const anoAtual = dataAtual.getFullYear();
	
		const senhaInput = document.getElementById('senha');
		const senhaInput2 = document.getElementById('senha2');
		const barraSenhaContainer = document.getElementById('barraSenhaContainer');
		const barraSenha = document.getElementById('barraSenha');
		const forcaSenhaTexto = document.getElementById('forcaSenhaTexto');
		const nomeCompleto = document.getElementById('nome').value;
		const primeiroNome = nomeCompleto.substring(0, nomeCompleto.indexOf(' '));
		const crm = document.getElementById('id_funcionario').value;

  		const senha = senhaInput.value;
		const confirmSenha = senhaInput2.value;
		const forcaSenha = calcularForcaSenha(senha, confirmSenha);
  		const caracterEspecialIcon = document.getElementById('caracterEspecial');
  		const numeroIcon = document.getElementById('numero');
  		const maiusculaIcon = document.getElementById('maiuscula');
  		const minusculaIcon = document.getElementById('minuscula');
		const botao = document.getElementById('botao');
		const caracteresMinimosIcon = document.getElementById('caracteresMinimos');

		const contemAno = senha.toLowerCase().includes(anoAtual);
		const contemUnimed = senha.toLowerCase().includes('unimed');
		const contemNome = senha.toLowerCase().includes(primeiroNome.toLowerCase());
		const contemCRM = senha.toLowerCase().includes(crm);

		barraSenha.style.width = `${forcaSenha}%`;

		if(contemAno || contemUnimed || contemNome || contemCRM){
			forcaSenhaTexto.textContent = 'Muito Fraca';
                	barraSenhaContainer.className = 'muito-fraca';
			barraSenha.style.width = '10%';
		}else{

			if (forcaSenha <= 10) {
                		forcaSenhaTexto.textContent = 'Muito Fraca';
                		barraSenhaContainer.className = 'muito-fraca';
            		} else if (forcaSenha <= 30) {
                		forcaSenhaTexto.textContent = 'Fraca';
				barraSenhaContainer.className = 'fraca';
            		} else if (forcaSenha <= 40) {
                		forcaSenhaTexto.textContent = 'Médio';
				barraSenhaContainer.className = 'media';
            		} else if (forcaSenha <= 50) {
                		forcaSenhaTexto.textContent = 'Forte';
				barraSenhaContainer.className = 'forte';
            		} else{
				forcaSenhaTexto.textContent = 'Muito Forte';
				barraSenhaContainer.className = 'muito-forte';
			}
		}
		

  		const criterios = {
   		 	temCaracterEspecial: /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(senha),
    			temNumero: /[0-9]/.test(senha),
    			temMaiusculo: /[A-Z]/.test(senha),
    			temMinusculo: /[a-z]/.test(senha),
			temMinino: senha.length >= 8,
 		};

		const comprimentoMinimo = Math.max(Math.min(senha.length, 8), 8);
 
  		caracterEspecialIcon.className = criterios.temCaracterEspecial ? "fas fa-check" : "fas fa-times";
  		numeroIcon.className = criterios.temNumero ? "fas fa-check" : "fas fa-times";
  		maiusculaIcon.className = criterios.temMaiusculo ? "fas fa-check" : "fas fa-times";
  		minusculaIcon.className = criterios.temMinusculo ? "fas fa-check" : "fas fa-times";

		if (barraSenhaContainer.className == 'muito-forte' && senha === confirmSenha) {
    			botao.disabled = false; 
  		} else {
    			botao.disabled = true; 
  		}

		const caracteresRestantes = Math.max(8 - senha.length, 0);
  		caracteresMinimosIcon.textContent = caracteresRestantes;
		caracteresMinimosIcon.className = senha.length >= 8 ? "fas fa-check" : "fas fa-times";
		
		if(senha === confirmSenha){
			confirmarSenha.className = "fas fa-check";
		}else{
			confirmarSenha.className = "fas fa-times";
		}

		if (caracteresRestantes === 0) {
    			caracteresMinimos.style.display = 'none';
			verificaMinimo.style.display = 'block';
  		} else {
    			caracteresMinimos.style.display = 'block';
			verificaMinimo.style.display = 'none';
  		}

		/*MOSTRAR SENHA 1

		
		const mostrarSenhaButton = document.getElementById('mostrarSenha');

		mostrarSenhaButton.addEventListener('mousedown', function () {
  			senhaInput.type = 'text'; 
		});

		mostrarSenhaButton.addEventListener('mouseup', function () {
  			senhaInput.type = 'password'; 
		});

		// Define o tratamento do evento "mouseout" para garantir que a senha seja ocultada ao retirar o cursor do botão
		mostrarSenhaButton.addEventListener('mouseout', function () {
  			senhaInput.type = 'password'; 
		});*/

		/*MOSTRAR SENHA 2

		const mostrarSenhaButton2 = document.getElementById('mostrarSenha2');

		mostrarSenhaButton2.addEventListener('mousedown', function () {
  			senhaInput2.type = 'text'; 
		});

		mostrarSenhaButton2.addEventListener('mouseup', function () {
  			senhaInput2.type = 'password'; 
		});

		// Define o tratamento do evento "mouseout" para garantir que a senha seja ocultada ao retirar o cursor do botão
		mostrarSenhaButton2.addEventListener('mouseout', function () {
  			senhaInput2.type = 'password'; 
		});*/

				
 	}

	function calcularForcaSenha(senha, confirmSenha) {
  		const comprimento = senha.length;
  		let forca = 10;

  		if (comprimento >= 8) {
    			forca += 10;
  		}

		if(senha === confirmSenha){
			forca += 10;
		}

  		if (/[A-Z]/.test(senha) && /[a-z]/.test(senha)) {
    			forca += 10;
  		}

  		if (/[0-9]/.test(senha)) {
    			forca += 10;
  		}

  		if (/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(senha)) {
    			forca += 10;
  		}

  		return forca;
	}

	function toggleSenhaVisibility(inputId) {
    		const senhaInput = document.getElementById(inputId);
    		const mostrarSenhaButton = document.getElementById(`mostrarSenha${inputId === 'senha' ? '' : inputId === 'senha2' ? '' : '3'}`);

    		if (senhaInput.type === 'password') {
        		senhaInput.type = 'text';
        		mostrarSenhaButton.textContent = 'visibility_off';
    		} else {
        		senhaInput.type = 'password';
        		mostrarSenhaButton.textContent = 'visibility';
    }
}

</script>

