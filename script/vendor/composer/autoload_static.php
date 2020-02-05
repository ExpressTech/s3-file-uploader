<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit40e0bd1ecff7b33c896ad2f737c83273
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\EventDispatcher\\' => 34,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\EventDispatcher\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/event-dispatcher',
        ),
    );

    public static $prefixesPsr0 = array (
        'G' => 
        array (
            'Guzzle\\Tests' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/guzzle/tests',
            ),
            'Guzzle' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/guzzle/src',
            ),
        ),
        'A' => 
        array (
            'Aws' => 
            array (
                0 => __DIR__ . '/..' . '/aws/aws-sdk-php/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit40e0bd1ecff7b33c896ad2f737c83273::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit40e0bd1ecff7b33c896ad2f737c83273::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit40e0bd1ecff7b33c896ad2f737c83273::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
