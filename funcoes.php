<?php
function connect($local)
{
  switch ($local)
   {
     case "wcooperado":
        $banco="(DESCRIPTION =
                   (ADDRESS_LIST =
                     (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.30.235)(PORT = 1521))
                   )
                   (CONNECT_DATA =
                        (SERVICE_NAME = tasyprinc)
                   )
                )";
	    return  OCILogon("wcooperado","wcooperado",$banco);
	
	break;

     case "srcadger":
        $banco="(DESCRIPTION =
                   (ADDRESS_LIST =
                     	(ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.30.235)(PORT = 1521))
                   )
                   (CONNECT_DATA =
                        (SERVICE_NAME = tasyprinc)
                   )
               	)";

		return  OCILogon("srcadger","srcadger",$banco);
	break;

     default:
       return null;
   }
}

function validaAPP($crm) {
    	$conn = connect("srcadger");

    	$select = "
        	SELECT 
            		COUNT(P.CD_PRESTADOR) AS PRESTADOR_COUNT
        	FROM 
            		SRCADGER.PRESERV P
        	WHERE 
            		P.CD_PRESTADOR = :crm
    	";

    	$stmt = oci_parse($conn, $select);
    	oci_bind_by_name($stmt, ":crm", $crm);

    	oci_execute($stmt);
    
    	oci_fetch($stmt);
    	$prestador_count = oci_result($stmt, 'PRESTADOR_COUNT');

    	return $prestador_count;
}

function qtdFuncionarios($tipo){
	$conn = connect("wcooperado");

	if($tipo == 1){

		$select = "SELECT 
       				A.DESCRICAO||' ['||A.QUANTITATIVO||']' DESCRICAO,
       				A.QUANTITATIVO
		  	   FROM WCOOPERADO.INDICADOR_RH A
		   	   WHERE A.CD_INDICADOR = 1
		   	   ORDER BY A.QUANTITATIVO DESC";

	}else{
		$select = "SELECT 
       			   	SUM(A.QUANTITATIVO)
			   FROM WCOOPERADO.INDICADOR_RH A
			   WHERE A.CD_INDICADOR = 1";
	}
	
	$resultado = OCIParse($conn, $select);
 	return $resultado;

}

function rol(){
	$conn = connect("wcooperado");

	$select = "SELECT
			CASE WHEN R.CLASSIFICACAO IS NULL THEN 'N�O COBERTOS' ELSE 'COBERTOS' END TP_ROL,
  			R.*
	  	   FROM WCOOPERADO.ROL R";
	
	$resultado = OCIParse($conn, $select);
 	return $resultado;

}

function fail_to_ban($login, $ip){
	$conn = connect("srcadger");
	$vresultado = 'Vazio';
	
	$stid = oci_parse($conn, "BEGIN WCOOPERADO.P_GESTAO_ACESSO('$login', '$ip', :vresultado); END;");

	oci_bind_by_name($stid, ':vresultado', $vresultado, 200);

	oci_execute($stid);

	oci_free_statement($stid);
	oci_close($conn);
	
	return $vresultado;
}

function reset_fail_to_ban($login){
	$conn = connect("wcooperado");

	$update = "UPDATE WCOOPERADO.FAIL_TO_BAN SET QTD_ACESSO = 0, BLOQUEADO = 0, DESC_ACESSO = 'Logou' WHERE USUARIO = '$login'";

	$resultado = OCIParse($conn, $update);
 	return $resultado;

}

function log_acesso($cd_prestador, $ip){
	$conn = connect("wcooperado");

	$insert = "INSERT INTO WCOOPERADO.LOG_ACESSO_COOP(CD_PRESTADOR, IP, DATA_ACESSO) VALUES ('$cd_prestador', '$ip', SYSDATE)";

	$resultado = OCIParse($conn, $insert);
 	return $resultado;

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
		       $consulta = "select substr(nrperiodo, 5, 2) || '/' ||
             substr(nrperiodo, 1, 4) periodo,
             trim(to_char(valor, '999.99')) valor,
             nrperiodo from (select * from wcooperado.sinistralidade order by nrperiodo desc)
               where rownum < 7
                 order by nrperiodo desc";};

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
							 where rownum < 4
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
			 $consulta = "select 'Dem_' || substr(p.nm_prestador, 3, 1) ||
					      substr(p.cd_esp_resid, 1, 1) || lower(substr(p.nm_prestador, 2, 1)) ||
					      substr(p.cd_esp_resid, 2, 1) || (p.cd_prestador * 99) || '_' ||
					      p.cd_prestador || '.pdf'
					from srcadger.preserv p, wcooperado.funcionario f
				       where p.cd_grupo_prestador = '11'
					 and LPAD(f.cdfuncionario,6,'0') = lpad(p.cd_prestador, 6, 0)
					 and lpad(p.cd_prestador, 6, 0) = lpad('$login', 6, 0)";};	

		//GERA SELECT DO DEMONSTRATIVO
		//and pc.nrperiodo between addperiodo(mm.maximo, -2) and mm.maximo		
		if($tipo=="8"){
			 $consulta =  "select *
  from (select 'S' exibir,
               to_char(pc.nrperiodo) competencia,
               initcap(tp.notipo_pagamento) referencia,
               pc.dtpagamento,
               pr.nrregistro_prest,
               TO_CHAR(pcp.nrseq_pagto_controle) nrseq_pagto_controle,
               pr.cdprestador
          from producao.pagamento_controle pc,
               producao.pagamento_controle_prest pcp,
               producao.prestador pr,
               producao.tipo_pagamento tp,
               (select a.nrregistro_prest, max(b.nrperiodo) maximo
                  from producao.pagamento_controle_prest a,
                       producao.pagamento_controle       b
                 where a.nrseq_pagto_controle = b.nrsequencial
                   and b.dtencerramento is not null
                 group by a.nrregistro_prest) mm
         where pc.nrsequencial = pcp.nrseq_pagto_controle
           and pcp.nrregistro_prest = pr.nrregistro_prest
           and pc.cdtipo_pagamento = tp.cdtipo_pagamento
           and pcp.nrregistro_prest = mm.nrregistro_prest
           and pc.dtencerramento is not null
           and pc.nrperiodo between producao.addperiodo(to_char(sysdate,'yyyymm'),-15) and mm.maximo
           and pr.CDPRESTADOR = '$login'
         group by to_char(pc.nrperiodo),
                  pc.cdtipo_pagamento,
                  tp.notipo_pagamento,
                  pc.dtpagamento,
                  pr.nrregistro_prest,
                  pcp.nrseq_pagto_controle,
                  pr.cdprestador
        union all
       select  'S',
               A.DT_ANOREF || LPAD(A.NR_PERREF, 2, '0') COMPETENCIA,
               'Fechamento' REFERENCIA,
               MAX(A.DT_VENCIMENTO) DTPAGAMENTO,
               NULL,
               MAX(A.U##COD_DOCTO_AP),
               to_char(a.cd_prestador)
          from srcadger.titupres a
         where a.dt_anoref >= 2023
           and a.cd_prestador = '$login'
           and a.cd_unidade_prestador = 57
           and a.u##cod_esp IN ('COO','ADC','AND') --ACRESENTOU AND 11/01/2024 - JOAO GABRIEL
           and To_CHAR(a.dt_vencimento,'DD') > '20'
           and a.u##in_estado = 'E'
         group by A.DT_ANOREF || LPAD(A.NR_PERREF, 2, '0'),
               to_char(a.cd_prestador))
 order by dtpagamento desc";};	

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
							 
		//GERA INDICADOR DE PRODUCAO MEDICA                  
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
			 $consulta =  "select mes, vlcusto, vlpre, vlinterc, total
					from (select mes, 
                  				trim(to_char(vlcusto,'99999990.90'))  vlcusto,
                  				trim(to_char(vlpre,'99999990.90'))    vlpre,
                  				trim(to_char(vlinterc,'99999990.90')) vlinterc,
                  				trim(to_char(total,'99999990.90'))    total,
                  				nrperiodo
                       			     from wcooperado.pagamento_web_sintetico
              				     order by nrperiodo desc)
					where rownum <= 12 
					order by nrperiodo ";};

		//CONSULTA DE CADASTROS DAS SINISTRALIDADES
		if($tipo=="12"){
			 $consulta =  "select s.nrperiodo, s.valor from wcooperado.sinistralidade s
						   order by 1";};

		//CONSULTA DE CAPITAL MEDICO
		if($tipo=="13"){
			 $consulta =  "SELECT * FROM (SELECT C.NRANO, C.CDFUNCIONARIO, C.SALDO_ATUAL, C.SALDO_ANTERIOR, C.PERCENTUAL_SITUACAO FROM WCOOPERADO.CAPITAL_MEDICO C
			 WHERE lpad(C.CDFUNCIONARIO,6,'0') = lpad('$login',6,'0')
			 ORDER BY C.NRANO DESC)
			 WHERE ROWNUM = 1";};
			 
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
						   WHERE M.DTFIMVALIDADE > SYSDATE
						   ORDER BY M.CDMENSAGEM";};
			
		//VERIFICA SE EXISTE PROLABORE				 
    	 if($tipo=="16"){
			 $consulta = "SELECT NVL(F.AOPROLABORE,'N')
						  FROM WCOOPERADO.FUNCIONARIO F
						  WHERE F.AOPROLABORE = 'S'  AND F.CDFUNCIONARIO = '$login'";};	

		//GERA NOME ARQUIVO PROLABORE SENIOR					 
    	 if($tipo=="17"){
			 $consulta = "select D.PERIODO || '/Dem_IR_' || substr(p.Nm_Prestador, 3, 1) ||
								 substr(p.Cd_Esp_Resid, 1, 1) || lower(substr(p.Nm_Prestador, 2, 1)) ||
								 substr(p.Cd_Esp_Resid, 2, 1) || (p.cd_prestador * 99) || '_' ||
								 p.cd_prestador || '.pdf' CAMINHO,
								 D.PERIODO
							 from SRCADGER.PRESERV            p,
								 WCOOPERADO.funcionario      f,
								 WCOOPERADO.DEMONSTRATIVO_IR D
							 where p.Cd_Grupo_Prestador = '11'
							 and f.cdfuncionario = lpad(p.cd_prestador, 6, 0)
							 AND F.CDFUNCIONARIO = D.CDFUNCIONARIO
							 AND F.AOPROLABORE = 'S'
							 and p.cd_prestador = '$login'
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
			 $consulta =  "SELECT F.CDFUNCIONARIO,
                  F.NOFUNCIONARIO,
                  CRIPT(F.CDSENHA, 'XMSDES-CRIPT') SENHA,
                  F.CDGRUPO,
                  DECODE(F.CDGRUPO,
                     'SAMC',
                     DECODE(P.LG_SEXO, 1, 'Dra.', 0, 'Dr.', 'Dr(a).') || ' ' ||
                     INITCAP(SUBSTR(F.NOFUNCIONARIO,
                             1,
                             INSTR(F.NOFUNCIONARIO, ' ') - 1)),
                     INITCAP(SUBSTR(F.NOFUNCIONARIO,
                             1,
                             INSTR(F.NOFUNCIONARIO, ' ') - 1))) PRIMEIRO_NOME,
                  P.NR_CGC_CPF,
                  F.CDSENHA,
                  F.CDSENHA_ANT,
                  F2.BLOQUEADO
               FROM  WCOOPERADO.FUNCIONARIO F, SRCADGER.PRESERV P, WCOOPERADO.FAIL_TO_BAN F2
               WHERE F.CDFUNCIONARIO = P.CD_PRESTADOR(+)
               AND F.CDGRUPO = 'SAMC'
               AND  (LPAD(F.CDFUNCIONARIO, 6, '0') = LPAD('$login', 6, '0') AND
                  UPPER(CRIPT(F.CDSENHA, 'XMSDES-CRIPT')) = UPPER('$senha'))
               AND F.CDFUNCIONARIO = F2.USUARIO";};
							
		//VALIDAR LOGIN E SENHA
		if($tipo=="2"){
			 $consulta =  "SELECT F.CDFUNCIONARIO, F.NOFUNCIONARIO, PRODUCAO.CRIPT(F.CDSENHA,'XMSDES-CRIPT') SENHA, F.CDGRUPO, INITCAP(SUBSTR(F.NOFUNCIONARIO, 1, INSTR(F.NOFUNCIONARIO,' ')-1 )) PRIMEIRO_NOME, F.CDSENHA, F2.BLOQUEADO
							FROM WCOOPERADO.FUNCIONARIO F, WCOOPERADO.FAIL_TO_BAN F2
							WHERE F.CDGRUPO <> 'SAMC' 
							AND (F.CDFUNCIONARIO = '$login' AND UPPER(PRODUCAO.CRIPT(F.CDSENHA,'XMSDES-CRIPT')) = UPPER('$senha'))
							AND F.CDFUNCIONARIO = F2.USUARIO";};
						   							 
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

		//ATUALIZA A SENHA DO USUARIO       
		if($tipo=="1"){	
			 $consulta =  "UPDATE FUNCIONARIO F 
			               SET F.CDSENHA = CRIPT('$novasenha','DRAGONITE'),
			                   F.DTALTER_SENHA = TO_CHAR(TRUNC(SYSDATE),'DD/MM/YYYY'), 
					               F.CDSENHA_ANT = F.CDSENHA
			             WHERE F.CDFUNCIONARIO = '$login'
										 AND UPPER(CRIPT(F.CDSENHA,'XMSDES-CRIPT')) = UPPER('$senha')";
										 									 
			 $resultado = oci_parse($ora_conecta, $consulta);
            if (oci_execute($resultado)) {
                $_SESSION["senhaAnterior"] = 'Senha atualizada com sucesso!';
            } else {
                $_SESSION["senhaAnterior"] = 'Erro ao atualizar a senha!';
            }
        }
    }
};
						   
		//RECEBER AS INFORMACOES DOS COOPERADOS      
		if($tipo=="2"){
			 $consulta =  "SELECT F.CDFUNCIONARIO,
							  	  F.NOFUNCIONARIO,
							  	  CRIPT(F.CDSENHA, 'XMSDES-CRIPT') SENHA,
							  	  F.CDGRUPO,
							  	  DECODE(P.LG_SEXO, '1', 'Dra.', '0', 'Dr.', 'Dr(a).') || ' ' ||
							  	  INITCAP(SUBSTR(F.NOFUNCIONARIO, 1, INSTR(F.NOFUNCIONARIO, ' ') - 1)) PRIMEIRO_NOME,
							  	  P.NR_CGC_CPF,
							  	  P.NM_PRESTADOR,
							  	  F.CDSENHA,
								  F.CDSENHA_ANT
							    FROM FUNCIONARIO F, SRCADGER.PRESERV P
							    WHERE P.CD_PRESTADOR = F.CDFUNCIONARIO
							    AND LPAD(F.CDFUNCIONARIO, 6, '0') = LPAD('$login', 6, '0')";};
						   
		//RECEBER AS INFORMACOES DOS FUNCIONARIOS      
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
						   
		//RECEBER AS INFORMACOES DOS COOPERADOS      
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
							FROM WCOOPERADO.V_CST_ATUALIZACAO_CADASTRAL AC
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
			  ORDER BY NVL(MP.DTLIDA,'01/01/2000'), M.DTINIVALIDADE DESC";};
			
			 							
		//VERIFICA A QUANTIDADE DE MENSAGENS NAO LIDAS DO PRESTADOR
		if($tipo=="2"){
			 $consulta =  "SELECT COUNT(*) FROM WCOOPERADO.MENSAGEM_PRESTADOR MP, WCOOPERADO.MENSAGEM M
              WHERE MP.CDFUNCIONARIO = '$login' AND MP.DTLIDA IS NULL AND MP.CDMENSAGEM = M.CDMENSAGEM AND SYSDATE <= M.DTFIMVALIDADE";};
			  
		//VISUALIZAR O DETALHE DAS MENSAGENS
		if($tipo=="3"){
			 $consulta =  "SELECT M.CDMENSAGEM, M.DSASSUNTO, M.DSMENSAGEM, M.DTINIVALIDADE, M.DTFIMVALIDADE, MP.DTLIDA, M.NOANEXO FROM WCOOPERADO.MENSAGEM M, WCOOPERADO.MENSAGEM_PRESTADOR MP
              WHERE M.CDMENSAGEM = MP.CDMENSAGEM AND M.CDGRUPO = '$grupo' AND MP.CDFUNCIONARIO = '$login' AND M.CDMENSAGEM = '$mens'
			  ORDER BY NVL(MP.DTLIDA,'01/01/2000'), M.DTINIVALIDADE";};
			  
		//ATUALIZA A SENHA DO USUA�RIO       
		if($tipo=="4"){
			 $consulta =  "UPDATE WCOOPERADO.MENSAGEM_PRESTADOR MP SET MP.DTLIDA = TO_CHAR(TRUNC(SYSDATE),'DD/MM/YYYY')
						   WHERE MP.DTLIDA IS NULL AND MP.CDFUNCIONARIO = '$login' AND MP.CDMENSAGEM = '$mens'";};
						   
		//LISTAR TODAS AS MENSAGENS CADASTRADAS       
		if($tipo=="5"){
			 $consulta =  "SELECT M.CDMENSAGEM, M.DSASSUNTO, M.DSMENSAGEM, M.DTINIVALIDADE, M.DTFIMVALIDADE, M.NOANEXO FROM WCOOPERADO.MENSAGEM M
						   ORDER BY TO_NUMBER(M.CDMENSAGEM) DESC";};
			  
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
