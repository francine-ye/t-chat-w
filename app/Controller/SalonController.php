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

		$currentUser = $this->getUser();
			
		if ($currentUser){
			if (!empty($_POST)) {
				
				$message = $_POST['message'];
				$idSalon = $id; 
				$idUser = $currentUser['id'];
				$creationDate = date('Y-m-d H:i:s');
				$modificationDate = date('Y-m-d H:i:s');

				
				$data = array(
					// les clés correspondent aux noms présents dans la table message
					'corps' => $message,
					'id_salon' => $idSalon,
					'id_utilisateur' => $idUser,
					'date_creation' => $creationDate,
					'date_modification' => $modificationDate,
				);
				$messageInfos=$messagesModel->insert($data);
			}

		}else{
			$this->getFlashMessenger()->error('Vous devez être connecté');

		}

		/**
		 * J'utilise une méthode propre au model MEssages qui permet de récupérer les messages avec les infos utilisateurs associées
		 */
		$messages = $messagesModel-> searchAllWithUserInfos($id);

		$this->show('salons/see', array('salon' => $salon, 'messages' => $messages));
	}

	public function newMessages($idSalon, $idMessage){
		$messagesModel = new MessagesModel();
		$messages = $messagesModel-> searchAllWithUserInfos($idSalon, $idMessage);

		$this->show('salons/newmessages', array('messages'=>$messages));

	}

}