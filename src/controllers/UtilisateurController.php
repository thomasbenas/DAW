<?php

namespace app\src\controllers;

use app\src\core\controller;

/**
 * UserController
 */
class UtilisateurController extends Controller
{
    public function connexion(){
        $this->render('utilisateur', 'connexion', [
            'utilisateur' => $this,
        ]);
    }

    public function deconnexion(){
        $this->render('utilisateur', 'deconnexion', []);
    }

    public function rejoindre(){
        $this->render('utilisateur', 'rejoindre', [
            'utilisateur' => $this,
        ]);
    }

    public function userRegistration($username, $password, $mail){
        $model = "user";
        $this->loadModel($model);
        try {
            $this->$model->Inscription($username, $password, $mail);
            $this->UserSetup($model, $username);
        } catch (\PDOException  $e) {
            $_GET['error'] = "Le nom d'utilisateur ou le mail est déjà utilisé.";
        }
    }

    public function userLogin($username, $password){
        $this->loadModel($model);
        $userData = $this->$model->getUserByUsername($username);
        $this->$model->hydrate($userData);

        foreach($userData as $key => $value)
        {
            $method = 'get'.ucfirst($key);
            $_SESSION[$key] = $this->$model->$method();
        }
    }

    //TODO
    /**
     * UserConnexion($pseudo, $password)
     * Vérifier les doublons, gestion des exceptions, etc...
     * htmlspecialchars
     */
	* retourne le hash d'une chaîne de caractère
	*
	* @param  string $password
	* @return string
	*/
	private function hashPassword (string $password) : string
	{
		return crypt($password, 'ae');
	}

	/**
	* Compare un hash avec une chaîne de caractère à hasher
	*
	* @param string $hashGiven
	* @param string $strToHash
	* @return bool
	*/
	private function isHashEquals(string $hashGiven, string $strToHash) : bool
	{
		$res =  false;
		if (hash_equals($hashGiven, $this->HashPassword($strToHash)))
			$res = true;
		return $res;
	}

}