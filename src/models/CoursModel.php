<?php

namespace app\src\models;

use app\src\core\Model;

/**
 * CoursModel
 */
class CoursModel extends Model
{

    public function __construct()
    {
        parent::__construct();
	$this->table = "lessons";
        $this->connection();
    }
    

	/**
	* Recuperation de l'id de la catégorie avec le nom
	*
	* @param string $name
	* @return int
	*/
	public function getCategorieIdD(string $name) : int
	{
		$sql = "SELECT `id` FROM `categories` WHERE `name` = '".$name."'";
		$query = $this->connection->query($sql);
		return $query->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	* Recuperation de l'id de la difficultée avec le nom
	*
	* @param string $name
	* @return int
	*/
	public function getDifficulteID(string $name) : int
	{
		$sql = "SELECT `id` FROM `difficulties` WHERE `name` = '".$name."'";
		$query = $this->connection->query($sql);
		return $query->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	* Ajout d'un cour suivis
	*
	* @param  int $user
	* @param  int $lesson
	*/
	public function ajoutCoursSuivis(int $user, int $lesson)
	{
	    $sql = "INSERT INTO `lessons_taken` (`user`, `lesson`, `date_start`, `status`)
				VALUES (':user', ':lesson', now(), '1');";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':user',$user);
		$stmt->bindParam(':lesson',$lesson);
	}

	/**
	* Recuperation du contenu du chapitre suivant
	*
	* @param int $lesson
	* @param int $chapitrePrecedent
	* @return string
	*/
	public function getContenuChapitreSuivant(int $lesson, int $chapitrePrecedent) : string
	{
		$sql = "SELECT `content`, `lesson`, `ch_number` FROM `chapters` 
				WHERE `lesson` = '".$lesson."' AND `ch_number` = '".$chapitrePrecedent."+1'";
		$query = $this->connection->query($sql);
		return $query->fetch(\PDO::FETCH_ASSOC);
	}
}

?>
