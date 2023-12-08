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

/**
 * This is the model class for table "collaborativemst_tbl".
 *
 * @property int $collaborativemst_pk Primary key
 * @property int $cpm_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property int $cpm_basemodulemst_fk basemodulemst_tbl pk for the module referred
 * @property int $cpm_referenceno Reference to the table that is referred.(i.e) if project is created for a particular tender then primary key of the tender
 * @property string $cpm_projectname Project Name
 * @property string $cpm_projdesc Project Description
 * @property int $cpm_status 1-Active,2-archived, 3-inactive
 * @property string $cpm_createdon Datetime of creation
 * @property int $cpm_createdby Reference to usermst_tbl
 * @property string $cpm_createdbyipaddr IP Address of the user
 * @property int $cpm_createdfrom 1 - Web, 2 - Android, 3 - IOS
 */
class CollaborativemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'collaborativemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cpm_memberregmst_fk', 'cpm_basemodulemst_fk', 'cpm_referenceno', 'cpm_projectname', 'cpm_createdon', 'cpm_createdby', 'cpm_createdfrom'], 'required'],
            [['cpm_memberregmst_fk', 'cpm_basemodulemst_fk', 'cpm_referenceno', 'cpm_status', 'cpm_createdby', 'cpm_createdfrom'], 'integer'],
            [['cpm_projdesc'], 'string'],
            [['cpm_createdon'], 'safe'],
            [['cpm_projectname'], 'string', 'max' => 250],
            [['cpm_createdbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'collaborativemst_pk' => 'Collaborativemst Pk',
            'cpm_memberregmst_fk' => 'Cpm Memberregmst Fk',
            'cpm_basemodulemst_fk' => 'Cpm Basemodulemst Fk',
            'cpm_referenceno' => 'Cpm Referenceno',
            'cpm_projectname' => 'Cpm Projectname',
            'cpm_projdesc' => 'Cpm Projdesc',
            'cpm_status' => 'Cpm Status',
            'cpm_createdon' => 'Cpm Createdon',
            'cpm_createdby' => 'Cpm Createdby',
            'cpm_createdbyipaddr' => 'Cpm Createdbyipaddr',
            'cpm_createdfrom' => 'Cpm Createdfrom',
        ];
    }
    public function addcollaborate($data)
    {
        $colpk = $data['colmstpk'];
        $coldtls= CollaborativemstTbl::find()
                ->where("collaborativemst_pk=:pk",[':pk'=>$colpk])
                ->one();
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if(empty($coldtls)){
            $coldtls = new CollaborativemstTbl();
            $coldtls->cpm_memberregmst_fk = Security::sanitizeInput($data['regpk'], "number");
            $coldtls->cpm_basemodulemst_fk = Security::sanitizeInput($data['modulepk'], "number");
            $coldtls->cpm_referenceno = Security::sanitizeInput($data['ref_no'], "number");
            $coldtls->cpm_projectname = Security::sanitizeInput($data['title'], "string");
            $coldtls->cpm_projdesc = Security::sanitizeInput($data['desc'], "string");
            $coldtls->cpm_createdon = date("Y-m-d H:i:s");
            $coldtls->cpm_status = 1;
            $coldtls->cpm_type = Security::sanitizeInput($data['type'], "number");
            $coldtls->cpm_createdby = $userPK;
            $coldtls->cpm_createdbyipaddr = $ip_address;
            $coldtls->cpm_createdfrom = Security::sanitizeInput($data['createdfrom'], "number");
            $msg = "Collaboration inserted successfully";
        }else{
            $coldtls->cpm_basemodulemst_fk = Security::sanitizeInput($data['modulepk'], "number");
            $coldtls->cpm_referenceno = Security::sanitizeInput($data['ref_no'], "number");
            $coldtls->cpm_projectname = Security::sanitizeInput($data['title'], "string");
            $coldtls->cpm_projdesc = Security::sanitizeInput($data['desc'], "string");
            $msg = "Collaboration updated successfully";
        }

        if($coldtls->save()){
            return $msg;
        }else{
            return $coldtls->getErrors();
        }
    }
    public function cardlisting($data)
    {
        $size = Security::sanitizeInput($data['size'], "number");
        $order = Security::sanitizeInput($data['order'], "string");
        $page_limit = Security::sanitizeInput($data['page'], "number");
        $user_type = (!empty($data['user_type']))? $data['user_type']: 1;
        $page=0;
        
        if(!empty($page_limit) && $page_limit>1){
            $page = $page_limit - 1;
        }
       
        $model=CollaborativemstTbl::find()
            ->select(['collaborativemst_pk','colprojaudience_pk','cpm_referenceno','cpm_projectname','cpm_projdesc','um_firstname','MCM_CompanyName','DATE_FORMAT(cpm_createdon,"%d-%m-%Y %h:%i %p") as cpm_createdon',
                'CASE WHEN `cpa_isdiscussion` = 1 then "Yes" 
                WHEN `cpa_isdiscussion` = 2 then "No" 
                ELSE "" END as discussion_status',
                'CASE WHEN `cpm_type` = 1 then "Internal" 
                WHEN `cpm_type` = 2 then "External" 
                ELSE "" END as user_type', 'cpa_accdeclon', 'cpa_invitestatus'])
            ->leftJoin('colprojaudience_tbl','colprojaudience_tbl.cpa_collaborativemst_fk=collaborativemst_tbl.collaborativemst_pk')
            ->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=collaborativemst_tbl.cpm_memberregmst_fk')
            ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=collaborativemst_tbl.cpm_createdby')
            ->where('cpm_memberregmst_fk=:reg_pk',array(':reg_pk' =>  $data['regpk']))
            ->andWhere('colprojaudience_tbl.cpa_targetusers=:userpk',array(':userpk' =>  $data['userpk']))
            ->andWhere('cpm_basemodulemst_fk=:basemodule_pk',array(':basemodule_pk' =>  $data['basemodule_pk']))
            ->andWhere('cpa_usertype=:usertype',array(':usertype' =>  $user_type));
        if(!empty($data['search'])){
            $model->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('cpm_referenceno', true), ':value',array(':value' =>  $data['search'])],
                ['LIKE',Common::getTableWithPrefix('cpm_projectname', true), ':value',array(':value' =>  $data['search'])]]);
        }
        if(!empty($data['start_date']) && !empty($data['end_date'])){
            $start_date = date("Y-m-d", strtotime($data['start_date']));
            $end_date = date("Y-m-d", strtotime($data['end_date']));
            $model->andWhere(['between', 'cpm_createdon', $start_date, $end_date]);
        }
        if(!empty($data['modules_pk'])){
            $model->where(['in', 'cpm_basemodulemst_fk',$data['modules_pk']]);
        }
        $model->groupBy('collaborativemst_pk');
        if(strtolower($order)=='desc'){
            $model->orderBy('collaborativemst_pk DESC');
        }else{
            $model->orderBy('collaborativemst_pk ASC');    
        }
        $page_size=(!empty($size))?$size:10;
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model, 'pagination' => ['pageSize' =>$page_size,'page'=>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page_size
        ];
    }
    public function collaboratecountlisting($regpk){
        $model=CollaborativemstTbl::find()
            ->select(['count(cpm_basemodulemst_fk) as cardcount','bmm_name','DATE_FORMAT(cpm_createdon,"%d-%m-%Y") as cpm_createdon'])
            ->leftJoin('basemodulemst_tbl','basemodulemst_tbl.basemodulemst_pk=collaborativemst_tbl.cpm_basemodulemst_fk')
            ->where('cpm_memberregmst_fk=:reg_pk',array(':reg_pk' =>  $regpk))
            ->groupBy(['cpm_basemodulemst_fk'])
            ->orderBy('cpm_createdon DESC')
            ->asArray()->all();
        return $model;
    }
    public function changecardstatus($data){
        $colmstpk = Security::sanitizeInput($data['colmstpk'], "number");
        $status = Security::sanitizeInput($data['card_status'], "number");
        $colmstdtls= CollaborativemstTbl::find()
                ->where("collaborativemst_pk=:pk",[':pk'=>$colmstpk])
                ->one();
        if(!empty($colmstdtls)){
            $colmstdtls->cpm_status=$status;
            if($colmstdtls->save()){
                if($status==2){
                    $msg = "Card status archive";
                }elseif($status==3){
                    $msg = "Card status disabled";
                } 
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }

    public function getCreatedby(){
        return $this->hasOne(\common\models\UsermstTbl::class, ['UserMst_pk' => 'cpm_createdby']);
       
    }

    public function getAllmembers(){
        return $this->hasMany(\api\modules\ct\models\ColprojaudienceTbl::class, ['cpa_collaborativemst_fk' => 'collaborativemst_pk']);
    }
}
