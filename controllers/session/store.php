<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs
$errors = [];

if (!Validator::email($email, 1, 1000)) {
    $errors['email'] = 'You must enter a valid email address.';
}

if (!Validator::string($password, 8, 30)) {
    $errors['password'] = 'The password must be between 8 and 30 characters.';
}

if (!empty($errors)) {
    return view('sessions/create.view.php', [
        'errors' => $errors
    ]);
}

// log in the user if the credentials match
$existingUser = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($existingUser) {
    if (password_verify($password, $existingUser['password'])) {
        login([
            'email' => $email
        ]);
        header('location: /');
        exit();
    }
}
$errors['password'] = 'The credentials supplied do not match an account. Please try again or <a href="/register" class="text-red-900 hover:underline">register.</a>';
return view('sessions/create.view.php', [
    'errors' => $errors
]);

