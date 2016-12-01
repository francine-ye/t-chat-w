<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
	<h2>Hello W !</h2>
	<p>T'Chat compte acutellement <span class="nbSalons"><?php echo count($salons); ?> salons</span></p>
	<p>Accédez à un salon ou <a href="<?php echo $this->url('add_salon'); ?>">créez-en un nouveau</a>!</p>
<?php $this->stop('main_content') ?>

