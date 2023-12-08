<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use common\components\Security;
use common\components\Drive;

/**
 * This is the model class for table "colmeetingdtls_tbl".
 *
 * @property int $colmeetingdtls_pk Primary key
 * @property int $cmd_collaborativemst_fk reference to collaborativemst_tbl
 * @property int $cmd_memcompmst_fk Reference to membercompanymst_tbl
 * @property string $cmd_colprojaudience_fk List of the users planned for the meeting. Reference to colprojaudience_tbl in comma separation. Yet to be confirmed
 * @property string $cmd_meetingtitle Meeting title
 * @property int $cmd_meetingtype Listing to be provided
 * @property int $cmd_presencetype Listing to be provided
 * @property string $cmd_meetingdate Meeting Date
 * @property string $cmd_meetingstarttime Meeting start time
 * @property string $cmd_meetingendtime Meeting end time
 * @property int $cmd_notiftype 1 - Day, 2 - Hours, 3 - Minutes
 * @property int $cmd_notifvalue Notification value
 * @property string $cmd_meetlocation Meeting Location
 * @property string $cmd_purposemeeting Purpose of the meeting
 * @property int $cmd_pinit 1-unpin, 2-pin
 */
class ColmeetingdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colmeetingdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmd_collaborativemst_fk', 'cmd_meetingtitle', 'cmd_meetingtype', 'cmd_meetingdate', 'cmd_meetingstarttime'], 'required'],
            [['cmd_collaborativemst_fk', 'cmd_memcompmst_fk', 'cmd_meetingtype', 'cmd_presencetype', 'cmd_notiftype', 'cmd_notifvalue', 'cmd_pinit'], 'integer'],
            [['cmd_colprojaudience_fk', 'cmd_purposemeeting'], 'string'],
            [['cmd_meetingdate', 'cmd_meetingstarttime', 'cmd_meetingendtime'], 'safe'],
            [['cmd_meetingtitle'], 'string', 'max' => 80],
            [['cmd_meetlocation'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'colmeetingdtls_pk' => 'Colmeetingdtls Pk',
            'cmd_collaborativemst_fk' => 'Cmd Collaborativemst Fk',
            'cmd_memcompmst_fk' => 'Cmd Memcompmst Fk',
            'cmd_colprojaudience_fk' => 'Cmd Colprojaudience Fk',
            'cmd_meetingtitle' => 'Cmd Meetingtitle',
            'cmd_meetingtype' => 'Cmd Meetingtype',
            'cmd_presencetype' => 'Cmd Presencetype',
            'cmd_meetingdate' => 'Cmd Meetingdate',
            'cmd_meetingstarttime' => 'Cmd Meetingstarttime',
            'cmd_meetingendtime' => 'Cmd Meetingendtime',
            'cmd_notiftype' => 'Cmd Notiftype',
            'cmd_notifvalue' => 'Cmd Notifvalue',
            'cmd_meetlocation' => 'Cmd Meetlocation',
            'cmd_purposemeeting' => 'Cmd Purposemeeting',
            'cmd_pinit' => 'Cmd Pinit',
        ];
    }

      /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserpreference()
    {
        return $this->hasOne(ColuserpreferenceTbl::className(), ['colmeetingdtls_pk' => 'cup_shared_fk']);
    }

    public function addmeeting($data)
    {
        $colmeetpk = $data['colmeetpk'];
        $colmeetdtls= ColmeetingdtlsTbl::find()
                ->where("colmeetingdtls_pk=:pk",[':pk'=>$colmeetpk])
                ->one();
        if(empty($colmeetdtls)){
            $colmeetdtls = new ColmeetingdtlsTbl();
            $colmeetdtls->cmd_collaborativemst_fk = Security::sanitizeInput($data['colmstpk'], "number");
            $colmeetdtls->cmd_memcompmst_fk = Security::sanitizeInput($data['comppk'], "number");
            $colmeetdtls->cmd_colprojaudience_fk = Security::sanitizeInput($data['colprojaudpk'], "number");
            $colmeetdtls->cmd_meetingtitle = Security::sanitizeInput($data['meetingtitle'], "string");
            $colmeetdtls->cmd_meetingtype = Security::sanitizeInput($data['meetingtype'], "number");
            $colmeetdtls->cmd_presencetype = Security::sanitizeInput($data['presencetype'], "number");
            $colmeetdtls->cmd_meetingdate = date("Y-m-d", strtotime($data['meetingdate']));
            $colmeetdtls->cmd_meetingstarttime = date("H:i:s", strtotime($data['meetingstarttime']));
            $colmeetdtls->cmd_meetingendtime = date("H:i:s", strtotime($data['meetingendtime']));
            $colmeetdtls->cmd_meetlocation = Security::sanitizeInput($data['location'], "string");
            $colmeetdtls->cmd_purposemeeting = Security::sanitizeInput($data['purposemeeting'], "string");
            $colmeetdtls->cmd_notiftype = Security::sanitizeInput($data['notiftype'], "number");
            $colmeetdtls->cmd_notifvalue = Security::sanitizeInput($data['notifvalue'], "number");
            $colmeetdtls->cmd_pinit = 1;
            $msg = "Meeting details inserted successfully";
        }else{
            $colmeetdtls->cmd_meetingtitle = Security::sanitizeInput($data['meetingtitle'], "string");
            $colmeetdtls->cmd_meetingtype = Security::sanitizeInput($data['meetingtype'], "number");
            $colmeetdtls->cmd_presencetype = Security::sanitizeInput($data['presencetype'], "number");
            $colmeetdtls->cmd_meetingdate = date("Y-m-d", strtotime($data['meetingdate']));
            $colmeetdtls->cmd_meetingstarttime = date("H:i:s", strtotime($data['meetingstarttime']));
            $colmeetdtls->cmd_meetingendtime = date("H:i:s", strtotime($data['meetingendtime']));
            $colmeetdtls->cmd_meetlocation = Security::sanitizeInput($data['location'], "string");
            $colmeetdtls->cmd_purposemeeting = Security::sanitizeInput($data['purposemeeting'], "string");
            $colmeetdtls->cmd_notiftype = Security::sanitizeInput($data['notiftype'], "number");
            $colmeetdtls->cmd_notifvalue = Security::sanitizeInput($data['notifvalue'], "number");
            $msg = "Meeting details updated successfully";
        }
        if($colmeetdtls->save()){
            return $msg;
        }else{
            return $colmeetdtls->getErrors();
        }
    }
    public function deletemeeting($data){
        $colmeetpk = Security::sanitizeInput($data['colmeetpk'], "number");
        $colmeetdtls= ColmeetingdtlsTbl::find()
                ->where("colmeetingdtls_pk=:pk",[':pk'=>$colmeetpk])
                ->one();
        if(!empty($colmeetdtls)){
            //$colmeetdtls->delete();
            $msg = "Meeting details deleted successfully";
        }else{
            $msg = "Something went wrong";
        }
        return $msg;
    }
    public function pinmeeting($data){
        $colmeetpk = Security::sanitizeInput($data['colmeetpk'], "number");
        $status = Security::sanitizeInput($data['pin_status'], "number");
        $colmeetdtls= ColmeetingdtlsTbl::find()
                ->where("colmeetingdtls_pk=:pk",[':pk'=>$colmeetpk])
                ->one();
        if(!empty($colmeetdtls)){
            $colmeetdtls->cmd_pinit = $status;
            if($colmeetdtls->save()){
                $msg = "Meeting Pinned";
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }
    public function meetinglisting($data)
    {
        $model=ColmeetingdtlsTbl::find()
            ->select(['colmeetingdtls_pk','cmd_meetingtitle','CASE WHEN `cmd_meetingtype` = 1 then "Online" WHEN `cmd_meetingtype` = 2 then "Offline" ELSE "" END as meetingtype','CASE WHEN `cmd_presencetype` = 1 then "Skype" WHEN `cmd_presencetype` = 2 then "Google Meet" WHEN `cmd_presencetype` = 3 then "Zoom" ELSE "" END as presencetype','DATE_FORMAT(cmd_meetingdate,"%d-%m-%Y") as cmd_meetingdate','DATE_FORMAT(cmd_meetingstarttime,"%h:%i %p") as cmd_meetingstarttime','DATE_FORMAT(cmd_meetingendtime,"%h:%i %p") as cmd_meetingendtime','UserMst_Pk','MemberCompMst_Pk','MCM_CompanyName','usermst_tbl.um_userdp as um_userdp'])
            ->leftJoin('colprojaudience_tbl','colprojaudience_tbl.colprojaudience_pk=colmeetingdtls_tbl.cmd_colprojaudience_fk')
            ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=colprojaudience_tbl.cpa_targetusers')
            ->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=usermst_tbl.UM_MemberRegMst_Fk')
            ->Where('cmd_collaborativemst_fk=:colmstpk',array(':colmstpk' =>  $data['colmstpk']))
            ->andWhere('colprojaudience_tbl.cpa_targetusers=:userpk',array(':userpk' =>  $data['userpk']));
        if(!empty($data['search'])){
            $model->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('cmd_meetingtitle', true), ':value',array(':value' =>  $data['search'])]]);
        }
        $model->orderBy('colmeetingdtls_pk DESC');
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model]);
        $active = [];
        $archive = [];
        foreach($provider->getModels() as $data){
            $info=[];
            $file_pk = $data['um_userdp'];
            $file_path='';
            if(!empty($file_pk)){
                $file_path = Drive::generateUrl($file_pk, $data['MemberCompMst_Pk'], $data['UserMst_Pk']);
            }
            $info['colmeetingdtls_pk']  =   $data['colmeetingdtls_pk'];      
            $info['cmd_meetingtitle']  =   $data['cmd_meetingtitle'];      
            $info['meetingtype']  =   $data['meetingtype'];      
            $info['presencetype']  =   $data['presencetype'];      
            $info['cmd_meetingdate']  =   $data['cmd_meetingdate'];      
            $info['cmd_meetingstarttime']  =   $data['cmd_meetingstarttime'];      
            $info['cmd_meetingendtime']  =   $data['cmd_meetingendtime'];      
            $info['MCM_CompanyName']  =   $data['MCM_CompanyName'];      
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
    public function getmeetinginfo($data)
    {
        $model=ColmeetingdtlsTbl::find()
            ->select(['colmeetingdtls_pk','cmd_meetingtitle','cmd_meetlocation','cmd_purposemeeting','cmd_notifvalue','CASE WHEN `cmd_notiftype` = 1 then "Day" WHEN `cmd_notiftype` = 2 then "Hours" WHEN `cmd_notiftype` = 3 then "Minutes" ELSE "" END as notifytype','CASE WHEN `cmd_meetingtype` = 1 then "Online" WHEN `cmd_meetingtype` = 2 then "Offline" ELSE "" END as meetingtype','CASE WHEN `cmd_presencetype` = 1 then "Skype" WHEN `cmd_presencetype` = 2 then "Google Meet" WHEN `cmd_presencetype` = 3 then "Zoom" ELSE "" END as presencetype','DATE_FORMAT(cmd_meetingdate,"%d-%m-%Y") as cmd_meetingdate','DATE_FORMAT(cmd_meetingstarttime,"%h:%i %p") as cmd_meetingstarttime','DATE_FORMAT(cmd_meetingendtime,"%h:%i %p") as cmd_meetingendtime','UserMst_Pk','MemberCompMst_Pk','MCM_CompanyName','usermst_tbl.um_userdp as um_userdp'])
            ->leftJoin('colprojaudience_tbl','colprojaudience_tbl.colprojaudience_pk=colmeetingdtls_tbl.cmd_colprojaudience_fk')
            ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=colprojaudience_tbl.cpa_targetusers')
            ->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=usermst_tbl.UM_MemberRegMst_Fk')
            ->Where('colmeetingdtls_pk=:meetingpk',array(':meetingpk' =>  $data['colmeetpk']))
            ->andWhere('colprojaudience_tbl.cpa_targetusers=:userpk',array(':userpk' =>  $data['userpk']))
            ->asArray()->one();
        $info=[];
        if(!empty($model)){            
            $file_pk = $model['um_userdp'];
            $file_path='';
            if(!empty($file_pk)){
                $file_path = Drive::generateUrl($file_pk, $model['MemberCompMst_Pk'], $model['UserMst_Pk']);
            }
            $info['colmeetingdtls_pk']  =   $model['colmeetingdtls_pk'];      
            $info['cmd_meetingtitle']  =   $model['cmd_meetingtitle'];      
            $info['cmd_meetlocation']  =   $model['cmd_meetlocation'];      
            $info['cmd_purposemeeting']  =   $model['cmd_purposemeeting'];      
            $info['notifytype']  =   $model['notifytype'];      
            $info['cmd_notifvalue']  =   $model['cmd_notifvalue'];      
            $info['meetingtype']  =   $model['meetingtype'];      
            $info['presencetype']  =   $model['presencetype'];      
            $info['cmd_meetingdate']  =   $model['cmd_meetingdate'];      
            $info['cmd_meetingstarttime']  =   $model['cmd_meetingstarttime'];      
            $info['cmd_meetingendtime']  =   $model['cmd_meetingendtime'];      
            $info['MCM_CompanyName']  =   $model['MCM_CompanyName'];      
            $info['file_path']  =   $file_path;    
            $model["cmd_colprojaudience_fk"] = array('1,2');
    
            $members = ColprojaudienceTbl::find()->where(['in', 'colprojaudience_pk', $model["cmd_colprojaudience_fk"]])->all();

            $discussmembers = [];
            $mcpPk =  \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
            if(!empty($members)){
                foreach($members as $member){
                   $image_link = Drive::generateUrl($member->user->um_userdp,$mcpPk,$member->user->UserMst_Pk);
                    $discussmembers[] = [
                        'fisrt_name' => $member->user->um_firstname,
                        'middle_name' => $member->user->um_middlename,
                        'last_name' => $member->user->um_lastname,
                        'user_dp' => $image_link
                    ];
                }
            }
            $info['members'] =  $discussmembers;
        }
      
        return $info;
    }
}
