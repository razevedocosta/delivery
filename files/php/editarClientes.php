<?php
	include ("../../connection/conexao.php");

	extract ($_POST);
	
	$sql = "UPDATE clientes SET nome = '$nome', endereco = '$endereco', complemento = '$complemento', bairro = '$bairro', telefone = '$telefone' WHERE id = '".$idCliente."'";
	$resultado = mysql_query($sql) or die(mysql_error());
	
	if ($resultado) {
		header('Location: ../../?page=clientesCon&res=success');
	} else {
		header('Location: ../../?page=clientesCon&res=error');
	}
?>