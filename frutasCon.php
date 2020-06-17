<?php
	require_once('connection/conexao.php');
//	mysql_select_db($database, $conexao);
	
	$query = "SELECT * FROM frutas ORDER BY id";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);
?>

<form class="form-horizontal" action="?page=esconsultar&acao=busca" method="post">

<?php if (isset($_GET['res'])) { ?>
    <?php if ($_GET['res'] == 'success') { ?>
    	<div class="alert alert-success">
        	<b>Atualização realizada com sucesso!</b>
		</div>
        
	<?php } elseif ($_GET['res'] == 'error') { ?>
    	<div class="alert alert-error">
        	<b>Atualização não realizada, tente novamente!</b>
		</div>        
    <?php } } ?>

<span class="label label-inverse" style="float:right;"><?php echo $total.' Resultado(s)'; ?></span>

<table class="table table-striped">
	<thead>
    	<tr>
        	<th width="17%">Nome</th>
            <th width="15%">Porção</th>
            <th width="15%">Unidade</th>
            <th>Preço de Compra</th>
            <th>Preço de Venda</th>
            <th>Opções</th>
        </tr>
    </thead>
    
    <tbody>
		<?php do { ?>
	    <tr>
        	<td><?php echo $dados['nome']; ?></td>
            <td><?php echo $dados['porcao']; ?></td>
            <td><?php echo $dados['unidade']; ?></td>
            <td><?php echo $dados['preco_compra']; ?></td>
            <td><?php echo $dados['preco_venda']; ?></td>
			<td><a href="?page=frutasEdit&id=<?php echo $dados['id']; ?>" title="editar"><span class="label label-info"><i class="icon-white icon-pencil"></i></span></a></td>
        </tr>
        <?php } while ($dados = mysql_fetch_assoc($rs_query)); ?>
    </tbody>
</table>