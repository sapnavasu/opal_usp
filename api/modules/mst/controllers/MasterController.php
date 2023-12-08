<?php

namespace api\modules\mst\controllers;

use Yii;
use api\modules\mst\models\CitymstTbl;
use api\modules\mst\models\CountryMaster;
use api\modules\mst\models\StatemstTbl;
use common\models\MembercompanymstTbl;
use common\models\BasemodulemstTbl;
use common\models\UsermstTbl;
use yii\rest\ActiveController;
use yii\web\Response;
use sizeg\jwt\JwtHttpBearerAuth;
use \common\components\Security;
use \api\modules\mst\components\Permission;


class MasterController extends ActiveController
{
    public $modelClass = 'api\modules\mst\models\CountryMaster';
    const WHITELISTED_CONTROLLERS = ['register','login','drive','country'];
    const WHITELISTED_FUNCTION = [
        'user/invitedtls',
        'reminder/sendremindermail',
        'reminder/sendexpiredmail',
        'reminder/sendcourexpiredmail',
        'reminder/sendremcourmail',
        'enterpriseadmin/getadmin',
        'reminder/remindermailexp',        'batchmanagement/checkavailabilityassessor',
        'ras/downloadgridata',
        'reminder/sendremivmsmail',   
        'device/downloadgridata',
        'device/mailcheck',
        'dashboard/get-centredashboarddata',
        'statemaster/statelistbycountry',
        'citymaster/getcitybystateid',
        'bussource/businesssourcelist',
        'timezone/timezonelist',
        'user/save-invited-user-dtls',
        'monitor/export-login-data',
        'monitor/export-activity-data',
        'afterlogin/generateinvoice',
         'batchmanagement/theory',
        'afterlogin/downloadinvoice',
        'afterlogin/downloadreceipt',
        'supplierstatistics/export-supplier-stat',
        'afterlogin/getsampletempfinlink',
        'afterlogin/onlinepayment',
        'svf/uplattach',
        'svf/saveimportownersid',
        'svf/downloadcomplist',
        'supplierstatistics/cron-stat-data',
        'approval/surveylistonregnew',
        'approval/surveylistonregold',
        'register/orderconfirmationsts',
        'register/expiry',
        'register/cancel-registration',
        'pms/successfesslisting',
        'svf/viewjsrspands',
        'afterlogin/downloadtaxinvoice',
        'afterlogin/downloadprotaxinvoice',
        'bizsearch/jsearchexportdata',
        'pms/downloadreceipt',
        'login/autoscfsubmitrenew',
        'login/autosezadsubmitrenew',
        'bizsearch/getdownloadfile',
        'svf/generatecertify',
        'afterlogin/getjsrscertificate',
        'afterlogin/getviewjsrscertificate',
        'afterlogin/getjsrsebadge',
        'menu/getmenulist',
        'menu/getj3links',
        'afterlogin/revertpayment',
        'afterlogin/viewcertificate',
        'afterlogin/updatepaymentstatus',
        'profile/downloadexcel',
        'profile/deleteexpiredfiles',
        'svf/getproductsummaryexport',
        'svf/getservicessummaryexport',
        'afterlogin/getjsrsproductsservices',
        'afterlogin/spresponse',
        'svf/viewcertificate',
        'svf/downloadsummary',
        'app-center/downloadlist',
        'app-center/coursedownloadlist',
        'assessmentreport/printcard',
        'assessmentreport/viewcard',
        'batchmanagement/downloadattend',
        'coursemanagement/downloaddata',  
        'mastercompanyprofile/contactusmasterdata',
        'app-center/userterevedtls',
        'coursemanagement/getcourse',
        'coursemanagement/getdocmstdata',
        'coursemanagement/getstaffsubcategory',
        'coursemanagement/savedocuments',
        'coursemanagement/getcustomcourse',
        'coursemanagement/getseccategory',
        'coursemanagement/getunit',
        'coursemanagement/getintnatrecogmst',
        'coursemanagement/getcountrymst',
        'coursemanagement/getstatemst',
        'coursemanagement/getcitymst',
        'coursemanagement/getstaffinfo',
        'coursemanagement/getstaffavialabe',
        'coursemanagement/checkcivilnum',
        'coursemanagement/applycertificate',
        'coursemanagement/savestaff',
        'coursemanagement/savestaffedu',
        'coursemanagement/savestaffwork',
        'coursemanagement/addcourse',
        'coursemanagement/saveinternational',
        'coursemanagement/getinterawardorgandata',
        'coursemanagement/stafffinalsave',
        'coursemanagement/staffconfigurationcheck',
        'coursemanagement/getsubactegoryarray',
        'coursemanagement/suspend',
        'coursemanagement/activate',
        'coursemanagement/getbatchids',
        'coursemanagement/getpaymentinfo',
        'coursemanagement/savepayment',
        'coursemanagement/getprojectinfo',
        'coursemanagement/submitdesktoreview',
        'coursemanagement/getdocumentdata',
        'coursemanagement/getroleforcourse',
        'coursemanagement/chechalredyapply',
        'coursemanagement/getinternational',
        'coursemanagement/getstaffgridlist',
        'coursemanagement/getstaffedu',
        'coursemanagement/getstaffwork',
        'coursemanagement/getbranchlistbyregpk',
        'coursemanagement/getfirstgrid',
        'coursemanagement/getaccessorscheduledtls',
        'coursemanagement/saveaccessorscheduledtls',
        'coursemanagement/updateaccessorscheduledtls',
        'coursemanagement/getalldata',
        'coursemanagement/interdelete',
        'coursemanagement/deletestaffgrid',
        'coursemanagement/deletestaffedu',
        'coursemanagement/deletestaffwork',
        'coursemanagement/getstaffdata',
        ''

        
    ];
    public function behaviors()
    {
        $behaviors = parent::behaviors();

//        $behaviors['authenticator'] = [
//            'class' => JwtHttpBearerAuth::class,
//            'optional' => [
//                'login','refresh','writeregjsonfile','removeregjsonfile','exportofflineregdata','countrylist','viewofflineregdata',
//                'savebuyer','savesupplier','saveprojowner','saveinvestor','getrightcardcounts','checkalreadyexists',
//                'getdefaultdept','getincorpstyle','webexhlist','timezonelist','invitedtls'
//            ],
//        ];
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Expose-Headers' => ['*']
            ],
        ];


        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }
    
    public function authenticate($user, $request, $response)
    {
        $authHeader = $request->getHeaders()->get('Authorization');
        if ($authHeader !== null && preg_match('/^' . $this->schema . '\s+(.*?)$/', $authHeader, $matches)) {
            $token = $this->loadToken($matches[1]);
            if ($token === null) {
                return null;
            }
            
            $identity = $token->getClaim('uid');

//            if ($this->auth) {
//                $identity = call_user_func($this->auth, $token, get_class($this));
//            } else {
//                $identity = $user->loginByAccessToken($token, get_class($this));
//            }

            return $identity;
        }

        return null;
    }

    public function beforeAction($action)
    {
        header("access-control-allow-origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header('Content-type: application/json; charset=utf-8');
        try {
            $postVar = Yii::$app->request->getRawBody();
            $params = json_decode($postVar);

            $userAccessCheck = $userAccessType = '';
            if(isset($_REQUEST['uac']) && !empty($_REQUEST['uac'])){
                $userAccessCheck = $_REQUEST['uac'];
            }elseif(isset($params->uac) && $params->uac){
                $userAccessCheck = $params->uac;
            }

//            $currentPage = strtolower(Yii::$app->controller->id . '/' . Yii::$app->controller->action->id);
//            if(!in_array(Yii::$app->controller->id, self::WHITELISTED_CONTROLLERS) && !in_array($currentPage,self::WHITELISTED_FUNCTION)){
//                
//               $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
//               $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
//               $userType =  \yii\db\ActiveRecord::getTokenData('oum_isfocalpoint', true);
//        
//
//                 $userrolePk = \app\models\OpalusermstTbl::find()
//                ->select(['oum_firstname', 'oum_emailid','opalusermst_pk','oum_rolemst_fk'])
//                ->where([
//                    'opalusermst_pk' => $userPk,
//                    'oum_status' => 'A',
//                ])
//                ->one();
//
//                $rolepk =  $userrolePk->oum_rolemst_fk;
//
//   
//
//               if ($userType == 2) {                
//                    if (!empty($userPk)) {
////                        $sql = " SELECT  rad_Access as access,omm_name_en as modules , opalmodulemst_pk as module_id  FROM Roleallocationdtls_tbl
////        LEFT JOIN opalmodulemst_tbl ON opalmodulemst_pk =  rad_OpalModuleMst_FK
////        WHERE rad_RoleMst_FK IN ($rolepk)";
////
////                        $model = \Yii::$app->db->createCommand($sql)->queryAll();
//                        
//                         $model = \app\models\OpalusermstTbl::getuseraccess($userPk);
//                        
//                        
//
////                         echo '<pre>';
////                         print_r($model);exit;
////                         die();
//
////                        if (!empty($model)) {
////                            foreach ($model as $key => $value) {
////                                $accessval = json_decode($value['access']);
////                                $access = json_decode($accessval);
////                                $response[$value['module_id']]['modules'] = $value['modules'];
////                                $response[$value['module_id']]['module_id'] = $value['module_id'];
////                                $response[$value['module_id']]['create'] = (in_array(1, $access) ? "Y" : "N");
////                                $response[$value['module_id']]['read'] = (in_array(2, $access) ? "Y" : "N");
////                                $response[$value['module_id']]['update'] = (in_array(3, $access) ? "Y" : "N");
////                                $response[$value['module_id']]['delete'] = (in_array(4, $access) ? "Y" : "N");
////                                $response[$value['module_id']]['approval'] = (in_array(5, $access) ? "Y" : "N");
////                                $response[$value['module_id']]['download'] = (in_array(6, $access) ? "Y" : "N");
////                                $i++;
////                            }
////                        }
//                        
//                        $response = [];
//
//                        foreach ($model as $moduleID => $submodules) {
//                            foreach ($submodules as $submoduleID => $submodule) {
//                                $modules = $submodule['modules'];
//                                $create = $submodule['create'];
//                                $read = $submodule['read'];
//                                $update = $submodule['update'];
//                                $delete = $submodule['delete'];
//                                $approval = $submodule['approval'];
//                                $download = $submodule['download'];
//
//                                $response[$submoduleID]['modules'] = $modules;
//                                $response[$submoduleID]['submodules'] = $modules;
//                                $response[$submoduleID]['module_id'] = $moduleID;
//                                $response[$submoduleID]['submodule_id'] = $submoduleID;
//                                $response[$submoduleID]['create'] = $create;
//                                $response[$submoduleID]['read'] = $read;
//                                $response[$submoduleID]['update'] = $update;
//                                $response[$submoduleID]['delete'] = $delete;
//                                $response[$submoduleID]['approval'] = $approval;
//                                $response[$submoduleID]['download'] = $download;
//                            }
//                        }
//
//                      
//
//
//                        
//                    }
//
//                                         
//                    $currenturl = strtolower(\Yii::$app->controller->id . '/' . \Yii::$app->controller->action->id);
//                    $permission = new Permission($response);
//                    
//                    if ($permission->isAccessGiven($currenturl, $response) == false) {
//                     
//                    } else {
//                        return parent::beforeAction($action);
//                    }
//                }
//            }
            return parent::beforeAction($action);
        }
        catch (BadRequestHttpException $e){}

    }

    public function actionGetmasterdata(){
        $type = filter_input(INPUT_GET,'type',FILTER_SANITIZE_STRING);
        $country_id = filter_input(INPUT_GET,'country_id',FILTER_SANITIZE_NUMBER_INT);
        $state_id = filter_input(INPUT_GET,'state_id',FILTER_SANITIZE_NUMBER_INT);
        $userpk = filter_input(INPUT_GET,'userpk',FILTER_SANITIZE_NUMBER_INT);
        $registerpk = filter_input(INPUT_GET,'registerpk',FILTER_SANITIZE_NUMBER_INT);
        switch ($type){
            case 'country';
                return CountryMaster::find()
                    ->select(['CountryMst_Pk as id' ,'CyM_CountryName_en as name'])
                    ->where(['CyM_Status' => 'A'])
                    ->orderBy(['CyM_CountryName_en' => SORT_ASC])
                    ->asArray()->all();
                break;
            case 'state':
                if (isset($_GET['custom'])) {
                    return StatemstTbl::find()
                        ->select(['StateMst_Pk as id', 'SM_StateName_en as name'])
                        ->where(['SM_CountryMst_Fk' => $country_id])
                        ->andWhere(' SM_Status =:SM_Status and SM_CreatedBy=:SM_CreatedBy',
                            [':SM_Status' => 'A',':SM_CreatedBy' => $userpk])
                        ->orderBy(['SM_StateName_en' => SORT_ASC])
                        ->asArray()->all();
                }
                return  StatemstTbl::find()
                        ->select(['StateMst_Pk as id','SM_StateName_en as name'])
                        ->where(['SM_CountryMst_Fk' => $country_id,'SM_Status' => 'A'])
                        ->orderBy(['SM_StateName_en' => SORT_ASC])
                        ->asArray()->all();
            case 'city':
                return CitymstTbl::find()
                    ->select(['CityMst_Pk as id','CM_CityName_en as name'])
                    ->where(['CM_Status' => 'A'])
                    ->andWhere(['CM_CountryMst_Fk' => $country_id,'CM_StateMst_Fk' => $state_id])
                    ->orderBy(['CM_CityName_en' => SORT_ASC])
                    ->asArray()->all();
            case 'user':
                return UsermstTbl::find()
                ->select(['UserMst_Pk as id','UM_EmpName as name'])
                ->leftJoin('userprofile_tbl','UserMst_Pk = UP_UserMst_FK')
                ->leftJoin('usrprofcontactdtls_tbl','UserMst_Pk = UPCD_UserMst_FK')
                ->where('UM_MemberRegMst_Fk = :memregpk',['memregpk' => $registerpk])
                ->orderBy(['UM_EmpName' => SORT_ASC])
                ->groupBy(['UserMst_Pk'])
                ->asArray()
                ->all();
            case 'company':
                return MembercompanymstTbl::find()
                    ->select(['MemberCompMst_Pk as id','MCM_CompanyName as name'])
                    ->leftJoin('memberregistrationmst_tbl','MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                    ->where('MRM_MemberStatus = :MRM_MemberStatus',[':MRM_MemberStatus' => 'A'])
                    ->orderBy(['MCM_CompanyName' => SORT_ASC])
                    ->groupBy(['MemberCompMst_Pk'])
                    ->asArray()
                    ->all();
			case 'companywithusers':
				return MemberCompanyMstTbl::getCompanyWithUsers();
            default:
                return true;
                break;
        }
    }

}
