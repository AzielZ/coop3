<?php
	  	include("valida_usuario.php");
        	valida_usuario('HOM_ADM');

		if($_SESSION["valida"] != 1){
			header("Location:http://intranet.unimedpinda.com.br/coop/redireciona_coop.php");
			session_destroy();
		}

?>

<link rel="shortcut icon" href="img/favicon.png">
<div class="tudo">
<?php 
  include_once('header_admin.php'); 
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
	
		<div class="row"> <!-- Inicio ROW -->

			<div class="col-md-3"> <!--INICIO BENEFICIARIOS ATIVOS-->
				<div class="alert alert-success alert-dismissible fade in" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				  <h4>Beneficiários Ativos!</h4>
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
			</div>	<!--FIM BENEFICIARIOS ATIVOS-->

		
			<div class="col-md-3"> <!--INICIO ANIVERSARIO-->
				<div class="alert alert-success alert-dismissible fade in" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				  <h4>Aniversariante(s) do Mês!</h4>
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
		</div> <!-- Fim ROW -->

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
	
</div>