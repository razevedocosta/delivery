<?php
	include ("../../connection/conexao.php");

	extract ($_POST);
			
	$string = '';
	foreach($_POST["ch"] as $produto) {
    	$string = $produto.'; '.$string;
	}

  	$sql = "INSERT INTO kits (id, nome, valor, itens) VALUES ('', '$nome', '$result', '".$string."') ";
		
	$resultado = mysql_query($sql) or die(mysql_error());
	
	if ($resultado) {
		header('Location: ../../?page=kitsCad&res=success');
	} else {
		header('Location: ../../?page=kitsCad&res=error');
	}
?>