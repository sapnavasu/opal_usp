<?php
namespace api\components;


class WebServiceFunctions
{
    /*
     * consumeWSDL($jsrsno, $params) - To consume WSDL file from PDO and pass the updated jsrs information with JSRS No. as mandatory
     * 
     * Parameter $jsrsno is a integer variable which accepts JSRS No. and this parameter is mandatory
     * 
     * Parameter $params is of type array and should hold values to be passed to the array variables $CompanyInformation, $Address, $POBoxAddress, $Communication, $ContactDetails which is then merged into 1 single array $Vendor and is passed to the function $client->SI_SupplierUpdate_JSRS_OA()
     * 
     */
    function consumeWSDL($jsrsno, $params)
    {
//        error_reporting(E_ALL);
        ini_set('display_errors', '0');
        ini_set('soap.wsdl_cache_enabled',0);
        ini_set('soap.wsdl_cache_ttl',0);
        $client = new SoapClient("wsdl/SI_SupplierUpdate_JSRS_OAService.wsdl", array('login' => "JSRS_TEST", 'password' => "welcome4", "trace" => 1, "encoding" => "ISO-8859-1"));
        $CompanyInformation = array('CompanyName' => $params['comp_CompanyName'],
                                    'Language' => 'Comp_EN',
                                    'Homepage' => $params['Comp_Homepage'],
                                    'Currency' => $params['Comp_Currency'],
                                    'CommercialRegNo' => $params['Comp_CommercialRegNo'],
                                    'JSRSNumber' => $jsrsno,
                                    'StyleOfIncorporation' => $params['Comp_StyleOfIncorporation'],
                                    'CompanyType' => $params['Comp_CompanyType'],
                                    'VendorType' => $params['Comp_VendorType']);
        $Address            = array('Country' => $params['Add_Country'],
                                    'Region' => $params['Add_Region'],
                                    'City' => $params['Add_City'],
                                    'PostalCode' => $params['Add_PostalCode'],
                                    'CompanyPostalCode' => $params['Add_CompanyPostalCode'],
                                    'HouseNo' => $params['Add_HouseNo'],
                                    'Street' => $params['Add_Street'],
                                    'Floor' => $params['Add_Floor'],
                                    'Room' => $params['Add_Room'],
                                    'Building' => $params['Add_Building']);
        $POBoxAddress       = array('POBox' => $params['PBox_POBox'],
                                    'OtherCity' => $params['PBox_OtherCity'],
                                    'PostalCode' => $params['PBox_PostalCode']);
        $Communication      = array('PhoneNo' => $params['Comm_PhoneNo'],
                                    'FaxNo' => $params['Comm_FaxNo'],
                                    'EMail' => $params['Comm_EMail']);
        $ContactDetails     = array('FirstName' => $params['Cont_FirstName'],
                                    'PhoneNo' => $params['Cont_PhoneNo'],
                                    'FaxNo' => $params['Cont_FaxNo'],
                                    'EMail' => $params['Cont_EMail'],
                                    'Country' => $params['Cont_Country']);
        $Vendor = array('Vendor' => array('CompanyInformation'=>$CompanyInformation, 'Address'=>$Address, 'POBoxAddress'=>$POBoxAddress, 'Communication'=>$Communication, 'ContactDetails'=>$ContactDetails));
        $vedorDuplicate=$Vendor;
        $vedorDuplicate['Vendor']['CompanyInformation']['Language']="";
        $vedorDuplicate['Vendor']['CompanyInformation']['JSRSNumber']="";
        
        if(!array_empty($vedorDuplicate)){
            try {
                $result = $client->SI_SupplierUpdate_JSRS_OA($Vendor);
                $getbrowser = HelperFunctions::getBrowser($_SERVER['HTTP_USER_AGENT']);
                Yii::log('Client Browser: '.$getbrowser['name']."\t".$getbrowser['version']."\t".$getbrowser['platform']."\nREQUEST:\t" . $client->__getLastRequest()."\n-----------------------------------------------------------------------", 'WEBSERV', 'TO PDO');
            } 
            catch (Exception $e) 
            {
                Yii::log('Caught exception: '.$e->getMessage()."\n-----------------------------------------------------------------------", 'WEBSERV', 'TO PDO');
            } 
        }        
    }
    
    public static function checkSession($loginId){
        return 'true';
        $status = 'false';
        @session_start();
        $obj = new Site($_SESSION['is_login']);
        $access = $obj->accesscontrol();
        if ($access == 'yes') 
        {
            $record = Yii::app()->user->userInfo;
            $alreadyLoginuserId= $record['attributes']['UM_LoginId'];
            if($alreadyLoginuserId == $loginId)
            $status = 'true';
        }
        return $status;
    }
    
    public static function requestCount($count){
        $status = 'false';
        $defaultRequestCount = 1;
        if(count($_REQUEST)==$count+1)
            $status = 'true';
        else
            $status = 'false';
        
        return $status;
    }
    
    public static function requestParam($param){
        $status = 'false';
        $defaultRequestParam =  array('r');
        $param =  array_merge($param,$defaultRequestParam);
        $rparam =array();
        foreach ($_REQUEST as $key => $value) {
            array_push($rparam, $key);
        }
        sort($param);
        sort($rparam);
        if($param==$rparam)
            $status = 'true';
        else
            $status = 'false';
        
        return $status;
    }
    
     public static function requestedParamIsEmpty($params){
        $status = 'true';
        $defaultRequestParam =  array('r');
        $params =  array_merge($params,$defaultRequestParam);
        foreach ($params as  $param) {
            if(empty($_REQUEST[$param]) || $_REQUEST[$param]=='')
            {
                $status = 'false';
            }
        }
        return $status;
    }
    
     public static function validateRequestedParam($requestData,$requestDataType){
        $status = 'true';
        if($requestDataType=='date' && !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$requestData))
        {
            $status = 'false';
        }
        elseif($requestDataType=='numeric' && !is_numeric($requestData))
        {
            $status = 'false';
        }
       
        return $status;
    }
    
}
function array_empty($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $value) {
            if (!array_empty($value)) {
                return false;
            }
        }
    }
    elseif (!empty($mixed)) {
        return false;
    }
    return true;
}
?>