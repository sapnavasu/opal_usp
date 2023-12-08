<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use common\components\Security;
use api\modules\ct\models\ColdiscusshdrTbl;
use common\components\Common;

/**
 * This is the model class for table "coldiscussdtls_tbl".
 *
 * @property int $coldiscussdtls_pk Primary key
 * @property int $cdd_coldiscusshdr_fk Reference to coldiscusshdr_tbl
 * @property int $cdd_replyfromprojaudience_fk Reference to projaudience_tbl
 * @property string $cdd_replymessage Reply message
 * @property int $cdd_replypath Reference to memcompfiledtls_tbl
 * @property int $cdd_isread Read status. 0 - Unread,1 - Read, 2 - Deleted
 * @property string $cdd_ipaddress IP Address of the user
 * @property int $cdd_timezone Reference to timezone_tbl
 * @property string $cdd_createdon Date of creation
 * @property int $cdd_createdfrom 1 - Web, 2 - Android, 3 - IOS
 */
class ColdiscussdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coldiscussdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cdd_coldiscusshdr_fk', 'cdd_replyfromprojaudience_fk', 'cdd_replymessage', 'cdd_isread', 'cdd_ipaddress', 'cdd_timezone', 'cdd_createdon', 'cdd_createdfrom'], 'required'],
            [['cdd_coldiscusshdr_fk', 'cdd_replyfromprojaudience_fk', 'cdd_replypath', 'cdd_isread', 'cdd_timezone', 'cdd_createdfrom'], 'integer'],
            [['cdd_replymessage'], 'string'],
            [['cdd_createdon'], 'safe'],
            [['cdd_ipaddress'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coldiscussdtls_pk' => 'Coldiscussdtls Pk',
            'cdd_coldiscusshdr_fk' => 'Cdd Coldiscusshdr Fk',
            'cdd_replyfromprojaudience_fk' => 'Cdd Replyfromprojaudience Fk',
            'cdd_replymessage' => 'Cdd Replymessage',
            'cdd_replypath' => 'Cdd Replypath',
            'cdd_isread' => 'Cdd Isread',
            'cdd_ipaddress' => 'Cdd Ipaddress',
            'cdd_timezone' => 'Cdd Timezone',
            'cdd_createdon' => 'Cdd Createdon',
            'cdd_createdfrom' => 'Cdd Createdfrom',
        ];
    }
    public function adddiscussionmsg($data)
    {
        $coldishdrpk = Security::sanitizeInput($data['coldishdrpk'], "number");
        $fromaudpk = Security::sanitizeInput($data['fromaudpk'], "number");
        $message = Security::sanitizeInput($data['message'], "string");
        $filepk = Security::sanitizeInput($data['filepk'], "number");
        $createdfrom = Security::sanitizeInput($data['createdfrom'], "number");
        $coldishdrdtls= ColdiscusshdrTbl::find()
                ->where("coldiscusshdr_pk=:pk",[':pk'=>$coldishdrpk])
                ->one();
        $ip_address = Common::getIpAddress();

        if(!empty($coldishdrdtls)){
            $discuss_members = explode(',', $coldishdrdtls->cdh_discussmembers);
            foreach($discuss_members as $key=>$value){
                $colprojaud = ColprojaudienceTbl::find()
                    ->select(['UM_TimeZone'])
                    ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=colprojaudience_tbl.cpa_targetusers')
                    ->where("colprojaudience_pk=:pk",[':pk'=>$value])
                    ->asArray()->one();
                $timezone_pk = $colprojaud['UM_TimeZone'];
                //$timezone_pk = $colprojaud->getUser->UM_TimeZone;
                $coldiscdtls = new ColdiscussdtlsTbl();
                $coldiscdtls->cdd_coldiscusshdr_fk = $coldishdrpk;
                $coldiscdtls->cdd_replyfromprojaudience_fk = $value;
                $coldiscdtls->cdd_replymessage = $message;
                $coldiscdtls->cdd_replypath = $filepk;
                if($value == $fromaudpk){
                    $coldiscdtls->cdd_isread = 1;
                }else{
                    $coldiscdtls->cdd_isread = 0;
                }
                $coldiscdtls->cdd_ipaddress = $ip_address;
                $coldiscdtls->cdd_timezone = $timezone_pk;
                $coldiscdtls->cdd_createdon = date('Y-m-d H:i:s');
                $coldiscdtls->cdd_createdfrom = $createdfrom;
                if(!$coldiscdtls->save()){
                    $msg = $coldiscdtls->getErrors();
                }  
            }
            $msg = "Message created successfully";
        }else{
            $msg = "No record found";
        }
        return $msg;
    }
    public function updatemessagestatus($data){
        $coldiscdtlspk = Security::sanitizeInput($data['coldiscdtlspk'], "number");
        $msg_status = Security::sanitizeInput($data['msg_status'], "number");
        $coldiscdtls= ColdiscussdtlsTbl::find()
                ->where("coldiscussdtls_pk=:pk",[':pk'=>$coldiscdtlspk])
                ->one();
        if(!empty($coldiscdtls)){
            $coldiscdtls->cdd_isread=$msg_status;
            if($coldiscdtls->save()){
                if($msg_status==1){
                    $msg = "Message Read";
                }elseif($msg_status==2){
                    $msg = "Message Deleted";
                } 
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }
    public function discussionmsginfo($data)
    {
        $model=ColdiscussdtlsTbl::find()
            ->select(['cdd_replymessage','usermst_tbl.um_userdp','usermst_tbl.um_firstname','DATE_FORMAT(cpa_createdon,"%d-%m-%Y") as cpa_createdon'])
            ->leftJoin('coldiscusshdr_tbl','coldiscusshdr_tbl.coldiscusshdr_pk=coldiscussdtls_tbl.cdd_coldiscusshdr_fk')
            ->leftJoin('colprojaudience_tbl','colprojaudience_tbl.colprojaudience_pk=coldiscusshdr_tbl.cdh_fromcolprojaudience_fk')
            ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=colprojaudience_tbl.cpa_targetusers')
            ->Where('cdd_coldiscusshdr_fk=:dishdrpk',array(':dishdrpk' =>  $data['coldishdrpk']));
        $model->orderBy('coldiscussdtls_pk DESC');
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount()
        ];
    }
}
