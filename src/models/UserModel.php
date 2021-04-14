<?php

namespace app\src\models;

use app\src\core\Model;

/**
 * UserModel
 */
class UserModel extends Model
{
	private $id;
	private $username;
	private $password;
	private $mail;
	private $date_registration;
	private $date_birth;
	private $biography;

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
	public function getUserByUsername($username)
	{
		$sql = "SELECT * FROM users WHERE `username`='".$username."'";
        $query = $this->connection->query($sql);
        return $query->fetch(\PDO::FETCH_ASSOC);
	}

	
	/**
	 * Get the value of biography
	 */
	public function getBiography()
	{
		return $this->biography;
	}

	/**
	 * Set the value of biography
	 */
	public function setBiography($biography) : self
	{
		$this->biography = $biography;

		return $this;
	}

	/**
	 * Get the value of date_birth
	 */
	public function getDate_Birth()
	{
		return $this->date_birth;
	}

	/**
	 * Set the value of date_birth
	 */
	public function setDate_Birth($date_birth) : self
	{
		$this->date_birth = $date_birth;

		return $this;
	}

	/**
	 * Get the value of date_registration
	 */
	public function getDate_Registration()
	{
		return $this->date_registration;
	}

	/**
	 * Set the value of date_registration
	 */
	public function setDate_Registration($date_registration) : self
	{
		$this->date_registration = $date_registration;

		return $this;
	}

	/**
	 * Get the value of mail
	 */
	public function getMail()
	{
		return $this->mail;
	}

	/**
	 * Set the value of mail
	 */
	public function setMail($mail) : self
	{
		$this->mail = $mail;

		return $this;
	}

	/**
	 * Get the value of password
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set the value of password
	 */
	public function setPassword($password) : self
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * Get the value of username
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Set the value of username
	 */
	public function setUsername($username) : self
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 */
	public function setId($id) : self
	{
		$this->id = $id;

		return $this;
	}
}

?>
