<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opalmemcompfiledtls_tbl".
 *
 * @property int $omcfd_opalmemcompfiledtls_pk primary key
 * @property int $omcfd_filemst_fk Reference to opalfileuploadmst_tbl
 * @property int $omcfd_opalmemberregmst_fk Reference to opalmemberregmst_tbl
 * @property string $omcfd_origfilename Original file name as given by the user
 * @property string $omcfd_sysgenerfilename System generated file name. Generated like currentdatetime with random number to avoid ambiguity
 * @property string $omcfd_filetype File types such as pdf, xlsx, doc to be stored
 * @property string $omcfd_uploadedon Datetime of upload
 * @property int $omcfd_uploadedby reference to opalusermst_tbl
 * @property int $omcfd_actualfilesize Actual file size
 * @property int $omcfd_isdeleted If the file is deleted then 1 else 2
 * @property string $omcfd_referredin
 *
 * @property OpalmemberregmstTbl[] $opalmemberregmstTbls
 * @property OpalmemberregmstTbl[] $opalmemberregmstTbls0
 * @property OpalfileuploadmstTbl $omcfdFilemstFk
 */
class OpalmemcompfiledtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalmemcompfiledtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['omcfd_filemst_fk', 'omcfd_opalmemberregmst_fk', 'omcfd_origfilename', 'omcfd_sysgenerfilename', 'omcfd_filetype', 'omcfd_uploadedon', 'omcfd_uploadedby', 'omcfd_actualfilesize', 'omcfd_isdeleted'], 'required'],
            [['omcfd_filemst_fk', 'omcfd_opalmemberregmst_fk', 'omcfd_uploadedby', 'omcfd_actualfilesize', 'omcfd_isdeleted'], 'integer'],
            [['omcfd_origfilename', 'omcfd_sysgenerfilename', 'omcfd_referredin'], 'string'],
            [['omcfd_uploadedon'], 'safe'],
            [['omcfd_filetype'], 'string', 'max' => 10],
            [['omcfd_filemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalfileuploadmstTbl::className(), 'targetAttribute' => ['omcfd_filemst_fk' => 'opalfileuploadmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'omcfd_opalmemcompfiledtls_pk' => 'Omcfd Opalmemcompfiledtls Pk',
            'omcfd_filemst_fk' => 'Omcfd Filemst Fk',
            'omcfd_opalmemberregmst_fk' => 'Omcfd Opalmemberregmst Fk',
            'omcfd_origfilename' => 'Omcfd Origfilename',
            'omcfd_sysgenerfilename' => 'Omcfd Sysgenerfilename',
            'omcfd_filetype' => 'Omcfd Filetype',
            'omcfd_uploadedon' => 'Omcfd Uploadedon',
            'omcfd_uploadedby' => 'Omcfd Uploadedby',
            'omcfd_actualfilesize' => 'Omcfd Actualfilesize',
            'omcfd_isdeleted' => 'Omcfd Isdeleted',
            'omcfd_referredin' => 'Omcfd Referredin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpalmemberregmstTbls()
    {
        return $this->hasMany(OpalmemberregmstTbl::className(), ['omrm_cmplogo' => 'omcfd_opalmemcompfiledtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpalmemberregmstTbls0()
    {
        return $this->hasMany(OpalmemberregmstTbl::className(), ['omrm_cractivity' => 'omcfd_opalmemcompfiledtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOmcfdFilemstFk()
    {
        return $this->hasOne(OpalfileuploadmstTbl::className(), ['opalfileuploadmst_pk' => 'omcfd_filemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return OpalmemcompfiledtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalmemcompfiledtlsTblQuery(get_called_class());
    }

    
    public static function singleUpload($data,$uploadPath,$companyPk = null,$userPk = null) {
     
        $companyPk = !empty($companyPk) ? $companyPk :\yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk',true);
        $userPk = !empty($userPk) ? $userPk : \yii\db\ActiveRecord::getTokenData('opalusermst_pk',true);
        
        $compFile=new OpalmemcompfiledtlsTbl();
        $compFile->omcfd_filemst_fk=$data['filePk'];
        $compFile->omcfd_opalmemberregmst_fk = $companyPk;
        $compFile->omcfd_origfilename=$data['fileName'];
        $compFile->omcfd_sysgenerfilename=$data['fileModified'];
        $compFile->omcfd_filetype=$data['fileType'];
        $compFile->omcfd_uploadedon=date('Y-m-d H:i:s');
        $compFile->omcfd_uploadedby=$userPk;
        $compFile->omcfd_actualfilesize=$data['fileSize'];
        $compFile->omcfd_isdeleted=0;
        if($compFile->save()){
            $generatedFileName=rtrim($data['fileModified'],".".$data['fileType']);
            $generatedFileName=$generatedFileName.'[[]]'.$compFile->omcfd_opalmemcompfiledtls_pk.".".$data['fileType'];
            $linkUrl=rtrim($data['fileUrl'],".".$data['fileType']);
            $linkUrl=$linkUrl.'[[]]'.$compFile->omcfd_opalmemcompfiledtls_pk.".".$data['fileType'];
            $compFile->omcfd_sysgenerfilename=$generatedFileName;
            if($compFile->save()){  
                $uploadPathNew=rtrim($uploadPath,".".$data['fileType']);
                $uploadPathNew=$uploadPathNew.'[[]]'.$compFile->omcfd_opalmemcompfiledtls_pk.".".$data['fileType'];
                rename($uploadPath, $uploadPathNew);
            }
            
            $fileMst= OpalfileuploadmstTbl::findOne($data['key']);
            
//            $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
//            $descText="Uploaded the {$fileMst->fm_filelabel}, {$data['originalFileName']}.";
//            \common\components\UserActivityLog::logUserActivity(16,$descText,$url,$fileMst->fm_modulemst_fk);
            
            $fileDtlsPk=$compFile->omcfd_opalmemcompfiledtls_pk;
			$userPk=$userPk;
			$companyPk=$companyPk;
			$link=\api\components\Drive::generateUrl($fileDtlsPk, $companyPk, $userPk,1);
            $baseUrl = \Yii::$app->params['baseMailPath'];              
                return $success = [
                    "msg" => "success",
                    "status" => 1,
                    "data"=>[
                        "filePk"=>$compFile->omcfd_opalmemcompfiledtls_pk,
                        "fileName"=>$compFile->omcfd_origfilename,
                        "fileSize"=>$compFile->omcfd_actualfilesize,
                        "fileType"=>$compFile->omcfd_filetype,
                        "fileModified"=>$compFile->omcfd_uploadedon,
                        "fileUrl"=>$link,
                        "link"=> $baseUrl.$uploadPathNew                    
                    ]
                ];
            
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
        $fileTemplate= \app\models\OpalfileuploadmstTbl::find()->filee($data['filePk']); 
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
        $fileTemplate= \app\models\OpalfileuploadmstTbl::find()->filee($data['filePk']); 
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
