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
        $this->table = "users";
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
		$sql = "SELECT `password`, `id` FROM `users` WHERE `id` = '".$id."'";
		$query = $this->connection->query($sql);
		$truepassword = $query->fetch(\PDO::FETCH_ASSOC);
		if (hash_equals($truepassword, crypt($password, 'ae'))){
			return true;
		}else {
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
	public function Inscription(string $pseudo, string $password, string $mail)
	{
		$hashedpassword = $this->HashPassword($password);
		$date = date("Y-m-d H:i:s");
	    $sql = "INSERT INTO users VALUES(id, :pseudo, :hashedpassword, :mail, :date, NULL, NULL)";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':pseudo',$pseudo);
		$stmt->bindParam(':hashedpassword',$hashedpassword);
		$stmt->bindParam(':mail', $mail);
		$stmt->bindParam(':date', $date);
		$stmt->execute();
	}

	/**
	* Change la description de l'utilisateur
	*
	* @param string $desc
	* @param int $id
	*/
	public function ModifBiographie(string $desc, int $id)
	{
		$sql = "UPDATE `users` SET
				`biography` = ':desc'
				WHERE ((`id` = '".$id."'));";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':desc',$desc);
		$stmt->execute();
	}

	/**
	* Change le mot de passe de l'utilisateur
	*
	* @param string $password
	* @param int $id
	*/
	public function ModifMotDePasse(string $password, int $id)
	{
		$hashedpassword = HashPassword($password);
		$sql = "UPDATE `users` SET
				`password` = ':hashedpassword'
				WHERE ((`id` = '".$id."'));";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':hashedpassword',$hashedpassword);
		$stmt->execute();
	}
}

?>
