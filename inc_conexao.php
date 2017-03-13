<?php 
	try{
		$conexao = new PDO("mysql:host=localhost;dbname=suaenquete", "root", ""); /*localhost*/
		//$conexao = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u144504092_data", "u144504092_admin", "coelho branco");
		$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch(PDOException $e){
		echo "Erro ao acessar o Banco de Dados <br>".$e->getMessage();
	}
	
?>
