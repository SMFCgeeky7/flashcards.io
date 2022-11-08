<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd4033b0302bad39365f487f36eb45683
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd4033b0302bad39365f487f36eb45683::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd4033b0302bad39365f487f36eb45683::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd4033b0302bad39365f487f36eb45683::$classMap;

        }, null, ClassLoader::class);
    }
}
