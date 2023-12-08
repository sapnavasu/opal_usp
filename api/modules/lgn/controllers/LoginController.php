<?php

namespace api\modules\lgn\controllers;

use app\filters\auth\HttpBearerAuth;
use common\models\UsermstTbl;
use Yii;


use yii\filters\auth\QueryParamAuth;
use yii\helpers\Json;
use yii\rbac\Permission;
use api\components\Configuration;
use yii\web\HttpException;
use sizeg\jwt\Jwt;
use yii\rest\Controller;
use \common\models\UsermstTblQuery;
use common\components\Drive;
use api\components\Common;
// use app\components\Security;
use api\components\Security;
use api\components\User;
use app\models\OpalmemberregmstTbl;
use app\models\OpalusermstTbl;
use app\models\OpaluserlogintrackTbl;
use app\models\ApplicationdtlstmpTbl;
use app\models\AppinstinfotmpTbl;

use app\models\OpalInvoiceTbl;
use app\models\CoursecategorymstTbl;
use app\models\AppoffercoursetmpTbl;
use app\models\ApplicationdtlsmainTbl;
use Da\QrCode\QrCode;
use app\models\RolemstTbl;
use app\models\StandardcoursemstTbl;
use app\models\AppoffercoursemainTbl;
use app\models\AppstaffinfotmpTbl;
use app\models\ApprasvehinspcattmpTbl;
use app\models\ProjectmstTbl;

class LoginController extends Controller
{
    public $modelClass = '\common\models\DepartmentmstTbl';

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
        /**/
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                // 'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                // 'Access-Control-Request-Headers' => ['*'],
                // 'Access-Control-Allow-Methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                // 'Allow' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                // 'Access-Control-Allow-Credentials' => null,
                // 'Access-Control-Max-Age' => 86400,
                // 'Access-Control-Expose-Headers' => []
            ],
        ];

        return $behaviors;
    }

    /**
     * Handle the login process for staff members for backend dashboard
     *
     * Request: POST /v1/staff/login
     *
     *
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionLogin()
    {
        $request_body = file_get_contents('php://input');
        // print_r($_REQUEST);exit;
        $data = json_decode($request_body, true);
        $data = $data['AdminLoginForm'];
          $token = $attemptCount = '';
          if(in_array($_REQUEST['apiFor'],['and','ios']) && ($_REQUEST['password']!='') ){
         $password =  base64_decode(htmlspecialchars_decode($_REQUEST['password']));
         $data['username']= $_REQUEST['username'];
         $data['userpk']= $_REQUEST['userpk'];
        
         $data['apiFor'] = trim($_REQUEST['apiFor']);
           }
        else{  
           $password = Security::aesdecrypt($data['password']);

          }
        
          

            $model = OpalusermstTbl::loginwithpass($data['userpk']);
            
            if($password != Security::aesdecrypt(trim($model['oum_password'])))
            { 
                $msg = 'Incorrect Password';
                $model['flag'] =null;
            }else{


            $model['flag'] ='S';
            $passexpdate =date("d-m-Y", strtotime($model['oum_passwordexpiry']));
           
            if($model['oum_passwordexpiry'] <= date('Y-m-d H:i:s')){
                $model['passwordexpaired'] = 'yes';
            }else{
                $model['passwordexpaired'] = 'no';
            }
               $logintrack =  new OpaluserlogintrackTbl;
                $device = $_SERVER["HTTP_USER_AGENT"];
                $isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows")); 
                $device= get_browser(null, true);

                $ip = ($_SERVER['REMOTE_ADDR']);
                $logintrack->oult_opalusermst_fk=$model['opalusermst_pk'];
                $logintrack->oult_loggedfrom=1;
                $logintrack->oult_devicename =$device['browser']." ".$device['version'];
                $logintrack->oult_loginstatus=1;
                $logintrack->oult_logintime=date('Y-m-d H:i:s');
                $logintrack->oult_devipaddr=$ip;
                if ($logintrack->save()) {

                } else {
                 
                  print_r($logintrack->getAttributes());
                  echo "MODEL NOT SAVED";
                  print_r($logintrack->getErrors());
                  exit;
                }
               
                $data = Configuration::getjson('Setting');
                $data = json_decode($data, true);
                
                $cdata = Configuration::getjson('Company');
                $cdata = json_decode($cdata, true);
                $prjData['projectname'] = Yii::$app->params['thisProjectName'];
            
                    $registrationdata = OpalmemberregmstTbl::find()->where('opalmemberregmst_pk = '.$model['oum_opalmemberregmst_fk'])->asArray()->one();
                    if(!empty($model['oum_userdp'])){
                        $dserdp = stripslashes(\api\components\Drive::generateUrl($model['oum_userdp'],$registrationdata['opalmemberregmst_pk'],$data['userpk'])); 
                        $registrationdata['companylogo']  = $dserdp ;
                    }

                    $tokenValues = array_merge($model,$registrationdata);
                  
                    $msg = "Logged In Successfully";
                    $status = 1;
                    
                    $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
                    /** @var Jwt $jwt */
                    $jwt = Yii::$app->jwt;
                    $token = $jwt->getBuilder()
                        ->setIssuer($_SERVER['SERVER_NAME'])// Configures the issuer (iss claim)
                        ->setAudience($_SERVER['SERVER_NAME'])// Configures the audience (aud claim)
                        ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
                        ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
                        ->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
                        ->set('uid', $tokenValues)// Configures a new claim, called "uid"
                        ->sign($signer, $jwt->key)// creates a signature using [[Jwt::$key]]
                        ->getToken(); // Retrieves the generated token
                     
                    
                    $refreshToken = $jwt->getBuilder()
                        ->setIssuer($_SERVER['SERVER_NAME'])// Configures the issuer (iss claim)
                        ->setAudience($_SERVER['SERVER_NAME'])// Configures the audience (aud claim)
                        ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
                        ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
                        ->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
                        ->set('uid', $tokenValues)// Configures a new claim, called "uid"
                        ->sign($signer, $jwt->key)// creates a signature using [[Jwt::$key]]
                        ->getToken(); // Retrieves the generated token

                // create record for app application tmp and Institute Information Table Starts
                //echo '<pre>';print_r($model);exit;

                $opalAppDtls = ApplicationdtlstmpTbl::find()->select(['*'])
                        ->where('appdt_opalmemberregmst_fk ='.$model['oum_opalmemberregmst_fk'].'  and appdt_projectmst_fk = 1')
                        ->asArray()
                        ->all();
               
                        // 1-opal star, 2.technical assessment, 3-both
                // if($model['omrm_intendforregistration'] == 2){
                //     $opalAppInsDtls = AppinstinfotmpTbl::find()->select(['*'])
                //     ->leftJoin('applicationdtlstmp_tbl','applicationdtlstmp_pk = appiit_applicationdtlstmp_fk')
                //     ->where('appiit_opalmemberregmst_fk ='.$model['oum_opalmemberregmst_fk'])
                //     ->andWhere('appiit_officetype = '.$model['omrm_officetype'])
                //     ->andWhere('appdt_projectmst_fk = 4')
                //     ->asArray()
                //     ->all();
                // }else{
                $opalAppInsDtls = AppinstinfotmpTbl::find()->select(['*'])
                        ->where('appiit_opalmemberregmst_fk ='.$model['oum_opalmemberregmst_fk'])
                        ->andWhere('appiit_officetype = 1')
                        ->asArray()
                        ->all();
                // }
                //echo '<pre>';print_r(count($opalAppInsDtls));exit;
// print_r($opalAppDtls);
// print_r($opalAppInsDtls);exit;
                if(empty($opalAppDtls) && empty($opalAppInsDtls)){
                   
                    $opalUserDtls = OpalusermstTbl::find()
                            ->select(['*','oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2'])
                            ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
                            ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
                            ->where('opalusermst_pk ='.$model['opalusermst_pk'])
                            ->asArray()
                            ->one();
                    //echo '<pre>';print_r($opalUserDtls);exit;        
                    $modelAppTbl = new ApplicationdtlstmpTbl();
                    $modelAppTbl->appdt_opalmemberregmst_fk = $opalUserDtls['oum_opalmemberregmst_fk'];
                    // if($model['omrm_intendforregistration'] == 2){
                    //     $modelAppTbl->appdt_projectmst_fk = 4;
                    //     $modelAppTbl->appdt_isprimarycert = 1;
                    // }else{
                        $modelAppTbl->appdt_projectmst_fk = 1;
                    // }
                    $modelAppTbl->appdt_appreferno = (string)1;
                    $modelAppTbl->appdt_apptype = 1;
                    //$model->appdt_appupdated=1;
                    $modelAppTbl->appdt_status = 1;
                    if($modelAppTbl->save()){
                        $modelComp = new \app\models\AppcompanydtlstmpTbl();
                        $modelComp->acdt_applicationdtlstmp_fk = $modelAppTbl->applicationdtlstmp_pk;
                        $modelComp->acdt_opalmemberregmst_fk = $opalUserDtls['regpk'];
                        $modelComp->acdt_opalusermst_fk = $opalUserDtls['opalusermst_pk'];
                        $modelComp->acdt_gmname = $opalUserDtls['gmname']? $opalUserDtls['gmname']:$opalUserDtls['oum_firstname'];
                        $modelComp->acdt_gmemailid =$opalUserDtls['gmaemailid']? $opalUserDtls['gmaemailid']:$opalUserDtls['oum_emailid'];
                        $modelComp->acdt_gmmobileno = $opalUserDtls['gmmobileno']? $opalUserDtls['gmmobileno']:$opalUserDtls['oum_mobno'];
                        $modelComp->acdt_gmmoherigrading = $opalUserDtls['omrm_opalmoherigradingmst_pk'];
                        $modelComp->acdt_addrline1 = $opalUserDtls['address1'];
                        $modelComp->acdt_addrline2 = $opalUserDtls['address2'];
                        $modelComp->acdt_statemst_fk = $opalUserDtls['omrm_opalstatemst_fk'];
                        $modelComp->acdt_citymst_fk = $opalUserDtls['omrm_opalcitymst_fk'];
                        $modelComp->acdt_createdon = date("Y-m-d H:i:s");
                        $modelComp->acdt_createdby = $opalUserDtls['opalusermst_pk'];
                        $modelComp->acdt_status = 1;
                        if($modelComp->save()){
                       
                            //ref no update starts
                            // if($modelAppTbl->appdt_projectmst_fk == 4){
                            //     $no = \app\models\ApplicationdtlstmpTbl::genRefNoras($opalUserDtls['oum_opalmemberregmst_fk'],$modelAppTbl->applicationdtlstmp_pk); 

                            // }else{
                                $no = \app\models\ApplicationdtlstmpTbl::genRefNo($opalUserDtls['oum_opalmemberregmst_fk'],$modelAppTbl->applicationdtlstmp_pk); 
                            // }
                            $appModel = \app\models\ApplicationdtlstmpTbl::find()->where(['applicationdtlstmp_pk' => $modelAppTbl->applicationdtlstmp_pk])->one();
                            $appModel->appdt_appreferno = (string)$no;
                            //echo '<pre>';print_r($appModel);exit;
                            if(!$appModel->save()){
                          
                                echo "<pre>";return $modelComp->getErrors();exit;
                            }

                            if(empty($opalAppInsDtls)){
                          
                                $modelIns = new \app\models\AppinstinfotmpTbl();
                                $modelIns->appiit_opalmemberregmst_fk = $opalUserDtls['oum_opalmemberregmst_fk'];
                                $modelIns->appiit_applicationdtlstmp_fk = $modelAppTbl->applicationdtlstmp_pk;
                                // if($model['omrm_intendforregistration'] == 2){
                                //     $modelIns->appiit_officetype = $model['omrm_officetype'];
                                // }else{
                                    $modelIns->appiit_officetype = 1;
                                // }
                                $modelIns->appiit_noofexpat = 0;
                                $modelIns->appiit_noofomani = 0;
                                $modelIns->appiit_loclatitude = "";
                                $modelIns->appiit_loclongitude = "";
                                $modelIns->appiit_locmapurl = "";
                                $modelIns->appiit_molpercent = 0;
                                $modelIns->appiit_nooftechstaff = 0;
                                $modelIns->appiit_noofcurlearners = 0;
                                $modelIns->appiit_maxcapacity = 0;
                                // if($model['omrm_intendforregistration'] == 2){
                                //     $modelIns->appiit_addrline1 = $opalUserDtls['address1'];
                                //     $modelIns->appiit_addrline2 = $opalUserDtls['address2'];
                                //     $modelIns->appiit_statemst_fk = $opalUserDtls['omrm_opalstatemst_fk'];
                                //     $modelIns->appiit_citymst_fk = $opalUserDtls['omrm_opalcitymst_fk'];
                                //     if($modelIns->appiit_officetype == 2){
                                //         $modelIns->appiit_branchname_en = $opalUserDtls['omrm_branchname_en'];
                                //         $modelIns->appiit_branchname_ar = $opalUserDtls['omrm_branchname_ar'];    
                                //     }
                                // }else{
                                    $modelIns->appiit_branchname_en = "";
                                    $modelIns->appiit_branchname_ar = "";
                                // }
                               
                                //$modelIns->appiit_statemst_fk = 0;
                                //$modelIns->appiit_citymst_fk = 0;
                                $modelIns->appiit_status = 1;
                                $modelIns->appiit_createdon = date("Y-m-d H:i:s");
                                $modelIns->appiit_createdby = $opalUserDtls['opalusermst_pk'];
                                
                                if(!$modelIns->save()){
                                    echo "<pre>";var_dump($modelIns->getErrors());exit;
                                }
                            }  
                            //ref no update ends
                            //return $model->applicationdtlstmp_pk;
                            
                        }else{
                            echo "<pre>";var_dump($modelComp->getErrors());exit;
                        }
            
                        
                    } else {
                        echo "<pre>";var_dump( $modelAppTbl->getErrors());exit;
                    }
                }
                // exit;
                //ras certification 
                $opalAppDtlsras = ApplicationdtlstmpTbl::find()->select(['*'])
                ->where('appdt_opalmemberregmst_fk ='.$model['oum_opalmemberregmst_fk'].' and appdt_projectmst_fk = 4')
                ->asArray()
                ->all();
                if(empty($opalAppDtlsras)){
                   
                    $opalUserDtls = OpalusermstTbl::find()
                            ->select(['*','oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2'])
                            ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
                            ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
                            ->where('opalusermst_pk ='.$model['opalusermst_pk'])
                            ->asArray()
                            ->one();
                    $modelAppTbl = new ApplicationdtlstmpTbl();
                    $modelAppTbl->appdt_opalmemberregmst_fk = $opalUserDtls['oum_opalmemberregmst_fk'];
                    $modelAppTbl->appdt_projectmst_fk = 4;
                    $modelAppTbl->appdt_appreferno = (string)1;
                    $modelAppTbl->appdt_apptype = 1;
                    $modelAppTbl->appdt_status = 1;
                    $modelAppTbl->appdt_isprimarycert = 1;
                    if($modelAppTbl->save()){
                        $modelComp = new \app\models\AppcompanydtlstmpTbl();
                        $modelComp->acdt_applicationdtlstmp_fk = $modelAppTbl->applicationdtlstmp_pk;
                        $modelComp->acdt_opalmemberregmst_fk = $opalUserDtls['regpk'];
                        $modelComp->acdt_opalusermst_fk = $opalUserDtls['opalusermst_pk'];
                        $modelComp->acdt_gmname = $opalUserDtls['gmname']? $opalUserDtls['gmname']:$opalUserDtls['oum_firstname'];
                        $modelComp->acdt_gmemailid = $opalUserDtls['gmaemailid']? $opalUserDtls['gmaemailid']:$opalUserDtls['oum_emailid'];
                        $modelComp->acdt_gmmobileno = $opalUserDtls['gmmobileno']? $opalUserDtls['gmmobileno']:$opalUserDtls['oum_mobno'];
                        $modelComp->acdt_gmmoherigrading = $opalUserDtls['omrm_opalmoherigradingmst_pk'];
                        // for auto fetch
                        $modelComp->acdt_addrline1 = $opalUserDtls['address1'];
                        $modelComp->acdt_addrline2 = $opalUserDtls['address2'];
                        $modelComp->acdt_statemst_fk = $opalUserDtls['omrm_opalstatemst_fk'];
                        $modelComp->acdt_citymst_fk = $opalUserDtls['omrm_opalcitymst_fk'];
                         // for auto fetch end
                        $modelComp->acdt_createdon = date("Y-m-d H:i:s");
                        $modelComp->acdt_createdby = $opalUserDtls['opalusermst_pk'];
                        $modelComp->acdt_status = 1;
                        if($modelComp->save()){
                            //ref no update starts
                            $no = \app\models\ApplicationdtlstmpTbl::genRefNoras($opalUserDtls['oum_opalmemberregmst_fk'],$modelAppTbl->applicationdtlstmp_pk); 
                            $appModel = \app\models\ApplicationdtlstmpTbl::find()->where(['applicationdtlstmp_pk' => $modelAppTbl->applicationdtlstmp_pk])->one();
                            $appModel->appdt_appreferno = (string)$no;
                            //echo '<pre>';print_r($appModel);exit;
                            if(!$appModel->save()){
                                echo "<pre>";return $modelComp->getErrors();exit;
                            }

                            // if(empty($opalAppInsDtls)){
                                $modelIns = new \app\models\AppinstinfotmpTbl();
                                $modelIns->appiit_opalmemberregmst_fk = $opalUserDtls['oum_opalmemberregmst_fk'];
                                $modelIns->appiit_applicationdtlstmp_fk = $modelAppTbl->applicationdtlstmp_pk;
                                if($model['omrm_intendforregistration'] == 2){
                                    $modelIns->appiit_officetype = $model['omrm_officetype'];
                                }else{
                                    $modelIns->appiit_officetype = 1;
                                }
                                $modelIns->appiit_noofexpat = 0;
                                $modelIns->appiit_noofomani = 0;
                                $modelIns->appiit_loclatitude = "";
                                $modelIns->appiit_loclongitude = "";
                                $modelIns->appiit_locmapurl = "";
                                $modelIns->appiit_molpercent = 0;
                                $modelIns->appiit_nooftechstaff = 0;
                                $modelIns->appiit_noofcurlearners = 0;
                                $modelIns->appiit_maxcapacity = 0;
                                $modelIns->appiit_addrline1 = $opalUserDtls['address1'];
                                $modelIns->appiit_addrline2 = $opalUserDtls['address2'];
                                $modelIns->appiit_statemst_fk = $opalUserDtls['omrm_opalstatemst_fk'];
                                $modelIns->appiit_citymst_fk = $opalUserDtls['omrm_opalcitymst_fk'];
                                $modelIns->appiit_status = 1;
                                $modelIns->appiit_createdon = date("Y-m-d H:i:s");
                                $modelIns->appiit_createdby = $opalUserDtls['opalusermst_pk'];
                                if($modelIns->appiit_officetype == 2){
                                    $modelIns->appiit_branchname_en = $opalUserDtls['omrm_branchname_en'];
                                    $modelIns->appiit_branchname_ar = $opalUserDtls['omrm_branchname_ar'];    
                                }
                                
                                if(!$modelIns->save()){
                                    echo "<pre>";var_dump($modelIns->getErrors());exit;
                                }
                            // }  
                            //ref no update ends
                            //return $model->applicationdtlstmp_pk;
                            
                        }else{
                            echo "<pre>";var_dump($modelComp->getErrors());exit;
                        }
            
                        
                    } else {
                        echo "<pre>";var_dump( $modelAppTbl->getErrors());exit;
                    }
                }
                $opalAppDtlsras = ApplicationdtlstmpTbl::find()->select(['*'])
                ->where('appdt_opalmemberregmst_fk ='.$model['oum_opalmemberregmst_fk'].' and appdt_projectmst_fk = 5')
                ->asArray()
                ->all();
                if(empty($opalAppDtlsras)){
                   
                    $opalUserDtls = OpalusermstTbl::find()
                            ->select(['*','oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2'])
                            ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
                            ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
                            ->where('opalusermst_pk ='.$model['opalusermst_pk'])
                            ->asArray()
                            ->one();
                    $modelAppTbl = new ApplicationdtlstmpTbl();
                    $modelAppTbl->appdt_opalmemberregmst_fk = $opalUserDtls['oum_opalmemberregmst_fk'];
                    $modelAppTbl->appdt_projectmst_fk = 5;
                    $modelAppTbl->appdt_appreferno = (string)1;
                    $modelAppTbl->appdt_apptype = 1;
                    $modelAppTbl->appdt_status = 1;
                    $modelAppTbl->appdt_isprimarycert = 1;
                    if($modelAppTbl->save()){
                        $modelComp = new \app\models\AppcompanydtlstmpTbl();
                        $modelComp->acdt_applicationdtlstmp_fk = $modelAppTbl->applicationdtlstmp_pk;
                        $modelComp->acdt_opalmemberregmst_fk = $opalUserDtls['regpk'];
                        $modelComp->acdt_opalusermst_fk = $opalUserDtls['opalusermst_pk'];
                        $modelComp->acdt_gmname = $opalUserDtls['gmname']? $opalUserDtls['gmname']:$opalUserDtls['oum_firstname'];
                        $modelComp->acdt_gmemailid = $opalUserDtls['gmaemailid']? $opalUserDtls['gmaemailid']:$opalUserDtls['oum_emailid'];
                        $modelComp->acdt_gmmobileno = $opalUserDtls['gmmobileno']? $opalUserDtls['gmmobileno']:$opalUserDtls['oum_mobno'];
                        $modelComp->acdt_gmmoherigrading = $opalUserDtls['omrm_opalmoherigradingmst_pk'];
                        // for auto fetch
                        $modelComp->acdt_addrline1 = $opalUserDtls['address1'];
                        $modelComp->acdt_addrline2 = $opalUserDtls['address2'];
                        $modelComp->acdt_statemst_fk = $opalUserDtls['omrm_opalstatemst_fk'];
                        $modelComp->acdt_citymst_fk = $opalUserDtls['omrm_opalcitymst_fk'];
                         // for auto fetch end
                        $modelComp->acdt_createdon = date("Y-m-d H:i:s");
                        $modelComp->acdt_createdby = $opalUserDtls['opalusermst_pk'];
                        $modelComp->acdt_status = 1;
                        if($modelComp->save()){
                            //ref no update starts
                            $no = \app\models\ApplicationdtlstmpTbl::genRefNoivms($opalUserDtls['oum_opalmemberregmst_fk'],$modelAppTbl->applicationdtlstmp_pk); 
                            $appModel = \app\models\ApplicationdtlstmpTbl::find()->where(['applicationdtlstmp_pk' => $modelAppTbl->applicationdtlstmp_pk])->one();
                            $appModel->appdt_appreferno = (string)$no;
                            //echo '<pre>';print_r($appModel);exit;
                            if(!$appModel->save()){
                                echo "<pre>";return $modelComp->getErrors();exit;
                            }

                            // if(empty($opalAppInsDtls)){
                                $modelIns = new \app\models\AppinstinfotmpTbl();
                                $modelIns->appiit_opalmemberregmst_fk = $opalUserDtls['oum_opalmemberregmst_fk'];
                                $modelIns->appiit_applicationdtlstmp_fk = $modelAppTbl->applicationdtlstmp_pk;
                                if($model['omrm_intendforregistration'] == 2){
                                    $modelIns->appiit_officetype = $model['omrm_officetype'];
                                }else{
                                    $modelIns->appiit_officetype = 1;
                                }
                                $modelIns->appiit_noofexpat = 0;
                                $modelIns->appiit_noofomani = 0;
                                $modelIns->appiit_loclatitude = "";
                                $modelIns->appiit_loclongitude = "";
                                $modelIns->appiit_locmapurl = "";
                                $modelIns->appiit_molpercent = 0;
                                $modelIns->appiit_nooftechstaff = 0;
                                $modelIns->appiit_noofcurlearners = 0;
                                $modelIns->appiit_maxcapacity = 0;
                                $modelIns->appiit_addrline1 = $opalUserDtls['address1'];
                                $modelIns->appiit_addrline2 = $opalUserDtls['address2'];
                                $modelIns->appiit_statemst_fk = $opalUserDtls['omrm_opalstatemst_fk'];
                                $modelIns->appiit_citymst_fk = $opalUserDtls['omrm_opalcitymst_fk'];
                                $modelIns->appiit_status = 1;
                                $modelIns->appiit_createdon = date("Y-m-d H:i:s");
                                $modelIns->appiit_createdby = $opalUserDtls['opalusermst_pk'];
                                if($modelIns->appiit_officetype == 2){
                                    $modelIns->appiit_branchname_en = $opalUserDtls['omrm_branchname_en'];
                                    $modelIns->appiit_branchname_ar = $opalUserDtls['omrm_branchname_ar'];    
                                }
                                
                                if(!$modelIns->save()){
                                    echo "<pre>";var_dump($modelIns->getErrors());exit;
                                }
                            // }  
                            //ref no update ends
                            //return $model->applicationdtlstmp_pk;
                            
                        }else{
                            echo "<pre>";var_dump($modelComp->getErrors());exit;
                        }
            
                        
                    } else {
                        echo "<pre>";var_dump( $modelAppTbl->getErrors());exit;
                    }
                }

                //$opalUserDtls['cr_expiry'] = date("Y-m-d", strtotime($model['cr_expiry']));
                //$opalUserDtls['opalmem_expiry'] = date("Y-m-d", strtotime($model['opalmem_expiry']));
                //$opalUserDtls = OpalmemberregmstTbl::getAppRegDtls();
                //echo '<pre>';print_r($opalUserDtls);exit;
                // create record for app application tmp and Institute Information Table Ends   
                    
            //Mobile Service//
            if(in_array($_REQUEST['apiFor'] ,['and','ios']) && $password != Security::aesdecrypt(trim($model['UM_Password'])) ){
             if($model['um_loginattempt']==(Yii::$app->params['loginattemptcount']-3) && in_array($_REQUEST['apiFor'] ,['and','ios'])){
                $msg = 'You have '.(Yii::$app->params['loginattemptcount']-3).' out of '.Yii::$app->params['loginattemptcount'].' login attempts left, after which you will be locked out of the portal. You can try to login after 1 day';
            }else if($model['um_loginattempt']==(Yii::$app->params['loginattemptcount']-2) && in_array($_REQUEST['apiFor'] ,['and','ios']))
            {
                $msg ='You have '.(Yii::$app->params['loginattemptcount']-2).' out of '.Yii::$app->params['loginattemptcount'].' login attempts left, after which you will be locked out of the portal. You can try to login after 1 day';
                
            } else if($model['flag'] == 'AO' && $model['um_loginattempt']>=(Yii::$app->params['loginattemptcount']-2)&& in_array($_REQUEST['apiFor'] ,['and','ios'])){
                $msg = 'You have been locked out of JSRS since you have used all your attempts to log in. Please try again later';
              }  
            }
            //Mobile Dashboard Data starts here//
            $baseUrl = \Yii::$app->params['APP_URL'];
            $cmpPk = $model['comp_pk'];
            $userPk = $model['user_pk'];
            $dash_banner_img  = stripslashes($baseUrl."frontend/web/assets/mobile-ban-image.png");
            $readmore_link = $baseUrl;
            $flag = stripslashes($baseUrl."app/assets/images/flags/".$model['company_country'].".png") ;
            if($model['MRM_ValSubStatus']=='A')  
            {
            $jsrs = 'JSRS Supplier code:';
            $code = $model['suppliercode'];
            }
            else 
            {
            $jsrs = 'JSRS Registration No:';
            $code = $model['mcm_RegistrationNo'];
            }
        
         //SCF Verified or not
         if(in_array($_REQUEST['apiFor'] ,['and','ios']) && !empty($userPk) && !empty($cmpPk))
         {
         $scfchk = Yii::$app->db->createCommand("SELECT * FROM `suppcertformmembtmp_tbl` as SCF 
         LEFT JOIN `membercompanymst_tbl` as MCM ON SCF.`scfmt_membercompmst_fk` =MCM.MemberCompMst_Pk  WHERE SCF.`scfmt_membercompmst_fk`=$cmpPk AND SCF.`scfmt_submittedby`= $userPk AND SCF.`scfmt_scfstatus`='I' ")->queryAll();  

          $dserdp = stripslashes(\api\components\Drive::generateUrl($model['user_logo'],$cmpPk,$userPk)); 
         }
         //AND MCM.MCM_Origin = 'N'
         if(empty($scfchk))
         {
         $dbdata["svdisable"] = TRUE;
         $dbdata["svmessage"] = 'SVF not verified';
         }else{
        $dbdata["svdisable"] = FALSE;
        $dbdata["svmessage"] = 'SVF Verified';
         }
          if(!empty($model) && in_array($_REQUEST['apiFor'] ,['and','ios']))
             {   
                $dbdata['dash_ban_img'] = $dash_banner_img;
                $dbdata['read_link'] = $readmore_link;
                $dbdata['user_name'] = $model['user_name'];
                $dbdata['designation'] = $model['designation'];
                $dbdata['company_name'] = $model['company_name'];
                $dbdata['company_country'] = $flag;
                $dbdata['jsrs_code'] = $jsrs.$code;
                $dbdata['expiry_date'] = $model['mcm_accexpirydate'];
                $dbdata['profile_pic'] = preg_replace('/\\\\/', '', $dserdp);
                $dbdata['useremail'] =$model['UM_EmailID'];
             }
             //End Mobile Dashboard Data starts here//
            //End Mobile Service//
            
            $model['otpid'] =($model['otpfor']==1)? Common::maskemail($model['UM_EmailID']) : Common::maskmobilenum($model['um_primobno']) ;
            if(!empty($model['um_2freminder'])&& $model['um_2freminder'] === date('Y-m-d'))
            {
               $ifremind = 1;
            }
            else
            {
               $ifremind = 0; 
            }

            

        }

            
    return $this->asJson([
                'msg' => $msg ?? "failure",
                'status' => $status ?? 0,
                'regstatus' => $model['reg_status'],
                'expiry' => $model['expiry'],
                'flag' => $model['flag'],
                'showRenewalPopup' => $model['showRenewalPopup'],
                'expdays' => $model['expdays'],
                'sub_period_end' => $model['sub_period_end'],
                'deactivation_period' => $model['deactivation_period'],
                'beforeexpdays' => $model['beforeexpdays'],
                'graceperiod' => $model['graceperiod'],
                'graceperiodend' => $model['graceperiodend'],
                'inactivationperiod' => $model['inactivationperiod'],
                'nearingexpiry' => $model['nearingexpiry'],
                'MRM_RenewalStatus' => $model['MRM_RenewalStatus'],
                'regType' => $model['reg_type'],
                'pk' => Security::encrypt($model['userpk']) ?? '',
                'enuserpk'=> Security::encrypt($model['UserMst_Pk']) ?? '',
                't' => explode('&t=',$usermodel->um_pwdresetlink)[1] ?? '',
                'passexpdate' =>  $passexpdate,
                'f'=> '',
                'loginattempt'=> $model['um_loginattempt'],
                'attemptCount'=> $model['um_fgtpasswordattempt'], 
                'token' => (string)$token,
                'refreshToken' => (string)$refreshToken,
               'j2link'=>$j2link,
               'dashbrd_data'=>$dbdata,
               'isotpenable'=>$model['um_2fkey'],
               'otpfor'=>$model['otpfor'],
               'otpid'=>$model['otpid'],
               'otpverified'=>$model['otpforverified'],
               'otp'=>$model['otp'],
               'otpexpiry'=>$model['otpexpiry'],
               'remider'=>$ifremind,
               'passwordexpired'=>$model['passwordexpaired']
            ]);
//        }else{
//            return [ 'title' => 'Warning!', 'msg' => 'There was a problem with your login. Please try again.', 'status' => 0, 'flag' => 'C' ];
//        }
        
    }


    /**
     * Return list of available permissions for the staff.  The function will be called when staff form is loaded in backend.
     *
     * Request: GET /v1/staff/get-permissions
     *
     * Sample Response:
     * {
     *        "success": true,
     *        "status": 200,
     *        "data": {
     *            "manageSettings": {
     *                "name": "manageSettings",
     *                "description": "Manage settings",
     *                "checked": false
     *            },
     *            "manageStaffs": {
     *                "name": "manageStaffs",
     *                "description": "Manage staffs",
     *                "checked": false
     *            }
     *        }
     *    }
     */
    public function actionGetPermissions()
    {
        $authManager = Yii::$app->authManager;

        /** @var Permission[] $permissions */
        $permissions = $authManager->getPermissions();

        /** @var array $tmpPermissions to store list of available permissions */
        $tmpPermissions = [];

        /**
         * @var string $permissionKey
         * @var Permission $permission
         */
        foreach ($permissions as $permissionKey => $permission) {
            $tmpPermissions[] = [
                'name' => $permission->name,
                'description' => $permission->description,
                'checked' => false,
            ];
        }

        return $tmpPermissions;
    }

    public function actionOptions($id = null)
    {
        return "ok";
    }

    public function actionList()
    {

        return "osdfsdf fdfk";
    }
    
    public function actionGetusers()
    {   
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $data = $requestdata['formdata'];
        $loginid = $data['username'];
        $type = $data['type'];
   if(!empty($loginid)){
        $model = OpalusermstTbl::login($loginid);
   
        if(!$model)
        {
            $msg = 'this login id or email id is not registered with our system';
            $data = null;
            $flag = "NR";
        }elseif(count($model)>1){
          
            // $dataarr =[];
          
            foreach($model as $key => $data){
               
                if(!empty($data['oum_rolemst_fk'])){
                  
                $role = RolemstTbl::find()->select('group_concat(rm_rolename_ar) as rmar , group_concat(rm_rolename_en) as rmen')->where('rolemst_pk in ('.$data['oum_rolemst_fk'].')')->asArray()->one();
                }
                $memberreg = \app\models\OpalmemberregmstTbl::find()
                ->select(['omrm_companyname_en','omrm_companyname_ar'])
                ->where(['opalmemberregmst_pk' =>$data['oum_opalmemberregmst_fk']])
                ->asArray()->one();
           
                $model[$key]['rmen'] = $role['rmen'];
                $model[$key]['rmar'] = $role['rmar'];
                $model[$key]['compen'] = $memberreg['omrm_companyname_en'];
                $model[$key]['compar'] = $memberreg['omrm_companyname_ar'];
                $model[$key]['oum_password'] = null;
                $model[$key]['maskedemail'] =  Common::maskemail($data['oum_emailid']);
                // array_push($dataarr, ['pk'=>$data['opalusermst_pk'],'name' => $data['oum_firstname'], 'rm_ar' => $role['rmar'], 'rm_en' =>$role['rmen']]);
         
                $msg = 'mullti';
                $data = $model;
                $flag = "ml";
            }
           
        }
        elseif(count($model) == 1)
        { 
         
                $data['maskedemail'] = Common::maskemail($model[0]['oum_emailid']);
                if(!$model[0]['oum_password'])
                {
       
                   $data['pk'] = $model[0]['opalusermst_pk'];
                   $data['email']=  $model[0]['oum_emailid'];
                   $msg = "Set Password";
                   $flag = "SP";
                }
                else
                {
                $msg = null;
         
                $data['pk'] = $model[0]['opalusermst_pk'];
                $data['email']=  $model[0]['oum_emailid'];
                $flag = "SR";
                }
       
            
        }
   
      
        return $this->asJson([ 
             'msg'=>$msg,
             'data'=>$data,
             'flag'=>$flag
                 ]);
    }else{
        return "illegal access";
    }
    }
    public function actionForgotpassword()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
         
        $email = $data['forgotmail']['email'];
        if (empty($email)) {
            return [
                "msg" => "Provide Email ID",
                "status" => 0
            ];
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                "msg" => "Invalid Email ID",
                "status" => 0
            ];
        }
        if (!empty($email)) {
            $userDtls = UsermstTblQuery::getUserByEmail($email);
            //print_r($userDtls);die;
            if (!isset($userDtls['flag'])) {
                return [
                    "msg" => "success",
                    "status" => 1,
                    "userlist" => $userDtls
                ];
            } else {
                return [
                    "msg" => "success",
                    "status" => $userDtls['msg'],
                    'flag' => $userDtls['flag'],
                ];
            }


        }
    }

    public function actionMailtest()
    {
        $campaign = new \app\modules\mailer\components\Campaign;
        $res = $campaign->mailtest();
    }

    public function actionGetuserdata()
    {

        if (isset($_GET['token']) && is_string($_GET['token'])) {
            $decryptuserpk = \common\components\Common::decrypt($_GET['token']);
          $usermodel = UsermstTbl::find()
                ->select(['UserMst_Pk', 'UM_EmailID'])
                ->where(['UserMst_Pk' => $decryptuserpk])
                ->andWhere(['not', ['UM_fgtpwdkey' => null]])
                ->asArray()->one();
            if ($usermodel) {
                $data = $usermodel;
            } else {
                $data = [];
            }
            return json_encode($data);
        }
    }
    
    public function actionGetusersbyemail(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
          if (isset($_REQUEST['email'])){ 
            $type = $_REQUEST['type'];
            $pk = $_REQUEST['pk'];
             $dtl = UsermstTbl::getUserDtlbyEmailandPk($email,$pk,$type);   
         
         }
        else
        {  
            $email = $data['email'];
            $type = $data['type'];
            $pk = $data['pk'];
          
            $dtl = UsermstTbl::getUserDtlbyEmailandPk($email,$pk,$type);   
        }
        if(!empty($dtl))
        {
            if(count($dtl) <= 1)
            {
                $model = UsermstTbl::findOne( $dtl[0]['UserMst_Pk']);
                $model->um_fgtpasswordattempt = null;
                $model->um_fgtpasswordattempton = date('Y-m-d H:i:s');
                $model->um_pwdresetlink = null;
                if($model->save())
                {
                   $msg['msg'] = "SR";
                $msg['email'] = $dtl[0]['email'];
                $msg['origin'] = $dtl[0]['origin'];
                $msg['status'] = 1; 
                $msg['id'] = $dtl[0]['UserMst_Pk']; 
                }
                else
                {
                    echo "<pre>";
                    var_dump($model->getErrors());
                    exit;
                }
                       
                
            }
            else
            {
                $msg['msg'] = "MR";
                $msg['status'] = 1; 
                foreach ($dtl as $detail)
                {
                    $msg['userlist'][]=$detail;
                }
            }
            
        }
        else if(empty($dtl) && ($_REQUEST['apiFor'] == "and" || $_REQUEST['apiFor'] == "ios")){
            $msg['msg'] = 'This email id/username/mobile is not registered with us.';
            $msg['status'] = 0; 
          }
        else{
            $msg['msg'] = 'Incorrect Email ID';
            $msg['status'] = 0;
            }
           
             return $this->asJson($msg);
    }
    
    public function actionSendforgotpwdmail(){  
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $email = $data['pk'];
       
        if(isset($email)){
            $model =  OpalusermstTbl::find()->where(['opalusermst_pk'=>$email])->one();
        }

       if(!empty($model)){
           
            $attemptLog = OpalusermstTbl::logForgotPasswordAttempt($model['opalusermst_pk'],$type); 
                OpalusermstTbl::sendForgotMail($model);
                
           
            $msg['msg'] = ($attemptLog !== 0) ? 'Forgot Mail Sent Successfully' : 'Limit Reached';
            $msg['status'] = ($attemptLog !== 0) ? 1 : 2; //2 - Limit Reached
            
                $msg['emailID'] = $attemptLog->oum_emailid;
            $msg['id'] = Security::encrypt($attemptLog->opalusermst_pk);
            $msg['attemptCount'] = $attemptLog->oum_fgtpasswordattempt;
            $msg['time'] = \Yii::$app->params['OTP']['setpassword']['expiryduration'];
          
          }
          else if(empty($dtl) && ($_REQUEST['apiFor'] == "and" || $_REQUEST['apiFor'] == "ios")){
            $msg['msg'] = 'This email id/username/mobile is not registered with us.';
            $msg['status'] = 0; 
          }
        else{
            $msg['msg'] = 'Incorrect Email ID';
            $msg['status'] = 0;
            }
            $msg['expdate']= $attemptLog['oum_otpexpiredon'];
        
         return $this->asJson($msg);
       
    }
    
    public function actionResetpassword(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
      if( !empty($_REQUEST['password']) && !empty($_REQUEST['userpk']))
      {
        $password = trim($_REQUEST['password']);
        $uuserpk = trim($_REQUEST['userpk']);
      }
      else{
        $password = $data['password'];
        $uuserpk = $data['userpk'];
        $type = $data['type'];
      }
        $userPk = Security::decrypt($uuserpk);
        $difffocal = $data['diff'];
        $resetPassword = OpalusermstTbl::resetPassword($password,$userPk,$type,$difffocal);
        if ($resetPassword === true){
            $msg['msg'] = 'Password reset successfully';
            $msg['status'] = 1;
        } else if ($resetPassword === "UN") {
            $msg['msg'] = 'Username cannot be a password';
            $msg['status'] = 2;
        } else if ($resetPassword === "LTP") {
            $msg['msg'] = 'Last 3 passwords cannot be reused';
            $msg['status'] = 3;
        } 
        return $this->asJson($msg);
    }
    
    public function actionSendotp(){
        
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        //echo '<pre>';print_r($data);exit;
        if(isset($_REQUEST['currentpassword']))
        {
        $currentpassword = ltrim($_REQUEST['currentpassword']);
        $userpk = ltrim($_REQUEST['userid']);
        }
        else{
            $currentpassword = $data['currentpassword'];
            $userpk = Security::decrypt($data['userpk']);
        }
       
        $msg['msg'] = 'Failure';
        $msg['status'] = 0;
        
        $checkAndSendOTP = User::sendOtpToChangePassword($userpk,$currentpassword,$data);
        
        if($checkAndSendOTP && $checkAndSendOTP === true){
            $msg['msg'] = 'OTP sent';
            $msg['status'] = 1;
            $model = OpalusermstTbl::findOne($userpk);
            if($data['otptype'] == 'email')
            {
              $msg['expiry'] =   $model->oum_otpexpiredon;
            }
            
        } else if ($checkAndSendOTP === "CNP") {
            $msg['msg'] = 'Current Password is wrong';
            $msg['status'] = 4;
        } else if ($checkAndSendOTP === "UN") {
            $msg['msg'] = 'Username cannot be a password';
            $msg['status'] = 2;
        } else if ($checkAndSendOTP === "LTP") {
            $msg['msg'] = 'Last 3 passwords cannot be reused';
            $msg['status'] = 3;
        }
        return $this->asJson($msg);
    }
    
    public function actionVerifyotp(){
        
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        //echo '<pre>';print_r($data);exit;
        if(isset($_REQUEST['OTP']))
        {
        $otp = ltrim($_REQUEST['OTP']);
        $userpk = ltrim($_REQUEST['userid']);
        }
        else{
            $otp = $data['OTP'];
            $userpk = Security::decrypt($data['userpk']);
        }
       
        $msg['msg'] = 'Failure';
        $msg['status'] = 0;
        
        $checkAndSendOTP = User::verifyOtpToChangePassword($userpk,$otp,$data);
       
        if($checkAndSendOTP && $checkAndSendOTP === true){
            $msg['msg'] = 'OTP sent';
            $msg['status'] = 1;
            if($data['otptype'] == 'email')
            {
              $msg['expiry'] =   $model->oum_otpexpiredon;
            }
            
        } else if ($checkAndSendOTP === "OTP-INVALID") {
            $msg['msg'] = 'Invalid OTP';
            $msg['status'] = 2;
        } else if ($checkAndSendOTP === "OTP-EXPIRED") {
            $msg['msg'] = 'OPT Expired';
            $msg['status'] = 3;
        }
        
        return $this->asJson($msg);
    }
    
    public function actionResendotp() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $userpk = Security::decrypt($data['userpk']);
        $model = UsermstTbl::findOne($userpk);
        
        if(isset($_REQUEST['newpassword']) && isset($_REQUEST['currentpassword']))
        {
        $currentpassword = ltrim($_REQUEST['currentpassword']);
        $newpassword = ltrim($_REQUEST['newpassword']);
        $userpk = ltrim($_REQUEST['userid']);
        }
        else{
            $currentpassword = $data['currentpassword'];
            $newpassword = $data['newpassword'];
            $userpk = Security::decrypt($data['userpk']);
        }
        $msg['msg'] = 'Failure';
        $msg['status'] = 0;
        $mailSend = User::sendOtpToChangePassword($userpk,$currentpassword,$newpassword,$data);
        if($mailSend  && $mailSend === true) {
            $msg['msg'] = 'OTP sent';
            $msg['status'] = 1;
            $model = UsermstTbl::findOne($userpk);
            if($data['otptype'] == 'email')
            {
              $msg['expiry'] =   $model->um_otpexpireson;
            }
            else
            {
               $msg['expiry'] =   $model->um_mobotpexpiry;
            }
            return $msg;
        }
        $msg['msg'] = 'Failure';
        $msg['status'] = 0;
        return $msg;
    }
    
    public function actionIsvalidlink(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        if(!empty($_REQUEST['userpk']) && !empty($_REQUEST['dt']) )
        {
           $userpk = trim($_REQUEST['userpk']);
           $dt = trim($_REQUEST['dt']);
            $userpk = Security::decrypt($userpk);
            $linkdate = Security::decrypt($dt);
        }else{
        $userpk = Security::decrypt($data['userpk']);
        $linkdate = Security::decrypt(urldecode($data['dt']));
        }
        $isValid = User::checkValidForgotPwdLink($userpk,$linkdate);
        $model = OpalusermstTbl::find()
        ->Where('opalusermst_pk =:userPk', array(':userPk' =>$userpk)) ->asArray() ->one();;
        if($isValid !== 2 && $isValid !== 3 && $isValid !== 5 && $isValid !== 4 ){
            $msg['msg'] = 'Active';
           
        }else if($isValid === 2){
            $msg['msg'] = 'Expired';
        }else if ($isValid === 3){
            $msg['msg'] = 'Already reset';
        }
        else if ($isValid === 5){
            $msg['msg'] = 'Deactivated';
        }
        else if ($isValid === 4){
            $msg['msg'] = 'Deleted';
        }
       
        $msg['status'] = $isValid;
        $msg['email']=$model['oum_emailid'];
        $msg['maskemail']= Common::maskemail($model['oum_emailid']);
        $msg['data']=$model['opalusermst_pk'];
        return $this->asJson($msg);
    }
    
    public function actionFgtotpverify(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        
        if(!empty($_REQUEST['userid']) && !empty($_REQUEST['otp']) && ($_REQUEST['apiFor']=='and'|| $_REQUEST['apiFor']=='ios') )
        {
        $userpk = trim($_REQUEST['userid']);
        $otp = trim($_REQUEST['otp']); 
        } 
        else{ 
        // $userpk = Security::decrypt($data['userpk']);
        $userpk= $data['userpk'];
        $otp = $data['otp'];
        $type = $data['type'];
        }
        // echo  $userpk;exit;
        $isValid = OpalusermstTbl::checkValidOTP($userpk,$otp,$type);
//        echo "<pre>";
//        var_dump($isValid);
//        exit;
//      
        $datamodel = OpalusermstTbl::findOne($userpk);
        
        if($isValid !== 2 && $isValid !== 3){
            $t = Security::encrypt($datamodel->oum_fgtpasswordattempton);
            $msg['msg'] = 'Active';
            $msg['userpk'] = $userpk  ;
            $msg['t'] = $t;
            $msg['f'] = '';
            $msg['en'] =  explode('&en=',$t)[1];
            $msg['status'] = 1;
            // $msg['frgtattempt'] = $datamodel->um_fgtpasswordattempt;
        }else if ($isValid == 2) {
            $msg['msg'] = 'Invalid OTP';
            $msg['status'] = 2;
            //  $msg['frgtattempt'] = $datamodel->um_fgtpasswordattempt;
        }else if ($isValid == 3) {
            $msg['msg'] = 'Expired OTP';
            $msg['status'] = 3;
        }
        if($_REQUEST['otp']=='' && ($_REQUEST['apiFor']=='and'|| $_REQUEST['apiFor']=='ios') ){
            $msg['msg'] = 'Please Enter OTP';
            $msg['status'] = 0;
            //  $msg['frgtattempt'] = $datamodel->um_fgtpasswordattempt;
        }
    return $this->asJson($msg);
    }
    
    public function actionValidateloginotp(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        
        if(!empty($_REQUEST['userid']) && !empty($_REQUEST['otp']) && ($_REQUEST['apiFor']=='and'|| $_REQUEST['apiFor']=='ios') )
        {
        $userpk = trim($_REQUEST['userid']);
        $otp = trim($_REQUEST['otp']); 
        } 
        else{ 
        $userpk = Security::decrypt($data['userpk']);
        $otp = $data['otp'];
        }
        $isValid = User::checkLoginOtp($userpk,$otp);
        $datamodel = UsermstTbl::findOne($userpk);
       
        if($isValid !== 2 && $isValid !== 3){
            $t = explode('&t=',$isValid)[1];
            $t = explode('&en=',$t)[0];
            $msg['msg'] = 'Active';
            $msg['userpk'] = $userpk  ;
            $msg['t'] = $t;
            $msg['f'] = '';
            $msg['en'] =  explode('&en=',$t)[1];
            $msg['status'] = 1;
            $msg['attempt'] = $datamodel->um_loginattempt;
        }else if ($isValid == 2) {
            $msg['msg'] = 'Invalid OTP';
            $msg['status'] = 2;
            $msg['attempt'] = $datamodel->um_loginattempt;
        }else if ($isValid == 3) {
            $msg['msg'] = 'Expired OTP';
            $msg['status'] = 3;
            $msg['attempt'] = $datamodel->um_loginattempt;
        }
        if($_REQUEST['otp']=='' && ($_REQUEST['apiFor']=='and'|| $_REQUEST['apiFor']=='ios') ){
            $msg['msg'] = 'Please Enter OTP';
            $msg['status'] = 0;
        }
    return $this->asJson($msg);
    }
    
    public function actionSendloginotp(){
        
         $request_body = file_get_contents('php://input');
         $data = json_decode($request_body, true);
         
         if(!empty($_REQUEST['pk']) && ($_REQUEST['apiFor']=='and'|| $_REQUEST['apiFor']=='ios') )
        {
        $userpk = trim($_REQUEST['pk']);
        } 
        else{ 
        $userpk = Security::decrypt($data['pk']);
        }
        
        $model = UsermstTbl::findOne($userpk);
        $mailSend = User::sendLoginOtp($userpk);
        
        if($mailSend && $mailSend['isSent'] === true){
            $msg['msg'] = 'OTP sent';
            $msg['status'] = 1;
            $msg['attempt'] = (int)$mailSend['attempt'];
            $msg['time'] = (int)$mailSend['duration'];
        }
        
        return $this->asJson($msg);  
    }
    
    public function isLoggedInWithNewIPorDevice($model) {
        $currentUserIpAddress = Common::getIpAddress();
        $trackDtls = \common\models\UserlogintrackTbl::getLoginTrackdtls($model['user_pk']);
        $ipAddressArr = array_column($trackDtls,'ult_devipaddr');
        
//        if(!in_array($currentUserIpAddress, $ipAddressArr)){
//            self::sendSuspisiousLoginMail($model);
//        }
        \common\models\UserlogintrackTbl::addUpdateLoginTrack($model, $currentUserIpAddress);
    }

    public function isLogInWithNewIPorDevice($model) {
        $currentUserIpAddress = Common::getIpAddress();
        $trackDtls = \common\models\UserlogintrackTbl::getLoginTrackdtls($model['user_pk']);
        $ipAddressArr = array_column($trackDtls,'ult_devipaddr');
        
//        if(!in_array($currentUserIpAddress, $ipAddressArr)){
//            self::sendSuspisiousLoginMail($model);
//        }
        \common\models\UserlogintrackTbl::addUpdateLgnTrack($model, $currentUserIpAddress);
        
    }
    
    public function sendSuspisiousLoginMail($model) {
        $content = "Hi {$model['user_name']}, You have recently logged in with new device or ip.<br> If it was not done by you. Kindly contact the support team.<br> Thanks";
        return \Yii::$app->mailer->compose()
                ->setFrom('noreply@businessgateways.com')
                ->setTo(\Yii::$app->params['testMailIDs'])
                ->setSubject('Security Warning - Sign in with new IP')
                ->setHTMLBody($content)
                ->send();
    }
    
    public function sendDiffCountryMail($userPk,$countrycode) {
       $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
            'type'=> 'logindiffcountrymailcontent',
            'userpk'=>$userPk,
            'location'=>$countrycode,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POSTFIELDS => json_encode($_data),
                CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/json",
                ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }
     public function sendDiffCountryLoginMailToAdmin($userpk,$location) {
       $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        $_data=[
            'type'=> 'loginadminusermailcontent',
            'userpk'=>$userpk,
            'location'=>$location,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POSTFIELDS => json_encode($_data),
                CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/json",
                ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }
    
    public function actionAcceptreg(){
        ini_set('max_execution_time', 0);
        $reg_pk = Security::decrypt($_REQUEST['reg_pk']);
        $user_info = UsermstTbl::find()->where(['UM_MemberRegMst_Fk' => $reg_pk,'um_primarycontact' => 1])->one();
        $emailid = $user_info->UM_EmailID;
        $userPk = $user_info->UserMst_Pk;
        $reg_info = \common\models\MemberregistrationmstTbl::findOne($reg_pk);
        $isLinkNotExpired = self::checkLinkExpiry($reg_info->MRM_CreatedOn);
        if($reg_info->MRM_OrderConfrmStat == 'N' && $isLinkNotExpired) {
            $reg_info->MRM_MemberStatus = 'V';
            $reg_info->MRM_OrderConfrmStat = 'A';
            $reg_info->MRM_OrderConfrmOn = Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
            $reg_info->save();
            $user_info->UM_Status = 'A';      
            $user_info->um_emailconfirmstatus = 1;
            $user_info->um_emailconfirmedon = Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
            if($user_info->save()){
                    $user_info =  \common\models\UsermstTbl::genereateSetPasswordLink($user_info);
            }
            //for dynamic mail trigger
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>157,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
            ];
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_POSTFIELDS => json_encode($_data),
                    CURLOPT_HTTPHEADER => array(
                            "cache-control: no-cache",
                            "content-type: application/json",
                    ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            //Backend Mail Accept mail
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>158,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
            ];
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_POSTFIELDS => json_encode($_data),
                    CURLOPT_HTTPHEADER => array(
                            "cache-control: no-cache",
                            "content-type: application/json",
                    ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            //Backend Mail Accept Invoice copy mail
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>159,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
            ];
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_POSTFIELDS => json_encode($_data),
                    CURLOPT_HTTPHEADER => array(
                            "cache-control: no-cache",
                            "content-type: application/json",
                    ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return [
                'msg' => 'A',
                'status' => 1,
                'setpassword' => $user_info->um_pwdresetlink
            ];
        }
        if(!$isLinkNotExpired) {
            $sts = 'EP';
        }else if($reg_info->MRM_OrderConfrmStat == 'C' && $isLinkNotExpired) {
            $sts = 'AC';
        }else if($reg_info->MRM_OrderConfrmStat == 'A' && $isLinkNotExpired) {
            $sts = 'AA';
        }else if($reg_info->MRM_OrderConfrmStat == 'I' && $isLinkNotExpired) {
            $emailid = 'nivediny@businessgateways.com';
            //Backend Mail Accept Invoice copy mail
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>329,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
            ];
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_POSTFIELDS => json_encode($_data),
                    CURLOPT_HTTPHEADER => array(
                            "cache-control: no-cache",
                            "content-type: application/json",
                    ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return [
                'msg' => 'AI',
                'status' => 1,
            ];
        }
        return [
            'msg' => $sts,
            'status' => 1
        ];
        
    }
    public function actionCancelreg(){
        $reg_pk = Security::decrypt($_REQUEST['reg_pk']);
        $user_info = UsermstTbl::find()->where(['UM_MemberRegMst_Fk' => $reg_pk,'um_primarycontact' => 1])->one();
        $emailid = $user_info->UM_EmailID;
        $userPk = $user_info->UserMst_Pk;
        $reg_info = \common\models\MemberregistrationmstTbl::findOne($reg_pk);
        $isLinkNotExpired = self::checkLinkExpiry($reg_info->MRM_CreatedOn);
        if($reg_info->MRM_OrderConfrmStat == 'N' && $isLinkNotExpired && !empty($_REQUEST['cancelcomment'])) {
            if($_REQUEST['willingon']){
                $reg_info->mrm_ocwillingon = date('Y-m-d');
            }
            $reg_info->MRM_OrderConfrmStat = 'C';
            $reg_info->mrm_occomments = $_REQUEST['cancelcomment'];
            $reg_info->MRM_OrderConfrmOn = Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
            $reg_info->save();
            //for dynamic mail trigger
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>160,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
            ];
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_POSTFIELDS => json_encode($_data),
                    CURLOPT_HTTPHEADER => array(
                            "cache-control: no-cache",
                            "content-type: application/json",
                    ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            //Backend Mail Cancel mail
            $baseUrl = \Yii::$app->params['APP_URL'];
            $url = $baseUrl."api/ma/mail/send";
            $_data=[
                'email'=>$emailid,
                'template_id'=>161,
                'table_ref_key'=>'UserMst_Pk',
                'table_ref_value'=>$userPk
            ];
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_POSTFIELDS => json_encode($_data),
                    CURLOPT_HTTPHEADER => array(
                            "cache-control: no-cache",
                            "content-type: application/json",
                    ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return [
                'msg' => 'CC',
                'status' => 1
            ];
        }
        $sts = 'C';
        if(!$isLinkNotExpired) {
            $sts = 'EP';
        }else if($reg_info->MRM_OrderConfrmStat == 'C' && $isLinkNotExpired) {
            $sts = 'AC';
        }else if($reg_info->MRM_OrderConfrmStat == 'A' && $isLinkNotExpired) {
            $sts = 'AA';
        }
        return [
            'msg' => $sts,
            'status' => 1
        ];
    }

    public static function checkLinkExpiry($linkCreatedDate) {
        $activeDays = \Yii::$app->params['regConfirmDays'];
        $linkCreatedDate = date('Y-m-d', strtotime($linkCreatedDate));
        $linkActiveTillDate = date('Y-m-d', strtotime("$linkCreatedDate + $activeDays days"));
        return (strtotime($linkActiveTillDate) >= strtotime(date('Y-m-d'))) ? true : false;
    }
    public function actionGetpdmodify(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userpk = Security::decrypt($data['userpk']);
        $Usrdata = OpalusermstTbl::findOne($userpk);
        $msg['msg'] = 'Failure';
        $msg['status'] = 0;
        if(!empty($Usrdata)){
            $msg['msg'] = 'success';
            $msg['status'] = 1;
//            $msg['modydate'] = !empty($Usrdata->um_pwdchangedon) ? date('d-m-Y',strtotime($Usrdata->um_pwdchangedon)) : '';
        }
        return $this->asJson($msg);
    }
    public function actionAutoscfsubmitrenew() {
        $dayofautosubmit = 1;
        $result = Yii::$app->db->createCommand("select * from membercompanymst_tbl a "
                . "left join memberregistrationmst_tbl b on a.MCM_MemberRegMst_Fk =b.MemberRegMst_Pk "
                . "left join suppcertformmembtmp_tbl c on a.MemberCompMst_Pk=c.scfmt_membercompmst_fk "
                . "where (c.scfmt_scfstatus IN ('I','A','D','DI','OSD') OR  c.scfmt_scfstatus IS NULL) and b.MRM_MemberStatus='A' and "
                . "b.MRM_ValSubStatus='A' and (b.MRM_RenewalStatus='RW' OR b.MRM_RenewalStatus='A') and scfmt_renewalstatus!='1'")->queryAll();
        if(count($result) > 0){
           foreach ($result as $value){
                $paymentdtls = \common\models\MemcomppymtinfodtlsTbl::find()
                ->where("mcpid_membercompmst_fk=:compk",[':compk'=>$value['MemberCompMst_Pk']])->orderBy("memcomppymtinfodtls_pk desc")->asArray()->one();
                if($paymentdtls['mcpid_pymtstatus']== 3){
                    $lastpayment=Yii::$app->db->createCommand("select case when DATEDIFF(NOW(), mcpah_appdeclon) >= $dayofautosubmit  then 1 else 0 end as days "
                            . "from memcomppymtapphstry_tbl where mcpah_memcomppymtinfodtls_fk=:compk order by memcomppymtapphstry_pk desc limit 1")
                        ->bindValues([':compk'=>$paymentdtls['memcomppymtinfodtls_pk']])
                        ->queryOne();
                    if ($lastpayment['days']==1) {
                        $result=Yii::$app->db->createCommand("update suppcertformmembtmp_tbl SET scfmt_scfstatus = 'U',scfmt_renewalstatus='1' where "
                                . "scfmt_membercompmst_fk=:compk")->bindValues([':compk'=>$value['MemberCompMst_Pk']]) ->execute(); 
                        $content = $value['MCM_CompanyName'] . ' - Auto Updated SCF for Approval  <br> Thanks';
                        $subject =  $value['MCM_SupplierCode'] . ' - Auto Updated SCF for Approval';
                         \Yii::$app->mailer->compose()
                         ->setFrom('noreply@businessgateways.com')
//                         ->setTo('prithi@businessgateways.com')
                         ->setTo(\Yii::$app->params['testMailIDs'])
                         ->setSubject($subject)
                         ->setHTMLBody($content)
                         ->send();
                    }
                }
           }
       }
    }
    public function actionAutosezadsubmitrenew() {
        $dayofautosubmit = 1;
        $result = Yii::$app->db->createCommand("select * from membercompanymst_tbl a "
                . "left join memberregistrationmst_tbl b on a.MCM_MemberRegMst_Fk =b.MemberRegMst_Pk "
                . "left join sezadregtmp_tbl c on a.MemberCompMst_Pk=c.srt_memcompmst_fk "
                . "JOIN  sezadregdtls_tbl sm ON sm.srd_sezadregtmp_fk = c.sezadregtmp_pk "
                . " where (c.srt_applstatus IN (3,4,5,6,8) and b.MRM_MemberStatus='A') and (b.MRM_RenewalStatus='RW' OR b.MRM_RenewalStatus='A') "
                . "and srt_renewalstatus='1'")->queryAll();
        if(count($result) > 0){
           foreach ($result as $value){
                $paymentdtls = \common\models\MemcomppymtinfodtlsTbl::find()
                ->where("mcpid_membercompmst_fk=:compk",[':compk'=>$value['MemberCompMst_Pk']])->orderBy("memcomppymtinfodtls_pk desc")->asArray()->one();
                if($paymentdtls['mcpid_pymtstatus']== 3){
                    $lastpayment=Yii::$app->db->createCommand("select case when DATEDIFF(NOW(), mcpah_appdeclon) >= $dayofautosubmit  then 1 else 0 end as days "
                            . "from memcomppymtapphstry_tbl where mcpah_memcomppymtinfodtls_fk=:compk order by memcomppymtapphstry_pk desc limit 1")
                        ->bindValues([':compk'=>$paymentdtls['memcomppymtinfodtls_pk']])
                        ->queryOne();
                    if ($lastpayment['days']==1) {
                        $result=Yii::$app->db->createCommand("update sezadregtmp_tbl SET srt_applstatus = '7',srt_isrenewal=1,srt_renewalstatus=0 where srt_memcompmst_fk=:compk")->bindValues([':compk'=>$value['MemberCompMst_Pk']]) ->execute(); 
                        $sezadMain=\common\models\SezadregdtlsTbl::find()->where("srd_memcompmst_fk=:tempmsfk",[":tempmsfk"=>$value['MemberCompMst_Pk']])->asArray()->one();
                        $content = $value['MCM_CompanyName'] . ' - Auto Updated SEZAD Form  <br> Thanks';
                        $subject =   'SEZAD Certified Supplier: Posted the Form for Renewal (SEZAD Reg. No. ' . $sezadMain->srd_regno . ')';
                         \Yii::$app->mailer->compose()
                         ->setFrom('noreply@businessgateways.com')
//                                 ->setTo('prithi@businessgateways.com')
                         ->setTo(\Yii::$app->params['testMailIDs'])
                         ->setSubject($subject)
                         ->setHTMLBody($content)
                         ->send();
                    }
                }
           }
       }
    }
    public function actionUserpermission(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userpk = base64_decode($data['userpk']);
        if(!empty($userpk) && is_numeric($userpk)){
            $retdata['data'] = \common\models\UserpermtrnTblQuery::getuseraccess($userpk);
            $retdata['status'] = 1;
        }else{
            $retdata['status'] = 0;
        }
        return $this->asJson($retdata);
    }
    public function actionGetotturesponsedata()
    {
        $request_body = file_get_contents('php://input');
        $dataval = json_decode($request_body, true);
        $dataval = $dataval['paymentDtl'];
        $dataval= Security::decrypt($dataval);
        $dataval=(array)json_decode($dataval);
        $ref_no = $dataval['ref_no'];
        $cls = $dataval['cls'];
        $country = $dataval['country'];
        $serv_module = $dataval['serv_module'];
        $userpk = Security::base64_decrypt_str($dataval['userpk'],'BGIINDIA');
        $comppk = Security::base64_decrypt_str($dataval['comppk'],'BGIINDIA');
        $response_data = \common\models\UsermstTblQuery::getPymtResponseData($ref_no, $serv_module, $comppk, $userpk);
        return ($response_data)?$this->asJson($response_data):[];
    }

    public function actionGetfeedbackquestion($learnerId){
        
        $isrecordthere = \app\models\LearnerfdbkhdrTbl::find()->where(['lfh_learnerreghrddtls_fk'=>$learnerId])->one();
        if($isrecordthere){
            if( $isrecordthere->lfh_FdbbkStatus == 1){

                $learner = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk'=>$learnerId])->one();
                $learnerfeedback = \app\models\LearnerfdbkhdrTbl::find()->where(['lfh_LearnerRegHrdDtls_FK'=>$learnerId])->one();
                $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['batchmgmtdtls_pk'=>$learner->lrhd_batchmgmtdtls_fk])->one();
                $standardcourse = \app\models\StandardcoursedtlsTbl::find()->where(['standardcoursedtls_pk'=>$batch->bmd_standardcoursedtls_fk])->one();
                $feedbackmst = \app\models\FeedbackmstTbl::find()
                ->where(['FeedbackMst_PK'=>$learnerfeedback->lfh_feedbackmst_fk])->one();
                
                $feedcatgetory = \app\models\FeedbackctgytypeTbl::find()
                ->where(['fdbkct_feedbackmst_fk'=>$feedbackmst->FeedbackMst_PK])
                ->asArray()->all();
                $questions = [];
                foreach($feedcatgetory as $d)
                {
                    $question = \app\models\FdbkquestmstTbl::find()
                    ->where(['fdbkqm_feedbackctgytype_fk'=>$d['feedbackctgytype_pk']])
                    ->andwhere(['fdbkqm_FeedbackMst_FK'=>$feedbackmst->FeedbackMst_PK])
                    ->andwhere(['fdbkqm_status'=> 1])
                    ->asArray()->all();
                    $d['questions'] = $question;
                    array_push($questions, $d);
                }
                $assessor = \app\models\BatchmgmtasmtdtlsTbl::find()
                ->select(['omrm_tpname_en','omrm_tpname_ar'])
                 ->leftJoin('batchmgmtasmthdr_tbl','batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk')
                 ->leftJoin('opalusermst_tbl','bmah_assessor = opalusermst_pk')
                 ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                ->where(['bmad_learnerreghrddtls_fk'=>$learnerId])
                ->asArray()->all();
                $trainer = \app\models\OpalmemberregmstTbl::find()
                ->select(['omrm_tpname_en','omrm_tpname_ar'])
                ->where(['opalmemberregmst_pk' =>$batch->bmd_opalmemberregmst_fk])
                ->asArray()->one();
               
                $learnerdata = \app\models\StaffinforepoTbl::find()->where(['staffinforepo_pk'=>$learner->lrhd_staffinforepo_fk])->one();
                $bool = false;
                if($standardcourse->scd_isknwlasmt == 1 || $standardcourse->scd_ispratasmt ==1){
                    $bool = true;
                }

                $data=[
                    'batchNo'=>$batch->bmd_Batchno,
                    'trainer'=>$trainer['omrm_tpname_en'],
                    'assessor'=>$assessor[0]['omrm_tpname_en'],
                    'name'=>$learnerdata->sir_name_en,
                    'civilnumber'=>$learnerdata->sir_idnumber,
                    'feedback'=> $questions,
                    'isassessment'=> $bool
                ];
                return $data;
            }
            else{
                return [ 'msg' => 'failure', 'status' => 102, 'flag' => 'r', 'data' => 'You had already provide feedback for this batch' ];
            }
        } else{
            return [ 'msg' => 'failure', 'status' => 102, 'flag' => 'f', 'data' => 'There is no feedback record for you' ];
        }
    }

    public function actionSavefeedbackquestion(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true); 
        $learner = \app\models\LearnerfdbkhdrTbl::find()->where(['lfh_learnerreghrddtls_fk'=>$data['learnerId']])->one();

        foreach($data['questions'] as $d)
        {
            foreach($d['questions'] as $dd)
            {
               
                $value = new \app\models\LearnerfdbkansdtlsTbl;
                $value->lfdbkansd_learnerfdbkhdr_fk = $learner->LearnerFdbkHdr_PK;
                $value->lfdbkansd_fdbkquestmst_fk = $dd['FdbkQuestMst_PK'];
                $value->lfdbkansd_agree =  $dd['value'] == 1 ? 1 : 0;
                $value->lfdbkansd_disagree = $dd['value'] == 2 ? 1 : 0;
                $value->lfdbkansd_stronglyagree = $dd['value'] == 3 ? 1 : 0;
                if($value->save()){
                    //return $catTable->LearnerAsmtHdr_PK;
                }else{
                    return [ 'msg' => 'failure', 'status' => 102, 'flag' => 'r', 'data' => $value->getErrors() ];
                   // echo "<pre>";return $value->getErrors();exit;
                } 
            }
        }

        $learner->lfh_FdbbkStatus  = 2;
        $learner->lfh_Comments = $data['comments'];

        if($learner->save()){
            return [ 'msg' => 'success', 'status' => 100, 'flag' => 's', 'data' => "Saved Successfully" ];
        }else{
            return [ 'msg' => 'failure', 'status' => 102, 'flag' => 'r', 'data' => $learner->getErrors() ];
            //echo "<pre>";return $learner->getErrors();exit;
        }   
    }


    public function actionFinalcerificategeneration(){
        $applicatonpk = $_REQUEST['applicationpk'];
        $websiteurl = \Yii::$app->params['website_url'];

      //   echo $applicatonpk;exit;
      $maindata = ApplicationdtlsmainTbl::find()->where('appdm_applicationdtlstmp_fk = '.$applicatonpk)->asArray()->one();
             if(!empty($maindata)){
             $applictioninfo = ApplicationdtlstmpTbl::find()
             ->select(['applicationdtlstmp_tbl.*','appcoursedtlstmp_tbl.*','reqfor.rm_name_en','gm_gradename_en','grademst_pk','appiit_officetype','osm_statename_en','ocim_cityname_en'])
             ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
             ->leftJoin('referencemst_tbl reqfor','reqfor.referencemst_pk = appcdt_requestfor')
             ->leftJoin('grademst_tbl','grademst_pk = appdt_grademst_fk')
             ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
             ->leftJoin('opalstatemst_tbl','opalstatemst_pk = appiit_statemst_fk')
             ->leftJoin('opalcitymst_tbl','opalcitymst_pk = appiit_citymst_fk')
             ->where('applicationdtlstmp_pk = '.$applicatonpk)->asArray()->one();
  
             $year  = OpalInvoiceTbl::find()
                 ->select(['feesubscriptionmst_tbl.*'])
                 ->leftJoin('feesubscriptionmst_tbl','apid_feesubscriptionmst_fk = feesubscriptionmst_pk') 
                 ->where('apid_applicationdtlstmp_fk = '.$applicatonpk)    
                 ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC])->asArray()->one();
 
                 $companyinfo = OpalmemberregmstTbl::find()
                 ->select(['opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
                 ->leftJoin('opalstatemst_tbl','opalstatemst_pk = omrm_opalstatemst_fk')
                 ->leftJoin('opalcitymst_tbl','opalcitymst_pk = omrm_opalcitymst_fk')
                 ->where('opalmemberregmst_pk = '.$applictioninfo['appdt_opalmemberregmst_fk'])
                     ->asArray()->one();
                     
             $course = AppoffercoursetmpTbl::find()->Select('group_concat(appoct_coursecategorymst_fk) as cat')->where('appoct_applicationdtlstmp_fk = '.$applicatonpk)->asArray()->one();
           $subcat = CoursecategorymstTbl::find()->Select('group_concat(ccm_catcode) as subcat')->where('coursecategorymst_pk in ('.$course['cat'].')')->asArray()->one();
             
             if(empty($applictioninfo['appdt_verificationno'])){
                 $varificationcode = 'TP'.$this->generateRandomString();
             }else{
                 $varificationcode = $applictioninfo['appdt_verificationno'];
             }
 
             $increasedate =   '+'.$year['fsm_validityinyrs'].' years';
            
              if($applictioninfo['appdt_apptype'] == 1 ){
                  $end = date('Y-m-d', strtotime($increasedate));
              }else if($applictioninfo['appdt_apptype'] == 2){
                  $end=date('Y-m-d', strtotime($increasedate, strtotime($applictioninfo['appdt_certificateexpiry'])) );
             }
             $end = date('Y-m-d', strtotime($end . ' -1 day'));
             $end=date('Y-m-d', strtotime($applictioninfo['appdt_certificateexpiry']));
             $end_format = date("d-m-Y", strtotime($end));  
 
             $regPk = $applictioninfo['appdt_opalmemberregmst_fk'];
            
             $path = "../api/web/centercertificate/$regPk/";
             $path1 = "/web/centercertificate/$regPk/";
             if(!is_dir($path)){
                 mkdir($path, 0777, true);
             }  
             $baseUrl = \Yii::$app->params['baseUrl'];
             $mPDF1 = new \Mpdf\Mpdf([
                 'mode' => '',
                 'format' => [297, 210],
                 'margin_left' => '15',
                 'margin_right' => '15',
                 'margin_top' => '35', 
                 'margin_bottom' => '16',
                 'margin_header' => '9',
                 'margin_footer' => '9',
                 'default_font_size' => '0', 
                 'orientation' => 'L',
                 'default_font' => 'futurastdmedium']);
             $imgpath = dirname(__FILE__).'../../../../../certicate/';
             $cerpath = dirname(__FILE__).'../../../../../certicate/TrainingCentre.pdf';
             $pagecount = $mPDF1->SetSourceFile($cerpath);
             $tplId = $mPDF1->ImportPage($pagecount);
             $mPDF1->UseTemplate($tplId);
             $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .$companyinfo['omrm_tpname_en']  . '</div>', 0, 144, 210, 0);
             if($applictioninfo['appiit_officetype'] == 1){
             $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .'('.$companyinfo['osm_statename_en'].','.$companyinfo['ocim_cityname_en']  .')'. '</div>', 0, 152, 210, 0);
             }else{
              $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .'('.$applictioninfo['osm_statename_en'].','.$applictioninfo['ocim_cityname_en']  .')'. '</div>', 0, 152, 210, 0);
             }
             $mPDF1->WriteFixedPosHTML('<div style="color:#5B5E5E;text-align: center;font-size: 22pt; ">' . 'Is a Recognised OPAL STAR Provider' . ' </div>', 25, 165, 150, 20);
 
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt; color:#1B1B1A">CR No.: <span style="color:#22228B">' . $companyinfo['omrm_crnumber'] . ' </span> </div>', 25, 180, 150, 20);
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt; color:#1B1B1A">OPAL Membership No.: <span style="color:#22228B">' . $companyinfo['omrm_opalmembershipregnumber'] . '</span> </div>', 25, 186, 150, 20);
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt; color:#1B1B1A">Verification Code: <span style="color:#22228B">' . $varificationcode . '</span> </div>', 25, 192, 150, 20);
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt; color:#1B1B1A">Expiry Date: <span style="color:#22228B">' . $end_format . '</span> </div>', 25, 198, 150, 20);
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 10pt; color:#5B5E5E">Grade: <span style="color:#22228B">' .$applictioninfo['gm_gradename_en']  . '</span> </div>', 140, 180, 50, 20);
                 
             if($applictioninfo['grademst_pk'] == 1){
                 $mPDF1->WriteFixedPosHTML('<img style="height:52pt" src="' .  $imgpath.'BRONZE.svg' . '">', 145, 187, 50, 20);
             }elseif($applictioninfo['grademst_pk'] == 2){
                 $mPDF1->WriteFixedPosHTML('<img style="height:52pt" src="' .  $imgpath.'SILVER.svg' . '">', 145, 187, 50, 20);
             }elseif($applictioninfo['grademst_pk'] == 3){
                 $mPDF1->WriteFixedPosHTML('<img style="height:52pt" src="' .  $imgpath.'GOLD.svg' . '">', 145, 187, 50, 20);
             }
             $mPDF1->WriteFixedPosHTML('<div style="color:#5B5E5E;font-size: 10pt; ">Categories: <span style="color:#22228B">' .$subcat['subcat']  . '</span> </div>', 140, 207, 50, 20);
 
             $info= "To view or verify authenticity please scan QR code with mobile device or refer to  www.usp.opaloman.om";
             $mPDF1->WriteFixedPosHTML('<div style="color:#5B5E5E;font-size: 8.79pt; ">' .$info . ' </div>', 25, 207, 55, 20);
            //  $mPDF1->WriteFixedPosHTML('<div style="color:#5B5E5E;font-size: 8.79pt; "> www.opaloman.om </div>', 25, 220, 50, 20);
             $qrCode = (new QrCode(''))
             ->setText($websiteurl."/verify-product/?verificationno=$varificationcode");
             $qrCode->writeFile(__DIR__ .'../../../web'.'/code.png'); 
             $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width:55pt; height:55pt;">';
 
            
             $mPDF1->WriteFixedPosHTML($qrcode, 30, 230, 50, 20);
             $mPDF1->Output($path .$applictioninfo['appdt_appreferno'].'.pdf', 'F');
 
             $model = ApplicationdtlstmpTbl::find() ->where('applicationdtlstmp_pk = '.$applicatonpk)->one();
            //  $model->appdt_verificationno =  $varificationcode;
             $model->appdt_certificategenon = date("Y-m-d H:i:s");
             $model->appdt_certificatepath = $path1.$applictioninfo['appdt_appreferno'].'.pdf';
            //  $model->appdt_certificateexpiry = $end;
             
             if(!$model->save()){
          
                 return $model->getErrors();
             }else{
              $appmst = ApplicationdtlsmainTbl::find()->where('appdm_applicationdtlstmp_fk = '.$applicatonpk)->one();
            //   $appmst->appdm_verificationno = $varificationcode;
              $appmst->appdm_certificategenon =date("Y-m-d H:i:s");
              $appmst->appdm_certificatepath = $path1.$applictioninfo['appdt_appreferno'].'.pdf';
            //   $appmst->appdm_certificateexpiry = $end;
              if($appmst->save()){
          
                return "success";
              }else{
                  return $model->getErrors();
              }
             return 'success';
             }
         }else{
            return "record not found in main table";
         }
    
        
 
 
     }
 public function actionGetuseraccess(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $userpk = $data['userpk'];
        $model = OpalusermstTbl::getuseraccess($userpk);
        return $model;
    }
    public function actionFinalcoursecerificategeneration(){
        
        $applicatonpk = $_REQUEST['applicationpk'];
        $maindata = ApplicationdtlsmainTbl::find()->where('appdm_applicationdtlstmp_fk = '.$applicatonpk)->asArray()->one();

         if(!empty($maindata)){
             $applictioninfo = ApplicationdtlstmpTbl::find()
             ->select(['applicationdtlstmp_tbl.*','appcoursedtlstmp_tbl.*','reqfor.rm_name_en','appiim_officetype'])
             ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
             ->leftJoin('referencemst_tbl reqfor','reqfor.referencemst_pk = appcdt_requestfor')
             ->leftJoin('appinstinfomain_tbl','appinstinfomain_pk = appcdt_appinstinfomain_fk')
             ->where('applicationdtlstmp_pk = '.$applicatonpk)->asArray()->one();
 
             $year  = OpalInvoiceTbl::find()
                 ->select(['feesubscriptionmst_tbl.*'])
                 ->leftJoin('feesubscriptionmst_tbl','apid_feesubscriptionmst_fk = feesubscriptionmst_pk') 
                 ->where('apid_applicationdtlstmp_fk = '.$applicatonpk)    
                 ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC])->asArray()->one();
                if($applictioninfo['appiim_officetype'] == 1){
             $companyinfo = OpalmemberregmstTbl::find()
             ->select(['opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
             ->leftJoin('opalstatemst_tbl','opalstatemst_pk = omrm_opalstatemst_fk')
             ->leftJoin('opalcitymst_tbl','opalcitymst_pk = omrm_opalcitymst_fk')
             ->where('opalmemberregmst_pk = '.$applictioninfo['appdt_opalmemberregmst_fk'])
                 ->asArray()->one();
                }else{
                    $companyinfo = ApplicationdtlstmpTbl::find()
                    ->select(['applicationdtlstmp_tbl.*','opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
                    ->leftJoin('appcoursedtlstmp_tbl','appcdt_applicationdtlstmp_fk = applicationdtlstmp_pk')
                    ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appdt_opalmemberregmst_fk')
                    ->leftJoin('appinstinfomain_tbl','appinstinfomain_pk = appcdt_appinstinfomain_fk')
                    ->leftJoin('opalstatemst_tbl','opalstatemst_pk = appiim_statemst_fk')
                    ->leftJoin('opalcitymst_tbl','opalcitymst_pk = appiim_citymst_fk')
                    ->where('applicationdtlstmp_pk = '.$applicatonpk)->asArray()->one();
                }
             
           
             $varificationcode = $applictioninfo['appdt_verificationno'];
             $end = date('Y-m-d', strtotime($applictioninfo['appdt_certificateexpiry']));
             //  $end = date('Y-m-d', strtotime($end . ' -1 day'));
              $end_format = date("d-m-Y", strtotime($end)); 
             $regPk = $applictioninfo['appdt_opalmemberregmst_fk'];  
            // $applictioninfo['appdt_projectmst_fk']  = 2;    
             if($applictioninfo['appdt_projectmst_fk'] == 2){
                 $cousre_list = StandardcoursemstTbl::find()->where('standardcoursemst_pk = '. $applictioninfo['appcdt_standardcoursemst_fk'])->asArray()->one();
                 $text = $cousre_list['scm_coursecertcontent'];
                }else{
                 $cousre_list = AppoffercoursemainTbl::find()->where('appoffercoursemain_pk = '. $applictioninfo['appcdt_appoffercoursemain_fk'])->asArray()->one();
                 $text = 'is an approved OPAL STAR Provider <br> to deliver and assess for the '.$cousre_list['appocm_coursename_en'].' as per the provisions <br> of OPAL Customized Course '.$cousre_list['appocm_coursename_en'] .'    '.     $applictioninfo['rm_name_en']. ' Standard.';
             }
            
             $path = "../api/web/certificate/$regPk/";
             $path1 = "/web/certificate/$regPk/";
 
             if(!is_dir($path)){
                 mkdir($path, 0777, true);
             }  
             $baseUrl = \Yii::$app->params['baseUrl'];
             $mPDF1 = new \Mpdf\Mpdf([
                 'mode' => '',
                 'format' => 'A4-L',
                 'margin_left' => '15',
                 'margin_right' => '15',
                 'margin_top' => '35', 
                 'margin_bottom' => '16',
                 'margin_header' => '9',
                 'margin_footer' => '9',
                 'default_font_size' => '0', 
                 'orientation' => 'L',
                 'default_font' => 'futurastdmedium']);
        
             $cerpath = dirname(__FILE__).'../../../../../certicate/cert.pdf';
             $pagecount = $mPDF1->SetSourceFile($cerpath);
             $tplId = $mPDF1->ImportPage($pagecount);
             $mPDF1->UseTemplate($tplId);
             $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .$companyinfo['omrm_tpname_en']  . ' </div>', 50, 88, 450, 20);
             
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 16pt;text-align: center;color:#1C1C1B ">' . $text . ' </div>', 50, 103, 200, 20);
 
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">CR No.: ' . $companyinfo['omrm_crnumber'] . ' </div>', 25, 135, 200, 20);
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">OPAL Membership No.: ' . $companyinfo['omrm_opalmembershipregnumber'] . ' </div>', 25, 142, 200, 20);
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Verification Code: ' . $varificationcode . ' </div>', 205, 135, 200, 20);
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Expiry Date: ' . $end_format . ' </div>', 205, 142, 200, 20);
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Governorate: ' . $companyinfo['osm_statename_en'] . ' </div>', 25, 149, 200, 20);
             $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Wilayat: ' . $companyinfo['ocim_cityname_en'] . ' </div>', 25, 156, 200, 20);
 
             $mPDF1->Output($path .$applictioninfo['appdt_appreferno'].'.pdf', 'F');
             $model = ApplicationdtlstmpTbl::find() ->where('applicationdtlstmp_pk = '.$applicatonpk)->one();
            //  $model->appdt_verificationno =  $varificationcode;
             $model->appdt_certificategenon = date("Y-m-d H:i:s");
             $model->appdt_certificatepath = $path1 .$applictioninfo['appdt_appreferno'].'.pdf';
            //  $model->appdt_certificateexpiry = $end;
             if(!$model->save()){ 
             
                 return $model->getErrors();  
             }else{
                
             return 'success';
             }
       
         }else{
            return "record not found in main table";
         }
         exit;
 }

 public function actionFinalrascerificategeneration(){
        
    $applicatonpk = $_REQUEST['applicationpk'];
    $websiteurl = \Yii::$app->params['website_url'];
    $maindata = ApplicationdtlsmainTbl::find()->where('appdm_applicationdtlstmp_fk = '.$applicatonpk)->asArray()->one();

    if(!empty($maindata)){
        $applictioninfo = ApplicationdtlstmpTbl::find()
        ->select(['applicationdtlstmp_tbl.*','opalstatemst_tbl.*','opalcitymst_tbl.*'])
        ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
        ->leftJoin('opalstatemst_tbl','opalstatemst_pk = appiit_statemst_fk')
        ->leftJoin('opalcitymst_tbl','opalcitymst_pk = appiit_citymst_fk') 
        ->where('applicationdtlstmp_pk = '.$applicatonpk)->asArray()->one();
     
        $course = AppstaffinfotmpTbl::find()->Select('group_concat(appsit_apprasvehinspcattmp_fk) as cat')->where('appsit_applicationdtlstmp_fk = '.$applicatonpk)->asArray()->one();

        $subcat = ApprasvehinspcattmpTbl::find()->Select('group_concat(rcm_coursesubcatname_en) as subcat')->leftJoin('rascategorymst_tbl','rascategorymst_pk = arvict_rascategorymst_fk')->where('apprasvehinspcattmp_pk in ('.$course['cat'].')')->asArray()->one();
       
        $year  = OpalInvoiceTbl::find()
            ->select(['feesubscriptionmst_tbl.*'])
            ->leftJoin('feesubscriptionmst_tbl','apid_feesubscriptionmst_fk = feesubscriptionmst_pk') 
            ->where('apid_applicationdtlstmp_fk = '.$applicatonpk)    
            ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC])->asArray()->one();
            if($applictioninfo['appdt_isprimarycert'] == 1){
                // $companyinfo = OpalmemberregmstTbl::find()
                // ->select(['opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
                // ->leftJoin('opalstatemst_tbl','opalstatemst_pk = omrm_opalstatemst_fk')
                // ->leftJoin('opalcitymst_tbl','opalcitymst_pk = omrm_opalcitymst_fk')
                // ->where('opalmemberregmst_pk = '.$applictioninfo['appdt_opalmemberregmst_fk'])
                //     ->asArray()->one();
                //    }else{
                       $companyinfo = ApplicationdtlstmpTbl::find()
                       ->select(['applicationdtlstmp_tbl.*','opalmemberregmst_tbl.*','osm_statename_en','ocim_cityname_en'])
                       ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appdt_opalmemberregmst_fk')
                       ->leftJoin('appinstinfotmp_tbl','appiit_applicationdtlstmp_fk = applicationdtlstmp_pk')
                       ->leftJoin('opalstatemst_tbl','opalstatemst_pk = appiit_statemst_fk')
                       ->leftJoin('opalcitymst_tbl','opalcitymst_pk = appiit_citymst_fk')
                       ->where('applicationdtlstmp_pk = '.$applicatonpk)->asArray()->one();
                 //  }

                  
                
       

        if(empty($applictioninfo['appdt_verificationno'])){
            $varificationcode = 'TPC'.self::generateRandomString();
        }else{
            $varificationcode = $applictioninfo['appdt_verificationno'];
        }
        if(empty($applictioninfo['appdt_certificateexpiry'])){
           
            $increasedate =   '+'.$year['fsm_validityinyrs'].' years';
            $end = date('Y-m-d', strtotime($increasedate));
            // $end = date('Y-m-d', strtotime($end . ' -1 day'));
            $end_format = date("d-m-Y", strtotime($end)); 

        }else if($applictioninfo['appdt_apptype'] == '2'){
           
            $increasedate =   '+'.$year['fsm_validityinyrs'].' years';
            $end = date('Y-m-d', strtotime($applictioninfo['appdt_certificateexpiry'].$increasedate));
            // $end = date('Y-m-d', strtotime($end . ' -1 day'));
            $end_format = date("d-m-Y", strtotime($end)); 
            
        }else{
            $end = date('Y-m-d', strtotime($applictioninfo['appdt_certificateexpiry']));
            $end_format = date("d-m-Y", strtotime($applictioninfo['appdt_certificateexpiry'])); 

        }
      
        $regPk = $applictioninfo['appdt_opalmemberregmst_fk'];  
       // $applictioninfo['appdt_projectmst_fk']  = 2;    
       
       $contentinfo = ProjectmstTbl::find()
       ->select(['pm_certcontent'])
       ->where('projectmst_pk = 4')
           ->asArray()->one();   
        $text = $contentinfo['pm_certcontent'];


        $path = "../api/web/certificate/$regPk/";
        $path1 = "/web/certificate/$regPk/";

        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }  
        $baseUrl = \Yii::$app->params['baseUrl'];
        $mPDF1 = new \Mpdf\Mpdf([
            'mode' => '',
            'format' => 'A4-L',
            'margin_left' => '15',
            'margin_right' => '15',
            'margin_top' => '35', 
            'margin_bottom' => '16',
            'margin_header' => '9',
            'margin_footer' => '9',
            'default_font_size' => '0', 
            'orientation' => 'L',
            'default_font' => 'futurastdmedium']);
   
        $cerpath = dirname(__FILE__).'../../../../../certicate/rascert.pdf';
        $pagecount = $mPDF1->SetSourceFile($cerpath);
        $tplId = $mPDF1->ImportPage($pagecount);
        $mPDF1->UseTemplate($tplId);
        $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .$companyinfo['omrm_branch_en'] . ' </div>', 50, 88, 430, 20);
        // if($applictioninfo['appdt_isprimarycert'] == 1){
        // $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .'('.$companyinfo['osm_statename_en'].','.$companyinfo['ocim_cityname_en']  .')'. '</div>',  50, 90, 460, 20);
        // }else{
        // $mPDF1->WriteFixedPosHTML('<div style="text-align: center;font-size: 20pt;color:#22228B">' .'('.$applictioninfo['osm_statename_en'].','.$applictioninfo['ocim_cityname_en']  .')'. '</div>',50, 90, 460, 20);
        // }
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 16pt;text-align: center;color:#1C1C1B ">' . $text . ' </div>', 50, 103, 200, 20);

        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Categories: ' . $subcat['subcat'] . ' </div>', 25, 135, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">CR No.: ' . $companyinfo['omrm_crnumber'] . ' </div>', 25, 142, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Verification Code: ' . $varificationcode . ' </div>', 25, 149, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Expiry Date: ' . $end_format . ' </div>', 25, 156, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Governorate: ' . $companyinfo['osm_statename_en'] . ' </div>', 25, 163, 200, 20);
        $mPDF1->WriteFixedPosHTML('<div style="font-size: 11.15pt;color:#1C1C1B ">Wilayat: ' . $applictioninfo['ocim_cityname_en'] . ' </div>', 25, 170, 200, 20);
        $qrCode = (new QrCode(''))
        ->setText($websiteurl."/verify-product/?verificationras=$varificationcode".'#ras');
        $qrCode->writeFile(__DIR__ . '/code.png'); 
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width:55pt; height:55pt;">';

    
        $mPDF1->WriteFixedPosHTML($qrcode, 255, 165, 290, 50);
        
        $rand = rand(10,100);
        $mPDF1->Output($path .$applictioninfo['appdt_appreferno'].'.pdf', 'F');
        $model = ApplicationdtlstmpTbl::find() ->where('applicationdtlstmp_pk = '.$applicatonpk)->one();
        $model->appdt_verificationno =  $varificationcode;
        $model->appdt_certificategenon = date("Y-m-d H:i:s");
        $model->appdt_certificatepath = $path1 .$applictioninfo['appdt_appreferno'].'.pdf'.'?v='.$rand;
        if($applictioninfo['appdt_apptype'] == '1' || $applictioninfo['appdt_apptype'] == '2'){
            $model->appdt_certificateexpiry = $end;
        }
     
        if(!$model->save()){ 
        
            return $model->getErrors();  
        }else{
            $appmst = ApplicationdtlsmainTbl::find()->where('appdm_applicationdtlstmp_fk = '.$applicatonpk)->one();
            //   $appmst->appdm_verificationno = $varificationcode;
              $appmst->appdm_certificategenon =date("Y-m-d H:i:s");
              $appmst->appdm_certificatepath = $path1.$applictioninfo['appdt_appreferno'].'.pdf';
            //   $appmst->appdm_certificateexpiry = $end;
              if($appmst->save()){
          
                return "success";
              }else{
                  return $model->getErrors();
              }
             return 'success';  
           
        }
   
     }else{
        return "record not found in main table";
     }
     exit;
}
function generateRandomString($length = 7) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
 
    
 
 }
}