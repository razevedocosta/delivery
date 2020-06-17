<?php
	require_once('connection/conexao.php');
//	mysql_select_db($database, $conexao);
	
	$id = $_GET['id'];
	$query = "SELECT * FROM frutas WHERE id = '".$id."'";
	$rs_query = mysql_query($query, $conexao) or die(mysql_error());
	$dados = mysql_fetch_assoc($rs_query);
	$total = mysql_num_rows($rs_query);
?>

<form class="form-horizontal" action="files/php/editarFrutas.php" method="post">
    <legend>Edição de Frutas / Legumes</legend>
    
	<div class="control-group">
        <label class="control-label" for="nome">Nome</label>
        <div class="controls">
            <input type="text" name="nome" class="span4" value="<?php echo $dados['nome']; ?>" autofocus required />
        </div>
    </div>

	<div class="control-group">
        <label class="control-label" for="string">String</label>
        <div class="controls">
            <input type="text" name="string" class="span4" value="<?php echo $dados['string']; ?>" autofocus required />
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="porcao">Porção</label>
        <div class="controls">
            <input type="text" name="porcao" class="span4" value="<?php echo $dados['porcao']; ?>" required />
        </div>
    </div>    
    
    <div class="control-group">
        <label class="control-label" for="unidade">Unidade</label>
        <div class="controls">
            <select name="unidade" class="span4">
            	<option value="<?php echo $dados['unidade']; ?>"><?php echo $dados['unidade']; ?></option>
            	<option value="und">UND (unidade)</option>
            	<option value="g">G (gramas)</option>
            	<option value="palma">PALMA</option>                
            </select>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="preco_compra">Preço de Compra</label>
        <div class="controls">
            <input type="text" name="preco_compra" class="span4" value="<?php echo $dados['preco_compra']; ?>" required />
        </div>
    </div>     
    
    <div class="control-group">
        <label class="control-label" for="preco_venda">Preço de Venda</label>
        <div class="controls">
            <input type="text" name="preco_venda" class="span4" value="<?php echo $dados['preco_venda']; ?>" required />
        </div>
    </div>      
    
    <div class="form-actions">
    	<button type="submit" class="btn btn-primary"> <i class="icon-white icon-check"></i> Salvar </button>
    	<a href="?page=frutasCon"><button type="button" class="btn"> <i class="icon icon-chevron-left"></i> Voltar </button></a>
    </div>
    
    <input type="hidden" name="idItem" value="<?php echo $id; ?>" />
    
</form>