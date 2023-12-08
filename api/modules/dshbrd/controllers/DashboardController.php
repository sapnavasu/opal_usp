<?php
namespace api\modules\dshbrd\controllers;

use api\modules\pm\controllers\NbfMasterController;
use yii\web\Response;
use common\components\Products;
use common\components\AfterLogin;
use Yii;
use yii\db\ActiveRecord;
use app\models\DashboardcountmstTbl;


class DashboardController extends NbfMasterController
{
    
    public $modelClass = 'app\modules\nbf\models\MemcompprofcertfdtlsTbl';
    public $reg_id;
    public $companypk;
    public $userpk;
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [];
    }

    public function beforeAction($action)
    {
//        $reg_id = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
//        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
//        $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
//        self::setSession($reg_id,$companypk,$userpk);
        header('Content-type: application/json; charset=utf-8');
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }
    
    /**
     * This method is set company session values 
     * @param int reg_id in header, registerpk
     * @param int companypk in header, copanypk
     * @param int userpk in header, userpk
     */
    public function setSession($reg_id,$companypk,$userpk) {
        $this->reg_id = $reg_id;
        $this->companypk = $companypk;
        $this->userpk = $userpk;
    }
    
    
  
    public function actionGetCentredashboarddata() {
        
        $regpk  = \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $spdata =  \Yii::$app->db->createCommand("call sp_Centre_Dashboard(:p1)")
        ->bindValue(':p1' , $regpk);
        $results = $spdata->query();

        //print_r( $results);exit;
            
        $centredtls = $results->readAll();
        $results->nextResult();
        $trainingprovider = $results->readAll();
        $results->nextResult();
        $assessmentcentre= $results->readAll();
        $results->close();
         
       $dashboarddtls = \app\models\DashboardcountmstTbl::find()
               ->select('dcm_dashboardcount')
               ->where(['=','dcm_opalmemberreg',$regpk])
               ->orderBy('dashboardcountmst_pk DESC')
               ->asArray()
               ->one()['dcm_dashboardcount'];
      $dashboardCounts  = json_decode($dashboarddtls,true);
       
      $maintable_center = \app\models\ApplicationdtlsmainTbl::find()->where(['appdm_projectmst_fk'=>1,'appdm_opalmemberregmst_fk'=>$regpk])->asArray()->one();
      $maintable_ras = \app\models\ApplicationdtlsmainTbl::find()->where(['appdm_projectmst_fk'=>4,'appdm_opalmemberregmst_fk'=>$regpk])->asArray()->one();
      $maincentercertified = 'no';
      $rascentercertified = 'no';
       if(!empty($maintable_center)){
            $maincentercertified = 'yes';
        }
        if(!empty($maintable_ras)){
            $rascentercertified = 'yes';
        }
       $web = Yii::$app->params['website_url'];
       $dashboardData = [
           'centredtls' => $centredtls[0],
           'counts' => $dashboardCounts,
           'batchTPData' => $trainingprovider,
           'batchACData' => $assessmentcentre,
           'website_url' => $web,
           'maincentercertified'=>$maincentercertified,
           'rascentercertified'=>$rascentercertified
           
       ];
       
       return $dashboardData;
    }
    public function actionGettechnicaldashboarddata()
    {
        
        $prjpk = isset($_GET['prjPk']) ? $_GET['prjPk'] : 0;
        
        $regpk  = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        
            $techevalspdata = \Yii::$app->db->createCommand("call sp_Company_Dashboard(:p1,:p2)")
            ->bindValue(':p1' , $regpk)
            ->bindValue(':p2' , $prjpk);
            $techresult = $techevalspdata->query();
            
            $techcompnydtls = $techresult->readAll();
            $techresult->nextResult();
            $techroles = $techresult->readAll();
            $techresult->nextResult();
            $techbranches = $techresult->readAll();
            $techresult->close();
            
            foreach($techroles as $roles)
            {
                if($roles['roles'] == '16')
                {
                    $Roles['Inspector'] = $roles['Role_count'];
                }
                if($roles['roles'] == '17')
                {
                    $Roles['Verifier'] = $roles['Role_count'];
                }
                if($roles['roles'] == '18')
                {
                    $Roles['Superivisor'] = $roles['Role_count'];
                }
            }
            
          if($prjpk == 4)
          {
              $rasvehicledtls = \Yii::$app->db->createCommand("call sp_RAS_Dashboard(:p1)")
                ->bindValue(':p1' , $regpk);
                $rasData = $rasvehicledtls->query();

                $inspPending = $rasData->readAll();
                $rasData->nextResult();
                $veriPending = $rasData->readAll();
                $rasData->nextResult();
                $apprPending = $rasData->readAll();
                $rasData->nextResult();
                $counts = $rasData->readAll();
                $rasData->close();
          }
          
         
        $dashboardData = [
           'Roles' => $Roles,
           'company' => $techcompnydtls[0],
           'branchData' => $techbranches[0],
           'rasData' => [
               'inspection' => $inspPending,
               'verification' => $veriPending,
               'approval' => $apprPending,
               'counts' => $counts[0]
           ],
           
       ];
        
        
          return $dashboardData;   
        
    }
    
    public function actionGetAdmindashboarddata() {
        $usermstpk  = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $regpk  = \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $isadmin  = \yii\db\ActiveRecord::getTokenData('oum_isfocalpoint', true);
      
        if($isadmin == 1)
        {
            $spdata =  \Yii::$app->db->createCommand("call sp_Admin_Dashboard()");
            $results = $spdata->execute();
         
       $dashboarddtls = \app\models\DashboardcountmstTbl::find()
               ->select('dcm_dashboardcount')
               ->where(['=','dcm_dashboardtype','Admin Dashboard'])
               ->orderBy('dashboardcountmst_pk DESC')
               ->asArray()
               ->one()['dcm_dashboardcount'];
        }
        else
        {
            $spdata =  \Yii::$app->db->createCommand("call sp_AdminUser_Dashboard($usermstpk)");
            $results = $spdata->execute();
         
             $dashboarddtls = \app\models\DashboardcountmstTbl::find()
               ->select('dcm_dashboardcount')
               ->where(['=','dcm_dashboardtype','Admin User Dashboard'])
               ->orderBy('dashboardcountmst_pk DESC')
               ->asArray()
               ->one()['dcm_dashboardcount'];
        }
            
        
        
        
        
      $dashboardCounts  = json_decode($dashboarddtls,true);
      
       $dashboardData = [
           'counts' => $dashboardCounts, 
       ];
       
       return $dashboardData;
    }
    
    public function actionGetAdminRasdashboarddata() {
        $usermstpk  = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $prjpk = isset($_GET['prjPk']) ? $_GET['prjPk'] : 0;
        $spdata =  \Yii::$app->db->createCommand("call sp_AdminDashboard_TechnicalCentre(:p1, :p2)")
                ->bindValue(':p1' , $prjpk)
                ->bindValue(':p2' , $usermstpk);
        
        $results = $spdata->execute();
         
       $dashboarddtls = DashboardcountmstTbl::find()
               ->select('dcm_dashboardcount')
               ->where(['=','dcm_spname','sp_AdminDashboard_TechnicalCentre'])
               ->orderBy('dashboardcountmst_pk DESC')
               ->asArray()
               ->one()['dcm_dashboardcount'];

      $dashboardCounts  = json_decode($dashboarddtls,true);
     
      $counts = [
          'Desktop_Review'=> $dashboardCounts['Desktop_Review'] ,
          'Confirm_Payment'=> $dashboardCounts['Confirm_Payment'] ,
          'Ready_for_Audit' => $dashboardCounts['Ready_for_Audit'] ,
          'Audit_Report_Approval' => $dashboardCounts['Audit_Report_Approval'] 
      ];
      
      $invoicecounts = [
          'RF_due_amount_CP'=> $dashboardCounts['RF_due_amount_CP'] ,
          'RF_due_amount_YR'=> $dashboardCounts['RF_due_amount_YR'] ,
          'RF_Yet_to_Receive' => $dashboardCounts['RF_Yet_to_Receive'] ,
          'RF_totalamount_CP' => $dashboardCounts['RF_totalamount_CP'],
          'RF_totalamount_YR'=> $dashboardCounts['RF_totalamount_YR'] ,
          'Due_amount_CP_Centre'=> $dashboardCounts['Due_amount_CP_Centre'] ,
          'Due_amount_YR_centre' => $dashboardCounts['Due_amount_YR_centre'] ,
          'RF_Invoice_in_due_CP' => $dashboardCounts['RF_Invoice_in_due_CP'],
          'RF_Invoice_in_due_YR' => $dashboardCounts['RF_Invoice_in_due_YR'] ,
          'Yet_to_Receive_Centre' => $dashboardCounts['Yet_to_Receive_Centre'],
          'Total_amount_CP_Centre'=> $dashboardCounts['Total_amount_CP_Centre'] ,
          'Total_amount_YR_centre'=> $dashboardCounts['Total_amount_YR_centre'] ,
          'RF_Confirmation_pending' => $dashboardCounts['RF_Confirmation_pending'] ,
          'Invoice_in_due_CP_Centre' => $dashboardCounts['Invoice_in_due_CP_Centre'],
          'Invoice_in_due_YR_Centre' => $dashboardCounts['Invoice_in_due_YR_Centre'] ,
          'Confirmation_pending_Centre' => $dashboardCounts['Confirmation_pending_Centre']
          
      ];
         
      
       $dashboardData = [
           'counts' => $counts, 
           'invoicecounts' => $invoicecounts
       ];
       
       return $dashboardData;
    } 

    public function actionGetAdminuserdashboarddata() {
        
        $usermstpk  = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $spdata =  \Yii::$app->db->createCommand("call sp_AdminUser_Dashboard('$usermstpk')");
        $results = $spdata->execute();
//        $results->close();
         
       $dashboarddtls = \app\models\DashboardcountmstTbl::find()
               ->select('dcm_dashboardcount')
               ->where(['=','dcm_dashboardtype','Admin User Dashboard'])
               ->orderBy('dashboardcountmst_pk DESC')
               ->asArray()
               ->one()['dcm_dashboardcount'];
      $dashboardCounts  = json_decode($dashboarddtls,true);
      
       $dashboardData = [
           'counts' => $dashboardCounts, 
       ];
       
       return $dashboardData;
    }
    
    
    
}
