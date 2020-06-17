<?php
	include ("../../connection/conexao.php");

	extract ($_POST);
	
	$sql = "UPDATE frutas SET nome = '$nome', string = '$string', porcao = '$porcao', unidade = '$unidade', preco_compra = '$preco_compra', preco_venda = '$preco_venda' WHERE id = '".$idItem."'";
	$resultado = mysql_query($sql) or die(mysql_error());
	
	if ($resultado) {
		header('Location: ../../?page=frutasCon&res=success');
	} else {
		header('Location: ../../?page=frutasCon&res=error');
	}
?>