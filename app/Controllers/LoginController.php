<?php

namespace App\Controllers;

session_start();

class LoginController
{
    public function login()
    {
        return require_once __DIR__ . '/../Views/LoginViews.php';
    }

    public function authorize()
    {
        $userEmail = $_POST['email'];
        $password = $_POST['password'];
        $user = $this->loadUserByEmail($userEmail);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['id'];
            return header('Location: /');
        }

        return require_once __DIR__ . '/../Views/LoginViews.php';


    }

    private function loadUserByEmail($email)
    {
        return query()
            ->select('*')
            ->from('users')
            ->where('email = :email')
            ->setParameter('email', $email)
            ->execute()
            ->fetchAssociative();

    }

    public function logout()
    {
        unset($_SESSION['user']);
        return header('Location: /');

    }
}
