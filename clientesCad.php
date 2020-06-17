<?php
	/*require_once('connection/conexao.php');
	mysql_select_db($database, $conexao);
	*/
?>

<form class="form-horizontal" action="files/php/cadClientes.php" method="post">
    <legend>Cadastro de Clientes</legend>
    
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
            <input type="text" name="nome" class="span6" autofocus required />
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="endereco">Endereço</label>
        <div class="controls">
            <input type="text" name="endereco" class="span8" required />
        </div>
    </div>    
    
    <div class="control-group">
        <label class="control-label" for="complemento">Complemento</label>
        <div class="controls">
            <input type="text" name="complemento" class="span4" />
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="Bairro">Bairro</label>
        <div class="controls">
            <input type="text" name="bairro" class="span4" required />
        </div>
    </div>   
    
    <div class="control-group">
        <label class="control-label" for="telefone">Telefone</label>
        <div class="controls">
            <input type="text" name="telefone" class="span4" />
        </div>
    </div>    
    
    <div class="form-actions">
    	<button type="submit" class="btn btn-primary"> <i class="icon-white icon-check"></i> Salvar </button>
    	<button type="reset" class="btn"> <i class="icon icon-refresh"></i> Limpar </button>        
    </div>
    
</form>