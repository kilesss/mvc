<?php
namespace controllers;

class HomeController extends Controller
{

    public function indexPage(){
        $this->frontDirector('index.tpl');
    }
}