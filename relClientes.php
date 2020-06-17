	<?php
	require_once('connection/conexao.php');
	//mysql_select_db($database, $conexao);
	
	$query = "SELECT c.nome, c.endereco, c.complemento, c.bairro, p.kit, p.total, p.id
			  FROM pedidos as p, clientes as c
			  WHERE p.cliente = c.nome
			  ORDER BY p.id";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);
?>

<form class="form-horizontal" action="?page=esconsultar&acao=busca" method="post">
<legend>Relatório de Clientes e Kits 

	<a href="relatorioEntregas.php"><span class="label label-info right"><i class="icon icon-print icon-white"></i> Imprimir</span></a>

</legend>

<span class="label label-inverse" style="float:right;"><?php echo 'Total: '.$total; ?></span>

<table class="table table-striped" style="font-size:12px;">
	<thead>
    	<tr>
        	<th>#</th>
            <th>Cliente</th>
            <th>Endereço</th>
            <th>Complemento</th>
            <th>Bairro</th>
            <th width="8%">Kit</th>
            <th>Valor</th>
        </tr>
    </thead>
    
    <tbody>  
    
    	<?php do { ?>
	    <tr>
            <td><?php echo $dados['id']; ?></td>
            <td><?php echo $dados['nome']; ?></td>
            <td><?php echo $dados['endereco']; ?></td>
            <td><?php echo $dados['complemento']; ?></td>            
            <td><?php echo $dados['bairro']; ?></td>
            <td><?php echo $dados['kit']; ?></td>
            <td><?php echo $dados['total']; ?></td>            
        </tr>
        <?php } while ($dados = mysql_fetch_assoc($rs_query)); ?>
       
    </tbody>
</table>