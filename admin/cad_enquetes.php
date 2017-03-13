<?php

	include_once "../inc_conexao.php";
	
	$op = isset($_POST["op"])?$_POST["op"]:"novo";
	$id = isset($_POST["id"])?$_POST["id"]:"";
	$titulo = isset($_POST["titulo"])?$_POST["titulo"]:"";
	$opcoes = isset($_POST["opcoes"])?$_POST["opcoes"]:"";
	$opcoes_ant = isset($_POST["opcoes_ant"])?$_POST["opcoes_ant"]:"";
	$data = isset($_POST["data"])?$_POST["data"]:"";
	$autor = isset($_POST["autor"])?$_POST["autor"]:"";
	$status = isset($_POST["status"])?$_POST["status"]:"";
	
	$lastid = 0;
	
	function insere_opcoes($opc,$con,$id){
		$arr_opc = explode(',',$opc);
		$cont = 0;

		$sql = "INSERT INTO opcoes(id_enquete,opcao,votos) VALUES(?,?,?)";
		try{
			foreach($arr_opc as $opcao){
				if(trim($opcao) != ''){
					$res = $con->prepare($sql);
					$res->execute(array($id, $opcao, 0));
					$cont++;
				}	
			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		if($cont == 0){
			$sql = "UPDATE enquetes SET status='Incompleto' WHERE id={$id}";
			try{
				$con->query($sql);
			}catch(PDOException $e){
			echo $e->getMessage();
			}
		}
	}
	function remove_opcoes($con,$id){
		$sql = "DELETE from opcoes WHERE id_enquete=?";
		try{
			$res = $con->prepare($sql);
			$res->execute(array($id));
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	if($op == "novo"){
		$sql = "INSERT INTO enquetes(autor,data,titulo,status) VALUES(:autor,:data,:titulo,:status)";
		try{
		$res = $conexao->prepare($sql);
		$res->execute(array(':autor'=>$autor, ':data'=>$data, 'titulo'=>$titulo, ':status'=>$status));
		$lastid = $conexao->lastInsertId();
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		insere_opcoes($opcoes,$conexao,$lastid);
		
		header('Location: index.php');
	}
	if($op == "editar"){
		$sql = "UPDATE enquetes SET titulo=?, autor=?, data=?, status=? WHERE id=?";
		try{
		$res = $conexao->prepare($sql);
		$res->execute(array($titulo,$autor,$data,$status,$id));
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		if($opcoes != $opcoes_ant){
			remove_opcoes($conexao,$id);
			insere_opcoes($opcoes,$conexao,$id);
		}
		header('Location: index.php');
	}
	if($op == "excluir"){
		$sql = "DELETE FROM enquetes WHERE id=?";
		try{
		$res = $conexao->prepare($sql);
		$res->execute(array($id));
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		remove_opcoes($conexao,$id);
		
		header('Location: index.php');
	}
	
	//mysqli_close($conexao);
	
?>