<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sua Enquete - Home</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src='js/jquery-3.1.1.min.js'></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src='js/votacao.js'></script>
	<style>
		body{background-color: #f0f0f0;}
		.div-enquetes{border:1px solid #ccc; border-radius:5px; padding-left:10px; padding-bottom:5px; margin-bottom:10px; background-color: white}
		.div-enquetes:hover{cursor:pointer;}
		.destaque{border:1px solid #ccc; border-radius:5px; padding-left:5px; padding-bottom:5px; margin-bottom:10px; background-color: white}
		.destaque div{margin:0 auto;}
		#lista-opcoes{margin:20px 0 20px;}
		#lista-opcoes th,td{padding-right: 5px; padding-top: 5px;}
		/*#myModal{margin-top: 200px;}*/
		.jumbotron{background-color: white; border-bottom: 1px solid #ccc; padding-bottom: 0;}
		footer{background-color: #888;}
		
	</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Home</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Assuntos<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Política</a></li>
                  <li><a href="#">Tecnologia</a></li>
                  <li><a href="#">Entretenimento</a></li>
                  <li><a href="#">Diversos</a></li>
                </ul>
              </li>
              <li><a href="#">Quem Somos</a></li>
              <li><a href="#">Contato</a></li>
            </ul>
            <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Procure por uma enquete" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Buscar</button>
          </form>
          </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	 <div class="jumbotron">
      <div class="container">
        <h1>SuaEnquete</h1>
        <p>Seu portal de enquetes sobre vários assuntos interessantes.</p>
        <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Crie sua enquete &raquo;</a></p> -->
      </div>
    </div>
	
	<div id="myModal" class="modal" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Registrando seu voto</h4>
	      </div>

	      <div id='div-email' class="modal-body">
	        <p>Para votar, você precisa informar seu e-mail.</p>
	        <form id='form-email' action="" method="post">
	        	<div class="form-group">
	        	<input type="e-mail" class="form-control" id='email'>
	        	</div>
				<button id='btn-enviar-email' class="btn btn-success">Enviar</button>
	        </form>
	      </div>

		  <div id='div-loading' class="modal-body" style="text-align: center">
		  	<p>Aguarde...</p>
		  	<img src="img/ajax-loader.gif" alt="" id='loading'>
		  </div>

	      <div id='div-codigo' class="modal-body">
	        <p>Foi enviado o Código de validação para no seu e-mail.<br>Você deve digitá-lo no campo abaixo para confirmar seu voto.</p>
			<form id='form-codigo' action="" method="post">
				<div class="form-group">
	        	<input type="text" class="form-control" id='codigo'>
	        	</div>
				<button id='btn-enviar-codigo' class="btn btn-success">Enviar</button>
	        </form>
	      </div>
	      <div id='div-msg' class="modal-body">
	       	<p id='pmsg'>O código digitado é inválido. Verifique seu e-mail</p>
	      </div>
		
	      <div class="modal-footer">
	        <button type="button" id='btn-fechar' class="btn btn-default" data-dismiss="modal">Fechar</button>
	      </div>
	    </div>
	  </div>
	</div>

    <div class="container">
		<div class='row'>
			<div class="col-md-12" align="center">
				<div class='destaque'>
				<?php
					
					require_once 'inc_conexao.php';
					
					$sql="SELECT * FROM enquetes WHERE status='Publicado' ORDER BY id DESC LIMIT 1";
					$res = $conexao->query($sql);
					$row = $res->fetch(PDO::FETCH_ASSOC);
					$id = $row['id'];
					$titulo = $row['titulo'];
					$data = date('d/m/Y',strtotime($row["data"]));
					//$autor = $row['autor'];
				?>
					<div>	
				  <h2 id='titulo-destaque'><?= $titulo ?></h2>
				  <p>Publicado em <span id='spn-data'><?= $data ?></span></p>
				  <form id='form-voto' action="" method="post">
					<input type="hidden" value='<?=$id?>' id='id_enquete'>
						<table id='lista-opcoes'>
						 <?php
						 	$sql = "SELECT MAX(votos) as maior FROM opcoes WHERE id_enquete={$id}";
							$res = $conexao->query($sql);
							$ret = $res->fetch();
							$maior = $ret['maior'];

							 $sql="SELECT * FROM opcoes WHERE id_enquete={$id} ORDER BY votos DESC";
							 $res = $conexao->query($sql);
							 while($row = $res->fetch(PDO::FETCH_ASSOC)){
								echo "<tr>
										<td><label for='opcao[{$row['id']}]'>{$row['opcao']}</label></td>
										<td><input type='radio' name='opcao' id='opcao[{$row['id']}]' value='{$row['id']}' ></td>
										<td><div class='div-qtd-votos'><progress max='{$maior}' value='{$row['votos']}'> </progress>{$row['votos']} votos</div></td></tr>" ;
							 }
						 ?>
						</table>
				  </form>
				  <p><a class="btn btn-success" id='btn-votar' style='width:150px;' role="button" data-toggle="modal" data-target="#myModal" >Votar &raquo;</a></p>
				  </div>	
				</div>
			</div>
		</div>
	
	
	  <?php
			require_once 'inc_conexao.php';
			
			//$sql="SELECT * FROM enquetes WHERE status='Publicado' and not id={$id} ORDER BY id DESC";
			$sql="SELECT * FROM enquetes WHERE status='Publicado' ORDER BY id DESC";
			$res = $conexao->query($sql);
			while($row = $res->fetch(PDO::FETCH_ASSOC)){
				$id = $row['id'];
				$titulo = $row['titulo'];
				$data = date('d-m-Y',strtotime($row["data"]));
				$autor = $row['autor'];
		?>		
      <div class="row">
      	<div class="col-md-12">
			<div class='div-enquetes'>
				<input type='hidden' value='<?=$id?>' id='idenq' >
				<input type='hidden' value='<?=$titulo?>' id='tituloenq' >
				<input type='hidden' value='<?=$data?>' id='dataenq' >
				<input type='hidden' value='<?=$autor?>' id='autorenq' >
				<h2><?=$titulo?></h2>
				<p>Publicado em <?=$data?> por <?=$autor?></p>
				
		   </div>
	   </div>
      </div>
		<?php
			}
		?>
    </div> <!-- /container -->
	<footer>
		<div class="container">
			<p>&copy; 2017 Company, Inc.</p>
		</div>
     </footer>
	

</body>
</html>
