<?php
	require_once('connection/conexao.php');
	//mysql_select_db($database, $conexao);
	
	$query = "SELECT * FROM pedidos";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);

	if (!empty($total)){
		foreach($dados as $d){
			$var = explode(';',$d);  // separar as frutas no campo item
		}
	}

	$query = "SELECT * FROM frutas ORDER BY id";
	$queryFru = mysql_query($query, $conexao) or die(mysql_error());
	$frutas = mysql_fetch_assoc($queryFru);
	$totalFru = mysql_num_rows($queryFru);
	
	$totalpedido = 0;
?>

<form class="form-horizontal" action="" method="post">
<legend>Relação de itens para comprar

	<a href="relatorioItensAComprar.php"><span class="label label-info right"><i class="icon icon-print icon-white"></i> Imprimir</span></a>
</legend>

<span class="label label-inverse" style="float:right;"><?php echo 'Total de pedidos: '.$total; ?></span>

<table class="table table-striped">
	<thead>
    	<tr>            
            <th width="20%">Itens</th>
            <th width="20%">Unidade</th>
            <th width="20%">Preço de compra</th>
            <th width="20%">Quantidade</th>
            <th width="20%">Preço por item</th>
        </tr>
    </thead>
    
    <tbody>  
    
    	<?php do { 
			$queryC = "SELECT SUM(".$frutas['string'].") as qtdeItem FROM pedidositens";
			$queryFruC = mysql_query($queryC, $conexao) or die(mysql_error());
			$frutasC = mysql_fetch_assoc($queryFruC);
			$totalFruC = mysql_num_rows($queryFruC);
			
			$precoPorItem = $frutas['preco_compra'] * $frutasC['qtdeItem'];
		?>
            <tr>
                <td><?php echo $frutas['nome']; ?>
                	<input type="hidden" name="item<?php echo $frutas['id']; ?>" value="<?php echo $frutas['nome']; ?>" />
                </td>
                <td><?php echo $frutas['porcao'].' '.$frutas['unidade']; ?></td>
                <td><input class="input-medium focused span6 calc" name="valor<?php echo $frutas['id']; ?>" id="valor<?php echo $frutas['id']; ?>" readonly="readonly" type="text" value="<?php echo $frutas['preco_compra']; ?>"/></td>
				<td>
                <input class="input-medium focused span6 calc" name="qtde<?php echo $frutas['id']; ?>" id="qtde<?php echo $frutas['id']; ?>"  type="text" readonly="readonly" value="<?php echo $frutasC['qtdeItem']; ?>"/>               
                </td>
				<td><input type="text" id="total<?php echo $frutas['id']; ?>" name="total<?php echo $frutas['id']; ?>" class="input-medium focused span6 result" readonly="readonly" value="<?php echo number_format($precoPorItem, 2, ',', '.'); ?>" /></td>
			</tr>
            <?php 
				$totalpedido = $totalpedido + $precoPorItem;
			} while ($frutas = mysql_fetch_assoc($queryFru)); ?>
            
			<tr>
            	<td></td>
                <td></td>
                <td></td>
            	<td><b>Total para compra</b></td>
                <td><input type="text" name="totalpedido" id="totalpedido" class="span6 result" readonly="readonly" value="<?php echo $totalpedido; ?>" /></td>
            </tr>             
       
    </tbody>
</table>