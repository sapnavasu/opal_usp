<?php
namespace api\modules\tend\controllers;

trait TenderFunctions { 
    public $tenderObj;
    public $tenderArr;
    public $tenderValidationArr;
    public $validTenderarr; 
    public $errorTenderarr;
    public $overallTenderError;
    
    public function __construct() { 
        $this->tenderArr = [];
        $this->tenderObj = [];
        $this->tenderValidationArr = [];
        $this->validTenderarr = [];
        $this->errorTenderarr = [];
        $this->overallTenderError = [];
    }
    
    public function findOutputType($url) {
        $testval = file_get_contents($url);
        $val = json_decode($testval); 
        
        if(json_last_error() == JSON_ERROR_NONE) {
            return "json";
        } else {
            return "xml";
        }
    }
        
    public function isDate($date, $format, $delimiter) { 
        $matches = array(); 
        
        if($format == 'Y-m-d') {
            $pattern = '/^([0-9]{4})\\' . $delimiter . '([0-9]{1,2})\\' . $delimiter . '([0-9]{1,2})$/'; 
        } elseif($format == 'd-m-Y') {
            $pattern = '/^([0-9]{1,2})\\' . $delimiter . '([0-9]{1,2})\\' . $delimiter . '([0-9]{4})$/'; 
        } elseif($format == 'm-d-Y') {
            $pattern = '/^([0-9]{1,2})\\' . $delimiter . '([0-9]{1,2})\\' . $delimiter . '([0-9]{4})$/';
        }
        
        if (!preg_match($pattern, $date, $matches)) { //(pattern, subject, matches)
            return false; 
        }  
        
        if($format == 'm-d-Y') {  
          if (!checkdate($matches[2], $matches[1], $matches[3])) return false;  
        } elseif($format == 'd-m-Y') {  
          if (!checkdate($matches[1], $matches[2], $matches[3])) return false; 
        } elseif($format == 'Y-m-d') {  
          if (!checkdate($matches[3], $matches[2], $matches[1])) return false; 
        } 
        
        return true;
    }
    
    function getValidationArray() {
        $this->tenderValidationArr['TenderNo'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['TenderName'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['Status'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['DocumentPrice'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['LastDateCollectingDocument'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['TenderAmount'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['TenderingDate'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['SubmissionDate'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['OpeningDate'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['Active'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['Date'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['AwardedAmount'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['AwardedDate'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];
        $this->tenderValidationArr['BidderName'] = ['dataType' => 'any', "required" => true, "minLength" => '', "maxLength" => ''];  
        $this->tenderValidationArr['FileName'] = ['dataType' => 'any', "required" => false, "minLength" => '', "maxLength" => ''];  
        return $this->tenderValidationArr;
    }
    
    function matchTenderKey($tender_data, $company_name) {  
        $tender_arr = $tender_data;
        $company_name = $company_name;
        
        $matchedKeys = $this->getMatchKeys($company_name); 
        
        foreach($tender_data as $key => $value) { 
          $this->tenderObj[$key]->TenderNo =  $this->isValueArr($value[$matchedKeys['TenderNo']]); 
          $this->tenderObj[$key]->TenderName = $this->isValueArr($value[$matchedKeys['TenderName']]); 
          $this->tenderObj[$key]->Status = $this->isValueArr($value[$matchedKeys['Status']]);
          $this->tenderObj[$key]->DocumentPrice =  $this->isValueArr($value[$matchedKeys['DocumentPrice']]); 
          $this->tenderObj[$key]->LastDateCollectingDocument = $this->isValueArr($value[$matchedKeys['LastDateCollectingDocument']]);
          $this->tenderObj[$key]->TenderAmount = $this->isValueArr($value[$matchedKeys['TenderAmount']]); 
          $this->tenderObj[$key]->TenderingDate = $this->isValueArr($value[$matchedKeys['TenderingDate']]); 
          $this->tenderObj[$key]->SubmissionDate = $this->isValueArr($value[$matchedKeys['SubmissionDate']]);
          $this->tenderObj[$key]->OpeningDate = $this->isValueArr($value[$matchedKeys['OpeningDate']]);
          $this->tenderObj[$key]->Active = $this->isValueArr($value[$matchedKeys['Active']]);
          $this->tenderObj[$key]->Date = $this->isValueArr($value[$matchedKeys['Date']]);
          $this->tenderObj[$key]->AwardedAmount = $this->isValueArr($value[$matchedKeys['AwardedAmount']]);
          $this->tenderObj[$key]->AwardedDate = $this->isValueArr($value[$matchedKeys['AwardedDate']]);
          $this->tenderObj[$key]->BidderName = $this->isValueArr($value[$matchedKeys['BidderName']]); 
          $this->tenderObj[$key]->FileName = $value[$matchedKeys['FileName']];  
        }   
        return $this->tenderObj;
    }
    
    function isValueArr($value) {
        if(is_array($value)) {
           return array_filter($value[0]);
        } else {
           return $value; 
        }
    }
    
    function tenderValidation($tenderArray) {
        $tenderErrArr['status'] = false;
        $tenderErrArr['count'] = 0;
        $tenderErrArr['msgs'] = [];
        $return_arr = []; 
        $validationArr =  $this->getValidationArray();  
        
        if(count($tenderArray) > 0) {
            foreach($tenderArray as $key => $value) {
                $isTenderValid = TRUE;
                $i = 0;
                $current_row_validation = [];
                foreach($value as $val_key => $val) { 
                    $isTenderValid = $this->validateData($val, $this->tenderValidationArr[$val_key], $key, $val_key, $i);
                    $current_row_validation[] = $isTenderValid;
                    $i++;
                }  
                if(in_array("", $current_row_validation)) {  
                    $this->errorTenderarr[$key] = $value;
                } else {
                    $this->validTenderarr[$key] = $value;
                }
            }  
        } else {
            $tenderErrArr['status'] = true;
            $tenderErrArr['count'] = 1;
            $tenderErrArr['msgs'] = "Please Enter Valid Array"; 
        } 
        $return_arr['valid_arr'] = $this->validTenderarr;
        $return_arr['invalid_arr'] = $this->errorTenderarr;
        return $return_arr;
    }
    
    function getMatchKeys($company_name) { 
        if($company_name == "test_company") {
            return $keyMatchedTenderArr = [
                "TenderNo" => "TenderNo", 
                "TenderName" => "TenderName", 
                "Status" => "Status",
                "DocumentPrice" => "DocumentPrice",
                "LastDateCollectingDocument" => "LastDateCollectingDocument",
                "TenderAmount" => "TenderAmount",
                "TenderingDate" => "TenderingDate",
                "SubmissionDate" => "SubmissionDate",
                "OpeningDate" => "OpeningDate", 
                "FileName" => "FileName", 
                "Active" => "Active",
                "Date" => "Date",
                "AwardedAmount" => "AwardedAmount",
                "AwardedDate" => "AwardedDate",
                "BidderName" => "BidderName" 
            ];
        }
    }
    
    function validateData($val, $column_name_val_arr, $key, $column_name, $i) { 
        $col_name = $column_name;
        $column_name_obj = (object) $column_name_val_arr;   
        $isValid = TRUE;
        
        if($this->isRequired($val, $column_name_obj->required)) {
            if($this->isValidDataType($val, $column_name_obj->dataType, $col_name)) {
                if($this->isMinLength($val, $column_name_obj->minLength)) {
                    if($this->isMaxLength($val, $column_name_obj->maxLength)) {  
                        $isValid = TRUE;
                    } else {
                        $this->overallTenderError[$key][$i] = ['filed' =>$col_name, 'error' => "Max length should be " . $column_name_obj->maxLength]; 
                        $isValid = FALSE;
                    }
                } else { 
                    $this->overallTenderError[$key][$i] = ['field' => $col_name, 'error' => "Min length should be " . $column_name_obj->minLength]; 
                    $isValid = FALSE;
                }
            } else { 
                $this->overallTenderError[$key][$i] = ['field' => $col_name, 'error' => "Data type should be " . $column_name_obj->dataType]; 
                $isValid = FALSE;
            }
        } else { 
            $this->overallTenderError[$key][$i] = ['field' => $col_name, 'error' => $col_name . " field required "]; 
            $isValid = FALSE;
        } 
        return $isValid;
    }
    
    function isRequired($value, $isreq) {
        if($isreq){
            if(!is_array($value)) { 
                $value = trim($value);
                return (strlen($value) > 0) ? TRUE : FAlSE; 
            } else { 
                return TRUE;
            }             
        } else {
            return TRUE;
        }   
    }
    
    function isValidDataType($value, $data_type, $col_name) {
        if(!is_array($value)) {
            $value = trim($value);
        }
        if ($data_type == 'any') { 
            if($this->tenderValidationArr[$col_name]['required'] == '') {
                return TRUE;
            } else {
                if(is_array($value) && $this->tenderValidationArr[$col_name]['required'] == '') {
                    return TRUE;     
                } else { 
                    return (strlen($value) > 0) ? TRUE: FAlSE;
                } 
            } 
        } elseif ($data_type == 'integer') {
            return is_numeric($value) ? TRUE : FAlSE;              
        } elseif ($data_type == 'decimal') { 
            return is_numeric($value) ? TRUE : FAlSE;     
        } elseif ($data_type == 'date') {
            
        }
    }
    
    function isMinLength($value, $minlength) {
        $value = trim($value); 
        if($minlength != '' && $minlength != NULL && $minlength != undefined) {
            if(strlen($value) >= $minlength) {
                return TRUE;
            }  else {
               return FALSE; 
            }
        } else {
            return TRUE;
        }
    }
    
    function isMaxLength($value, $maxlength) {
        $value = trim($value);
        if($maxlength != '' && $maxlength != NULL && $maxlength != undefined) {
            if(strlen($value) <= $maxlength) {
                return TRUE;
            }  else {
               return FALSE; 
            }
        } else {
            return TRUE;
        }
    }
}
