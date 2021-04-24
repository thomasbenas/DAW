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
	public function GetCategorieIdD(string $name) : int
	{
		$Sql = 'SELECT id FROM categories WHERE name = :name;';
		$Request = $this->connection->prepare($Sql);
		$Request->bindParam(':name', $name);
		$Request->execute();
		return $Request->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	* Recuperation de l'id de la difficultée avec le nom
	*
	* @param string $name
	* @return int
	*/
	public function GetDifficulteID(string $name) : int
	{
		$Sql = 'SELECT id FROM difficulties WHERE name = :name;';
		$Request = $this->connection->prepare($Sql);
		$Request->bindParam(':name', $name);
		$Request->execute();
		return $Request->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	* Ajout d'un cour suivis
	*
	* @param  int $user
	* @param  int $lesson
	*/
	public function AjoutCoursSuivis(int $user, int $lesson)
	{
		$Sql = 'INSERT INTO lessons_taken (user, lesson, date_start)
				VALUES (:user, :lesson, now());';
		$Request = $this->connection->prepare($Sql);
		$Request->bindParam(':user', $user);
		$Request->bindParam(':lesson', $lesson);
		$Request->execute();
	}

	/**
	* Recuperation du contenu du chapitre suivant
	*
	* @param int $lesson
	* @param int $chapitrePrecedent
	* @return string
	*/
	public function GetContenuChapitreSuivant(int $lesson, int $chapitrePrecedent) : string
	{
		$NextChapter = $chapitrePrecedent + 1;
		$Sql = 'SELECT content,lesson,ch_number FROM chapters
				WHERE lesson = :lesson AND ch_number = :next;';
		$Request = $this->connection->prepare($Sql);
		$Request->bindParam(':lesson', $lesson);
		$Request->bindParam(':next', $NextChapter);
		$Request->execute();
		return $Request->fetch(\PDO::FETCH_ASSOC);
	}
}