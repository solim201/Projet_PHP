<?php

use modeles\User;
$db = Database::getInstance();
$conn = $db->getConnection();
session_start();

require_once("tbs_class.php");
require_once("../modeles/User.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = "role";

    $existingUser = User::getByEmail($email);

    if($existingUser != null){
        $message = "Cet email est déjà utilisé. Veuillez utiliser un autre email.";
    }
    else{
        $newUser = new User( $nom, $prenom, $email, $password, $role);
        $newUser->add();

        $_SESSION["user"] = $newUser;
        header("location: ../template/index.html");
    }
}
else{
    $message = "Inscription";
}

$tbs = new clsTinyButStrong; // Création d'un objet tbs de la classe

$tbs->LoadTemplate("../template/inscription.html");
$tbs->MergeField("message", $message);
$tbs->Show();

