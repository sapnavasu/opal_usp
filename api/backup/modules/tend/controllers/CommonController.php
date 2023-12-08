<?php
namespace api\modules\tend\controllers;

trait CommonController
{    
    public function __construct() { 
        
    }
    
    public function cleanInputValue($value) {
        header('Content-Type: text/plain');   
        $value = trim($value); 
//        $value = $mysqli->real_escape_string($value);
        $value = htmlentities($value);
        return $value;
    } 
    
    function getXMLValue($source) {
        return json_decode(json_encode(simplexml_load_file($source)),true);
    }
    
    function getJSONValue($source) {
        return json_decode(json_encode(file_get_contents($source)),true);
    }
}
