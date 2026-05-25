<?php

namespace OmniPrint\Agents\Core;

if (!defined('ABSPATH')) {
    exit;
}

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload(string $class): void
    {
        $prefix = 'OmniPrint\\Agents\\';

        if (strpos($class, $prefix) !== 0) {
            return;
        }

        $relative = substr($class, strlen($prefix));
        $relative = str_replace('\\', DIRECTORY_SEPARATOR, $relative);
        $parts = explode(DIRECTORY_SEPARATOR, $relative);
        $className = array_pop($parts);
        $fileName = 'class-' . strtolower(str_replace('_', '-', $className)) . '.php';
        $path = OMNIPRINT_AGENTS_PATH . 'includes' . DIRECTORY_SEPARATOR;

        if (!empty($parts)) {
            $path .= implode(DIRECTORY_SEPARATOR, $parts) . DIRECTORY_SEPARATOR;
        }

        $path .= $fileName;

        if (file_exists($path)) {
            require_once $path;
        }
    }
}
