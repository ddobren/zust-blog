<?php

class Config
{
    private static array $config = [];

    private static function load(): void
    {
        if (empty(self::$config)) {
            $path = __DIR__ . '/configData.php';
            if (!file_exists($path)) {
                throw new Exception("Configuration file not found: $path");
            }

            self::$config = require $path;
        }
    }
    
    public static function get(string $key, mixed $default = null): mixed
    {
        self::load();

        $keys = explode('.', $key);
        $value = self::$config;

        foreach ($keys as $segment) {
            if (is_array($value) && array_key_exists($segment, $value)) {
                $value = $value[$segment];
            } else {
                return $default;
            }
        }

        return $value;
    }
}
