<?php

namespace app\src\controllers;

use app\src\core\controller;

/**
 * AdminController
 */
class AdminController extends Controller
{
    private function isAdmin(){
        $isAdmin = (!empty($_SESSION)) ? $_SESSION['admin'] : false;
        if(!$isAdmin){
            $error = new ErrorController();
            $error->error_403();
        }
    }

    public function index(){
        $this->isAdmin();

        $userModel = "user";
        $this->loadModel($userModel);
        $usersCount = $this->$userModel->count();

        $coursModel = "cours";
        $this->loadModel($coursModel);
        $coursCount = $this->$coursModel->count();

        //TODO modèles pour les catégories et les QCM

        $this->render('admin', 'index', [
            "usersCount" => $usersCount[0],
            "coursCount" => $coursCount[0],
        ]);
    }

    public function utilisateurs(){
        $this->isAdmin();

        $userModel = "user";
        $this->loadModel($userModel);
        $users = $this->$userModel->getUsersAndRoles();

        $roleModel = "role";
        $this->loadModel($roleModel);
        $roles = $this->$roleModel->getAll();

        $this->render('admin', 'utilisateurs', [
            "users" => $users,
            "roles" => $roles,
            "adminCapacity" => $this,
        ]);
    }

    public function cours(){
        $this->isAdmin();

        $coursModel = "cours";
        $this->loadModel($coursModel);
        $courses = $this->$coursModel->getAll();

        $this->render('admin', 'cours', [
            "courses" => $courses,
            "adminCapacity" => $this,
        ]);
    }

    public function deleteUser($id){
        $userModel = "user";
        $this->loadModel($userModel);
        $isAdmin = $this->$userModel->isAdmin($id);

        if(!$isAdmin){
            $this->$userModel->deleteUser($id);
            $refresh = '//' . HOST . '/' .FOLDER_ROOT . '/admin/utilisateurs'; 
            header('Location:'.$refresh);
        } else {
            $_GET['error'] = "L'utilisateur est un administrateur il ne peut pas être supprimé. Changez son rôle d'abord.";
        }
    }

    public function updateRole($id, $newRole){
        $userModel = "user";
        $this->loadModel($userModel);
        $isAdmin = $this->$userModel->isAdmin($id);
        $countAdmin = $this->$userModel->countAdmin();

        if(($isAdmin && $countAdmin > 1) || !$isAdmin){
            $this->$userModel->updateUserRole($id, $newRole);
            $refresh = '//' . HOST . '/' .FOLDER_ROOT . '/admin/utilisateurs'; 
            header('Location:'.$refresh);
        } else {
            $_GET['error'] = "Impossible de modifier le rôle de l'admin. Ajoutez un autre admin d'abord.";
        }
    }
}