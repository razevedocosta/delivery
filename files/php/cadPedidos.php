<?php
	include ("../../connection/conexao.php");

	extract ($_POST);
		
	$string = '';
	for($i=1; $i<=25; $i++){
		$var = $_POST['qtde'.$i];
		if(!empty($var)){
			$item = $_POST['qtde'.$i].'-'.$_POST['item'.$i];
			$string = $string.''.$item.'; ';
		}
	}
		
  	$sql = "INSERT INTO pedidos (id, cliente, dataEntrega, kit, total, itens) VALUES ('', '$cliente', '$data', '$kit', '$totalpedido', '".$string."') ";
	$resultado = mysql_query($sql) or die(mysql_error());
	
	$query = "SELECT MAX(id) as id FROM pedidos";
	$query1 = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($query1);
	$total = mysql_num_rows($query1);

	$sql2 = "INSERT INTO pedidositens (id, idPedido, abacate, abacaxi, ameixa, banana, kiwi, laranja, maca, mamao, manga, maracuja, melancia, melao, morango, pacova, pera, tangerina, uvared, uvasemsemente, batatadoce, batataportuguesa, beterraba, cara, cenoura, jerimum, macaxeira) VALUES ('',".$dados['id'].",".$qtde1.",".$qtde2.",".$qtde3.",".$qtde4.",".$qtde5.",".$qtde6.",".$qtde7.",".$qtde8.",".$qtde9.",".$qtde10.",".$qtde11.",".$qtde12.",".$qtde13.",".$qtde14.",".$qtde15.",".$qtde16.",".$qtde17.",".$qtde18.",".$qtde19.",".$qtde20.",".$qtde21.",".$qtde22.",".$qtde23.",".$qtde24.",".$qtde25.")";
	$resultado2 = mysql_query($sql2) or die(mysql_error());
	
	if ($resultado2) {
		header('Location: ../../?page=pedidosCad&res=success');
	} else {
		header('Location: ../../?page=pedidosCad&res=error');
	}
?>