<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;
// Find the corresponding note
$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// Authorise current user
authorize($note['user_id'] === $currentUserId);

// Validate the form
$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'The body of the note must be between 1 and 1,000 characters.';
}

if (!Validator::string($_POST['title'], 1, 100)) {
    $errors['title'] = 'The title of the note must be between 1 and 100 characters.';
}

if (!empty($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

// If no validation errors, update the record in the notes database.
$db->query('update notes set body = :body, title = :title where id = :id', [
    'body' => $_POST['body'],
    'title' => $_POST['title'],
    'id' => $_POST['id']
]);
redirect('/notes');