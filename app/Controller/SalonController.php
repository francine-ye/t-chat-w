<?php

namespace Controller;

use \Model\SalonsModel; 
use \Model\MessagesModel; 

class SalonController extends BaseController
{
	/**
	 * Cette action permet de voir la liste des messages d'un salon
	 * @param int $id l'id du salon dont je cherche à voir les messages
	 */
	public function seeSalon($id){

		/**
		 * On instancie le modèle des salons de fa_on à récupérer les informations du salon dont l'id est $id (passé dans l'url)
		 */
		$salonsModel = new SalonsModel();
		$salon = $salonsModel -> find($id);

		/**
		 * On instancie le modèle des messages pour récupérer les messages du salon dont l'id est $id
		 */
		$messagesModel = new MessagesModel();

		/**
		 * J'utilise une méthode propre au model MEssages qui permet de récupérer les messages avec les infos utilisateurs associées
		 */

		$messages = $messagesModel-> searchAllWithUserInfos($id);
		$this->show('salons/see', array('salon' => $salon, 'messages' => $messages));

	}

}