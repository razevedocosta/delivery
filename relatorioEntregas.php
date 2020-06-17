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
	$query = "SELECT c.nome, c.endereco, c.complemento, c.bairro, p.kit, p.total, p.id
			  FROM pedidos as p, clientes as c
			  WHERE p.cliente = c.nome
			  ORDER BY p.id";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);
	
	$pdf= new PDF("L","pt","A4");
	$pdf->AddPage();
	$pdf->SetDrawColor(160,160,160); // cor das bordas da tabela
	
	$pdf->SetFont('arial','B',18);
	$pdf->Cell(0,5,utf8_decode('Relatório de Entregas'),0,1,'C');
	$pdf->Cell(0,5,"","B",1,'C');
	$pdf->Ln(30);
	 
	// Cabeçalho
	$pdf->SetFont('arial','B',11);
	$pdf->Cell(20,20,'#',1,0,"L");
	$pdf->Cell(120,20,'Cliente',1,0,"L");
	$pdf->Cell(250,20,utf8_decode('Endereço'),1,0,"L");
	$pdf->Cell(150,20,'Complemento',1,0,"L");
	$pdf->Cell(120,20,'Bairro',1,0,"L");
	$pdf->Cell(60,20,'Kit',1,0,"L");
	$pdf->Cell(60,20,'Valor',1,1,"L");
	// widht, height, texto, 0-sem borda 1-com borda, 0-exibe na direita 1-exibe na proxima linha 2-exibe abaixo, L-esquerda C-cento R-direita
	 
	$zebrado = false;
	// Linhas
	$pdf->SetFont('arial','',10);
	do {
		if($zebrado){
			$pdf->SetFillColor(220,220,220);
		    $zebrado = false; 	
		} else {
			$pdf->SetFillColor(255,255,255);
			$zebrado = true ; 
		}
			
		$pdf->Cell(20,20,$dados['id'],0,0,"L",true);
		$pdf->Cell(120,20,utf8_decode($dados['nome']),0,0,"L",true);
		$pdf->Cell(250,20,utf8_decode($dados['endereco']),0,0,"L",true);
		$pdf->Cell(150,20,utf8_decode($dados['complemento']),0,0,"L",true);
		$pdf->Cell(120,20,utf8_decode($dados['bairro']),0,0,"L",true);
		$pdf->Cell(60,20,$dados['kit'],0,0,"L",true);
		$pdf->Cell(60,20,'R$ '.$dados['total'],0,1,"L",true);
	} while ($dados = mysql_fetch_assoc($rs_query));
		
	$pdf->Output("arquivo.pdf","I");
	// I envia o documento diretamente para o browser
	// D força o download
	// F salva em um arquivo local
?>