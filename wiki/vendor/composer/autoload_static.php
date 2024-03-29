<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

use Closure;

class ComposerStaticInita19a915ee98347a0c787119619d2ff9b
{
    public static $files = array (
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
        'decc78cc4436b1292c6c0d151b19445c' => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'splitbrain\\PHPArchive\\' => 22,
        ),
        'p' => 
        array (
            'phpseclib\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'splitbrain\\PHPArchive\\' => 
        array (
            0 => __DIR__ . '/..' . '/splitbrain/php-archive/src',
        ),
        'phpseclib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'SimplePie' => 
            array (
                0 => __DIR__ . '/..' . '/simplepie/simplepie/library',
            ),
        ),
    );

    public static $classMap = array (
        'GeSHi' => __DIR__ . '/..' . '/easybook/geshi/geshi.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita19a915ee98347a0c787119619d2ff9b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita19a915ee98347a0c787119619d2ff9b::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInita19a915ee98347a0c787119619d2ff9b::$prefixesPsr0;
            $loader->classMap = ComposerStaticInita19a915ee98347a0c787119619d2ff9b::$classMap;

        }, null, ClassLoader::class);
    }
}
