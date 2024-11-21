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
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags   -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="shortcut icon" href="img/favicon.png">

    <title>�rea do Cooperado - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
 
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

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
  </style>
    <div class="container">
      <div class="login">
        <form class="form-signin" name="form1" action="login_admin.php" method="post">
            <div class="form-group">
              <img src="img/login_admin.png" class="img-rounded img-responsive" alt="Login">
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
                    <p>Caso tenha perdido a senha, ou encontrado algum problema, entre em contato com a T.I. via:</p>
                    <ul>
                      <li>E-mail: ti@unimedpinda.com.br</li>
                      <li>Telefone: (12) 3644-4420 ou (12) 3644-4424</li>
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
            <font>Login:</font>
            <input type="text" id="inputEmail" class="form-control" name="login" placeholder="Ex: tteberga" required autofocus>
           <font>Senha:</font>
            <input type="password" id="inputPassword" class="form-control" name="senha" placeholder="******" required>

	    <div class="g-recaptcha" data-sitekey="6Le0DwMnAAAAAOHaAWJuNKwXZND8E_Ljgef0mo_0"></div>	

            <p class="help-block">Problemas ao acessar? Contate o <a href="#" data-toggle="modal" data-target="#suporte">suporte</a>.</p>
            <button class="btn btn-lg btn-success btn-block" type="submit" name="enviar">Entrar</button>
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

		alert('Selecione a caixa de "n�o sou um rob�"');
        
        	return false;

    	}
    </script>


  </body>
</html>
 