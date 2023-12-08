<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use common\components\Security;
use common\components\Common;
use common\components\Drive;

/**
 * This is the model class for table "coltaskdtls_tbl".
 *
 * @property int $coltaskdtls_pk Primary key
 * @property int $ctd_collaborativemst_fk Reference to collaborativemst_tbl
 * @property string $ctd_tasktitle Task title
 * @property string $ctd_taskdesc Task description
 * @property string $ctd_taskdate Task Date
 * @property string $ctd_tasktime Time of the task
 * @property int $ctd_isallday 1 - Yes, 2 - No
 * @property int $ctd_status 1 - Completed, 2 - Delete, 3 - Archive
 * @property int $ctd_memcompfiledtls_tbl Reference to memcompfiledtls_tbl
 * @property int $ctd_pinit 1-unpin, 2-pin
 * @property string $ctd_createdon Datetime of creation
 * @property int $ctd_createdby Reference to colprojaudience_tbl
 * @property string $ctd_createdbyipaddr IP Address of the user
 */
class ColtaskdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coltaskdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctd_collaborativemst_fk', 'ctd_tasktitle', 'ctd_taskdesc', 'ctd_taskdate', 'ctd_tasktime', 'ctd_createdon', 'ctd_createdby'], 'required'],
            [['ctd_collaborativemst_fk', 'ctd_isallday', 'ctd_status', 'ctd_memcompfiledtls_tbl', 'ctd_pinit', 'ctd_createdby'], 'integer'],
            [['ctd_taskdesc'], 'string'],
            [['ctd_taskdate', 'ctd_tasktime', 'ctd_createdon'], 'safe'],
            [['ctd_tasktitle'], 'string', 'max' => 80],
            [['ctd_createdbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coltaskdtls_pk' => 'Coltaskdtls Pk',
            'ctd_collaborativemst_fk' => 'Ctd Collaborativemst Fk',
            'ctd_tasktitle' => 'Ctd Tasktitle',
            'ctd_taskdesc' => 'Ctd Taskdesc',
            'ctd_taskdate' => 'Ctd Taskdate',
            'ctd_tasktime' => 'Ctd Tasktime',
            'ctd_isallday' => 'Ctd Isallday',
            'ctd_status' => 'Ctd Status',
            'ctd_memcompfiledtls_tbl' => 'Ctd Memcompfiledtls Tbl',
            'ctd_pinit' => 'Ctd Pinit',
            'ctd_createdon' => 'Ctd Createdon',
            'ctd_createdby' => 'Ctd Createdby',
            'ctd_createdbyipaddr' => 'Ctd Createdbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserpreference()
    {
        return $this->hasOne(ColuserpreferenceTbl::className(), ['coltaskdtls_pk' => 'cup_shared_fk']);
    }
    
    public function addtask($data)
    {
        $coltaskpk = $data['coltaskpk'];
        $coltaskdtls= ColtaskdtlsTbl::find()
                ->where("coltaskdtls_pk=:pk",[':pk'=>$coltaskpk])
                ->one();
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if(empty($coltaskdtls)){
            $coltaskdtls = new ColtaskdtlsTbl();
            $coltaskdtls->ctd_collaborativemst_fk = Security::sanitizeInput($data['colmstpk'], "number");
            $coltaskdtls->ctd_tasktitle = Security::sanitizeInput($data['tasktitle'], "string");
            $coltaskdtls->ctd_taskdesc = Security::sanitizeInput($data['taskdesc'], "string");
            $coltaskdtls->ctd_taskdate = date("Y-m-d", strtotime($data['date']));
            $coltaskdtls->ctd_tasktime = date("H:i:s", strtotime($data['time']));
            $coltaskdtls->ctd_isallday = Security::sanitizeInput($data['isallday'], "number");
            $coltaskdtls->ctd_memcompfiledtls_tbl = Security::sanitizeInput($data['filepk'], "string");
            $coltaskdtls->ctd_pinit = 1;
            $coltaskdtls->ctd_createdon = date('Y-m-d H:i:s');
            $coltaskdtls->ctd_createdby = $userPK;
            $coltaskdtls->ctd_createdbyipaddr = $ip_address;
            $msg = "Task details inserted successfully";
        }else{
            $coltaskdtls->ctd_tasktitle = Security::sanitizeInput($data['tasktitle'], "string");
            $coltaskdtls->ctd_taskdesc = Security::sanitizeInput($data['taskdesc'], "string");
            $coltaskdtls->ctd_taskdate = date("Y-m-d", strtotime($data['date']));
            $coltaskdtls->ctd_tasktime = date("H:i:s", strtotime($data['time']));
            $coltaskdtls->ctd_isallday = Security::sanitizeInput($data['isallday'], "number");
            $msg = "Task details updated successfully";
        }
        if($coltaskdtls->save()){
            return $msg;
        }else{
            return $coltaskdtls->getErrors();
        }
    }
    public function updatestatus($data){
        $coltaskpk = Security::sanitizeInput($data['coltaskpk'], "number");
        $status = Security::sanitizeInput($data['taskstatus'], "number");
        $coltaskdtls= ColtaskdtlsTbl::find()
                ->where("coltaskdtls_pk=:pk",[':pk'=>$coltaskpk])
                ->one();
        if(!empty($coltaskdtls)){
            $coltaskdtls->ctd_status=$status;
            if($coltaskdtls->save()){
                if($status==1){
                    $msg = "Task Completed successfully";
                }elseif($status==2){
                    $msg = "Task Delete successfully";
                }elseif($status==3){
                    $msg = "Task Archive successfully";
                }  
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }
    public function tasklisting($data)
    {
        $model=ColtaskdtlsTbl::find()
            ->select(['coltaskdtls_pk','ctd_tasktitle','ctd_taskdesc','ctd_isallday','ctd_memcompfiledtls_tbl','DATE_FORMAT(ctd_taskdate,"%d-%m-%Y") as ctd_taskdate','DATE_FORMAT(ctd_tasktime,"%h:%i %p") as ctd_tasktime','CASE WHEN `ctd_status` = 1 then "Completed"  
                WHEN `ctd_status` = 2 then "Delete"  
                WHEN `ctd_status` = 3 then "Archive"   
                ELSE "" END as task_status'])
            ->Where('ctd_collaborativemst_fk=:colmstpk',array(':colmstpk' =>  $data['colmstpk']))
            ->andWhere('ctd_createdby=:userpk',array(':userpk' =>  $data['userpk']));
        if(!empty($data['search'])){
            $model->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('ctd_tasktitle', true), ':value',array(':value' =>  $data['search'])]]);
        }
        $model->orderBy('coltaskdtls_pk DESC');
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model]);
        $active = [];
        $archive = [];
        foreach($provider->getModels() as $data){
            $info=[];
            $file_pk = $data['ctd_memcompfiledtls_tbl'];
            $file_path='';
            if(!empty($file_pk)){
                $file_info= \api\modules\drv\models\MemcompfiledtlsTbl::find()
                    ->where("memcompfiledtls_pk=:pk",[':pk'=>$file_pk])
                    ->one();
                $companyPk = $file_info->mcfd_memcompmst_fk;
                $userPk = $file_info->mcfd_uploadedby;
                $file_path = Drive::generateUrl($file_pk, $companyPk, $userPk);
            }
            $info['coltaskdtls_pk']  =   $data['coltaskdtls_pk'];      
            $info['ctd_tasktitle']  =   $data['ctd_tasktitle'];      
            $info['ctd_taskdesc']  =   $data['ctd_taskdesc'];      
            $info['ctd_isallday']  =   $data['ctd_isallday'];      
            $info['ctd_taskdate']  =   $data['ctd_taskdate'];      
            $info['ctd_tasktime']  =   $data['ctd_tasktime'];      
            $info['task_status']  =   $data['task_status'];      
            $info['file_path']  =   $file_path;     

            if($data->userpreference){
                array_push($archive, $info); 
            } else {
                array_push($active, $info);
            }   
          
        }
        $val = ['active' => $active, 'archive' => $archive];
        return [
            'items' => $val,
            'total_count' => $provider->getTotalCount()
        ];
    }
    public function pintask($data){
        $coltaskpk = Security::sanitizeInput($data['coltaskpk'], "number");
        $status = Security::sanitizeInput($data['pin_status'], "number");
        $coltaskdtls= ColtaskdtlsTbl::find()
                ->where("coltaskdtls_pk=:pk",[':pk'=>$coltaskpk])
                ->one();
        if(!empty($coltaskdtls)){
            $coltaskdtls->ctd_pinit=$status;
            if($coltaskdtls->save()){
                $msg = "Task Pinned"; 
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }
    
    public function getAttachments(){
        return $this->hasMany(\api\modules\drv\models\MemcompfiledtlsTbl::class,  ['memcompfiledtls_pk' => 'ctd_memcompfiledtls_tbl']);
    }
}
