<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use common\components\Security;
use \common\models\UsermstTbl;

/**
 * This is the model class for table "colprojaudience_tbl".
 *
 * @property int $colprojaudience_pk Primary key
 * @property int $cpa_collaborativemst_fk Reference to collaborativemst_tbl
 * @property int $cpa_usertype 1-Internal User, 2 - External User
 * @property int $cpa_membercompmst_fk Reference to membercompanymst_tbl
 * @property int $cpa_targetusers Reference to usrmst_tbl
 * @property int $cpa_invitestatus 1 - Invited, 2 - Accepted, 3 - Declined
 * @property int $cpa_targetuserstatus 1 - Active, 2 - InActive
 * @property int $cpa_isdiscussion Is the user involved in discussion. 1 - Yes, 2 - No. Default 2
 * @property string $cpa_createdon Datetime of creation
 * @property string $cpa_invitedon Datetime of Invite
 * @property string $cpa_accdeclon Datetime of acceptance / decline
 */
class ColprojaudienceTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colprojaudience_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cpa_collaborativemst_fk', 'cpa_membercompmst_fk', 'cpa_targetusers', 'cpa_targetuserstatus', 'cpa_createdon'], 'required'],
            [['cpa_collaborativemst_fk', 'cpa_usertype', 'cpa_membercompmst_fk', 'cpa_targetusers', 'cpa_invitestatus', 'cpa_targetuserstatus', 'cpa_isdiscussion'], 'integer'],
            [['cpa_createdon', 'cpa_invitedon', 'cpa_accdeclon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'colprojaudience_pk' => 'Colprojaudience Pk',
            'cpa_collaborativemst_fk' => 'Cpa Collaborativemst Fk',
            'cpa_usertype' => 'Cpa Usertype',
            'cpa_membercompmst_fk' => 'Cpa Membercompmst Fk',
            'cpa_targetusers' => 'Cpa Targetusers',
            'cpa_invitestatus' => 'Cpa Invitestatus',
            'cpa_targetuserstatus' => 'Cpa Targetuserstatus',
            'cpa_isdiscussion' => 'Cpa Isdiscussion',
            'cpa_createdon' => 'Cpa Createdon',
            'cpa_invitedon' => 'Cpa Invitedon',
            'cpa_accdeclon' => 'Cpa Accdeclon',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\UsermstTbl::className(), ['UserMst_Pk' => 'cpa_targetusers']);
    }
    public function addteammember($data)
    {
        $colmstpk = Security::sanitizeInput($data['colmstpk'], "number");
        $internal_ursers = explode(',', $data['internal_users']);
        $external_ursers = explode(',', $data['external_users']);
        $comp_pk = Security::sanitizeInput($data['comppk'], "number");
        if(count($internal_ursers)>0){
            foreach($internal_ursers as $key=>$value){
                $coltaskdtls = new ColprojaudienceTbl();
                $coltaskdtls->cpa_collaborativemst_fk = $colmstpk;
                $coltaskdtls->cpa_usertype = 1;
                $coltaskdtls->cpa_membercompmst_fk = $comp_pk;
                $coltaskdtls->cpa_targetusers = $value;
                $coltaskdtls->cpa_invitestatus = 1;
                $coltaskdtls->cpa_targetuserstatus = 1;
                $coltaskdtls->cpa_isdiscussion = 1;
                $coltaskdtls->cpa_createdon = date('Y-m-d H:i:s');
                $coltaskdtls->cpa_invitedon = date('Y-m-d H:i:s');
                $coltaskdtls->save();   
            }
        }
        if(count($external_ursers)>0){
            foreach($external_ursers as $key=>$value){
                $item = explode('*', $value);
                $coltaskdtls = new ColprojaudienceTbl();
                $coltaskdtls->cpa_collaborativemst_fk = $colmstpk;
                $coltaskdtls->cpa_usertype = 1;
                $coltaskdtls->cpa_membercompmst_fk = $item[1];
                $coltaskdtls->cpa_targetusers = $item[0];
                $coltaskdtls->cpa_invitestatus = 1;
                $coltaskdtls->cpa_targetuserstatus = 1;
                $coltaskdtls->cpa_isdiscussion = 1;
                $coltaskdtls->cpa_createdon = date('Y-m-d H:i:s');
                $coltaskdtls->cpa_invitedon = date('Y-m-d H:i:s');
                $coltaskdtls->save();   
            }
        }
        if($internal_ursers>0 || $external_ursers>0){
            $msg = "Audience added successfully";
        }else{
            $msg = "Something went wrong";
        }
        return $msg;
    }
    public function updateinvitestatus($data){
        $colprojaudpk = Security::sanitizeInput($data['colprojaudpk'], "number");
        $status = Security::sanitizeInput($data['invitestatus'], "number");
        $colprojauddtls= ColprojaudienceTbl::find()
                ->where("colprojaudience_pk=:pk",[':pk'=>$colprojaudpk])
                ->one();
        if(!empty($colprojauddtls)){
            $colprojauddtls->cpa_invitestatus=$status;
            if($colprojauddtls->save()){
                if($status==2){
                    $msg = "Invite status accepted";
                }elseif($status==3){
                    $msg = "Invite status declined";
                } 
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }
}
