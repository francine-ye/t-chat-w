<?php foreach ($messages as $message): ?>
	<li data-id="<?php echo $message['id']; ?>">
		<span class="avatar"><img src="<?php echo $this->assetUrl('uploads/' . $message['avatar']); ?>" alt=""/></span>
		<span class="personne"><?php echo $this->e($message['pseudo']); ?> : </span>
		<span class="message"><?php echo $this->e($message['corps']); ?></span>
	</li>
<?php endforeach; 