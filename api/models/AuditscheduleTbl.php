<?php

namespace app\models;

use Yii;
use app\models\AppauditschedtmpTbl;
use app\models\ApplicationdtlstmpTbl;
use app\models\OpalusermstTbl;
use \api\components\Security;
use app\models\AppapprovalhdrTbl;
use api\modules\center\components\SiteAudit;

/**
 * This is the model class for table "auditscheddtls_tbl".
 *
 * @property int $auditscheddtls_pk Primary Key
 * @property int $asd_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $asd_projectmst_fk Reference to projectmst_pk
 * @property int $asd_opalusermst_fk Reference to opalusermst_fk
 * @property string $asd_date
 * @property int $asd_isavailable 1-Yes Available, 2-Not Available,3-Booked
 * @property int $asd_appauditschedtmp_fk Booked by Training Institute
 * @property string $asd_createdon
 * @property int $asd_createdby
 * @property string $asd_updatedon
 * @property int $asd_updatedby
 *
 * @property AppauditschedhstyTbl[] $appauditschedhstyTbls
 * @property AppauditschedmainTbl[] $appauditschedmainTbls
 * @property AppauditschedtmpTbl[] $appauditschedtmpTbls
 * @property AppauditschedtmpTbl $asdAppauditschedtmpFk
 * @property OpalmemberregmstTbl $asdOpalmemberregmstFk
 * @property OpalusermstTbl $asdOpalusermstFk
 * @property ProjectmstTbl $asdProjectmstFk
 */
class AuditscheduleTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auditscheddtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asd_opalmemberregmst_fk', 'asd_projectmst_fk', 'asd_opalusermst_fk', 'asd_date', 'asd_createdby'], 'required'],
            [['asd_opalmemberregmst_fk', 'asd_projectmst_fk', 'asd_opalusermst_fk', 'asd_isavailable', 'asd_appauditschedtmp_fk', 'asd_createdby', 'asd_updatedby'], 'integer'],
            [['asd_date', 'asd_createdon', 'asd_updatedon'], 'safe'],
            //[['asd_appauditschedtmp_fk'], 'exist', 'skipOnError' => true,  'targetAttribute' => ['asd_appauditschedtmp_fk' => 'appauditschedtmp_pk']],
            [['asd_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['asd_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['asd_opalusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['asd_opalusermst_fk' => 'opalusermst_pk']],
            [['asd_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['asd_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'auditscheddtls_pk' => 'Auditscheddtls Pk',
            'asd_opalmemberregmst_fk' => 'Asd Opalmemberregmst Fk',
            'asd_projectmst_fk' => 'Asd Projectmst Fk',
            'asd_opalusermst_fk' => 'Asd Opalusermst Fk',
            'asd_date' => 'Asd Date',
            'asd_isavailable' => 'Asd Isavailable',
            'asd_appauditschedtmp_fk' => 'Asd Appauditschedtmp Fk',
            'asd_createdon' => 'Asd Createdon',
            'asd_createdby' => 'Asd Createdby',
            'asd_updatedon' => 'Asd Updatedon',
            'asd_updatedby' => 'Asd Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppauditschedhstyTbls()
    {
        return $this->hasMany(AppauditschedhstyTbl::className(), ['appasdh_AuditSchedDtls_FK' => 'auditscheddtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppauditschedmainTbls()
    {
        return $this->hasMany(AppauditschedmainTbl::className(), ['appasdm_AuditschedDtls_FK' => 'auditscheddtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppauditschedtmpTbls()
    {
        return $this->hasMany(AppauditschedtmpTbl::className(), ['appasdt_auditscheddtls_fk' => 'auditscheddtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsdAppauditschedtmpFk()
    {
        //return $this->hasOne(AppauditschedtmpTbl::className(), ['appauditschedtmp_pk' => 'asd_appauditschedtmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsdOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'asd_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsdOpalusermstFk()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'asd_opalusermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsdProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'asd_projectmst_fk']);
    }


    public static function getStaff(){
    $requestParam = $_GET;
    ini_set ( 'max_execution_time', 1200);
    $query = self::find();


    $projectid = Security::decrypt($requestParam['projectid']);


     $query->select(['*' ,'DATE_FORMAT(asd_date,"%d-%m-%Y") AS asd_date', ]);
  //   $query->leftJoin('staffinforepo_tbl  repo','repo.staffinforepo_pk = appstaffinfotmp_tbl.appsit_staffinforepo_fk');
     $query->leftJoin('opalusermst_tbl  user','user.opalusermst_pk = auditscheddtls_tbl.asd_opalusermst_fk');
   //  $query->leftJoin('rolemst_tbl  role','role.rolemst_pk = opalusermst_tbl.oum_rolemst_fk');
    //  $query->where("FIND_IN_SET(3, oum_rolemst_fk)");
     $query->where([
        'asd_projectmst_fk'=> $projectid
    ]);
    if($requestParam['gridsearchValues'] != ''){

        $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);         
        $userpk = $gridsearchValues['asd_opalusermst_fk'];
        $date = $gridsearchValues['asd_date'];
        $available = $gridsearchValues['asd_isavailable'];
    

        if($userpk)    //civil id
{
        $query->andFilterWhere(['AND',
        ['LIKE', 'oum_firstname', $userpk],
    ]);
}           



    if($available){  // available   Filter
        if(count($available) >1){
            $appcond ="";
           if(in_array(1, $available)){ //yes
               $appcond .= "asd_isavailable='1' ||";
           }
           if(in_array(2, $available)){ //no
            $appcond .= "asd_isavailable='2' ||";
           }
           if(in_array(3, $available)){ //no
            $appcond .= "asd_isavailable='3' ||";
           }     
           $paymentstscond = rtrim($appcond, "||");
           $query->andWhere($paymentstscond);
        }else{
            if(in_array($available[0], [1,2,3])){ 
                $pymt_sts = $available[0];
                $query->andWhere("asd_isavailable='$pymt_sts' ");
            }
        }
    }
    
    if($date && $date['startDate']!=null && $date['endDate']!=null)
    {
        $query->andFilterWhere(['between', 'date(asd_date)', date('Y-m-d',strtotime($date['startDate'])), date('Y-m-d',strtotime($date['endDate']))]);
    }
 }

    $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];  
    $order_by = ($requestParam['order']=='asc')? SORT_ASC: SORT_DESC;
    $query->orderBy(["$sort_column" => $order_by]);   
    $query->asArray();
    // echo '<pre>'; print_r($query); exit;
    // echo 'success'; exit;

    $page = (!empty($requestParam['size']) && $requestParam['size'] != 'undefined') ? $requestParam['size'] : 10 ;  
    $provider = new \yii\data\ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => $page,
            'page' => $requestParam['page']
        ]
    ]);
   $raw = $query->createCommand()->getRawSql();
   
    $data = $provider->getModels();
    //$model     =   \app\models\OpalusermstTbl::find()->where("FIND_IN_SET(3, oum_rolemst_fk)")->asArray()->All();
    $model = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
    ->select(['*'])
    ->leftJoin('projapprovalworkflowhrd_tbl hrd','hrd.projapprovalworkflowhrd_pk = pawfud_projapprovalworkflowhrd_fk')
    ->leftJoin('projapprovalworkflowdtls_tbl ins','ins.projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk')
    ->leftJoin('opalusermst_tbl  user','user.opalusermst_pk = pawfud_opalusermst_fk')
    ->Where(['pawfd_rolemst_fk'=> 5])
    ->andWhere(['pawfh_projectmst_fk'=> $projectid])
    ->andWhere(['pawfh_formstatus'=> 1])
    ->andWhere(['oum_status'=> 'A'])
    ->groupBy('opalusermst_pk')
   // ->orderBy('asarct_order asc')
    ->asArray()
    ->all();
    $response = array();
    foreach ($data as $key => $favResData) {
        $favData[$key] = $favResData;
        $today =  date("d-m-Y");
        $curdate=strtotime($today);
        $mydate=strtotime($favResData['asd_date']);
        if($curdate > $mydate)
        {
        $isexpired = 1;
        }
        else{
         $isexpired = 0;
        }

      
        $favData[$key]['isexpired'] = $isexpired;
       }
    $response['data'] = $favData;
    $response['staffdata'] = $model;
    $response['totalcount'] = $provider->getTotalCount();
    $response['size'] = $page;
    return $response;


}


public static function saveAppscheduledate($requestdata){
  
    
    $data = AuditscheduleTbl::find()->where(['=','asd_opalusermst_fk',$requestdata['asd_opalusermst_fk']])->andWhere(['=', 'asd_projectmst_fk', $requestdata['asd_projectmst_fk']])->andWhere(['=','asd_date',$requestdata['asd_date']])->count();
   if($data == 0)
   {
     $model = new AuditscheduleTbl();
    $model->asd_opalmemberregmst_fk = $requestdata['asd_opalmemberregmst_fk'];
    $model->asd_projectmst_fk = $requestdata['asd_projectmst_fk'];
    $model->asd_opalusermst_fk = $requestdata['asd_opalusermst_fk'];
    $model->asd_date = $requestdata['asd_date'];
    $model->asd_isavailable = $requestdata['asd_isavailable'];
    $model->asd_createdon = $requestdata['asd_createdon'];
    $model->asd_createdby = $requestdata['asd_createdby'];  
    if($model->save()){
        return $model->auditscheddtls_pk;
    } else {
        echo "<pre>";
        var_dump($model->getErrors());
        exit;
    }   
   }
   return false;   
}
public function getAvailableDate($projPk){
    $result = AuditscheduleTbl::find()
    ->select(['asd_date'])
    ->where('asd_projectmst_fk = :projpk and asd_isavailable = :isavail',[':projpk' =>$projPk,':isavail'=>1])
    ->groupBy('asd_date')
    ->orderBy(['asd_date' => SORT_ASC])
    ->asArray()->all();
    return $result;
}
public function saveSiteAudit($sitedate,$appTempPk,$projPk){
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $data['status'] = false;
    $data['msg'] = 'failure';
    $data['siteauditor'] = '';
    $availabeauditor = AuditscheduleTbl::find()
        ->select(['auditscheddtls_pk','asd_opalusermst_fk','asd_date'])
        ->where('asd_projectmst_fk = :projpk and asd_isavailable = :isavail and asd_date =:date',[ ':projpk' => $projPk,':isavail'=>1,':date'=>$sitedate])
        ->groupBy(['asd_date','asd_opalusermst_fk'])
        ->orderBy(['auditscheddtls_pk' => SORT_ASC])
        ->asArray()->one();
    if(!empty($availabeauditor)){
        $model  = AppauditschedtmpTbl::find()->where('appasdt_applicationdtlstmp_fk = '.$appTempPk)->orderBy(['appauditschedtmp_pk' => SORT_DESC])->one();
        if(empty($model)){
            $model = new AppauditschedtmpTbl();
            $model->appasdt_applicationdtlstmp_fk = $appTempPk;
            $model->appasdt_auditscheddtls_fk = $availabeauditor['auditscheddtls_pk'];
            $model->appasdt_createdon = date('Y-m-d H:i:s');
            $model->appasdt_createdby = $userPk;
            $model->appasdt_status = 1;
        }else{
            
            $model->appasdt_applicationdtlstmp_fk = $appTempPk;
            $model->appasdt_auditscheddtls_fk = $availabeauditor['auditscheddtls_pk'];
            $model->appasdt_updatedon = date('Y-m-d H:i:s');
            $model->appasdt_updatedby = $userPk;
            $model->appasdt_status = 1;  
        }
      
        if($model->save()){
            $audittemppk = $model->appauditschedtmp_pk; 
            $recUpd = AuditscheduleTbl::findOne($availabeauditor['auditscheddtls_pk']);
            $recUpd->asd_isavailable = 3;
            $recUpd->asd_appauditschedtmp_fk = $audittemppk;
            if($recUpd->save()){
                $affectedRows = AuditscheduleTbl::updateAll(
                    ['asd_isavailable' => 2], 
                    ['and', ['asd_opalusermst_fk' =>$availabeauditor['asd_opalusermst_fk'] ], ['asd_date' =>$availabeauditor['asd_date'] ], ['asd_isavailable' =>1 ]]
                );
                $modelmain = ApplicationdtlstmpTbl::find()->where('applicationdtlstmp_pk = '.$appTempPk)->one();
                $modelmain->appdt_status = 9;
                $modelmain->appdt_updatedby = $userPk;
                $modelmain->appdt_updatedon = date("Y-m-d H:i:s");
                if(!$modelmain->save()){ 
                    $data['msg'] = $modelmain->getErrors();
                }else{
                    $data['msg'] = 'success';
                }
                $userInfo = OpalusermstTbl::findOne($availabeauditor['asd_opalusermst_fk']);
                if(!empty($userInfo)){
                    $siteauditor = $userInfo->oum_firstname;
                    $data['siteauditor'] = $siteauditor;                    
                }
                if($modelmain->appdt_apptype == 1){
                    $apptype = 1;
                }else if($modelmain->appdt_apptype == 2){
                    $apptype = 4;
                }else{
                    if($modelmain->appdt_projectmst_fk ==1){
                        $apptype = 2;
                    }else{
                        $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $modelmain->applicationdtlstmp_pk])->orderBy('appapprovalhdr_pk desc')->one();
                        $apptype = $updatemodel->aah_formstatus;
                    }
                }
                $info = SiteAudit::getApprovalHdrInfo($modelmain->appdt_projectmst_fk, $apptype, 5);
                $modelhdr = new AppapprovalhdrTbl;
                $modelhdr->aah_projapprovalworkflowhrd_fk = $info['projapprovalworkflowhrd_pk'];
                $modelhdr->aah_projapprovalworkflowdtls_fk = $info['projapprovalworkflowdtls_pk'];
                $modelhdr->aah_projapprovalworkflowuserdtls_fk = $info['projapprovalworkflowuserdtls_pk'];
                $modelhdr->aah_applicationdtlstmp_fk = $appTempPk;
                if($modelmain->appdt_apptype == 1){
                    $modelhdr->aah_formstatus = 1;
                }else if($modelmain->appdt_apptype == 2){
                    $modelhdr->aah_formstatus = 4;
                }else{
                    if($modelmain->appdt_projectmst_fk==1){
                        $modelhdr->aah_formstatus = 2;
                    }else{
                        $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $modelmain->applicationdtlstmp_pk])->orderBy('appapprovalhdr_pk desc')->one();
                        $modelhdr->aah_formstatus = $updatemodel->aah_formstatus;
                    }
                  
                }
                $modelhdr->aah_status = null;
                $modelhdr->save();
                if($projPk != 4){
                $projPk = ($modelmain->appdt_projectmst_fk==1)? 1: 2;
                }
                //Update history table SP process
                if($projPk == 4){
                    \Yii::$app->db->createCommand("call sp_RAS_tmh_insertion(:p1,:p2,:p3)")
                    ->bindValue(':p1' , $appTempPk)
                    ->bindValue(':p2' , '')
                    ->bindValue(':p3' , $projPk)
                    ->execute();
                }else{
                    \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
                    ->bindValue(':p1' , $appTempPk)
                    ->bindValue(':p2' , '')
                    ->bindValue(':p3' , $projPk)
                    ->execute();
                }
               
                $data['status'] = true;
                $data['appdt_status'] = (!empty($modelmain->appdt_status))? $modelmain->appdt_status: '';
            }
        }
    }
    return $data;
}
public function getSiteAuditDate($apptempPk){
    $auditinfo = AppauditschedtmpTbl::find()
        ->select(['auditscheddtls_pk','oum_firstname','asd_date','asd_isavailable','appasdt_status'])
        ->leftJoin('auditscheddtls_tbl','asd_appauditschedtmp_fk = appauditschedtmp_pk')
        ->leftJoin('opalusermst_tbl','opalusermst_pk = asd_opalusermst_fk')
        ->where('appasdt_applicationdtlstmp_fk = :temppk',[ ':temppk' => $apptempPk])
        ->orderBy(['appauditschedtmp_pk' => SORT_DESC])
        ->asArray()->one();
        if(!empty($auditinfo)){
            $currentdate = date('Y-m-d');
            $audit_date = $auditinfo['asd_date'];
            if($currentdate > $audit_date){
                $auditinfo['crosseddate'] = 1;
            }else{
                $auditinfo['crosseddate'] = 2;
            }
        }
    return $auditinfo;
}
}
