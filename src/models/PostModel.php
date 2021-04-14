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
	     * Récupère tous les posts d'un utilisateur
	     *
	     * @param  mixed $author 
	     * @return mixed
	     */
		public function GetByAuthor(int $author)
		{
			$Sql = 'SELECT * FROM posts WHERE author = :author ORDER BY date DESC';
			$Request = $this->connection->prepare($Sql);
			$Request->bindParam(':author', $author);
			$Request->execute();
			return $Request->fetch(\PDO::FETCH_ASSOC);
		}
		/**
	     * Récupère tous les posts d'un sujet
	     *
	     * @param  mixed $subject 
	     * @return mixed
	     */
		public function GetBySubject(int $subject)
		{
			$Sql = 'SELECT * FROM posts WHERE subject = :subject ORDER BY date DESC';
			$Request = $this->connection->prepare($Sql);
			$Request->bindParam(':subject', $subject);
			$Request->execute();
			return $Request->fetchAll(\PDO::FETCH_ASSOC);
		}

		/**
	     * Ajoute un post dans la base de données
	     *
	     * @param  mixed $author, $subject, $title, $content 
	     * @return boolean
	     */
		public function Add(int $author, int $subject, string $title, string $content)
		{
			$Sql = 'INSERT INTO posts (author, subject, title, content, date)
						VALUES (:author, :subject, :title, :content, NOW())';
			$Request = $this->connection->prepare($Sql);
			$Request->bindParam(':author', $author);
			$Request->bindParam(':subject', $subject);
			$Request->bindParam(':title', $title);
			$Request->bindParam(':content', $content);
			return $Request->execute();
		}

		/**
	     * Retire un post de la base de données
	     *
	     * @param  mixed $id 
	     * @return boolean
	     */
		public function Remove(int $id)
		{
			$Sql = 'DELETE FROM posts WHERE id = ?';
			$Request = $this->connection->prepare($Sql);
			$Request->bindParam(1, $id);
			return $Request->execute();
		}

		/**
	     * Modifie le titre d'un post
	     *
	     * @param  mixed $id, $title 
	     * @return boolean
	     */
		public function UpdateTitle(int $id, string $title)
		{
			$Sql = 'UPDATE posts SET title = :title WHERE id = :id';
			$Request = $this->connection->prepare($Sql);
			$Request->bindParam(':title', $title);
			$Request->bindParam(':id', $id);
			return $Request->execute();
		}

		/**
	     * Modifie le contenu d'un post
	     *
	     * @param  mixed $id, $content 
	     * @return boolean
	     */
		public function UpdateContent(int $id, string $content)
		{
			$Sql = 'UPDATE posts SET content = :content WHERE id = :id';
			$Request = $this->connection->prepare($Sql);
			$Request->bindParam(':content', $content);
			$Request->bindParam(':id', $id);
			return $Request->execute();
		}
	}