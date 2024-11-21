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

#div{
	display:flex;
	justify-content: flex-start;
	border: 2px solid #34975f;
	border-radius: 5px;
	width:60%;
	flex-direction: column;
    	align-items: center;
	gap: 20px;
	margin-top: 10%;
}

.container{
	display:flex;
	justify-content: center;
	height: 50%;
}

</style>

<!--INICIO MODAL DE MENSAGENS-->

<div id='div'>
	<h2>Demonstrativo temporariamente em Manutenção</h2>
	<h5>Para mais informações entrar em contato com o setor de REVISÃO DE CONTAS</h5>
</div>

<!--FIM CONTAINER-->
<!--FIM HOME-->  
  
<div class="rodape">
<?php 
  include_once('footer.php'); 
?>
</div>
    
<!-- INICIO PROGRESS BAR -->

<!-- INICIO CARREGA MODAL -->

<!-- FIM CARREGA MODAL -->
	
</div>