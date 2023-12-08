<?php

namespace api\modules\ivms\components; 

use Yii;
use app\models\OpalmemberregmstTbl;
use app\models\ApplicationdtlstmpTbl;
use app\models\AppcompanydtlstmpTbl;
use app\models\AppinstinfotmpTbl;


class ivmsbusinesslogic {
   
    public function getmain(){
    
    $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    
    $request_body	= file_get_contents('php://input');
    $request = json_decode($request_body, true);

    $response = [];
    $projecttype =$request['projectType'];

    $dataTmp = \app\models\ApplicationdtlstmpTbl::find()
    ->select(['*'])
    ->innerjoin('appinstinfotmp_tbl insinfor','insinfor.appiit_applicationdtlstmp_fk = applicationdtlstmp_tbl.applicationdtlstmp_pk')
    ->where(['appdt_opalmemberregmst_fk' => $regPk])
    ->andwhere(['appdt_projectmst_fk' =>  5])
    ->orderBy(['applicationdtlstmp_pk' => SORT_ASC])
    ->asArray()->one();

    $data = \app\models\ApplicationdtlsmainTbl::find()
    ->select(['*','DATE_FORMAT(appdm_certificategenon,"%d-%m-%Y") AS certificategenon',
                    'DATE_FORMAT(appdm_certificateexpiry,"%d-%m-%Y") AS certificateexpiry'])
    ->innerjoin('appinstinfotmp_tbl insinfor','insinfor.appiit_applicationdtlstmp_fk = applicationdtlsmain_tbl.appdm_applicationdtlstmp_fk')
    ->where(['appdm_opalmemberregmst_fk' => $regPk])
    ->andwhere(['appdm_projectmst_fk' => 5])
    ->orderBy(['applicationdtlsmain_pk' => SORT_ASC])
    ->asArray()->one();
    
    
    $responseData['cert_status'] = "New";
    if(!empty($data['appdm_certificategenon'])){
        $responseData['cert_status'] = "Active";
    }

    if(date('Y-m-d', strtotime($data['appdm_certificateexpiry'])) < date('Y-m-d', strtotime(date("Y/m/d")))){
        $responseData['cert_status'] = "Expired";
    }
    
    if(empty($data['appdm_certificategenon'])){
        $responseData['cert_status'] = "New";
    } 

    $responseData['exp_date'] = $data['certificateexpiry'];

    $now = time(); // or your date as well
    $your_date = strtotime($data['appdm_certificateexpiry']);
    $datediff = $your_date - $now;
    $renewDate = round($datediff / (60 * 60 * 24));
    $responseData['renew_date'] = $renewDate + 1;
    $responseData['overdue_date'] = abs($renewDate + 1);

    $cert_path=Yii::$app->params['opal_cert_path'];
    //echo '<pre>';print_r($dataTmp);exit;
    //echo $dataTmp->appdt_certificatepath;exit;
    $responseData['opal_cert_path']=$cert_path.$dataTmp['appdt_certificatepath'];
    $responseData['opal_siteaudit_path1']=$cert_path.$dataTmp['appdt_auditedreport'];
    $responseData['opal_siteaudit_path']=$cert_path.$data['appdm_auditedreport'];
    $responseData['appdt_certificatepath']=$dataTmp['appdt_certificatepath'];

    if($data){
        $response = ['status' => 1,
                    'data' => $data,
                    'msg' => 'Success',
                    'dataTmp' => $dataTmp,
                    'response' => $responseData];
    } else {
        $response = ['status' => 2,
                        'data' => '',
                        'data1'=>$dataTmp,
                        'msg' => 'Failure']; 
    }
    
    return $response;
    }

    public function savecompaydtls($requestdata){

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
    }
    
    public function saveivmsinstitue($requestdata){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
// print_r($requestdata);exit;
        $model = AppinstinfotmpTbl::find()->where(['appiit_applicationdtlstmp_fk' => $requestdata['apppk']])->one();
        
        //$model->appinstinfotmp_pk = $requestdata['appinstinfotmp_pk'];
        // $model->appiit_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
        $model->appiit_officetype = $requestdata['formvalue']['offtype'];

        if(!empty($requestdata['formvalue']['brancheng']) && !empty($requestdata['formvalue']['brancharab'])){
            $model->appiit_branchname_en = $requestdata['formvalue']['brancheng'];
            $model->appiit_branchname_ar = $requestdata['formvalue']['brancharab'];
        }
        $model->appiit_noofexpat = $requestdata['formvalue']['exp_a'];
        $model->appiit_noofomani = $requestdata['formvalue']['oma_n'];
        $model->appiit_loclatitude = $requestdata['formvalue']['lat'];
        $model->appiit_loclongitude = $requestdata['formvalue']['lang'];
        $model->appiit_locmapurl = $requestdata['formvalue']['site_main'];
        $model->appiit_molpercent = $requestdata['formvalue']['molpercent'];
        $model->appiit_nooftechstaff = $requestdata['formvalue']['no_techstaff'];
        $model->appiit_noofcurlearners = $requestdata['formvalue']['curr_learn'];
        $model->appiit_maxcapacity = $requestdata['formvalue']['trainprovmax'];
        $model->appiit_addrline1 = $requestdata['formvalue']['address1br'];
        $model->appiit_addrline2 = $requestdata['formvalue']['address2br'];
        $model->appiit_statemst_fk = $requestdata['formvalue']['governoratebr'];
        $model->appiit_citymst_fk = $requestdata['formvalue']['wilayatbr'];
        $model->appiit_addrline1 = $requestdata['formvalue']['inst_address1'];
        $model->appiit_addrline2 = $requestdata['formvalue']['inst_address2'];
        $model->appiit_statemst_fk = $requestdata['formvalue']['instgovernorate'];
        $model->appiit_citymst_fk = $requestdata['formvalue']['wila_yat'];
       
        $model->appiit_updatedon = date("Y-m-d H:i:s");
        $model->appiit_updatedby = $userPk;
         
        if($model->save()){
          
            return ['istituepk'=>$model->appinstinfotmp_pk];
              
        } else {
            echo "<pre>";var_dump($model->getErrors());exit;
        }  
    }

}

// $status = $data['formdata']['select_valitate']; 
//     $appDtlsPk = Security::decrypt($data['formdata']['appdtlstmp_id']);
//     $modelComp   = AppcompanydtlstmpTbl::find()->select(['acdt_status'])->where(['acdt_applicationdtlstmp_fk' => $appDtlsPk])->one();
//     $model['acdt_status'] = $modelComp['acdt_status'];
//     $modelIns   =  AppinstinfotmpTbl::find()->select(['appiit_status'])->where(['appiit_applicationdtlstmp_fk' => $appDtlsPk])->one();
//     $model['appiit_status'] = $modelIns['appiit_status'];
//     $modelCont   =  AppoprcontracttmpTbl::find()->select(['appoprct_status'])->where(['appoprct_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all(); 
     
//     foreach($modelCont as $key => $status){
//        $contractarray[] = $status['appoprct_status'];

//     }

//     if(in_array('3' , $contractarray)){
//         $model['appoprct_status'] = 3; 
//     }if(in_array('4' , $contractarray)){
//     $model['appoprct_status'] = 4;

//    }else if(in_array('1' , $contractarray)){
 
//     $model['appoprct_status'] = 1; 
//    }else if(in_array('2' , $contractarray)){
//     $model['appoprct_status'] = 2; 
//    }

//    $modelInt   =  AppintrecogtmpTbl::find()->select(['appintit_status'])->where(['appintit_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all();   
//    foreach($modelInt as $key => $status){
//     $interarray[] = $status['appintit_status'];

//     }

//     if(in_array('3' , $interarray)){
//     $model['appintit_status'] = 3; 
//     }if(in_array('4' , $interarray)){
//     $model['appintit_status'] = 4;

//     }else if(in_array('1' , $interarray)){

//     $model['appintit_status'] = 1; 
//     }else if(in_array('2' , $interarray)){
//     $model['appintit_status'] = 2; 
//     }

//     $docInt   =  AppdocsubmissiontmpTbl::find()->select(['appdst_status'])->where(['appdst_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all();   
//     foreach($docInt as $key => $status){
//      $docarray[] = $status['appdst_status'];

//      }

//      if(in_array('3' , $docarray)){
//      $model['appdst_status'] = 3; 
//      }if(in_array('4' , $docarray)){
//      $model['appdst_status'] = 4;

//      }else if(in_array('1' , $docarray)){

//      $model['appdst_status'] = 1; 
//      }else if(in_array('2' , $docarray)){
//      $model['appdst_status'] = 2; 
//      }

//      $offerInt   =  AppoffercoursetmpTbl::find()->select(['appoct_status'])->where(['appoct_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all();   
//     foreach($offerInt as $key => $status){
//      $offerarray[] = $status['appoct_status'];

//      }

//      if(in_array('3' , $offerarray)){
//      $model['appoct_status'] = 3; 
//      }if(in_array('4' , $offerarray)){
//      $model['appoct_status'] = 4;

//      }else if(in_array('1' , $offerarray)){

//      $model['appoct_status'] = 1; 
//      }else if(in_array('2' , $offerarray)){
//      $model['appoct_status'] = 2; 
//      }

//      $staffInt   =  AppstaffinfotmpTbl::find()->select(['appsit_status'])->where(['appsit_applicationdtlstmp_fk' => $appDtlsPk])->asArray()->all();   
//       foreach($staffInt as $key => $status){
//         $staffarray[] = $status['appsit_status'];

//      }

//      if(in_array('3' , $staffarray)){
//      $model['appsit_status'] = 3; 
//      }if(in_array('4' , $staffarray)){
//      $model['appsit_status'] = 4;

//      }else if(in_array('1' , $staffarray)){

//      $model['appsit_status'] = 1; 
//      }else if(in_array('2' , $staffarray)){
//      $model['appsit_status'] = 2; 
//      }
//     return $model;

