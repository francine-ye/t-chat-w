<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],

		// QUand on essaye d'accéder à l'url : localhost/t-chat/public, l'url vraiment recu est localhost/t-chat/index.php
		//Cette route n'est accessible que par la méthode GET 
		['GET', '/test', 'Test#monAction', 'test_index'],
		// Test = nom du fichier dans app/Controller/TestController
		// monAction = nom de la méthode 
		// test_index = nom que l'on donne à notre route
		['GET', '/users', 'User#listUsers', 'users_list'],
		
		['GET|POST', '/salon/[i:id]','Salon#seeSalon', 'see_salon'],
		// [] = paramètre variable 
		// i: = int, un entier 
		// id = correspond au paramètre id de la méthode seeSalon

		['GET|POST', '/login','User#login', 'login'],
		['GET', '/logout','User#logout', 'logout'],
		['GET|POST', '/register','User#register', 'register'],
		// Cette route va être accessible en ajax et servira à renvoyer les messages d'un salon qui ont été postés depuis un id donné 
		['GET', '/newmessages/[i:idSalon]/[i:idMessage]','Salon#newMessages', 'new_messages'],






	);

