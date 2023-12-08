<?php

namespace api\modules\ea\controllers;

use api\components\Security;
use Yii;
use api\modules\mst\controllers\MasterController;
use app\models\OpalusermstTbl;
use app\models\RoleallocationdtlsTbl;
use app\models\RolemstTbl;
use app\models\OpalsubmodulemstTbl;
use app\models\ProjapprovalworkflowuserdtlsTbl;
use yii\data\ActiveDataProvider;


class EnterpriseadminController extends MasterController
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

    function baseErrorMessage($type){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $resMessage = '';
        switch ($type) {
            case 'success':
                $resMessage = 'Success';
                break;
            case 'notAvailable':
                $resMessage = 'Data is not available towards this';
                break;
            case 'missingFields':
                $resMessage = 'Mandatory Fields are missing';
                break;
            case 'dbError':
                $resMessage = 'Database error occurs';
                break;
            case 'smAlreadyAvailable':
                $resMessage = 'This data is already available';
                break;
            case 'sanitizeError':
                $resMessage = 'Sanitization Error';
                break;
            case 'activeInSameCompany':
                $resMessage = 'User already registered in same company';
                break;
            case 'activeInAnotherCompany':
                $resMessage = 'This user has already been registered in another company';
                break;
            case 'invitedInAnotherCompany':
                $resMessage = 'This user has already been invited by another company';
                break;
            case 'activewhiledelete':
                $resMessage = 'This user is in active state';
                break;
            case 'alreadydeleted':
                $resMessage = 'This user is already deleted';
                break;
        }
        return $resMessage;
    }
    
    public function actionSaveroledata()
    {
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->data;
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
     
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $rolepk= $requestdata['data']['rolerelpk'];
        $userAccess = $resParam->useraccess;
        $date=date('Y-m-d H:i:s');        
        $checkapprovalmanagement =  ProjapprovalworkflowuserdtlsTbl::checkapprovalrole($userAccess , $rolepk);
        if($checkapprovalmanagement == false){  
            return 'failed';
        }
        $requestdata['data']['stkholdertype'] = $requestdata['data']['stkholdertype'] == 3 ? 2 : $requestdata['data']['stkholdertype'];
        if(($requestdata['type'] == 'new') ||$requestdata['type'] == 'edit'){
            $model = RolemstTbl::find()->where(['rolemst_pk'=>$requestdata['data']['rolerelpk']])->one();
            if(empty($model)){
            $model=new RolemstTbl();
            $model->rm_createdon = $date;
            $model->rm_createdby = $userPk;
            $model->rm_higherrole = !empty($requestdata['data']['arrolehigh']) ? implode(',', $requestdata['data']['arrolehigh']) : NULL;
            $model->rm_opalstkholdertypmst_fk = $requestdata['data']['stkholdertype'];
             if($requestdata['data']['stkholdertype'] == 2 && !empty( $requestdata['data']['techeval'])){
                  $model->rm_projectmst_fk = $requestdata['data']['techeval'];
             }elseif($requestdata['data']['stkholdertype'] == 2 && empty( $requestdata['data']['techeval'])){
                  $model->rm_projectmst_fk =1;
             }           
            $model->rm_rolename_en = $requestdata['data']['arrole'];
            $model->rm_rolename_ar = $requestdata['data']['rolearbic'];
            $model->rm_status = 1;
        
            // $OpalModuleMst_FK = [];
            $userAry=array();
            $getsofarsubcatid = [];
            $checknumb = 0;
            // echo '<pre>';print_r($userAccess);exit;
            foreach($userAccess as $key =>$userInfo){
                if(!in_array($userInfo->submodule,$getsofarsubcatid, true)){
                    if($key == 0){
                        $checknumb = 0;
                    }else{
                        $checknumb++;
                    }
                    $userAry[$checknumb]['module'] =  $userInfo->module;
                    $userAry[$checknumb]['submodule'] = $userInfo->submodule;
                    $userAry[$checknumb]['useraccess'] = $userInfo->type;
                    $getsofarsubcatid[] = array_push($getsofarsubcatid,$userInfo->submodule);  
                    $getsofarsubcatid = array_unique($getsofarsubcatid);       
                }else{
                    $userAry[$checknumb]['useraccess'] = $userAry[$checknumb]['useraccess'].','.$userInfo->type;
                }
            }
            if($model->save())
            {
                 foreach($userAry as $key=>$acs){
                    $access = explode(',',$acs['useraccess']);    
                    $models=new RoleallocationdtlsTbl();
                    $date=date('Y-m-d H:i:s');
                    $models->rad_RoleMst_FK = $model->rolemst_pk;
                    $models->rad_OpalModuleMst_FK =$acs['module'];
                    $models->rad_OpalSubModuleMst_FK = $acs['submodule'];
                    $models->rad_Access = json_encode($access);
                    $models->rad_CreatedOn = $date;
                    $models->rad_CreatedBy = $userPk;
                    $models->rad_UpdatedOn = $date;
                    $models->save();
                 }
                 if(!$models->save()){
                    var_dump($models->getErrors());
                    exit;
                }
                else{
                    return $model->rolemst_pk;
                }
                
            } 
            if(!$model->save()){
                echo '<pre>';
                print_r($model->getErrors());
                exit;
            }
            else{
                return $model->rolemst_pk;
            }
        }else{
            // $model=new RolemstTbl();
            $model->rm_updatedon = $date;
            $model->rm_updatedby = $userPk;
            $model->rm_opalstkholdertypmst_fk = $requestdata['data']['stkholdertype'];
            if(in_array($requestdata['data']['techeval'],[4,5]))
            {
                $model->rm_projectmst_fk = $requestdata['data']['techeval'];
            }
            
            $model->rm_higherrole = !empty($requestdata['data']['arrolehigh']) ? implode(',', $requestdata['data']['arrolehigh']) : NULL;
            $model->rm_rolename_en = $requestdata['data']['arrole'];
            $model->rm_rolename_ar = $requestdata['data']['rolearbic'];
            $model->rm_status = 1;
            $OpalModuleMst_FK = [];
            $userAry=array();
            $getsofarsubcatid = [];
            $checknumb = 0;
           
            foreach($userAccess as $key =>$userInfo){
                if(!in_array($userInfo->submodule,$getsofarsubcatid, true)){
                    if($key == 0){
                        $checknumb = 0;
                    }else{
                        $checknumb++;
                    }
                    $userAry[$checknumb]['module'] =  $userInfo->module;
                    $userAry[$checknumb]['submodule'] = $userInfo->submodule;
                    $userAry[$checknumb]['useraccess'] = $userInfo->type;
                    $getsofarsubcatid[] = array_push($getsofarsubcatid,$userInfo->submodule);  
                    $getsofarsubcatid = array_unique($getsofarsubcatid);       
                }else{
                    $userAry[$checknumb]['useraccess'] = $userAry[$checknumb]['useraccess'].','.$userInfo->type;
                }
            }
            
            $arraymodules = $userAry;
             
            foreach($arraymodules as $key => $module)
            {
              foreach($userAry as $newkey => $newmodule)
              {
               
                if($module['submodule'] == $newmodule['submodule'] && $newkey != $key )
                    {
                        $access = explode(',',$module['useraccess']);
                        $newaccess = explode(',',$newmodule['useraccess']);

                        $finalaccess = array_unique(array_merge($access,$newaccess));
                        
                        $userfinalaccess = implode(",",$finalaccess);
                        
                        $arraymodules[$newkey]['module'] = $userAry[$newkey]['module'];
                        $arraymodules[$newkey]['submodule'] = $userAry[$newkey]['submodule'];
                        $arraymodules[$newkey]['useraccess'] = $userfinalaccess;
                        
                    unset($arraymodules[$key]);
                        
                    }
              }
                
            }
            
            if($model->save())
            {

                if(!empty($userPk)){
                    $checkPrevAccess = RoleallocationdtlsTbl::find()
                                        ->where(['rad_RoleMst_FK'=>$rolepk])
                                        ->asArray()->all();
                }
                if(!empty($checkPrevAccess)){
                    foreach ($checkPrevAccess as $key => $cpa) {
                        $cpad = RoleallocationdtlsTbl::find()
                            ->where(['RoleAllocationDtls_pk'=>$cpa['RoleAllocationDtls_pk']])
                            ->one();
                        if(!empty($cpad)){
                            $cpad->delete();
                        }
                    }
                }
                 foreach($arraymodules as $key=>$acs){
                    $access = explode(',',$acs['useraccess']);
                    $models = new RoleallocationdtlsTbl();
                    // $access = explode(',',$acs);
                    // $models['userAccess'] = $userAccessArr;          
                    // $models=new RoleallocationdtlsTbl();
                    $date=date('Y-m-d H:i:s');
                    $models->rad_RoleMst_FK = $rolepk;
                    $models->rad_OpalModuleMst_FK =$acs['module'];
                    $models->rad_OpalSubModuleMst_FK = $acs['submodule'];
                    $models->rad_Access = json_encode($access);
                    $models->rad_CreatedOn = $date;
                    $models->rad_CreatedBy = $userPk;
                    // $models->rad_UpdatedBy = $userPk;
                    $models->rad_UpdatedOn = $date;
                    $models->save();
                    // if(!$model->save()){
                    //     var_dump($model->getErrors());
                    //     exit;
                    // }else{
                    //     $message= 'success';
                    // }
                    
                 }
            }
            if(!$model->save()){
                var_dump($model->getErrors());
                exit;
            }
            else{
                return $requestdata['type'];
            }
         }
      }

    }
    public function actionSaveusersdata(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $date=date('Y-m-d H:i:s');
        $checkapprovalmanagement =  ProjapprovalworkflowuserdtlsTbl::checkapprovaldata($model->opalusermst_pk , $requestdata['data']);
        if($checkapprovalmanagement == false){
            
            return 'failed';
           return false;
        }
        if($requestdata['type'] == 'new'){
            $model=new OpalusermstTbl();
            $model->oum_createdon = $date;
            $model->oum_createdby = $userPk;
            $model->oum_isfocalpoint = 2;
            $model->oum_idnumber = $requestdata['data']['civilno'];
            $model->oum_emailid = $requestdata['data']['emailid'];
            if($requestdata['data']['stkholdertypeuser'] == 1){
                $model->oum_staffinforepo_fk = NULL;            
                $model->oum_opalmemberregmst_fk = $regPk;
            }else{
                $model->oum_opalmemberregmst_fk = $requestdata['data']['centrename'];
                $model->oum_staffinforepo_fk = $requestdata['data']['staffrepopk'];      
            }
             $oldrole = $model->oum_rolemst_fk;      
//            if($requestdata['data']['stkholdertypeuser'] == 1){
                $model->oum_rolemst_fk = !empty($requestdata['data']['arroles']) ? implode(',', $requestdata['data']['arroles']) : NULL;
//            }else{
//                $model->oum_rolemst_fk = $requestdata['data']['rolecentre'];
//            }            
            $model->oum_mobno = $requestdata['data']['mobilenumber'];            
            $model->oum_firstname = $requestdata['data']['stafName'];
            $model->oum_status = 'E';
            $model->oum_emailconfirmstatus = 2;
            $model->oum_isthirdpartyagent = ($requestdata['data']['slider']==1)? 1: 2;   
            $oldproject = $model->oum_allocatedproject;         
            $model->oum_standcoursemst_fk =   implode(",", $requestdata['data']['arcourse']);   
            $model->oum_allocatedproject =   implode(",", $requestdata['data']['arproject']); 
            if($model->save())
            {
                 $confirmlink = OpalusermstTbl::genereateSetPasswordLink($model);
                 OpalusermstTbl::sendUserCreatedMail($model->opalusermst_pk,'enterpriseadmintoactive',$confirmlink['resetlink']); 
                //insert project user tbl
                 ProjapprovalworkflowuserdtlsTbl::insertapprovaldata($model->opalusermst_pk , $requestdata['data'] , $oldproject ,  $oldrole);
                 return $requestdata['type'];
            }
            else
            {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        } 
        elseif($requestdata['type'] == 'edit'){
            $model = OpalusermstTbl::find()->where(['opalusermst_pk'=>$requestdata['data']['opalusermstpk']])->one();
            $model->oum_idnumber = $requestdata['data']['civilno'];
            $model->oum_emailid = $requestdata['data']['emailid'];
            if($requestdata['data']['stkholdertypeuser'] == 1){
            $model->oum_staffinforepo_fk = NULL;            
            }else{
                $model->oum_staffinforepo_fk = $requestdata['data']['staffrepopk'];      
            }
            $oldrole = $model->oum_rolemst_fk;    
            $model->oum_rolemst_fk = !empty($requestdata['data']['arroles']) ? implode(',', $requestdata['data']['arroles']) : NULL;
            $model->oum_mobno = $requestdata['data']['mobilenumber'];
            $model->oum_firstname = $requestdata['data']['stafName'];
            $model->oum_isthirdpartyagent = ($requestdata['data']['slider']=="true")? 1: 2;
            $model->oum_updatedon = $date;
            $model->oum_updatedby = $userPk;
            $oldproject = $model->oum_allocatedproject;
            $model->oum_standcoursemst_fk =   implode(",", $requestdata['data']['arcourse']);   
            $model->oum_allocatedproject =   implode(",", $requestdata['data']['arproject']); 
        
            if($model->save()){
                //update project user tbl
                ProjapprovalworkflowuserdtlsTbl::insertapprovaldata($model->opalusermst_pk , $requestdata['data'], $oldproject , $oldrole);
                return $requestdata['type'];
            } else {
                var_dump($model->getErrors());
                exit;
            }  
        }
       
    }
    public function actionSavecentresdata(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $date=date('Y-m-d H:i:s');
        
        $projpks = null;
        if(!empty($requestdata['data']['rolescentreid']))
        {
           $projpks = RolemstTbl::find()->select(['group_concat(distinct rm_projectmst_fk) as projpks'])->where(['IN','rolemst_pk',$requestdata['data']['rolescentreid']])->asArray()->one()['projpks'];
        }
      
        
        if($requestdata['type'] == 'new'){
            $modelcentre=new OpalusermstTbl();
            $modelcentre->oum_createdon = $date;
            $modelcentre->oum_isfocalpoint = 2;
            $modelcentre->oum_createdby = $userPk;
            $modelcentre->oum_opalmemberregmst_fk = $regPk;
            $modelcentre->oum_staffinforepo_fk = $requestdata['data']['staffcentrerepopk'];
            $modelcentre->oum_idnumber = $requestdata['data']['civilnocentre'];
            $modelcentre->oum_emailid = $requestdata['data']['emailidcentre'];
            $modelcentre->oum_rolemst_fk = !empty($requestdata['data']['rolescentreid']) ? implode(',', $requestdata['data']['rolescentreid']) : NULL;
            $modelcentre->oum_projectmst_fk = $projpks;
            $modelcentre->oum_mobno = $requestdata['data']['mobilenumbercentre'];
            $modelcentre->oum_firstname = $requestdata['data']['staffsnamecentrename'];
            $modelcentre->oum_status = 'E';
            $modelcentre->oum_emailconfirmstatus = 2;
            if($modelcentre->save()){
                $confirmlink = OpalusermstTbl::genereateSetPasswordLink($modelcentre);
                 OpalusermstTbl::sendUserCreatedMail($modelcentre->opalusermst_pk,'enterpriseadmintoactive',$confirmlink['resetlink']); 
                return $modelcentre->opalusermst_pk;
            }
            else
            {
                echo "<pre>";
                var_dump($modelcentre->getErrors());
                exit;
            }
        }
        elseif($requestdata['type'] == 'edit'){
            $modelcentre = OpalusermstTbl::find()->where(['opalusermst_pk'=>$requestdata['data']['opalusermstpk']])->one();
            $modelcentre->oum_idnumber = $requestdata['data']['civilnocentre'];
            $modelcentre->oum_emailid = $requestdata['data']['emailidcentre'];
            $modelcentre->oum_rolemst_fk = !empty($requestdata['data']['rolescentreid']) ? implode(',', $requestdata['data']['rolescentreid']) : NULL;
            $modelcentre->oum_projectmst_fk = $projpks;
            $modelcentre->oum_staffinforepo_fk = $requestdata['data']['staffcentrerepopk'];
            $modelcentre->oum_mobno = $requestdata['data']['mobilenumbercentre'];
            $modelcentre->oum_firstname = $requestdata['data']['staffsnamecentrename'];
            $modelcentre->oum_updatedon = $date;
            $modelcentre->oum_updatedby = $userPk;
            if($modelcentre->save()){
            
                return $modelcentre->opalusermst_pk;
            } else {
                var_dump($modelcentre->getErrors());
                exit;
            }  
        }
       
    }
    // get-role-dtls
    public function actionGetRoleDtls(){
         $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $stktype = $data['type'];
        $roleuserdata = \app\models\RolemstTbl::find()
        ->select(['rolemst_pk','rm_rolename_en','rm_rolename_ar','rm_opalstkholdertypmst_fk as stktype'])
        ->leftjoin('roleallocationdtls_tbl','rad_RoleMst_FK = rolemst_pk')
        ->Where(['rm_status'=>1])  
         ->andWhere(['rm_opalstkholdertypmst_fk'=>$stktype])
        ->asArray()
        ->all();
        return $roleuserdata;
    }
    public function actionCheckEmailExist() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $usrpk = $data['usrid'];
        $companypk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
    //echo'<pre>';print_r($data);exit;
        $emailexistdata = false;
         if(isset($data['stktype']) && !empty($data['stktype']) && $data['stktype'] != "undefined"){
             $stktype = $data['stktype'];
         }else{
             $stktype = \yii\db\ActiveRecord::getTokenData('omrm_stkholdertypmst_fk',true);
         }       
        if(!empty($data)) {
            if(isset($data['emailid'])) {
                if(isset($companypk) && $companypk != '' && $companypk != null) {
                    $userExistValues = OpalusermstTbl::find()
                     ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = oum_opalmemberregmst_fk')                        
                    ->where('oum_emailid = :oum_emailid', [':oum_emailid' => $data['emailid']])
                    ->andFilterWhere(['=','opalmemberregmst_pk',$companypk])
                    ->andFilterWhere(['=', 'omrm_stkholdertypmst_fk', $stktype])
                    ->andFilterWhere(['<>', 'oum_status', 'D'])->exists();
                        if($userExistValues) {
                            $emailexistdata = true;
                        }
                } else {
                        $userexit = OpalusermstTbl::find()
                        ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = oum_opalmemberregmst_fk')
                        ->where('lower(oum_emailid) = :oum_emailid', [':oum_emailid' => $data['emailid']])
                        ->andFilterWhere(['<>', 'opalusermst_pk', $usrpk])
                        ->andFilterWhere(['=', 'omrm_stkholdertypmst_fk', $stktype])
                        ->andFilterWhere(['<>', 'oum_status', 'D'])
                        ->exists();
                        if($userexit) {
                            $emailexistdata = true;
                        }
    
                    }

           
                return $this->asJson(['data' => $emailexistdata]);
            }
        }
    }
    // get-highroledata-dtls
    public function actionGetHighroledataDtls(){
        // $request_body = file_get_contents('php://input');
        // $requestdata = json_decode($request_body, true);
        // print_r($requestdata);
        // exit;
        $roleuserroleallocation = \app\models\RolemstTbl::find()
        ->select(['rolemst_pk','rm_rolename_en','rm_rolename_ar','rm_opalstkholdertypmst_fk'])
        ->Where(['rm_status'=>1])  
        ->andWhere(['rm_opalstkholdertypmst_fk'=>1])
        ->asArray()
        ->all();
        $centrearry=[
            'highroledata'=>$roleuserroleallocation,
        ];
        return $this->asJson($centrearry);
    }
// get-centrelist-dtls
    public function actionGetCentrelistDtls()
    {
         $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
         $staffsdatafetch = \app\models\OpalusermstTbl::find()
        ->select(['opalusermst_pk','oum_emailid','oum_idnumber','oum_rolemst_fk','rm_rolename_en','oum_mobno','oum_firstname'])
        ->leftjoin('opalmemberregmst_tbl','opalmemberregmst_pk = oum_opalmemberregmst_fk')
        ->leftjoin('rolemst_tbl','rolemst_pk = oum_rolemst_fk')
        ->where('oum_status = :oum_status', [':oum_status' => 'A']) 
        ->groupBy('opalusermst_pk')
        ->asArray()
        ->all();
        $centrearry=[
            'stafffcentretchdata'=>$staffsdatafetch,
        ];
        return $this->asJson($centrearry);
    } 
    // get-centreliststaff-dtls
    public function actionGetCentreliststaffDtls()
    {
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
         $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
         
         $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $userProjPk = OpalusermstTbl::findOne($userPk)->oum_projectmst_fk  ;
         
         $query = \app\models\AppstaffinfomainTbl::find()
            ->select(['staffinforepo_pk','omrm_branch_en','omrm_branch_ar','appdm_projectmst_fk','ocym_countrydialcode as countrycode','sir_idnumber','sir_emailid','sir_mobnum','sir_name_en','sir_name_ar','group_concat(DISTINCT rm_rolename_en separator ", ") as rm_rolename_en','group_concat(DISTINCT rm_rolename_ar separator ", ") as rm_rolename_ar','AppStaffInfoMain_PK','appsim_roleforcourse','oum_opalmemberregmst_fk'])
         ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appsim_OpalMemberRegMst_FK')
        ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsim_StaffInfoRepo_FK')
        ->leftJoin('rolemst_tbl','find_in_set(rolemst_pk,appsim_roleforcourse)')
        ->leftJoin('opalusermst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
        ->leftJoin('opalcountrymst_tbl','oum_mobnocc = opalcountrymst_pk')
        ->leftJoin('applicationdtlsmain_tbl','applicationdtlsmain_pk = appsim_ApplicationDtlsMain_FK')
        //   ->andWhere("appsit_status =3")
          ->where("oum_opalmemberregmst_fk = :regpk ",[':regpk'=>$regPk])
        ->andWhere("appdm_projectmst_fk != 1");
         if($userProjPk){
         $userProjPks = explode(',',$userProjPk);
         $query->andWhere(["IN","rm_projectmst_fk" ,$userProjPks]);
    }
        $staffdatacentrefetch =  $query->groupBy('staffinforepo_pk')
         ->asArray()
         ->all();
        return $staffdatacentrefetch;
    } 
    public function actionGetCentreliststaffDtls1()
    {
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
         $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
         $staffdatacentrefetch = \app\models\AppstaffinfomainTbl::find()
        ->select(['staffinforepo_pk','oum_opalmemberregmst_fk','omrm_branch_en','omrm_branch_ar','ocym_countrydialcode as countrycode','appdm_projectmst_fk','sir_idnumber','sir_emailid','rm_rolename_en','sir_mobnum','rm_rolename_ar','sir_name_en','sir_name_ar'])
         ->leftjoin('opalmemberregmst_tbl','opalmemberregmst_pk = appsim_OpalMemberRegMst_FK')
         ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsim_StaffInfoRepo_FK')
         ->leftJoin('rolemst_tbl','rolemst_pk = appsim_mainrole')
         ->leftJoin('opalusermst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
         ->leftJoin('opalusermst_tbl','oum_mobnocc = opalcountrymst_pk')
         ->leftjoin('applicationdtlsmain_tbl','applicationdtlsmain_pk = appsim_ApplicationDtlsMain_FK')
         ->andWhere("appsim_OpalMemberRegMst_FK = ".$requestdata)
         ->groupBy('staffinforepo_pk')
         ->asArray()
         ->all();
        return $staffdatacentrefetch;
    } 
    public function actionUserstafffetchdata(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        // print_r($requestdata);
        // exit;
        $staffdatafetch = \app\models\AppstaffinfomainTbl::find()
        ->select(['staffinforepo_pk','omrm_branch_en','omrm_branch_ar','appdm_projectmst_fk','ocym_countrydialcode as countrycode','sir_idnumber','sir_emailid','sir_mobnum','sir_name_en','sir_name_ar','group_concat(DISTINCT rm_rolename_en separator ", ") as rm_rolename_en','group_concat(DISTINCT rm_rolename_ar separator ", ") as rm_rolename_ar','AppStaffInfoMain_PK','appsim_roleforcourse'])
        ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appsim_OpalMemberRegMst_FK')
        ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsim_StaffInfoRepo_FK')
        ->leftJoin('rolemst_tbl','find_in_set(rolemst_pk,appsim_roleforcourse)')
        ->leftJoin('opalusermst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
        ->leftJoin('opalcountrymst_tbl','oum_mobnocc = opalcountrymst_pk')
        ->leftJoin('applicationdtlsmain_tbl','applicationdtlsmain_pk = appsim_ApplicationDtlsMain_FK')
        ->where(['oum_opalmemberregmst_fk'=> $requestdata]) 
        ->andWhere("appdm_projectmst_fk != 1")
        ->groupBy('staffinforepo_pk')
        ->asArray()
        ->all();
        //echo'<pre>';print_r($staffdatafetch->createCommand()->getRawSql());exit;
        return $staffdatafetch;
    }
    public function actionUserstafffetchdata1(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        // print_r($requestdata);
        // exit;
        $staffdatafetch = \app\models\AppstaffinfomainTbl::find()
        ->select(['staffinforepo_pk','omrm_branch_en','oum_opalmemberregmst_fk','omrm_branch_ar','appdm_projectmst_fk','sir_idnumber','sir_emailid','rm_rolename_en','sir_mobnum','rm_rolename_ar','sir_name_en','sir_name_ar'])
        ->leftjoin('opalmemberregmst_tbl','opalmemberregmst_pk = appsim_OpalMemberRegMst_FK')
        ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsim_StaffInfoRepo_FK')
        ->leftJoin('rolemst_tbl','rolemst_pk = appsim_mainrole')
        ->leftJoin('opalusermst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
        ->leftjoin('applicationdtlsmain_tbl','applicationdtlsmain_pk = appsim_ApplicationDtlsMain_FK')
        ->where(['oum_opalmemberregmst_fk'=> $requestdata]) 
        ->groupBy('staffinforepo_pk')
        ->asArray()
        ->all();
        //echo'<pre>';print_r($staffdatafetch->createCommand()->getRawSql());exit;
        return $staffdatafetch;
    }
    public function actionUserstafffetchcentredata(){
        $request_body = file_get_contents('php://input');
        $requestdata = json_decode($request_body, true);
        // print_r($requestdata);
        // exit;
        $staffdatacentrefetch = \app\models\AppstaffinfomainTbl::find()
        ->select(['staffinforepo_pk','omrm_branch_en','oum_opalmemberregmst_fk','omrm_branch_ar','appdm_projectmst_fk','sir_idnumber','sir_emailid','rm_rolename_en','sir_mobnum','rm_rolename_ar','sir_name_en','sir_name_ar'])
        ->leftjoin('opalmemberregmst_tbl','opalmemberregmst_pk = appsim_OpalMemberRegMst_FK')
        ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsim_StaffInfoRepo_FK')
        ->leftJoin('rolemst_tbl','rolemst_pk = appsim_mainrole')
        ->leftJoin('opalusermst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
        ->leftjoin('applicationdtlsmain_tbl','applicationdtlsmain_pk = appsim_ApplicationDtlsMain_FK')
        // ->where(['oum_opalmemberregmst_fk'=> $requestdata]) 
        // ->andWhere("appdm_projectmst_fk != 1")
        ->groupBy('staffinforepo_pk')
        ->asArray()
        ->all();
        //echo'<pre>';print_r($staffdatafetch->createCommand()->getRawSql());exit;
        $staffcentrearray=[
            'staffcentrearraylist'=>$staffdatacentrefetch,
        ];
        return $this->asJson($staffcentrearray);
    }
    
    public function actionGetUserstktypeDtls()
    {
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userdatafetch = \app\models\OpalmemberregmstTbl::find()
        ->select(['opalmemberregmst_pk','omrm_tpname_en','omrm_tpname_ar'])
        ->leftjoin('applicationdtlsmain_tbl','appdm_opalmemberregmst_fk = opalmemberregmst_pk')
        ->where('omrm_memberStatus = :omrm_memberStatus and appdm_projectmst_fk =2 and omrm_intendforregistration in (1,3) and appdm_issuspended = 2', [':omrm_memberStatus' => 'A']) 
        ->groupBy('opalmemberregmst_pk')
        ->asArray()
        ->all();
        
        $userdatafetchtechras = \app\models\OpalmemberregmstTbl::find()
        ->select(['opalmemberregmst_pk','omrm_branch_en','omrm_branch_ar'])
        ->leftjoin('applicationdtlsmain_tbl','appdm_opalmemberregmst_fk = opalmemberregmst_pk')
        ->where('omrm_memberStatus = :omrm_memberStatus and appdm_projectmst_fk in (4) and omrm_intendforregistration in (2,3) and appdm_issuspended = 2', [':omrm_memberStatus' => 'A']) 
        ->groupBy('opalmemberregmst_pk')
        ->asArray()
        ->all();
        
        $userdatafetchtechivms = \app\models\OpalmemberregmstTbl::find()
        ->select(['opalmemberregmst_pk','omrm_branch_en','omrm_branch_ar'])
        ->leftjoin('applicationdtlsmain_tbl','appdm_opalmemberregmst_fk = opalmemberregmst_pk')
        ->where('omrm_memberStatus = :omrm_memberStatus and appdm_projectmst_fk in (5) and omrm_intendforregistration in (2,3) and appdm_issuspended = 2', [':omrm_memberStatus' => 'A']) 
        ->groupBy('opalmemberregmst_pk')
        ->asArray()
        ->all();
      
        $stktypeuserdata = \app\models\OpalstkholdertypmstTbl::find()
        ->select(['oshm_stakeholdertype','opalstkholdertypmst_pk'])        
        ->Where(['oshm_status'=>1])
        ->andWhere(['or',['opalstkholdertypmst_pk'=>1],['opalstkholdertypmst_pk'=>2]])
        ->orderBy(['opalstkholdertypmst_pk' => SORT_ASC])
        ->asArray()
        ->all();
        $roleuserstktypearry=[
            'stktypeuserdata'=>$stktypeuserdata,
            'userdatafetchlist'=>$userdatafetch,
            'userdatafetchlisttechras'=>$userdatafetchtechras,
            'userdatafetchlisttechivms'=>$userdatafetchtechivms,
        ];
        return $this->asJson($roleuserstktypearry);
    } 
// get-rolestktype-dtls
    public function actionGetRolestktypeDtls()
    {
        $projecttypedata = \app\models\ProjectmstTbl::find()
        ->select(['projectmst_pk','pm_projectname_en','pm_projectname_ar'])
        ->Where(['pm_projtype'=>2])        
        ->asArray()
        ->all();

        $stktypelistdata = \app\models\OpalstkholdertypmstTbl::find()
        ->select(['oshm_stakeholdertype','opalstkholdertypmst_pk'])        
        ->Where(['oshm_status'=>1])
        ->andWhere(['or',['opalstkholdertypmst_pk'=>1],['opalstkholdertypmst_pk'=>2]])
        ->orderBy(['opalstkholdertypmst_pk' => SORT_ASC])
        ->asArray()
        ->all();
      
        $projectstktypearry=[
            'projectdata'=>$projecttypedata,
            'stktypedata'=>$stktypelistdata,
        ];
        return $this->asJson($projectstktypearry);
       
    } 
    public function actionGetUsersDataDtls()
    {
        
        $userList=\app\models\OpalusermstTbl::find()
         ->select(["concat_ws(' ', oum_firstname) as stafName",'oum_emailid as emailid','oshm_stakeholdertype as stakeholdertype','omrm_branch_en as branch',
         'oum_idnumber as civilNo','oum_mobno as mobilno','rm_rolename_en as roleName_en','rm_rolename_ar as roleName_ar','oum_status as status','oum_emailconfirmstatus as emailstatus',
         'DATE_FORMAT(oum_createdon,"%d-%m-%Y") as addedOn','DATE_FORMAT(oum_updatedon,"%d-%m-%Y") as lastUpdateOn','oum_isthirdpartyagent as thirdPartyAgent',
         'case when(oum_isthirdpartyagent= 1 AND oum_isthirdpartyagent != NULL) THEN "Yes"
               when(oum_isthirdpartyagent=2 OR oum_isthirdpartyagent = NULL) THEN "No" END  as isthirdPartyAgent'
         ])
         ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = oum_opalmemberregmst_fk')
         ->leftJoin('opalstkholdertypmst_tbl','opalstkholdertypmst_pk = omrm_stkholdertypmst_fk')
         ->leftJoin('rolemst_tbl','rm_opalstkholdertypmst_fk = opalstkholdertypmst_pk')
         ->orderBy(['opalusermst_pk' => SORT_ASC])
         ->groupBy('opalusermst_pk')
         ->asArray()
         ->all(); 
        $userList=[
            'userList'=>$userList,
        ];
        return $this->asJson($userList);
       
    } 
    public function actionGetusersdtls(){
        $formatedData = \app\models\OpalusermstTbl::getUsergridList();
        return $this->asJson([
               'data' => $formatedData,
            //    'msg' => 'Success',
            //    'status' => 100,
           ]);
    }
    public function actionGetrolesdtls(){
 
        $formatedData = \app\models\RolemstTbl::getUserroleList();
        
        return $this->asJson([
               'data' => $formatedData,
            //    'msg' => 'Success',
            //    'status' => 100,
           ]);
       
        
    }
    public function actionGetRoledataDtls()
    {
        $roleList = \app\models\RolemstTbl::find()
        ->select(['oshm_stakeholdertype as stakeholdertype','proj.pm_projectname_en as projectname_en','proj.pm_projectname_ar as projectname_ar','rm_rolename_ar as rolename_ar','rolemst_pk as rolepk',
        'rm_rolename_en as rolename_en','DATE_FORMAT(rm_createdon,"%d-%m-%Y") as addedOn','DATE_FORMAT(rm_updatedon,"%d-%m-%Y") as updatedOn','rm_status as status',
        'rm_higherrole as higherRole'])
        ->leftJoin('projectmst_tbl proj','proj.projectmst_pk = rm_projectmst_fk')
        ->leftJoin('opalstkholdertypmst_tbl','opalstkholdertypmst_pk = rm_opalstkholdertypmst_fk')
//        ->leftJoin('roleallocationdtls_tbl rallocation','rallocation.rad_RoleMst_FK = rolemst_pk')
        ->orderBy(['opalstkholdertypmst_pk' => SORT_ASC])
        ->groupBy('rolemst_pk')
        ->asArray()
        ->all();
        // echo'<pre>';
        // print_r($roleList);exit;
        $roleList=[
            'roleList'=>$roleList,
        ];
        return $this->asJson($roleList);
    }
    
    //fetch-user-details
    public function actionFetchUserDetails(){
        
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        $rolepk = Security::decrypt($resParam->rolepk);
           
        $rolepk = Security::sanitizeInput($rolepk,'number');
        $stkpk = Security::sanitizeInput($resParam->stkpk,'number');
        // echo'<pre>';print_r($resParam) ; echo'++++'; print_r($rolepk);
        //                         exit;  
        // $mcpPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $baseModules = OpalsubmodulemstTbl::getModuleItsSubmodulebyStakholder($stkpk);

                $tmpMpk = '';
                $baseModulesArr = $moduleIdArr = [];
                foreach ($baseModules as $key => $bm) {
                      if($tmpMpk == '' || ($tmpMpk != $bm['mPk'])){
                        $tmpMpk = $bm['mPk'];
                        $baseModule['modules'] = $bm['mName'];
                        $baseModule['modulesinfocontent'] = $bm['minfo'];
                        $baseModule['module_id'] = $bm['mPk'];
                        $mAccess = explode(',',$bm['mAccess']);
                        // 1 - create,2-view,3- update,4-delete,5-Approval,6-Download
                        $baseModule['create'] = in_array(1, $mAccess)?'N':'NIL';
                        $baseModule['read'] = in_array(2, $mAccess)?'N':'NIL';
                        $baseModule['update'] = in_array(3, $mAccess)?'N':'NIL';
                        $baseModule['delete'] = in_array(4, $mAccess)?'N':'NIL';
                        $baseModule['approval'] = in_array(5, $mAccess)?'N':'NIL';
                        $baseModule['download'] = in_array(6, $mAccess)?'N':'NIL';
                        $baseModule['extend'] = true;
                        $baseModule['parentEnable'] = true;
                        $baseModule['childEnable'] = false;
                        $baseModule['aC'] = false;
                        $baseModule['aR'] = false;
                        $baseModule['aU'] = false;
                        $baseModule['aD'] = false;
                        $baseModule['aA'] = false;
                        $baseModule['aDwn'] = false;
                        $baseModule['child'] = 1;
                        // echo'<pre>';print_r($baseModule);exit;
                        $baseModulesArr[] = $baseModule;
                    }

                    $baseSubModule['modules'] = $bm['smName'];
                    $baseSubModule['module_id'] = $bm['mPk'].'_'.$bm['smPk'];
                    $smAccess = explode(',',$bm['smAccess']);
                    $baseSubModule['create'] = in_array(1, $smAccess)?'N':'NIL';
                    $baseSubModule['read'] = in_array(2, $smAccess)?'N':'NIL';
                    $baseSubModule['update'] = in_array(3, $smAccess)?'N':'NIL';
                    $baseSubModule['delete'] = in_array(4, $smAccess)?'N':'NIL';
                    $baseSubModule['approval'] = in_array(5, $smAccess)?'N':'NIL';
                    $baseSubModule['download'] = in_array(6, $smAccess)?'N':'NIL';
                    $baseSubModule['parentEnable'] = false;
                    $baseSubModule['childEnable'] = true;
                    $baseSubModule['aC'] = false;
                    $baseSubModule['aR'] = false;
                    $baseSubModule['aU'] = false;
                    $baseSubModule['aD'] = false;
                    $baseSubModule['aA'] = false;
                    $baseSubModule['aDwn'] = false;
                   
                    $baseModulesArr[] = $baseSubModule;
                    $moduleIdArr[$bm['mPk']][] = $bm['mPk'].'_'.$bm['smPk'];

                }

                $data['baseModules'] = $baseModulesArr;
                $data['modSubModIds'] = $moduleIdArr;
                              

        return $this->asJson([
            'data' => $data,
           
        ]);
    }
        // get-user-centerlist-dtls(dev)
        public function actionGetUserCenterlistDtls()
        {
            
            $centerList=\app\models\OpalusermstTbl::find()
             ->select(["concat_ws(' ', oum_firstname) as stafName",'oum_emailid as emailid',
             'oum_idnumber as civilNo','oum_mobno as mobilno','rm_rolename_en as roleName_en','rm_rolename_ar as roleName_ar','oum_status as status',
             'DATE_FORMAT(oum_createdon,"%d-%m-%Y") as addedOn','DATE_FORMAT(oum_updatedon,"%d-%m-%Y") as lastUpdateOn'
             ])
             ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = oum_opalmemberregmst_fk')
             ->leftJoin('opalstkholdertypmst_tbl','opalstkholdertypmst_pk = omrm_stkholdertypmst_fk')
             ->leftJoin('rolemst_tbl','rm_opalstkholdertypmst_fk = opalstkholdertypmst_pk')
             ->orderBy(['opalusermst_pk' => SORT_ASC])
             ->groupBy('opalusermst_pk')
             ->asArray()
             ->all(); 
    
            $centerList=[
                'centerList'=>$centerList,
            ];
            return $this->asJson($centerList);
           
        }
        public function actionGetusercenterlist()
        {
            $formatedData = \app\models\OpalusermstTbl::getUserCentergridList();
            return $this->asJson([
                   'data' => $formatedData,
                //    'msg' => 'Success',
                //    'status' => 100,
               ]);
        }
        // update-manageorcenter-users
    public function actionUpdateManageorcenterUsers(){
        
        $loginuserPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');
            $roleStatus = Security::sanitizeInput($resParam->status,'string');
            
            $rStatus = ($roleStatus == "A")?"I":(($roleStatus == "I")?"A":"E");
            $OpalusermstTbl = \app\models\OpalusermstTbl::find()
            ->where('opalusermst_pk=:pk',[':pk'=>$userPk])->one();
             
            if(!empty($OpalusermstTbl)){
                // rm_status
                $OpalusermstTbl->oum_status = $rStatus;
                $OpalusermstTbl->oum_updatedon = date('Y-m-d H:i:s');
                $OpalusermstTbl->oum_updatedby = $loginuserPk;
               if(!$OpalusermstTbl->save()){
                    $status = 1; // db error
                    $message='db error';
                }else{
                    
                    $message=($roleStatus == "A")?"The User has been Deactivated.":(($roleStatus == "I")?"The User has been Activated.":"Email");
                }
            }else{
                    $status = 2; // No data available
                   
                }
        }else{
             $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            // 'status' => $status,
        ]);
    }
    

    public function actionUpdateStakholderUsers(){
          $loginuserPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->userPk) && !empty($resParam->userPk)){
            $userPk = Security::decrypt($resParam->userPk);
            $userPk = Security::sanitizeInput($userPk,'number');
            $roleStatus = Security::sanitizeInput($resParam->status,'number');
            $rStatus = ($roleStatus == 1)?2:(($roleStatus == 2)?1:3);
            $RolemstTbl = \app\models\RolemstTbl::find()
            ->where('rolemst_pk=:pk',[':pk'=>$userPk])->one();

            if(!empty($RolemstTbl)){
                // rm_status
                $RolemstTbl->rm_status = $rStatus;
                $RolemstTbl->rm_updatedon = date('Y-m-d H:i:s');
                $RolemstTbl->rm_updatedby = $loginuserPk;
               if(!$RolemstTbl->save()){
                    $status = 1; // db error
                    $message='db error';
                }else{
                    $message=$message=($roleStatus == 1)?"The Role has been Deactivated.":(($roleStatus == 2)?"The Role has been Activated.":"Email");;
                }
            }else{
                    $status = 2; // No data available
                   
                }
        }else{
             $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            // 'status' => $status,
        ]);

    }
    // stk-update-user-details
    public function actionStkUpdateUserDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];
        if(isset($resParam->rolepk) && !empty($resParam->rolepk)){
            $rolepk = Security::decrypt($resParam->rolepk);
//            $rolepk = Security::sanitizeInput($rolepk,'number');              
            $stkpk = Security::sanitizeInput($resParam->stkpk,'number');              
                $userAccess = RoleallocationdtlsTbl::getUserPermission($rolepk);   
                // echo'<pre>';print_r($stkpk) ; echo'++++'; print_r($rolepk);
                //                 exit;             
                $userAccessFormatin = [];
                
                foreach ($userAccess as $key => $ua) {
                    $modPk = $ua['rad_OpalModuleMst_FK'].'_'.$ua['rad_OpalSubModuleMst_FK'];
                    if($userAccessFormatin[$modPk] != null)
                    {
                        $userAccessFormatin[$modPk] = array_unique(array_merge($userAccessFormatin[$modPk],str_replace('"','',str_replace('[','',str_replace(']','',explode(',',json_decode($ua['rad_Access'])))))));
                    }
                    else
                    {
                        $userAccessFormatin[$modPk] = array_unique(str_replace('"','',str_replace('[','',str_replace(']','',explode(',',json_decode($ua['rad_Access'])))))) ;
                    }
                     
                }
               
                
                
                $baseModules = OpalsubmodulemstTbl::getModuleItsSubmodulebyStakholder($stkpk);
                $tmpMpk = '';
                $baseModulesArr = $moduleIdArr = $chekedAcess = [];
                $aC = $aR = $aU = $aD = $aA = $aDwn = $prevTempPk = '';
                $init = $prevInit = 0;
                                // echo'<pre>';print_r($baseModules);print_r($rolepk);
                                // exit;
                foreach ($baseModules as $key => $bm) {
                    
                    if($tmpMpk == '' || ($tmpMpk != $bm['mPk'])){
                        $tmpMpk = $bm['mPk'];
                        $baseModule['modules'] = $bm['mName'];
                        $baseModule['modulesinfocontent'] = $bm['minfo'];
                        $baseModule['module_id'] = $bm['mPk'];
                        $mAccess = explode(',',$bm['mAccess']);
                        
                        // echo'<pre>';print_r($mAccess);print_r($rolepk);
                        // exit;
                        $baseModule['create'] = in_array(1, $mAccess)?'N':'NIL';
                        $baseModule['read'] = in_array(2, $mAccess)?'N':'NIL';
                        $baseModule['update'] = in_array(3, $mAccess)?'N':'NIL';
                        $baseModule['delete'] = in_array(4, $mAccess)?'N':'NIL';
                        $baseModule['approval'] = in_array(5, $mAccess)?'N':'NIL';
                        $baseModule['download'] = in_array(6, $mAccess)?'N':'NIL';
                        // echo'<pre>';print_r($baseModule);print_r($rolepk);
                        // exit;
                        $baseModule['extend'] = true;
                        $baseModule['parentEnable'] = true;
                        $baseModule['childEnable'] = false;
                        $baseModule['child'] = 1;
                        $baseModulesArr[] = $baseModule;
                        
                        $baseModulesArr[$prevInit]['aC'] = ($aC == 'Y')?true:false;
                        $baseModulesArr[$prevInit]['aR'] = ($aR == 'Y')?true:false;
                        $baseModulesArr[$prevInit]['aU'] = ($aU == 'Y')?true:false;
                        $baseModulesArr[$prevInit]['aD'] = ($aD == 'Y')?true:false;
                        $baseModulesArr[$prevInit]['aA'] = ($aA == 'Y')?true:false;
                        $baseModulesArr[$prevInit]['aDwn'] = ($aDwn == 'Y')?true:false;
                        
                        if(($aC == 'Y' || $aC=='') && ($aR == 'Y' || $aR=='') && ($aU == 'Y' || $aU=='') &&
                            ($aD == 'Y' || $aD=='') && ($aA == 'Y' || $aA=='') && ($aDwn == 'Y'|| $aDwn=='')) 
                        {
                            $baseModulesArr[$prevInit]['aAll'] = true;
                        } else {
                            $baseModulesArr[$prevInit]['aAll'] = false;
                        }
                        
                        // Above condition is for edit permission
                        
                        $aC = $aR = $aU = $aD = $aA = $aDwn = '';
                        $prevInit = $init;
                        $init +=1;
                    }

                    
                    $baseSubModule['modules'] = $bm['smName'];
                    $baseSubModule['module_id'] = $modId = $bm['mPk'].'_'.$bm['smPk'];
                    $smAccess = explode(',',$bm['smAccess']);

                    $create = in_array(1, $smAccess)?'N':'NIL';
                    if($create != 'NIL'){
                        $baseSubModule['create'] = in_array(1, $userAccessFormatin[$modId])?'Y':$create;
                        if($baseSubModule['create'] == 'Y' && ($aC == '' || $aC == 'Y')){
                            $aC = 'Y';
                        }else{
                            $aC = 'N';
                        }

                        if($baseSubModule['create'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_1',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>1
                            ];
                        }
                    }else{
                        $baseSubModule['create'] = 'NIL';
                    }

                    $read = in_array(2, $smAccess)?'N':'NIL';
                    if($read != 'NIL'){
                        $baseSubModule['read'] = in_array(2, $userAccessFormatin[$modId])?'Y':$read;
                        if($baseSubModule['read'] == 'Y' && ($aR == '' || $aR == 'Y')){
                            $aR = 'Y';
                        }else{
                            $aR = 'N';
                        }
                        if($baseSubModule['read'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_2',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>2
                            ];
                        }
                    }else{
                        $baseSubModule['read'] = 'NIL';
                    }

                    $update = in_array(3, $smAccess)?'N':'NIL';
                    if($update != 'NIL'){
                        $baseSubModule['update'] = in_array(3, $userAccessFormatin[$modId])?'Y':$update;
                        if($baseSubModule['update'] == 'Y' && ($aU == '' || $aU == 'Y')){
                            $aU = 'Y';
                        }else{
                            $aU = 'N';
                        }
                        if($baseSubModule['update'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_3',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>3
                            ];
                        }
                    }else{
                        $baseSubModule['update'] = 'NIL';
                    }

                    $delete = in_array(4, $smAccess)?'N':'NIL';
                    if($delete != 'NIL'){
                        $baseSubModule['delete'] = in_array(4, $userAccessFormatin[$modId])?'Y':$delete;
                        if($baseSubModule['delete'] == 'Y' && ($aD == '' || $aD == 'Y')){
                            $aD = 'Y';
                        }else{
                            $aD = 'N';
                        }
                        if($baseSubModule['delete'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_4',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>4
                            ];
                        }
                    }else{
                        $baseSubModule['delete'] = 'NIL';
                    }

                    $approval = in_array(5, $smAccess)?'N':'NIL';
                    if($approval != 'NIL'){
                        $baseSubModule['approval'] = in_array(5, $userAccessFormatin[$modId])?'Y':$approval;
                        if($baseSubModule['approval'] == 'Y' && ($aA == '' || $aA == 'Y')){
                            $aA = 'Y';
                        }else{
                            $aA = 'N';
                        }
                        if($baseSubModule['approval'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_5',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>5
                            ];
                        }
                    }else{
                        $baseSubModule['approval'] = 'NIL';
                    }

                    $download = in_array(6, $smAccess)?'N':'NIL';
                    if($download != 'NIL'){
                        $baseSubModule['download'] = in_array(6, $userAccessFormatin[$modId])?'Y':$download;
                        if($baseSubModule['download'] == 'Y' && ($aDwn == '' || $aDwn == 'Y')){
                            $aDwn = 'Y';
                        }else{
                            $aDwn = 'N';
                        }
                        if($baseSubModule['download'] == 'Y'){
                            $chekedAcess[] = [
                                'name'=>'module_'.$modId.'_6',
                                'value'=>1,
                                'module'=>$bm['mPk'],
                                'submodule'=>$bm['smPk'],
                                'type'=>6
                            ];
                        }
                    }else{
                        $baseSubModule['download'] = 'NIL';
                    }

                    $baseSubModule['parentEnable'] = false;
                    $baseSubModule['childEnable'] = true;
                    $baseSubModule['aC'] = false;
                    $baseSubModule['aR'] = false;
                    $baseSubModule['aU'] = false;
                    $baseSubModule['aD'] = false;
                    $baseSubModule['aA'] = false;
                    $baseSubModule['aDwn'] = false;
                    $baseSubModule['aAll'] = false;
                    $baseModulesArr[] = $baseSubModule;
                    $moduleIdArr[$bm['mPk']][] = $bm['mPk'].'_'.$bm['smPk'];

                    $init +=1;

                }
                if(!empty($baseModulesArr)){
                    $baseModulesArr[$prevInit]['aC'] = ($aC == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aR'] = ($aR == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aU'] = ($aU == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aD'] = ($aD == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aA'] = ($aA == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aDwn'] = ($aDwn == 'Y')?true:false;
                    $baseModulesArr[$prevInit]['aAll'] =  (($aC == 'Y' || !in_array(1, $mAccess)) && ($aR == 'Y' || !in_array(2, $mAccess)) && ($aU == 'Y' || !in_array(3, $mAccess)) && ($aD == 'Y' || !in_array(4, $mAccess)) && ($aA == 'Y' || !in_array(5, $mAccess)) && ($aDwn == 'Y' || !in_array(6, $mAccess)) )?true:false;
                }
                

                $data['baseModulesAccess'] = $baseModulesArr;
                $data['modSubModIds'] = $moduleIdArr;
                $data['checkedAccess'] = $chekedAcess;
                $message = $this->baseErrorMessage('success');
                $status = 100;
            
        }
        // echo'<pre>',print_r($data['checkedAccess']);exit;p
        return $this->asJson([
            'data' => $data,
        ]);
    }
    
    // check-is-role-already-exists
    public function actionCheckIsRoleAlreadyExists(){
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $stkholderType = Security::sanitizeInput($data['stkholderType'], "number");
        $dataToCheck = strtolower(trim($data['data']));
        $type = Security::sanitizeInput($data['type'], "string");
        $isAvailable = false;
        if(!empty($dataToCheck)){
            switch ($type) {
                case 'arrole':
                    $isAvailable = RolemstTbl::checkIsRoleAlreadyExit($dataToCheck,$stkholderType,$type);
                    break;
               case 'rolearbic':
                    $isAvailable = RolemstTbl::checkIsRoleAlreadyExit($dataToCheck,$stkholderType,$type);
                    break;
                default:
                    return false;
            }
        }
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'available' => $isAvailable,
        ]);
    }
    // check-is-user-civil-or-email-already-exists
    public function actionCheckIsUserCivilOrEmailAlreadyExists(){
        $request_body	= file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        $stkholderType = Security::sanitizeInput($data['stkholderType'], "string");
        $dataToCheck = strtolower(trim(Security::sanitizeInput($data['data'], "string_spl_char")));
        $type = Security::sanitizeInput($data['type'], "string");
        $usrpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $isAvailable = false;
        if(!empty($dataToCheck)){
            $isAvailable = OpalusermstTbl::checkIsCivilOrEmailAlreadyExists($dataToCheck,$usrpk,$stkholderType,$type);
        }
        return $this->asJson([
            'msg' => 'success',
            'status' => 1,
            'available' => $isAvailable,
        ]);
    }
    public function actionGethigherrolesdtls(){
        $formatedData = \app\models\RolemstTblQuery::gethigerroles();
        return $this->asJson([
               'data' => $formatedData,
           ]);
    }
    
    //checking exiting users
    public function actionGetcheckstaffuser(){
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
      
       $saffDataTbl = OpalusermstTbl::getstaffuserTbl($data['data']);
    
        return $this->asJson([
               'data' =>$saffDataTbl,
           ]);
    }

    
    public function actionGetProjectDtls()
    {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
      
        if(!empty($data['data'])){
            $project_array = array_unique($data['data']);
        $projectList=\app\models\ProjectmstTbl::find()
         ->select(['pm_certificationname_en','pm_certificationname_ar',
         'projectmst_pk'
         ])
         ->where('projectmst_pk in ('.implode(", " , $project_array).')')
         ->orderBy(['projectmst_pk' => SORT_ASC])
         ->groupBy('projectmst_pk')
         ->asArray()
         ->all(); 
       }
        $projectList=[
            'projectList'=>$projectList,
        ];
        return $this->asJson($projectList);
       
}

    public function actionGetCourseDtls()
    {
        
        $courseList=\app\models\StandardcoursemstTbl::find()
         ->select(['scm_coursename_en','scm_coursename_ar',
         'standardcoursemst_pk'
         ])
         ->Where("scm_status = '1' OR  scm_status = '3'")             
         ->orderBy(['standardcoursemst_pk' => SORT_ASC])
         ->groupBy('standardcoursemst_pk')
         ->asArray()
         ->all(); 

        $courseList=[
            'courseList'=>$courseList,
        ];
        return $this->asJson($courseList);
       
    }
}