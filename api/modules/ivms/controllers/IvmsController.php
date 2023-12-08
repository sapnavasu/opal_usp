<?php

namespace api\modules\ivms\controllers;
use setasign\Fpdi\Fpdi;
// require_once(__DIR__.'\fpdf\fpdf.php');
// require_once(__DIR__.'\fpdi\autoload.php');
use DateTime;
use DateTimeZone;
use Yii;
use api\modules\mst\controllers\MasterController;
use api\modules\center\controllers\AppCenterController;
use yii\data\ActiveDataProvider;

use app\models\StandardcoursemstTbl;
use app\models\CoursecategorymstTbl;
use app\models\StaffinforepoTbl;
use app\models\StaffacademicsTbl;
use app\models\StaffworkexpTbl;
use app\models\IntnatrecogmstTbl;
use app\models\AppcompanydtlstmpTbl;
use app\models\AppintrecogtmpTbl;
use app\models\ReferencemstTbl;
use app\models\ApplicationdtlstmpTbl;
use app\models\AppcoursedtlstmpTbl;
use app\models\AppcoursetrnstmpTbl;
use app\models\AppoffercoursemainTbl;
use app\models\opalcountrymsttbl;
use app\models\RolemstTbl;
use app\models\OpalstatemstTbl;
use  app\models\OpalcitymstTbl;
use app\models\AppoffercourseunitmainTbl;
use app\models\DocumentdtlsmstTbl;
use app\models\AppoprcontracttmpTbl;
use app\models\AppdocsubmissiontmpTbl;
use app\models\AppstafflocationtmpTbl;
use app\models\AppstaffscheddtlsTbl;
use app\models\AppstaffinfotmpTbl;
use app\models\ApppymtdtlstmpTbl;
use app\models\AppapprovalhdrTbl;
use app\models\OpalInvoiceTbl;
use \app\models\OpalusermstTbl;
use \app\models\AppstaffinfomainTbl;
use app\models\OpalmemberregmstTbl;
use \app\models\ProjapprovalworkflowdtlsTbl;
use app\models\StandardcoursedtlsTbl;
use app\models\AppintrecogmainTbl;
use api\modules\center\components\SiteAudit;
use app\models\AppinstinfomainTbl;
use app\models\BatchmgmtasmthdrTbl;
use app\models\BatchmgmtthyhdrTbl;
use app\models\BatchmgmtpracthdrTbl;
use app\models\StaffcourseconfigmstTbl;
use DatePeriod;
use api\modules\ivms\components\ivmsbusinesslogic;


class IvmsController extends MasterController 
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

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }
     public function actionGetmaincertificaterecored(){
    
        $data = ivmsbusinesslogic::getmain();
        return $data;
        
     }
     public function actionGetivmscompanydtls(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $userPk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        $applicationpk = $request['apppk'];

        $model = OpalusermstTbl::find()
            ->select(['oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2','omrm_cractivity','oum_projectmst_fk'])
            ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
            ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
            ->where('opalusermst_pk ='.$userPk)
            ->asArray()
            ->one();


        return $model;
     }
     public function actionSaveivmscompaydtls(){
     
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $save = ivmsbusinesslogic::savecompaydtls($request);

        return $save;
    }
    public function actionSaveivmsinstitue(){
     
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $save = ivmsbusinesslogic::saveivmsinstitue($request);
        
        return $save;

    }
    public function actionGetivmsinstituedata(){
        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);

        $data = \app\models\AppinstinfotmpTbl::find()->where(['appiit_applicationdtlstmp_fk' => $request['apppk']])->asArray()->one();

        return ['res'=>$data];
    }
    public function actionGetivmsgrid(){

        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = $request['limit'];
        $page = $request['page'];

        $query = ApplicationdtlstmpTbl::find()
        ->select('*')
        ->asArray()
        ->all();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                                'pageSize' =>$limit,
                                'page'=>$page
                            ]
                ]);
         
        $allrecords = $dataProvider->getModels();
        $total =$dataProvider->getTotalCount();
      }

      public function actionGetivmsoperatorgrid(){

        $request_body	= file_get_contents('php://input');
        $request = json_decode($request_body, true);

        $limit = $request['limit'];
        $page = $request['page'];
        $apppk = $request['apppk'];

        $query = AppoprcontracttmpTbl::find()
                    ->select(['*','DATE_FORMAT(appoprct_contstartdate,"%d-%m-%Y") AS start_date',
                    'DATE_FORMAT(appoprct_contenddate,"%d-%m-%Y") AS end_date',
                    'DATE_FORMAT(appoprct_createdon,"%d-%m-%Y") AS created_on',
                    'DATE_FORMAT(appoprct_createdon,"%d-%m-%Y") AS created_on',
                    'DATE_FORMAT(appoprct_appdecon,"%d-%m-%Y") AS appdecon'])
                    ->leftJoin('referencemst_tbl ref','ref.referencemst_pk = appoprcontracttmp_tbl.appoprct_operatorname')
                    ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appoprcontracttmp_tbl.appoprct_appdecby')
                    ->where("appoprct_applicationdtlstmp_fk =".$apppk);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                                'pageSize' =>$limit,
                                'page'=>$page
                            ]
                ]);
         
        $allrecords = $dataProvider->getModels();
        $total =$dataProvider->getTotalCount();

        return ['record'=> $allrecords ,'total' => $total];
      }
   
    
}