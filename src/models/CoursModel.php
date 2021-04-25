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
	
	public function getCoursFullInfos() : mixed
    {
        $sql = "SELECT lessons.id, lessons.name, lessons.date_publication, lessons.slug, users.username AS author, difficulties.name AS difficulty
		FROM lessons INNER JOIN users ON users.id = lessons.author
		INNER JOIN difficulties ON difficulties.id = lessons.difficulty";
        $query = $this->connection->query($sql);
        return $query->fetchAll();
    }

	public function addCourse($name, $slug, $difficulty, $categorie, $summary)
	{
		$date = date("Y-m-d H:i:s");
	    $sql = "INSERT INTO lessons VALUES(id, :name, :date_publication, :author, :categorie, :difficulty, :slug, NULL, :summary)";
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

	public function deleteUser($id){
		$sql = "DELETE FROM lessons WHERE id = :lessons_id";
		$stmt = $query = $this->connection->prepare($sql);
		$stmt->bindParam(':lessons_id', $id, \PDO::PARAM_INT);
		$stmt->execute();
	}
}