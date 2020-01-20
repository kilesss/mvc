<?php

namespace autoloader;

use helpers\ReadIni as ReadIni;
use helpers\Request;
class ClassLoader
{
    private static $classname;
    private static $functionName;
    private static $controllersDir = "app".DIRECTORY_SEPARATOR."controllers";
    private static $controllerExtension;
    private static $controllerDirFull;
    private static $controllerNamespace;
    private static $extendedController;
    private static $extendedControllerPath;
    private static $routeParam;
    private static $requestType;
    public static function init($classname, $functionName,$routeParams, $requestType)
    {
        self::$classname = $classname;
        self::$functionName = $functionName;
        self::$routeParam = $routeParams;
        $ini = new ReadIni('app');
        self::$controllerExtension = $ini->searchConfiguration('controllersExtension');
        self::$controllerNamespace = $ini->searchConfiguration('controllerNamespace');
        self::$extendedController = $ini->searchConfiguration('extendedControllerName');
        self::$requestType = $requestType;
        self::recursiveScan(self::$controllersDir);
        self::registerClasses();

    }

    // do not touch is very important load to be in this order
    private static function registerClasses(){
        //load extended controller
        if (is_readable(self::$extendedControllerPath)) {

            require_once(self::$extendedControllerPath);
        }
        self::autoloadExtendClass();

        //load main controller
        if (is_readable(self::$controllerDirFull)) {
            require_once(self::$controllerDirFull);
        }
        self::autoloadClass();

    }
    private static function recursiveScan($dir) {
        $tree = glob(rtrim($dir, '/') . '/*');
        if (is_array($tree)) {
            foreach($tree as $file) {

                if (is_dir($file)) {
                    self::recursiveScan($file);
                } elseif (is_file($file)) {

                    if(preg_match('/[\\\\\/]('.self::$classname.')'.self::$controllerExtension.'/m',$file)){

                        str_replace('\\',DIRECTORY_SEPARATOR,$file);
                        self::$controllerDirFull = $file;
                        $extendedController = str_replace(self::$classname.self::$controllerExtension,'',$file);
                        self::$extendedControllerPath =$extendedController.self::$extendedController.self::$controllerExtension;
                    }
                }
            }
        }
    }

    private static function autoloadClass(){
        $classNameString = self::$controllerNamespace.self::$classname;
        $loadedClass = new $classNameString();
        $funcName = self::$functionName;
        $loadedClass->$funcName(new Request(self::$routeParam, self::$requestType));
    }

    private static function autoloadExtendClass(){
        $classNameString = self::$controllerNamespace.self::$extendedController;
        new $classNameString();
    }
}
