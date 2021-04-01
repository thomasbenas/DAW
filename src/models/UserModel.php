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
        $this->connection();
    }
    
}
/**
* Hashe le mot de passe que l'utilisateur donne
*
* @param  string $password
* @return string
*/
public function hashPassword (string $password) : string
{
	return crypt($password, 'ae')
}

/**
* Verification du mot de passe que l'utilisateur insère
*
* @param string $password
* @param int $id
* @return bool
*/
public function checkPassword(string $password, int $id) : bool
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
public function inscription(string $pseudo, string $password, string $mail, int $year, int $month, int $day)
{
	$hashedpassword = hashPassword($password);
	$birth = $year."-".$month."-".$day;
    $sql = "INSERT INTO `users` (`username`, `password`, `mail`, `date_registration`, `date_birth`, `biography`)
			VALUES (':pseudo', ':hashedpassword', ':mail', now(), ':birth', NULL);";
	$stmt = $this->connection->prepare($sql);
	$stmt->bindParam(':pseudo',$pseudo);
	$stmt->bindParam(':hashedpassword',$hashedpassword);
	$stmt->bindParam(':mail',$mail);
	$stmt->bindParam(':birth',$birth);
}

/**
* Change la description de l'utilisateur
*
* @param string $desc
* @param int $id
*/
public function modifBiographie(string $desc, int $id)
{
	$sql = "UPDATE `users` SET
			`biography` = ':desc'
			WHERE ((`id` = '".$id."'));";
	$stmt = $this->connection->prepare($sql);
	$stmt->bindParam(':desc',$desc);
}

/**
* Change le mot de passe de l'utilisateur
*
* @param string $password
* @param int $id
*/
public function modifMotDePasse(string $password, int $id)
{
	$hashedpassword = hashPassword($password);
	$sql = "UPDATE `users` SET
			`password` = ':hashedpassword'
			WHERE ((`id` = '".$id."'));";
	$stmt = $this->connection->prepare($sql);
	$stmt->bindParam(':hashedpassword',$hashedpassword);
}

?>