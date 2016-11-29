<?php

namespace Controller;

use Model\UtilisateursModel;
use W\Security\AuthentificationModel;


class UserController extends BaseController
{
	/**
	 * 	Cette fonction sert à afficher la liste des utilisateurs 
	 */
	public function listUsers()
	{
		/**
		 * J'instancie depuis l'action du controler un modele d'utilisateurs pour pouvoir accéder à la liste des utilisateurs
		 */
		$usersModel = new UtilisateursModel();
		$usersList = $usersModel -> findAll();


		//	$usersList = array('GoogleMan', 'Pausewoman','Yaké', 'Roland');
		/* Affiche la vue présente dans app/views/users/list.php et y injecte le tablaeu $usersList sous un nouveau nom $listUsers */
		$this -> show('users/list', array('listUsers' => $usersList));
	}
	
	public function login()	{
		// On va utiliser le modèle d'authentifaction et plus particulièrement la méthode isValidLoginInfos à laquelle on passera en paramètre le pseudo/email et le password envoyés en POST par l'utilisateur 
		// Une fois cette vérification faite, on récupère l'utilisateur en BDD on le connecte et on le redirige vers la page d'accueil 


		if (!empty($_POST)) {
			// 1) Je vérifie la non-vacuité du pseudo en POST 
			if (empty($_POST['pseudo'])) {
				$this->getFlashMessenger()->error('Veuillez entrer un pseudo');
			}
			// 1) Je vérifie la non-vacuité du mdp en POST
			if (empty($_POST['mot_de_passe'])) {
				$this->getFlashMessenger()->error('Veuillez entrer un mot de passe');
			}

			$authentifaction = new AuthentificationModel();

			if (! $this->getFlashMessenger()->hasErrors()) {
				//Vérification de l'existence de l'utilisateur
				$idUser = $authentifaction->isValidLoginInfo($_POST['pseudo'], $_POST['mot_de_passe']); 

				// Si l'utilisateur existe, on le connecte
				if ($idUser !== 0) {
					$utilisateurModel = new UtilisateursModel();

					//Je récupère les infos de l'utilisateur et je m'en sers pour le connecter au site à l'aide de $authentifaction->logUserIn($userInfos);
					$userInfos = $utilisateurModel -> find($idUser);
					$authentifaction -> logUserIn($userInfos);

					//Une fois que l'utilisateur est connec, je le redirige vers l'acceil 
					$this->redirectToRoute('default_home');
				}else{
					$this->getFlashMessenger()->error('Vos informations de connexion sont incorrectes');
				}
			}

		}

		$this->show('users/login', array('datas' => isset($_POST) ? $_POST : array()));
		// chemin à partir de Views : users/login.php
		// array('datas' => isset($_POST) ? $_POST : array() permet d'injecter des informations à la vue
	}


	public function logout(){
		$authentifaction = new AuthentificationModel();
		$authentifaction->logUserOut();
		$this->redirectToRoute('login');
	}

	public function register(){
		$this->show('users/register');
	}







}

