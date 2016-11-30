<?php $this -> layout('layout',['title' => 'Messages de mon salon']); ?>


<?php $this->start('main_content') ?>
<!-- on a uniquement $salon et $messages à notre disposition -->

	<h2>Bienvenue sur le salon : "<?php echo $this -> e($salon['nom']) ?>" !</h2>
	<ol class="messages">
		<?php $this->insert('salons/inc.messages', array('messages'=>$messages)) ; ?>	
	</ol>	

	<!-- J'envoie mon formulaire d'ajout de message sur la page courante. Cela va me permettre d'ajouter  mes messages à ce salon précis 
	$this -> url('see_salon', array('id' -> $salon['id'])) va générer une url du genre : 
	t-chat-w/public/salon/2
	-->

	<!-- On affice le formulaire que si l'utilisateur est connecté  -->
	<?php if($w_user) : ?>
	<form class="from-mesage" action="<?php echo $this -> url('see_salon', array('id' => $salon['id']))?>" method="POST" >
		<label>Votre message</label>
		<textarea name="message"> </textarea> 
		<input type="submit" class="button" name="send" value="Envoyer">
	</form>
	<?php else :  ?>
		<a href="<?php echo $this->url('login') ?>" title="Accès au formulaire de connexion"> Connectez-vous pour poster un message </a>
	<?php endif ;  ?>

<?php $this->stop('main_content') ?>




<?php $this->start('javascripts') ?>
	<script type="text/javascript" src="<?php echo $this->assetUrl('js/prepare-chat.js') ?>"></script>

	<script type="text/javascript">
		var salonId = <?php echo $salon['id']; ?> ;
		var homeUrl = '<?php echo $this->url('default_home'); ?>';

		$(function(){
			setInterval(function(){
				var lastMessageId = $('.messages > li:last-child').data('id') || 0;

				// Pour ajout la phrase "est en train d'écrire"
				$('textarea[name="message"]').on('input', function(){
					$.get(homeUrl+'writing/'+salonId, [], function(data){
						// Traitement à la réception de l'info "bidule est en train d'écrire"
					});

				});










				// Premier paramètre : l'url des datas que l'on veut récupérer
				// Deuxième paramètre [] : pas de data injecté car elles sont passées par la route 
				// Dernier paramètre : la fonction que l'on veut exécuter
				$.get(homeUrl+'newmessages/'+salonId+'/'+lastMessageId, [], function(data){
					$('.messages').append(data).scrollTop($('.messages').height());
				});
			}, 500);


		}); // FIN DU DOM
	</script>


<?php $this->stop('javascripts') ?>
