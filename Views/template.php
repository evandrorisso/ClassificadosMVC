<!DOCTYPE html>
<html lang="pt_br">
<head>
	<meta charset="UTF-8">
	<title>Classificados - Êxodo TI</title>
	<link rel="stylesheet" href="<?php echo BASE_URL?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL?>assets/css/style.css">
	<script type="text/javascript" src="<?php echo BASE_URL?>assets/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL?>assets/js/script.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="<?php echo BASE_URL?>" class="navbar-brand">Classificados</a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<?php if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])): ?>
				<li><a href="<?php echo BASE_URL;?>Perfil/"><?php 
					echo $viewData['dado']['dados']['nome'];
				 ?></a></li>
				<li><a href="<?php echo BASE_URL;?>Anuncios">Meus Anúncios</a></li>
				<li><a href="<?php echo BASE_URL;?>Home/Sair">Sair</a></li>
			<?php else: ?>
				<li><a href="<?php echo BASE_URL;?>Home/Cadastrar">Cadastre-se</a></li>
				<li><a href="<?php echo BASE_URL;?>Home/Login">Login</a></li>
			<?php endif; ?>
		</ul>
	</div>
	</nav>
<?php $this->loadViewInTemplate($viewName, $viewData); ?>
</body>
</html>