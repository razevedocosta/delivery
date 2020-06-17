<?php
	require_once('connection/conexao.php');
	//mysql_select_db($database, $conexao);
	
	$query = "SELECT * FROM pedidos";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);
?>

<form class="form-horizontal" action="?page=esconsultar&acao=busca" method="post">
<legend>Pedidos</legend>

<span class="label label-inverse" style="float:right;"><?php echo 'Total: '.$total; ?></span>

<table class="table table-striped">
	<thead>
    	<tr>
        	<th width="2%">#</th>
            <th width="20%">Cliente</th>
            <th width="9%">Kit</th>
            <th width="6%">Total</th>
            <th>Itens</th>
            <th colspan="2">Espelho</th>
            <th>Op</th>
        </tr>
    </thead>
    
    <tbody>  
    
    	<?php do { ?>
	    <tr>
            <td><?php echo $dados['id']; ?></td>
            <td><?php echo $dados['cliente']; ?></td>
            <td><?php echo $dados['kit']; ?></td>
            <td><?php echo $dados['total']; ?></td>
            <td><?php echo $dados['itens']; ?></td>			
            <td style="text-align:center;"><a href="relatorioPedidos.php?id=<?php echo $dados['id']; ?>" title="PDF"><span class="label"><i class="icon-white icon-print"></i></span></a></td>
            <td style="text-align:center;"><a href="?page=teste&id=<?php echo $dados['id']; ?>" title="Na tela"><span class="label"><i class="icon-white icon-zoom-in"></i></span></a></td>
            <td><a href="?page=pedidosEdit&id=<?php echo $dados['id']; ?>" title="editar"><span class="label label-info"><i class="icon-white icon-pencil"></i></span></a></td>
        </tr>
        <?php } while ($dados = mysql_fetch_assoc($rs_query)); ?>
       
    </tbody>
</table>