<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdae1dcf14cf41ac69dcd903198932be2
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\HTTP\\' => 9,
            'App\\DebugLogger\\' => 16,
            'App\\Bitrix24\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\HTTP\\' => 
        array (
            0 => __DIR__ . '/..' . '/andrey-tech/http-client-php/src/App/HTTP',
        ),
        'App\\DebugLogger\\' => 
        array (
            0 => __DIR__ . '/..' . '/andrey-tech/debug-logger-php/src/App/DebugLogger',
        ),
        'App\\Bitrix24\\' => 
        array (
            0 => __DIR__ . '/..' . '/andrey-tech/bitrix24-api-php/src/App/Bitrix24',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdae1dcf14cf41ac69dcd903198932be2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdae1dcf14cf41ac69dcd903198932be2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdae1dcf14cf41ac69dcd903198932be2::$classMap;

        }, null, ClassLoader::class);
    }
}
