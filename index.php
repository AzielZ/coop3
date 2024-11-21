<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Área do Cooperado - Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>
    body {
      height:100%;
      width:100%;
      background: url(img/bg.png) repeat center center;
 
    }

    .input-container {
    	position: relative;
    	display: flex;
    	align-items: center;
    }

    .input-container input {
	width: 100%;
    	padding-right: 40px;
     }

     .input-container .icone-span {
    	position: absolute;
    	right: 10px;
    	top: 40%; 
    	transform: translateY(-50%); 
    	cursor: pointer;
    	color: #000;
    	pointer-events: auto;   
    }
	
     #mostrarSenha{
	margin-bottom: 10px;
	color: #a9a9a9;
	z-index: 5;
     }

  </style>
    <div class="container">
      <div class="login">
        <form class="form-signin" name="form1" action="login.php" method="post" onsubmit="return validarPost()" autocomplete="off">
            <div class="form-group">
              <img src="img/login.png" class="img-rounded img-responsive" alt="Login">
            </div>

             <!-- Modal RESPONSAVEL PELA CAIXA DE DIALOGO -->
             <div id="suporte" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color:black">Algum problema?</h4>
                  </div>
                  <div class="modal-body" style="color:black">
                    <p>Caso tenha perdido a senha, ou encontrado algum problema, entre em contato com a Assessoria ao Cooperado:</p>
                    <ul>
                      <li>E-mail: assessoriacoop@unimedpinda.com.br</li>
                      <li>Telefone: (12) 3644-4405</li>
                    </ul>
                  </div>

                  <div align="center">
                    <table>
                      <thead>
                        <tr>
                          <th>
                           <button type="button" class="btn btn-success margem" data-dismiss="modal"></span>Voltar</button>
                         </th>
                       </tr>
                     </thead>
                   </table>
                   <br>
                 </div>
               </div>
             </div>
             </div>
             <!-- Fim Modal RESPONSAVEL PELA CAIXA DE DIALOGO -->

            <h2 class="form-signin-heading">Preencha os campos:</h2>
            <font>Login (CRM):</font>
            <input type="text" id="inputEmail" class="form-control" name="login" placeholder="Digite aqui o CRM (Ex: 058421)" required autofocus>
           <font>Senha:</font>
	    <div class="input-container">
            	<input type="password" id="inputPassword" class="form-control" name="senha" placeholder="******" required>
	    	<span class="material-symbols-outlined icone-span" id="mostrarSenha">visibility</span>
	    </div>
	    <!-- <p>Numero de tentativas: <?php echo $_SESSION["contador"] ?></p>  -->

	    <div class="g-recaptcha" data-sitekey="6Le0DwMnAAAAAOHaAWJuNKwXZND8E_Ljgef0mo_0"></div>

            <p class="help-block">Problemas ao acessar? Contate o <a href="#" data-toggle="modal" data-target="#suporte">suporte</a>.</p>
            <input class="btn btn-lg btn-success btn-block" type="submit" name="enviar">
        </form>
      </div>
    </div> <!-- /container -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script> 

    <script>
    	function validarPost(){
        	if(grecaptcha.getResponse() !== "") return true;

		alert('Selecione a caixa de "não sou um robó"');
        
        	return false;

    	}

	const senhaInput = document.getElementById('inputPassword');
	const mostrarSenhaButton = document.getElementById('mostrarSenha');

	mostrarSenhaButton.addEventListener('mousedown', function () {
  		senhaInput.type = 'text'; 
	});

	mostrarSenhaButton.addEventListener('mouseup', function () {
  		senhaInput.type = 'password'; 
	});

	mostrarSenhaButton.addEventListener('mouseout', function () {
  		senhaInput.type = 'password'; 
	});

    </script>
  </body>
</html>
