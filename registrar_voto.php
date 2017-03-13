<?php 
	if(isset($_POST['id_enquete'])){
		$id_enquete = $_POST['id_enquete'];
		$codigo = $_POST['codigo'];
		$opcao = $_POST['opcao'];

		session_start();

		if(isset($_SESSION['user'])){
			$em = $_SESSION['user']['email'];
			$key = $_SESSION['user']['chave'];
			require_once 'inc_conexao.php';
			
			if($key == $codigo){
				$sql="SELECT id_enquete FROM votacao WHERE id_enquete=? AND email=?";
				$res = $conexao->prepare($sql);
				$res->execute(array($id_enquete,$em));
				
				if($res->rowCount() > 0)
					echo '2';//usuario já votou nesta enquete
				else{
					$sql="INSERT INTO votacao(id_enquete,email) VALUES(?,?)";
					$res = $conexao->prepare($sql);
					$res->execute(array($id_enquete,$em));
					
					$sql="UPDATE opcoes SET votos = votos + 1 WHERE id=?";
					$res = $conexao->prepare($sql);
					$res->execute(array($opcao));
					
					echo '1';
				}
			}else
				echo '0';
		}
		
	}else
		echo '-1';


 ?>