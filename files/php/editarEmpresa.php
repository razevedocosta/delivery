<?php
	include ("../../connection/conexao.php");

	extract ($_POST);
	
	$sql = "UPDATE empresa SET cnpj = '$cnpj', nome = '$nome', endereco = '$endereco', numero = '$numero', bairro = '$bairro', responsavel =  '$responsavel', telefone = '$telefone' WHERE codigo = '$codigo'";
	$resultado = mysql_query($sql) or die(mysql_error());
	
	if ($resultado) {
		header('Location: ../../?page=emeditar&c='.$codigo.'&res=success');
	} else {
		header('Location: ../../?page=emeditar&c='.$codigo.'&=res=error');
	}
?>