<?php
namespace api\components;

use api\components\Security;
use api\models\MemcompfiledtlsTbl;
use Yii;
use yii\base\BaseObject;

class Drive extends BaseObject
{

    public static function generateUrl($fileDtlsPk,$compPk,$usrPk,$track=false){
        $fileDtlsPk = Security::encrypt($fileDtlsPk);
        $compPk = Security::encrypt($compPk);
        $usrPk = Security::encrypt($usrPk); 
        $track = Security::encrypt($track);
        return \Yii::$app->urlManager->createAbsoluteUrl(['/drv/drive/view?f='.$fileDtlsPk.'&c='.$compPk.'&u='.$usrPk.'&t='.$track]);   
    }
    
    public static function getFileName($fileDtlsPk){
        $fileDtlsPk = Security::decrypt($fileDtlsPk);
        return MemcompfiledtlsTbl::getFileNameByPk($fileDtlsPk);
    }
    public static function getFileType($fileDtlsPk){
        $fileDtlsPk = Security::decrypt($fileDtlsPk);
        return MemcompfiledtlsTbl::getFileTypeByPk($fileDtlsPk);
    }

    public static function logDelete($fileDtlsPk){
    
    $fileDetails=\common\models\MemcompfiledtlsTbl::findOne($fileDtlsPk);
    if(!empty($fileDetails)){            
        $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
        $descText="Deleted the {$fileDetails->masters->fm_filelabel}, {$fileDetails->mcfd_origfilename}.";
        \common\components\UserActivityLog::logUserActivity(3,$descText,$url,$fileDetails->masters->fm_modulemst_fk);
    }
    
    }

    public static function getfiledetails($filePk, $companyPk) {
        if($filePk) {
            return \common\models\MemcompfiledtlsTbl::getFileDetailsByPk($filePk, $companyPk);
        }
    }

    public static function getAbsFilePath($fileDtlsPk){
        $fileDetails=MemcompfiledtlsTbl::find()->where('memcompfiledtls_pk=:filedtlspk',[':filedtlspk'=>$fileDtlsPk])->one();
        
       
		$directory=$fileDetails->masters->fm_phyfilepath;
        $file = $fileDetails->mcfd_sysgenerfilename;
        $srcDirectory=Yii::$app->params['baseMailPath'];
        $userDirectory="comp_".$fileDetails->mcfd_opalmemberregmst_fk."/user_".$fileDetails->mcfd_uploadedby;
        $uploadPath=  \Yii::$app->params['uploadPath'];
        $originalImageDirectory = $srcDirectory.$uploadPath."/".$userDirectory. '/' . $directory.'/';
		$download_path = $originalImageDirectory.'/'.$file;
        return $download_path;
    }
    public static function getrelativepath($fileDtlsPk){
        $fileDetails=\common\models\MemcompfiledtlsTbl::find()->where('memcompfiledtls_pk=:filedtlspk',[':filedtlspk'=>$fileDtlsPk])->one();
		$directory=$fileDetails->masters->fm_phyfilepath;
        $file = $fileDetails->mcfd_sysgenerfilename;
        $srcDirectory=Yii::$app->params['baseMailPath'];
        $userDirectory="comp_".$fileDetails->mcfd_memcompmst_fk."/user_".$fileDetails->mcfd_uploadedby;
        
        $uploadPath=  \Yii::$app->params['uploadPath'];
        $originalImageDirectory = $srcDirectory.$uploadPath."/".$userDirectory. '/' . $directory.'/';
         $relativepath = $uploadPath."/".$userDirectory. '/' . $directory.'/'.$file;
         
        return $relativepath;
    }
}