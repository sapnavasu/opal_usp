<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use common\components\Security;
use api\modules\ct\models\ColdiscussdtlsTbl;
use common\components\Common;
use api\modules\ct\models\ColprojaudienceTbl;
use common\components\Drive;
use api\modules\ct\models\CollaborativemstTbl;
use api\modules\ct\models;

/**
 * This is the model class for table "coldiscusshdr_tbl".
 *
 * @property int $coldiscusshdr_pk Primary key
 * @property int $cdh_collaborativemst_fk Reference to collaborativemst_tbl
 * @property int $cdh_fromcolprojaudience_fk Initiating user id. Ref to colprojaudience_tbl
 * @property string $cdh_discussmembers Projaudience_tbl in comma separation
 * @property string $cdh_title Title of the discussion
 * @property string $cdh_desc Discussion content
 * @property int $cdh_status Discussion status. 0 - InActive, 1 - Active
 * @property int $cdh_pinit 1-unpin, 2-pin
 * @property string $cdh_ipaddress IP Address of the user
 * @property int $cdh_timezone Reference to timezone_tbl
 * @property string $cdh_createdon Date of creation
 * @property int $cdh_createdfrom 1 - Web, 2 - Android, 3 - IOS
 */
class ColdiscusshdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coldiscusshdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cdh_collaborativemst_fk', 'cdh_fromcolprojaudience_fk', 'cdh_title', 'cdh_desc', 'cdh_status', 'cdh_timezone', 'cdh_createdon', 'cdh_createdfrom'], 'required'],
            [['cdh_collaborativemst_fk', 'cdh_fromcolprojaudience_fk', 'cdh_status', 'cdh_pinit', 'cdh_timezone', 'cdh_createdfrom'], 'integer'],
            [['cdh_discussmembers', 'cdh_desc'], 'string'],
            [['cdh_createdon'], 'safe'],
            [['cdh_title'], 'string', 'max' => 100],
            [['cdh_ipaddress'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coldiscusshdr_pk' => 'Coldiscusshdr Pk',
            'cdh_collaborativemst_fk' => 'Cdh Collaborativemst Fk',
            'cdh_fromcolprojaudience_fk' => 'Cdh Fromcolprojaudience Fk',
            'cdh_discussmembers' => 'Cdh Discussmembers',
            'cdh_title' => 'Cdh Title',
            'cdh_desc' => 'Cdh Desc',
            'cdh_status' => 'Cdh Status',
            'cdh_pinit' => 'Cdh Pinit',
            'cdh_ipaddress' => 'Cdh Ipaddress',
            'cdh_timezone' => 'Cdh Timezone',
            'cdh_createdon' => 'Cdh Createdon',
            'cdh_createdfrom' => 'Cdh Createdfrom',
        ];
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserpreference()
    {
        return $this->hasOne(ColuserpreferenceTbl::className(), ['coldiscusshdr_pk' => 'cup_shared_fk']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(CollaborativemstTbl::className(), ['collaborativemst_pk' => 'cdh_collaborativemst_fk']);
    }
    
    public function adddiscussion($data)
    {
        $coldishdrpk = $data['coldishdrpk'];
        $coldishdrdtls= ColdiscusshdrTbl::find()
                ->where("coldiscusshdr_pk=:pk",[':pk'=>$coldishdrpk])
                ->one();
        $ip_address = Common::getIpAddress();
        if(empty($coldishdrdtls)){
            $coldishdrdtls = new ColdiscusshdrTbl();
            $coldishdrdtls->cdh_collaborativemst_fk = Security::sanitizeInput($data['colmstpk'], "number");
            $coldishdrdtls->cdh_fromcolprojaudience_fk = Security::sanitizeInput($data['colprojaudpk'], "number");
            $coldishdrdtls->cdh_discussmembers = Security::sanitizeInput($data['discuss_members'], "string");
            $coldishdrdtls->cdh_title = Security::sanitizeInput($data['disc_title'], "string");
            $coldishdrdtls->cdh_desc = Security::sanitizeInput($data['disc_desc'], "string");
            $coldishdrdtls->cdh_status = 1;
            $coldishdrdtls->cdh_pinit = 1;
            $coldishdrdtls->cdh_timezone = Security::sanitizeInput($data['timezonepk'], "number");
            $coldishdrdtls->cdh_createdon = date('Y-m-d H:i:s');
            $coldishdrdtls->cdh_ipaddress = $ip_address;
            $coldishdrdtls->cdh_createdfrom = Security::sanitizeInput($data['cdh_createdfrom'], "number");
            $msg = "Discussion created successfully";
        }else{
            $coldishdrdtls->cdh_title = Security::sanitizeInput($data['disc_title'], "string");
            $coldishdrdtls->cdh_desc = Security::sanitizeInput($data['disc_desc'], "string");
            $msg = "Discussion updated successfully";
        }
        if($coldishdrdtls->save()){
            return $msg;
        }else{
            return $coldishdrdtls->getErrors();
        }
    }
    public function discussionlisting($data)
    {
        $model=ColdiscusshdrTbl::find()
            ->select(['coldiscusshdr_pk','cdh_title','cdh_desc','UserMst_Pk','MemberCompMst_Pk','MCM_CompanyName','usermst_tbl.um_userdp as um_userdp','usermst_tbl.um_firstname as um_firstname','DATE_FORMAT(cdh_createdon,"%d-%m-%Y") as cdh_createdon'])
            ->leftJoin('colprojaudience_tbl','colprojaudience_tbl.colprojaudience_pk=coldiscusshdr_tbl.cdh_fromcolprojaudience_fk')
            ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=colprojaudience_tbl.cpa_targetusers')
            ->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=usermst_tbl.UM_MemberRegMst_Fk')
            ->Where('cdh_collaborativemst_fk=:colmstpk',array(':colmstpk' =>  $data['colmstpk']))
            ->andWhere('colprojaudience_tbl.cpa_targetusers=:userpk',array(':userpk' =>  $data['userpk']));
        if(!empty($data['search'])){
            $model->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('cdh_title', true), ':value',array(':value' =>  $data['search'])]]);
        }
        $model->orderBy('coldiscusshdr_pk DESC');
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
            $info['coldiscusshdr_pk']  =   $data['coldiscusshdr_pk'];      
            $info['cdh_title']  =   $data['cdh_title'];      
            $info['cdh_desc']  =   $data['cdh_desc'];      
            $info['um_firstname']  =   $data['um_firstname'];      
            $info['MCM_CompanyName']  =   $data['MCM_CompanyName'];      
            $info['cdh_createdon']  =   $data['cdh_createdon'];      
            $info['user_image']  =   $file_path;  

            if($data->userpreference){
                array_push($archive, $info); 
            } else {
                array_push($active, $info);
            }  
        }
        
        $val = ['active' => $active, 'archive' => $archive];
        $colmst = CollaborativemstTbl::findOne($data['colmstpk']);
        $cardDetail = [
            'referenceno' => $colmst->cpm_referenceno,
            'projectname' => $colmst->cpm_projectname,
            'type' => $colmst->cpm_type
        ];
        $members = [];
        
        if(!empty($colmst->allmembers)){
            $mcpPk =  \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
            foreach($colmst->allmembers as $member){
                $image_link = Drive::generateUrl($member->user->um_userdp,$mcpPk,$member->user->UserMst_Pk);
                $members[] = [
                    'fisrt_name' => $member->user->um_firstname,
                    'middle_name' => $member->user->um_middlename,
                    'last_name' => $member->user->um_lastname,
                    'user_dp' => $image_link
                ]; 
            }
        }
        $cardDetail['members'] = $members;
        return [
            'items' => $val,
            'cardDetail' => $cardDetail,
            'total_count' => $provider->getTotalCount()
        ];
    }
    public function discussioninfo($data)
    {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $model=ColdiscusshdrTbl::find()
            ->select(['cdh_title','cdh_desc','usermst_tbl.um_userdp','usermst_tbl.um_firstname','DATE_FORMAT(cdh_createdon,"%d-%m-%Y") as cdh_createdon, cdh_collaborativemst_fk, coldiscusshdr_pk'])
            ->leftJoin('colprojaudience_tbl','colprojaudience_tbl.colprojaudience_pk=coldiscusshdr_tbl.cdh_fromcolprojaudience_fk')
            ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=colprojaudience_tbl.cpa_targetusers')
            ->Where('coldiscusshdr_pk=:dishdrpk',array(':dishdrpk' =>  $data['coldishdrpk']))
            ->asArray()->one();

        if($model){
            $members = ColprojaudienceTbl::find()->where(['cpa_collaborativemst_fk' => $model['cdh_collaborativemst_fk'], 'cpa_isdiscussion' => 1])->all();
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
            $commentsCount = ColdiscussdtlsTbl::find()->where(['cdd_coldiscusshdr_fk' => $model['coldiscusshdr_pk']])->count();
           
            $data = array(
                'items' =>  $model,
                'members' => $discussmembers,
                'commentsCount' => $commentsCount
            );
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'U',
                'returndata' => $data
            );
        }
        return $result;
    }
    public function deletediscussion($data){
        $coldischdrpk = Security::sanitizeInput($data['coldischdrpk'], "number");
        $status = Security::sanitizeInput($data['disc_status'], "number");
        $colnotesdtls= ColdiscusshdrTbl::find()
                ->where("coldiscusshdr_pk=:pk",[':pk'=>$coldischdrpk])
                ->one();
        if(!empty($colnotesdtls)){
            $colnotesdtls->cdh_status = $status;
            if($colnotesdtls->save()){
                $msg = "Discussion deleted successfully";
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }
    public function pindiscussion($data){
        $coldischdrpk = Security::sanitizeInput($data['coldischdrpk'], "number");
        $status = Security::sanitizeInput($data['pin_status'], "number");
        $colnotesdtls= ColdiscusshdrTbl::find()
                ->where("coldiscusshdr_pk=:pk",[':pk'=>$coldischdrpk])
                ->one();
        if(!empty($colnotesdtls)){
            $colnotesdtls->cdh_pinit = $status;
            if($colnotesdtls->save()){
                $msg = "Discussion Pinned";
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }
}
