<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3781202f0aa45251a283afce8b0a13f8
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PrestaShop\\Module\\LpmiSupplier\\' => 31,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PrestaShop\\Module\\LpmiSupplier\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit3781202f0aa45251a283afce8b0a13f8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3781202f0aa45251a283afce8b0a13f8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3781202f0aa45251a283afce8b0a13f8::$classMap;

        }, null, ClassLoader::class);
    }
}
