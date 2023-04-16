<?php

use modeles\Database;

require_once 'database.php';
require_once 'tbs/tbs_class.php';

class User
{
    private $db;

    function __construct()
    {
        $this->db = Database::getInstance();
        $this->db = $this->db->getConnection();
    }

    function getAllUsers()
    {
        $query = "SELECT * FROM user";
        $result = $this->db->query($query);
        return $result;
    }

    function getUserById($id)
    {
        $query = "SELECT * FROM user WHERE id=:id";
        $params = array(':id' => $id);
        $result = $this->db->query($query, $params);
        return $result;
    }

    function insertUser($nom, $prenom, $password, $adress, $email, $role)
    {
        $query = "INSERT INTO user (nom, prenom, password, adresse, email, role) 
                  VALUES (:nom, :prenom, :password, :adress, :email, :role)";
        $params = array(
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':password' => $password,
            ':adress' => $adress,
            ':email' => $email,
            ':role' => $role
        );
        $result = $this->db->query($query, $params);
        return $result;
    }

    function updateUser($id, $nom, $prenom, $password, $adress, $email, $role)
    {
        $query = "UPDATE user SET nom=:nom, prenom=:prenom, password=:password, 
                  adresse=:adress, email=:email, role=:role WHERE id=:id";
        $params = array(
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':password' => $password,
            ':adress' => $adress,
            ':email' => $email,
            ':role' => $role
        );
        $result = $this->db->query($query, $params);
        return $result;
    }

    function deleteUser($id)
    {
        $query = "DELETE FROM user WHERE id=:id";
        $params = array(':id' => $id);
        $result = $this->db->query($query, $params);
        return $result;
    }

    function showAllUsers()
    {
        $users = $this->getAllUsers();
        $TBS = new clsTinyButStrong;
        $TBS->LoadTemplate('templates/user_list.html');
        $TBS->MergeBlock('user_block', $users);
        $TBS->Show();
    }

    function showUserById($id)
    {
        $user = $this->getUserById($id);
        $TBS = new clsTinyButStrong;
        $TBS->LoadTemplate('templates/user_detail.html');
        $TBS->MergeBlock('user_block', $user);
        $TBS->Show();
    }

    function showUserForm($action, $id = null)
    {
        if ($action == 'edit' && $id != null) {
            $user = $this->getUserById($id);
            $TBS = new clsTinyButStrong;
            $TBS->LoadTemplate('templates/user_form.html');
            $TBS->MergeBlock('user_block', $user);
        } else {
            $TBS = new clsTinyButStrong;
            $TBS->LoadTemplate('templates/user_form.html');
        }
        $TBS->Show();
    }
}



