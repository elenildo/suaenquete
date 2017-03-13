<?php
	
	$login = $_POST["login"];
	$senha = $_POST["senha"];
	
	include_once "../inc_conexao.php";
	
	//$sql = "SELECT * FROM usuarios WHERE login='$login' and senha='$senha'";
	$sql = "SELECT * FROM usuarios WHERE login=? and senha=?";
	$res = $conexao->prepare($sql);
	$res->bindParam(1,$login);
	$res->bindParam(2,$senha);
	$res->execute();
	
	$total = $res->rowCount();
	
	if($total > 0){
		$objeto = $res->fetch(PDO::FETCH_ASSOC);
		
		session_start();
		$_SESSION["user_admin"] = $objeto["nome"];
		header("Location: index.php");
		
	}else{
		session_start();
		$_SESSION["auth_message"] = "Acesso negado";
		header("Location: login.php");
	}
?>