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
	/**
	 * Récupération de tout les chapitres en fonction du cours.
	 * 
	 * @param string $slug 
	 */
	public function getAllChapitre(string $slug)
	{
		$sql = "SELECT chapters.name, chapters.slug FROM chapters,lessons WHERE lesson = lessons.id  AND lessons.slug = '"  . $slug . "'";
		$query = $this->connection->query($sql);
		return $query->fetchAll();
	}
	/**
	 * Récupération d'un chapitre en fonction du slug.
	 */
	public function getChapitreBySlug(string $slug)
	{
		$sql = "select * from chapters where slug = '" .$slug . "'";
		$query = $this->connection->query($sql);
		return $query->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 * Récupération de tout les chapitres en fonction du cours.
	 * 
	 * @param int $lesson ID du cours
	 */
	public function getAllChapitreLesson(int $lesson)
	{
		$sql = "SELECT * from chapters where lesson = '" . $lesson . "'"; 
		$query = $this->connection->query($sql);
		return $query->fetchAll();		

	}
	/**
	 * Récupération des données d'un chapitre en fonction de son numéro.
	 */
	public function getChapitreNumber(int $number, int $lesson)
	{

		$sql = "SELECT * from chapters where ch_number = '" . $number . "' and lesson = '" .$lesson ."'";
		$query = $this->connection->query($sql);
		return $query->fetch(\PDO::FETCH_ASSOC);		
		$this->connection();
	}
	
	public function getCoursFullInfos() : mixed
    {
        $sql = "SELECT lessons.id, lessons.name, lessons.date_publication, lessons.slug, users.username AS author, difficulties.name AS difficulty, categories.name AS category 
		FROM lessons INNER JOIN users ON users.id = lessons.author
		INNER JOIN difficulties ON difficulties.id = lessons.difficulty
		INNER JOIN categories ON lessons.category = categories.id";
        $query = $this->connection->query($sql);
        return $query->fetchAll();
    }

	public function addCourse($name, $slug, $difficulty, $categorie, $summary)
	{
		$date = date("Y-m-d H:i:s");
	    $sql = "INSERT INTO lessons VALUES(id, :name, :date_publication, :author, :categorie, :difficulty, :slug, image, :summary)";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':name',$name);
		$stmt->bindParam(':date_publication', $date);
		$stmt->bindParam(':author',$_SESSION['id']);
		$stmt->bindParam(':categorie',$categorie);
		$stmt->bindParam(':difficulty',$difficulty);
		$stmt->bindParam(':slug',$slug);
		$stmt->bindParam(':summary',$summary);
		$stmt->execute();
	}

	public function addChapter($lesson, $name, $slug, $content){
		$sql = "INSERT INTO chapters VALUES(id, :lesson, NULL, :name, :content, :slug)";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':lesson', $lesson);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':content',$content);
		$stmt->bindParam(':slug',$slug);
		$stmt->execute();
	}

	public function deleteUser($id){
		$sql = "DELETE FROM lessons WHERE id = :lessons_id";
		$stmt = $query = $this->connection->prepare($sql);
		$stmt->bindParam(':lessons_id', $id, \PDO::PARAM_INT);
		$stmt->execute();
	}
}
?>
