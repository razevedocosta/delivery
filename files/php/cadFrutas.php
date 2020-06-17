<?php
	include ("../../connection/conexao.php");

	extract ($_POST);
	
	$sql = "INSERT INTO frutas (nome, string, porcao, unidade, preco_compra, preco_venda) 
			VALUES ('$nome','$string','$porcao','$unidade','$preco_compra','$preco_venda')";
	$resultado = mysql_query($sql) or die(mysql_error());
	
	if ($resultado) {
		header('Location: ../../?page=frutasCad&res=success');
	} else {
		header('Location: ../../?page=frutasCad&res=error');
	}
?>