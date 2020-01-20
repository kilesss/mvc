<?php


namespace controllers;
use loaders\CustomClassLoad;
use helpers\Request;

class SecondController  extends Controller
{

    private $firstModel;
    public function __construct()
    {
        parent::__construct();

        // load model class FirstModel
        CustomClassLoad::loadCustomClass('FirstModel', 'models','models');
        // set instance to parameter
        $this->firstModel = CustomClassLoad::autoloadClass();
    }

    public function indexPage(Request $request){
        // call database function
        $data = $this->firstModel->getData();
        $this->frontDirector('index.tpl');
    }
}