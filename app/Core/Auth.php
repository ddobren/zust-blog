<?php

class Auth
{
    public static function login(int $userId): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION['user_id'] = $userId;
    }

    public static function userId(): ?int
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        return $_SESSION['user_id'] ?? null;
    }

    public static function getUsername(): ?string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            return null;
        }

        $db = Conn::get();

        $stmt = $db->prepare("SELECT username FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $userId]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user['username'] ?? null;
    }

    public static function getRole(): ?string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            return null;
        }

        $db = Conn::get();

        $stmt = $db->prepare("SELECT role FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $userId]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user['role'] ?? null;
    }

    public static function logout(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        session_destroy();

        header('Location: /');
        exit;
    }

    public static function check(): bool
    {
        return self::userId() !== null;
    }

    public static function redirectIfAuthenticated(): void
    {
        if (self::check()) {
            header('Location: /cms/dashboard');
            exit;
        }
    }

    public static function redirectIfGuest(): void
    {
        if (!self::check()) {
            header('Location: /cms/login');
            exit;
        }
    }
}
