// JavaScript Document 
// FUNÇÃO RESPONSÁVEL DE CONECTAR A UMA PAGINA EXTERNA NO NOSSO CASO A BUSCA_NOME.PHP 
// E RETORNAR OS RESULTADOS 

//readyState:
//Inteiro representando o estado da requisição:
//0 = não inicializado
//1 = carregando
//2 = carregado
//3 = modo interativo
//4 = completado

function ajax(url)
{ 

	req = null; 
	// Procura por um objeto nativo (Mozilla/Safari) 
	if (window.XMLHttpRequest) 
	{ 
		req = new XMLHttpRequest(); 
		req.onreadystatechange = processReqChange;
		req.open("GET",url,true);
		req.send(null); 
        // Procura por uma versão ActiveX (IE)
	} 
	else if (window.ActiveXObject) 
	{ 
		req = new ActiveXObject("Microsoft.XMLHTTP"); 
		if (req) 
			{
				req.onreadystatechange = processReqChange; 
				req.open("GET",url,true); 
				req.send();
				
			}
	}
}

function processReqChange()
{ 

	// apenas quando o estado for "completado" 
	if (req.readyState == 4) 
	{ 

		// apenas se o servidor retornar "OK" 
		if (req.status == 200)
        { 

		// procura pela div id="pagina" e insere o conteudo 
		// retornado nela, como texto HTML 

		document.getElementById("aviso").innerHTML = "";
		document.getElementById("res").innerHTML = req.responseText;

		} 
		else 
		{ 
			alert("Houve um problema ao obter os dados:n" + req.statusText); 
		} 
	}
	else
		if(req.readyState == 1)
		{
			document.getElementById("aviso").innerHTML = "<img src='imagens/load.gif'/> <b>Aguarde...</b> ";
		}
} 

function consult(prod, i, f)
{
    //FUNÃO QUE MONTA A URL E CHAMA A FUNÃO AJAX
    url="consulta.php?login="+prod;
    ajax(url);
}

function abrir(URL) 
{
  var width = 620;
  var height = 650;
  var left = 50;
  var top = 50;

  window.open(URL,'Imprimir', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=no, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
}