<?php

namespace Controller;

use Model\UtilisateursModel;
use W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;
use \Respect\Validation\Exceptions\NestedValidationException;

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
		if (!empty($_POST)) {
			//Permet de dire à respect\validation où (namespace) aller chercher nos rules
			v::with("Validation\Rules");

			$validators = array(
				"pseudo" => v::length(3,50)
				->alnum()
				->noWhiteSpace()
				->usernameNotExists()
				->setName('Nom d\'utilisateur'), 

				"email" => v::email()
				->EmailNotExists()
				->setName('Email'),

				"mot_de_passe" => v::length(3,50)
				->noWhiteSpace()
				->alnum()
				->setName('Mot de passe'), 

				"sexe" => v::in(['femme','homme','non-defini']),

				"avatar" => v::optional(
					v::image()->size('1MB')
					->uploaded()
				)
			);

			$datas = $_POST;

			//On ajoute le chemin vers le fichier d'avatar qui a été uploadé s'il y en a
			if (!empty($_FILES['avatar']['tmp_name'])) {
				// Je stocke en donnée à valider le chemin vers la localisation temporaire de l'avatar
				$datas['avatar'] = $_FILES['avatar']['tmp_name'];
			}else{
				//Sinon je laisse le champ vide
				$datas['avatar'] = '';
			}


			// Je parcours la liste de mes validators en récupérant aussi le nom du champ en clé 
			foreach ($validators as $field => $validator) {
				// La méthode assert renvoieune exception de type NestedValidationException qui nous permet de récupérer le(s) message(s) d'erreur en cas d'erreur
				try{
					// On essaye de valider la donnée. 
					//Si une exception se produit, c'est le bloc catch qui sera exécuté
					$validator->assert(isset($datas[$field]) ? $datas[$field] : '');
				}
				// l'excetpion $ex sera du type NestedValidationException
				catch (NestedValidationException $ex){
					$fullMessage = $ex->getFullMessage();
					$this->getFlashMessenger()->error($fullMessage);
				}
			}
			if (!$this->getFlashMessenger()->hasErrors()) {
				//Si on n'a pas rencontré d'erreur, on procède à l'insertion du nouvel utilisateur 
				//Avant l'insertion, on doit faire deux choses: 
				//		- Déplacer l'avatar du fichier temporaire vers une localisation 		le dossier avatar/
				//		- Hasher le password


				// On hashe d'abord le mot de passe. On utilise pour cela le modèle AuthentificationModel pour rester cohérent avec le framework
				$authentifaction = new AuthentificationModel();
				$datas['mot_de_passe'] = $authentifaction->hashPassword($datas['mot_de_passe']);

				//On déplace l'avatar vers le dossier avatar/
				if (!empty($_FILES['avatar']['tmp_name'])) {
					$initialAvatarPath = $_FILES['avatar']['tmp_name'];
					$avatarNewName = md5(time().uniqid());
					$targetPath = realpath('assets/uploads');
					move_uploaded_file($initialAvatarPath, $targetPath.'/'.$avatarNewName);

					// On met à jour le nouveau nom de l'avatar dans $datas 
					$datas['avatar'] = $avatarNewName;
				}else{
					$datas['avatar'] = 'default.jpg';

				}
				
				

				//INSERTION EN BDD sauf le boutton send
				$utilisateurModel = new UtilisateursModel();
				$utilisateurModel->insert($datas);
				unset($datas['send']);

				// Connexion suite à l'inscription
				$utilisateurModel = new UtilisateursModel();
				$userInfos = $utilisateurModel->find($datas);
				$authentifaction -> logUserIn($userInfos);

				$this->getFlashMessenger()->success('Vous vous êtes inscrit à T-Chat');
				$this->redirectToRoute('default_home');

			}
		}



		$this->show('users/register');
	}







}

