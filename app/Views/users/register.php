<?php 

function affichePost($champ){
	echo (!empty($_POST[$champ])? $_POST[$champ] : '');
}

function afficheCheck($valeurAttendue){
	// Si on a renseigné un sexe en POST et que la valeur entrée en POST est celle qui est attendue par l'input radio, alors on veut cocher cette input Le checked permet de choisir par défaut un bouton
	echo (!empty($_POST['sexe']) && $_POST['sexe']==$valeurAttendue) ? 'checked' : '';
}


?>


<?php $this->layout('layout', ['title'=> 'Inscrivez-vous']); ?>


<?php $this->start('main_content'); ?>

<h2> Inscription d'un utilisateur </h2>

<form action="<?php echo $this->url('register');?>" method="POST" enctype="multipart/form-data">
	<!-- pseudo email avatar password sexe avatar -->
	<p>
		<label for="pseudo"> Pseudo </label>
		<input type="text" name="pseudo" id="pseudo" value="<?php affichePost('pseudo');  ?>" placeholder="3 à 50 caractères"> 

	</p>

	<p>
		<label for="email"> Email </label>
		<input type="text" name="email" id="email" value="<?php affichePost('email'); ?>">

	</p>

	<p>
		<label for="mot_de_passe"> Mot de passe </label>
		<input type="password" name="mot_de_passe" id="mot_de_passe" value="<?php affichePost('mot_de_passe'); ?>"> 
	</p>

	<p>
		<label for="femme"> Femme </label>
		<input type="radio" name="sexe" id="femme" value="femme"" <?php afficheCheck('femme'); ?> > 
		<label for="homme"> Homme </label>
		<input type="radio" name="sexe" id="homme" value="homme" <?php afficheCheck('homme'); ?>> 
		<label for="non-defini"> Non défini </label>
		<input type="radio" name="sexe" id="non-defini" value="non-defini" <?php afficheCheck('non-defini'); ?>> 
	</p>

	<p>
		<label for="avatar"> Avatar </label>
		<input type="file" name="avatar" id="avatar"> 
	</p>

	<p>
		<input type="submit" name="send" value="S'inscrire">
	</p>

</form>

<?php $this->stop('main_content'); ?>



