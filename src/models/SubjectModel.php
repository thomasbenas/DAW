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
		 * Retourne un sujet en fonction du slug et de la catégorie
		 *
		 * @param int $ctg
		 * @param string $slug
		 * @return mixed
		 */
		public function GetBySlug(int $ctg, string $slug)
		{
			$sql = 'SELECT * FROM subjects WHERE category = ? AND slug = ?;';
			$request = $this->connection->prepare($sql);
			$request->execute(array($ctg, $slug));
			return $request->fetch(\PDO::FETCH_ASSOC);
		}

		/**
		 * Retourne un certain nombre de sujet d'une catégorie, classés par date
		 *
		 * @param int $id
		 * @param int $limit
		 * @return mixed
		 */
		public function GetByCategory(int $id, int $limit=-1)
		{
			$sql = 'SELECT * FROM subjects WHERE category = ?';
			$sql = $sql . ' ORDER BY date';
			if ($limit > 0)
				$sql = $sql . ' LIMIT ' . $limit;
			$sql = $sql . ';';
			$request = $this->connection->prepare($sql);
			$request->execute(array($id));
			return $request->fetchAll(\PDO::FETCH_ASSOC);
		}

		/**
		 * Retourne tous les sujets dans lesquels l'utilisateur est intervenu,
		 * soit en créant le sujet, soit en mettant un post
		 *
		 * @param int $user
		 * @return mixed
		 */
		public function GetInterventions(int $user)
		{
			$sql = 'SELECT * FROM subjects AS sbj WHERE author = :user OR EXISTS (SELECT * FROM posts WHERE author = :user AND subject = sbj.id) ORDER BY date DESC;';
			$request = $this->connection->prepare($sql);
			$request->bindParam(':user', $user);
			$request->execute();
			return $request->fetchAll(\PDO::FETCH_ASSOC);
		}

		/**
		 * Ajoute un sujet dans la base de données
		 *
		 * @param int $author
		 * @param int $category
		 * @param string $title
		 * @param string $slug
		 */
		public function Add(int $author, int $category, string $title, string $slug) : void
		{
			$sql = 'INSERT INTO subjects (author, category, title, slug)
						VALUES (:author, :category, :title, :slug);';
			$request = $this->connection->prepare($sql);
			$request->bindParam(':author', $author);
			$request->bindParam(':category', $category);
			$request->bindParam(':title', $title);
			$request->bindParam(':slug', $slug);
			$request->execute();
		}

		/**
		 * Retire un sujet de la base de données
		 *
		 * @param int $subject
		 */
		public function Remove(int $subject) : void
		{
			$sql = 'DELETE FROM subjects WHERE id = ?;';
			$request = $this->connection->prepare($sql);
			$request->execute(array($subject));
		}
	}