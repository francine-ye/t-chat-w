<?php $this->layout('layout', ['title' => 'Messages de mon salon']); ?>

<?php $this->start('main_content'); ?>

<!-- on a uniquement $salon et $messages à notre disposition -->

<h2>Bienvenue sur le salon "<?php echo $this->e($salon['nom']); ?>"</h2>
<ol class="messages">
	<?php $this->insert('salons/inc.messages',['messages'=>$messages]); ?>
</ol>
<!-- J'envoie mon formulaire d'ajout de message sur la page courante
cela va me permettre d'ajouter mes messages à ce salon précisément.
$this->url('see_salon', array('id' => $salon['id'])) va générer une url du genre :
t-chat-w/public/salon/$salon['id']
-->
<!-- On n'affiche le formulaire que si l'utilisateur est connecté -->
<?php if($w_user): ?>
<form class="form-message" action="<?php $this->url('see_salon', array('id'=>$salon['id'])) ?>" method="POST">
	<input type="text" name="message" /><input type="submit" class="button" name="send" value="Envoyer"/>
</form>
<?php else : ?>
<a href="<?php echo $this->url('login'); ?>" 
   title="Accès au formulaire de connexion">
	Connectez-vous pour poster un message !
</a>
<?php endif; ?>
<?php $this->stop('main_content'); ?>

<?php $this->start('javascripts'); ?>
<script type="text/javascript" src="<?php echo $this->assetUrl('js/prepare-chat.js'); ?>"></script>
<script type="text/javascript">
	
var salonId = <?php echo $salon['id']; ?> ;
var homeUrl = '<?php echo $this->url('default_home'); ?>' ;

$(document).ready(function() {
	setInterval(function() {
		var lastMessageId = $('.messages > li:last-child').data('id') || 0;
		
		$.get(homeUrl+'newmessages/'+salonId+'/'+lastMessageId, [], function(data) {
			if($('<div>'+data+'</div>').find('li').length > 0) {
				$('.messages').append(data).scrollTop($('.messages').height());
			}
		});
	}, 500);
});

</script>
<?php $this->stop('javascripts'); ?>
