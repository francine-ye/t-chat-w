<?php


namespace Model;

use \PDO;
use \W\Model\Model;

/**
 * Description of MessagesModel
 *
 * @author Admin
 */
class MessagesModel extends Model {
	
	/**
	 * Cette fonction sélectionne tous les messages d'un salon en les associant
	 * avec les infos de leur utilisateur respectif
	 * @param int $idSalon l'id du salon dont on souhaite récupérer les messages
	 * @return array la liste des messages avec les infos utilisateur
	 */
	public function searchAllWithUserInfos($idSalon, $idMessage = null) {
		$query = "SELECT messages.*, utilisateurs.pseudo, utilisateurs.avatar "
				. "FROM $this->table"
				. " JOIN utilisateurs ON $this->table.id_utilisateur = utilisateurs.id"
				. " WHERE id_salon = :id_salon";
		
		$idMessageExists = $idMessage !== null && ctype_digit($idMessage);
		
		if($idMessageExists) {
			$query .= ' AND messages.id > :id_message';
		}
		
		$query .= ' ORDER BY messages.id ASC';
		
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(':id_salon', $idSalon, PDO::PARAM_INT);
		
		if($idMessageExists) {
			$stmt->bindParam(':id_message', $idMessage, PDO::PARAM_INT);
		}
		
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
