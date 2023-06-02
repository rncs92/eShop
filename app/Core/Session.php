<?php declare(strict_types=1);

namespace EShop\Core;
class Session
{
    public static function has($key): bool
    {
        return (bool)static::get($key);
    }

    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash()
    {
        unset($_SESSION['_flash']);
    }

    public static function destroy()
    {
        $_SESSION = [];
        session_destroy();
    }
}