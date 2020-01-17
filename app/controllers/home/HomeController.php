<?php
namespace controllers;

class HomeController extends Controller
{
    public $tests = 'asdasd';

    public function indexPage(){
        die('sad');
        $this->frontDirector('index.tpl');
    }
}