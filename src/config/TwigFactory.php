<?php
namespace Config;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigFactory {
    public static function get() : Environment{
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        return new Environment($loader);
    }
}


