<?php
	require_once("files/fpdf/fpdf.php");	
	require_once('connection/conexao.php');
	
	class PDF extends FPDF{		
		function Footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'rodrigo',0,0,'R');
		}
	}	
	
	// convert(campo using binary) as campo para reconhecer acentos
	$query = "SELECT * FROM pedidos";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);

	if (!empty($total)){
		foreach($dados as $d){
			$var = explode(';',$d);  // separar as frutas no campo item
		}
	}

	$query = "SELECT * FROM frutas ORDER BY id";
	$queryFru = mysql_query($query, $conexao) or die(mysql_error());
	$frutas = mysql_fetch_assoc($queryFru);
	$totalFru = mysql_num_rows($queryFru);
	
	$totalpedido = 0;
	
	$pdf= new PDF("P","pt","A4");
	$pdf->AddPage();
	$pdf->SetDrawColor(160,160,160); // cor das bordas da tabela
	
	$pdf->SetFont('arial','B',18);
	$pdf->Cell(0,5,utf8_decode('Relação de Itens para comprar'),0,1,'C');
	$pdf->Cell(0,5,"","B",1,'C');
	$pdf->Ln(30);
	 
	// Cabeçalho
	$pdf->SetFont('arial','B',10);
	$pdf->Cell(90,20,'Itens',1,0,"L");
	$pdf->Cell(90,20,'Unidade',1,0,"C");
	$pdf->Cell(90,20,utf8_decode('Preço de compra'),1,0,"C");
	$pdf->Cell(90,20,'Quantidade',1,0,"C");
	$pdf->Cell(90,20,'Convertido',1,0,"C");	
	$pdf->Cell(90,20,utf8_decode('Preço por item'),1,1,"C");
	// widht, height, texto, 0-sem borda 1-com borda, 0-exibe na direita 1-exibe na proxima linha 2-exibe abaixo, L-esquerda C-cento R-direita
	 
	$zebrado = false;
	// Linhas
	$pdf->SetFont('arial','',10);
	do {
		$queryC = "SELECT SUM(".$frutas['string'].") as qtdeItem FROM pedidosItens";
		$queryFruC = mysql_query($queryC, $conexao) or die(mysql_error());
		$frutasC = mysql_fetch_assoc($queryFruC);
		$totalFruC = mysql_num_rows($queryFruC);
		
		$precoPorItem = $frutas['preco_compra'] * $frutasC['qtdeItem'];
		
		// zebrado
		if($zebrado){
			$pdf->SetFillColor(220,220,220);
		    $zebrado = false; 	
		} else {
			$pdf->SetFillColor(255,255,255);
			$zebrado = true ; 
		}
			
		$pdf->Cell(90,20,utf8_decode($frutas['nome']),0,0,"L",true);
		$pdf->Cell(90,20,$frutas['porcao'].' '.$frutas['unidade'],0,0,"C",true);
		$pdf->Cell(90,20,$frutas['preco_compra'],0,0,"C",true);
		$pdf->Cell(90,20,$frutasC['qtdeItem'],0,0,"C",true);
		$pdf->Cell(90,20,$frutasC['qtdeItem']*$frutas['porcao'].' '.$frutas['unidade'],0,0,"C",true);		
		$pdf->Cell(90,20,number_format($precoPorItem, 2, ',', '.'),0,1,"C",true);
		
		$totalpedido = $totalpedido + $precoPorItem;
	} while ($frutas = mysql_fetch_assoc($queryFru));

	
	$pdf->SetFillColor(255,255,255);
	$pdf->Cell(550,20,'',0,1,"L",true);
	$pdf->Cell(0,5,"","B",1,'C');
	$pdf->SetFont('arial','B',10);	
	$pdf->Cell(430,20,'Total para compra:',0,0,"R",true);
	$pdf->Cell(110,20,number_format($totalpedido, 2, ',', '.'),0,1,"C",true);
		
	$pdf->Output("arquivo.pdf","I");
	// I envia o documento diretamente para o browser
	// D força o download
	// F salva em um arquivo local
?>