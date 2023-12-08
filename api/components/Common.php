<?php

namespace api\components;

use common\models\MemcompprdserfollowdtlsTbl;
use common\models\MemcompproddtlsTbl;
use common\models\MemcompservicedtlsTbl;
use common\models\MemcompbussrcdtlsTbl;
use yii\db\ActiveRecord;
use Yii;

class Common extends \yii\base\BaseObject {

    const PREFIXWITHTABLE = array(
        'ActM' => 'activitiesmst_tbl',
        'aum' => 'adminusermst_tbl',
        'aurm' => 'adminuserrolemst_tbl',
        'CurM' => 'currencymst_tbl',
        'SecM' => 'sectormst_tbl',
        'IndM' => 'industrymst_tbl',
        'SegM' => 'segmentmst_tbl',
        'FamM' => 'familymst_tbl',
        'ClsM' => 'classmst_tbl',
        'SrvM' => 'servicemst_tbl',
        'BGIMPM' => 'bgimpurposemst_tbl',
        'MM' => 'modulemst_tbl',
        'SMM' => 'submodulemst_tbl',
        'BECM' => 'bgieventcatmst_tbl',
        'SpM' => 'specificationmst_tbl',
        'PrdM' => 'productmst_tbl',
        'CyM' => 'countrymst_tbl',
        'SM' => 'statemst_tbl',
        'CM' => 'citymst_tbl',
        'ClM' => 'classificationmst_tbl',
        'AM' => 'areamst_tbl',
        'BSM' => 'bussourcemst_tbl',
        'MPSCM' => 'ministrypscodemst_tbl',
        'DoM' => 'domainmst_tbl',
        'NLKCM' => 'natlookoutcatmst_tbl',
        'LA' => 'languagemst_tbl',
        'LAK' => 'LanguagekeywordmstTbl',
        'LAT' => 'LanguagetranslateTbl',
        'DM' => 'departmentMst_Tbl',
        "MCPD" => "memcompprofiledtls",
        "MCPSD" => "memcompprodspecdtls",
        "MCTBRSGD" => "mctbrsecgrddtls",
        "MCM" => "membercompanymst_tbl",
        "MCGD" => "memcompgendtls",
        "MCLPD" => "memcomplookoutproddtls",
        "MCLSD" => "memcomplookoutservdtls",
        "MCMP" => "memcompmarketpresencedtls",
        "MCPrD" => "memcompproddtls_tbl",
        "MCPAvD" => "memcompprofachvdtls",
        "MCPCD" => "memcompprofcertfdtls",
        "MCPASD" => "memcompprofsuppattdtls",
        "MCSD" => "memcompsectordtls",
        "MCSvD" => "memcompservicedtls_tbl",
        "mcsvd" => "memcompservicedtls_tbl",
        "mcad" => "memcompacomplishdtls",
        "mcpsap_" => "memcompprodservagentsprncp",
        "mcsp_" => "memcompservprncp",
        "UPT_" => "userpermtrn",
        "MCSSD_" => "memcompservspecdtls",
        "UM" => "usermst",
        "sham" => "stkholderaccessmst_tbl",
        "prjd" => "projectdtls_tbl",
        "prjt" => "projecttmp_tbl",
        "mrm" => "memeberregistrationmst_tbl",
        "li" => 'licensinginfo_tbl'
    );

    public static function getTableWithPrefix($field, $tblwithfield = false) {

        if ($field == '') {
            return 'Prefix not valid';
            exit;
        }
        $splt = explode("_", $field);
        $allprefix = self::PREFIXWITHTABLE;
        $checkprefix = (!empty($splt[0])) ? $splt[0] : '';
        $prefix = trim($checkprefix);
        if (!empty($prefix)) {
            if (array_key_exists($prefix, $allprefix)) {
                if ($tblwithfield) {
                    return $allprefix[$prefix] . "." . $field;
                } else {
                    return $allprefix[$prefix];
                }
            }
            die;
        } else {
            return '';
        }
    }

    public function fileupload($data, $file) {
        $regPk = ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);

        $filename = $file['file']['name'];
        $tempnname = $file['file']['tmp_name'];
        $target_path = getcwd() . "/web/uploads/suppliers/" . $regPk . "/" . $data['dmsCategory'];
        $file_size = $file['file']['size'];
        $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $extensions = ['jpg', 'png', 'jpeg', 'gif', 'doc', 'pdf', 'flv'];
        $type = $data['type'];

        if (!empty($file) && !empty($data['dmsSize'])) {
            if (in_array($file_extension, $extensions)) {

                /* @var $file_size type */
                if ($data['dmsSize'] >= $file_size) {
                    if ($data['temp'] === 1) {
                        $temp_path = $_SERVER['DOCUMENT_ROOT'] . "/v3/temp/";
                        $temp_path = $data['temppath'];
                        if (!file_exists($temp_path)) {
                            mkdir($temp_path, 0777, true);
                        }
                        $temp_path = $temp_path . basename($filename);
                        if (move_uploaded_file($tempnname, $temp_path)) {
                            return [
                                "msg" => "The file $filename has been moved successfully to temp folder",
                                "status" => 1,
                                "filename" => $filename
                            ];
                        } else {
                            return [
                                "msg" => "Error uploading your file to temp",
                                "status" => 0
                            ];
                        }
                    } else {
                        if (!file_exists($target_path)) {
                            mkdir($target_path, 0777, true);
                        }
                        $jsonArr['file_name'] = Common::generateFileName($filename, null, false);
                        $jsonArr['original_name'] = $filename;
                        $jsonArr['file_size'] = $file_size;
                        $jsonArr['file_type'] = $type;
                        $upload = \common\models\MemcompfiledtlsTblQuery::saveFiles($jsonArr, $data);
                        $jsonArr['file_name'] = $upload['dbFileName'];
                        $target_path = $target_path . "/" . $jsonArr['file_name'];
                        
                        if (move_uploaded_file($tempnname, $target_path)) {
                            return $upload;
                        } else {
                            return [
                                "msg" => "Error uploading your file",
                                "status" => 0
                            ];
                        }
                    }
                } else {
                    return [
                        "msg" => "The file exceeds the allowed size " . $data['size'],
                        "status" => 0
                    ];
                }
                // } else {
                //     return [
                //         "msg" => "Invalid file",
                //         "status" => 0
                //     ];
                // }
            } else {
                return [
                    "msg" => "This file type is not  allowed",
                    "status" => 0
                ];
            }
        } else {
            return [
                "msg" => "Please specify the target path, extensions and size",
                "status" => 0
            ];
        }
    }

 
    public function file_upload_temp($data, $file , $temp = false , $module = NULL) { 
       
//        $file = $file[0];
       
        if(!$temp)
        {
            $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
            $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        }
        
        $serverAllowedExtensions = ['xlsx', 'xls', 'png', 'pdf', 'jpg', 'jpeg', 'doc', 'docx', 'ppt', 'jfif'];
        $srcDirectory = \Yii::$app->params['srcDirectory'];
        $baseUrl = \Yii::$app->params['baseMailPath'];
        $uploadPath = \Yii::$app->params['uploadPath'];
        
        if(!$temp)
        {
        $userDirectory = "comp_" . $companyPk . "/user_" . $userPk;
        }
        else
        {
        $userDirectory = "temp/".$module;
        }
        
        

        $target_path = $srcDirectory . $uploadPath . "/" . $userDirectory . '/' . $data['filePath'] . '/';
        $linkUrl = $uploadPath . "/" . $userDirectory . '/' . $data['filePath'] . '/'; 
     
        $filename = $file['file']['name']; 
        $tempPath = $file['file']['tmp_name'];
        $file_size = $file['file']['size'];
        
        $file_extension = strtolower(pathinfo($filename[0], PATHINFO_EXTENSION));
        
        $allowedExtensions = array_map('trim', explode(",", $data['fileFormat']));
        $allowedFileSize = $data['fileSize']; //This should be in bytes

        $uploadData = [];
        $uploadData['key'] = $data['key'];
        $uploadData['originalFileName'] = $filename;
        $uploadData['generatedFileName'] = $filename . "[[]]" . time() . '.' . $file_extension;
        $uploadData['fileType'] = $file_extension;
        $uploadData['fileSize'] = $file_size;
        
        
        if (!in_array($file_extension, $serverAllowedExtensions)) {
            return [
                "msg" => "Unsupported file format, Please contact our support team.",
                "status" => 0,
                "errorCode" => 'FILEFORMATNOTSUPPORTEDSERVER',
            ];
        }
        
        if (in_array($file_extension, $allowedExtensions)) { //For Extension Validation
           
            
            if (!empty($file['file']) && Common::mimeCheck($file['file'])) {
                
                if ($allowedFileSize >= $file_size[0]) {
                    if (!is_dir($target_path)) {
                        
                        mkdir($target_path, 0777, true);
                    }
                   
                    
                    $target_path = $target_path . basename($uploadData['generatedFileName']);
                    $linkUrl = $linkUrl . basename($uploadData['generatedFileName']);
                    
                    
                    $result = move_uploaded_file($tempPath[0], $target_path);
                    $uploadData['fileUrl'] = $linkUrl;
                    self::compress($uploadData['fileUrl'],$uploadData['fileUrl']);
                    if(!$temp)
                    {
                       
                    $upload = \api\models\MemcompfiledtlsTbl::singleUpload($uploadData, $target_path);

                    return $upload;
                    }
                    else
                    {
                        return [
                            "msg" => "success",
                            "status" => 1,
                            "data" => [
                                "fileName" => $filename,
                                "fileModified" => $uploadData['generatedFileName'],
                                "fileType" => $file_extension,
                                "fileSize" => $file_size,
                                "fileUrl" => $target_path,
                                "filePk" => $data['key'],
                                "link" => $baseUrl.$linkUrl,
                        ]];
                    }
                   
                } else {
                    return [
                        "msg" => "This file exceeds the maximum size allocated",
                        "status" => 0,
                        "errorCode" => 'FILESIZEEXCEED',
                    ];
                }
            } else {
                return [
                    "msg" => "The file is corrupted, please try again later",
                    "status" => 0,
                    "errorCode" => 'FILECORRUPTED',
                ];
            }
        } else {
            return [
                "msg" => "This file extension is not allowed",
                "status" => 0,
                "errorCode" => 'FILEEXTNOTALLOWED',
            ];
        }
    }


    //Multipleimage Upload Mobile Service
    public function file_multiupload_temp($data, $file) {  
        
      
       
         //For the base directory
//        $companyPk = ActiveRecord::getTokenData('MemberCompMst_Pk', true);
//        $userPk = ActiveRecord::getTokenData('UserMst_Pk', true);
        
       $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $serverAllowedExtensions = ['xlsx', 'xls', 'png', 'pdf', 'jpg', 'jpeg', 'doc', 'docx', 'ppt'];
        $srcDirectory = \Yii::$app->params['srcDirectory']; 
        $uploadPath = \Yii::$app->params['uploadPath'];
        $userDirectory = "comp_" . $companyPk . "/user_" . $userPk;
        $target_path = $srcDirectory . $uploadPath . "/" . $userDirectory . '/' . $data['filePath'] . '/';
        $linkUrl = $uploadPath . "/" . $userDirectory . '/' . $data['filePath'] . '/';
        $baseUrl = \Yii::$app->params['baseMailPath'];
     
        if(!file_exists($target_path)){
            mkdir($target_path, 0777, true);
            }
            
         
         $i = 0;
       
        foreach ($_FILES['file']['name'] as $val ) {
                
        $filename_[$i] = $_FILES['file']['name'][$i]; 
        $tempPath_[$key] = $_FILES['file']['tmp_name'][$i];
        $file_size = $_FILES['file']['size'][$i];
        $file_extension = strtolower(pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION));
        $allowedExtensions = array_map('trim', explode(",", $data['fileFormat']));
        $allowedFileSize = $data['fileSize']; //This should be in bytes
        $uploadData = [];
        $uploadData['datakey'] = [$i];
        $uploadData['filePk'] = $data['key'];
        $uploadData['fileName'] = $_FILES['file']['name'][$i];
        $uploadData['fileModified'] = $_FILES['file']['name'][$i]. "[[]]" . time() . '.' . $file_extension;
        $uploadData['fileType'] = $file_extension;
        $uploadData['fileSize'] = $file_size ;
   

         if (in_array($file_extension, $allowedExtensions)) { //For Extension Validation
           $fname["tmp_name"] = $_FILES['file']['tmp_name'][$i];
           $fname["name"] = $_FILES['file']['name'][$i];
           
            if (!empty($_FILES['file']['name'][$i]) && Common::mimeCheck($fname)) {
                if ($allowedFileSize >= $file_size) {
                   
                    $linkUrl = $linkUrl . basename($uploadData['generatedFileName']);  
                    $tmpFilePath = $_FILES['file']['tmp_name'][$i];
                    $target_path = $linkUrl . $uploadData['fileModified'];
                    move_uploaded_file($tmpFilePath, $target_path);
                    $uploadData['fileUrl'] = $target_path;
                    self::compress($uploadData['fileUrl'],$uploadData['fileUrl']);   
                    $upload[] = \app\models\OpalmemcompfiledtlsTbl::singleUpload($uploadData, $target_path);  
                   
                } else {
                    return [
                        "msg" => "This file exceeds the maximum size allocated",
                        "status" => 0,
                        "errorCode" => 'FILESIZEEXCEED',
                    ];
                }
            } else {
                return [
                    "msg" => "The file is corrupted, please try again later",
                    "status" => 0,
                    "errorCode" => 'FILECORRUPTED',
                ];
            }
        } else {
            return [
                "msg" => "This file extension is not allowed",
                "status" => 0,
                "errorCode" => 'FILEEXTNOTALLOWED',
            ];
        }
           
           $i++;
        }
        
     return $upload;
    }
    //End
    public function file_upload_crop($data, $file,$filename) {
      
    //For the base directory
    $companyPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    
    $serverAllowedExtensions = ['xlsx', 'xls', 'png', 'pdf', 'jpg', 'jpeg', 'doc', 'docx', 'ppt', 'jfif'];
    $srcDirectory = \Yii::$app->params['srcDirectory'];
    $uploadPath = \Yii::$app->params['uploadPath'];
    $userDirectory = "comp_" . $companyPk . "/user_" . $userPk;
    $target_path = $srcDirectory . $uploadPath . "/" . $userDirectory . '/' . $data['filePath'] . '/';
    $linkUrl = $uploadPath . "/" . $userDirectory . '/' . $data['filePath'] . '/';
    
    $filename = $filename;
    $tempPath = $file['file']['tmp_name'];
    $file_size = $file['file']['size'];
    $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowedExtensions = explode(", ", $data['fileFormat']);
    $allowedFileSize = $data['fileSize']; //This should be in bytes
    $filenameDtls=explode(".".$file_extension, $filename);
    $filename=$filenameDtls[0].'.'.$file_extension;
    
    if (!in_array($file_extension, $serverAllowedExtensions)) {
        return [
            "msg" => "Unsupported file format, Please contact our support team.",
            "status" => 0,
            "errorCode" => 'FILEFORMATNOTSUPPORTEDSERVER',
        ];
    }
    $uploadData = [];
    $uploadData['key'] = $data['key'];
    $uploadData['originalFileName'] = $filename;
    $uploadData['generatedFileName'] = $filename . "[[]]" . time() . '.' . $file_extension;
    $uploadData['fileType'] = $file_extension ? $file_extension : 'png';
    $uploadData['fileSize'] = $file_size;
    
    
    $isSameFileExist = \api\models\MemcompfiledtlsTbl::find()->where(
                    'mcfd_filemst_fk=:mstpk AND '
                    . 'mcfd_opalmemberregmst_fk=:comppk AND '
                    . 'mcfd_uploadedby=:userpk AND '
                    . 'mcfd_origfilename=:filename',
                    [
                        ':mstpk' => $uploadData['key'],
                        ':comppk' => $companyPk,
                        ':userpk' => $userPk,
                        ':filename' => $uploadData['originalFileName'],
                    ]
            )->count();
            
    $chkFle = array();
    $imageInfo = getimagesize( $file['file']['tmp_name'] );
    $mime = mime_content_type($file['file']['tmp_name']);
    // $mime = $imageInfo['mime'];
    $chkFle['mime'] = $mime;
    $chkFle['extension'] = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if (in_array($file_extension, $allowedExtensions)) { //For Extension Validation
        if (!empty($file['file']) && Common::mimeCheckCrop($chkFle)) {
            if ($allowedFileSize >= $file_size  || 1) {
                if (!file_exists($target_path)) {
                    mkdir($target_path, 0777, true);
                }
                $target_path = $target_path . basename($uploadData['generatedFileName']);
                $linkUrl = $linkUrl . basename($uploadData['generatedFileName']);
                   
                move_uploaded_file($tempPath, $target_path);
                $uploadData['fileUrl'] = $linkUrl;
                self::compress($uploadData['fileUrl'],$uploadData['fileUrl']);
                $uploadData['originalFileName'] = $uploadData['originalFileName'];
                
                $upload = \api\models\MemcompfiledtlsTbl::singleUpload($uploadData, $target_path);
                //echo '<pre>';print_r($upload);exit;
                 return $upload;
            } else {
                return [
                    "msg" => "This file exceeds the maximum size allocated",
                    "status" => 0,
                    "errorCode" => 'FILESIZEEXCEED',
                ];
            }
        } else {
            return [
                "msg" => "The file is corrupted, please try again later",
                "status" => 0,
                "errorCode" => 'FILECORRUPTED',
            ];
        }
    } else {
        return [
            "msg" => "This file extension is not allowed11111",
            "status" => 0,
            "errorCode" => 'FILEEXTNOTALLOWED',
        ];
    }
}

    public function getfilemod() {

        $dir = getcwd() . '/modules/backend/json/*';
        $fileList = glob($dir);
        $jsondecode = [];
        foreach ($fileList as $filename) {
            if (is_file($filename)) {
                $basename = basename($filename);
                $file_extension = explode(".", $basename);
                $fp = fopen($filename, 'r');
                $arr = array();
                $arr = file_get_contents($filename);
                $data = json_decode($arr, true);
                $date = date('d-m-y H:i', filemtime($filename));
                $jsondecode['msg'] = "success";
                $jsondecode['status'] = 1;
                $jsondecode[$file_extension[0]] = $data;
                $jsondecode[$file_extension[0]]['date'] = $date;
            }
        }

        return $jsondecode;
    }

    function chkMime($ext, $file) {
        $mime_typ = array('png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript'
        );

        $mime = mime_content_type($file);
        if ($mime_typ[$ext] == $mime) {
            return true;
        }
    }

    public function generateFileName($name, $pk, $bool = false) {
        $userpk = ActiveRecord::getTokenData('UserMst_Pk', true);
        $pathinfo = pathinfo($name);
        $filename = str_replace($pathinfo['filename'], time() . rand(), $pathinfo['filename']);
        if (empty($filename)) {
            $filename = rand(10, 999) . date('Ymdi');
        }
        $ext = strtolower($pathinfo['extension']);
        if ($bool) {
            return "pub_$userpk" . "_" . "$pk" . "[[]]" . $filename . '_' . $pk . '.' . $ext;
        } else {
            return $filename . "." . $ext;
        }
    }

    public static function encrypt($key) {
        return Security::base64_encrypt_str($key, 'atomicka');
    }

    public static function decrypt($key) {

        return Security::base64_decrypt_str($key, 'atomicka');
    }

    public static function getIpAddress() {
        return \Yii::$app->request->userIP;
    }

    public static function getUniqueId($type, $from=null, $table_type = 1, $crondata=null) { 

        if(isset($crondata['datafrom']) && $crondata['datafrom'] == 'cron') {
            $companypk =  $crondata['company_pk'];           
            $company_pk = $crondata['company_pk'];       
            $company_jsrsregno = $crondata['jsrsno'];       
        } else { 
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            // $lypisId = \yii\db\ActiveRecord::getTokenData('lypis_id', true);
            $company_pk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
            $company_jsrsregno = \yii\db\ActiveRecord::getTokenData('mcm_RegistrationNo', true);
        }
        //print_r('sdfd');
        //print_r($company_jsrsregno);die();
        if ($type == 'cmsReq') { 
            $typekey = 'JSRSREQ';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('cmsrequisitionformdtls_tbl', 'crfd_createdby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))
                            ->andWhere('crfd_type=:type', array(':type' => 1))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'tender') { 
            $typekey = 'JSRSTN';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('cmsrequisitionformdtls_tbl', 'crfd_createdby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))
                            ->andWhere('crfd_type=:type', array(':type' => $from))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        
        if ($type == 'Quotation') { 
            $typekey = 'JSRSQT';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('cmsquotationhdr_tbl', 'cmsqh_initiatedby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))                   
                            ->andWhere('cmsqh_type=:type', array(':type' => 1))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'Offer') { 
            $typekey = 'JSRSOFR';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('cmsquotationhdr_tbl', 'cmsqh_initiatedby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))                   
                            ->andWhere('cmsqh_type=:type', array(':type' => 2))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'Proposal') { 
            $typekey = 'JSRSPROP';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('cmsquotationhdr_tbl', 'cmsqh_initiatedby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))                   
                            ->andWhere('cmsqh_type=:type', array(':type' => 3))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'Contract') { 
            $typekey = 'JSRSCN';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('cmscontracthdr_tbl', 'cmsch_initiatedby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))                   
                            ->andWhere('cmsch_type=:type and cmsch_contracttype = 1', array(':type' => 1))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'subContract') { 
            $typekey = 'JSRSSC';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('cmscontracthdr_tbl', 'cmsch_initiatedby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))                   
                            ->andWhere('cmsch_type=:type and cmsch_contracttype = 2', array(':type' => 1))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'Blanket') { 
            $typekey = 'JSRSBA';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('cmscontracthdr_tbl', 'cmsch_initiatedby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))                   
                            ->andWhere('cmsch_type=:type', array(':type' => 3))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'Purchase') { 
            $typekey = 'JSRSPO';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('cmscontracthdr_tbl', 'cmsch_initiatedby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))                    
                            ->andWhere('cmsch_type=:type and cmsch_contracttype = 1', array(':type' => 2))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'subOrder') { 
            $typekey = 'JSRSSO';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('cmscontracthdr_tbl', 'cmsch_initiatedby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))                    
                            ->andWhere('cmsch_type=:type and cmsch_contracttype = 2', array(':type' => 2))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'project') { 
            $typekey = 'JSRSPRJ';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('projectdtls_tbl', 'prjd_createdby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'Agreement') { 
            $typekey = 'JSRSBA';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('cmscontractagreementhdr_tbl', 'cmscah_createdby = UserMst_Pk')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'jdo') { 
            $typekey = 'JSRSJDO';
            $id = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['count(*) as count'])
                            ->innerJoin('usermst_tbl', 'UM_MemberRegMst_Fk = MCM_MemberRegMst_Fk')
                            ->innerJoin('jdomoduledtl_tbl', 'jdmd_createdby = UserMst_Pk and jdmd_shared_type = 5')
                            ->where('MemberCompMst_Pk=:pk', array(':pk' => $companypk))
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }

        if ($type == 'cmsRFI') { 
            $typekey = 'RFI';
            $id = \api\modules\pms\models\CmstenderhdrTbl::find()
                            ->select(['count(*) as count'])
                            ->asArray()->one();
            if (!empty($id['count'])) {
                $countData = $id['count'] + 1;
            } else {
                $countData = 1;
            }
        }
        if ($type == 'RFI') { 
            $typekey = 'JSRSRFI';
            if($table_type == 1) {
                $id = \api\modules\pms\models\CmstenderhdrtempTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmstht_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmstht_type=:type', array(':type' => 1))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 2) {
                $id = \api\modules\pms\models\CmstenderhdrTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsth_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsth_type=:type', array(':type' => 1))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 3) {
                $id = \api\modules\pms\models\CmstenderhdrhstyTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsthh_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsthh_type=:type', array(':type' => 1))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

        }

        if ($type == 'RFQ') { 
            $typekey = 'JSRSRFQ';
            if($table_type == 1) {
                $id = \api\modules\pms\models\CmstenderhdrtempTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmstht_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmstht_type=:type', array(':type' => 5))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 2) {
                $id = \api\modules\pms\models\CmstenderhdrTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsth_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsth_type=:type', array(':type' => 5))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 3) {
                $id = \api\modules\pms\models\CmstenderhdrhstyTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsthh_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsthh_type=:type', array(':type' => 5))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

        }

        if ($type == 'RFP') { 
            $typekey = 'JSRSRFP';
            if($table_type == 1) {
                $id = \api\modules\pms\models\CmstenderhdrtempTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmstht_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmstht_type=:type', array(':type' => 4))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 2) {
                $id = \api\modules\pms\models\CmstenderhdrTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsth_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsth_type=:type', array(':type' => 4))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 3) {
                $id = \api\modules\pms\models\CmstenderhdrhstyTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsthh_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsthh_type=:type', array(':type' => 4))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

        }

        if ($type == 'EOI') { 
            $typekey = 'JSRSEOI';
            if($table_type == 1) {
                $id = \api\modules\pms\models\CmstenderhdrtempTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmstht_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmstht_type=:type', array(':type' => 2))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 2) {
                $id = \api\modules\pms\models\CmstenderhdrTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsth_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsth_type=:type', array(':type' => 2))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 3) {
                $id = \api\modules\pms\models\CmstenderhdrhstyTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsthh_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsthh_type=:type', array(':type' => 2))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }
        }

        if ($type == 'PQ') { 
            $typekey = 'JSRSPQ';
            if($table_type == 1) {
                $id = \api\modules\pms\models\CmstenderhdrtempTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmstht_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmstht_type=:type', array(':type' => 3))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 2) {
                $id = \api\modules\pms\models\CmstenderhdrTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsth_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsth_type=:type', array(':type' => 3))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 3) {
                $id = \api\modules\pms\models\CmstenderhdrhstyTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsthh_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsthh_type=:type', array(':type' => 3))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }
        }

        if ($type == 'RFT') { 
            $typekey = 'JSRSRFT';
            if($table_type == 1) {
                $id = \api\modules\pms\models\CmstenderhdrtempTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmstht_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmstht_type=:type', array(':type' => 6))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 2) {
                $id = \api\modules\pms\models\CmstenderhdrTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsth_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsth_type=:type', array(':type' => 6))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }

            if($table_type == 3) {
                $id = \api\modules\pms\models\CmstenderhdrhstyTbl::find()
                        ->select(['count(*) as count'])
                        ->where('cmsthh_memcompmst_fk=:pk', array(':pk' => $companypk))
                        ->andWhere('cmsthh_type=:type', array(':type' => 6))
                        ->asArray()->one();
                if (!empty($id['count'])) {
                    $countData = $id['count'] + 1;
                } else {
                    $countData = 1;
                }
            }
        }

        if ($type == 'PROD') { 
            $typekey = 'RPRDS';//JSRSPRD
            $product_count = MemcompproddtlsTbl::find()->where(['MCPrD_MemberCompMst_Fk' => $companypk])->count();
          
            //->andWhere(['!=', 'mcprd_isdeleted', 1])
            if (!empty($product_count)) {
                $countData = $product_count + 1;
            } else {
                $countData = 1;
            }
        }

        if ($type == 'SERV') { 
            $typekey = 'RSERVS';//JSRSSERV
            $service_count = MemcompservicedtlsTbl::find()->where(['MCSvD_MemberCompMst_Fk' => $companypk])->count();
            // ->andWhere(['!=', 'mcsvd_isdeleted', 1])
          
            if (!empty($service_count)) { 
                $countData = $service_count + 1;
            } else {
                $countData = 1;
            }
        }

        if ($type == 'BS') { 
            $typekey = 'RBSS';//JSRSBS
            $bs_count = MemcompbussrcdtlsTbl::find()->where(['mcbsd_membercompanymst_fk' => $companypk])->count();
          
            if (!empty($bs_count)) {
                $countData = $bs_count + 1;
            } else {
                $countData = 1;
            }
        }

        if($type == 'cmsdiscipline') {
            $typekey = 'CMSDIS';
            $dis_count = \app\models\CmsdisciplinedtlsTbl::find()->where(['cmsdd_memcompmst_fk' => $companypk])->count();
          
            if (!empty($dis_count)) {
                $countData = $dis_count + 1;
            } else {
                $countData = 1;
            }
        }

        if($type == 'cmscostcentre') {
            $typekey = 'CMSCC';
            $dis_count = \app\models\CmscostcenterdtlsTbl::find()->where(['cmsccd_memcompmst_fk' => $companypk])->count();
          
            if (!empty($dis_count)) {
                $countData = $dis_count + 1;
            } else {
                $countData = 1;
            }
        }
        if($type == 'RDVS') {
            // JSRSDV
            $typekey = 'RDVS';//JSRSDV
            // $dis_count = \common\models\MemcompsectordtlsTbl::find()->where(['MCSD_MemberCompMst_Fk' => $companypk])->count(); 
            $dis_count_num = \common\models\MemcompsectordtlsTbl::find()->select(['mcsd_referenceno'])->where(['MCSD_MemberCompMst_Fk' => $companypk])->orderby('MemCompSecDtls_Pk desc')->limit(1)->asArray()->one(); 

            if(!empty($dis_count_num)){
                    $get_inc_num=substr($dis_count_num['mcsd_referenceno'],-3);
            }
            
            $dis_count=$get_inc_num*1;

            if (!empty($dis_count)) {
                $countData = (int)$dis_count + 1;
            } else {
                $countData = 1;
            }
        }
       
        $stktype = \common\models\MemberregistrationmstTbl::find()->select('mrm_stkholdertypmst_fk')
                ->innerJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                ->where(['MemberCompMst_Pk' => $companypk])->asArray()->one();
      
        if( $company_jsrsregno == null  && $stktype["mrm_stkholdertypmst_fk"]!= 8) {
            //code added after discuss with karthick
            $resutl = [
                "msg" => "Something went wrong",
                "status" => 0,
                "errorCode" => 'UNABLETOCREATEUNIQUEID',
            ];
            echo json_encode($resutl); 
            die();
        } else {
            return $typekey.$company_jsrsregno.sprintf("%04d",$countData);
        }
    }

    /**
     * This method is used to convert timezone from one to another
     * @param string $time - Date from the Database
     * @param string $toTz - Country Name
     * @param string $fromTz - Country Name
     * @return string
     */

    function convertTimezone($time="",$toTz='',$fromTz='') {
        if($time){
            $date = new \DateTime($time, new \DateTimeZone($fromTz));
            $date->setTimezone(new \DateTimeZone($toTz));
            $time= $date->format('Y-m-d H:i:s');
            return $time;            
        }  else {
            return "";            
        }
    }

    /**
     * This method is used to convert timezone from one to another
     * @param string $date - Date from the Database
     * @param string $format - return datetime format
     * @param string $fromTimeZone - Timezone from
     * @param string $toTimeZone - Timezone to
     * @return string
     */
    public static function convertDateTimeToUserTimezone($date, $format = 'Y-m-d H:i:s', $fromTimeZone = '+04:00', $toTimeZone = '') {
            $user_timezone = ($toTimeZone) ? $toTimeZone : \yii\db\ActiveRecord::getTokenData('timezone', true);
        if (!empty($date) && !empty($user_timezone)) {
            $date = new \DateTime($date, new \DateTimeZone($fromTimeZone));
            $date->setTimezone(new \DateTimeZone($user_timezone));
            return $date->format($format);
        }
        return "";
    }

    /**
     * This method is used to convert timezone to server timezone
     * @param string $date - Date to be converted
     * @param string $format - return datetime format
     * @return string
     */
    public static function convertDateTimeToServerTimezone($date, $format = 'Y-m-d H:i:s') {
        if (!empty($date)) {
           
            $date = new \DateTime($date, new \DateTimeZone('+4:00'));
            $date->setTimezone(new \DateTimeZone('+4:00'));
            return $date->format($format);
        }
        return "";
    }

    /**
     * this method is used to check and return "ETN" is or not on phone number column
     * @input $data as string
     * @output boolean and integer
     */
    public static function strposcheck($data) {
        return !empty($data) ? strpos($data, '/') : false;
    }

    /**
     * This method is used to generate LyPIS ID using regpk
     * @param integer $regpk - Primary key of the Registration
     * @return string
     */
    public static function generateLyPISID($regpk,$countryPk,$compPk) {
        $projectNameConfig  =   1;
        $projectConfigArr   =   1;
        $projectConfig      =   $projectConfigArr[$projectNameConfig];
            if (!empty($regpk) && !empty($countryPk)) {
                $countryData = \common\models\MemberregistrationmstTbl::getCountryByRegPk($regpk);
                if($countryData != ''){
                    $countryPk          =   $countryData['MCM_Source_CountryMst_Fk'];
                    $countryShortName   =   $countryData['CyM_CountryCode_en'];
                }else{
                    $countryData = \api\modules\mst\models\CountrymstTbl::findOne($countryPk);
                    $countryShortName   =   $countryData->CyM_CountryCode_en;
                }
                    $countryDataRegPk   =   \common\models\MemberregistrationmstTbl::getLastRegPkByCountryPk($countryPk,$regpk);
                    $lastRegPk          =   $compPk;
                    $projShortName      =   $projectConfig['shortName'];
                    $commonIdMask       =   $projectConfig['projectCommonidMask'];
                    $finalId            =   str_ireplace(array('{SHORTNAME}','{COUNTRY}','{INCVAL}'), array($projShortName,$countryShortName,$lastRegPk), $commonIdMask);
                    return $finalId;
            }
//            $stakeholderType = \common\models\MemberregistrationmstTbl::getStakeholderType($regpk);
//            $prefix = self::getStakeholderPrefix($stakeholderType);
//            $idCount = \common\models\MemberregistrationmstTbl::getRegCountByStakeholder($stakeholderType) + 1;
//            return $prefix . "" . sprintf("%03d", $idCount);
            return "";
    }

    public static function getStakeholderPrefix($stkType) {
        switch ($stkType) {
            case 1:
                return 'SA';
            case 2:
                return 'CA';
            case 3:
                return 'NOC';
            case 4:
                return 'ME';
            case 5:
                return 'IME';
            case 6:
                return 'SUP';
            case 7:
                return 'BUY';
            case 8:
                return 'GCE';
            case 9:
                return 'INV';
            case 10:
                return 'LA';
            case 11:
                return 'PO';
            case 12:
                return 'JS';
            case 13:
                return 'PUB';
            default :
                return '';
        }
    }

    function numberConversion($n, $precision = 2, $type = 0) {
        if (empty($n) || $n == '-') {
            return '-';
        }
        $n = (0 + str_replace(",", "", $n));
        if (!is_numeric($n)) {
            return false;
        }
        $_suffixar = [['M', 'Mn', 'Million'], ['B', 'Bn', 'Billion'], ['T', 'Tn', 'Trillon']];
        $type = ($type > 2 ) ? 0 : $type;
        if ($n > 9999 && $n < 900000000) {
            $n_format = number_format($n / 1000000, $precision);
            $suffix = $_suffixar[0][$type];
        } elseif ($n > 900000000 && $n < 900000000000) {
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = $_suffixar[1][$type];
        } elseif ($n > 900000000000) {
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = $_suffixar[2][$type];
        } else {
            $n_format = $n;
        }

        return $n_format . ' ' . $suffix;
    }

    function numberConversionNew($n, $precision = 2, $type = 0) {
        if (empty($n) || $n == '-') {
            return '-';
        }
        $n = (0 + str_replace(",", "", $n));
        if (!is_numeric($n)) {
            return false;
        }
        $_suffixar = [['K'], ['M', 'Mn', 'Million'], ['B', 'Bn', 'Billion'], ['T', 'Tn', 'Trillon']];
        $type = ($type > 3 ) ? 0 : $type;
        if ($n > 999 && $n < 1000000) {
             $n_format = number_format($n / 1000, $precision);
//            $n_format = round($n / 1000);
            $suffix = $_suffixar[0][$type];
        } elseif ($n > 999999 && $n < 900000000) {
            // $n_format = number_format($n / 1000000, $precision);
            $n_format = round($n / 1000000,2);
            $suffix = $_suffixar[1][$type];
        } elseif ($n > 900000000 && $n < 900000000000) {
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = $_suffixar[2][$type];
        } elseif ($n > 900000000000) {
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = $_suffixar[3][$type];
        } else {
            $n_format = $n;
        }
        $chkFormet=explode('.', $n_format);
        if(end($chkFormet) == '00'){
            $n_format = $chkFormet[0];
        }
        return $n_format . '' . $suffix;
    }

    /* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
    /* ::                                                                         : */
    /* ::  This routine calculates the distance between two points (given the     : */
    /* ::  latitude/longitude of those points). It is being used to calculate     : */
    /* ::  the distance between two locations using GeoDataSource(TM) Products    : */
    /* ::                                                                         : */
    /* ::  Definitions:                                                           : */
    /* ::    South latitudes are negative, east longitudes are positive           : */
    /* ::                                                                         : */
    /* ::  Passed to function:                                                    : */
    /* ::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  : */
    /* ::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  : */
    /* ::    unit = the unit you desire for results                               : */
    /* ::           where: 'M' is statute miles (default)                         : */
    /* ::                  'K' is kilometers                                      : */
    /* ::                  'N' is nautical miles                                  : */
    /* ::  Worldwide cities and other features databases with latitude longitude  : */
    /* ::                                                                         : */
    /* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */

    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return round($miles * 1.609344);
            } else if ($unit == "N") {
                return round($miles * 0.8684);
            } else {
                return round($miles);
            }
        }
    }

    function mimeCheckCrop($fname)
    {
        $mime = $fname['mime'];
        $ext = $fname['extension'];
        $mime_typ = array(
                'image/png',
                'image/jpeg',
                'image/jpeg',
                'image/jpeg',
                //'image/gif',
                //'image/bmp',
                //'image/vnd.microsoft.icon',
                //'image/tiff',
                //'image/tiff',
                //'image/svg+xml',
                //'image/svg+xml',
                'application/pdf',
                //'image/vnd.adobe.photoshop',
                //'application/postscript',
                //'application/postscript',
                //'application/postscript',
                'video/mp4',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/msword',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip',
        );

        if (in_array($mime, $mime_typ)) {
            return true;
        } else {
            return false;
        }

    }

    public static function mimeCheck($fname) {
        $mime = mime_content_type($fname["tmp_name"][0]);
        $pathinfo = pathinfo($fname["name"][0]);
        $ext = strtolower($pathinfo['extension']);
        
        $mime_typ = array(
            'png' => ['image/png'],
            'jpe' => ['image/jpeg'],
            'jpeg' => ['image/jpeg'],
            'jpg' => ['image/jpeg'],
            'jfif' => ['image/jpeg'],
            'gif' => ['image/gif'],
            'bmp' => ['image/bmp'],
            'ico' => ['image/vnd.microsoft.icon'],
            'tiff' => ['image/tiff'],
            'tif' => ['image/tiff'],
            'svg' => ['image/svg+xml'],
            'svgz' => ['image/svg+xml'],
            'pdf' => ['application/pdf'],
            'psd' => ['image/vnd.adobe.photoshop'],
            'ai' => ['application/postscript'],
            'eps' => ['application/postscript'],
            'ps' => ['application/postscript'],
            'mp4' => ['video/mp4'],
            'ppt' => ['application/vnd.ms-powerpoint'],
            'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation'],
            'ppt' => ['application/vnd.ms-powerpoint'],
            'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            'doc' => ['application/msword'],
            'xls' => ['application/vnd.ms-excel'],
            'xlsx' => array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/zip')
        );

        if (in_array($mime,$mime_typ[$ext])) {
            return true;
        } else
            return false;
    }

    public static function checRecaptchaV3($captchaToken, $action) {
        return true;
        if (isset($captchaToken)) {
            // call curl to POST request
            $secretKey = "6Ldec7AZAAAAAMeqxG6ZhrhbZ01zcVuSUIbzMXJa";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $secretKey, 'response' => $captchaToken)));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $arrResponse = json_decode($response, true);
            // verify the response
            if ($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function checkRecaptcha($captchaToken) {
        if (isset($captchaToken)) {
            $captcha = $captchaToken;
        }
        // 6Le0IQEVAAAAAHXnx3OVAVrMvJPseU9b2Si3qbbI // Site Key
        $secretKey = '6Le0IQEVAAAAAD6HYIhJA6RYJvWfoulyRu5_N0De'; // LyPIS google secret key
        $ip = $_SERVER['REMOTE_ADDR'];
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $ip);
        $responseKeys = json_decode($response, true);
        if (intval($responseKeys["success"]) !== 1) {
            return false;
        }
        return true;
    }

    /**
     * This method is used to generate LyPIS ID using userpk
     * @param integer $userpk - Primary key of the User
     * @return string
     */
    public static function generateUserID($userpk) {
        if (!empty($userpk)) {
            return "user" . sprintf("%03d", $userpk);
        }
        return "";
    }

    /**
     * This method is used to generate referenceno using regpk
     * @param integer $regpk - Primary key of the Registration
     * @return string
     */
    public static function generateRegReferenceNo($regpk) {
        if (!empty($regpk)) {
            return rand(100, 1000) . sprintf("%03d", $regpk);
        }
        return "";
    }

    public static function yearandmonth($startdate, $enddate = '') {
        $enddates = $enddate ? $enddate : date('Y-m-d');
// Declare and define two dates
        $date1 = strtotime($startdate);
        $date2 = strtotime($enddates);
// Formulate the Difference between two dates
        $diff = abs($date2 - $date1);
// To get the year divide the resultant date into
// total seconds in a year (365*60*60*24)
        $years = floor($diff / (365 * 60 * 60 * 24));
// To get the month, subtract it with years and
// divide the resultant date into
// total seconds in a month (30*60*60*24)
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $YearMonth = '0.0';
        if ($years == 0 && $months != 0) {
            $YearMonth = '0.' . $months;
        }elseif ($months != 0 && $years != 0) {
            $YearMonth = $years . '.' . $months;
        }elseif ($months == 0 && $years != 0) {
            $YearMonth = $years . '.' . 0;
        }
        return $YearMonth;
    }

    public static function analysisforlypis() {
        $detailpk = Security::decrypt($_GET['detailPk']);
        $typeofModule = Security::decrypt($_GET['typeofModule']);
        $type = Security::decrypt($_GET['type']);
        $detailpksanitize = \common\components\Security::sanitizeInput($detailpk, "number");
        $typeofModulesanitize = \common\components\Security::sanitizeInput($typeofModule, "number");
        $typesanitize = \common\components\Security::sanitizeInput($type, "number");
        $ipaddress = Common::getIpAddress();
        $date = date('Y-m-d');
        $companypk = Security::decrypt($_GET['company']);
        $sncompanypk = \common\components\Security::sanitizeInput($companypk, "number");
        $userpk = Security::decrypt($_GET['user']);
        $snuserpk = \common\components\Security::sanitizeInput($userpk, "number");

        $companypkfinal = is_numeric($companypk) ? $sncompanypk : null;
        $userpkfinal = is_numeric($userpk) ? $snuserpk : null;
        if (!empty($detailpksanitize) && !empty($typeofModulesanitize) && !empty($typesanitize)) {
            if (!is_null($userpkfinal) && !is_null($companypkfinal)) {
                if ($type == 3 || $type == 5) {  //for login user fav count user
                    $Checkmodel = MemcompprdserfollowdtlsTbl::find()
                                    ->where('mcpsfd_followtype=:followtype and 
            mcpsfd_shared_fk=:detail and mcpsfd_type=:type and mcpsfd_followmemcompmst_fk=:company and mcpsfd_usermst_fk=:user ',
                                            [':followtype' => $typeofModulesanitize, ':type' => $typesanitize,
                                                ':detail' => $detailpksanitize, ':company' => $companypkfinal, ':user' => $userpkfinal])->one();
                } else { // for login user view purpose
                    $Checkmodel = MemcompprdserfollowdtlsTbl::find()
                                    ->where('mcpsfd_followtype=:followtype and 
            mcpsfd_shared_fk=:detail and mcpsfd_type=:type and
             mcpsfd_createdipaddr=:ipaddress and DATE(mcpsfd_createdon)=CURDATE() and 
             mcpsfd_followmemcompmst_fk=:company and mcpsfd_usermst_fk=:user ',
                                            [':followtype' => $typeofModulesanitize, ':type' => $typesanitize, ':detail' => $detailpksanitize, ':ipaddress' => $ipaddress,
                                                ':company' => $companypkfinal, ':user' => $userpkfinal])->one();
                }
            } else {
                $Checkmodel = MemcompprdserfollowdtlsTbl::find()
                                ->where('mcpsfd_followtype=:followtype and 
            mcpsfd_shared_fk=:detail and mcpsfd_type=:type and
             mcpsfd_createdipaddr=:ipaddress and DATE(mcpsfd_createdon)=CURDATE() and  mcpsfd_followmemcompmst_fk is null and mcpsfd_usermst_fk is null',
                                        [':followtype' => $typeofModulesanitize, ':type' => $typesanitize,
                                            ':detail' => $detailpksanitize, ':ipaddress' => $ipaddress])->one();
            }

            if ($typesanitize && !empty($Checkmodel)) {
                if ($typesanitize == 3 || $typesanitize == 5)
                    $returnVar = self::decreaseoraddCount($typeofModulesanitize, $typesanitize, $detailpksanitize, 'dec');
            }
        }
        if (empty($Checkmodel)) {
            $FollowModel = new MemcompprdserfollowdtlsTbl();
            $FollowModel->mcpsfd_createdon = date('Y-m-d H:i:s');
            $FollowModel->mcpsfd_followtype = $typeofModulesanitize;
            $FollowModel->mcpsfd_type = $typesanitize;
            $FollowModel->mcpsfd_shared_fk = $detailpksanitize;
            $FollowModel->mcpsfd_createdipaddr = $ipaddress;
            $FollowModel->mcpsfd_status = 1;
            $FollowModel->mcpsfd_followmemcompmst_fk = $companypkfinal;
            $FollowModel->mcpsfd_usermst_fk = $userpkfinal;
            if ($FollowModel->save(false)) {
                $returnVar = self::decreaseoraddCount($typeofModulesanitize, $typesanitize, $detailpksanitize, 'add');
            }
        }
        return $returnVar;
    }

    public static function decreaseoraddCount($typeofModulesanitize, $typesanitize, $detailpksanitize, $mode) {
        $count = 0;
        $companypk = Security::decrypt($_GET['company']);
        $sncompanypk = \common\components\Security::sanitizeInput($companypk, "number");
        $userpk = Security::decrypt($_GET['user']);
        $snuserpk = \common\components\Security::sanitizeInput($userpk, "number");
        $companypkfinal = is_numeric($companypk) ? $sncompanypk : null;
        $userpkfinal = is_numeric($userpk) ? $snuserpk : null;
        if ($typesanitize == 3 || $typesanitize == 5 || $typesanitize == 7) {
            if ($typeofModulesanitize == 2) {
                $ProductModel = MemcompproddtlsTbl::findOne($detailpksanitize);
            } elseif ($typeofModulesanitize == 3) {
                $serviceModel = \common\models\MemcompservicedtlsTbl::findOne($detailpksanitize);
            }
            if ($typesanitize == 3) {
                if ($mode == 'dec') {
                    $decModel = MemcompprdserfollowdtlsTbl::find()
                                    ->where('mcpsfd_type=:type and mcpsfd_shared_fk=:shared and mcpsfd_followmemcompmst_fk=:company
                         and mcpsfd_usermst_fk=:user',
                                            [':type' => $typesanitize, ':shared' => $detailpksanitize,
                                                ':company' => $companypkfinal, ':user' => $userpkfinal])->one();
                    $decModel->mcpsfd_status = $decModel->mcpsfd_status == 1 ? 0 : 1;
                    if ($decModel->mcpsfd_status == 1) {
                        $ProductModel->mcprd_prodfavcount = $ProductModel->mcprd_prodfavcount + 1;
                        $count = $ProductModel->mcprd_prodfavcount;
                    } else {
                        if ($ProductModel->mcprd_prodfavcount != 0) {
                            $ProductModel->mcprd_prodfavcount = $ProductModel->mcprd_prodfavcount - 1;
                            $count = $ProductModel->mcprd_prodfavcount;
                        }
                    }
                    $decModel->mcpsfd_updatedon = date('Y-m-d H:i:s');
                    $decModel->mcpsfd_updatedipaddr = Common::getIpAddress();
                    $decModel->save(false);
                } else if ($mode == 'add') {
                    $ProductModel->mcprd_prodfavcount = $ProductModel->mcprd_prodfavcount + 1;
                    $count = $ProductModel->mcprd_prodfavcount;
                }
            } else if ($typesanitize == 5) {
                if ($mode == 'dec') {
                    $decModel = MemcompprdserfollowdtlsTbl::find()
                                    ->where('mcpsfd_type=:type and mcpsfd_shared_fk=:shared and mcpsfd_followmemcompmst_fk=:company
                         and mcpsfd_usermst_fk=:user',
                                            [':type' => $typesanitize, ':shared' => $detailpksanitize,
                                                ':company' => $companypkfinal, ':user' => $userpkfinal])->one();
                    $decModel->mcpsfd_status = $decModel->mcpsfd_status == 1 ? 0 : 1;
                    if ($decModel->mcpsfd_status == 1) {
                        $serviceModel->mcsvd_servfavcount = $serviceModel->mcsvd_servfavcount + 1;
                        $count = $serviceModel->mcsvd_servfavcount;
                    } else {
                        if ($serviceModel->mcsvd_servfavcount != 0) {
                            $serviceModel->mcsvd_servfavcount = $serviceModel->mcsvd_servfavcount - 1;
                            $count = $serviceModel->mcsvd_servfavcount;
                        }
                    }
                    $decModel->mcpsfd_updatedon = date('Y-m-d H:i:s');
                    $decModel->mcpsfd_updatedipaddr = Common::getIpAddress();
                    $decModel->save(false);
                } else if ($mode == 'add') {
                    $serviceModel->mcsvd_servfavcount = $serviceModel->mcsvd_servfavcount + 1;
                    $count = $serviceModel->mcsvd_servfavcount;
                }
            } else if ($typesanitize == 7) {
                if ($mode == 'add') {
                    if ($typeofModulesanitize == 2) {
                        $ProductModel->mcprd_prodviewcount = $ProductModel->mcprd_prodviewcount + 1;
                        $count = $ProductModel->mcprd_prodviewcount;
                    } elseif ($typeofModulesanitize == 3) {
                        $serviceModel->mcsvd_servviewcount = $serviceModel->mcsvd_servviewcount + 1;
                        $count = $serviceModel->mcsvd_servviewcount;
                    }
                }
            }
            if ($typeofModulesanitize == 2) {
                $ProductModel->save(false);
            } elseif ($typeofModulesanitize == 3) {
                $serviceModel->save(false);
            }
            return $count;
        }
    }

    public function checkDateWithCurrentDate($dateToCheck, $isDateTime = true) {
        $current = strtotime(date("Y-m-d"));
        $date = ($isDateTime) ? strtotime(date('Y-m-d', strtotime($dateToCheck))) : strtotime($dateToCheck);

        $datediff = $date - $current;
        $difference = floor($datediff / (60 * 60 * 24));
        if ($difference == 0) {
            return 'TODAY';
        } else if ($difference > 1) {
            return 'FUTURE';
        } else if ($difference > 0) {
            return 'TOMORROW';
        } else if ($difference < -1) {
            return 'PAST';
        } else {
            return 'YESTERDAY';
        }
    }

    public function checkDateDiffByHrs($dateToCheck, $hrs) {
        $currentDateTime = strtotime(date("Y-m-d H:i:s"));
        $d = strtotime($dateToCheck);
        $validDateTime = strtotime(date('Y-m-d H:i:s', strtotime("+$hrs hours", $d)));
        if ($validDateTime > $currentDateTime) {
            return 'VALID';
        }
        return 'INVALID';
    }
    
    public function datediff($date1, $date2) {
        $d1 = strtotime($date1);
        $d2 = strtotime($date2);
        
        
        return abs($d1 - $d2)/3600;
        
        
    }

    public static function isNotExpired($startDate, $endDate) {
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        $currentDate = strtotime(date('Y-m-d'));
        return (($currentDate > $startDate) && ($endDate > $currentDate));
    }

    public static function getDurationByDays($noOfDays) {
//        $currentDate = (string) date('Y-m-d');
//        $currentDateTime = new \DateTime($currentDate);
//
//        $validDate = (string) date('Y-m-d', strtotime("+$noOfDays days"));
//        $validDateTime = new \DateTime($validDate);
//
//        $diff = $currentDateTime->diff($validDateTime);

//        return [
//            'Years' => $diff->y,
//            'Months' => $diff->m,
//            'Days' => $diff->d
//        ];
        $years_remaining = intval($noOfDays / 365); //divide by 365 and throw away the remainder
        $days_remaining = $noOfDays % 365;          //divide by 365 and *return* the remainder
        return [
            'Years' => $years_remaining,
            'Months' => $diff->m,
            'Days' => $days_remaining
        ];
    }
    
    public static function getLoggedIndeviceName() {
        $browser = get_browser(null, true);
        return [
            'browser' => $browser['browser'],
            'version' => $browser['version']
        ];
    }
    
    public static function AmountInWords($num, $cr)
    {
        $decones = array(
            '01' => "One",
            '02' => "Two",
            '03' => "Three",
            '04' => "Four",
            '05' => "Five",
            '06' => "Six",
            '07' => "Seven",
            '08' => "Eight",
            '09' => "Nine",
            10 => "Ten",
            11 => "Eleven",
            12 => "Twelve",
            13 => "Thirteen",
            14 => "Fourteen",
            15 => "Fifteen",
            16 => "Sixteen",
            17 => "Seventeen",
            18 => "Eighteen",
            19 => "Nineteen"
        );
        $ones = array(
            0 => " ",
            1 => "One",
            2 => "Two",
            3 => "Three",
            4 => "Four",
            5 => "Five",
            6 => "Six",
            7 => "Seven",
            8 => "Eight",
            9 => "Nine",
            10 => "Ten",
            11 => "Eleven",
            12 => "Twelve",
            13 => "Thirteen",
            14 => "Fourteen",
            15 => "Fifteen",
            16 => "Sixteen",
            17 => "Seventeen",
            18 => "Eighteen",
            19 => "Nineteen"
        );
        $tens = array(
            0 => "",
            2 => "Twenty",
            3 => "Thirty",
            4 => "Forty",
            5 => "Fifty",
            6 => "Sixty",
            7 => "Seventy",
            8 => "Eighty",
            9 => "Ninety"
        );
        $hundreds = array(
            0 => "",
            1 => "One Hundred",
            2 => "Two Hundred",
            3 => "Three Hundred",
            4 => "Four Hundred",
            5 => "Five Hundred",
            6 => "Six Hundred",
            7 => "Seven Hundred",
            8 => "Eight Hundred",
            9 => "Nine Hundred"
        );
        $hundredsAbv = array(
            "Hundred",
            "Thousand",
            "Million",
            "Billion",
            "Trillion",
            "Quadrillion"
        ); //limit t quadrillion 
        if($cr == 'N'){
            $num = number_format($num, 3, ".", ",");
        }else{
            $num = number_format($num, 2, ".", ",");
        }
        $num_arr = explode(".", $num);
        $wholenum = $num_arr[0];
        $decnum = $num_arr[1];
        $whole_arr = array_reverse(explode(",", $wholenum));
        krsort($whole_arr);
        $rettxt = "";
        foreach ($whole_arr as $key => $i) {
            if ($i < 20) {
                $i=ltrim($i,0);
                $rettxt .= $ones[$i];
            } elseif ($i < 100) {
                $i=ltrim($i,0);
                $rettxt .= $tens[substr($i, 0, 1)];
                $rettxt .= " " . $ones[substr($i, 1, 1)];
            } else {
//                $i=ltrim($i,0);
//                $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundredsAbv[0];
//                $rettxt .= " " . $tens[substr($i, 1, 1)];
//                $rettxt .= " " . $ones[substr($i, 2, 1)];
                
              $i=ltrim($i,0);
               $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundredsAbv[0];
               $tens_value = substr($i, 1, 2); 
               if($tens_value > 9 && $tens_value < 20){                    
                   $rettxt .= " " . $ones[substr($i, 1, 2)];
               }else{
                   $rettxt .= " " . $tens[substr($i, 1, 1)];
                   $rettxt .= " " . $ones[substr($i, 2, 1)];
               }  
            }
            if ($key > 0) {
                $rettxt .= " " . $hundredsAbv[$key] . " ";
            }
        }
        if ($cr == 'N') {
            $rettxt = rtrim($rettxt." Omani Rials",' ');
        } else if ($cr == 'I') {
            $rettxt = rtrim($rettxt.' US Dollars',' ');
        }
        
        if ($decnum > 0) {
            $rettxt .= " and ";
            if ($decnum < 20) {
                $rettxt .= $decones[$decnum];
            } elseif ($decnum < 100) {
                $rettxt .= $tens[substr($decnum, 0, 1)];
                $rettxt .= " " . $ones[substr($decnum, 1, 1)];
            } elseif ($decnum > 100){
                $rettxt .= $hundreds[substr($decnum, 0, 1)];
                $rettxt .= " " . $tens[substr($decnum, 1, 1)];
                $rettxt .= " " . $ones[substr($decnum, 2, 1)];
            }
            if ($cr == 'N') {
                $rettxt = $rettxt . " BAISA ";
            } else if ($cr == 'I') {
                $rettxt = $rettxt . " CENTS ";
            }
        }
        return $rettxt;
//            $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
//            // Check if there is any number after decimal
//            $amt_hundred = null;
//            $count_length = strlen($num);
//            $x = 0;
//            $string = array();
//            $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
//              3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
//              7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
//              10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
//              13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
//              16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
//              19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
//              40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
//              70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
//             $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
//             while( $x < $count_length ) {
//               $get_divider = ($x == 2) ? 10 : 100;
//               $amount = floor($num % $get_divider);
//
//            $num = floor($num / $get_divider);
//               $x += $get_divider == 10 ? 1 : 2;
//               if ($amount) {
//                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
//                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
//                $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
//                '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
//                '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
//                 }
//            else $string[] = null;
//            }
//            $implode_to_Rupees = implode('', array_reverse($string));
//            $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
//            " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
//            //return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
//            return ($implode_to_Rupees ? $implode_to_Rupees : '') . $get_paise;
    }

    public static function AmountInWordsArabic($num, $cr)
    {
        $decones = array(
            '01' => "واحد",
            '02' => "اثنان",
            '03' => "ثلاثة",
            '04' => "أربعة",
            '05' => "خمسة",
            '06' => "ستة",
            '07' => "سبعة",
            '08' => "ثمانية",
            '09' => "تسعة",
            10 => "عشرة",
            11 => "أحد عشر",
            12 => "أحد عشر",
            13 => "ثلاثة عشر",
            14 => "أربعة عشر",
            15 => "خمسة عشر",
            16 => "ستة عشر",
            17 => "سبعة عشر",
            18 => "ثمانية عشر",
            19 => "تسعة عشر	"
        );
        $ones = array(
           1 => "واحد",
            2 => "اثنان",
            3 => "ثلاثة",
            4 => "أربعة",
            5 => "خمسة",
            6 => "ستة",
            7 => "سبعة",
            8 => "ثمانية",
            9 => "تسعة",
            10 => "عشرة",
            11 => "أحد عشر",
            12 => "اثنا عشر",
            13 => "ثلاثة عشر",
            14 => "أربعة عشر",
            15 => "خمسة عشر",
            16 => "ستة عشر",
            17 => "سبعة عشر",
            18 => "ثمانية عشر",
            19 => "تسعة عشر	"
        );
        $tens = array(
            0 => "",
            2 => "عشرون",
            3 => "ثلاثون",
            4 => "أربعون",
            5 => "خمسون",
            6 => "ستون",
            7 => "سبعون",
            8 => "ثمانون",
            9 => "تسعون"
        );
        $hundreds = array(
            0 => "",
            1 => "مائة",
            2 => "مئتان",
            3 => "ثلاثمائة",
            4 => "أربعمائة",
            5 => "خمسمائة",
            6 => "ستمائة",
            7 => "سبعمائة",
            8 => "ثمانمائة",
            9 => "تسعمائة"
        );
        $hundredsAbv = array(
           "مائة",
            "أل�?",
            "مليون",
            "مليار",
            "تريليون",
            "كوادريليون"
        ); //limit t quadrillion 
        if($cr == 'N'){
            $num = number_format($num, 3, ".", ",");
        }else{
            $num = number_format($num, 2, ".", ",");
        }
        $num_arr = explode(".", $num);
        $wholenum = $num_arr[0];
        $decnum = $num_arr[1];
        $whole_arr = array_reverse(explode(",", $wholenum));
        krsort($whole_arr);
        $rettxt = "";
        foreach ($whole_arr as $key => $i) {
            if ($i < 20) {
                $i=ltrim($i,0);
                $rettxt .= $ones[$i];
            } elseif ($i < 100) {
                $i=ltrim($i,0);
                $rettxt .= $tens[substr($i, 0, 1)];
                $rettxt .= " " . $ones[substr($i, 1, 1)];
            } else {
//                $i=ltrim($i,0);
//                $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundredsAbv[0];
//                $rettxt .= " " . $tens[substr($i, 1, 1)];
//                $rettxt .= " " . $ones[substr($i, 2, 1)];
                
              $i=ltrim($i,0);
               $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundredsAbv[0];
               $tens_value = substr($i, 1, 2); 
               if($tens_value > 9 && $tens_value < 20){                    
                   $rettxt .= " " . $ones[substr($i, 1, 2)];
               }else{
                   $rettxt .= " " . $tens[substr($i, 1, 1)];
                   $rettxt .= " " . $ones[substr($i, 2, 1)];
               }  
            }
            if ($key > 0) {
                $rettxt .= " " . $hundredsAbv[$key] . " ";
            }
        }
        if ($cr == 'N') {
            $rettxt = rtrim($rettxt." الريال العماني",' ');
        } else if ($cr == 'I') {
            $rettxt = rtrim($rettxt.' الدولار الأمريكي',' ');
        }
        
        if ($decnum > 0) {
            $rettxt .= " and ";
            if ($decnum < 20) {
                $rettxt .= $decones[$decnum];
            } elseif ($decnum < 100) {
                $rettxt .= $tens[substr($decnum, 0, 1)];
                $rettxt .= " " . $ones[substr($decnum, 1, 1)];
            } elseif ($decnum > 100){
                $rettxt .= $hundreds[substr($decnum, 0, 1)];
                $rettxt .= " " . $tens[substr($decnum, 1, 1)];
                $rettxt .= " " . $ones[substr($decnum, 2, 1)];
            }
            if ($cr == 'N') {
                $rettxt = $rettxt . " بيسة ";
            } else if ($cr == 'I') {
                $rettxt = $rettxt . " سنتات ";
            }
        }
        return $rettxt;
//            $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
//            // Check if there is any number after decimal
//            $amt_hundred = null;
//            $count_length = strlen($num);
//            $x = 0;
//            $string = array();
//            $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
//              3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
//              7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
//              10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
//              13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
//              16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
//              19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
//              40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
//              70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
//             $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
//             while( $x < $count_length ) {
//               $get_divider = ($x == 2) ? 10 : 100;
//               $amount = floor($num % $get_divider);
//
//            $num = floor($num / $get_divider);
//               $x += $get_divider == 10 ? 1 : 2;
//               if ($amount) {
//                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
//                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
//                $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
//                '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
//                '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
//                 }
//            else $string[] = null;
//            }
//            $implode_to_Rupees = implode('', array_reverse($string));
//            $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
//            " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
//            //return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
//            return ($implode_to_Rupees ? $implode_to_Rupees : '') . $get_paise;
    }
    
    public function getBrowser($agent = null) {
        $u_agent = ($agent != null) ? $agent : $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/Trident/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "Trident";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');

        $pattern = '#(?<browser>' . join('|', $known) .
                ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have

        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'pattern' => $pattern
        );
    }
            
    public static function getsubscriptionDiscount($submst, $promodiscper = null)
    
    {         
          if($promodiscper)
          {
              if($submst['msm_valtospecify']== 1)
                {
                    if(strtotime($submst['msm_valto']) > time())
                    {
                        $totalamount = $submst['msm_baseprice'] - $submst['msm_discountval'];
                        $prmodiscamount = number_format(($totalamount/100)*$promodiscper['pcm_discpercent'],3);
                        $prmodiscamount = ($prmodiscamount > $promodiscper['pcm_discpercent'])? $promodiscper['pcm_discpercent']:$prmodiscamount;
                        $totalamount = $totalamount  - $prmodiscamount;  
                        $vatamount = number_format(($totalamount/100)*\Yii::$app->params['vatpercentage'],3);
                        $totalamount = $totalamount  + $vatamount;  
                        $data['vatamount'] = number_format($vatamount,3);
                        $data['promodiscval'] = number_format($prmodiscamount,3);
                        $data['promodetails'] = $promodiscper;
                        $data['discountval'] = number_format($submst['msm_discountval'],3);
                        $data['totalamount'] = number_format($totalamount,3);
                    } 
                }
                else
                {
                    $prmodiscamount = number_format(($submst['msm_baseprice']/100)*$promodiscper['pcm_discpercent'],3);
                    $prmodiscamount = ($prmodiscamount > $promodiscper['pcm_discpercent'])? $promodiscper['pcm_discpercent']:$prmodiscamount;
                    $totalamount = $submst['msm_baseprice']  - $prmodiscamount;  
                    $vatamount = number_format(($totalamount/100)*\Yii::$app->params['vatpercentage'],3);
                    $totalamount = $totalamount  + $vatamount;  
                    $data['vatamount'] = number_format($vatamount,3);
                    $data['promodiscval'] = number_format($prmodiscamount,3);
                    $data['promodetails'] = $promodiscper;
                    $data['totalamount'] = number_format($totalamount,3);
                    
                }  
              
          }
          else{
              if($submst['msm_valtospecify'] == 1)
                {
                    $vattodate = strtotime($submst['msm_valto']);
                    if($vattodate > time())
                    {
                        $totalamount = $submst['msm_baseprice'] - $submst['msm_discountval'];
                        $vatamount = number_format(($totalamount/100)*\Yii::$app->params['vatpercentage'],3);
                        $totalamount = $totalamount + $vatamount;  
                        $data['vatamount'] = number_format($vatamount,3);
                        $data['discountval'] = number_format($submst['msm_discountval'],3);
                        $data['totalamount'] = number_format($totalamount,3);
                    }
                    
                }
          }
         
          
         return $data;
    }
    public static function newRabtCode($data,$stktype = 6) {
        
        $origin_id = $data->MCM_Origin;
        
        $cid = ($origin_id == 'N') ? $data->MCM_CountryMst_Fk :$data->MCM_Source_CountryMst_Fk;
        
        $supplierid = \common\models\MembercompanymstTbl::getLastSupplierIDByCountry($cid, $origin_id ,$stktype)['MCM_SupplierCode'];
        
        if (empty($supplierid)) {
            $supplierid = '100001';
            $invID = sprintf("%05d", $supplierid);
            $invID = '1' . $invID;
        } else {
//            $pos = ($stktype == 1)? 5 : 4;
            $supsubstr = substr($supplierid, 1);
            $supplierid = "$supsubstr";
            $supplierid = ltrim($supplierid, '0');
            $supplierid = $supplierid + 1;
            $invID = sprintf("%06d", $supplierid);
        }
        
        $stkcc = ($stktype == 6)? 'S' : 'M';
        $row_ctry = \api\modules\mst\models\CountryMasterQuery::getCountryDtlByPk($cid);
        
        $ccode = $row_ctry['CyM_CountryCode_en'];
        $cc = $stkcc. $invID;
        $supplierCode = $cc;
        
        return $supplierCode;

    }
    public function newRabtRegistrationNo($stktyp = 6) {
        $row_jsrs = \common\models\MembercompanymstTbl::getLastJSRSRegistrationNo(null,$stktyp);
        
        $row_jsrsNotNull = \common\models\MembercompanymstTbl::getLastJSRSRegistrationNo('NOT NULL',$stktyp);
        $jsrsid = $row_jsrs['mcm_RegistrationNo'];
        $jsrsidNotNull = $row_jsrsNotNull['mcm_RegistrationNo'];
        
        if ($jsrsid == NULL) {
            if (count($row_jsrsNotNull) > 0) {
                $supjsrsstr = substr($jsrsidNotNull, 2);
                $supplierid = "$supjsrsstr";
                $jsrsid = ltrim($jsrsidNotNull, '0');
                $jsrsid = $jsrsidNotNull + 1;
            } else {
                $jsrsid = '10001';
            }
        } else {
            $stkcc = ($stktyp == 6)? 'S' : 'M';
            if($stkcc ==  $jsrsid[0])
            {
            $supjsrsstr = substr($jsrsid, 1);
            $supplierid = $supjsrsstr;
            $jsrsid = ltrim($supplierid, '0');
            $jsrsid = $jsrsid + 1;
            }
            else
            {
               $jsrsid = '10001'; 
            }
        }
        $newjsrs =$jsrsid;
        $stkcc = ($stktyp == 6)? 'S' : 'M';
        $jsrsinvID = sprintf("%04d", $newjsrs);
        $rabtcode =$stkcc.$jsrsinvID;
        return $rabtcode ;
    }
    public static function getSupportFile($dataArray) {    
        $data = $dataArray['selectedData'];
        $type = $dataArray['type'];
        $userPk= $data['createdby'];
        $memCompPk= $data['compPk'];
        $quantity_price= [];
        if($type == 1){
            $itemPK=$data['MemCompProdDtls_Pk'];
            $prodspec=  \common\models\MemcompprodspecdtlsTbl::getspeclist($data['MemCompProdDtls_Pk']);
            $quantity_price= \common\models\MemcompquantitypriceTblQuery::getQuantityPrice($data['MemCompProdDtls_Pk']);
            $specList = $prodspec['addmore'];
        } elseif ($type == 2){
            $itemPK=$data['MemCompServDtls_Pk'];
            $servicespec=  \common\models\MemcompspecservvaldtlsTbl::getServiceSpecArray($data['MemCompServDtls_Pk']);   
            $specList = $servicespec;
        }
       if($data['brochfile'] != null && $data['brochfile'] != ''){
           $brochfile= self::fileArray($data['brochfile'], $userPk,$memCompPk);
       }  else {
           $brochfile = ['status'=>false,'code'=>'E001','msg'=>'Record not found','data'=>[]]; 
       }
       if($data['coverimgfile'] != null && $data['coverimgfile'] != ''){
           $coverImg= self::fileArray($data['coverimgfile'], $userPk,$memCompPk);
       }  else {
           $coverImg = ['status'=>false,'code'=>'E001','msg'=>'Record not found','data'=>[]]; 
       }
       if($data['otherdocfile'] != null && $data['otherdocfile'] != ''){
           $otherdocfile= self::fileArray($data['otherdocfile'], $userPk,$memCompPk);
       }  else {
           $otherdocfile = ['status'=>false,'code'=>'E001','msg'=>'Record not found','data'=>[]]; 
       }
       if($data['innerimgfile'] != null && $data['innerimgfile'] != ''){
           $prodinnerimgfile = self::fileArray($data['innerimgfile'], $userPk,$memCompPk);
       }  else {
           $prodinnerimgfile = ['status'=>false,'code'=>'E001','msg'=>'Record not found','data'=>[]]; 
       }
       if($data['mcprd_pkgdeliveryfile'] != null && $data['mcprd_pkgdeliveryfile'] != ''){
           $pkgdeliveryfile = self::fileArray($data['mcprd_pkgdeliveryfile'], $userPk,$memCompPk);
       }  else {
           $pkgdeliveryfile = ['status'=>false,'code'=>'E001','msg'=>'Record not found','data'=>[]]; 
       }
       if($data['techdetailsfile'] != null && $data['techdetailsfile'] != ''){
           $techdetailsfile = self::fileArray($data['techdetailsfile'], $userPk,$memCompPk);
       }  else {
           $techdetailsfile = ['status'=>false,'code'=>'E001','msg'=>'Record not found','data'=>[]]; 
       }
       if($data['mcprd_prodorigin'] != null && $data['mcprd_prodorigin'] != ''){
           $originData = \api\modules\mst\models\CountrymstTblQuery::getCountryArrayData($data['mcprd_prodorigin']);
       }  else {
           $originData = ['status'=>false,'code'=>'E001','msg'=>'Record not found','data'=>[]]; 
       }
       if($data['contactinfo'] != null && $data['contactinfo'] != ''){
           $userData = \common\models\UsermstTbl::getUserDataArray($data['contactinfo']);
           $conactArray = ['status'=>false,'code'=>'S000','msg'=>'sucuss','data'=>$userData]; 
       }  else {
           $conactArray = ['status'=>false,'code'=>'E001','msg'=>'Record not found','data'=>[]]; 
       }       
       if($data['mcprd_ordercapacityunit'] != null && $data['mcprd_ordercapacityunit'] != ''){
           $unitName = \api\modules\mst\models\UnitmstTblQuery::getUnitVal($data['mcprd_ordercapacityunit']);
       }  else {
           $unitName = ['status'=>false,'code'=>'E001','msg'=>'Record not found','data'=>[]]; 
       }       
       if($data['unittype'] != null && $data['unittype'] != ''){
           $unitType = \api\modules\mst\models\UnitmstTblQuery::getUnitVal($data['unittype']);
       }  else {
           $unitType = ['status'=>false,'code'=>'E001','msg'=>'Record not found','data'=>[]]; 
       }      
        
       
       $prodmarketing = ['NIL','Direct Sales', 'Distributor Network', 'eCommerce', 'Others'];
        $getBusinessSource = \common\models\MemcompprodbussrcmapTblQuery::getBusinessSourceWithFile($itemPK,$type);
        $selected_branch = \common\components\Profile::prodbranchlist($itemPK,($type==1 ? 'P' : 'S'),'common');
        $faqData= \api\modules\pd\models\ProjfaqdtlsTblQuery::faqdtls($itemPK);
        $faqData=json_decode($faqData,true);
        $rdata = ['status'=>true,'code'=>'S000','msg'=>'sucuss','brochfile'=>$brochfile,'coverImg'=>$coverImg,'otherdocfile'=>$otherdocfile,'prodinnerimgfile'=>$prodinnerimgfile,'conactArray'=>$conactArray,'businessSource'=>$getBusinessSource,'prodspec'=>$specList,'originData'=>$originData,'unitName'=>$unitName['unm_namesg_en'],'pkgdeliveryfile'=>$pkgdeliveryfile,'unitType'=>$unitType['unm_namesg_en'],'techdetailsfile'=>$techdetailsfile,'faqData'=>$faqData['data'],'quantity_price'=>$quantity_price,'selectedbranches'=>$selected_branch['selectedbranches'],'selectedfatory'=>$selected_branch['selectedfactory'],'prodmarketing'=>$data['mcprd_prodmarketing'] ? $prodmarketing[$data['mcprd_prodmarketing']] : 'NIL']; 
        return $rdata;
    }
    public static function fileArray($data, $userPk,$memCompPk) {
        $docDataArray=[];
        $DataPk=  explode(',', $data);
        foreach ($DataPk as $val){
            $memcompfile_pk =$val;
            $memcomp_pk = $memCompPk;
            $user_pk = $userPk;
            $img_path = Drive::generateUrl($memcompfile_pk, $memcomp_pk, $user_pk);
            $docVal['image_url'] = $img_path;
            $filename = Drive::getFileName(Security::encrypt($memcompfile_pk));
            $filenamearray = explode('.', $filename);
            $docVal['fileName'] = $filename;
            $docVal['fileType'] = end($filenamearray);
            $docDataArray[]=$docVal;
        }
        $rdata = ['status'=>true,'code'=>'S000','msg'=>'sucuss','data'=>$docDataArray]; 
        return $rdata;
    }

    public static function requestCount($count){
        $status = 'false';
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

    public static function ymdhms_to_dmyhms($date){
        $result=date('d-m-Y H:i:s',strtotime($date));
        return $result;
    }
    public static function ymdhms_to_dmy($date){
        if(!empty($date)){
            $result=date('d-m-Y',strtotime($date));
            return $result;
        }else{
            return '-';
        }
    }
    public static function ymdhms_to_ymd($date){
        $result=date('Y-m-d',strtotime($date));
        return $result;
    }
    public static function ymdhms_to_hampm($date){
        if(!empty($date))
            $result=date('h:i A',strtotime($date));
        else
            $result='';
        return $result;
    }
    public static function dmyhms_to_ymdhms($date){
        $result=date('Y-m-d H:i:s',strtotime($date));
        return $result;
    }

    public static function getCompanyDataByRegisterPk($memberRegisterPk){
        if(empty($memberRegisterPk && !is_numeric($memberRegisterPk))){
            return FALSE;
        }
        $memberCompanyData = \Yii::$app->db->createCommand()
                       ->select('*')
                       ->from('membercompanymst_tbl')
                       ->where('MCM_MemberRegMst_Fk=:memberRegisterPk', array(':memberRegisterPk'=>$memberRegisterPk))
                       ->queryRow();    
        return $memberCompanyData;
    }
    public static function getusdbyomr($omr) {
        $currency_convert_amt = Yii::$app->params['omr_currency_convert_amt_for_usd'];
        return $usd = number_format($omr*$currency_convert_amt,2, '.', '');
    }
    public static function getomrbyusd($usd) {
        $currency_convert_amt = Yii::$app->params['omr_currency_convert_amt_for_usd'];
       return $omr = number_format($usd*1/$currency_convert_amt,3, '.', '');
    }
    public static function getusdbyomrWithoutFormat($omr) {
        $currency_convert_amt = Yii::$app->params['omr_currency_convert_amt_for_usd'];
        return $usd = number_format($omr*$currency_convert_amt,2, '.', '');
    }
    public static function getomrbyusdWithoutFormat($usd) {
        $currency_convert_amt = Yii::$app->params['omr_currency_convert_amt_for_usd'];
       return $omr = $usd*1/$currency_convert_amt;
    }
    public static function getusdbyomrfortxt($omr) {
        $currency_convert_amt = Yii::$app->params['omr_currency_convert_amt_for_usd'];
        return $usd = $omr*$currency_convert_amt;
    }
    public static function numberToWord($num, $cr) {
        $decones = array(
            '01' => "One",
            '02' => "Two",
            '03' => "Three",
            '04' => "Four",
            '05' => "Five",
            '06' => "Six",
            '07' => "Seven",
            '08' => "Eight",
            '09' => "Nine",
            10 => "Ten",
            11 => "Eleven",
            12 => "Twelve",
            13 => "Thirteen",
            14 => "Fourteen",
            15 => "Fifteen",
            16 => "Sixteen",
            17 => "Seventeen",
            18 => "Eighteen",
            19 => "Nineteen"
        );
        $ones = array(
            0 => " ",
            1 => "One",
            2 => "Two",
            3 => "Three",
            4 => "Four",
            5 => "Five",
            6 => "Six",
            7 => "Seven",
            8 => "Eight",
            9 => "Nine",
            10 => "Ten",
            11 => "Eleven",
            12 => "Twelve",
            13 => "Thirteen",
            14 => "Fourteen",
            15 => "Fifteen",
            16 => "Sixteen",
            17 => "Seventeen",
            18 => "Eighteen",
            19 => "Nineteen"
        );
        $tens = array(
            0 => "",
            2 => "Twenty",
            3 => "Thirty",
            4 => "Forty",
            5 => "Fifty",
            6 => "Sixty",
            7 => "Seventy",
            8 => "Eighty",
            9 => "Ninety"
        );
        $hundreds = array(
            0 => "",
            1 => "One Hundred",
            2 => "Two Hundred",
            3 => "Three Hundred",
            4 => "Four Hundred",
            5 => "Five Hundred",
            6 => "Six Hundred",
            7 => "Seven Hundred",
            8 => "Eight Hundred",
            9 => "Nine Hundred"
        );
        $hundredsAbv = array(
            "Hundred",
            "Thousand",
            "Million",
            "Billion",
            "Trillion",
            "Quadrillion"
        ); //limit t quadrillion 
        if($cr == 'N'){
            $num = number_format($num, 3, ".", ",");
        }else{
            $num = number_format($num, 2, ".", ",");
        }
        $num_arr = explode(".", $num);
        $wholenum = $num_arr[0];
        $decnum = $num_arr[1];
        $whole_arr = array_reverse(explode(",", $wholenum));
        krsort($whole_arr);
        $rettxt = "";
        foreach ($whole_arr as $key => $i) {
            if ($i < 20) {
                $rettxt .= $ones[$i];
            } elseif ($i < 100) {
                $rettxt .= $tens[substr($i, 0, 1)];
                $rettxt .= " " . $ones[substr($i, 1, 1)];
            } else {
                $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundredsAbv[0];
                $rettxt .= " " . $tens[substr($i, 1, 1)];
                $rettxt .= " " . $ones[substr($i, 2, 1)];
                
            }
            if ($key > 0) {
                $rettxt .= " " . $hundredsAbv[$key] . " ";
            }
        }
        if ($cr == 'N') {
            $rettxt = rtrim("Omani Rial ".$rettxt,' ');
        } else if ($cr == 'I') {
            $rettxt = rtrim('US Dollar '. $rettxt,' ');
        }
        
        if ($decnum > 0) {
            $rettxt .= " and ";
            if ($decnum < 20) {
                $rettxt .= $decones[$decnum];
            } elseif ($decnum < 100) {
                $rettxt .= $tens[substr($decnum, 0, 1)];
                $rettxt .= " " . $ones[substr($decnum, 1, 1)];
            } elseif ($decnum > 100){
                $rettxt .= $hundreds[substr($decnum, 0, 1)];
                $rettxt .= " " . $tens[substr($decnum, 1, 1)];
                $rettxt .= " " . $ones[substr($decnum, 2, 1)];
            }
            if ($cr == 'N') {
                $rettxt = $rettxt . " BAISA ";
            } else if ($cr == 'I') {
                $rettxt = $rettxt . " CENTS ";
            }
        }
        return $rettxt;
    }
    public function getVATAmount($amount, $vat_percent){
        $vat_amount = 0;
        if($vat_percent>0 && $vat_percent!=0){
            $vat_amount = ($amount * ($vat_percent / 100));
        }
        return $vat_amount;
    }
    public function generateInvoiceNo($type='INV',$mode='PER',$invoice_pk=''){
        if($mode!='PER'){
            $inv_running_no = self::getRunningInvNo($type);
        }else{
            $inv_running_no = $invoice_pk;
        }
        $prefix = \Yii::$app->params['VAT']['invno_nomenclature'];
        $gen = $prefix.strtoupper(date('M'))."-".$type."-".$inv_running_no."-".date('y');
        return $gen;
    }
    public function getRunningInvNo($type){        
        $date = date('Y-m-01');
        $seq_qry=  \common\models\SequencegenTbl::find()->where("sg_type='$type' and sg_date='$date'")->one();
        if(!empty($seq_qry) && count($seq_qry)>0){
            $db_number = $seq_qry->sg_number;
            $running_no = $db_number + 1;
        }else{
            $running_no = '10001';
        }        
        return $running_no;
    }
    public function updateInvoiceNo($type) {
        $date = date('Y-m-01');
        $seq_qry = \common\models\SequencegenTbl::find()->where("sg_type='$type' and sg_date='$date'")->one();
        if (!empty($seq_qry) && count($seq_qry) > 0) {
            $db_number = $seq_qry->sg_number;
            $running_no = $db_number + 1;
            $seq_qry->sg_number = $running_no;
            $seq_qry->sg_latesttime = date('Y-m-d H:i:s');
            $seq_qry->save();
        } else {
            $running_no = 10001;
            $model = new \common\models\SequencegenTbl;
            $model->sg_date = $date;
            $model->sg_type = $type;
            $model->sg_number = $running_no;
            $model->sg_latesttime = date('Y-m-d H:i:s');
            $model->save();
        }
    }
    public function getInvoiceName($ref_no, $date){
        $time = strtotime($date);
        $invoice_name = $ref_no."-".$time.".pdf";
        return $invoice_name;
    }
    public function get_USD_Details($amt_in_OMR)
    {
        $rData = ['amt_in_USD'=>'0','amt_in_USD_withFormat'=>'0.00'];
        if(!empty($amt_in_OMR) && is_numeric($amt_in_OMR)){
            $rData['amt_in_USD'] = self::getusdbyomrWithoutFormat($amt_in_OMR);
            $rData['amt_in_USD_withFormat'] = self::getusdbyomr($amt_in_OMR);
        }
        return $rData;
    }
    public function getTargetAmount($amount, $origin='N')
    {
        if($origin=='N'){
            $amount= !empty($amount)?'USD '.number_format($amount, 2).'(OMR '.self::getomrbyusd($amount).')':'NIL';
        }else{
            $amount = !empty($amount) ? 'USD ' . number_format($amount, 2) : 'NIL';
        }
        return $amount;
    }
    public function getPaymentAmounts($total_amount, $vat_percent, $tot_vat_amt, $origin='N'){
        $addi_charge = Yii::$app->params['additional_processing_charge'];        
        $addi_charge_international = Yii::$app->params['additional_processing_charge_international'];        
        if ($origin == 'N') {
            $addi_charge_international=0;
            $Omramount =number_format($total_amount,3, '.', '');
            $Amountpercent = number_format(($total_amount / 100) * $addi_charge, 3, '.', '');
            $vat_percent = (!empty($vat_percent))? number_format($vat_percent,0): '0';
            $tot_vat_amt = (!empty($tot_vat_amt))? number_format((float) $tot_vat_amt, 3): '0.000';
            $totalamount=number_format($Amountpercent+$Omramount+$tot_vat_amt,3, '.', '');
            $totalamount_WO_ProcessingFee=number_format($Omramount+$tot_vat_amt,3, '.', '');
        }else{
            $Omramount =number_format($total_amount,2, '.', '');
            $OnlineProcessingFeeIn_OMR = ($Omramount / 100) * $addi_charge;
            $Amountpercent = number_format($OnlineProcessingFeeIn_OMR,2, '.', '');
            $addi_charge_international = number_format($addi_charge_international,2, '.', '');
            $vat_percent = (!empty($vat_percent))? number_format($vat_percent,0): '0';
            $tot_vat_amt = (!empty($tot_vat_amt))? number_format((float) $tot_vat_amt, 2): '0.00';
            $totalamount=number_format($total_amount+$OnlineProcessingFeeIn_OMR+$tot_vat_amt,2, '.', '');
            $totalamount_international=number_format($total_amount+$addi_charge_international+$tot_vat_amt,2, '.', '');
            $totalamount_WO_ProcessingFee=number_format($total_amount+$tot_vat_amt,2, '.', '');
        }
        $rData['omramount'] = $Omramount;
        $rData['vat_percent'] = $vat_percent;
        $rData['vat_amount'] = $tot_vat_amt;
        $rData['processing_fee'] = $addi_charge;
        $rData['processing_fee_amt'] = $Amountpercent;
        $rData['processing_fee_international'] = $addi_charge_international;
        $rData['totalamount_wo_processingfee'] = $totalamount_WO_ProcessingFee;
        $rData['totalamount_international'] = $totalamount_international;
        $rData['totalamount'] = $totalamount;
        return $rData;
    }
    public function getSupplierRenewStatus($renewal_status, $comp_pk){
        $suppcertdtls = \common\models\SuppcertformmembdtlsTbl::find()->where("scfmd_membercompmst_fk=:comp_pk", [':comp_pk'=>$comp_pk])->one();
        if($renewal_status==null || $renewal_status=='NE'){
            $status = 'Fresh';
        }else{
            $status = 'Renewal';
        }
        if(!empty($suppcertdtls)){
            $scf_renewal_status = $suppcertdtls['scfmd_renewalstatus'];
            if($scf_renewal_status==1 && $renewal_status=='NE'){
                $status = 'Renewal';
            }
        }
        return $status;
    }
    public function getModuleName($module) {
        switch ($module) {
            case 1:
                return 'REG';
            case 2:
                return 'RENEW';
            case 3:
                return 'GCC';
            case 4:
                return 'CMS';
            default :
                return '';
        }
    }
    public function get_client_ip() {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        $ipadd=explode(',',$ipaddress);
        if(count($ipadd)>1){
            return $ipadd[0];
        }else{
            return $ipadd[0];
        }
    }
    public function checkTimeDiffernce($gen_date, $extend_time='90') {
        date_default_timezone_set('Asia/Muscat');
        $dbDatetry = date('Y-m-d H:i:s', strtotime($gen_date . '+'.$extend_time.' minutes'));
        $date1 = new \DateTime();
        $date2 = new \DateTime($dbDatetry);      
        $datetime1 = $date2->diff($date1);
        $checkToClearBolean = ($datetime1->invert===1) ? true : false;
        return $checkToClearBolean;
        
    }
    public function getModuleValues($key) {
        switch ($key) {
            case 'REG':$value = 1;
                break;
            case 'RENEW':$value = 2;
                break;
            case 'CMS':$value = 4;
                break;
            case 'GCC':$value = 5;
                break;
            case 'TENDER':$value = 3;
                break;
            case 'PERMIT':$value = 6;
                break;
            default: $value = $key;
                break;
        }
        return $value;
    }
    public function getOttuCCLink($comp_pk,$user_pk,$module_type,$payment_platform) {
        $cc_link = [];
        $credit_link = \common\models\PymtplatformdtlsTbl::find()
            ->select("pymtplatformdtls_pk,ppfd_pymtlink,ppfd_generatedon")
            ->where('ppfd_membercompmst_fk=:comPk and ppfd_usermst_fk = :userPk and ppfd_module = :module and ppfd_paymentplatform = :pymtplatform and ppfd_linkstatus = :linkstatus and ppfd_linkfor = :linkfor', [':comPk'=>$comp_pk,':userPk' => $user_pk,':module'=>$module_type,':pymtplatform'=>$payment_platform,':linkstatus'=>1,':linkfor'=>2])
            ->orderBy(['pymtplatformdtls_pk' => SORT_DESC])
            ->asArray()->one(); 
        if(!empty($credit_link)){
            $cc_link = $credit_link;
        }
        return $cc_link;
    }
    public function getOttuDCLink($comp_pk,$user_pk,$module_type,$payment_platform) {
        $dc_link = [];
        $debit_link = \common\models\PymtplatformdtlsTbl::find()
            ->select("pymtplatformdtls_pk,ppfd_pymtlink,ppfd_generatedon")
            ->where('ppfd_membercompmst_fk=:comPk and ppfd_usermst_fk = :userPk and ppfd_module = :module and ppfd_paymentplatform = :pymtplatform and ppfd_linkstatus = :linkstatus and ppfd_linkfor = :linkfor', [':comPk'=>$comp_pk,':userPk' => $user_pk,':module'=>$module_type,':pymtplatform'=>$payment_platform,':linkstatus'=>1,':linkfor'=>1])
            ->orderBy(['pymtplatformdtls_pk' => SORT_DESC])
            ->asArray()->one(); 
        if(!empty($debit_link)){
            $dc_link = $debit_link;
        }
        return $dc_link;
    }
    public function saveOttuPaymentLink($data){
        date_default_timezone_set('Asia/Muscat');
        $module_type = self::getModuleValues($data['module_type']);
        $model = new \common\models\PymtplatformdtlsTbl;
        $model->ppfd_membercompmst_fk = $data['comppk'];
        $model->ppfd_usermst_fk = $data['userpk'];
        $model->ppfd_module = $module_type; 
        $model->ppfd_paymentplatform = $data['payment_platform']; 
        $model->ppfd_pymtlink = $data['payment_link']; 
        $model->ppfd_linkstatus = $data['linkstatus']; 
        if($data['payment_platform']==1){
            $model->ppfd_linkfor = $data['linkfor']; 
        }
        $model->ppfd_generatedon = date('Y-m-d H:i:s');
        if(!$model->save()){
            echo "<pre>";
            print_r($model->getErrors());
            exit;
        }else{
            return $model->ppfd_generatedon;
        }
    }
    public function updateOttuLinkStatus($link_id,$status){
        $model = \common\models\PymtplatformdtlsTbl::findOne($link_id);
        $model->ppfd_linkstatus = $status;
        $model->save();
    }
    public static function Pdoexportskip(){
        $skipid='17,17488,17374,400,17797,17576';
        return $skipid;
    }
    public static function maskemail($email){
        
        
        list($first, $last) = explode('@', $email);
        $first = str_replace(substr($first, '3'), str_repeat('*', strlen($first)-3), $first);
        $last = explode('.', $last);
        $last_domain = str_replace(substr($last['0'], '1'), str_repeat('*', strlen($last['0'])-1), $last['0']);
        $hideEmailAddress = $first.'@'.$last_domain.'.'.$last['1'];
        
        return $hideEmailAddress;
        
      
    }
    public static function maskmobilenum($number){
        return substr($number, 0, 2) . '******' . substr($number, -2);
      
    }
    
    public static function sendMobileVerifyOtp($msg, $to, $lang,$type=null) {
//        $to=97335632;
        return true;
        if(in_array(Yii::$app->params['NSSENV'],['local','demo'])){
            $to='95467964';
        }
        if(in_array($to, ['92534289'])){
            return '00';
        }else{
            if (\Yii::$app->params['sms']['Ooredoo']) {
                $api = 'Ooredoo';
                $sms = SmsWS::getInstance();
                $smsts = $sms->sendSms($msg, $to);
                $msgstscode = $smsts;
                $msgsts = self::smsSts($smsts);
            }else if (\Yii::$app->params['sms']['iBulkSMS']) {
                $api='iBulkSMS';
                $msgencode = urlencode($msg);
                $lang=64;
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER  =>  true,
                    CURLOPT_HEADER          =>  false,
                    CURLOPT_FOLLOWLOCATION  =>  true,
                    CURLOPT_USERAGENT       =>  "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)",
                    CURLOPT_URL => "https://www.ismartsms.net/iBulkSMS/HttpWS/SMSDynamicAPI.aspx?UserId=businessws&Password=Business@107&MobileNo=$to&Message=$msgencode&Lang=$lang&FLashSMS=n", //FLashSMS
                    CURLOPT_SSL_VERIFYHOST  =>  false,
                    CURLOPT_SSL_VERIFYPEER  =>  false,
                    CURLOPT_POST            =>  0,
                ));
                $resp = curl_exec($curl);
                if (curl_errno($curl)) {
//            echo 'error:' . curl_error($curl);
                }else{
                    $msgstscode = $resp;
                    $msgsts = self::smsstatus($resp);
                }
            }
            if(\Yii::$app->params['smslog']){
                $data.='API: '.$api.PHP_EOL;
                $data.='To: '.$to.PHP_EOL;
                $data.='Language: '.$lang.PHP_EOL;
                $data.='Messgage: '.$msg.PHP_EOL;
                $data.='StatusCode: '.$msgstscode.PHP_EOL;
                $data.='Status: '.$msgsts.PHP_EOL;
                $path = './sms/send/';
                $d=date('Y-m-d');
                if(!is_dir($path)){
                    mkdir($path, 0777, true);
                }
                $request=file_put_contents($path.'smsmessges.txt', $data.PHP_EOL , FILE_APPEND | LOCK_EX);
            }
            if(is_null($type))
                Secure::insertOtpAttempt();
            return $msgstscode;
           
        }
    }
    public static function commaSeparatedwithLastAmpersand($data){
        $last  = array_slice($data, -1);
        $first = join(', ', array_slice($data, 0, -1));
        $returnData  = array_filter(array_merge(array($first), $last), 'strlen');
        return join(' & ', $returnData);
    }
    
    public static function mergeDateAndTime($date, $time)
 {
        
      
        $data['date'] = isset($date) ? date('Y-m-d', ($date / 1000)) : NULL;
        $data['time'] = isset($time) ? date('H:i:s', ($time / 1000)) : NULL;
        
     
        if ($data['date'] && $data['time']) {
            return $data['date'] . ' ' . $data['time'];
        } else {
            return null;
        }
    }
    
    public static function convertTime($dec) {
        $hour = floor($dec);
        $min = round(60 * ($dec - $hour));

        return $hour . ':' . $min;
    }
    public function generateInvoiceNumber($type='INV',$opal_reg_no,$shortkey,$invoicePk){
        $curr_year = date('Y');
        $invoice_no = $type.'-'.$opal_reg_no.'-'.$shortkey.'-'.$curr_year.'-'.$invoicePk;
        return $invoice_no;
    }

    public function compress($source, $destination){
        $quality = 50;
        $info = getimagesize($source); 
        if($info['mime'] == 'image/jpeg'){
            $image = imagecreatefromjpeg($source);
            imagejpeg($image, $destination, $quality);
        }
        if ($info['mime'] == 'image/png'){
            $image = imagecreatefrompng($source);
        
            $input = imagecreatefrompng($source);
            list($width, $height) = getimagesize($source);
            $output = imagecreatetruecolor($width, $height);
            $white = imagecolorallocate($output,  255, 255, 255);
            imagefilledrectangle($output, 0, 0, $width, $height, $white);
            imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
            imagejpeg($output, $destination, $quality);
        }
        imagedestroy($image);
    }

}


