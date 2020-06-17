	<?php
	require_once('connection/conexao.php');
	//mysql_select_db($database, $conexao);
	$id = $_GET['id'];
	$query = "SELECT *
			  FROM pedidos as p, clientes as c
			  WHERE c.nome = p.cliente
			  AND p.id = '".$id."'";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);
	$itens = $dados['itens'];
?>

<form class="form-horizontal" action="?page=esconsultar&acao=busca" method="post">
<legend>Espelho de pedido
<a href="?page=pedidosCon" title="Voltar"><button type="button" class="btn right"> <i class="icon icon-chevron-left"></i> Voltar </button></a>
</legend>

<table class="table table-striped">
	<thead>
    	<tr>
        	<th>#</th>
            <th>Cliente</th>
            <th>Endereço</th>
            <th>Complemento</th>
            <th>Bairro</th>
            <th>Kit</th>
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

<br />
<h5>Detalhamento do pedido</h5>
<hr />
<table class="table table-striped">
	<thead>
    	<tr>
        	<th>#</th>
            <th>Item</th>
            <th>Porção</th>
            <th>Valor Unitário</th>
            <th>Quantidade</th>
            <th>Valor por Item</th>
        </tr>
	</thead>
    <tbody>
    
		<?php
        $i = 0; // Deve começar com 0, pois a string concatena após o nome do item
        $j = 1; // contador de itens
        $taxa = 7;
        $subtotal = 0;
        
        $var = explode(';',$itens);
		
		$totalDeItens = count($var)-1;
		
        while ($i < $totalDeItens) {
            $varItens = explode('-',$var[$i]); // Divide os itens em: quantidade e nome
            $qtde = $varItens[0]; // quantidade
            $item = $varItens[1]; // nome
			//echo '<pre>' . print_r($varItens, true) . '</pre>' . PHP_EOL;
            
            $queryItem = "SELECT * FROM frutas as f WHERE f.nome = '".$item."' ";
            $rs_queryItem = mysql_query($queryItem, $conexao) or die(mysql_error());
            $dadosItem = mysql_fetch_assoc($rs_queryItem);
            $totalItem = mysql_num_rows($rs_queryItem); 
            
            $valorPorItem = $qtde * $dadosItem['preco_venda']; 
            $subtotal = $subtotal + $valorPorItem; 
			
			if (!empty($dadosItem['nome'])) { ?>
            
            <tr>
                <td><?php echo $j; ?></td>
                <td><?php echo $dadosItem['nome']; ?></td>
                <td><?php echo $dadosItem['porcao'].' '.$dadosItem['unidade']; ?></td>
                <td><?php echo $dadosItem['preco_venda']; ?></td>            
                <td><?php echo $qtde; ?></td>
                <td><?php echo number_format($valorPorItem,2,',','.'); ?></td>            
            </tr>
            
        <?php }
			$i++; 
			if(empty($var[$i]))
				break;
			
			$j++; 
			$var = explode(';',$itens); // Pega os itens e as quantidades do campo itens
        } ?>
    
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Sub-total:</b></td>
            <td><?php echo number_format($subtotal,2,',','.'); ?></td>            
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Taxa de entrega:</b></td>
            <td><?php echo '7,00'; ?></td>            
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total do pedido:</b></td>
            <td><?php echo number_format($subtotal+$taxa,2,',','.'); ?></td>            
        </tr>        
    </tbody>
</table>