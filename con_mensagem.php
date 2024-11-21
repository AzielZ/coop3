<?php
	  	include("valida_usuario.php");
        	valida_usuario('CON_MEN');

		if($_SESSION["valida"] != 1){
			header("Location:http://intranet.unimedpinda.com.br/coop/redireciona_coop.php");
			session_destroy();
		}

		if($_SESSION["senha"] == 'C0OP@M#D'){
			header("Location:http://intranet.unimedpinda.com.br/coop/home.php");

		}

?>

<link rel="shortcut icon" href="img/favicon.png">
<div class="tudo">
<?php 
  include_once('header.php'); 
  include_once('funcoes.php');
?>

<!--INICIO HOME-->
<div class="conteudo">


        <!-- Modal RESPONSAVEL PELA CAIXA DE DIALOGO -->
       <div id="confirm-delete" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel" style="color:black">Confirmar Atualização</h4>
            </div>
            <div class="modal-body" style="color:black">
              Ocorreram alterações desde a última vez em que você esteve aqui. Deseja atualizar a página?
            </div>

            <div align="right">
              <table>
                <thead>
                  <tr>
                    <th>
                     <button type="button" class="btn btn-default margem" data-dismiss="modal"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Cancelar</button>
                     <a class="btn btn-success margem btn-ok" href='http://intranet.unimedpinda.com.br/coop/con_mensagem.php'><span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Atualizar</a>
                   </th>
                 </tr>
               </thead>
             </table>
             <br>
           </div>
         </div>
       </div>
       </div>
       <!-- Fim Modal RESPONSAVEL PELA CAIXA DE DIALOGO -->
	   
	   
	<div class="container theme-showcase" role="main">
				<div class="panel panel-success">
					<div class="panel-heading">
			            <h2 class="panel-title"> Mensagens disponíveis:</h2>
					</div>
					<div class="panel-body">
						<div class="table-condenssed table-responsive">  
						<table class="table table-condensed table-hover" id="datatable">
							<thead>
								<tr>
									<th>Lida</th>
									<th>Data de Postagem</th>
									<th>Mensagem</th>
									<th>Anexo</th>
								</tr>
							</thead>
							<tbody>

							<?php 
								$resultado = mensagem($_SESSION["cdfuncionario"],$_SESSION["grupo"]," ","1");
								if(OCIExecute($resultado)){
									$cont = 0;
									while(OCIFetch($resultado)){
											$cont++;
											$id_mensagem = OCIResult($resultado,1);
											$lida = OCIResult($resultado,6);
											
											if ($lida == null){
											echo "  <tr>";
											echo "	  <td align='center'></td>";  
											echo "	  <th>".OCIResult($resultado,4)."</th>";    
											echo "	  <th><b><u>".OCIResult($resultado,2)."</u></b>:<br> ".OCIResult($resultado,3)."</th>";    
											echo "	  <td class='last-td' align='center'>";
											echo "		<form method='POST' action='atu_mensagem.php' target='_blank'>";
											echo "		<input type='hidden' name='id_mensagem' value='$id_mensagem'>";
											echo "		<button type='submit' class='btn btn-success btn-sm' data-toggle='modal' data-target='#confirm-delete'><span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span></button>";
											echo "		</form>";
											echo "	  </td>";
											echo "	</tr>";
											
											}else{
											echo "  <tr>";
											echo "	  <td align='center'><span class='glyphicon glyphicon-ok verde' aria-hidden='true'></span></td>";  
											echo "	  <td>".OCIResult($resultado,4)."</td>";    
											echo "	  <td><u>".OCIResult($resultado,2)."</u>:<br> ".OCIResult($resultado,3)."</td>";   
											echo "	  <td class='last-td' align='center'>";
											echo "		<form method='POST' action='atu_mensagem.php' target='_blank'>";
											echo "		<input type='hidden' name='id_mensagem' value='$id_mensagem'>";
											echo "		<button type='submit' class='btn btn-success btn-sm' data-toggle='modal' data-target='#confirm-delete'><span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span></button>";
											echo "		</form>";
											echo "	  </td>";
											echo "	</tr>";
											};
									};
											
								};
							?>
							</tbody>
						</table>
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
    }
  } );

} );
</script>

  <script type="text/javascript">
    $(document).ready(function() {
        $('#confirma').modal();
    });

    $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  </script>


<!--FECHA DIV TUDO -->      
</div>