<?php
namespace app\commonfunction;

use Yii;
use yii\helpers\Url;
use app\modules\nbf\models\MembercompanymstTbl;
use yii\db\ActiveRecord;
use app\commonfunction\Security;

class Util
{
    //function to get the file size in kilo bytes
    function formatSizeUnits($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
        return $bytes;
    }
    function base64ToImage($base64_string, $output_file) {
        
        $file = fopen($output_file, "wb");

        $data = explode(',', $base64_string);

        fwrite($file, base64_decode($data[1]));
        fclose($file);

        return $output_file;
    }
    function getFileStorageDirectory() {
        $loginType='S';//From Session
        $regPk=1;//From Session
        $directory='web/uploads/';
        if($loginType=='S'){
            $directory.='suppliers/supplier_'.$regPk.'/';
        }elseif($loginType=='O'){
            $directory.='operators/operator_'.$regPk.'/';
        }else{
            $directory.='others/supplier_'.$regPk.'/';
        }

        return $directory;
    }

}