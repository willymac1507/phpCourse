<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs
$form = new LoginForm();

if ($form->validate($email, $password)) {
    if ((new Authenticator)->attempt($email, $password)) {
        redirect('/');
    }
    $form->error(
        'password',
        'The credentials supplied do not match an account. Please try again or <a href="/register" class="text-red-900 hover:underline">register.</a>'
    );
}

return view('sessions/create.view.php', [
    'errors' => $form->errors()
]);

