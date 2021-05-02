<?php 
namespace app\src\controllers;

/**
 * 
 */
trait UserVerificationTrait
{
    private function isAdminUser(){
        $isAdmin = (!empty($_SESSION)) ? $_SESSION['admin'] : false;
        if(!$isAdmin){
            $error = new ErrorController();
            $error->error_403("Vous n'êtes pas administrateur.");
        }
    }

    private function isConnectedUser(){
        $isConnected = (!empty($_SESSION)) ? $_SESSION['id'] : false;
        if(!$isConnected){
            $error = new ErrorController();
            $error->error_403("Vous n'êtes pas connecté.");
        }
    }
}
