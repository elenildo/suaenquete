<!DOCTYPE html>
<?php include_once "../inc_conexao.php"; ?>
<?php
	$total = isset($_GET["total"])? $_GET["total"] : 0;
	$busca = isset($_GET["valor"])? $_GET["valor"] : "";
	$campo = isset($_GET["campo"])? $_GET["campo"] : "";
	
	$total_paginas = 0;
	
	if(isset($_GET["busca"])){
		$busca = $_GET["busca"];
		if($busca == ""){
			$total = 0;
		}else{
			//$sql = "SELECT id FROM enquetes WHERE titulo like '%$busca%'";
			$sql = "SELECT id FROM enquetes WHERE titulo like ?";
			$res = $conexao->prepare($sql);
			$res->bindParam(1,$busca);
			$res->execute();
			
			$total = $res->rowCount();
		}
	}else{
		$sql = "SELECT id FROM enquetes";
		$res = $conexao->query($sql);
		$total = $res->rowCount();
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Enquetes</title>
		<link rel="stylesheet" href="css/estilo_adm.css">
		<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	</head>
	<body>
		<?php include_once "inc_topo_adm.html" ?>
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Listagem de Enquetes</span>
				</div>
				<div class="barra_btn">
					<a href="enquete.php?op=novo"><img src="img/add.png" title="Novo"></a>
				</div>
				
				<form method="GET" action="" style="padding-top:10px;">
					<select name="campo">
						<option value="titulo">Título</option>
						<option value="id">Código</option>
					</select>
					<input type="text" placeholder="Digite um valor" name="busca">
					<button type="submit">Filtrar</button> 
				</form>
				
			</div>
			
			<div class="listagem">
				<table cellpadding="5px" border="1" width="100%" style="border-collapse:collapse;">
					<tr bgcolor="#ccc">
						<th>id</th>
						<th>Título</th>
						<th>Data</th>
						<th>Autor</th>
						<th>Status</th>
						<th colspan="3">Ações</th>
					</tr>
				<?php
					
					if( isset( $_GET['pagina'] ) && (int)$_GET['pagina'] >= 1)
						$pagina = (int)$_GET['pagina'];
					else
						$pagina = 1;
						
					$limite = 10;
					$offset = $limite * ($pagina-1);
					
					if($busca != "")
						$sql = "SELECT e.* FROM enquetes e WHERE {$campo} like '%{$busca}%' ORDER BY id DESC LIMIT {$limite} OFFSET {$offset}";
					else
						$sql = "SELECT e.* FROM enquetes e ORDER BY id DESC LIMIT {$limite} OFFSET {$offset}";
					
					//$resultado = mysqli_query($conexao, $sql) or die(mysql_error());
					 
					$resultado = $conexao->query($sql);
					$total_paginas = ceil($total / $limite) ;
					
					while($registro = $resultado->fetch(PDO::FETCH_ASSOC) ){
						$id = $registro["id"];
				?>
						<tr align="center">
							<td><?= $id ?></td>
							<td><?= $registro["titulo"]?></td>
							<td><?= $registro["data"]?></td>
							<td><?= $registro["autor"]?></td>
							<td><?= $registro["status"] ?></td>
							<td><a href="enquete.php?op=novo">Criar Nova</a></td>
							<td width="25px">
								<form method="get" action="enquete.php">
									<input type="hidden" name="id" value="<?= $id ?>">
									<input type="hidden" name="op" value="editar">
									<button type="submit" style="background: url('img/edit.png') no-repeat 5px 5px; width:30px; height:30px; border:1px solid #ccc;"></button>
								</form>
							</td>
							<td width="25px">
								<form method="post" action="cad_enquetes.php" onSubmit='return confirm("Deseja excluir este registro?")'>
									<input type="hidden" name="id" value="<?= $id ?>">
									<input type="hidden" name="op" value="excluir">
									<button type="submit" style="background: url('img/remove.png') no-repeat 4px 4px; width:30px; height:30px; border:1px solid #ccc;" ></button>
								</form>
							</td>
						</tr>
				<?php
					}
					
				?>
				</table>
			</div>
			<div class="barra_busca">
				<div style="padding-top:10px; padding-bottom:10px; text-align:center">
				<?php
				if($pagina !== 1){ // Sem isto irá exibir "Página Anterior" na primeira página.
				?>
					<a href="?total=<?= $total?>&valor=<?= $busca ?>&campo=<?= $campo?>&pagina=<?= $pagina-1 ?>"  style="text-decoration:none;">
						<span class="botao_pag" > Página Anterior </span>
					</a>
				<?php
				}
				if($pagina < $total_paginas){
				?>
					<a href="?total=<?= $total?>&valor=<?= $busca ?>&campo=<?= $campo?>&pagina=<?= $pagina+1; ?>" style="text-decoration:none;">
						<span class="botao_pag" > Próxima Página </span>
					</a>
				<?php }?>
				</div>
			</div>
		</div>
		<?php include_once "inc_rodape_adm.html" ?>
	</body>
</html>