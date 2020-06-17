<script>
	function add1(_this){
		var item3 = document.getElementById('item3');
		var item4 = document.getElementById('item4');
		var item5 = document.getElementById('item5');
		var item6 = document.getElementById('item6');
		var item7 = document.getElementById('item7');
		var item11 = document.getElementById('item11');																				
		var kit1 = document.getElementById('kit1');
		
		if(kit1.checked) {
			item3.value = 1;
			item4.value = 1;
			item5.value = 1;
			item6.value = 1;
			item7.value = 1;
			item11.value = 1;
		} else {
			item3.value = 0;
			item4.value = 0;
			item5.value = 0;
			item6.value = 0;
			item7.value = 0;
			item11.value = 0;
		}
	}
		
	function add2(_this){
		var item2 = document.getElementById('item2');
		var item3 = document.getElementById('item3');
		var item4 = document.getElementById('item4');
		var item5 = document.getElementById('item5');
		var item6 = document.getElementById('item6');
		var item7 = document.getElementById('item7');
		var item8 = document.getElementById('item8');
		var item9 = document.getElementById('item9');
		var item10 = document.getElementById('item10');
		var item11 = document.getElementById('item11');																				
		var kit2 = document.getElementById('kit2');		
		
		if(kit2.checked) {
			item2.value = 1;
			item3.value = 1;
			item4.value = 1;
			item5.value = 1;
			item6.value = 1;
			item7.value = 1;
			item8.value = 1;
			item9.value = 1;
			item10.value = 1;
			item11.value = 1;
		} else {
			item2.value = 0;
			item3.value = 0;
			item4.value = 0;
			item5.value = 0;
			item6.value = 0;
			item7.value = 0;
			item8.value = 0;
			item9.value = 0;
			item10.value = 0;
			item11.value = 0;
		}
	}

</script>


<div class="form-group col-md-7">
  <label class="checkbox-inline"><input onclick="add1(this)" type="checkbox" value="kit 1" id="kit1">kit 1</label>
  <label class="checkbox-inline"><input onclick="add2(this)" type="checkbox" value="kit 2" id="kit2">kit 2</label>
  <label class="checkbox-inline"><input onclick="add(this)" type="checkbox" value="kit escolha" id="kite">kit escolha</label>
</div>

<table>
	<thead>
	<tr>
    	<th>fruta</th>
        <th>quantidade</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    	<td>abacate</td>
        <td><input type="text" id="item1" value="0" /></td>
    </tr>
    <tr>
    	<td>abacaxi</td>
        <td><input type="text" id="item2" value="0" /></td>
    </tr>  
    <tr>
    	<td>banana</td>
        <td><input type="text" id="item3" value="0" /></td>
    </tr>
    <tr>
    	<td>laranja</td>
        <td><input type="text" id="item4" value="0" /></td>
    </tr>
    <tr>
    	<td>maça</td>
        <td><input type="text" id="item5" value="0" /></td>
    </tr>
    <tr>
    	<td>mamão</td>
        <td><input type="text" id="item6" value="0" /></td>
    </tr>
    <tr>
    	<td>melancia</td>
        <td><input type="text" id="item7" value="0" /></td>
    </tr>
    <tr>
    	<td>melão rei</td>
        <td><input type="text" id="item8" value="0" /></td>
    </tr>
	<tr>
    	<td>morango</td>
        <td><input type="text" id="item9" value="0" /></td>
    </tr>      
    <tr>
    	<td>pera</td>
        <td><input type="text" id="item10" value="0" /></td>
    </tr>
    <tr>
    	<td>uva red</td>
        <td><input type="text" id="item11" value="0" /></td>
    </tr>  
    </tbody>
</table>