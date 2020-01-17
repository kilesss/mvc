<?php

namespace autoloader;

use helpers\ReadIni as ReadIni;
use helpers\Request;
class ClassLoader
{
    private $classname;
    private $functionName;
    private $controllersDir = "app".DIRECTORY_SEPARATOR."controllers";
    private $controllerExtension;
    private $controllerDirFull;
    private $controllerNamespace;
    private $extendedController;
    private $extendedControllerPath;
    private $routeParam;
    private $requestType;
    public function __construct($classname, $functionName,$routeParams, $requestType)
    {
        $this->classname = $classname;
        $this->functionName = $functionName;
        $this->routeParam = $routeParams;
        $ini = new ReadIni('app');
        $this->controllerExtension = $ini->searchConfiguration('controllersExtension');
        $this->controllerNamespace = $ini->searchConfiguration('controllerNamespace');
        $this->extendedController = $ini->searchConfiguration('extendedControllerName');
        $this->requestType = $requestType;
        $this->recursiveScan($this->controllersDir);
        $this->registerClasses();
        $this->autoloadExtendClass();
        $this->autoloadClass();

    }
    private function registerClasses(){
        //load extended controller
        if (is_readable($this->extendedControllerPath)) {
            require_once($this->extendedControllerPath);
        }

        //load main controller
        if (is_readable($this->controllerDirFull)) {
            require_once($this->controllerDirFull);
        }
    }
    private function recursiveScan($dir) {
        $tree = glob(rtrim($dir, '/') . '/*');
        if (is_array($tree)) {
            foreach($tree as $file) {

                if (is_dir($file)) {
                    $this->recursiveScan($file);
                } elseif (is_file($file)) {
                    if(preg_match('/[\\\\\/]('.$this->classname.')'.$this->controllerExtension.'/m',$file)){
                        str_replace('\\',DIRECTORY_SEPARATOR,$file);
                        $this->controllerDirFull = $file;
                        $extendedController = str_replace($this->classname.$this->controllerExtension,'',$file);
                        $this->extendedControllerPath =$extendedController.$this->extendedController.$this->controllerExtension;
                    }
                }
            }
        }
    }


    public function autoloadClass(){
        $classNameString = $this->controllerNamespace.$this->classname;
        $loadedClass = new $classNameString();
        $funcName = $this->functionName;
        $loadedClass->$funcName(new Request($this->routeParam, $this->requestType));
    }
    public function autoloadExtendClass(){
        $classNameString = $this->controllerNamespace.$this->extendedController;
        new $classNameString();

    }

}