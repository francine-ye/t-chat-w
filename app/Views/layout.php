<!DOCTYPE html>

<html lang="fr">
    <head>
        <title><?php echo $this->e($title); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- $this->assetUrl('css/style.css') vaudra 'assets/css/style.css' -->
        <link rel="stylesheet" href="<?php echo $this->assetUrl('css/reset.css'); ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo $this->assetUrl('css/style.css'); ?>" type="text/css" />
    </head>
    <body>

		<header>
			<h1><?php echo $this->e($title); ?></h1>
		</header>
		<aside>
			<h3><a href="<?php echo $this->url('default_home'); ?>" title="Revenir à l'accueil">Les salons</a></h3>
			<nav>
				<ul id="menu-salons">
					<!-- On parcourre les nom des salons pour afficher me menu -->
					<?php foreach ($salons as $salon) : ?>
						<!-- ici $salon est équivalent à $salons[$i] dans la boucle for -->
						<!-- mon href va pointer vers une nouvelle page (salon.php)
						   dans laquelle je vais pouvoir récupérer ma variable "id" 
							grâce à $_GET['id']
						-->
						<li> 
							<a href="<?php echo $this->url('see_salon', array('id' => $salon['id'])) ?>">
								<?php echo $this->e($salon['nom']); ?></a> 
						</li>
					<?php endforeach; ?>
					
					<?php if($w_user): ?>
					<li>
						<a class="button" href="<?php echo $this->url('add_salon') ?>">
							Ajouter un nouveau salon
						</a>
					</li>	
					<?php endif; ?>
					
					<li>
						<?php if($w_user): ?>
						<a class="button" href="<?php echo $this->url('profile') ?>">
							Mon profil
						</a>
						<?php else: ?>
						<a class="button" href="<?php echo $this->url('register') ?>">
							S'inscrire à T'Chat
						</a>
						<?php endif; ?>
					</li>	
					
						
					<?php if(in_array($w_user['role'], ['admin', 'superadmin'])): ?>
					<li>
						<a class="button" href="<?php echo $this->url('users_list'); ?>" title="Liste des utilisateurs">
							Liste des utilisateurs
						</a>
					</li>
					<?php endif; ?>
					<li>
						<?php if($w_user): ?>
						<a class="button" 
						   href="<?php echo $this->url('logout'); ?>" 
						   title="Se déconnecter de T'Chat">
							Déconnexion
						</a>
						<?php else : ?>
						<a class="button" 
						   href="<?php echo $this->url('login') ?>" 
						   title="Accéder au formulaire de connexion">
							Connexion
						</a>
						<?php endif; ?>
					</li>
				</ul>

			</nav>
		</aside><main>

			<section>
				<?php $fmsg->display(); ?>
				<?= $this->section('main_content') ?>
			</section>
		</main>
		<footer>
		</footer>
		<script
			src="https://code.jquery.com/jquery-2.2.4.js"
			integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
		crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?php echo $this->assetUrl('js/close-flash-messages.js') ?>"></script>
		<?php $sectionJavascripts = $this->section('javascripts');
			if( ! empty($sectionJavascripts)) {
				echo $sectionJavascripts;
			}
		?>
 	</body>

</html>
