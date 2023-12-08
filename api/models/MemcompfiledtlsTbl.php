<?php

namespace api\models;

use Yii;
use app\models\OpalusermstTbl;
use app\models\OpalmemberregmstTbl;

/**
 * This is the model class for table "memcompfiledtls_tbl".
 *
 * @property string $memcompfiledtls_pk
 * @property int $mcfd_filemst_fk Reference to filemst_tbl
 * @property int $mcfd_opalmemberregmst_fk Reference to membercompanymst_tbl
 * @property string $mcfd_origfilename Original file name as given by the user
 * @property string $mcfd_sysgenerfilename System generated file name. Generated like currentdatetime with random number to avoid ambiguity
 * @property string $mcfd_filetype File types such as pdf, xlsx, doc to be stored
 * @property string $mcfd_uploadedon Datetime of upload
 * @property int $mcfd_uploadedby Reference to usermst_tbl
 * @property int $mcfd_actualfilesize Actual file size
 * @property int $mcfd_isdeleted If the file is deleted then 1 else 2
 */
class MemcompfiledtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompfiledtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcfd_filemst_fk', 'mcfd_opalmemberregmst_fk', 'mcfd_origfilename', 'mcfd_sysgenerfilename', 'mcfd_filetype', 'mcfd_uploadedon', 'mcfd_uploadedby', 'mcfd_actualfilesize', 'mcfd_isdeleted'], 'required'],
            [['mcfd_filemst_fk', 'mcfd_opalmemberregmst_fk', 'mcfd_uploadedby', 'mcfd_actualfilesize', 'mcfd_isdeleted'], 'integer'],
            [['mcfd_origfilename', 'mcfd_sysgenerfilename'], 'string'],
            [['mcfd_uploadedon'], 'safe'],
            [['mcfd_filetype'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompfiledtls_pk' => 'Memcompfiledtls Pk',
            'mcfd_filemst_fk' => 'Mcfd Filemst Fk',
            'mcfd_opalmemberregmst_fk' => 'Mcfd Memcompmst Fk',
            'mcfd_origfilename' => 'Mcfd Origfilename',
            'mcfd_sysgenerfilename' => 'Mcfd Sysgenerfilename',
            'mcfd_filetype' => 'Mcfd Filetype',
            'mcfd_uploadedon' => 'Mcfd Uploadedon',
            'mcfd_uploadedby' => 'Mcfd Uploadedby',
            'mcfd_actualfilesize' => 'Mcfd Actualfilesize',
            'mcfd_isdeleted' => 'Mcfd Isdeleted',
        ];
    }
    
    public static function singleUpload($data,$uploadPath,$compRegPk=null ,$userpk=null) {
        
        
        $companyPk = $compRegPk ? $compRegPk : \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk',true);
        $userPk = $userpk ? $userpk : \yii\db\ActiveRecord::getTokenData('opalusermst_pk',true);
        
        $memcompsvimg_chk=Yii::$app->db->createCommand("select `memcompfiledtls_pk` FROM `memcompfiledtls_tbl` WHERE `mcfd_opalmemberregmst_fk`= $companyPk and `mcfd_uploadedby`= $userPk and `mcfd_filemst_fk`=235")->queryAll();
        
        if(!empty($memcompsvimg_chk)){
            if($data['datakey'][0]==0 && in_array($_REQUEST['apiFor'],['and','ios'])){
                foreach($memcompsvimg_chk as $key=>$val) {   
                    $memsvpk .= ($val['memcompfiledtls_pk'].',');
                    $memsvpks = rtrim($memsvpk,',') ;
                }
                // UPDATE (table name, column values, condition)
                $memsvimgdel = Yii::$app->db->createCommand()->update('memcompfiledtls_tbl', ['mcfd_isdeleted' => 1], 'memcompfiledtls_pk IN ('.$memsvpks.')')->execute();            
            }
        }
        $org="";
        if(is_array($data['originalFileName'])){
            $org=$data['originalFileName'][0];
        }else{
            $org=$data['originalFileName'];
        }

        $sze="";
        if(is_array($data['fileSize'])){
            $sze=$data['fileSize'][0];
        }else{
            $sze=$data['fileSize'];
        }
        
        $compFile=new MemcompfiledtlsTbl();
        $compFile->mcfd_filemst_fk=$data['key'] ? $data['key'] : $data['filePk'];
        $compFile->mcfd_opalmemberregmst_fk=$companyPk;

        $compFile->mcfd_origfilename=$org ? $org : $data['fileName'][0];
        $compFile->mcfd_sysgenerfilename=$data['generatedFileName'] ? $data['generatedFileName']: $data['fileModified'] ;
        $compFile->mcfd_filetype=$data['fileType'];
        $compFile->mcfd_uploadedon=date('Y-m-d H:i:s');
        $compFile->mcfd_uploadedby=$userPk;
        $compFile->mcfd_actualfilesize=$sze;
        $compFile->mcfd_isdeleted=0;
        if($compFile->save()){
            $generatedFileName=rtrim($data['generatedFileName'],".".$data['fileType']);
            if(!$data['generatedFileName'])
            {
                $generatedFileName=rtrim($data['fileModified'],".".$data['fileType']);
            }
            $generatedFileName=$generatedFileName.'[[]]'.$compFile->memcompfiledtls_pk.".".$data['fileType'];
            $linkUrl=rtrim($data['fileUrl'],".".$data['fileType']);
            $linkUrl=$linkUrl.'[[]]'.$compFile->memcompfiledtls_pk.".".$data['fileType'];
            $compFile->mcfd_sysgenerfilename=$generatedFileName;
            if($compFile->save()){  
                $uploadPathNew=rtrim($uploadPath,".".$data['fileType']);
                $uploadPathNew=$uploadPathNew.'[[]]'.$compFile->memcompfiledtls_pk.".".$data['fileType'];
                rename($uploadPath, $uploadPathNew);
            }
            
            $fileMst=\api\modules\drv\models\FilemstTbl::findOne($data['key']);
            //Audit Log
            if( $data['key']==93 && in_array($_REQUEST['apiFor'],['and','ios'])){
                $filedtlpk=Yii::$app->db->createCommand("select * FROM `memcompfiledtls_tbl` WHERE `mcfd_opalmemberregmst_fk`= $companyPk and `mcfd_uploadedby`=$userPk and `mcfd_filemst_fk`=93 and `mcfd_isdeleted` = 0 and cast(`mcfd_uploadedon` as Date) = cast(Date(Now()) as Date)")->queryAll();
                if(!empty($filedtlpk)){
                    foreach($filedtlpk as $key=>$value) { 
                        $response[$key]['MemcompFileDtl_pk'] = $value['memcompfiledtls_pk'];
                        $response[$key]['orgifilename'] = $value['mcfd_origfilename'];
                        $response[$key]['filesize'] = $value['mcfd_actualfilesize']; 
                        $response[$key]['filetype'] = $value['mcfd_filetype'];
                        $response[$key]['uploadedon'] = $value['mcfd_uploadedon'];
                        $response[$key]['link'] =\common\components\Drive::generateUrl($response[$key]['MemcompFileDtl_pk'], $companyPk, $userPk,1);
                    }
                }
            }
            $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
            $descText="Uploaded the {$fileMst->fm_filelabel}, {$data['originalFileName']}.";
            //\common\components\UserActivityLog::logUserActivity(16,$descText,$url,$fileMst->fm_modulemst_fk);
            
            $fileDtlsPk=$compFile->memcompfiledtls_pk;
			$userPk=$userPk;
			$companyPk=$companyPk;
            
			$link=\api\components\Drive::generateUrl($fileDtlsPk, $companyPk, $userPk,1);
            if( $data['key']==93 && in_array($_REQUEST['apiFor'],['and','ios'])){
                return $success = [
                    "msg" => "success",
                    "status" => 1,
                    "data"=>$response
                ];
            } else {                
                return $success = [
                    "msg" => "success",
                    "status" => 1,
                    "data"=>[
                        "filePk"=>$compFile->memcompfiledtls_pk,
                        "fileName"=>$compFile->mcfd_origfilename,
                        "fileSize"=>$compFile->mcfd_actualfilesize,
                        "fileType"=>$compFile->mcfd_filetype,
                        "fileModified"=>$compFile->mcfd_uploadedon,
                        "fileUrl"=>$link                        
                    ]
                ];
            }
        }else{ 
            echo '<pre>';
            print_r($compFile->getErrors());
            exit;
            return $failure = [
                "msg" => "failure",
                "status" => 0
            ];
        }        
    }
       /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasters()
    {
        return $this->hasOne(\api\modules\drv\models\FilemstTbl::className(), ['filemst_pk' => 'mcfd_filemst_fk']);
    }
    
    
    public static function addedToday(){
       $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
       return MemcompfiledtlsTbl::find()->where([
           'mcfd_uploadedby'=>$userPk,
           'DATE(mcfd_uploadedon)'=>  date("Y-m-d")
       ])->count();
    }
    public static function totalUploads(){
       $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
       return MemcompfiledtlsTbl::find()->where([
           'mcfd_uploadedby'=>$userPk
       ])->count();
    }
    public static function uploadedModuleByField($field,$selectedPks){
        
        if(!empty($selectedPks)){
            $userPk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk',true);
            $companyPk = \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk',true);
            
            $uploadPath=  \Yii::$app->params['uploadPath'];
            $userDirectory="comp_".$companyPk."/user_".$userPk;
            $fileMst=  \api\modules\drv\models\FilemstTbl::find()->select(['fm_phyfilepath'])->where(['filemst_pk'=>$field])->one();
            $linkPath=$uploadPath."/".$userDirectory."/".$fileMst->fm_phyfilepath.'/';
            
            
        $returnDtls=MemcompfiledtlsTbl::find()->select([
            'mcfd_origfilename as fileName',
           'mcfd_filetype as fileType',
           'mcfd_actualfilesize as fileSize',
           'mcfd_uploadedon as fileModified',
           'CONCAT("'.$linkPath.'",mcfd_sysgenerfilename) as fileUrl',
           'memcompfiledtls_pk as filePk',
           ])
           //->where(['mcfd_uploadedby'=>$userPk])
           ->where([
            'IN','memcompfiledtls_pk',$selectedPks
        ])
       ->asArray()->all();
          
       foreach($returnDtls as $key=>$details){
            $returnDtls[$key]['imageUrl']=\api\components\Drive::generateUrl($details['filePk'], $companyPk, $userPk);    
            $returnDtls[$key]['fileUrl']=\api\components\Drive::generateUrl($details['filePk'], $companyPk, $userPk,1);
        }
        }
       return $returnDtls;
    }

    public static function getFileNameByPk($fileDtlsPk){ 
        $data = self::find()
                ->select(['mcfd_origfilename as filename'])
                ->where(['=','memcompfiledtls_pk',$fileDtlsPk])
                ->asArray()
                ->one();
                
        return $data['filename'] ? $data['filename'] : "";
    }
    public static function getFileTypeByPk($fileDtlsPk){
        $data = self::find()
                ->select(['mcfd_filetype as filetype'])
                ->where(['=','memcompfiledtls_pk',$fileDtlsPk])
                ->asArray()
                ->one();
        return $data['filetype'] ? $data['filetype'] : "";
    }
    
    public static function getDriveUsageSizeTowardsCompany($companypk){
        return self::find()
                ->select([ 'driveSize' => new \yii\db\Expression('format_bytes(sum(mcfd_actualfilesize))')])
                ->where(['mcfd_opalmemberregmst_fk' => $companypk])
                ->asArray()->one()['driveSize'];
    }

    public static function getFileDetailsByPk($filePk, $companyPk) {
        $data = self::find()
            ->select(['mcfd_origfilename', 'mcfd_sysgenerfilename', 'mcfd_filetype as uploadtype', 'mcfd_uploadedon', 'mcfd_uploadedby', 'mcfd_actualfilesize'])
            ->where(['=','memcompfiledtls_pk',$filePk])
            ->asArray()
            ->one();
        $data['imageUrl'] = \common\components\Drive::generateUrl($filePk, $companyPk, $data['mcfd_uploadedby']);
        return $data;
    }
    
    public static function saveRegUploads($data,$userpk)
    {
        $userdtls = OpalusermstTbl::findOne($userpk);
        $compRegPk = $userdtls->oum_opalmemberregmst_fk;
        
        
       if(!empty($data['company_logo']))
       {
           
         $complogofiledata = json_decode($data['company_logo'],true);
         $fileUploadpk['company_logo'] = self::registrationUpload($complogofiledata[0],$userpk);
       }
       
       if(!empty($data['cr_activity']))
       {
           
         $complogofiledata = json_decode($data['cr_activity'],true);
         $fileUploadpk['cr_activity'] = self::registrationUpload($complogofiledata[0],$userpk);
       }
        
       if(!empty($fileUploadpk))
       {
           $model = OpalmemberregmstTbl::findOne($compRegPk);
           
           $model->omrm_cmplogo = $fileUploadpk['company_logo'] ? $fileUploadpk['company_logo'] : null;
           $model->omrm_cractivity = $fileUploadpk['cr_activity'] ? $fileUploadpk['cr_activity'] : null;
           if($model->save())
           {
               return true;
           }
           else
           {
               echo "<pre>";
               var_dump($model->getErrors());
               exit;
           }
           
       }
       return true;  
       
    }
    public static function registrationUpload($data,$userpk)
    {
        $userdtls = OpalusermstTbl::findOne($userpk);
        $compRegPk = $userdtls->oum_opalmemberregmst_fk;
        $srcDirectory = \Yii::$app->params['srcDirectory'];
        $uploadPath = \Yii::$app->params['uploadPath'];
        $fileTemplate= \api\modules\drv\models\FilemstTbl::find()->filee($data['filePk']); 
        $userDirectory = "comp_" . $compRegPk . "/user_" . $userpk;
        $target_path = $srcDirectory . $uploadPath . "/" . $userDirectory . '/' . $fileTemplate['filePath'] . '/';
        if (!file_exists($target_path)) {
            mkdir($target_path, 0777, true);
        }
       
        $target_path = $target_path.basename($data['fileModified']);  
        if(rename($data['fileUrl'], $target_path))
        {
          $filepk = self::singleUpload($data,$target_path,$compRegPk ,$userpk);
        }
        else
        {
            echo "<pre>";
            exit;
        }
        
       return $filepk['data']['filePk'];
    }
    
    public static function SaveUserDp($data,$userpk)
    {
        $userdtls = OpalusermstTbl::findOne($userpk);
        $compRegPk = $userdtls->oum_opalmemberregmst_fk;
        $srcDirectory = \Yii::$app->params['srcDirectory'];
        $uploadPath = \Yii::$app->params['uploadPath'];
        $fileTemplate=\api\modules\drv\models\FilemstTbl::find()->filee($data['filePk']); 
        $userDirectory = "comp_" . $compRegPk . "/user_" . $userpk;
        $target_path = $srcDirectory . $uploadPath . "/" . $userDirectory . '/' . $fileTemplate['filePath'] . '/';
        if (!file_exists($target_path)) {
            mkdir($target_path, 0777, true);
        }
        $target_path = $target_path.basename($data['fileModified']);  
        
        if(rename($data['fileUrl'], $target_path))
        {
          $filepk = self::singleUpload($data,$target_path,$compRegPk ,$userpk);
        }
        else
        {
            echo "<pre>";
            var_dump('fdgdfgfdg');
            exit;
        }
        
       return $filepk['data']['filePk'];
    }
}




