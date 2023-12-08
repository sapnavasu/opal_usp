<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use common\components\Security;
use \common\components\Drive;
use common\components\Common;

/**
 * This is the model class for table "jdonoteshdr_tbl".
 *
 * @property int $jdonoteshdr_pk Primary key
 * @property int $jdnh_jdomoduledtl_fk Reference to jdomoduledtl_tbl
 * @property int $jdnh_creator_jdotargetmember_fk created this notes: Reference to jdotargetmember_tbl
 * @property string $jdnh_notestitle Notes title
 * @property string $jdnh_notesdesc Notes description
 * @property string $jdnh_notesdesc Notes description
 * @property int $jdnh_notes_timezone_fk insert only minutes here
 * @property string $cnd_reminderdt
 * @property int $cnd_isallday 1 - Yes, 2 - No
 * @property int $cnd_notesstatus Current Status.1 - Active, 2 -  InActive
 * @property int $cnd_pinit 1-unpin, 2-pin
 * @property string $cnd_ipaddress IP Address of the user who created the notes
 * @property string $cnd_timezone Timezone of the user who created the notes
 * @property string $cnd_createdon Date of creation
 * @property string $cnd_updatedon Date of update
 * @property int $cnd_createdfrom 1 - Web, 2 - Android, 3 - IOS
 */
class ColnotesdtlTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colnotesdtl_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cnd_collaborativemst_fk', 'cnd_colprojaudience_fk', 'cnd_notestitle', 'cnd_notes', 'cnd_notesstatus', 'cnd_ipaddress', 'cnd_timezone', 'cnd_createdon', 'cnd_createdfrom'], 'required'],
            [['cnd_collaborativemst_fk', 'cnd_colprojaudience_fk', 'cnd_reminder', 'cnd_isallday', 'cnd_notesstatus', 'cnd_pinit', 'cnd_createdfrom'], 'integer'],
            [['cnd_notes', 'cnd_memcompfiledtls_fk'], 'string'],
            [['cnd_reminderdt', 'cnd_createdon', 'cnd_updatedon'], 'safe'],
            [['cnd_notestitle'], 'string', 'max' => 80],
            [['cnd_ipaddress'], 'string', 'max' => 50],
            [['cnd_timezone'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'colnotesdtl_pk' => 'Colnotesdtl Pk',
            'cnd_collaborativemst_fk' => 'Cnd Collaborativemst Fk',
            'cnd_colprojaudience_fk' => 'Cnd Colprojaudience Fk',
            'cnd_notestitle' => 'Cnd Notestitle',
            'cnd_notes' => 'Cnd Notes',
            'cnd_memcompfiledtls_fk' => 'Cnd Memcompfiledtls Fk',
            'cnd_reminder' => 'Cnd Reminder',
            'cnd_reminderdt' => 'Cnd Reminderdt',
            'cnd_isallday' => 'Cnd Isallday',
            'cnd_notesstatus' => 'Cnd Notesstatus',
            'cnd_pinit' => 'Cnd Pinit',
            'cnd_ipaddress' => 'Cnd Ipaddress',
            'cnd_timezone' => 'Cnd Timezone',
            'cnd_createdon' => 'Cnd Createdon',
            'cnd_updatedon' => 'Cnd Updatedon',
            'cnd_createdfrom' => 'Cnd Createdfrom',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserpreference()
    {
        return $this->hasOne(ColuserpreferenceTbl::className(), ['colnotesdtl_pk' => 'cup_shared_fk']);
    }

    public function addnotes($data)
    {
        $colnotespk = $data['colnotespk'];
        $colnotesdtls= ColnotesdtlTbl::find()
                ->where("colnotesdtl_pk=:pk",[':pk'=>$colnotespk])
                ->one();
        $ip_address = Common::getIpAddress();

        if(empty($colnotesdtls)){
            $colnotesdtls = new ColnotesdtlTbl();
            $colnotesdtls->cnd_collaborativemst_fk = Security::sanitizeInput($data['colmstpk'], "number");
            $colnotesdtls->cnd_colprojaudience_fk = Security::sanitizeInput($data['colprojaudpk'], "number");
            $colnotesdtls->cnd_notestitle = Security::sanitizeInput($data['notestitle'], "string");
            $colnotesdtls->cnd_notes = Security::sanitizeInput($data['notes'], "string");
            $colnotesdtls->cnd_reminderdt = date("Y-m-d", strtotime($data['date']));
            //$colnotesdtls->cnd_reminder = date("H:i:s", strtotime($data['time']));
            $colnotesdtls->cnd_isallday = Security::sanitizeInput($data['isallday'], "number");
            $colnotesdtls->cnd_memcompfiledtls_fk = Security::sanitizeInput($data['filepk'], "string");
            $colnotesdtls->cnd_timezone = Security::sanitizeInput($data['timezone'], "string");
            $colnotesdtls->cnd_notesstatus = 1;
            $colnotesdtls->cnd_pinit = 1;
            $colnotesdtls->cnd_createdon = date('Y-m-d H:i:s');
            $colnotesdtls->cnd_ipaddress = $ip_address;
            $colnotesdtls->cnd_createdfrom = Security::sanitizeInput($data['createdfrom'], "number");
            $msg = "Task details inserted successfully";
        }else{
            $colnotesdtls->cnd_notestitle = Security::sanitizeInput($data['notestitle'], "string");
            $colnotesdtls->cnd_notes = Security::sanitizeInput($data['notes'], "string");
            $colnotesdtls->ctd_isallday = Security::sanitizeInput($data['isallday'], "number");
            $colnotesdtls->cnd_timezone = Security::sanitizeInput($data['timezone'], "string");
            $msg = "Task details updated successfully";
        }
        if($colnotesdtls->save()){
            return $msg;
        }else{
            return $colnotesdtls->getErrors();
        }
    }
    public function deletenotes($data){
        $colnotespk = Security::sanitizeInput($data['colnotespk'], "number");
        $status = Security::sanitizeInput($data['notes_status'], "number");
        $colnotesdtls= ColnotesdtlTbl::find()
                ->where("colnotesdtl_pk=:pk",[':pk'=>$colnotespk])
                ->one();
        if(!empty($colnotesdtls)){
            $colnotesdtls->cnd_notesstatus = $status;
            if($colnotesdtls->save()){
                $msg = "Notes details deleted successfully";
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }
    public function pinnotes($data){
        $colnotespk = Security::sanitizeInput($data['colnotespk'], "number");
        $status = Security::sanitizeInput($data['pin_status'], "number");
        $colnotesdtls= ColnotesdtlTbl::find()
                ->where("colnotesdtl_pk=:pk",[':pk'=>$colnotespk])
                ->one();
        if(!empty($colnotesdtls)){
            $colnotesdtls->cnd_pinit = $status;
            if($colnotesdtls->save()){
                $msg = "Notes Pinned";
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }
    public function noteslisting($data)
    {
        $model=ColnotesdtlTbl::find()
            ->select(['colnotesdtl_pk','cnd_notestitle','cnd_notes','UserMst_Pk','MemberCompMst_Pk','MCM_CompanyName','cnd_memcompfiledtls_fk','DATE_FORMAT(cnd_createdon,"%d-%m-%Y") as cnd_createdon'])
            ->leftJoin('colprojaudience_tbl','colprojaudience_tbl.colprojaudience_pk=colnotesdtl_tbl.cnd_colprojaudience_fk')
            ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=colprojaudience_tbl.cpa_targetusers')
            ->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=usermst_tbl.UM_MemberRegMst_Fk')
            ->Where('cnd_collaborativemst_fk=:colmstpk',array(':colmstpk' =>  $data['colmstpk']))
            ->andWhere('colprojaudience_tbl.cpa_targetusers=:userpk',array(':userpk' =>  $data['userpk']));
        if(!empty($data['search'])){
            $model->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('cnd_notestitle', true), ':value',array(':value' =>  $data['search'])]]);
        }
        $model->orderBy('colnotesdtl_pk DESC');
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model]);
        $active = [];
        $archive = [];
        foreach($provider->getModels() as $data){
            $info=[];
            $file_pk = $data['cnd_memcompfiledtls_fk'];
            $file_path='';
            if(!empty($file_pk)){
                $file_path = Drive::generateUrl($file_pk, $data['MemberCompMst_Pk'], $data['UserMst_Pk']);
            }
            $info['colnotesdtl_pk']  =   $data['colnotesdtl_pk'];      
            $info['cnd_notestitle']  =   $data['cnd_notestitle'];      
            $info['cnd_notes']  =   $data['cnd_notes'];      
            $info['cnd_createdon']  =   $data['cnd_createdon'];      
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
}
