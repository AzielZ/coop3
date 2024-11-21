<?php
	  	include("valida_usuario.php");
        valida_usuario('CAD_SIN');
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
    <div class="container theme-showcase" role="main" style="padding-top: 50px;">
		
		<div class="tabbable"> <!-- Only required for left/right tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab"><b><font size="3" color="#006600"><span class="glyphicon glyphicon-plus"></span> Cadastrar</font></b></a></li>
			<li><a href="#tab2" data-toggle="tab"><b><font size="3" color="#006600"><span class="glyphicon glyphicon-pencil"></span> Manutenção</font></b></a></li>
		</ul>
		<div class="tab-content">
		
		<div class="tab-pane active" id="tab1">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">PARA CADASTRAR UMA SINISTRALIDADE, PREENCHA O FORMULÁRIO COM OS DADOS SOLICITADOS:</h3>
            </div>
              <div class="panel-body">

                <form method="POST" action="cad_sinistralidade.php">
                  
                  <div class="row">

                    <div class="col-xs-6 col-md-9">
                      <br>Período:<br>
                      <input type="text" placeholder="Ex: 201701" class="form-control" name="periodo" maxlength="6" required>
                    </div>
					
                    <div class="col-xs-6 col-md-3">
					  <button type="submit" style="margin-top: 40px;" class="btn btn-success" name="enviar">Cadastrar</button>
                      <button type="reset" style="margin-top: 40px;" class="btn btn-default" name ="limpar">Limpar</button>
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
              <br>
            </div>
		</div>
	
	
	
	<div class="tab-pane" id="tab2">
     <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title">PARA REMOVER UM REGISTRO, CLIQUE NO BOTÃO REMOVER DO REGISTRO DESEJADO:</h3>
        </div>
        <div class="panel-body">

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
                <th>Período</th>
                <th>Percentual (%)</th>
                <th>Remover</th>
                </tr>
              </thead>
              <tbody>
			  
							<?php 
								$resultado = retornalinhas($_SESSION["cdfuncionario"],"12");
								if(OCIExecute($resultado)){
									$cont = 0;
									while(OCIFetch($resultado)){
											$id = OCIResult($resultado,1);
											$cont++;
											echo("             
													<tr>
													<th scope='row'>".OCIResult($resultado,1)."</th>
													<td>".OCIResult($resultado,2)."</td>
													<td class='last-td'>
														<button class='btn btn-danger btn-sm' data-href='exc_sinistralidade.php?id=$id' data-toggle='modal' data-target='#confirm-delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>
													</td>
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
	
    $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  </script>
  
</div>