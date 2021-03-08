<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7bf7a22bc5b99ef8f273def8a691f118
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Libraries\\' => 14,
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Libraries\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/libraries',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7bf7a22bc5b99ef8f273def8a691f118::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7bf7a22bc5b99ef8f273def8a691f118::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7bf7a22bc5b99ef8f273def8a691f118::$classMap;

        }, null, ClassLoader::class);
    }
}
