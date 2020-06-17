<?php
	require_once("files/fpdf/fpdf.php");	
	require_once('connection/conexao.php');
	
	/*class PDF extends FPDF{		
		function Footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'rodrigo',0,0,'R');
		}
	}	*/

	// Select para dados do cliente e itens
	$id = $_GET['id'];
	$query = "SELECT *
			  FROM pedidos p, clientes c
			  WHERE p.cliente = c.nome
			  AND p.id = '".$id."'";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);
	$itens = $dados['itens'];
	
	$pdf= new FPDF("P","pt","A4"); // P-Paisagem L-Retrato
	$pdf->AddPage();
	$pdf->Image('files/img/logo.fw.png');
	$pdf->SetDrawColor(160,160,160); // cor das bordas da tabela
	$pdf->Cell(0,5,"","B",1,'C');
	
	$pdf->SetFont('arial','B',11);
	$pdf->Cell(0,20,"Espelho do Pedido",0,1,'C');
	$pdf->Ln(5);
	
	$pdf->SetFont('arial','',10);
	$pdf->Cell(390,20,'Nome: '.$dados['cliente'],0,0,'L');
	$data = date_create($dados['dataEntrega']);
	$pdf->Cell(150,20,'Data: '.date_format($data, 'd/m/Y'),0,1,'R');	
	$pdf->Cell(150,20,utf8_decode('Endereço: '.$dados['endereco'].' - '.$dados['complemento']),0,1,'L');
	$pdf->Cell(150,20,utf8_decode('Bairro: '.$dados['bairro']),0,1,'L');
	$pdf->Cell(0,5,"","B",1,'C');
	$pdf->Ln(20);
	 
	// Cabeçalho da tabela
	$pdf->SetFont('arial','B',10);
	$pdf->Cell(30,20,'#',1,0,"C");
	$pdf->Cell(150,20,'Item',1,0,"L");
	$pdf->Cell(90,20,utf8_decode('Porção'),1,0,"C");
	$pdf->Cell(90,20,utf8_decode('Valor Unitário'),1,0,"C");
	$pdf->Cell(90,20,'Quantidade',1,0,"C");
	$pdf->Cell(90,20,'Valor por Item',1,1,"C");
	// widht, height, texto, 0-sem borda 1-com borda, 0-exibe na direita 1-exibe na proxima linha 2-exibe abaixo, L-esquerda C-cento R-direita
	 
	// Laço dos itens do pedido 	 
	$i = 0; // Deve começar com 0, pois a string concatena após o nome do item
	$j = 1; // contador de itens
	$taxa = 7;
	$subtotal = 0;
	$k=0;
	
	$zebrado = false;
	
	$var = explode(';',$itens);	

	$totalDeItens = count($var)-1;
	//echo '<pre>' . print_r($var, true) . '</pre>' . PHP_EOL;
	
	while ($i < $totalDeItens) {
		$varItens = explode('-',$var[$i]); // Divide os itens em: quantidade e nome
		$qtde = $varItens[0]; // quantidade
		$item = $varItens[1]; // nome
		
		$queryItem = "SELECT * FROM frutas WHERE nome = '".$item."' ";
		$rs_queryItem = mysql_query($queryItem, $conexao) or die(mysql_error());
		$dadosItem = mysql_fetch_assoc($rs_queryItem);
		$totalItem = mysql_num_rows($rs_queryItem); 
		
		$valorPorItem = $qtde * $dadosItem['preco_venda']; 
		$subtotal = $subtotal + $valorPorItem;

		// zebrado
		if($zebrado){
			$pdf->SetFillColor(220,220,220);
		    $zebrado = false; 	
		} else {
			$pdf->SetFillColor(255,255,255);
			$zebrado = true ; 
		}
	
		// Linhas
		$pdf->SetFont('arial','',10);
		$pdf->Cell(30,20,$j,0,0,"C",true);
		$pdf->Cell(150,20,utf8_decode($dadosItem['nome']),0,0,"L",true);
		$pdf->Cell(90,20,utf8_decode($dadosItem['porcao'].' '.$dadosItem['unidade']),0,0,"C",true);
		$pdf->Cell(90,20,number_format($dadosItem['preco_venda'],2,',','.'),0,0,"C",true);
		$pdf->Cell(90,20,$qtde,0,0,"C",true);
		$pdf->Cell(90,20,number_format($valorPorItem,2,',','.'),0,1,"C",true);
	
		$i++;
		if(empty($var[$i]))
			break;
			
		$j++; 
		$var = explode(';',$itens); // Pega os itens e as quantidades do campo itens
    }

	$pdf->Cell(30,20,'',0,0,"L");
	$pdf->Cell(150,20,'',0,0,"L");
	$pdf->Cell(90,20,'',0,0,"L");
	$pdf->Cell(90,20,'',0,0,"L");
	$pdf->Cell(90,20,'',0,0,"L");
	$pdf->Cell(90,20,'',0,1,"L");
		
	$pdf->Cell(30,20,'',0,0,"L");
	$pdf->Cell(150,20,'',0,0,"L");
	$pdf->Cell(90,20,'',0,0,"L");
	$pdf->Cell(90,20,'',0,0,"L");
	$pdf->Cell(90,20,'Sub-total:',0,0,"R");
	$pdf->Cell(90,20,number_format($subtotal,2,',','.'),0,1,"C");
		
	$pdf->Cell(30,20,'',0,0,"L");
	$pdf->Cell(150,20,'',0,0,"L");
	$pdf->Cell(90,20,'',0,0,"L");
	$pdf->Cell(90,20,'',0,0,"L");
	$pdf->Cell(90,20,'Taxa de entrega:',0,0,"R");
	$pdf->Cell(90,20,'7,00',0,1,"C");
	
	$pdf->SetFont('arial','B',10);
	$pdf->Cell(30,20,'',0,0,"L");
	$pdf->Cell(150,20,'',0,0,"L");
	$pdf->Cell(90,20,'',0,0,"L");
	$pdf->Cell(90,20,'',0,0,"L");
	$pdf->Cell(90,20,'Total do pedido:',0,0,"R");
	$pdf->Cell(90,20,number_format($subtotal+$taxa,2,',','.'),0,1,"C");	
		
	$pdf->Output("arquivo.pdf","I");
	// I envia o documento diretamente para o browser
	// D força o download
	// F salva em um arquivo local
?>