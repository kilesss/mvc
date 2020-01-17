<?php


namespace helpers;

/*
Read config files.

Helper class for reading of config files
*/
class ReadIni
{

    private $iniName;
    private $fileExt = 'ini';
    private $directory = 'config';
    /**
     *
     * @param  string $iniName filename of config
     * */
    public function __construct($iniName)
    {
        $this->iniName = $iniName;
    }
    /**
     * Check if file exist and search specific key in config
     * @param  string $configKey keyname from config file, if its false return all config content
     * IMPORTANT: Its not a good practics to get all config , prefer to use this options only for test cases
     * @return array $configArray array with all config files , or specific parameters
     * @return bool if key is not exist
     * */

    public function searchConfiguration($configKey){
        $configArray = [];
        try {
            if (parse_ini_file($this->directory.DIRECTORY_SEPARATOR.$this->iniName.'.'.$this->fileExt, True) == false)
                throw new \Exception('Missing INI file: ' . $this->iniName);
            else
                $configArray = parse_ini_file($this->directory.DIRECTORY_SEPARATOR.$this->iniName.'.'.$this->fileExt, True);
        }
        catch (\Exception $e) {
            die($e->getMessage());
        }

        if($configKey == false){
            return $configArray;
        }

        if(array_key_exists($configKey, $configArray)){
            return $configArray[$configKey];
        }
        return false;
    }

}