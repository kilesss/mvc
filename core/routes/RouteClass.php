<?php
namespace routes;
use  \routes\RouteMap;
use autoloader\ClassLoader;
use controllers;
//get
//post
//put
//delete
//group
//redirect

class RouteClass extends RouteMapHelper {
    public static function init(){
    }

    public static function get($uri,$callback){
        $res = RouteMapHelper::loadParameters($uri,$callback,'GET');
        if($res[0] == false)
            return false;

        ClassLoader::init($res[0][0], $res[0][1],$res[1], $res[2]);
    }

    public static function post($uri,$callback){
        $res = RouteMapHelper::loadParameters($uri,$callback,'POST');
        if($res[0] == false)
            return false;

        ClassLoader::init($res[0][0], $res[0][1],$res[1], $res[2]);
    }


    public static function put($uri,$callback){
        RouteMapHelper::loadParameters($uri,$callback,'PUT');
    }
    public static function delete($uri,$callback){
        RouteMapHelper::loadParameters($uri,$callback,'DELETE');
    }

}