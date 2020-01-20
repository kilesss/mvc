<?php
namespace models;
use database\Model;

class FirstModel extends Model
{

    public function getData(){
        die('asd');
        $this->get();
    }
}