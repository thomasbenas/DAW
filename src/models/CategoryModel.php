<?php
	namespace app\src\models;
	use app\src\core\Model;

	/**
	 * CategoryModel
	 */
	class CategoryModel extends Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->table = 'categories';
			$this->connection();
		}

		/**
		 * Retourne la catégorie qui correspond à un certain slug
		 *
		 * @param string $slug
		 * @return mixed
		 */
		public function GetBySlug(string $slug)
		{
			$sql = 'SELECT * FROM categories WHERE slug = ?;';
			$request = $this->connection->prepare($sql);
			$request->execute(array($slug));
			return $request->fetch(\PDO::FETCH_ASSOC);
		}

		/**
		 * Ajoute une catégorie dans la base de données
		 *
		 * @param string $name
		 * @param string $description
		 */
		public function Add(string $name, string $description) : void
		{
			$sql = 'INSERT INTO categories (name, description) VALUES (:name, :description);';
			$request = $this->connection->prepare($sql);
			$request->bindParam(':name', $description);
			$request->bindParam(':description', $description);
			$request->execute();
		}

		/**
		 * Retire une catégorie en fonction de son identifiant
		 *
		 * @param int $id
		 */
		public function Remove(int $id) : void
		{
			$sql = 'DELETE FROM categories WHERE id = ?;';
			$request = $this->connection->prepare($sql);
			$request->execute(array($id));
		}
	}