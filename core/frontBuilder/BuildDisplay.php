<?php
declare(strict_types=1);

namespace frontBuilder;
use Smarty;

class BuildDisplay
{
    private $header;
    private $footer;
    private $cssFiles = [];
    private $javascriptFiles = [];
    private $templateFile;
    private $parameters = [];
    private $viewBasePath = 'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR;
    public function setHeader($header){
        $this->header = $header;
    }

    public function setFooter($footer){
        $this->footer = $footer;
    }

    public function setCssFiles(Array $cssFiles){
        $this->cssFiles = $cssFiles;
    }

    public function setJavascriptFiles(Array $javascriptFiles){
        $this->javascriptFiles = $javascriptFiles;
    }

    public function setTemplateFile($templateFile){
        $this->templateFile = $templateFile;
    }

    public function setParameters(Array $parameters){
        $this->parameters = $parameters;
    }
    public function generateFront(){
        $dataArray = [];

        if($this->header != false)
            $dataArray['header'] = $this->header;

        if($this->footer != false)
            $dataArray['footer'] = $this->footer;

        if(!empty($this->cssFiles))
            $dataArray['cssFiles'] = $this->cssFiles;

        if(!empty($this->javascriptFiles))
            $dataArray['javascriptFiles'] = $this->javascriptFiles;

        if(!empty($this->parameters))
            $dataArray['parameters'] = $this->parameters;
        $smarty = new \Smarty();
        $smarty->display($this->viewBasePath.$this->templateFile, $dataArray);

    }

}