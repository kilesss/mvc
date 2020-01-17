<?php


namespace helpers;


class Request
{
    private $urlParams;
    private $requestType;

    public function __construct($urlParams, $requestType){
        $this->urlParams = $urlParams;
        $this->requestType = $requestType;
    }
    public function getUrlParams(){
        return $this->urlParams;
    }
    public function getRequest(){
        //TODO: need optimisation this is temporary option
        return $_REQUEST;
    }
    public function getAll(){
        return [
            'urlParams' => $this->getUrlParams(),
            'request' =>$this->getRequest(),
        ];
    }
}