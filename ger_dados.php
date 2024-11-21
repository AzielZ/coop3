<?php
	  	include("valida_usuario.php");
        	valida_usuario('CAD_SIN');

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

  <style>
    #conteudo {
      background: #f2f2f2;
 
    }
  </style>

	<!--INICIO CONTAINER-->
    <div class="container theme-showcase" role="main" style="padding-top: 50px;">
		
		<div class="tabbable"> <!-- Only required for left/right tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab"><b><font size="3" color="#006600"><span class="glyphicon glyphicon-repeat"></span> Processar</font></b></a></li>
			<li><a href="#tab2" data-toggle="tab"><b><font size="3" color="#006600"><span class="glyphicon glyphicon-time"></span> Histórico</font></b></a></li>
		</ul>
		<div class="tab-content">
		
		<div class="tab-pane active" id="tab1">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">PARA PROCESSAR UM PERÍODO, INFORME OS DADOS:</h3>
            </div>
              <div class="panel-body" id="conteudo">

                <form method="POST" action="ger_dados.php">
                  
                  <div class="row">

                    <div class="col-xs-6 col-md-9">
                      <br>Período:<br>
                      <input type="text" placeholder="Ex: 201701" class="form-control" name="periodo" maxlength="6" required>
                    </div>
					
                    <div class="col-xs-6 col-md-3">
					  <button type="submit" style="margin-top: 40px;" class="btn btn-success" name="enviar">Processar <span class="glyphicon glyphicon-ok"></span></button>
                      <button type="reset" style="margin-top: 40px;" class="btn btn-default" name ="limpar">Limpar <span class="glyphicon glyphicon-file"></button>
                    </div>

                  </div>                    
                     
                </form>
				
				
		<?php 

          if (isset($_POST["enviar"]))
          {
            $periodo    = $_POST["periodo"];
			$login		= strtoupper($_SESSION["cdfuncionario"]);

			$resultado = processar($login, $periodo, "1");

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
                           <button type="button" class="btn btn-success margem btn-ok" data-dismiss="modal"></span>OK</button>
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
				
				
				
              </div>
            </div>
		</div>
	
	
	
	<div class="tab-pane" id="tab2">
     <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title" >HISTÓRICO DE PROCESSAMENTO <b>(S</b> - SUCESSO, <b>P</b> - PROCESSANDO, <b>E</b> - ERRO<b>)</b>:</h3>
        </div>
        <div class="panel-body" id="conteudo">   

          <div class="table-responsive">  
            <table class="table table-hover" id="datatable">
              <thead>
                <tr>
                <th>Período</th>
                <th>Dt. Processamento</th>
                <th>Status</th>
				<th>Funcionário</th>
				<th>Observação</th>
                </tr>
              </thead>
              <tbody>
			  
							<?php 
								$resultado = retornalinhas($_SESSION["cdfuncionario"],"14");
								if(OCIExecute($resultado)){
									$cont = 0;
									while(OCIFetch($resultado)){
											$id = OCIResult($resultado,1);
											$cont++;
											echo("             
													<tr>
													<th scope='row'>".OCIResult($resultado,1)."</th>
													<td>".OCIResult($resultado,2)."</td>
													<td>".OCIResult($resultado,3)."</td>
													<td>".OCIResult($resultado,4)."</td>
													<td>".OCIResult($resultado,5)."</td>
													</tr>
											");
									}
								}
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
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    },
	 "order": [[ 1, "desc" ]]
  } );

} );
</script>

<!-- Máscara para datas, telefones e senhas -->
    <script language="JavaScript" type="text/javascript" src="js/jquery.maskMoney.min.js"></script>

    <script language='JavaScript'>
      $(function($) {
      $('#mascara1').maskMoney();
    })
    </script>
	
	<script type="text/javascript">
	
	$(document).ready(function() {
    $('#confirma').modal();
    });
	
    $('#confirm-reprocess').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  </script>
  
</div>