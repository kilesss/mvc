<?php


namespace helpers;


/**
 * Class Request
 * TODO: add middleware logic here
 * @package helpers
 */
class Request
{
    private $urlParams;
    private $requestType;

    /**
     * Request constructor.
     * @param $urlParams
     * @param $requestType
     */
    public function __construct($urlParams, $requestType){
        $this->urlParams = $urlParams;
        $this->requestType = $requestType;
    }

    /**
     * @return mixed
     */
    public function getUrlParams(){
        return $this->urlParams;
    }

    /**
     * @return mixed
     */
    public function getRequest(){
        //TODO: need optimisation this is temporary option
        return $_REQUEST;
    }

    /**
     * @return array
     */
    public function getAll(){
        return [
            'urlParams' => $this->getUrlParams(),
            'request' =>$this->getRequest(),
        ];
    }
}