<?php
	require_once('connection/conexao.php');
	//mysql_select_db($database, $conexao);
	
	$query = "SELECT * FROM clientes ORDER BY nome";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);
?>

<form class="form-horizontal" action="?page=esconsultar&acao=busca" method="post">
<legend>Clientes</legend>

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

<span class="label label-inverse" style="float:right;"><?php echo 'Total: '.$total; ?></span>

<table class="table table-striped">
	<thead>
    	<tr>
        	<th>Nome</th>
            <th>Endereço</th>
            <th>Complemento</th>
            <th>Bairro</th>
            <th>Telefone</th>
            <th>Op</th>
        </tr>
    </thead>
    
    <tbody>  
    
    	<?php do { ?>
	    <tr>
        	<td><?php echo $dados['nome']; ?></td>
            <td><?php echo $dados['endereco']; ?></td>
            <td><?php echo $dados['complemento']; ?></td>
            <td><?php echo $dados['bairro']; ?></td>
            <td><?php echo $dados['telefone']; ?></td>
			<td><a href="?page=clientesEdit&id=<?php echo $dados['id']; ?>" title="editar"><span class="label label-info"><i class="icon-white icon-pencil"></i></span></a></td>            
        </tr>
        <?php } while ($dados = mysql_fetch_assoc($rs_query)); ?>
       
    </tbody>
</table>