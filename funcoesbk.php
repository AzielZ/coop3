<?php
function connect($local)
{
  switch ($local)
   {
     case "wcooperado":
        $banco="(DESCRIPTION =
                   (ADDRESS_LIST =
                     (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.10.2)(PORT = 1521))
                   )
                   (CONNECT_DATA =
                        (SERVICE_NAME = tasyprinc)
                   )
                )";
	    return  OCILogon("wcooperado","wcooperado",$banco);
	
	break;
     default:
       return null;
   }
}

function retornalinhas($login, $tipo)
{
	$login = sql_inject($login);
	$ora_conecta=connect("wcooperado");
    if($ora_conecta)
    {	
        //ANIVERSARIANTE DO DIA TIPO 1
         if($tipo=="1"){
		       $consulta = "select * from v_aniversariantes order by 2";};
			   
        //USUARIOS ATIVOS POR PERIODO
    	 if($tipo=="2"){
		       $consulta = "select * from v_usuarios_ativos_no_dia";};							 
		 //CONTROLE INDICADOR MATRIZ					 
    	 if($tipo=="3"){
		       $consulta = "select * 
							  from matriz_web_ecom_controle a
							 where a.aoexibe = 'S'
							 order by 2";};

		 //SINISTRALIDADE			 
    	 if($tipo=="4"){
		       $consulta = "select substr((to_char(to_date(nrperiodo, 'YYYYMM'), 'MONTH')), 1, 3) || '/' ||
								   substr(nrperiodo, 3, 2) periodo,
								   trim(to_char(valor, '99.99')) valor,
								   nrperiodo
							  from (select * from sinistralidade order by nrperiodo desc)
							 where rownum < 4
						     order by nrperiodo";};

		 //USUARIOS ATIVOS POR PERIODO E TIPO DE CONTRATACAO(INDICADORES)		 
    	 if($tipo=="5"){
		       $consulta = "select *
			                  from (select substr((to_char(to_date(nrperiodo,'YYYYMM'),'MONTH')),1,3)||'/'||substr(nrperiodo,3,2) periodo,
							               EmpresaSP,
										   EmpresaPM,
										   ParticularPM,
										   UnimedSP,
										   qtde,
										   nrperiodo
									  from usuarios_ativos a
									 order by a.nrperiodo desc )
							 where rownum < 5
							 order by nrperiodo";};


		 //MENSAGEM DEMONSTRATIVO					 
    	 if($tipo=="6"){
		       $consulta = "SELECT B.NRID,
								   B.TXMENSAGEM
							  FROM MENSAGEM_DE_RELATORIO A,
								   MENSAGEM_DE_RELATORIO_DETALHE B,
								   PRESTADOR                     C
							 WHERE a.nrid = b.nrid
								 and   
								   (((((((((A.NOCLASSE) = ('TPP10FT05')) OR (('TPP10FT05') IS NULL)) AND
								   (((A.NRID) = (0.000000)) OR ((0.000000) = (0)))) AND
								   ((((A.NRPERIODO_INI) <= (TO_CHAR(SYSDATE,'YYYYMM'))) OR
								   (TO_CHAR(SYSDATE,'YYYYMM') = (0))) OR ((A.NRPERIODO_INI) IS NULL))) AND
								   ((((A.NRPERIODO_FIN) >= (TO_CHAR(SYSDATE,'YYYYMM'))) OR
								   (TO_CHAR(SYSDATE,'YYYYMM') = (0))) OR ((A.NRPERIODO_FIN) IS NULL))) AND
								   ((((A.VLCRIT_01) = (C.CDPRESTADOR)) OR ((C.CDPRESTADOR) = ('*'))) OR
								   ((NVL(A.VLCRIT_01,'*')) = ('*')))) AND
								   ((((A.VLCRIT_02) = (C.CDESPECIAL_PREDOM)) OR ((C.CDESPECIAL_PREDOM) = ('*'))) OR
								   ((A.VLCRIT_02) = ('*')))) AND
								   ((((A.VLCRIT_03) = (C.TPPRESTADOR)) OR ((C.TPPRESTADOR) = ('*'))) OR
								   ((A.VLCRIT_03) = ('*'))))
							   AND ((((A.VLCRIT_04) = ('')) OR (('') = ('*'))) OR
								   ((A.VLCRIT_04) = ('*')))
							   AND C.CDPRESTADOR = '$login'
									 ORDER BY B.NRID, B.NRSEQUENCIAL";};
									 
		//GERA NOME ARQUIVO IRPF					 
    	 if($tipo=="7"){
			 $consulta = "select 'Dem_'||substr(pe.nopessoa,3,1)||substr(p.cdespecial_predom,1,1)||
								   lower(substr(pe.nopessoa,2,1))||substr(p.cdespecial_predom,2,1)||
								   (p.cdprestador * 99)||'_'||p.cdprestador||'.pdf'
							from   prestador   p,
								   pessoa      pe,
								   funcionario f
							where  p.nrregistro_prest= pe.nrregistro
							and    p.tpprestador     = '0'
							and    p.cdsituacao      = 'A'
							and    f.cdfuncionario   = lpad(p.cdprestador,6,0)
		                    and    p.cdprestador     = '$login'";};	

		//GERA SELECT DO DEMONSTRATIVO
		//and pc.nrperiodo between addperiodo(mm.maximo, -2) and mm.maximo		
		if($tipo=="8"){
			 $consulta =  "select 'S' exibir,
								   pc.nrperiodo competencia,
								   initcap(tp.notipo_pagamento) referencia,
								   pc.dtpagamento,
								   pr.nrregistro_prest,
								   pcp.nrseq_pagto_controle,
								   pr.cdprestador
							  from pagamento_controle pc,
								   pagamento_controle_prest pcp,
								   prestador pr,
								   tipo_pagamento tp,
								   (select a.nrregistro_prest, max(b.nrperiodo) maximo
									  from pagamento_controle_prest a, pagamento_controle b
									 where a.nrseq_pagto_controle = b.nrsequencial
									   and b.dtencerramento is not null
									 group by a.nrregistro_prest) mm
							 where pc.nrsequencial = pcp.nrseq_pagto_controle
							   and pcp.nrregistro_prest = pr.nrregistro_prest
							   and pc.cdtipo_pagamento = tp.cdtipo_pagamento
							   and pcp.nrregistro_prest = mm.nrregistro_prest
							   and pc.dtencerramento is not null
							   and pc.nrperiodo between '201712' and mm.maximo
							   and pr.CDPRESTADOR = '$login'
							 group by pc.nrperiodo,
									  pc.cdtipo_pagamento,
									  tp.notipo_pagamento,
									  pc.dtpagamento,
									  pr.nrregistro_prest,
									  pcp.nrseq_pagto_controle,
									  pr.cdprestador
							 order by pc.dtpagamento desc";};	

		//GERA COMPROVANTE INSS                  
		if($tipo=="9"){
			 $consulta =  "select 'S' exibir,
								   pc.nrperiodo competencia,
								   initcap(tp.notipo_pagamento) referencia,
								   pc.dtpagamento,
								   pr.nrregistro_prest,
								   pcp.nrseq_pagto_controle,
								   pr.cdprestador
							  from pagamento_controle pc,
								   pagamento_controle_prest pcp,
								   prestador pr,
								   tipo_pagamento tp,
								   (select a.nrregistro_prest, max(b.nrperiodo) maximo
									  from pagamento_controle_prest a, pagamento_controle b
									 where a.nrseq_pagto_controle = b.nrsequencial
									   and b.dtencerramento is not null
									 group by a.nrregistro_prest) mm
							 where pc.nrsequencial = pcp.nrseq_pagto_controle
							   and pcp.nrregistro_prest = pr.nrregistro_prest
							   and pc.cdtipo_pagamento = tp.cdtipo_pagamento
							   and pcp.nrregistro_prest = mm.nrregistro_prest
							   and pc.dtencerramento is not null
							   and pc.nrperiodo between addperiodo(mm.maximo, -2) and mm.maximo
							   and pc.cdtipo_pagamento = 'F'
							   and pr.CDPRESTADOR = '$login'
							 group by pc.nrperiodo,
									  pc.cdtipo_pagamento,
									  tp.notipo_pagamento,
									  pc.dtpagamento,
									  pr.nrregistro_prest,
									  pcp.nrseq_pagto_controle,
									  pr.cdprestador
							 order by pc.dtpagamento desc";};
							 
		//GERA INDICADOR DE PRODUÇÃO MÉDICA                  
		if($tipo=="10"){
			 $consulta =  "select * 
			                 from (select nrperiodo, 
										  trim(to_char(vlcusto,'999,990.90')) vlcusto,
										  trim(to_char(vlpre,'999,990.90')) vlpre, 
										  trim(to_char(vlinterc,'999,990.90')) vlinterc, 
										  trim(to_char(total,'999,990.90')) total, 
										  trim(to_char(pcusto,'990.90')) pcusto, 
										  trim(to_char(ppre,'990.90')) ppre, 
										  trim(to_char(pinterc,'990.90')) pinterc, 
										  mesextenso
									 from wcooperado.pagamento_web a
									where a.cdprestador = '$login' 
									order by 1 desc)
						    where rownum < 4";};

		if($tipo=="11"){
			 $consulta =  "select mes, 
								  trim(to_char(vlcusto,'99999990.90'))  vlcusto,
								  trim(to_char(vlpre,'99999990.90'))    vlpre,
								  trim(to_char(vlinterc,'99999990.90')) vlinterc,
								  trim(to_char(total,'99999990.90'))    total
			                 from pagamento_web_sintetico
							order by nrperiodo";};

		//CONSULTA DE CADASTROS DAS SINISTRALIDADES
		if($tipo=="12"){
			 $consulta =  "select s.nrperiodo, s.valor from wcooperado.sinistralidade s
						   order by 1";};

		//CONSULTA DE CAPITAL MEDICO
		if($tipo=="13"){
			 $consulta =  "SELECT C.NRANO, C.CDFUNCIONARIO, C.SALDO_ATUAL, C.SALDO_ANTERIOR, C.PERCENTUAL_SITUACAO FROM WCOOPERADO.CAPITAL_MEDICO C
			 WHERE C.CDFUNCIONARIO = '$login' AND ROWNUM = 1
			 ORDER BY C.NRANO DESC";};
			 
		//CONSULTA DE HISTORICO DO PROCESSAMENTO
		if($tipo=="14"){
			 $consulta =  "select h.nrperiodo,
						  	      decode(h.dtprocessamento, '', '-', TO_CHAR(h.dtprocessamento,'DD/MM/YYYY HH24:MI:SS')),
						  	      h.aostatus,
						  	      h.cdfuncionario,
						  	      decode(h.aostatus,
						  	     		 'S',
						  	     		 '<b> <font color=#26A226>' ||
						  	     		 decode(h.txobservacao, '', '-', h.txobservacao) || '</font></b>',
						  	     		 'R',
						  	     		 '<font color=#404040>' ||
						  	     		 decode(h.txobservacao, '', '-', h.txobservacao) || '</font>',
						  	     		 'P',
						  	     		 '<font color=#000000>' ||
						  	     		 decode(h.txobservacao, '', '-', h.txobservacao) || '</font>',
						  	     		 'E',
						  	     		 '<font color=#FF0000>' ||
						  	     		 decode(h.txobservacao, '', '-', h.txobservacao) || '</font>',
						  	     		 decode(h.txobservacao, '', '-', h.txobservacao))
						        from wcooperado.historico_processamento h
						        order by h.nrsequencia desc";};

		//CONSULTA DE HISTORICO DO PROCESSAMENTO
		if($tipo=="15"){
			 $consulta =  "SELECT M.CDMENSAGEM,
							  	  M.CDGRUPO,
							  	  M.DSASSUNTO,
							  	  M.DSMENSAGEM,
							  	  M.CDFUNCIONARIO,
							  	  M.DTINIVALIDADE,
							  	  M.DTFIMVALIDADE,
							  	  M.NOANEXO
						   FROM MENSAGEM M
						   ORDER BY M.CDMENSAGEM";};
			
		//VERIFICA SE EXISTE PROLABORE				 
    	 if($tipo=="16"){
			 $consulta = "SELECT NVL(F.AOPROLABORE,'N')
						  FROM WCOOPERADO.FUNCIONARIO F
						  WHERE F.AOPROLABORE = 'S'  AND F.CDFUNCIONARIO = '$login'";};	

		//GERA NOME ARQUIVO PROLABORE SENIOR					 
    	 if($tipo=="17"){
			 $consulta = "select D.PERIODO || '/Dem_IR_'||substr(pe.nopessoa,3,1)||substr(p.cdespecial_predom,1,1)||
                   lower(substr(pe.nopessoa,2,1))||substr(p.cdespecial_predom,2,1)||
                   (p.cdprestador * 99)||'_'||p.cdprestador||'.pdf' CAMINHO, D.PERIODO
              from prestador   p,
                   pessoa      pe,
                   WCOOPERADO.funcionario f,
                   WCOOPERADO.DEMONSTRATIVO_IR D
              where  p.nrregistro_prest= pe.nrregistro
              and    p.tpprestador     = '0'
              and    p.cdsituacao      = 'A'
              and    f.cdfuncionario   = lpad(p.cdprestador,6,0)
              AND    F.CDFUNCIONARIO = D.CDFUNCIONARIO
			  AND   F.AOPROLABORE = 'S'
              and    p.cdprestador     = '$login'
			  ORDER BY D.PERIODO DESC";};	

 		 $resultado = OCIParse($ora_conecta, $consulta);
 		 return $resultado;
}
	else
	{
		return "erro";
	}
	
}

function indicadorecom($login, $tipo, $indicador)
{
	$login = sql_inject($login);
	$ora_conecta=connect("wcooperado");
    if($ora_conecta)
    {	

		if($tipo=="1"){
			 $consulta =  "select *
							 from V_MATRIZ_WEB_ECOM A
							where a.nrperiodo =  (SELECT MAX(T.NRPERIODO) FROM matriz_web_ecom T WHERE T.codigo_crm = A.CODIGO_CRM)
							  and a.codigo_crm = '$login'
                              and a.codigo_indicador = '$indicador'";};
							 
 		 $resultado = OCIParse($ora_conecta, $consulta);
 		 return $resultado;
}
	else
	{
		return "erro";
	}
	
}


function autenticausuario($login, $senha, $tipo)
{
	$login = sql_inject($login);
	$ora_conecta=connect("wcooperado");
    if($ora_conecta)
    {	
		//VALIDAR LOGIN E SENHA COOPERADO      
		if($tipo=="1"){
			 $consulta =  "SELECT F.CDFUNCIONARIO, F.NOFUNCIONARIO, CRIPT(F.CDSENHA,'XMSDES-CRIPT') SENHA, F.CDGRUPO, DECODE(F.CDGRUPO,'SAMC',DECODE(A.CDSEXO,'F','Dra.','M','Dr.','Dr(a).') ||' '|| INITCAP(SUBSTR(F.NOFUNCIONARIO, 1, INSTR(F.NOFUNCIONARIO,' ')-1 )),INITCAP(SUBSTR(F.NOFUNCIONARIO, 1, INSTR(F.NOFUNCIONARIO,' ')-1 ))) PRIMEIRO_NOME, A.NRCGC_CPF, F.CDSENHA
							FROM WCOOPERADO.FUNCIONARIO F, PRODUCAO.PESSOA A, PRODUCAO.PRESTADOR P
							WHERE F.CDFUNCIONARIO = P.CDPRESTADOR(+)
							AND P.NRREGISTRO_PREST = A.NRREGISTRO(+)
							AND F.CDGRUPO = 'SAMC'
							AND (F.CDFUNCIONARIO = LPAD('$login',6,'0') AND UPPER(CRIPT(F.CDSENHA,'XMSDES-CRIPT')) = UPPER('$senha'))";};
							
		//VALIDAR LOGIN E SENHA
		if($tipo=="2"){
			 $consulta =  "SELECT F.CDFUNCIONARIO, F.NOFUNCIONARIO, CRIPT(F.CDSENHA,'XMSDES-CRIPT') SENHA, F.CDGRUPO, INITCAP(SUBSTR(F.NOFUNCIONARIO, 1, INSTR(F.NOFUNCIONARIO,' ')-1 )) PRIMEIRO_NOME, F.CDSENHA
							FROM WCOOPERADO.FUNCIONARIO F
							WHERE F.CDGRUPO <> 'SAMC' 
							AND (F.CDFUNCIONARIO = '$login' AND UPPER(CRIPT(F.CDSENHA,'XMSDES-CRIPT')) = UPPER('$senha'))";};
						   							 
 		 $resultado = OCIParse($ora_conecta, $consulta);
 		 return $resultado;
}
	else
	{
		return "erro";
	}
	
}

function alterarsenha($login, $senha, $novasenha, $tipo)
{
	$login = sql_inject($login);
	$ora_conecta=connect("wcooperado");
    if($ora_conecta)
    {	
		//ATUALIZA A SENHA DO USUÁRIO       
		if($tipo=="1"){
			 $consulta =  "UPDATE FUNCIONARIO F SET F.CDSENHA = CRIPT('$novasenha','DRAGONITE'), F.DTALTER_SENHA = TO_CHAR(TRUNC(SYSDATE),'DD/MM/YYYY')
						   WHERE F.CDFUNCIONARIO = '$login' AND UPPER(CRIPT(F.CDSENHA,'XMSDES-CRIPT')) = UPPER('$senha')";};
						   
		//RECEBER AS INFORMAÇÕES DOS COOPERADOS      
		if($tipo=="2"){
			 $consulta =  "SELECT F.CDFUNCIONARIO, F.NOFUNCIONARIO, CRIPT(F.CDSENHA,'XMSDES-CRIPT') SENHA, F.CDGRUPO, DECODE(A.CDSEXO,'F','Dra.','M','Dr.','Dr(a).') ||' '|| INITCAP(SUBSTR(F.NOFUNCIONARIO, 1, INSTR(F.NOFUNCIONARIO,' ')-1 )) PRIMEIRO_NOME, A.NRCGC_CPF, A.NOPESSOA, F.CDSENHA
						   FROM FUNCIONARIO F, PRESTADOR P, PESSOA A
						   WHERE P.CDPRESTADOR = F.CDFUNCIONARIO
						   AND P.NRREGISTRO_PREST = A.NRREGISTRO
						   AND F.CDFUNCIONARIO = '$login'";};
						   
		//RECEBER AS INFORMAÇÕES DOS FUNCIONARIOS      
		if($tipo=="3"){
			 $consulta =  "SELECT F.CDFUNCIONARIO, F.NOFUNCIONARIO, CRIPT(F.CDSENHA,'XMSDES-CRIPT') SENHA, F.CDGRUPO, INITCAP(SUBSTR(F.NOFUNCIONARIO, 1, INSTR(F.NOFUNCIONARIO,' ')-1 )) PRIMEIRO_NOME, F.CDSENHA
						   FROM FUNCIONARIO F
						   WHERE F.CDFUNCIONARIO = '$login'";};
						   							 
 		 $resultado = OCIParse($ora_conecta, $consulta);
 		 return $resultado;
}
	else
	{
		return "erro";
	}
}

function atualizarcadastro($nome, $cpf, $crm, $tel_comerc_1, $tel_comerc_2, $email_consult, $rua_comerc, $num_comerc, $bairro_comerc, $cep_comerc, $rua_resid, $num_resid, $bairro_resid, $cep_resid, $cel_resid_1, $cel_resid_2, $whatsapp_resid, $email_pessoal, $anexo_alvara_localizacao, $anexo_alvara_sanitario, $anexo_registro_cnes, $anexo_titulo_especialista, $anexo_residencia_medica, $anexo_rqe, $tipo)
{
	$login = sql_inject($crm);
	$ora_conecta=connect("wcooperado");
    if($ora_conecta)
    {	
		//INSERE O HISTORICO     
		if($tipo=="1"){
			 $consulta =  "INSERT INTO WCOOPERADO.ATUALIZACAO_CADASTRAL (NOME,
																		 CPF,
																		 CRM,
																		 TEL_COMERC_1,
																		 TEL_COMERC_2,
																		 EMAIL_CONSULT,
																		 RUA_COMERC,
																		 NUM_COMERC,
																		 BAIRRO_COMERC,
																		 CEP_COMERC,
																		 RUA_RESID,
																		 NUM_RESID,
																		 BAIRRO_RESID,
																		 CEP_RESID,
																		 CEL_RESID_1,
																		 CEL_RESID_2,
																		 WHATSAPP_RESID,
																		 EMAIL_PESSOAL,
																		 DT_ATUALIZACAO)
																	 VALUES ('$nome',
																		 '$cpf',
																		 '$crm',
																		 '$tel_comerc_1',
																		 '$tel_comerc_2',
																		 '$email_consult',
																		 '$rua_comerc',
																		 '$num_comerc',
																		 '$bairro_comerc',
																		 '$cep_comerc',
																		 '$rua_resid',
																		 '$num_resid',
																		 '$bairro_resid',
																		 '$cep_resid',
																		 '$cel_resid_1',
																		 '$cel_resid_2',
																		 '$whatsapp_resid',
																		 '$email_pessoal',
																		 sysdate)";};
						   
		//RECEBER AS INFORMAÇÕES DOS COOPERADOS      
		if($tipo=="2"){
			 $consulta =  "SELECT AC.NOME,
							      AC.CPF,
							      AC.CRM,
							      AC.TEL_COMERC_1,
							      AC.TEL_COMERC_2,
							      AC.EMAIL_CONSULT,
							      AC.RUA_COMERC,
							      AC.NUM_COMERC,
							      AC.BAIRRO_COMERC,
							      AC.CEP_COMERC,
							      AC.RUA_RESID,
							      AC.NUM_RESID,
							      AC.BAIRRO_RESID,
							      AC.CEP_RESID,
							      AC.CEL_RESID_1,
							      AC.CEL_RESID_2,
							      AC.WHATSAPP_RESID,
							      AC.EMAIL_PESSOAL
							FROM PRODUCAO.V_CST_ATUALIZACAO_CADASTRAL AC
							WHERE AC.CRM = '$crm'";};
						   							 
 		 $resultado = OCIParse($ora_conecta, $consulta);
 		 return $resultado;
}
	else
	{
		return "erro";
	}
}

function sinistralidade($login, $periodo, $valor, $tipo)
{
	$login = sql_inject($login);
	$ora_conecta=connect("wcooperado");
    if($ora_conecta)
    {	
		//INSERE UMA NOVA SINISTRALIDADE
		if($tipo=="1"){
			 $consulta =  "INSERT INTO WCOOPERADO.SINISTRALIDADE (NRPERIODO, VALOR) VALUES ('$periodo','$valor')";};

		//DELETA UMA SINISTRALIDADE
		if($tipo=="2"){
			 $consulta =  "DELETE WCOOPERADO.SINISTRALIDADE WHERE NRPERIODO = '$periodo'";};
						   							 
 		 $resultado = OCIParse($ora_conecta, $consulta);
 		 return $resultado;
}
	else
	{
		return "erro";
	}
	
}


function processar($login, $periodo, $tipo)
{
	$login = sql_inject($login);
	$ora_conecta=connect("wcooperado");
    if($ora_conecta)
    {	
		//PROCESSAR UM PERIODO
		if($tipo=="1"){
			 $consulta =  "INSERT INTO WCOOPERADO.HISTORICO_PROCESSAMENTO (NRPERIODO, DTPROCESSAMENTO, AOSTATUS, CDFUNCIONARIO, TXOBSERVACAO) VALUES ('$periodo','','P','$login','PERIODO SENDO PROCESSADO, AGUARDE...')";};
			 
		if($tipo=="2"){
			 $consulta =  "UPDATE WCOOPERADO.HISTORICO_PROCESSAMENTO H SET H.DTPROCESSAMENTO = '', H.AOSTATUS = 'R', H.CDFUNCIONARIO = '$login', H.TXOBSERVACAO = 'PERIODO SENDO REPROCESSADO, AGUARDE...'
						   WHERE H.NRPERIODO = '$periodo'";};
						   							 
 		 $resultado = OCIParse($ora_conecta, $consulta);
 		 return $resultado;
}
	else
	{
		return "erro";
	}
	
}



function valida_session($login, $grupo, $tela, $tipo)
{
	$login = sql_inject($login);
	$ora_conecta=connect("wcooperado");
    if($ora_conecta)
    {	
		//VALIDA O LOGIN E O GRUPO
		if($tipo=="1"){
			 $consulta =  "SELECT F.* FROM WCOOPERADO.PERMISSAO_DO_GRUPO F
							WHERE F.CDGRUPO = '$grupo' AND F.CDFUNCAO = '$tela'";};
			 
 		 $resultado = OCIParse($ora_conecta, $consulta);
 		 return $resultado;
}
	else
	{
		return "erro";
	}
}



function mensagem($login, $grupo, $mens, $tipo)
{
	$login = sql_inject($login);
	$ora_conecta=connect("wcooperado");
    if($ora_conecta)
    {	
		//VERIFICA AS MENSAGENS DO GRUPO
		if($tipo=="1"){
			 $consulta =  "SELECT M.CDMENSAGEM, M.DSASSUNTO, M.DSMENSAGEM, M.DTINIVALIDADE, M.DTFIMVALIDADE, MP.DTLIDA FROM WCOOPERADO.MENSAGEM M, WCOOPERADO.MENSAGEM_PRESTADOR MP
              WHERE M.CDMENSAGEM = MP.CDMENSAGEM AND M.CDGRUPO = '$grupo' AND MP.CDFUNCIONARIO = '$login' AND TO_CHAR(TRUNC(SYSDATE),'DD/MM/YYYY') BETWEEN M.DTINIVALIDADE AND M.DTFIMVALIDADE 
			  ORDER BY NVL(MP.DTLIDA,'01/01/2000'), M.DTINIVALIDADE";};
		
							
		//VERIFICA A QUANTIDADE DE MENSAGENS NÃO LIDAS DO PRESTADOR
		if($tipo=="2"){
			 $consulta =  "SELECT COUNT(*) FROM WCOOPERADO.MENSAGEM_PRESTADOR MP, WCOOPERADO.MENSAGEM M
              WHERE MP.CDFUNCIONARIO = '$login' AND MP.DTLIDA IS NULL AND MP.CDMENSAGEM = M.CDMENSAGEM AND SYSDATE <= M.DTFIMVALIDADE";};
			  
		//VISUALIZAR O DETALHE DAS MENSAGENS
		if($tipo=="3"){
			 $consulta =  "SELECT M.CDMENSAGEM, M.DSASSUNTO, M.DSMENSAGEM, M.DTINIVALIDADE, M.DTFIMVALIDADE, MP.DTLIDA, M.NOANEXO FROM WCOOPERADO.MENSAGEM M, WCOOPERADO.MENSAGEM_PRESTADOR MP
              WHERE M.CDMENSAGEM = MP.CDMENSAGEM AND M.CDGRUPO = '$grupo' AND MP.CDFUNCIONARIO = '$login' AND M.CDMENSAGEM = '$mens'
			  ORDER BY NVL(MP.DTLIDA,'01/01/2000'), M.DTINIVALIDADE";};
			  
		//ATUALIZA A SENHA DO USUÁRIO       
		if($tipo=="4"){
			 $consulta =  "UPDATE WCOOPERADO.MENSAGEM_PRESTADOR MP SET MP.DTLIDA = TO_CHAR(TRUNC(SYSDATE),'DD/MM/YYYY')
						   WHERE MP.DTLIDA IS NULL AND MP.CDFUNCIONARIO = '$login' AND MP.CDMENSAGEM = '$mens'";};
						   
		//LISTAR TODAS AS MENSAGENS CADASTRADAS       
		if($tipo=="5"){
			 $consulta =  "SELECT M.CDMENSAGEM, M.DSASSUNTO, M.DSMENSAGEM, M.CDGRUPO, M.DTINIVALIDADE, M.DTFIMVALIDADE, M.NOANEXO FROM WCOOPERADO.MENSAGEM M
						   ORDER BY M.CDMENSAGEM";};
			  
 		 $resultado = OCIParse($ora_conecta, $consulta);
 		 return $resultado;
}
	else
	{
		return "erro";
	}
}



function historico($login, $senha, $nrip, $sucesso, $tipo)
{
	$login = sql_inject($login);
	$ora_conecta=connect("wcooperado");
    if($ora_conecta)
    {	
		//INSERE UM HISTORICO
		if($tipo=="1"){
			 $consulta =  "INSERT INTO WCOOPERADO.HISTORICO_LOGIN (CDFUNCIONARIO, CDSENHA, DTTENTATIVA, NRIP, AOSUCESSO) VALUES ('$login',CRIPT('$senha','DRAGONITE'),SYSDATE,'$nrip','$sucesso')";};
						   							 
 		 $resultado = OCIParse($ora_conecta, $consulta);
 		 return $resultado;
}
	else
	{
		return "erro";
	}
	
}




function sql_inject($cdusuario)
{
	$cdusuario=str_replace("'","",$cdusuario);
	$cdusuario=str_replace("or","",$cdusuario);		
	$cdusuario=str_replace(" ","",$cdusuario);		
	$cdusuario=str_replace("=","",$cdusuario);
	$cdusuario=str_replace("-","",$cdusuario);
	$cdusuario=str_replace("/","",$cdusuario);		
    return $cdusuario;
}
?>
