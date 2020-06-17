<?php
	require_once('connection/conexao.php');
	//mysql_select_db($database, $conexao);
	
	$query = "SELECT * FROM frutas ORDER BY id";
	$queryFru = mysql_query($query, $conexao) or die(mysql_error());
	$frutas = mysql_fetch_assoc($queryFru);
	$totalFru = mysql_num_rows($queryFru);	
?>

<form class="form-horizontal" action="files/php/cadKits.php" method="post">
    <legend>Cadastro de Kits</legend>
    
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
        </div>
    </div>
 
    <div class="control-group">
        <label class="control-label" for="itens">Itens</label>
    	<div class="controls">
        <table class="table table-striped">
        <thead>
        	<tr>
            	<th>Fruta / Legume</th>
                <th>Porção</th>
                <th>Preço de venda</th>
            </tr>
        </thead>
        
        <tbody>
		<?php do { 
			$item = $frutas['porcao'].' '.$frutas['unidade'].' '.$frutas['nome']; ?>
        	<tr>
            	<td>
                <div class="">
				<input type="checkbox" name="ch[]" id="ch<?php echo $frutas['id']; ?>" value="<?php echo $item; ?>" /><?php echo $frutas['nome']; ?>
				</div>
            	</td>
                <td>
                <?php echo $frutas['porcao'].' '.$frutas['unidade']; ?>
                </td>
                <td>
                <input type="text" class="span4" name="preco_venda" id="campo<?php echo $frutas['id']; ?>" value="<?php echo $frutas['preco_venda']; ?>" readonly="readonly" />
                </td>
            </tr>        	
        <?php } while ($frutas = mysql_fetch_assoc($queryFru)); ?>
        <tr>
        	<td colspan="3"><button type="button" class="btn btn-success" onclick="soma()"><i class="icon icon-list	icon-white"></i> Calcular Kit </button></td>
            <td></td>
        </tr>
        </tbody>
        </table>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="result">Preço</label>
        <div class="controls">
            <input type="text" name="result" id="result" value="0,00" class="span4" readonly="readonly" />
        </div>
    </div>	    
    
    <div class="form-actions">
    	<button type="submit" class="btn btn-primary"> <i class="icon-white icon-check"></i> Salvar </button>
    	<button type="reset" class="btn"> <i class="icon icon-refresh"></i> Limpar </button>        
    </div>
    
</form>

<script type="text/javascript">
	function id( el ){
        return document.getElementById( el );
	}
	
	function getMoney( el ){
        var money = id( el ).value.replace( ',', '.' );
        return parseFloat( money )*100;
	}
	
	function soma(){
		var soma = 0;
		
		if (id('ch1').checked == true) {
			soma = soma + getMoney('campo1');
		}

		if (id('ch2').checked == true) {
			soma = soma + getMoney('campo2');
		}
		
		if (id('ch3').checked == true) {
			soma = soma + getMoney('campo3');
		}
		
		if (id('ch4').checked == true) {
			soma = soma + getMoney('campo4');
		}
		
		if (id('ch5').checked == true) {
			soma = soma + getMoney('campo5');
		}
		
		if (id('ch6').checked == true) {
			soma = soma + getMoney('campo6');
		}
		
		if (id('ch7').checked == true) {
			soma = soma + getMoney('campo7');
		}
		
		if (id('ch8').checked == true) {
			soma = soma + getMoney('campo8');
		}
		
		if (id('ch9').checked == true) {
			soma = soma + getMoney('campo9');
		}
		
		if (id('ch10').checked == true) {
			soma = soma + getMoney('campo10');
		}
		
		if (id('ch11').checked == true) {
			soma = soma + getMoney('campo11');
		}
		
		if (id('ch12').checked == true) {
			soma = soma + getMoney('campo12');
		}
		
		if (id('ch13').checked == true) {
			soma = soma + getMoney('campo13');
		}

		if (id('ch14').checked == true) {
			soma = soma + getMoney('campo14');
		}
		
		if (id('ch15').checked == true) {
			soma = soma + getMoney('campo15');
		}
		
		if (id('ch16').checked == true) {
			soma = soma + getMoney('campo16');
		}
		
		if (id('ch17').checked == true) {
			soma = soma + getMoney('campo17');
		}
		
		if (id('ch18').checked == true) {
			soma = soma + getMoney('campo18');
		}
		
		var total = getMoney('campo1')+getMoney('campo2')+getMoney('campo3');
        id('result').value = soma/100;
	}
</script>