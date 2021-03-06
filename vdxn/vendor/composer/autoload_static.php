<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit475056737bd4998ba94822485f951213
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mini\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mini\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit475056737bd4998ba94822485f951213::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit475056737bd4998ba94822485f951213::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
