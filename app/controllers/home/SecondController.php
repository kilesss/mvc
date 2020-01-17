<?php


namespace controllers;
use helpers\Request;
class SecondController  extends Controller
{

    public function indexPage(Request $request){
        var_dump($request->getAll());
        $this->frontDirector('index.tpl');
    }
}