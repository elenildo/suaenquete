<!DOCTYPE html>
<?php include_once "../inc_conexao.php" ?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Título</title>
		<link rel="stylesheet" href="css/estilo_adm.css">
	</head>
	<body>
		<?php include_once "inc_topo_adm.html" ?>
		<?php if(!isset($_SESSION["guia"])) $_SESSION["guia"] = "Produtos" ?>
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Cadastro de <?php echo $_SESSION["guia"]?></span>
				</div>
				<div class="barra_btn">
					<a href="produto.php"><img src="img/add.png" title="Novo"></a>
				</div>
				<span>Busca</span>
				<input type="text" placeholder="Digite o nome do produto">
				<button>Filtrar</button> 
			</div>
			
			<div class="listagem">
				<table cellpadding="5px" cellspacing="0" border="1" width="100%">
					<tr>
						<th align="left">Imagem</th>
						<th>id</th>
						<th>Nome</th>
						<th>Preço</th>
						<th>Estoque</th>
						<th colspan="2">Ações</th>
					</tr>
				<?php
					$resultado = mysqli_query($conexao, "SELECT * FROM produtos") or die(mysql_error());
					$total = mysqli_num_rows($resultado);
					for($i=0; $i<$total; $i++){
						$registro = mysqli_fetch_assoc($resultado);
				?>
					<tr align="center">
						<td align="left"><img src='<?php echo "../".$registro["imagem"]?>' width="32px"></td>
						<td><?php echo $registro["id"]?></td>
						<td><?php echo $registro["nome"]?></td>
						<td><?php echo $registro["preco"]?></td>
						<td><?php echo $registro["estoque"]?></td>
						<td width="50px"><img src="img/edit.png"></td>
						<td><img src="img/delete.png"></td>
					</tr>
				<?php
					}
					mysqli_close($conexao);
				?>
				</table>
			</div>
		</div>
		<?php include_once "inc_rodape_adm.html" ?>
	</body>
</html>