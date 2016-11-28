<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width initial-scale=1 user-scalable=no">
		<title><?php echo $this -> e($title); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo $this ->assetUrl('css/reset.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo $this ->assetUrl('css/style.css'); ?>">
	</head>

	<body>

		
		<header>
			<h1><?php echo $this-> e($title); ?></h1>
		</header>

		<aside>
 			<a href="<?php echo $this -> url('default_home') ; ?>" title="Revenir à l'accueil"> <h3>Les salons</h3> </a>
 			<nav>
 				<ul id="menu-salons">
 				</ul>
 				<a class="button" href="<?php echo $this -> url('users_list') ; ?>" title="Liste des utilisateurs de T'Chat"> Liste des utilisateurs</a>
 				<a class="button" href="deconnexion.php" title="Se déconnecter de T'Chat"> Déconnexion</a>
 			</nav>
		</aside><main>

			<section>
				<?= $this->section('main_content') ?>
			</section>
		</main>

		<footer>
		</footer>
	</body>	
</html>