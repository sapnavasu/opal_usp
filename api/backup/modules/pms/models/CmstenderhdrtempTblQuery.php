<?php

namespace api\modules\pms\models;

use api\modules\pms\models\CmsaddinfodtlsTbl;
use api\modules\pms\models\CmsaddinfodtlstempTbl;
use api\modules\pms\models\CmstenderhdrTbl;
use api\modules\quot\models\CmsquotationhdrTbl;
use api\modules\drv\models\MemcompfiledtlsTbl;
use api\modules\rfx\components\Rfx;
use common\components\Common;
use common\components\Security;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use Yii;
use common\components\Drive;
use common\models\UsermstTbl;
use api\modules\pms\models\CmsaddinfodtlsTblQuery;
use api\modules\pms\models\CmsaddinfodtlshstyTblQuery;
use common\models\MemberregistrationmstTbl;
use common\components\Notification;
use common\models\BasemodulemstTbl;
use api\modules\mst\models\TimezoneTbl;

/**
 * This is the ActiveQuery class for [[CmstenderhdrtempTbl]].
 *
 * @see CmstenderhdrtempTbl
 */
class CmstenderhdrtempTblQuery extends \yii\db\ActiveQuery
{
    const ENQURY_TYPE_CAN_CREATE_VAR =  array(
        0 => 'rfx_create',
        1 => 'rfi_create',
        2 => 'eoi_create',
        3 => 'pq_create',
        4 => 'rfp_create',
        5 => 'rfq_create',
        6 => 'rft_create',
        7 => 'eTender',
        8 => 'eAuction'
    );

    const ENQURY_TYPES =  array(
        1 => 'rfi',
        2 => 'eoi',
        3 => 'pq',
        4 => 'rfp',
        5 => 'rfq',
        6 => 'rft',
        7 => 'eTender',
        8 => 'eAuction'
    );

    const ENQURY_TYPES_NAME =  array(
        1 => 'RFI',
        2 => 'EOI',
        3 => 'PQ',
        4 => 'RFP',
        5 => 'RFQ',
        6 => 'RFT',
        7 => 'eTender',
        8 => 'eAuction'
    );

    const ENQURY_TYPE_TO_CHECK_FOR_CREATE =  array(
        1 => array('2', '3', '4', '5', '6'),
        2 => array('3', '4', '5', '6'),
        3 => array('4', '5', '6'),
        4 => array('5', '6'),
        5 => array('6'),
        6 => [],
    );

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmstenderhdrtempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstenderhdrtempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function addrfxdetails($data) {       
        if (!empty($data)) {
           
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
            $rfxdata = $data['rfxval'];
            $republish = false;

            $rfxtender_pk = Security::decrypt($rfxdata['rfxtender_pk']);
            $rfxtender_type = $rfxdata['rfxtender_type'];
            $cancreatecheckarray = array('rfx_pk' => $rfxtender_pk, 'type' => $rfxtender_type);           
            $can_create_enquiry = self::cancreaterfxtemp($cancreatecheckarray);
            $checkvariable = self::ENQURY_TYPE_CAN_CREATE_VAR[$rfxtender_type];
           
            if ($rfxdata['rfx_pk'] != null) {
                $model = CmstenderhdrtempTbl::find()->where("cmstenderhdrtemp_pk =:pk", [':pk' => $rfxdata['rfx_pk']])->one();
                if($model && $model->cmstht_tenderstatus != 6) {
                    $model->cmstht_updatedon = $date;
                    $model->cmstht_updatedby = $userPK;
                    $model->cmstht_updatedbyipaddr = $ip_address;
                } else {
                    return $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => "You can't edit this etender",
                        'returndata' => null
                    );
                }
            } else {
                if($can_create_enquiry[$checkvariable]) {                   
                    $model = new CmstenderhdrtempTbl();
                    $model->cmstht_uid = Common::getUniqueId($rfxdata['rfxtender_type_val'], null, 1);
                    $model->cmstht_tenderstatus = 1;
                    $model->cmstht_cmstenderhdrtemp_fk = $rfxdata['reference_enquriy'];
                } else {
                    return $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => "You can't create etender while another etender is active",
                        'returndata' => null
                    );
                }
            }

            $remainderval = $rfxdata['isreminder'] ? 1 : 2;
                      
            if ($rfxdata['card_type'] == 'info') {                
                $model->cmstht_memcompmst_fk = $company_id;
                $model->cmstht_title = $rfxdata['rfxcardtitle'];
                $model->cmstht_refno = $rfxdata['rfxcardrefno'];
                $model->cmstht_initiateddate = Common::convertDateTimeToServerTimezone($rfxdata['rfxinitiate_Date']);
                $model->cmstht_initiatedby = $rfxdata['rfx_initiateby'];
                $model->cmstht_type = $rfxdata['rfxtender_type'];
                $model->cmstht_cmsrequisitionformdtls_fk = Security::decrypt($rfxdata['rfxtender_pk']);

                if($rfxdata['rfxdisciplinepk'] == '' || $rfxdata['rfxdisciplinepk'] == null) { 
                   $disciplinepk = \app\models\CmsdisciplinedtlsTblQuery::adddisciplinedtls($rfxdata['rfxdiscipline']);
                    if($disciplinepk['code'] == '202') {
                        return $result = array(
                            'status' => 202,
                            'msg' => 'failure',
                            'flag' => 'U',
                            'comments' => 'Discipline name duplicate error occurred',
                            'moduleData' => $model,
                        );
                    } else {
                        $model->cmstht_cmsdisciplinedtls_fk = $disciplinepk;
                    }
                } else {
                    $model->cmstht_cmsdisciplinedtls_fk = $rfxdata['rfxdisciplinepk'];
                }


            } else if($rfxdata['card_type'] == 'remainder') {
                $model->cmstht_setreminder = $remainderval;
                $model->cmstht_closeintvl = $rfxdata['req_intervalcnt'];
                $model->cmstht_closeintvltype = $rfxdata['req_interval'];
                $model->cmstht_openintvl = $rfxdata['aft_intervalcnt'];
                $model->cmstht_openintvltype = $rfxdata['aft_interval'];
            } else if ($rfxdata['card_type'] == 'scope') {
                $model->cmstht_shortdesc = $rfxdata['rfx_shortdesc'];
                $model->cmstht_statement = $rfxdata['requisi_state'];
                $model->cmstht_instruction = $rfxdata['rfx_instruct'];
                $model->cmstht_mineligibility = $rfxdata['rfx_mineligibility'];
                $model->cmstht_reqdate = Common::convertDateTimeToServerTimezone($rfxdata['required_Date']);
                $model->cmstht_reqincoterms = $rfxdata['incoterms'];
                $model->cmstht_portname = $rfxdata['portname'];

                if($rfxdata['rfxtender_type_val'] == 'RFT') {
                    $model->cmstht_csstartdate = Common::convertDateTimeToServerTimezone($rfxdata['startdate']);
                    $model->cmstht_csenddate = Common::convertDateTimeToServerTimezone($rfxdata['enddate']);
                }

            } else if ($rfxdata['card_type'] == 'communication') {
                $model->cmstht_contact_usermst_fk = $rfxdata['rfxcommunication'];
            } else if ($rfxdata['card_type'] == 'notify') {
                $model->cmstht_config_usermst_fk = $rfxdata['rfxnotify'];
            } else if ($rfxdata['card_type'] == 'subcontractrule') {
                $model->cmstht_issubcontrqmt = $rfxdata['subcontract'] ? 1 : 2;
                $model->cmstht_obligation = $rfxdata['rfp_classic'];
                $model->cmstht_msmepercent = $rfxdata['rfp_obligation'];
                $model->cmstht_lccpercent = $rfxdata['rfp_lccobligation'];
                $model->cmstht_obligationscope = $rfxdata['rfx_obligationscope'];
                $model->cmstht_isetendmandate = $rfxdata['etender'] ? 1 : 0;
            } elseif ($rfxdata['card_type'] == 'questionarie') {
                if($rfxdata['questionairepk'] != $model->cmstht_cmsquestionnaireformtemp_fk && $model->cmstht_cmsquestionnaireformtemp_fk != null) {
                    $model->cmstht_mailfor = 2;
                    $update = true;
                }
                $model->cmstht_cmsquestionnaireformtemp_fk = $rfxdata['questionairepk'];
            } elseif ($rfxdata['card_type'] == 'req_support_doc') {
                $model->crfd_remarks = $rfxdata['remark_disc'];
            } elseif ($rfxdata['card_type'] == 'icv') {
                if($rfxdata['icvsubmission']) {
                    $model->cmstht_icv_startyear = $rfxdata['startyearsicv'];
                    $model->cmstht_icv_startquarter = $rfxdata['startquarter'];
                    $model->cmstht_icv_endyear = $rfxdata['endyearsicv'];
                    $model->cmstht_icv_endquarter = $rfxdata['endquarter'];
                    $model->cmstht_isicv = $rfxdata['endquarter'] ? 1 : 2;
                }else{
                    $model->cmstht_isicv = 2;
                }
            } elseif ($rfxdata['card_type'] == 'schedule') {
                $model->cmstht_createdby = $userPK;
                $model->cmstht_skdtype = $rfxdata['optonSelection'];
                $model->cmstht_skd_timezone_fk = $rfxdata['timeZone'];
                if($model->cmstht_skdtype == 2){
                    $republish = true;
                }
                $model->cmstht_skdstartdate = Common::convertDateTimeToServerTimezone($rfxdata['closingdate']);
                $model->cmstht_skdclosedate = Common::convertDateTimeToServerTimezone($rfxdata['submittedOn']); 
                $model->cmstht_createdon = $date;
                $model->cmstht_createdbyipaddr = $ip_address;
                if($rfxdata['optonSelection'] == 2) {
                    $model->cmstht_tenderstatus = 11; // Scheduled to Publish Later
                } else {
                    $model->cmstht_tenderstatus = 2; // Published
                }
            } elseif ($rfxdata['card_type'] == 'savedrft') {
                // $model->cmstht_tenderstatus = 1;
            } elseif($rfxdata['card_type'] == 'additonaldoc') {
                $model->cmstht_attachlink = $rfxdata['attach_link'];
                $model->cmstht_attachclosedate = Common::convertDateTimeToServerTimezone($rfxdata['close_date']);
            } elseif($rfxdata['card_type'] == 'rfxaddinfo') {
                $transaction = Yii::$app->db->beginTransaction();
                $update_happen = false;
                $deleteaddinfo = CmsaddinfodtlstempTbl::deleteAll(['=', 'caidt_cmstenderhdrtemp_fk', $model->cmstenderhdrtemp_pk]);
                foreach ($rfxdata['rfxadditionalinfo'] as $key => $value) {
                    if ($value['addinfopk']) {
                        $update_happen = true;
                    }
                    // $modeladdinfo = CmsaddinfodtlstempTbl::find()->where("cmsaddinfodtlstemp_pk =:pk", [':pk' => $value['addinfopk']])->one();
                    // if (!empty($modeladdinfo->caid_createdon)) {
                    //     $modeladdinfo->caidt_updatedon = $date;
                    //     $modeladdinfo->caidt_updatedby = $userPK;
                    //     $modeladdinfo->caidt_updatedbyipaddr = Common::getIpAddress();
                    // }
                    
                    $modeladdinfo = new CmsaddinfodtlstempTbl();
                    $modeladdinfo->caidt_createdon = $date;
                    $modeladdinfo->caidt_createdby = $userPK;
                    $modeladdinfo->caidt_createdbyipaddr = Common::getIpAddress();
                    $modeladdinfo->caidt_cmstenderhdrtemp_fk = $rfxdata['rfx_pk'];
                    $modeladdinfo->caidt_title = $value['question'];
                    $modeladdinfo->caidt_description = $value['answer'];
                    $modeladdinfo->caidt_index = $key + 1;
                    $modeladdinfo->caidt_status = 1;
                    
                    if(!$modeladdinfo->save()) {
                        $result = array(
                            'status' => 200,
                            'msg' => 'warning',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'returndata' => $modeladdinfo->getErrors()
                        );
                        break;
                    } else {
                        $result = array(
                            'status' => true
                        );
                    }

                }

                if ($result['status']) {
                    $transaction->commit();
                    $all_addinfo_rfx = CmsaddinfodtlstempTbl::find()
                        ->select(['cmsaddinfodtlstemp_pk as addinfopk', 'caidt_title as question', 'caidt_description as answer'])
                        ->where("caidt_cmstenderhdrtemp_fk =:ten_fk", [':ten_fk' => $rfxdata['rfx_pk']])
                        ->asArray()
                        ->All();
                    if($update_happen) {
                        $add_msg = 'Updated';
                    } else {
                        $add_msg = 'Created';
                    }

                    return $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => $rfxdata['rfxtender_type_val'] . ' Additional Info ' . $add_msg .' Successfully',
                        'moduleData' => $all_addinfo_rfx,
                    );
                } else {
                    $transaction->rollBack();

                    return $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $modeladdinfo->getErrors()
                    );
                }
            } else if($rfxdata['card_type'] == 'configcontact') {
                $model->cmstht_contact_usermst_fk = $rfxdata['rfxcontact'];
            }          
            
            if ($model->save() === TRUE) {
                if ($rfxdata['card_type'] != 'questionarie') {
                    if($rfxdata['questionairepk'] != $model->cmstht_cmsquestionnaireformtemp_fk && $model->cmstht_cmsquestionnaireformtemp_fk != null) {
                        $isupdated = self::isUpdate('rfxadddetail',$rfxdata,$company_id);
                        if($isupdated){
                            if($model->cmstht_mailfor==2){
                                $model->cmstht_mailfor = 2;
                                $model->save();
                            }else{
                                $model->cmstht_mailfor = $isupdated;
                                $model->save();
                            }
                            
                        }
                    }
                }               
                if($rfxdata['card_type'] == 'schedule'){
                    if($model->cmstht_tenderstatus == 2) {
                        if(!empty($model->cmstendertargethdrTbls)){  
                            foreach($model->cmstendertargethdrTbls as $target){
                                if(!empty($target->cmstthMemberregmstFk->user->UM_EmailID)){
                                    $this->sendRfxPublishEmail($model, $target, $republish);
                                }
                            }
                        }
                    }
                }
               
                
                if ($rfxdata['card_type'] == 'schedule') {
                    if($model->cmstht_tenderstatus == 2) {
                        //$check = Rfx::saveTargettedSuppliertemp($model->cmstenderhdrtemp_pk, $model->cmstht_type, $model->cmstht_tenderstatus); 
                        $moving_temptomain = self::copyingrfxdata($model, 'temptomain','web');

                        self::insertnoticerecord($model,$regPk,$status=1);
                    }
                }

               

                if ($rfxdata['card_type'] == 'notify') {
                    $msg = "Notify user Updated Successfully";
                } else if ($rfxdata['card_type'] == 'communication') {
                    $msg = "Communication Updated Successfully";
                } elseif($rfxdata['card_type'] == 'additonaldoc') {
                    $msg = "Additional Documents Updated Successfully";
                } elseif($rfxdata['card_type'] == 'configcontact') {
                    $msg = "Contact Updated Successfully";
                } else {
                    $msg = $rfxdata['rfxtender_type_val'] . ' Card Updated Successfully';
                }

                if ($rfxdata['rfx_pk']) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => $msg,
                        'moduleData' => $model,
                    );
                } else {
                    if ($rfxdata['card_type'] == 'notify') {
                        $msg = "Notify user Created Successfully";
                    } else if ($rfxdata['card_type'] == 'communication') {
                        $msg = "Communication Created Successfully";
                    } elseif($rfxdata['card_type'] == 'additonaldoc') {
                        $msg = "Additional Documents Created Successfully";
                    } elseif($rfxdata['card_type'] == 'configcontact') {
                        $msg = "Contact Created Successfully";
                    } else {
                        $msg = $rfxdata['rfxtender_type_val'] . ' Card Created Successfully';
                    }

                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => $msg,
                        'moduleData' => $model,
                    ); 

                    if ($rfxdata['rfx_pk']) {

                        if ($rfxdata['card_type'] == 'notify') {
                            $msg = "Notify user Updated Successfully";
                        } else if ($rfxdata['card_type'] == 'communication') {
                            $msg = "Communication Updated Successfully";
                        } elseif($rfxdata['card_type'] == 'additonaldoc') {
                            $msg = "Additional Documents Updated Successfully";
                        } elseif($rfxdata['card_type'] == 'configcontact') {
                            $msg = "Contact Updated Successfully";
                        } else {
                            $msg = $rfxdata['rfxtender_type_val'] . ' Card Updated Successfully';
                        } 

                        $result = array(
                            'status' => 200,
                            'msg' => 'success',
                            'flag' => 'U',
                            'comments' => $msg,
                            'moduleData' => $model,
                        );
                    } else {
                        if ($rfxdata['card_type'] == 'notify') {
                            $msg = "Notify user Created Successfully";
                        } else if ($rfxdata['card_type'] == 'communication') {
                            $msg = "Communication Created Successfully";
                        } elseif($rfxdata['card_type'] == 'additonaldoc') {
                            $msg = "Additional Documents Created Successfully";
                        } elseif($rfxdata['card_type'] == 'configcontact') {
                            $msg = "Contact Created Successfully";
                        } else {
                            $msg = $rfxdata['rfxtender_type_val'] . ' Card Created Successfully';
                        }

                        $flag = 'S';
                        if($update) {
                            $flag = 'U';
                        } 
                        $result = array(
                            'status' => 200,
                            'msg' => 'success',
                            'flag' => $flag,
                            'comments' => $msg,
                            'moduleData' => $model,
                        );
                    }
                }
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
            return $result;
        }
    }
    static function mailsending($model=NULL){
       /* // implement mail seding
        $model = CmstenderhdrTbl::findOne(['cmsth_cmstenderhdrtemp_fk' => 415]);
        // $model->cmstendertargethdrTblsnew
        
    echo'<pre>';print_r($model->cmstendertargethdrTbls[0]);exit;

        

        if($model->cmsth_mailfor==1 && $model->cmsth_isrepublished==NUll){
             //new quotation
             Notification::insertmailidoftargetsupplier($model);
        }elseif($model->cmsth_mailfor==1 && $model->cmsth_isrepublished!=NUll){
            //remainder
            Notification::insertmailidoftargetsupplier($model);
        }elseif($model->cmsth_mailfor==2){
            // update
            Notification::insertmailidoftargetsupplier($model);
        }elseif($model->cmsth_mailfor==3){
            // closingdate changes
            Notification::insertmailidoftargetsupplier($model);
        }*/
    }
    
    static function insertnoticerecord($model,$regPk,$status='',$newsupplier=[],$attachment=null,$targettype=null,$targetstring=null,$targetcount=null){
         // $data = ['notifdev_tempid'=>12,'msg_type','msg_to','msg_title','msg_description','attachment','msg_status','targettype','targetstring','targetcount','notification_link','usermst_pk']

// echo '<pre>';print_r($model);exit;  MCM_CompanyName
        // 1 RFI, 2 - EOI, 3 - PQ, 4 - RFP, 5 - RFQ, 6 - RFT, 7 - eTender, 8 - eAuction
        $cmstht_type = ['RFI','EOI','PQ','RFP','RFQ','RFT','eTender','eAuction'];
        $cmstht_type_abbr = ['Request for Information','Expression of Interest','Pre-qualification','Request for Proposal','Request for Quotation','Request for Tender'];
        $tempmodel = CmstenderhdrtempTbl::findOne(['cmstenderhdrtemp_pk' => $model->cmstenderhdrtemp_pk]);
        $tempmodel->cmstht_mailfor = 1;
        $tempmodel->save();
        $model = CmstenderhdrTbl::findOne(['cmsth_cmstenderhdrtemp_fk' => $model->cmstenderhdrtemp_pk]);

        $cmsth_name = $cmstht_type[$model->cmsth_type-1];
        $cmsth_name_abbr = $cmstht_type_abbr[$model->cmsth_type-1];
        // if($model->cmstht_type==5){
            
            // echo'<pre>';print_r($model);exit;
            $basemodule_record = BasemodulemstTbl::find()->where("bmm_name like 'Contracts Management System'")->one();
            if(!empty($basemodule_record)){
                $notice_data = [];
                $timezone = '';
                $subject = '';
                $body = '';
                $timezone_record = TimezoneTbl::find()->where(['timezone_pk'=>$model->cmsth_skd_timezone_fk])->one();
                $timezone = isset($timezone_record->tz_countryname) ? explode(' ',trim($timezone_record->tz_countryname))[0] : ''; 
                $closedate = $model->cmsth_skdclosedate;
                $current_date = strtotime(date('Y-m-d'));
                $closing_date = strtotime($model->cmsth_skdclosedate);
                $betweendays = $current_date - $closing_date;
                $rfq_created_by = $model->cmsthCreatedby;
                $rfq_created_by = ($rfq_created_by->um_middlename!=NULL&&trim($rfq_created_by->um_middlename)!='') ? $rfq_created_by->um_firstname.' '.$rfq_created_by->um_middlename.' '.$rfq_created_by->um_lastname : $rfq_created_by->um_firstname.' '.$rfq_created_by->um_lastname;
                $rfq_title = $model->cmsth_title;
                $title_for_newsupplier = "Received a New ".$cmsth_name." - ".$model->cmsth_refno;
                $decsription_for_newsupplier = "You have received a <b>".$cmsth_name_abbr." (".$cmsth_name.")</b> form (<b>".$model->cmsth_refno." - ".$rfq_title."</b>).<br>Kindly respond to the ".$cmsth_name." on or before";
                // $rfq_closingdate = ($model->cmsth_skdtype==2) ? date('d-m-Y h:i A',strtotime($model->cmsth_skdstartdate)) : date('d-m-Y h:i A',strtotime($model->cmsth_initiateddate));
                $supplier_pks = $model->cmstendertargethdrTblsold;
                // $supplier_pks = $model->cmstendertargethdrTbls;

                $newsubject = $model->cmsth_refno.' - '.$cmsth_name.' Received from '.$rfq_created_by;;
                $newbody = $newsubject.
                '<br><br><p>'.$model->membercompanymsttbl->MCM_CompanyName.',</p>
                <p>You have received a <b>'.$cmsth_name_abbr.' ('.$cmsth_name.')</b> form. Here are the details:</p><br>
                
                <p><b>Buyer/Operator/Contractor Name</b>: '.$rfq_created_by.'</p><p><b>'.
                $cmsth_name_abbr .' ('.$cmsth_name.')</b>: '.$rfq_title.'</p><p>
                Closing Date & Time: '.date('d-m-Y H:i A',strtotime($closedate)).' ('.$timezone.')</p><br><p>
                You have <b>'.floor($betweendays/86400).'</b> day(s) left to respond to the request. Kindly fill the form at the earliest.</p><br>
                <a href="http://192.168.1.31:4200/admin/login" target="_blank"><button>Click here to respond to the'.$cmsth_name.'</button></a><br><p><b>About JSRS</b></p>
                <p>Joint Supplier Registration System (JSRS) is an initiative by the Ministry of Energy and Minerals, Oman. JSRS Buyers (O&G Industry and other industries) utilize JSRS Certified Companies for their procurement activities.</p><br>

                <p>For queries, please write to jsrs@businessgateways.com or call +968 2410 6100.</p><br>

                <p>Note: You are receiving this email based on the Sector configured by your Organization for receiving enquiries from the JSRS '.Contractors.$rfq_created_by.'.</p>';

                if($status==4){
                    $title = $cmsth_name." ".$model->cmsth_refno." has been Terminated";
                    $description = "<b>".ucwords($model->membercompanymsttbl->MCM_CompanyName)."</b> has <b>terminated</b> the <b>".$cmsth_name_abbr." (".$cmsth_name.")</b> form (<b>".$model->cmsth_refno." - ".$rfq_title."</b>).";

                    $subject = '';
                    $body ='';

                }elseif($model->cmsth_mailfor==1 && $model->cmsth_isrepublished!=NUll){
                // elseif($status==3){
                    $title = "Respond to ".$cmsth_name." - ".$model->cmsth_refno;
                    $description = "Reminder to respond to the received <b>".$cmsth_name_abbr." (".$cmsth_name.")</b> form (<b>".$model->cmsth_refno." - ".$rfq_title."</b>).<br>Kindly respond to the ".$cmsth_name." on or before";
                    $newsupplier = $model->cmstendertargethdrTblsnew;

                    $subject = 'Reminder: '.$model->cmsth_refno.' - '.$cmsth_name.' Received from '.$rfq_created_by;
                    $content = $subject;
                    $body = $subject.
                        '<p>'.$model->membercompanymsttbl->MCM_CompanyName.',</p>
                        <p>This is a gentle reminder to respond to the received <b>'.$cmsth_name_abbr.' ('.$cmsth_name.')<b> form. Here are the details:</p><br>
                        
                        <p><b>Buyer/Operator/Contractor Name</b>: '.$rfq_created_by.'</p><p><b>'.
                        $cmsth_name_abbr.' ('.$cmsth_name.')</b>: '.$rfq_title.'</p><p>
                        Closing Date & Time: '.date('d-m-Y H:i A',strtotime($closedate)).' ('.$timezone.')</p><br><p>
                        You have <b>'.floor($betweendays/86400).'</b> day(s) left to respond to the request. Kindly fill the form at the earliest.</p><br>
                        <a href="http://192.168.1.31:4200/admin/login" target="_blank"><button>Click here to respond to the'.$cmsth_name.'</button></a><br><p><b>About JSRS</b></p>
                        <p>Joint Supplier Registration System (JSRS) is an initiative by the Ministry of Energy and Minerals, Oman. JSRS Buyers (O&G Industry and other industries) utilize JSRS Certified Companies for their procurement activities.</p><br>
        
                        <p>For queries, please write to jsrs@businessgateways.com or call +968 2410 6100.</p><br>
        
                        <p>Note: You are receiving this email based on the Sector configured by your Organization for receiving enquiries from the JSRS '.Contractors.$rfq_created_by.'.</p>';


                }elseif($model->cmsth_mailfor==2){
                    // elseif($status==2){    $model->cmsth_isrepublished; $model->cmsth_mailfor
                    $newsupplier = $model->cmstendertargethdrTblsnew;
                    $title = "Received an Updated ".$cmsth_name." - ".$model->cmsth_refno;
                    $description = "You have received an updated <b>".$cmsth_name_abbr." (".$cmsth_name.")</b> form (<b>".$model->cmsth_refno." - ".$rfq_title."</b>).<br>Kindly respond to the ".$cmsth_name." on or before";

                    $subject = $model->cmsth_refno.' - '.$cmsth_name.' is updated by '.$rfq_created_by;
                    $content = $subject;
                    $body = $subject.
                        '<p>'.$model->membercompanymsttbl->MCM_CompanyName.',</p>
                        <p>Please be informed that there is an update on the <b>'.$cmsth_name_abbr.' ('.$cmsth_name.')</b> form. Here are the details:</p><br>
                        
                        <p><b>Buyer/Operator/Contractor Name</b>: '.$rfq_created_by.'</p><p><b>'.
                        $cmsth_name_abbr .' ('.$cmsth_name.')</b>: '.$rfq_title.'</p><p>
                        Closing Date & Time: '.date('d-m-Y H:i A',strtotime($closedate)).' ('.$timezone.')</p><br><p>
                        You have <b>'.floor($betweendays/86400).'</b> day(s) left to respond to the request. Kindly fill the form at the earliest.</p><br>
                        <a href="http://192.168.1.31:4200/admin/login" target="_blank"><button>Click here to respond to the'.$cmsth_name.'</button></a><br><p><b>About JSRS</b></p>
                        <p>Joint Supplier Registration System (JSRS) is an initiative by the Ministry of Energy and Minerals, Oman. JSRS Buyers (O&G Industry and other industries) utilize JSRS Certified Companies for their procurement activities.</p><br>
    
                        <p>For queries, please write to jsrs@businessgateways.com or call +968 2410 6100.</p><br>
    
                        <p>Note: You are receiving this email based on the Sector configured by your Organization for receiving enquiries from the JSRS '.Contractors.$rfq_created_by.'.</p>';
                }elseif($model->cmsth_mailfor==3){
                    // elseif($status==2){    $model->cmsth_isrepublished; $model->cmsth_mailfor
                    $newsupplier = $model->cmstendertargethdrTblsnew;
                    $title = "Received an Updated ".$cmsth_name." - ".$model->cmsth_refno;
                    $description = "You have received an updated <b>".$cmsth_name_abbr." (".$cmsth_name.")</b> form (<b>".$model->cmsth_refno." - ".$rfq_title."</b>).<br>Kindly respond to the ".$cmsth_name." on or before";

                    $subject = 'Closing Date extended for '.$model->cmsth_refno.' – '.$cmsth_name.' received from '.$rfq_created_by;
                    $content = $subject;
                    $body = $subject.
                        '<p>'.$model->membercompanymsttbl->MCM_CompanyName.',</p>
                        <p>Please be informed that the closing date for the <b>'.$cmsth_name_abbr.' ('.$cmsth_name.')</b> has been extended by '.$rfq_created_by.'. Here are the details:</p><br>
                        
                        <p><b>Buyer/Operator/Contractor Name</b>: '.$rfq_created_by.'</p><p><b>'.
                        $cmsth_name_abbr .' ('.$cmsth_name.')</b>: '.$rfq_title.'</p><p>
                        Closing Date & Time: '.date('d-m-Y H:i A',strtotime($closedate)).' ('.$timezone.')</p><br><p>
                        You now have <b>'.floor($betweendays/86400).'</b> day(s) left to respond to the request. Kindly fill the form at the earliest.</p><br>
                        <a href="http://192.168.1.31:4200/admin/login" target="_blank"><button>Click here to respond to the'.$cmsth_name.'</button></a><br><p><b>About JSRS</b></p>
                        <p>Joint Supplier Registration System (JSRS) is an initiative by the Ministry of Energy and Minerals, Oman. JSRS Buyers (O&G Industry and other industries) utilize JSRS Certified Companies for their procurement activities.</p><br>
    
                        <p>For queries, please write to jsrs@businessgateways.com or call +968 2410 6100.</p><br>
    
                        <p>Note: You are receiving this email based on the Sector configured by your Organization for receiving enquiries from the JSRS '.Contractors.$rfq_created_by.'.</p>';
                }else{
                    $title = $title_for_newsupplier;
                    $description = $decsription_for_newsupplier;
                    $supplier_pks = $model->cmstendertargethdrTbls;

                    $subject = $newsubject;
                    $content = $subject;
                    $body = $newbody;
                }
                // echo '<pre>';print_r($supplier_pks);exit;
             
                 $notice_data['notifdev_tempid'] = NULL; //waiting for clarification
                 $notice_data['basemodulemst_fk'] = $basemodule_record->basemodulemst_pk;
                 $notice_data['memberregmst_fk'] = $regPk;
                 $notice_data['msg_type'] = 3; //CMS
                 $notice_data['msg_to'] = 1;  //company
                 $notice_data['msg_title'] = $title;
                 $notice_data['msg_description'] = $description;
                 $notice_data['attachment'] = $attachment;
                 $notice_data['msg_status'] = 1;
                 $notice_data['targettype'] = $targettype;
                 $notice_data['targetstring'] = $targetstring;
                 $notice_data['targetcount'] = $targetcount;
                 // $notice_data['notification_link'] = ;
                 $notice_data['usermst_pk'] = $model->cmsth_createdby;
                 $notice_data['notification_name'] = 'cmstype';
                 $notice_data['supplier_pks'] = $supplier_pks;
                 $notice_data['isdeleted'] = ($status==4) ? 2 : 1;
                 $notice_data['title_newsupplier'] = $title_for_newsupplier;
                 $notice_data['description_newsupplier'] = $decsription_for_newsupplier;
                 $notice_data['newsupplier'] = $newsupplier;
                 $notice_data['bnm_tz_utcoffset'] = $model->cmsthSkdTimezoneFk->tz_utcoffset;
                 $notice_data['bnm_closing_date'] = $closedate;
                 $notice_data['bnm_refno'] = $model->cmsth_refno;
                 $notice_data['bnm_noticefrom'] = $rfq_created_by;
                 $notice_data['mailfor'] = $model->cmsth_mailfor;
                 $notice_data['isrepublished'] = $model->cmsth_isrepublished;
                 $notice_data['subject'] = $subject;
                 $notice_data['body'] = $body;
                 $notice_data['newsubject'] = $newsubject;
                 $notice_data['newbody'] = $newbody;
                 Notification::insertnotification($notice_data);
            }
        // }
        
       
    }
    public static function cancreaterfxtemp($data) {
        if ($data) {
            $pk = $data['rfx_pk'];
            $rfx_create = false;
            $rfi_create = false;
            $eoi_create = false;
            $pq_create = false;
            $rfp_create = false;
            $rfq_create = false;
            $rft_create = false;
            $refernce_enquiry_id = '';

            $model = CmsrequisitionformdtlsTbl::find()->where("cmsrequisitionformdtls_pk =:pk", [':pk' => $pk])->one();

            // if($model->crfd_rqprocesstype ==  3) { //if online tender
                $countquery = CmstenderhdrtempTbl::find()
                    ->select(['crfd_rqprocesstype as tender_process_type', 'crfd_rqtype as tender_type','cmstenderhdrtemp_pk as ten_pk', 'cmstht_memcompmst_fk as comp_pk', 'cmstht_type as type', 'cmstht_tenderstatus as status'])
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmstht_cmsrequisitionformdtls_fk')
                    ->where('cmstht_cmsrequisitionformdtls_fk=:pk', array(':pk' => $pk))
                    ->andWhere('cmstht_isdeleted=:isdel', [':isdel' => 2])
                    // ->andWhere(['IN', 'cmsth_tenderstatus' , [3, 6]]) // shortlisted
                    ->orderBy(['cmstenderhdrtemp_pk' => SORT_ASC])
                    ->asArray()
                    ->all();

                $overall_rfx_count = count($countquery);

                $all_status_alone_array = array_map(function($val) {
                    return $val['status'];
                }, $countquery);

                $counts_of_status = array_count_values($all_status_alone_array);

                if($counts_of_status[6] == $overall_rfx_count) { // If all rfx terminated
                    $rfx_create = true;
                    $rfi_create = true;
                    $eoi_create = true;
                    $pq_create = true;
                    $rfp_create = true; 

                    //checking tender type
                    if($model->crfd_rqtype == 1) { //product
                        $rfq_create = true;
                        $rft_create = false; 
                    } else if($model->crfd_rqtype == 2) { //service
                        $rfq_create = false;
                        $rft_create = true;
                    }

                    return $rfx_validation = array(
                        'rfx_create' => $rfx_create,
                        'active_enquiry' => $value['type'],
                        'rfi_create' => $rfi_create,
                        'eoi_create' => $eoi_create,
                        'pq_create' => $pq_create,
                        'rfp_create' => $rfp_create,
                        'rfq_create' => $rfq_create,
                        'rft_create' => $rft_create,
                    );
                } else {
                    foreach($countquery as $key => $value) {
                        if($value['tender_process_type'] == '3') {
                            if($value['status'] != 6) { // not terminated
                                $rfx_create = false;
                                $rfi_create = false;
                                $eoi_create = false;
                                $pq_create = false;
                                $rfp_create = false;
                                $rfq_create = false;
                                $rft_create = false;
    
                                if($value['status'] == 3) { // if any one shortlisted
                                    $rfx_create = true;
                                    
                                    foreach(self::ENQURY_TYPE_TO_CHECK_FOR_CREATE[$value['type']] as $key => $val) {
                                        if($value['type'] != $val) {
                                            ${self::ENQURY_TYPES[$val] . '_create'} = true; // allowing only subsequant of the rfx like if shortlisted is PQ then we are allowing RFP and RFQ
                                        }
                                    }

                                    if($value['type'] != 5 && $value['type'] != 6) {
                                        if($value['tender_type'] == 1) { //product
                                            $rfq_create = true;
                                            $rft_create = false; 
                                        } else if($value['tender_type'] == 2) { //service
                                            $rfq_create = false;
                                            $rft_create = true;
                                        }
                                    } else {
                                        $rfq_create = false;
                                        $rft_create = false;
                                    }

                                    $refernce_enquiry_id = $value['cmstht_cmstenderhdrtemp_fk'] ? $value['cmstht_cmstenderhdrtemp_fk'] : $value['cmstenderhdrtemp_pk'];

                                    return $rfx_validation = array(
                                        'rfx_create' => $rfx_create,
                                        'active_enquiry' => $value['type'],
                                        'rfi_create' => $rfi_create,
                                        'eoi_create' => $eoi_create,
                                        'pq_create' => $pq_create,
                                        'rfp_create' => $rfp_create,
                                        'rfq_create' => $rfq_create,
                                        'rft_create' => $rft_create,
                                        'refernce_enquiry_id' => $refernce_enquiry_id,
                                        'enquiry_status' => $value['status']
                                    );
                                } else {
                                    $rfx_create = false;
                                    $rfi_create = false;
                                    $eoi_create = false;
                                    $pq_create = false;
                                    $rfp_create = false;
                                    $rfq_create = false;
                                    $rft_create = false;

                                    return $rfx_validation = array(
                                        'rfx_create' => $rfx_create,
                                        'active_enquiry' => $value['type'],
                                        'rfi_create' => $rfi_create,
                                        'eoi_create' => $eoi_create,
                                        'pq_create' => $pq_create,
                                        'rfp_create' => $rfp_create,
                                        'rfq_create' => $rfq_create,
                                        'rft_create' => $rft_create,
                                    );
                                }
    
                            }  
                        } else {
                            $rfx_create = false;
                            return $rfx_validation = array(
                                'rfx_create' => $rfx_create,
                                'error' => "You can't create etender for tender which are not online tenders",
                            );
                        }
                    }
                }

            // } else {
            //     $rfx_create = false;
            //     $rfi_create = false;
            //     $eoi_create = false;
            //     $pq_create = false;
            //     $rfp_create = false;
            //     $rfq_create = false;
            //     $rft_create = false;
            // }

            $rfx_validation = array(
                'rfx_create' => $rfx_create,
                'rfi_create' => $rfi_create,
                'eoi_create' => $eoi_create,
                'pq_create' => $pq_create,
                'rfp_create' => $rfp_create,
                'rfq_create' => $rfq_create,
                'rft_create' => $rft_create,
                'refernce_enquiry_id' => $refernce_enquiry_id
            );

            return $rfx_validation;
        }
    }

    /**
     * Get RFX Details and Scope
     */

    public function getRFXDetails($rfx_pk, $rfx_type = null) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $date = new \DateTime();
        $timeZone = $date->getTimezone();
        $data = $products = $files = $doc_list = $inspection_list = [];
        $quotationstatus = 1; 

        if($rfx_type) {
            $tender = CmstenderhdrtempTbl::findOne(['cmstenderhdrtemp_pk' => $rfx_pk, 'cmstht_type' => $rfx_type ]);
        } else {
            $tender = CmstenderhdrtempTbl::findOne($rfx_pk);
        }

        if($tender) {
            $project = $tender->cmsthCmsrequisitionformdtlsFk->crfdProjectdtlsFk;
            $project_stage = $tender->cmsthCmsrequisitionformdtlsFk->crfdProjectdtlsFk->projectstage;
            $questionnaire_tranx = $tender->cmsthCmsquestionnaireformFk ? $tender->cmsthCmsquestionnaireformFk->getCmsquestionnaireformtrnxTbl()->where(['cmsqft_createdby' => $userPK])->one() : null;
            $company = $tender->cmsthCmsrequisitionformdtlsFk->membercompanymst;
            $file = MemcompfiledtlsTbl::findOne($project->prjd_projimg_fk);
            $projectimage = $file ? Drive::generateUrl($file->memcompfiledtls_pk, $file->mcfd_memcompmst_fk, $file->mcfd_uploadedby) : 'assets/images/lypis_noimg.svg';

           
            if(!empty($tender->cmstenderpsmaps)) {
                foreach($tender->cmstenderpsmaps as $product) {
                    $products[] = [
                        'name' => $product->ctpsmCmsrqprodservdtlsFk->crpsd_displayname,
                        'description' => $product->ctpsmCmsrqprodservdtlsFk->crpsd_description,
                        'unit' => $product->ctpsmCmsrqprodservdtlsFk->crpsdUnitmstFk->unm_namesg,
                    ];
                }
            } 
           
           /*
            if(!empty($tender->cmsrqprodservdtlstemp)) {
                foreach($tender->cmsrqprodservdtlstemp as $product) {
                    $products[] = [
                        'name' => $product->crpsdt_displayname,
                        'description' => $product->crpsdt_description,
                        'unit' => $product->crpsdtUnitmstFk->unm_namesg,
                    ];
                }
            }
            */

            if(!empty($tender->specAndDraw)) {
                foreach($tender->specAndDraw as $term) {
                    $files = [];

                    foreach($term->ctncttUploads as $file) {
                        $files[] = [
                            'name' => Drive::getFileName(Security::encrypt($file->memcompfiledtls_pk)),
                            'src' => Drive::generateUrl($file->memcompfiledtls_pk, $file->mcfd_memcompmst_fk, $file->mcfd_uploadedby),
                            'type' => $file->mcfd_filetype,
                            'upload_on' => date('Y-m-d', strtotime($file->mcfd_uploadedon)),
                            'size' => $file->mcfd_actualfilesize,
                        ];
                    }

                    $terms[] = [
                        'name' => $term->ctnctCmsttnchdrFk->ctnch_name,
                        'title' => $term->ctnctt_title,
                        'content' => $term->ctnctt_content,
                        'files' => $files
                    ];
                }
            }

            if(!empty($tender->cmssuppdocreqlisthdr->cmssuppdocreqlistdtlstempTbls)) {
                foreach($tender->cmssuppdocreqlisthdr->cmssuppdocreqlistdtlstempTbls as $doc) {
                    $doc_list[] = [
                        'doc_code' => $doc->csdrldtCmssdrldoccatFk->csdrldc_doccode,
                        'doc_description' => $doc->csdrldtCmssdrldoccatFk->csdrldc_docdesc,
                        'review_class' => $doc->csdrldt_reviewclass,
                        'date' => $doc->csdrldt_createdon
                    ];
                }
            }

            if(!empty($tender->cmsinspreqdochdr->cmsinspreqdocdtlsTbls)) {
                foreach($tender->cmsinspreqdochdr->cmsinspreqdocdtlsTbls as $inspection) {
                    $entities = [];

                    foreach($inspection->cmsinspreqdocactionmapTbls as $entity) {
                        $entities[] = [
                            'name' => $entity->cirdamtQuancheckMcmFk ? $entity->cirdamtQuancheckMcmFk->MCM_CompanyName : $entity->cirdamt_quancheckname,
                            'action' => $entity->cirdamt_actions
                        ];
                    }
                    $inspection_list[] = [
                        'title' => $inspection->cirddt_activitytitle,
                        'activity_no' => $inspection->cirddt_activityno,
                        'ref_doc' => $inspection->cirddt_refdoc,
                        'remarks' => $inspection->cirddt_remarks,
                        'entity' => $entities
                    ];
                }
            }

            if(in_array($tender->cmstht_type, [1, 2, 3])) {
                $tenderResponse = CmstenderresponseTbl::find()->where(['ctr_cmstenderhdr_fk' => $rfx_pk, 'ctr_memcompmst_fk' => $compPK])->one();
                $quotationstatus = $tenderResponse ? $tenderResponse->ctr_status : $quotationstatus;
                $submitted_by = $tenderResponse->cmsqftCreatedby->um_firstname ? $tenderResponse->cmsqftCreatedby->um_firstname : null;
                $submitted_on = $tenderResponse->ctr_createdon ? $tenderResponse->ctr_createdon : null;
                $quotationPK = $tenderResponse->cmstenderresponse_pk ? $tenderResponse->cmstenderresponse_pk : null;
            } elseif(in_array($tender->cmstht_type, [4,5,6])) {
                $quotation = CmsquotationhdrTbl::find()->where(['cmsqh_cmstenderhdr_fk' => $rfx_pk,'cmsqh_isdeleted' =>2,'cmsqh_memcompmst_fk'=>$compPK])->one();
                $quotationstatus = $quotation ? $quotation->cmsqh_status : $quotationstatus;
                $submitted_by = $quotation->cmsqhCreatedby->um_firstname ? $quotation->cmsqhCreatedby->um_firstname : null;
                $submitted_on = $quotation->cmsqh_createdon ? $quotation->cmsqh_createdon : null;
                $quotationPK = $quotation->cmsquotationhdr_pk ? $quotation->cmsquotationhdr_pk : null;
            }

            $additonal_info_data = \api\modules\pms\models\CmsaddinfodtlstempTblQuery::GetAddInfoData($rfx_pk);
            $projectimage = null;
            if($project->prjd_projimg_fk != null){
                $file = MemcompfiledtlsTbl::findOne($project->prjd_projimg_fk);
                $projectimage = Drive::generateUrl($file->memcompfiledtls_pk, $file->mcfd_memcompmst_fk, $file->mcfd_uploadedby);
                $projectimage = $projectimage;
            }

           
            $data = [
                'contactuser_pks' => $tender->cmstht_contact_usermst_fk,
                'reference_enquriy' => $tender->cmstht_cmstenderhdrtemp_fk,
                'type' => $tender->cmstht_type,
                'uid' => $tender->cmstht_uid,
                'ref' => $tender->cmstht_refno,
                'projectImage' => $projectimage,
                'document_remarks' => $tender->cmstht_remarks,
                'attachlink' => $tender->cmstht_attachlink,
                'attachclosedate' => $tender->cmstht_attachclosedate,
                'initiated_on' => $tender->cmstht_initiateddate,
                'initiated_on_date' => date('Y-m-d',strtotime($tender->cmstht_initiateddate)),
                'initiated_by' => $tender->cmstht_initiatedby ? [
                    'name' => $tender->cmsthInitiatedby->um_firstname . ' ' . ($tender->cmsthInitiatedby->um_middlename ? $tender->cmsthInitiatedby->um_middlename . ' ' : '') . $tender->cmsthInitiatedby->um_lastname,
                    'empID' => $tender->cmsthInitiatedby->UM_EmpId,
                    'userpk' => $tender->cmstht_initiatedby,
                    'dropdownName' =>  $tender->cmsthInitiatedby->um_firstname . " - " . $tender->cmsthInitiatedby->UM_EmpId,
                    'dropdownDesignation' => $tender->cmsthInitiatedby->designation->dsg_designationname
                ] : null,
                'name' => $tender->cmstht_title,
                'requisition_fk' => $tender->cmstht_cmsrequisitionformdtls_fk,
                'questionnaire_id' => $tender->cmstht_cmsquestionnaireformtemp_fk,
                'quotationstatus' => $quotationstatus,
                'close_date' => $tender->cmstht_skdclosedate,
                'currenttimezone_close_date' => $tender->cmstht_skdclosedate ? date('d-m-Y h:m A',strtotime(Common::convertTimezone($tender->cmstht_skdclosedate,$tender->cmsthSkdTimezoneFk->tz_utcoffset, $timeZone->getName()))) : null,
                'publish_by' => [
                    'company'=> $company->MCM_CompanyName,
                    'logo_id' => $company ? $company->mcm_complogo_memcompfiledtlsfk : null,
                    'company_id' => $company->MemberCompMst_Pk,
                    'img' => $company->logo ? Drive::generateUrl($company->logo->memcompfiledtls_pk, $company->logo->mcfd_memcompmst_fk, $company->logo->mcfd_uploadedby) : null
                ],
                'sdterm' => $terms,
                'tender_notice' => $tender->cmsthCmsrequisitionformdtlsFk ? [
                    'id' => $tender->cmsthCmsrequisitionformdtlsFk->crfd_rqid,
                    'ref' => $tender->cmsthCmsrequisitionformdtlsFk->crfd_rqrefno,
                    'title' => $tender->cmsthCmsrequisitionformdtlsFk->crfd_rqtitle,
                    'process_type' => $tender->cmsthCmsrequisitionformdtlsFk->crfd_rqprocesstype,
                    'type' => $tender->cmsthCmsrequisitionformdtlsFk->crfd_rqtype,
                    'date' => $tender->cmsthCmsrequisitionformdtlsFk->crfd_rqdate,
                    'priority' => $tender->cmsthCmsrequisitionformdtlsFk->crfd_rqpriority,
                    'status' => $tender->cmsthCmsrequisitionformdtlsFk->crfd_rqstatus,
                    'isblanketrq' => $tender->cmsthCmsrequisitionformdtlsFk->crfd_isblanketrq
                ] : null,
                'project' => $project ? [
                    'id' => $project->prjd_projectid,
                    'ref' => $project->prjd_referenceno,
                    'title' => $project->prjd_projname,
                    'status' => $project->prjd_projstatus,
                    'image' => $projectimage,
                    'project_stage' => $project_stage ? $project_stage : null
                ] : null,
                'start_date' => $tender->cmstht_skdstartdate,
                'discipline_name' => $tender->cmsdisciplined->cmsdd_name,
                'discipline_pk'=> $tender->cmstht_cmsdisciplinedtls_fk,
                'previous_enquiry' => $tender->selfPrevoius ? [
                    'uid' => $tender->selfPrevoius->cmstht_uid,
                    'ref' => $tender->selfPrevoius->cmstht_refno,
                    'title' => $tender->selfPrevoius->cmstht_title,
                    'type' => $tender->selfPrevoius->cmstht_type,
                    'status' => $tender->selfPrevoius->cmstht_tenderstatus
                ] : null,
                'description' => $tender->cmstht_shortdesc,
                'statement' => $tender->cmstht_statement,
                'obligation' => $tender->cmstht_obligation,
                'msmepercent' => (int)$tender->cmstht_msmepercent,
                'lccpercent' => (int)$tender->cmstht_lccpercent,
                'eTendering' => $tender->cmstht_isetendmandate,
                'sub_contracting' => $tender->cmstht_issubcontrqmt,
                'is_icv' => $tender->cmstht_isicv,
                'icv_start_year' => $tender->cmstht_icv_startyear,
                'icv_startquarter' => $tender->cmstht_icv_startquarter,
                'icv_end_year' => $tender->cmstht_icv_endyear,
                'icv_endendquarter' => $tender->cmstht_icv_endquarter,
                'required_currency' => $tender->cmsthCurrencymstFk ? $tender->cmsthCurrencymstFk->CurM_CurrencyName_en : null,
                'products' => $products,
                'supp_doc_req' => $tender->cmssuppdocreqlisthdr ? [
                    'title' => $tender->cmssuppdocreqlisthdr->csdrlhtCmstnchdrtempFk->ctnch_name,
                    'ref_no' => $tender->cmssuppdocreqlisthdr->csdrlht_sdrlrefno,
                    'date' => $tender->cmssuppdocreqlisthdr->csdrlht_sdrldate,
                    'issued_by' => $tender->cmssuppdocreqlisthdr->csdrlhtSdrlusermstFk->um_firstname,
                    'list' => $doc_list
                ] : null,
                'inspection_doc' => $tender->cmsinspreqdochdr ? [
                    'title' => $tender->cmsinspreqdochdr->cirdhCmstnchdrFk->ctnch_name,
                    'ref_no' => $tender->cmsinspreqdochdr->cirdht_itprefno,
                    'date' => $tender->cmsinspreqdochdr->cirdht_itpdate,
                    'issued_by' => $tender->cmsinspreqdochdr->cirdhtItpusermstFk->um_firstname,
                    'list' => $inspection_list,
                    'tech_note' => $tender->cmsinspreqdochdr->cirdht_technote,
                    'general_note' => $tender->cmsinspreqdochdr->cirdht_generalnote,
                    'applicable_spec' => $tender->cmsinspreqdochdr->cirdht_applspec
                ] : null,
                'instruction' => $tender->cmstht_instruction,
                'min_eligibility' => $tender->cmstht_mineligibility,
                'spec_drawing' => $tender->cmstht_specdrawing,
                'reqdate' => $tender->cmstht_reqdate,
                'reqincoterms' => $tender->cmstht_reqincoterms,
                'portname' => $tender->cmstht_portname,
                'submitted_by' => $submitted_by,
                'submitted_on' => $submitted_on,
                'quotationPK' => $quotationPK,
                'additonalinfo' => $additonal_info_data,
                'is_time_over' => $tender->cmstht_skdclosedate ? date('Y-m-d H:i:s', strtotime(gmdate('Y-m-d H:i:s')) . ' ' . $tender->cmsthSkdTimezoneFk->tz_utcoffset) > $tender->cmstht_skdclosedate : false,
                'createdon' => $tender->cmstht_createdon,
                'tender_status' => $tender->cmstht_tenderstatus,
                'csstartdate' => $tender->cmstht_csstartdate,
                'csenddate' => $tender->cmstht_csenddate,
                'terminate_comment' => $tender->cmstht_terminatedcomment ? $tender->cmstht_terminatedcomment : null,
                'terminated_by' => $tender->cmsthterminatedby->um_firstname ? $tender->cmsthterminatedby->um_firstname . ' ' . ($tender->cmsthterminatedby->um_middlename ? $tender->cmsthterminatedby->um_middlename . ' ' : '') . $tender->cmsthterminatedby->um_lastname : null,
                'terminated_on' => $tender->cmstht_terminatedon ? date('d-m-Y h:i:s a', strtotime($tender->cmstht_terminatedon)) : null,
            ];
        }

        return $data;
    }
    
    /**
     * Get RFX Configuration
     */
    public function getRFXConfigurationtemp($rfx_pk) {
        $data = $users = $contacts = [];
        $tender = CmstenderhdrtempTbl::findOne($rfx_pk);
        
        if(!empty($tender->configUsers)) {
            foreach($tender->configUsers as $user) {
                $file = $user->userdp;  
                $users[] = [
                    'name' => $user->um_firstname . ' ' . ($user->um_middlename ? $user->um_middlename . ' ' : '') . $user->um_lastname,
                    'designation' => $user->designation ? $user->designation->dsg_designationname : null,
                    'country_code' => $user->um_primobnocc,
                    'mobile' => $user->um_primobno,
                    'email' => $user->UM_EmailID,
                    'dp' => $user->um_userdp ? Drive::generateUrl($file->memcompfiledtls_pk, $file->mcfd_memcompmst_fk, $file->mcfd_uploadedby): null 
                ];
            }
        }
        
        if(!empty($tender->contactUsers) && in_array($tender->cmstht_type, [1,2,3])) {
            foreach($tender->contactUsers as $user) {
                $contacts[] = [
                    'name' => $user->um_firstname . ' ' . ($user->um_middlename ? $user->um_middlename . ' ' : '') . $user->um_lastname,
                    'designation' => $user->designation ? $user->designation->dsg_designationname : null,
                    'country_code' => $user->um_primobnocc,
                    'mobile' => $user->um_primobno,
                    'email' => $user->UM_EmailID,
                    'dp' => $user->userdp->mcfd_sysgenerfilename
                ];
            }
        }

      
        // Target suppliers starts
        $data['isTemp'] = 1;
        $jsrsQ = "(CASE WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'A' AND MRM_ValSubStatus = 'A' AND mcm_accexpirydate >= DATE(NOW())) THEN 'Active' WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'A' AND MRM_ValSubStatus = 'A' AND mcm_accexpirydate < DATE(NOW())) THEN 'Expired' WHEN (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'V' AND MRM_ValSubStatus <> 'A' AND MRM_OrderConfrmStat = 'A') THEN 'Yet to Certify' WHEN (mrm_stkholdertypmst_fk = 14 OR (mrm_stkholdertypmst_fk = 6 AND MRM_MemberStatus = 'I' AND MRM_OrderConfrmStat <> 'A')) THEN 'Yet to Register' ELSE 'In-active' END)";

        $query = CmstendertargethdrtempTbl::find();

        $subQuery = 'SELECT group_concat(m2.mclch_lcctype) FROM memcomplcccerthdr_tbl m2 WHERE m2.mclch_membercompmst_fk = MemberCompMst_Pk and m2.mclch_status = 1';

        $query->select(['MCM_CompanyName', 'mcm_complogo_memcompfiledtlsfk', 'MemberCompMst_Pk', 'MCM_SupplierCode', 'CyM_CountryName_en', 'CountryMst_Pk', 'REPLACE(ClM_ClassificationType, " ", "") ClM_ClassificationType', 'ISM_IncorpStyleEntity', '('.$subQuery.') as mclch_lcctype', 'cnjsm_cmsnonjsrssupdtls_fk', 'cnjsm_contperson', 'cnjsm_designation', 'cnjsm_contactemail', 'cnjsm_contactmobilecc', 'cnjsm_contactmobile', 'cnjsm_specialstatus', $jsrsQ.' AS jsrs'])
            ->leftJoin('memberregistrationmst_tbl', 'cmsttht_memberregmst_fk  = MemberRegMst_Pk')
            ->leftJoin('membercompanymst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
            ->leftJoin('countrymst_tbl', 'MCM_Source_CountryMst_Fk = CountryMst_Pk')
            ->leftJoin('classificationmst_tbl', 'mcm_classificationmst_fk = classificationmst_pk')
            ->leftJoin('incorpstylemst_tbl', 'mrm_incorpstylemst_fk = IncorpStyleMst_Pk')
            ->leftJoin('memcomplcccerthdr_tbl', 'MemberCompMst_Pk = mclch_membercompmst_fk and mclch_status = 1')
            ->leftJoin('cmsnonjsrssupdtls_tbl', 'MemberRegMst_Pk = cmsnjsd_memberregmst_fk')
            ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupdtls_pk = cnjsm_cmsnonjsrssupdtls_fk')
            ->where(['cmsttht_cmstenderhdrtemp_fk' => $rfx_pk]);                

        if($data['search']['company']) {
            $query = $query->andFilterWhere(['like', 'MCM_CompanyName', $data['search']['company']]);
        }
        
        $filter = $data['filter'];
        if($filter['suppcode']) {
            $query = $query->andFilterWhere(['like', 'MCM_SupplierCode', $filter['suppcode']]);
        }
        if($filter['country']) {
            $query = $query->andWhere(['in', 'CyM_CountryName_en', $filter['country']]);
        }
        if($filter['classify']) {
            $query = $query->andWhere(['in', 'ClM_ClassificationType', $filter['classify']]);
        }
        if($filter['icstyle']) {
            $query = $query->andWhere(['in', 'ISM_IncorpStyleEntity', $filter['icstyle']]);
        }
        if($filter['specialStatus']) {
            $query = $query->andWhere(['in', 'mclch_lcctype', $filter['specialStatus']]);
        }
        if($filter['isjsrs']) {
            $query = $query->andWhere(['in', $jsrsQ, $filter['isjsrs']]);
        }

        
        $sort = [$data['isTemp'] ? 'cmstendertargethdrtemp_pk' : 'cmstendertargethdr_pk' => SORT_ASC];  
        if($data['sort'] == 'asc') {
            $sort = 'MCM_CompanyName asc';
        } elseif ($data['sort'] == 'desc') {
            $sort = 'MCM_CompanyName desc';        
        } elseif ($data['sort'] == 'recent') {
            $sort = [$data['isTemp'] ? 'cmstendertargethdrtemp_pk' : 'cmstendertargethdr_pk' => SORT_DESC];            
        }

        $query = $query->orderBy($sort)->groupBy('cmstendertargethdrtemp_pk');  
        if($query->count() <= 5) {
            $data['page'] = 0;
        } 
        $query = $query->asArray(); 

        $provider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => $sort
            ],
            'pagination' => [
                'page' => $data['page'], 
                'pageSize' => $data['size']
            ]
        ]);

        $classify_array = array('MSME-Micro'=>1,'MSME-Small'=>2,'MSME-Medium'=>3,'MSME-Large'=>4);
        $jsrs_status_array = array('Active'=>1,'Expired'=>2);

      
        $tenderTargetData = [];
        foreach ($provider->getModels() as $kay => $proVal) {
            $specialStatus = $proVal['mclch_lcctype'] ? array_map('intval', explode(',', $proVal['mclch_lcctype'])) : [];            
            $classify_string = isset($classify_array[$proVal['ClM_ClassificationType']] ) ? $classify_array[$proVal['ClM_ClassificationType']] : '';
            $status_string = isset($jsrs_status_array[ $proVal['jsrs']] ) ? $jsrs_status_array[ $proVal['jsrs']] : '';
            $tenderTargetData[] = [
                'companyName' => $proVal['MCM_CompanyName'],
                'logo_id' => $proVal['mcm_complogo_memcompfiledtlsfk'],
                'company_id' => $proVal['MemberCompMst_Pk'],
                'supplierCode' => $proVal['MCM_SupplierCode'],
                'Country' => $proVal['CyM_CountryName_en'],
                'flag' => $proVal['CountryMst_Pk'],
                'classification' => $classify_string, //$proVal['ClM_ClassificationType']
                'icstyle' => $proVal['ISM_IncorpStyleEntity'],
                //'jsrsStatus' => $specialStatus,
                'jsrsStatus' => $status_string , // $proVal['jsrs']
                'nonjsrs' => $proVal['cnjsm_cmsnonjsrssupdtls_fk'] ? [
                    'name' => $proVal['cnjsm_contperson'],
                    'designation' => $proVal['cnjsm_designation'],
                    'email' => $proVal['cnjsm_contactemail'],
                    'mobilecc' => $proVal['cnjsm_contactmobilecc'],
                    'mobile' => $proVal['cnjsm_contactmobile'],
                    'status' => $proVal['cnjsm_specialstatus']
                ] : null
            ];
        }

        

        $respData = [
            'suppliers' => $tenderTargetData,
            'total_count' => $provider->getTotalCount()
        ];
        if($data['isFirst']) {
            $respData['jsrsstatuslist'] = ['Active', 'Expired'];
            $respData['icstylelist'] = $provider->query->select('GROUP_CONCAT(DISTINCT ISM_IncorpStyleEntity) AS icstyle')->groupBy($data['isTemp'] ? 'cmsttht_cmstenderhdrtemp_fk' : 'cmstth_cmstenderhdr_fk')->one()['icstyle'];
            $respData['countrylist'] = $provider->query->select('GROUP_CONCAT(DISTINCT CountryMst_Pk) AS country')->groupBy($data['isTemp'] ? 'cmsttht_cmstenderhdrtemp_fk' : 'cmstth_cmstenderhdr_fk')->one()['country'];
            $respData['classifylist'] = $provider->query->select('GROUP_CONCAT(DISTINCT ClM_ClassificationType) AS classify')->groupBy($data['isTemp'] ? 'cmsttht_cmstenderhdrtemp_fk' : 'cmstth_cmstenderhdr_fk')->one()['classify'];
        }
       
        // target supplier ends

        $data = [
            'notifyuser_pks' => $tender->cmstht_config_usermst_fk,
            'contactuser_pks' => $tender->cmstht_contact_usermst_fk,
            'rfxtype' => $tender->cmstht_type, 
            'reminder' => $tender->cmstht_setreminder == 1 || $tender->cmstht_setreminder == 2 ? [
                'close_intvl' => $tender->cmstht_closeintvl,
                'close_intvl_type' => $tender->cmstht_closeintvltype,
                'open_intvl' => $tender->cmstht_openintvl,
                'open_intvl_type' => $tender->cmstht_openintvltype,
                'isremainder' => $tender->cmstht_setreminder
            ] : null,
            'notify_users' => $users,
            'contacts' => $contacts,
            'subcontract_status' => $tender->cmstht_issubcontrqmt,
            'obligation' => $tender->cmstht_obligation,
            'msmepercent' => $tender->cmstht_msmepercent,
            'lccpercent' => $tender->cmstht_lccpercent,
            'obligation_scope' => $tender->cmstht_obligationscope,
            'eTendering' => $tender->cmstht_isetendmandate,
            'is_icv' => $tender->cmstht_isicv,
            'icv_startyear' => $tender->cmstht_icv_startyear,
            'icv_startquarter' => $tender->cmstht_icv_startquarter,
            'icv_endyear' => $tender->cmstht_icv_endyear,
            'icv_endquarter' => $tender->cmstht_icv_endquarter,
            'supplierData'=> $respData,
            'targeted_supplier' => $tender->cmstendertargethdrTbls ? [
                'shortlisted' => $tender->getCmstendertargethdrTbls()->where(['cmsttht_targettype' => 1])->count(),
                'jsrs' => $tender->getCmstendertargethdrTbls()->where(['cmsttht_targettype' => 2])->count(),
                'non_jsrs' => $tender->getCmstendertargethdrTbls()->where(['cmsttht_targettype' => 3])->count()
            ] : null
        ];

        return $data;
    }

    public function getOveralldataStatustemp($rfx_pk) {
        $tender = CmstenderhdrtempTbl::findOne($rfx_pk);
        $overall_status = [];
        $rfxterms_values_count = 0;
        if($tender) {

            if(!empty($tender->cmstnctrnxs)) {
                foreach($tender->cmstnctrnxs as $term) {                
                    $files = [];
                    if(!$term->ctnctt_content &&  !$term->ctncttUploads) {
                        $rfxterms_values_count++;
                    }
                }
            }
            $overall_status['tenderdetails'] = $tender;
            $overall_status['additional_info'] = count($tender->cmsaddinfodtlsTbls);
            $overall_status['supporting_count'] = count($tender->supportingDocuments);
            $overall_status['questionariedetails'] = $tender->cmstht_cmsquestionnaireformtemp_fk;
            $overall_status['rfxterms_values'] = $tender->cmstnctrnxs;
            $overall_status['rfxconfiguration_values'] = array(
                'reminder' => $tender->cmstht_setreminder,
                'reminder_openintvl' => $tender->cmstht_openintvl,
                'notifyUsers' => $tender->configUsers,
                'contactUsers' => count(array_filter(explode(',',$tender->cmstht_contact_usermst_fk))),
                'cmissubcontrqmt' => $tender->cmstht_issubcontrqmt,
                'subcontract_obligation' => $tender->cmstht_obligation,
                'isicv' => $tender->cmstht_isicv,
                'icv_startyear' => $tender->cmstht_icv_startyear,
                'targeted_supplier' => $tender->cmstendertargethdrTbls ? [
                    'shortlisted' => $tender->getCmstendertargethdrTbls()->where(['cmsttht_targettype' => 1])->count(),
                    'jsrs' => $tender->getCmstendertargethdrTbls()->where(['cmsttht_targettype' => 2])->count(),
                    'non_jsrs' => $tender->getCmstendertargethdrTbls()->where(['cmsttht_targettype' => 3])->count()
                ] : null
            );
            $overall_status['rfxcommunication_values'] = $tender->cmstht_contact_usermst_fk;
            $overall_status['rfxadditional_documents'] = count($tender->additionalDocuments);
            return $overall_status;
        } 
    }

    /**
     * Get RFX Supporting Document
     */
    public function getRFXSupportingDoctemp($rfx_pk) {
        $data = $docs = [];
        $tender = CmstenderhdrtempTbl::findOne($rfx_pk);
        if(!empty($tender->supportingDocuments)) {
            foreach($tender->supportingDocuments as $doc) {
                $docs[] = [
                    'name' => $doc->cmssdt_docname,
                    'file' => $doc->cmssdtUpload ? [
                        'name' => Drive::getFileName(Security::encrypt($doc->cmssdtUpload->memcompfiledtls_pk)),
                        'src' => Drive::generateUrl($doc->cmssdtUpload->memcompfiledtls_pk, $doc->cmssdtUpload->mcfd_memcompmst_fk, $doc->cmssdtUpload->mcfd_uploadedby),
                        'type' => $doc->cmssdtUpload->mcfd_filetype,
                        'upload_on' => $doc->cmssdtUpload->mcfd_uploadedon,
                        'size' => $doc->cmssdtUpload->mcfd_actualfilesize
                    ] : null
                ];
            }
        }

        $data = [
            'remarks' => $tender->cmstht_remarks,
            'supporting_docs' => $docs
        ];

        return $data;
    }

    /**
     * Get RFX Questionnaire Form
     */
    public function getRFXQuestionnaireFormtemp($pk) {
        $questionnaire = CmsquestionnaireformtempTbl::findOne($pk);
        
        $data = [
            'name' => $questionnaire->cmsqft_formname,
            // 'nameheader' => $questionnaire->cmsqft_formnameheight,
            'description' => $questionnaire->cmsqft_formdesc,
            // 'descriptionheader' =>  $questionnaire->cmsqft_formdescheight,
            'created_on' => $questionnaire->cmsqft_createdon,
            'builder_template' => $questionnaire->cmsqft_buildertemplate,
            'builder_template_count' => count($questionnaire->cmsqft_buildertemplate)
        ];

        return $data;
    }

    /**
     * Get RFX Questionnaire Form answer
     */
    public function getRFXQuestionnaireFormAnswertemp($qpk, $rfxid, $type) {
        $questionnaire = CmsquestionnaireformtrnxtempTbl::find()
            ->select(['cmsqftt_answer'])
            ->where(['cmsqftt_cmsquestionnaireformtemp_fk' => $qpk])
            ->andWhere(['cmsqftt_shared_fk' => $rfxid])
            ->andWhere(['cmsqftt_shared_type' => $type])
            ->all();
        
        $data = [
            'ques_answer' => $questionnaire[0]['cmsqftt_answer'],
        ];

        return $data;
    }

    /**
     * Get RFX Terms
     */
    public function getRFXTermstemp($rfx_pk) {
        $data = $terms = $payments = [];
        $tender = CmstenderhdrtempTbl::findOne($rfx_pk);
        
        if(!empty($tender->cmstnctrnxs)) {
            foreach($tender->cmstnctrnxs as $term) {        
                $files = [];
                if($term->ctncttUploads) {
                    foreach($term->ctncttUploads as $file) {
                        $files[] = [
                            'name' => Drive::getFileName(Security::encrypt($file->memcompfiledtls_pk)),
                            'src' => Drive::generateUrl($file->memcompfiledtls_pk, $file->mcfd_memcompmst_fk, $file->mcfd_uploadedby),
                            'type' => $file->mcfd_filetype,
                            'upload_on' => $file->mcfd_uploadedon,
                            'size' => $file->mcfd_actualfilesize,
                        ];
                    }
                }

                $terms[$term->ctnctt_cmstnchdr_fk][] = [
                    'name' => $term->ctncttCmstnchdrFk->ctnch_name, 
                    'title' => $term->ctnctt_title,
                    'content' => $term->ctnctt_content,
                    'files' => $files
                ];
            }
        }

        if(!empty($tender->cmspaymentterms)) {
            foreach($tender->cmspaymentterms as $payment) {
                $payments[] = [
                    'name' => $payment->cmsptt_name,
                    'value' => $payment->cmsptt_value,
                    'pk' => $payment->cmspaymenttermstemp_pk
                ];
            }
        }

        $data = [
            'invoice_interval' => $tender->cmstht_invoiceinterval,
            'invoice_interval_type' => $tender->cmstht_invoiceintervaltype,
            'payment_terms' => $payments,
            'terms' => array_values($terms)
        ];

        return $data;
    }

    /**
     * Get RFX Contacts Detail
     */
    public function getRFXContactstemp($formData) {
        $data = $users = [];
        $tender = CmstenderhdrtempTbl::findOne($formData['rfx_pk']);
        
        if(!empty($tender->contactUsers)) {
            foreach($tender->contactUsers as $user) {
                // $mob_no = !empty($formData['open_view']) ? $user->um_primobno : str_pad(substr($user->um_primobno, 0, 1), strlen($user->um_primobno), 'x');
                $mob_no = $user->um_primobno;
                $users[] = [
                    'name' => $user->um_firstname . ' ' . ($user->um_middlename ? $user->um_middlename . ' ' : '') . $user->um_lastname,
                    'designation' => $user->designation ? $user->designation->dsg_designationname : null,
                    'country_code' => $user->um_primobnocc,
                    'mobile' => $mob_no,
                    'email' => $user->UM_EmailID,
                    'dp' => Drive::generateUrl($user->um_userdp, $user->uMMemberRegMstFk->company->MemberCompMst_Pk, $user->UserMst_Pk),
                    'dept'=>$user->department->DM_Name
                ];
            }
        }

        $data = [
            'users' => $users
        ];

        return $data;
    }

    /**
     * Get RFX Additional Document
     */
    public function getRFXAdditionalDoctemp($rfx_pk) {
        $data = $docs = [];
        $tender = CmstenderhdrtempTbl::findOne($rfx_pk);

        if(!empty($tender->additionalDocuments)) {
            foreach($tender->additionalDocuments as $doc) { 
                $docs[] = [
                    'file' => $doc->cmssdtUpload ? [
                        'name' => Drive::getFileName(Security::encrypt($doc->cmssdtUpload->memcompfiledtls_pk)),
                        'src' => Drive::generateUrl($doc->cmssdtUpload->memcompfiledtls_pk, $doc->cmssdtUpload->mcfd_memcompmst_fk, $doc->cmssdtUpload->mcfd_uploadedby),
                        'type' => $doc->cmssdtUpload->mcfd_filetype,
                        'upload_on' => $doc->cmssdtUpload->mcfd_uploadedon,
                        'size' => $doc->cmssdtUpload->mcfd_actualfilesize                        
                    ] : null
                ];
            }
        }

        $data = [
            'link' => $tender->cmstht_attachlink,
            'close_date' => $tender->cmstht_attachclosedate,
            'additional_docs' => $docs
        ];

        return $data;
    }

    public function getrfxdatafortendercounttemp($tenPk) {
        $model = CmstenderhdrtempTbl::find()->select(['cmstht_type','count(*) as count'])
            ->where('cmstht_cmsrequisitionformdtls_fk=:pk', [':pk' => $tenPk])
            ->andWhere('cmstht_isdeleted=:isdel', [':isdel' => 2])
            ->groupBy(['cmstht_type'])
            ->asArray()
            ->All(); 
        return $model;
    }

    public function getrfxdatafortendertemp($tenPk, $type, $page, $perpage, $sortorder=null) { 
        $model = CmstenderhdrtempTbl::find()
            ->select(['*', 
            'CASE 
                WHEN `cmstht_tenderstatus`= 1 THEN "Yet to Publish"  
                WHEN `cmstht_tenderstatus`= 2 THEN "Published" 
                WHEN `cmstht_tenderstatus`= 3 THEN "Shortlisted" 
                WHEN `cmstht_tenderstatus`= 4 THEN "Rejected" 
                WHEN `cmstht_tenderstatus`= 5 THEN "Awarded" 
                WHEN `cmstht_tenderstatus`= 6 THEN "Terminated" 
                WHEN `cmstht_tenderstatus`= 7 THEN "Closed"
                WHEN `cmstht_tenderstatus`= 8 THEN "Evaluation Completed"
                WHEN `cmstht_tenderstatus`= 8 and (`cmstht_type` != 2 or `cmstht_type` != 3) THEN "Yet to Award"
                WHEN `cmstht_tenderstatus`= 9 THEN "Yet to Evaluate"
                WHEN `cmstht_tenderstatus`= 10 THEN "Evaluation in Progress"
                WHEN `cmstht_tenderstatus`= 11 THEN "Scheduled to Publish Later"
            END as derived_status', 
            'date_format(cmstht_initiateddate,"%d-%m-%Y") as cmstht_initiateddate_formatted', 'date_format(cmsth_skdclosedate,"%d-%m-%Y") as cmsth_skdclosedate_formatted', 'um_firstname'])
            ->leftJoin('usermst_tbl', 'UserMst_Pk = cmstht_initiatedby')
            ->leftJoin('cmstenderhdr_tbl', 'cmsth_cmstenderhdrtemp_fk = cmstenderhdrtemp_pk')
            ->leftJoin('cmscontracthdr_tbl', 'cmsch_cmstenderhdr_fk = cmstenderhdrtemp_pk and cmsch_isdeleted = 2')
            ->where('cmstht_cmsrequisitionformdtls_fk=:pk', [':pk' => $tenPk])
            ->andWhere('cmstht_isdeleted=:isdel', [':isdel' => 2])
            ->andWhere('cmstht_type=:type', [':type' => $type])
            ->asArray();
        if ($sortorder == 1) {
            $model->orderBy([new \yii\db\Expression("coalesce(cmstht_updatedon,cmstht_createdon) DESC")]);
        } else {
            $model->orderBy([new \yii\db\Expression("coalesce(cmstht_updatedon,cmstht_createdon) ASC")]);
        }

        $provider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => ['pageSize' => $perpage, 'page' => $page]
        ]);

        foreach ($provider->getModels() as $value) {
            $data['rfx_pk'] = $value['cmstenderhdrtemp_pk'];
            $can_terminate_arr =  self::canterminate($data); 
            $value['can_terminate'] = $can_terminate_arr;   
            $cancreatecheckarray = array('rfx_pk' => $value['cmsrequisitionformdtls_pk'], 'type' => $value['cmstht_type']);
            $can_create_enquiry = self::cancreaterfxtemp($cancreatecheckarray);
            $value['can_create_enquiry'] = $can_create_enquiry;
            $value['targeted_suppliers_count'] = CmstendertargethdrtempTbl::find()->where(['cmsttht_cmstenderhdrtemp_fk' => $value['cmstenderhdrtemp_pk']])->count();
            if(in_array($value['cmstht_type'], ['1','2','3'])) {
                $value['received_responses_count'] = CmstenderresponseTbl::find()->where(['ctr_cmstenderhdr_fk' => $value['cmstenderhdrtemp_pk']])->count();
                $value['shortlisted_count'] = CmstenderresponseTbl::find()->where(['ctr_cmstenderhdr_fk' => $value['cmstenderhdrtemp_pk'], 'ctr_status' => 5])->count();
                $value['awarded_count'] = CmstenderresponseTbl::find()->where(['ctr_cmstenderhdr_fk' => $value['cmstenderhdrtemp_pk'], 'ctr_status' => 7])->count();
            } else {
                $value['received_responses_count'] = CmsquotationhdrTbl::find()->where(['cmsqh_cmstenderhdr_fk' => $value['cmstenderhdrtemp_pk']])->count();
                $value['shortlisted_count'] = CmsquotationhdrTbl::find()->where(['cmsqh_cmstenderhdr_fk' => $value['cmstenderhdrtemp_pk'], 'cmsqh_status' => 5])->count();
                $value['awarded_count'] = CmsquotationhdrTbl::find()->where(['cmsqh_cmstenderhdr_fk' => $value['cmstenderhdrtemp_pk'], 'cmsqh_status' => 7])->count();
            }
            $conact_pks = explode(',', $value['cmstht_contact_usermst_fk']);
            $value['contact_users'] = \common\models\UsermstTblQuery::getAllUserData($conact_pks);
            $overall_user_count = count($value['contact_users']['userfirst_character']);
            $value['userfirst_character'] = array_slice($value['contact_users']['userfirst_character'],0,2);
            $value['overall_user_count'] = $overall_user_count;
            unset($value['contact_users']['userfirst_character']);
            if($overall_user_count > 2) {
                array_push($value['userfirst_character'], $overall_user_count-2 . '+');
            }
            // $deriverd_status = self::getrfxstatusvalue($value);
            // $value['derived_status'] = $deriverd_status; 
            $finalData[] = $value;
        }

        return [
            'items' => $finalData,
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
        ]; 
    }

    public static function canterminate($data) {
        if ($data) {
            $pk = $data['rfx_pk']; 
            $can_terminate = true;

            $rfx_data = CmstenderhdrtempTbl::findOne($pk);
            $rfxstatus = $rfx_data->cmstht_tenderstatus;
            
            if($rfxstatus == 2) {
                $is_subsequence_etender_available = self::get_subsequence_etender($pk , $rfx_data->cmstht_type);
                if(in_array(true, array_values($is_subsequence_etender_available))) {
                    $can_terminate = false;
                    $can_terminate_array = array(
                        'status' => 200,
                        'msg' => 'Error', 
                        'flag' => 'E', 
                        'comments' => "You can't terminate active etender sequence",
                        'can_terminate' => $can_terminate,
                        'etenders_status' => $is_subsequence_etender_available
                    );
                } else {
                    // $contracts = CmscontracthdrTbl::find()->where(['cmstht_cmstenderhdrtemp_fk' => $pk])->all();
                    // if(count($contracts) > 0) {
                    //     $can_terminate = false;
                    // } else {
                        $can_terminate = true;
                    // }

                    // $can_terminate_array = array(
                    //     'status' => 200,
                    //     'msg' => 'success', 
                    //     'comments' => "You can't terminate as etender having contract",
                    //     'can_terminate' => $can_terminate,
                    //     'etenders_status' => $is_subsequence_etender_available,
                    //     'contract_status' => $contracts,
                    // );
                    $can_terminate_array = array(
                        'status' => 200,
                        'msg' => 'Error', 
                        'flag' => 'E', 
                        'comments' => "You can't terminate active etender sequence",
                        'can_terminate' => $can_terminate,
                        'etenders_status' => $is_subsequence_etender_available
                    );
                }
            } else { 
                return $can_terminate_array = array(
                    'status' => 200,
                    'msg' => 'Error',
                    'flag' => 'E',
                    'comments' => "You can't terminate active etender",
                    'can_terminate' => false
                );
            }
            
            return $can_terminate_array;  
        }  
    }

    public static function get_subsequence_etender($pk, $type) {
        $rfi_available = false;
        $eoi_available = false;
        $pq_available = false;
        $rfp_available = false;
        $rfq_available = false;
        $rft_available = false;

        if($pk) {
            foreach(self::ENQURY_TYPE_TO_CHECK_FOR_CREATE[$type] as $key => $val) {
                $subsequence_etender = CmstenderhdrtempTbl::find()
                    ->select(['count(*) as count'])
                    ->where('cmstht_cmstenderhdrtemp_fk=:fk', array(':fk' => $pk))
                    ->andWhere('cmstht_tenderstatus !=:status', array(':status' => 6))
                    ->andWhere('cmstht_isdeleted=:isdel', [':isdel' => 2])
                    ->andWhere('cmstht_type=:type', array(':type' => $val))
                    ->asArray()
                    ->all(); 
                    if($subsequence_etender[0]['count'] > 0) {
                        ${self::ENQURY_TYPES[$val] . '_available'} = true;
                    } else {
                        ${self::ENQURY_TYPES[$val] . '_available'} = false;
                    }
                }
            $rfx_creation = array(
                'rfi_available' => $rfi_available,
                'eoi_available' => $eoi_available,
                'pq_available' => $pq_available, 
                'rfp_available' => $rfp_available, 
                'rfq_available' => $rfq_available, 
                'rft_available' => $rft_available, 
            );
            return $rfx_creation; 
        }
    }

    public static function getrfxstatusvalue($model) {
        // db values
        // 1 - Yet to Submit, 2 - Submitted, 
        // 3 - Shortlisted, 4 - Rejected, 5 - Awarded, 
        // 6 - Terminated, 7 - Closed, 8 - Yet to Award, 
        // 9 - Yet to Shortlist, 10 - Shortlisting in Progress
        if($model) {
            $status = '';
            $tendermodel = CmstenderhdrtempTbl::findOne($model['cmstenderhdrtemp_pk']);

            if($model['cmstht_tenderstatus'] != 2 && $model['cmstht_skdtype'] != 2) {
                $status = 'Yet to Publish';
            } 
            
            if($model['cmstht_tenderstatus'] != 2 && $model['cmstht_skdtype'] == 2){
                $status = 'Scheduled to Publish Later';
            } 

            if($model['cmstht_tenderstatus'] == 2 && count($tendermodel->cmstenderresponseTbls) == 0){
                $status = 'Published';
            }  

            if($tendermodel->cmstenderresponseTbls) {
                $overall_response = count($tendermodel->cmstenderresponseTbls);

                $all_response_alone_array = array_map(function($val) {
                    return $val['ctr_status'];
                }, $tendermodel->cmstenderresponseTbls);

                $counts_of_status = array_count_values($all_response_alone_array);
                if($counts_of_status[5] == $overall_response) {
                    // $status = 'Yet to Award'; // Evaluation completed
                    $status = 'Evaluation completed';
                } else if($counts_of_status[2] == $overall_response) {
                    $status = 'Yet to Evaluate';
                } else if($counts_of_status[5] != $overall_response) {
                    $status = 'Evaluation In-progress';
                } else if($counts_of_status[6] != $overall_response) {
                    $status = 'Rejected';
                } else if($counts_of_status[6] == $overall_response) {
                    $status = 'Rejected';
                }  
            } 

            if($model['cmstht_tenderstatus'] == 6){
                $status = 'Terminated';
            }
            if($model['cmstht_tenderstatus'] == 4){
                $status = 'Rejected';
            } 
            if($model['cmstht_tenderstatus'] == 5){
                $status = 'Awarded'; // not required here
            } 
            if($model['cmstht_tenderstatus'] == 3){
                $status = 'Shortlisted';
            }
            
            if($status) {
                return array('status_name' => $status, 'icon' => "", "class" => ""); 
            }
        }
    }
    
    public function changestatustemp($ten_id, $status, $comments = null) { 
        $can_execute_query = false;
        if($ten_id) {

            $model = CmstenderhdrtempTbl::find()
                ->where("cmstenderhdrtemp_pk =:pk", [':pk' =>  $ten_id])
                ->one();

            $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
            if($model) {
                $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
                if($status ==  6) {
                    $data['rfx_pk'] = $ten_id;
                    $can_terminate_arr =  self::canterminate($data);
                    if($can_terminate_arr['can_terminate']) {
                        $ip_address = Common::getIpAddress();
                        $date = date('Y-m-d H:i:s');
                        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);

                        $model->cmstht_tenderstatus = $status;
                        $model->cmstht_terminatedon = $date;
                        $model->cmstht_terminatedby = $userPK;
                        $model->cmstht_terminatedbyipaddr = $ip_address;
                        if($comments) {
                            $model->cmstht_terminatedcomment = $comments;
                        }
                        $can_execute_query = true;
                        
                    } else {
                        return array(
                            'status' => 200,
                            'msg' => 'warning',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'returndata' => $can_terminate_arr
                        ); 
                    }
                }  else if($status ==  2) { 
                    $model->cmstht_tenderstatus = $status;
                    $can_execute_query = $moving_temp_main = self::copyingrfxdata($model, 'temptomain','web');
                    $can_execute_query = true;
                } else {
                    $can_execute_query = true;
                    $model->cmstht_tenderstatus = $status;
                }
                
                // this code has to be moved below inside the success
                if($status == 6 && !empty($model->cmstendertargethdrTbls)){
                    self::insertnoticerecord($model,$regPk,$status=4);
                    foreach($model->cmstendertargethdrTbls as $target){
                        if(!empty($target->cmstthMemberregmstFk->user->UM_EmailID)){
                            $this->sendRfxEmail($model, $target, $template_id = 248);
                        }
                    }
                }

                if($can_execute_query) {
                    if($model->save() === true) {
                        return array(
                            'status' => 200,
                            'msg' => 'success',
                            'flag' => 'U',
                            'comments' => 'Enquiry Status Updated Successfully!'
                        );
                    } else {
                        return array(
                            'status' => 200,
                            'msg' => 'warning',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'returndata' => $model->getErrors()
                        ); 
                    }
                } else {
                    return array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                    ); 
                }
               
            } else {
                return array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }  
        }

    }

    public function getrfidatafortender($tenPk, $type) {
        $model = CmstenderhdrtempTbl::find()->
            select(['*', 'date_format(cmstht_initiateddate,"%d-%m-%Y") as cmstht_initiateddate_formatted', 'um_firstname'])
            ->leftJoin('usermst_tbl', 'UserMst_Pk = cmstht_initiatedby')
            ->where('cmstht_cmsrequisitionformdtls_fk=:pk', [':pk' => $tenPk])
            ->andWhere('cmstht_type=:type', [':type' => $type])
            ->andWhere('cmstht_isdeleted=:isdel', [':isdel' => 2])
            ->asArray()->All();
        return $model;
    }

    public static function deletetenquirytemp($enquirypk) {
        $result = array(
            'status' => 200,
            'msg' => 'failure',
            'flag' => 'U',
            'comments' => 'Something Went Wrong!',
        );

        if($enquirypk) {
            $tender = CmstenderhdrtempTbl::findOne($enquirypk);
            if($tender) {
                $tender->cmstht_isdeleted = 1;

                if ($tender->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Enquiry Deleated Successfully!',
                    );
                }

            } 
        }
        return $result;
    }

    public function copyingrfxdata($tempmodel, $copytype,$comingfrom) {  
        // echo $copytype;exit;
        if($tempmodel) { 
            $tenderhdrtemp_columns_to_skip = ['cmstht_uid', 'cmsth_uid', 'cmsth_cmsquestionnaireform_fk', 'cmstenderhdr_pk', 'cmstenderhdrtemp_pk','cmstht_cmstenderhdrtemp_fk', 'cmstht_uid', 'cmstht_cmsquestionnaireformtemp_fk', 'cmstht_tenderstatus', 'cmsthh_cmstenderhdrhsty_fk', 'cmsthh_cmsrequisitionformdtls_fk'];
            if($comingfrom == 'cron') {
                $crondata = array('company_pk'=> $tempmodel->cmstht_memcompmst_fk,'usermst_pk'=> $tempmodel->cmstht_createdby,'jsrsno'=>$tempmodel->membercompanymsttbl->mcm_RegistrationNo,'datafrom'=>'cron');
            }else{
                $crondata = array();
            }
           
            if($copytype == 'temptomain') {
                $model = CmstenderhdrTbl::findOne(['cmsth_cmstenderhdrtemp_fk' => $tempmodel->cmstenderhdrtemp_pk]);               

                               
                if($model == null || $model == '') { 
                    $model = new CmstenderhdrTbl();                    
                    $model->cmsth_uid =  $tempmodel->cmstht_uid; 
                }else{
                    
                    $ip_address = Common::getIpAddress();
                    $date = date('Y-m-d H:i:s');
                    $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                    $model->cmsth_isrepublished = 1;
                    $model->cmsth_republishedon = $date;
                    $model->cmsth_republishedby = $userPK;
                    $model->cmsth_republishedipaddr = $ip_address;
                }
                $model->cmsth_tenderstatus = 2; 
                $model->cmsth_cmstenderhdrtemp_fk = $tempmodel->cmstenderhdrtemp_pk;    
                $model->cmsth_mailfor = $tempmodel->cmstht_mailfor;           
                // $model->cmsth_cmsquestionnaireform_fk = $tempmodel->cmstht_cmsquestionnaireformtemp_fk;   
                
                //  $model->cmsth_uid = Common::getUniqueId(self::ENQURY_TYPES_NAME[$tempmodel->cmstht_type], null, 2,$crondata); 
               
               
                $explodekey = 'cmstht_';
                $concatkey ='cmsth_';
            } else if($copytype == 'maintohistory') {            
                $model = new CmstenderhdrhstyTbl();                 
                $cmstenderhdr_pk = $tempmodel->cmstenderhdr_pk;
                $model->cmsthh_cmstenderhdr_fk = $tempmodel->cmstenderhdr_pk;
                // $model->cmsthh_cmsquestionnaireformhsty_fk = $tempmodel->cmstht_cmsquestionnaireformtemp_fk;
                $model->cmsthh_uid = Common::getUniqueId(self::ENQURY_TYPES_NAME[$tempmodel->cmsth_type], null, 3,$crondata);
                $explodekey = 'cmsth_';
                $concatkey ='cmsthh_';
            } 
            foreach($tempmodel as $key => $value) { 
                if(!in_array($key, $tenderhdrtemp_columns_to_skip)) { 
                    $new_key = explode($explodekey, $key);
                    $new_key_main = $concatkey . $new_key[1]; 
                    if($new_key_main == 'cmsthh_cmstenderhdrtemp_fk') { 
                        $model->cmsthh_cmstenderhdr_fk = $value;
                    } else { 
                        $model->$new_key_main = $value;
                    }
                }
            }

            if($copytype == 'maintohistory') {
                $model->cmsthh_cmstenderhdr_pk = $cmstenderhdr_pk;             
            }
           
           
            if($model->save()) {
                if($copytype == 'temptomain') {
                    $tenderpk = $tempmodel->cmstenderhdrtemp_pk;
                    $maintenderpk = $model->cmstenderhdr_pk;
                    $mainquestionariepk = $tempmodel->cmstht_cmsquestionnaireformtemp_fk;
                    $cms_tender_status = $tempmodel->cmstht_tenderstatus;
                    $cms_tender_type = $tempmodel->cmstht_type;
                } else {
                    $tenderpk = $tempmodel->cmsth_cmstenderhdrtemp_fk;	
                    $maintenderpk = $tempmodel->cmstenderhdr_pk;  // prveious code hided 
                    //$maintenderpk = $model->cmstenderhdrhsty_pk; // new code
                    $mainquestionariepk = $tempmodel->cmsth_cmsquestionnaireform_fk;
                    $cms_tender_status = $tempmodel->cmsth_tenderstatus;
                    $cms_tender_type = $tempmodel->cmsth_type;
                } 

                $moving_prod_serv = self::copyingprodservtemptomain($tenderpk, $copytype, $maintenderpk,$crondata);  
                $moving_vendordocument = self::copyvendordocumentdetails($tenderpk, $copytype,$crondata);
                $moving_questionarrie = self::copyingquestionarrietomain($mainquestionariepk, $copytype, $maintenderpk, $crondata);
                $copying_paymentterms = self::copyingpaymenttermstomain($tenderpk, 1, $copytype, $maintenderpk, $crondata);
                $moving_termsandcondition = self::copyingtermandcondition($tenderpk, $copytype, $maintenderpk, $crondata);
                $moving_additionaldocument = self::copyingadditionaldocument($tenderpk, $copytype, $maintenderpk, $crondata);
                $moving_additionalinfo = self::copyingadditionalinfo($tenderpk, $copytype, $maintenderpk, $crondata);
                $moving_inspection_testplan = self::copyinspectiontestplandetails($tenderpk, $copytype, $crondata);
                $moving_targetted_supplier = self::coyingTargettedSupplier($tenderpk, $maintenderpk,$cms_tender_status, $cms_tender_type, $copytype, $crondata);
            } else { 
                var_dump($model->getErrors());exit;
                return $model->getErrors();
            }
        } else {
            return false;
        }
    } 

    public static function coyingTargettedSupplier($tenderpk, $maintenderpk, $cms_tender_status, $cms_tender_type, $copytype, $crondata=null) {

       

        /*
        if($copytype == 'temptomain') {
            $temptargetvmodel = CmstendertargethdrtempTbl::find()->where("cmsttht_cmstenderhdrtemp_fk =:pk ", [':pk' => $tenderpk])->all();
            $tender_target_details_temp = CmstendertargetdtlsTbl::find()->where("cmsttd_cmstendertargethdr_fk =:pk", [':pk' => $maintenderpk])->all();
        } else if($copytype == 'maintohistory') {
            $temptargetvmodel = CmstendertargethdrTbl::find()->where("cmstth_cmstenderhdr_fk =:pk", [':pk' => $maintenderpk])->all();            
            $tenderhistry = CmstenderhdrhstyTbl::find()->where(['cmsthh_cmstenderhdr_pk'=>$maintenderpk])->orderBy(['cmstenderhdrhsty_pk'=>SORT_DESC])->limit(1)->one();
            $tender_target_details_main = CmstendertargetdtlsTbl::find()->where("cmsttd_cmstendertargethdr_fk =:pk", [':pk' => $maintenderpk])->all(); 
        }
        */

        if($copytype == 'temptomain') {
            $temptargetvmodel = CmstendertargethdrtempTbl::find()->where("cmsttht_cmstenderhdrtemp_fk =:pk ", [':pk' => $tenderpk])->all();
        } else if($copytype == 'maintohistory') {
            $temptargetvmodel = CmstendertargethdrTbl::find()->where("cmstth_cmstenderhdr_fk =:pk", [':pk' => $maintenderpk])->all(); 
            $tenderhistry = CmstenderhdrhstyTbl::find()->where(['cmsthh_cmstenderhdr_pk'=>$maintenderpk])->orderBy(['cmstenderhdrhsty_pk'=>SORT_DESC])->limit(1)->one(); 
        }

        //as of now only JSRS suppliers
        $already_selected_target_suppliers = array();
        $target_main_primary_ids = array();           
        $cmsttd_cmstendertargethdr_fk_ids = array();
        if ($cms_tender_status == 2) {      
            if($cms_tender_type == 5)  {
                $target_main_model = CmstendertargethdrTbl::find()->where('cmstth_cmstenderhdr_fk =:tendHrd AND cmstth_targettype =:type', [':tendHrd' => $maintenderpk, ':type' => 2])->all();
            } else {
                $target_main_model = CmstendertargethdrTbl::find()->where('cmstth_cmstenderhdr_fk =:tendHrd AND cmstth_targettype =:type', [':tendHrd' => $maintenderpk, ':type' => 1])->all();
            }     
           
            if(count($target_main_model)>0) {
                for($kt=0;$kt<count($target_main_model);$kt++) {
                   $already_selected_target_suppliers[] = $target_main_model[$kt]->cmstth_memberregmst_fk;   
                   $cmsttd_cmstendertargethdr_fk_ids[] = $target_main_model[$kt]->cmstendertargethdr_pk;   
                   $cmstendertargethdr_pk_ids[] = $target_main_model[$kt]->cmstendertargethdr_pk;              
                }
                $cmsttd_cmstendertargethdr_fk_join_ids = join(',',$cmsttd_cmstendertargethdr_fk_ids);
                $cmstendertargethdr_pk_join_ids = join(',',$cmstendertargethdr_pk_ids);
               
                if(count($cmsttd_cmstendertargethdr_fk_ids)>0) {
                    Yii::$app->db->createCommand("delete from cmstendertargetdtls_tbl where cmsttd_cmstendertargethdr_fk  IN ($cmsttd_cmstendertargethdr_fk_join_ids) ")->execute();
                }
                Yii::$app->db->createCommand("delete from cmstendertargethdr_tbl where cmstth_cmstenderhdr_fk = '$maintenderpk' ")->execute();
            }           
            
        }  
        
        
        $JSRSSuppliers = array();
        $jsrs_reg_ids = array();
        if($maintenderpk>0) { // published
            $JSRSSuppliers = MemberregistrationmstTbl::find()->select(['MemberRegMst_Pk'])
            ->where('mrm_stkholdertypmst_fk=6 AND MRM_MemberStatus ="A" AND MRM_ValSubStatus ="A" AND (MRM_RenewalStatus != "GE" OR MRM_RenewalStatus IS NULL)  ')
            ->asArray()
            ->all();
            
        } else { // not published
            $JSRSSuppliers = MemberregistrationmstTbl::find()->select(['MemberRegMst_Pk'])
            ->where('mrm_stkholdertypmst_fk=6 AND MRM_MemberStatus ="A" AND MRM_ValSubStatus ="A" AND (MRM_RenewalStatus != "GE" OR MRM_RenewalStatus IS NOT NULL)  ')
            ->asArray()
            ->all();
        }

        for($k=0;$k<count($JSRSSuppliers);$k++) {
            $jsrs_reg_ids[] = $JSRSSuppliers[$k][MemberRegMst_Pk];
        }
        
        foreach($temptargetvmodel as $key => $value) {

            if($copytype == 'temptomain') {  
                $targetmodel = new CmstendertargethdrTbl(); 
                $targetmodel->cmstth_cmstendertargethdrtemp_fk = $value['cmstendertargethdrtemp_pk'];
                $targetmodel->cmstth_cmstenderhdr_fk = $maintenderpk;
                $targetmodel->cmstth_memberregmst_fk = $value['cmsttht_memberregmst_fk'];
                if($cms_tender_type == 5) {
                    $targetmodel->cmstth_targettype = 2; 
                } else {
                    $targetmodel->cmstth_targettype = 1; 
                }
               
                $targetmodel->cmstth_mailfor = 1; 
                if(in_array($value['cmsttht_memberregmst_fk'],$already_selected_target_suppliers)) {                  
                    $targetmodel->cmstth_targetsuptype = 2; 
                } else {
                    $targetmodel->cmstth_targetsuptype = 1; 
                }
                
                if($targetmodel->save()) {
                    $model_users = UsermstTbl::find()->where("UM_MemberRegMst_Fk = ".$value['cmsttht_memberregmst_fk'])->all();

                    if(count($model_users)>0) {
                        for($p=0;$p<count($model_users);$p++) {
                            $targetmodel_details = new CmstendertargetdtlsTbl();                           
                            $targetmodel_details->cmsttd_cmstendertargethdr_fk = $targetmodel->cmstendertargethdr_pk;
                            $targetmodel_details->cmsttd_emailid = $model_users[$p]->UM_EmailID;                            
                            $targetmodel_details->cmsttd_emailstatus = 1;
                            $targetmodel_details->cmsttd_mailfor = 1;   
                            if(in_array($value['cmsttht_memberregmst_fk'],$already_selected_target_suppliers)) {                          
                                 $targetmodel_details->cmsttd_targetsuptype = 2; 
                            } else {
                                $targetmodel_details->cmsttd_targetsuptype = 1;
                            }
                            $targetmodel_details->save();
                        }
                    } 
                    
                } 
            } else if($copytype == 'maintohistory') {

                $targetmodel = new CmstendertargethdrhstyTbl(); 
                $targetmodel->cmstthh_cmstendertargethdr_fk = $value['cmstendertargethdr_pk'];
                if(count($tenderhistry)>0) {                        
                    $targetmodel->cmstthh_cmstenderhdrhsty_fk  = $tenderhistry->cmstenderhdrhsty_pk;
                } else {                    
                    $targetmodel->cmstthh_cmstenderhdrhsty_fk  = $maintenderpk;
                } 
                $targetmodel->cmstthh_memberregmst_fk  = $value['cmstth_memberregmst_fk'];
                $targetmodel->cmstthh_targettype  = $value['cmstth_targettype'];
                $targetmodel->cmstthh_mailfor  = $value['cmstth_mailfor'];
                $targetmodel->cmstthh_targetsuptype  = $value['cmstth_targetsuptype'];
                if($targetmodel->save()) {
                    $model_target_dtls = CmstendertargetdtlsTbl::find()->where("cmsttd_cmstendertargethdr_fk = ".$value['cmstendertargethdr_pk'])->all();                   
                    if(count($model_target_dtls)>0) {
                        for($m=0;$m<count($model_target_dtls);$m++) {
                            $model_target_dtls_htry = new  CmstendertargetdtlshstyTbl();
                            $model_target_dtls_htry->cmsttdh_cmstendertargetdtls_fk  = $model_target_dtls[$m]->cmstendertargetdtls_pk;
                            $model_target_dtls_htry->cmsttdh_cmstendertargethdrhsty_fk = $targetmodel->cmstendertargethdrhsty_pk;
                            $model_target_dtls_htry->cmsttdh_emailid = $model_target_dtls[$m]->cmsttd_emailid;
                            $model_target_dtls_htry->cmsttdh_emailstatus = $model_target_dtls[$m]->cmsttd_emailstatus;
                            $model_target_dtls_htry->cmsttdh_mailfor = $model_target_dtls[$m]->cmsttd_mailfor;
                            $model_target_dtls_htry->cmsttdh_targetsuptype = $model_target_dtls[$m]->cmsttd_targetsuptype;
                            if(!$model_target_dtls_htry->save()) {
                                //echo "<pre>"; print_r($cmstendertargethdr_tbl);
                            }    
                        }
                    }
                } else {
                   // echo "<pre>main"; print_r($targetmodel);
                }
            }

        }
        if(count($cmstendertargethdr_pk_ids)>0) {
            // Deleting the sub tables
              Yii::$app->db->createCommand("delete from  cmstendertargetdtls_tbl  where cmsttd_cmstendertargethdr_fk  IN ($cmstendertargethdr_pk_join_ids) ")->execute();     
        }
        

    }


    public function copyingprodservtemptomain($tenderpk, $copytype, $maintenderpk, $crondata = null) {
        if($tenderpk) {
            if($copytype == 'temptomain') {
                $tempprodservmodel = CmsrqprodservdtlstempTbl::find()->where("crpsdt_shared_fk =:pk and crpsdt_shared_type =:type", [':pk' => $tenderpk, ':type' => 3])->all();
            } else if($copytype == 'maintohistory') {
                $tempprodservmodel = CmsrqprodservdtlsTbl::find()->where("crpsd_shared_fk =:pk and crpsd_shared_type =:type", [':pk' => $maintenderpk, ':type' => 3])->all();
            }
            //keys from both temp and main tables
            $prodserv_columns_to_skip = ['crpsdt_shared_fk','cmsrqprodservdtlstemp_pk', 'cmsrqprodservdtls_pk', 'crpsd_cmsrqprodservdtlstemp_fk'];
            foreach($tempprodservmodel as $tpskey => $tpsvalue) {
                if($copytype == 'temptomain') {
                    
                    $prodservmodel = CmsrqprodservdtlsTbl::find()->where("crpsd_cmsrqprodservdtlstemp_fk =:pk ", [':pk' => $tpsvalue->cmsrqprodservdtlstemp_pk])->one();
                    if(!$prodservmodel) {
                        $prodservmodel = new CmsrqprodservdtlsTbl();
                    }
                    $explodekey = 'crpsdt_';
                    $concatkey ='crpsd_';
                } else if($copytype == 'maintohistory') {
                    $prodservmodel = new CmsrqprodservdtlshstyTbl();
                    $explodekey = 'crpsd_';
                    $concatkey ='crpsdh_';
                }

                foreach($tpsvalue as $pskey => $value) {
                    if($pskey == 'cmsrqprodservdtlstemp_pk') {
                        $prodservmodel->crpsd_cmsrqprodservdtlstemp_fk = $value;
                    }

                    if($pskey == 'crpsdt_shared_fk') {
                        $prodservmodel->crpsd_shared_fk = $maintenderpk;
                    }

                    if($pskey == 'cmsrqprodservdtls_pk') {
                        $prodservmodel->crpsdh_cmsrqprodservdtls_fk = $value;
                    } 

                    if(!in_array($pskey, $prodserv_columns_to_skip)) {
                        $psnew_key = explode($explodekey, $pskey);
                        $psnew_key_main = $concatkey . $psnew_key[1]; 
                        $prodservmodel->$psnew_key_main = $value;
                    }
                }
                if(!$prodservmodel->save() === TRUE) {
                    // echo "<pre>";print_r($prodservmodel->getErrors());
                    return false;
                }  else {
                    if($copytype == 'temptomain') {
                        $proservid = $tempprodservmodel->crpsdt_sharedmst_fk; 
                    } else if($copytype == 'maintohistory') {
                        $proservid = $tempprodservmodel->crpsd_sharedmst_fk; 
                    }
                    // $copyingprodservmstmapping = self::copyingprodmstservmsttemptomain($proservid);
                }
            }
        }

    }

    public function copyingquestionarrietomain($quest_pk, $copytype, $tenderpk, $crondata=null) {
        $date = date('Y-m-d H:i:s');

        if(isset($crondata['datafrom']) && $crondata['datafrom'] == 'cron')  {
            $userPK = $crondata['usermst_pk'];
        } else {
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        }
        

        if($copytype == 'temptomain') {
            $questionarriemodel_source = CmsquestionnaireformtempTbl::find()
                ->where("cmsquestionnaireformtemp_pk =:pk", [':pk' => $quest_pk])
                ->one();
        } else if($copytype == 'maintohistory')  {
            $questionarriemodel_source = CmsquestionnaireformTbl::find()
                ->where("cmsquestionnaireform_pk =:pk", [':pk' => $quest_pk])
                ->one();
        }

        $questionarie_columns_to_skip = ['cmsquestionnaireformtemp_pk', 'cmsquestionnaireform_pk', 'cmsqf_cmsquestionnaireformtemp_fk'];

        if($questionarriemodel_source) {
            if($copytype == 'temptomain') {

                $model = CmsquestionnaireformTbl::find()->where("cmsqf_cmsquestionnaireformtemp_fk =:pk ", [':pk' => $questionarriemodel_source->cmsquestionnaireformtemp_pk])->one();
                if(!$model) {
                    $model = new CmsquestionnaireformTbl();
                }
                $explodekey = 'cmsqft_';
                $concatkey ='cmsqf_';
            } else if($copytype == 'maintohistory') {
                $model = new CmsquestionnaireformhstyTbl();
                $explodekey = 'cmsqf_';
                $concatkey ='cmsqfh_';
            }
            
            foreach($questionarriemodel_source as $key => $value) {
                if($key == 'cmsquestionnaireformtemp_pk') {
                    $model->cmsqf_cmsquestionnaireformtemp_fk = $value;
                } else if($key == 'cmsquestionnaireform_pk') {
                    $model->cmsqfh_cmsquestionnaireform_fk = $value;
                } 

                if(!in_array($key, $questionarie_columns_to_skip)) {
                    $new_key = explode($explodekey, $key);
                    $new_key_main = $concatkey . $new_key[1];
                    $model->$new_key_main = $value; 
                }
            }
            if(!$model->save() === TRUE) {
                return false;
            } else {
                if($copytype == 'temptomain') {
                    $questionnarireform_pk = $questionarriemodel_source->cmsquestionnaireformtemp_pk;
                    $maintendermodel = CmstenderhdrTbl::findOne(['cmstenderhdr_pk' => $tenderpk]);
                    if($maintendermodel) {
                        $maintendermodel->cmsth_cmsquestionnaireform_fk = $model->cmsquestionnaireform_pk;
                        if(!$maintendermodel->save() === TRUE) {
                            return false;
                        }
                    }
                } else if($copytype == 'maintohistory') {
                    $questionnarireform_pk = $questionarriemodel_source->cmsquestionnaireform_pk;
                }
                $copying_questionarrie_answer = self::copyingquestionarrieanswertomain($questionnarireform_pk, $copytype,$crondata);
            }   
        }  
        
    }

    public function copyingquestionarrieanswertomain($quest_pk, $copytype,$crondata=null) {

       
        $date = date('Y-m-d H:i:s');
        if(isset($crondata['datafrom']) && $crondata['datafrom'] == 'cron') {
            $userPK =  $crondata['usermst_pk'];  
            $company_id =  $crondata['company_pk'];  

        } else {
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
       
        
        if($copytype == 'temptomain') {
           $questionarriemodel_source = CmsquestionnaireformtrnxtempTbl::find()
                ->where("cmsqftt_cmsquestionnaireformtemp_fk =:pk", [':pk' => $quest_pk])
                ->one();
        } else if($copytype == 'maintohistory')  { 
            $questionarriemodel_source = CmsquestionnaireformtrnxTbl::find()
                ->where("cmsqft_cmsquestionnaireform_fk =:pk", [':pk' => $quest_pk])
                ->one();
        }
        
        if($questionarriemodel_source) {
            
            if($copytype == 'temptomain') {
                $model = CmsquestionnaireformtrnxTbl::find()->where("cmsqft_cmsquestionnaireformtrnxtemp_fk =:pk ", [':pk' => $questionarriemodel_source->cmsquestionnaireformtrnxtemp_pk])->one();
                if(!$model) {
                    $model = new CmsquestionnaireformtrnxTbl();
                }
                $explodekey = 'cmsqftt_';
                $concatkey ='cmsqft_';
            } else if($copytype == 'maintohistory') {
                $model = new CmsquestionnaireformtrnxhstyTbl();
                $explodekey = 'cmsqft_';
                $concatkey ='cmsqfth_';
            } 
            $questionarietrx_columns_to_skip = ['cmsqft_cmsquestionnaireformtrnxtemp_fk','cmsqftt_cmsquestionnaireformtemp_fk', 'cmsquestionnaireformtrnxtemp_pk', 'cmsquestionnaireformtrnx_pk',  'cmsqft_cmsquestionnaireform_fk'];
            foreach($questionarriemodel_source as $key => $value) {
                
                if($key == 'cmsqftt_cmsquestionnaireformtemp_fk') {
                    $model->cmsqft_cmsquestionnaireform_fk = $value;
                }

                if($key == 'cmsquestionnaireformtrnxtemp_pk') {
                    $model->cmsqft_cmsquestionnaireformtrnxtemp_fk = $value;
                }

                if($key == 'cmsquestionnaireformtrnx_pk') {
                    $model->cmsqfth_cmsquestionnaireformtrnx_fk = $value;
                } 

                if($key == 'cmsqft_cmsquestionnaireform_fk') {
                    $model->cmsqfth_cmsquestionnaireformhsty_fk = $value;
                }  

                if($key == 'cmsqft_cmsquestionnaireformtrnxtemp_fk') {
                    $model->cmsqfth_cmsquestionnaireformtrnx_fk = $questionarriemodel_source['cmsquestionnaireformtrnx_pk'];
                }

                if(!in_array($key, $questionarietrx_columns_to_skip)) {
                    $new_key = explode($explodekey, $key);
                    $new_key_main = $concatkey . $new_key[1];
                    $model->$new_key_main = $value;
                }
            }
            if(!$model->save() === TRUE) {
                return false;
            }  
        }  
    }

    public function copyingpaymenttermstomain($tender_pk, $type, $copytype, $maintenderpk, $crondata=null) {
        if($copytype == 'temptomain') {
            $model_source = CmspaymenttermstempTbl::find()
                 ->select(['*'])
                 ->where('cmsptt_shared_fk=:pk and cmsptt_type=:type', [':pk' => $tender_pk, ':type' => $type])
                 ->orderBy('cmsptt_name ASC')
                 ->groupBy('cmsptt_name')
                 ->asArray()
                 ->All();
         } else if($copytype == 'maintohistory')  {  
            $model_source = CmspaymenttermsTbl::find()
                ->select(['*'])
                ->where('cmspt_shared_fk=:pk and cmspt_type=:type', [':pk' => $tender_pk, ':type' => $type])
                ->orderBy('cmspt_name ASC')
                ->groupBy('cmspt_name')
                ->asArray()
                ->All();
         }

        $payment_columns_to_skip = ['cmspaymentterms_pk', 'cmspaymenttermstemp_pk', 'cmspt_cmspaymenttermstemp_fk'];

        if($model_source) {

            
            foreach($model_source as $key1 => $payvalue) {
                if($copytype == 'temptomain') {
                    $model = CmspaymenttermsTbl::find()->where("cmspt_cmspaymenttermstemp_fk =:pk ", [':pk' => $payvalue['cmspaymenttermstemp_pk']])->one();
                    if(!$model) {
                        $model = new CmspaymenttermsTbl();
                    }
                    $explodekey = 'cmsptt_';
                    $concatkey ='cmspt_';
                } else if($copytype == 'maintohistory') {
                    $model = new CmspaymenttermshstyTbl();
                    $explodekey = 'cmspt_';
                    $concatkey ='cmspth_';
                }
                foreach($payvalue as $key => $value) {
                    if($key == 'cmspaymenttermstemp_pk') {
                        $model->cmspt_cmspaymenttermstemp_fk = $value;
                    }
    
                    if($key == 'cmspaymentterms_pk') {
                        $model->cmspth_cmspaymentterms_fk = $value;
                    }

                    if(!in_array($key, $payment_columns_to_skip)) {
                        $new_key = explode($explodekey, $key);
                        $new_key_main = $concatkey . $new_key[1];
                        $model->$new_key_main = $value; 
                        if($copytype == 'temptomain' && $new_key_main == 'cmspt_shared_fk') {
                            $model->cmspt_shared_fk = $maintenderpk;
                        }
                    }

                } 

                if(!$model->save() === TRUE) {
                    return false;
                }
            } 
        }
    }

    public function copyingtermandcondition($tenderpk, $copytype, $maintenderpk,$crondata=null) {
        if($copytype == 'temptomain') { 
            $tempmodel = CmstnctrnxtempTbl::find()
                ->select(['*'])->where("ctnctt_shared_fk=:fk and ctnctt_type=:type and ctnctt_status = 1", [':fk' => $tenderpk, ':type' => 2])
                ->asArray()
                ->all();

         } else if($copytype == 'maintohistory')  { 
            $tempmodel = CmstnctrnxTbl::find()
                ->select(['*'])->where("ctnct_shared_fk=:fk and ctnct_type=:type and ctnct_status = 1", [':fk' => $tenderpk, ':type' => 2])
                ->asArray()
                ->all();  
         }

        $termsandcondition_columns_to_skip = ['ctnctt_shared_fk', 'cmstnctrnxtemp_pk', 'cmstnctrnx_pk', 'ctnct_cmstnctrnxtemp_fk'];

        if($tempmodel) {

            foreach($tempmodel as $key => $value) {
                if($copytype == 'temptomain') {
                    $model = CmstnctrnxTbl::find()->where("ctnct_cmstnctrnxtemp_fk =:pk ", [':pk' => $value['cmstnctrnxtemp_pk']])->one();
                    if(!$model) {
                        $model = new CmstnctrnxTbl();
                    }

                    $explodekey = 'ctnctt_';
                    $concatkey ='ctnct_';
                } else if($copytype == 'maintohistory') {
                    $model = new CmstnctrnxhstyTbl();
                    $explodekey = 'ctnct_';
                    $concatkey ='ctncth_';
                }
                foreach($value as $vkey => $val) {
                    if($vkey == 'cmstnctrnxtemp_pk') {
                        $model->ctnct_cmstnctrnxtemp_fk = $val;
                    }
                    
                    if($vkey == 'ctnctt_shared_fk') {
                        $model->ctnct_shared_fk = $maintenderpk;
                    } 

                    if($vkey == 'cmstnctrnx_pk') {
                        $model->ctncth_cmstnctrnx_fk = $val;
                    } 

                    if(!in_array($vkey, $termsandcondition_columns_to_skip)) {
                        $new_key = explode($explodekey, $vkey);
                        $new_key_main = $concatkey . $new_key[1];  
                        $model->$new_key_main = $val;
                    }
                }
                if(!$model->save() === TRUE) {
                    return false;
                } 
            } 
        } 
    }

    public static function copyingadditionaldocument($tender_pk, $copytype, $maintenderpk, $crondata=null) {
        if($tender_pk) {
            if($copytype == 'temptomain') { 
                $tender = CmstenderhdrtempTbl::findOne($tender_pk);
            } else if($copytype == 'maintohistory')  { 
                $tender = CmstenderhdrTbl::findOne($tender_pk);
            }

            if($tender) {

                $additional_documents = $tender->additionalandSupportDocuments;
                $additionaldoc_columns_to_skip = ['cmssdt_shared_fk','cmssupdocumenttemp_pk', 'cmssupdocument_pk', 'cmssd_cmssupdocumenttemp_fk'];

                foreach($additional_documents as $key => $value) {
                    if($copytype == 'temptomain') {

                        $model = CmssupdocumentTbl::find()->where("cmssd_cmssupdocumenttemp_fk =:pk ", [':pk' => $value['cmssupdocumenttemp_pk']])->one();
                        if(!$model) {
                            $model = new CmssupdocumentTbl();
                        }

                        $explodekey = 'cmssdt_';
                        $concatkey ='cmssd_';
                    } else if($copytype == 'maintohistory') {
                        $model = new CmssupdocumenthstyTbl();
                        $explodekey = 'cmssd_';
                        $concatkey ='cmssdh_';
                    }
                    foreach($value as $vkey => $val) {
                        if($vkey == 'cmssdt_shared_fk') {
                            $model->cmssd_shared_fk = $maintenderpk;
                        }
                        if($vkey == 'cmssupdocumenttemp_pk') {
                            $model->cmssd_cmssupdocumenttemp_fk = $val;
                        }
    
                        if($vkey == 'cmssupdocument_pk') {
                            $model->cmssdh_cmssupdocument_fk = $val;
                        } 

                        if(!in_array($vkey, $additionaldoc_columns_to_skip)) {
                            $new_key = explode($explodekey, $vkey);
                            $new_key_main = $concatkey . $new_key[1];  
                            $model->$new_key_main = $val;
                        }
                    } 
                    if(!$model->save() === TRUE) { 
                        return false;
                    }
                }
            }
        }
    }

    public static function copyingadditionalinfo($tender_pk, $copytype, $maintenderpk, $crondata=null) {
        if($tender_pk) {
            if($copytype == 'temptomain') { 
                $additonal_info_data = \api\modules\pms\models\CmsaddinfodtlstempTblQuery::getadditonalinfolist($tender_pk);
            } else if($copytype == 'maintohistory')  { 
                $additonal_info_data = \api\modules\pms\models\CmsaddinfodtlsTblQuery::getadditonalinfolist($tender_pk);
            }

            $additionalinfo_columns_to_skip = ['cmsaddinfodtlstemp_pk', 'caidt_cmstenderhdrtemp_fk', 'cmsaddinfodtls_pk', 'caid_cmstenderhdr_fk'];
            if($additonal_info_data) {
                foreach($additonal_info_data as $key => $value) {
                    if($copytype == 'temptomain') {

                        $model = CmsaddinfodtlsTbl::find()->where("caid_cmsaddinfodtlstemp_fk =:pk ", [':pk' => $value['cmsaddinfodtlstemp_pk']])->one();
                        if(!$model) {
                            $model = new CmsaddinfodtlsTbl();
                        }

                        $explodekey = 'caidt_';
                        $concatkey ='caid_';
                    } else if($copytype == 'maintohistory') {
                        $model = new CmsaddinfodtlshstyTbl();
                        $explodekey = 'caid_';
                        $concatkey ='caidh_';
                    }
                    
                    foreach($value as $vkey => $val) {
                        if($vkey == 'cmsaddinfodtlstemp_pk') {
                            $model->caid_cmsaddinfodtlstemp_fk = $val;
                        }
                        if($vkey == 'caidt_cmstenderhdrtemp_fk') {
                            $model->caid_cmstenderhdr_fk = $maintenderpk;
                        }

                        if($vkey == 'cmsaddinfodtls_pk') {
                            $model->caidh_cmsaddinfodtls_fk = $val;
                        } 

                        if($vkey == 'caid_cmstenderhdr_fk') {
                            $model->caidh_cmstenderhdrhsty_fk = $val;
                        } 

                        if(!in_array($vkey, $additionalinfo_columns_to_skip)) {
                            $new_key = explode($explodekey, $vkey);
                            $new_key_main = $concatkey . $new_key[1]; 
                            if($new_key_main  == 'caidh_cmsaddinfodtlstemp_fk') {
                                $new_key_main =  'caidh_cmsaddinfodtls_fk';
                            }
                            $model->$new_key_main = $val;
                        }
                    } 
                    if(!$model->save() === TRUE) {
                        return false;
                    } 
                }
            }
        }

    } 

    public function copyvendordocumentdetails($pk, $copytype, $crondata = null) {

        if($copytype == 'temptomain') {
            $vendor_doc_req = CmssuppdocreqlisthdrtempTbl::find()
                ->select(['*'])
                ->where("csdrlht_shared_fk = :sharedFk and csdrlht_shared_type = :sharedType and csdrlht_status = 1", [':sharedFk' => $pk, ':sharedType' => 2])
                ->asArray()
                ->all();
        } else if($copytype == 'maintohistory')  {
            $vendor_doc_req = CmssuppdocreqlisthdrTbl::find()
                ->select(['*'])
                ->where("csdrlh_shared_fk = :sharedFk and csdrlh_shared_type = :sharedType and csdrlh_status = 1", [':sharedFk' => $pk, ':sharedType' => 2])
                ->asArray()
                ->all();
        }

        if($copytype == 'temptomain') {

            $vdmodel = CmssuppdocreqlisthdrTbl::find()->where("csdrlh_cmssuppdocreqlisthdrtemp_fk =:pk ", [':pk' => $vendor_doc_req->cmssuppdocreqlisthdr_pk])->one();
            if(!$vdmodel) {
                $vdmodel = new CmssuppdocreqlisthdrTbl();
            }

            // $vdmodel = new CmssuppdocreqlisthdrTbl();
            $explodekey = 'csdrlht_';
            $concatkey ='csdrlh_';
        } else if($copytype == 'maintohistory') {
            $vdmodel = new CmssuppdocreqlisthdrhstyTbl();
            $explodekey = 'csdrlh_';
            $concatkey ='csdrlh_';
        } 
        
        $suppdocreq_columns_to_skip = ['cmssuppdocreqlisthdrtemp_pk', 'cmssuppdocreqlisthdr_pk', 'csdrlh_cmstnchdr_fk', 'csdrlh_cmssuppdocreqlisthdrtemp_fk'];
        foreach($vendor_doc_req as $key => $value) { 
            if($copytype == 'temptomain') {
                $vdmodel->csdrlh_cmssuppdocreqlisthdrtemp_fk = $value['cmssuppdocreqlisthdrtemp_pk'];
            } else { 
                $vdmodel->csdrlh_cmssuppdocreqlisthdr_fk = $value['csdrlh_cmssuppdocreqlisthdrtemp_fk'];
                $vdmodel->csdrlh_cmstnchdrhsty_fk = $value['csdrlh_cmstnchdr_fk'];
            }
            foreach($value as $vkey => $val) {
                if(!in_array($vkey, $suppdocreq_columns_to_skip)) { 
                    $new_key = explode($explodekey, $vkey);
                    $new_key_main = $concatkey . $new_key[1]; 
                    $vdmodel->$new_key_main = $val;
                }
            }

            if(!$vdmodel->save() === TRUE) {
                return false;
            }
        }
    }

    public function copyinspectiontestplandetails($pk, $copytype, $crondata=null) {
        if($copytype == 'temptomain') {
            $inspection = CmsinspreqdochdrtempTbl::find()
                ->select(['*'])
                ->where("cirdht_shared_fk = :sharedFk and cirdht_shared_type = :sharedType and cirdht_status = 1", [':sharedFk' => $pk, ':sharedType' => 2])
                ->asArray()
                ->all();
        } else if($copytype == 'maintohistory')  {
            $inspection = CmsinspreqdochdrTbl::find()
                ->select(['*'])
                ->where("cirdh_shared_fk = :sharedFk and cirdh_shared_type = :sharedType and cirdh_status = 1", [':sharedFk' => $pk, ':sharedType' => 2])
                ->asArray()
                ->all();
        }

        if($copytype == 'temptomain') {

            // $insmodel = CmsinspreqdochdrTbl::find()->where("cirdh_cmsinspreqdochdrtemp_fk =:pk ", [':pk' => $inspection->cmsinspreqdochdrtemp_pk])->one();
            // if(!$insmodel) {
            //     $insmodel = new CmsinspreqdochdrTbl();
            // }

            // $insmodel = new CmsinspreqdochdrTbl();
            $explodekey = 'cirdht_';
            $concatkey ='cirdh_';
        } else if($copytype == 'maintohistory') {
            $insmodel = new CmsinspreqdochdrhstyTbl();
            $explodekey = 'cirdh_';
            $concatkey ='cirdhh_';
        } 
        $inspection_columns_to_skip = ['cmsinspreqdochdr_fk','cmsinspreqdochdrtemp_fk','cirdh_cmstnchdr_fk','cmsinspreqdochdr_pk', 'cmsinspreqdochdrtemp_pk','cmsinspreqdochdrhsty_pk'];
        foreach($inspection as $key => $value) { 
           
            if($copytype == 'temptomain') {
                $insmodel = CmsinspreqdochdrTbl::find()->where("cirdh_cmsinspreqdochdrtemp_fk =:pk ", [':pk' => $value['cmsinspreqdochdrtemp_pk']])->one();
                if(!$insmodel) {
                    $insmodel = new CmsinspreqdochdrTbl();
                }
                $insmodel->cirdh_cmsinspreqdochdrtemp_fk = $value['cmsinspreqdochdrtemp_pk'];
            } else {
                $insmodel->cirdhh_cmsinspreqdochdr_fk = $value['cmsinspreqdochdr_pk'];
                $insmodel->cirdhh_cmstnchdr_fk = $value['cirdh_cmstnchdr_fk'];
            }

            foreach($value as $vkey => $val) {
                if(!in_array($vkey, $inspection_columns_to_skip)) { 
                    $new_key = explode($explodekey, $vkey);
                    $new_key_main = $concatkey . $new_key[1]; 
                    if($new_key_main != 'cirdhh_cmsinspreqdochdrtemp_fk') {
                        $insmodel->$new_key_main = $val;
                    }
                }
            }
            if(!$insmodel->save() === TRUE) {
                return false;
            }
            
            if($copytype == 'temptomain') {
                self::copyinspectiontestplandocdtls($value['cmsinspreqdochdrtemp_pk'], $copytype);
            } else {
                self::copyinspectiontestplandocdtls($value['cmsinspreqdochdr_pk'], $copytype);
            } 
        }

    }

    public function copyinspectiontestplandocdtls($pk, $copytype) {
        if($copytype == 'temptomain') {
            $inspectionmap = CmsinspreqdocdtlstempTbl::find()
                ->select(['*'])
                ->where("cirddt_cmsinspreqdochdrtemp_fk = :sharedFk", [':sharedFk' => $pk])
                ->asArray()
                ->all();
        } else if($copytype == 'maintohistory')  {
            $inspectionmap = CmsinspreqdocdtlsTbl::find()
                ->select(['*'])
                ->where("cmsinspreqdocdtls_pk = :sharedFk", [':sharedFk' => $pk])
                ->asArray()
                ->all();
        }

        if($copytype == 'temptomain') {
            // $insmodel = new CmsinspreqdocdtlsTbl();
            $explodekey = 'cirddt_';
            $concatkey ='cirdd_';
        } else if($copytype == 'maintohistory') {
            $insmodel = new CmsinspreqdocdtlshstyTbl();
            $explodekey = 'cirdd_';
            $concatkey ='cirddh_';
        } 

        $inspectionmapping_columns_to_skip = ['cmsinspreqdochdr_fk', 'cirdd_cmsinspreqdochdr_fk', 'cmsinspreqdocdtlstemp_fk','cirddt_cmsinspreqdochdrtemp_fk', 'cmsinspreqdocdtlstemp_pk', 'cmsinspreqdocdtls_pk'];
        foreach($inspectionmap as $key => $value) { 
           
            if($copytype == 'temptomain') {

                $insmodel = CmsinspreqdocdtlsTbl::find()->where("cirdd_cmsinspreqdocdtlstemp_fk =:pk ", [':pk' => $value['cmsinspreqdocdtlstemp_pk']])->one();
                if(!$insmodel) {
                    $insmodel = new CmsinspreqdocdtlsTbl();
                }

                $insmodel->cirdd_cmsinspreqdocdtlstemp_fk = $value['cmsinspreqdocdtlstemp_pk'];
                $insmodel->cirdd_cmsinspreqdochdr_fk = $value['cirddt_cmsinspreqdochdrtemp_fk'];
            } else {
                $insmodel->cirddh_cmsinspreqdocdtls_fk = $value['cmsinspreqdocdtls_pk'];
            }

            foreach($value as $vkey => $val) {
                if(!in_array($vkey, $inspectionmapping_columns_to_skip)) { 
                    $new_key = explode($explodekey, $vkey);
                    $new_key_main = $concatkey . $new_key[1];  
                    if($new_key_main != 'cirddh_cmsinspreqdocdtlstemp_fk') {
                        $insmodel->$new_key_main = $val;
                    }
                }
            }
            if(!$insmodel->save() === TRUE) {
                return false;
            }
            if($copytype == 'temptomain') {
                self::copyinspectiontestplanmapping($value['cmsinspreqdocdtlstemp_pk'], $copytype);
            } else {
                self::copyinspectiontestplanmapping($value['cmsinspreqdocdtls_pk'], $copytype);
            }
        }
        
    }
    
    public function copyinspectiontestplanmapping($pk, $copytype) {
        if($copytype == 'temptomain') {
            $inspectionmap = CmsinspreqdocactionmaptempTbl::find()
                ->select(['*'])
                ->where("cirdamt_cmsinspreqdocdtlstemp_fk = :sharedFk", [':sharedFk' => $pk])
                ->asArray()
                ->all();
        } else if($copytype == 'maintohistory')  {
            $inspectionmap = CmsinspreqdocactionmapTbl::find()
                ->select(['*'])
                ->where("cirdam_cmsinspreqdocdtls_fk = :sharedFk", [':sharedFk' => $pk])
                ->asArray()
                ->all();
        }

        if($copytype == 'temptomain') {
            // $insmodel = new CmsinspreqdocactionmapTbl();
            $explodekey = 'cirdamt_';
            $concatkey ='cirdam_';
        } else if($copytype == 'maintohistory') {
            $insmodel = new CmsinspreqdocactionmaphstyTbl();
            $explodekey = 'cirdam_';
            $concatkey ='cirdamh_';
        } 

        $inspectionmapping_columns_to_skip = ['cirdam_cmsinspreqdocactionmaptemp_fk','cirdamt_cmsinspreqdocdtlstemp_fk','cmsinspreqdocactionmaptemp_pk', 'cmsinspreqdocactionmap_pk'];

        foreach($inspectionmap as $key => $value) { 
           
            if($copytype == 'temptomain') {

                $insmodel = CmsinspreqdocactionmapTbl::find()->where("cirdam_cmsinspreqdocactionmaptemp_fk =:pk ", [':pk' => $value['cmsinspreqdocactionmaptemp_pk']])->one();
                if(!$insmodel) {
                    $insmodel = new CmsinspreqdocactionmapTbl();
                }

                $insmodel->cirdam_cmsinspreqdocactionmaptemp_fk = $value['cmsinspreqdocactionmaptemp_pk'];
                $insmodel->cirdam_cmsinspreqdocdtls_fk = $value['cirdamt_cmsinspreqdocdtlstemp_fk'];
            } else {
                $insmodel->cirdamh_cmsinspreqdocactionmap_fk = $value['cmsinspreqdocactionmap_pk'];
                $insmodel->cirdamh_cmsinspreqdocdtls_fk = $value['cirdam_cmsinspreqdocdtlstemp_fk'];
                $insmodel->cirdamh_cmsinspreqdocactionmap_fk = $value['cirdam_cmsinspreqdocactionmaptemp_fk'];
            }

            foreach($value as $vkey => $val) {
                if(!in_array($vkey, $inspectionmapping_columns_to_skip)) { 
                    $new_key = explode($explodekey, $vkey);
                    $new_key_main = $concatkey . $new_key[1]; 
                    $insmodel->$new_key_main = $val;
                }
            }
            if(!$insmodel->save() === TRUE) {
                return false;
            }
        }
        
    }

     // RFX scheduled cron
     public function publishscheduledcron() {

        $currentdate = date("Y-m-d H:i:s");
       
       
        $model = CmstenderhdrtempTbl::find()
            ->leftjoin('timezone_tbl', 'timezone_pk = cmstht_skd_timezone_fk')
            ->where("cmstht_skdtype = :type", [':type' =>  2])
            ->andWhere("cmstht_tenderstatus = :status", [':status' => 1])            
            ->all();
       
        /*
        $model = CmstenderhdrtempTbl::find()
                ->leftjoin('timezone_tbl', 'timezone_pk = cmstht_skd_timezone_fk')
                ->where("cmstenderhdrtemp_pk = 379")->all(); 
        */  
        
                   
        $error_count = 0;
        $date = new \DateTime();
        $timeZone = $date->getTimezone();
        $timeZone->getName();

        if($model) {
            foreach($model as $key => $val) { 
                $etender_time_zone = \api\modules\mst\models\TimezoneTbl::find()->select(['timezone_pk','tz_countryname','tz_utcoffset'])
                    ->where('tz_status =:tz_status',[':tz_status' => 1])
                    ->andWhere('timezone_pk =:tz_pk',[':tz_pk' => $val->cmstht_skd_timezone_fk])
                    ->one();
                    $timezone_converted_datetime = Common::convertTimezone($val->cmstht_skdstartdate, $etender_time_zone->tz_utcoffset, $timeZone->getName());
                    if($timezone_converted_datetime <= $currentdate) {                       
                        $copytype = 'temptomain';
                        $model_temp = CmstenderhdrtempTbl::find()->where("cmstenderhdrtemp_pk =:pk", [':pk' => $val->cmstenderhdrtemp_pk])->one();
                        $updatedby = $model_temp->cmsth_createdby;
                        CmstenderhdrtempTblQuery:: copyingrfxdata($model_temp, $copytype,'cron');
                        $val->cmstht_tenderstatus = 2;
                        $val->cmstht_updatedon = $currentdate;
                        $val->cmstht_updatedby = $updatedby;
                       
                        if($val->save() === true) {
                            if(isset($val->membercompanymsttbl->mCMMemberRegMstFk->MemberRegMst_Pk)){
                                self::insertnoticerecord($val,$val->membercompanymsttbl->mCMMemberRegMstFk->MemberRegMst_Pk,$status=1);
                            }
                            $data = $val->cmstenderhdrtemp_pk . " / " . $val->cmstht_memcompmst_fk . " / " . $val->cmstht_skdstartdate . " / " . "success";
                            
                            $logPath = __DIR__. "/../logs/logs.txt";
                            $mode = (!file_exists($logPath)) ? 'w':'a';
                            $logfile = fopen($logPath, $mode);
                            fwrite($logfile, "\r\n". $data);
                            fclose($logfile);
                           
                        } else {                         
                            $data = $val->cmstenderhdrtemp_pk . " / " . $val->cmstht_memcompmst_fk . " / " . $val->cmstht_skdstartdate . " / " . "failed";
                           
                            $data .= $val->getErrors();                            
                            $logPath = __DIR__. "/../logs/logs.txt";
                            $mode = (!file_exists($logPath)) ? 'w':'a';
                            $logfile = fopen($logPath, $mode);
                            fwrite($logfile, "\r\n". $data);
                            fclose($logfile); 
                            $error_count++;
                        }
                    }
                  
                if($error_count > 0) {
                    return array(
                        'status' => 200,
                        'msg' => 'Failure',
                        'flag' => 'U',
                        'comments' => $val->getErrors()
                    );
                } else {
                    return array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Enquiry Status Updated Successfully!'
                    );
                }
            } 
        }
    }

    
    static function isUpdate($type,$rfxdata,$company_id=NULL){
          // remainder,info,questionarie,notify,subcontractrule,icv,communication
          // teested - scope,info
        // unknown - RFT,subcontractrule,schedule,savedrft,rfxaddinfo,configcontact
        // 1 - new, 2 - update, 3 - closing date
        $isupdated = 1;
        if ($type=='rfxadddetail'&&$rfxdata['rfx_pk'] != null) {
            $model = CmstenderhdrTbl::find()->where("cmsth_cmstenderhdrtemp_fk =:pk", [':pk' => $rfxdata['rfx_pk']])->one();
            if(!empty($model)){
            

                $remainderval = $rfxdata['isreminder'] ? 1 : 0;
                        
                if ($rfxdata['card_type'] == 'info') {
                    if(!($model->cmsth_memcompmst_fk==$company_id && $model->cmsth_title==$rfxdata['rfxcardtitle']&&$model->cmsth_refno==$rfxdata['rfxcardrefno'] && $model->cmsth_initiateddate==Common::convertDateTimeToServerTimezone($rfxdata['rfxinitiate_Date']) && $model->cmsth_initiatedby==$rfxdata['rfx_initiateby'] && $model->cmsth_type==$rfxdata['rfxtender_type'] && $model->cmsth_cmsrequisitionformdtls_fk==Security::decrypt($rfxdata['rfxtender_pk']))){

                        $isupdated = 2; 
                    }   
        
                    if($rfxdata['rfxdisciplinepk'] == '' || $rfxdata['rfxdisciplinepk'] == null) { 
                    $disciplinepk = \app\models\CmsdisciplinedtlsTblQuery::adddisciplinedtls($rfxdata['rfxdiscipline']);
                        if($disciplinepk['code'] != '202'&&$model->cmsth_cmsdisciplinedtls_fk!=$disciplinepk) {
                            $isupdated = 2;
                        }
                    } else {
                    if($model->cmsth_cmsdisciplinedtls_fk==$rfxdata['rfxdisciplinepk'])
                            $isupdated = 2;
                    }  
                } else if($rfxdata['card_type'] == 'remainder' && !($model->cmsth_setreminder==$remainderval && $model->cmsth_closeintvl==$rfxdata['req_intervalcnt'] && $model->cmsth_closeintvltype==$rfxdata['req_interval'] && $model->cmsth_openintvl==$rfxdata['aft_intervalcnt'] && $model->cmsth_openintvltype==$rfxdata['aft_interval'])) {
                    $isupdated = 2;
                } else if ($rfxdata['card_type'] == 'scope' && !($model->cmsth_shortdesc==$rfxdata['rfx_shortdesc'] && $model->cmsth_statement==$rfxdata['requisi_state'] && $model->cmsth_instruction==$rfxdata['rfx_instruct'] && $model->cmsth_mineligibility==$rfxdata['rfx_mineligibility'] && $model->cmsth_reqdate==date('Y-m-d',strtotime(Common::convertDateTimeToServerTimezone($rfxdata['required_Date'])))&& $model->cmsth_reqincoterms==$rfxdata['incoterms'] && $model->cmsth_portname==$rfxdata['portname'])) {
                    $isupdated = 2;
        
                    if($rfxdata['rfxtender_type_val'] == 'RFT' && !($model->cmsth_csstartdate==Common::convertDateTimeToServerTimezone($rfxdata['startdate']) && $model->cmsth_csenddate==Common::convertDateTimeToServerTimezone($rfxdata['enddate']))){
                        $isupdated = 2;
                    }
        
                } else if ($rfxdata['card_type']=='communication' && $model->cmsth_contact_usermst_fk==$rfxdata['rfxcommunication']) {
                    $isupdated = 2;
                } else if ($rfxdata['card_type']=='notify' && $model->cmsth_config_usermst_fk==$rfxdata['rfxnotify']) {
                    $isupdated = 2;
                } else if ($rfxdata['card_type'] == 'subcontractrule') {
                    $subcontract = $rfxdata['subcontract'] ? 1 : 0;
                    $etender = $rfxdata['etender'] ? 1 : 0;
                    if($model->cmsth_issubcontrqmt==$subcontract && $model->cmsth_obligation==$rfxdata['rfp_classic'] && $model->cmsth_msmepercent==$rfxdata['rfp_obligation'] && $model->cmsth_lccpercent==$rfxdata['rfp_lccobligation'] && $model->cmsth_obligationscope==$rfxdata['rfx_obligationscope'] && $model->cmsth_isetendmandate==$etender){
                        $isupdated = 2;
                    }
                    
                } 
                /*elseif ($rfxdata['card_type'] == 'questionarie') {
                    if($rfxdata['questionairepk'] != $model->cmstht_cmsquestionnaireformtemp_fk && $model->cmstht_cmsquestionnaireformtemp_fk != null) {
                        $isupdated = 2;
                    }
                    $model->cmstht_cmsquestionnaireformtemp_fk = $rfxdata['questionairepk'];
                }*/ 
                /*elseif ($rfxdata['card_type'] == 'req_support_doc') {
                    $model->crfd_remarks = $rfxdata['remark_disc'];
                }*/
                elseif ($rfxdata['card_type'] == 'icv') {
                    if($rfxdata['icvsubmission']) {
                        $endquarter = $rfxdata['endquarter'] ? 1 : 2;
                        if(!($model->cmsth_icv_startyear == $rfxdata['startyearsicv']&&$model->cmsth_icv_startquarter==$rfxdata['startquarter']&&$model->cmsth_icv_endyear==$rfxdata['endyearsicv']&&$model->cmsth_icv_endquarter==$rfxdata['endquarter']&&$model->cmsth_isicv==$endquarter)){
                            $isupdated = 2;
                        }
                    }
                }elseif ($rfxdata['card_type'] == 'schedule' && !($model->cmsth_skdclosedate==Common::convertDateTimeToServerTimezone($rfxdata['closingdate'])&&$model->cmsth_skdclosedate==Common::convertDateTimeToServerTimezone($rfxdata['submittedOn']))) {
                    $isupdated = 2;
                    if($model->cmsth_skdclosedate!=Common::convertDateTimeToServerTimezone($rfxdata['closingdate']))
                        $isupdated = 3;
                
                } elseif ($rfxdata['card_type'] == 'savedrft') {
                    // $model->cmstht_tenderstatus = 1;
                } elseif($rfxdata['card_type'] == 'additonaldoc') {
                    $attachclosedate = ($rfxdata['close_date']!=NULL&&$rfxdata['close_date']!='') ? date('Y-m-d',strtotime(Common::convertDateTimeToServerTimezone($rfxdata['close_date']))) : NULL;
                    if($model->cmsth_attachlink!=$rfxdata['attach_link']&&$model->cmsth_attachclosedate!=$attachclosedate)
                        $isupdated = 2;
                } 
                /*elseif($rfxdata['card_type'] == 'rfxaddinfo') {
                    $transaction = Yii::$app->db->beginTransaction();
                    $update_happen = false;
                    $deleteaddinfo = CmsaddinfodtlstempTbl::deleteAll(['=', 'caidt_cmstenderhdrtemp_fk', $model->cmstenderhdrtemp_pk]);
                    foreach ($rfxdata['rfxadditionalinfo'] as $key => $value) {
                        if ($value['addinfopk']) {
                            $update_happen = true;
                        }
                        // $modeladdinfo = CmsaddinfodtlstempTbl::find()->where("cmsaddinfodtlstemp_pk =:pk", [':pk' => $value['addinfopk']])->one();
                        // if (!empty($modeladdinfo->caid_createdon)) {
                        //     $modeladdinfo->caidt_updatedon = $date;
                        //     $modeladdinfo->caidt_updatedby = $userPK;
                        //     $modeladdinfo->caidt_updatedbyipaddr = Common::getIpAddress();
                        // }
                        
                        $modeladdinfo = new CmsaddinfodtlstempTbl();
                        $modeladdinfo->caidt_createdon = $date;
                        $modeladdinfo->caidt_createdby = $userPK;
                        $modeladdinfo->caidt_createdbyipaddr = Common::getIpAddress();
                        $modeladdinfo->caidt_cmstenderhdrtemp_fk = $rfxdata['rfx_pk'];
                        $modeladdinfo->caidt_title = $value['question'];
                        $modeladdinfo->caidt_description = $value['answer'];
                        $modeladdinfo->caidt_index = $key + 1;
                        $modeladdinfo->caidt_status = 1;
                        
                        if(!$modeladdinfo->save()) {
                            $result = array(
                                'status' => 200,
                                'msg' => 'warning',
                                'flag' => 'E',
                                'comments' => 'Something went wrong!',
                                'returndata' => $modeladdinfo->getErrors()
                            );
                            break;
                        }
        
                    }
        
                } */
                /*else if($rfxdata['card_type'] == 'configcontact') {
                    $model->cmstht_contact_usermst_fk = $rfxdata['rfxcontact'];
                }*/
            }
        }
        else if($type=='supportdoctext'){
            // function call from api\modules\pms\models\CmssupdocumenttempTblQuery::saveSupportingDocumenttemp()
            $model = CmstenderhdrTbl::find()->where("cmsth_cmstenderhdrtemp_fk =:pk", [':pk' => $rfxdata['sharedFk']])->one();
            if($model->cmsth_remarks!=$rfxdata['remark_disc'])
                $isupdated=2;
        }
        else if($type=='supportdoc'){
            // function call from api\modules\pms\models\CmssupdocumenttempTblQuery::saveSupportingDocumenttemp()
            $model = CmstenderhdrtempTbl::find()->where("cmstenderhdrtemp_pk =:pk", [':pk' => $rfxdata])->one();
            if(!empty($model)&&$model->cmstht_tenderstatus!=1){
                $model->cmstht_mailfor = 2;
                $model->save();
                $isupdated = 2;
            }
           
        }elseif($type=='payment_term'){
            $model = CmstenderhdrTbl::find()->where("cmsth_cmstenderhdrtemp_fk =:pk", [':pk' => $rfxdata['sharedFk']])->one();
            if(!empty($model) && $model->cmsth_invoiceinterval==$rfxdata['reqinterval'] && $model->cmsth_invoiceintervaltype==$rfxdata['reqintervaltype']){
                $isupdated = 2;
            }
        }elseif($type=='common'){
            $model = CmstenderhdrtempTbl::find()->where("cmstenderhdrtemp_pk =:pk", [':pk' => $rfxdata['sharedFk']])->one();
            if(!empty($model)&&$model->cmstht_tenderstatus!=1){
                $model->cmstht_mailfor = 2;
                $model->save();
                $isupdated = 2;
            }
        }
        return $isupdated;
    }


}