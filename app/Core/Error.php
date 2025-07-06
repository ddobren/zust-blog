<?php

class ErrorHandlerSys
{
    const KEY_ERRORS = 'form_errors';
    const KEY_SUCCESS = 'form_success';

    // Dodaj grešku
    public static function add(string $message): void
    {
        $_SESSION[self::KEY_ERRORS][] = $message;
    }

    // Dodaj success poruku
    public static function success(string $message): void
    {
        $_SESSION[self::KEY_SUCCESS][] = $message;
    }

    // Dohvati sve greške
    public static function get(): array
    {
        return $_SESSION[self::KEY_ERRORS] ?? [];
    }

    // Dohvati sve uspješne poruke
    public static function getSuccess(): array
    {
        return $_SESSION[self::KEY_SUCCESS] ?? [];
    }

    // Očisti sve poruke
    public static function clear(): void
    {
        unset($_SESSION[self::KEY_ERRORS], $_SESSION[self::KEY_SUCCESS]);
    }
}
