<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd7ac65fe97504187ad92f8f3aa2d57cc
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'ParagonIE\\EasyDB\\' => 17,
            'ParagonIE\\Corner\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ParagonIE\\EasyDB\\' => 
        array (
            0 => __DIR__ . '/..' . '/paragonie/easydb/src',
        ),
        'ParagonIE\\Corner\\' => 
        array (
            0 => __DIR__ . '/..' . '/paragonie/corner/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd7ac65fe97504187ad92f8f3aa2d57cc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd7ac65fe97504187ad92f8f3aa2d57cc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
