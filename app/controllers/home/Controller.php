<?php
namespace controllers;
use frontBuilder\BuildDisplay;
use loaders\validatorsLoad;

class Controller
{

    public function __construct()
    {

    }

    public function frontDirector($template, $parameters = array(), $cssFiles = array(), $javascriptFiles = array(), $header = false, $footer = false){

        if(property_exists($this, 'parameters'))
            $parameters= $this->paarameters;

        if(property_exists($this, 'cssFiles'))
            $parameters= $this->cssFiles;

        if(property_exists($this, 'javascriptFiles'))
            $parameters= $this->javascriptFiles;

        if(property_exists($this, 'header'))
            $parameters= $this->header;

        if(property_exists($this, 'footer'))
            $parameters= $this->footer;

        $buildDisplay = new BuildDisplay();
        $buildDisplay->setTemplateFile($template);
        $buildDisplay->setParameters($parameters);
        $buildDisplay->setCssFiles($cssFiles);
        $buildDisplay->setJavascriptFiles($javascriptFiles);
        $buildDisplay->setHeader($header);
        $buildDisplay->setFooter($footer);
        $buildDisplay->generateFront();
    }
}