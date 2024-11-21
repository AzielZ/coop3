<?php
	  	include("valida_usuario.php");
        valida_usuario('DEM_PAG');
?>

<link rel="shortcut icon" href="img/favicon.png">
<div class="tudo">
<div class="topo">
<?php 
  include_once('header.php'); 
  include_once('funcoes.php');
?>
</div>

<!--INICIO HOME-->
<div class="conteudo">
	<style>
	body{
		height:100%;
		width:100%;
		background: url(img/background.png) no-repeat center center; }
	</style>
	<div class="container theme-showcase" role="main">
	    <div class="row vertical-offset-100">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-success">
					<div class="panel-heading">
			            <h2 class="panel-title"> Demonstrativo Pró-labore</h2>
					</div>
					<div class="panel-body">
						<div class="table-condenssed">  
						<table class="table table-condensed table-hover" id="datatable">
							<thead>
								<tr>
									<th>Período</th>
									<th></th>
								</tr>
							</thead>
							<tbody>

							<?php 
							
								$resultado = retornalinhas($_SESSION["cdfuncionario"],"17");
								if(OCIExecute($resultado)){
									$cont = 0;
									while(OCIFetch($resultado)){
											$cont++;
											echo "  <tr>";
											echo "	  <td>".OCIResult($resultado,2)."</td>";
											echo "	  <td class='last-td'>";
											echo '	  <a class="btn btn-success btn-sm" href="pdfs/prolabore/'.OCIResult($resultado,1).'" target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>';
											echo "	  </td>";
											echo "	</tr>";}}
							?>
							</tbody>
						</table>
						</div>
					</div>
				</div>   
			</div>
		</div>
	</div>
</div>
<!--FIM HOME-->   
<div class="rodape">
<?php 
  include_once('footer.php');?>
</div>
            
</div>