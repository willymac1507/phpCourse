<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'The body of the note must be between 1 and 1,000 characters.';
}

if (!Validator::string($_POST['title'], 1, 100)) {
    $errors['title'] = 'The title of the note must be between 1 and 100 characters.';
}

if (!empty($errors)) {
    return view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO notes(body, title, user_id) VALUES(:body, :title, :user_id)', [
    'body' => $_POST['body'],
    'title' => $_POST['title'],
    'user_id' => 1
]);
header('location: /notes');
exit();

