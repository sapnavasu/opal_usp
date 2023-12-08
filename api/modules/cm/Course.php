<?php

namespace api\modules\cm\components; 

use Yii;
use \app\models\AppauditschedtmpTbl;
use \app\models\AppsiteauditreportcattmpTbl;
use \app\models\AppsiteauditquestionmsttmpTbl;
use \app\models\AppsiteauditanswerdtlsTbl;
use \app\models\ApplicationdtlstmpTbl;
use \app\models\AppstaffinfotmpTbl;
use \app\models\StaffinforepoTbl;
use \app\models\StaffevaluationtmpTbl;
use \app\models\AppapprovalhdrTbl;
use \app\models\ProjapprovalworkflowhrdTbl;
use \app\models\ProjapprovalworkflowuserdtlsTbl;
use \app\models\ProjapprovalworkflowdtlsTbl;
use \app\models\AppoffercoursemainTbl;
use \app\models\StandardcoursemstTbl;
use \app\models\OpalmemberregmstTbl;
use \app\models\OpalInvoiceTbl;
use \yii\db\ActiveRecord;
use \api\components\Security;
use app\models\AppcoursedtlstmpTbl;
use app\models\AppcoursetrnsmainTbl;
use app\models\ApplicationdtlsmainTbl;
use app\models\AppstaffinfomainTbl;
use app\models\AppstafflocationtmpTbl;
use app\models\AppstaffscheddtlsTbl;
use app\models\OpalmodulemstTbl;
use app\models\StaffacademicsTbl;
use app\models\StafflicensedtlsTbl;
use app\models\OpalsubmodulemstTbl;
use app\models\RoleallocationdtlsTbl;
use app\models\StaffcompetencycarddtlsTbl;
use app\models\StaffcompetencycardhdrTbl;
use app\models\StaffworkexpTbl;


class Course {
    
    function mailsendforcouresesubmission($apppk,$additonalinfo){
        $applictionpk = $apppk;
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $applicatondtls = ApplicationdtlstmpTbl::find()->where('applicationdtlstmp_pk = '.$applictionpk)->one();
        $updatemodel = \app\models\AppapprovalhdrTbl::find()->where("aah_applicationdtlstmp_fk =:pk", [':pk' =>$applicatondtls->applicationdtlstmp_pk])->orderBy('appapprovalhdr_pk desc')->one();

        // 2-  new staff added 3- no  new staff added    $updatemodel->aah_formstatus
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl."api/ma/mail/sendmail";
        if($applicatondtls->appdt_status == 2 || $applicatondtls->appdt_status == 4){
            $mailnumber = '';//course_3_1_1  course_3_3_1
            if($applicatondtls->appdt_status == 2){
                $mailnumber = 'course_2_1';
            }else if($applicatondtls->appdt_status == 4){
                $mailnumber = 'course_2_3_1';
            }
                $_data=[
                    'data'=>$applicatondtls,
                    'mailnumber'=>$mailnumber,
                    'type' => 'Mail to the desktop reviewer for validation',
                    'userpk'=>$userPk,
                    'regpk'=>$regPk,
                    'applictionpk'=>$applictionpk
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
     }elseif($applicatondtls->appdt_status == 3){
        //course_3_2_1
            $_data=[
                'data'=>$applicatondtls,
                'type' => 'Mail to the Training Evaluation Centre to re-submit the form for desktop review',
                'userpk'=>$userPk,
                'regpk'=>$regPk,
                'applictionpk'=>$applictionpk
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
     }elseif($updatemodel->aah_formstatus == 2 && ($applicatondtls->appdt_status == 10 || $applicatondtls->appdt_status == 14)){
        $mailnumber = 'course_2_4_1';
        // $mailnumber = 'course_2_4_1_1';
        // $mailnumber = 'course_2_4_3_1';
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'Desktop Review Completed and received for your Validation',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
    }elseif($updatemodel->aah_formstatus == 2 && $applicatondtls->appdt_status == 20){
        $mailnumber = 'course_2_4_2_1';
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'Qualitymanager_authority_decline',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }elseif($applicatondtls->appdt_status == 17){
        $mailnumber = 'course_2_5_11_1';//course_3_14_1
        $mailnumber = 'course_2_4_4_1';
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'Congratulations Certification form has been approved',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }elseif(($updatemodel->aah_formstatus == 3 || $applicatondtls->appdt_apptype == 2 ) && $applicatondtls->appdt_status == 5){
        $mailnumber = 'course_2_5_1_1'; // course_3_4_1
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'Complete payment for Site Audit',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }elseif(($updatemodel->aah_formstatus == 3 || $applicatondtls->appdt_apptype == 2 ) && $applicatondtls->appdt_status == 6){
        $mailnumber = 'course_2_5_4_1'; // course_3_5_1
        $mailnumber = 'course_2_5_2_1';
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'course_2_5_2_1',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }elseif($updatemodel->aah_formstatus == 3 && $applicatondtls->appdt_status == 18){
        $mailnumber = 'course_2_5_3_1';//course_3_6_1 
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'course_2_5_3_1',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }elseif(($updatemodel->aah_formstatus == 3 || $applicatondtls->appdt_apptype == 2 )&& ($applicatondtls->appdt_status == 7 || $applicatondtls->appdt_status == 8)){
        $mailnumber = 'course_2_5_5_1'; //course_3_8_1
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'course_2_5_5_1',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }elseif(($updatemodel->aah_formstatus == 3 || $applicatondtls->appdt_apptype == 2)&& ($applicatondtls->appdt_status == 9)){
        $mailnumber = 'course_2_5_7_1'; //course_3_9_1
        $mailnumber = 'course_2_5_6_1';
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'course_2_5_6_1',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }elseif(($updatemodel->aah_formstatus == 3 || $applicatondtls->appdt_apptype == 2)&& ($applicatondtls->appdt_status == 10 || $applicatondtls->appdt_status == 14)){
        $mailnumber = 'course_2_5_8_1'; //course_3_11_1
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'course_2_5_8_1',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }elseif(($updatemodel->aah_formstatus == 3 || $applicatondtls->appdt_apptype == 2)&& ($applicatondtls->appdt_status == 13 || $applicatondtls->appdt_status == 9)){
        $mailnumber = 'course_2_5_9_1'; //course_3_12_1
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'course_2_5_9_1',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }elseif(($updatemodel->aah_formstatus == 3 || $applicatondtls->appdt_apptype == 2) && ($applicatondtls->appdt_status == 14)){
        $mailnumber = 'course_2_5_10_1'; //course_3_13_1
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'course_2_5_10_1',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }elseif($applicatondtls->appdt_apptype == 19){
        $mailnumber = 'course_5_1_1'; 
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'course_5_1_1',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }elseif($additonalinfo == 'reactivate'){
        $mailnumber = 'course_6_1_1'; 
        $_data=[
            'data'=>$applicatondtls,
            'mailnumber'=>$mailnumber,
            'type' => 'course_6_1_1',
            'userpk'=>$userPk,
            'regpk'=>$regPk,
            'applictionpk'=>$applictionpk
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
        // var_dump($response);exit;
    }
        return true;
    
    }
}
