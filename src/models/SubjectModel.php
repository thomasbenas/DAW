<?php
	namespace app\src\models;
	use app\src\core\Model;

	/**
	 * SubjectModel
	 */
	class SubjectModel extends Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->table = 'subjects';
			$this->connection();
		}

		/**
	     * Récupère tous les sujets crées par un utilisateur
	     *
	     * @param  mixed $id 
	     * @return mixed
	     */
		public function GetByAuthor(int $id) : mixed
		{
			$Sql = 'SELECT * FROM subjects WHERE author = ? ORDER BY date DESC';
			$Request = $this->connection->prepare($Sql);
			$Request->bindParam(1, $id);
			$Request->execute();
			return $Request->fetch(\PDO::FETCH_ASSOC);
		}
		/**
	     * Récupère tous les sujets dans lesquels l'utilisateur est intervenu
	     *
	     * @param  mixed $user 
	     * @return mixed
	     */
		public function GetInterventions(int $user)
		{
			$Sql = 'SELECT * FROM subjects
					WHERE
						author = :author
						OR EXISTS 
							(SELECT * FROM posts
							WHERE
								subject = subjects.id
								AND author = :author)
					ORDER BY date DESC';
			$Request = $this->connection->prepare($Sql);
			$Request->bindParam(':author', $user);
			$Request->execute();
			return $Request->fetchAll(\PDO::FETCH_ASSOC);
		}

		/**
	     * Ajoute un sujet dans la base de données
	     *
	     * @param  mixed $user, $category, $title
	     * @return boolean
	     */
		public function Add(int $author, int $category, string $title)
		{
			$Sql = 'INSERT INTO subjects (author, category, title, date)
						VALUES (:author, :category, :title, NOW())';
			$Request = $this->connection->prepare($Sql);
			$Request->bindParam(':author', $author);
			$Request->bindParam(':category', $category);
			$Request->bindParam(':title', $title);
			return $Request->execute();
		}

		/**
	     * Supprime un sujet de la base à partir de son identifiant
	     *
	     * @param  mixed $id 
	     * @return boolean
	     */
		public function Remove(int $id)
		{
			$Sql = 'DELETE FROM subjects WHERE id = :id';
			$Request = $this->connection->prepare($Sql);
			$Request->bindParam(':id', $id);
			return $Request->execute();
		}

		/**
	     * Modifie le titre d'un sujet
	     *
	     * @param  mixed $id, $title 
	     * @return boolean
	     */
		public function UpdateTitle(int $id, string $title)
		{
			$Sql = 'UPDATE subjects SET title = :title WHERE id = :id';
			$Request = $this->connection->prepare($Sql);
			$Request->bindParam(':id', $id);
			$Request->bindParam(':title', $title);
			return $Request->execute();
		}
	}