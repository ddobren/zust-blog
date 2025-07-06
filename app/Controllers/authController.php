<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Core/Auth.php';

class AuthController
{
    public function login()
    {
        session_start();

        // Ako forma nije submitana, redirektaj
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['loginBtn'])) {
            header("Location: /cms/login");
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Provjera praznih polja
        if (!$username || !$password) {
            $_SESSION['login_error'] = 'Korisničko ime i lozinka su obavezni.';
            header('Location: /cms/login');
            exit;
        }

        // Provjeri korisnika
        $user = User::findByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['login_error'] = 'Neispravni podaci za prijavu.';
            header('Location: /cms/login');
            exit;
        }

        // Uspješna prijava
        Auth::login($user['id']);
        header('Location: /cms/dashboard');
        exit;
    }
}
