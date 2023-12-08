<?php

namespace api\modules\lic\controllers;

use Yii;
use common\components\Common;
use yii\data\ActiveDataProvider;
use yii\rbac\Permission;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\pd\models\ProjectdtlsTbl;
use api\modules\mst\models\LicensauthoritiesmstTbl;
use api\modules\pd\models\ProjlicpermauthTbl;
use api\modules\lic\models\LicensetrackerTbl;
use api\modules\lic\models\LicensetrackerTblQuery;
use api\modules\lic\models\LicinvappliedTbl;
use api\modules\lic\models\LicinvappliedTblQuery;
use api\modules\lic\models\LicapprhstyTblQuery;
use common\components\Security;


class LicenseController extends ActiveController
{
    public $modelClass = 'api\modules\lic\models\LicensetrackerTbl';
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
    
    
    public function actionIndex(){
        return LicinvappliedTblQuery::index($_REQUEST);
    }
   
    public function actionFilter(){
        return LicinvappliedTblQuery::filterindex($_REQUEST);
    }
    public function actionLiaindex(){
        return LicinvappliedTblQuery::liaindex($_REQUEST);
    }
   
    public function actionLiafilter(){
        return LicinvappliedTblQuery::liafilterindex($_REQUEST);
    }

    public function actionHistory(){
        return LicapprhstyTblQuery::index(Security::decrypt($_GET['id']));
    }
    
    public function actionNoclist(){
       return \api\modules\mst\models\LicensinginfoTblQuery::noc_listing($_REQUEST);
    }
    
    public function actionNoccount(){
       return \api\modules\lic\models\LicinvappliedTblQuery::noclicencelistcount();
    }
    
    public function actionInvestorlist(){
       return \api\modules\lic\models\LicinvappliedTblQuery::investorlist();
    }
    
    public function actionLicensetitle(){
       return \api\modules\lic\models\LicinvappliedTblQuery::licensetitle_list();
    }
    
    public function actionLicenauthdtls(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $licinfoPk = Security::sanitizeInput($data['licinfoPK'],"number");
       return \api\modules\mst\models\LicensinginfoTblQuery::lic_auth_dtls($licinfoPk);
    }
    
    public function actionFilterinvestor(){
        return LicinvappliedTblQuery::filterinvestor();
    }
    public function actionFilterlicense(){
        return LicinvappliedTblQuery::filterlicense();
    }
    
    public function actionFilterproject(){
        return LicinvappliedTblQuery::filterproject();
    }

    public function actionPinnedlist(){
        return \api\modules\inv\models\LicprocedurepinupTblQuery::getpinnedlist($_REQUEST);
    }

    public function actionProjectlist(){
        return \api\modules\lic\models\LicinvappliedTblQuery::projectlist();
    }
    public function actionIndustrylist(){
        return \api\modules\mst\models\IndustrymstTbl::getindustrylist();
    }
    public function actionLicenselist(){
        return \api\modules\mst\models\LicensauthoritiesmstTbl::licAuthoritList();
    }
    public function actionUnpinlicense(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        return \api\modules\inv\models\LicprocedurepinupTblQuery::unpinlicense($pk);
     }
    public function actionAlllicenselist(){
        return LicinvappliedTblQuery::licencelist();
    }
    public function actionLicseclist(){
        return LicinvappliedTblQuery::licseclist();
    }
    public function actionIndexlic(){
        return LicinvappliedTblQuery::licindex($_REQUEST);
    }
    public function actionLicform(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        return LicinvappliedTblQuery::licform($data['form']);
    }
    public function actionLichistory(){ 
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        return LicapprhstyTblQuery::index($pk);
    }
    public function actionLicseclistcount(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $pk=Security::sanitizeInput($data['appliedpk'],'number');
        return LicapprhstyTblQuery::gethstrycount($pk);
    }
    public function actionGetlicauth(){
        $pk_dec = Security::decrypt($_REQUEST['pk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        return LicinvappliedTblQuery::getlicauth($pk);
    }
    
}
