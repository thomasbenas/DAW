<?php
	namespace app\src\models;
	use app\src\core\Model;

	/**
	 * PostModel
	 */
	class PostModel extends Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->table = 'posts';
			$this->connection();
		}

		/**
		 * Retourne tous les posts d'un sujet
		 *
		 * @param int $sbj
		 * @return mixed
		 */
		public function GetBySubject(int $sbj)
		{
			$sql = "SELECT subject, posts.id, content, date, author, users.username AS author_name
			FROM users 
			INNER JOIN posts ON posts.author = users.id 
			WHERE subject = ? 
			ORDER BY date";
			$request = $this->connection->prepare($sql);
			$request->execute(array($sbj));
			return $request->fetchAll(\PDO::FETCH_ASSOC);
		}

		/**
		 * Retourne le dernier post d'un utilisateur sur un sujet
		 *
		 * @param int $author
		 * @param int $subject
		 * @return mixed
		 */
		public function LastPost(int $author, int $subject)
		{
			$sql = 'SELECT * FROM posts WHERE author = :author AND subject = :subject AND date >= ALL (SELECT date FROM posts WHERE author = :author AND subject = :subject);';
			$request = $this->connection->prepare($sql);
			$request->bindParam(':author', $author);
			$request->bindParam(':subject', $subject);
			$request->execute();
			return $request->fetch(\PDO::FETCH_ASSOC);
		}

		/**
		 * Ajoute un post dans la base de donnéees
		 *
		 * @param int $author
		 * @param int $subject
		 * @param string $content
		 */
		public function Add(int $author, int $subject, string $content) : void
		{
			$sql = 'INSERT INTO posts (author, subject, content)
						VALUES (:author, :subject, :content);';
			$request = $this->connection->prepare($sql);
			$request->bindParam(':author', $author);
			$request->bindParam(':subject', $subject);
			$request->bindParam(':content', $content);
			$request->execute();
		}

		/**
		 * Retire un post de la base de données
		 *
		 * @param int $post
		 */
		public function Remove(int $post) : void
		{
			$sql = 'DELETE FROM posts WHERE id = ?;';
			$request = $this->connection->prepare($sql);
			$request->execute(array($post));
		}
	}