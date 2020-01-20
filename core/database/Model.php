<?php
namespace database;


use helpers\ReadIni as ReadIni;
use Medoo\Medoo;

/**
 * Class Model
 * @package database
 */
class Model extends Medoo
{
    private static $instance;

    /**
     * Model constructor.
     */
    public function __construct()
 {
     $options= [];
     $ini = new ReadIni('database');
     $options['database_type'] = $ini->searchConfiguration('database_type');
     $options['database_name'] = $ini->searchConfiguration('database_name');
     $options['server'] = $ini->searchConfiguration('server');
     $options['username'] = $ini->searchConfiguration('username');
     $options['password'] = $ini->searchConfiguration('password');

     self::getInstance($options);
 }

    /**
     * @param array $options
     * @return Medoo
     */
    public static function getInstance(array $options)
 {
     if (self::$instance == null)
     {
         self::$instance = new Medoo($options);
     }

     return self::$instance;
 }

}