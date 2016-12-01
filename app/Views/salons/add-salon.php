<?php $this->layout('layout', ['title' => 'Ajout d\'un nouveau salon']); ?>

<?php $this->start('main_content'); ?>

<form action="<?php echo $this->url('add_salon') ?>" method="post">
	<label for="nom"> Nouveau salon : </label>
	<input type="text" name="nom" id="nom"/>
	<input type="submit" name="send" value="Ajouter"/>
</form>

<?php $this->stop('main_content'); ?>
