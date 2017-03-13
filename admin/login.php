<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Título</title>
		<link rel="stylesheet" href="../css/estilo.css">
	</head>
	<body>
		<div style="margin:0 auto; width:400px; padding-top: 50px;">
			<h2>Área restrita.<br> Para acessar, entre com login e senha de administrador</h2>
			<div style="width:360px; height:180px; margin-top:200px; border:1px solid #ccc; border-radius:10px; font-size:25px; padding-left:40px; padding-top:20px; background-color:#f0f0f0;">
				<form method="post" action="auth.php">
					<table cellpadding="10">
						<tr><td>Login:</td><td><input type="text" name="login"></td></tr>
						<tr><td>Senha:</td><td><input type="password" name="senha"></td></tr>
						<tr><td><button type="submit">Entrar</td></tr>
					</table>
				</form>
			</div>
			<div style="color:red; font-size:20px;">
			<?php 
				if(isset($_SESSION["auth_message"])) echo $_SESSION["auth_message"];
			?>
			</div>
		</div>
	</body>
</html>