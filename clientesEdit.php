<?php
	require_once('connection/conexao.php');
	//mysql_select_db($database, $conexao);
	
	$id = $_GET['id'];
	$query = "SELECT * FROM clientes WHERE id = '".$id."'";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);
?>

<form class="form-horizontal" action="files/php/editarClientes.php" method="post">
    <legend>Edição de Clientes</legend>
    
    <?php if (isset($_GET['res'])) { ?>
    <?php if ($_GET['res'] == 'success') { ?>
    	<div class="alert alert-success">
        	<b>Cadastro realizado com sucesso!</b>
		</div>
        
	<?php } elseif ($_GET['res'] == 'error') { ?>
    	<div class="alert alert-error">
        	<b>Cadastro não realizado, tente novamente!</b>
		</div>        
    <?php } } ?>

	<div class="control-group">
        <label class="control-label" for="nome">Nome</label>
        <div class="controls">
            <input type="text" name="nome" class="span6" value="<?php echo $dados['nome']; ?>" autofocus required />
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="endereco">Endereço</label>
        <div class="controls">
            <input type="text" name="endereco" class="span8" value="<?php echo $dados['endereco']; ?>" required />
        </div>
    </div>    
    
    <div class="control-group">
        <label class="control-label" for="complemento">Complemento</label>
        <div class="controls">
            <input type="text" name="complemento" class="span4" value="<?php echo $dados['complemento']; ?>" />
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="Bairro">Bairro</label>
        <div class="controls">
            <input type="text" name="bairro" class="span4" value="<?php echo $dados['bairro']; ?>" required />
        </div>
    </div>   
    
    <div class="control-group">
        <label class="control-label" for="telefone">Telefone</label>
        <div class="controls">
            <input type="text" name="telefone" class="span4" value="<?php echo $dados['telefone']; ?>" />
        </div>
    </div>    
    
    <div class="form-actions">
    	<button type="submit" class="btn btn-primary"> <i class="icon-white icon-check"></i> Salvar </button>
    	<a href="?page=clientesCon"><button type="button" class="btn"> <i class="icon icon-chevron-left"></i> Voltar </button></a>
    </div>
    
    <input type="hidden" name="idCliente" value="<?php echo $id; ?>" />    
    
</form>