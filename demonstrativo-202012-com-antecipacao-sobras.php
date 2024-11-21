<?php
include("valida_usuario.php");
valida_usuario('DEM_PAG');

$a1 = $_REQUEST['a1'];
$a2 = $_REQUEST['a2'];
$a3 = $_REQUEST['a3'];
$a4 = $_REQUEST['a4'];
$a5 = $_REQUEST['a5'];
$a6 = $_REQUEST['a6'];

$a1 = base64_decode($a1);
$a1 = base64_decode($a1);
$a3 = base64_decode($a3);
$a6 = base64_decode($a6);
$a4 = base64_decode($a4);

if ($a5 != "NwnjhGrtD=aqT") 
     
 {
   print "<SCRIPT LANGUAGE=JAVASCRIPT>
		       alert('Acesso no permitido!');
		       window.history.back(1);
                       </SCRIPT>";
 }


$conn = OCILogon("PRODUCAO","EBAD","INFO_PRODUCAO");
require_once("fpdf.php");
//parse_str($_server['QUERY_STRING']);
$pdf=new FPDF();
$pdf->Open();

if ($a2 == '1') {
$sql = "select DATA, 
                  TPPAGAMENTO,
                  NRSEQ_PAGTO_CONTROLE, 
                  NRPAGAMENTO, 
                  CDPRESTADOR, 
                  NRREGISTROINSS, 
                  CDEVENTO, 
                  VLPAGO_EM_MOEDA, 
                  CDUSUARIO, 
                  NOUSUARIO2, 
                  TPPLANO_USUARIO, 
                  DTATENDIMENTO, 
                  CDSERVICO, 
                  NOSERVICO, 
                  NRGRAU_PARTICIP, 
                  QTSERVICO, 
                  AOEMERGENCIA, 
                  AOUTILIZA_VIA, 
                  CDOCORRENCIA, 
                  CDTIPO_TOMADOR, 
                  TPVALORIZACAO, 
                  CDGUIA, 
                  NOTIPO_GUIA, 
                  NOPRESTADOR, 
                  NRCGC_CPF, 
                  VLSINAL, 
                  NOEVENTO, 
                  CDCATEGORIA_EVENTO, 
                  NOCATEGORIA_EVENTO,
                  AOCONTROLE,
                  NOCONTROLE,
                  CDTIPO_TOMADOR,
                  SINAL,
                  CDTIPO_GUIA,
                  TXOBSERVACAO,
                  VLREFERENCIA,
   	          VLREFERENCIA4,
	          VLREFERENCIA5,
	          VLREFERENCIA2,
                  CDTIPO_PAGAMENTO,
                  NREVENTO
  from ((select data,
               DECODE(substr(TPPAGAMENTO, 1, 6),
					  '202012',
					  '202012 - Pagto: 30/12 (ANTECIPAÇÃO DE SOBRAS) e 20/01 (FECHAMENTO)',
					  TPPAGAMENTO) TPPAGAMENTO,
               '' nrseq_pagto_controle, --TO_CHAR(nrseq_pagto_controle) nrseq_pagto_controle,
               99 nrpagamento,
               to_char(cdprestador) cdprestador,
               nrregistroinss,
               to_char(cdevento) cdevento,
               to_char(vlpago_em_moeda,'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''') vlpago_em_moeda,
               cdusuario,
               nousuario2,
               tpplano_usuario,
               dtatendimento,
               cdservico,
               noservico,
               nrgrau_particip,
               qtservico,
               aoemergencia,
               aoutiliza_via,
               cdocorrencia,
               tpvalorizacao,
               cdguia,
               notipo_guia,
               noprestador,
               nrcgc_cpf,
               vlsinal,
               noevento,
               to_char(cdcategoria_evento) cdcategoria_evento,
               nocategoria_evento,
               aocontrole,
               nocontrole,
               cdtipo_tomador,
               sinal,
               cdtipo_guia,
               txobservacao,
               to_char(vlreferencia,'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''') vlreferencia,
               to_char(vlreferencia4,'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''') vlreferencia4,
               to_char(vlreferencia5,'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''') vlreferencia5,
               vlreferencia2,
               cdtipo_pagamento,
               nrevento
          from srcadger.v_pagamento_prestador a
         where a.CDPRESTADOR = '$a1'
           and a.dt_anoref   = substr('$a6',1,4)
           and a.nr_perref   = substr('$a6',5,2)
           and a.cdevento != 179
		   and a.AOCONTROLE = 0
		union all
		select data,
			DECODE(substr(TPPAGAMENTO, 1, 6),
					'202012',
					'202012 - Pagto: 12/20',
					substr(TPPAGAMENTO, 1, 16) || substr(TPPAGAMENTO, 20, 7)) TPPAGAMENTO,
			'' nrseq_pagto_controle, --TO_CHAR(nrseq_pagto_controle) nrseq_pagto_controle,
			99 nrpagamento,
			to_char(cdprestador) cdprestador,
			nrregistroinss,
			to_char(cdevento) cdevento,
			to_char(sum(vlpago_em_moeda),
					'99999D99',
					'NLS_NUMERIC_CHARACTERS = ''.,''') vlpago_em_moeda,
			'' cdusuario,
			'' nousuario2,
			'' tpplano_usuario,
			dtatendimento,
			'' cdservico,
			'' noservico,
			'' nrgrau_particip,
			0 qtservico,
			'' aoemergencia,
			'' aoutiliza_via,
			'' cdocorrencia,
			'' tpvalorizacao,
			cdguia,
			notipo_guia,
			noprestador,
			nrcgc_cpf,
			vlsinal,
			decode(to_char(cdevento),
					'110',
					'CREDITO ANTECIPAÇÃO DE SOBRAS - PAGO EM 30/12/2020',
					noevento) noevento,
			to_char(cdcategoria_evento) cdcategoria_evento,
			nocategoria_evento,
			aocontrole,
			nocontrole,
			cdtipo_tomador,
			sinal,
			cdtipo_guia,
			txobservacao,
			to_char(sum(vlreferencia),
					'99999D99',
					'NLS_NUMERIC_CHARACTERS = ''.,''') vlreferencia,
			to_char(sum(vlreferencia4),
					'99999D99',
					'NLS_NUMERIC_CHARACTERS = ''.,''') vlreferencia4,
			to_char(sum(vlreferencia5),
					'99999D99',
					'NLS_NUMERIC_CHARACTERS = ''.,''') vlreferencia5,
			vlreferencia2,
			cdtipo_pagamento,
			nrevento
		from srcadger.v_pagamento_prestador a
		where a.CDPRESTADOR = '$a1'
		and a.dt_anoref   = substr('$a6',1,4)
		and a.nr_perref   = substr('$a6',5,2)
		and a.cdevento != 179
		and a.AOCONTROLE = 1
		group by data,
				DECODE(substr(TPPAGAMENTO, 1, 6),
						'202012',
						'202012 - Pagto: 12/20',
						substr(TPPAGAMENTO, 1, 16) || substr(TPPAGAMENTO, 20, 7)),
				--nrseq_pagto_controle,
				nrpagamento,
				cdprestador,
				to_char(cdevento),
				nrregistroinss,
				noprestador,
				nrcgc_cpf,
				aocontrole,
				nocontrole,
				dtatendimento,
				cdguia,
				notipo_guia,
				noprestador,
				nrcgc_cpf,
				vlsinal,
				to_char(cdcategoria_evento),
				nocategoria_evento,
				aocontrole,
				nocontrole,
				cdtipo_tomador,
				sinal,
				cdtipo_guia,
				txobservacao,
				vlreferencia2,
				cdtipo_pagamento,
				nrevento,
				decode(to_char(cdevento),
						'110',
						'CREDITO ANTECIPAÇÃO DE SOBRAS - PAGO EM 30/12/2020',
						noevento),
				cdtipo_pagamento
        union all
         select data,
                DECODE(substr(TPPAGAMENTO,1,6),'202012','202012 - Pagto: 12/20',substr(TPPAGAMENTO,1,16) || substr(TPPAGAMENTO,20,7)) TPPAGAMENTO,
                '' nrseq_pagto_controle,-- nrseq_pagto_controle
                99 nrpagamento,
                to_char(cdprestador) cdprestador,
                nrregistroinss,
                '800' cdevento,
                to_char(sum(vlsinal * vlpago_em_moeda),
                        '99999D99',
                        'NLS_NUMERIC_CHARACTERS = ''.,''') vlpago_em_moeda,
                null cdusuario,
                null nousuario2,
                null tpplano_usuario,
                null dtatendimento,
                null cdservico,
                null noservico,
                null nrgrau_particip,
                null qtservico,
                null aoemergencia,
                null aoutiliza_via,
                null cdocorrencia,
                null tpvalorizacao,
                null cdguia,
                null notipo_guia,
                noprestador,
                nrcgc_cpf,
                0 vlsinal,
                DECODE(substr(TPPAGAMENTO,1,6),'202012','TOTAIS (30/12/2020 e 20/01/2021)', 'TOTAIS') noevento,
                '800' cdcategoria_evento,
                'TOTAIS' nocategoria_evento,
                aocontrole,
                nocontrole,
                null cdtipo_tomador,
                NULL sinal,
                null cdtipo_guia,
                NULL txobservacao,
                '0' vlreferencia,
                '0' vlreferencia4,
                '0' vlreferencia5,
                0 vlreferencia2,
                cdtipo_pagamento,
                0 nrevento
           from srcadger.v_pagamento_prestador a
          where a.CDPRESTADOR = '$a1'
           and a.dt_anoref   = substr('$a6',1,4)
           and a.nr_perref   = substr('$a6',5,2)
           and a.AOCONTROLE = 1
           and a.cdevento   != 179

          group by data,
                   DECODE(substr(TPPAGAMENTO,1,6),'202012','202012 - Pagto: 12/20',substr(TPPAGAMENTO,1,16) || substr(TPPAGAMENTO,20,7)),
                   --nrseq_pagto_controle,
                   nrpagamento,
                   cdprestador,
                   nrregistroinss,
                   800,
                   DECODE(substr(TPPAGAMENTO,1,6),'202012','TOTAIS (30/12/2020 e 20/01/2021)', 'TOTAIS'),
                   noprestador,
                   nrcgc_cpf,
                   800,
                   'TOTAIS',
                   aocontrole,
                   nocontrole,
                   cdtipo_pagamento)
UNION ALL
(SELECT TO_CHAR(SYSDATE, 'DD/MM/YYYY HH24:MM:SS') DATA,
       NRPERIODO_COMPET || ' - Pagto: ' || NRSEQ_PAGTO_CONTROLE || ' - ' ||
       P.TPPAGAMENTO || ' - ' || C.DTPAGAMENTO TPPAGAMENTO,
       to_char(NRSEQ_PAGTO_CONTROLE),
       NRPAGAMENTO,
       CDPRESTADOR,
       to_char(NRREGISTROINSS),
       CDEVENTO,
       VLPAGO_EM_MOEDA,
       CDUSUARIO,
       NOUSUARIO2,
       TPPLANO_USUARIO,
       to_char(DTATENDIMENTO) DTATENDIMENTO,
       CDSERVICO,
       NOSERVICO,
       NRGRAU_PARTICIP,
       QTSERVICO,
       AOEMERGENCIA,
       AOUTILIZA_VIA,
       CDOCORRENCIA,
       TPVALORIZACAO,
       CDGUIA,
       NOTIPO_GUIA,
       NOPRESTADOR,
       NRCGC_CPF,
       VLSINAL,
       NOEVENTO,
       CDCATEGORIA_EVENTO,
       NOCATEGORIA_EVENTO,
       AOCONTROLE,
       NOCONTROLE,
       P.CDTIPO_TOMADOR,
       DECODE(P.vlsinal, 0, NULL, 1, '+', -1, '-') SINAL,
       CDTIPO_GUIA,
       TXOBSERVACAO,
       VLREFERENCIA,
       VLREFERENCIA4,
       VLREFERENCIA5,
       VLREFERENCIA2,
       CDTIPO_PAGAMENTO,
       P.NREVENTO
  FROM producao.V_CST_PAGMENTO_PRESTADOR P, producao.PAGAMENTO_CONTROLE C
 WHERE P.CDPRESTADOR = LPAD('$a1', 6, '0')
   AND P.NRSEQ_PAGTO_CONTROLE = '$a3'
   AND P.NRSEQ_PAGTO_CONTROLE = C.NRSEQUENCIAL))
 ORDER BY AOCONTROLE,
          TO_NUMBER(CDCATEGORIA_EVENTO),
          TO_NUMBER(CDEVENTO),
          CDTIPO_GUIA,
          NOUSUARIO2,
          DTATENDIMENTO,
          cdguia";
    
	$stmt = OCIParse($conn,$sql);
	OCIExecute($stmt);

      $cont=0;
      $pagina=0;
      $controle="cpd";
      $cartegoria="cpd";
      $txobservacao="cpd";
      $noevento="cpd";
      $tpguia="cpd";
      $vltotal=0.00;
      $qtservico=0.00;
      $vlcategoria=0.00;
      $nrevento=0;
      $total=0.00;
      while (OCIFetch($stmt)){ 

          if ($cont == 0) {
             $pagina=$pagina+1;
             $pdf->AddPage();
             $pdf->SetXY(10, 10);
             $pdf->SetFont('Helvetica', 'B', 10);
             $pdf->Image('img/logo.jpg',170,12,33,10,jpg);
             $pdf->Image('img/reg_ans.jpg',120,12,20,5,jpg);
             $pdf->Cell(60, 4, 'DEMONSTRATIVO ANALÍTICO',0, 'T', 'L', 0, 0);
             $pdf->SetFont('Helvetica', '', 7); 
             $pdf->Cell(25, 4,OCIResult($stmt,1), 0, 0, 'C', 0, 0);
             $pdf->Cell(10, 4, 'Pág: '."$pagina", 0, 0, 'L', 0, 0);
             $pdf->SetFont('Helvetica', 'B', 10);
             $pdf->Ln();
             $pdf->MultiCell(0, 7, 'DE PAGAMENTO', 0, 'L', 0, 0);
             $pdf->SetFont('Helvetica', 'B', 7); 
             $pdf->MultiCell(0, 4, 'Período: '.OCIResult($stmt,2), 0, 'L', 0, 0);
             $pdf->Cell(50, 4, 'Demonstrativo nº: '.OCIResult($stmt,4), 0, 0 ,'L', 0, 0);
             $pdf->Cell(100, 4,'CNPJ: 47565155000139', 0,0, 'C', 0, 0);
             $pdf->Ln();
             $pdf->Cell(15, 4, OCIResult($stmt,5),1 , 0, 'L', 0, 0);
             $pdf->Cell(98, 4, OCIResult($stmt,24),1 , 0, 'L', 0, 0);
             $pdf->Cell(40, 4, 'CPF/CNPJ: '.OCIResult($stmt,25),1 , 0, 'L', 0, 0);
             $pdf->Cell(40, 4, 'Inscr.INSS: '.OCIResult($stmt,6),1 , 0, 'L', 0, 0);
             $pdf->Ln();
             $pdf->SetTextColor(250, 250, 250);
             $pdf->Cell(18,4,'Guia',1,0,'L', 1, 1);
             $pdf->Cell(26,4,'Cód.Benef',1,0,'L', 1, 1);
             $pdf->Cell(40,4,'Nome Beneficiário',1,0,'L', 1, 1);
             $pdf->Cell(6,4,'Pla',1,0,'L', 1, 1);
             $pdf->Cell(15,4,'Data',1,0,'L', 1, 1);
             $pdf->Cell(49,4,'Serviço',1,0,'L', 1, 1);
             $pdf->Cell(12,4,'G.Part',1,0,'L', 1, 1);
             $pdf->Cell(12,4,'Qtde',1,0,'L', 1, 1);
             $pdf->Cell(15,4,'Valor(R$)',1,0,'L', 1, 1);
             $pdf->SetFont('Arial', '', 7);
             $pdf->Ln();
	       $pdf->SetTextColor(0, 0, 0);
          }

          $cont=$cont+1;

          if ($controle == "cpd"){
             $pdf->Ln();
             $pdf->SetFont('Arial', 'BU', 8);
             $pdf->MultiCell(0, 4,OCIResult($stmt,31), 0, 'C', 0, 0);
             $pdf->Ln();
             $pdf->SetFont('Arial', '', 7);
             $controle= OciResult($stmt,30);
             $cont=$cont+3;
             $vlcategoria=0.00;
          }

          if (($tpguia.$noevento <> OCIResult($stmt,23).OCIResult($stmt,27)) and
              ($tpguia <> "cpd")                and
			  ($qtservico > 0 )){
             $pdf->Cell(154, 4,"                Total guias tipo: ".$tpguia,'B',0,'L');
             $pdf->Cell(21, 4,"Servicos: ".$qtservico,'B',0,'L');
             $pdf->Cell(13, 4,number_format($total,2,",","."), 'B',0,'R');
             $pdf->Ln();
             $total=0;
             $qtservico=0;
             $cont=$cont+1;
          }

          if (($cartegoria.$controle <> OCIResult($stmt,29).OCIResult($stmt,30)) and
              ($cartegoria           <> "cpd")	   and
              ($cartegoria           <> "TOTAIS")  ){
             $pdf->SetFont('Arial', 'B', 7);
             $pdf->Cell(170, 4,"TOTAL: ".$cartegoria,'B',0,'L');
             $pdf->Cell( 18, 4,number_format($vlcategoria,2,",","."), 'B',0,'R');
             $pdf->SetFont('Arial', '', 7);
             $vlcategoria=0;
             $total=0;
             $qtservico=0;
             $pdf->Ln();
             $cont=$cont+2;

               if ((OciResult($stmt,30) == "1")   and
                   (OciResult($stmt,30) <> $controle)) { 
                  $pdf->Ln();
                  $pdf->SetFont('Arial', 'BU', 8);
                  $pdf->MultiCell(0, 4,OCIResult($stmt,31), 0, 'C', 0, 0);
                  $pdf->Ln();
                  $pdf->SetFont('Arial', '', 7);
                  $cartegoria="BRAZ";
                  $cont=$cont+3;
               }
          }

          $pdf->SetFont('Arial', 'B', 8);

          if ($cartegoria.$controle <> OCIResult($stmt,29).OCIResult($stmt,30)) {
             $cartegoria= OCIResult($stmt,29);
             $pdf->MultiCell(0, 4, OCIResult($stmt,28)." - ".OCIResult($stmt,29), 'T', 'L', 0, 0);
             $vlcategoria=0;
             $cont=$cont+1;
          }

          if ($noevento.$controle.$cartegoria.$txobservacao.$nrevento <> OCIResult($stmt,27).OCIResult($stmt,30).OCIResult($stmt,29).OCIResult($stmt,35).OCIResult($stmt,41)){
        
               $noevento = OCIResult($stmt,27);
               $controle= OciResult($stmt,30);
               $nrevento= OciResult($stmt,41);
               $txobservacao = OCIResult($stmt,35);
               if (OCIResult($stmt,30) ==  '0') {
                    $pdf->Cell(200, 4,"      Evento: ".OCIResult($stmt,7)."  ".OCIResult($stmt,27), 0, 0, 'L', 0, 0);
                    $pdf->Ln();
                    $cont=$cont+1;
               } Else{

                    $pdf->SetFont('Arial', '', 7);

                    if ( OCIResult($stmt,28) <> "300" ) {
                         $pdf->Cell(70, 4,"      ".OCIResult($stmt,7)."  ".OCIResult($stmt,27), 0, 0, 'L', 0, 0);
                         $pdf->Cell(80, 4,OCIResult($stmt,35),0,0,'L',0,0);
                         $pdf->Cell(38, 4,number_format(OCIResult($stmt,8),2,",","."),0,0,'R',0,0);
                         $pdf->Cell(2,3,OCIResult($stmt,33),0,0,'L');
                    }else 
                    {
                       if (OCIResult($stmt,7) == "302") {
                         $pdf->Cell(120,4,"      ".OCIResult($stmt,7)."  ".OCIResult($stmt,27), 0, 0, 'L', 0, 0);
                         $pdf->Cell(18, 4,"Base cálculo", 0, 0, 'L', 0, 0);
                         $pdf->Cell(12, 4,number_format(OCIResult($stmt,36),2,",","."),0,0,'R',0,0);
                         $pdf->Cell(38, 4,number_format(OCIResult($stmt,8),2,",","."),0,0,'R',0,0);
                         $pdf->Cell(2,3,OCIResult($stmt,33),0,0,'L');
                         $cont=$cont+1;
                       }

                       if (OCIResult($stmt,7) == "304") {
                         $pdf->Cell(70, 4,"      ".OCIResult($stmt,7)."  ".OCIResult($stmt,27), 0, 0, 'L', 0, 0);
                         $pdf->Cell(17, 4,"Base PRO ", 0, 0, 'L', 0, 0);
                         $pdf->Cell(12, 4,number_format(OCIResult($stmt,37),2,",","."),0,0,'R',0,0);
                         $pdf->Cell(12, 4,"Base P.F.", 0, 0, 'L', 0, 0);
                         $pdf->Cell(12, 4,number_format(OCIResult($stmt,38),2,",","."),0,0,'R',0,0);
                         $pdf->Cell(15, 4,"Base P.J.", 0, 0, 'L', 0, 0);
                         $pdf->Cell(12, 4,number_format(OCIResult($stmt,36),2,",","."),0,0,'R',0,0);
                         $pdf->Cell(38, 4,number_format(OCIResult($stmt,8),2,",","."),0,0,'R',0,0);
                         $pdf->Cell(2,3,OCIResult($stmt,33),0,0,'L');
                         $cont=$cont+1;
                       }

                    }
                    
                    $pdf->Ln();
                    $cont=$cont+2;
                    $pdf->SetFont('Arial', 'B', 8);
               }
          }


          if (($tpguia <> OCIResult($stmt,23)) and
              (OCIResult($stmt,30) <> "1")) {
             $tpguia= OCIResult($stmt,23);
             $pdf->Cell(100, 4,"              Tipo de Guia: ".OCIResult($stmt,34)."  ".OCIResult($stmt,23) , 0, 0, 'L', 0, 0);
             $pdf->Ln();
             $cont=$cont+3;
          }

          if (OCIResult($stmt,30) <> "1") {
          $pdf->SetFont('Arial', '', 7);
          $pdf->Cell(18,3,OCIResult($stmt,22),0,0,'L');
          $pdf->Cell(26,3,OCIResult($stmt,9),0,0,'L');
          $pdf->Cell(40,3,OCIResult($stmt,10),0,0,'L');
          $pdf->Cell(06,3,OCIResult($stmt,11),0,0,'L');
          $pdf->Cell(12,3,OCIResult($stmt,12),0,0,'L');
          $pdf->Cell(17,3,OCIResult($stmt,13),0,0,'L');
          $pdf->Cell(43,3,OCIResult($stmt,14),0,0,'L');
          $pdf->Cell(5,3,OCIResult($stmt,15),0,0,'C');
          $pdf->Cell(10,3,OCIResult($stmt,16),0,0,'L');
          $pdf->Cell(12,3,number_format(OCIResult($stmt,8),2,",","."),0,0,'R');
          $pdf->Cell(2,3,OCIResult($stmt,33),0,0,'C');
          $pdf->Cell(2,3,OCIResult($stmt,32),0,0,'C');
          $pdf->Ln();
          }

          if ($cont == 77) {$cont=0;} 
          $vlcategoria=$vlcategoria+OCIResult($stmt,8);
          $total=$total+OCIResult($stmt,8);
          $qtservico=$qtservico+OCIResult($stmt,16);
      }
}
// inicio do comprovante de recolhimento inss

if ($a2 == '2') {

$sqlc= "select  TO_CHAR(SYSDATE,'DD/MM/YYYY HH24:MM:SS') DATA, 
                pc.nrperiodo,
                pr.cdprestador,
                pe.nopessoa,
        	    pr.nrregistroinss,
                pe.nrcgc_cpf,
                pe.nrpis,
                to_char(mp.vlreferencia,'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''') VLREFERENCIA,
                to_char(mp.vlreferencia4,'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''') VLREFERENCIA4,
                to_char(mp.vlreferencia6,'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''') VLREFERENCIA6,
                to_char(mp.vlreferencia8,'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''') VLREFERENCIA8,
                to_char(mp.vlpago_em_moeda,'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''') vlpago_em_moeda,
                pc.dtpagamento dtcredito,
                SUBSTR(PC.NRPERIODO,5,2)||'/'||SUBSTR(PC.NRPERIODO,1,4) PERIODO,
                to_char(round(mp.vlreferencia8 - mp.vlreferencia4,2),'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''') saldo,
                to_char(round((mp.vlreferencia6 *
                              (SELECT substr(vlparametro,4,2)
                               FROM   PARAMETRO 
                               WHERE  CDPARAMETRO = 'INSSPJPF'))/ 100,2),'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''') CTPF,
                to_char(round((mp.vlreferencia *
                              (SELECT substr(vlparametro,1,2)
                               FROM   PARAMETRO 
                               WHERE  CDPARAMETRO = 'INSSPJPF'))/ 100,2),'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''')  CTPJ,
                to_char(round(mp.vlreferencia + mp.vlreferencia6,2),'99999D99','NLS_NUMERIC_CHARACTERS = ''.,''')  TOTAL
         from   pagamento_controle       pc,
                pagamento_controle_prest pcp,
                resumo_pagamento         mp,
                evento_prestador         ep,
                tipo_de_evento           te,
                prestador                pr,
                pessoa                   pe
         where  pcp.nrseq_pagto_controle = '$a3'
         and    pr.cdprestador           = lpad('$a1',6,'0')
         and    te.cdrotina              in ('PROC_PGINSS01', 'PROC_PGINSS02')
         and    pcp.nrseq_pagto_controle = pc.nrsequencial
         and    mp.nrseq_pagto_prest     = pcp.nrsequencial
         and    mp.nrevento              = ep.nrevento
         and    ep.cdevento              = te.cdevento
         and    pcp.nrregistro_prest     = pr.nrregistro_prest
         and    pr.nrregistro_prest      = pe.nrregistro";
    
	$stmtc= OCIParse($conn,$sqlc);
	OCIExecute($stmtc);

      while (OCIFetch($stmtc)){ 

          $pdf->AddPage();
          $pdf->SetXY(10, 10);
          $pdf->SetFont('Helvetica', 'B', 10);
          $pdf->Image('img/logo.jpg',170,12,33,10,jpg);
          $pdf->Image('img/reg_ans.jpg',120,12,20,5,jpg);
          $pdf->Cell(60, 4, "COMPROVANTE DE RECOLHIMENTO", 0, 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', '', 7); 
          $pdf->Cell(45, 4,OCIResult($stmtc,1), 0, 0, 'C', 0, 0);
          $pdf->SetFont('Helvetica', 'B', 10);
          $pdf->Ln();
          $pdf->MultiCell(0, 7, "DE INSS", 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', 'B', 7); 
          $pdf->MultiCell(0, 4, "Período: ".OCIResult($stmtc,2), 'B', 'C', 0, 0);
          $pdf->Ln();
          $pdf->Ln();
          $pdf->Ln();
          $pdf->Ln();
          $pdf->Ln();
          $pdf->Ln();
          $pdf->SetFont('Helvetica', 'B', 9); 
          $pdf->MultiCell(0, 7, "DECLARAÇÃO DE PAGAMENTO AO CONTRIBUINTE INDIVIDUAL", 1, 'C', 0, 0);
          $pdf->Ln();
          $pdf->MultiCell(0, 7, "EMPRESA", 1, 'C', 0, 0);
          $pdf->SetFont('Helvetica', 'B', 8);
          $pdf->MultiCell(0, 7, "UNIMED PINDAMONHANGABA COOPERATIVA DE TRABALHO MÉDICO", 1, 'C', 0, 0);
          $pdf->Cell(115, 4, "ENDEREÇO COMPLETO", 1, 0, 'C', 0, 0);
          $pdf->Cell(75, 4, "MUNICÍPIO UF", 1, 0, 'C', 0, 0);
          $pdf->SetFont('Helvetica', '', 7); 
          $pdf->Ln();
          $pdf->Cell(115, 4, "AV. NOSSA SENHORA DO BOM SUCESSO, 906/910", 1, 0, 'C', 0, 0);
          $pdf->Cell(75, 4, "PINDAMONHANGABA / SP", 1, 0, 'C', 0, 0);
          $pdf->Ln();
          $pdf->SetFont('Helvetica', 'B', 8); 
          $pdf->Cell(115, 4, "C.N.P.J.", 1, 0, 'C', 0, 0);
          $pdf->Cell(75, 4, "CÓDIGO DA OPERADORA", 1, 0, 'C', 0, 0);
          $pdf->SetFont('Helvetica', '', 7); 
          $pdf->Ln();
          $pdf->Cell(115, 4, "47565155000139", 1, 0, 'C', 0, 0);
          $pdf->Cell(75, 4, "342343", 1, 0, 'C', 0, 0);
          $pdf->Ln();
          $pdf->Ln();
          $pdf->SetFont('Helvetica', 'B', 9); 
          $pdf->MultiCell(0, 7, "DADOS DO CONTRIBUINTE INDIVIDUAL", 1, 'C', 0, 0);
          $pdf->SetFont('Helvetica', 'B', 8); 
          $pdf->Cell(25, 4, "NOME", 1, 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', '', 8); 
          $pdf->Cell(165, 4, OCIResult($stmtc,4), 1, 0, 'L', 0, 0);
          $pdf->Ln();
          $pdf->SetFont('Helvetica', 'B', 8); 
          $pdf->Cell(25, 4, "INSCRIÇÃO INSS", 1, 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', '', 8); 
          $pdf->Cell(102, 4, OCIResult($stmtc,5), 1, 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', 'B', 8); 
          $pdf->Cell(33, 4, "COMPETÊNCIA", 1, 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', '', 8); 
          $pdf->Cell(30, 4, OCIResult($stmtc,14), 1, 0, 'L', 0, 0);
          $pdf->Ln();
          $pdf->SetFont('Helvetica', 'B', 8); 
          $pdf->Cell(25, 4, "PIS", 1, 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', '', 8); 
          $pdf->Cell(102, 4, OCIResult($stmtc,7), 1, 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', 'B', 8); 
          $pdf->Cell(33, 4, "DATA DE CRÉDITO", 1, 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', '', 8); 
          $pdf->Cell(30, 4, OCIResult($stmtc,13), 1, 0, 'L', 0, 0);
          $pdf->Ln();
          $pdf->Ln();
          $pdf->SetFont('Helvetica', 'B', 8); 
          $pdf->Cell(63, 5, "TETO MÁXIMO DE CONTRIBUIÇÃO INSS", 1, 0, 'L', 0, 0);
          $pdf->Cell(64, 5, "(-) CONTRIBUIÇÃO EM OUTRAS FONTES", 1, 0, 'L', 0, 0);
          $pdf->Cell(63, 5, "SALDO", 1, 0, 'L', 0, 0);
          $pdf->Ln();
          $pdf->SetFont('Helvetica', '', 7); 
          $pdf->Cell(63, 7, number_format(OCIResult($stmtc,11),2,",",".") , 1, 0, 'R', 0, 0);
          $pdf->Cell(64, 7, number_format(OCIResult($stmtc,9),2,",",".") , 1, 0, 'R', 0, 0);
          $pdf->Cell(63, 7, number_format(OCIResult($stmtc,15),2,",","."), 1, 0, 'R', 0, 0);
          $pdf->Ln();
          $pdf->Ln();
          $pdf->SetFont('Helvetica', 'B', 9); 
          $pdf->MultiCell(0, 7, "CONTRIBUIÇÃO NESTA EMPRESA", 1, 'C', 0, 0);
          $pdf->SetFont('Helvetica', 'B', 8); 
          $pdf->Cell(63, 5, " ", 1, 0, 'L', 0, 0);
          $pdf->Cell(64, 5, "BASE", 1, 0, 'L', 0, 0);
          $pdf->Cell(63, 5, "CONTRIBUIÇÃO", 1, 0, 'L', 0, 0);
          $pdf->Ln();
          $pdf->Cell(63, 7, "CONTRIBUIÇÃO SOBRE PESSOA FÍSICA" , 1, 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', '', 7); 
          $pdf->Cell(64, 7, number_format(OCIResult($stmtc,10),2,",",".") , 1, 0, 'R', 0, 0);
          $pdf->Cell(63, 7, number_format(OCIResult($stmtc,16),2,",",".") , 1, 0, 'R', 0, 0);
          $pdf->Ln();
          $pdf->SetFont('Helvetica', 'B', 8); 
          $pdf->Cell(63, 7, "CONTRIBUIÇÃO SOBRE PESSOA JURÍDICA" , 1, 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', '', 7); 
          $pdf->Cell(64, 7, number_format(OCIResult($stmtc,8),2,",","."), 1, 0, 'R', 0, 0);
          $pdf->Cell(63, 7, number_format(OCIResult($stmtc,17),2,",",".") , 1, 0, 'R', 0, 0);
          $pdf->Ln();
          $pdf->SetFont('Helvetica', 'B', 8); 
          $pdf->Cell(63, 7, "TOTAL" , 1, 0, 'L', 0, 0);
          $pdf->SetFont('Helvetica', '', 7); 
          $pdf->Cell(64, 7, number_format(OCIResult($stmtc,18),2,",",".") , 1, 0, 'R', 0, 0);
          $pdf->Cell(63, 7, number_format(OCIResult($stmtc,12),2,",",".") , 1, 0, 'R', 0, 0);


      }
}

//fim do comprovente de recolhimento inss

      $pdf->Output();
	OCIFreeStatement($stmt,$stmt1,$stmtpa);
	OCILogoff($conn);

?>

