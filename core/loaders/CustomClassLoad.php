<?php


namespace loaders;


use helpers\ReadIni as ReadIni;
use helpers\Request;

class CustomClassLoad
{


    private static $classname;
    private static $functionName;
    private static $controllerExtension;
    private static $controllerDirFull;
    private static $controllerNamespace;
    private static $extendedController;
    private static $extendedControllerPath;

    private static function recursiveScan($dir)
    {
        $tree = glob(rtrim($dir, '/') . '/*');
        if (is_array($tree)) {
            foreach ($tree as $file) {

                if (is_dir($file)) {
                    self::recursiveScan($file);
                } elseif (is_file($file)) {

                    if (preg_match('/[\\\\\/](' . self::$classname . ')' . self::$controllerExtension . '/m', $file)) {

                        str_replace('\\', DIRECTORY_SEPARATOR, $file);
                        self::$controllerDirFull = $file;
                        $extendedController = str_replace(self::$classname . self::$controllerExtension, '', $file);
                        self::$extendedControllerPath = $extendedController . self::$extendedController . self::$controllerExtension;
                    }
                }
            }
        }
    }

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