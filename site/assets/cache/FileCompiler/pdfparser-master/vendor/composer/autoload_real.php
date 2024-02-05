<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit7a0169d9f9975dca84861f2993b18dbf
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
 require(\ProcessWire\wire('files')->compile('pdfparser-master/vendor/composer' . '/ClassLoader.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
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

        spl_autoload_register(array('ComposerAutoloaderInit7a0169d9f9975dca84861f2993b18dbf', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit7a0169d9f9975dca84861f2993b18dbf', 'loadClassLoader'));

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
        if ($useStaticLoader) {
 require_once(\ProcessWire\wire('files')->compile('pdfparser-master/vendor/composer' . '/autoload_static.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

            call_user_func(\Composer\Autoload\ComposerStaticInit7a0169d9f9975dca84861f2993b18dbf::getInitializer($loader));
        } else {
            $map = require(\ProcessWire\wire('files')->compile('pdfparser-master/vendor/composer' . '/autoload_namespaces.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
            foreach ($map as $namespace => $path) {
                $loader->set($namespace, $path);
            }

            $map = require(\ProcessWire\wire('files')->compile('pdfparser-master/vendor/composer' . '/autoload_psr4.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
            foreach ($map as $namespace => $path) {
                $loader->setPsr4($namespace, $path);
            }

            $classMap = require(\ProcessWire\wire('files')->compile('pdfparser-master/vendor/composer' . '/autoload_classmap.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
            if ($classMap) {
                $loader->addClassMap($classMap);
            }
        }

        $loader->register(true);

        if ($useStaticLoader) {
            $includeFiles = Composer\Autoload\ComposerStaticInit7a0169d9f9975dca84861f2993b18dbf::$files;
        } else {
            $includeFiles = require(\ProcessWire\wire('files')->compile('pdfparser-master/vendor/composer' . '/autoload_files.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
        }
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire7a0169d9f9975dca84861f2993b18dbf($fileIdentifier, $file);
        }

        return $loader;
    }
}

function composerRequire7a0169d9f9975dca84861f2993b18dbf($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
 require(\ProcessWire\wire('files')->compile($file,array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
    }
}
