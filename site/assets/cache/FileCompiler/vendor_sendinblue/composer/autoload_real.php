<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit14532637486ebe0cc8ef696f8fae4373
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
 require(\ProcessWire\wire('files')->compile('vendor_sendinblue/composer' . '/ClassLoader.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
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

 require(\ProcessWire\wire('files')->compile('vendor_sendinblue/composer' . '/platform_check.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

        spl_autoload_register(array('ComposerAutoloaderInit14532637486ebe0cc8ef696f8fae4373', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname('vendor_sendinblue/composer'));
        spl_autoload_unregister(array('ComposerAutoloaderInit14532637486ebe0cc8ef696f8fae4373', 'loadClassLoader'));

 require(\ProcessWire\wire('files')->compile('vendor_sendinblue/composer' . '/autoload_static.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
        call_user_func(\Composer\Autoload\ComposerStaticInit14532637486ebe0cc8ef696f8fae4373::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit14532637486ebe0cc8ef696f8fae4373::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire14532637486ebe0cc8ef696f8fae4373($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire14532637486ebe0cc8ef696f8fae4373($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

 require(\ProcessWire\wire('files')->compile($file,array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
    }
}
