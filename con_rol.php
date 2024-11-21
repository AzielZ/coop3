<?php
	include("valida_usuario.php");
        valida_usuario('CON_MEN');

	if($_SESSION["valida"] != 1){
			header("Location:http://intranet.unimedpinda.com.br/coop/redireciona_coop.php");
		session_destroy();
	}
?>
<link rel="shortcut icon" href="img/favicon.png">

<!-- SweetAlert 2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<div class="tudo">
<?php 
  include_once('header.php'); 
  include_once('funcoes.php');
?>
<!--INICIO HOME-->
<div class="conteudo">

  <style>
    #conteudo {
      background: #f2f2f2;
 
    }

    #search{
	margin-bottom: 15px;
	width: 80%;

	border: 1px solid #3c763d;
	border-radius: 5px;
    }

    #diretrizes{
	color: red;
    }

    .bolinha {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
            margin-left: 5px;
     }

     .bolinha-verde {
           background-color: green;
     }

     .bolinha-vermelha {
           background-color: red;
     }

     .espacamento{
	margin: 0 10px;

     }
	
     body {
	overflow-x: hidden;
     }

      @media (max-width: 510px) {
	.total, .origem, .executora, .qtd, .tp_tabela, .classificacao{
		display: none;
	}

	/*.tabbable{
		margin: 0;
		width: 95%;
	}*/

	.mobile{
		font-size: 12px;
	}

	.contMobile{
		font-size: 10px;
	}

	.bolinha{
		width: 15px;
            	height: 15px;
	}
	
	.cob{
		font-size: 12px;
	}

	#cobOrNot{
		flex-direction: column;
		margin-right: 40px;
	}

 	#search{
		width: 100%;
	}

      }	
  </style>
  
	<!--INICIO CONTAINER-->
    <div class="container theme-showcase" role="main" style="padding-top: 50px;">

<div style="display:flex;justify-content: space-between; ">
	<div style="width: 40%">
		<label style="color: #006600;">Consulte aqui: </label>
		<input type="text" id="search" oninput="atualizaPesquisa(this.value);"/>
	</div>

	<div id='cobOrNot' style="display: flex;">
		<div style="display: flex;">
		  <div class='bolinha bolinha-verde espacamento'></div>
		  <label class='cob'>Cobertos</label>
		</div>

		<div style="display: flex;">
		  <div class='bolinha bolinha-vermelha espacamento'></div>
		  <label class='cob'>Não Cobertos</label>
		</div>
	</div>
</div>
            
<div class="tabbable"> <!-- Only required for left/right tabs -->
   <div class="tab-content">
  
      <div class="tab-pane active" id="tab1">
	  
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">ROL - PROCEDIMENTOS</h3>
            </div>
              <div class="panel-body" id="conteudo">
				
		<?php 

          if (isset($_POST["enviar"]))
          {
            $periodo    = $_POST["periodo"];
            $valor      = $_POST["valor"];
	    $login	= strtoupper($_SESSION["cdfuncionario"]);

			$resultado = sinistralidade($login, $periodo, $valor, "1");

			oci_execute($resultado, OCI_COMMIT_ON_SUCCESS);							
            echo '
             <div id="confirma" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color:black">Aviso</h4>
                  </div>
                  <div class="modal-body" style="color:black">
                    <p>Cadastro realizado com sucesso.</p>
                  </div>

                  <div align="center">
                    <table>
                      <thead>
                        <tr>
                          <th>
                           <button type="button" class="btn btn-primary margem" data-dismiss="modal"></span>OK</button>
                         </th>
                       </tr>
                     </thead>
                   </table>
                   <br>
                 </div>
               </div>
             </div>
             </div>
              ';
		  }
        ?>

		<div class="table-responsive">  
            <table class="table table-hover" id="datatable">
              <thead>
                <tr>
			<th></th>
                	<th class='mobile'>Código</th>
			<th class='mobile tp_tabela'>TISS Tipo Tabela</th>
			<!-- <th>Código TISS</th> -->
			<th class='mobile'>Descrição</th>
			<th class='classificacao'>Classificação</th>
			<th class='qtd'>QTD</th>
			<th class='mobile'>Racionalização</th>
			<th class='executora'>Executora</th>  
			<th class='origem'>Origem</th>
			<th class='total'>Total</th>             
                </tr>
              </thead>
              <tbody>
			  
	<?php 

	  function removerAcentos($str) {
    		$acentos = array('á', 'à', 'â', 'ã', 'ä', 'é', 'è', 'ê', 'ë', 'í', 'ì', 'î', 'ï', 'ó', 'ò', 'ô', 'õ', 'ö', 'ú', 'ù', 'û', 'ü', 'ç', 'ñ');
    		$naoAcentos = array('a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'c', 'n');

    		$str = str_replace($acentos, $naoAcentos, $str);
    		return $str;								
	  }

	  function contemANS($str) {
    		return (stripos($str, 'ANS nº') !== false or stripos($str, 'ANS - nº') !== false);
	  }

	  $resultado = rol();
	  if(OCIExecute($resultado)){
		while(OCIFetch($resultado)){
			$status = OCIResult($resultado, 1);
			$contemAns = OCIResult($resultado, 5);

        		echo "<tr>";

        		if ($status == 'COBERTOS') {
            			echo "<th scope='row'><div class='bolinha bolinha-verde'></div></th>";
        		} else {
            			echo "<th scope='row'><div class='bolinha bolinha-vermelha'></div></th>";
        		}

       		 	echo "
            			<td class='contMobile'>" . removerAcentos(OCIResult($resultado, 2)) . "</td>
            			<td class='contMobile tp_tabela'>" . removerAcentos(OCIResult($resultado, 3)) . "</td>
            			<!-- <td>" . removerAcentos(OCIResult($resultado, 4)) . "</td> -->";
		
	    			if(contemANS($contemAns)){
					echo "<th class='contMobile'>".removerAcentos($contemAns)."<a id='diretrizes' href='http://intranet.unimedpinda.com.br/coop/anexos/DIRETRIZES%20DE%20UTILIZACAO%20ANS.pdf' target='_blank'> Diretrizes de Utilização</a></th>";
	    			}else{
					echo "<th class='contMobile'>".removerAcentos($contemAns)."</th>";
	    			}

				echo "
            				<td class='classificacao'>" . removerAcentos(OCIResult($resultado, 6)) . "</td>
            				<td class='qtd'>" . removerAcentos(OCIResult($resultado, 7)) . "</td>
            				<td class='contMobile'>" . removerAcentos(OCIResult($resultado, 8)) . "</td>
            				<td class='executora'>" . removerAcentos(OCIResult($resultado, 9)) . "</td>
            				<td class='origem'>" . removerAcentos(OCIResult($resultado, 10)) . "</td>
            				<td class='total'>" . removerAcentos(OCIResult($resultado, 11)) . "</td>
        			</tr>";			
		  }
	   }
	?>							
           </tbody>
          </table>
         </div>		
        </div>
       </div>
      </div>
	 	<!--FIM CONTAINER-->
    </div>
<!--FIM HOME-->  
  
<div class="rodape">
<?php 
  include_once('footer.php'); 
?>
</div>

<!-- PARA FUNCIONAR O DATATABLE -->
<script src="datatables/js/jquery.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
<script src="datatables/js/dataTables.bootstrap.min.js"></script>
<script src="datatables/js/moment.min.js"></script>
<script src="datatables/js/datetime-moment.js"></script>
<script>

  $(document).ready(function() {
  
    $.fn.dataTable.moment('DD-MM-YYYY');

    $('#datatable').dataTable({
      "language": {
      	"sEmptyTable": "Nenhum registro encontrado",
      	"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      	"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      	"sInfoFiltered": "(Filtrados de _MAX_ registros)",
      	"sInfoPostFix": "",
      	"sInfoThousands": ".",
      	"sLengthMenu": "_MENU_ Resultados por página",
      	"sLoadingRecords": "Carregando...",
      	"sProcessing": "Processando...",
      	"sZeroRecords": "Nenhum registro encontrado",
      	"sSearch": "Pesquisar",
      	"oPaginate": {
        	"sNext": "Próximo",
        	"sPrevious": "Anterior",
        	"sFirst": "Primeiro",
        	"sLast": "Último"
      	},
      	"oAria": {
        	"sSortAscending": ": Ordenar colunas de forma descendente",
        	"sSortDescending": ": Ordenar colunas de forma descendente"
      	}
    	}
    });
   });

</script>

<script>

	window.addEventListener('load', function() {

		var disabled1 = document.getElementById('datatable_filter');

		disabled1.style.display = 'none';

	 });

	function removerAcentos(str) {
    		return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
	}
	
	function atualizaPesquisa(valor){

		var nCobertos = document.getElementById('datatable_filter').children[0].children[0];

		nCobertos.value = removerAcentos(valor);

		var eventoInput = new Event('input');

		nCobertos.dispatchEvent(eventoInput);

	}
</script>


</div>

