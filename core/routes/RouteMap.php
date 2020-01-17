<?php
namespace routes;
use routes\RouteMapHelper;

class RouteMap extends RouteMapHelper {

    private static $uri;
    /**
     * Explode url to map it to controller.
     * Check if callback is function.
     * if callback is function scip uri and execute only callback
     * @param  string $uri string where we map by url
     * @param string $callback Controller name and function
     * */ 
    public static function explodeUri($uri,$callback){

       }



    public static function redirect($uri, $callback){
        if(self::callbackExecution($callback) != false){
            return true;
        }
        self::$uri = $uri;
//        $this->explodeUri();
    }
    /**
     *
     * Check callback if is executable function.
     * If callback is executable function skip route and execute function
     *
     * @param    function  $callback callback function
     * @return     boolean
     *
     */
    private static function callbackExecution($callback){
        if(is_callable($callback)){
           $callback();
        }
        return false;
    }



}