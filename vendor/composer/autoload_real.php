<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit74ae638803f65c4a8e335c5fa5261e2e
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit74ae638803f65c4a8e335c5fa5261e2e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit74ae638803f65c4a8e335c5fa5261e2e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit74ae638803f65c4a8e335c5fa5261e2e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
