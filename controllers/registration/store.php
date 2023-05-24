<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$email = $_POST['email'];
$password = $_POST['password'];
$repeatPassword = $_POST['repeatPassword'];
$errors = [];

if (!Validator::email($email, 1, 1000)) {
    $errors['body'] = 'You must enter a valid email address.';
}

if (!Validator::string($password, 8, 30)) {
    $errors['password'] = 'The password must be between 8 and 30 characters.';
}

if ($repeatPassword !== $password) {
    $errors['repeatPassword'] = 'The two passwords do not match.';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'heading' => 'Register',
        'errors' => $errors
    ]);
}

// Check if account exists.
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    // If account exists, redirect
    header('location: /');
    exit();
} else {
    // If not, persist record //TODO hash the password!!
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => $password
    ]);
    // Mark that the user has logged in
    $_SESSION['user'] = [
        'email' => $email
    ];

    header('location: /notes');
    exit();
}



