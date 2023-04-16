<?php
// Include the user model
include_once '../modeles/user.php';
require_once("tbs_class.php");
class RegisterController {

    // Display the registration form
    public function showRegisterForm() {
        // Load the template
        $template = new clsTinyButStrong;
        $template->loadTemplate('views/registerForm.html');

        // Display the template
        $template->show();
    }

    // Register a new user
    public function registerUser() {
        // Check if the registration form has been submitted
        if (isset($_POST['submit'])) {
            // Get the form data
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Create a new user model
            $userModel = new User();

            // Register the new user
            if ($userModel->register($username, $email, $password)) {
                // Redirect to the login page
                header('Location: login.php');
                exit;
            } else {
                // Display an error message
                echo 'Registration failed.';
            }
        }
    }
}
