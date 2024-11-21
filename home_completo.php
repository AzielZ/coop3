<?php
	  	include("valida_usuario.php");
        valida_usuario('HOM_COO');
?>

<link rel="shortcut icon" href="img/favicon.png">
<div class="tudo">
<?php 
  include_once('header.php'); 
  include_once('funcoes.php');
?>
<!--INICIO HOME-->
<div class="conteudo">

<!--INICIO CONTAINER-->
	<div class="container">

<style>
#div1 { float: left; }
#div2 { float: right; }
#div3 { clear: both;}
</style>
	
<!--INICIO MENSAGEM DEMONSTRATIVO
<?php
	  $resultado = retornalinhas($_SESSION["cdfuncionario"],"6");
      if(OCIExecute($resultado)){
             
		$cont = 0;
		 while(OCIFetch($resultado)){
			 if ($cont == 0){
				 echo '<div class="row"><div class="container">
					  <div class="col-md-12">
					  <div class="alert alert-danger alert-dismissible fade in" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					  <h4>ATENÇÃO</h4>'; 
							 };
			$cont++;
			echo '<p>'.OCIResult($resultado,2).'</p>';
		 };
   	    if ($cont > 0) {echo '</div></div></div></div>';};};
?>
FIM MENSAGEM DEMONSTRATIVO-->



<!--INICIO MODAL DE MENSAGENS-->
<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Você possui novas mensagens!</h4>
      </div>
      <div class="modal-body">
        <p>Olá, que tal dar uma olhada na caixa de mensagens? Existem mensagens que ainda não foram lidas.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Não, obrigado!</button>
        <a href='http://intranet.unimedpinda.com.br/coop/con_mensagem.php'><button type="button" class="btn btn-success">Vamos ver!</button></a>
      </div>
    </div>
  </div>
</div>
<!--INICIO MODAL DE MENSAGENS-->



		<div class="row"> <!-- Inicio ROW -->

			<div class="col-md-3"> <!--INICIO BENEFICIARIOS ATIVOS-->
				<div class="alert alert-success alert-dismissible fade in" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

				  <h4 class="panel-title"><b>BENEFICIÁRIOS ATIVOS</b></h4>
 				  <?php $resultado = retornalinhas("0","2");
					  if(OCIExecute($resultado)){
						 $cont = 0;
						 while(OCIFetch($resultado)){
							$cont++;
						 echo '<p>'.OCIResult($resultado,1).'</p>';
						 if (OCIResult($resultado,2) != 100 ) {
						 echo '<div class="progress">';
						 echo '<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="'.OCIResult($resultado,2).'" style="width: 0%">';
						 echo '<span class="sr-only">20% Complete</span></div>'.OCIResult($resultado,3).'</div>';
					  }}}
				  ?>
				</div>
				
				<div class="alert alert-success alert-dismissible fade in" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

				  <h4 class="panel-title"><b>CAPITAL SOCIAL:</b></h4>
 				  <?php $resultado = retornalinhas($_SESSION["cdfuncionario"],"13");
					  if(OCIExecute($resultado)){
						 $cont = 0;
						 while(OCIFetch($resultado)){
							$cont++;
						 echo '<br>';
						 echo '<p> <b>Ano:</b> '.OCIResult($resultado,1).'</p>';
						 echo '<p> <b>Saldo Atual:</b> '.OCIResult($resultado,3).'</p>';
						 echo '<p> <b>Saldo Anterior:</b> '.OCIResult($resultado,4).'</p>';
						 echo '<p> <b>Percentual:</b> '.OCIResult($resultado,5).'%</p>';
						 }}
						 if ($cont == 0){echo '<br><tr><td>Não há dados</td></tr>';};
						 
				  ?>
				</div>
			</div>	<!--FIM BENEFICIARIOS ATIVOS-->

		
			<div class="col-md-3"> <!--INICIO ANIVERSARIO-->
				<div class="alert alert-success alert-dismissible fade in" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				  <h2 class="panel-title"><b>ANIVERSARIANTES DO MÊS</b></h2>
					<?php $resultado = retornalinhas("0","1");
						  if(OCIExecute($resultado)){
							 $cont = 0;
							 while(OCIFetch($resultado)){
								$cont++;
								echo "<b><p>".OCIResult($resultado,2)." -  </b>".OCIResult($resultado,1)."</p>";
							 }}
						  if ($cont == 0){echo '<tr><td>Não há dados</td></tr>';};
					?> 
				</div>
			</div> <!--FIM ANIVERSARIO-->

			<div class="col-md-6"> <!--INICIO INDICADOR DE PRODUÇÃO MÉDICA -->
				<div class="panel panel-success">
					<div class="panel-heading">
					<h2 class="panel-title"><b>PRODUÇÃO MÉDICA POR CONTRATAÇÃO</b></h2>
					<Font Size=1><b>Definição: </b> Trata-se dos serviços médicos prestados à beneficiários locais e de outras operadoras. Pré-Pagamento são os contratos com mensalidade. Custo Operacional são os contratos que pagam pelos serviços prestados. Intercâmbio são os beneficiários de outras singulares e pagam pelo serviços prestados.</font>
					</div>
					<div class="panel-body">
						<div class="table-condenssed">  
							<?php $resultado = retornalinhas($_SESSION["cdfuncionario"],"10");
								  if(OCIExecute($resultado)){
									 $cont = 0;
									 while(OCIFetch($resultado)){
										 
									  $cont++;
									  echo "<div class='text-xs-center' id='example-caption-6'><b>Mês:</b> ".OCIResult($resultado,9)." - <b>Período:</b> ".OCIResult($resultado,1)." - <b>Valor Total:</b>R$".OCIResult($resultado,5)."</div>
											<div class='progress'>
											<div class='progress-bar progress-bar-success progress-bar-striped' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='".OCIResult($resultado,7)."' style='width: 0%'>
												<span>R$".OCIResult($resultado,3)."</span>
											</div>
											<div class='progress-bar progress-bar-warning progress-bar-striped' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='".OCIResult($resultado,6)."' style='width: 0%'>
												<span>R$".OCIResult($resultado,2)."</span>
											</div>
											<div class='progress-bar progress-bar-danger progress-bar-striped' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='".OCIResult($resultado,8)."' style='width: 0%'>
												<span>R$".OCIResult($resultado,4)."</span>
											</div>
											</div>";
											}}
									  if ($cont == 0){echo '<tr><td>Não há dados</td></tr>';};
							?> 
							<span class="label label-success">Pré-Pagamento</span>
							<span class="label label-warning">Custo Operacional</span>
							<span class="label label-danger">Intercâmbio</span>
						</div>										
					</div>
				</div> 
			</div> <!--FIM INDICADOR DE PRODUÇÃO MÉDICA -->
		</div> <!-- Fim ROW -->

	    <!--Inicio Indicadores Matriz Gerencial-->
		<?php $resultado = retornalinhas($_SESSION["cdfuncionario"],"3");
		      if(OCIExecute($resultado)){
				  $contador = 0;
				while(OCIFetch($resultado)){
					
					if($contador % 2 == 0){
						echo '<div class="row">  <!--INICIO ROW INDICADORES -->'; //Inicio do Row
					};
					
   			        $resultadon = indicadorecom($_SESSION["cdfuncionario"],"1",OCIResult($resultado,1));
						 if(OCIExecute($resultadon)){
						   $cont = 0;
						   while(OCIFetch($resultadon)){
							if ($cont == 0) {
								echo '<div class="col-md-6"> 
										<div class="panel panel-success">
											<div class="panel-heading">
												<h2 class="panel-title"><b> '.OCIResult($resultado,2).'</b></h2>
												<h2 class="panel-title"><div id="div1"><b>Comp.:</b> '.OCIResult($resultadon,16).'</div> <div id="div2">';
												if (OCIResult($resultado,1) == 999999){
								           	      echo '</div> </h2>';
								                } else {
												  echo '<b>Limite:</b>'.OCIResult($resultadon,10).'</div> </h2>';
												};
								echo 		   '<div id="div3">
												<th><Font Size=1><b>Definição: </b> '.OCIResult($resultado,6).'</font></th>
												</div>
											</div>

											<div class="panel-body">
												<div class="table-condenssed">  
												<table class="table table-hover "> 
												<thead>
												  <tr>';
								if (OCIResult($resultado,1) == 999999){
									echo '<th><Font Size=2>Indicador</font></th>';
								} else {
									echo '<th><Font Size=2>Prestador</font></th>';
								};	
													
								echo 			'<th><Font Size=2>'.OCIResult($resultado,5).'</font></th>
													<th><Font Size=2>'.OCIResult($resultado,3).'</font></th>
													<th><Font Size=2>'.OCIResult($resultado,4).'</font></th>
												  </tr>
												</thead>
												<tbody>';								 
							};   
						   $cont++;
						   echo '<tr>';
						   echo '<td>'.OCIResult($resultadon,14).OCIResult($resultadon,5).OCIResult($resultadon,15).'</td>';
						   echo '<td>'.OCIResult($resultadon,14).'<center>'.OCIResult($resultadon,8).'</center>'.OCIResult($resultadon,15).'</td>';
						   echo '<td>'.OCIResult($resultadon,14).'<center>'.OCIResult($resultadon,6).'</center>'.OCIResult($resultadon,15).'</td>';
						   echo '<td>'.OCIResult($resultadon,14).'<center>'.OCIResult($resultadon,7).'</center>'.OCIResult($resultadon,15).'</td>';
						   echo '</tr>';
						   }}				  
						 if ($cont == 0){echo '<div class="col-md-6"> 
												<div class="panel panel-success">
													<div class="panel-heading">
														<h2 class="panel-title"><b> '.OCIResult($resultado,2).' </b></h2>
														<th><Font Size=1><b>Explicação: </b>'.OCIResult($resultado,6).'</font></th>
													</div>
													<div class="panel-body">
														<div class="table-condenssed">  
														<table class="table table-hover "> 
														<thead>
														  <tr>';
 										 if (OCIResult($resultado,1) == 999999){
										 	 echo '<th><Font Size=2>Indicador</font></th>';
										 } else {
											 echo '<th><Font Size=2>Prestador</font></th>';
										 };	
										 echo '  			<th><Font Size=2>'.OCIResult($resultado,5).'</font></th>
															<th><Font Size=2>'.OCIResult($resultado,3).'</font></th>
															<th><Font Size=2>'.OCIResult($resultado,4).'</font></th>
														  </tr>
														</thead>
														<tbody> 
														<tr><td>Não há dados</td></tr>';};
						echo '		</tbody>
							  </table> 
								</div>
							</div>
						</div> 
					</div>';
					if($contador % 2 != 0){
						echo '</div><!--FIM ROW INDICADORES -->';	};
				    $contador++;
			  };
				if($contador % 2 != 0){echo '</div><!--FIM ROW INDICADORES -->';};	
			};?>
	<!--Fim Indicadores Matriz Gerencial-->
	
	</div>
	<!--FIM CONTAINER-->

</div>
<!--FIM HOME-->  
  
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
	

			  <?php
 				      $resultado = mensagem($_SESSION["cdfuncionario"]," "," ","2");
					  if(OCIExecute($resultado)){
						 while(OCIFetch($resultado)){
							$aux = OCIResult($resultado,1);
							if($aux > 0){
							echo "  <script type='text/javascript'>
									$(document).ready(function() {
									$('#myModal').modal('show');
									});
							</script>";}
							};}; 			 
              ?>

<!-- INICIO CARREGA MODAL -->

<!-- FIM CARREGA MODAL -->

	
	
	
	
</div>