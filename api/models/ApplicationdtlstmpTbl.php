<?php

namespace app\models;

use Yii;
use \api\components\Security;
use \yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use api\components\Drive;
use api\components\Common;
use \app\models\OpalInvoiceTbl;
use app\models\ReferencemstTbl;
use api\modules\center\components\SiteAudit;
/**
 * This is the model class for table "applicationdtlstmp_tbl".
 *
 * @property int $applicationdtlstmp_pk Primary Key
 * @property int $appdt_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $appdt_projectmst_fk Reference to projectmst_pk
 * @property int $appdt_grademst_fk Reference to grademst_pk
 * @property string $appdt_appreferno
 * @property int $appdt_apptype 1-Fresh, 2-Renewal,3-Updated
 * @property string $appdt_gradingreason
 * @property string $appdt_recommendation Reference to memcompfiledtls_pk
 * @property int $appdt_auditreport Reference to memcompfiledtls_pk
 * @property int $appdt_status 1-Yet to Submit for Desktop Review,2-Submitted for Desktop Review,3-Declined during Desktop Review,4-Re-submitted for Desktop Review,5-Yet to Pay,6-Paid - Confirmation Pending,7-Awaiting for Site Audit Date,8-Confirm Site Audit Date,9-Ready for Audit,10-Submitted for Quality Manager Approval,11-Submitted for Authority Approval,12-Submitted for CEO Approval,13-Site Audit Declined,14-Re-Submitted for Quality Manager Approval,15-Re-Submitted for Authority Approval,16-Re-Submitted for CEO Approval,17-Approved,18-Declined by finance team,19-Suspended,20-Certification Form Declined
 * @property string $appdt_submittedon
 * @property int $appdt_submittedby
 * @property string $appdt_updatedon
 * @property int $appdt_updatedby
 * @property string $appdt_verificationno
 * @property string $appdt_certificategenon Certificate generated on
 * @property string $appdt_certificatepath
 * @property string $appdt_certificateexpiry
 * @property string $appdt_appdecon
 * @property int $appdt_appdecby
 * @property string $appdt_appdeccomment
 *
 * @property AppapprovalhdrTbl[] $appapprovalhdrTbls
 * @property AppauditschedtmpTbl[] $appauditschedtmpTbls
 * @property AppcompanydtlstmpTbl[] $appcompanydtlstmpTbls
 * @property AppcoursedtlstmpTbl[] $appcoursedtlstmpTbls
 * @property AppdocsubmissiontmpTbl[] $appdocsubmissiontmpTbls
 * @property AppinstinfohstyTbl[] $appinstinfohstyTbls
 * @property AppinstinfotmpTbl[] $appinstinfotmpTbls
 * @property AppintrecogtmpTbl[] $appintrecogtmpTbls
 * @property ApplicationdtlshstyTbl[] $applicationdtlshstyTbls
 * @property ApplicationdtlsmainTbl $applicationdtlsmainTbl
 * @property GrademstTbl $appdtGrademstFk
 * @property OpalmemberregmstTbl $appdtOpalmemberregmstFk
 * @property ProjectmstTbl $appdtProjectmstFk
 * @property AppoffercoursetmpTbl[] $appoffercoursetmpTbls
 * @property AppoprcontracttmpTbl[] $appoprcontracttmpTbls
 * @property ApppymtdtlstmpTbl[] $apppymtdtlstmpTbls
 * @property ApppytminvoicedtlsTbl[] $apppytminvoicedtlsTbls
 * @property AppstaffinfotmpTbl[] $appstaffinfotmpTbls
 * @property AppstafflocationtmpTbl[] $appstafflocationtmpTbls
 */
class ApplicationdtlstmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'applicationdtlstmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appdt_opalmemberregmst_fk', 'appdt_projectmst_fk', 'appdt_status'], 'required'],
            [['appdt_opalmemberregmst_fk', 'appdt_projectmst_fk', 'appdt_grademst_fk', 'appdt_apptype', 'appdt_auditreport', 'appdt_status', 'appdt_submittedby', 'appdt_updatedby', 'appdt_appdecby'], 'integer'],
            
            [['appdt_gradingreason', 'appdt_recommendation', 'appdt_certificatepath', 'appdt_appdeccomment'], 'string'],
            [['appdt_submittedon', 'appdt_updatedon', 'appdt_certificategenon', 'appdt_certificateexpiry', 'appdt_appdecon'], 'safe'],
            [['appdt_verificationno'], 'string', 'max' => 50],
            [['appdt_grademst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => GrademstTbl::className(), 'targetAttribute' => ['appdt_grademst_fk' => 'grademst_pk']],
            [['appdt_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appdt_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['appdt_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['appdt_projectmst_fk' => 'projectmst_pk']],

         ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'applicationdtlstmp_pk' => 'Primary Key',
            'appdt_opalmemberregmst_fk' => 'Reference to opalmemberregmst_pk',
            'appdt_projectmst_fk' => 'Reference to projectmst_pk',
            'appdt_grademst_fk' => 'Reference to grademst_pk',
            'appdt_appreferno' => 'Appdt Appreferno',
            'appdt_apptype' => '1-Fresh, 2-Renewal,3-Updated',
            'appdt_gradingreason' => 'Appdt Gradingreason',
            'appdt_recommendation' => 'Reference to memcompfiledtls_pk',
            'appdt_auditreport' => 'Reference to memcompfiledtls_pk',
            'appdt_status' => '1-Yet to Submit for Desktop Review,2-Submitted for Desktop Review,3-Declined during Desktop Review,4-Re-submitted for Desktop Review,5-Yet to Pay,6-Paid - Confirmation Pending,7-Awaiting for Site Audit Date,8-Confirm Site Audit Date,9-Ready for Audit,10-Submitted for Quality Manager Approval,11-Submitted for Authority Approval,12-Submitted for CEO Approval,13-Site Audit Declined,14-Re-Submitted for Quality Manager Approval,15-Re-Submitted for Authority Approval,16-Re-Submitted for CEO Approval,17-Approved,18-Declined by finance team,19-Suspended,20-Certification Form Declined',
            'appdt_submittedon' => 'Appdt Submittedon',
            'appdt_submittedby' => 'Appdt Submittedby',
            'appdt_updatedon' => 'Appdt Updatedon',
            'appdt_updatedby' => 'Appdt Updatedby',
            'appdt_verificationno' => 'Appdt Verificationno',
            'appdt_certificategenon' => 'Certificate generated on',
            'appdt_certificatepath' => 'Appdt Certificatepath',
            'appdt_certificateexpiry' => 'Appdt Certificateexpiry',
            'appdt_appdecon' => 'Appdt Appdecon',
            'appdt_appdecby' => 'Appdt Appdecby',
            'appdt_appdeccomment' => 'Appdt Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppauditschedtmpTbls()
    {
        return $this->hasMany(AppauditschedtmpTbl::className(), ['appasdt_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdocsubmissiontmpTbls()
    {
        return $this->hasMany(AppdocsubmissiontmpTbl::className(), ['appdst_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppinstinfotmpTbls()
    {
        return $this->hasMany(AppinstinfotmpTbl::className(), ['appiit_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintrecogtmpTbls()
    {
        return $this->hasMany(AppintrecogtmpTbl::className(), ['appintit_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprcontracttmpTbls()
    {
        return $this->hasMany(AppoprcontracttmpTbl::className(), ['appoct_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppymtdtlstmpTbls()
    {
        return $this->hasMany(ApppymtdtlstmpTbl::className(), ['apppdt_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']);
    }

    /**
     * {@inheritdoc}
     * @return ApplicationdtlstmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApplicationdtlstmpTblQuery(get_called_class());
    }


    public static function finanacevalidbtn()
    {

        return null;
    }

    public static function overallapprovdec(){
      
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request = Yii::$app->request;
        $app_ref_id = $request->post('app_ref_id');
        $select_valitate = $request->post('select_valitate');
        $comments = $request->post('comments');
        $todays = date("Y-m-d h:i:s");
     $model_ApplicationdtlstmpTbl =  ApplicationdtlstmpTbl::findOne(['appdt_appreferno' => $app_ref_id]);
     $staffdata = AppstaffinfotmpTbl::find()
     ->select(['appsit_iscarddetails','appsit_status'])
     ->where(['appsit_applicationdtlstmp_fk' => $model_ApplicationdtlstmpTbl->applicationdtlstmp_pk])
     ->asArray()
     ->all();
     foreach($staffdata as $staffvalue){
         $staffcardarray[] = $staffvalue['appsit_iscarddetails'];
         $staffstatus[] = $staffvalue['appsit_status'];
     }
    if($select_valitate == 3)
     {
        if($model_ApplicationdtlstmpTbl->appdt_apptype == 3){
           
            $staffcountdata = AppstaffinfotmpTbl::find()
            ->select(['staffevaluationtmp_pk'])
            ->leftJoin('staffevaluationtmp_tbl','set_appstaffinfotmp_fk = appostaffinfotmp_pk')
            ->where(['appsit_applicationdtlstmp_fk' => $model_ApplicationdtlstmpTbl->applicationdtlstmp_pk])
            ->andWhere(['IS NOT', 'set_staffevanfee', null])
            ->andWhere(['set_asmttype' => 1])
            ->andWhere(['IS','set_apppytminvoicedtls_fk' ,null])
            ->groupBy('set_appstaffinfotmp_fk')
            ->asArray()
            ->count();
       
            if(($staffcountdata > 0)&&  ($model_ApplicationdtlstmpTbl->appdt_status == 2 ||  $model_ApplicationdtlstmpTbl->appdt_status == 4)){

                $model_ApplicationdtlstmpTbl->appdt_status = 5;

            }else{
               

                if($model_ApplicationdtlstmpTbl->appdt_status == 2 || $model_ApplicationdtlstmpTbl->appdt_status == 4){
                    $status = 10;
                }
                if($model_ApplicationdtlstmpTbl->appdt_status == 10 ){
                   $status = 11;
               }
               if($model_ApplicationdtlstmpTbl->appdt_status == 11 ){
                   $status = 17;
               }
               if($model_ApplicationdtlstmpTbl->appdt_status == 20 ){
                $status = 14;
            }
            if($model_ApplicationdtlstmpTbl->appdt_status == 14){
                $status = 11;
            }
               $model_ApplicationdtlstmpTbl->appdt_status = $status;
            }
         }else{
            $model_ApplicationdtlstmpTbl->appdt_status = 5;
         }
           
     }
 else if($select_valitate == 4)
     
     { 
        // $model_ApplicationdtlstmpTbl->appdt_status = 3;
        if($model_ApplicationdtlstmpTbl->appdt_apptype == 3 ){
            if( $model_ApplicationdtlstmpTbl->appdt_status != 2 &&  $model_ApplicationdtlstmpTbl->appdt_status != 4){
            $previous = ApplicationdtlshstyTbl::find()->select('appdh_status')->where(['appdh_applicationdtlstmp_fk' => $model_ApplicationdtlstmpTbl->applicationdtlstmp_pk])
            ->orderBy(['applicationdtlshsty_pk' => SORT_DESC])->asArray()->all();
            
           
            $prev = '';
                foreach ($previous  as $value) {
                    if ($value['appdh_status'] == 2) {
                        $prev = 2;
                        break;
                    }
                    if ($value['appdh_status'] == 9) {
                        $prev = 9;
                        break;
                    }
                }
            if($prev == 2){
                $model_ApplicationdtlstmpTbl->appdt_status = 20;  
            }else{
                $model_ApplicationdtlstmpTbl->appdt_status = 9;  
            }
        }else{
            if( $model_ApplicationdtlstmpTbl->appdt_status == 2 ||  $model_ApplicationdtlstmpTbl->appdt_status == 4){
  
                $model_ApplicationdtlstmpTbl->appdt_status = 3;
            }
            if($model_ApplicationdtlstmpTbl->appdt_apptype == 3 && ($model_ApplicationdtlstmpTbl->appdt_status == 10 || $model_ApplicationdtlstmpTbl->appdt_status == 11)){
    
            $model_ApplicationdtlstmpTbl->appdt_status = 20;
    
        }
        }
       
            // if( $model_ApplicationdtlstmpTbl->appdt_status == 2 ||  $model_ApplicationdtlstmpTbl->appdt_status == 4 || $model_ApplicationdtlstmpTbl->appdt_status == 20){
  
            //     $model_ApplicationdtlstmpTbl->appdt_status = 3;
            // }
         
       
    }else{
        if($model_ApplicationdtlstmpTbl->appdt_status == 10 || $model_ApplicationdtlstmpTbl->appdt_status == 11){
            $model_ApplicationdtlstmpTbl->appdt_status = 9;
        }

        if( $model_ApplicationdtlstmpTbl->appdt_status == 2 ||  $model_ApplicationdtlstmpTbl->appdt_status == 4 || $model_ApplicationdtlstmpTbl->appdt_status == 20){
  
            $model_ApplicationdtlstmpTbl->appdt_status = 3;
        }
        if($model_ApplicationdtlstmpTbl->appdt_status == 9){
  
            $model_ApplicationdtlstmpTbl->appdt_status = 13;
        }

     }

    }

     $model_ApplicationdtlstmpTbl->appdt_appdecon =$todays;
     $model_ApplicationdtlstmpTbl->appdt_appdecby = $userPk;
     $model_ApplicationdtlstmpTbl->appdt_appdeccomment = $comments;
     $model_ApplicationdtlstmpTbl->save();
     if(!$model_ApplicationdtlstmpTbl->save()) {
        print_r($model_ApplicationdtlstmpTbl->getErrors()); exit;
    }
    if($status == 17){
        SiteAudit::appstaffinfomain($model_ApplicationdtlstmpTbl->applicationdtlstmp_pk,2);        $appsta = AppstaffinfotmpTbl::find()
        ->where(['appsit_applicationdtlstmp_fk' => $model_ApplicationdtlstmpTbl->applicationdtlstmp_pk])
        ->asArray()->all();
        if(!empty($appsta)){
        foreach($appsta as $app){
            $appstaf = AppstaffinfotmpTbl::find()
            ->where(['appostaffinfotmp_pk' => $app['appostaffinfotmp_pk']])
            ->one();
            $appstaf->appsit_iscarddetails = 2;
            $appstaf->save();

        }
    }

    }
      

        $applicationdtlstmp_pk =  $model_ApplicationdtlstmpTbl->applicationdtlstmp_pk;
        $opal_regpk =  $model_ApplicationdtlstmpTbl->appdt_opalmemberregmst_fk;
        $app_type =  $model_ApplicationdtlstmpTbl->appdt_apptype;
        $reg_info = OpalmemberregmstTbl::findOne($opal_regpk);
        $opal_reg_no = $reg_info->omrm_opalmembershipregnumber;
      
        // course approved and declined
        $model_appcoursedtlstmp_tbl = AppcoursedtlstmpTbl::find()->where("appcdt_applicationdtlstmp_fk  ='$applicationdtlstmp_pk'")->one(); 

        if($model_appcoursedtlstmp_tbl->appcdt_status == 1 || $model_appcoursedtlstmp_tbl->appcdt_status == 2 )
        {
            if($select_valitate == 3)
                 {
                       $model_appcoursedtlstmp_tbl->appcdt_status = 3;
                      $model_appcoursedtlstmp_tbl->appcdt_appdeccomment = $comments;
                         $model_appcoursedtlstmp_tbl->appcdt_appdecon = $todays;                        if(!$model_appcoursedtlstmp_tbl->save()) {

                            print_r($model_appcoursedtlstmp_tbl->getErrors()); exit;
                        }
                 }
            
                 else if($select_valitate == 4)
                 {
                    $model_appcoursedtlstmp_tbl->appcdt_status = 4;
                    $model_appcoursedtlstmp_tbl->appcdt_appdeccomment = $comments;
                    $model_appcoursedtlstmp_tbl->appcdt_appdecon = $todays;
                    if(!$model_appcoursedtlstmp_tbl->save()) {

                        print_r($model_appcoursedtlstmp_tbl->getErrors()); exit;
                    }
            
                 }
        }
// course transaction approved and declined
           $model_appcoursetrnstmp_tbl = AppcoursetrnstmpTbl::find()->where("appctt_appcoursedtlstmp_fk = ".$model_appcoursedtlstmp_tbl->appcoursedtlstmp_pk)->asArray()->all();
           if(!empty($model_appcoursetrnstmp_tbl)){
               foreach($model_appcoursetrnstmp_tbl as $trans){
                   $appcoursetrnstmp_tbl = AppcoursetrnstmpTbl::find()->where("appcoursetrnstmp_pk = ".$trans['appcoursetrnstmp_pk'])->one();
                   if($select_valitate == 3){
                       $appcoursetrnstmp_tbl->appctt_status = 3;
                   }else{
                       $appcoursetrnstmp_tbl->appctt_status = 4;
                   }
                   
                   $appcoursetrnstmp_tbl->appctt_appdeccomment = $comments;
                   $appcoursetrnstmp_tbl->appctt_appdecon =  $todays;
                   $appcoursetrnstmp_tbl->appctt_appdecby = $userPk;
                   if(!$appcoursetrnstmp_tbl->save()){
                       return $appcoursetrnstmp_tbl->getErrors();
                   }
               }
           }        // international approved and decined



        $international_data = ApplicationdtlstmpTbl::find()
        ->select("appintit_appdeccomment,oum_firstname,appintit_doc,appintit_opalmemberregmst_fk,appintit_createdby,appintit_appdeccomment,appintrecogtmp_pk,appintit_applicationdtlstmp_fk,irm_intlrecogname_en AS awarding ,irm_intlrecogname_ar,appintit_intnatrecogmst_fk, intnatrecogmst_pk, appintit_lastauditdate AS lastaudited,appintit_status AS status, appintit_createdon AS addedon, appintit_updatedon AS lastupdated ")
        ->innerJoin('appintrecogtmp_tbl','appintit_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->leftJoin('opalusermst_tbl','oum_opalmemberregmst_fk = 	oum_opalmemberregmst_fk')
        ->leftJoin('intnatrecogmst_tbl','appintit_intnatrecogmst_fk =  intnatrecogmst_pk')
        ->where("appdt_appreferno = '$app_ref_id'  group by intnatrecogmst_pk")
        ->asArray()
        ->all();

      foreach($international_data as $key => $value){

        $inter_id[$key] = $value['appintrecogtmp_pk'];

      }


        $international_comma_ids = join(',',$inter_id);
        if($international_comma_ids){
          $modelappintrecogtmp_tbl = AppintrecogtmpTbl::find()->where("appintrecogtmp_pk in($international_comma_ids)")->all();
        }

      if(count($modelappintrecogtmp_tbl) >= 1) {
          foreach($modelappintrecogtmp_tbl as $key => $value) {
              if($value['appintit_status'] == 1 || $value['appintit_status'] == 2 )
              {
                for($i=0; $i<count($modelappintrecogtmp_tbl);$i++) {
                    if($select_valitate == 3) {
                            $modelappintrecogtmp_tbl[$i]->appintit_status = 3; 
                            $modelappintrecogtmp_tbl[$i]->appintit_appdeccomment = $comments; 
                            $modelappintrecogtmp_tbl[$i]->appintit_appdecon = $todays; 
                            $modelappintrecogtmp_tbl[$i]->appintit_appdecby = $userPk; 
                        if(!$modelappintrecogtmp_tbl[$i]->save()) {
                            print_r($modelappintrecogtmp_tbl[$i]->getErrors()); exit;
                        }
                    }
                    else if($select_valitate == 4) {
                        $modelappintrecogtmp_tbl[$i]->appintit_status = 4; 
                        $modelappintrecogtmp_tbl[$i]->appintit_appdeccomment = $comments; 
                        $modelappintrecogtmp_tbl[$i]->appintit_appdecon = $todays; 
                        $modelappintrecogtmp_tbl[$i]->appintit_appdecby = $userPk; 
                        if(!$modelappintrecogtmp_tbl[$i]->save()) {
                            print_r($modelappintrecogtmp_tbl[$i]->getErrors()); exit;
                        }
                    }
                }
              }
          }
        }


        // document 

        $document_data = ApplicationdtlstmpTbl::find()
        ->select("appdocsubmissiontmp_pk,oum_firstname,appdst_upload,appdst_opalmemberregmst_fk,appdst_createdby,appdocsubmissiontmp_pk,appdst_appdeccomment,appdst_submissionstatus,appdst_remarks, appdst_submissionstatus AS documentprovided,ddm_documentname_en AS documentname,ddm_documentname_ar,appdst_applicationdtlstmp_fk, appdst_status AS status, appdst_createdon AS addedon,appdst_updatedon ")
  
        ->innerJoin('appdocsubmissiontmp_tbl','appdst_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->leftJoin('opalusermst_tbl','appdst_opalmemberregmst_fk = 	oum_opalmemberregmst_fk')
  
        ->innerJoin('documentdtlsmst_tbl','appdst_documentdtlsmst_fk = documentdtlsmst_pk')
        ->where("appdt_appreferno = '$app_ref_id'  group by appdocsubmissiontmp_pk")
        ->asArray()
        ->all();

     
        foreach($document_data as $key => $value)
        {
        $docs_id[$key] = $value['appdocsubmissiontmp_pk'];

         
        }
        $docs_comma_id = join(',',$docs_id);


      if($docs_comma_id){
        $modelappdocsubmissiontmp_tbl = AppdocsubmissiontmpTbl::find()->where("appdocsubmissiontmp_pk in($docs_comma_id)")->all();

     }
        if(count($modelappdocsubmissiontmp_tbl) >= 1)
        {

            foreach($modelappdocsubmissiontmp_tbl as $key => $value)
            {

            
            if($value['appdst_status']== 1 || $value['appdst_status'] == 2)
            {

                
            
    
           for($i=0; $i<count($modelappdocsubmissiontmp_tbl);$i++) {

            if($select_valitate == 3)
                {
                    $modelappdocsubmissiontmp_tbl[$i]->appdst_status = 3; 
                    $modelappdocsubmissiontmp_tbl[$i]->appdst_appdeccomment = $comments; 
                   $modelappdocsubmissiontmp_tbl[$i]->appdst_appdecon = $todays;
                    $modelappdocsubmissiontmp_tbl[$i]->appdst_appdecby = $userPk;                     $modelappdocsubmissiontmp_tbl[$i]->save();
                } else if($select_valitate == 4)
                {
                    $modelappdocsubmissiontmp_tbl[$i]->appdst_status = 4; 
                    $modelappdocsubmissiontmp_tbl[$i]->appdst_appdeccomment = $comments; 
                   $modelappdocsubmissiontmp_tbl[$i]->appdst_appdecon = $todays;
                    $modelappdocsubmissiontmp_tbl[$i]->appdst_appdecby = $userPk;                    $modelappdocsubmissiontmp_tbl[$i]->save();
                }
             
             
   
            }
   
        }
    }
       
        }


$fsmfee = 0;
     if($select_valitate == 3)
{
    

     $project_mst = ApplicationdtlstmpTbl::find()
     ->select(" appdt_projectmst_fk,stafffee.fsm_fee AS stafffee,appcdt_standardcoursemst_fk,appdt_apptype,appiim_officetype as officetype,
     applicationdtlstmp_pk,feesubscriptionmst_tbl.fsm_fee AS coursefee,appcoursetrnstmp_pk,appcoursedtlstmp_pk,feesubscriptionmst_tbl.feesubscriptionmst_pk,appdt_opalmemberregmst_fk")  
     ->innerJoin("feesubscriptionmst_tbl AS feesubscriptionmst_tbl","feesubscriptionmst_tbl.fsm_projectmst_fk = appdt_projectmst_fk")
     ->innerJoin("feesubscriptionmst_tbl As stafffee","appdt_projectmst_fk = stafffee.fsm_feestype")     
     ->innerJoin("appcoursedtlstmp_tbl","appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk")
     ->innerJoin("appcoursetrnstmp_tbl","appctt_appcoursedtlstmp_fk = appcoursedtlstmp_pk")
     ->leftJoin('appinstinfomain_tbl','appcdt_appinstinfomain_fk = appinstinfomain_pk')
     ->where("appdt_appreferno  = '$app_ref_id' GROUP BY appdt_projectmst_fk")
     ->asArray()
     ->one();



    $staffdata = \Yii::$app->db->createCommand(" select staffevaluationtmp_pk, set_staffevanfee,set_appstaffinfotmp_fk
    from( select staffevaluationtmp_pk, set_staffevanfee,set_appstaffinfotmp_fk, ROW_NUMBER() OVER(PARTITION BY set_appstaffinfotmp_fk ORDER BY staffevaluationtmp_pk desc) as rn
    FROM `appstaffinfotmp_tbl` LEFT JOIN `staffevaluationtmp_tbl` ON set_appstaffinfotmp_fk = appostaffinfotmp_pk WHERE (`appsit_applicationdtlstmp_fk`='$applicationdtlstmp_pk') AND (`set_asmttype`=1)  AND (`set_apppytminvoicedtls_fk` IS  NULL) ) as a
    where rn = 1")->queryAll();
       
    $staffcountdata = AppstaffinfotmpTbl::find()
        ->select(['staffevaluationtmp_pk'])
        ->leftJoin('staffevaluationtmp_tbl','set_appstaffinfotmp_fk = appostaffinfotmp_pk')
        ->where(['appsit_applicationdtlstmp_fk' => $applicationdtlstmp_pk])
        ->andWhere(['IS NOT', 'set_staffevanfee', null])
        ->andWhere(['set_asmttype' => 1])
        ->andWhere(['IS','set_apppytminvoicedtls_fk' ,null])
        ->groupBy('set_appstaffinfotmp_fk')
        ->asArray()
        ->count();

        $fsmfee = 0;
        
        if($project_mst['appdt_projectmst_fk'] == 2) {
            $projectmst = $project_mst['appdt_projectmst_fk'];
            $standardcourse_fk = $project_mst['appcdt_standardcoursemst_fk'];
            $officetype = $project_mst['officetype'];
            $feetype = '1'; // certification fee
            $apptype = $project_mst['appdt_apptype'];
            if($apptype == 3 ){
                $apptype = 2;
            }
            $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")
            ->andWhere("fsm_standardcoursemst_fk = '$standardcourse_fk'") 
            ->andWhere("fsm_officetype = '$officetype'") 
            ->andWhere("fsm_feestype = '$feetype'") 
            ->andWhere("fsm_applicationtype = '$apptype'") 
            ->asArray()->one();   

            if($project_mst['appdt_apptype']!= 3){
            $fsmfee = $feerec['fsm_fee'];
            }

        } else {
            $projectmst = $project_mst['appdt_projectmst_fk'];
            $standardcourse_fk = $project_mst['appcdt_standardcoursemst_fk'];
            $officetype = $project_mst['officetype'];
            $feetype = '1'; // certification fee
            $apptype = $project_mst['appdt_apptype'];
          
            if($apptype == 3 ){
                $apptype = 2;
            }
          
            $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")
            ->andWhere("fsm_officetype = '$officetype'") 
            ->andWhere("fsm_feestype = '$feetype'") 
            ->andWhere("fsm_applicationtype = '$apptype'") 

            ->asArray()->one(); 
            if($project_mst['appdt_apptype']!= 3){  
            $fsmfee = $feerec['fsm_fee'];
            }
            // $fsmfee = $project_mst['coursefee'];
        }
       

    $steval_fee = 0;
    if(!empty($staffdata)) {
        foreach($staffdata as $stafffee) {
            if(!empty($stafffee['set_staffevanfee']) && $stafffee['set_staffevanfee'] != null){
                $steval_fee = $steval_fee + $stafffee['set_staffevanfee'];
            }
        }
        $vatamount =   (($fsmfee + $steval_fee) * (5 / 100));
    } else {
        $vatamount =   ($fsmfee * (5 / 100));
    }   

   $apppytminvoicedtls_tbl = new OpalInvoiceTbl();
   
   $apppytminvoicedtls_tbl->apid_opalmemberregmst_fk = $project_mst['appdt_opalmemberregmst_fk'];
   $apppytminvoicedtls_tbl->apid_applicationdtlstmp_fk = $project_mst['applicationdtlstmp_pk'];
   $apppytminvoicedtls_tbl->apid_feesubscriptionmst_fk = $project_mst['feesubscriptionmst_pk'];
   $apppytminvoicedtls_tbl->apid_appcoursedtlstmp_fk = $project_mst['appcoursedtlstmp_pk'];
   $apppytminvoicedtls_tbl->apid_appcoursetrnstmp_fk = $project_mst['appcoursetrnstmp_pk'];
   $apppytminvoicedtls_tbl->apid_invoiceno = "456";
   $apppytminvoicedtls_tbl->apid_noofstaffeval = $staffcountdata;
   $apppytminvoicedtls_tbl->apid_staffevalfee = $steval_fee;
   $apppytminvoicedtls_tbl->apid_raisedon = $todays;
   $apppytminvoicedtls_tbl->apid_coursecertfee = $fsmfee;
   $apppytminvoicedtls_tbl->apid_vatamount = $vatamount;
   $apppytminvoicedtls_tbl->apid_invoicestatus = 1;
   $apppytminvoicedtls_tbl->apid_vatpercent = 5.00;
   $apppytminvoicedtls_tbl->apid_invoicestatus = 1;
   $apppytminvoicedtls_tbl->save();
    $invoice_id = $apppytminvoicedtls_tbl->apppytminvoicedtls_pk;
    $shortkey = 'CCI';
    if($app_type==1){
        $shortkey = 'CCI';
    }elseif($app_type==2){
        $shortkey = 'CCR';
    }elseif($app_type==3){
        $shortkey = 'CCU';
    }   
    $invoice_no = Common::generateInvoiceNumber('INV', $opal_reg_no, $shortkey, $invoice_id);
    $updateInv = OpalInvoiceTbl::findOne($invoice_id);
    $updateInv->apid_invoiceno = $invoice_no;
    $updateInv->save();
    $staffinvdata = AppstaffinfotmpTbl::find()
        ->select(['staffevaluationtmp_pk','set_staffevanfee'])
        ->leftJoin('staffevaluationtmp_tbl','set_appstaffinfotmp_fk = appostaffinfotmp_pk')
        ->where(['appsit_applicationdtlstmp_fk' => $applicationdtlstmp_pk])        
        ->asArray()
        ->all();

    if(!empty($staffinvdata)){
        foreach($staffinvdata as $staffinvval){
            $staffevalpk = $staffinvval['staffevaluationtmp_pk'];
            $staffevaltbl = StaffevaluationtmpTbl::findOne($staffevalpk);
            if(!empty($staffevaltbl)) {

                $staffevaltbl->set_apppytminvoicedtls_fk = $invoice_id;
                $staffevaltbl->save();
            }
        }
    }

   $apppymtdtlstmp_tbl = new ApppymtdtlstmpTbl();   
   $apppymtdtlstmp_tbl->apppdt_opalmemberregmst_fk = $project_mst['appdt_opalmemberregmst_fk'];
   $apppymtdtlstmp_tbl->apppdt_apppytminvoicedtls_fk = $invoice_id;
   $apppymtdtlstmp_tbl->apppdt_applicationdtlstmp_fk = $project_mst['applicationdtlstmp_pk'];
   $apppymtdtlstmp_tbl->apppdt_currency = 1;
   $apppymtdtlstmp_tbl->apppdt_noofstaffeval = $staffcountdata;
   $apppymtdtlstmp_tbl->apppdt_staffevafee =  $steval_fee;
   $apppymtdtlstmp_tbl->apppdt_amount = $fsmfee;
   $apppymtdtlstmp_tbl->apppdt_vatchrgs = $vatamount;
   $apppymtdtlstmp_tbl->apppdt_vatpercent = 5.00;
   $apppymtdtlstmp_tbl->apppdt_requesttype =  $project_mst['appdt_projectmst_fk'];
   $apppymtdtlstmp_tbl->apppdt_createdon =  $todays;
   $apppymtdtlstmp_tbl->apppdt_status =  1;
   if($apppymtdtlstmp_tbl->save())
   {
    $apptmpPk = $model_ApplicationdtlstmpTbl->applicationdtlstmp_pk;
    $applydtls_id = $apppymtdtlstmp_tbl->apppymtdtlstmp_pk;
    $appstatus =  $model_ApplicationdtlstmpTbl->appdt_status;
    $apptype = $model_ApplicationdtlstmpTbl->appdt_apptype;
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);   
    $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $project_mst['applicationdtlstmp_pk']])->orderBy('appapprovalhdr_pk desc')->one();

    if($apptype == 1){
        $approvaltype = 1;
    }else if($apptype == 2){
        $approvaltype = 4;

    }else if($apptype == 3){
        $approvaltype = $updatemodel->aah_formstatus;

    }
       //update approval
       if($updatemodel){
           if($select_valitate == 3){
               $approvalstatus = 1;
           }else{
               $approvalstatus = 2;
           }
       $updatemodel->aah_status = $approvalstatus;
       $updatemodel->aah_appdecComments = $comments;
       $updatemodel->aah_appdecon = date("Y-m-d H:i:s");
       $updatemodel->aah_appdecby = $userPk;
       $updatemodel->save();
       }

       if($model_ApplicationdtlstmpTbl->appdt_status == 10 || $model_ApplicationdtlstmpTbl->appdt_status == 14 || $model_ApplicationdtlstmpTbl->appdt_status == 20 ){
        $roletype = 3;
       }elseif($model_ApplicationdtlstmpTbl->appdt_status == 11 || $model_ApplicationdtlstmpTbl->appdt_status == 15 ){
        $roletype = 4;
       }else{
        $roletype = 5;
       }

       if($model_ApplicationdtlstmpTbl->appdt_status != 17 && $model_ApplicationdtlstmpTbl->appdt_status != 5){
        $info = SiteAudit::getApprovalHdrInfo($model_ApplicationdtlstmpTbl->appdt_projectmst_fk, $approvaltype, $roletype);
        $modelhdr = new AppapprovalhdrTbl;
        $modelhdr->aah_projapprovalworkflowhrd_fk = $info['projapprovalworkflowhrd_pk'];;
        $modelhdr->aah_projapprovalworkflowdtls_fk =  $info['projapprovalworkflowdtls_pk'];;
        $modelhdr->aah_projapprovalworkflowuserdtls_fk = $info['projapprovalworkflowuserdtls_pk'];
        $modelhdr->aah_applicationdtlstmp_fk = $project_mst['applicationdtlstmp_pk'];
        $modelhdr->aah_formstatus = $updatemodel->aah_formstatus;
        $modelhdr->save();
       }

 
 
 
    }
}else{

    // \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion($model_ApplicationdtlstmpTbl->applicationdtlstmp_pk,'',2)")->execute();
    $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' =>$model_ApplicationdtlstmpTbl->applicationdtlstmp_pk])->orderBy('appapprovalhdr_pk desc')->one();

    if($updatemodel){
        if($select_valitate == 3){
            $approvalstatus = 1;
        }else{
            $approvalstatus = 2;
        }
    $updatemodel->aah_status = $approvalstatus;
    $updatemodel->aah_appdecComments = $comments;
    $updatemodel->aah_appdecon = date("Y-m-d H:i:s");
    $updatemodel->aah_appdecby = $userPk;
    $updatemodel->save();
    }
    

   

}

    
    $apptmpPk = $model_ApplicationdtlstmpTbl->applicationdtlstmp_pk;
    $appstatus =  $model_ApplicationdtlstmpTbl->appdt_status;
    $apptype = $model_ApplicationdtlstmpTbl->appdt_apptype;
    $regPk = $model_ApplicationdtlstmpTbl->appdt_opalmemberregmst_fk; 
    $projpk = $model_ApplicationdtlstmpTbl->appdt_projectmst_fk; 

//\Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion($apppymtdtlstmp_tbl->apppdt_applicationdtlstmp_fk,'',2)")->execute();
\Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion($model_ApplicationdtlstmpTbl->applicationdtlstmp_pk,'',2)")->execute();             
    if($appstatus==3 && $apptype ==1 ){
        \api\components\Mail::courseDtls($apptmpPk,$regPk,'crdecldesk');    
    }elseif($appstatus==5 && $apptype ==1){
        \api\components\Mail::courseDtls($apptmpPk,$regPk,'crapproved');  
    }
    
     if($appstatus==3 && $apptype ==2 ){
        \api\components\Mail::courseDtls($apptmpPk,$regPk,'rencrdecldesk');    
    }elseif($appstatus==5 && $apptype ==2){
        \api\components\Mail::courseDtls($apptmpPk,$regPk,'rencrapproved');  
    }
    
    $updsts = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' =>$apptmpPk])->orderBy('appapprovalhdr_pk desc')->one();
    $formsts = $updsts['aah_formstatus'];

     
    
       if($appstatus==3 && $apptype ==3 ){
        \api\components\Mail::courseDtls($apptmpPk,$regPk,'updcrdecldesk');    
       }elseif($appstatus==5 && $apptype ==3){
        \api\components\Mail::courseDtls($apptmpPk,$regPk,'updnewadded');  
       }elseif($appstatus==17 && $apptype ==3){
        \api\components\Mail::courseDtls($apptmpPk,$regPk,'updcourapprovedno');  
       }
       

       
       
       
     
       
             if($projpk==2 && $appstatus==20 ){ 
                $upddesrwmailcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 2 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 2 AND oum_status = 'A' AND applicationdtlstmp_pk = $apptmpPk");
 
                    $upddesrwmail = $upddesrwmailcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                        foreach ($upddesrwmail as $updrow) {
                        $id = $updrow['oum_emailid'];
                        $name = $updrow['oum_firstname'];
                            if($appstatus==20 && $apptype==3){
                              \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updvaldec');
                              }
                    }             
            } 
            if($projpk==3 && $appstatus==20){
                   $upddesrwmail = \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 2, 'pawfh_projectmst_fk' => 1 , 'pawfd_rolemst_fk' => 2,'oum_status'=>'A'])
                  ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];         
                    foreach ($upddesrwmail as $updrow) {
                        $id = $updrow['oum_emailid'];
                        $name = $updrow['oum_firstname'];
                            if($appstatus==20 && $apptype==3){
                              \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updvaldec');
                              }
                    }               
            }
        
            if($projpk==2 && $appstatus==10){ 
                $updaddqualmancommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 2 AND pawfh_projectmst_fk in (2,3) AND pawfd_rolemst_fk = 3 AND oum_status = 'A' AND applicationdtlstmp_pk = $apptmpPk
                GROUP BY opalusermst_pk");
                 
                    $updaddqualman = $updaddqualmancommand ->queryAll();  
                        $id = [];
                        $name = [];   
                      foreach ($updaddqualman as $updaddmanrow) {
                        $id = $updaddmanrow['oum_emailid'];
                        $name = $updaddmanrow['oum_firstname']; 
                                if($appstatus==10 && $apptype ==3 && $formsts == 3){
                                  \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updaddnew');  
                                }
                    }
            } 
        if($projpk==3 && $appstatus==10){
                $updaddqualman= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 2, 'pawfh_projectmst_fk' => [2,3] , 'pawfd_rolemst_fk' => 3,'oum_status'=>'A'])
                 ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($updaddqualman as $updaddmanrow) {
                        $id = $updaddmanrow['oum_emailid'];
                        $name = $updaddmanrow['oum_firstname']; 
                    if($appstatus==10 && $apptype ==3 && $formsts == 3){
                      \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updaddnew');  
                    }
                }
        }
       
        if($projpk==2 && $appstatus==14){ 
                $reupdaddqualmancommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 3 AND pawfh_projectmst_fk in (2,3) AND pawfd_rolemst_fk = 3 AND oum_status = 'A' AND applicationdtlstmp_pk = $apptmpPk
                GROUP BY opalusermst_pk");
                  
                    $reupdaddqualman = $reupdaddqualmancommand ->queryAll();  
                        $id = [];
                        $name = [];  
                            foreach ($reupdaddqualman as $reupdaddmanrow) {
                                    $id = $reupdaddmanrow['oum_emailid'];
                                    $name = $reupdaddmanrow['oum_firstname']; 
                                    if($appstatus==14 && $apptype ==3 && $formsts == 3){
                                        \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'reupdaddnew');  
                                    }
                            }
            } 

            if($projpk==3 && $appstatus==14){
             $reupdaddqualman= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                    ->select(['oum_emailid', 'oum_firstname'])
                    ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                    ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                    ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                    ->where(['pawfh_formstatus' => 3, 'pawfh_projectmst_fk' => [2,3] , 'pawfd_rolemst_fk' => 3,'oum_status'=>'A'])
                      ->groupBy(['opalusermst_pk'])
                    ->asArray()
                    ->all();
                    $id = [];
                    $name = [];
                    foreach ($reupdaddqualman as $reupdaddmanrow) {
                            $id = $reupdaddmanrow['oum_emailid'];
                            $name = $reupdaddmanrow['oum_firstname']; 
                            if($appstatus==14 && $apptype ==3 && $formsts == 3){
                                \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'reupdaddnew');  
                            }
                    }
            }
   
         if($projpk==2 && $appstatus==14){ 
                $reupdnoqualmancommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 3 AND pawfh_projectmst_fk in (2,3) AND pawfd_rolemst_fk = 3 AND oum_status = 'A' AND applicationdtlstmp_pk = $apptmpPk
                GROUP BY opalusermst_pk");
                  
                    $reupdnoqualman = $reupdnoqualmancommand ->queryAll();  
                        $id = [];
                        $name = [];  
                        
                foreach ($reupdnoqualman as $reupdnomanrow) {
                        $id = $reupdnomanrow['oum_emailid'];
                        $name = $reupdnomanrow['oum_firstname']; 
                    if($appstatus==14 && $apptype ==3 && $formsts == 2){
                      \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'reupdnonew');  
                    }
                }
            }  

        if($projpk==3 && $appstatus==14){
               $reupdnoqualman= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 2, 'pawfh_projectmst_fk' => [2,3] , 'pawfd_rolemst_fk' => 3,'oum_status'=>'A'])
                 ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($reupdnoqualman as $reupdnomanrow) {
                        $id = $reupdnomanrow['oum_emailid'];
                        $name = $reupdnomanrow['oum_firstname']; 
                    if($appstatus==14 && $apptype ==3 && $formsts == 2){
                      \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'reupdnonew');  
                    }
                }
        }    
        
          if($projpk==2 && $appstatus==10){      
                $updqualmancommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 1 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 4 AND oum_status = 'A' AND applicationdtlstmp_pk = $apptmpPk
                GROUP BY opalusermst_pk");
                   
                    $updqualman = $updqualmancommand ->queryAll();  
                        $id = [];
                        $name = [];   
                foreach ($updqualman as $updmanrow) {
                        $id = $updmanrow['oum_emailid'];
                        $name = $updmanrow['oum_firstname']; 
                            if($appstatus==10 && $apptype ==3 && $formsts == 2){
                              \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updnonew');  
                            }
                } 
            } 

        if($projpk==3 && $appstatus==10){
         $updqualman= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
                ->select(['oum_emailid', 'oum_firstname'])
                ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
                ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
                ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
                ->where(['pawfh_formstatus' => 3, 'pawfh_projectmst_fk' => 3 , 'pawfd_rolemst_fk' => 3,'oum_status'=>'A'])
                  ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($updqualman as $updmanrow) {
                        $id = $updmanrow['oum_emailid'];
                        $name = $updmanrow['oum_firstname']; 
                    if($appstatus==10 && $apptype ==3 && $formsts == 2){
                      \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updnonew');  
                    }
                }
        }      
           
          if($projpk==2 && $appstatus ==11){ 
                $updauthoraddcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 3 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 4 AND oum_status = 'A' AND applicationdtlstmp_pk = $apptmpPk
                GROUP BY opalusermst_pk");
                 
                    $updauthoradd = $updauthoraddcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                      foreach ($updauthoradd as $updaddauthorrow) {
                $id = $updaddauthorrow['oum_emailid'];
                $name = $updaddauthorrow['oum_firstname'];

                        if($appstatus ==11 && $apptype == 3 && $formsts == 3 ){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcropalAupadd');   
                        }
                }
            } 
            
            if($projpk==3 && $appstatus ==11){
            $updauthoradd= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
            ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
            ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
            ->where(['pawfh_formstatus' => 3, 'pawfh_projectmst_fk' => 3 , 'pawfd_rolemst_fk' => 4,'oum_status'=>'A'])
             ->groupBy(['opalusermst_pk'])
            ->asArray()
            ->all();
            
            $id = [];
            $name = [];
            foreach ($updauthoradd as $updaddauthorrow) {
                $id = $updaddauthorrow['oum_emailid'];
                $name = $updaddauthorrow['oum_firstname'];

                        if($appstatus ==11 && $apptype == 3 && $formsts == 3 ){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcropalAupadd');   
                        }
                }
            }
            
              if($projpk==2 && $appstatus ==11){ 
        
                $updauthorcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 2 AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 4 AND oum_status = 'A' AND applicationdtlstmp_pk = $apptmpPk
                GROUP BY opalusermst_pk");
                
                    $updauthor = $updauthorcommand ->queryAll();  
                        $id = [];
                        $name = [];   
                   foreach ($updauthor as $updauthorrow) {
                $id = $updauthorrow['oum_emailid'];
                $name = $updauthorrow['oum_firstname'];

                        if($appstatus ==11 && $apptype == 3 && $formsts == 2 ){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcropalAup');   
                        }
                }     
           
            } 
            
            if($projpk==3 && $appstatus ==11){
            $updauthor= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
            ->select(['oum_emailid', 'oum_firstname'])
            ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
            ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
            ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
            ->where(['pawfh_formstatus' => 2, 'pawfh_projectmst_fk' => 3 , 'pawfd_rolemst_fk' => 4,'oum_status'=>'A'])
            ->groupBy(['opalusermst_pk'])
            ->asArray()
            ->all();
            
            $id = [];
            $name = [];
            foreach ($updauthor as $updauthorrow) {
                $id = $updauthorrow['oum_emailid'];
                $name = $updauthorrow['oum_firstname'];

                        if($appstatus ==11 && $apptype == 3 && $formsts == 2 ){
                            \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcropalAup');   
                        }
                }     
            }    
           
            if($projpk==2 && $appstatus == 9){ 
        
                $updaudcommand = \Yii::$app->db->createCommand("
                SELECT opalusermst_pk, oum_firstname, oum_emailid, oum_standcoursemst_fk, oum_allocatedproject, oum_rolemst_fk, appcdt_standardcoursemst_fk
                FROM Projapprovalworkflowuserdtls_Tbl
                LEFT JOIN projapprovalworkflowdtls_tbl ON projapprovalworkflowdtls_pk = pawfud_projapprovalworkflowdtls_fk
                LEFT JOIN projapprovalworkflowhrd_tbl ON projapprovalworkflowhrd_pk = pawfd_projapprovalworkflowhrd_fk
                LEFT JOIN opalusermst_tbl ON pawfud_opalusermst_fk = opalusermst_pk
                JOIN appcoursedtlstmp_tbl ON FIND_IN_SET(appcdt_standardcoursemst_fk, oum_standcoursemst_fk)
                LEFT JOIN applicationdtlstmp_tbl ON applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk
                WHERE pawfh_formstatus = 3  AND pawfh_projectmst_fk = 2 AND pawfd_rolemst_fk = 4 AND oum_status = 'A' AND applicationdtlstmp_pk = $apptmpPk
                GROUP BY opalusermst_pk");
                
                    $updaud = $updaudcommand ->queryAll();  
                        $id = [];
                        $name = [];  
               foreach ($updaud as $updaudrow) {
                $id = $updaudrow['oum_emailid'];
                $name = $updaudrow['oum_firstname']; 
        
                if($appstatus == 9 && $apptype ==3){
                   
                     \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcrdecline');
                }
                }
            }   

           if($projpk==3 && $appstatus == 9){
           $updaud= \app\models\ProjapprovalworkflowuserdtlsTbl::find()
               ->select(['oum_emailid', 'oum_firstname'])
               ->leftJoin('projapprovalworkflowdtls_tbl','projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')        
               ->leftJoin('projapprovalworkflowhrd_tbl','projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')   
               ->leftJoin('opalusermst_tbl','pawfud_opalusermst_fk = opalusermst_pk')           
               ->where(['pawfh_formstatus' => 3, 'pawfh_projectmst_fk' => [2,3] , 'pawfd_rolemst_fk' => 5,'oum_status'=>'A'])
                 ->groupBy(['opalusermst_pk'])
                ->asArray()
                ->all();
                $id = [];
                $name = [];
                foreach ($updaud as $updaudrow) {
                $id = $updaudrow['oum_emailid'];
                $name = $updaudrow['oum_firstname']; 
        
                if($appstatus == 9 && $apptype ==3){                 
                     \api\components\Mail::superadmincer($apptmpPk,$regPk,$id,$name,'updcrdecline');
                }
                }
           }
        
        if($model_ApplicationdtlstmpTbl->appdt_status == 17 && $updatemodel->aah_formstatus == 3){
            SiteAudit::appstaffinfomain($model_ApplicationdtlstmpTbl->applicationdtlstmp_pk);
        }


     

return ['resdata'=>$apppymtdtlstmp_tbl];
        
    }
 public static function showapprovdec()
    {
        $request = Yii::$app->request;
        $id = $request->post('id');
        $arr=[];


        $appstaffinfotmp_tbl = AppstaffinfotmpTbl::find()->where("appostaffinfotmp_pk = '$id'")->one();
        $staffevaluationtmp_tbl = StaffevaluationtmpTbl::find()->where("set_appstaffinfotmp_fk = '$id'")->one();

        array_push($arr,$appstaffinfotmp_tbl, $staffevaluationtmp_tbl);


        return $arr;


    }


    public static function staffapprodecproce()
    {

        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        $opalusermst_tbl = OpalusermstTbl::find()->where("opalusermst_pk = '$userPk'")->one();
        $appcdt_appdecby = $opalusermst_tbl->opalusermst_pk;
        $last_updated_by['updat_by'] = $opalusermst_tbl->oum_firstname;
       
        $request = Yii::$app->request;
        $status = $request->post('status');

        $staffinfotmppk = $request->post('staffinfotmp_pk');
        $staffinfotmp_pk = Security::decrypt($staffinfotmppk);
      
        $staff_id = $request->post('staff_id');
        $comments = $request->post('comments');
        $arr= [];
        $doc_arr= [];
        

        $reportdocument = $request->post('reportdocument');
        $reportdocument = $reportdocument[0];
        $status_info = $request->post('status_info');
        $percentage = $request->post('percentage');
        $mark = $request->post('mark');
        $todays = date("Y-m-d h:i:s");
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        //delete
    // $delete = StaffevaluationtmpTbl::find()->where()
    \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
    StaffevaluationtmpTbl::deleteAll(['IN', 'set_appstaffinfotmp_fk',$staffinfotmp_pk]);
    \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();

        if($status == 2)  // declined
        {


             $appstaffinfotmp_tbl = AppstaffinfotmpTbl::find()->where("appostaffinfotmp_pk = '$staffinfotmp_pk'")->one();
     
               $appstaffinfotmp_tbl->appsit_status = 4;
               $appstaffinfotmp_tbl->appsit_appdeccomment = $comments;
               $appstaffinfotmp_tbl->appsit_appdecon = $todays;
               $appstaffinfotmp_tbl->appsit_appdecby = $userPk;
               $appstaffinfotmp_tbl->save();

            $addedon = $appstaffinfotmp_tbl->appsit_appdecby;
          

        }
        elseif($status == 1) // approved
        {
            
            

            $standaradmst =  AppstaffinfotmpTbl::find()
                ->select("appcdt_standardcoursemst_fk,standardcoursedtls_pk")
                ->innerJoin('appcoursedtlstmp_tbl' , 'appcdt_applicationdtlstmp_fk = appsit_applicationdtlstmp_fk')
                ->leftJoin('standardcoursedtls_tbl','scd_standardcoursemst_fk = appcdt_standardcoursemst_fk')
                ->where("appostaffinfotmp_pk = '$staffinfotmp_pk'")
                ->asArray()
                ->one();

                
                if($status_info  == 'undefined' ||  $status_info == null)  // declined
                {
        
        
                     $appstaffinfotmp_tbl = AppstaffinfotmpTbl::find()->where("appostaffinfotmp_pk = '$staffinfotmp_pk'")->one();
             
                       $appstaffinfotmp_tbl->appsit_status = 3;

                    //    $appstaffinfotmp_tbl->appsit_iscarddetails = 2;
                       $appstaffinfotmp_tbl->appsit_appdeccomment = $comments;
                       $appstaffinfotmp_tbl->appsit_appdecon = $todays;
                       $appstaffinfotmp_tbl->appsit_appdecby = $userPk;
                       $appstaffinfotmp_tbl->save();
        
                    $addedon = $appstaffinfotmp_tbl->appsit_appdecby;
                  
        
                }
            if($status_info == 3) 
            {

               
                $appstaffinfotmp_tbl = AppstaffinfotmpTbl::find()->where("appostaffinfotmp_pk = '$staffinfotmp_pk'")->one();
     
                $appstaffinfotmp_tbl->appsit_status = 3;
               
                //$appstaffinfotmp_tbl->appsit_iscarddetails = 2;
                // $appstaffinfotmp_tbl->appsit_iscarddetails = 2;
                $appstaffinfotmp_tbl->appsit_appdeccomment = $comments;
                $appstaffinfotmp_tbl->appsit_appdecon = $todays;
                $appstaffinfotmp_tbl->appsit_appdecby = $userPk;
                $appstaffinfotmp_tbl->save();
 
             $addedon = $appstaffinfotmp_tbl->appsit_appdecby;

             $staffevaluationtmp_tbl = new  StaffevaluationtmpTbl(); 
             $staffevaluationtmp_tbl->set_appstaffinfotmp_fk = $staffinfotmp_pk;
             $staffevaluationtmp_tbl->set_staffinforepo_fk = $staff_id;
             $staffevaluationtmp_tbl->set_asmttype = 1;
             $staffevaluationtmp_tbl->set_asmtmode = 1;
             $staffevaluationtmp_tbl->set_asmtstatus = 5;
             $staffevaluationtmp_tbl->set_standardcoursemst_fk = $standaradmst['appcdt_standardcoursemst_fk'] ;
             $staffevaluationtmp_tbl->set_standardcoursedtls_fk = $standaradmst['standardcoursedtls_pk'] ;
             
             $staffevaluationtmp_tbl->set_createdon = date("Y-m-d H:m:s") ;
             $staffevaluationtmp_tbl->set_createdby = $userPk ;
             if($staffevaluationtmp_tbl->save()){
                

                 if($status_info == 3){     
                    
                    $staffevaluationtmp_tbl_pa = new  StaffevaluationtmpTbl(); 
                    $staffevaluationtmp_tbl_pa->set_appstaffinfotmp_fk = $staffinfotmp_pk;
                    $staffevaluationtmp_tbl_pa->set_staffinforepo_fk = $staff_id;
                    $staffevaluationtmp_tbl_pa->set_asmttype = 2;
                    $staffevaluationtmp_tbl_pa->set_asmtmode = 1;
                    $staffevaluationtmp_tbl_pa->set_asmtstatus = ($status_info==1)? 1: 2;
                    $staffevaluationtmp_tbl_pa->set_standardcoursemst_fk = $standaradmst['appcdt_standardcoursemst_fk'] ;
                    $staffevaluationtmp_tbl_pa->set_standardcoursedtls_fk = $standaradmst['standardcoursedtls_pk'] ;
                    
                    $staffevaluationtmp_tbl_pa->set_createdon = date("Y-m-d H:m:s") ;
                    $staffevaluationtmp_tbl_pa->set_createdby = $userPk ;
                    if(!$staffevaluationtmp_tbl_pa->save()){
                        print_r($staffevaluationtmp_tbl_pa->getErrors()); 
                    }
                }
             }

            }
            elseif($status_info == 1 || $status_info == 2){
            
    
            $project_mst = AppstaffinfotmpTbl::find()
             ->select("appdt_projectmst_fk , appdt_apptype")
             ->leftJoin("applicationdtlstmp_tbl","applicationdtlstmp_pk = appsit_applicationdtlstmp_fk")
             ->where("appostaffinfotmp_pk = '$staffinfotmp_pk'")
             ->asArray()
             ->one();

      

            $projectmst = $project_mst['appdt_projectmst_fk'];
            $appdt_apptype = $project_mst['appdt_apptype'];
            if($appdt_apptype ==1){
                $apptype = 1;
            } else if($appdt_apptype ==2 || $appdt_apptype ==3){
                $apptype = 3;

            }
          
             $infotemrec = AppstaffinfotmpTbl::find()
             ->where("appostaffinfotmp_pk = '$staffinfotmp_pk' ")->one();
             $applicationstatus = $infotemrec->appsit_iscarddetails; 

             $roleofcourse = $infotemrec->appsit_roleforcourse;

             
             $array = explode(',', $roleofcourse);

                 
        
            
            
             $fsmfee = '0.000';
            

             if( in_array("12", $array, TRUE) || in_array("13", $array, TRUE) || in_array("14", $array, TRUE))
             {
   
                 if($projectmst == 3)
                {
                   
                        if($applicationstatus == 1 || $applicationstatus == 3)
                        {
                            $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")
                            ->andWhere("fsm_feestype = 6") 
                            ->andWhere("fsm_applicationtype = $apptype") 
                            ->andWhere("fsm_officetype = '$officetype' OR  fsm_officetype = '3'") 
                            ->one();   
                        }
                        if($applicationstatus == 2)
                        {
                            
                            $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")
                            ->andWhere("fsm_feestype = 2") 
                            ->andWhere("fsm_applicationtype = $apptype")  
                            ->andWhere("fsm_officetype = '$officetype' OR  fsm_officetype = '3'")               
                            ->one();
                        }
                        if($apptype == 3 && $applicationstatus == 1)
                        {
                            
                            $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")
                            ->andWhere("fsm_feestype = 2") 
                            ->andWhere("fsm_applicationtype = $apptype")  
                            ->andWhere("fsm_officetype = '$officetype' OR  fsm_officetype = '3'")               
                            ->one();
                        }
              
                        $fsmfee = $feerec->fsm_fee;
                       
                       
                    }

                elseif($projectmst == '2')
           
                {
                    $appinstinfotmprecords =  AppinstinfotmpTbl::find()->where("appinstinfotmp_pk = '$staff_id'")->one();
                    $officetype =  $appinstinfotmprecords['appiit_officetype'];
                   

                    $feetype = 2;
                    if($applicationstatus == 2 ) {
                        $feetype = 2;
                        $app_type =1;

                    } 
                    if($applicationstatus == 1 || $applicationstatus == 3) {
                        $feetype = 6;
                        $app_type =2;

                    }
                    if($apptype == 3 && $applicationstatus == 1){
                       $feetype = 2;
                       $app_type =1; 
                    }


                
                    $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")

                    ->andWhere("fsm_standardcoursemst_fk = '$standaradmst[appcdt_standardcoursemst_fk]'") 
                    ->andWhere("fsm_officetype = '$officetype' OR  fsm_officetype = '3'") 
                    ->andWhere("fsm_feestype = '$feetype'") 
                    ->andWhere("fsm_applicationtype = '$apptype'") 
                    ->asArray()->one();   

                
                    $fsmfee = $feerec['fsm_fee']; 
                    

                }
               
               
              
               $staffevaluationtmp_tbl = new  StaffevaluationtmpTbl();         
               $staffevaluationtmp_tbl->set_appstaffinfotmp_fk = $staffinfotmp_pk;
               $staffevaluationtmp_tbl->set_staffinforepo_fk = $staff_id;
               $staffevaluationtmp_tbl->set_asmttype = 1;
               $staffevaluationtmp_tbl->set_asmtmode = 1;
               $staffevaluationtmp_tbl->set_standardcoursemst_fk = $standaradmst['appcdt_standardcoursemst_fk'] ;
               $staffevaluationtmp_tbl->set_standardcoursedtls_fk = $standaradmst['standardcoursedtls_pk'] ;
               $staffevaluationtmp_tbl->set_asmtstatus = ($status_info==1)? 1: 2;
               $staffevaluationtmp_tbl->set_asmtupload = $reportdocument;
               $staffevaluationtmp_tbl->set_marksecured = $mark ;
               $staffevaluationtmp_tbl->set_percentage =  $percentage;
               $staffevaluationtmp_tbl->set_staffevanfee = $fsmfee;
               $staffevaluationtmp_tbl->set_createdon = date("Y-m-d H:m:s") ;
               $staffevaluationtmp_tbl->set_createdby = $userPk ;
   
               if($staffevaluationtmp_tbl->save())
               {     
                  
               }
            }


            
    
            $appstaffinfotmp_tbl = AppstaffinfotmpTbl::find()->where("appostaffinfotmp_pk = '$staffinfotmp_pk'")->one();
    
            $appstaffinfotmp_tbl->appsit_status = 3;
            
           // $appstaffinfotmp_tbl->appsit_iscarddetails = 2;
            // $appstaffinfotmp_tbl->appsit_iscarddetails = 2;
            $appstaffinfotmp_tbl->appsit_appdeccomment = $comments;
            $appstaffinfotmp_tbl->appsit_appdecon = $todays;
            $appstaffinfotmp_tbl->appsit_appdecby = $userPk;
            $appstaffinfotmp_tbl->save();
           
        
            $docs =  StaffevaluationtmpTbl::find()->where("set_appstaffinfotmp_fk = '$staffinfotmp_pk' ")->one();
            $infotemp = StaffinforepoTbl::find()->where("staffinforepo_pk = '$staffinfotmp_pk'")->one();
            
            if($reportdocument != '' && $reportdocument!= null)
            {
                $doc_arr['staff_doc'] = \api\components\Drive::generateUrl( $docs->set_asmtupload,$infotemp->sir_opalmemberregmst_fk,$docs->set_createdby );
            }
           
    
    
            }
           

        } 
        elseif($status == 3)  // fail
        {

          
            $standaradmst =  AppstaffinfotmpTbl::find()
            ->select("appcdt_standardcoursemst_fk,standardcoursedtls_pk")
            ->innerJoin('appcoursedtlstmp_tbl' , 'appcdt_applicationdtlstmp_fk = appsit_applicationdtlstmp_fk')
            ->leftJoin('standardcoursedtls_tbl','scd_standardcoursemst_fk = appcdt_standardcoursemst_fk')
            ->where("appostaffinfotmp_pk = '$staffinfotmp_pk'")
            ->asArray()
            ->one();
          
        $project_mst = AppstaffinfotmpTbl::find()
         ->select("appdt_projectmst_fk")
         ->leftJoin("applicationdtlstmp_tbl","applicationdtlstmp_pk = appsit_applicationdtlstmp_fk")
         ->where("appostaffinfotmp_pk = '$staffinfotmp_pk'")
         ->asArray()
         ->one();
        $projectmst = $project_mst['appdt_projectmst_fk'];
         $infotemrec = AppstaffinfotmpTbl::find()
         ->where("appostaffinfotmp_pk = '$staffinfotmp_pk' ")->one();
         $applicationstatus = $infotemrec->appsit_iscarddetails;       
         $fsmfee = '0.000';
         if($projectmst == 3)
         {
           $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")
           ->andWhere("fsm_applicationtype = '$applicationstatus'")
           ->one();    
           $fsmfee = $feerec->fsm_fee; 
         }
         elseif($projectmst == 2)
         {
          $appinstinfotmprecords =  AppinstinfotmpTbl::find()->where("appinstinfotmp_pk = appinstinfotmp_pk")->one();
         $officetype =  $appinstinfotmprecords->appiit_officetype;

         $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")
         ->andWhere("fsm_standardcoursemst_fk = ' $standaradmst[appcdt_standardcoursemst_fk]'")
         ->one();

      if($applicationstatus == 1)  // initial
      {
        $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")
        ->andWhere("fsm_standardcoursemst_fk = ' $standaradmst[appcdt_standardcoursemst_fk]'")
        ->andWhere("fsm_feestype = 2")
        ->one();
        $fsmfee = $feerec->fsm_fee; 

      }
      elseif($applicationstatus == 2)  // update
      {
        $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")
        ->andWhere("fsm_standardcoursemst_fk = ' $standaradmst[appcdt_standardcoursemst_fk]'")
        ->andWhere("fsm_feestype = 6")
        ->one();
        $fsmfee = $feerec->fsm_fee; 

      }
    

         }

        $staffevaluationtmp_tbl = new  StaffevaluationtmpTbl();         
        $staffevaluationtmp_tbl->set_appstaffinfotmp_fk = $staffinfotmp_pk;
        $staffevaluationtmp_tbl->set_staffinforepo_fk = $staff_id;
        $staffevaluationtmp_tbl->set_asmttype = 1;
        $staffevaluationtmp_tbl->set_asmtmode = 1;
        $staffevaluationtmp_tbl->set_standardcoursemst_fk = $standaradmst['appcdt_standardcoursemst_fk'] ;
        $staffevaluationtmp_tbl->set_standardcoursedtls_fk = $standaradmst['standardcoursedtls_pk'] ;
        $staffevaluationtmp_tbl->set_asmtstatus = 1;
        $staffevaluationtmp_tbl->set_asmtupload = $reportdocument;
        $staffevaluationtmp_tbl->set_marksecured = $mark ;
        $staffevaluationtmp_tbl->set_percentage =  $percentage;
        $staffevaluationtmp_tbl->set_staffevanfee = $fsmfee;
        $staffevaluationtmp_tbl->set_createdon = date("Y-m-d H:m:s") ;
        $staffevaluationtmp_tbl->set_createdby = $userPk ;
      
        if($staffevaluationtmp_tbl->save())
        {  
            
            if($status_info == 3)
            {
                $staffevaluationtmp_tbl_pa = new  StaffevaluationtmpTbl(); 
                $staffevaluationtmp_tbl_pa->set_appstaffinfotmp_fk = $staffinfotmp_pk;
                $staffevaluationtmp_tbl_pa->set_staffinforepo_fk = $staff_id;
                $staffevaluationtmp_tbl_pa->set_asmttype = 2;
                $staffevaluationtmp_tbl_pa->set_asmtmode = 1;
                $staffevaluationtmp_tbl_pa->set_asmtstatus = 5;
                $staffevaluationtmp_tbl_pa->set_standardcoursemst_fk = $standaradmst['appcdt_standardcoursemst_fk'] ;
                $staffevaluationtmp_tbl_pa->set_standardcoursedtls_fk = $standaradmst['standardcoursedtls_pk'] ;
                
                $staffevaluationtmp_tbl_pa->set_createdon = date("Y-m-d H:m:s") ;
                $staffevaluationtmp_tbl_pa->set_createdby = $userPk ;
                if(!$staffevaluationtmp_tbl_pa->save()){
                    print_r($staffevaluationtmp_tbl_pa->getErrors()); 
                }
            }
           
        }

        $appstaffinfotmp_tbl = AppstaffinfotmpTbl::find()->where("appostaffinfotmp_pk = '$staffinfotmp_pk'")->one();

        $appstaffinfotmp_tbl->appsit_status = 5;
        $appstaffinfotmp_tbl->appsit_appdeccomment = $comments;
        $appstaffinfotmp_tbl->appsit_appdecon = $todays;
        $appstaffinfotmp_tbl->appsit_appdecby = $userPk;
        $appstaffinfotmp_tbl->save();
    
        $docs =  StaffevaluationtmpTbl::find()->where("set_appstaffinfotmp_fk = '$staffinfotmp_pk' ")
        
        ->one();
        $infotemp = StaffinforepoTbl::find()->where("staffinforepo_pk = '$staffinfotmp_pk'")->one();
        
        
        if($reportdocument != '' && $reportdocument!= null)

        {
            $doc_arr['staff_doc'] = \api\components\Drive::generateUrl( $docs->set_asmtupload,$infotemp->sir_opalmemberregmst_fk,$docs->set_createdby );
        }
       

        



        }


        // if($status == 1 || $status == 3)

        // {
            
        // array_push($arr,$appstaffinfotmp_tbl,$staffevaluationtmp_tbl,$doc_arr,$last_updated_by);

        // }
        // elseif($status == 2){
        //     array_push($arr,$appstaffinfotmp_tbl,$last_updated_by);

        // }elseif($status_info == 2 && $status == 1)
        // {
        //     array_push($arr,$arr[0].$appstaffinfotmp_tbl,$arr[1].$last_updated_by);
        // }
        $arr['appsit_status']=$appstaffinfotmp_tbl->appsit_status;
        $arr['staff_doc']=(!empty($doc_arr['staff_doc']))? $doc_arr['staff_doc']: '';
        // $arr['staff_doc']=($staffevaluationtmp_tbl->set_asmtupload);
        $arr['set_percentage']=$staffevaluationtmp_tbl->set_percentage;
        $arr['set_marksecured']=$staffevaluationtmp_tbl->set_marksecured;
        $arr['appsit_appdeccomment']=$comments;
        $arr['appsit_appdecon']=$todays;
        $arr['updat_by']=$last_updated_by['updat_by'];

        if($status == 1){
            $modelloc =  AppstafflocationtmpTbl::find()->where('aslt_appostaffinfotmp_fk =  '. $staffinfotmp_pk)->asArray()->all();
           if(!empty($modelloc)){
            foreach($modelloc as $data){
                $model =  AppstafflocationtmpTbl::find()->where('appstaffLocationtmp_pk =  '. $data['appstaffLocationtmp_pk'])->one();
                $model->aslt_status = 1;
                $model->aslt_staffstatus = 3;
                $model->save();
            }
        }
        }else if($status == 2){
            $modelloc =  AppstafflocationtmpTbl::find()->where('aslt_appostaffinfotmp_fk =  '. $staffinfotmp_pk .' and  aslt_staffstatus != 3')->asArray()->all();
            if(!empty($modelloc)){
             foreach($modelloc as $data){
                 $model =  AppstafflocationtmpTbl::find()->where('appstaffLocationtmp_pk =  '. $data['appstaffLocationtmp_pk'])->one();
                //  $model->aslt_status = 1;
                 $model->aslt_staffstatus = 4;
                 $model->save();
             }
         }
        }else{
            $modelloc =  AppstafflocationtmpTbl::find()->where('aslt_appostaffinfotmp_fk =  '. $staffinfotmp_pk)->asArray()->all();
            if(!empty($modelloc)){
             foreach($modelloc as $data){
                 $model =  AppstafflocationtmpTbl::find()->where('appstaffLocationtmp_pk =  '. $data['appstaffLocationtmp_pk'])->one();
                 $model->aslt_status = 1;
                 $model->aslt_staffstatus = 3;
                 $model->save();
             }
        }
    }
        return $arr; 

    }



    public static function getworkexp()
    {
        $request = Yii::$app->request;
        $staffview_id = $request->post('id');
        $arr=[];
      
        // $staffview_id = $request->post('staff_id');

        // $staffview_id = Security::decrypt($staffview_id);
     
        // $data = StaffinforepoTbl::find()
        // ->select("staffinforepo_pk,ocym_countryname_en,ocym_countryname_ar,sexp_employername,ocim_cityname_en,ocim_cityname_ar,osm_statename_en,osm_statename_ar,sexp_doj,sexp_currentlyworking")

        // ->leftJoin('staffworkexp_tbl','sexp_staffinforepo_fk = staffinforepo_pk')
        // ->leftJoin('opalcountrymst_tbl','opalcountrymst_pk = sexp_opalcountrymst_fk')
        // ->leftJoin('opalstatemst_tbl','opalstatemst_pk = sexp_opalstatemst_fk')
        // ->leftJoin('opalcitymst_tbl','opalcitymst_pk = sexp_opalcitymst_fk')
        // ->where("staffinforepo_pk = '$staffview_id'")->asarray()->all();

       $data = StaffworkexpTbl::find()
       ->select("*")
       ->leftJoin('opalcountrymst_tbl','opalcountrymst_pk = sexp_opalcountrymst_fk')
        ->leftJoin('opalstatemst_tbl','opalstatemst_pk = sexp_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl','opalcitymst_pk = sexp_opalcitymst_fk')
        ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk = sexp_profdocupload')

        ->where("sexp_staffinforepo_fk = '$staffview_id'")->asarray()->all();
        
       foreach( $data  as $key => $record){
            $url = \api\components\Drive::generateUrl($record['memcompfiledtls_pk'],$record['mcfd_opalmemberregmst_fk'],$record['mcfd_uploadedby']);
            $data[$key]['url'] =  $url;
        } 


        return $data;
    }

    public static function geteducationqulification()
    {
        $request = Yii::$app->request;
        $staffview_id = $request->post('id');
        $staffview_id1 = \api\components\Security::decrypt($request->post('id1'));

        $data = StaffacademicsTbl::find()
        
        ->select("ocim_cityname_en,ocim_cityname_ar,osm_statename_en,osm_statename_ar,sacd_startdate ,sacd_enddate,sacd_institutename,sacd_edulevel,sacd_grade,sacd_degorcert,staffedulevel.rm_name_en,staffedulevel.rm_name_ar,
        mcfd_filetype,memcompfiledtls_pk,mcfd_opalmemberregmst_fk,mcfd_uploadedby")
        ->leftJoin('referencemst_tbl AS staffedulevel','sacd_edulevel = staffedulevel.referencemst_pk')
        ->leftJoin('opalstatemst_tbl','opalstatemst_pk = sacd_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl','opalcitymst_pk = sacd_opalcitymst_fk')
        ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk = sacd_certupload')

        ->where("sacd_staffinforepo_fk = '$staffview_id'")->asarray()->all();
        foreach( $data  as $key => $record){
            $url = \api\components\Drive::generateUrl($record['memcompfiledtls_pk'],$record['mcfd_opalmemberregmst_fk'],$record['mcfd_uploadedby']);
            $data[$key]['url'] =  $url;
        }

        return $data;
    }

    public static function getstaffassesorloca()
    {
        $request = Yii::$app->request;
        $staffview_id = $request->post('id');
        $staffview_id1 = \api\components\Security::decrypt($request->post('id1'));
        $arr=[];

    //     $data = StaffinforepoTbl::find()
    // ->select(" aslt_opalcitymst_fk,osm_statename_en AS state_en, osm_statename_ar AS stat_ar,ocim_cityname_en,ocim_cityname_ar AS city_ar, aslt_opalstatemst_fk,aslt_opalcitymst_fk,appsit_status")
    // ->leftJoin('appstaffinfotmp_tbl','appsit_staffinforepo_fk = staffinforepo_pk')
    // ->leftJoin('appstaffLocationtmp_tbl','aslt_appostaffinfotmp_fk = appostaffinfotmp_pk')
    // ->leftJoin('opalstatemst_tbl','aslt_opalstatemst_fk = opalstatemst_pk')
    // ->leftJoin('opalcitymst_tbl','opalcitymst_pk in(aslt_opalcitymst_fk)')
    // ->where("aslt_appostaffinfotmp_fk = '$staffview_id1' group by opalstatemst_pk")
    // ->asArray()
    // ->all();
    $data = AppstafflocationtmpTbl::find()
    ->select("aslt_staffstatus,aslt_status,aslt_opalcitymst_fk,osm_statename_en AS state_en, osm_statename_ar AS stat_ar,ocim_cityname_en,ocim_cityname_ar AS city_ar, aslt_opalstatemst_fk,aslt_opalcitymst_fk")
    ->leftJoin('opalstatemst_tbl','aslt_opalstatemst_fk = opalstatemst_pk')
    ->leftJoin('opalcitymst_tbl','opalcitymst_pk in(aslt_opalcitymst_fk)')
    ->where("aslt_appostaffinfotmp_fk = '$staffview_id1'")
    ->asArray()
    ->all();

    foreach($data as $key => $value)
    {
        
        if(!empty($data[$key]['aslt_opalcitymst_fk'])) {

        $city =  OpalcitymstTbl::find()
        ->select("group_concat(ocim_cityname_en) AS city_en")
        ->where("opalcitymst_pk in(".$data[$key]['aslt_opalcitymst_fk'].")")
        ->asarray()
        ->all(); 
  
        $arr[$key]['state_en'] = $value['state_en'];
        $arr[$key]['city_en'] = $city[0]['city_en'];
        $arr[$key]['appsit_status'] = $value['appsit_status'];
        $arr[$key]['aslt_staffstatus'] = $value['aslt_staffstatus'];
        $arr[$key]['aslt_status'] = $value['aslt_status'];
    }
    }
  
  

   
  
    return $arr;
    }

    public static function getstaffavailabledate()
    {
        $request = Yii::$app->request;
        $staffview_id = $request->post('id');
        $staffview_id1 = \api\components\Security::decrypt($request->post('id1'));

        $arr=[];

        //  $data = StaffinforepoTbl::find()
        //  ->select("assd_date AS selecteddate, assd_starttime As starttime,assd_endtime AS endtime,rm_name_en AS status,rm_name_ar AS selectedcategory_ar")
        //  ->leftJoin('appstaffinfotmp_tbl','appsit_staffinforepo_fk = staffinforepo_pk')
        //  ->leftJoin('appstaffscheddtls_tbl','assd_appstaffinfotmp_fk = appostaffinfotmp_pk')
        //  ->leftJoin('referencemst_tbl','referencemst_pk = assd_dayschedule')
        //  ->where("staffinforepo_pk = '$staffview_id' group by appstaffscheddtls_pk")
        //  ->asArray()
        //  ->all();

        $data = AppstaffscheddtlsTbl::find()
         ->select(['appstaffscheddtls_pk','assd_appstaffinfotmp_fk','DATE_FORMAT(assd_date,"%d-%m-%Y") AS selecteddate','assd_date','assd_dayschedule',
         'concat((DATE_FORMAT(assd_starttime, "%h:%i %p")),"-",(DATE_FORMAT(assd_endtime, "%h:%i %p"))) as times','rm_name_en','rm_name_ar',
         "if(assd_date >= CURDATE(),'yes','no') as dtype"])
         ->leftJoin('referencemst_tbl','referencemst_pk = assd_dayschedule')
         ->where('assd_appstaffinfotmp_fk = '.$staffview_id1)
         ->orderBy(['appstaffscheddtls_pk' => SORT_DESC])
         ->asArray()->all();

    //   foreach($data as $key => $value)
    //     {
    //         if($value['selecteddate'] != null)
    //         {
    //             $selecteddate[$key] = $value['selecteddate'];

    //         }
            
    //     }

    //     $timestamps = array_map('strtotime', $selecteddate);

    //     $min_timestamp = min($timestamps);
    //     $max_timestamp = max($timestamps);

    //   $data[0]['min'] = date('Y-m-d', $min_timestamp);
    //   $data[0]['max'] = date('Y-m-d', $max_timestamp); 

    //   array_push($arr,$data,$min_date,$max_date);
       
        return $data;

        
    }



    public static function getvaluestaffview()
    {
        $request = Yii::$app->request;
        $staffview_id = $request->post('id');
        $asit_id = $request->post('asit_id');
        $asit_id = Security::decrypt($asit_id);
        $arr=[];
        $response=[];

        $data = ApplicationdtlstmpTbl::find()
        
        ->select("appsit_applicationdtlstmp_fk,appdt_appreferno,appsit_appcoursetrnstmp_fk,appsit_mainrole,appsit_jobtitle,sir_staffcv,sir_opalmemberregmst_fk,sir_createdby,appsit_status,appsit_appdeccomment,appostaffinfotmp_pk AS staffinfotmp_pk,appsit_language,lang.rm_name_en  AS lan_en,lang.rm_name_ar AS lang_ar,sir_moheridoc AS mohericard,sexp_designation AS jobtittle,staffinforepo_pk,sacd_staffinforepo_fk,sacd_edulevel,sexp_employername AS workername,sexp_doj AS dateofjoin,sexp_currentlyworking AS workstill,staffedulevel.rm_name_en AS edulevel,staffinforepo_pk,sacd_institutename AS institudename_edu,sacd_startdate AS startdate,sacd_enddate AS enddate,sacd_grade AS grade, sacd_degorcert AS certificate,mainrole.rolemst_pk,mainrole.rm_rolename_ar AS mainrole,mainrole.rm_rolename_en AS mainrole,ocym_countryname_en,ocym_countryname_ar,referencemst_tbl.rm_name_en,appsit_contracttype,sir_emailid,sir_dob,sir_gender,sir_nationality,ccm_catname_en AS cour_subcate , appctt_coursecategorymst_fk, rolemst_tbl.rm_rolename_en AS roleforcourse,rolemst_tbl.rm_rolename_ar,sir_idnumber AS civilnumber,sir_name_en AS staffname,sir_name_ar,sir_dob AS age, appsit_status AS status,appsit_createdon AS addedon,appsit_updatedon AS lastupdated,appsit_roleforcourse,appdt_apptype,appsit_iscarddetails,oum_firstname,
        mcfd_filetype")         ->innerJoin('appstaffinfotmp_tbl',' appsit_applicationdtlstmp_fk = applicationdtlstmp_pk')
->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appstaffinfotmp_tbl.appsit_appdecby')         ->leftJoin('referencemst_tbl','referencemst_tbl.referencemst_pk = appsit_contracttype')
         ->innerJoin('referencemst_tbl AS lang',' lang.referencemst_pk = appsit_language ')
         ->leftJoin('staffinforepo_tbl','appsit_staffinforepo_fk = staffinforepo_pk')

        ->leftJoin('staffacademics_tbl','sacd_staffinforepo_fk = staffinforepo_pk')
        ->leftJoin('referencemst_tbl AS staffedulevel','sacd_edulevel = staffedulevel.referencemst_pk')
        ->leftJoin('staffworkexp_tbl','sexp_staffinforepo_fk = staffinforepo_pk')

         ->leftJoin('opalcountrymst_tbl','opalcountrymst_pk = sir_nationality')
         ->leftJoin('appcoursetrnstmp_tbl','appsit_appcoursetrnstmp_fk = appcoursetrnstmp_pk')
         ->leftJoin('rolemst_tbl','appsit_roleforcourse = rolemst_tbl.rolemst_pk')
         ->leftJoin('rolemst_tbl AS mainrole','appsit_mainrole = mainrole.rolemst_pk')
         ->leftJoin('coursecategorymst_tbl','appctt_coursecategorymst_fk = coursecategorymst_pk')
         ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk = sir_moheridoc')
        ->where(" staffinforepo_pk = '$staffview_id' AND appostaffinfotmp_pk = '$asit_id' group by appostaffinfotmp_pk ")
        ->asArray()
        ->all();

        // print_r($data);exit;
        $doc_arr = \api\components\Drive::generateUrl($data[0]['mohericard'],$data[0]['sir_opalmemberregmst_fk'],$data[0]['sir_createdby']);
       if(!empty($data[0]['appsit_language'])){
        $land  = ReferencemstTbl::find()->select(['rm_name_en','rm_name_ar'])->where('referencemst_pk in ('.$data[0]['appsit_language'].')')->asArray()->all();
    //    print_r( $data);exit;
        $roleid =  $data[0]['appsit_roleforcourse'];
        $roleofcourse = RolemstTbl::find()
        ->select("rm_rolename_en AS roleforcourse, rm_rolename_ar AS roleforcourse_ar")
        ->where("rolemst_pk in($roleid)")
        ->asArray()
        ->all();

        $mainroleid =  $data[0]['appsit_mainrole'];
        $mainrole = RolemstTbl::find()
        ->select("rm_rolename_en AS roleforcourse, rm_rolename_ar AS roleforcourse_ar")
        ->where("rolemst_pk in($mainroleid)")
        ->asArray()
        ->all();
       }
    //    $appcoursedtlstmp_tbl= AppcoursedtlstmpTbl::find()->where("appcdt_applicationdtlstmp_fk = ".$data[0]['appsit_applicationdtlstmp_fk'])->one();
   

      
      if($data[0]['appsit_appcoursetrnstmp_fk']){
       $subcatpk = AppcoursetrnstmpTbl::find()->select('group_concat(appctt_coursecategorymst_fk) as subcat')->where('appcoursetrnstmp_pk in( '.$data[0]['appsit_appcoursetrnstmp_fk'].')')->asArray()->one();

       $subcategory = CoursecategorymstTbl::find()
       ->select("ccm_catname_en,ccm_catname_ar")
       ->where("coursecategorymst_pk in( ".$subcatpk['subcat'].")")
       ->asarray()
       ->all();

       } 
       

        $data[0]['doc'] = $doc_arr;
        $data[0]['doc_type'] =  $data[0]['mcfd_filetype'];
        $data[0]['lang'] = $land;
        $data[0]['roleforcourse'] = $roleofcourse;
        $data[0]['mainrole'] = $mainrole;
        $data[0]['coursesubcate'] = $subcategory;
        
        if($data[0]['appdt_projectmst_fk'] == 2){
            $cousesedetls = AppcoursedtlstmpTbl::find()
                ->select(['scm_assessmentin'])
                ->leftJoin('standardcoursemst_tbl','standardcoursemst_pk = appcdt_standardcoursemst_fk') 
                ->where(['appcdt_applicationdtlstmp_fk'=>$data[0]['appsit_applicationdtlstmp_fk']])
                ->asArray()->one();
                // 13 assessor 
              $accessor = in_array('13',explode(',',$roleid));  
              if($accessor &&  $cousesedetls['scm_assessmentin'] == 17){
                $data[0]['showaccessorloc'] = 'yes';
              }else{
                $data[0]['showaccessorloc'] = 'no';
              }

            
       }else{
            $data[0]['showaccessorloc'] = 'no';
       }

        //check update flow



        
        // $staffdata = AppstaffinfotmpTbl::find()
        // ->select(['appsit_iscarddetails'])
        // ->where(['appsit_applicationdtlstmp_fk' => $data[0]['appsit_applicationdtlstmp_fk']])
        // ->asArray()
        // ->all();
        // foreach($staffdata as $staffvalue){
        // $staffcardarray[] = $staffvalue['appsit_iscarddetails'];
        // }
        // if(in_array(1,$staffcardarray)){
        // $carddetails = 1;  
        // }else if(in_array(3,$staffcardarray)){
        //     $carddetails = 1;
        //  }else{
        // $carddetails = 2;
        // }
        // $data[0]['appsit_iscarddetails'] = $carddetails;  


        $appdeccard = AppstaffinfotmpTbl::find()->where("appostaffinfotmp_pk = '$asit_id'")->one();
      
        $status = $appdeccard->appsit_status;
        $appsit_appdeccomment = $appdeccard->appsit_appdeccomment;

       

        if($status == 1 || $status == 2) // new 
        {
            $appdecrecords['status'] = 1;
            array_push($response,$data,$appdecrecords);

        }
        elseif($status == 3 || $status == 5)  // approved  || failed
        {
            $staffval =  StaffevaluationtmpTbl::find()->where("set_appstaffinfotmp_fk = '$asit_id' and set_asmttype = 1")->orderBy(['staffevaluationtmp_pk' => SORT_DESC])->one();
            $staff_status = $appdeccard->appsit_status;

            

            $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
            $opalusermst_tbl = OpalusermstTbl::find()->where("opalusermst_pk = '$userPk'")->one();
            $appcdt_appdecby = $opalusermst_tbl->opalusermst_pk;

            if($staffval->set_asmtupload)
            {
                $appdecrecords['staff_doc'] = \api\components\Drive::generateUrl( $staffval->set_asmtupload,$appdeccard->appsit_opalmemberregmst_fk,$staffval->set_createdby );
            }
            else{
                $appdecrecords['staff_doc'] = "";
            }
            
           
          
                
                $appdecrecords['set_marksecured'] = $staffval->set_marksecured;  
                $appdecrecords['set_percentage'] = $staffval->set_percentage; 
                $appdecrecords['status'] =$status; 
                $appdecrecords['appsit_appdeccomment'] = $appsit_appdeccomment ; 
                $appdecrecords['appsit_appdecon'] = $appdeccard->appsit_appdecon ; 
                $appdecrecords['set_updatedby'] = $appdeccard->appsit_appdecby; 
                $appdecrecords['updat_by'] = $data[0]['oum_firstname'];             
                // $appdecrecords['staff_doc'] =$staffval->set_asmtupload;


                array_push($response,$data,$appdecrecords);

               
            

   

        }
        elseif($status == 4)  // declined
        {
            $staffval =  StaffevaluationtmpTbl::find()->where("set_appstaffinfotmp_fk = '$asit_id' and set_asmttype = 1")->orderBy(['staffevaluationtmp_pk' => SORT_DESC])->one();
            $staff_status = $appdeccard->appsit_status;

            $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
            $opalusermst_tbl = OpalusermstTbl::find()->where("opalusermst_pk = '$userPk'")->one();
            $appcdt_appdecby = $opalusermst_tbl->opalusermst_pk;

            $appdecrecords['status'] =$status; 
            $appdecrecords['appsit_appdeccomment'] = $appsit_appdeccomment ; 
            $appdecrecords['appsit_appdecon'] = $appdeccard->appsit_appdecon ; 
            $appdecrecords['set_updatedby'] = $appdeccard->appsit_appdecby; 
            $appdecrecords['updat_by'] = $opalusermst_tbl->oum_firstname;
         
            $appdecrecords['staff_doc'] = \api\components\Drive::generateUrl( $staffval->set_asmtupload,$appdeccard->appsit_opalmemberregmst_fk,$staffval->set_createdby );

            array_push($response,$data,$appdecrecords);

        } 
     
       // $arr =  array_merge($data, $doc_arr);   

      
 
   return $response;


    }

    public static function staffstatuschange()
    {
        $request = Yii::$app->request;
        $app_ref_id = $request->post('id');
        $select_valitate = $request->post('select_valitate');
        $comments = $request->post('comments');

           
     $model_ApplicationdtlstmpTbl =  ApplicationdtlstmpTbl::find()->where("appdt_appreferno = '$app_ref_id'")->one(); 
 
     $applicationdtlstmp_pk =  $model_ApplicationdtlstmpTbl->applicationdtlstmp_pk;

     $modelappstaffinfotmp_tbl = AppstaffinfotmpTbl::find()->where("appsit_applicationdtlstmp_fk = '$applicationdtlstmp_pk'")->one();
     if(count($modelappstaffinfotmp_tbl) >= 1)
     {
        $modelappstaffinfotmp_tbl->appsit_status = $select_valitate;
        $modelappstaffinfotmp_tbl->appsit_appdeccomment = $comments;
        $modelappstaffinfotmp_tbl->save();
     }
    
     return  $modelappstaffinfotmp_tbl;
    }




    public static function Documentstatuschange()
    {
        $request = Yii::$app->request;
        $app_ref_id = $request->post('id');
        $select_valitate = $request->post('select_valitate');
        $comments = $request->post('comments');
        $documentapproved_id = $request->post('documentapproved_id');
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $documentapproved_ids = join(',',$documentapproved_id);

           
     $model_ApplicationdtlstmpTbl =  ApplicationdtlstmpTbl::find()->where("appdt_appreferno = '$app_ref_id'")->one(); 
 
     $applicationdtlstmp_pk =  $model_ApplicationdtlstmpTbl->applicationdtlstmp_pk;

     $modelappdocsubmissiontmp_tbl = AppdocsubmissiontmpTbl::find()->where("appdocsubmissiontmp_pk in($documentapproved_ids)")->all();
     if(count($modelappdocsubmissiontmp_tbl) >= 1)
     {

        for($i=0; $i<count($modelappdocsubmissiontmp_tbl);$i++) {
          
              $modelappdocsubmissiontmp_tbl[$i]->appdst_status = $select_valitate; 
              $modelappdocsubmissiontmp_tbl[$i]->appdst_appdeccomment = $comments; 
              $modelappdocsubmissiontmp_tbl[$i]->appdst_appdecon = date("Y-m-d H:i:s");
              $modelappdocsubmissiontmp_tbl[$i]->appdst_appdecby =  $userPk; 
              $modelappdocsubmissiontmp_tbl[$i]->save();

         }


    
     }
     return $modelappdocsubmissiontmp_tbl;
    }





    public static function Internationalstatuschange()
    {
        $request = Yii::$app->request;
        $app_ref_id = $request->post('id');
        $select_valitate = $request->post('select_valitate');
        $comments = $request->post('comments');
        $international_id = $request->post('international_id');

        $international_comma_ids = join(',',$international_id);
        $arr = [];

        
           
     $model_ApplicationdtlstmpTbl =  ApplicationdtlstmpTbl::find()->where("appdt_appreferno = '$app_ref_id'")->one(); 
 
     $applicationdtlstmp_pk =  $model_ApplicationdtlstmpTbl->applicationdtlstmp_pk;

     

    $modelappintrecogtmp_tbl = AppintrecogtmpTbl::find()->where("appintrecogtmp_pk in($international_comma_ids)")->all();

   
    $updated_by = $modelappintrecogtmp_tbl[0]->appintit_opalmemberregmst_fk;
 

    $opalusermst_tbl = OpalusermstTbl::find()->where("oum_opalmemberregmst_fk = '$updated_by'")->one();
    $appcdt_appdecby = $opalusermst_tbl->opalusermst_pk;
    $last_updated_by= $opalusermst_tbl->oum_firstname;
   
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
     if(count($modelappintrecogtmp_tbl) >= 1)
    {
          for($i=0; $i<count($modelappintrecogtmp_tbl);$i++) {
          
             $modelappintrecogtmp_tbl[$i]->appintit_status = $select_valitate; 
               $modelappintrecogtmp_tbl[$i]->appintit_appdeccomment = $comments; 
               $modelappintrecogtmp_tbl[$i]->appintit_appdecby = $userPk; 
               $modelappintrecogtmp_tbl[$i]->appintit_appdecon = date("Y-m-d H:i:s");
               
              
              if(!$modelappintrecogtmp_tbl[$i]->save()){
                var_dump($modelappintrecogtmp_tbl[$i]->getErrors());
              }
     
          }
        }
       
        array_push($arr,$modelappintrecogtmp_tbl,$last_updated_by);


        

      return $arr;
   
       

    }



    public function aprefid()
    {
        $request = Yii::$app->request;
        $app_ref_id = $request->post('id');

     $data =  ApplicationdtlstmpTbl::find()
     ->select("appdt_projectmst_fk")
     ->where("appdt_appreferno = '$app_ref_id'") 
     ->asArray()
     ->one();

        return $data;
    }



    public static function Desktopstatuschange()
    {
        
        $request = Yii::$app->request;
        $app_ref_id = $request->post('id');
        $select_valitate = $request->post('select_valitate');
        $comments = $request->post('comments');
        $arr = [];
    $today = date("Y-m-d");

       
     $model_ApplicationdtlstmpTbl =  ApplicationdtlstmpTbl::find()->where("appdt_appreferno = '$app_ref_id'")->one(); 
     
    $applicationdtlstmp_pk =  $model_ApplicationdtlstmpTbl->applicationdtlstmp_pk;
  
    $model_appcoursedtlstmp_tbl = AppcoursedtlstmpTbl::find()->where("appcdt_applicationdtlstmp_fk  ='$applicationdtlstmp_pk'")->one(); 
    
   $updated_by = $model_appcoursedtlstmp_tbl->appcdt_opalmemberregmst_fk;
   $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
   $opalusermst_tbl = OpalusermstTbl::find()->where("opalusermst_pk = '$userPk'")->one();
   $appcdt_appdecby = $opalusermst_tbl->opalusermst_pk;
   $last_updated_by['updat_by'] = $opalusermst_tbl->oum_firstname;
  
    
    if( count($model_appcoursedtlstmp_tbl) >= 1 )
    {
        $model_appcoursedtlstmp_tbl->appcdt_status = $select_valitate;
        $model_appcoursedtlstmp_tbl->appcdt_appdeccomment = $comments;
        $model_appcoursedtlstmp_tbl->appcdt_appdecby = $userPk;
        $model_appcoursedtlstmp_tbl->appcdt_appdecon = $today;
        $model_appcoursedtlstmp_tbl->save();
    }

   
    

    $appcoursedtlstmp_pk = $model_appcoursedtlstmp_tbl->appcoursedtlstmp_pk;

    $model_appcoursetrnstmp_tbl = AppcoursetrnstmpTbl::find()->where("appctt_appcoursedtlstmp_fk = '$appcoursedtlstmp_pk'")->all();
    if(count($model_appcoursetrnstmp_tbl) >= 1)
    {
        for($i=0; $i<count($model_appcoursetrnstmp_tbl);$i++) {
        $model_appcoursetrnstmp_tbl[$i]->appctt_status = $select_valitate;
        $model_appcoursetrnstmp_tbl[$i]->appctt_appdeccomment = $comments;
        $model_appcoursetrnstmp_tbl[$i]->appctt_appdecon =  $today;
        $model_appcoursetrnstmp_tbl[$i]->appctt_appdecby = $userPk;
        $model_appcoursetrnstmp_tbl[$i]->save();
        }

    }
   
//     $model_appdocsubmissiontmp_tbl = AppdocsubmissiontmpTbl::find()->where('appdst_applicationdtlstmp_fk = '.$applicationdtlstmp_pk.'')->one();

//     if(count($model_appdocsubmissiontmp_tbl) >= 1)
//     {
//         $model_appdocsubmissiontmp_tbl->appdst_status = $select_valitate;
//         $model_appdocsubmissiontmp_tbl->appdst_appdeccomment = $comments;
//         $model_appdocsubmissiontmp_tbl->save();
//     }
   

//     $model_appintrecogtmp_tbl = AppintrecogtmpTbl::find()->where('appintit_applicationdtlstmp_fk = '.$applicationdtlstmp_pk.'')->one();
//    if(count($model_appintrecogtmp_tbl) >= 1)
//    {
//     $model_appintrecogtmp_tbl->appintit_status = $select_valitate;
//     $model_appintrecogtmp_tbl->appintit_appdeccomment = $select_valitate;
//     $model_appintrecogtmp_tbl->save();
//    }
     

//     $model_appstaffinfotmp_tbl = AppstaffinfotmpTbl::find()->where('appsit_applicationdtlstmp_fk = '.$applicationdtlstmp_pk.'')->one();
//    if(count($model_appstaffinfotmp_tbl) >= 1)
//    {
//     $model_appstaffinfotmp_tbl->appsit_status = $select_valitate;
//     $model_appstaffinfotmp_tbl->appsit_appdeccomment = $select_valitate;
//     $model_appstaffinfotmp_tbl->save();
//    }
   
      
   
    // $data->status = $select_valitate;
    // $data->commentss =  $comments;
    
    
    // $values = json_encode($data);
 
  
    array_push($arr,$model_appcoursedtlstmp_tbl,$last_updated_by);

        return $arr;

    }

    public static function getstafftab()
    {

        $request = Yii::$app->request;
        $apprefer_id = $request->post('id');
       $doc_arr= [];
        $data = ApplicationdtlstmpTbl::find()
      ->select("appsit_status")
       ->innerJoin('appstaffinfotmp_tbl',' appsit_applicationdtlstmp_fk=applicationdtlstmp_pk')
       ->leftJoin('staffinforepo_tbl','appsit_staffinforepo_fk = staffinforepo_pk')
      ->where(" appdt_appreferno = '$apprefer_id' group by staffinforepo_pk")
      ->asArray()
      ->all();    

 

      foreach($data as $key => $value){

       
        $doc_arr[$key]['appsit_status'] = $value['appsit_status'];  
       
      }
        return $doc_arr;
    }
    public static function getstafftabdata()
    {
        $request = Yii::$app->request;
        $apprefer_id = $request->post('id');
        $limit = empty($request->post('limit'))?10:$request->post('limit');
        $page = empty($request->post('page'))?0:$request->post('page');
        $searchkey = $request->post('serachkey');
       $doc_arr= [];
    //    getallStandardCoursesapproval
       $query = ApplicationdtlstmpTbl::find()
      ->select("(case  when appsit_iscarddetails = 2 and sccd_appcoursetrnstmp_fk is null then '1' 
      when sccd_status =1 then '2'  when sccd_status =2 then '3' when appsit_iscarddetails = 1 then '4' end) as competcard,appsit_roleforcourse,appostaffinfotmp_pk,oum_firstname,appsit_appdeccomment,appsit_updatedon,staffinforepo_pk,ccm_catname_en AS cour_subcate , appctt_coursecategorymst_fk, group_concat(rm_rolename_en) AS roleforcourse,rm_rolename_ar,sir_idnumber AS civilnumber,sir_name_en AS staffname,sir_name_ar,sir_dob AS age, appsit_status AS status,appsit_createdon AS addedon,appsit_updatedon AS lastupdated,
       appdt_status as appdt_status,appsit_appcoursetrnstmp_fk,appsit_status,appcdt_appoffercoursemain_fk,appcdt_standardcoursemst_fk,appdt_projectmst_fk,appsit_staffinforepo_fk,
      appsit_appdecon")       ->innerJoin('appstaffinfotmp_tbl',' appsit_applicationdtlstmp_fk=applicationdtlstmp_pk')
       ->leftJoin('rolemst_tbl','find_in_set(rolemst_pk,appsit_roleforcourse) ')
        ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appstaffinfotmp_tbl.appsit_appdecby')
       ->leftJoin('staffinforepo_tbl','appsit_staffinforepo_fk = staffinforepo_pk')
       ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
       ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk')
       ->leftJoin('appcoursetrnstmp_tbl','find_in_set(appcoursetrnstmp_pk,appsit_appcoursetrnstmp_fk)')
       ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = appsit_applicationdtlstmp_fk')


       ->leftJoin('coursecategorymst_tbl','appctt_coursecategorymst_fk = coursecategorymst_pk');
      $query->where("appdt_appreferno = '$apprefer_id' ");

      if(!empty($searchkey['civil_number_filter'])){
        $query->andwhere("sir_idnumber like '%".$searchkey['civil_number_filter']."%'");
        }
        if(!empty($searchkey['staff_name_filter'])){
        $query->andwhere("sir_name_en like '%".$searchkey['staff_name_filter']."%'");
        }
        if(!empty($searchkey['rolecourse_filter'])){
            $query->andwhere("rm_rolename_en like '%".$searchkey['rolecourse_filter']."%'");
            }
        if(!empty($searchkey['coursesubcate_filter'])){
            $query->andwhere("ccm_catname_en like '%".$searchkey['coursesubcate_filter']."%'");
            }
        if(!empty($searchkey['stat_us_filter'])){
            $query->andwhere("appsit_status in( ".implode(",",$searchkey['stat_us_filter']).")");
        }
        if(!empty($searchkey['addedon_filter']['startDate'])){
            $query->andwhere("appsit_createdon  between '".date("Y-m-d", strtotime($searchkey['addedon_filter']['startDate']. "+1 day"))."' and '".date("Y-m-d", strtotime($searchkey['addedon_filter']['endDate']. "+1 day"))."'");
         }
         if(!empty($searchkey['last_audit']['startDate'])){
            $query->andwhere("appsit_updatedon  between '".date("Y-m-d", strtotime($searchkey['last_audit']['startDate']. "+1 day"))."' and '".date("Y-m-d", strtotime($searchkey['last_audit']['endDate']. "+1 day"))."'");
         }
      $query->groupBy('staffinforepo_pk');
      $query->orderBy(['appsit_updatedon' => SORT_DESC,'appsit_createdon'=>SORT_DESC]);
      $query->asArray();
    //   ->all();   
    
    
            $dataProvider = new ActiveDataProvider([
                'query' =>   $query,
                'pagination' => [
                                    'pageSize' => $limit,
                                    'page'=>$page
                                ]
                    ]);
            $data =  $dataProvider->getModels();
            $total = $dataProvider->getTotalCount();
            
            foreach($data as $key => $value){

                $comptcard = AppstaffinfotmpTbl::find()
                ->select(["(case  when appsit_iscarddetails = 2 and staffcompetencycarddtls_pk is null then '1' when appsit_iscarddetails = 1 then '4'
                when sccd_status =1 then '2'  when sccd_status =2 then '3'  end) as competcard"])
                ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
                ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');
                if($value['appdt_projectmst_fk'] == 2){
                    $comptcard->where(['scch_standardcoursemst_fk'=>$value['appcdt_standardcoursemst_fk']]);
                }else{
                    $comptcard->where(['scch_appoffercoursemain_fk'=>$value['appcdt_appoffercoursemain_fk']]);
        
                }
                $comptcard->andWhere(['appostaffinfotmp_pk'=>$value['appostaffinfotmp_pk']]);
                $comptcard->orderBy(['staffcompetencycardhdr_pk' => SORT_DESC]);
                $compt =  $comptcard->asArray()->one();
                // 1 -new ,2-active 3-expired 4-postforupgrade
                $comptcard_info =  empty($compt['competcard'])?'1':$compt['competcard'];
        // echo  $comptcard_info ;
        
               $roleid =  $value['appsit_roleforcourse'];
               $roleofcourse = RolemstTbl::find()
               ->select("group_concat(rm_rolename_en) AS roleforcourse ,group_concat(rm_rolename_ar) AS roleforcourse_ar")
               ->where("rolemst_pk in($roleid)")
               ->asArray()
               ->all();
        
               $subcatpk = AppcoursetrnstmpTbl::find()->select('group_concat(appctt_coursecategorymst_fk) as subcat')
               ->where('appcoursetrnstmp_pk in( '.$value['appsit_appcoursetrnstmp_fk'].')')->asArray()->one();
        
               $subcategory = CoursecategorymstTbl::find()
               ->select("group_concat(ccm_catname_en) as ccm_catname_en,group_concat(ccm_catname_ar) as ccm_catname_ar")
               ->where("coursecategorymst_pk in( ".$subcatpk['subcat'].")")
               ->asarray()
               ->all();
        
                $allstaffevaluated = 'yes'; 
                if( $value['appsit_status'] == 1 ||  $value['appsit_status'] == 2){
                    $allstaffevaluated = 'no'; 
                }
                $doc_arr[$key]['appsit_roleforcourse'] = $value['appsit_roleforcourse'];   
                $doc_arr[$key]['appostaffinfotmp_pk'] = $value['appostaffinfotmp_pk'];   
                $doc_arr[$key]['oum_firstname'] = $value['oum_firstname'];   
                $doc_arr[$key]['appsit_appdeccomment'] = $value['appsit_appdeccomment'];   
                $doc_arr[$key]['staffinforepo_pk'] = $value['staffinforepo_pk'];   
                $doc_arr[$key]['cour_subcate'] = $value['cour_subcate'];   
                $doc_arr[$key]['appctt_coursecategorymst_fk'] = $value['appctt_coursecategorymst_fk'];   
                $doc_arr[$key]['rm_rolename_ar'] = $value['rm_rolename_ar'];   
                $doc_arr[$key]['civilnumber'] = $value['civilnumber'];   
                $doc_arr[$key]['staffname'] = $value['staffname'];   
                $doc_arr[$key]['sir_name_ar'] = $value['sir_name_ar'];   
                $doc_arr[$key]['age'] = $value['age'];   
                $doc_arr[$key]['status'] = $value['status'];   
                $doc_arr[$key]['addedon'] = $value['addedon'];   
                $doc_arr[$key]['lastupdated'] = $value['lastupdated'];   
                $doc_arr[$key]['roleofcourse'] =  $roleofcourse;   
               
                $doc_arr[$key]['competcard'] =  $comptcard_info;   
                $doc_arr[$key]['subcategory'] =  $subcategory;   
                $doc_arr[$key]['appsit_status'] = $value['appsit_status'];  
                $doc_arr[$key]['appdt_status'] = $value['appdt_status'];   
                $doc_arr[$key]['allstaffevaluated'] = $allstaffevaluated;
                $doc_arr[$key]['appsit_appdecon'] = $value['appsit_appdecon']; 
                // $doc_arr[$key]['appdocsubmissiontmp_pk'] = $value['appdocsubmissiontmp_pk'];   
                // $doc_arr[$key]['oum_firstname'] = $value['oum_firstname']; 
              }


    
            return ['arr'=>$doc_arr,'limit'=>$limit,'totalcount'=>$total];


    }
    public static function inspectionapprodecprocettab()
    {

        $request = Yii::$app->request;
        $apprefer_id = $request->post('id');
        $doc_arr = [];

        $data = ApplicationdtlstmpTbl::find()
      
      ->select("oum_firstname,appdst_memcompfiledtls_fk,appdst_upload,appdst_opalmemberregmst_fk,appdst_createdby,appdocsubmissiontmp_pk,appdst_appdeccomment,appdst_submissionstatus,appdst_remarks, appdst_submissionstatus AS documentprovided,ddm_documentname_en AS documentname,ddm_documentname_ar,appdst_applicationdtlstmp_fk, appdst_status AS status, appdst_createdon AS addedon,appdst_updatedon , appdst_appdecon,mcfd_filetype")

      ->innerJoin('appdocsubmissiontmp_tbl','appdst_applicationdtlstmp_fk = applicationdtlstmp_pk')
    //  ->leftJoin('opalusermst_tbl','appdst_opalmemberregmst_fk = 	oum_opalmemberregmst_fk')
      ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = appdst_memcompfiledtls_fk')
      ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appdocsubmissiontmp_tbl.appdst_appdecby')
      ->innerJoin('documentdtlsmst_tbl','appdst_documentdtlsmst_fk = documentdtlsmst_pk')
      ->where("appdt_appreferno = '$apprefer_id'  group by appdocsubmissiontmp_pk")
      ->asArray()
      ->all();

    //   print_r( $data);exit;

      foreach($data as $key => $value){
        
        $doc_arr[$key]['appdocsubmissiontmp_pk'] = $value['appdocsubmissiontmp_pk'];   
        $doc_arr[$key]['oum_firstname'] = $value['oum_firstname'];   
        $doc_arr[$key]['appdst_appdeccomment'] = ($value['appdst_appdeccomment'])?$value['appdst_appdeccomment']:'Nil';   
        $doc_arr[$key]['documentprovided'] = $value['documentprovided'];   
        $doc_arr[$key]['documentname'] = $value['documentname'];   
        $doc_arr[$key]['appdst_applicationdtlstmp_fk'] = $value['appdst_applicationdtlstmp_fk'];   
        $doc_arr[$key]['addedon'] = $value['addedon'];   
        $doc_arr[$key]['appdst_updatedon'] = $value['appdst_updatedon']; 
        $doc_arr[$key]['status'] = $value['status']; 
        $doc_arr[$key]['appdst_appdecon'] = $value['appdst_appdecon']; 
        $doc_arr[$key]['mcfd_filetype'] = $value['mcfd_filetype']; 
        
        

        if($value['documentprovided'] == 2)
        {
        $doc_arr[$key]['docs_remarks'] = $value['appdst_remarks'];   

        }
        else
        {
            $doc_arr[$key]['docs_remarks'] = \api\components\Drive::generateUrl($value['appdst_memcompfiledtls_fk'],$value['appdst_opalmemberregmst_fk'],$value['appdst_createdby']  );
        }

     



     }




        return $doc_arr;
    }
    public static function getdocumenttab()
    {

        $request = Yii::$app->request;
        $apprefer_id = $request->post('id');
        $doc_arr = [];

        $data = ApplicationdtlstmpTbl::find()
      
      ->select("oum_firstname,appdst_memcompfiledtls_fk,appdst_upload,appdst_opalmemberregmst_fk,appdst_createdby,appdocsubmissiontmp_pk,appdst_appdeccomment,appdst_submissionstatus,appdst_remarks, appdst_submissionstatus AS documentprovided,ddm_documentname_en AS documentname,ddm_documentname_ar,appdst_applicationdtlstmp_fk, appdst_status AS status, appdst_createdon AS addedon,appdst_updatedon , appdst_appdecon,mcfd_filetype")

      ->innerJoin('appdocsubmissiontmp_tbl','appdst_applicationdtlstmp_fk = applicationdtlstmp_pk')
    //  ->leftJoin('opalusermst_tbl','appdst_opalmemberregmst_fk = 	oum_opalmemberregmst_fk')
      ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = appdst_memcompfiledtls_fk')
      ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appdocsubmissiontmp_tbl.appdst_appdecby')
      ->innerJoin('documentdtlsmst_tbl','appdst_documentdtlsmst_fk = documentdtlsmst_pk')
      ->where("appdt_appreferno = '$apprefer_id'  group by appdocsubmissiontmp_pk")
      ->asArray()
      ->all();

    //   print_r( $data);exit;

      foreach($data as $key => $value){
        
        $doc_arr[$key]['appdocsubmissiontmp_pk'] = $value['appdocsubmissiontmp_pk'];   
        $doc_arr[$key]['oum_firstname'] = $value['oum_firstname'];   
        $doc_arr[$key]['appdst_appdeccomment'] = ($value['appdst_appdeccomment'])?$value['appdst_appdeccomment']:'Nil';   
        $doc_arr[$key]['documentprovided'] = $value['documentprovided'];   
        $doc_arr[$key]['documentname'] = $value['documentname'];   
        $doc_arr[$key]['appdst_applicationdtlstmp_fk'] = $value['appdst_applicationdtlstmp_fk'];   
        $doc_arr[$key]['addedon'] = $value['addedon'];   
        $doc_arr[$key]['appdst_updatedon'] = $value['appdst_updatedon']; 
        $doc_arr[$key]['status'] = $value['status']; 
        $doc_arr[$key]['appdst_appdecon'] = $value['appdst_appdecon']; 
        $doc_arr[$key]['mcfd_filetype'] = $value['mcfd_filetype']; 
        
        

        if($value['documentprovided'] == 2)
        {
        $doc_arr[$key]['docs_remarks'] = $value['appdst_remarks'];   

        }
        else
        {
            $doc_arr[$key]['docs_remarks'] = \api\components\Drive::generateUrl($value['appdst_memcompfiledtls_fk'],$value['appdst_opalmemberregmst_fk'],$value['appdst_createdby']  );
        }

     



     }




        return $doc_arr;
    }




    public static function getinternationaltab()
    {
        $request = Yii::$app->request;
        $apprefer_id = $request->post('id');
        $doc_arr = [];

        $data = ApplicationdtlstmpTbl::find()
      
      ->select("oum_firstname,appintit_doc,appintit_opalmemberregmst_fk,appintit_createdby,appintit_appdeccomment,appintrecogtmp_pk,appintit_applicationdtlstmp_fk,irm_intlrecogname_en AS awarding ,irm_intlrecogname_ar,appintit_intnatrecogmst_fk, intnatrecogmst_pk, appintit_lastauditdate AS lastaudited,appintit_status AS status, appintit_createdon AS addedon, appintit_updatedon AS lastupdated ,appintit_appdecon as appintit_appdecon , mcfd_filetype,
      appdt_apptype ")
      ->innerJoin('appintrecogtmp_tbl','appintit_applicationdtlstmp_fk = applicationdtlstmp_pk')
      //->leftJoin('opalusermst_tbl','oum_opalmemberregmst_fk = 	oum_opalmemberregmst_fk')
      ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appintrecogtmp_tbl.appintit_appdecby')
      ->leftJoin('intnatrecogmst_tbl','appintit_intnatrecogmst_fk =  intnatrecogmst_pk')
      ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = appintit_doc')
      ->where("appdt_appreferno = '$apprefer_id'  group by intnatrecogmst_pk")
      ->asArray()
      ->all();

      
    // $updated_by = $modelappintrecogtmp_tbl->appintit_opalmemberregmst_fk;
    // $opalusermst_tbl = OpalusermstTbl::find()->where("oum_opalmemberregmst_fk = '$updated_by'")->one();
    // $appcdt_appdecby = $opalusermst_tbl->opalusermst_pk;
    // $last_updated_by= $opalusermst_tbl->oum_firstname;
    //   $proof = \api\components\Drive::generateUrl("appintit_doc,appintit_opalmemberregmst_fk,appintit_createdby");

  

    foreach($data as $key => $value){

        $doc_arr[$key]['appintit_appdeccomment'] = ($value['appintit_appdeccomment'])? $value['appintit_appdeccomment']:"Nil" ;
        $doc_arr[$key]['appintit_opalmemberregmst_fk'] = $value['appintit_opalmemberregmst_fk'];   
        $doc_arr[$key]['oum_firstname'] = $value['oum_firstname'];  
        $doc_arr[$key]['appintit_appdecon'] = $value['appintit_appdecon'];  
        $doc_arr[$key]['appintrecogtmp_pk'] = $value['appintrecogtmp_pk'];   
        $doc_arr[$key]['appintit_applicationdtlstmp_fk'] = $value['appintit_applicationdtlstmp_fk'];   
        $doc_arr[$key]['awarding'] = $value['awarding'];   
        $doc_arr[$key]['irm_intlrecogname_ar'] = $value['irm_intlrecogname_ar'];   
        $doc_arr[$key]['appintit_intnatrecogmst_fk'] = $value['appintit_intnatrecogmst_fk'];   
        $doc_arr[$key]['intnatrecogmst_pk'] = $value['intnatrecogmst_pk'];   
        $doc_arr[$key]['lastaudited'] = $value['lastaudited'];   
        $doc_arr[$key]['status'] = $value['status'];   
     
        $doc_arr[$key]['addedon'] = $value['addedon'];   
        $doc_arr[$key]['lastupdated'] = $value['lastupdated']; 
        $doc_arr[$key]['mcfd_filetype'] = $value['mcfd_filetype']; 
        $doc_arr[$key]['appdt_apptype'] = $value['appdt_apptype'];   
        $doc_arr[$key]['docs'] = \api\components\Drive::generateUrl($value['appintit_doc'],$value['appintit_opalmemberregmst_fk'],$value['appintit_createdby']  );

     }
    

        return $doc_arr;
    }

    public static function getonestandardcoursesapproval()
    {

        $request = Yii::$app->request;

        $temp_id = $request->post('id');



 $data = ApplicationdtlstmpTbl::find()

 ->select("appoct_courselevel,appcdt_updatedon,appcdt_status,omrm_companyname_ar,
 omrm_companyname_en,omrm_tpname_en,omrm_tpname_ar,appdt_certificateexpiry,appdt_updatedon,
 appdt_submittedon,oum_firstname,appinstinfomain_pk,applicationdtlstmp_pk,
 appdt_certificateexpiry AS dateofexpiry,appcdt_appdecon,appcdt_appdecby,appctt_status,
 appctt_appdeccomment,appiih_branchname_en AS compnameeng ,appiih_branchname_ar,
  appdt_appdeccomment, offerrequestfor.rm_name_en as offerrequestfor_en,
  offerrequestfor.rm_name_ar as offerrequestfor_ar,
  ( CASE WHEN standaradrequestfor.rm_name_en IS NOT NULL 
  THEN standaradrequestfor.rm_name_en ELSE offerrequestfor.rm_name_en END) AS requestfor,
 ( CASE WHEN standaradlevel.rm_name_en IS NOT NULL 
 THEN standaradlevel.rm_name_en ELSE  offerlevel.rm_name_en END) AS courselevel,  
 appdt_appreferno AS applictionno, sir_name_en As trainprovname,sir_name_ar,
 appiim_officetype  AS offictype,
 ( CASE WHEN appiim_officetype =  1  THEN NULL ELSE  appiim_branchname_en END) AS branchname,
 ,appiim_branchname_ar,appiim_locmapurl AS  sitelocan,appiim_loclongitude,appiim_loclatitude,
 appdt_projectmst_fk AS coursetype,(CASE WHEN appocm_coursename_en IS NOT NULL 
 THEN  appocm_coursename_en ELSE scm_coursename_en  END) AS coursetitle, 
 (CASE WHEN category.ccm_catname_en IS NOT NULL THEN category.ccm_catname_en ELSE scm_coursename_en END) AS coursecate,
 (CASE WHEN category.ccm_catname_ar IS NOT NULL THEN category.ccm_catname_ar ELSE scm_coursename_ar END) AS coursecate_ar,
 appcoursetrnstmp_pk,
  group_concat(Distinct(coursesubcategory.ccm_catname_en) SEPARATOR  '**') AS coursesubcate,
 group_concat(Distinct(coursesubcategory.ccm_catname_ar)) AS coursesubcate_ar , 
 appdt_apptype As applytype,appdt_status as applicationstatus,appdt_updatedon,appdt_appdecon,
 applicationdtlstmp_pk,appdt_apptype,appdt_status ,(case when appdt_certificateexpiry is null then '1'    when appdt_certificateexpiry is not null and  appdt_certificateexpiry > CURDATE() then '2'
 when appdt_certificateexpiry is not null and  appdt_certificateexpiry < CURDATE()  then '3'  end) as certification,asd_date")
->innerJoin('appcoursedtlstmp_tbl','applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk')
 ->leftJoin('opalmemberregmst_tbl','appcdt_opalmemberregmst_fk = opalmemberregmst_pk')

 //->leftJoin('opalusermst_tbl','	oum_opalmemberregmst_fk = appcdt_opalmemberregmst_fk')
 ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appcoursedtlstmp_tbl.appcdt_appdecby')
 ->leftJoin('appinstinfomain_tbl','appcdt_appinstinfomain_fk = appinstinfomain_pk')
 ->leftJoin('appstaffinfotmp_tbl','appsit_applicationdtlstmp_fk = applicationdtlstmp_pk')
 ->leftJoin('appinstinfohsty_tbl','appcdt_appinstinfomain_fk = appinstinfohsty_pk')
 ->leftJoin('staffinforepo_tbl','appsit_staffinforepo_fk = staffinforepo_pk')



 ->leftJoin('appoffercoursemain_tbl','appoffercoursemain_pk = appcdt_appoffercoursemain_fk')
 ->leftJoin('appoffercoursetmp_tbl','appcdt_appoffercoursemain_fk = appoffercoursemain_pk')
 ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk in(appocm_coursesubcategorymst_fk)')
 ->leftJoin('coursecategorymst_tbl AS category',' appocm_coursecategorymst_fk in(category.coursecategorymst_pk)')

 ->leftJoin('standardcoursemst_tbl','standardcoursemst_pk = appcdt_standardcoursemst_fk')
 ->leftJoin('standardcoursedtls_tbl','scd_standardcoursemst_fk = standardcoursemst_pk')
 ->leftJoin('appcoursetrnstmp_tbl','appctt_appcoursedtlstmp_fk = appcoursedtlstmp_pk')
 ->leftJoin('coursecategorymst_tbl AS coursesubcategory','appctt_coursecategorymst_fk = coursesubcategory.coursecategorymst_pk')
->leftJoin('appcoursedtlsmain_tbl','appcdm_standardcoursemst_fk = coursecategorymst_tbl.ccm_coursecategorymst_pk')

->leftJoin('referencemst_tbl AS standaradlevel','standaradlevel.referencemst_pk = appoct_courselevel')
->leftJOin('referencemst_tbl AS offerlevel','offerlevel.referencemst_pk = scm_courselevel')

 ->leftjoin('referencemst_tbl AS standaradrequestfor', 'standaradrequestfor.referencemst_pk = scm_requestfor') 
 ->leftjoin('referencemst_tbl AS offerrequestfor', 'offerrequestfor.referencemst_pk = appcdt_requestfor')
 ->leftJoin('appauditschedtmp_tbl','appasdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
->leftJoin('auditscheddtls_tbl','auditscheddtls_pk = appasdt_auditscheddtls_fk')
 
 ->Where(" appdt_status != 1 and appdt_projectmst_fk in (2,3)  and ((appcdt_appoffercoursemain_fk is not null and appcdt_standardcoursemst_fk is null) or (appcdt_appoffercoursemain_fk is null and appcdt_standardcoursemst_fk is not null))and appdt_appreferno = '".$temp_id."' group by appdt_appreferno")
 
 ->asArray()
 ->all();








return $data;

      
    }

    public static function checkallapprovedornot()
    {

        $request = Yii::$app->request;

        $temp_id = $request->post('id');

        $data = ApplicationdtlstmpTbl::find()
        ->select(['applicationdtlstmp_pk'])
        ->Where(" appdt_appreferno = '".$temp_id."'")
        ->asArray()->one();

        $staffdata = AppstaffinfotmpTbl::find()->select(['group_concat(appsit_status) as status'])
        ->where(['appsit_applicationdtlstmp_fk'=>$data['applicationdtlstmp_pk']])->asArray()->one();
        $uniqueValues = array_unique(explode(',',$staffdata['status']));
        $isAllThree = (count($uniqueValues) === 1 && $uniqueValues[0] == 3);

        $retundata ='';
        if($isAllThree){
            $retundata ='ok';
        }else{
            $retundata ='notok';
        }
       return ['retundata'=>$retundata];
    }

    public static function getallStandardCoursesapproval()
    {
        $request = Yii::$app->request;

        $desktopfilter = $request->post('desktopfilter');
        $limit = empty($request->post('limit'))?10:$request->post('limit');
        $page = empty($request->post('page'))?0:$request->post('page');
        $searchkey = $request->post('searchkey');
        $order = $request->post('order');
        $sort = $request->post('sort');
        $today = date("Y-m-d");
        $arr = [];
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

            $usercourse = OpalusermstTbl::find()
            ->select(['oum_standcoursemst_fk' , 'oum_allocatedproject' , 'oum_isfocalpoint' , 'oum_opalmemberregmst_fk'])
            ->where("opalusermst_pk = '$userPk'")
            ->andWhere("oum_status = 'A'")
            ->asArray()
            ->one();   

            if($usercourse['oum_isfocalpoint'] == '1' and $usercourse['oum_opalmemberregmst_fk'] == '1'){
                $project_pk = '2,3';
                $standardcourse = '';
            }else{
                $project_pk_array = [];
                $allocatedprojects  = explode(',', $usercourse['oum_allocatedproject']);
                if(in_array('2',$allocatedprojects)){
                  array_push($project_pk_array , 2);
                }

                if(in_array('3',$allocatedprojects)){
                    array_push($project_pk_array , 3);
                }
                $project_pk  = implode(',',$project_pk_array);
                if($usercourse['oum_standcoursemst_fk']){
                    $standardcourse =  " and standardcoursemst_pk in (".$usercourse['oum_standcoursemst_fk'].")";
                }
               

            }
              
           $query = ApplicationdtlstmpTbl::find()
            ->select("
            appcdt_status,appdt_certificatepath,omrm_tpname_en,omrm_tpname_ar,appdt_certificateexpiry,appdt_updatedon,appdt_submittedon,applicationdtlstmp_pk,appdt_certificateexpiry AS dateofexpiry,appdt_appreferno AS applictionno,appiim_officetype  AS offictype,
            appiim_branchname_en AS branchname,appiim_branchname_ar,appiim_locmapurl,appiim_loclongitude,appiim_loclatitude AS sitelocan,
		    appdt_projectmst_fk AS coursetype,(CASE WHEN appocm_coursename_en IS NOT NULL THEN  appocm_coursename_en ELSE scm_coursename_en  END) AS coursetitle, (CASE WHEN  category.ccm_catname_en IS NOT NULL THEN category.ccm_catname_en ELSE scm_coursename_en  END ) AS coursecate,appcoursetrnstmp_pk, group_concat(DISTINCT(coursesubcategory.ccm_catname_en) SEPARATOR '**') AS coursesubcate , appdt_apptype As applytype, appdt_status AS applicationstatus,appdt_updatedon AS lastUpdated ,appdt_certificateexpiry AS addedon,applicationdtlstmp_pk,appdt_apptype,appdt_status ,category.coursecategorymst_pk,appocm_coursecategorymst_fk,
            omrm_companyname_en,omrm_companyname_ar,asd_date")    
            ->innerJoin('appcoursedtlstmp_tbl','applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk')
            ->leftJoin('opalmemberregmst_tbl','appcdt_opalmemberregmst_fk = opalmemberregmst_pk')
            ->leftJoin('appinstinfomain_tbl','appcdt_appinstinfomain_fk = appinstinfomain_pk')
           // ->leftjoin('applicationdtlsmain_tbl','applicationdtlsmain_pk = appiim_applicationdtlsmain_fk')
           // ->leftJoin('appstaffinfotmp_tbl','appsit_applicationdtlstmp_fk = applicationdtlstmp_pk')
           // ->leftJoin('staffinforepo_tbl','appsit_staffinforepo_fk = staffinforepo_pk')
            ->leftJoin('appoffercoursemain_tbl','appoffercoursemain_pk = appcdt_appoffercoursemain_fk')
            //->leftJoin('appoffercoursetmp_tbl','appcdt_appoffercoursemain_fk = appoffercoursemain_pk')
            ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk in(appocm_coursesubcategorymst_fk)')
            ->leftJoin('coursecategorymst_tbl AS category',' appocm_coursecategorymst_fk in(category.coursecategorymst_pk)')
            ->leftJoin('standardcoursemst_tbl','standardcoursemst_pk = appcdt_standardcoursemst_fk')
            ->leftJoin('standardcoursedtls_tbl','scd_standardcoursemst_fk = standardcoursemst_pk')
            ->leftJoin('appcoursetrnstmp_tbl','appctt_appcoursedtlstmp_fk = appcoursedtlstmp_pk')
            ->leftJoin('coursecategorymst_tbl AS coursesubcategory','appctt_coursecategorymst_fk = coursesubcategory.coursecategorymst_pk')
          // ->leftJoin('appcoursedtlsmain_tbl','appcdm_standardcoursemst_fk = coursecategorymst_tbl.ccm_coursecategorymst_pk')
           ->leftJoin('appauditschedtmp_tbl','appasdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
           ->leftJoin('auditscheddtls_tbl','auditscheddtls_pk = appasdt_auditscheddtls_fk')
           ->Where("appdt_projectmst_fk in (".$project_pk .")  and appdt_status != 1   and ((appcdt_appoffercoursemain_fk is not null and appcdt_standardcoursemst_fk is null) or (appcdt_appoffercoursemain_fk is null and appcdt_standardcoursemst_fk is not null".$standardcourse."))");
        //    if(!empty($standardcourse)){
        //       $query->andwhere("standardcoursemst_pk in (".$standardcourse.")");
        //    }
            if(!empty($desktopfilter)){
                $query->andwhere("appdt_status in( ".$desktopfilter.")");
                }
             if(!empty($searchkey['appl_form'])){
                $query->andwhere("appdt_appreferno like '%".$searchkey['appl_form']."%'");
                }
            if(!empty($searchkey['trainingprovider'])){
                $query->andwhere("omrm_tpname_en like '%".$searchkey['trainingprovider']."%'");
                }
            if(!empty($searchkey['officetype'])){
                $query->andwhere("appiim_officetype in( ".implode(",",$searchkey['officetype']).")");
                }
            if(!empty($searchkey['branch'])){
                $query->andwhere("appiim_branchname_en like '%".$searchkey['branch']."%'");
                }
            if(!empty($searchkey['cour_type'])){
                $query->andwhere("appdt_projectmst_fk in( ".implode(",",$searchkey['cour_type']).")");
                }
            if(!empty($searchkey['course_title'])){
                $query->andwhere("scm_coursename_en  like '%".$searchkey['course_title']."%'");
                $query->orwhere("appocm_coursename_en  like '%".$searchkey['course_title']."%'");
                }
            if(!empty($searchkey['course_cat'])){
                $query->andwhere("category.ccm_catname_en  like '%".$searchkey['course_cat']."%'");
                }
            if(!empty($searchkey['cour_subcate'])){
                $query->andwhere("coursesubcategory.ccm_catname_en  like '%".$searchkey['cour_subcate']."%'");
                }
            if(!empty($searchkey['appl_type'])){
                $query->andwhere("appdt_apptype in( ".implode(",",$searchkey['appl_type']).")");
                }
            if(!empty($searchkey['appdt_status'])){
                $query->andwhere("appdt_status in( ".implode(",",$searchkey['appdt_status']).")");
                }
            // if(!empty($searchkey['cert_status'])){
            //     if($searchkey['cert_status'] == 1){
            //         $query->andwhere("appdt_certificateexpiry is null");
            //     }else if($searchkey['cert_status'] == 2){
            //         $query->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry > CURDATE()");
            //     }else if($searchkey['cert_status'] == 3){
            //         $query->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry < CURDATE()");
            //     }
            // } 
            if(!empty($searchkey['cert_status'])){ // certificate  Filter
                $appcond ="";
                if(in_array(2, $searchkey['cert_status'])){ //approved
                $appcond .= "(appdt_certificategenon is not null  and appdt_certificateexpiry > '$today') ||";
                }
                if(in_array(1, $searchkey['cert_status'])){ //yrt to certify
                $appcond .= "appdt_certificategenon is  null||";
                }
                if(in_array(3, $searchkey['cert_status'])){ //Expired
                    $appcond .= "(appdt_certificategenon is not null   and appdt_certificateexpiry < '$today' ) ||";
                 }
                $paymentstscond = rtrim($appcond, "||");
                $query->andWhere($paymentstscond);
                }  
            if(!empty($searchkey['site_audit_filter']['startDate'])){
                $query->andwhere("asd_date  between '".date("Y-m-d", strtotime($searchkey['site_audit_filter']['startDate']. "+1 day"))."' and '".date("Y-m-d", strtotime($searchkey['site_audit_filter']['endDate']. "+1 day"))."'");
             }
             if(!empty($searchkey['date_expiry_filter']['startDate'])){
                $query->andwhere("appdt_certificateexpiry  between '".date("Y-m-d", strtotime($searchkey['date_expiry_filter']['startDate']. "+1 day"))."' and '".date("Y-m-d", strtotime($searchkey['date_expiry_filter']['endDate']. "+1 day"))."'");
             }
             if(!empty($searchkey['addedon_branch_filter']['startDate'])){
                $query->andwhere("appdt_submittedon  between '".date("Y-m-d", strtotime($searchkey['addedon_branch_filter']['startDate']. "+1 day"))."' and '".date("Y-m-d", strtotime($searchkey['addedon_branch_filter']['endDate']. "+1 day"))."'");
             }
             if(!empty($searchkey['lastUpdated_branch_filter']['startDate'])){
                $query->andwhere("appdt_updatedon  between '".date("Y-m-d", strtotime($searchkey['lastUpdated_branch_filter']['startDate']. "+1 day"))."' and '".date("Y-m-d", strtotime($searchkey['lastUpdated_branch_filter']['endDate']. "+1 day"))."'");
             }
            $query->groupBy('appdt_appreferno');
            $query->orderBy(['ifnull(appdt_updatedon,appdt_submittedon)'=>SORT_DESC]);
            $fiterArray = [
                'applictionno'=> 'applicationdtlstmp_pk',
                'trainprovname'=> 'omrm_tpname_en',
                'offictype'=> 'appiim_officetype',
                'branchname'=> 'appiim_branchname_en',
                'sitelocan'=> 'appiim_loclatitude',
                'coursetype'=> 'appdt_projectmst_fk',
                'coursetitle'=> 'appocm_coursename_en',
                'coursecate'=> 'category.ccm_catname_en',
                'coursesubcate'=> 'coursesubcategory.ccm_catname_en',
                'applytype'=> 'appdt_apptype',
                'applicationstatus'=> 'appdt_status',
                'certification'=> 'appdt_certificateexpiry',
                'siteaudit'=> 'asd_date',
                'dateofexpiry'=> 'appdt_certificateexpiry',
                'addedon'=> 'appdt_submittedon',
                'lastUpdated'=> 'appdt_updatedon',
               
            ];
            $sort_column = isset($fiterArray[$order])?$fiterArray[$order]:$order;
            if($sort_column){
                $order_by = ($sort=='asc')? 'asc': 'desc';
                $sort = "ORDER BY $sort_column $order_by";
            }
            if($order){
                $query->orderBy("$sort_column $order_by");
            }
           
            $query->asArray();
            $raw = $query->createCommand()->getRawSql();
        
            $dataProvider = new ActiveDataProvider([
                'query' =>   $query,
                'pagination' => [
                                    'pageSize' => $limit,
                                    'page'=>$page
                                ]
                    ]);
            $data =  $dataProvider->getModels();
            $total = $dataProvider->getTotalCount();
            foreach($data as $key => $value){
                $arr[$key]['applictionno'] = $value['applictionno'];   
                $arr[$key]['omrm_tpname_en'] = $value['omrm_tpname_en'];   
                $arr[$key]['offictype'] = $value['offictype'];   
                $arr[$key]['branchname'] = $value['branchname'];   
                $arr[$key]['sitelocan'] = $value['sitelocan'];   
                $arr[$key]['appiim_loclongitude'] = $value['appiim_loclongitude'];   
                $arr[$key]['coursetype'] = $value['coursetype'];   
                $arr[$key]['coursetitle'] = $value['coursetitle'];   
                $arr[$key]['coursecate'] = $value['coursecate'];   
                $arr[$key]['coursesubcate'] = $value['coursesubcate'];   
                $arr[$key]['applytype'] = $value['applytype'];   
                $arr[$key]['applicationstatus'] = $value['applicationstatus'];  
                $arr[$key]['applicationdtlstmp_pk'] = $value['applicationdtlstmp_pk'];
                $arr[$key]['appdt_certificatepath'] = $value['appdt_certificatepath'];  
                $arr[$key]['appdm_issuspended'] = empty($value['appdm_issuspended'])?2:$value['appdm_issuspended'];  
                $date = $value['appdt_certificateexpiry'];
               if($date == '' || $date == null)
               {
                $arr[$key]['dateofexpiry'] = '1';  

               }
               else if($date <= $today){
                $arr[$key]['dateofexpiry'] = '3'; 

               }
               else if($date > $today)

               {
                $arr[$key]['dateofexpiry'] = '2'; 


               }
                // if($date)
                $arr[$key]['asd_date'] = $value['asd_date'];  
                $arr[$key]['appdt_certificateexpiry'] = $value['appdt_certificateexpiry'];   
                $arr[$key]['appdt_submittedon'] = $value['appdt_submittedon'];   
                $arr[$key]['appdt_submittedon'] = $value['appdt_submittedon'];   
                $arr[$key]['appdt_updatedon'] = $value['appdt_updatedon'];   
                $arr[$key]['omrm_companyname_en'] = $value['omrm_companyname_en'];   
                $arr[$key]['omrm_companyname_ar'] = $value['omrm_companyname_ar'];   
                
                //check update flow

                $staffdata = AppstaffinfotmpTbl::find()
                ->select(['appsit_iscarddetails'])
                ->where(['appsit_applicationdtlstmp_fk' => $value['applicationdtlstmp_pk']])
                ->asArray()
                ->all();
                foreach($staffdata as $staffvalue){
                $staffcardarray[] = $staffvalue['appsit_iscarddetails'];
                }
                if(in_array(1,$staffcardarray)){
                    $carddetails = 1;
                }else{
                    $carddetails = 2;
                }
                $arr[$key]['appsit_iscarddetails'] = $carddetails;   
                $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' =>$value['applicationdtlstmp_pk']])->orderBy('appapprovalhdr_pk desc')->one();
                $arr[$key]['applictonmovtype'] = $updatemodel->aah_formstatus; 


            }


    return ['arr'=>$arr,'limit'=>$limit,'totalcount'=>$total];

    }

    public static function saveAppCenterDtls($requestdata){
        //echo '<pre>';print_r($requestdata);exit;
        $model = new ApplicationdtlstmpTbl();
        $model->appdt_opalmemberregmst_fk = $requestdata['acdt_opalmemberregmst_fk'];
        $model->appdt_projectmst_fk = $requestdata['appdt_projectmst_fk'];
        $model->appdt_appreferno = 1;
        $model->appdt_apptype = 1;
        //$model->appdt_appupdated=1;
        $model->appdt_status = 1;
        
        if($model->save()){
            $modelComp = new AppcompanydtlstmpTbl();
            $modelComp->acdt_applicationdtlstmp_fk = $model->applicationdtlstmp_pk;
            $modelComp->acdt_opalmemberregmst_fk = $requestdata['acdt_opalmemberregmst_fk'];
            $modelComp->acdt_opalusermst_fk = $requestdata['acdt_opalusermst_fk'];
            $modelComp->acdt_gmname = $requestdata['gm_name'];
            $modelComp->acdt_gmemailid = $requestdata['gm_emailid'];
            $modelComp->acdt_gmmobileno = $requestdata['gm_mobnum'];
            $modelComp->acdt_gmmoherigrading = $requestdata['moheri_grade'];
            $modelComp->acdt_addrline1 = $requestdata['address1'];
            $modelComp->acdt_addrline2 = $requestdata['address2'];
            $modelComp->acdt_statemst_fk = $requestdata['governorate'];
            $modelComp->acdt_citymst_fk = $requestdata['wilayat'];
            $modelComp->acdt_createdon = date("Y-m-d H:i:s");
            $modelComp->acdt_createdby = $requestdata['acdt_createdby'];
            $modelComp->acdt_status = 1;
            if($modelComp->save()){
                //ref no update starts
                $no = ApplicationdtlstmpTbl::genRefNo($requestdata['acdt_opalmemberregmst_fk'],$model->applicationdtlstmp_pk);
                $appModel = ApplicationdtlstmpTbl::find()->where(['applicationdtlstmp_pk' => $model->applicationdtlstmp_pk])->one();
                $appModel->appdt_appreferno = $no;
                if($appModel->save()){
                }else{
                    echo "<pre>";return $modelComp->getErrors();exit;
                }
                //ref no update ends
                return $model->applicationdtlstmp_pk;
                
            }else{
                echo "<pre>";
                return $modelComp->getErrors();
                exit;
            }

            
        } else {
            echo "<pre>";
            return $model->getErrors();
            exit;
        }  
    }

    public static function genRefNo($memRegPk,$appPk){

        $memReg = OpalmemberregmstTbl::find()->where(['opalmemberregmst_pk' => $memRegPk])->one();
        
        $memRegPk = $memReg->omrm_opalmembershipregnumber;
        $apPk = strlen($appPk);
        $memPk = strlen($memRegPk);
        $appNo="";
        $memNo="";

        if($apPk == 1){
            $appNo="00".$appPk;
        }elseif($apPk == 2){
            $appNo="0".$appPk;
        }else{
            $appNo=$appPk;
        }

        if($memPk == 1){
            $memNo="00".$memRegPk;
        }elseif($memPk == 2){
            $memNo="0".$memRegPk;
        }else{
            $memNo=$memRegPk;
        }

        return "TECC-".$memNo."-".$appNo;

    }
    public static function genRefNoras($memRegPk,$appPk){

        $memReg = OpalmemberregmstTbl::find()->where(['opalmemberregmst_pk' => $memRegPk])->one();
        
        $memRegPk = $memReg->omrm_opalmembershipregnumber;
        $apPk = strlen($appPk);
        $memPk = strlen($memRegPk);
        $appNo="";
        $memNo="";

        if($apPk == 1){
            $appNo="00".$appPk;
        }elseif($apPk == 2){
            $appNo="0".$appPk;
        }else{
            $appNo=$appPk;
        }

        if($memPk == 1){
            $memNo="00".$memRegPk;
        }elseif($memPk == 2){
            $memNo="0".$memRegPk;
        }else{
            $memNo=$memRegPk;
        }

        return "RASCC-".$memNo."-".$appNo;

    }
    public static function genRefNoivms($memRegPk,$appPk){

        $memReg = OpalmemberregmstTbl::find()->where(['opalmemberregmst_pk' => $memRegPk])->one();
        
        $memRegPk = $memReg->omrm_opalmembershipregnumber;
        $apPk = strlen($appPk);
        $memPk = strlen($memRegPk);
        $appNo="";
        $memNo="";

        if($apPk == 1){
            $appNo="00".$appPk;
        }elseif($apPk == 2){
            $appNo="0".$appPk;
        }else{
            $appNo=$appPk;
        }

        if($memPk == 1){
            $memNo="00".$memRegPk;
        }elseif($memPk == 2){
            $memNo="0".$memRegPk;
        }else{
            $memNo=$memRegPk;
        }

        return "IVMS-".$memNo."-".$appNo;

    }
    public static function genRefNocourse($memRegPk,$appPk,$projpk){

        $memReg = OpalmemberregmstTbl::find()->where(['opalmemberregmst_pk' => $memRegPk])->one();
        
        $memRegPk = $memReg->omrm_opalmembershipregnumber;
        $apPk = strlen($appPk);
        $memPk = strlen($memRegPk);
        $appNo="";
        $memNo="";

        if($apPk == 1){
            $appNo="00".$appPk;
        }elseif($apPk == 2){
            $appNo="0".$appPk;
        }else{
            $appNo=$appPk;
        }

        if($memPk == 1){
            $memNo="00".$memRegPk;
        }elseif($memPk == 2){
            $memNo="0".$memRegPk;
        }else{
            $memNo=$memRegPk;
        }
       
            return "SCCC-".$memNo."-".$appNo;
      

    }

    public static function savecousre($requestdata){
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        $model = new ApplicationdtlstmpTbl();
        $model->appdt_opalmemberregmst_fk =  $regPk;
        $model->appdt_projectmst_fk = $requestdata['value']; 
        // $model->appdt_appreferno = rand(4,4);
        $model->appdt_apptype = 1;
        // $model->appdt_appupdated=1;
        $model->appdt_status = 1;
        $model->appdt_submittedon =  date("Y-m-d H:i:s");
        $model->appdt_submittedby = $userPk;
        
        if($model->save()){
            $no = ApplicationdtlstmpTbl::genRefNocourse($regPk,$model->applicationdtlstmp_pk,$model->appdt_projectmst_fk);
            $appModel = ApplicationdtlstmpTbl::find()->where(['applicationdtlstmp_pk' => $model->applicationdtlstmp_pk])->one();
            $appModel->appdt_appreferno = $no;
            if($appModel->save()){
            }else{
               return $appModel->getErrors();exit;
            }
            return $model->applicationdtlstmp_pk;

        } else {
            return $model->getErrors();
            exit;
        }  
    }
    public static function getAppDtls() {

        $model = ApplicationdtlstmpTbl::find()
                ->select(['*',               
                'DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") AS created_on',
                'DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") AS updated_on'])
                ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
                ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appdt_opalmemberregmst_fk')
                ->where("appdt_status =2 OR appdt_status =4")
                ->asArray()
                ->all();
                
        if($model){
             return $model; 
        } else{
             return false;
        }
         
    }


        public static function getappoveral($data) {

        $status = $data['formdata']['select_valitate']; 
        $appDtlsPk = Security::decrypt($data['formdata']['appdtlstmp_id']);
        $modelComp   = AppcompanydtlstmpTbl::find()->select(['acdt_status'])->where(['acdt_applicationdtlstmp_fk' => $appDtlsPk])->one();
        $model['acdt_status'] = $modelComp['acdt_status'];
        $modelIns   =  AppinstinfotmpTbl::find()->select(['appiit_status'])->where(['appiit_applicationdtlstmp_fk' => $appDtlsPk])->one();
        $model['appiit_status'] = $modelIns['appiit_status'];
        $modelCont   =  AppoprcontracttmpTbl::find()->select(['appoprct_status'])->where(['appoprct_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all(); 
         
        foreach($modelCont as $key => $status){
           $contractarray[] = $status['appoprct_status'];

        }
    
        if(in_array('3' , $contractarray)){
            $model['appoprct_status'] = 3; 
        }if(in_array('4' , $contractarray)){
        $model['appoprct_status'] = 4;

       }else if(in_array('1' , $contractarray)){
     
        $model['appoprct_status'] = 1; 
       }else if(in_array('2' , $contractarray)){
        $model['appoprct_status'] = 2; 
       }

       $modelInt   =  AppintrecogtmpTbl::find()->select(['appintit_status'])->where(['appintit_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all();   
       foreach($modelInt as $key => $status){
        $interarray[] = $status['appintit_status'];

        }
 
        if(in_array('3' , $interarray)){
        $model['appintit_status'] = 3; 
        }if(in_array('4' , $interarray)){
        $model['appintit_status'] = 4;

        }else if(in_array('1' , $interarray)){

        $model['appintit_status'] = 1; 
        }else if(in_array('2' , $interarray)){
        $model['appintit_status'] = 2; 
        }

        $docInt   =  AppdocsubmissiontmpTbl::find()->select(['appdst_status'])->where(['appdst_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all();   
        foreach($docInt as $key => $status){
         $docarray[] = $status['appdst_status'];
 
         }
  
         if(in_array('3' , $docarray)){
         $model['appdst_status'] = 3; 
         }if(in_array('4' , $docarray)){
         $model['appdst_status'] = 4;
 
         }else if(in_array('1' , $docarray)){
 
         $model['appdst_status'] = 1; 
         }else if(in_array('2' , $docarray)){
         $model['appdst_status'] = 2; 
         }

         $offerInt   =  AppoffercoursetmpTbl::find()->select(['appoct_status'])->where(['appoct_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all();   
        foreach($offerInt as $key => $status){
         $offerarray[] = $status['appoct_status'];
 
         }
  
         if(in_array('3' , $offerarray)){
         $model['appoct_status'] = 3; 
         }if(in_array('4' , $offerarray)){
         $model['appoct_status'] = 4;
 
         }else if(in_array('1' , $offerarray)){
 
         $model['appoct_status'] = 1; 
         }else if(in_array('2' , $offerarray)){
         $model['appoct_status'] = 2; 
         }

         $staffInt   =  AppstaffinfotmpTbl::find()->select(['appsit_status'])->where(['appsit_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all();   
          foreach($staffInt as $key => $status){
            $staffarray[] = $status['appsit_status'];
 
         }
  
         if(in_array('3' , $staffarray)){
         $model['appsit_status'] = 3; 
         }if(in_array('4' , $staffarray)){
         $model['appsit_status'] = 4;
 
         }else if(in_array('1' , $staffarray)){
 
         $model['appsit_status'] = 1; 
         }else if(in_array('2' , $staffarray)){
         $model['appsit_status'] = 2; 
         }
        return $model;

    }


    public static function updateAppCenterDtls($requestdata){
        //echo '<pre>';print_r($requestdata);exit;
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        $modelMem = OpalmemberregmstTbl::find()->where(['opalmemberregmst_pk' => $requestdata['acdt_opalmemberregmst_fk']])->one();
        $modelMem->omrm_address1 = $requestdata['address1'];
        $modelMem->omrm_address2 = $requestdata['address2'];
        $modelMem->omrm_opalstatemst_fk = $requestdata['governorate'];
        $modelMem->omrm_opalcitymst_fk = $requestdata['wilayat'];
        $modelMem->omrm_gmname=$requestdata['gm_name'];
        $modelMem->omrm_gmemailid=$requestdata['gm_emailid'];
        $modelMem->omrm_gmmobileno=$requestdata['gm_mobnum'];
        $modelMem->omrm_opalmoherigradingmst_pk=$requestdata['moheri_grade'] == 0 ?'':$requestdata['moheri_grade']; 
        $modelMem->omrm_crregistrationexpiry=date('Y-m-d',strtotime($requestdata['comp_cr_expiry']));
        $modelMem->omrm_companyname_ar=$requestdata['company_name_ar'];
        $modelMem->omrm_tpname_ar=$requestdata['tp_name_ar'];
        $modelMem->omrm_branch_ar=$requestdata['branch_name_ar'];
        $modelMem->omrm_branch_en=$requestdata['branch_name_en'];

        if(!empty($requestdata['upload'])){
            $modelMem->omrm_cmplogo=$requestdata['upload'][0];
        }
        if(!empty($requestdata['file_cractivity'])){
            $modelMem->omrm_cractivity=$requestdata['file_cractivity'][0];
        }
        if(!$modelMem->save()){
           
            return $modelMem->getErrors();exit;
        }
    
        // $model = new ApplicationdtlstmpTbl();
        // $model->appdt_opalmemberregmst_fk = $requestdata['acdt_opalmemberregmst_fk'];
        // $model->appdt_projectmst_fk = $requestdata['appdt_projectmst_fk'];
        // $model->appdt_appreferno = 1;
        // $model->appdt_apptype = 1;
        // $model->appdt_appupdated=1;
        // $model->appdt_status = 1;
        
        // if($model->save()){appdtlstmp_id
            //$modelComp = new AppcompanydtlstmpTbl();
            $resSts = ApplicationdtlstmpTbl::changeStatus($requestdata['appdtlstmp_id']);
            
            $modelComp = AppcompanydtlstmpTbl::find()->where(['acdt_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->one();
            
            if(empty($modelComp)){
                $modelComp = new AppcompanydtlstmpTbl();
                $modelComp->acdt_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
                $modelComp->acdt_opalmemberregmst_fk = $requestdata['acdt_opalmemberregmst_fk'];
                $modelComp->acdt_opalusermst_fk = $requestdata['acdt_opalusermst_fk'];
                $modelComp->acdt_gmname = $requestdata['gm_name'];
                $modelComp->acdt_gmemailid = $requestdata['gm_emailid'];
                $modelComp->acdt_gmmobileno = $requestdata['gm_mobnum'];
                $modelComp->acdt_gmmoherigrading = $requestdata['moheri_grade'];
                $modelComp->acdt_addrline1 = $requestdata['address1'];
                $modelComp->acdt_addrline2 = $requestdata['address2'];
                $modelComp->acdt_statemst_fk = $requestdata['governorate'];
                $modelComp->acdt_citymst_fk = $requestdata['wilayat'];
                $modelComp->acdt_createdon = date("Y-m-d H:i:s");
                $modelComp->acdt_createdby = $userPk;
                $modelComp->acdt_status = 1;
            }else{
            //$modelComp->acdt_opalmemberregmst_fk = $requestdata['acdt_opalmemberregmst_fk'];
            //$modelComp->acdt_opalusermst_fk = $requestdata['acdt_opalusermst_fk'];
            $modelComp->acdt_gmname = $requestdata['gm_name'];
            $modelComp->acdt_gmemailid = $requestdata['gm_emailid'];
            $modelComp->acdt_gmmobileno = $requestdata['gm_mobnum'];
            $modelComp->acdt_gmmoherigrading = $requestdata['moheri_grade'];
            $modelComp->acdt_addrline1 = $requestdata['address1'];
            $modelComp->acdt_addrline2 = $requestdata['address2'];
            $modelComp->acdt_statemst_fk = $requestdata['governorate'];
            $modelComp->acdt_citymst_fk = $requestdata['wilayat'];
            $modelComp->acdt_updatedon = date("Y-m-d H:i:s");
            $modelComp->acdt_updatedby = $userPk;
            if(!empty($resSts)){
                $modelComp->acdt_status = 2;
               // $modelComp->acdt_appdecComments = "";
            }
            
          }
            if($modelComp->save()){
                return $requestdata['appdtlstmp_id'];
            }else{
                echo "<pre>";
                return $modelComp->getErrors();
                exit;
            }

            
        // } else {
        //     echo "<pre>";
        //     return $model->getErrors();
        //     exit;
        // }  
    }

    public static function changeStatus($appDtlsPk){
        $model = AppcompanydtlstmpTbl::find()
                ->select(['acdt_status'])
                ->where("acdt_applicationdtlstmp_fk = $appDtlsPk")
                ->andWhere("acdt_status = 2 OR acdt_status = 3 OR acdt_status = 4")
                ->asArray()
                ->one();

        if(!empty($model)){
            return true;
        }else{
            return false;
        } 
    }


    public static function saveSubDesk($requestdata){
            //echo '<pre>';print_r($requestdata);exit;
            $sucStr = "";
            //table applicationdtlshsty_tbl starts
            $modelApp = ApplicationdtlstmpTbl::find()->where(['applicationdtlstmp_pk' => $requestdata['appdtlstmp_id']])->one();
            $modelApp->appdt_status = 2;
            $modelApp->appdt_submittedon = date("Y-m-d H:i:s");
            $modelApp->appdt_submittedby = $requestdata['user_pk'];
            if($modelApp->save()){
                $sucStr = "tap1t";
            }else{
                echo "<pre>";return $modelApp->getErrors();exit;
            }
            $modelAppHstry = new ApplicationdtlshstyTbl();
            $modelAppHstry->appdh_applicationdtlstmp_fk = $modelApp->applicationdtlstmp_pk;
            $modelAppHstry->appdh_opalmemberregmst_fk = $modelApp->appdt_opalmemberregmst_fk;
            $modelAppHstry->appdh_projectmst_fk = $modelApp->appdt_projectmst_fk;
            $modelAppHstry->appdh_apptype = $modelApp->appdt_apptype;
            $modelAppHstry->appdt_appupdated = $modelApp->appdt_appupdated;
            $modelAppHstry->appdh_status = $modelApp->appdt_status;
            $modelAppHstry->appdh_submittedon = date("Y-m-d H:i:s");
            $modelAppHstry->appdh_submittedby = $requestdata['user_pk'];
            if($modelAppHstry->save()){
                $sucStr .= "tap1h";
            }else{
                echo "<pre>";return $modelAppHstry->getErrors();exit;
            }
            //table applicationdtlshsty_tbl ends

            //table companydtlshsty_tbl starts
            $modelAppComp = AppcompanydtlstmpTbl::find()->where(['acdt_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->one();
            $modelAppComp->acdt_status = 2;
            if($modelAppComp->save()){
                $sucStr .= "tap2t";
            }else{
                echo "<pre>";return $modelAppComp->getErrors();exit;
            }
            //echo '<pre>';print_r($modelAppComp->appcompanydtlstmp_pk);exit;
            $modelAppCompHstry = new AppcompanydtlshstyTbl();
            //$modelAppCompHstry->acdh_applicationdtlstmp_fk = $modelAppComp->acdt_applicationdtlstmp_fk;
            $modelAppCompHstry->acdh_applicationdtlshsty_fk = $modelAppHstry->applicationdtlshsty_pk;
            $modelAppCompHstry->acdh_appcompanydtlstmp_fk = $modelAppComp->appcompanydtlstmp_pk;
            $modelAppCompHstry->acdh_opalmemberregmst_fk = $modelAppComp->acdt_opalmemberregmst_fk;
            $modelAppCompHstry->acdh_opalusermst_fk = $modelAppComp->acdt_opalusermst_fk;
            $modelAppCompHstry->acdh_gmname = $modelAppComp->acdt_gmname;
            $modelAppCompHstry->acdh_gmemailid = $modelAppComp->acdt_gmemailid;
            $modelAppCompHstry->acdh_gmmobileno = $modelAppComp->acdt_gmmobileno;
            $modelAppCompHstry->acdh_gmmoherigrading = $modelAppComp->acdt_gmmoherigrading;
            $modelAppCompHstry->acdh_addrline1 = $modelAppComp->acdt_addrline1;
            $modelAppCompHstry->acdh_addrline2 = $modelAppComp->acdt_addrline2;
            $modelAppCompHstry->acdh_statemst_fk = $modelAppComp->acdt_statemst_fk;
            $modelAppCompHstry->acdh_citymst_fk = $modelAppComp->acdt_citymst_fk;
            $modelAppCompHstry->acdh_status = $modelAppComp->acdt_status;
            $modelAppCompHstry->acdh_createdon = date("Y-m-d H:i:s");
            $modelAppCompHstry->acdh_createdby = $requestdata['user_pk'];
            if($modelAppCompHstry->save()){
                $sucStr .= "tap2h";
            }else{
                echo "<pre>";return $modelAppCompHstry->getErrors();exit;
            }
            //table companydtlshsty_tbl ends

            //table AppinstinfohstyTbl starts
            $modelAppIns = AppinstinfotmpTbl::find()->where(['appiit_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->one();
            $modelAppIns->appiit_status = 2;
            if($modelAppIns->save()){
                $sucStr .= "tap2t";
            }else{
                echo "<pre>";return $modelAppIns->getErrors();exit;
            }
            
            $modelAppInsHstry = new AppinstinfohstyTbl();
            $modelAppInsHstry->appiih_AppInstInfoTmp_FK = $modelAppIns->appinstinfotmp_pk;
            $modelAppInsHstry->appiih_OpalMemberRegMst_FK = $modelAppIns->appiit_opalmemberregmst_fk;
            $modelAppInsHstry->appiih_ApplicationDtlsHsty_FK = $modelAppHstry->applicationdtlshsty_pk;
            $modelAppInsHstry->appiih_OfficeType = $modelAppIns->appiit_officetype;
            $modelAppInsHstry->appiih_NoOfExpAt = $modelAppIns->appiit_noofexpat;
            $modelAppInsHstry->appiih_NoOfOmani = $modelAppIns->appiit_noofomani;
            $modelAppInsHstry->appiih_LocLatitude = $modelAppIns->appiit_loclatitude;
            $modelAppInsHstry->appiih_LocLongitude = $modelAppIns->appiit_loclongitude;
            $modelAppInsHstry->appiih_LocMapUrl = $modelAppIns->appiit_locmapurl;
            $modelAppInsHstry->appiih_MolPercent = $modelAppIns->appiit_molpercent;
            $modelAppInsHstry->appiih_NoOfTechStaff = $modelAppIns->appiit_nooftechstaff;
            $modelAppInsHstry->appiih_NoOfCurLearners = $modelAppIns->appiit_noofcurlearners;
            $modelAppInsHstry->appiih_MaxCapacity = $modelAppIns->appiit_maxcapacity;
            $modelAppInsHstry->appiih_Status = $modelAppIns->appiit_status;
            $modelAppInsHstry->appiih_CreatedOn = date("Y-m-d H:i:s");
            $modelAppInsHstry->appiih_CreatedBy = $requestdata['user_pk'];
            if($modelAppInsHstry->save()){
                $sucStr .= "tap2h";
            }else{
                echo "<pre>";return $modelAppInsHstry->getErrors();exit;
            }
            //table AppinstinfohstyTbl ends

            //table AppintrecoghstyTbl starts
            $modelAppIntRec = AppintrecogtmpTbl::find()->where(['appintit_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->all();
            
            foreach($modelAppIntRec as $modelAppIntRecDtls){
                $modelAppIntRecdt = AppintrecogtmpTbl::find()->where(['appintrecogtmp_pk' => $modelAppIntRecDtls->appintrecogtmp_pk])->one();
                $modelAppIntRecdt->appintit_status = 2;
                if($modelAppIntRecdt->save()){
                    $sucStr .= "tap3t";
                }else{
                    echo "<pre>";return $modelAppIntRecdt->getErrors();exit;
                }
                
                $modelAppIntRecHstry = new AppintrecoghstyTbl();
                $modelAppIntRecHstry->appintih_AppIntRecogTmp_FK = $modelAppIntRecdt->appintrecogtmp_pk;
                $modelAppIntRecHstry->appintih_OpalMemberRegMst_FK = $modelAppIntRecdt->appintit_opalmemberregmst_fk;
                $modelAppIntRecHstry->appintih_ApplicationDtlsHsty_FK = $modelAppHstry->applicationdtlshsty_pk;
                $modelAppIntRecHstry->appintih_IntnatRecogMst_FK = $modelAppIntRecdt->appintit_intnatrecogmst_fk;
                $modelAppIntRecHstry->appintih_LastAuditDate = $modelAppIntRecdt->appintit_lastauditdate;
                $modelAppIntRecHstry->appintih_Doc = $modelAppIntRecdt->appintit_doc;
                $modelAppIntRecHstry->appintih_Status = $modelAppIntRecdt->appintit_status;
                $modelAppIntRecHstry->appintih_CreatedOn = date("Y-m-d H:i:s");
                $modelAppIntRecHstry->appintih_CreatedBy = $requestdata['user_pk'];
                if($modelAppIntRecHstry->save()){
                    $sucStr .= "tap3h";
                }else{
                    echo "<pre>";return $modelAppIntRecHstry->getErrors();exit;
                }
            }
            
            //table AppintrecoghstyTbl ends

            //table AppintrecoghstyTbl starts
            $modelAppContr = AppoprcontracttmpTbl::find()->where(['appoprct_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->all();
            
            foreach($modelAppContr as $modelAppContrDtls){
                $modelAppContrdt = AppoprcontracttmpTbl::find()->where(['appoprcontracttmp_pk' => $modelAppContrDtls->appoprcontracttmp_pk])->one();
                $modelAppContrdt->appoprct_status = 2;
                if($modelAppContrdt->save()){
                    $sucStr .= "tap3t";
                }else{
                    echo "<pre>";return $modelAppContrdt->getErrors();exit;
                }
                
                $modelAppContrHstry = new AppoprcontracthstyTbl();
                $modelAppContrHstry->appoprch_Appoprcontracttmp_FK = $modelAppContrdt->appoprcontracttmp_pk;
                $modelAppContrHstry->appoprch_OpalMemberRegMst_FK = $modelAppContrdt->appoprct_opalmemberregmst_fk;
                $modelAppContrHstry->appoprch_ApplicationDtlsHsty_FK = $modelAppHstry->applicationdtlshsty_pk;
                $modelAppContrHstry->appoprch_OperatorName = $modelAppContrdt->appoprct_operatorname;
                $modelAppContrHstry->appoprch_ContType = $modelAppContrdt->appoprct_conttype;
                $modelAppContrHstry->appoprch_ContStartDate = $modelAppContrdt->appoprct_contstartdate;
                $modelAppContrHstry->appoprch_ContendDate = $modelAppContrdt->appoprct_contenddate;
                $modelAppContrHstry->appoprch_Status = $modelAppContrdt->appoprct_status;
                $modelAppContrHstry->appoprch_CreatedOn = date("Y-m-d H:i:s");
                $modelAppContrHstry->appoprch_CreatedBy = $requestdata['user_pk'];
                if($modelAppContrHstry->save()){
                    $sucStr .= "tap3h";
                }else{
                    echo "<pre>";return $modelAppContrHstry->getErrors();exit;
                }
            }
            
            //table AppintrecoghstyTbl ends

            //table appdocsubmissionhsty_tbl starts

            //table appdocsubmissionhsty_tbl ends

            //table AppintrecoghstyTbl starts
            $modelAppcour = AppoffercoursetmpTbl::find()->where(['appoct_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->all();
            
            foreach($modelAppcour as $modelAppcourDtls){
                $modelcourdt = AppoffercoursetmpTbl::find()->where(['appoffercoursetmp_pk' => $modelAppcourDtls->appoffercoursetmp_pk])->one();
                $modelcourdt->appoct_status = 2;
                if($modelcourdt->save()){
                    $sucStr .= "tap3t";
                }else{
                    echo "<pre>";return $modelcourdt->getErrors();exit;
                }
                
                $modelCourHstry = new AppoffercoursehstyTbl();
                $modelCourHstry->appoch_AppOfferCoursetmp_FK = $modelcourdt->appoffercoursetmp_pk;
                $modelCourHstry->appoch_OpalMemberRegMst_FK = $modelcourdt->appoct_opalmemberregmst_fk;
                $modelCourHstry->appoch_ApplicationDtlsHsty_FK = $modelAppHstry->applicationdtlshsty_pk;
                $modelCourHstry->appoch_CourseName_en = $modelcourdt->appoct_coursename_en;
                $modelCourHstry->appoch_CourseName_ar = $modelcourdt->appoct_coursename_ar;
                $modelCourHstry->appoch_courseDuration = $modelcourdt->appoct_courseduration;
                $modelCourHstry->appoch_FoundationProg = $modelcourdt->appoct_foundationprog;
                $modelCourHstry->appoch_CourseLevel = $modelcourdt->appoct_courselevel;
                $modelCourHstry->appoch_CourseCategoryMst_FK = $modelcourdt->appoct_coursecategorymst_fk;
                $modelCourHstry->appoch_CourseSubcategoryMst_FK = $modelcourdt->appoct_coursesubcategorymst_fk;
                $modelCourHstry->appoch_CourseTested = $modelcourdt->appoct_coursetested;
                $modelCourHstry->appoch_AppIntRecogTmp_FK = $modelcourdt->appoct_appintrecogtmp_fk;
                $modelCourHstry->appoch_status = $modelcourdt->appoct_status;
                $modelCourHstry->appoch_CreatedOn = date("Y-m-d H:i:s");
                $modelCourHstry->appoch_CreatedBy = $requestdata['user_pk'];
                if($modelCourHstry->save()){
                    $sucStr .= "tap3h";
                }else{
                    echo "<pre>";return $modelCourHstry->getErrors();exit;
                }

                $modelAppcourunt = AppoffercourseunittmpTbl::find()->where(['appocut_appoffercoursetmp_fk' => $modelcourdt->appoffercoursetmp_pk])->all();
                foreach($modelAppcourunt as $modelAppcouruntdtls){
                    $modelcouruntdt = AppoffercourseunittmpTbl::find()->where(['appoffercourseunittmp_pk' => $modelAppcouruntdtls->appoffercourseunittmp_pk])->one();
                    $modelcouruntdt->appocut_status = 2;
                    if($modelcouruntdt->save()){
                        $sucStr .= "tap3t";
                    }else{
                        echo "<pre>";return $modelcouruntdt->getErrors();exit;
                    }

                    $modelAppcouruntHstry = new AppoffercourseunithstyTbl();
                    $modelAppcouruntHstry->appocuh_AppOffercourseUnitTmp_FK = $modelcouruntdt->appoffercourseunittmp_pk;
                    //$modelAppcouruntHstry->appoch_OpalMemberRegMst_FK = $modelcouruntdt->appoct_opalmemberregmst_fk;
                    $modelAppcouruntHstry->appocuh_AppOfferCourseHsty_FK = $modelCourHstry->AppOfferCourseHsty_PK;
                    $modelAppcouruntHstry->appocuh_Unitcode = $modelcouruntdt->appocut_unitcode;
                    $modelAppcouruntHstry->appocuh_UnitTitle = $modelcouruntdt->appocut_unittitle;
                    $modelAppcouruntHstry->appocuh_Status = $modelcouruntdt->appocut_status;
                    $modelAppcouruntHstry->appocuh_CreatedOn = date("Y-m-d H:i:s");
                    $modelAppcouruntHstry->appocuh_CreatedBy = $requestdata['user_pk'];
                    if($modelAppcouruntHstry->save()){
                        $sucStr .= "tap3h";
                    }else{
                        echo "<pre>";return $modelAppcouruntHstry->getErrors();exit;
                    }

                }

            }
            
            //table AppintrecoghstyTbl ends

            //table appstaffinfohsty_tbl starts
            $modelstftmp = AppstaffinfotmpTbl::find()->where(['appsit_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->all();
            
            foreach($modelstftmp as $modelstftmpDtls){
                $modelstftmpdt = AppstaffinfotmpTbl::find()->where(['appostaffinfotmp_pk' => $modelstftmpDtls->appostaffinfotmp_pk])->one();
                $modelstftmpdt->appsit_status = 2;
                if($modelstftmpdt->save()){
                    $sucStr .= "tap3t";
                }else{
                    echo "<pre>";return $modelstftmpdt->getErrors();exit;
                }
                
                $modelstfHstry = new AppstaffinfohstyTbl();
                $modelstfHstry->appsih_AppoStaffInfotmp_FK = $modelstftmpdt->appostaffinfotmp_pk;
                $modelstfHstry->appsih_OpalMemberRegMst_FK = $modelstftmpdt->appsit_opalmemberregmst_fk;
                $modelstfHstry->appsih_ApplicationDtlsHsty_FK = $modelAppHstry->applicationdtlshsty_pk;
                $modelstfHstry->appsih_StaffInfoRepo_FK = $modelstftmpdt->appsit_staffinforepo_fk;
                $modelstfHstry->appsih_mainrole = $modelstftmpdt->appsit_mainrole;
                $modelstfHstry->appsih_jobtitle = $modelstftmpdt->appsit_jobtitle;
                $modelstfHstry->appsih_contracttype = $modelstftmpdt->appsit_contracttype;
                $modelstfHstry->appsih_roleforcourse = $modelstftmpdt->appsit_roleforcourse;
                $modelstfHstry->appsih_Status = $modelstftmpdt->appsit_status;
                $modelstfHstry->appsih_CreatedOn = date("Y-m-d H:i:s");
                $modelstfHstry->appsih_CreatedBy = $requestdata['user_pk'];
                if($modelstfHstry->save()){
                    $sucStr .= "tap3h";
                    return $modelAppHstry->applicationdtlshsty_pk;
                }else{
                    echo "<pre>";return $modelstfHstry->getErrors();exit;
                }

                
            }
            if(!empty($modelAppHstry->applicationdtlshsty_pk)){
                return $modelAppHstry->applicationdtlshsty_pk;
            }
            
            
            //table appstaffinfohsty_tbl ends

    }

    public static function saveSubDeskSub($requestdata){
        
        $sucStr = "";
        //table applicationdtlshsty_tbl starts
        $appTmpPk=$requestdata['appdtlstmp_id'];
        $renewalaction=$requestdata['renewalaction'];
        $modelAppTmp = ApplicationdtlstmpTbl::find()->select(['appdt_status'])
                        ->where("applicationdtlstmp_pk = $appTmpPk")
                        //->andWhere("appdt_status = 2 OR appdt_status = 3 OR appdt_status = 4")
                        ->asArray()
                        ->one();
        //echo '<pre>';print_r($modelAppTmp);exit;
        $proAprHdr=0;
        $proAprDtls=0;
        $proAprUser=1;
        $formStatus=0;
        $stsStr=0;
        if(!empty($modelAppTmp)){
           
            if($modelAppTmp['appdt_status'] == 1 && $renewalaction !=1 && $renewalaction != 2){
                $stsStr=2;
                $proAprHdr=1;
                $proAprDtls=1;
                $formStatus=1;
                $apptype = 1;
            }
            elseif($modelAppTmp['appdt_status'] == 3 && $renewalaction !=1 && $renewalaction != 2){
                $stsStr=4;
                $proAprHdr=1;
                $proAprDtls=1;
                $formStatus=1;
                $apptype = 1;
            }
            elseif($modelAppTmp['appdt_status'] == 1 && ($renewalaction !=1 && $renewalaction != 2 ) && ($renewalaction == 5 )){
               
                $stsStr=2;
                $proAprHdr=1;
                $proAprDtls=1;
                $formStatus=1;
                $apptype = 1;
            }
            elseif($modelAppTmp['appdt_status']== 3 && $renewalaction !=1 && $renewalaction != 2 && $renewalaction != 0){
               
                $stsStr=4;
                $proAprHdr=2;
                $proAprDtls=7;
                $formStatus=2;
                $apptype = 3;
            }
            //elseif($modelAppTmp['appdt_status'] >= 5){
            //     $stsStr=4;
            //     $proAprHdr=2;
            //     $proAprDtls=7;
            //     $formStatus=2;
            //     $apptype = 3;
            // }
            elseif($renewalaction == 1){
               
             // renewal
                if($modelAppTmp['appdt_status'] == 1  || $modelAppTmp['appdt_status']  == 17){
                      $stsStr=2;
                }if($modelAppTmp['appdt_status'] == 3){
                       $stsStr=4;
                }else{
                       $stsStr=2;
                }
                $proAprHdr=3;
                $proAprDtls=10;
                $formStatus=4;
                $apptype = 2;
            }elseif($renewalaction == 2){
                // update
                if($modelAppTmp['appdt_status'] == 1 ){
                    $stsStr=2;
                }else{
                    $stsStr=4;
                }          
                $proAprHdr=2;
                $proAprDtls=7;
                $formStatus=2;
                $apptype = 3;
   
            }else{
                $apptype =1;
            }

            
            
        }

        

        $modelApp = ApplicationdtlstmpTbl::find()->where(['applicationdtlstmp_pk' => $requestdata['appdtlstmp_id']])->one();
        $modelApp->appdt_status = $stsStr;
       
        $modelApp->appdt_apptype = $apptype;
        if($renewalaction == 1 || $renewalaction == 2){
            $modelApp->appdt_updatedon = date("Y-m-d H:i:s");
            $modelApp->appdt_updatedby = $requestdata['user_pk'];
        }else{
            $modelApp->appdt_submittedon = date("Y-m-d H:i:s");
            $modelApp->appdt_submittedby = $requestdata['user_pk'];
        }
        if($modelApp->save()){
            if($modelApp->appdt_projectmst_fk == 4){
                if( $modelApp->appdt_apptype == 3){
                    $staffdata = AppstaffinfotmpTbl::find()->select(['group_concat(appsit_status) as status','group_concat(appsit_iscarddetails) as cardstatus'])
                    ->where(['appsit_applicationdtlstmp_fk'=>$modelApp->applicationdtlstmp_pk])->asArray()->one();
                    $status =explode(',',$staffdata['status']);
                    $isstatus =explode(',',$staffdata['cardstatus']);
                    if(in_array(1,$status) || in_array(1,$isstatus)){
                        $formStatus = 3;
                        }else{
                            $formStatus = 2;
                        }
                }
                // echo $formStatus;exit;

            $info = SiteAudit::getApprovalHdrInfo($modelApp->appdt_projectmst_fk, $formStatus, 2);
            $appAprHdr = new AppapprovalhdrTbl;
            $appAprHdr->aah_projapprovalworkflowhrd_fk = $info['projapprovalworkflowhrd_pk'];;
            $appAprHdr->aah_projapprovalworkflowdtls_fk =  $info['projapprovalworkflowdtls_pk'];;
            $appAprHdr->aah_projapprovalworkflowuserdtls_fk = $info['projapprovalworkflowuserdtls_pk'];
            $appAprHdr->aah_applicationdtlstmp_fk = $modelApp->applicationdtlstmp_pk;
            $appAprHdr->aah_formstatus =  $formStatus;
            $appAprHdr->aah_status = null;
            if($formStatus == 4){
                $appsta = AppstaffinfotmpTbl::find()
                ->where(['appsit_applicationdtlstmp_fk' => $modelApp->applicationdtlstmp_pk])
                ->asArray()->all();
                if(!empty($appsta)){
                foreach($appsta as $app){
                    $appstaf = AppstaffinfotmpTbl::find()
                    ->where(['appostaffinfotmp_pk' => $app['appostaffinfotmp_pk']])
                    ->one();
                    $rascat =  $appstaf->appsit_apprasvehinspcattmp_fk;
                    if (!empty($rascat)) {
                        $courTstRes =   \app\models\ApprasvehinspcattmpTbl::find()  
                        ->select(['apprasvehinspcattmp_pk','rascategorymst_pk','rcm_coursesubcatname_ar','rcm_coursesubcatname_en','arvict_status','DATE_FORMAT(arvict_createdon,"%d-%m-%Y") as  inspectcreatedon','DATE_FORMAT(arvict_updatedon,"%d-%m-%Y") as  inspectlastupdate'])
                        ->leftJoin('rascategorymst_tbl','rascategorymst_pk = arvict_rascategorymst_fk')
                        ->where('apprasvehinspcattmp_pk in ('.$rascat.')')->asArray()->all();
                        if (!empty($courTstRes)) {
                            foreach ($courTstRes as $courTstVal) {
                                $rascatmst[] = $courTstVal['rascategorymst_pk'];
                            }
                        }
                    }
                    $comptcard = AppstaffinfotmpTbl::find()
                    ->select(["(case  when appsit_iscarddetails = 2 and staffcompetencycarddtls_pk is null then '1'
                    when appsit_iscarddetails = 1 then '4' 
                    when sccd_status =1 then '2'  when sccd_status =2 then '3'  end) as competcard"])
                    ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
                    ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');
                    $comptcard->andWhere(['appostaffinfotmp_pk'=>$appstaf->appostaffinfotmp_pk]);
                    $comptcard->andWhere('sccd_rascategorymst_fk in('.implode(",",$rascatmst).')');
                    $comptcard->orderBy(['staffcompetencycardhdr_pk' => SORT_DESC]);
                    $compt =  $comptcard->asArray()->one();
                    $comptancycard = empty($compt['competcard'])?'1':$compt['competcard'];
                    if($comptancycard == 3){
                        $appstaf->appsit_iscarddetails = 3;
                    }
                   
                    $appstaf->save();
        
                }
            }
            }
            }else{
            //store data appapprovalhdr tbl starts
            $appAprHdr = new AppapprovalhdrTbl();
            $appAprHdr->aah_projapprovalworkflowhrd_fk = $proAprHdr;
            $appAprHdr->aah_projapprovalworkflowdtls_fk = $proAprDtls; 
            $appAprHdr->aah_projapprovalworkflowuserdtls_fk = $proAprUser; 
            $appAprHdr->aah_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
            $appAprHdr->aah_formstatus = $formStatus;
            }
            // echo 1;exit;
            if($appAprHdr->save()){
                if($modelApp->appdt_projectmst_fk == 4){
                    \Yii::$app->db->createCommand("call sp_RAS_tmh_insertion(:p1,:p2,:p3)")
                    ->bindValue(':p1' , $appTmpPk)
                    ->bindValue(':p2' , '')
                    ->bindValue(':p3' , 4)
                    ->execute();

                }else{
            \Yii::$app->db->createCommand("call sp_opalformcourse_tmh_insertion(:p1,:p2,:p3)")
            ->bindValue(':p1' , $appTmpPk)
            ->bindValue(':p2' , '')
            ->bindValue(':p3' , 1)
            ->execute();
                }
            return $appAprHdr->appapprovalhdr_pk;

            }else{
              return $appAprHdr->getErrors();exit;
            }
            //store data appapprovalhdr tbl ends

            //return true;
        }else{
            echo "<pre>";return $modelApp->getErrors();exit;
        }
        
        
        
        //table applicationdtlshsty_tbl ends

        //table companydtlshsty_tbl starts
        // $modelAppComp = AppcompanydtlstmpTbl::find()->where(['acdt_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->one();
        // $modelAppComp->acdt_status = 2;
        // if($modelAppComp->save()){
        //     $sucStr .= "tap2t";
        // }else{
        //     echo "<pre>";return $modelAppComp->getErrors();exit;
        // }
        
        //table companydtlshsty_tbl ends

        //table AppinstinfohstyTbl starts
        // $modelAppIns = AppinstinfotmpTbl::find()->where(['appiit_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->one();
        // $modelAppIns->appiit_status = 2;
        // if($modelAppIns->save()){
        //     $sucStr .= "tap2t";
        // }else{
        //     echo "<pre>";return $modelAppIns->getErrors();exit;
        // }
        
        
        //table AppinstinfohstyTbl ends 

        //table AppintrecoghstyTbl starts
        // $modelAppIntRec = AppintrecogtmpTbl::find()->where(['appintit_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->all();
        
        // foreach($modelAppIntRec as $modelAppIntRecDtls){
        //     $modelAppIntRecdt = AppintrecogtmpTbl::find()->where(['appintrecogtmp_pk' => $modelAppIntRecDtls->appintrecogtmp_pk])->one();
        //     $modelAppIntRecdt->appintit_status = 2;
        //     if($modelAppIntRecdt->save()){
        //         $sucStr .= "tap3t";
        //     }else{
        //         echo "<pre>";return $modelAppIntRecdt->getErrors();exit;
        //     }  
        // }
        
        //table AppintrecoghstyTbl ends

        //table AppintrecoghstyTbl starts
        // $modelAppContr = AppoprcontracttmpTbl::find()->where(['appoprct_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->all();
        
        // foreach($modelAppContr as $modelAppContrDtls){
        //     $modelAppContrdt = AppoprcontracttmpTbl::find()->where(['appoprcontracttmp_pk' => $modelAppContrDtls->appoprcontracttmp_pk])->one();
        //     $modelAppContrdt->appoprct_status = 2;
        //     if($modelAppContrdt->save()){
        //         $sucStr .= "tap3t";
        //     }else{
        //         echo "<pre>";return $modelAppContrdt->getErrors();exit;
        //     }   
        // }
        
        //table AppintrecoghstyTbl ends

        //table appdocsubmissionhsty_tbl starts

        //table appdocsubmissionhsty_tbl ends

        //table AppintrecoghstyTbl starts
        // $modelAppcour = AppoffercoursetmpTbl::find()->where(['appoct_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->all();
        
        // foreach($modelAppcour as $modelAppcourDtls){
        //     $modelcourdt = AppoffercoursetmpTbl::find()->where(['appoffercoursetmp_pk' => $modelAppcourDtls->appoffercoursetmp_pk])->one();
        //     $modelcourdt->appoct_status = 2;
        //     if($modelcourdt->save()){
        //         $sucStr .= "tap3t";
        //     }else{
        //         echo "<pre>";return $modelcourdt->getErrors();exit;
        //     }
            
        //     $modelAppcourunt = AppoffercourseunittmpTbl::find()->where(['appocut_appoffercoursetmp_fk' => $modelcourdt->appoffercoursetmp_pk])->all();
        //     foreach($modelAppcourunt as $modelAppcouruntdtls){
        //         $modelcouruntdt = AppoffercourseunittmpTbl::find()->where(['appoffercourseunittmp_pk' => $modelAppcouruntdtls->appoffercourseunittmp_pk])->one();
        //         $modelcouruntdt->appocut_status = 2;
        //         if($modelcouruntdt->save()){
        //             $sucStr .= "tap3t";
        //         }else{
        //             echo "<pre>";return $modelcouruntdt->getErrors();exit;
        //         }
        //     }

        // }
        
        //table AppintrecoghstyTbl ends

        //table appstaffinfohsty_tbl starts
        // $modelstftmp = AppstaffinfotmpTbl::find()->where(['appsit_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->all();
        
        // foreach($modelstftmp as $modelstftmpDtls){
        //     $modelstftmpdt = AppstaffinfotmpTbl::find()->where(['appostaffinfotmp_pk' => $modelstftmpDtls->appostaffinfotmp_pk])->one();
        //     $modelstftmpdt->appsit_status = 2;
        //     if($modelstftmpdt->save()){
        //         $sucStr .= "tap3t";
        //     }else{
        //         echo "<pre>";return $modelstftmpdt->getErrors();exit;
        //     }
        // }
        // if(!empty($requestdata['appdtlstmp_id'])){
        //     return $requestdata['appdtlstmp_id'];
        // }
        
        
        //table appstaffinfohsty_tbl ends

}


public static function getDesktop(){
    $requestParam = $_GET;
    ini_set ( 'max_execution_time', 1200);
    $today = date("Y-m-d");
    $projectpk = $requestParam['projectpk'];


     $query = self::find();
     $query->select(['*',
     
     'DATE_FORMAT(asd_date,"%d-%m-%Y") AS asd_date','DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") AS appdt_submittedon',
     'DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") AS appdt_updatedon','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS appdt_certificateexpiry'])
     ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
      ->leftJoin('opalmemberregmst_tbl' ,'opalmemberregmst_pk = appdt_opalmemberregmst_fk')
      ->leftJoin('grademst_tbl' ,'grademst_pk = appdt_grademst_fk')
      ->leftJoin('appauditschedtmp_tbl' ,'appasdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
      ->leftJoin('auditscheddtls_tbl' ,'auditscheddtls_pk = appasdt_auditscheddtls_fk')
      //->where("appdt_status  in (2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20)") 
      ->where('appdt_status != 1')
     ->andWhere("appdt_projectmst_fk='$projectpk'");

    $sort = $requestParam['sort'];
    $order_by = $requestParam['order'];
    if($requestParam['gridsearchValues'] != ''){
        $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);  
        $refno = $gridsearchValues['appdt_appreferno'];
        $officetype = $gridsearchValues['appiit_officetype'];
        $companyname       = $gridsearchValues['omrm_companyname_en'];
        $centrename = $gridsearchValues['omrm_branch_en'];
        $tpname  = $gridsearchValues['omrm_tpname_en'];
        $apptype = $gridsearchValues['appdt_apptype'];
        $appstatus = $gridsearchValues['appdt_status'];
        $grade = $gridsearchValues['appdt_grademst_fk'];
        $appdt_certificateexpiry = $gridsearchValues['appdt_certificateexpiry'];
        $createdon = $gridsearchValues['appdt_submittedon'];
        $updatedon = $gridsearchValues['appdt_updatedon'];
        $cert_status = $gridsearchValues['cert_status'];
        $asddate = $gridsearchValues['asd_date'];
        $branchname = $gridsearchValues['appiit_branchname_en'];
    

    if($refno) //opertsor name filter
      {
        $query->andFilterWhere(['AND',
        ['LIKE', 'appdt_appreferno', $refno],
       ]);
     }           

    if($officetype){  // office  Filter
    if(count($officetype) >1){
    $appcond ="";
    if(in_array(1, $officetype)){ //yes
    $appcond .= "appiit_officetype='1' ||";
    }
    if(in_array(2, $officetype)){ //no
    $appcond .= "appiit_officetype='2' ||";
    }


    $paymentstscond = rtrim($appcond, "||");
    $query->andWhere($paymentstscond);
    }else{
    if(in_array($officetype[0], [1,2])){ 
    $pymt_sts = $officetype[0];
    $query->andWhere("appiit_officetype='$pymt_sts' ");
    }
    }
    }
   
    if($companyname) //Company Name filter
    {
        $query->andFilterWhere(['AND',
        ['LIKE', 'omrm_companyname_en', $companyname],
    ]);
    }

    if($centrename) //centre Name filter
    {
        $query->andFilterWhere(['AND',
        ['LIKE', 'omrm_branch_en', $centrename],
    ]);
    }

    if($branchname) //branch Name filter
    {
        $query->andFilterWhere(['AND',
        ['LIKE', 'appiit_branchname_en', $branchname],
    ]);
    }
    if($tpname) //tp Name filter
    {
        $query->andFilterWhere(['AND',
        ['LIKE', 'omrm_tpname_en', $tpname],
    ]);
    }

    if($apptype){  // application  Filter
        if(count($apptype) >1){
        $appcond ="";
        if(in_array(1, $apptype)){ //initial
        $appcond .= "appdt_apptype='1' ||";
        }
        if(in_array(2, $apptype)){ //update
        $appcond .= "appdt_apptype='2' ||";
        }
        if(in_array(3, $apptype)){ //renewal
            $appcond .= "appdt_apptype='3' ||";
         }
    
    
        $paymentstscond = rtrim($appcond, "||");
        $query->andWhere($paymentstscond);
        }else{
        if(in_array($apptype[0], [1,2,3])){ 
        $pymt_sts = $apptype[0];
        $query->andWhere("appdt_apptype='$pymt_sts' ");
        }
        }
        }

        // if($appstatus) //application status filter
        // {
        // $query->andFilterWhere(['AND',
        // ['LIKE', 'appdt_status', $appstatus],
        // ]);
        // }
        
        if($appstatus){  // application status filter
            if(in_array('10', $appstatus)){
                array_push($appstatus,"14");
             }
            if(count($appstatus) >1){
            $appcond ="";
            if(in_array(2, $appstatus)){ 
            $appcond .= "appdt_status='2' ||";
            $appcond .= "appdt_status='4' ||";
            }
            if(in_array(3, $appstatus)){ 
                $appcond .= "appdt_status='3' ||";
             }
             if(in_array(4, $appstatus)){ 
                $appcond .= "appdt_status='4' ||";
             }
             if(in_array(5, $appstatus)){ 
                $appcond .= "appdt_status='5' ||";
             }
             if(in_array(6, $appstatus)){ 
                $appcond .= "appdt_status='6' ||";
             }
             if(in_array(7, $appstatus)){ 
                $appcond .= "appdt_status='7' ||";
             }
             if(in_array(8, $appstatus)){
                $appcond .= "appdt_status='8' ||";
             }
             if(in_array(9, $appstatus)){ 
                $appcond .= "appdt_status='9' ||";
             }
             if(in_array(10, $appstatus)){
                $appcond .= "appdt_status='10' || ";
             }
     
             if(in_array(11, $appstatus)){
                $appcond .= "appdt_status='11' ||";
             }
             if(in_array(12, $appstatus)){
                $appcond .= "appdt_status='12' ||";
             }
             if(in_array(13, $appstatus)){
                $appcond .= "appdt_status='13' ||";
             }
             if(in_array(14, $appstatus)){
                $appcond .= "appdt_status='14' ||";
             }
             if(in_array(15, $appstatus)){
                $appcond .= "appdt_status='15' ||";
             }
             if(in_array(16, $appstatus)){
                $appcond .= "appdt_status='16' ||";
             }
             if(in_array(17, $appstatus)){
                $appcond .= "appdt_status='17' ||";
             }
             if(in_array(18, $appstatus)){
                $appcond .= "appdt_status='18' ||";
             }
             if(in_array(19, $appstatus)){
                $appcond .= "appdt_status='19' ||";
             }
             if(in_array(20, $appstatus)){
                $appcond .= "appdt_status='20' ||";
             }
        
        
        
            $paymentstscond = rtrim($appcond, "||");
            $query->andWhere($paymentstscond);
            }else{
           
            if(in_array($appstatus[0], [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20])){ 
            $pymt_sts = $appstatus[0];
            $query->andWhere("appdt_status='$pymt_sts' ");
            }
            }
            }

       if($grade){  // Grade  Filter
        if(count($grade) >1){
        $appcond ="";
        if(in_array(1, $grade)){ //bronze
        $appcond .= "appdt_grademst_fk='1' ||";
        }
        if(in_array(2, $grade)){ //silver
        $appcond .= "appdt_grademst_fk='2' ||";
        }
        if(in_array(3, $grade)){ //gold
            $appcond .= "appdt_grademst_fk='3' ||";
         }
    
    
        $paymentstscond = rtrim($appcond, "||");
        $query->andWhere($paymentstscond);
        }else{
        if(in_array($grade[0], [1,2,3])){ 
        $pymt_sts = $grade[0];
        $query->andWhere("appdt_grademst_fk='$pymt_sts' ");
        }
        }
        }


        if($cert_status){  // certificate  Filter
          
            $appcond ="";
            if(in_array(2, $cert_status)){ //approved
            $appcond .= "(appdt_certificategenon is not null  and appdt_certificateexpiry > '$today') ||";
            }
            if(in_array(1, $cert_status)){ //yrt to certify
            $appcond .= "appdt_certificategenon is  null||";
            }
            if(in_array(3, $cert_status)){ //Expired
                $appcond .= "(appdt_certificategenon is not null   and appdt_certificateexpiry < '$today' )||";
             }
            $paymentstscond = rtrim($appcond, "||");
            $query->andWhere($paymentstscond);
            }
    



        if($appdt_certificateexpiry && $appdt_certificateexpiry['startDate']!=null && $appdt_certificateexpiry['endDate']!=null)
        {
            $query->andFilterWhere(['between', 'date(appdt_certificateexpiry)', date('Y-m-d',strtotime($appdt_certificateexpiry['startDate'])), date('Y-m-d',strtotime($appdt_certificateexpiry['endDate']))]);
        }
        if($createdon && $createdon['startDate']!=null && $createdon['endDate']!=null)
        {
            $query->andFilterWhere(['between', 'date(appdt_submittedon)', date('Y-m-d',strtotime($createdon['startDate'])), date('Y-m-d',strtotime($createdon['endDate']))]);
        }
    
    
    
         
        if($updatedon && $updatedon['startDate']!=null && $updatedon['endDate']!=null)
        {
            $query->andFilterWhere(['between', 'date(appdt_updatedon)', date('Y-m-d',strtotime($updatedon['startDate'])), date('Y-m-d',strtotime($updatedon['endDate']))]);
        }
        if($asddate && $asddate['startDate']!=null && $asddate['endDate']!=null)
        {
            $query->andFilterWhere(['between', 'date(asd_date)', date('Y-m-d',strtotime($asddate['startDate'])), date('Y-m-d',strtotime($asddate['endDate']))]);
        }

     //$sort_column = 'applicationdtlstmp_pk';
       
    // $query = $query->orderBy(['applicationdtlstmp_pk'=>'desc']);
    //$query->asArray();

    $sort_column = (strpos($sort,"-") !== false) ? explode("-",$sort)[1] : $sort;   
    
   // $query->orderBy("$sort_column $order_by");
   
    if($sort_column == 'appdt_updatedon' && $order_by == 'asc'){
         $query->orderBy(['DATE_FORMAT(appdt_updatedon,"%Y-%m-%d")'=>SORT_ASC]);
    }else if($sort_column == 'appdt_updatedon' && $order_by == 'desc'){
     //   $query->orderBy(['DATE_FORMAT(appdt_updatedon,"%Y-%m-%d")'=>SORT_DESC]);
       
        $query->orderBy(['ifnull(appdt_updatedon,appdt_submittedon)'=>SORT_DESC]);
   }else if($sort_column == 'appdt_submittedon' && $order_by == 'asc'){
        $query->orderBy(['DATE_FORMAT(appdt_submittedon,"%Y-%m-%d")'=>SORT_ASC]);
    }else if($sort_column == 'appdt_submittedon' && $order_by == 'desc'){
        $query->orderBy(['DATE_FORMAT(appdt_submittedon,"%Y-%m-%d")'=>SORT_DESC]);
    }else{
        $query->orderBy("$sort_column $order_by");
    }
    $query->asArray();
    $page = (!empty($requestParam['size']) && $requestParam['size'] != 'undefined') ? $requestParam['size'] : 10 ;  
    $provider = new \yii\data\ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => $page,
            'page' => $requestParam['page']
        ]
    ]);

       $raw = $query->createCommand()->getRawSql();
      // print_R( $raw );
  
          
    $data = $provider->getModels();
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    //$userPk = 146;
     $model = ProjapprovalworkflowuserdtlsTbl::find()
     ->select(['pawfd_rolemst_fk','pawfh_formstatus'])
     ->leftJoin('projapprovalworkflowdtls_tbl', 'projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')
     ->leftJoin('projapprovalworkflowhrd_tbl', 'projapprovalworkflowhrd_pk=pawfd_projapprovalworkflowhrd_fk')
     ->leftJoin('opalusermst_tbl', 'opalusermst_pk=pawfud_opalusermst_fk')
     ->where("pawfud_opalusermst_fk = $userPk")
     ->andWhere("projapprovalworkflowhrd_tbl.pawfh_status = 1")
     ->andWhere("pawfh_projectmst_fk = '$projectpk'")
     ->andWhere("FIND_IN_SET('$projectpk', oum_allocatedproject)")
    // ->andWhere("pawfh_formstatus = 1")
     ->asArray()
     ->all();

    
     $accessdesktop = false;
     $accesspayement = false;
     $accessauditor = false;
     $accessqualitymanager = false;
     $accessAuthority =false;
     $accessceo = false;
 

    $accessproject = OpalusermstTbl::find()
    ->select(['opalusermst_pk'])
    ->where("opalusermst_pk = '$userPk'")
    ->andWhere("FIND_IN_SET('$projectpk', oum_allocatedproject)")
    ->andWhere("oum_status = 'A'")
    ->asArray()
    ->one();


    $accesssuperadmin = OpalusermstTbl::find()
    ->select(['opalusermst_pk'])
    ->where("opalusermst_pk = '$userPk'")
    ->andWhere("oum_isfocalpoint = '1'")
    ->andWhere("oum_opalmemberregmst_fk = '1'")
    ->andWhere("oum_status = 'A'")
    ->asArray()
    ->one();

    if($projectpk == 1){
        $desktop =  \Yii::$app->params['project']['trainingcentre']['desktop_id'];
        $payment =  \Yii::$app->params['project']['trainingcentre']['payment_id'];
        $auditor =   \Yii::$app->params['project']['trainingcentre']['auditor_id'];
        $qualitymanager =  \Yii::$app->params['project']['trainingcentre']['qualitymanager_id'];
        $authority =   \Yii::$app->params['project']['trainingcentre']['authority_id'];
        $ceo =   \Yii::$app->params['project']['trainingcentre']['ceo_id'];

    }
    if($projectpk == 4){
        $desktop =  \Yii::$app->params['project']['technicalcentre']['desktop_id'];
        $payment =  \Yii::$app->params['project']['technicalcentre']['payment_id'];
        $auditor =   \Yii::$app->params['project']['technicalcentre']['auditor_id'];
        $qualitymanager =  \Yii::$app->params['project']['technicalcentre']['qualitymanager_id'];
        $authority =   \Yii::$app->params['project']['technicalcentre']['authority_id'];
        $ceo =   \Yii::$app->params['project']['technicalcentre']['ceo_id'];

    }
  


    foreach($model as $role){
        if($role['pawfd_rolemst_fk'] == $desktop  && $role['pawfh_formstatus'] == 1){
            $accessdesktop_i = true;
        
        }
        if($role['pawfd_rolemst_fk'] == $desktop  && $role['pawfh_formstatus'] == 2){
            $accessdesktop_u = true;
        
        }
        if($role['pawfd_rolemst_fk'] == $desktop  && $role['pawfh_formstatus'] == 3){
            $accessdesktop_up = true;
        
        }
        if($role['pawfd_rolemst_fk'] == $desktop  && $role['pawfh_formstatus'] == 4){
            $accessdesktop_r = true;
        
        }
            
       if($role['pawfd_rolemst_fk'] == $payment   && $role['pawfh_formstatus'] == 1){
        $accesspayement_i = true;
       }
             
       if($role['pawfd_rolemst_fk'] == $payment   && $role['pawfh_formstatus'] == 3){
        $accesspayement_up = true;
       }
             
       if($role['pawfd_rolemst_fk'] == $payment   && $role['pawfh_formstatus'] == 4){
        $accesspayement_r = true;
       }  

       if($role['pawfd_rolemst_fk'] == $auditor && $role['pawfh_formstatus'] == 1){
        $accessauditor_i = true;
       } 
       if($role['pawfd_rolemst_fk'] == $auditor  && $role['pawfh_formstatus'] == 2){
        $accessauditor_u = true;
       } 
       if($role['pawfd_rolemst_fk'] == $auditor  && $role['pawfh_formstatus'] == 3){
        $accessauditor_up = true;
       } 
       if($role['pawfd_rolemst_fk'] == $auditor && $role['pawfh_formstatus'] == 4){
        $accessauditor_r = true;
       } 

     
       if($role['pawfd_rolemst_fk'] == $qualitymanager  && $role['pawfh_formstatus'] == 1){
        $accessqualitymanager_i = true;
       }
       if($role['pawfd_rolemst_fk'] == $qualitymanager  && $role['pawfh_formstatus'] == 2){
        $accessqualitymanager_u = true;
       } 
       if($role['pawfd_rolemst_fk'] == $qualitymanager  && $role['pawfh_formstatus'] == 3){
        $accessqualitymanager_up = true;
       } 
       if($role['pawfd_rolemst_fk'] == $qualitymanager  && $role['pawfh_formstatus'] == 4){
        $accessqualitymanager_r = true;
       }  

       if($role['pawfd_rolemst_fk'] == $authority  && $role['pawfh_formstatus'] == 1){
        $accessAuthority_i = true;
       }
       if($role['pawfd_rolemst_fk'] == $authority   && $role['pawfh_formstatus'] == 2){
        $accessAuthority_u = true;
       }
       if($role['pawfd_rolemst_fk'] == $authority  && $role['pawfh_formstatus'] == 3){
        $accessAuthority_up = true;
       }
       if($role['pawfd_rolemst_fk'] == $authority   && $role['pawfh_formstatus'] == 4){
        $accessAuthority_r = true;
       }

       if($role['pawfd_rolemst_fk'] == $ceo  && $role['pawfh_formstatus'] == 1){
        $accessceo_i = true;
       }
       if($role['pawfd_rolemst_fk'] == $ceo  && $role['pawfh_formstatus'] == 2){
        $accessceo_u = true;
       }
       if($role['pawfd_rolemst_fk'] == $ceo   && $role['pawfh_formstatus'] == 3){
        $accessceo_up = true;
       }
       if($role['pawfd_rolemst_fk'] == $ceo   && $role['pawfh_formstatus'] == 4){
        $accessceo_r = true;
       } 
 

        
    }

    foreach ($provider->getModels() as $key => $favResData) {
        $favData[$key] = $favResData;
        $expireDate = $favResData['appdt_certificateexpiry'];
     
        // echo $expireDate;
        // echo $today;
        if (strtotime($today) > strtotime($expireDate)) {
        $expired = 1;
        } else {
        $expired = 0;
        }
        
        //if(strtotime($today) > strtotime($expireDate)) { $expired = 1; }
        $favData[$key]['isexpired'] = $expired;
        $favData[$key]['accessdesktop_i'] = $accessdesktop_i;
        $favData[$key]['accessdesktop_u'] = $accessdesktop_u;
        $favData[$key]['accessdesktop_up'] = $accessdesktop_up;
        $favData[$key]['accessdesktop_r'] = $accessdesktop_r;

        $favData[$key]['accesspayment_i'] = $accesspayement_i;
        $favData[$key]['accesspayment_up'] = $accesspayement_up;
        $favData[$key]['accesspayment_r'] = $accesspayement_r;

        $favData[$key]['accessauditor_i'] = $accessauditor_i;
        $favData[$key]['accessauditor_u'] = $accessauditor_u;
        $favData[$key]['accessauditor_up'] = $accessauditor_up;
        $favData[$key]['accessauditor_r'] = $accessauditor_r;

        $favData[$key]['accessAuthority_i'] = $accessAuthority_i;
        $favData[$key]['accessAuthority_u'] = $accessAuthority_u;
        $favData[$key]['accessAuthority_up'] = $accessAuthority_up;
        $favData[$key]['accessAuthority_r'] = $accessAuthority_r;

        $favData[$key]['accessqualitymanager_i'] = $accessqualitymanager_i;
        $favData[$key]['accessqualitymanager_u'] = $accessqualitymanager_u;
        $favData[$key]['accessqualitymanager_up'] = $accessqualitymanager_up;
        $favData[$key]['accessqualitymanager_r'] = $accessqualitymanager_r;

        $favData[$key]['accessceo_i'] = $accessceo_i;
        $favData[$key]['accessceo_u'] = $accessceo_u;
        $favData[$key]['accessceo_up'] = $accessceo_up;
        $favData[$key]['accessceo_r'] = $accessceo_r;

        $favData[$key]['accessadmin']    =     self::siteauditconfig();
        $favData[$key]['omrm_tpname_en'] =      (!empty($favResData['omrm_tpname_en'])?$favResData['omrm_tpname_en']:"-");
        $favData[$key]['omrm_branch_en'] =      (!empty($favResData['omrm_branch_en'])?$favResData['omrm_branch_en']:"-");
        $favData[$key]['appiit_branchname_en'] =      (!empty($favResData['appiit_branchname_en'])?$favResData['appiit_branchname_en']:"-");
        $favData[$key]['appdt_submittedon'] =     (!empty($favResData['appdt_submittedon'])?$favResData['appdt_submittedon']: "-");
        $favData[$key]['appdt_updatedon'] =       (!empty($favResData['appdt_updatedon'])?$favResData['appdt_updatedon']:"-");
        $favData[$key]['appdt_certificateexpiry'] =      (!empty($favResData['appdt_certificateexpiry'])?$favResData['appdt_certificateexpiry']:"-");  
        $favData[$key]['appdt_grademst_fk'] =      (!empty($favResData['appdt_grademst_fk'])?$favResData['appdt_grademst_fk']:"-");
        $approvalmodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' => $favResData['applicationdtlstmp_pk']])->orderBy('appapprovalhdr_pk desc')->one(); 
        $favData[$key]['formstatus'] = $approvalmodel['aah_formstatus']; 
        if($favResData['asd_opalusermst_fk'] == $userPk){
            $favData[$key]['siteauditstaff'] = true;
        }else{
            $favData[$key]['siteauditstaff'] = false;
        }
                
       }
       

    $response = array();
    $response['data'] = $favData;
   // $response['exportlink']  = \Yii::$app->urlManager->createAbsoluteUrl(['center/app-center/downloadlist']);
    $response['totalcount'] = $provider->getTotalCount();
    $response['accessauditor_i'] = $accessauditor_i;
    $response['accessqualitymanager_i'] = $accessqualitymanager_i;
    $response['accessAuthority_i'] = $accessAuthority_i;
    $response['accessceo_i']       = $accessceo_i;
    $response['accesssuperadmin'] = ($accesssuperadmin)?true:false;
    $response['accessadmin'] = self::siteauditconfig();
    if($accesssuperadmin){
        $response['accessproject'] = true;
    }else{
        $response['accessproject'] = ($accessproject)?true:false;
    }
   
    $response['size'] = $page;
    return $response;
}
}



    public function siteauditconfig(){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $opalusermst_tbl = OpalusermstTbl::find()
        ->select(['*'])
        ->where("opalusermst_pk = '$userPk'")
        ->andWhere("oum_isfocalpoint = '2'")
        ->andWhere("oum_opalmemberregmst_fk = '1'")
        ->asArray()
        ->one();
        // $rolearray = explode(",",$opalusermst_tbl['oum_rolemst_fk']);
        // if(in_array(1 ,$rolearray ) || in_array(3  ,$rolearray ) || in_array(5  ,$rolearray )){
        // $accesssiteaudit= true;
        // }
        $accessadmin = false;
        if(opalusermst_tbl){
            $accessadmin= true;
        }
        return $accessadmin;
    }

public function validbtnshoworhide()
{
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
$fianance_btn['fianance_btn'] = false;
    $model = ProjapprovalworkflowuserdtlsTbl::find()
    ->select(['pawfd_rolemst_fk'])
    ->leftJoin('projapprovalworkflowdtls_tbl', 'projapprovalworkflowdtls_pk=pawfud_projapprovalworkflowdtls_fk')
    ->where("pawfud_opalusermst_fk = $userPk")
    ->andWhere("pawfh_status = 1")
    ->asArray()
    ->all();

    foreach($model as $role){
        if($role['pawfd_rolemst_fk'] == 6){
            $fianance_btn = true;
        }
        else{
         $fianance_btn = false;

        }
       
         
     }
    return $fianance_btn;
}


public function getscfexportlist($gridsearchValues){
    $scflistdata = [];
    $today = date("Y-m-d");
    $projectpk = $gridsearchValues['projectpk'];
    if($projectpk == '1'){
        $query = \app\models\ApplicationdtlstmpTbl::find()
        ->select(['appdt_appreferno',"(CASE   WHEN appiit_officetype = 1  THEN 'Main Office'  WHEN appiit_officetype = '2' THEN 'Branch Ofice' END) as appiit_officetype",'omrm_companyname_en','omrm_branch_en','omrm_tpname_en',"(CASE   WHEN appdt_apptype = 1  THEN 'Initial'  WHEN appdt_apptype = '2' THEN 'Renewal'   WHEN appdt_apptype = '3' THEN 'Update'  END) as appdt_apptype",
        "(CASE  WHEN appdt_status = 2  THEN  'Desktop Review Pending' WHEN appdt_status = 3 THEN 'Missing Files' WHEN appdt_status = 4 THEN 'Desktop Review Pending'  WHEN appdt_status = 5 THEN 'Payment Pending'   WHEN appdt_status = 6 THEN 'Confirm Payment'   WHEN appdt_status = 7 THEN 'Awaiting for Site Audit Date'   WHEN appdt_status = 8 THEN 'Audit Date Selection(Training Provider)'  WHEN appdt_status = 9 THEN 'Ready for Audit' WHEN appdt_status = 10 THEN 'Quality Manager Approval Pending'  WHEN appdt_status = 11 THEN 'Authority  Approval Pending'  WHEN appdt_status = 12  THEN 'CEO Approval Pending'  WHEN appdt_status = 13 THEN 'Site Audit Report Declined'  WHEN appdt_status = 14  THEN 'Quality Manager Approval Pending'  WHEN appdt_status = 15 THEN 'Authority  Approval Pending' WHEN appdt_status = 16 THEN 'CEO Approval Pending'  WHEN appdt_status = 17 THEN 'Approved'   WHEN appdt_status = 18 THEN 'Declined by finance team'  WHEN appdt_status = 19 THEN 'Suspended' END) as appdt_status",
        "(CASE   WHEN appdt_grademst_fk = 1  THEN 'Bronze'  WHEN appdt_grademst_fk = '2' THEN 'Silver'   WHEN appdt_grademst_fk = '3' THEN 'Gold'  END) as appdt_grademst_fk"
        ,'appdt_certificategenon' ,'appdt_projectmst_fk',
        'DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") AS appdt_submittedon',
        'DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") AS appdt_updatedon','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS appdt_certificateexpiry'])
        ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->leftJoin('opalmemberregmst_tbl' ,'opalmemberregmst_pk = appdt_opalmemberregmst_fk')
        ->leftJoin('grademst_tbl' ,'grademst_pk = appdt_grademst_fk')
        ->leftJoin('appauditschedtmp_tbl' ,'appasdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->leftJoin('auditscheddtls_tbl' ,'auditscheddtls_pk = appasdt_auditscheddtls_fk')
         ->where('appdt_status != 1')
         ->andWhere("appdt_projectmst_fk='$projectpk'");
    }else{
        $query = \app\models\ApplicationdtlstmpTbl::find()
        ->select(['appdt_appreferno',"(CASE   WHEN appiit_officetype = 1  THEN 'Main Office'  WHEN appiit_officetype = '2' THEN 'Branch Ofice' END) as appiit_officetype",'omrm_companyname_en','omrm_branch_en','omrm_tpname_en',"(CASE   WHEN appdt_apptype = 1  THEN 'Initial'  WHEN appdt_apptype = '2' THEN 'Renewal'   WHEN appdt_apptype = '3' THEN 'Update'  END) as appdt_apptype",
        "(CASE  WHEN appdt_status = 2  THEN  'Desktop Review Pending' WHEN appdt_status = 3 THEN 'Missing Files' WHEN appdt_status = 4 THEN 'Desktop Review Pending'  WHEN appdt_status = 5 THEN 'Payment Pending'   WHEN appdt_status = 6 THEN 'Confirm Payment'   WHEN appdt_status = 7 THEN 'Awaiting for Site Audit Date'   WHEN appdt_status = 8 THEN 'Audit Date Selection(Inspection Centre)'  WHEN appdt_status = 9 THEN 'Ready for Audit' WHEN appdt_status = 10 THEN 'Quality Manager Approval Pending'  WHEN appdt_status = 11 THEN 'Authority  Approval Pending'  WHEN appdt_status = 12  THEN 'CEO Approval Pending'  WHEN appdt_status = 13 THEN 'Site Audit Report Declined'  WHEN appdt_status = 14  THEN 'Quality Manager Approval Pending'  WHEN appdt_status = 15 THEN 'Authority  Approval Pending' WHEN appdt_status = 16 THEN 'CEO Approval Pending'  WHEN appdt_status = 17 THEN 'Approved'   WHEN appdt_status = 18 THEN 'Declined by finance team'  WHEN appdt_status = 19 THEN 'Suspended' END) as appdt_status",
        "(CASE   WHEN appdt_grademst_fk = 1  THEN 'Bronze'  WHEN appdt_grademst_fk = '2' THEN 'Silver'   WHEN appdt_grademst_fk = '3' THEN 'Gold'  END) as appdt_grademst_fk"
        ,'appdt_certificategenon' ,'appdt_projectmst_fk',
        'DATE_FORMAT(appdt_submittedon,"%d-%m-%Y") AS appdt_submittedon',
        'DATE_FORMAT(appdt_updatedon,"%d-%m-%Y") AS appdt_updatedon','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS appdt_certificateexpiry'])
        ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->leftJoin('opalmemberregmst_tbl' ,'opalmemberregmst_pk = appdt_opalmemberregmst_fk')
        ->leftJoin('grademst_tbl' ,'grademst_pk = appdt_grademst_fk')
        ->leftJoin('appauditschedtmp_tbl' ,'appasdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->leftJoin('auditscheddtls_tbl' ,'auditscheddtls_pk = appasdt_auditscheddtls_fk')
         ->where('appdt_status != 1')
         ->andWhere("appdt_projectmst_fk='$projectpk'");



    }
   
     if($gridsearchValues != ''){
        // $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);  
         $refno = $gridsearchValues['appdt_appreferno'];
         $office= $gridsearchValues['appiit_officetype'];
         $companyname       = trim($gridsearchValues['omrm_companyname_en']);
         $branchname = $gridsearchValues['omrm_branch_en'];
         $tpname  = $gridsearchValues['omrm_tpname_en'];
         $apptype = $gridsearchValues['appdt_apptype'];
         $appstatus = $gridsearchValues['appdt_status'];
         $grade = $gridsearchValues['appdt_grademst_fk'];
         $appdt_certificateexpiry_start = $gridsearchValues['appdt_certificateexpiry_start'];
         $appdt_certificateexpiry_end = $gridsearchValues['appdt_certificateexpiry_end'];
         $createdon_start = $gridsearchValues['appdt_submittedon_start'];
         $createdon_end = $gridsearchValues['appdt_submittedon_end'];
         $updatedon_start = $gridsearchValues['appdt_updatedon_start'];
         $updatedon_end = $gridsearchValues['appdt_updatedon_end'];
         $cert_status = $gridsearchValues['cert_status'];
         $asddate_start = $gridsearchValues['asd_date_start'];
         $asddate_end = $gridsearchValues['asd_date_end'];
     if($refno && $refno != 'null') //opertsor name filter
       {
         $query->andFilterWhere(['AND',
         ['LIKE', 'appdt_appreferno', $refno],
        ]);
      }           
 
     if($office){  // office  Filter
       $officetype =    explode(",",$office);
     if(count($officetype) >1){
     $appcond ="";
     if(in_array(1, $officetype)){ //yes
     $appcond .= "appiit_officetype='1' ||";
     }
     if(in_array(2, $officetype)){ //no
     $appcond .= "appiit_officetype='2' ||";
     }
 
 
     $paymentstscond = rtrim($appcond, "||");
     $query->andWhere($paymentstscond);
     }else{
     if(in_array($officetype[0], [1,2])){ 
     $pymt_sts = $officetype[0];
     $query->andWhere("appiit_officetype='$pymt_sts' ");
     }
     }
     }
    
     if($companyname && $companyname != 'null') //Company Name filter
     {
         $query->andFilterWhere(['AND',
         ['LIKE', 'omrm_companyname_en', $companyname],
     ]);
     }
 
     if($branchname && $branchname != 'null') //branch Name filter
     {
         $query->andFilterWhere(['AND',
         ['LIKE', 'omrm_branch_en', $branchname],
     ]);
     }
     if($tpname && $tpname != 'null') //tp Name filter
     {
         $query->andFilterWhere(['AND',
         ['LIKE', 'omrm_tpname_en', $tpname],
     ]);
     }
 
     if($apptype){  // application  Filter
        $apptype = explode(",",$apptype);

         if(count($apptype) >1){
         $appcond ="";
         if(in_array(1, $apptype)){ //initial
         $appcond .= "appdt_apptype='1' ||";
         }
         if(in_array(2, $apptype)){ //update
         $appcond .= "appdt_apptype='2' ||";
         }
         if(in_array(3, $apptype)){ //renewal
             $appcond .= "appdt_apptype='3' ||";
          }
     
     
         $paymentstscond = rtrim($appcond, "||");
         $query->andWhere($paymentstscond);
         }else{
         if(in_array($apptype[0], [1,2,3])){ 
         $pymt_sts = $apptype[0];
         $query->andWhere("appdt_apptype='$pymt_sts' ");
         }
         }
         }
         if($appstatus){
             $appstatus = explode(",",$appstatus);
              // application status filter
             if(count($appstatus) >1){
             $appcond ="";
             if(in_array(2, $appstatus)){ 
             $appcond .= "appdt_status='2' ||";
             }
             if(in_array(3, $appstatus)){ 
                 $appcond .= "appdt_status='3' ||";
              }
              if(in_array(4, $appstatus)){ 
                 $appcond .= "appdt_status='4' ||";
              }
              if(in_array(5, $appstatus)){ 
                 $appcond .= "appdt_status='5' ||";
              }
              if(in_array(6, $appstatus)){ 
                 $appcond .= "appdt_status='6' ||";
              }
              if(in_array(7, $appstatus)){ 
                 $appcond .= "appdt_status='7' ||";
              }
              if(in_array(8, $appstatus)){
                 $appcond .= "appdt_status='8' ||";
              }
              if(in_array(9, $appstatus)){ 
                 $appcond .= "appdt_status='9' ||";
              }
              if(in_array(10, $appstatus)){
                 $appcond .= "appdt_status='10' ||";
              }
              if(in_array(11, $appstatus)){
                 $appcond .= "appdt_status='11' ||";
              }
              if(in_array(12, $appstatus)){
                 $appcond .= "appdt_status='12' ||";
              }
              if(in_array(13, $appstatus)){
                 $appcond .= "appdt_status='13' ||";
              }
              if(in_array(14, $appstatus)){
                 $appcond .= "appdt_status='14' ||";
              }
              if(in_array(15, $appstatus)){
                 $appcond .= "appdt_status='15' ||";
              }
              if(in_array(16, $appstatus)){
                 $appcond .= "appdt_status='16' ||";
              }
              if(in_array(17, $appstatus)){
                 $appcond .= "appdt_status='17' ||";
              }
              if(in_array(18, $appstatus)){
                 $appcond .= "appdt_status='18' ||";
              }
              if(in_array(19, $appstatus)){
                 $appcond .= "appdt_status='19' ||";
              }
         
             $paymentstscond = rtrim($appcond, "||");
             $query->andWhere($paymentstscond);
             }else{
             if(in_array($appstatus[0], [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19])){ 
             $pymt_sts = $appstatus[0];
             $query->andWhere("appdt_status='$pymt_sts' ");
             }
             }
             }
 
        if($grade){  // Grade  Filter
            $grade = explode(",",$grade);
         if(count($grade) >1){
         $appcond ="";
         if(in_array(1, $grade)){ //bronze
         $appcond .= "appdt_grademst_fk='1' ||";
         }
         if(in_array(2, $grade)){ //silver
         $appcond .= "appdt_grademst_fk='2' ||";
         }
         if(in_array(3, $grade)){ //gold
             $appcond .= "appdt_grademst_fk='3' ||";
          }
     
     
         $paymentstscond = rtrim($appcond, "||");
         $query->andWhere($paymentstscond);
         }else{
         if(in_array($grade[0], [1,2,3])){ 
         $pymt_sts = $grade[0];
         $query->andWhere("appdt_grademst_fk='$pymt_sts' ");
         }
         }
         }
 
 
         if($cert_status){  // certificate  Filter
          //  print_r($cert_status);
            $cert_status = explode(",",$cert_status);
             $appcond ="";
             if(in_array(2, $cert_status)){ //approved
             $appcond .= "(appdt_certificategenon is not null  and appdt_certificateexpiry > '$today') ||";
             }
             if(in_array(1, $cert_status)){ //yrt to certify
             $appcond .= "appdt_certificategenon is  null||";
             }
             if(in_array(3, $cert_status)){ //Expired
                 $appcond .= "(appdt_certificategenon is not null   and appdt_certificateexpiry < '$today' )||";
              }
             
             $paymentstscond = rtrim($appcond, "||");
             $query->andWhere($paymentstscond);
             }
     
 
 
 
         if(trim($appdt_certificateexpiry_start) && $appdt_certificateexpiry_end && trim($appdt_certificateexpiry_start) !=null && trim($appdt_certificateexpiry_end)!=null)
         {
      
             $query->andFilterWhere(['between', 'date(appdt_certificateexpiry)', date('Y-m-d',strtotime($appdt_certificateexpiry_start)), date('Y-m-d',strtotime($appdt_certificateexpiry_end))]);
         }
       
         if(trim($createdon_start) &&  trim($createdon_end) && trim($createdon_start)!=null && trim($createdon_end)!=null)
         {
             $query->andFilterWhere(['between', 'date(appdt_submittedon)', date('Y-m-d',strtotime($createdon_start)), date('Y-m-d',strtotime($createdon_end))]);
         }
     
         if(trim($updatedon_start) && trim($updatedon_end) && trim($updatedon_start) !=null && trim($updatedon_end)!=null)
         {
        
             $query->andFilterWhere(['between', 'date(appdt_updatedon)', date('Y-m-d',strtotime($updatedon_start)), date('Y-m-d',strtotime($updatedon_end))]);
         }

         if(trim($asddate_start) && trim($asddate_end) && trim($asddate_start) !=null && trim($asddate_end) !=null)
         {
             $query->andFilterWhere(['between', 'date(asd_date)', date('Y-m-d',strtotime($asddate_start)), date('Y-m-d',strtotime($asddate_end))]);
         }
     }
     $query->orderBy(['appdt_updatedon' => SORT_DESC])
     ->asArray()
     ->all();
     $raw = $query->createCommand()->queryAll();
     $raw1 = $query->createCommand()->getRawSql();
 
    $showhide = explode( ',' , $_GET['showCol']);
     if(!empty($raw)){
      foreach ($raw as $key => $value) {
        $sitevisitsts = $value['appdt_status'];
        $appdt_apptype = $value['appdt_apptype'];
            if(in_array('appdt_appreferno', $showhide)){
                $scflistdata[$key]['appdt_appreferno'] =    $value['appdt_appreferno'];
            }

            if(in_array('appiit_officetype', $showhide)){
               $scflistdata[$key]['appiit_officetype'] = $value['appiit_officetype'];
            }

            if(in_array('omrm_companyname_en', $showhide)){ 
              $scflistdata[$key]['omrm_companyname_en'] =  $value['omrm_companyname_en'];
            }
            if($value['appdt_projectmst_fk'] == 1){
            if(in_array('omrm_tpname_en', $showhide)){ 
                $scflistdata[$key]['omrm_tpname_en'] =      (!empty($value['omrm_tpname_en'])?$value['omrm_tpname_en']:"-");  
            }
           }
            if($value['appdt_projectmst_fk'] == 4){
                if(in_array('omrm_branch_en', $showhide)){ 
                $scflistdata[$key]['omrm_tpname_en'] =      (!empty($value['omrm_branch_en'])?$value['omrm_branch_en']:"-");
                }
            }
           if($value['appdt_projectmst_fk'] == 1){
           if(in_array('appiit_branchname_en', $showhide)){ 
            $scflistdata[$key]['appiit_branchname_en'] =      (!empty($value['appiit_branchname_en'])?$value['appiit_branchname_en']:"-");
           }
           }
           if(in_array('sitelocan', $showhide)){ 
            $scflistdata[$key]['appiit_loclatitude'] =       (!empty($value['appiit_locmapurl']))?$value['appiit_locmapurl']:'-';
           }
           if(in_array('appdt_apptype', $showhide)){ 
            $scflistdata[$key]['appdt_apptype'] =  $appdt_apptype;
           }
           if(in_array('appdt_status', $showhide)){ 
            $scflistdata[$key]['appdt_status'] =      $sitevisitsts;
           }
            $expireDate = $value['appdt_certificateexpiry'];
            if(!$expireDate){   //yet to certify
                 $certificatestatus = 'New';
             }
           else if($expireDate  &&  strtotime($expireDate) > strtotime($today)){ 
                    $certificatestatus = 'Active';
            }
            
           else if($expireDate &&  strtotime($today) > strtotime($expireDate)){   //Expired
                    $certificatestatus = 'Expired';
            }
            if(in_array('appdt_certificategenon', $showhide)){ 
            $scflistdata[$key]['appdt_certificategenon'] =     $certificatestatus;
            }

            if($value['appdt_projectmst_fk'] == 1){
                if(in_array('appdt_grademst_fk', $showhide)){ 
            $scflistdata[$key]['appdt_grademst_fk'] =   (!empty($value['appdt_grademst_fk'])?$value['appdt_grademst_fk']:"-");
            }
           }
            if(in_array('asd_date', $showhide)){ 
            $scflistdata[$key]['asd_date'] =       (!empty($value['asd_date'])?$value['asd_date']:"-");  
            }  
            if(in_array('appdt_certificateexpiry', $showhide)){ 
            $scflistdata[$key]['appdt_certificateexpiry'] =     (!empty($value['appdt_certificateexpiry'])?$value['appdt_certificateexpiry']: "-");
            }
            if(in_array('appdt_submittedon', $showhide)){ 
            $scflistdata[$key]['appdt_submittedon'] =     (!empty($value['appdt_submittedon'])?$value['appdt_submittedon']: "-");
            }
            if(in_array('appdt_updatedon', $showhide)){ 
            $scflistdata[$key]['appdt_updatedon'] =       (!empty($value['appdt_updatedon'])?$value['appdt_updatedon']:"-");    
            }          
      }
  }


  return $scflistdata;

}

public function getApplicationInfoByReg($regPk){
    $modelmain = ApplicationdtlstmpTbl::find()
        ->select(['applicationdtlstmp_pk','appdt_projectmst_fk','appdt_apptype','appdt_status'])
        ->where('appdt_opalmemberregmst_fk = '.$regPk)
        ->one();
    return $modelmain;
}



public static function getAppbranchDtls($ipArray) {      
       //echo "<pre>";print_r($ipArray);exit;
       //$userPk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
       $today = date("Y-m-d");
       $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
       $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
       $mem_reg=$ipArray['mem_reg'];
       $projecttype=$ipArray['projectype'];
       $provider="";
       if(!empty($mem_reg) && $mem_reg != 'undefined'){

        $model = ApplicationdtlstmpTbl::find()
                ->select(['*','DATE_FORMAT(appdt_certificateexpiry,"%d-%m-%Y") AS certificateexpiry',
                'DATE_FORMAT(appiit_createdon,"%d-%m-%Y") AS createdon',
                'DATE_FORMAT(appiit_updatedon,"%d-%m-%Y") AS updatedon'])
                ->leftJoin('appinstinfotmp_tbl insinfor','insinfor.appiit_applicationdtlstmp_fk = applicationdtlstmp_tbl.applicationdtlstmp_pk')
                ->leftJoin('applicationdtlsmain_tbl','appdm_applicationdtlstmp_fk = applicationdtlstmp_pk')
                ->where(["appdt_opalmemberregmst_fk" => $mem_reg,"appdt_projectmst_fk" => $projecttype]);
                if($projecttype == 1){
                    $model->andWhere(["appiit_officetype" => '2']);
                }
                if($projecttype == 4){
                    $model->andWhere('appdt_isprimarycert <> 1  or appdt_isprimarycert is null');
                }
                if($ipArray['gridsearchValues'] != ''){
                        $gridsearchValues = json_decode($ipArray['gridsearchValues'],true);  
                        
                        $appl_form = $gridsearchValues['appl_form'];
                        $bran_name = $gridsearchValues['bran_name'];
                        $appl_status = $gridsearchValues['appl_status'];
                        $cert = $gridsearchValues['cert'];
                        $date_expiry = $gridsearchValues['date_expiry'];
                        $addedon_branch = $gridsearchValues['addedon_branch'];
                        $lastUpdated_branch = $gridsearchValues['lastUpdated_branch'];
                                        
                        if($appl_form){
                            $model->andFilterWhere(['AND', ['LIKE', 'appdt_appreferno', $appl_form],]);
                        }
                        
                        if($bran_name){
                            $model->andFilterWhere(['AND', ['LIKE', 'appiit_branchname_en', $bran_name],]);
                        }

                        // if($cert){
                        //     $model->andFilterWhere(['AND', ['LIKE', 'irm_intlrecogname_en', $cert],]);
                        // }

                        if($cert){  // certificate  Filter
          
                            $appcond ="";
                            if(in_array(2, $cert)){ //approved
                            $appcond .= "(appdt_certificategenon is not null  and appdt_certificateexpiry > '$today') ||";
                            }
                            if(in_array(1, $cert)){ //yrt to certify
                            $appcond .= "appdt_certificategenon is  null||";
                            }
                            if(in_array(3, $cert)){ //Expired
                                $appcond .= "(appdt_certificategenon is not null   and appdt_certificateexpiry < '$today' )||";
                             }
                            $paymentstscond = rtrim($appcond, "||");
                            $model->andWhere($paymentstscond);
                            }

                        if($appl_status){
                        if(in_array('10', $appl_status)){
                             array_push($appl_status,"11","12","13","14","15","16","20");
                        }
            
                           $model->andFilterWhere(['AND',['IN', 'appdt_status', $appl_status],]);
                        }

                        if($date_expiry['startDate'] && $date_expiry['endDate']){
                            $model->andFilterWhere(['between', 'date(appdt_certificateexpiry)', date('Y-m-d',strtotime($date_expiry['startDate'])), date('Y-m-d',strtotime($date_expiry['endDate']))]);
                        }
                        
                        if($addedon_branch['startDate'] && $addedon_branch['endDate']){
                            $model->andFilterWhere(['between', 'date(appiit_createdon)', date('Y-m-d',strtotime($addedon_branch['startDate'])), date('Y-m-d',strtotime($addedon_branch['endDate']))]);
                        }

                        if($lastUpdated_branch['startDate'] && $lastUpdated_branch['endDate']){
                            $model->andFilterWhere(['between', 'date(appiit_updatedon)', date('Y-m-d',strtotime($lastUpdated_branch['startDate'])), date('Y-m-d',strtotime($lastUpdated_branch['endDate']))]);
                        }
                }
            $sort_column = (strpos($ipArray['sort'],"-") !== false) ? explode("-",$ipArray['sort'])[1] : $ipArray['sort'];
            $order_by = ($ipArray['order']=='asc')? 'asc': 'desc';
            if($sort_column = 'addedon'){
                $sort_column = 'appdt_submittedon';
            }
            if($sort_column = 'lastUpdated'){
                $sort_column = 'appdt_updatedon';
            }
         
            $model->orderBy("$sort_column $order_by");
            $model->asArray();
            $raw = $model->createCommand()->getRawSql();
   
            $page = (!empty($ipArray['size']) && $ipArray['size'] != 'undefined') ? $ipArray['size'] : 10 ;  
            $provider = new \yii\data\ActiveDataProvider([
                'query' => $model,
                'pagination' => [
                    'pageSize' => $page,
                    'page' => $ipArray['page']
                ],
            ]);

            $data = $provider->getModels();
            //echo '<pre>';print_r($data);exit;
            $finalAry = array();
            foreach($data as $dataInfo){
                $resAry=$dataInfo;
                if(!empty($dataInfo['appdt_certificategenon'])){
                    $resAry['cert_status'] = "Active";
                }
    
                if(date('Y-m-d', strtotime($dataInfo['appdt_certificateexpiry'])) < date('Y-m-d', strtotime(date("Y/m/d")))){
                    $resAry['cert_status'] = "Expired";
                }
                
                if(empty($dataInfo['appdt_certificategenon'])){
                    $resAry['cert_status'] = "New";
                }
                $now = time(); // or your date as well
                $your_date = strtotime($dataInfo['appdt_certificateexpiry']);
                $datediff = $your_date - $now;
                $renewDate = round($datediff / (60 * 60 * 24));
                $resAry['days'] = $renewDate + 1;
                $finalAry[]=$resAry;
            }
            
            $response = array();
            $response['data'] = $finalAry;
            $response['totalcount'] = $provider->getTotalCount();
            $response['size'] = $page;
            return $response;
        } else {
            
            $response = array();
            $response['data'] ="";
            $response['totalcount'] = "";
            $response['size'] = $page;
            return $response;
        }
   }

   public static function getunitcodedata($id)
   {
       $response = [];
       $temp_id = $id;
       
       $data = ApplicationdtlstmpTbl::find()
       ->select(['applicationdtlstmp_pk','appoffercoursetmp_pk','appoffercourseunittmp_pk','appocut_unitcode','appocut_unittitle'])
       ->leftJoin('appoffercoursetmp_tbl','appoct_applicationdtlstmp_fk = applicationdtlstmp_pk')
       ->leftJoin('appoffercourseunittmp_tbl','appocut_appoffercoursetmp_fk = appoffercoursetmp_pk')
       ->Where(['appdt_appreferno' => $temp_id])
       ->asArray()
       ->all();

       if($data){
           $response = ['status' => 1,'data' => $data,'msg' => 'Success',
           ];
       } else{
          $response = ['status' => 2,'data' => '','msg' => 'Failure',
           ]; 
       }
       return $response;
   }
   public function getProjectInfo($data){
       $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
       $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
       $modelmain = ApplicationdtlstmpTbl::find()
           ->select(['applicationdtlstmp_pk','projectmst_pk','appdt_apptype','appdt_status',
           'pm_projtype','pm_projectname_en','pm_projectname_ar','appocm_coursename_en as customcourse_en',
           'appocm_coursename_ar as customcourse_ar','scm_coursename_en as stndcourse_en',
           'scm_coursename_ar as stndcourse_ar','scm_coursetype as coursetype','appiim_officetype as appiim_officetype',
           'appiim_branchname_en as appiim_branchname_en','appiim_branchname_ar as appiim_branchname_ar'])
           ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appdt_opalmemberregmst_fk')
           ->leftJoin('projectmst_tbl','appdt_projectmst_fk = projectmst_pk')
           ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
           ->leftJoin('standardcoursemst_tbl','standardcoursemst_pk = appcdt_standardcoursemst_fk')
           ->leftJoin('appoffercoursemain_tbl','appoffercoursemain_pk = appcdt_appoffercoursemain_fk')
           ->leftJoin('appinstinfomain_tbl','appinstinfomain_pk = appcdt_appinstinfomain_fk')
           ->where(['appcdt_opalmemberregmst_fk' => $regPk])
           ->andWhere(['appcdt_applicationdtlstmp_fk' => $data['apppk']])
           ->andWhere(['appdt_projectmst_fk' => $data['projpk']])
           ->asArray()
           ->one();
       return $modelmain;
   }
   

public function getcourseexportlist($searchkey)
{


$excelldata= [];  
$today = date("Y-m-d");

$data = ApplicationdtlstmpTbl::find()
->select("
    appcdt_status,appdt_certificatepath,omrm_tpname_en,omrm_tpname_ar,appdt_certificateexpiry,appdt_updatedon,appdt_submittedon,applicationdtlstmp_pk,appdt_certificateexpiry AS dateofexpiry,appdt_appreferno AS applictionno,appiim_officetype  AS offictype,
    appiim_branchname_en AS branchname,appiim_branchname_ar,appiim_locmapurl,appiim_loclongitude,appiim_loclatitude AS sitelocan,
    appdt_projectmst_fk AS coursetype,(CASE WHEN appocm_coursename_en IS NOT NULL THEN  appocm_coursename_en ELSE scm_coursename_en  END) AS coursetitle, (CASE WHEN  category.ccm_catname_en IS NOT NULL THEN category.ccm_catname_en ELSE scm_coursename_en  END ) AS coursecate,appcoursetrnstmp_pk, group_concat(DISTINCT(coursesubcategory.ccm_catname_en)) AS coursesubcate , appdt_apptype As applytype, appdt_status AS applicationstatus,appdt_updatedon AS lastUpdated ,appdt_certificateexpiry AS addedon,applicationdtlstmp_pk,appdt_apptype,appdt_status ,category.coursecategorymst_pk,appocm_coursecategorymst_fk,
    omrm_companyname_en,omrm_companyname_ar,asd_date")    
    ->innerJoin('appcoursedtlstmp_tbl','applicationdtlstmp_pk = appcdt_applicationdtlstmp_fk')
    ->leftJoin('opalmemberregmst_tbl','appcdt_opalmemberregmst_fk = opalmemberregmst_pk')
    ->leftJoin('appinstinfomain_tbl','appcdt_appinstinfomain_fk = appinstinfomain_pk')
    // ->leftJoin('appstaffinfotmp_tbl','appsit_applicationdtlstmp_fk = applicationdtlstmp_pk')
  //   ->leftJoin('staffinforepo_tbl','appsit_staffinforepo_fk = staffinforepo_pk')
    ->leftJoin('appoffercoursemain_tbl','appoffercoursemain_pk = appcdt_appoffercoursemain_fk')
  //  ->leftJoin('appoffercoursetmp_tbl','appcdt_appoffercoursemain_fk = appoffercoursemain_pk')
    ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk in(appocm_coursesubcategorymst_fk)')
    ->leftJoin('coursecategorymst_tbl AS category',' appocm_coursecategorymst_fk in(category.coursecategorymst_pk)')
    ->leftJoin('standardcoursemst_tbl','standardcoursemst_pk = appcdt_standardcoursemst_fk')
    ->leftJoin('standardcoursedtls_tbl','scd_standardcoursemst_fk = standardcoursemst_pk')
    ->leftJoin('appcoursetrnstmp_tbl','appctt_appcoursedtlstmp_fk = appcoursedtlstmp_pk')
    ->leftJoin('coursecategorymst_tbl AS coursesubcategory','appctt_coursecategorymst_fk = coursesubcategory.coursecategorymst_pk')
   //->leftJoin('appcoursedtlsmain_tbl','appcdm_standardcoursemst_fk = coursecategorymst_tbl.ccm_coursecategorymst_pk')
   ->leftJoin('appauditschedtmp_tbl','appasdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
   ->leftJoin('auditscheddtls_tbl','auditscheddtls_pk = appasdt_auditscheddtls_fk')
    ->Where("appdt_projectmst_fk in (2,3) and appdt_status != 1   and ((appcdt_appoffercoursemain_fk is not null and appcdt_standardcoursemst_fk is null) or (appcdt_appoffercoursemain_fk is null and appcdt_standardcoursemst_fk is not null))");
    
   
     if(!empty($searchkey['appl_form'])){
        $data->andwhere("appdt_appreferno like '%".$searchkey['appl_form']."%'");
        }
    if(!empty($searchkey['trainingprovider'])){
        $data->andwhere("omrm_tpname_en like '%".$searchkey['trainingprovider']."%'");
        }
    if(!empty($searchkey['officetype'])){
        $data->andwhere("appiim_officetype in( ".implode(",",$searchkey['officetype']).")");
        }
    if(!empty($searchkey['branch'])){
        $data->andwhere("appiim_branchname_en like '%".$searchkey['branch']."%'");
        }
    if(!empty($searchkey['cour_type'])){
        $data->andwhere("appdt_projectmst_fk in( ".implode(",",$searchkey['cour_type']).")");
        }
    if(!empty($searchkey['course_title'])){
        $data->andwhere("scm_coursename_en  like '%".$searchkey['course_title']."%'");
        $data->orwhere("appocm_coursename_en  like '%".$searchkey['course_title']."%'");
        }
    if(!empty($searchkey['course_cat'])){
        $data->andwhere("category.ccm_catname_en  like '%".$searchkey['course_cat']."%'");
        }
    if(!empty($searchkey['cour_subcate'])){
        $data->andwhere("coursesubcategory.ccm_catname_en  like '%".$searchkey['cour_subcate']."%'");
        }
    if(!empty($searchkey['appl_type'])){
        $data->andwhere("appdt_apptype in( ".implode(",",$searchkey['appl_type']).")");
        }
    if(!empty($searchkey['appdt_status'])){
        $data->andwhere("appdt_status in( ".implode(",",$searchkey['appdt_status']).")");
        }
    // if(!empty($searchkey['cert_status'])){
    //     if($searchkey['cert_status'] == 1){
    //         $data->andwhere("appdt_certificateexpiry is null");
    //     }else if($searchkey['cert_status'] == 2){
    //         $data->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry > CURDATE()");
    //     }else if($searchkey['cert_status'] == 3){
    //         $data->andwhere("appdt_certificateexpiry is not null and  appdt_certificateexpiry < CURDATE()");
    //     }
    // }
    if(!empty($searchkey['cert_status'])){ // certificate  Filter
        $appcond ="";
        if(in_array(2, $searchkey['cert_status'])){ //approved
        $appcond .= "(appdt_certificategenon is not null  and appdt_certificateexpiry > '$today') ||";
        }
        if(in_array(1, $searchkey['cert_status'])){ //yrt to certify
        $appcond .= "appdt_certificategenon is  null||";
        }
        if(in_array(3, $searchkey['cert_status'])){ //Expired
            $appcond .= "(appdt_certificategenon is not null   and appdt_certificateexpiry < '$today' ) ||";
         }
        $paymentstscond = rtrim($appcond, "||");
        $data->andWhere($paymentstscond);
        }     
    if(!empty($searchkey['site_audit_filter']['startDate'])){
        $data->andwhere("asd_date  between '".date("Y-m-d", strtotime($searchkey['site_audit_filter']['startDate']. "+1 day"))."' and '".date("Y-m-d", strtotime($searchkey['site_audit_filter']['endDate']. "+1 day"))."'");
     }
     if(!empty($searchkey['date_expiry_filter']['startDate'])){
        $data->andwhere("appdt_certificateexpiry  between '".date("Y-m-d", strtotime($searchkey['date_expiry_filter']['startDate']. "+1 day"))."' and '".date("Y-m-d", strtotime($searchkey['date_expiry_filter']['endDate']. "+1 day"))."'");
     }
     if(!empty($searchkey['addedon_branch_filter']['startDate'])){
        $data->andwhere("appdt_appdecon  between '".date("Y-m-d", strtotime($searchkey['addedon_branch_filter']['startDate']. "+1 day"))."' and '".date("Y-m-d", strtotime($searchkey['addedon_branch_filter']['endDate']. "+1 day"))."'");
     }
     if(!empty($searchkey['lastUpdated_branch_filter']['startDate'])){
        $data->andwhere("appdt_updatedon  between '".date("Y-m-d", strtotime($searchkey['lastUpdated_branch_filter']['startDate']. "+1 day"))."' and '".date("Y-m-d", strtotime($searchkey['lastUpdated_branch_filter']['endDate']. "+1 day"))."'");
     }
     $data->groupBy('appdt_appreferno');
     $data->orderBy(['ifnull(appdt_updatedon,appdt_submittedon)'=>SORT_DESC]);
   
     $data->asArray();
    
    $allrecords = $data->all();
// print_r($allrecords);exit;
   
 if(!empty($allrecords))
 {
    foreach ($allrecords as $key => $value) {
        $sitevisitstss = $value['applicationstatus'];

        $apptype =  [1=>'Initial',2=>'Renewal',3=>'update'];
        $apparrays = [2=>'Desktop Review Pending',3=>'Missing Files',4=>'Desktop Review Pending',5=>'Payment Pending',6=>'Confirm Payment',7=>'Yet to schedule for Site Audit',8=>'Audit Date Selection(Training Provider)',9=>'Ready for Audit',10=>'Quality Manager Approval Pending',11=>'Authority  Approval Pending',12=>'CEO Approval Pending',13=>'Site Audit Report Declined',14=>'Quality Manager Approval Pending',15=>'Authority  Approval Pending',16=>'CEO Approval Pending',17=>'Approved',18=>'Declined by finance team',19=>'Suspended',20=>'Certification Form Declined'];
        $excelldata[$key]['applictionno'] =  $value['applictionno'];
        $excelldata[$key]['trainprovname'] =  $value['omrm_tpname_en'];
        $excelldata[$key]['offictype'] = ($value['offictype'] == 1)?'Main Office':'Branch Ofice';
        $excelldata[$key]['branchname'] = empty($value['branchname'])?'-':$value['branchname'];
        $excelldata[$key]['sitelocan'] = empty($value['appiim_locmapurl'])?'-':$value['appiim_locmapurl'];

        if($value['coursetype'] == 2)
        {
            $excelldata[$key]['coursetype'] = 'Standard';
        }
        else if(($value['coursetype'] == 3))
        {
            $excelldata[$key]['coursetype'] = 'Customize';
        }
       
        $excelldata[$key]['coursetitle'] = $value['coursetitle'];
        $excelldata[$key]['coursecate'] = $value['coursecate'];
        $excelldata[$key]['coursesubcate'] = $value['coursesubcate'];

        if($value['applytype'] == 1)
        {
            $excelldata[$key]['applytype'] = 'Initial';
        }
        else if($value['applytype'] == 2)
        {
            $excelldata[$key]['applytype'] = 'Renewal'; 

        } else if($value['applytype'] == 3)
        {
            $excelldata[$key]['applytype'] = 'Update';  


        }
        $excelldata[$key]['applicationstatus'] =    $apparrays[$sitevisitstss];
        
        if(($value['dateofexpiry'] !=  '')  &&  ($value['dateofexpiry'] > $today)){ 
            $excelldata[$key]['Certification_Status'] = 'Active';
        }
      if($value['dateofexpiry'] ==  '' || $value['dateofexpiry'] == null ){   
        $excelldata[$key]['Certification_Status'] = 'New ';
       }
      if(($value['dateofexpiry'] !=  '') &&  ($value['dateofexpiry'] < $today)){   //Expired
              $excelldata[$key]['Certification_Status'] = 'Expired';
       }

        $excelldata[$key]['asd_date'] =     (!empty($value['asd_date'])? date("d-m-Y",strtotime($value['asd_date'])): "-");
        $excelldata[$key]['dateofexpiry'] =     (!empty($value['dateofexpiry'])? date("d-m-Y",strtotime($value['dateofexpiry'])): "-");
        $excelldata[$key]['addedon'] =     (!empty($value['appdt_submittedon'])?date("d-m-Y",strtotime($value['appdt_submittedon'])): "-");
        $excelldata[$key]['lastUpdated'] =     (!empty($value['lastUpdated'])?date("d-m-Y",strtotime($value['lastUpdated'])): "-");

    }
 }


    return $excelldata;

}

public static function getappoveralras($data) {

    $status = $data['formdata']['select_valitate']; 
    $appDtlsPk = Security::decrypt($data['formdata']['appdtlstmp_id']);
    $modelComp   = AppcompanydtlstmpTbl::find()->select(['acdt_status'])->where(['acdt_applicationdtlstmp_fk' => $appDtlsPk])->one();
    $model['acdt_status'] = $modelComp['acdt_status'];
    $modelIns   =  AppinstinfotmpTbl::find()->select(['appiit_status'])->where(['appiit_applicationdtlstmp_fk' => $appDtlsPk])->one();
    $model['appiit_status'] = $modelIns['appiit_status'];
    $docInt   =  AppdocsubmissiontmpTbl::find()->select(['appdst_status'])->where(['appdst_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all();   
    foreach($docInt as $key => $status){
     $docarray[] = $status['appdst_status'];
     }
     if(in_array('3' , $docarray)){
     $model['appdst_status'] = 3; 
     }if(in_array('4' , $docarray)){
     $model['appdst_status'] = 4;
     }else if(in_array('1' , $docarray)){
     $model['appdst_status'] = 1; 
     }else if(in_array('2' , $docarray)){
     $model['appdst_status'] = 2; 
     }
     $venInt   =  ApprasvehinspcattmpTbl::find()->select(['arvict_status'])->where(['arvict_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all();   
     foreach($venInt as $key => $status){
      $veharray[] = $status['arvict_status'];
      }
      if(in_array('3' , $veharray)){
      $model['arvict_status'] = 3; 
      }if(in_array('4' , $veharray)){
      $model['arvict_status'] = 4;
      }else if(in_array('1' , $veharray)){
      $model['arvict_status'] = 1; 
      }else if(in_array('2' , $veharray)){
      $model['arvict_status'] = 2; 
      }
 
  

     $staffInt   =  AppstaffinfotmpTbl::find()->select(['appsit_status'])->where(['appsit_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all();   
      foreach($staffInt as $key => $status){
        $staffarray[] = $status['appsit_status'];

     }

     if(in_array('3' , $staffarray)){
     $model['appsit_status'] = 3; 
     }if(in_array('4' , $staffarray)){
     $model['appsit_status'] = 4;

     }else if(in_array('1' , $staffarray)){

     $model['appsit_status'] = 1; 
     }else if(in_array('2' , $staffarray)){
     $model['appsit_status'] = 2; 
     }
    return $model;

}



public static function inspectionapprodecproce()
{

    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $opalusermst_tbl = OpalusermstTbl::find()->where("opalusermst_pk = '$userPk'")->one();
    $appcdt_appdecby = $opalusermst_tbl->opalusermst_pk;
    $last_updated_by['updat_by'] = $opalusermst_tbl->oum_firstname;
    $request = Yii::$app->request;
    $status = $request->post('status');
    $inspectiontmp_pk = $request->post('inspectiontmp_pk');
    $staffinfotmp_pk = $request->post('staff_id');
    $categoryid = $request->post('catid');
    $staff_id = $request->post('repo_id');
    $comments = $request->post('comments');
    $arr= [];
    $doc_arr= [];
    

    $reportdocument = $request->post('reportdocument');
    $reportdocument = $reportdocument[0];
    $status_info = $request->post('status_info');
    $percentage = $request->post('percentage');
    $mark = $request->post('mark');
    $todays = date("Y-m-d h:i:s");
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);


    //delete
// $delete = StaffevaluationtmpTbl::find()->where()
// \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
// StaffevaluationtmpTbl::deleteAll(['IN', 'set_appstaffinfotmp_fk',$staffinfotmp_pk]);
// \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute(); 

              
            $project_mst = AppstaffinfotmpTbl::find()
            ->select("appdt_projectmst_fk , appdt_apptype")
            ->leftJoin("applicationdtlstmp_tbl","applicationdtlstmp_pk = appsit_applicationdtlstmp_fk")
            ->where("appostaffinfotmp_pk = '$staffinfotmp_pk'")
            ->asArray()
            ->one();
            $projectmst = $project_mst['appdt_projectmst_fk'];
            $appdt_apptype = $project_mst['appdt_apptype'];
   
            if($appdt_apptype ==1){
            $apptype = 1;
            } else if($appdt_apptype ==2 || $appdt_apptype ==3){
            $apptype = 3;

            }

                $infotemrec = AppstaffinfotmpTbl::find()
                ->where("appostaffinfotmp_pk = '$staffinfotmp_pk' ")->one();
                $applicationstatus = $infotemrec->appsit_iscarddetails; 

                $roleofcourse = $infotemrec->appsit_roleforcourse;
                $array = explode(',', $roleofcourse);
                $fsmfee = '0.000';


                //  if( in_array("8", $array, TRUE) || in_array("9", $array, TRUE) || in_array("10", $array, TRUE))
                //  {



            if($projectmst == 4)
            {

            $staffeval = \app\models\StaffevaluationtmpTbl::find()
            ->select(['*'])
            ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = set_asmtupload')
            ->where("set_appstaffinfotmp_fk =:set_appstaffinfotmp_fk", [':set_appstaffinfotmp_fk' => $staffinfotmp_pk])
            ->andwhere("set_rascategorymst_fk =:set_rascategorymst_fk", [':set_rascategorymst_fk' => $categoryid])
            ->orderBy(["staffevaluationtmp_pk" => SORT_DESC])->asArray()->one();
          

            if($status_info == 1 && $staffeval['set_asmtstatus'] == 6){
            $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")
            ->andWhere("fsm_feestype = 6")
            ->andWhere("fsm_applicationtype = $apptype")  
            ->andWhere("fsm_officetype = '$officetype' OR  fsm_officetype = '3'")               
            ->one();
            } else {
                $feerec = FeesubscriptionmstTbl::find()->where("fsm_projectmst_fk = '$projectmst'")
                ->andWhere("fsm_feestype = 2")
                ->andWhere("fsm_applicationtype = $apptype")  
                ->andWhere("fsm_officetype = '$officetype' OR  fsm_officetype = '3'")               
                ->one();
            }

            $fsmfee = $feerec->fsm_fee;
            }

            $exists  =  StaffevaluationtmpTbl::find()->where("set_appstaffinfotmp_fk = '$staffinfotmp_pk' ")->andwhere("set_rascategorymst_fk = '$categoryid' ")->andwhere("set_asmttype = '1' ")->andWhere(['IS','set_apppytminvoicedtls_fk' ,null])->one();  
            
            $practicalexists  =  StaffevaluationtmpTbl::find()->where("set_appstaffinfotmp_fk = '$staffinfotmp_pk' ")->andwhere("set_rascategorymst_fk = '$categoryid' ")->andwhere("set_asmttype = '2' ")->andWhere(['IS','set_apppytminvoicedtls_fk' ,null])->one(); 
            if($status == 1) // applicable 
            { 
            if($status_info == 1 || $status_info == 2){
            if(!$exists || $exists['set_asmtstatus'] == 6){
            $staffevaluationtmp_tbl = new  StaffevaluationtmpTbl();         
            $staffevaluationtmp_tbl->set_appstaffinfotmp_fk = $staffinfotmp_pk;
            $staffevaluationtmp_tbl->set_staffinforepo_fk = $staff_id;
            $staffevaluationtmp_tbl->set_asmttype = 1;
            $staffevaluationtmp_tbl->set_asmtmode = 1;
            $staffevaluationtmp_tbl->set_rascategorymst_fk =   $categoryid ;
            $staffevaluationtmp_tbl->set_asmtstatus = ($status_info==1)? 5: 6;
            $staffevaluationtmp_tbl->set_asmtupload = $reportdocument;
            $staffevaluationtmp_tbl->set_marksecured = $mark ;
            $staffevaluationtmp_tbl->set_percentage =  $percentage;
            $staffevaluationtmp_tbl->set_comment =  $comments;
            $staffevaluationtmp_tbl->set_staffevanfee = $fsmfee;
            $staffevaluationtmp_tbl->set_createdon = date("Y-m-d H:m:s") ;
            $staffevaluationtmp_tbl->set_createdby = $userPk ;
            $staffevaluationtmp_tbl->set_rolemst_fk = $roleofcourse ;
            

            if($staffevaluationtmp_tbl->save())
            {     
            }else{ 
            echo '<pre>';
            print_r($staffevaluationtmp_tbl->getErrors());
            exit;

            }
            }else{
            $exists->set_marksecured = $mark ;
            $exists->set_percentage =  $percentage;
            $exists->set_comment =  $comments;
            $exists->set_staffevanfee = $fsmfee;
            $exists->set_asmtupload = $reportdocument;
            $exists->set_asmtstatus =  ($status_info==1)? 5: 6;
            $exists->set_updatedon = date("Y-m-d H:m:s") ;
            $exists->set_updatedby = $userPk ;
            $exists->save();

            }     

            if($practicalexists){
                $practicalexists->set_comment =  $comments;
                $practicalexists->set_asmtstatus = 7;
                $practicalexists->set_updatedon = date("Y-m-d H:m:s") ;
                $practicalexists->set_updatedby = $userPk ;
                $practicalexists->set_marksecured = '' ;
                $practicalexists->set_percentage =  '';
               // $practicalexists->set_staffevanfee = $fsmfee;
                $practicalexists->set_asmtupload = '';
                if($practicalexists->save())
                {     
                }else{ 
                echo '<pre>';
                print_r($practicalexists->getErrors());
                exit;
        
                }
            }
            }
   }
  
    if($status == 2) //not applicable
    {
            if(!$exists){
            $staffevaluationtmp_tbl = new  StaffevaluationtmpTbl(); 
            $staffevaluationtmp_tbl->set_appstaffinfotmp_fk = $staffinfotmp_pk;
            $staffevaluationtmp_tbl->set_staffinforepo_fk = $staff_id;
            $staffevaluationtmp_tbl->set_asmttype = 1;
            $staffevaluationtmp_tbl->set_asmtmode = 1;
            $staffevaluationtmp_tbl->set_asmtstatus = 2;
            $staffevaluationtmp_tbl->set_comment =  $comments;
            $staffevaluationtmp_tbl->set_rascategorymst_fk =   $categoryid ;
            $staffevaluationtmp_tbl->set_createdon = date("Y-m-d H:m:s") ;
            $staffevaluationtmp_tbl->set_createdby = $userPk ;
            $staffevaluationtmp_tbl->set_rolemst_fk = $roleofcourse ;
            if($staffevaluationtmp_tbl->save()){
            }else{
            print_r($staffevaluationtmp_tbl->getErrors()); 
            }

            }else{
                $exists->set_comment =  $comments;
                $exists->set_asmtstatus = 2;
                $exists->set_updatedon = date("Y-m-d H:m:s") ;
                $exists->set_updatedby = $userPk ;
                $exists->set_marksecured = '' ;
                $exists->set_percentage =  '';
                $exists->set_staffevanfee = '';
                $exists->set_asmtupload = '';
                $exists->save();
    
                }

         $existspractical  =  StaffevaluationtmpTbl::find()->where("set_appstaffinfotmp_fk = '$staffinfotmp_pk' ")->andwhere("set_rascategorymst_fk = '$categoryid' ")->andwhere("set_asmttype = '2' ")->andWhere(['IS','set_apppytminvoicedtls_fk' ,null])->one();  
        if(!$existspractical){
        $staffevaluationtmp_tbl_pa = new  StaffevaluationtmpTbl(); 
        $staffevaluationtmp_tbl_pa->set_appstaffinfotmp_fk = $staffinfotmp_pk;
        $staffevaluationtmp_tbl_pa->set_staffinforepo_fk = $staff_id;
        $staffevaluationtmp_tbl_pa->set_asmttype = 2;
        $staffevaluationtmp_tbl_pa->set_asmtmode = 1;
        $staffevaluationtmp_tbl_pa->set_asmtstatus = 2;
        $staffevaluationtmp_tbl_pa->set_comment =  $comments;
        $staffevaluationtmp_tbl_pa->set_rascategorymst_fk =   $categoryid ;
        $staffevaluationtmp_tbl_pa->set_createdon = date("Y-m-d H:m:s") ;
        $staffevaluationtmp_tbl_pa->set_createdby = $userPk ;
        $staffevaluationtmp_tbl_pa->set_rolemst_fk = $roleofcourse ;
        if(!$staffevaluationtmp_tbl_pa->save()){
        print_r($staffevaluationtmp_tbl_pa->getErrors()); 
        }
        }else{
            $existspractical->set_comment =  $comments;
            $existspractical->set_asmtstatus = 2;
            $existspractical->set_updatedon = date("Y-m-d H:m:s") ;
            $existspractical->set_updatedby = $userPk ;
            $existspractical->set_marksecured = ''  ;
            $existspractical->set_percentage =  '';
            $existspractical->set_staffevanfee = '';
            $existspractical->set_asmtupload = '';
            $existspractical->save();

            }
    } 
    elseif($status == 3)  // not applicable(knowledge assessment alone)
    {
    if(!$exists){
     $staffevaluationtmp_tbl = new  StaffevaluationtmpTbl(); 
     $staffevaluationtmp_tbl->set_appstaffinfotmp_fk = $staffinfotmp_pk;
     $staffevaluationtmp_tbl->set_staffinforepo_fk = $staff_id;
     $staffevaluationtmp_tbl->set_asmttype = 1;
     $staffevaluationtmp_tbl->set_asmtmode = 1;
     $staffevaluationtmp_tbl->set_asmtstatus = 7;
     $staffevaluationtmp_tbl->set_staffevanfee = $fsmfee;
     $staffevaluationtmp_tbl->set_comment =  $comments;
     $staffevaluationtmp_tbl->set_rascategorymst_fk =   $categoryid ;
     $staffevaluationtmp_tbl->set_createdon = date("Y-m-d H:m:s") ;
     $staffevaluationtmp_tbl->set_createdby = $userPk ;
     $staffevaluationtmp_tbl->set_rolemst_fk = $roleofcourse ;
     if($staffevaluationtmp_tbl->save()){
    }
    }else{
      // print_R($exists);
        $exists->set_comment =  $comments;
        $exists->set_asmtstatus = 7;
        $exists->set_updatedon = date("Y-m-d H:m:s") ;
        $exists->set_updatedby = $userPk ;
        $exists->set_marksecured = '' ;
        $exists->set_percentage =  '';
        $exists->set_staffevanfee = $fsmfee;
        $exists->set_asmtupload = '';
        //$exists->save();
        if($exists->save())
        {     
         //   print_R($exists);
          
        }else{ 
        echo '<pre>';
        print_r($exists->getErrors());
        exit;

        }
    }

    if($practicalexists){

        $practicalexists->set_comment =  $comments;
        $practicalexists->set_asmtstatus = 7;
        $practicalexists->set_updatedon = date("Y-m-d H:m:s") ;
        $practicalexists->set_updatedby = $userPk ;
        $practicalexists->set_marksecured = '' ;
        $practicalexists->set_percentage =  '';
       // $practicalexists->set_staffevanfee = $fsmfee;
        $practicalexists->set_asmtupload = '';
        if($practicalexists->save())
        {     
        }else{ 
        echo '<pre>';
        print_r($practicalexists->getErrors());
        exit;

        }
    }
    }
    $arr['appsit_status']=$appstaffinfotmp_tbl->appsit_status;
    $arr['staff_doc']=(!empty($doc_arr['staff_doc']))? $doc_arr['staff_doc']: '';
    // $arr['staff_doc']=($staffevaluationtmp_tbl->set_asmtupload);
    $arr['set_percentage']=$staffevaluationtmp_tbl->set_percentage;
    $arr['set_marksecured']=$staffevaluationtmp_tbl->set_marksecured;
    $arr['appsit_appdeccomment']=$comments;
    $arr['appsit_appdecon']=$todays;
    $arr['updat_by']=$last_updated_by['updat_by'];

    return $arr; 


}

public static function inspectionpractical()
{

    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

    $opalusermst_tbl = OpalusermstTbl::find()->where("opalusermst_pk = '$userPk'")->one();
    $appcdt_appdecby = $opalusermst_tbl->opalusermst_pk;
    $last_updated_by['updat_by'] = $opalusermst_tbl->oum_firstname;
   
    $request = Yii::$app->request;
    $status = $request->post('status');

    $inspectiontmp_pk = $request->post('inspectiontmp_pk');
  
    $staffinfotmp_pk = $request->post('staff_id');
    $categoryid = $request->post('catid');
    // $inspectiontmp_pk = Security::decrypt($inspectiontmppk);
    // $staffinfotmp_pk = Security::decrypt($stafftmppk);

    $staff_id = $request->post('repo_id');
    $comments = $request->post('comments');
    $arr= [];
    $doc_arr= [];
    

    $reportdocument = $request->post('reportdocument');
    $reportdocument = $reportdocument[0];
    $status_info = $request->post('status_info');
    $percentage = $request->post('percentage');
    $mark = $request->post('mark');
    $todays = date("Y-m-d h:i:s");

    $invoicedata  = OpalInvoiceTbl::find()
    ->select(['*'])
    ->leftJoin('appstaffinfotmp_tbl', 'appsit_applicationdtlstmp_fk = apid_applicationdtlstmp_fk')
    ->where('appostaffinfotmp_pk = '.$staffinfotmp_pk)    
    ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC])->asArray()->one();
    $invoiceid = $invoicedata['apppytminvoicedtls_pk'];
    $roleofcourse = $invoicedata['appsit_roleforcourse'];
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);    
       $exists  =  StaffevaluationtmpTbl::find()->where("set_appstaffinfotmp_fk = '$staffinfotmp_pk' ")->andwhere("set_rascategorymst_fk = '$categoryid' ")->andwhere("set_asmttype = '2' ")->andWhere(['IS','set_apppytminvoicedtls_fk' ,null])->one();
        if($status == 4 ||  $status == 5 || $status == 6) // competent 
        {
            if($status == 4){
                       $asmstatus = 3;
            }else if($status == 5){
                $asmstatus = 4;
            }else{
                $asmstatus = 2;
            }
          
            if(!$exists){
                $staffevaluationtmp_tbl = new  StaffevaluationtmpTbl();         
                $staffevaluationtmp_tbl->set_appstaffinfotmp_fk = $staffinfotmp_pk;
                $staffevaluationtmp_tbl->set_staffinforepo_fk = $staff_id;
                $staffevaluationtmp_tbl->set_asmttype = 2;
                $staffevaluationtmp_tbl->set_asmtmode = 1;
                $staffevaluationtmp_tbl->set_rascategorymst_fk =   $categoryid ;
                $staffevaluationtmp_tbl->set_asmtstatus = $asmstatus;
                $staffevaluationtmp_tbl->set_asmtupload = $reportdocument;
                $staffevaluationtmp_tbl->set_marksecured = $mark ;
                $staffevaluationtmp_tbl->set_percentage =  $percentage;
                $staffevaluationtmp_tbl->set_apppytminvoicedtls_fk =  $invoiceid;
                $staffevaluationtmp_tbl->set_comment =  $comments;
                $staffevaluationtmp_tbl->set_createdon = date("Y-m-d H:m:s") ;
                $staffevaluationtmp_tbl->set_createdby = $userPk ;         
                $staffevaluationtmp_tbl->set_rolemst_fk = $roleofcourse;
                if($staffevaluationtmp_tbl->save())
                {     

                }else{ 
                echo '<pre>';
                print_r($staffevaluationtmp_tbl->getErrors());
                exit;

                }
            }else{
                $exists->set_marksecured = $mark ;
                $exists->set_percentage =  $percentage;
                $exists->set_comment =  $comments;
                $exists->set_asmtstatus = $asmstatus;
                $exists->set_updatedon = date("Y-m-d H:m:s") ;
                $exists->set_updatedby = $userPk ;
                $exists->set_rolemst_fk = $roleofcourse;
                $exists->set_apppytminvoicedtls_fk =  $invoiceid;
                $exists->save();

            }
        }
  
}


}
