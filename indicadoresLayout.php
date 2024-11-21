<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="shortcut icon" href="img/favicon.png">

<!-- INICIO DIV TUDO -->
<div class="tudo">
	<?php 
	  include_once('funcoes.php');
	?>

	<!--INICIO CONTEUDO-->
	<div class="conteudo">

	<style>

	body{
		overflow-x: hidden;
	}

	.center_title{
		text-align:center;
	}

	.title_tabela{
		color: #3c763d;
		font-weight: bold;
	}

	.green-background th,
      	.green-background td {
        	background-color: #415832 !important;
        	color: white;
      	}
	.green-background th{
		text-align: center;
	}

	.google-visualization-table th,
      	.google-visualization-table td {
        	white-space: normal !important;
      	}

	.chart {
	  	width: 100%; 
	  	min-height: 250px;
	}

	.new_chart{
	  	min-height: 80px !important;	
	}

	.logo-unimed{
	  	margin: 5px 0 0 35px;
	}

	.logo-h10{
	  	margin: 5px 0 0 10px;
	}

	.acompanhamentoFinanceiro{
		width: 250px;
	}

	.normaDerivada{
		display: flex;
		text-align: center;
    		flex-direction: column;
	}

	.content{
		display: flex; 
		justify-content: space-between; 
		align-itens: center;
		gap: 20px;
		margin-left: 20px;
	}

	.lista-h10{
		display: flex; 
		flex-direction: column; 
		margin: 10px 0 0 0;
	}

	.lista-h10-1{
		display: flex; 
		flex-direction: column; 
		margin: 10px 0 15px 0;

	}

	.lista-h10 ul li a, .lista-h10-1 ul li a,
	.lista-h10 ul li, .lista-h10-1 ul li{
		font-size: 16px;
	}

	.itens{
		font-size: 14px !important;
	}

	.qtdCirurgias{
		display: flex; 
		gap: 30px; 
		align-items: center;
	}
	
	@media only screen and (max-width: 480px) {
  		.title{
			display:none;
		}

		.logo-unimed{
	  		margin-left: 0;
		}

		.logo-h10{
			margin: 15px 5px 0 0;
		}

		.img-mobile{
			width: 150px;
		}

		.content{
			gap: 10px;
			margin-left: 0;
		}
		
		.qtdCirurgias{
			flex-direction: column;
		}

		.qtdCirurResponsive{
			width: 85% !important;
		}

	}
	
	</style>

	<!--INICIO CONTAINER-->
		<div class="container">

			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"> <B>PLANEJAMENTO ESTRATEGICO</B> 
						</div>
						<div class="panel-body">
							<div class="table-condenssed">
								<div class="content">
								<div>  
								    <Font Size=2 class="title"><B>Planejamento Estrategico Operadora</B></font>
								    <a href="pdfs/BOOK_ESTRATEGICO_V4_OPERADORA_DO_MKT.pdf" target="_blank">
								 	<img class="logo-unimed img-mobile" src="img/logorodape.png" /></br>
								    </a>
								  </div>

								 <div>
								   <Font Size=2 class="title"><B>Planejamento Estrategico Hospital</B></font>
								   <a href="pdfs/BOOK_ESTRATEGICO_HOSPITAL_V4_DO_MKT.pdf" target="_blank">
								 	<img class="logo-h10 img-mobile" src="img/logo-h10.png" />
								   </a>
								</div>
								</div>
                                                        </div>
						</div>
					</div>   
				</div>

		               <div class="col-md-3">
				      <div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"><B>HOSPITAL 10 DE JULHO </B></h2>
							<!-- <Font Size=1><b>Definição:</b> Quantidade de usuários ativos por tipo de contratação dos últimos quatro meses. </font> -->

						</div>
						<div class="panel-body">
							 <div class="table-condenssed">
							   <div class="content">			
								<div class="lista-h10-1">
									<ul>
									 	<li><a href="pdfs/Indicadores da Hotelaria.pdf" target="_blank">Indicadores da Hotelaria</a></li>
									 	<li><a href="pdfs/H10-ORG-DIR-001_Organograma_do_H10J_rev7.pdf" target="_blank">Organograma</a></li>
									</ul>
								</div>
	 						    </div>		
							</div> 
						</div> 
					</div>   
				</div>

				<div class="col-md-3">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"><B>AÇÕES ADMINISTRATIVAS </B></h2>
							<!-- <Font Size=1><b>Definição:</b> Quantidade de usuários ativos por tipo de contratação dos últimos quatro meses. </font> -->

						</div>
						<div class="panel-body">
							 <div class="table-condenssed">
							   <div class="content-1">			
								<div class="lista-h10">
									<ul>
										<li><a href="pdfs/Relatório junho.pdf" target="_blank">Ações da Gestão</a></li>
										<li><a href="pdfs/Relatório Unimed 1 - 30 dias.pdf" target="_blank">Inventário Unimed</a></li>
										<ul>
									 		<li><a href="pdfs/TEA 057 Evolucao de gastos-1.pdf" class="itens" target="_blank">Evolução de Gastos [Item 11]</a></li>
											<li><a href="pdfs/Inventario oficial H10.pdf" class="itens" target="_blank">Inventário H10 [Item 13]</a></li>
										</ul>
									</ul>
								</div>
	 						    </div>		
							</div> 
						</div> 
					</div>   
				</div>

				


			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"> <B>ACOMPANHE AS REUNIÕES DA DIRETORIA</B> </h2>
							 <Font Size=1>Acompanhe as reuniões da DIRETORIA. </font>
						</div>
						<div class="panel-body">
							<div class="table-condenssed">  
								 <Font Size=2><B>AGENDA ANUAL DE REUNIÕES</B></br>Todas as terças-feiras às 14h.</font></br></br>
								 <Font Size=2><B>LOCAL</B></br>Sala de Reuniões da Sede Administrativa (Shopping Pátio Pinda)</font></br><br>
								 <!--<Font Size=2><B>Acesse o vídeo da última reunião</B></font></br>
                                                                  <a href="#" data-toggle="modal" data-target="#videoModal1" class="videoLink">Abrir Vídeo</a>
                                                                  <div class="modal fade" id="videoModal1" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
                                                                     <div class="modal-dialog modal-lg" role="document">
                                                                         <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="videoModalLabel">REUNIÃO DO CONSELHO ADMINISTRATIVO</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                                   <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <iframe width="100%" height="400" frameborder="0" allowfullscreen></iframe>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                 </div> -->
						       </div>
						</div>
					</div>   
				</div>

			
				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"> <B>ACOMPANHE AS REUNIÕES DO CONSELHO FISCAL</B> </h2>
							 <Font Size=1>É competência do Conselho Fiscal, a fiscalização de todas atividades da Cooperativa, contratar serviços de auditoria e técnicos especializados para exames de livros de contabilidade e de documentos, submetendo a previsão de despesas bem como o currículo dos contratados ao Conselho de Administração, nos termos da lei n°5.764/71.</font>
						</div>
						<div class="panel-body">
							        <div class="table-condenssed">  
								 <Font Size=2><B>AGENDA ANUAL DE REUNIÕES</B></br>30/04/2024, 28/05/2024, 02/07/2024, 27/08/2024, 24/09/2024, 29/10/2024, 26/11/2024, 17/12/2024, 28/01/2025, 25/02/2025 às 19h.</font></br></br>
								 <Font Size=2><B>LOCAL</B></br>Sala de Reuniões da Sede Administrativa (Shopping Pátio Pinda)</font></br><br>
								 <!--<Font Size=2><B>Acesse o vídeo da última reunião</B></font></br>
                                                                 <a href="#" data-toggle="modal" data-target="#videoModal2" class="videoLink">Abrir Vídeo</a>
                                                                 <div class="modal fade" id="videoModal2" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
                                                                     <div class="modal-dialog modal-lg" role="document">
                                                                         <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="videoModalLabel">REUNIÃO DO CONSELHO FISCAL</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                                   <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <iframe width="100%" height="400" frameborder="0" allowfullscreen></iframe>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                 </div> -->
							</div>
						</div>
					</div>   
				</div>
			<div>
				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"> <B>ACOMPANHE AS REUNIÕES DO CONSELHO DE ADMINISTRAÇÃO</B> </h2>
							 <Font Size=1>É competência do Conselho de administração, nos limites da lei, do Estatuto Social e das deliberações da Assembleia Geral, é de planejamento, de gerenciamento, de controle e normativa. Reunindo-se uma vez por mês e extraordinariamente, sempre que necessário, por convocação do Presidente, da maioria do próprio Conselho de Administração, ou ainda, por solicitação Conselho do Fiscal.</font>
						</div>
						<div class="panel-body">
							<div class="table-condenssed">  
								 <Font Size=2><B>AGENDA ANUAL DE REUNIÕES</B></br>Todas as quartas-feiras às 20h.</font></br></br>
								 <Font Size=2><B>LOCAL</B></br>Sala de Reuniões da Sede Administrativa (Shopping Pátio Pinda)</font></br><br>
								 <!-- <Font Size=2><B>Acesse o vídeo da última reunião</B></font></br>
                                                                 <a href="#" data-toggle="modal" data-target="#videoModal3" class="videoLink">Abrir Vídeo</a>
                                                                 <div class="modal fade" id="videoModal3" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
                                                                     <div class="modal-dialog modal-lg" role="document">
                                                                         <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="videoModalLabel">REUNIÃO DO CONSELHO FISCAL</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                                   <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <iframe width="100%" height="400" frameborder="0" allowfullscreen></iframe>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                 </div> -->
							</div>
						</div>

					</div>   
				</div>

				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"> <B>INDICADORES DA OPERADORA</B> </h2>
							 <Font Size=1>A Norma Derivada 11, consiste em 12 indicadores econômicos e financeiros, que visam demonstrar a capacidade econômica e financeira, tanto da operadora como da cooperativa, onde a Unimed do Brasil avalia mensalmente esses indicadores e atribui a Unimed uma nota mensal sendo de 0 a100.</font>
						</div>
						<div class="panel-body">
							<div class="normaDerivada">  
								 <Font class="title" Size=2><B>Para acessar clique na imagem a baixo!</B></Font>
								 <a href="pdfs/Acompanhamento.pdf" target="_blank">
									<img class="acompanhamentoFinanceiro" src="img/acompanhamento_financeiro.png" />
								 <a/>
							</div>
						</div>
					</div>   
				</div>

				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"> <B>QUADRO DE FUNCIONARIOS</B> </h2>
							 <Font Size=1>Total de Funcionarios: <?php 
												$resul = qtdFuncionarios(2);
												if(OCIExecute($resul)){
					   								while(OCIFetch($resul)){
					  	 								echo OCIResult($resul,1);
				       	   								} 
				 								}	
			   	 							      ?>
							</font>
						</div>
						<div class="panel-body">
							<div class="table-condenssed">  
								 <div id="table_div" class="chart"></div>
							</div>
						</div>
					</div>   
				</div>

				
				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"> <B>SINISTRALIDADE</B> </h2>
							 <Font Size=1><b>Definição:</b> É um indicador dos contratos de assistência médica e é a relação entre os custos da assistência médica hospitalar e a receita que a operadora tem para um determinado produto ou sua carteira.</font>
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
							<h2 class="panel-title"><B> USUÁRIOS ATIVOS POR PERÍODO </B></h2>
							<Font Size=1><b>Definição:</b> Quantidade de usuários ativos por tipo de contratação dos últimos quatro meses. </font>

						</div>
						<div class="panel-body">
							<div class="table-condenssed">  
								
								 <div id="chart_div1" class="chart"></div>
								 
							</div>
						</div>
					</div>   
				</div>

				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"> <B>Quantidade de Cirurgias com Passagem por UTI</B> </h2>
							 <Font Size=1></font>
						</div>
						<div class="panel-body">
							<div class="qtdCirurgias">
							  <div class="qtdCirurResponsive" style="flex-grow: 2; width: 26%;">
								<div class="center_title">
									<p class="title_tabela">Nº TOTAL</p>
								</div>
								<div class="table-condenssed">  
								 	<div id="chart_div6" class="chart"></div>
								</div>
							  </div>

							  <div class="qtdCirurResponsive" style="flex-grow: 2;">
								<div class="center_title">
									<p class="title_tabela">Nº COM PASSAGEM POR UTI</p>
								</div>
								<div class="table-condenssed">  
								 	<div id="chart_div7" class="chart"></div>
								</div>
							  </div>

							   <div class="qtdCirurResponsive" style="display: flex; flex-direction: column; width: 29%;">
								<div class="center_title">
									<p class="title_tabela">CASOS EVOLUÇÃO UTI NÃO PREVISTO</p>
								</div>
								<div class="table-condenssed">  
								 	<div id="chart_div8" class="chart  new_chart"></div>
								</div>
								
								<div class="center_title">
									<p class="title_tabela">CUSTO MÉDIO DIÁRIA DE UTI</p>
								</div>
								<div class="table-condenssed">  
								 	<div id="chart_div9" class="chart  new_chart"></div>
								</div>
							  </div>

							</div>
						</div>
					</div>   
				</div>


			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h2 class="panel-title"><B> PRODUÇÃO MÉDICA GERAL POR CONTRATAÇÃO </B></h2>
							<Font Size=1><b>Definição: </b> Trata-se dos serviços médicos prestados à beneficiários locais e de outras operadoras. Pré-Pagamento são os contratos com mensalidade. Custo Operacional são os contratos que pagam pelos serviços prestados. Intercâmbio são os beneficiários de outras singulares que pagam pelos serviços prestados.</font>

						</div>
						<div class="panel-body">
							<div class="table-condenssed">  
								
								 <div id="chart_div3" class="chart"></div>
							</div>
						</div>
					</div>   
				</div>
			
			</div>
		


		<!--FIM CONTAINER-->
		</div>

	<!--FIM CONTEUDO--> 
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
			   [['PERÍODO','PJ CO',{ role: 'annotation' },'PJ Pré',{ role: 'annotation' },'PF',{ role: 'annotation' },'Total', { role: 'annotation' }]
			   <?php 
					$resultado1 = retornalinhas("0","5");
					if(OCIExecute($resultado1)){
					   while(OCIFetch($resultado1)){
					  	 echo ",['".OCIResult($resultado1,1)."',".OCIResult($resultado1,2).",".OCIResult($resultado1,2).",".OCIResult($resultado1,3).",".OCIResult($resultado1,3).",".OCIResult($resultado1,4).",".OCIResult($resultado1,4).",".OCIResult($resultado1,6).",".OCIResult($resultado1,6)."]";
				       } 
				    }	
			   ?>
			   ]);

			 var options = {
			   chartArea: { left: 10, top: 10, right: 100, bottom: 25 },
			   bar: { groupWidth: '80%' },
			   annotations: {
            				alwaysOutside: true,
            				textStyle: {
                				fontSize: 10,
                				color: 'black',
            				}
        		  }
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
				  height: 300,
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
				['MÊS',	'Custo Oper.',	'Pré Pagto', 'Intercâmbio','Total']
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

		google.charts.load('current', {'packages':['corechart']});
    		google.charts.setOnLoadCallback(drawChart5);

    		function drawChart5() {
      			var data = google.visualization.arrayToDataTable([
				['UNIDADE', 'QTDE']
				<?php 
					$resul = qtdFuncionarios(1);
					if(OCIExecute($resul)){
					   while(OCIFetch($resul)){
					  	 echo ",['".OCIResult($resul,1)."',".OCIResult($resul,2)."]";
				       	   } 
				 	}	
			   	 ?>
              		]);

			var options = {
				legend: {  maxLines: null, textStyle: { fontSize: 10 } },
				pieHole: 0.4,
				chartArea: { left: 10, top: 40, right: 30, bottom: 50 }
        		};

      			var chart = new google.visualization.PieChart(document.getElementById('table_div'));
    			chart.draw(data, options);  		
		}

		google.charts.load('current', {'packages':['table']});
    		google.charts.setOnLoadCallback(drawChart6);

    		function drawChart6() {
        		var data = new google.visualization.DataTable();
        		data.addColumn('string', 'Mês/Ano');
        		data.addColumn('string', 'N° Cirurgias');
        		data.addRows([
          			['mar/23', '506'],
				['abr/23', '394'],
				['mai/23', '535'],
				['jun/23', '463'],
				['jul/23', '536'],
				['ago/23', '486'],
				['set/23', '430'],
				['out/23', '457'],
				['nov/23', '478'],
				['dez/23', '378'],
				['jan/23', '492'],
				['fev/23', '409']
          		]);

                	data.addRow(['TOTAL', '5.564']);

			var numRows = data.getNumberOfRows();
        		data.setProperty(numRows - 1, 0, 'style', 'background-color: #548235; color: white;');
        		data.setProperty(numRows - 1, 1, 'style', 'background-color: #548235; color: white; text-align: center;');

			for (var i = 0; i < numRows-1; i++) {
          			data.setProperty(i, 1, 'style', 'text-align: center;');
        		}
  
        		var table = new google.visualization.Table(document.getElementById('chart_div6'));

			var cssClassNames = {
          			headerRow: 'green-background'
        		};

			 var options = {
          			showRowNumber: false,
         			width: '100%',
          			height: '100%',
          			cssClassNames: cssClassNames,
				allowHtml: true
        		};

        		table.draw(data, options);
		}

		google.charts.load('current', {'packages':['table']});
    		google.charts.setOnLoadCallback(drawChart7);

    		function drawChart7() {
        		var data = new google.visualization.DataTable();
        		data.addColumn('string', 'Mês/Ano');
        		data.addColumn('string', 'N° Cirurgias');
			data.addColumn('string', '%');
        		data.addRows([
          			['mar/23', '65', '12,85%'],
				['abr/23', '52', '13,20%'],
				['mai/23', '77', '14,39%'],
				['jun/23', '58', '12,53%'],
				['jul/23', '50', '9,33%'],
				['ago/23', '57', '11,73%'],
				['set/23', '42', '9,77%'],
				['out/23', '64', '14,00%'],
				['nov/23', '66', '13,81%'],
				['dez/23', '41', '10,85%'],
				['jan/23', '62', '12,60%'],
				['fev/23', '52', '12,71%']
          		]);

                	data.addRow(['TOTAL', '686', '12,33%']);

			var numRows = data.getNumberOfRows();
        		data.setProperty(numRows - 1, 0, 'style', 'background-color: #548235; color: white;');
        		data.setProperty(numRows - 1, 1, 'style', 'background-color: #548235; color: white; text-align: center;');
			data.setProperty(numRows - 1, 2, 'style', 'background-color: #548235; color: white; text-align: center;');

			for (var i = 0; i < numRows-1; i++) {
          			data.setProperty(i, 1, 'style', 'text-align: center;');
				data.setProperty(i, 2, 'style', 'text-align: center;');
        		}
  
        		var table = new google.visualization.Table(document.getElementById('chart_div7'));

			var cssClassNames = {
          			headerRow: 'green-background'
        		};

			 var options = {
          			showRowNumber: false,
         			width: '100%',
          			height: '100%',
          			cssClassNames: cssClassNames,
				allowHtml: true
        		};

        		table.draw(data, options);
		}

		google.charts.load('current', {'packages':['table']});
    		google.charts.setOnLoadCallback(drawChart8);

    		function drawChart8() {
        		var data = new google.visualization.DataTable();
        		data.addColumn('string', 'N° Cirurgias');
        		data.addColumn('string', 'Média de Dias na UTI');
        		data.addRows([
          			['4', '2']
          		]);
		
			var numRows = data.getNumberOfRows();

			for (var i = 0; i < numRows; i++) {
				data.setProperty(i, 0, 'style', 'text-align: center;');
          			data.setProperty(i, 1, 'style', 'text-align: center;');
        		}

			var cssClassNames = {
          			headerRow: 'green-background'
        		};
  
        		var table = new google.visualization.Table(document.getElementById('chart_div8'));

			 var options = {
          			showRowNumber: false,
         			width: '100%',
				height: '20%',
				cssClassNames: cssClassNames,
  				allowHtml: true
        		};

        		table.draw(data, options);
		}


		google.charts.load('current', {'packages':['table']});
    		google.charts.setOnLoadCallback(drawChart9);

    		function drawChart9() {
        		var data = new google.visualization.DataTable();
        		data.addColumn('string', 'Com Matmed e Honorário');
        		data.addColumn('string', 'Sem Matmed e Honorário');
        		data.addRows([
          			['R$3.435,65', 'R$2.757,20',],
          		]);

			var numRows = data.getNumberOfRows();
    
			for (var i = 0; i < numRows; i++) {
				data.setProperty(i, 0, 'style', 'text-align: right;');
          			data.setProperty(i, 1, 'style', 'text-align: right;');
        		}
			
			var cssClassNames = {
          			headerRow: 'green-background'
        		};
  
        		 var table = new google.visualization.Table(document.getElementById('chart_div9'));

			 var options = {
          			showRowNumber: false,
         			width: '100%',
          			height: '50%',
				cssClassNames: cssClassNames,
				allowHtml: true
        		};

        		table.draw(data, options);

			var thElements = document.querySelectorAll('.google-visualization-table-th');
			thElements.forEach(function(element) {
    				element.classList.remove('gradient');
			});
		}


		$(window).resize(function(){
		  drawChart1();
		  drawChart2();
		  drawChart3();
		  drawChart5();
	          drawChart6();
		  drawChart7();
		  drawChart8();
 		  drawChart9();
		});					
	</script> 
	<!-- FIM DIV TUDO -->
</div>

<script>


   function setup(modalId){
	var modal = document.getElementById(modalId);
	
	if(modalId == 'videoModal1'){
		var iframeSrc = 'http://intranet.unimedpinda.com.br/coop_2/videos/diretoria.mp4';

	}else if(modalId == 'videoModal2'){
		var iframeSrc = 'http://intranet.unimedpinda.com.br/coop_2/videos/fiscal.mp4';

	}else{
		var iframeSrc = 'http://intranet.unimedpinda.com.br/coop_2/videos/adm.mp4';

	}

   	var videoFrame = modal.querySelector('iframe');
   	var closeModal = modal.querySelector('.close');
   	//var iframeSrc = videoFrame.src; 

	// Event listener para fechar o modal clicando no botão fechar
  	closeModal.addEventListener('click', closeModalAndPauseVideo);

  	// Event listener para fechar o modal clicando fora do modal
  	window.addEventListener('click', function(event) {
    		if (event.target === modal) {
      			closeModalAndPauseVideo();
    		}
  	});

  	// Função para abrir o vídeo
  	function openModal() {
    		videoFrame.src = iframeSrc;
    		modal.style.display = 'block';
  	}

  	// Fechar o modal e pausar o vídeo
  	function closeModalAndPauseVideo() {
    		var video = videoFrame.contentWindow.document.querySelector('video');
    		video.pause();
    		modal.style.display = 'none';
  	}

	openModal();

   }

  // Event listener para abrir o vídeo
  var openVideoLinks = document.querySelectorAll('[data-toggle="modal"]');
  openVideoLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            var targetModalId = this.getAttribute('data-target').replace('#', ''); // Obtém o id do modal alvo
	    setup(targetModalId)
        });
    });

</script>