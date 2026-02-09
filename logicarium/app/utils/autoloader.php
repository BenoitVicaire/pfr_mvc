<?php

namespace App\Utils;

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register(function ($class) {

            if (strpos($class, 'App\\') !== 0) {
                return;
            }

            $class = str_replace('App\\', '', $class);

            $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

            $file = __DIR__ . '/../' . $class . '.php';

            if (file_exists($file)) {
                require_once $file;
            }
        });
    }
}
