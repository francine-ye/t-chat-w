<?php $this->layout('layout', ['title'=> 'Connectez-vous']); ?>


<?php $this->start('main_content'); ?>

	<h2>Connectez-vous à T'Chat</h2>
	<?php $fmsg->display(); ?>

	<form action="<?php echo $this->url('login') ?>" method="POST">
		<p>
			<label for="pseudo">
				Veuillez renseigner un pseudo : 
			</label>
			<input type="text" name="pseudo" id="pseudo" value="<?php echo isset($datas['pseudo']) ? $datas['pseudo'] : '' ; ?>">

		</p>

		<p>
			<label for="mot_de_passe">
				Veuillez renseigner un mot de passe : 
			</label>
			<input type="text" name="mot_de_passe" id="mot_de_passe">
		</p>

		<p>
			<input type="submit" class="button" value="Me connecter">
			<a href="#" title="Accéder à la page d'inscription">Pas encore inscrit ? </a>
		</p>


		
	</form>

<?php $this->stop('main_content'); ?>



