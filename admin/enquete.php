<!DOCTYPE html>
<?php include_once "../inc_conexao.php"; ?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Enquete</title>
		<link rel="stylesheet" href="css/estilo_adm.css">
		<style type="text/css">
			#cad_categoria{display: none; border:1px solid #ccc; padding: 10px;}
			#spn_nova_cat{cursor: pointer; border:1px solid #ccc; padding: 2px;}
		</style>
		<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>

		<script type="text/javascript">

			function valida(){
				if(form1.status.value == 'Publicado'){
					return confirm('A enquete está marcada como Publicado.\nApós salvar não será mais possível editar esta enquete.\nTem certeza que quer continuar?')
				}
				// if(form1.id_sub.value ==""){
					// alert("Selecione uma categoria.");
					// form1.id_sub.focus();
					// return false;
				// }
				// if(form1.nome.value ==""){
					// alert("Digite o nome do produto.");
					// form1.nome.focus();
					// return false;
				// }
				// if(form1.descricao.value ==""){
					// alert("Digite uma breve descricao do produto.");
					// form1.descricao.focus();
					// return false;
				// }
				// if(form1.preco.value ==""){
					// alert("Digite o preço do produto.");
					// form1.preco.focus();
					// return false;
				// }
			}

		</script>
	</head>
	<body>
		<?php include_once "inc_topo_adm.html" ?>
		<?php
			$str_opc = '';
			$status = '';
			$operacao = $_GET["op"];
			if($operacao == "editar"){
				$id = $_GET["id"];
				$sql = "SELECT * FROM enquetes WHERE id=?";
				
				$res = $conexao->prepare($sql);
				$res->bindParam(1,$id);
				$res->execute();
				
				$registro = $res->fetch(PDO::FETCH_ASSOC);
				
				$titulo = $registro["titulo"];
				$data = $registro["data"];
				$autor = $registro["autor"];
				$status = $registro["status"];
				
				$sql2 = "SELECT opcao FROM opcoes WHERE id_enquete=?";
				$res2 = $conexao->prepare($sql2);
				$res2->bindParam(1,$id);
				$res2->execute();
				$rows = $res2->fetchAll(PDO::FETCH_ASSOC);
				$arr = array();
				foreach($rows as $r){
					$arr[]=$r['opcao'];
				}
				$str_opc = implode(',',$arr);
				
			}
		?>
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Cadastro de Enquetes</span>
				</div>
				<div class="barra_btn">
					<a href="index.php"><img src="img/voltar.png" title="Voltar"></a>
				</div>
			</div>
		</div>
		<div class="container">
			<div style="padding-top:20px;">
				<form method="post" action="cad_enquetes.php" name="form1" onSubmit='return valida();'>
					<input type="hidden" name="op" value="<?= $_GET["op"]; ?>">
					<input type="hidden" name="id" value="<?php if(isset($id))echo $id ?>">
					<input type="text" name="titulo" placeholder="Título da enquete" size="60px" maxLength="64" value="<?= isset($titulo)?$titulo:'' ?>"> <br><br>
					<input type="text" name="opcoes" placeholder="Digite as alternativas separadas por vírgulas" size='60px' value="<?= isset($str_opc)? $str_opc:''; ?>"> <br><br>
					<input type="hidden" name="opcoes_ant" value="<?= $str_opc ?>">
					<input type="text" name="data" placeholder="Data" size="20px" maxLength="10" value="<?= isset($data)?$data:date('Y-m-d') ?>"> <br><br>
					<input type="text" name="autor" placeholder="Nome do Autor" value="<?= isset($autor)? $autor:$_SESSION['user_admin'] ?>"> <br><br>
					
					<select name='status'>
						<option value='Aberto' <?php if(isset($status) && $status == 'Aberto') echo 'selected' ?> >Aberto</option>
						<option value='Encerrado'>Encerrado</option>
						<option value='Publicado'>Publicado</option>
					</select><br><br><br>
					<?php if($status != 'Publicado'): ?>
						<button type="image" style="background: url('img/Save.png'); width:36px; height:36px;" title="Salvar"></button>
					<?php else:?>
						<p style='color:red'>Esta enquete foi publicada não pode mais ser alterada</p>
					<?php endif;?>
				</form>
			</div>
		</div>
		<?php include_once "inc_rodape_adm.html" ?>
	</body>
</html>