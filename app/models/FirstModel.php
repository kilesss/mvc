<?php
namespace models;
use database\Model;
class FirstModel extends \database\Model
{

    public function getData(){

        $this->get();
    }
}