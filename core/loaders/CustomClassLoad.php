<?php


namespace loaders;


use autoloader\ClassLoader;
use helpers\ReadIni as ReadIni;
use helpers\Request;

class CustomClassLoad extends ClassLoader
{


    private static $classname;
    private static $controllerDirFull;
    private static $controllerNamespace;


    public static function loadCustomClass($classname, $folder, $namespace = false)
    {
        self::$classname = $classname;

        if ($namespace === false) {
            $ini = new ReadIni('app');
            self::$controllerNamespace = $ini->searchConfiguration('controllerNamespace');
        } else {
            self::$controllerNamespace = $namespace . DIRECTORY_SEPARATOR;

        }
        self::recursiveScan('app/' . $folder);
        if (is_readable(self::$controllerDirFull)) {
            require_once(self::$controllerDirFull);
        }
    }

    public static function autoloadClass(){
        $classNameString = self::$controllerNamespace.self::$classname;
        return new $classNameString();
    }

}