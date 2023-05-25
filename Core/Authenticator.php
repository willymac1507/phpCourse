<?php

namespace Core;

class Authenticator
{

    public function attempt($email, $password): bool
    {
        $existingUser = App::resolve(Database::class)
            ->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        if ($existingUser) {
            if (password_verify($password, $existingUser['password'])) {
                $this->login([
                    'email' => $email
                ]);
                return true;
            }
        }
        return false;
    }

    public function login($user): void
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}