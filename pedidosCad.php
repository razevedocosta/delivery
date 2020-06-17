<?php
	require_once('connection/conexao.php');
//	mysql_select_db($database, $conexao);
	
	$query = "SELECT * FROM clientes ORDER BY nome";
	$queryCli = mysql_query($query, $conexao) or die(mysql_error());
	$clientes = mysql_fetch_assoc($queryCli);
	$totalCli = mysql_num_rows($queryCli);
	
	$query = "SELECT * FROM frutas ORDER BY id";
	$queryFru = mysql_query($query, $conexao) or die(mysql_error());
	$frutas = mysql_fetch_assoc($queryFru);
	$totalFru = mysql_num_rows($queryFru);	
?>

<form class="form-horizontal" action="files/php/cadPedidos.php" method="post">
    <legend>Cadastro de Pedidos</legend>
    
    <?php if (isset($_GET['res'])) { ?>
    <?php if ($_GET['res'] == 'success') { ?>
    	<div class="alert alert-success">
        	<b>Pedido cadastrado com sucesso!</b>
		</div>
        
	<?php } elseif ($_GET['res'] == 'error') { ?>
    	<div class="alert alert-error">
        	<b>Cadastro não realizado, tente novamente!</b>
		</div>        
    <?php } } ?>

	<div class="control-group">
        <label class="control-label" for="cliente">Nome do Cliente</label>
        <div class="controls">
            <select name="cliente" class="span5" autofocus="autofocus">
            	<option></option>
				<?php do { ?> 
                        <option value="<?php echo $clientes['nome']; ?>"><?php echo $clientes['nome']; ?></option>				
                <?php } while ($clientes = mysql_fetch_assoc($queryCli)); ?>
            </select>
        </div>
    </div>
    
    	<div class="control-group">
        <label class="control-label" for="cliente">Data de Entrega</label>
        <div class="controls">
        	<input type="date" name="data" class="span5" />
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="kit">Kit desejado</label>    
	    <div class="controls">
    	  <table class="table">
       		<tr>
           		<td><input type="checkbox" name="kit" value="kit 1" id="kit1" onclick="add1(this)" />kit 1</td>
	           	<td><input type="checkbox" name="kit" value="kit 2" id="kit2" onclick="add2(this)" />kit 2</td>
	           	<td><input type="checkbox" name="kit" value="kit escolha" id="kite" />kit Escolha</td>
	        </tbody>
	      </table>
	    </div>
    </div>

	<div class="control-group">
        <label class="control-label" for="cliente">Itens</label>
        <div class="controls">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th width="20%">Item</th>
                    <th width="20%">Unidade</th>
                    <th width="20%">Preço Unitário</th>
                    <th width="20%">Quantidade</th>
                    <th width="20%">Preço por item</th>
                </tr>
            </thead>
            <tbody>
			<?php do { ?>
            <tr>
                <td><?php echo $frutas['nome']; ?>
                	<input type="hidden" name="item<?php echo $frutas['id']; ?>" value="<?php echo $frutas['nome']; ?>" />
                </td>
                <td><?php echo $frutas['porcao'].' '.$frutas['unidade']; ?></td>
                <td><input class="input-medium focused span6 calc" name="valor<?php echo $frutas['id']; ?>" id="valor<?php echo $frutas['id']; ?>" readonly="readonly" type="text" value="<?php echo $frutas['preco_venda']; ?>"/></td>
				<td><input class="input-medium span6 calc" name="qtde<?php echo $frutas['id']; ?>" id="qtde<?php echo $frutas['id']; ?>"  type="text" value="0"/></td>
				<td><input type="text" id="total<?php echo $frutas['id']; ?>" name="total<?php echo $frutas['id']; ?>" class="input-medium focused span6 result" readonly="readonly"/></td>
			</tr>
            <?php } while ($frutas = mysql_fetch_assoc($queryFru)); ?>
            <tr>
            	<td></td>
                <td></td>
                <td></td>
            	<td>Total frutas</td>
                <td><input type="text" name="totalfrutas" id="totalfrutas" class="span6 result" readonly="readonly" /></td>
            </tr>
            <tr>
            	<td></td>
                <td></td>
                <td></td>
            	<td>Taxa de entrega</td>
                <td><input type="text" name="taxa" id="taxa" class="span6 result" readonly="readonly" value="7.00" /></td>
            </tr> 
            <tr>
            	<td></td>
                <td></td>
                <td></td>
            	<td><b>Total do pedido</b></td>
                <td><input type="text" name="totalpedido" id="totalpedido" class="span6 result" readonly="readonly" /></td>
            </tr>                        
            </tbody>
            </table>
        </div>
    </div>

    <div class="form-actions">        
    	<button type="reset" class="btn" style="float:right; margin-left:10px;"> <i class="icon icon-refresh"></i> Limpar </button>
    	<button type="submit" class="btn btn-primary" style="float:right;"> <i class="icon-white icon-check"></i> Salvar </button>
    </div>
    
</form>

<!-- Cálculo quantidade x valor unitário -->
<script type="text/javascript">        
	$(document).ready(function(){
		$('.calc').keyup(function(){
			var valor1 = parseFloat($('#valor1').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde1 = parseFloat($('#qtde1').val().replace(".", "").replace(",", ".")) || 0.00;
			var total1 = valor1 * qtde1;
			$('#total1').val(number_format(total1,2, ',', '.'));

			var valor2 = parseFloat($('#valor2').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde2 = parseFloat($('#qtde2').val().replace(".", "").replace(",", ".")) || 0.00;
			var total2 = valor2 * qtde2;
			$('#total2').val(number_format(total2,2, ',', '.'));

			var valor3 = parseFloat($('#valor3').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde3 = parseFloat($('#qtde3').val().replace(".", "").replace(",", ".")) || 0.00;
			var total3 = valor3 * qtde3;
			$('#total3').val(number_format(total3,2, ',', '.'));

			var valor4 = parseFloat($('#valor4').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde4 = parseFloat($('#qtde4').val().replace(".", "").replace(",", ".")) || 0.00;
			var total4 = valor4 * qtde4;
			$('#total4').val(number_format(total4,2, ',', '.'));
			
			var valor5 = parseFloat($('#valor5').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde5 = parseFloat($('#qtde5').val().replace(".", "").replace(",", ".")) || 0.00;
			var total5 = valor5 * qtde5;
			$('#total5').val(number_format(total5,2, ',', '.'));
			
			var valor6 = parseFloat($('#valor6').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde6 = parseFloat($('#qtde6').val().replace(".", "").replace(",", ".")) || 0.00;
			var total6 = valor6 * qtde6;
			$('#total6').val(number_format(total6,2, ',', '.'));

			var valor7 = parseFloat($('#valor7').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde7 = parseFloat($('#qtde7').val().replace(".", "").replace(",", ".")) || 0.00;
			var total7 = valor7 * qtde7;
			$('#total7').val(number_format(total7,2, ',', '.'));
			
			var valor8 = parseFloat($('#valor8').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde8 = parseFloat($('#qtde8').val().replace(".", "").replace(",", ".")) || 0.00;
			var total8 = valor8 * qtde8;
			$('#total8').val(number_format(total8,2, ',', '.'));
			
			var valor9 = parseFloat($('#valor9').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde9 = parseFloat($('#qtde9').val().replace(".", "").replace(",", ".")) || 0.00;
			var total9 = valor9 * qtde9;
			$('#total9').val(number_format(total9,2, ',', '.'));
			
			var valor10 = parseFloat($('#valor10').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde10 = parseFloat($('#qtde10').val().replace(".", "").replace(",", ".")) || 0.00;
			var total10 = valor10 * qtde10;
			$('#total10').val(number_format(total10,2, ',', '.'));

			var valor11 = parseFloat($('#valor11').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde11 = parseFloat($('#qtde11').val().replace(".", "").replace(",", ".")) || 0.00;
			var total11 = valor11 * qtde11;
			$('#total11').val(number_format(total11,2, ',', '.'));
			
			var valor12 = parseFloat($('#valor12').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde12 = parseFloat($('#qtde12').val().replace(".", "").replace(",", ".")) || 0.00;
			var total12 = valor12 * qtde12;
			$('#total12').val(number_format(total12,2, ',', '.'));
			
			var valor13 = parseFloat($('#valor13').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde13 = parseFloat($('#qtde13').val().replace(".", "").replace(",", ".")) || 0.00;
			var total13 = valor13 * qtde13;
			$('#total13').val(number_format(total13,2, ',', '.'));
			
			var valor14 = parseFloat($('#valor14').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde14 = parseFloat($('#qtde14').val().replace(".", "").replace(",", ".")) || 0.00;
			var total14 = valor14 * qtde14;
			$('#total14').val(number_format(total14,2, ',', '.'));
			
			var valor15 = parseFloat($('#valor15').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde15 = parseFloat($('#qtde15').val().replace(".", "").replace(",", ".")) || 0.00;
			var total15 = valor15 * qtde15;
			$('#total15').val(number_format(total15,2, ',', '.'));
			
			var valor16 = parseFloat($('#valor16').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde16 = parseFloat($('#qtde16').val().replace(".", "").replace(",", ".")) || 0.00;
			var total16 = valor16 * qtde16;
			$('#total16').val(number_format(total16,2, ',', '.'));
			
			var valor17 = parseFloat($('#valor17').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde17 = parseFloat($('#qtde17').val().replace(".", "").replace(",", ".")) || 0.00;
			var total17 = valor17 * qtde17;
			$('#total17').val(number_format(total17,2, ',', '.'));				
			
			var valor18 = parseFloat($('#valor18').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde18 = parseFloat($('#qtde18').val().replace(".", "").replace(",", ".")) || 0.00;
			var total18 = valor18 * qtde18;
			$('#total18').val(number_format(total18,2, ',', '.'));
			
			var valor19 = parseFloat($('#valor19').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde19 = parseFloat($('#qtde19').val().replace(".", "").replace(",", ".")) || 0.00;
			var total19 = valor19 * qtde19;
			$('#total19').val(number_format(total19,2, ',', '.'));

			var valor20 = parseFloat($('#valor20').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde20 = parseFloat($('#qtde20').val().replace(".", "").replace(",", ".")) || 0.00;
			var total20 = valor20 * qtde20;
			$('#total20').val(number_format(total20,2, ',', '.'));

			var valor21 = parseFloat($('#valor21').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde21 = parseFloat($('#qtde21').val().replace(".", "").replace(",", ".")) || 0.00;
			var total21 = valor21 * qtde21;
			$('#total21').val(number_format(total21,2, ',', '.'));

			var valor22 = parseFloat($('#valor22').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde22 = parseFloat($('#qtde22').val().replace(".", "").replace(",", ".")) || 0.00;
			var total22= valor22 * qtde22;
			$('#total22').val(number_format(total22,2, ',', '.'));
			
			var valor23 = parseFloat($('#valor23').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde23 = parseFloat($('#qtde23').val().replace(".", "").replace(",", ".")) || 0.00;
			var total23 = valor23 * qtde23;
			$('#total23').val(number_format(total23,2, ',', '.'));
			
			var valor24 = parseFloat($('#valor24').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde24 = parseFloat($('#qtde24').val().replace(".", "").replace(",", ".")) || 0.00;
			var total24 = valor24 * qtde24;
			$('#total24').val(number_format(total24,2, ',', '.'));
			
			var valor25 = parseFloat($('#valor25').val().replace(",", "").replace(",", ".")) || 0.00;
			var qtde25 = parseFloat($('#qtde25').val().replace(".", "").replace(",", ".")) || 0.00;
			var total25 = valor25 * qtde25;
			$('#total25').val(number_format(total25,2, ',', '.'));			

			var totalfrutas = total1 + total2 + total3 + total4 + total5 + total6 + total7 + total8 + total9 + total10 + total11 + total12 + total13 + total14 + total15 + total16 + total17 + total18 + total19 + total20 + total21 + total22 + total23 + total24 + total25;
			$('#totalfrutas').val(number_format(totalfrutas,2, '.', ','));       
			
			var totalpedido = totalfrutas + 7;
			$('#totalpedido').val(number_format(totalpedido,2, '.', ','));

		});
	});

	function number_format( number, decimals, dec_point, thousands_sep ) {
	var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
	var d = dec_point == undefined ? "." : dec_point;
	var t = thousands_sep == undefined ? "," : thousands_sep, s = n < 0 ? "-" : "";
	var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");}
	
	
	function add1(_this){
		var qtde4 = document.getElementById('qtde4');
		var qtde6 = document.getElementById('qtde6');
		var qtde7 = document.getElementById('qtde7');
		var qtde8 = document.getElementById('qtde8');
		var qtde11 = document.getElementById('qtde11');
		var qtde17 = document.getElementById('qtde17');																				
		var kit1 = document.getElementById('kit1');
		
		if(kit1.checked) {
			qtde4.value = 1;
			qtde6.value = 1;
			qtde7.value = 1;
			qtde8.value = 1;
			qtde11.value = 1;
			qtde17.value = 1;
		} else {
			qtde4.value = 0;
			qtde6.value = 0;
			qtde7.value = 0;
			qtde8.value = 0;
			qtde11.value = 0;
			qtde17.value = 0;
		}
		
	}
		
	function add2(_this){
		var qtde2 = document.getElementById('qtde2');
		var qtde4 = document.getElementById('qtde4');
		var qtde6 = document.getElementById('qtde6');
		var qtde7 = document.getElementById('qtde7');
		var qtde8 = document.getElementById('qtde8');
		var qtde11 = document.getElementById('qtde11');
		var qtde12 = document.getElementById('qtde12');
		var qtde13 = document.getElementById('qtde13');
		var qtde15 = document.getElementById('qtde15');
		var qtde17 = document.getElementById('qtde17');																				
		var kit2 = document.getElementById('kit2');		
		
		if(kit2.checked) {
			qtde2.value = 1;
			qtde4.value = 1;
			qtde6.value = 1;
			qtde7.value = 1;
			qtde8.value = 1;
			qtde11.value = 1;
			qtde12.value = 1;
			qtde13.value = 1;
			qtde15.value = 1;
			qtde17.value = 1;
		} else {
			qtde2.value = 0;
			qtde4.value = 0;
			qtde6.value = 0;
			qtde7.value = 0;
			qtde8.value = 0;
			qtde11.value = 0;
			qtde12.value = 0;
			qtde13.value = 0;
			qtde15.value = 0;
			qtde17.value = 0;
		}
	}
</script>