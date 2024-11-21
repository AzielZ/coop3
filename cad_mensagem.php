<?php
	include("valida_usuario.php");
        valida_usuario('CAD_MEN');

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
			<li class="active"><a href="#tab1" data-toggle="tab"><b><font size="3" color="#006600"><span class="glyphicon glyphicon-plus"></span> Cadastrar</font></b></a></li>
			<li><a href="#tab2" data-toggle="tab"><b><font size="3" color="#006600"><span class="glyphicon glyphicon-pencil"></span> Consulta</font></b></a></li>
  </ul>
  <div class="tab-content">
  
      <div class="tab-pane active" id="tab1">
	  
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">PARA CADASTRAR UMA MENSAGEM, PREENCHA O FORMULÁRIO COM OS DADOS SOLICITADOS</h3>
            </div>
              <div class="panel-body" id="conteudo">

                <div>
                  
                  <div class="row">

                    <div class="col-xs-6 col-md-6">
                      <br>Grupo de Prestador:<br>
                        <input class="form-control" id="gPrestador" name="gprestador" value="SAMC" disabled >
                    </div>

                    <div class="col-xs-6 col-md-6">
                      <br>Data Fim (Validade):<br>
                      <input type="date" placeholder="Ex: 31/12/2016" id="dataFim" class="form-control" name="validade">
                    </div>
					
		  </div>
				  
				  <div class="row">
				  
                    <div class="col-xs-6 col-md-12">
                      <br>Assunto:<br>
                      <input type="text" id="assunto" placeholder="Ex: Reunião Mensal" id="assunto" class="form-control" name="assunto" maxlength="90">
                    </div>

                  </div> 

				  <div class="row">
				  
                    <div class="col-xs-6 col-md-12">
                      <br>Mensagem:<br>
                      <textarea cols="40" rows="5" class="form-control" id="mensagem" name="mensagem" maxlength="750"></textarea>
                    </div>

                  </div> 
				  
				  <div class="row">
				  
                    <div class="col-xs-6 col-md-12">
                      <br>Anexo:<br>
                      <input class="form-control input-lg" type="file" id="anexo" name="file">
                    </div>

                  </div> 

				  <div class="row">
				  
                    <div class="col-xs-6 col-md-12">
		      <button type="submit" style="margin-top: 40px;" class="btn btn-success" name="enviar" onclick="ajaxArquivo()">Cadastrar</button>
                      <button style="margin-top: 40px;" class="btn btn-default" name ="limpar" onclick="limpaCampos()">Limpar</button>
                    </div>

                  </div> 				  
                     
                </div>	
				
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
				
				
				
              </div>
            </div>
</div>
	
	
	
	    <div class="tab-pane" id="tab2">
     <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title">PARA CONSULTAR DE FORMA PRATICA USE O CAMPO DE PEQUISA</h3>
        </div>
        <div class="panel-body" id="conteudo">

        <!-- Modal RESPONSAVEL PELA CAIXA DE DIALOGO -->
       <div id="confirm-delete" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel" style="color:black">Confirmação</h4>
            </div>
            <div class="modal-body" style="color:black">
              Deseja realmente remover o registro?
            </div>

            <div align="right">
              <table>
                <thead>
                  <tr>
                    <th>
                     <button type="button" class="btn btn-default margem" data-dismiss="modal"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Cancelar</button>
                     <a class="btn btn-success margem btn-ok"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Confirmar</a>
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

          <div class="table-responsive">  
            <table class="table table-hover" id="datatable">
              <thead>
                <tr>
                <th>Cod.</th>
                <th>Grupo</th>
				<th>Assunto</th>
				<th>Funcionario</th>
				<th>Ini. Val.</th>
				<th>Fim. Val.</th>
				<th>Anexo</th>
                <!-- <th>Remover</th> -->
                </tr>
              </thead>
              <tbody>
			  
							<?php 
								$resultado = retornalinhas($_SESSION["cdfuncionario"],"15");
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
													<td>".OCIResult($resultado,5)."</td>
													<td>".OCIResult($resultado,6)."</td>
													<td>".OCIResult($resultado,7)."</td>
													<td>".OCIResult($resultado,8)."</td>
													<!-- <td class='last-td'>
														<button class='btn btn-danger btn-sm' data-href='exc_sinistralidade.php?id=$id' data-toggle='modal' data-target='#confirm-delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>
													</td> -->
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
        "sSortAscending": ": Ordenar colunas de forma descendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  });

});
</script>

<!-- Máscara para datas, telefones e senhas -->
    <script language="JavaScript" type="text/javascript" src="js/jquery.maskMoney.min.js"></script>

    <script language='JavaScript'>
      $(function($) {
      $('#mascara1').maskMoney();
    })
    </script>
	
    <script type="text/javascript">
	
	/*$(document).ready(function() {
    		$('#confirma').modal();
    	});*/
	
    	$('#confirm-delete').on('show.bs.modal', function(e) {
      		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    	});
  </script>
  
</div>

<script>

	function ajaxArquivo(){

		var dataFim = $('#dataFim').val();
		var dataFormatada = dataFim.split('-').reverse().join('/');
		var assunto = $('#assunto').val();
		var mensagem = $('#mensagem').val();
		var anexo = $('#anexo').val();

		infos = new FormData();

		infos.append('ASSUNTO', $('#assunto').val());
		infos.append('MENSAGEM', $('#mensagem').val());
		infos.append('DATAFIM', dataFormatada);
		infos.append('FILE', $('#anexo')[0].files[0]);
		infos.append('USUARIO', '<?php echo $login = strtoupper($_SESSION["cdfuncionario"]) ?>');


		if(dataFim != "" && assunto != "" && mensagem != "" && anexo != ""){

		  $.ajax({
    			url: 'enviarArquivos.php',
   			type: 'POST',
    			data: infos,
			processData: false,
			contentType: false,
			enctype: 'multipart/form-data',
    			success: function(result){	
	
				console.log(result);

				if(result.length == 1){

					Swal.fire({
  					  icon: 'success',
  					  title: 'Cadastro',
  					  text: 'Item cadastrado com sucesso',
					  showConfirmButton: false,
  					  timer: 3000,
					  width: '600px' 
					});
					
					setTimeout(function() {
					  window.location.reload();
       					}, 3000);
		
				}else{

					if(result != 4){
						Swal.fire({
  					 	  icon: 'error',
  					 	  title: 'Cadastro',
  					 	  text: 'Verifique se assunto ou anexo já foram cadastrado. Para fazer isso clique em consulta.',
					  	  showConfirmButton: false,
  					  	  timer: 3000,
					  	  width: '600px' 
						});

						var table = $('#datatable').DataTable();
    						var valor_padrao = assunto;
						$('input[type="search"').val(valor_padrao);
    						table.search(valor_padrao).draw();	
					}else{
						Swal.fire({
  					 	  icon: 'error',
  					 	  title: 'Cadastro',
  					 	  text: 'Verifique a extensão do arquivo, só é aceito PDF',
					  	  showConfirmButton: false,
  					  	  timer: 3000,
					  	  width: '600px' 
						});
					}					
				}
				
         		},
   			error: function(err) {
				console.log('Erro ao enviar');
     			}
		});



		}else{
			Swal.fire({
  				icon: 'warning',
  				title: 'Cadastro',
  			  	text: 'Preencha todos os campos',
				showConfirmButton: false,
  				timer: 3000,
				width: '600px' 
			});

		}
	}

	function limpaCampos(){

		$('#assunto').val("");
		$('#mensagem').val("");
		$('#dataFim').val("");
		$('#anexo').val("");

		var table = $('#datatable').DataTable();
		$('input[type="search"').val("");
    		table.search("").draw();


	}	

</script>