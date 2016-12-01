<!-- Exceptionnellement, on n'inscrit pas la vue dans un layout car
elle s'exécute dans un contexte AJAX. Je n'ai donc besoin que de la partie 
qui m'intéresse, à savoir la liste des nouveaux messages
-->
<!-- Pour les requêtes du chat, j'ai besoin de l'id du dernier message 
Ici, je fais en sorte que cette information soit portée par tous mes messages
-->
<?php $this->insert('salons/inc.messages',['messages'=>$messages]);