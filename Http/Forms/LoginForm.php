<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected array $errors = [];

    public function validate($email, $password): bool
    {
        if (!Validator::email($email, 1, 1000)) {
            $this->errors['email'] = 'You must enter a valid email address.';
        }

        if (!Validator::string($password, 8, 30)) {
            $this->errors['password'] = 'The password must be between 8 and 30 characters.';
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error($field, $message): void
    {
        $this->errors[$field] = $message;
    }
}