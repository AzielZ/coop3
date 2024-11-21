<?php
	  	include("valida_usuario.php");
        valida_usuario('TRA_GER');
?>

<link rel="shortcut icon" href="img/favicon.png">

<!-- INICIO DIV TUDO -->
<div class="tudo">
	<?php 
	  include_once('header.php'); 
	  include_once('funcoes.php');
	?>

	<!--INICIO CONTEUDO-->
	<div class="conteudo">

	<style>
	.chart {
	  width: 100%; 
	  min-height: 250px;
	}
	</style>

	<!--INICIO CONTAINER-->
		<div class="container">

			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"> <B>SINISTRALIDADE</B> </h2>
							 <Font Size=1><b>Defini��o:</b> � um indicador dos contratos de assist�ncia m�dica e � a rela��o entre os custos da assist�ncia m�dica hospitalar e a receita que a operadora tem para um determinado produto ou sua carteira. </font>
						</div>
						<div class="panel-body">
							<div class="table-condenssed">  
								
								 <div id="chart_div2" class="chart"></div>
							</div>
						</div>
					</div>   
				</div>
			 
				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"><B> USU�RIOS ATIVOS POR PER�ODO </B></h2>
							<Font Size=1><b>Defini��o:</b> Quantidade de usu�rios ativos por tipo de contrata��o dos �ltimos quatro meses. </font>

						</div>
						<div class="panel-body">
							<div class="table-condenssed">  
								
								 <div id="chart_div1" class="chart"></div>
								 
							</div>
						</div>
					</div>   
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"><B> PRODU��O M�DICA GERAL POR CONTRATA��O </B></h2>
							<Font Size=1><b>Defini��o: </b> Trata-se dos servi�os m�dicos prestados � benefici�rios locais e de outras operadoras. Pr�-Pagamento s�o os contratos com mensalidade. Custo Operacional s�o os contratos que pagam pelos servi�os prestados. Interc�mbio s�o os benefici�rios de outras singulares e pagam pelo servi�os prestados.</font>

						</div>
						<div class="panel-body">
							<div class="table-condenssed">  
								
								 <div id="chart_div3" class="chart"></div>
							</div>
						</div>
					</div>   
				</div>

				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"> Andamento das obras do Hospital 10 de Julho</h2>
						</div>
						<div class="panel-body">
							<div class="table-condenssed">  
							
								<div class="progress">
								<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="96" style="width: 0%">
									Geral - 96%
								</div>
								</div>
								
								<div class="progress">
								<div class="progress-bar progress-bar-info progress-bar-striped false" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
									Maternidade - 100%
								</div>
								</div>
								
								<div class="progress">
								<div class="progress-bar progress-bar-warning progress-bar-striped false" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
									Hemodin�mica - 100%
								</div>
								</div>
								
								<div class="progress">
								<div class="progress-bar progress-bar-danger progress-bar-striped false" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
									Interna��o Pedi�trica - 100%
								</div>
								</div>
								
								<div class="progress">
								<div class="progress-bar progress-bar-success progress-bar-striped false" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="80" style="width: 0%">
									Unidade Coronariana - 80%
								</div>
								</div>
								
								<div class="progress">
								<div class="progress-bar progress-bar-info progress-bar-striped false" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
									U.T.I Neo Natal - 100%
								</div>
								</div>
								
								<div class="progress">
								<div class="progress-bar progress-bar-warning progress-bar-striped false" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
									Lanchonete - 100%
								</div>
								</div>						
							
							</div>
						</div>
					</div>   
				</div>
			
			</div>
		


		<!--FIM CONTAINER-->
		</div>

	<!--FIM CONTEUDO--> 
	</div>
	 
	<div class="rodape">
	<?php 
	  include_once('footer.php'); 
	?>
	</div>
			

	<!-- INICIO PROGRESS BAR -->
	  <script type="text/javascript">
	  

	$('.progress-bar').each(function() {
		var $bar = $(this);
		var progress = setInterval(function() {

		  var currWidth = parseInt($bar.attr('aria-valuenow'));
		  var maxWidth = parseInt($bar.attr('aria-valuemax'));

		
		  //update the progress
			$bar.width(currWidth+'%');
			$bar.attr('aria-valuenow',currWidth+1);

		  //clear timer when max is reach
		  if (currWidth >= maxWidth){
			clearInterval(progress);
		  }

		}, 0);
	});
	  </script>
		<!-- FIM PROGRESS BAR -->

		<script>					
		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart1);
		function drawChart1() {
			 var data = google.visualization.arrayToDataTable(
			   [['PER�ODO','PJ CO','PJ Pr�','PF','Unimed','Total']
			   <?php 
					$resultado1 = retornalinhas("0","5");
					if(OCIExecute($resultado1)){
					   while(OCIFetch($resultado1)){
					  	 echo ",['".OCIResult($resultado1,1)."',".OCIResult($resultado1,2).",".OCIResult($resultado1,3).",".OCIResult($resultado1,4).",".OCIResult($resultado1,5).",".OCIResult($resultado1,6)."]";
				       } 
				    }	
			   ?>
			   ]);
			 var options = {
			   legend: { position: 'bottom'},
			   bar: { groupWidth: '75%' }
			 };

			 var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
			 chart.draw(data, options);
		}

		google.load("visualization", "1", {packages:["gauge"]});
		google.setOnLoadCallback(drawChart2);
		function drawChart2() {
			 var data = google.visualization.arrayToDataTable(
			   [['Label', 'Value']
			   <?php 
					$resultado1 = retornalinhas("0","4");
					if(OCIExecute($resultado1)){
					   while(OCIFetch($resultado1)){
					  	 echo ",['".OCIResult($resultado1,1)."',".OCIResult($resultado1,2)."]";
				       } 
				    }	
			   ?>
			   ]);

			 var options = {
				  yellowFrom:76, yellowTo: 80,
				  redFrom: 80, redTo: 100,
				  minorTicks: 5
			 };

			 var chart = new google.visualization.Gauge(document.getElementById('chart_div2'));
			 chart.draw(data, options);
		}

		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart3);
		function drawChart3() {
			 var data = google.visualization.arrayToDataTable([
				['M�S',	'Custo Oper.',	'Pr� Pagto', 'Interc�mbio','Total']
			    <?php 
					$resultado1 = retornalinhas("0","11");
					if(OCIExecute($resultado1)){
					   while(OCIFetch($resultado1)){
					  	 echo ",['".OCIResult($resultado1,1)."',".OCIResult($resultado1,2).",".OCIResult($resultado1,3).",".OCIResult($resultado1,4).",".OCIResult($resultado1,5)."]";
				       } 
				    }	
			   ?>
 			  ]);

			 var options = {
				  legend: { position: 'bottom'}   
			 };

			 var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
			 chart.draw(data, options);
		}

		$(window).resize(function(){
		  drawChart1();
		  drawChart2();
		  drawChart3();
		  
		});					
	</script> 
	<!-- FIM DIV TUDO -->
</div>