<?php

namespace common\components;

use Yii;
use yii\web\Response;
use common\models\MembercompanymstTbl;
use common\models\UsermstTbl;
use common\models\MemberregistrationmstTbl;
use common\models\BcastnotifmstTbl;
use common\models\BcastnotifdtlsTbl;
use api\modules\pms\models\CmstendertargetdtlsTbl;
class Notification{
    static function insertnotification($data=NULL){
     
        $bcastnotification = new BcastnotifmstTbl();
        // $bcastnotification->bnm_notifdev_templates_id = ;
        $bcastnotification->bnm_basemodulemst_fk = $data['basemodulemst_fk'];
        $bcastnotification->bnm_memberregmst_fk = $data['memberregmst_fk'];
        $bcastnotification->bnm_msgtype = $data['msg_type'];
        $bcastnotification->bnm_msgto = $data['msg_to'];
        $bcastnotification->bnm_msgtitle = $data['msg_title'];
        $bcastnotification->bnm_msgdesc = $data['msg_description'];
        $bcastnotification->bnm_attachment = $data['attachment'];
        $bcastnotification->bnm_msgstatus = $data['msg_status'];
        $bcastnotification->bnm_targettype = $data['targettype'];
        $bcastnotification->bnm_targetstring = $data['targetstring'];
        $bcastnotification->bnm_targetcount = $data['targetcount'];
        $bcastnotification->bnm_notiflink = $data['notification_link'];  // which link ? this one - https://bgi.businessgateways.net/j3/app/notification
        $bcastnotification->bnm_createdon = date('Y-m-d H:i:s');
        $bcastnotification->bnm_createdby = $data['usermst_pk'];
        $bcastnotification->bnm_tz_utcoffset = $data['bnm_tz_utcoffset'];
        $bcastnotification->bnm_closing_date = $data['bnm_closing_date'];
        $bcastnotification->bnm_refno = $data['bnm_refno'];
        $bcastnotification->bnm_noticefrom = $data['bnm_noticefrom'];
        $bcastnotification->bnm_isdeleted = $data['isdeleted']; //1-deleted, 2-notdeleted

        if($bcastnotification->save()){
            if($data['notification_name']=='award'){
                self::awardnotification($data,$bcastnotification->bcastnotifmst_pk);
            }else{
                self::membernotification($data,$bcastnotification->bcastnotifmst_pk);
            }
            return (['status'=>200,'message'=>'inserted successfully']);
        }
    }
    static function updatenotification($data=NULL,$is_update_delete=NULL){
       /* $bcastnotification = BcastnotifmstTbl::find()->where()->one();
        if(!empty($bcastnotification)){
            if(is_update_delete==1){
                $bcastnotification->bnm_notifdev_templates_id = isset($data['notifdev_tempid']) ? $data['notifdev_tempid'] : $bcastnotification->bnm_notifdev_templates_id;
                $bcastnotification->bnm_msgtype = isset($data['msg_type']) ? $data['msg_type'] : $bcastnotification->bnm_msgtype;
                $bcastnotification->bnm_msgto = isset($data['msg_to']) ? $data['msg_to'] : $bcastnotification->bnm_msgto;
                $bcastnotification->bnm_msgtitle = isset($data['msg_title']) ? $data['msg_title'] : $bcastnotification->bnm_msgtitle;
                $bcastnotification->bnm_msgdesc = isset($data['msg_description']) ? $data['msg_description'] : $bcastnotification->bnm_msgdesc;
                $bcastnotification->bnm_attachment = isset($data['attachment']) ? $data['attachment'] : $bcastnotification->bnm_attachment;
                $bcastnotification->bnm_msgstatus = isset($data['msg_status']) ? $data['msg_status'] : $bcastnotification->bnm_msgstatus;
                $bcastnotification->bnm_targettype = isset($data['targettype']) ? $data['targettype'] : $bcastnotification->bnm_targettype;
                $bcastnotification->bnm_targetstring = isset($data['targetstring']) ? $data['targetstring'] : $bcastnotification->bnm_targetstring;
                $bcastnotification->bnm_targetcount = isset($data['targetcount']) ? $data['targetcount'] : $bcastnotification->bnm_targetcount;
                $bcastnotification->bnm_notiflink = isset($data['notification_link']) ? $data['notification_link'] : $bcastnotification->bnm_notiflink;
                $bcastnotification->bnm_isdeleted - isset($data['istrash']) ? $data['istrash'] : $bcastnotification->bnm_isdeleted;
            }
            if($is_update_delete==2){
                $bcastnotification->bnm_isdeleted = 1; //1-deleted, 2-notdeleted
                $bcastnotification->bnm_deletedon = date('Y-m-d');
                $bcastnotification->bnm_deletedby = $data['usermst_pk'];
                $bcastnotification->bnm_deletedbyipaddr = Yii::$app->getRequest()->getUserIP(); 
            }
            if($bcastnotification->save()){
                return (['status'=>200,'message'=>'updated successfully']);
            }
            return (['status'=>201,'message'=>'fail']);
        }
        return (['status'=>201,'message'=>'No records']);*/
    }
    static function membernotification($data,$notifymst_pk){
        if(!empty($notifymst_pk)){
            /*if(!isset($data['newsuppliernotice'])){
               
                if(count($data['newsupplier'])>0){
                    // echo '<pre>ww';print_r($data['newsupplier']);exit;
                    $oldsupplier = isset($data['newsupplier'][0]['oldsupplier']) ? explode(',',$data['newsupplier'][0]['oldsupplier']) : [];
                    // echo '<pre>ww';print_r($oldsupplier);exit;
                    $usermstrecords = UsermstTbl::find()->where(['in','UM_MemberRegMst_Fk',$oldsupplier])->all();
                    foreach($usermstrecords as $usermstrecord){
                        self::insertnoitification($notifymst_pk,$usermstrecord->UserMst_Pk);
                    }
                    
                }else{
                    foreach($data['supplier_pks'] as $tatgetedsupplier){
                        if(isset($tatgetedsupplier->cmstthtMemberregmstFk->user)){
                            foreach($tatgetedsupplier->cmstthtMemberregmstFk->user as $userrecord){
                                self::insertnoitification($notifymst_pk,$userrecord->UserMst_Pk);
                            }
                            
                        }
                    }
                }
            }else{
                $newsupplier = isset($data['newsupplier'][0]['newsupplier']) ? explode(',',$data['newsupplier'][0]['newsupplier']) : [];
                $usermstrecords = UsermstTbl::find()->where(['in','UM_MemberRegMst_Fk',$newsupplier])->all();
                foreach($usermstrecords as $usermstrecord){
                    self::insertnoitification($notifymst_pk,$usermstrecord->UserMst_Pk);
                }
                $data['newsupplier'] = [];
            }*/
            // echo '<pre>';print_r($data);exit;
            if(isset($data['newsuppliernotice'])){
                // $n = 0;
                foreach($data['newsupplier'] as $tatgetedsupplier){
                    if(isset($tatgetedsupplier->cmstthMemberregmstFk->user)){
                        foreach($tatgetedsupplier->cmstthMemberregmstFk->user as $userrecord){
                            
                            // if($n<10){
                                self::insertnoitification($notifymst_pk,$userrecord->UserMst_Pk);
                                self::insertmailidoftargetsupplier($tatgetedsupplier,$userrecord,$data,1);
                        //     }
                        //    $n++;
                        }
                    }
                }
                $data['newsupplier'] = [];
            }else{
                // echo 'pp';exit;
                // $n = 0;
                foreach($data['supplier_pks'] as $tatgetedsupplier){
                    if(isset($tatgetedsupplier->cmstthMemberregmstFk->user)){
                        foreach($tatgetedsupplier->cmstthMemberregmstFk->user as $userrecord){
                            // if($n<10){
                                self::insertnoitification($notifymst_pk,$userrecord->UserMst_Pk);
                                self::insertmailidoftargetsupplier($tatgetedsupplier,$userrecord,$data,2);
                        //     }
                        //    $n++;
                        }
                        
                    }
                }
            }
        }
        if(count($data['newsupplier'])>0){
            $data['msg_title'] = $data['title_newsupplier'];
            $data['msg_description'] = $data['description_newsupplier'];
            $data['newsuppliernotice'] = true;
            self::insertnotification($data);
        }
        
    }
    static function awardnotification($data,$notifymst_pk){
       
        // foreach($data['supplier_pks'] as $awardsupplier){
            if(isset($data['supplier_pks']->cmsqhCreatedby->UserMst_Pk)){
                self::insertnoitification($notifymst_pk,$data['supplier_pks']->cmsqhCreatedby->UserMst_Pk);
            }
        // }
    }
    // static function suppliernotices(){
        
    
    // }

    Static function insertnoitification($notifymst_pk,$user_pk){
        // echo 55;exit;
        $bcastnotifydtls = new BcastnotifdtlsTbl();
        $bcastnotifydtls->bnd_bcastnotifmst_fk = $notifymst_pk;
        $bcastnotifydtls->bnd_usermst_fk = $user_pk;
        $bcastnotifydtls->bnd_status = 1; //1 - Unread
        $bcastnotifydtls->save();
    }

    static function insertmailidoftargetsupplier($tendertarget,$userrecord,$data,$type){

        // Notification::insertmailidoftargetsupplier($model);
        $tagerdetailstbl = new CmstendertargetdtlsTbl();
        $tagerdetailstbl->cmsttd_cmstendertargethdr_fk =$tendertarget->cmstendertargethdr_pk;
        $tagerdetailstbl->cmsttd_emailid = $userrecord->UM_EmailID;
        $tagerdetailstbl->cmsttd_emailstatus = 1;
        $tagerdetailstbl->cmsttd_mailfor = $data['mailfor'];
        $tagerdetailstbl->cmsttd_targetsuptype = $type;
        if($tagerdetailstbl->save()){
            /*if($data['mailfor']==1 && $data['isrepublished']==NUll){
                //new quotation
            }elseif($data['mailfor']==1 && $data['isrepublished']!=NUll){
                //remainder
            }elseif($data['mailfor']==2){
                // update
            }elseif($data['mailfor']==3){
                // closingdate changes
            }*/
            $from = 'Business Gateways International (noreply@businessgateways.com)';
            $to = $userrecord->UM_EmailID;
            $subject = $data['subject'];
            $body = $data['body'];

            if($type==1){
                $subject = $data['newsubject'];
                $body = $data['newbody'];
            }

            return \Yii::$app->mailer->compose()
                            ->setFrom('noreply@businessgateways.com')
                            ->setTo($data['email']) // $data['email'] //vignesh@businessgateways.com
                            ->setSubject($subject)
                            ->setHTMLBody($body)
                            ->send();

        }
        



        /*$cmstendertargethdr_pk = $model->cmstendertargethdrTbls->cmstendertargethdr_pk;
        cmstendertargethdrTblsnew
        cmstendertargethdrTblsnew
        $findExistingSupplier = CmstendertargetdtlsTbl::find()->where('cmsttd_cmstendertargethdr_fk',$cmstendertargethdr_pk)->all();
        foreach($findExistingSupplier as $alue){
            
        }
        $bcastnotifydtls = new CmstendertargetdtlsTbl();
        $bcastnotifydtls->cmsttd_cmstendertargethdr_fk = $cmstendertargethdr_pk;
        $bcastnotifydtls->cmsttd_emailid = ;
        $bcastnotifydtls->cmsttd_emailstatus = ;
        $bcastnotifydtls->cmsttd_mailfor = ;
        $bcastnotifydtls->cmsttd_targetsuptype = ;*/
    }
    static function mailcontent(){
        
       /* $from = 'Business Gateways International (noreply@businessgateways.com)';
        $to = $userrecord->UM_EmailID;
        
        
        if($status==4){
            //terminate
            $subject = $model->cmsth_refno.' - '.$cmsth_name.' Received from '.$rfq_created_by;
            $content = $subject;
        }elseif($model->cmsth_mailfor==1 && $model->cmsth_isrepublished!=NUll){
        // elseif($status==3){      //remainder
            $subject = $model->cmsth_refno.' - '.$cmsth_name.' Received from '.$rfq_created_by;
            $content = $subject;
            $body = 
                '<p>'.$model->membercompanymsttbl->MCM_CompanyName.',</p>
                <p>This is a gentle reminder to respond to the received '.$cmsth_name_abbr.' ('.$cmsth_name.') form. Here are the details:</p><br>'

                '<p>Buyer/Operator/Contractor Name: '.$rfq_created_by.'</p><p>'.
                $cmsth_name_abbr .' ('.$cmsth_name.'): '.$rfq_title.'</p><p>
                Closing Date & Time: '.$closedate.' ('.$timezone.')</p><br><p>
                You have '.floor($betweendays/86400).' day(s) left to respond to the request. Kindly fill the form at the earliest.</p><br>
                <button>Click here to respond to the'.$cmsth_name.'</button><br><p>About JSRS</p>
                <p>Joint Supplier Registration System (JSRS) is an initiative by the Ministry of Energy and Minerals, Oman. JSRS Buyers (O&G Industry and other industries) utilize JSRS Certified Companies for their procurement activities.</p><br>

                <p>For queries, please write to jsrs@businessgateways.com or call +968 2410 6100.</p><br>

                <p>Note: You are receiving this email based on the Sector configured by your Organization for receiving enquiries from the JSRS '.Contractors.$rfq_created_by.'.</p>';

        }elseif($model->cmsth_mailfor==2){
            // elseif($status==2){    //update
                $subject = $model->cmsth_refno.' - '.$cmsth_name.' is updated by '.$rfq_created_by;
                $content = $subject;
                $body = 
                    '<p>'.$model->membercompanymsttbl->MCM_CompanyName.',</p>
                    <p>Please be informed that there is an update on the '.$cmsth_name_abbr.' ('.$cmsth_name.') form. Here are the details:</p><br>'

                    '<p>Buyer/Operator/Contractor Name: '.$rfq_created_by.'</p><p>'.
                    $cmsth_name_abbr .' ('.$cmsth_name.'): '.$rfq_title.'</p><p>
                    Closing Date & Time: '.$closedate.' ('.$timezone.')</p><br><p>
                    You have '.floor($betweendays/86400).' day(s) left to respond to the request. Kindly fill the form at the earliest.</p><br>
                    <button>Click here to respond to the'.$cmsth_name.'</button><br><p>About JSRS</p>
                    <p>Joint Supplier Registration System (JSRS) is an initiative by the Ministry of Energy and Minerals, Oman. JSRS Buyers (O&G Industry and other industries) utilize JSRS Certified Companies for their procurement activities.</p><br>

                    <p>For queries, please write to jsrs@businessgateways.com or call +968 2410 6100.</p><br>

                    <p>Note: You are receiving this email based on the Sector configured by your Organization for receiving enquiries from the JSRS '.Contractors.$rfq_created_by.'.</p>';
        }elseif($model->cmsth_mailfor==3){
            // elseif($status==2){    //closing date
                $subject = 'Closing Date extended for '.$model->cmsth_refno.' – '.$cmsth_name.' received from '.$rfq_created_by;
                $content = $subject;
                $body = 
                    '<p>'.$model->membercompanymsttbl->MCM_CompanyName.',</p>
                    <p>Please be informed that the closing date for the '.$cmsth_name_abbr.' ('.$cmsth_name.') has been extended by '.$rfq_created_by.'. Here are the details:</p><br>'

                    '<p>Buyer/Operator/Contractor Name: '.$rfq_created_by.'</p><p>'.
                    $cmsth_name_abbr .' ('.$cmsth_name.'): '.$rfq_title.'</p><p>
                    Closing Date & Time: '.$closedate.' ('.$timezone.')</p><br><p>
                    You now have '.floor($betweendays/86400).' day(s) left to respond to the request. Kindly fill the form at the earliest.</p><br>
                    <button>Click here to respond to the'.$cmsth_name.'</button><br><p>About JSRS</p>
                    <p>Joint Supplier Registration System (JSRS) is an initiative by the Ministry of Energy and Minerals, Oman. JSRS Buyers (O&G Industry and other industries) utilize JSRS Certified Companies for their procurement activities.</p><br>

                    <p>For queries, please write to jsrs@businessgateways.com or call +968 2410 6100.</p><br>

                    <p>Note: You are receiving this email based on the Sector configured by your Organization for receiving enquiries from the JSRS '.Contractors.$rfq_created_by.'.</p>';
        }else{
            //new 
            $subject = $model->cmsth_refno.' - '.$cmsth_name.' Received from '.$rfq_created_by;
            $content = $subject;
            $body = 
                '<p>'.$model->membercompanymsttbl->MCM_CompanyName.',</p>
                <p>You have received a '.$cmsth_name_abbr.' ('.$cmsth_name.') form. Here are the details:</p><br>'

                '<p>Buyer/Operator/Contractor Name: '.$rfq_created_by.'</p><p>'.
                $cmsth_name_abbr .' ('.$cmsth_name.'): '.$rfq_title.'</p><p>
                Closing Date & Time: '.$closedate.' ('.$timezone.')</p><br><p>
                You have '.floor($betweendays/86400).' day(s) left to respond to the request. Kindly fill the form at the earliest.</p><br>
                <button>Click here to respond to the'.$cmsth_name.'</button><br><p>About JSRS</p>
                <p>Joint Supplier Registration System (JSRS) is an initiative by the Ministry of Energy and Minerals, Oman. JSRS Buyers (O&G Industry and other industries) utilize JSRS Certified Companies for their procurement activities.</p><br>

                <p>For queries, please write to jsrs@businessgateways.com or call +968 2410 6100.</p><br>

                <p>Note: You are receiving this email based on the Sector configured by your Organization for receiving enquiries from the JSRS '.Contractors.$rfq_created_by.'.</p>';

        }*/
    }
}


