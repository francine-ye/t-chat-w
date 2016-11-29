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
 					<?php foreach($salons as $salon): ?>
 						<!-- $salons a été crée dans le BaseController dans l'engine->addData -->
 						
 						<li> <a href="<?php echo $this -> url('see_salon', array('id' => $salon['id']))?>"> <?php echo $this->e($salon['nom']); ?> </a> </li>
 					<?php endforeach; ?>
 				</ul>
 				<a class="button" href="<?php echo $this -> url('users_list') ; ?>" title="Liste des utilisateurs de T'Chat"> Liste des utilisateurs</a>
 				<a class="button" href="<?php echo $this -> url('logout')?>" title="Se déconnecter de T'Chat"> Déconnexion</a>
 			</nav>
		</aside><main>

			<section>
				<?= $this->section('main_content') ?>
			</section>
		</main>

		<footer>
		</footer>

		<script
		  src="https://code.jquery.com/jquery-2.2.4.min.js"
		  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
		  crossorigin="anonymous"></script>
		  <script type="text/javascript" src="<?php echo $this->assetUrl('js/close-flash-messages.js') ?>"></script>
	</body>	
</html>