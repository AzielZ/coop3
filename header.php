<?php
		if($_SESSION["valida"] != 1){
			header("Location:http://intranet.unimedpinda.com.br/coop/redireciona_coop.php");
			session_destroy();
		}

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

          <title>Área do Cooperado</title>

          <!-- Bootstrap core CSS -->
          <link href="css/bootstrap.min.css" rel="stylesheet">

          <!-- Bootstrap theme -->
          <link href="css/bootstrap-theme.min.css" rel="stylesheet">

          <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
          <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

          <!-- Custom styles for this template -->
          <link href="css/dashboard.css" rel="stylesheet">
          <link href="css/style.css" rel="stylesheet"> 

		  <!-- Graficos utilizando Chart -->
		  <script src="chart/Chart.min.js"></script>		  

          <!-- PARA FUNCIONAR O DATATABLE -->
          <link href="datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">
		  
		  <!-- Graficos utilizando Google Chart -->
		  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		  
		  <!-- Graficos utilizando Google Chart -->
		  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
		  
          <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
          <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
          <script language="JavaScript" type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>

          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
          <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>          
          <![endif]-->

          <script language="JavaScript" type="text/javascript" src="js/cidades-estados-utf8.js"></script>

      </head>

<style>
.corbadge{
		color: green;
		background-color: white;
	 }
.verde{
		color: green;
	 }
.active{
		background-color: green;
	 }

a{
	font-size: 12px;
}

.add-css:focus,
.add-css:hover
{
	background-color: #72b051 !important;
}

.icon-bar{
	background-color: #fff !important;
}

</style>

    <body>

      <?php
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        #echo strftime( '%Y-%m-%e %T', strtotime('now')); 
        $data_padrao = date('d-m-Y H:i:s');
        include_once('funcoes.php');
      ?>

      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed add-css" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
			<a href="home.php"><img src="img/logocoop.png"></a>
			<!-- <span class="navbar-brand"></span> -->
          </div>

<div id="navbar" class="navbar-collapse collapse">

	<?php if($_SESSION["senha"] != 'C0OP@M#D'){ ?>
		  
          

             <ul class="nav navbar-nav navbar-left">
              <li><a href="home.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Início </a></li>
              <li><a href="indicadores.php"><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> PORTAL DA TRANSPARÊNCIA</a></li> 
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Demonstrativos <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header">Pagamento Prestador</li>
                  <li><a href="ger_demonstrativo.php">Folha de Pagamento</a></li>
                  <!-- <li><a href="ger_inss.php">Comprovante Rec. INSS</a></li> -->

                 <!-- <?php
 		 		      $resultado = retornalinhas($_SESSION["cdfuncionario"],"16");
		 			  if(OCIExecute($resultado)){
		 				 while(OCIFetch($resultado)){
		 					echo '<li role="separator" class="divider"></li>';
		 					echo '<li class="dropdown-header">Pró-labore</li>';
		 					echo '<li><a href="ger_dem_prolabore.php">Demonstrativos Pró-labore</a></li>';
		 					};}; 			 
                  ?> -->
				  
                  <?php
 				      $resultado = retornalinhas($_SESSION["cdfuncionario"],"7");
					  if(OCIExecute($resultado)){
						 while(OCIFetch($resultado)){
							echo '<li role="separator" class="divider"></li>';
							echo '<li class="dropdown-header">Imposto de Renda</li>';
							echo '<li><a href="pdfs/dirfcoop/dirf2024/'.OCIResult($resultado,1).'" target="_blank">Ano Calendário 2023</a></li>';
							
							#O trecho abaixo faz a abertura de duas paginas, uma com o href e outra com o OnClick
							#echo '<li><a href="pdfs/dirfcoop/dirf2022/'.OCIResult($resultado,1).'" target="_blank" onclick="window.open(\'sobre.php\', \'_blank\')">Ano Calendário 2022</a></li>';
							};}; 			 
                  ?>
		          <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Resultados de Exercícios</li>
		  <li><a href="pdfs/rel2023.pdf" target="_blank">Ano 2023</a></li>
		  <li><a href="pdfs/rel2022.pdf" target="_blank">Ano 2022</a></li>
                  <li><a href="pdfs/rel2021.pdf" target="_blank">Ano 2021</a></li>
                  <li><a href="pdfs/rel2020.pdf" target="_blank">Ano 2020</a></li>
                  <li><a href="pdfs/rel2019.pdf" target="_blank">Ano 2019</a></li>
                  <li><a href="pdfs/rel2018.pdf" target="_blank">Ano 2018</a></li>
                  <li><a href="pdfs/rel2017.pdf" target="_blank">Ano 2017</a></li>
                  <li><a href="pdfs/rel2016.pdf" target="_blank">Ano 2016</a></li>
                  <li><a href="pdfs/rel2015.pdf" target="_blank">Ano 2015</a></li>
                  <li><a href="pdfs/rel2014.pdf" target="_blank">Ano 2014</a></li>
                  <li><a href="pdfs/rel2013.pdf" target="_blank">Ano 2013</a></li>
                  <li><a href="pdfs/rel2012.pdf" target="_blank">Ano 2012</a></li>
                  <li><a href="pdfs/rel2011.pdf" target="_blank">Ano 2011</a></li>
                </ul>
              </li>

		<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span> ROL <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="anexos\TB 039_SADT Versão 2023.03_Adequação_01.10.2023.xlsx" target="_blank">TB 039 - SADT</a></li>
		    <li><a href="anexos\TB 038_Odontologia Versão 2023.03_Adequação_01.10.2023.xls" target="_blank">TB 038 - Odontologia</a></li>
	            <li><a href="anexos\DIRETRIZES DE UTILIZACAO ANS.pdf" target="_blank">Diretrizes de Ulização ANS </a></li>
		    <li><a href="anexos\MAME_v20.indb.pdf.crdownload" target="_blank">Manual de Consultas das Normas de Auditora Médica e Enfermagem </a></li>
		    <li><a href="anexos\TB 042_Procedimentos Excludentes_Versão 2023.02.xlsx" target="_blank">Procedimentos Excludentes </a></li>
		    <li><a href="con_rol.php">ROL de Procedimentos</a></li>	                    
		  </ul>
             	</li>

	     <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span> Políticas<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="anexos\SED-POL-ADM-017 Política de privacidade e proteção de dados rev0.pdf" target="_blank">Política de Privacidade</a></li>
		    <li><a href="anexos\SED-POL-TI-002 Política Geral da Segurança da Informação rev5.pdf" target="_blank">Política de Segurança da Informação</a></li>
		    <li><a href="politicas.php">Anexos das Politicas de Segurança da Informação</a></li>
		    <li><a href="anexos\SED-POL-ASS-002 Política do Plano de Valorização do Cooperado (PVC) rev 1.pdf" target="_blank">Politica Plano Valorização do Cooperado</a></li>
		    <li><a href="anexos\SED-POL-ASS-005 Preparação e Desenvolvimento de Futuros Dirigentes rev0.pdf" target="_blank">Preparação e Desenvolvimento de Futuros Dirigentes</a></li>
		    <li><a href="anexos\SED-I-ASS-013 Incentivo Educacional rev0.pdf" target="_blank">Impresso Política Educacional</a></li>
		    <li><a href="anexos\SED-POL-ASS-001 Política para preservar confid. prontuário rev1.pdf" target="_blank">Política para Preservar Confid. Prontuário</a></li>
		    <li><a href="anexos\SED-PS-ASS-003 Incentivo Educacional Cooperados rev1.pdf" target="_blank">Política Incentivo Educacional Cooperados</a></li>
		    <li><a href="anexos\SED-PS-ASS-005 Critério de Seleção, Avaliação e Desligamento de Cooperados.pdf" target="_blank">Política de Criterio de seleção, avaliação e desligamento de Cooperados</a></li>
		    <li><a href="anexos\SED-POL-ASS-003 Relacionamento com o cooperado - rev1.pdf" target="_blank">Política de Relacionamento com o cooperado</a></li>
		    <li><a href="pdfs\SED-POL-ADM-016 Nomeacao atrib respons Coord Méd áreas ou unids - Rev0 bloq.pdf" target="_blank">Nomeação Responsável Coord. Médicos Áreas e/ou Unidades</a></li>
		    <li><a href="anexos\SED-I-ASS-015 Prestação de serviço de apoio Diagnóstico e terapeutico (S.A.D.T) rev0.pdf" target="_blank">Impresso Prestação de serviço de apoio Diagnostico e terapeutico</a></li>
		    <li><a href="anexos\SED-I-ASS-016 Requerimento de extensão ou migração de especialidade - cooperado rev0.pdf" target="_blank">Impresso Requerimento de extenção ou migração de especialidade</a></li>
                  </ul>
              </li>

	     <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span> Est.Social <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="pdfs/estatuto_social_13_03_2023.pdf" target="_blank">Estatuto Social </a></li>
                  </ul>
              </li>



 
              
			  
			  <?php
 				      $resultado = mensagem($_SESSION["cdfuncionario"]," "," ","2");
					  if(OCIExecute($resultado)){
						 while(OCIFetch($resultado)){
							echo '<li><a href="con_mensagem.php"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Mensagens <span class="badge corbadge">'.OCIResult($resultado,1).'</span></a></li> ';
							};}; 			 
              ?>
	
	      
<!-- 			  
-->				  
		  
            </ul>
	<?php  } ?> 

            <ul class="nav navbar-nav navbar-right">
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="user" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-user' aria-hidden='true'></span> Olá, <?php echo $_SESSION["nomeusuario"]; ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="atu_senha.php"><span class='glyphicon glyphicon-user' aria-hidden='true'></span> Alterar Senha</a></li>
				  <li><a href="atu_cadastro.php"><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Atualizar Cadastro</a></li>
				  <!-- <li><a href="sobre.php"><span class='glyphicon glyphicon-briefcase' aria-hidden='true'></span> Sobre a Empresa</a></li> -->	
                  <li><a href="redireciona_coop.php"><span class='glyphicon glyphicon-off' aria-hidden='true'></span> Sair</a></li>
                </ul>
              </li>
            </ul>

          </div>
        </div>
      </nav>
