<?php


namespace api\modules\rem\controllers;

use api\modules\mst\controllers\MasterController;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\web\Response;

/**
 * Default controller for the `backend` module
 */
class ReminderController extends MasterController
{


          public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];
    }
    

     public function actionSendremindermail(){
         
        //Send Reminder Mail to Training Evaluation Centre to renew the certificate
        $appliQuery = "SELECT DATEDIFF(appdm_certificateexpiry,curdate()) AS dayleft , appdm_opalmemberregmst_fk , applicationdtlstmp_pk , appdm_certificateexpiry from applicationdtlsmain_tbl
inner join applicationdtlstmp_tbl on applicationdtlsmain_tbl.appdm_applicationdtlstmp_fk = applicationdtlstmp_tbl.applicationdtlstmp_pk
where appdm_projectmst_fk=1";
        $expiryDt = \Yii::$app->db->createCommand($appliQuery)->queryAll();   
        if(!empty($expiryDt)&& count($expiryDt)>0){
            foreach ($expiryDt as $expDt) {
                $currentDate = date('Y-m-d');
                $apptmpPk = $expDt['applicationdtlstmp_pk'];
                $regPk = $expDt['appdm_opalmemberregmst_fk'];
                $expiryDt = $expDt['appdm_certificateexpiry'];
                $dayleft  = $expDt['dayleft'];
                    if ($dayleft == 30 || $dayleft == 23 || $dayleft == 16 || $dayleft == 9 || $dayleft == 0){
                      \api\components\Mail::getCertificatests($apptmpPk,$regPk,'remindermail'); 
                    }      
          }                 
        } 
         echo "Cron Run Successfully"; 
    } 
    
        public function actionSendexpiredmail(){
         
    
        $appliQuery = "SELECT DATEDIFF(curdate(),appdm_certificateexpiry) AS afterdays , appdm_opalmemberregmst_fk , applicationdtlstmp_pk , appdm_certificateexpiry from applicationdtlsmain_tbl
inner join applicationdtlstmp_tbl on applicationdtlsmain_tbl.appdm_applicationdtlstmp_fk = applicationdtlstmp_tbl.applicationdtlstmp_pk
where appdm_projectmst_fk=1";
        $expiryDt = \Yii::$app->db->createCommand($appliQuery)->queryAll();   
        if(!empty($expiryDt)&& count($expiryDt)>0){
            foreach ($expiryDt as $expDt) {
                $currentDate = date('Y-m-d');
                $apptmpPk = $expDt['applicationdtlstmp_pk'];
                $regPk = $expDt['appdm_opalmemberregmst_fk'];
                $expiryDt = $expDt['appdm_certificateexpiry'];
                $afterday  = $expDt['afterdays'];
                    if ($afterday == 7 || $afterday == 14 || $afterday == 21 || $afterday == 28 || $afterday == 30){
                      \api\components\Mail::getCertificatests($apptmpPk,$regPk,'expiredmail'); 
                    } 
                          
          }                 
        } 
         echo "Cron Run Successfully"; 
    }
    
         public function actionSendremcourmail(){
         
        //Send Reminder Mail to Training Evaluation Centre to renew the certificate
        $courseQuery = "SELECT DATEDIFF(appdm_certificateexpiry,curdate()) AS dayleft , appdm_opalmemberregmst_fk , applicationdtlstmp_pk , appdm_certificateexpiry from applicationdtlsmain_tbl
inner join applicationdtlstmp_tbl on applicationdtlsmain_tbl.appdm_applicationdtlstmp_fk = applicationdtlstmp_tbl.applicationdtlstmp_pk
where appdm_projectmst_fk in (2,3)";
        
      
        $expiryDt = \Yii::$app->db->createCommand($courseQuery)->queryAll();   
        if(!empty($expiryDt)&& count($expiryDt)>0){
            foreach ($expiryDt as $expDt) {
                $currentDate = date('Y-m-d');
                $apptmpPk = $expDt['applicationdtlstmp_pk'];
                $regPk = $expDt['appdm_opalmemberregmst_fk'];
                $expiryDt = $expDt['appdm_certificateexpiry'];
                $dayleft  = $expDt['dayleft'];
                
              
                    if ($dayleft == 30 || $dayleft == 23 || $dayleft == 16 || $dayleft == 9 || $dayleft == 0){
                      \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'crremindermail');
                    }      
          }                 
        } 
         echo "Cron Run Successfully"; 
    } 
    
    
      public function actionSendcourexpiredmail(){
         
    
        $courQuery = "SELECT DATEDIFF(curdate(),appdm_certificateexpiry) AS afterdays , appdm_opalmemberregmst_fk , applicationdtlstmp_pk , appdm_certificateexpiry from applicationdtlsmain_tbl
inner join applicationdtlstmp_tbl on applicationdtlsmain_tbl.appdm_applicationdtlstmp_fk = applicationdtlstmp_tbl.applicationdtlstmp_pk
where appdm_projectmst_fk in (2,3)";
        

        $expiryDt = \Yii::$app->db->createCommand($courQuery)->queryAll();   
        if(!empty($expiryDt)&& count($expiryDt)>0){
            foreach ($expiryDt as $expDt) {
                $currentDate = date('Y-m-d');
                $apptmpPk = $expDt['applicationdtlstmp_pk'];
                $regPk = $expDt['appdm_opalmemberregmst_fk'];
                $expiryDt = $expDt['appdm_certificateexpiry'];
                $afterday  = $expDt['afterdays'];
         
                    if ($afterday == 7 || $afterday == 14 || $afterday == 21 || $afterday == 28 || $afterday == 30){
                      \api\components\Mail::getPaymentSts($apptmpPk,$regPk,'crexpiredmail');
                    } 
                          
          }                 
        } 
         echo "Cron Run Successfully"; 
    }
    
    public function actionSendremivmsmail(){
         
        //Send Reminder Mail to Training Evaluation Centre to renew the certificate
        $ivmsQuery = "SELECT DATEDIFF(ivrd_dateofexpiry,curdate()) AS dayleft,ivmsvehicleregdtls_pk,ivrd_contpermailid,ivrd_dateofexpiry,ivrd_Installername from ivmsvehicleregdtls_tbl where ivrd_installationstatus = 3";
        
        
        $expiryDt = \Yii::$app->db->createCommand($ivmsQuery)->queryAll();   
        if(!empty($expiryDt)&& count($expiryDt)>0){
            foreach ($expiryDt as $expDt) {
                $dayleft  = $expDt['dayleft'];
                $userPk   = $expDt['ivrd_Installername'];
                 $data = [
                    'vehiclePk' => $expDt['ivmsvehicleregdtls_pk'],
                ];
                 $datamail = json_encode($data);
                  
                  if($expDt['ivrd_contpermailid'])
                  {
                      if ($dayleft == 30 || $dayleft == 23 || $dayleft == 16 || $dayleft == 9 || $dayleft == 0){
                       \api\components\Ivmsdevice::sendIvmsDeviceMail($userPk,'ivmsvehicleregremaindernearing',$datamail);
                     
                    }
                    else if($dayleft == -1)
                    {
                        \api\components\Ivmsdevice::sendIvmsDeviceMail($userPk,'ivmsvehicleregremainderexpired',$datamail);
                    }
                  }
                         
          }                 
        } 
         echo "Cron Run Successfully"; 
    } 
}