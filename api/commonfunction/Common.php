<?php
namespace app\commonfunction;

use Yii;
use yii\helpers\Url;
use app\modules\nbf\models\MembercompanymstTbl;
use yii\db\ActiveRecord;
use app\commonfunction\Security;

class Common extends \yii\base\BaseObject
{

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
        'sm' =>  'socialmediamst_tbl',
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
        'MCPD' => 'memcompprofiledtls',
        'MCPSD' => 'memcompprodspecdtls',
        'MCTBRSGD' => 'mctbrsecgrddtls',
        'MCM' => 'membercompanymst',
        'MCGD' => 'memcompgendtls',
        'MCLPD' => 'memcomplookoutproddtls',
        'MCLSD' => 'memcomplookoutservdtls',
        'MCMP' => 'memcompmarketpresencedtls',
        'MCPrD' => 'memcompproddtls',
        'MCPAvD' => 'memcompprofachvdtls',
        'MCPCD' => 'memcompprofcertfdtls',
        'MCPASD' => 'memcompprofsuppattdtls',
        'MCSD' => 'memcompsectordtls',
        'MCSvD' => 'memcompservicedtls',
        'mcad' => 'memcompacomplishdtls',
        'mcpsap_' => 'memcompprodservagentsprncp',
        'mcsp_' => 'memcompservprncp',
        'UPT_' => 'userpermtrn',
        'MCSSD_' => 'memcompservspecdtls',
        'UM' => 'usermst',
        'ISM' => 'incorpstylemst_tbl',
        'bicc' => 'bgiindcodecateg_tbl',
        'bicsc' => 'bgiindcodesubcateg_tbl',
        'bicpm' => 'bgiinduscodeprodmst_tbl',
        'bicsm' => 'bgiinduscodeservmst_tbl',
        'ed'=>'eventsdtl_tbl',
        'wd'=>'webinardtls_tbl',
        'ndt'=>'newsdtl_tbl',
        'sham' => 'stkholderaccessmst_tbl',
        'lpm' => 'licproceduremst_tbl',
        'ssm' => 'subsectormst_tbl',
        'prjd' => 'projectdtls_tbl',
        'li' => 'licensinginfo_tbl',
        'frm'=>'formmst_tbl',
        'fcm'=>'formcategorymst_tbl',
        'wfm'=>'workflowmgmt_tbl',
        'bmm'=>'basemodulemst_tbl',
        'shm'=>'stkholdertypmst_tbl',
        'MCM'=>'membercompanymst_tbl',
        'UM'=>'usermst_tbl',



    );



    public static function getTableWithPrefix($field, $tblwithfield = false)
    {

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
//        print_r(getcwd());die;
        $regPk = ActiveRecord::getTokenData('MCM_MemberRegMst_Fk',true);
        $filename = $file['file']['name']; 
        $tempnname = $file['file']['tmp_name']; 
        $target_path = getcwd()."/web/uploads/suppliers/".$regPk."/".$data['dmsCategory']; 
        $file_size = $file['file']['size'];
        $file_extension = strtolower(pathinfo($filename,PATHINFO_EXTENSION)); 
        $extensions = ['jpg', 'png', 'jpeg', 'gif', 'doc', 'pdf', 'flv']; 
        $type = $data['type'];

        if (!empty($file) && !empty($data['dmsSize'])) {
            if (in_array($file_extension, $extensions)) { 
                // if (self::chkMime($file_extension, $target_path . basename($filename))) {
                /* @var $file_size type */
                if ($data['dmsSize'] >= $file_size) {
                        if ($data['temp'] === 1) {  
                             $temp_path = $_SERVER['DOCUMENT_ROOT']."/v3/temp/"; 
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
                            $jsonArr['file_name'] = Common::generateFileName($filename,null,false);
                            $jsonArr['original_name'] = $filename;
                            $jsonArr['file_size'] = $file_size;
                            $jsonArr['file_type'] = $type;
                            $upload = \app\modules\nbf\models\MemcompfiledtlsTblQuery::saveFiles($jsonArr,$data);
                            $jsonArr['file_name'] = $upload['dbFileName'];
                            $target_path = $target_path."/" . $jsonArr['file_name'];
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

    public function file_upload_temp($data,$file){ 
        $companyPk = ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $userPk = ActiveRecord::getTokenData('UserMst_Pk',true);
        $filename = $file;  
        $temppath = $data['temppath']."$file";   
        $target_path = $data['dmsBasePath']."comp_".$companyPk."/user_".$userPk."/";
        $file_size = filesize($temppath);
        $file_extension = strtolower(pathinfo($filename,PATHINFO_EXTENSION)); 
        $extensions = ['jpg', 'png', 'jpeg', 'gif', 'doc', 'pdf', 'flv'];        
        if (!empty($file) && !empty($data['dmsBasePath']) && !empty($data['dmsSize']) && !empty($data['dmsTableName'])) {
          if(in_array($file_extension,$extensions)){
            //   if (self::chkMime($file_extension,$file)){
                  if ($data['dmsSize'] >= $file_size) {
                      if (!file_exists($target_path)) {
                          mkdir($target_path, 0777, true);
                      } 
                      $target_path = $target_path . basename($filename); 

                      if (rename($temppath,$target_path)) { 
                              $tblname = explode(",", $data['dmsTableName']);
                              $modelname = CommonDb::getModelname($tblname[0]);
                              $upload = $modelname::singleUpload($filename, $tblname[0], $tblname[1], $modelname);
                            //   unlink($temppath);
                              return $upload;
                      } else { 
                          return [
                              "msg" => "Error uploading your file to db",
                              "status" => 0
                          ];
                      }
                  }else {
                      return [
                          "msg" => "The file exceeds the allowed size " . $data['size'],
                          "status" => 0
                      ];
                  }
            //   }else {
            //       return [
            //           "msg" => "Invalid file",
            //           "status" => 0
            //       ];
            //   }
          }else {
            return [
                "msg" => "This file type is not  allowed",
                "status" => 0
            ];
        }
        }else {
            return [
                "msg" => "Please specify the target path, extensions and size",
                "status" => 0
            ];
        }
    }

    public function getfilemod()
    {
    
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
                $date = date('d-m-y H:i',filemtime($filename));
                $jsondecode['msg'] = "success";
                $jsondecode['status'] = 1;
                $jsondecode[$file_extension[0]] = $data;
                $jsondecode[$file_extension[0]]['date'] = $date;
            }
        }

        return $jsondecode;
    }

    function chkMime($ext,$file){ 
        $mime_typ=array('png' => 'image/png',
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
            'ps' => 'application/postscript');
            
        $mime=mime_content_type($file); 
        if($mime_typ[$ext]==$mime){ 
            return true;
        } 
    }
    
    public function generateFileName($name,$pk,$bool = false) {
        $userpk = ActiveRecord::getTokenData('UserMst_Pk',true);
        $pathinfo = pathinfo($name); 
        $filename = str_replace($pathinfo['filename'], time() . rand(), $pathinfo['filename']);
        if (empty($filename)) {
            $filename = rand(10, 999) . date('Ymdi');
        }
        $ext = strtolower($pathinfo['extension']);
        if($bool){
            return "pub_$userpk"."_"."$pk"."[[]]".$filename.'_'.$pk . '.' . $ext;
        }else{
            return $filename.".". $ext;
        }
    }

    public static function encrypt($key)
    {
        return Security::base64_encrypt_str($key,'atomicka');
    }
    public static function decrypt($key)
    {

        return Security::base64_decrypt_str($key,'atomicka');
    }
    
}