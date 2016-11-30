<?php foreach ($messages as $message):  ?>
	
	<!-- Pour les requêtes AJAX, j'ai besoin des id du dernier message. Dans le li, je fais un sorte que l'id apparaisse dans tous les messages -->
	<li data-id="<?php echo $message['id'] ?>">
	<span class="avatar"><img src="<?php echo $this->assetUrl('uploads/'.$message['avatar']);?>" alt=""></span>
	<span class="personne"><?php echo $this -> e($message['pseudo']); ?> : </span>
	 <span class="message"><?php echo $this -> e($message['corps']); ?></span> 
	 </li>

<?php endforeach ; ?>	