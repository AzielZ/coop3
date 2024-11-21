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

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

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
       background: url(img/bg.png) repeat center center;
 
    }
	
    #form{
	position: absolute;
    	border: 0.5px solid #5cb85c;
	border-radius: 10px;
	width: 50%;
    	background-color: #f7f4f4;
	margin: -100px;
	min-widht: 35%;
    }

    .container{
	display: flex;
    	justify-content:center;
    	width: 95%;
    }

    .conteudo{
	padding: 15px;    }

    input{
        width: 100%;
    	padding: 10px 15px;
    	margin: 8px 0;
    	display: inline-block;
    	border: 1px solid #ccc;
   	box-sizing: border-box;
    }

    input:hover{
	border-color: #5cb85c;	
    }

    button{
	background-color: #5cb85c;
    	color: white;
    	padding: 14px 20px;
    	margin: 8px 0;
    	border: none;
	border-radius: 10px;
    	cursor: pointer;
	width: 100%;
   
    }

  </style>

	<div class="container">
		<div id="form">
			<div class="conteudo">
	
				<h1>Inserir um novo arquivo</h1>

				<label>Descrição do assunto</label>
				<input id="assunto" type="text" placeholder="Ex: Conselho Administrativo Abril - Reunião Presencial">

				<label>Descrição da mensagem</label>
				<input id="mensagem" type="text" placeholder="Ex: Clique no botão para realizar o download do anexos">
			
				<label>Anexo</label>
				<input id="anexo" type="file">

				<button id="btnEnviar" onclick="ajaxArquivo()">Enviar</button>
			</div>
		</div>

	<div>

      </body>
</html>

<script>

	function ajaxArquivo(){

		var assunto = $("#assunto").val();
		var mensagem = $("#mensagem").val();
		var anexo = $(":file");

		console.log(anexo);

		//if(assunto != "" && mensagem != ""){
			$.ajax({
    				url: 'enviarArquivos.php',
   				type: 'POST',
    				data: {assunto: assunto,
			       	       mensagem: mensagem},
    			success: function(result){
				console.log(result);
         		},
   			error: function(err) {
				console.log(err);
     			}
			});

		/*}else{
			alert("Informe todos os campos necessarios");
		}*/

	}	
</script>