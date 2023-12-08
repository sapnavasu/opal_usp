<?php
namespace api\components;

class FileManager{
    public $stakeholder="";
    public $memregPk="";
    public $usrPk="";
    public $accessUrl="";
    
    function __construct() {
        
    }
    
    
    
    function listFolder($path){
        //will list the list of files & folders from the directory given
    }
    function viewFile($path){
        
        //will list the list of files & folders from the directory given
    }
    function createFolder(){
        
    }
    function newFile(){        
    
    }
    function searchFolder(){
        
    }
    function deleteFile(){
        
    }
    public static function renderUrl($fileDtlsPk,$compPk,$usrPk){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        
        
    }
}