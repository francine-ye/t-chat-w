<?php

namespace Model;
use W\Model\Model;
use \PDO;


class MessagesModel extends Model
{
	/**
	 * Cette fonction sélectionne tous les messages d'un salon en les associant avec les infos de leur utilisateur respectif
	 * @param type INT $idSalon : l'id du salon dont on souhaite récupérer les messages
	 *@return type array : la liste des messages avec les infos utilisateurs 
	 */
	public function searchAllWithUserInfos($idSalon){
		$query = "SELECT * FROM $this->table"
			." JOIN utilisateurs ON $this->table.id_utilisateur = utilisateurs.id"
			." WHERE id_salon = :id_salon";

		$statement = $this->dbh->prepare($query); 
		$statement -> bindParam(":id_salon", $idSalon, PDO::PARAM_INT);
		$statement -> execute();
		return $statement -> fetchAll();
	}


}