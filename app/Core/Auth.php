<?php

class Auth
{
    public static function login(int $userId): void
    {
        SessionManager::set('user_id', $userId);
    }

    public static function userId(): ?int
    {
        return SessionManager::get('user_id');
    }

    public static function getUsername(): ?string
    {
        $userId = self::userId();
        if (!$userId) return null;

        $db = Conn::get();
        $stmt = $db->prepare("SELECT username FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user['username'] ?? null;
    }

    public static function getRole(): ?string
    {
        $userId = self::userId();
        if (!$userId) return null;

        $db = Conn::get();
        $stmt = $db->prepare("SELECT role FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user['role'] ?? null;
    }

    public static function logout(): void
    {
        SessionManager::destroy();
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
