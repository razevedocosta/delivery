<div class="container">

	<div class="row-fluid">
    	<div id="menu" class="span2">
        
          <ul class="nav nav-list">
            <li class="nav-header titulo">Clientes</li>
            <li><a href="?page=clientesCad">Cadastrar</a></li>
            <li><a href="?page=clientesCon">Consultar</a></li>
            <li class="nav-header titulo">Pedidos</li>
            <li><a href="?page=pedidosCad">Cadastrar</a></li>
            <li><a href="?page=pedidosCon">Consultar</a></li>            
            <li class="nav-header titulo">Frutas / Legumes</li>
            <li><a href="?page=frutasCad">Cadastrar</a></li>
            <li><a href="?page=frutasCon">Consultar</a></li>
            <li class="nav-header titulo">Kits</li>
            <li><a href="?page=kitsCad">Cadastrar</a></li>
            <li><a href="?page=kitsCon">Consultar</a></li>            
            <li class="nav-header titulo">Relatórios</li>
            <li><a href="?page=relClientes">Clientes</a></li>
            <li><a href="?page=relItensAComprar">Itens a comprar</a></li>
         
		  </ul>
        </div>
        
        <div class="span10">
        	
            <?php
			if (isset($_GET['page'])){
				$page = $_GET['page'];
				include $page.'.php';
			}
            ?>
            
        </div>
    </div>

</div>