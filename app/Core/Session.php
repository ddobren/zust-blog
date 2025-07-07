<?php

class SessionManager
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            $lifetime = Config::get('session.lifetime', 86400);
            $path     = Config::get('session.path', '/');
            $domain   = Config::get('session.domain', '');
            $secure   = Config::get('session.secure', false);
            $httponly = Config::get('session.httponly', true);
            $samesite = Config::get('session.samesite', 'Lax');

            // Postavi cookie parametre
            session_set_cookie_params([
                'lifetime' => $lifetime,
                'path' => $path,
                'domain' => $domain,
                'secure' => $secure,
                'httponly' => $httponly,
                'samesite' => $samesite
            ]);

            ini_set('session.gc_maxlifetime', (string) $lifetime);

            session_start();
        }
    }

    public static function set(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key): mixed
    {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function forget(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        self::start();
        session_unset();
        session_destroy();
    }
}
