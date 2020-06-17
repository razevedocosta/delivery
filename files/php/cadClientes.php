<?php
	include ("../../connection/conexao.php");

	extract ($_POST);
	
	$sql = "INSERT INTO clientes (nome, endereco, complemento, bairro, telefone) 
			VALUES ('$nome','$endereco','$complemento','$bairro','$telefone')";
	$resultado = mysql_query($sql) or die(mysql_error());
	
	if ($resultado) {
		header('Location: ../../?page=clientesCad&res=success');
	} else {
		header('Location: ../../?page=clientesCad&res=error');
	}
?>