<?php 
namespace routes;

use mysql_xdevapi\Exception;
use helpers\ReadIni as ReadIni;
class RouteMapHelper{

    private static  $uri;
    private static $callback;
    private static $routeParsing = false;

    /**
     * Access point to class , receive all needed parameters
     * @param  string $uri url shema from route
     * @param  string $callback controller and function name from route
     * @param  string $requestType type of request where we search
     * @return  array controller and function name
     * */

    public static function loadParameters($uri, $callback, $requestType){
        self::$uri = $uri;
        self::$callback = $callback;
        return [self::checkRequestType($requestType) ,self::$routeParsing, $requestType];
    }


    private static function parseUrlAndController(){
        $routeParsing =  self::parseRoute(self::$uri);

        if($routeParsing === false) {
            return false;
        }

        self::$routeParsing = $routeParsing;

        return self::parseController(self::$callback);

    }


    private static function checkRequestType($requestType){
        if ($_SERVER['REQUEST_METHOD'] === $requestType) {
           return self::parseUrlAndController();
        }
        return false;
    }

    /**
     * Parse controller string
     * @param  string $controllerString string with controller and function name
     * @return  array controller and function name
     * */
    private static function parseController($controllerString){
        if(!strpos($controllerString, '@')){
            throw new Exception("Controller request format is not allowed.");
        }
        return explode('@',$controllerString);
    }
    /**
     * Parse route to schema and get url variables if its have
     * @param  string $uri string where we map by url
     * @return  array $variablesArray Variables from url if its have
     * @return bool if url dont pass to shema
     * */
    private static function parseRoute($uri){
        $requestUri = $_SERVER['REQUEST_URI'];
        $ini = new ReadIni('app');
        $configurationPrefix = $ini->searchConfiguration('prefix');

        //remove prefix if exist
        if($configurationPrefix != ''){
            $configurationPrefix = '/'.$configurationPrefix.'/';
            $requestUri = str_replace($configurationPrefix,'',$requestUri);
        }
        $explodedUri = explode('/',$uri);

        $explodedRequestedUri = explode('/',$requestUri);
        $variablesArray = [];
        foreach ($explodedUri as $key =>$part){
            if(preg_match_all('/(\{\S+\})/mi', $part)){
                // url can`t start with variable parameter
                if($key <=0){
                    throw new \Exception("Wrong url path. Url can`t start with variable parameter");
                }


                $part = str_replace('{','',$part);
                $part = str_replace('}','',$part);
                $part = preg_replace('/[^A-Za-z0-9. -]/', '', $part);

                $variablesArray[$part] = $explodedRequestedUri[$key];
                unset($explodedRequestedUri[$key]);

            }else{
                // if one part id different this is not correct url
                if($part != $explodedRequestedUri[$key])
                    return false;

                unset($explodedRequestedUri[$key]);
            }
        }
        if(!empty($explodedRequestedUri))
            return false;

        return $variablesArray;
    }



}