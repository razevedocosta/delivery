<form class="form-horizontal" action="files/php/cadFrutas.php" method="post">
    <legend>Cadastro de Frutas / Legumes</legend>
    
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
            <input type="text" name="nome" class="span4" autofocus required />
            <span class="label label-info">Ex: Melão Rei</span>
        </div>
    </div>

	<div class="control-group">
        <label class="control-label" for="string">String</label>
        <div class="controls">
            <input type="text" name="string" class="span4" autofocus required />
            <span class="label label-info">Ex: melaorei</span>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="porcao">Porção</label>
        <div class="controls">
            <input type="text" name="porcao" class="span4" required />
        </div>
    </div>    
    
    <div class="control-group">
        <label class="control-label" for="unidade">Unidade</label>
        <div class="controls">
            <select name="unidade" class="span4">
            	<option></option>
            	<option value="und">UND (unidade)</option>
            	<option value="g">G (gramas)</option>
            	<option value="palma">PALMA</option>                
            </select>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="preco_compra">Preço de Compra</label>
        <div class="controls">
            <input type="text" name="preco_compra" class="span4" required />
        </div>
    </div>     
    
    <div class="control-group">
        <label class="control-label" for="preco_venda">Preço de Venda</label>
        <div class="controls">
            <input type="text" name="preco_venda" class="span4" required />
        </div>
    </div>      
    
    <div class="form-actions">
    	<button type="submit" class="btn btn-primary"> <i class="icon-white icon-check"></i> Salvar </button>
    	<button type="reset" class="btn"> <i class="icon icon-refresh"></i> Limpar </button>
    </div>
    
</form>