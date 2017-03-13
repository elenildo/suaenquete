<?php
	
	require_once 'inc_conexao.php';
	$idenq=$_POST['id_enquete'];
	
	$sql = "SELECT MAX(votos) as maior FROM opcoes WHERE id_enquete={$idenq}";
	$res = $conexao->query($sql);
	$ret = $res->fetch();
	$max = $ret['maior'];

	$sql="SELECT * FROM opcoes WHERE id_enquete={$idenq} ORDER BY votos DESC";
	$res = $conexao->query($sql);
	
	while($row = $res->fetch(PDO::FETCH_ASSOC)){

		// echo "<li><label for='opcao[{$row['id']}]' style='min-width:100px;'>{$row['opcao']}</label> <input type='radio' name='opcao' id='opcao[{$row['id']}]' value='{$row['id']}' >  <progress max='{$max}' value='{$row['votos']}'></progress> {$row['votos']} votos</li>" ;
		echo "<tr>
				<td><label for='opcao[{$row['id']}]'>{$row['opcao']}</label></td>
				<td><input type='radio' name='opcao' id='opcao[{$row['id']}]' value='{$row['id']}' ></td>
				<td><div class='div-qtd-votos'><progress max='{$max}' value='{$row['votos']}'> </progress>{$row['votos']} votos</div></td></tr>" ;
	}
	
?>		
