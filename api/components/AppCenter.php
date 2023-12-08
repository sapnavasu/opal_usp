<?php

namespace api\components;
use Yii;
use \common\models\MemberregistrationmstTbl;
use \api\modules\mst\models\CountryMasterQuery;
use \common\components\Common;
use \api\components\Register;
use app\models\OpalusermstTbl;

class AppCenter {
    
      
    public static function saveAppCenter($request){
       
       if(!empty($request['appdtlstmp_id'])){
        $data =  \app\models\ApplicationdtlstmpTbl::updateAppCenterDtls($request);
       } else{
        $data =  \app\models\ApplicationdtlstmpTbl::saveAppCenterDtls($request);
       }
       

       if($data){
            return $data;
       } else {
            return false;
       }
    }

    public static function saveInsCenter($request){
       
       $modelAppObj = \app\models\AppinstinfotmpTbl::find()->where(['appiit_applicationdtlstmp_fk' => $request['appdtlstmp_id']])->one();
    //    $application = \app\models\ApplicationdtlstmpTbl::find()->where(['applicationdtlstmp_pk'=>$request['appdtlstmp_id']])->asArray()->one();
    if($request['projecttype'] == 1){
       if($request['offtype'] == '1'){
   
            if(!empty($request['appinstinfotmp_pk'])){
                $data =  \app\models\AppinstinfotmpTbl::updateInsCenterDtls($request);
            }else{
                    if(!empty($modelAppObj)){
                        $data =  \app\models\AppinstinfotmpTbl::updateInsCenterDtls($request);
                    }else{
                        $data =  \app\models\AppinstinfotmpTbl::saveInsCenterDtls($request);
                    }
            }
       }else{

            if(!empty($request['appinstinfotmp_pk'])){
                $data =  \app\models\AppinstinfotmpTbl::updateInsCenterDtls($request);
            }else{
                    //if(!empty($modelAppObj)){
                      //  $data =  \app\models\AppinstinfotmpTbl::updateInsCenterDtls($request);
                    //}else{
                        $data =  \app\models\AppinstinfotmpTbl::saveInsCenterDtls($request);
                    //}
            }
       }
    }else{
        
        if(!empty($request['appinstinfotmp_pk'])){
            $data =  \app\models\AppinstinfotmpTbl::updateInsCenterDtls($request);
        }else{
            $data =  \app\models\AppinstinfotmpTbl::saveInsCenterDtls($request);
        }
    }  
       
       if($data){
            return $data;
        } else {
            return false;
        }
    }

    public static function saveInsRecCenter($request){
        
        if(!empty($request['appintrecogtmp_pk'])){
            $data =  \app\models\AppintrecogtmpTbl::updateInsRecDtls($request);
        }else{
            $data =  \app\models\AppintrecogtmpTbl::saveInsRecDtls($request);
        }
        
        if($data){
             return $data;
         } else {
             return false;
         }
     }

     public static function saveOprContrCenter($request){
        //echo '<pre>';print_r($request['appoprcontracttmp_pk']);exit;
        if(!empty($request['appoprcontracttmp_pk'])){
            $data =  \app\models\AppoprcontracttmpTbl::updateOprContrCenter($request);
        }else{
            $data =  \app\models\AppoprcontracttmpTbl::saveOprContrCenter($request);
        }
        
        if($data){
             return $data;
         } else {
             return false;
         }
     }

     public static function saveCourse($request){

        if(!empty($request['appoffercoursetmp_pk'])){
            $data =  \app\models\AppoffercoursetmpTbl::updateCourse($request);
        }else{
            $data =  \app\models\AppoffercoursetmpTbl::saveCourse($request);
        }
        

        if($data){
             return $data;
         } else {
             return false;
         }
     }

     public static function saveStaff($request){
        //echo '<pre>';print_r($request);exit;
        if(!empty($request['staffinforepo_pk'])){
            $data =  \app\models\StaffinforepoTbl::updateStaff($request);
        } else{
            $data =  \app\models\StaffinforepoTbl::saveStaff($request);
        }
        
        if($data){
             return $data;
         } else {
             return false;
         }
     }

     public static function saveStaffedu($request){
        if(!empty($request['staffacademics_pk'])){
            $data =  \app\models\StaffinforepoTbl::updateStaffedu($request);
        }else{
            $data =  \app\models\StaffinforepoTbl::saveStaffedu($request);
        }
        

        if($data){
             return $data;
         } else {
             return false;
         }
     }

     public static function saveWorkexp($request){
        
        if(!empty($request['staffworkexp_pk'])){
            $data =  \app\models\StaffinforepoTbl::updateWorkexp($request);
        }else{
            $data =  \app\models\StaffinforepoTbl::saveWorkexp($request);
        }
        

        if($data){
             return $data;
         } else {
             return false;
         }
     }

     public static function saveSubDesk($request){
        
        $data =  \app\models\ApplicationdtlstmpTbl::saveSubDeskSub($request);
        
        if($data){
             return $data;
         } else {
             return false;
         }
     }
     public static function differentfoculpoint($request){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $memberreg = \app\models\OpalmemberregmstTbl::find()->where(['opalmemberregmst_pk'=>$regPk])->one();

        if($memberreg->omrm_intendforregistration == 1){
        $model = \app\models\OpalusermstTbl::find()->where(['opalusermst_pk'=>$userPk])->one();
        $model->oum_projectmst_fk = 1;
        $model->save();
        
         $designination =(string) \app\models\OpaldesignationmstTbl::createNewDesig($request['focalpoint_desig'],$userPk);

        $diffuser = new \app\models\OpalusermstTbl();
        $diffuser->oum_firstname = $request['focalpoint_name'];
        $diffuser->oum_emailid = $request['focalpoint_emailid'];
        $diffuser->oum_mobno = $request['focalpoint_mobno'];
        $diffuser->oum_opaldesignationmst_fk = $designination;
        $diffuser->oum_opalmemberregmst_fk =  $regPk;
        $diffuser->oum_projectmst_fk = 4;
        $diffuser->oum_isfocalpoint = 1;
        $diffuser->oum_status = 'I';
        $diffuser->oum_createdon =  date('Y-m-d H:i:s');
        $diffuser->oum_createdby = $userPk ;


        if(!$diffuser->save()){
           
            var_dump($diffuser->getErrors());exit;
        }else{
         $diffuserinfo = \app\models\OpalusermstTbl::find()
         ->select(['opalusermst_tbl.*','opaldesignationmst_tbl.*'])
         ->leftJoin('opaldesignationmst_tbl','opaldesignationmst_pk = oum_opaldesignationmst_fk')
         ->where(['opalusermst_pk'=>$diffuser->opalusermst_pk])->asArray()->one();
         $sameuser = \app\models\OpalusermstTbl::find()
         ->select(['opalusermst_tbl.*','opaldesignationmst_tbl.*'])
         ->leftJoin('opaldesignationmst_tbl','opaldesignationmst_pk = oum_opaldesignationmst_fk')
         ->where(['opalusermst_pk'=>$userPk])->asArray()->one();
          $memberreg = \app\models\OpalmemberregmstTbl::find()->where(['opalmemberregmst_pk'=>$regPk])->one();
          $memberreg->omrm_intendforregistration =3;
          if(!$memberreg->save()){
            return $memberreg->getErrors();
          }
          $response = OpalusermstTbl::genereateSetPasswordLink($diffuser);
          $setpasslink = $response['resetlink'];
          Register::sendSetPassLinkdifffocal($diffuser->opalusermst_pk, $setpasslink, 'suppreg',$diffuserinfo,$sameuser);
        }
        }else{
            $model = \app\models\OpalusermstTbl::find()->where(['opalusermst_pk'=>$userPk])->one();
            $model->oum_projectmst_fk = 4;
            $model->save();
            
             $designination =(string) \app\models\OpaldesignationmstTbl::createNewDesig($request['focalpoint_desig'],$userPk);
    
            $diffuser = new \app\models\OpalusermstTbl();
            $diffuser->oum_firstname = $request['focalpoint_name'];
            $diffuser->oum_emailid = $request['focalpoint_emailid'];
            $diffuser->oum_mobno = $request['focalpoint_mobno'];
            $diffuser->oum_opaldesignationmst_fk = $designination;
            $diffuser->oum_opalmemberregmst_fk =  $regPk;
            $diffuser->oum_projectmst_fk = 1;
            $diffuser->oum_isfocalpoint = 1;
            $diffuser->oum_status = 'I';
            $diffuser->oum_createdon =  date('Y-m-d H:i:s');
            $diffuser->oum_createdby = $userPk ;
    
            if(!$diffuser->save()){
               
                var_dump($diffuser->getErrors());exit;
            }else{
              $diffuserinfo = \app\models\OpalusermstTbl::find()
              ->select(['opalusermst_tbl.*','opaldesignationmst_tbl.*'])
              ->leftJoin('opaldesignationmst_tbl','opaldesignationmst_pk = oum_opaldesignationmst_fk')
              ->where(['opalusermst_pk'=>$diffuser->opalusermst_pk])->asArray()->one();
              $sameuser = \app\models\OpalusermstTbl::find()
              ->select(['opalusermst_tbl.*','opaldesignationmst_tbl.*'])
              ->leftJoin('opaldesignationmst_tbl','opaldesignationmst_pk = oum_opaldesignationmst_fk')
              ->where(['opalusermst_pk'=>$userPk])->asArray()->one();
              $memberreg = \app\models\OpalmemberregmstTbl::find()->where(['opalmemberregmst_pk'=>$regPk])->one();
              $memberreg->omrm_intendforregistration =3;
              $memberreg->save();
              $response = OpalusermstTbl::genereateSetPasswordLink($diffuser);
              $setpasslink = $response['resetlink'];
             
              Register::sendSetPassLinkdifffocal($diffuser->opalusermst_pk, $setpasslink, 'suppreg',$diffuserinfo,$sameuser);
            }
        }
     }
     public static function saveStaffcourmoher($request){
        //echo '<pre>';print_r($request);exit;
        $data =  \app\models\StaffinforepoTbl::saveStaffcourmoher($request);
        
       
        if($data){
             return $data;
         } else {
             return false;
         }
     }

     public static function saveAppPayment($request){
        
       $data =  \app\models\OpalPaymentTbl::updatePayment($request);


        if(!empty($request['apppymtdtlstmp_pk'])){
            $data =  \app\models\OpalPaymentTbl::updatePayment($request);
        }else{
            $data =  \app\models\OpalPaymentTbl::savePayment($request);
        }
        
        if($data){
             return $data;
         } else {
             return false;
         }
     }


     public static function saveAppInvoice($request){
        $data =  \app\models\OpalInvoiceTbl::updateInvoice($request);
         if(!empty($request['apppytminvoicedtls_pk'])){
             $data =  \app\models\OpalInvoiceTbl::updateInvoice($request);
         }else{
             $data =  \app\models\OpalInvoiceTbl::saveInvoice($request);
         }
         
         if($data){
              return $data;
          } else {
              return false;
          }
      }

      public static function updateInvoiceNo($request){

         if(!empty($request['apppytminvoicedtls_pk'])){
             $data =  \app\models\OpalInvoiceTbl::updateInvoiceNo($request);
         }
         
         if($data){
              return $data;
          } else {
              return false;
          }
      }

      public static function saveAppscheduledate($request){
        $data =  \app\models\AuditscheduleTbl::saveAppscheduledate($request);
        if($data){
             return $data;
         } else {
             return false;
         }
     }
     public static function saveAppanswer($request){
        $data =  \app\models\OpalsiteanswerTbl::updateAnswer($request);

        if($data){
             return $data;
         } else {
             return false;
         }
     }

     public static function saveAppQuestion($request){

        $data =  \app\models\OpalsitequestionTbl::updateQuestion($request);
        if($data){
             return $data;
         } else {
             return false;
         }
     }

     public static function saveAppcategory($request){
        $data =  \app\models\OpalsitecategoryTbl::updateCategory($request);

        if($data){
             return $data;
         } else {
             return false;
         }
     }

     public static function saveAppHistory($request){
             $data =  \app\models\ApplicationdtlshstyTbl::saveApplicationHst($request);
            if($data){
                return $data;
            } else {
                return false;
            }
      }

      public static function saveAppapproval($request){
        $data =  \app\models\AppapprovalhdrTbl::saveAppapproval($request);
       if($data){
         return $data;
        } else {
         return false;
       }
    }

    public static function resetanswer($request){
        $data =  \app\models\OpalsiteanswerTbl::resetAnswer($request);

        if($data){
             return $data;
         } else {
             return false;
         }
     }

     public static function resetgrade($request){
        $questionid = \app\models\OpalsiteanswerTbl::find()->where(['appsiteauditanswerdtls_pk' => $request])->asArray()->one();
        if($questionid){
           $data =  \app\models\OpalsiteanswerTbl::resetGrade($questionid);
          if($data){
             return $data;
         } else {
             return false;
         }
     }
     
    
}

    public static function updategrade($request){
        foreach($request as $key => $value){
            $model = \app\models\OpalsiteanswerTbl::find()->where(['appsiteauditanswerdtls_pk' => $key])->one();
            if($model){
                $model->asaad_grademst_fk = $value;
            if($model->save()){
              //  return $model->appsiteauditanswerdtls_pk;
            } else {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        }  
      }
    }
}



