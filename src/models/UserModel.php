<?php

namespace app\src\models;

use app\src\core\Model;

/**
 * UserModel
 */
class UserModel extends Model
{

	public function __construct()
	{
		parent::__construct();
		$this->table = 'users';
		$this->connection();
	}

	/**
	* Hashe le mot de passe que l'utilisateur donne
	*
	* @param  string $password
	* @return string
	*/
	public function HashPassword (string $password) : string
	{
		return crypt($password, 'ae');
	}

	/**
	* Verification du mot de passe que l'utilisateur insère
	*
	* @param string $password
	* @param int $id
	* @return bool
	*/
	public function CheckPassword(string $password, int $id) : bool
	{
		$Sql = 'SELECT password,id FROM users WHERE id = :id;';
		$Request = $this->connection->prepare($Sql);
		$Request->bindParam(':id', $id);
		$Request->execute();
		$Result = $Request->fetch(\PDO::FETCH_ASSOC);
		if (hash_equals($Result['password'], crypt($password, 'ae'))){
			return true;
		} else {
			return false;
		}
	}

	/**
	* Insertion des données de l'utilisateur lors de l'inscription
	*
	* @param  string $pseudo
	* @param  string $password
	* @param  string $mail
	* @param  int $year
	* @param  int $month
	* @param  int $day
	*/
	public function Inscription(string $pseudo, string $password, string $mail, int $year, int $month, int $day)
	{
		$HashedPassword = $this->HashPassword($password);
		$Birth = $year . '-' . $month . '-' . $day;
		$Sql = 'INSERT INTO users (username, password, mail, date_registration, date_birth, biography)
				VALUES (:pseudo, :hashedpassword, :mail, now(), :birth, NULL);';
		$Request = $this->connection->prepare($Sql);
		$Request->bindParam(':pseudo', $pseudo);
		$Request->bindParam(':hashedpassword', $HashedPassword);
		$Request->bindParam(':mail', $mail);
		$Request->bindParam(':birth', $Birth);
		$Request->execute();
	}

	/**
	* Change la description de l'utilisateur
	*
	* @param string $desc
	* @param int $id
	*/
	public function ModifBiographie(string $desc, int $id)
	{
		$Sql = 'UPDATE users
				SET biography = :desc
				WHERE id = :id;';
		$Request = $this->connection->prepare($Sql);
		$Request->bindParam(':desc',$desc);
		$Request->bindParam(':id', $id);
		$Request->execute();
	}

	/**
	* Change le mot de passe de l'utilisateur
	*
	* @param string $password
	* @param int $id
	*/
	public function ModifMotDePasse(string $password, int $id)
	{
		$hashedpassword = $this->HashPassword($password);
		$Sql = 'UPDATE users SET
				password = :hashedpassword
				WHERE id = :id;';
		$Request = $this->connection->prepare($Sql);
		$Request->bindParam(':hashedpassword',$hashedpassword);
		$Request->bindParam(':id', $id);
		$Request->execute();
	}
}