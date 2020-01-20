<?php
namespace autoloader;
use routes\RouteMap;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
Autoloader class. 

Load all classes to load framework 
*/
class Autoloader{

    // DO NOT CHANGE ANYTHING IN THIS ARRAY
    public static $class_dir = array(
//        'core/smarty/libs/Autoloader.php',
        'core/helpers/ReadIni.php',
        'core/helpers/Request.php',
        'core/routes/RouteMapHelper.php',
        'core/routes/RouteMap.php',
        'core/routes/RouteClass.php',
        'core/database/Model.php',
        'core/database/Medoo.php',
        'core/loaders/ClassLoader.php',
        'core/loaders/CustomClassLoad.php',
        'route/webRoutes.php',
        'core/frontBuilder/FrontBuilder.php',
//        'core/frontBuilder/DisplayController.php',
        'core/frontBuilder/BuildDisplay.php',
        'core/validator/ValidatorHelper.php',
        'core/validator/validatorInterface/MainInterface.php',

    );

    public static function class_loader(){
        foreach (self::$class_dir as $directory) {
            if (file_exists($directory)) {
                require_once($directory);
            }else{
                throw new \Exception("Undefined file $directory");
            }
        }
    }
}

spl_autoload_register('autoloader\Autoloader::class_loader');
\routes\RouteClass::init();



    
    
