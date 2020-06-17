<?php
	require_once('connection/conexao.php');
	//mysql_select_db($database, $conexao);
	
	$query = "SELECT * FROM kits";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);
?>

<form class="form-horizontal" action="?page=esconsultar&acao=busca" method="post">
<legend>Kits</legend>

<span class="label label-inverse" style="float:right;"><?php echo 'Total: '.$total; ?></span>

<table class="table table-striped">
	<thead>
    	<tr>
        	<th>#</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Itens</th>
            <th></th>
        </tr>
    </thead>
    
    <tbody>  
    
    	<?php do { ?>
	    <tr>
            <td><?php echo $dados['id']; ?></td>
            <td><?php echo $dados['nome']; ?></td>
            <td><?php echo $dados['valor']; ?></td>
            <td><?php echo $dados['itens']; ?></td>            
			<td><a href="#" title="editar"><span class="label label-info"><i class="icon-white icon-pencil"></i></span></a></td>            
        </tr>
        <?php } while ($dados = mysql_fetch_assoc($rs_query)); ?>
       
    </tbody>
</table>