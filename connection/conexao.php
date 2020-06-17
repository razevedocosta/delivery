<?php 
	$conexao = mysql_connect("localhost", "root", "") or die("Erro na conexao!");
	$db = mysql_select_db("delivery_db", $conexao) or die("Erro ao selecionar banco de dados!");

	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
?>

<?php
	/*$hostname = "localhost";
	$database = "delivery_db";
	$username = "root";
	$password = "";
	$conexao = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');*/
?>