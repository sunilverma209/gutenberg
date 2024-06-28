<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7802b9e83548543183b8095653c79dc3
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'DMG\\Plugins\\DMGReadMore\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'DMG\\Plugins\\DMGReadMore\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit7802b9e83548543183b8095653c79dc3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7802b9e83548543183b8095653c79dc3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7802b9e83548543183b8095653c79dc3::$classMap;

        }, null, ClassLoader::class);
    }
}
