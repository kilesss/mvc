<?php
namespace route;
use routes;

/* 'test'
 * 'test/ret'
 * test/{a}
 * test/{a}/ret/{e}
 */


routes\RouteClass::get('home/gtr/{a}/gt/{f}', "SecondController@indexPage");
routes\RouteClass::get('test', "HomeController@indexPage");




