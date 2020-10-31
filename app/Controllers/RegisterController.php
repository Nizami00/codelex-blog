<?php

namespace App\Controllers;

use App\Models\User;

session_start();

class RegisterController
{
    public function register()
    {
        return require_once __DIR__ . '/../Views/RegisterView.php';
    }

    public function store()
    {
        $email = ($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return header('Location: /register');
        }

        $isEmailUsed = query()
            ->select('*')
            ->from('users')
            ->where('email = :email')
            ->setParameter('email', $email)
            ->execute()
            ->fetchAssociative();


        $password = $this->encodePassword($_POST['password']);

        if (empty($isEmailUsed)) {
            $userQuery = query()
                ->insert('users')
                ->values([
                    'name' => '?',
                    'email' => '?',
                    'password' => '?'
                ])
                ->setParameter(0, $_POST['name'])
                ->setParameter(1, $email)
                ->setParameter(2, $password);

            $userQuery->execute();

            $login = new LoginController();
            $login->authorize();

            return header('Location: /');
        }

        return header('Location: /register');
    }



    private function encodePassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}