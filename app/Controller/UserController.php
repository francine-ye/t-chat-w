<?php

namespace Controller;

use Model\UtilisateursModel;

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
	

}