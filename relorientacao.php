<?php
	require_once('connection/conexao.php');

	mysql_select_db($database, $conexao);
	$query1 = "SELECT distinct o.nome, a.orientador FROM orientador o
			  INNER JOIN aluno a
			  ON o.nome = a.orientador";
	$rs_query1 = mysql_query($query1, $conexao) or die(mysql_error());
	$orientador = mysql_fetch_assoc($rs_query1);
	$total1 = mysql_num_rows($rs_query1);
?>

<ul class="breadcrumb">
	<li>Relatórios <span class="divider">/</span> </li>
    <li>Relação Orientadores x Orientandos</li>
</ul>

<?php do { ?>
<table class="table table-ordered">
	<thead>
    	<tr>
        </tr>
    </thead>
    
    <tbody>

	    <tr class="info">
        	<td colspan="3"><strong>Orientador: </strong><?php echo $orientador['nome']; ?></td>
        </tr>
        
        <?php
			$orientadorNome = $orientador['nome'];
			$query2 = "SELECT nome, curso, modalidade FROM aluno where orientador LIKE '%$orientadorNome%'";
			$rs_query2 = mysql_query($query2, $conexao) or die(mysql_error());
			$aluno = mysql_fetch_assoc($rs_query2);
			$total2 = mysql_num_rows($rs_query2);
			
			do { ?>

            <tr>
                <td width="33%"><?php echo $aluno['nome']; ?></td>
                <td width="33%"><?php echo $aluno['curso']; ?></td>
				<td width="33%"><?php echo $aluno['modalidade']; ?></td>
            </tr>
        
        <?php 		
			} while ($aluno = mysql_fetch_assoc($rs_query2));		
		
		} while ($orientador = mysql_fetch_assoc($rs_query1)); ?>
    </tbody>
</table>