<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;
use common\models\UsermstTbl;
use common\components\Notification;
use common\models\BasemodulemstTbl;

/**
 * This is the ActiveQuery class for [[CmscontracthdrTbl]].
 *
 * @see CmscontracthdrTbl
 */
class CmscontracthdrTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmscontracthdrTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }
    public $memcomppymtinfodtls_pk;
    /**
     * {@inheritdoc}
     * @return CmscontracthdrTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function submitContractCard($formdata) {
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $lable = '';
            if ($formdata['cont_contracType'] == 'CO') {
                $lable = 'Contract';
            } elseif ($formdata['cont_contracType'] == 'PO') {
                $lable = 'Purchase Order';
            } elseif ($formdata['cont_contracType'] == 'BA') {
                $lable = 'Agreement';
            } elseif ($formdata['cont_contracType'] == 'SC') {
                $lable = 'Subcontract';
            } elseif ($formdata['cont_contracType'] == 'SO') {
                $lable = 'Suborder';
            }
            if (!empty($formdata['contractPk']) && $formdata['contractPk'] != null) {
                $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $formdata['contractPk']])->one();
                $comments = $lable . ' Information Updated Successfully';
                $flag = 'U';
            } else {
                $model = new CmscontracthdrTbl;
                $flag = 'C';
                $comments = $lable . ' Information Added Successfully';
                if ($formdata['cont_contracType'] == 'CO' || $formdata['cont_contracType'] == 'SC') {
                    $model->cmsch_type = 1;
                    if ($formdata['cont_contracType'] == 'CO') {
                        $model->cmsch_uid = Common::getUniqueId('Contract');
                        $model->cmsch_contracttype = 1;
                        $model->cmsch_level = 1;
                    } elseif ($formdata['cont_contracType'] == 'SC') {
                        $model->cmsch_uid = Common::getUniqueId('subContract');
                        $model->cmsch_contracttype = 2;
                        $model->cmsch_cmscontracthdr_fk = $formdata['headerContractPk'];
                        $model->cmsch_level = self::existingLevel($formdata['headerContractPk']);
                    }
                } elseif ($formdata['cont_contracType'] == 'PO' || $formdata['cont_contracType'] == 'SO') {
                    $model->cmsch_type = 2;
                    if ($formdata['cont_contracType'] == 'PO') {
                        $model->cmsch_uid = Common::getUniqueId('Purchase');
                        $model->cmsch_contracttype = 1;
                        $model->cmsch_level = 1;
                    } elseif ($formdata['cont_contracType'] == 'SO') {
                        $model->cmsch_contracttype = 2;
                        $model->cmsch_uid = Common::getUniqueId('subOrder');
                        $model->cmsch_cmscontracthdr_fk = $formdata['headerContractPk'];
                        $model->cmsch_level = self::existingLevel($formdata['headerContractPk']);
                    }
                } elseif ($formdata['cont_contracType'] == 'BA') {
                    $model->cmsch_type = 3;
                    if ($formdata['cont_contracType'] == 'BA') {
                        $model->cmsch_uid = Common::getUniqueId('Blanket');
                        $model->cmsch_contracttype = 1;
                        if (empty($formdata['headerContractPk']) && $formdata['headerContractPk'] == null) {
                            $model->cmsch_level = 1;
                        } else {
                            $model->cmsch_cmscontracthdr_fk = $formdata['headerContractPk'];
                            $model->cmsch_level = self::existingLevel($formdata['headerContractPk']);
                        }
                    } elseif ($formdata['cont_contracType'] == 'SA') {
                        $model->cmsch_contracttype = 2;
                        $model->cmsch_cmscontracthdr_fk = $formdata['headerContractPk'];
                        $model->cmsch_level = self::existingLevel($formdata['headerContractPk']);
                    }
                }
                if(!empty($formdata['quotationhdrFk'])){
                    $quotData = \api\modules\quot\models\CmsquotationhdrTblQuery::getQuotationData($formdata['quotationhdrFk']);
                    $quotData = $quotData['moduleData'];
                    $model->cmsch_cmsquotationhdr_fk = $formdata['quotationhdrFk'];
                    $model->cmsch_cmstenderhdr_fk = $quotData['cmstenderhdr_pk'];
                }
                $model->cmsch_memcompmst_fk = $compPK;
                $model->cmsch_contractsalone = $formdata['contractsalone'];
                $model->cmsch_contractstatus = 2;
                $model->cmsch_cmsrequisitionformdtls_fk = $formdata['req_pk'];
            }
            $model->cmsch_contracttitle = $formdata['contcardtit'];
            $model->cmsch_contractrefno = $formdata['contcardrefno'];
            $model->cmsch_contractdate = $formdata['contract_Date'];
            $model->cmsch_initiatedby = $formdata['cont_initiateby'];
            $model->cmsconttypemst_fk = $formdata['procurementType'];
            if ($model->save() === TRUE) {
                $TenderTbl = CmsrequisitionformdtlsTbl::find()->where("cmsrequisitionformdtls_pk =:pk", [':pk' => $model->cmsch_cmsrequisitionformdtls_fk])->one();
                if($TenderTbl->crfd_rqprocesstype != 3 && $TenderTbl->crfd_tenderstatus == 1){
                    $TenderTbl->crfd_tenderstatus = 2;
                    if (!$TenderTbl->save()) {
                        $result = array(
                            'status' => 200,
                            'msg' => 'warning',
                            'flag' => 'E',
                            'comments' => 'Something went wrong',
                            'returndata' => $TenderTbl->getErrors()
                        );
                        return $result;
                    }
                }  elseif($TenderTbl->crfd_rqprocesstype == 3 && $flag == 'C') {                    
                    $formdata['contractPk'] = $model->cmscontracthdr_pk;
                    if ($quotData['primaryPk'] != null && !empty($quotData['primaryPk'])) {
                        $primary = CmsawarddtlsTblQuery::inserData($formdata, 1, $quotData['primaryPk'], 1, 1);
                        if ($primary['flag'] == 'E') {
                            return $primary;
                        }
                    }
                    if ($quotData['cmsqh_secondary_memcompmst_fk'] != null && !empty($quotData['cmsqh_secondary_memcompmst_fk'])) {
                        $pkArray=explode(',', $quotData['cmsqh_secondary_memcompmst_fk']);
                        foreach ($pkArray as $key => $dataVal) {
                            $secondary = CmsawarddtlsTblQuery::inserData($formdata, 1, $dataVal, 0, 1);
                            if ($secondary['flag'] == 'E') {
                                return $secondary;
                            }
                        }
                    }
                }
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $flag,
                    'comments' => $comments,
                    'moduleData' => CmscontracthdrTblQuery::GetContractData($formdata['req_pk'], $model->cmscontracthdr_pk),
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                    'returndata' => $model->getErrors()
                );
            }
            return $result;
        }
    }

    public function existingLevel($dataPk) {
        $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $dataPk])->one();
        return $model->cmsch_level + 1;
    }

    public function submitCardStatus($formdata) {
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $lable = '';
            if ($formdata['dataType'] == 'CO') {
                $lable = 'Contract';
            } elseif ($formdata['dataType'] == 'PO') {
                $lable = 'Purchase Order';
            } elseif ($formdata['dataType'] == 'BA') {
                $lable = 'Agreement';
            } elseif ($formdata['dataType'] == 'SC') {
                $lable = 'Subcontract';
            } elseif ($formdata['dataType'] == 'SO') {
                $lable = 'Suborder';
            }
            if (!empty($formdata['dataPk']) && $formdata['dataPk'] != null) {
                $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $formdata['dataPk']])->one();
                $comments = $lable . ' Status Updated Successfully';
                $model->cmsch_contractstatus = $formdata['dataStaus'];
                $model->cmsch_contractcomments = $formdata['dataComments'];
                $model->cmsch_updatedon = $date;
                $model->cmsch_updatedby = $userPK;
                $model->cmsch_updatedbyipaddr = $ip_address;
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => $comments,
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong',
                        'returndata' => $model->getErrors()
                    );
                }
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                );
            }
            return $result;
        }
    }

    public function saveNotifyUser($contractPk, $userPk, $dataType) {
        if (!empty($contractPk)) {
            $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $contractPk])->one();

            if ($dataType == 1) {
                if ($model->cmsch_config_usermst_fk != null) {
                    $comments = 'Notify User Updated Successfully!';
                    $flag = 'U';
                } else {
                    $comments = 'Notify User Add Successfully!';
                    $flag = 'C';
                }
                $model->cmsch_config_usermst_fk = $userPk;
            } elseif ($dataType == 2) {
                if ($model->cmsch_contact_usermst_fk != null) {
                    $comments = 'Contact Details Updated Successfully!';
                    $flag = 'U';
                } else {
                    $comments = 'Contact Details Add Successfully!';
                    $flag = 'C';
                }
                $model->cmsch_contact_usermst_fk = $userPk;
            }
            if ($model->save() === TRUE) {
                $contacts = UsermstTbl::find()->where(['IN', 'UserMst_Pk', explode(',', $userPk)])->asArray()->all();

                if (!empty($contacts)) {
                    $label = '';
                    if ($model->cmsch_type == 1) {
                        if ($model->cmsch_contracttype == 1) {
                            $label = 'Contract';
                        } else {
                            $label = 'Subcontract';
                        }
                    } elseif ($model->cmsch_type == 2) {
                        if ($model->cmsch_contracttype == 1) {
                            $label = 'Purchase Order';
                        } else {
                            $label = 'Suborder';
                        }
                    } elseif ($model->cmsch_type == 3) {
                        $label = 'Blanket Agreement';
                    }
                    foreach ($contacts as $contact) {
                        try {
                            $consolePath = \Yii::$app->params['consolePath'];
                            $consoleCalling = \Yii::$app->params['consoleCalling'];
                            $baseMailPath = \Yii::$app->params['baseMailPath'];
                            $app_url = \Yii::$app->params['APP_URL'];
                            $baseUrl = \Yii::$app->params['baseUrl'];
                            $userPk = $contact['UserMst_Pk'];
//                             echo "{$consoleCalling} {$consolePath}yii cms/sendmailcontact $contractPk $label $userPk $app_url $baseUrl";exit;
                            pclose(popen("start {$consoleCalling} {$consolePath}yii cms/sendmailcontact $contractPk $label $userPk $app_url $baseUrl")); 
                        } catch(Exception $e){                            
                            $errormsg = $e->getMessage();                            
                            self::getErrormsg($errormsg,$pkid);                             
                        }
                    }
                }
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $flag,
                    'comments' => $comments
                );
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

    public function notifyUserEmail($contractpk, $type, $userPk,$app_url,$baseUrl) {
        $contact = UsermstTbl::find()->where('UserMst_Pk = :userPk',[':userPk' => $userPk])->asArray()->one();
        $url = $app_url . "api/ma/mail/send"; 
        $contact = json_decode($contact); 
        $primary_key = $contractpk;
        $encrypted_pk = Security::encrypt($primary_key);
        $btn_url = $baseUrl . 'contract/contractdetails/' . $encrypted_pk;
        $btn = '<a href="' . $btn_url . '">View Detail</a>';
        $name = $contact['um_firstname'];

        if ($contact['um_middlename']) {
            $name .= ' ' . $contact['um_middlename'];
        }
        if ($contact['um_lastname']) {
            $name .= ' ' . $contact['um_lastname'];
        }

        $_data = [
            'email' => $contact['UM_EmailID'],
            'template_id' => 267,
            'table_ref_key' => 'cmscontracthdr_pk',
            'table_ref_value' => $primary_key,
            'addi_params' => ['CONTRACT_TYPE' => $type, 'view_btn' => $btn, 'receiver_name' => $name]
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
        curl_error($curl);
        curl_close($curl);
    }

    public function saveContactData($sharedfk, $consigneePk, $notifyingpartyPk) {
        if (!empty($sharedfk)) {
            $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $sharedfk])->one();
            if ($model) {
                if ($model->cmsch_consignee_mcmpld_fk == null) {
                    $comments = 'Consignee Details Add Successfully!';
                } else {
                    $comments = 'Consignee Details Updated Successfully!';
                }
                $model->cmsch_consignee_mcmpld_fk = $consigneePk ? $consigneePk : null;
                $model->cmsch_notiparty_mcmpld_fk = $notifyingpartyPk ? $notifyingpartyPk : null;
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => $comments
                    );
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
    }

    public function getContactAfterSave($sharedfk) {
        if (!empty($sharedfk)) {
            $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $sharedfk])->one();
            if ($model) {
                $consigneeData = null;
                $notifyingPartyData = null;
                if ($model->cmsch_consignee_mcmpld_fk != null) {
                    $consigneeData = \api\modules\pd\models\MemcompmplocationdtlsTblQuery::getContatData($model->cmsch_consignee_mcmpld_fk, 1);
                }
                if ($model->cmsch_notiparty_mcmpld_fk != null) {
                    $notifyingPartyData = \api\modules\pd\models\MemcompmplocationdtlsTblQuery::getContatData($model->cmsch_notiparty_mcmpld_fk, 2);
                }
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'consigneeData' => $consigneeData['returndata'],
                    'notifyingPartyData' => $notifyingPartyData['returndata'],
                );
                return $result;
            }
        }
    }

    public function saveSubcontractRule($formdata) {
        if (!empty($formdata)) {
            $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $formdata['contractPk']])->one();
            if ($model) {
                $lable = '';
                if ($model->cmsch_type == 1) {
                    $lable = 'Subcontract';
                } elseif ($model->cmsch_type == 2) {
                    $lable = 'Suborder';
                } elseif ($model->cmsch_type == 3) {
                    $lable = 'Subcontract';
                }
                if ($model->cmsch_issubcontrqmt != null) {
                    $comments = $lable . ' Rule Updated Successfully';
                    $flag = 'U';
                } else {
                    $comments = $lable . ' Rule Added Successfully';
                    $flag = 'C';
                }
                $msme = null;
                $lcc = null;
                if ($formdata['obligation'] == 1) {
                    $msme = $formdata['req_percentage'];
                } elseif ($formdata['obligation'] == 3) {
                    $msme = $formdata['msme_percentage'];
                } else {
                    $msme = null;
                }
                if ($formdata['obligation'] == 2) {
                    $lcc = $formdata['req_percentage'];
                } elseif ($formdata['obligation'] == 3) {
                    $lcc = $formdata['lcc_percentage'];
                } else {
                    $lcc = null;
                }
                $model->cmsch_issubcontrqmt = $formdata['subRequirement'] == true ? 1 : 2;
                $model->cmsch_obligation = $formdata['obligation'];
                $model->cmsch_msmepercent = $msme;
                $model->cmsch_lccpercent = $lcc;
                $model->cmsch_obligationscope = $formdata['oblicationScope'];
                $model->cmsch_isetendmandate = $formdata['etenderMandate'] == true ? 1 : 2;
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $flag,
                        'comments' => $comments
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
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

    public function saveContractorICVCommitement($formdata) {
        //print_r($formdata);die();
        if (!empty($formdata)) {
            $model = CmscontracthdrTbl::find()->where(["cmscontracthdr_pk" => $formdata['cmsch_cmscontracthdr_fk']])->one();
            if ($model) {

                $model->cmsch_icvcommitmentvalue = $formdata['cmsch_icvcommitmentvalue'];
                $model->cmsch_icvpercent = $formdata['cmsch_icvpercent'];
                $model->cmsch_icvfileupload = $formdata['cmsch_icvfileupload'];
//                $model->cmsch_cmscontracthdr_fk = $formdata['cmsch_cmscontracthdr_fk'];
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S'
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
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


    public function updateicvcommitementvalue($formdata) {
        $icvcommitmentvalue = 0;
        if (!empty($formdata)) {
            $model = CmscontracthdrTbl::find()->where(["cmscontracthdr_pk" => $formdata['cmsch_cmscontracthdr_fk']])->one();
            if ($model && !empty($model->cmsch_cmsquotationhdr_fk)) {
                $data = \api\modules\icv\controllers\IcvController::actionIcvactualspenddataforoverview($model->cmsch_cmsquotationhdr_fk,'','');

                foreach($data['items'] as $key =>$value) {
                    $icvcommitmentvalue += $value['plannedamt'];
                }

                if(!empty($icvcommitmentvalue)) {

                    $model->cmsch_icvcommitmentvalue = $icvcommitmentvalue;
                    if($model->save()) {
                            $result = array(
                            'status' => 200,
                            'msg' => 'success',
                            );
                    } else{

                        $result = array(
                            'status' => 200,
                            'msg' => 'Error',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'returndata' => $model->getErrors()
                    );
                    }
                }
            
            } else {
                $result = array(
                            'status' => 200,
                            'msg' => 'Error',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'returndata' => $model->getErrors()
                    );
            }

            return $result;
        }
    }

    public function getIcvStatus($formdata) {
        //print_r($formdata['cmscontracthdr_pk']);
        if (!empty($formdata)) {

            $model = CmscontracthdrTbl::find();
            $model->select('*');

            $model->where(['cmscontracthdr_pk' => $formdata['cmscontracthdr_pk']]);

            $model->andWhere(['not', ['cmsch_icvcommitmentvalue' => null, 'cmsch_icvpercent' => null, 'cmsch_icvfileupload' => null]]);

            $listofData = $model->asArray()->all();

            if (!empty($listofData)) {
                return ['items' => true];
            } else {
                return ['items' => false];
            }
        }
    }

    public function saveScope($formdata) {
        if (!empty($formdata)) {
            $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $formdata['contractPk']])->one();
            if ($model) {
                $lable = '';
                if ($model->cmsch_type == 1) {
                    if ($model->cmsch_contracttype == 1) {
                        $lable = 'Contract';
                    } else {
                        $lable = 'Subcontract';
                    }
                } elseif ($model->cmsch_type == 2) {
                    if ($model->cmsch_contracttype == 1) {
                        $lable = 'Purchase Order';
                    } else {
                        $lable = 'Suborder';
                    }
                } elseif ($model->cmsch_type == 3) {
                    $lable = 'Agreement';
                }
                if ($model->cmsch_contractdesc != null) {
                    $comments = $lable . ' Scope Updated Successfully!';
                    $flag = 'U';
                } else {
                    $comments = $lable . ' Scope Created Successfully!';
                    $flag = 'C';
                }
                if ($formdata['processType'] == 2) {
                    $model->cmsch_contractdesc = $formdata['scope_desc'];
                    $model->cmsch_contractvalue = $formdata['contractValue'];
                    $model->cmsch_currencymst_fk = $formdata['currency_lst'];
                    $model->cmsch_contractstartdate = $formdata['submit_start_date'];
                    $model->cmsch_contractenddate = $formdata['submit_end_date'];
                    $model->cmsch_contractperiod = $formdata['contractperiod'];
                    $model->cmsch_contractactualvalue = $formdata['alreadySpend'];
                }
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $flag,
                        'comments' => $comments
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
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

    public function submitScopeOnline($formdata) {
        if (!empty($formdata)) {
            $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $formdata['contractPk']])->one();
            if ($model) {
                $lable = '';
                if ($model->cmsch_type == 1) {
                    if ($model->cmsch_contracttype == 1) {
                        $lable = 'Contract';
                    } else {
                        $lable = 'Subcontract';
                    }
                } elseif ($model->cmsch_type == 2) {
                    if ($model->cmsch_contracttype == 1) {
                        $lable = 'Purchase Order';
                    } else {
                        $lable = 'Suborder';
                    }
                } elseif ($model->cmsch_type == 3) {
                    $lable = 'Agreement';
                }
                if ($model->cmsch_scopeofwork != null) {
                    $comments = $lable . ' Scope Updated Successfully';
                    $flag = 'U';
                } else {
                    $comments = $lable . ' Scope Created Successfully';
                    $flag = 'C';
                }
                $model->cmsch_contractdesc = $formdata['cont_desc'];
                $model->cmsch_scopeofwork = $formdata['scope_desc'];
                $model->cmsch_contractstartdate = $formdata['submit_start_date'];
                $model->cmsch_contractenddate = $formdata['submit_end_date'];
                $model->cmsch_contractperiod = $formdata['contractperiod'];
                $model->cmsch_contractvalue = $formdata['contractvalue'];
                $model->cmsch_currencymst_fk = $formdata['currencyPk'];
                if ($model->save() === TRUE) {
                    $ContractBillOfMeterial = CmstenderpsmapTblQuery::addBillOfMeterial($formdata);
                    $billOfMeterialTenderPScharges = CmstenderpschargesTblQuery::tenderPSCharges($formdata);
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $flag,
                        'comments' => $comments
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong',
                        'returndata' => $model->getErrors()
                    );
                }
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                    'returndata' => $model->getErrors()
                );
            }

            return $result;
        }
    }

    public function saveContractInfo($formdata) {
        if (!empty($formdata)) {
            $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $formdata['contractPk']])->one();
            if ($model) {
                $lable = '';
                if ($model->cmsch_type == 1) {
                    if ($model->cmsch_contracttype == 1) {
                        $lable = 'Contract';
                    } else {
                        $lable = 'Subcontract';
                    }
                    $formType = 'CO';
                } elseif ($model->cmsch_type == 2) {
                    if ($model->cmsch_contracttype == 1) {
                        $lable = 'Purchase Order';
                    } else {
                        $lable = 'Suborder';
                    }
                    $formType = 'PO';
                }
                if ($model->cmsch_contractdesc != null) {
                    $comments = $lable . ' Basic Information Updated Successfully';
                    $flag = 'U';
                } else {
                    $comments = $lable . ' Basic Information Added Successfully';
                    $flag = 'C';
                }
                $exstingType = $model->cmsch_shared_agreetype;
                $exstingAgreePk = $model->cmsch_shared_agreefk;
//                $model->cmsch_contractdesc = $formdata['cont_desc'];
                if ($formdata['contractType'] == 4) {
                    $model->cmsch_shared_agreetype = $formdata['agreementDtls']['dataType'];
                    $model->cmsch_shared_agreefk = $formdata['agreementDtls']['dataPk'];
                    if ($exstingAgreePk != $formdata['agreementDtls']['dataPk']) {
                        if ($formdata['agreementDtls']['dataType'] == 1) {
                            $exstingModule = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $formdata['agreementDtls']['dataPk']])->one();
//                            $model->cmsch_contractvalue = $exstingModule->cmsch_contractvalue;
                            $model->cmsch_contractactualvalue = $exstingModule->cmsch_contractactualvalue;
                            $model->cmsch_scopeofwork = $exstingModule->cmsch_scopeofwork;
                            $model->cmsch_currencymst_fk = $exstingModule->cmsch_currencymst_fk;
                            $model->cmsch_contractstartdate = $exstingModule->cmsch_contractstartdate;
                            $model->cmsch_contractenddate = $exstingModule->cmsch_contractenddate;
                            $model->cmsch_contractperiod = $exstingModule->cmsch_contractperiod;
                            $model->cmsch_supdocremarks = $exstingModule->cmsch_supdocremarks;
                            $model->cmsch_config_usermst_fk = $exstingModule->cmsch_config_usermst_fk;
                            $model->cmsch_issubcontrqmt = $exstingModule->cmsch_issubcontrqmt;
                            $model->cmsch_obligation = $exstingModule->cmsch_obligation;
                            $model->cmsch_msmepercent = $exstingModule->cmsch_msmepercent;
                            $model->cmsch_lccpercent = $exstingModule->cmsch_lccpercent;
                            $model->cmsch_obligationscope = $exstingModule->cmsch_obligationscope;
                            $model->cmsch_isetendmandate = $exstingModule->cmsch_isetendmandate;
                            $model->cmsch_invoiceinterval = $exstingModule->cmsch_invoiceinterval;
                            $model->cmsch_invoiceintervaltype = $exstingModule->cmsch_invoiceintervaltype;
                            $model->cmsch_contact_usermst_fk = $exstingModule->cmsch_contact_usermst_fk;
                            $extSupport = CmssupdocumentTbl::find()
                                            ->where('cmssd_shared_fk=:sharedFk and cmssd_type = 7 and cmssd_status = 1', array(':sharedFk' => $formdata['contractPk']))->all();
                            if (!empty($extSupport)) {
                                foreach ($extSupport as $supporting) {
                                    $$supportingDelete = CmssupdocumentTblQuery::delData($supporting->cmssupdocument_pk);
                                    if ($$supportingDelete['status'] == FALSE) {
                                        return $$supportingDelete;
                                    }
                                }
                                $agreeSupporting = CmssupdocumentTbl::find()
                                                ->where('cmssd_shared_fk=:sharedFk and cmssd_type = 7 and cmssd_status = 1', array(':sharedFk' => $formdata['agreementDtls']['dataPk']))->All();
                                if (!empty($agreeSupporting)) {
                                    foreach ($agreeSupporting as $key => $dataVal) {
                                        $creatSupporting = CmssupdocumentTblQuery::creatSupportingDocument($dataVal, $formdata['contractPk'], 7);
                                        if ($creatSupporting['flag'] == 'E') {
                                            return $creatSupporting;
                                        }
                                    }
                                }
                            } else {
                                $agreeSupporting = CmssupdocumentTbl::find()
                                                ->where('cmssd_shared_fk=:sharedFk and cmssd_type = 7 and cmssd_status = 1', array(':sharedFk' => $formdata['agreementDtls']['dataPk']))->All();
                                if (!empty($agreeSupporting)) {
                                    foreach ($agreeSupporting as $key => $dataVal) {
                                        $creatSupporting = CmssupdocumentTblQuery::creatSupportingDocument($dataVal, $formdata['contractPk'], 7);
                                        if ($creatSupporting['flag'] == 'E') {
                                            return $creatSupporting;
                                        }
                                    }
                                }
                            }
                            $extTerms = CmspaymenttermsTbl::find()
                                    ->where('cmspt_shared_fk=:sharedFk', array(':sharedFk' => $formdata['contractPk']))
                                    ->all();
                            if (!empty($extTerms)) {
                                foreach ($extTerms as $term) {
                                    $termDelete = CmspaymenttermsTblQuery::deleteTermsCondition($term->cmspaymentterms_pk);
                                    if ($termDelete['flag'] == 'E') {
                                        return $termDelete;
                                    }
                                }
                                $agreeTerm = CmspaymenttermsTbl::find()
                                                ->select(['cmspt_name', 'cmspt_value'])
                                                ->where('cmspt_shared_fk=:sharedFk', array(':sharedFk' => $formdata['agreementDtls']['dataPk']))
                                                ->asArray()->All();
                                if (!empty($agreeTerm)) {
                                    foreach ($agreeTerm as $key => $dataVal) {
                                        $creatTerm = CmspaymenttermsTblQuery::creatTermsCondition($dataVal, $formdata['contractPk'], 2);
                                        if ($creatTerm['flag'] == 'E') {
                                            return $creatTerm;
                                        }
                                    }
                                }
                            } else {
                                $agreeTerm = CmspaymenttermsTbl::find()
                                                ->where('cmspt_shared_fk=:sharedFk', array(':sharedFk' => $formdata['agreementDtls']['dataPk']))
                                                ->asArray()->All();
                                if (!empty($agreeTerm)) {
                                    foreach ($agreeTerm as $key => $dataVal) {
                                        $creatTerm = CmspaymenttermsTblQuery::creatTermsCondition($dataVal, $formdata['contractPk'], 2);
                                        if ($creatTerm['flag'] == 'E') {
                                            return $creatTerm;
                                        }
                                    }
                                }
                            }
                        } elseif ($formdata['agreementDtls']['dataType'] == 2) {
                            $exstingModule = CmscontractagreementhdrTbl::find()->where("cmscontractagreementhdr_pk =:pk", [':pk' => $formdata['agreementDtls']['dataPk']])->one();
                            $model->cmsch_contractstartdate = $exstingModule->cmscah_startdate;
                            $model->cmsch_contractenddate = $exstingModule->cmscah_enddate;
                            $model->cmsch_currencymst_fk = $exstingModule->cmscah_tav_currencymst_fk;
//                            $model->cmsch_contractvalue = $exstingModule->cmscah_totagreevalue;
                            $model->cmsch_contractactualvalue = null;
                            $model->cmsch_scopeofwork = null;
                            $model->cmsch_contractperiod = null;
                            $model->cmsch_supdocremarks = null;
                            $model->cmsch_config_usermst_fk = null;
                            $model->cmsch_issubcontrqmt = null;
                            $model->cmsch_obligation = null;
                            $model->cmsch_msmepercent = null;
                            $model->cmsch_lccpercent = null;
                            $model->cmsch_obligationscope = null;
                            $model->cmsch_isetendmandate = null;
                            $model->cmsch_invoiceinterval = null;
                            $model->cmsch_invoiceintervaltype = null;
                            $model->cmsch_contact_usermst_fk = null;
                        }
                    }
                }
                if ($model->save() === TRUE) {
                    $reg_type = \yii\db\ActiveRecord::getTokenData('reg_type', true);
                    $award = CmsawarddtlsTbl::find()
                            ->select(['cmsawarddtls_pk', 'cmsad_cmscontracthdr_fk', 'cmsad_memcompmst_fk', 'cmsad_cmsnonjsrssupmap_fk', 'cmsad_isprimarycontractor'])
                            ->where('cmsad_cmscontracthdr_fk=:conPK', array(':conPK' => $formdata['contractPk']))
                            ->asArray()
                            ->all();
                    if (empty($award)) {
                        if ($formdata['primarySupplier'] != null && !empty($formdata['primarySupplier'])) {
                            $primary = CmsawarddtlsTblQuery::inserData($formdata, $formType, $formdata['primarySupplier']['dataPk'], 1, $formdata['primarySupplier']['dataType']);
                            if ($primary['flag'] == 'E') {
                                return $primary;
                            }
                        }
                        if ($formdata['secondarySupplir'] != null && !empty($formdata['secondarySupplir'])) {
                            foreach ($formdata['secondarySupplir'] as $key => $dataVal) {
                                $secondary = CmsawarddtlsTblQuery::inserData($formdata, $formType, $dataVal['dataPk'], 0, $dataVal['dataType']);
                                if ($secondary['flag'] == 'E') {
                                    return $secondary;
                                }
                            }
                        }
                    } elseif ($reg_type == 6) {
                        foreach ($award as $val) {
                            if ($val['cmsad_isprimarycontractor'] == 1) {//                                
                                $resonUpdate = CmsawarddtlsTbl::find()->where("cmsawarddtls_pk =:pk", [':pk' => $val['cmsawarddtls_pk']])->one();
                                if(!empty($formdata['resason_proof'])){
                                    $resonUpdate->cmsad_justifydocupload = strval($formdata['resason_proof'][0]);                                    
                                }  else {
                                    $resonUpdate->cmsad_justifydocupload = null; 
                                }
                                $resonUpdate->cmsad_justifycomment = $formdata['resason_desc'];
                                if (!$resonUpdate->save()) {
                                    $result = array(
                                        'status' => 200,
                                        'msg' => 'warning',
                                        'flag' => 'E',
                                        'comments' => 'Something went wrong',
                                        'returndata' => $resonUpdate->getErrors()
                                    );
                                    return $result;
                                }
                            }
                        }
                    }
                }
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $flag,
                    'comments' => $comments
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                    'returndata' => $model->getErrors()
                );
            }
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
                'returndata' => $model->getErrors()
            );
        }
        return $result;
    }

    public function submitContractFinalSave($contractPk) {
        if (!empty($contractPk)) {
            // echo 45;exit;
            $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $contractPk])->one();
            if ($model) {
                $ip_address = Common::getIpAddress();
                $date = date('Y-m-d H:i:s');
                $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                $lable = '';
                if ($model->cmsch_type == 1) {
                    if ($model->cmsch_contracttype == 1) {
                        $lable = 'Contract';
                    } else {
                        $lable = 'Subcontract';
                    }
                } elseif ($model->cmsch_type == 2) {
                    if ($model->cmsch_contracttype == 1) {
                        $lable = 'Purchase Order';
                    } else {
                        $lable = 'Suborder';
                    }
                } elseif ($model->cmsch_type == 3) {
                    $lable = 'Agreement';
                }
                if ($model->cmsch_createdon != null) {
                    $comments = $lable . ' Updated Successfully';
                    $flag = 'U';
                    $model->cmsch_updatedon = $date;
                    $model->cmsch_updatedby = $userPK;
                    $model->cmsch_updatedbyipaddr = $ip_address;
                } else {
                    $comments = $lable . ' Created Successfully';
                    $flag = 'C';
                    $model->cmsch_createdon = $date;
                    $model->cmsch_createdby = $userPK;
                    $model->cmsch_createdbyipaddr = $ip_address;
                }
                $model->cmsch_contractstatus = 1;
                
                if ($model->save() == TRUE) {
                    
                    if($model->cmsch_type==2&&$model->cmsch_contracttype==1){
                        $notice_data = [];
                        $c_po_created_by = $model->cmschCreatedby;
                        $c_po_created_by = ($c_po_created_by->um_middlename!=NULL&&trim($c_po_created_by->um_middlename)!='') ? $c_po_created_by->um_firstname.' '.$c_po_created_by->um_middlename.' '.$c_po_created_by->um_lastname : $c_po_created_by->um_firstname.' '.$c_po_created_by->um_lastname;
                        $c_po_title = $model->cmsch_contracttitle;
                        $c_po_refno = $model->cmsch_contractrefno;
                        $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
                        $basemodule_record = BasemodulemstTbl::find()->where("bmm_name like 'Contracts Management System'")->one();
                        $attachment=null;
                        $targettype=null;
                        $targetstring=null;
                        $targetcount=null;
                        $title = 'You have been awarded a Contract/Purchase Order ('.$c_po_refno.' - '.$c_po_created_by.')';
                        $description = 'Congratulations! <b>'.$c_po_created_by.'</b> has awarded the <b>Contract/Purchase Order ('.$c_po_refno.' - '.$c_po_created_by.')</b> on JSRS Contracts Management System (JSRS-CMS) with <b'.$obligation.'</b>to your company. Kindly pay the success fee and get validated to create Tender and award a Contract/Purchase Order.';
                        $obligation = ($model->cmsch_obligation!=NULL&&$model->cmsch_obligation!='') ? $model->cmsch_obligation.' ' : '';

                        // if($flag=='C'){
                            
                        // }
                        if($flag=='U'){
                            $title = 'The Contract/Purchase Order ('.$c_po_refno.' - '.$c_po_created_by.') has been Updated';

                            $description = '<b>'.$c_po_created_by.'</b> has <b>updated</b> the awarded <b>Contract/Purchase Order ('.$c_po_refno.' - '.$c_po_created_by.')</b> on JSRS Contracts Management System (JSRS-CMS) with <b>'.$obligation.'</b>to your company. Kindly pay the success fee and get validated to create Tender and award a Contract/Purchase Order.';
                        }
                        $notice_data['notifdev_tempid'] = NULL; //waiting for clarification
                        $notice_data['basemodulemst_fk'] = $basemodule_record->basemodulemst_pk;
                        $notice_data['memberregmst_fk'] = $regPk;
                        $notice_data['msg_type'] = 1; //system generated
                        $notice_data['msg_to'] = 1;  //company
                        $notice_data['msg_title'] = $title;
                        $notice_data['msg_description'] = $description;
                        $notice_data['attachment'] = $attachment;
                        $notice_data['msg_status'] = 1;
                        $notice_data['targettype'] = $targettype;
                        $notice_data['targetstring'] = $targetstring;
                        $notice_data['targetcount'] = $targetcount;
                        // $notice_data['notification_link'] = ;
                        $notice_data['usermst_pk'] = $userPK;
                        $notice_data['supplier_pks'] = $model->cmschCmsquotationhdrFk;
                        $notice_data['notification_name'] = 'award';
                        $notice_data['isdeleted'] = 2;
                        $notice_data['title_newsupplier'] = '';
                        $notice_data['description_newsupplier'] = '';
                        $notice_data['newsupplier'] = [];
                        $notice_data['bnm_tz_utcoffset'] = NULL;
                        $notice_data['bnm_closing_date'] = NULL;
                        $notice_data['bnm_refno'] = $c_po_refno;
                        $notice_data['bnm_noticefrom'] = $c_po_created_by;
                        Notification::insertnotification($notice_data);

                    }
                    $award = CmsawarddtlsTbl::find()
                            ->where("cmsad_cmscontracthdr_fk =:contractPk", [':contractPk' => $contractPk])
                            ->asArray()
                            ->all();
                    $TenderTbl = CmsrequisitionformdtlsTbl::find()->where("cmsrequisitionformdtls_pk =:pk", [':pk' => $model->cmsch_cmsrequisitionformdtls_fk])->one();
                    $awardPrimaryComData = null;
                    if (!empty($award)) {
                        foreach ($award as $key => $dataVal) {
                            $awardSingle = CmsawarddtlsTbl::find()
                                    ->where("cmsawarddtls_pk =:dataPk", [':dataPk' => $dataVal['cmsawarddtls_pk']])
                                    ->one();
                            $awardSingle->cmsad_awardedon = $date;
                            if($TenderTbl->crfd_rqprocesstype != 2){
                                $awardSingle->cmsad_awardamt = $model->cmsch_contractvalue;
                            }  else {
                                 $awardSingle->cmsad_awardamt = $model->cmsch_contractvalue - $model->cmsch_contractactualvalue;
                            }
                            $awardSingle->save();
                            if ($awardSingle->cmsad_isprimarycontractor == 1) {
                                $awardPrimaryComData = $awardSingle;
                            }
                        }
                        $contactEmail = '';
                        $nonjsrs = false;

                        if (!empty($awardPrimaryComData)) {
                            $contactPerson = !empty($awardPrimaryComData->cmsadMemcompmstFk) ? $awardPrimaryComData->cmsadMemcompmstFk->getMemcompcontactdtlsTbls()->where(['mccd_primarycontact' => 'Y'])->one() : '';

                            if (!empty($contactPerson)) {
                                $contactEmail = $contactPerson->MCCD_Email;
                            }

                            if (!empty($awardPrimaryComData->cmsadCmsnonjsrssupmapFk)) {
                                $nonjsrs = true;
                                $contactEmail = $awardPrimaryComData->cmsadCmsnonjsrssupmapFk->cnjsm_contactemail;
                            }
                        }
                    }
                    if($TenderTbl->crfd_rqprocesstype != 3){
                        $TenderTbl->crfd_tenderstatus = 4;
                        $TenderTbl->save();
                    }  else {                        
                        $getBlanceData= CmsrqprodservdtlsTblQuery::getContractProductChk($model->cmsch_cmsrequisitionformdtls_fk);
                        if(count($getBlanceData['productList']) != 0){
                            $TenderTbl->crfd_tenderstatus = 3;
                        }  else {
                            $TenderTbl->crfd_tenderstatus = 4;                            
                        }
                        $TenderTbl->save();
                    }
                    if ($TenderTbl->crfd_rqprocesstype != 1 && ($model->cmsch_isetendmandate == 1 || $model->cmsch_issubcontrqmt == 1 )) {
                        if ($model->cmsch_currencymst_fk == 3) {
                            $finalAmt = round($awardPrimaryComData->cmsad_awardamt * 2.60080, 2, PHP_ROUND_HALF_UP);
                        } else {
                            $finalAmt = round($awardPrimaryComData->cmsad_awardamt, 2, PHP_ROUND_HALF_UP);
                        }
                        if ($finalAmt > \Yii::$app->params['CMS']['Contract_success_fee_target_limit']) {
                            $invoice = self::generateInvoice($model->cmscontracthdr_pk);
                        }
                    }

                    if ($contactEmail) {
                        try {
                            self::createContractEmail($model, $contactEmail, $lable, $nonjsrs);
                        } catch (\yii\base\Exception $exception) {
                            //$exception->getMessage();
                        }
                    }
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $flag,
                        'comments' => $comments
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong',
                        'returndata' => $model->getErrors()
                    );
                }
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                    'returndata' => $model->getErrors()
                );
            }

            return $result;
        }
    }
    public function getobligationtype($oblig)
    {
        if($oblig == 'SME Obligation')
            $type = 1;
        elseif($oblig == 'LCC Obligation')
            $type =2;
        elseif($oblig == 'SME & LCC Obligation')
            $type =3;
        elseif($oblig == 'SME & LCC Obligation')
            $type =5;
        else
            $type =4;
        
        return $type;
    }
    public function getcontractstatus($status)
    {
        //1 - Active, 2 - Inactive, 3 - Terminated, 4 - Suspended, 5 - Ongoing, 6 - Floated, 7 - Completed, 8 - Closed
                
        if($status == 'Active')
            $sts = 1;
        elseif($status == 'Terminated')
            $sts =3;
        elseif($status == 'Suspended')
            $sts =4;
        elseif($status == 'Completed')
            $sts =7;
        
        return $sts;
    }
    public function getawardtype($award)
    {
         if($award == 'General Contract')
               $awardtype = 1;
           elseif($award == 'Purchase Order')
               $awardtype = 2;
           elseif($award == 'Call Off Contract')
               $awardtype = 3;
        
        return $awardtype;
    }
    
    
    public function saveimportedcontract2($contract)
    {
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $membregid = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
        
        
        if($contract)
        {
           $epcProject = \api\modules\pd\models\ProjectdtlsTbl::find()
                            ->where('prjd_referenceno = :prjd_referenceno', [':prjd_referenceno' => $contract['Project_Ref_No']])
                            ->andWhere('prjd_memberregmst_fk = :prjd_memberregmst_fk', [':prjd_memberregmst_fk' => $membregid])
                            ->one();
           $epcTender = \api\modules\pms\models\CmsrequisitionformdtlsTbl::find()
                            ->where('crfd_rqrefno = :tenderrefno', [':tenderrefno' => $contract['Tender_Ref_No']])
                            ->andWhere('crfd_projectdtls_fk = :crfd_projectdtls_fk', [':crfd_projectdtls_fk' => $epcProject->projectdtls_pk])->one();
             
           
           
           $start = date('Y-m-d',strtotime($contract['Contract_Start_Date']));
           $end = date('Y-m-d',strtotime($contract['Contract_End_Date']));
          
           $duration = \common\components\GeneralFunctions::getdatedifference($start,$end);
           $awardtype = self::getawardtype($contract['Award_Type']);
           $obligationtype = self::getobligationtype($contract['Obligation_Type']);
           $contract_status = self::getcontractstatus($contract['Contract_Status']);
           $model = new CmscontracthdrTbl;
           
           $model->cmsch_memcompmst_fk = $compPK;
           $model->cmsch_cmsrequisitionformdtls_fk = $epcTender->cmsrequisitionformdtls_pk;
           $model->cmsch_type = $awardtype;
           $model->cmsch_contracttype = 1;
           $model->cmsch_cmscontracthdr_fk = NULL;
           $model->cmsch_contracttitle = $contract['Contract_Title'];
           $model->cmsch_contractrefno = $contract['Contract_Ref_No'];
           $model->cmsch_contractdate = date('Y-m-d',strtotime($contract['Contract_Start_Date']));
           $model->cmsch_initiatedby = $userPK;
           $model->cmsch_initiateddate = date('Y-m-d');
           $model->cmsch_contractdesc = $contract['Contract_Description'];
           $model->cmsch_contractenddate = date('Y-m-d',strtotime($contract['Contract_Start_Date']));
           $model->cmsch_contractenddate = date('Y-m-d',strtotime($contract['Contract_End_Date']));
           $model->cmsch_contractperiod = $duration;
           $model->cmsch_obligation = $obligationtype;
           $model->cmsch_msmepercent = $contract['SME_Obligation_Percentage'];
           $model->cmsch_lccpercent = $contract['LCC_Obligation_Percentage'];
           $model->cmsch_obligationscope = $contract['Scope_of_Obligation'];
           $model->cmsch_isetendmandate = strtolower($contract['Tendering_Mandate'])== 'yes'?1:2;
           $model->cmsch_contractstatus = $contract_status;
           $model->cmsch_contractcomments = $contract['Contract_Comments'];
           $model->cmsch_latesttime = date('Y-m-d H:i:s');
           $model->cmsch_isdeleted = 2;
           $model->cmsch_uid = Common::getUniqueId('Contract');
           $model->cmsch_level = 1;
           
           if(!$model->save())
           {
               
               $award = new CmsawarddtlsTbl();
               $award->cmsad_cmscontracthdr_fk = $model->cmscontracthdr_pk;
               $award->cmsad_memcompmst_fk = $compPK;
               $award->
               
               $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong',
                        'returndata' => $model->getErrors()
                    );
           }
           else
           {
               $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $flag,
                        'comments' => $comments
                    );
           }  
           
        }
        else
        {
           $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong',
                        'returndata' => 'No Contract Data Found'
                    );
        }
        
    }
    public function saveimportedcontract($contract,$rescount)
    {
          
          
          $wsdl['OprCompMst_Pk'] = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
          $wsdl['ewc_createdby'] = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
          $wsdl['ewc_updatedby'] = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
          $wsdl['ewc_memberregmst_fk'] = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
          $wsdl['user_type'] =  \yii\db\ActiveRecord::getTokenData('reg_type', true);
          
          $contractalone = $_SESSION['ocm_contract'];
          $oprcompPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
          $oprcompName = \yii\db\ActiveRecord::getTokenData('MCM_ComapanyName', true);
          
          
          $wsdlobject = \common\components\Wsdlcontract::getInstance();
          $wsdlobject->InsertPrjectInfo($contract,$wsdl,$rescount,FALSE,$contractalone,$oprcompPk,$oprcompName,$type='excel');
          
          
          
                 
          
        
        
        
        
    }

    public function createContractEmail($contract, $emailid, $type, $nonjsrs) {
        $app_url = \Yii::$app->params['APP_URL'];
        $baseUrl = \Yii::$app->params['baseUrl'];
        $url = $app_url . "api/ma/mail/send";
        $primary_key = $contract->cmscontracthdr_pk;
        $encrypted_pk = Security::encrypt($primary_key);
        $btn_url = $baseUrl . 'contract/contractdetails/' . $encrypted_pk;
        $btn = '<a href="' . $btn_url . '">View Detail</a>';

        if ($nonjsrs) {
            $btn = '<a href="' . $btn_url . '">Be JSRS Certified to Access the Contract Details</a>';
        }
        if (!empty($contract->cmsch_obligation) && $contract->cmsch_obligation != 5 && $contract->cmsch_isetendmandate == 2) {
            $template_id = 252;
            if ($nonjsrs) {
                $template_id = 255;
            }
        } else if ($contract->cmsch_obligation != 5 && $contract->cmsch_isetendmandate == 1) {
            $template_id = 253;
            if ($nonjsrs) {
                $template_id = 256;
            }
        } else if ($contract->cmsch_obligation == 5 && $contract->cmsch_isetendmandate == 1) {
            $template_id = 254;
            if ($nonjsrs) {
                $template_id = 257;
            }
        } else if ($nonjsrs && $contract->cmsch_obligation == 5 && $contract->cmsch_isetendmandate == 2) {
            $template_id = 258;
        }

        $_data = [
            'email' => $emailid,
            'template_id' => $template_id,
            'table_ref_key' => 'cmscontracthdr_pk',
            'table_ref_value' => $primary_key,
            'addi_params' => ['CONTRACT_TYPE' => $type, 'view_btn' => $btn]
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
        curl_error($curl);
        curl_close($curl);
    }

    public static function GetContractData($reqPk, $contractPk) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        if (empty($contractPk)) {
            $model = \api\modules\pms\models\CmsrequisitionformdtlsTbl::find()
                    ->select(['crfd_rqid', 'cmsrequisitionformdtls_pk', 'crfd_rqtitle', 'crfd_rqprocesstype', 'crfd_rqrefno', 'crfd_rqpriority', 'um_firstname as requesteruserName', 'UM_EmpId as requesterEmpId', 'DM_Name', 'prjd_projname', 'prjd_referenceno', 'projectdtls_pk', 'prjd_projectid', 'prjd_projstatus', 'prjd_projstage', 'crfd_rqtype', 'crfd_rqdate', 'crfd_rqstatus', 'mrm_contractsalone', 'crfd_cmscontracthdr_fk','cmsch_contracttitle as dataTitle','cmsch_uid as dataId','cmsch_contractrefno as dataRef','cmsch_contractstatus as dataStatus','prsm_projstage as proStatus',
                        "IF(cmsch_type = 1 and cmsch_contracttype = 1, 'Contract', IF(cmsch_type = 1 and cmsch_contracttype = 2, 'Subcontract',IF(cmsch_type = 2 and cmsch_contracttype = 1, 'Purchase Order',IF(cmsch_type = 2 and cmsch_contracttype = 2, 'Suborder', 'Agreement')))) as 'dataType'"])
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = crfd_requester')
                    ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
                    ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = crfd_cmscontracthdr_fk')
                    ->leftJoin('projstagemst_tbl', 'projstagemst_pk = prjd_projstage')
                    ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = crfd_departmentmst_fk')
                    ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = prjd_memberregmst_fk')
                    ->where('cmsrequisitionformdtls_pk=:reqPK', array(':reqPK' => $reqPk))
                    ->asArray()
                    ->one();
        } else {
            $model = CmscontracthdrTbl::find()
                    ->select(['crfd_rqid','crfd_tenderstatus', 'cmsrequisitionformdtls_pk', 'crfd_rqtitle', 'crfd_rqprocesstype', 'crfd_rqrefno', 'crfd_rqpriority', 'initiatedby.um_firstname as initiatedUser', 'initiatedby.UM_EmpId as initiatedEmpId', 'requester.um_firstname as requesteruserName', 'requester.UM_EmpId as requesterEmpId', 'DM_Name', 'prjd_projname', 'prjd_referenceno', 'projectdtls_pk', 'prjd_projectid', 'prjd_projstatus', 'prjd_projstage', 'crfd_rqtype', 'cmscontracthdr_tbl.cmsch_contracttype as cmsch_contracttype', 'cmscontracthdr_tbl.cmsch_uid as cmsch_uid', 'cmscontracthdr_tbl.cmsch_contracttitle as cmsch_contracttitle', 'cmscontracthdr_tbl.cmsch_contractrefno as cmsch_contractrefno', 'cmscontracthdr_tbl.cmsch_contractdate as cmsch_contractdate', 'cmscontracthdr_tbl.cmsch_initiatedby as cmsch_initiatedby', 'cmscontracthdr_tbl.cmsch_initiateddate as cmsch_initiateddate', 'cmscontracthdr_tbl.cmscontracthdr_pk as cmscontracthdr_pk', 'cmscontracthdr_tbl.cmsch_config_usermst_fk as cmsch_config_usermst_fk', 'cmscontracthdr_tbl.cmsch_issubcontrqmt as cmsch_issubcontrqmt', 'cmscontracthdr_tbl.cmsch_obligation as cmsch_obligation', 'cmscontracthdr_tbl.cmsch_msmepercent as cmsch_msmepercent', 'cmscontracthdr_tbl.cmsch_lccpercent as cmsch_lccpercent', 'cmscontracthdr_tbl.cmsch_obligationscope as cmsch_obligationscope', 'cmscontracthdr_tbl.cmsch_isetendmandate as cmsch_isetendmandate', 'cmscontracthdr_tbl.cmsch_contact_usermst_fk as cmsch_contact_usermst_fk', 'cmscontracthdr_tbl.cmsch_skdtype as cmsch_skdtype', 'cmscontracthdr_tbl.cmsch_skdsubmiton as cmsch_skdsubmiton', 'cmscontracthdr_tbl.cmsch_skd_timezone_fk as cmsch_skd_timezone_fk', 'cmscontracthdr_tbl.cmsch_supdocremarks as cmsch_supdocremarks', 'cmscontracthdr_tbl.cmsch_contractenddate as cmsch_contractenddate', 'cmscontracthdr_tbl.cmsch_currencymst_fk as cmsch_currencymst_fk', 'cmscontracthdr_tbl.cmsch_contractvalue as cmsch_contractvalue', 'cmscontracthdr_tbl.cmsch_contractdesc as cmsch_contractdesc', 'cmscontracthdr_tbl.cmsch_icvcommitmentvalue as cmsch_icvcommitmentvalue','cmscontracthdr_tbl.cmsch_icvfileupload as cmsch_icvfileupload','cmscontracthdr_tbl.cmsch_icvpercent as cmsch_icvpercent','cmscontracthdr_tbl.cmsch_contractactualvalue as cmsch_contractactualvalue', 'cmscontracthdr_tbl.cmsch_invoiceinterval as cmsch_invoiceinterval', 'cmscontracthdr_tbl.cmsch_invoiceintervaltype as cmsch_invoiceintervaltype', 'crfd_rqdate', 'cmscontracthdr_tbl.cmsch_cmsquotationhdr_fk as cmsch_cmsquotationhdr_fk', 'cmscontracthdr_tbl.cmsch_scopeofwork as cmsch_scopeofwork', 'cmscontracthdr_tbl.cmsch_contractstartdate as cmsch_contractstartdate', 'cmscontracthdr_tbl.cmsch_shared_agreetype as cmsch_shared_agreetype', 'cmscontracthdr_tbl.cmsch_shared_agreefk as cmsch_shared_agreefk', 'cmscontracthdr_tbl.cmsch_createdon as createdon', 'cmscontracthdr_tbl.cmsch_type as cmsch_type', 'cmscontracthdr_tbl.cmsch_consignee_mcmpld_fk as cmsch_consignee_mcmpld_fk', 'cmscontracthdr_tbl.cmsch_notiparty_mcmpld_fk as cmsch_notiparty_mcmpld_fk', 'crfd_rqstatus', 'mrm_contractsalone', 'crfd_cmscontracthdr_fk', 'cmsad_justifydocupload', 'cmsad_justifycomment', 'cmscontracthdr_tbl.cmsch_isjsrstncaccept as cmsch_isjsrstncaccept','headCon.cmsch_contracttitle as dataTitle','headCon.cmsch_uid as dataId','headCon.cmsch_contractrefno as dataRef','headCon.cmsch_contractstatus as dataStatus','prsm_projstage as proStatus',"IF(headCon.cmsch_type = 1 and headCon.cmsch_contracttype = 1, 'Contract', IF(headCon.cmsch_type = 1 and headCon.cmsch_contracttype = 2, 'Subcontract',IF(headCon.cmsch_type = 2 and headCon.cmsch_contracttype = 1, 'Purchase Order',IF(headCon.cmsch_type = 2 and headCon.cmsch_contracttype = 2, 'Suborder', 'Agreement')))) as 'dataType'",'cmscontracthdr_tbl.cmsconttypemst_fk as cmsconttypemst_fk'])
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmscontracthdr_tbl.cmsch_cmsrequisitionformdtls_fk')
                    ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
                    ->leftJoin('cmscontracthdr_tbl as headCon', 'headCon.cmscontracthdr_pk = crfd_cmscontracthdr_fk')
                    ->leftJoin('projstagemst_tbl', 'projstagemst_pk = prjd_projstage')
                    ->leftJoin('usermst_tbl as requester', 'requester.UserMst_Pk = crfd_requester')
                    ->leftJoin('usermst_tbl as initiatedby', 'initiatedby.UserMst_Pk = cmscontracthdr_tbl.cmsch_initiatedby')
                    ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_tbl.cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                    ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = crfd_departmentmst_fk')
                    ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = prjd_memberregmst_fk')
                    ->where('cmscontracthdr_tbl.cmscontracthdr_pk=:conPK', array(':conPK' => $contractPk))
                    ->asArray()
                    ->one();
        }
        if ($model['prjd_projbanner'] != null) {
            $model['imgUrl'] = Drive::generateUrl($model['proFilePk'], $model['proComPK'], $model['proUserPK']);
        } else {
            $model['imgUrl'] = 'assets/images/lypis_noimg.svg';
        }
        $icvfiles = !empty($model['cmsch_icvfileupload']) ? explode(',', $model['cmsch_icvfileupload']) : [];
        
        $filedoc = [];
        if(count($icvfiles) > 0) {
            foreach ($icvfiles as $key => $value) {
                $filedoc[$key]['icvFileURL'] = Drive::generateUrl($value, $compPK, $userPK);
                $filedoc[$key]['icvFileName'] = Drive::getFileName(\common\components\Security::encrypt($value));
                $filedoc[$key]['fileType'] = Drive::getFileType(\common\components\Security::encrypt($value));

                $fileDetails = Drive::getfiledetails($value, $compPK);
                if(is_array($fileDetails)) {
                    $filedoc[$key]['docdate'] =  $fileDetails['mcfd_uploadedon'];
                    $filedoc[$key]['docsize'] =  $fileDetails['mcfd_actualfilesize'];    
                }
            }

        }
        $model['icvFiles'] = $filedoc;

        if($model['cmsch_shared_agreetype'] == 1){
            $getAgree = CmscontracthdrTbl::find()
                    ->select(['crfd_rqid', 'cmsrequisitionformdtls_pk', 'crfd_rqtitle', 'crfd_rqprocesstype as agreeProcessType', 'crfd_rqrefno'])
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsch_cmsrequisitionformdtls_fk')
                    ->where('cmscontracthdr_pk=:conPK', array(':conPK' => $model['cmsch_shared_agreefk']))
                    ->asArray()
                    ->one();
            $model['agreeProcessType']= $getAgree['agreeProcessType'];
        }  else {
            $model['agreeProcessType']= null;
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    public static function  getContractListData($data) {
        $size = Security::sanitizeInput($data['size'], "number");
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $sortpk = Security::sanitizeInput($data['sort'], "number");
        $reqPk = $data['reqPk'];
        $dataType = $data['dataType'];
        $listType = null;
        $listSubType = null;
        if ($dataType == 'CO') {
            $listType = 1;
            $listSubType = 1;
        } elseif ($dataType == 'PO') {
            $listType = 2;
            $listSubType = 1;
        } elseif ($dataType == 'BA') {
            $listType = 3;
            $listSubType = 1;
        } elseif ($dataType == 'SC') {
            $listType = 1;
            $listSubType = 2;
        } elseif ($dataType == 'SO') {
            $listType = 2;
            $listSubType = 2;
        }
        $query = CmscontracthdrTbl::find()
                ->select(['cmsch_uid', 'cmsch_contractrefno', 'cmsch_contracttitle', 'cmscontracthdr_pk', 'cmsch_cmsrequisitionformdtls_fk', 'um_firstname', 'UM_EmpId', 'cmsch_contractvalue', 'cmsch_contact_usermst_fk', 'MCM_CompanyName as jsrsCompanyName', 'cnjsm_orgname as nonJsrsCompanyName', 'jsrsCountry.CyM_CountryName_en as jsrsCountryname', 'nonJsrsCountry.CyM_CountryName_en as nonjsrsCountryname', 'jsrsCountry.CountryMst_Pk as jsrsCountryPk', 'nonJsrsCountry.CountryMst_Pk as nonJsrsCountryPk', 'cmsch_contractstartdate', 'cmsch_contractenddate', 'cmsch_isetendmandate', 'cmsch_obligation', 'cmsch_msmepercent', 'cmsch_lccpercent', 'cmsch_type', 'mcm_complogo_memcompfiledtlsfk as companyFile', 'MemberCompMst_Pk as CompPk', 'cmsch_contractstatus', 'cmsad_awardedon', 'cmsch_level', 'cmsch_createdon','cmsch_icvcommitmentvalue','cmsch_issubcontrqmt',
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsch_contractvalue * 2.60080, cmsch_contractvalue)),2) as 'contractValueUSD'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsch_contractvalue / 2.60080, cmsch_contractvalue)),3) as 'contractValueOMR'", 'cmsch_icvcommitmentvalue',
//                    "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsch_icvcommitmentvalue * 2.60080, cmsch_icvcommitmentvalue)),2) as 'icvCommitmentValueUSD'",
//                    "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsch_icvcommitmentvalue / 2.60080, cmsch_icvcommitmentvalue)),3) as 'icvCommitmentValueOMR'", 
                    'cmsch_contracttype'])
                ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsch_initiatedby')
                ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk=cmsad_memcompmst_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk=cmsad_cmsnonjsrssupmap_fk')
                ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
                ->leftJoin('countrymst_tbl as jsrsCountry', 'jsrsCountry.CountryMst_Pk = MCM_Source_CountryMst_Fk')
                ->leftJoin('countrymst_tbl as nonJsrsCountry', 'nonJsrsCountry.CountryMst_Pk = cmsnjsd_countrymst_fk')
                ->where('cmsch_cmsrequisitionformdtls_fk=:pk and cmsch_isdeleted=2', array(':pk' => $reqPk))
                ->andWhere('cmsch_contracttype=:type', array(':type' => $listSubType))
                ->andWhere('cmsch_type=:dataType', array(':dataType' => $listType))
                ->andFilterWhere(['like', 'cmsch_contracttitle', $searchTxt])
                ->orFilterWhere(['like', 'cmsch_uid', $searchTxt])
                ->orFilterWhere(['like', 'cmsch_contractrefno', $searchTxt])
                ->asArray();
        if ($sortpk == 1) {
            $query->orderBy([new \yii\db\Expression("coalesce(cmsch_updatedon,cmsch_createdon) DESC")]);
        } else {
            $query->orderBy([new \yii\db\Expression("coalesce(cmsch_updatedon,cmsch_createdon) ASC")]);
        }
        $query->groupBy("cmscontracthdr_pk");
        $page = (!empty($size)) ? $size : 2;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        $finalData = [];
        foreach ($provider->getModels() as $listData) {
            $listData['awardedList'] = [];
            $listData['companylogo'] = null;
            if ($listData['cmscontracthdr_pk'] != NULL && !empty($listData['cmscontracthdr_pk'])) {
                $dataGet = CmsawarddtlsTblQuery::getAwardedtoArray($listData['cmscontracthdr_pk']);
                $listData['awardedList'] = $dataGet['moduleData'];
            } else {
                $listData['awardedList'] = [];
            }
            if ($listData['cmsch_type'] != NULL && !empty($listData['cmsch_type']) && $listData['cmsch_type'] == 3) {
                $agreementCount = self::getAgreementCount($listData['cmscontracthdr_pk']);
                $listData['noOfAwards'] = $agreementCount['noOfAwards'];
                $listData['awardedValue'] = $agreementCount['awardedValue'];
            } else {
                $listData['noOfAwards'] = null;
                $listData['awardedValue'] = null;
            }
            if ($listData['cmscontracthdr_pk'] != NULL && !empty($listData['cmscontracthdr_pk'])) {
                $SubCount = self::getSubConut($listData['cmscontracthdr_pk']);
                $listData['subContract'] = $SubCount['subContract'];
                $listData['subOrder'] = $SubCount['subOrder'];
            } else {
                $listData['subContract'] = null;
                $listData['subOrder'] = null;
            }
            if (!empty($listData['companyFile'])) {
                $listData['companylogo'] = \common\components\Drive::generateUrl($listData['companyFile'], $listData['CompPk'], $userPK);
            } else {
                $listData['companylogo'] = null;
            }
            $finalData[] = $listData;
        }
        return [
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'items' => $finalData ? $finalData : [],
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
        ];
    }

    public static function getManageListing($data) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $size = Security::sanitizeInput($data['size'], "number");
        $awardedStartDate = Security::sanitizeInput($data['awardedStartDate'], "string_spl_char");
        $awardedEndDate = Security::sanitizeInput($data['awardedEndDate'], "string_spl_char");
        $closingStarDate = Security::sanitizeInput($data['closingStarDate'], "string_spl_char");
        $closingEndDate = Security::sanitizeInput($data['closingEndDate'], "string_spl_char");
        $startStartDate = Security::sanitizeInput($data['startStartDate'], "string_spl_char");
        $startEndDate = Security::sanitizeInput($data['startEndDate'], "string_spl_char");
        $valueStart = Security::sanitizeInput($data['valueStart'], "string_spl_char");
        $valueEnd = Security::sanitizeInput($data['valueEnd'], "string_spl_char");
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $sortpk = Security::sanitizeInput($data['sort'], "number");
        $dataType = Security::sanitizeInput($data['dataType'], "number");
        $listStatus = Security::sanitizeInput($data['listStatus'], "number");
        $procurementType = Security::sanitizeInput($data['procurementType'], "number");
        $supplierStatus = Security::sanitizeInput($data['supplierStatus'], "number");
        $specialStatus = Security::sanitizeInput($data['specialStatus'], "number");
        $operatorBuyer = Security::sanitizeInput($data['operatorBuyer'], "number");
        $awardFilter = Security::sanitizeInput($data['awardFilter'], "number");
        $classification = Security::sanitizeInput($data['classification'], "string_spl_char");
        $country = Security::sanitizeInput($data['country'], "string_spl_char");
        $countryNon = Security::sanitizeInput($data['countryNon'], "string_spl_char");
        $awardedto = $data['awardedto'];
        $awardedNonJSRS = $data['awardedNonJSRS'];
        $obligation = Security::sanitizeInput($data['obligation'], "string_spl_char");
        $percentage = Security::sanitizeInput($data['percentage'], "string_spl_char");
        $subContract = Security::sanitizeInput($data['subContract'], "string_spl_char");
        $eTendering = Security::sanitizeInput($data['eTendering'], "string_spl_char");
        $awardType = Security::sanitizeInput($data['awardType'], "string_spl_char");
        $successFeeType = Security::sanitizeInput($data['successFeeType'], "string_spl_char");
        $query = CmscontracthdrTbl::find()
                ->select(['cmsch_uid', 'cmsch_contractrefno', 'cmsch_contracttitle', 'cmscontracthdr_pk', 'cmsch_cmsrequisitionformdtls_fk', 'um_firstname', 'UM_EmpId', 'cmsch_contractvalue', 'cmsch_contact_usermst_fk', 'MCM_CompanyName as jsrsCompanyName', 'cnjsm_orgname as nonJsrsCompanyName', 'jsrsCountry.CyM_CountryName_en as jsrsCountryname', 'nonJsrsCountry.CyM_CountryName_en as nonjsrsCountryname', 'jsrsCountry.CountryMst_Pk as jsrsCountryPk', 'nonJsrsCountry.CountryMst_Pk as nonJsrsCountryPk', 'cmsch_contractstartdate', 'cmsch_contractenddate', 'cmsch_isetendmandate', 'cmsch_obligation', 'cmsch_msmepercent', 'cmsch_lccpercent', 'cmsch_type', 'cmsch_contractstatus', 'cmsad_awardedon', 'cmsch_issubcontrqmt', 'crfd_rqprocesstype', 'mcm_complogo_memcompfiledtlsfk as companyFile', 'MemberCompMst_Pk as CompPk', 'cmsch_memcompmst_fk', 'cmsch_contracttype', 'crfd_cmscontracthdr_fk', 'cmsch_contractcomments', 'cmsrequisitionformdtls_pk', 'cmsch_level', 'cmsch_createdon', 'mcid_invoicestatus', 'cmsad_memcompmst_fk as awardToComPk', 'cmsad_cmsnonjsrssupmap_fk', 'mcid_invoiceamount', 'MCM_Origin as jsrsOrigin', 'cmsnjsd_countrymst_fk as nonJsrsOrigin', "DATE_FORMAT(mcid_generatedon,'%d-%m-%Y') AS generatedon", "DATE_FORMAT(mcpr_createdon,'%d-%m-%Y') AS reciptData", 'mcid_membercompmst_fk', 'mcid_invoicepath', 'memcomppymtrcptdtls_pk',new \yii\db\Expression("substring_index(substring_index(group_concat(`mcpid_pymtstatus` order by memcomppymtinfodtls_pk desc separator '***'),'***',1),'***',-(1)) as mcpid_pymtstatus"),'memcompinvoicedtls_pk', 'jdomoduledtl_pk as jdoCardPk', 'MCM_MemberRegMst_Fk as memRegPk','crfd_tenderstatus',
                    "IF(cmsch_type = 1 and cmsch_contracttype = 1, 'Contract', IF(cmsch_type = 1 and cmsch_contracttype = 2, 'Subcontract',IF(cmsch_type = 2 and cmsch_contracttype = 1, 'Purchase Order',IF(cmsch_type = 2 and cmsch_contracttype = 2, 'Suborder', 'Agreement')))) as 'dataType'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsch_contractvalue * 2.60080, cmsch_contractvalue)),2) as 'contractValueUSD'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsch_contractvalue / 2.60080, cmsch_contractvalue)),3) as 'contractValueOMR'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt)),2) as 'awardAmtUSD'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt)),3) as 'awardAmtOMR'",
                ])
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsch_cmsrequisitionformdtls_fk')
                ->leftJoin('jdomoduledtl_tbl', 'cmscontracthdr_pk = jdmd_shared_fk and jdmd_shared_type = 2')
                ->leftJoin('usermst_tbl', 'UserMst_Pk = cmsch_initiatedby')
                ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk=cmsad_memcompmst_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk=cmsad_cmsnonjsrssupmap_fk')
                ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
                ->leftJoin('countrymst_tbl as jsrsCountry', 'jsrsCountry.CountryMst_Pk = MCM_Source_CountryMst_Fk')
                ->leftJoin('countrymst_tbl as nonJsrsCountry', 'nonJsrsCountry.CountryMst_Pk = cmsnjsd_countrymst_fk')
                ->leftJoin('memcomplcccerthdr_tbl', 'mclch_membercompmst_fk = cmsad_memcompmst_fk')
                ->leftJoin('memcompinvoicedtls_tbl', 'mcid_membercompmst_fk = cmsch_memcompmst_fk and mcid_shared_fk = cmscontracthdr_pk and mcid_basemodulemst_fk = 131 and mcid_module = 4')
                ->leftJoin('memcomppymtinfodtls_tbl', 'mcpid_memcompinvoicedtls_fk = memcompinvoicedtls_pk')
                ->leftJoin('memcomppymtrcptdtls_tbl', 'mcpr_memcompinvoicedtls_fk = memcompinvoicedtls_pk')
                ->where('cmsch_memcompmst_fk=:pk and cmsch_isdeleted = 2', array(':pk' => $compPK))
                ->asArray();
        if (!empty($searchTxt) && $searchTxt != null) {
            $query->andFilterWhere(['or', ['like', 'cmsch_contracttitle', $searchTxt], ['like', 'cmsch_uid', $searchTxt], ['like', 'cmsch_contractrefno', $searchTxt]]);
        }
        if (!empty($dataType) && $dataType != null) {
            $query->andFilterWhere(['IN', 'crfd_rqprocesstype', explode(',', $dataType)]);
        }
        if (!empty($successFeeType) && $successFeeType != null) {
            $query->andFilterWhere(['IN', 'mcpid_pymtstatus', explode(',', $successFeeType)]);
        }
        if (!empty($awardFilter) && $awardFilter != null) {
            $query->andWhere('cmsch_createdon is not null');
        }
        if (!empty($listStatus) && $listStatus != null) {
            $query->andFilterWhere(['IN', 'cmsch_contractstatus', explode(',', $listStatus)]);
        }
        if (!empty($procurementType) && $procurementType != null) {
            $query->andFilterWhere(['IN', 'crfd_rqtype', explode(',', $procurementType)]);
        }
        if (!empty($awardType) && $awardType != null) {
            $query->andFilterWhere(['IN', 'cmsch_type', explode(',', $awardType)]);
        }
        if (!empty($classification) && $classification != null) {
            $query->andFilterWhere(['IN', 'cmsad_classification', explode(',', $classification)]);
        }
        if (!empty($subContract) && $subContract != null) {
            $query->andFilterWhere(['IN', 'cmsch_issubcontrqmt', explode(',', $subContract)]);
        }
        if (!empty($eTendering) && $eTendering != null) {
            $query->andFilterWhere(['IN', 'cmsch_isetendmandate', explode(',', $eTendering)]);
        }
        if (!empty($supplierStatus) && $supplierStatus != null) {
            $supplierStatusArray = explode(',', $supplierStatus);
            if (in_array(1, $supplierStatusArray) && !in_array(2, $supplierStatusArray)) {
                $query->andFilterWhere(['is', 'cmsad_cmsnonjsrssupdtls_fk', null]);
            }
            if (in_array(2, $supplierStatusArray) && !in_array(1, $supplierStatusArray)) {
                $query->andFilterWhere(['is', 'cmsad_memcompmst_fk', null]);
            }
        }
        if (!empty($specialStatus) && $specialStatus != null) {
            $query->andFilterWhere(['not', 'mclch_lcccerton', null]);
        }
        if (!empty($obligation) && $obligation != null) {
            $query->andFilterWhere(['IN', 'cmsch_obligation', explode(',', $obligation)]);
            $obligationArray = explode(',', $obligation);
            if (!empty($percentage) && $percentage != null) {
                if (in_array(1, $obligationArray) && !in_array(3, $obligationArray)) {
                    $query->andFilterWhere(['like', 'cmsch_msmepercent', $percentage]);
                }
                if (in_array(2, $obligationArray) && !in_array(3, $obligationArray)) {
                    $query->andFilterWhere(['like', 'cmsch_lccpercent', $percentage]);
                }
                if (in_array(3, $obligationArray)) {
                    $query->andFilterWhere(['or', ['like', 'cmsch_msmepercent', $percentage], ['like', 'cmsch_lccpercent', $percentage]]);
                }
            }
        }
        if (!empty($operatorBuyer) && $operatorBuyer != null) {
            $query->andFilterWhere(['IN', 'mclch_lcctype', explode(',', $operatorBuyer)]);
        }
        if (!empty($country) && $country != null) {
            $query->andFilterWhere(['IN', 'MCM_Source_CountryMst_Fk', explode(',', $country)]);
        }
        if (!empty($countryNon) && $countryNon != null) {
            $query->andFilterWhere(['IN', 'cmsnjsd_countrymst_fk', explode(',', $countryNon)]);
        }
        if (!empty($awardedStartDate) && $awardedStartDate != null && !empty($awardedEndDate) && $awardedEndDate != null) {
            $query->andFilterWhere(['between', 'cmsad_awardedon', $awardedStartDate, $awardedEndDate]);
        }
        if (!empty($startStartDate) && $startStartDate != null && !empty($startEndDate) && $startEndDate != null) {
            $query->andFilterWhere(['between', 'cmsch_contractstartdate', $closingStarDate, $startEndDate]);
        }
        if (!empty($closingStarDate) && $closingStarDate != null && !empty($closingEndDate) && $closingEndDate != null) {
            $query->andFilterWhere(['between', 'cmsch_contractenddate', $closingStarDate, $closingEndDate]);
        }
        if (!empty($valueStart) && $valueStart != null && !empty($valueEnd) && $valueEnd != null) {
            $query->andFilterWhere(['between', 'cmsch_contractvalue', $valueStart, $valueEnd]);
        }
        if (!empty($awardedto) && $awardedto != null) {
            $query->andFilterWhere(['or', ['IN', 'cmsad_memcompmst_fk', explode(',', $awardedto)]]);
        }
        if (!empty($awardedNonJSRS) && $awardedNonJSRS != null) {
            $query->andFilterWhere(['or', ['IN', 'cmsad_cmsnonjsrssupmap_fk', explode(',', $awardedNonJSRS)]]);
        }
        if ($sortpk == 1) {
            $query->orderBy([new \yii\db\Expression("coalesce(cmsch_updatedon,cmsch_createdon) DESC")]);
        } else {
            $query->orderBy([new \yii\db\Expression("coalesce(cmsch_updatedon,cmsch_createdon) ASC")]);
        }
        $query->groupBy("cmscontracthdr_pk");
        $page = (!empty($size)) ? $size : 10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        $finalData = [];
        foreach ($provider->getModels() as $listData) {
            $listData['awardedList'] = [];
            $listData['companylogo'] = null;
            if ($listData['cmscontracthdr_pk'] != NULL && !empty($listData['cmscontracthdr_pk'])) {
                $dataGet = CmsawarddtlsTblQuery::getAwardedtoArray($listData['cmscontracthdr_pk']);
                $listData['awardedList'] = $dataGet['moduleData'];
                $SubCount = self::getSubConut($listData['cmscontracthdr_pk']);
                $listData['subContract'] = $SubCount['subContract'];
                $listData['subOrder'] = $SubCount['subOrder'];
            } else {
                $listData['awardedList'] = [];
                $listData['subContract'] = null;
                $listData['subOrder'] = null;
            }
            if ($listData['cmsch_type'] != NULL && !empty($listData['cmsch_type']) && $listData['cmsch_type'] == 3) {
                $agreementCount = self::getAgreementCount($listData['cmscontracthdr_pk']);
                $listData['noOfAwards'] = $agreementCount['noOfAwards'];
                $listData['awardedValue'] = $agreementCount['awardedValue'];
            } else {
                $listData['noOfAwards'] = null;
                $listData['awardedValue'] = null;
            }
            if (!empty($listData['companyFile'])) {
                $listData['companylogo'] = \common\components\Drive::generateUrl($listData['companyFile'], $listData['CompPk'], $userPK);
            } else {
                $listData['companylogo'] = null;
            }

            $dataName = \common\components\Security::encrypt($listData['mcid_invoicepath']);
            $compPK = \common\components\Security::encrypt($listData['mcid_membercompmst_fk']);
            if (!empty($dataName) && !empty($compPK)) {
                $model['invoiceUrl'] = \Yii::$app->urlManager->createAbsoluteUrl(['/pms/pms/downloadinvoice?dataVal=' . $dataName . '&cpk=' . $compPK]);
            } else {
                $model['invoiceUrl'] = 'javascript:void(0)';
            }
            if (!empty($model['mcid_membercompmst_fk']) && !empty($model['memcomppymtrcptdtls_pk'])) {
                $model['paymentreceipt'] = \Yii::$app->urlManager->createAbsoluteUrl(['/pms/pms/downloadreceipt?cpk=' . $listData['mcid_membercompmst_fk'] . '&rpk=' . $listData['memcomppymtrcptdtls_pk']]);
            } else {
                $model['paymentreceipt'] = 'javascript:void(0)';
            }
            if (!empty($listData['jsrsOrigin'])) {
                $listData['Origin'] = $listData['jsrsOrigin'];
            } elseif (!empty($model['nonJsrsOrigin'])) {
                $listData['Origin'] = $listData['nonJsrsOrigin'] == 31 ? 'N' : 'I';
            }
            $finalData[] = $listData;
        }
        return [
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'items' => $finalData ? $finalData : [],
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
        ];
    }

    public static function getstatistics($compk = '') {
        if (!empty($compk)) {
            $compPK = $compk;
        } else {
            $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
//        and 
        $model = CmscontracthdrTbl::find()
                ->select(['count(if(cmsch_type = 1, 1, null)) as totalContract', 'count(if(cmsch_type = 2, 1, null)) as totalPO', 'count(if(cmsch_type = 3, 1, null)) as totalCallOfContract', 'count(*) as allData', 'count(if(cmsawarddtls_pk is not null and cmsch_createdon is not null, cmsawarddtls_pk, null)) as totalAwarded'])
                ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1 and cmsad_isdeactivated = 0')
                ->where('cmsch_memcompmst_fk=:pk and cmsch_isdeleted = 2', array(':pk' => $compPK))
                ->groupBy("cmsch_memcompmst_fk")
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'returndata' => $model ? $model : [],
        );
        return $result;
    }

    public function getViewContractsData($contractPk) {
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $model = CmscontracthdrTbl::find()
                ->select(['crfd_rqid', 'crfd_tenderstatus','cmsrequisitionformdtls_pk', 'crfd_rqtitle', 'crfd_rqprocesstype', 'crfd_rqrefno', 'crfd_rqpriority', 'initiatedby.um_firstname as initiatedUser', 'initiatedby.UM_EmpId as initiatedEmpId', 'requester.um_firstname as requesteruserName', 'requester.UM_EmpId as requesterEmpId', 'DM_Name', 'prjd_projname', 'prjd_referenceno', 'projectdtls_pk', 'prjd_projectid', 'prjd_projstatus', 'prjd_projstage','cmsth_uid', 'cmsth_refno', 'cmsth_title', 'cmsth_csenddate', 'cmsth_tenderstatus', 'cmsth_skdclosedate', 'cmsth_type','crfd_rqtype', 'cmscontracthdr_tbl.cmsch_contracttype as cmsch_contracttype', 'cmscontracthdr_tbl.cmsch_uid as cmsch_uid', 'cmscontracthdr_tbl.cmsch_contracttitle as cmsch_contracttitle', 'cmscontracthdr_tbl.cmsch_contractrefno as cmsch_contractrefno', 'cmscontracthdr_tbl.cmsch_contractdate as cmsch_contractdate', 'cmscontracthdr_tbl.cmsch_initiatedby as cmsch_initiatedby', 'cmscontracthdr_tbl.cmsch_initiateddate as cmsch_initiateddate', 'cmscontracthdr_tbl.cmsch_cmstenderhdr_fk as cmsch_cmstenderhdr_fk', 'cmscontracthdr_tbl.cmscontracthdr_pk as cmscontracthdr_pk', 'cmscontracthdr_tbl.cmsch_config_usermst_fk as cmsch_config_usermst_fk', 'cmscontracthdr_tbl.cmsch_issubcontrqmt as cmsch_issubcontrqmt', 'cmscontracthdr_tbl.cmsch_obligation as cmsch_obligation', 'cmscontracthdr_tbl.cmsch_msmepercent as cmsch_msmepercent', 'cmscontracthdr_tbl.cmsch_lccpercent as cmsch_lccpercent', 'cmscontracthdr_tbl.cmsch_obligationscope as cmsch_obligationscope', 'cmscontracthdr_tbl.cmsch_isetendmandate as cmsch_isetendmandate', 'cmscontracthdr_tbl.cmsch_contact_usermst_fk as cmsch_contact_usermst_fk', 'cmscontracthdr_tbl.cmsch_skdtype as cmsch_skdtype', 'cmscontracthdr_tbl.cmsch_skdsubmiton as cmsch_skdsubmiton', 'cmscontracthdr_tbl.cmsch_skd_timezone_fk as cmsch_skd_timezone_fk', 'cmscontracthdr_tbl.cmsch_supdocremarks as cmsch_supdocremarks', 'cmscontracthdr_tbl.cmsch_contractenddate as cmsch_contractenddate', 'CurM_CurrencyName_en', 'CurM_CurrSymbol', 'cmscontracthdr_tbl.cmsch_contractvalue as cmsch_contractvalue', 'cmscontracthdr_tbl.cmsch_contractdesc as cmsch_contractdesc', 'cmscontracthdr_tbl.cmsch_contractactualvalue as cmsch_contractactualvalue', 'cmscontracthdr_tbl.cmsch_invoiceinterval as cmsch_invoiceinterval', 'cmscontracthdr_tbl.cmsch_invoiceintervaltype as cmsch_invoiceintervaltype', 'crfd_rqdate', 'cmscontracthdr_tbl.cmsch_cmsquotationhdr_fk as cmsch_cmsquotationhdr_fk', 'cmscontracthdr_tbl.cmsch_scopeofwork as cmsch_scopeofwork', 'cmscontracthdr_tbl.cmsch_contractstartdate as cmsch_contractstartdate', 'cmscontracthdr_tbl.cmsch_contractenddate as cmsch_contractenddate', 'cmscontracthdr_tbl.cmsch_shared_agreefk as cmsch_shared_agreefk', 'cmscontracthdr_tbl.cmsch_shared_agreetype as cmsch_shared_agreetype', 'cmscontracthdr_tbl.cmsch_type as cmsch_type', 'crfd_rqstatus', 'mrm_contractsalone', 'crfd_cmscontracthdr_fk','cmscontracthdr_tbl.cmsch_icvcommitmentvalue as cmsch_icvcommitmentvalue','cmscontracthdr_tbl.cmsch_icvfileupload as cmsch_icvfileupload','cmscontracthdr_tbl.cmsch_icvpercent as cmsch_icvpercent', 'cmscontracthdr_tbl.cmsch_cmscontracthdr_fk as cmsch_cmscontracthdr_fk', 'cmscontracthdr_tbl.cmsch_contractstatus as cmsch_contractstatus', 'awardBy.MemberCompMst_Pk as createdByComPk', 'awardBy.MCM_CompanyName as awardByCompanyName', 'awardTo.MCM_CompanyName as awardToCompanyName', 'jdomoduledtl_pk as jdoCardPk', 'awardBy.MCM_MemberRegMst_Fk as awardByMemRegPk', 'cmsad_memcompmst_fk as awardToComPk', 'cmscontracthdr_tbl.cmsch_memcompmst_fk as awardByComPk', 'mcid_invoicestatus', 'createdBy.um_firstname as creator', 'cmscontracthdr_tbl.cmsch_createdon as cmsch_createdon', 'cmscontracthdr_tbl.cmsch_updatedon as cmsch_updatedon', 'updatedBy.um_firstname as updatedBy', 'cmscontracthdr_tbl.cmsch_updatedby as cmsch_updatedby', 'cmscontracthdr_tbl.cmsch_level as cmsch_level', 'cmsth_icv_startyear as startyear', 'cmsth_icv_startquarter as startquarter', 'cmsth_icv_endyear as endyear', 'cmsth_icv_endquarter as endquarter', 'cmsad_createdby', 'prjd_projimg_fk', 'mcid_invoiceamount', 'awardTo.MCM_Origin as jsrsOrigin', 'cmsnjsd_countrymst_fk as nonJsrsOrigin', "DATE_FORMAT(mcid_generatedon,'%d-%m-%Y') AS generatedon", 'mcid_membercompmst_fk', 'mcid_invoicepath', 'cmsad_cmsnonjsrssupmap_fk', "DATE_FORMAT(mcpr_createdon,'%d-%m-%Y') AS reciptData", 'memcomppymtrcptdtls_pk', 'cmsad_justifydocupload', 'cmsad_justifycomment',new \yii\db\Expression("substring_index(substring_index(group_concat(`mcpid_pymtstatus` order by memcomppymtinfodtls_pk desc separator '***'),'***',1),'***',-(1)) as mcpid_pymtstatus"),
                    "ROUND(SUM(IF(cmscontracthdr_tbl.cmsch_currencymst_fk = 3, cmscontracthdr_tbl.cmsch_contractvalue * 2.60080, cmscontracthdr_tbl.cmsch_contractvalue)),2) as 'contractValueUSD'",
                    "ROUND(SUM(IF(cmscontracthdr_tbl.cmsch_currencymst_fk = 21, cmscontracthdr_tbl.cmsch_contractvalue / 2.60080, cmscontracthdr_tbl.cmsch_contractvalue)),3) as 'contractValueOMR'",
                    "ROUND(SUM(IF(cmscontracthdr_tbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt)),2) as 'awardAmtUSD'",
                    "ROUND(SUM(IF(cmscontracthdr_tbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt)),3) as 'awardAmtOMR'",'memcompinvoicedtls_pk',
                    'headCon.cmsch_contracttitle as dataTitle','headCon.cmsch_uid as dataId','headCon.cmsch_contractrefno as dataRef','headCon.cmsch_contractstatus as dataStatus','prsm_projstage as proStatus',"IF(headCon.cmsch_type = 1 and headCon.cmsch_contracttype = 1, 'Contract', IF(headCon.cmsch_type = 1 and headCon.cmsch_contracttype = 2, 'Subcontract',IF(headCon.cmsch_type = 2 and headCon.cmsch_contracttype = 1, 'Purchase Order',IF(headCon.cmsch_type = 2 and headCon.cmsch_contracttype = 2, 'Suborder', 'Agreement')))) as 'dataType'"])
                ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                ->leftJoin('jdomoduledtl_tbl', 'cmscontracthdr_tbl.cmscontracthdr_pk = jdmd_shared_fk and jdmd_shared_type = 2')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmscontracthdr_tbl.cmsch_cmsrequisitionformdtls_fk')
                ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
                ->leftJoin('cmscontracthdr_tbl as headCon', 'headCon.cmscontracthdr_pk = crfd_cmscontracthdr_fk')
                ->leftJoin('projstagemst_tbl', 'projstagemst_pk = prjd_projstage')
                ->leftJoin('usermst_tbl as requester', 'requester.UserMst_Pk = crfd_requester')
                ->leftJoin('usermst_tbl as initiatedby', 'initiatedby.UserMst_Pk = cmscontracthdr_tbl.cmsch_initiatedby')
                ->leftJoin('usermst_tbl as createdBy', 'createdBy.UserMst_Pk = cmsad_createdby')
                ->leftJoin('usermst_tbl as updatedBy', 'updatedBy.UserMst_Pk = cmscontracthdr_tbl.cmsch_updatedby')
                ->leftJoin('membercompanymst_tbl as awardBy', 'awardBy.MemberCompMst_Pk = cmscontracthdr_tbl.cmsch_memcompmst_fk')
                ->leftJoin('membercompanymst_tbl as awardTo', 'awardTo.MemberCompMst_Pk = cmsad_memcompmst_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk = cmsad_cmsnonjsrssupmap_fk')
                ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
                ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = crfd_departmentmst_fk')
                ->leftJoin('currencymst_tbl', 'CurrencyMst_Pk = cmscontracthdr_tbl.cmsch_currencymst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = prjd_memberregmst_fk')
                ->leftJoin('memcompinvoicedtls_tbl', 'mcid_membercompmst_fk = cmsad_memcompmst_fk and mcid_shared_fk = cmscontracthdr_tbl.cmscontracthdr_pk and mcid_basemodulemst_fk = 131 and mcid_module = 4')
                ->leftJoin('memcomppymtinfodtls_tbl', 'mcpid_memcompinvoicedtls_fk = memcompinvoicedtls_pk')
                ->leftJoin('memcomppymtrcptdtls_tbl', 'mcpr_memcompinvoicedtls_fk = memcompinvoicedtls_pk')
                ->leftJoin('cmstenderhdr_tbl', 'cmstenderhdr_pk = cmscontracthdr_tbl.cmsch_cmstenderhdr_fk')
                ->where('cmscontracthdr_tbl.cmscontracthdr_pk=:conPK', array(':conPK' => $contractPk))
                ->asArray()
                ->one();
        if (!empty($model['cmscontracthdr_pk'])) {
            $awardedList = CmsawarddtlsTblQuery::getAwardedtoArray($model['cmscontracthdr_pk']);
            $currentLoginChk = false;
            if (!empty($awardedList['moduleData'])) {
                foreach ($awardedList['moduleData'] as $dataVal) {
                    if ($dataVal['cmsad_memcompmst_fk'] == $compPK) {
                        $currentLoginChk = true;
                    }
                }
            }
            if (!empty($model['jsrsOrigin'])) {
                $model['Origin'] = $model['jsrsOrigin'];
            } elseif (!empty($model['nonJsrsOrigin'])) {
                $model['Origin'] = $model['nonJsrsOrigin'] == 31 ? 'N' : 'I';
            }
            if ($currentLoginChk == true) {
                $model['viewType'] = 'CA';
            } elseif ($model['createdByComPk'] == $compPK) {
                $model['viewType'] = 'CO';
            } else {
                $model['viewType'] = 'CM';
            }
            if (!empty($model['awardToComPk']) && $model['awardToComPk'] != $compPK) {
                $model['awardToShow'] = 1;
            } else {
                $model['awardToShow'] = 0;
            }
            if (!empty($model['awardByComPk']) && $model['awardByComPk'] != $compPK) {
                $model['awardByShow'] = 1;
            } else {
                $model['awardByShow'] = 0;
            }
        }
        $dataName = \common\components\Security::encrypt($model['mcid_invoicepath']);
        $compPK = \common\components\Security::encrypt($model['mcid_membercompmst_fk']);
        if (!empty($dataName) && !empty($compPK)) {
            $model['invoiceUrl'] = \Yii::$app->urlManager->createAbsoluteUrl(['/pms/pms/downloadinvoice?dataVal=' . $dataName . '&cpk=' . $compPK]);
        } else {
            $model['invoiceUrl'] = 'javascript:void(0)';
        }
        if (!empty($model['cmsch_cmscontracthdr_fk'])) {
            $previewsContractData = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $model['cmsch_cmscontracthdr_fk']])->one();
            $model['previewsCompPk'] = $previewsContractData->cmsch_memcompmst_fk;
        } else {
            $model['previewsCompPk'] = null;
        }
        if (!empty($model['mcid_membercompmst_fk']) && !empty($model['memcomppymtrcptdtls_pk'])) {
            $model['paymentreceipt'] = \Yii::$app->urlManager->createAbsoluteUrl(['/pms/pms/downloadreceipt?cpk=' . $model['mcid_membercompmst_fk'] . '&rpk=' . $model['memcomppymtrcptdtls_pk']]);
        } else {
            $model['paymentreceipt'] = 'javascript:void(0)';
        }
        $model['cmsch_contractdesc'] = strip_tags($model['cmsch_contractdesc']);
        if (!empty($model['cmsch_contact_usermst_fk']) && $model['cmsch_contact_usermst_fk'] != null) {
            $model['contactUserlist'] = \common\models\UsermstTblQuery::getUserlistData($model['cmsch_contact_usermst_fk']);
        } else {
            $model['contactUserlist'] = [];
        }
        if ($model['prjd_projimg_fk'] != null && $model['prjd_projimg_fk'] != 0) {
            $model['imgUrl'] = Drive::generateUrl($model['prjd_projimg_fk'], $model['cmsth_memcompmst_fk'], $model['prjd_submittedby']);
        } else {
            $model['imgUrl'] = 'assets/images/lypis_noimg.svg';
        }
        $icvfiles = !empty($model['cmsch_icvfileupload']) ? explode(',', $model['cmsch_icvfileupload']) : [];
        //print_r($icvfiles);die();
        $filedoc = [];
        if(count($icvfiles) > 0) {
            foreach ($icvfiles as $key => $value) {
                $filedoc[$key]['icvFileURL'] = Drive::generateUrl($value, $compPK, $userPK);
                $filedoc[$key]['icvFileName'] = Drive::getFileName(\common\components\Security::encrypt($value));
                $filedoc[$key]['fileType'] = Drive::getFileType(\common\components\Security::encrypt($value));
                $fileDetails = Drive::getfiledetails($value, $compPK);
                //print_r($fileDetails);die();
                if(is_array($fileDetails)) {
                    $filedoc[$key]['docdate'] =  $fileDetails['mcfd_uploadedon'];
                    $filedoc[$key]['docsize'] =  $fileDetails['mcfd_actualfilesize'];
                    $filedoc[$key]['filePk'] =  $value;    
                }
            }
        }
        $model['icvFiles'] = $filedoc;
        if ($model['cmsad_justifydocupload'] != null && $model['cmsad_justifydocupload'] != 0) {
            $model['reasonFile'] = Drive::getfiledetails($model['cmsad_justifydocupload'], $model['cmsth_memcompmst_fk']);
        } else {
            $model['reasonFile'] = [];
        }
        if (!empty($model['cmsch_cmsquotationhdr_fk'])) {
            //print_r($model['cmsch_cmsquotationhdr_fk']);die();
            $data = \api\modules\icv\controllers\IcvController::actionIcvactualspenddataforoverview($model['cmsch_cmsquotationhdr_fk'],'','');
            //print_r($data);die();
            foreach ($data['items'] as $actualcommited_key => $actualcommited_value) {
                $model['commited_val'] += $actualcommited_value['plannedamt'];
                $model['actual_val'] += $actualcommited_value['actspendamt'];
            }
            if ($model['actual_val'] != 0) {
                $model['icv_percentage'] = ($model['commited_val'] / $model['actual_val'] ) * 100;
            } else {
                $model['icv_percentage'] = ($model['commited_val'] / 1 ) * 100;
            }
        } else {
            $model['commited_val'] = 0;
            $model['actual_val'] = 0;
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    public function generateInvoice($dataPk) {
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $date = date('Y-m-d H:i:s');
        $model = CmscontracthdrTbl::find()
                ->select(['crfd_rqtitle as tenderTitle', 'crfd_rqrefno as tenderRef', 'cmsch_contracttitle as contractTitle', 'cmsch_contractrefno as contractRef', 'compTo.MCM_CompanyName as jsrsCompanyName', 'cnjsm_orgname as nonJsrsCompanyName', 'compTo.mcm_vatinno as vatNo', 'cmsch_type as dataType', 'compTo.MCM_Origin as jsrsOrigin', 'compTo.mcm_complogo_memcompfiledtlsfk as companyFile', 'compTo.MemberCompMst_Pk as toCompPk', 'cmsad_classification as classification', 'compTo.MCM_SupplierCode as supplierCode', 'cmsnjsd_countrymst_fk as nonJsrsOrigin', 'compBy.MCM_CompanyName as byCompanyName', 'um_firstname as contactName', 'um_address as contactAddress', 'dsg_designationname as contactDesignation', 'UM_EmailID as contactEmail', 'um_primobno as contactMobileNo', 'mobileCC.CyM_CountryDialCode as contactDialCode', 'cnjsm_address as nonJsrsAddress', 'cnjsm_contactemail as nonJsrsEmail', 'cnjsm_contperson as nonJsrsName', 'cnjsm_designation as nonJsrsDesignation', 'cnjsm_contactmobilecc as nonJsrsMobilCC', 'cnjsm_contactmobile as nonJsrsMobile', 'cmsch_contractvalue', 'nonJsrsCounty.CyM_CountryName_en as nonJsrsCountryname', 'jsrsCountry.CyM_CountryName_en as jsrsCountryname', 'SM_StateName_en as jsrsStateName', 'CM_CityName_en as jsrsCityName', 'cmsch_contracttype','cmsch_currencymst_fk','cmsad_memcompmst_fk','mcmpld_address'])
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsch_cmsrequisitionformdtls_fk')
                ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                ->leftJoin('membercompanymst_tbl as compTo', 'compTo.MemberCompMst_Pk=cmsad_memcompmst_fk')
                ->leftJoin('membercompanymst_tbl as compBy', 'compBy.MemberCompMst_Pk=cmsch_memcompmst_fk')
                ->leftJoin('memcompmplocationdtls_tbl', 'mcmpld_membercompmst_fk=cmsad_memcompmst_fk and mcmpld_locationtype=1')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk = cmsad_cmsnonjsrssupmap_fk')
                ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
                ->leftJoin('usermst_tbl', 'UM_MemberRegMst_Fk=compTo.MCM_MemberRegMst_Fk and um_pymtcontact = 1')
                ->leftJoin('designationmst_tbl', 'designationmst_pk=UM_Designation')
                ->leftJoin('countrymst_tbl as mobileCC', 'mobileCC.CountryMst_Pk=um_primobnocc')
                ->leftJoin('countrymst_tbl as nonJsrsCounty', 'nonJsrsCounty.CountryMst_Pk=cmsnjsd_countrymst_fk')
                ->leftJoin('countrymst_tbl as jsrsCountry', 'jsrsCountry.CountryMst_Pk=um_countrymst_fk')
                ->leftJoin('statemst_tbl', 'StateMst_Pk=um_statemst_fk')
                ->leftJoin('citymst_tbl', 'CityMst_Pk=um_citymst_fk')
                ->where('cmscontracthdr_pk=:conPK', array(':conPK' => $dataPk))
                ->asArray()
                ->one();     
        if (!empty($model['jsrsOrigin'])) {
            $model['Origin'] = $model['jsrsOrigin'];
        } elseif (!empty($model['nonJsrsOrigin'])) {
            $model['Origin'] = $model['nonJsrsOrigin'] == 31 ? 'N' : 'I';
        }
        $OMR = 2.60080;
        if ($model['cmsch_currencymst_fk'] == 3) {
            $finalAmt = round($model['cmsch_contractvalue'] * $OMR, 2, PHP_ROUND_HALF_UP);
        } else {
            $finalAmt = round($model['cmsch_contractvalue'] ,2, PHP_ROUND_HALF_UP);
        }
        $totalamount = (1 / 100) * $finalAmt;
        $totalOMRamount = ($totalamount / $OMR);
        $Omramount = round($totalOMRamount, 3, PHP_ROUND_HALF_UP);
        if ($Omramount < 50) {
            $Omramount = 50;
        } else if ($Omramount > 500) {
            $Omramount = 500;
        }
        $roundedValue = $Omramount;
        if ($model['Origin'] == 'I') {
            $roundedValue = Common::getusdbyomr($roundedValue);
            $vat_percent = \Yii::$app->params['VAT']['Intl_vatpercent'];
            $vat_amount = Common::getVATAmount($roundedValue, $vat_percent);
        } else {
            $vat_percent = \Yii::$app->params['VAT']['Nat_vatpercent'];
            $vat_amount = Common::getVATAmount($roundedValue, $vat_percent);
        }
        if (!empty($model['companyFile'])) {
            $model['companylogo'] = \common\components\Drive::generateUrl($model['companyFile'], $model['toCompPk'], $userPK);
        } else {
            $model['companylogo'] = "";
        }
        $toCompPk=$model['cmsad_memcompmst_fk'];
        $path = dirname(__FILE__) . "/../../../../api/web/generated/invoice/cms/$toCompPk/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $InvoiceModel = \common\models\MemcompinvoicedtlsTbl::find()->where("mcid_shared_fk =:pk and mcid_basemodulemst_fk = 131 and mcid_membercompmst_fk = :compPk", [':pk' => $dataPk, ':compPk' => $toCompPk])->one();
        $generatedonDate = $date;
        $invoice_refno = Common::generateInvoiceNo('INV', 'INV');
        $inv_name = Common::getInvoiceName($invoice_refno, $generatedonDate);
        if (empty($InvoiceModel)) {
            $InvoiceModel = new \common\models\MemcompinvoicedtlsTbl;
            $InvoiceModel->mcid_membercompmst_fk = $toCompPk;
            $InvoiceModel->mcid_basemodulemst_fk = 131;
            $InvoiceModel->mcid_module = 4;
            $InvoiceModel->mcid_shared_fk = $dataPk;
            $InvoiceModel->mcid_invoicestatus = 'G';
        }
        $InvoiceModel->mcid_invoiceno = $invoice_refno;
        $InvoiceModel->mcid_invoicepath = $inv_name;
        $InvoiceModel->mcid_invoiceamount = str_replace(',', '', $roundedValue);
        $InvoiceModel->mcid_vatpercent = $vat_percent;
        $InvoiceModel->mcid_vatamount = str_replace(',', '', $vat_amount);
        $InvoiceModel->mcid_generatedon = $generatedonDate;
        $InvoiceModel->save();
        $model['invoiceNo'] = $InvoiceModel->mcid_invoiceno;
        $model['invoiceDate'] = $InvoiceModel->mcid_generatedon;
        $model['amount'] = $InvoiceModel->mcid_invoiceamount;
        $model['vatPercent'] = $InvoiceModel->mcid_vatpercent;
        $model['vatAamount'] = $InvoiceModel->mcid_vatamount;
        Common::updateInvoiceNo('INV');
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_left' => '5', 'margin_right' => '5', 'margin_top' => '10',
            'margin_bottom' => '10', 'margin_header' => '0', 'margin_footer' => '0', 'default_font_size' => '', 'orientation' => 'P', 'default_font' => 'cairoregular']);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->SetWatermarkImage('http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png', .1, 1, 200, '', '', '', true, true);
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML(\Yii::$app->controller->renderPartial('invoice', ['invoiceDtls' => $model]));
        $mpdf->Output("../api/web/generated/invoice/cms/" . $toCompPk . "/" . $inv_name, 'F');
        $dataName = \common\components\Security::encrypt($InvoiceModel->mcid_invoicepath);
        $compPK = \common\components\Security::encrypt($InvoiceModel->mcid_membercompmst_fk);
        $viewlink = \Yii::$app->urlManager->createAbsoluteUrl(['/pms/pms/viewinvoice?dataVal=' . $dataName . '&cpk=' . $compPK]);
        $downloadLink = \Yii::$app->urlManager->createAbsoluteUrl(['/pms/pms/downloadinvoice?dataVal=' . $dataName . '&cpk=' . $compPK]);
        self::sendInvoiceMail($model, $viewlink, $downloadLink);
        return true;
    }

    public function sendInvoiceMail($data, $viewlink, $downloadLink) {
        $name = (!empty($data['jsrsCompanyName']) ? $data['jsrsCo$downloadLinkmpanyName'] : $data['nonJsrsCompanyName']);
        $content = "Hi $name, <br> Please find your invoice attachemnt. <br> Kindly use the below link to view the invoice <br><a href='$viewlink' target='_blank'>Click Here </a><br><a href='$downloadLink' target='_blank'>Click Here Download Invoice</a> <br>  Thanks,<br>" . $data['byCompanyName'];
        return \Yii::$app->mailer->compose()
                        ->setFrom('noreply@businessgateways.com')
                        ->setTo(\Yii::$app->params['testMailIDs'])
                        ->setSubject('Invoice Generated')
                        ->setHTMLBody($content)
                        ->send();
    }

    public static function getCmsEngagements($compk = '') {
        if (!empty($compk)) {
            $compPK = $compk;
        } else {
            $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
//        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $model = CmscontracthdrTbl::find()
                ->select(['count(cmsawarddtls_pk) as totalAwarded'])
                ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                ->where('cmsch_memcompmst_fk=:pk', array(':pk' => $compPK))
                ->groupBy("cmsch_memcompmst_fk")
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'received' => 150,
            'responded' => 50,
            'bidsSubmitted' => 40,
            'awardcontvalue' => "35,000,000",
            'awarded' => $model['totalAwarded'],
        );
        return $result;
    }

    public static function getAgreementCount($agreementPk) {
        $model = CmscontracthdrTbl::find()
                ->select(['count(cmsawarddtls_pk) as noOfAwards', 'sum(cmsad_awardamt) as awardedValue'])
                ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                ->where('cmsch_shared_agreefk=:pk', array(':pk' => $agreementPk))
                ->andWhere(['<>', 'cmsch_type', 3])
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'noOfAwards' => $model['noOfAwards'],
            'awardedValue' => $model['awardedValue'],
        );
        return $result;
    }

    public static function getContractBasedTenderCount($contractPk) {
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $model = CmsrequisitionformdtlsTbl::find()
                ->select(['count(cmsrequisitionformdtls_pk) as tendercount'])
                ->where('crfd_memcompmst_fk=:compk and crfd_cmscontracthdr_fk=:pk and crfd_type= 3 and crfd_isdeleted = 2', array(':pk' => $contractPk, ':compk' => $company_id))
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'tendercount' => $model['tendercount'],
        );
        return $result;
    }

    public static function getSubCountData($dataPk) {
        $mandatorysql = "select count(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 1, 1, null)) as 'sub_contract', count(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 2, 1, null)) as 'sub_order', sum(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 1, cmssch.cmsch_contractvalue, null)) as 'sc_value', sum(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 2, cmssch.cmsch_contractvalue, null)) as 'so_value', count(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 1 and cmssch.cmsch_contractstatus = 1, 1, null)) as 'sc_active', count(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 1 and cmssch.cmsch_contractstatus = 3, 1, null)) as 'sc_terminated', count(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 1 and cmssch.cmsch_contractstatus = 4, 1, null)) as 'sc_suspended', count(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 1 and cmssch.cmsch_contractstatus = 7, 1, null)) as 'sc_completed', count(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 2 and cmssch.cmsch_contractstatus = 1, 1, null)) as 'so_active', count(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 2 and cmssch.cmsch_contractstatus = 3, 1, null)) as 'so_terminated', count(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 2 and cmssch.cmsch_contractstatus = 4, 1, null)) as 'so_suspended', count(if(cmssch.cmsch_contracttype = 2 and cmssch.cmsch_type = 2 and cmssch.cmsch_contractstatus = 7, 1, null)) as 'so_completed' from  cmscontracthdr_tbl as cmsch join cmscontracthdr_tbl as cmssch on cmsch.cmscontracthdr_pk = cmssch.cmsch_cmscontracthdr_fk and cmssch.cmsch_isdeleted = 2 where cmsch.cmscontracthdr_pk = {$dataPk}";
        $model = Yii::$app->db->createCommand($mandatorysql)->queryOne();
        $scFinal = [];
        $soFinal = [];
        if (!empty($model)) {
            $totalValSC = $model['sc_active'] + $model['sc_completed'] + $model['sc_suspended'] + $model['sc_terminated'];
            $totalValSO = $model['so_active'] + $model['so_completed'] + $model['so_suspended'] + $model['so_terminated'];
            if ($totalValSC != 0) {
                $scFinal = [['name' => 'Suspended', 'count' => $model['sc_suspended'], 'y' => ($model['sc_suspended'] / $totalValSC) * 100, 'color' => '#68afff'],
                    ['name' => 'Active', 'count' => $model['sc_active'], 'y' => ($model['sc_active'] / $totalValSC) * 100, 'color' => '#f5a623'],
                    ['name' => 'Compleated', 'count' => $model['sc_completed'], 'y' => ($model['sc_completed'] / $totalValSC) * 100, 'color' => '#71c016'],
                    ['name' => 'Terminated', 'count' => $model['sc_terminated'], 'y' => ($model['sc_terminated'] / $totalValSC) * 100, 'color' => '#ff4747']];
            }
            if ($totalValSO != 0) {
                $soFinal = [['name' => 'Suspended', 'count' => $model['so_suspended'], 'y' => ($model['so_suspended'] / $totalValSO) * 100, 'color' => '#68afff'],
                    ['name' => 'Active', 'count' => $model['so_active'], 'y' => ($model['so_active'] / $totalValSO) * 100, 'color' => '#f5a623'],
                    ['name' => 'Compleated', 'count' => $model['so_completed'], 'y' => ($model['so_completed'] / $totalValSO) * 100, 'color' => '#71c016'],
                    ['name' => 'Terminated', 'count' => $model['so_terminated'], 'y' => ($model['so_terminated'] / $totalValSO) * 100, 'color' => '#ff4747']];
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'scChart' => $scFinal,
            'soChart' => $soFinal,
            'sc_value' => $model['sc_value'] ? $model['sc_value'] : 0,
            'so_value' => $model['so_value'] ? $model['so_value'] : 0,
            'sub_contract' => $model['sub_contract'],
            'sub_order' => $model['sub_order'],
        );
        return $result;
    }

    public static function getContractorData($dataPk, $dataType) {
        $obligatedContractors = CmscontracthdrTbl::find()
                ->select(["cnjsm_orgname",
                    "MCM_CompanyName",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt)),2) as 'amtUSD'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt)),3) as 'amtOMR'",
                    'cmsawarddtls_pk',
                    'cmsad_cmscontracthdr_fk',
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsch_contractactualvalue * 2.60080, cmsch_contractactualvalue)),2) as 'spendUSD'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsch_contractactualvalue / 2.60080, cmsch_contractactualvalue)),3) as 'spendOMR'",
                ])
                ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsad_memcompmst_fk')
                ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk = cmsad_cmsnonjsrssupmap_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cnjsm_cmsnonjsrssupdtls_fk = cmsnonjsrssupdtls_pk')
                ->where('cmsch_cmscontracthdr_fk=:pk and cmsch_obligation != 5 and cmsch_isdeleted = 2 and cmsch_createdon is not null and cmsad_awardamt is not null', array(':pk' => $dataPk))
                ->groupBy('MemberCompMst_Pk', 'cmsnonjsrssupdtls_pk')
                ->asArray()
                ->all();
        $classificationContract = CmscontracthdrTbl::find()
                ->select(["count(if(cmsad_classification = 1, 1,null)) as 'MSME_Micro'",
                    "count(if(cmsad_classification = 2,1, null)) as 'MSME_Small'",
                    "count(if(cmsad_classification = 3, 1,null)) as 'MSME_Medium'",
                    "count(if(cmsad_classification = 4, 1,null)) as 'Large'",
                    "count(if(cmsad_classification = 5, 1,null)) as 'International'",
                    "ROUND(SUM(if(cmsad_classification = 1, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'MSME_Micro_ValUSD'",
                    "ROUND(SUM(if(cmsad_classification = 1, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'MSME_Micro_ValOMR'",
                    "ROUND(SUM(if(cmsad_classification = 2, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'MSME_Small_ValUSD'",
                    "ROUND(SUM(if(cmsad_classification = 2, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'MSME_Small_ValOMR'",
                    "ROUND(SUM(if(cmsad_classification = 3, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'MSME_Medium_ValUSD'",
                    "ROUND(SUM(if(cmsad_classification = 3, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'MSME_Medium_ValOMR'",
                    "ROUND(SUM(if(cmsad_classification = 4, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'Large_ValUSD'",
                    "ROUND(SUM(if(cmsad_classification = 4, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'Large_ValOMR'",
                    "ROUND(SUM(if(cmsad_classification = 5, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'International_ValUSD'",
                    "ROUND(SUM(if(cmsad_classification = 5, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'International_ValOMR'",])
                ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                ->where('cmsch_cmscontracthdr_fk=:pk and cmsch_isdeleted = 2 and cmsch_createdon is not null and cmsad_awardamt is not null', array(':pk' => $dataPk))
                ->asArray()
                ->one();
        $obligatedFinal = [];
        foreach ($obligatedContractors as $dataVal) {
            if (($dataVal['MCM_CompanyName'] != null || $dataVal['cnjsm_orgname']) && !empty($dataVal['amtUSD'])) {
                $obligatedFinal[] = $dataVal;
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'obligatedContractors' => $obligatedFinal,
            'classificationContract' => $classificationContract,
        );
        return $result;
    }

    public static function getProjectBasedContractor($dataPk) {
        $contractors = CmsrequisitionformdtlsTbl::find()
                ->select(["cnjsm_orgname",
                    "MCM_CompanyName",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt)),2) as 'amtUSD'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt)),3) as 'amtOMR'",
                    'cmsawarddtls_pk', 'cmsad_cmscontracthdr_fk'])
                ->leftJoin('cmscontracthdr_tbl', 'cmsch_cmsrequisitionformdtls_fk = cmsrequisitionformdtls_pk')
                ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsad_memcompmst_fk')
                ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk = cmsad_cmsnonjsrssupmap_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cnjsm_cmsnonjsrssupdtls_fk = cmsnonjsrssupdtls_pk')
                ->where('crfd_projectdtls_fk=:pk and cmsch_isdeleted = 2 and cmsch_createdon is not null and cmsad_awardamt is not null', array(':pk' => $dataPk))
                ->groupBy('MemberCompMst_Pk', 'cmsnonjsrssupdtls_pk')
                ->asArray()
                ->all();
        $classificationContract = CmsrequisitionformdtlsTbl::find()
                ->select(["count(if(cmsad_classification = 1, 1,null)) as 'MSME_Micro'",
                    "count(if(cmsad_classification = 2,1, null)) as 'MSME_Small'",
                    "count(if(cmsad_classification = 3, 1,null)) as 'MSME_Medium'",
                    "count(if(cmsad_classification = 4, 1,null)) as 'Large'",
                    "count(if(cmsad_classification = 5, 1,null)) as 'International'",
                    "ROUND(SUM(if(cmsad_classification = 1, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'MSME_Micro_ValUSD'",
                    "ROUND(SUM(if(cmsad_classification = 1, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'MSME_Micro_ValOMR'",
                    "ROUND(SUM(if(cmsad_classification = 2, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'MSME_Small_ValUSD'",
                    "ROUND(SUM(if(cmsad_classification = 2, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'MSME_Small_ValOMR'",
                    "ROUND(SUM(if(cmsad_classification = 3, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'MSME_Medium_ValUSD'",
                    "ROUND(SUM(if(cmsad_classification = 3, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'MSME_Medium_ValOMR'",
                    "ROUND(SUM(if(cmsad_classification = 4, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'Large_ValUSD'",
                    "ROUND(SUM(if(cmsad_classification = 4, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'Large_ValOMR'",
                    "ROUND(SUM(if(cmsad_classification = 5, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'International_ValUSD'",
                    "ROUND(SUM(if(cmsad_classification = 5, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'International_ValOMR'",])
                ->leftJoin('cmscontracthdr_tbl', 'cmsch_cmsrequisitionformdtls_fk = cmsrequisitionformdtls_pk')
                ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                ->where('crfd_projectdtls_fk=:pk and cmsch_isdeleted = 2 and cmsch_createdon is not null and cmsad_awardamt is not null', array(':pk' => $dataPk))
                ->asArray()
                ->one();
        $contractorFinal = [];
        foreach ($contractors as $dataVal) {
            if ($dataVal['MCM_CompanyName'] != null || $dataVal['cnjsm_orgname']) {
                $contractorFinal[] = $dataVal;
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'contractors' => $contractorFinal,
            'classificationContract' => $classificationContract,
        );
        return $result;
    }

    public static function getAwardIssued($dataPk, $dataType) {
        if ($dataType == 1) {
            $totalAwards = CmscontracthdrTbl::find()
                    ->select([
                        "count(cmsawarddtls_pk) as awardsCount",
                        "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt)),2) as 'awardAmtUSD'",
                        "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt)),3) as 'awardAmtOMR'",
                        "count(if(cmsch_type = 1, 1,null)) as 'coCount'",
                        "ROUND(SUM(if(cmsch_type = 1, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coAmtUSD'",
                        "ROUND(SUM(if(cmsch_type = 1, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coAmtOMR'",
                        "count(if(cmsch_type = 2, 1,null)) as 'poCount'",
                        "ROUND(SUM(if(cmsch_type = 2, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poAmtUSD'",
                        "ROUND(SUM(if(cmsch_type = 2, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poAmtOMR'",
                        "count(if(cmsch_type = 3, 1,null)) as 'baCount'",
                        "ROUND(SUM(if(cmsch_type = 3, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baAmtUSD'",
                        "ROUND(SUM(if(cmsch_type = 3, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baAmtOMR'",
                        "count(if(cmsch_type = 1 and cmsch_obligation = 1 , 1,null)) as 'coMSMECount'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coMSMEValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coMSMEValueOMR'",
                        "count(if(cmsch_type = 3 and cmsch_obligation = 1 , 1,null)) as 'baMSMECount'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baMSMEValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baMSMEValueOMR'",
                        "count(if(cmsch_type = 1 and cmsch_obligation = 2 , 1,null)) as 'coLCCCount'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coLCCValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coLCCValueOMR'",
                        "count(if(cmsch_type = 3 and cmsch_obligation = 2 , 1,null)) as 'baLCCCount'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baLCCValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baLCCValueOMR'",
                        "count(if(cmsch_type = 1 and cmsch_obligation = 3 , 1,null)) as 'coAllCount'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coAllValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coAllValueOMR'",
                        "count(if(cmsch_type = 3 and cmsch_obligation = 3 , 1,null)) as 'baAllCount'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baAllValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baAllValueOMR'",
                        "count(if(cmsch_type = 2 and cmsch_obligation = 1 , 1,null)) as 'poMSMECount'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poMSMEValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poMSMEValueOMR'",
                        "count(if(cmsch_type = 2 and cmsch_obligation = 2 , 1,null)) as 'poLCCCount'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poLCCValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poLCCValueOMR'",
                        "count(if(cmsch_type = 2 and cmsch_obligation = 3 , 1,null)) as 'poAllCount'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poALLValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poALLValueOMR'",
                        "count(if(cmsch_type = 1 and cmsch_obligation = 5 , 1,null)) as 'coNonCount'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coNonValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coNonValueOMR'",
                        "count(if(cmsch_type = 3 and cmsch_obligation = 5 , 1,null)) as 'baNonCount'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baNonValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baNonValueOMR'",
                        "count(if(cmsch_type = 2 and cmsch_obligation = 5 , 1,null)) as 'poNonCount'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poNonValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poNonValueOMR'",
                        "count(if(cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3, 1,null)) as 'obligatedOverAllCount'",
                        "ROUND(SUM(if(cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllValueUSD'",
                        "ROUND(SUM(if(cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllValueOMR'",
                        "count(if(cmsch_obligation = 5 , 1,null)) as 'obligatedNonOverAllCount'",
                        "ROUND(SUM(if(cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedNonOverAllValueUSD'",
                        "ROUND(SUM(if(cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedNonOverAllValueOMR'",
                        "count(if(cmsch_type = 1 and (cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , 1,null)) as 'obligatedOverAllContractCount'",
                        "ROUND(SUM(if(cmsch_type = 1 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllContractValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 1 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllContractValueOMR'",
                        "count(if(cmsch_type = 3 and (cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , 1,null)) as 'obligatedOverAllBACount'",
                        "ROUND(SUM(if(cmsch_type = 3 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllBAValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 3 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllBAValueOMR'",
                        "count(if(cmsch_type = 2 and (cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , 1,null)) as 'obligatedOverAllPOCount'",
                        "ROUND(SUM(if(cmsch_type = 2 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllPOValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 2 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllPOValueOMR'",])
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsch_cmsrequisitionformdtls_fk')
                    ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk')
                    ->where('crfd_projectdtls_fk=:pk and cmsch_createdon is not null and cmsch_isdeleted = 2 and cmsad_isprimarycontractor = 1 and cmsad_isdeactivated = 0 and cmsawarddtls_pk is not null', array(':pk' => $dataPk))
                    ->asArray()
                    ->one();
        } elseif ($dataType == 2) {
            $totalAwards = CmscontracthdrTbl::find()
                    ->select([
                        "count(cmsawarddtls_pk) as awardsCount",
                        "ROUND(SUM(IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt)),2) as 'awardAmtUSD'",
                        "ROUND(SUM(IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt)),3) as 'awardAmtOMR'",
                        "count(if(subTbl.cmsch_type = 1, 1,null)) as 'coCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1, IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coAmtUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1, IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coAmtOMR'",
                        "count(if(subTbl.cmsch_type = 2, 1,null)) as 'poCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2, IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poAmtUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2, IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poAmtOMR'",
                        "count(if(subTbl.cmsch_type = 3, 1,null)) as 'baCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3, IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baAmtUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3, IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baAmtOMR'",
                        "count(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 1 , 1,null)) as 'coMSMECount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 1 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coMSMEValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 1 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coMSMEValueOMR'",
                        "count(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 1 , 1,null)) as 'baMSMECount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 1 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baMSMEValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 1 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baMSMEValueOMR'",
                        "count(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 2 , 1,null)) as 'coLCCCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 2 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coLCCValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 2 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coLCCValueOMR'",
                        "count(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 2 , 1,null)) as 'baLCCCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 2 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baLCCValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 2 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baLCCValueOMR'",
                        "count(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 3 , 1,null)) as 'coAllCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 3 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coAllValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 3 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coAllValueOMR'",
                        "count(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 3 , 1,null)) as 'baAllCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 3 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baAllValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 3 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baAllValueOMR'",
                        "count(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 1 , 1,null)) as 'poMSMECount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 1 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poMSMEValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 1 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poMSMEValueOMR'",
                        "count(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 2 , 1,null)) as 'poLCCCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 2 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poLCCValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 2 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poLCCValueOMR'",
                        "count(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 3 , 1,null)) as 'poAllCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 3 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poALLValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 3 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poALLValueOMR'",
                        "count(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 5 , 1,null)) as 'coNonCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 5 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coNonValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1 and subTbl.cmsch_obligation = 5 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coNonValueOMR'",
                        "count(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 5 , 1,null)) as 'baNonCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 5 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baNonValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3 and subTbl.cmsch_obligation = 5 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baNonValueOMR'",
                        "count(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 5 , 1,null)) as 'poNonCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 5 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poNonValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2 and subTbl.cmsch_obligation = 5 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poNonValueOMR'",
                        "count(if(subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3, 1,null)) as 'obligatedOverAllCount'",
                        "ROUND(SUM(if(subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllValueOMR'",
                        "count(if(subTbl.cmsch_obligation = 5 , 1,null)) as 'obligatedNonOverAllCount'",
                        "ROUND(SUM(if(subTbl.cmsch_obligation = 5 , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedNonOverAllValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_obligation = 5 , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedNonOverAllValueOMR'",
                        "count(if(subTbl.cmsch_type = 1 and (subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3) , 1,null)) as 'obligatedOverAllContractCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1 and ( subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3) , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllContractValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 1 and ( subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3) , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllContractValueOMR'",
                        "count(if(subTbl.cmsch_type = 3 and (subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3) , 1,null)) as 'obligatedOverAllBACount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3 and ( subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3) , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllBAValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 3 and ( subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3) , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllBAValueOMR'",
                        "count(if(subTbl.cmsch_type = 2 and (subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3) , 1,null)) as 'obligatedOverAllPOCount'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2 and ( subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3) , IF(subTbl.cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllPOValueUSD'",
                        "ROUND(SUM(if(subTbl.cmsch_type = 2 and ( subTbl.cmsch_obligation = 1 or subTbl.cmsch_obligation = 2 or subTbl.cmsch_obligation = 3) , IF(subTbl.cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllPOValueOMR'",])
                    ->leftJoin('cmscontracthdr_tbl as subTbl', 'subTbl.cmsch_cmscontracthdr_fk = cmscontracthdr_tbl.cmscontracthdr_pk and subTbl.cmsch_createdon is not null and subTbl.cmsch_obligation in (1,2,3,5) and subTbl.cmsch_isdeleted = 2')
                    ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = subTbl.cmscontracthdr_pk and cmsad_isprimarycontractor = 1 and cmsad_isdeactivated = 0')
                    ->where('cmscontracthdr_tbl.cmscontracthdr_pk=:pk and cmsawarddtls_pk is not null and cmsad_cmscontracthdr_fk != :pk', array(':pk' => $dataPk))
                    ->asArray()
                    ->one();
        } elseif ($dataType == 3) {
            $totalAwards = CmscontracthdrTbl::find()
                    ->select([
                        "count(IF((cmsch_type = 1 or cmsch_type = 2 or cmsch_type = 3) and cmsch_obligation != 4, 1,null)) as awardsCount",
                        "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt)),2) as 'awardAmtUSD'",
                        "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt)),3) as 'awardAmtOMR'",
                        "count(if(cmsch_type = 1 and cmsch_obligation != 4, 1,null)) as 'coCount'",
                        "ROUND(SUM(if(cmsch_type = 1, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coAmtUSD'",
                        "ROUND(SUM(if(cmsch_type = 1, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coAmtOMR'",
                        "count(if(cmsch_type = 2 and cmsch_obligation != 4, 1,null)) as 'poCount'",
                        "ROUND(SUM(if(cmsch_type = 2, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poAmtUSD'",
                        "ROUND(SUM(if(cmsch_type = 2, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poAmtOMR'",
                        "count(if(cmsch_type = 3, 1,null)) as 'baCount'",
                        "ROUND(SUM(if(cmsch_type = 3, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baAmtUSD'",
                        "ROUND(SUM(if(cmsch_type = 3, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baAmtOMR'",
                        "count(if(cmsch_type = 1 and cmsch_obligation = 1 , 1,null)) as 'coMSMECount'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coMSMEValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coMSMEValueOMR'",
                        "count(if(cmsch_type = 3 and cmsch_obligation = 1 , 1,null)) as 'baMSMECount'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baMSMEValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baMSMEValueOMR'",
                        "count(if(cmsch_type = 1 and cmsch_obligation = 2 , 1,null)) as 'coLCCCount'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coLCCValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coLCCValueOMR'",
                        "count(if(cmsch_type = 3 and cmsch_obligation = 2 , 1,null)) as 'baLCCCount'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baLCCValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baLCCValueOMR'",
                        "count(if(cmsch_type = 1 and cmsch_obligation = 3 , 1,null)) as 'coAllCount'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coAllValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coAllValueOMR'",
                        "count(if(cmsch_type = 3 and cmsch_obligation = 3 , 1,null)) as 'baAllCount'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baAllValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baAllValueOMR'",
                        "count(if(cmsch_type = 2 and cmsch_obligation = 1 , 1,null)) as 'poMSMECount'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poMSMEValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 1 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poMSMEValueOMR'",
                        "count(if(cmsch_type = 2 and cmsch_obligation = 2 , 1,null)) as 'poLCCCount'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poLCCValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 2 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poLCCValueOMR'",
                        "count(if(cmsch_type = 2 and cmsch_obligation = 3 , 1,null)) as 'poAllCount'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poALLValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poALLValueOMR'",
                        "count(if(cmsch_type = 1 and cmsch_obligation = 5 , 1,null)) as 'coNonCount'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coNonValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coNonValueOMR'",
                        "count(if(cmsch_type = 3 and cmsch_obligation = 5 , 1,null)) as 'baNonCount'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baNonValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baNonValueOMR'",
                        "count(if(cmsch_type = 2 and cmsch_obligation = 5 , 1,null)) as 'poNonCount'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poNonValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poNonValueOMR'",
                        "count(if(cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3, 1,null)) as 'obligatedOverAllCount'",
                        "ROUND(SUM(if(cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllValueUSD'",
                        "ROUND(SUM(if(cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllValueOMR'",
                        "count(if(cmsch_obligation = 5 , 1,null)) as 'obligatedNonOverAllCount'",
                        "ROUND(SUM(if(cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedNonOverAllValueUSD'",
                        "ROUND(SUM(if(cmsch_obligation = 5 , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedNonOverAllValueOMR'",
                        "count(if(cmsch_type = 1 and (cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , 1,null)) as 'obligatedOverAllContractCount'",
                        "ROUND(SUM(if(cmsch_type = 1 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllContractValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 1 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllContractValueOMR'",
                        "count(if(cmsch_type = 3 and (cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , 1,null)) as 'obligatedOverAllBACount'",
                        "ROUND(SUM(if(cmsch_type = 3 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllBAValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 3 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllBAValueOMR'",
                        "count(if(cmsch_type = 2 and (cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , 1,null)) as 'obligatedOverAllPOCount'",
                        "ROUND(SUM(if(cmsch_type = 2 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'obligatedOverAllPOValueUSD'",
                        "ROUND(SUM(if(cmsch_type = 2 and ( cmsch_obligation = 1 or cmsch_obligation = 2 or cmsch_obligation = 3) , IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'obligatedOverAllPOValueOMR'",])
                    ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1 and cmsad_isdeactivated = 0')
                    ->where('cmsch_memcompmst_fk = :pk and cmsch_createdon is not null and cmsch_isdeleted = 2 and cmsawarddtls_pk is not null', array(':pk' => $dataPk))
                    ->groupBy("cmsch_memcompmst_fk")
                    ->asArray()
                    ->one();
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'totalAwards' => $totalAwards ? $totalAwards : [],
        );
        return $result;
    }

    public static function getObligatedEnquiries($dataPk, $dataType) {
        if ($dataType == 1) {
            $obligatedEnquiries = CmsrequisitionformdtlsTbl::find()
                    ->select(["count(if((cmstht_type = 1 or cmstht_type = 2) and cmstht_obligation = 1 , 1,null)) as 'msmeCount'", "count(if((cmstht_type = 1 or cmstht_type = 2) and cmstht_obligation = 2 , 1,null)) as 'lccCount'", "count(if((cmstht_type = 1 or cmstht_type = 2) and cmstht_obligation = 3 , 1,null)) as 'combineCount'", "count(if((cmstht_type = 1 or cmstht_type = 2) and (cmstht_obligation = 1 or cmstht_obligation = 2 or cmstht_obligation = 3), 1,null)) as 'allCount'"])
                    ->leftJoin('cmstenderhdrtemp_tbl', 'cmstht_cmsrequisitionformdtls_fk = cmsrequisitionformdtls_pk and cmstht_obligation in (1,2,3) and cmstht_isdeleted = 2')
                    ->where('crfd_projectdtls_fk=:pk and crfd_isdeleted = 2', array(':pk' => $dataPk))
                    ->asArray()
                    ->one();
        } elseif ($dataType == 2) {
            $obligatedEnquiries = CmsrequisitionformdtlsTbl::find()
                    ->select(["count(if((cmstht_type = 1 or cmstht_type = 2) and cmstht_obligation = 1 , 1,null)) as 'msmeCount'", "count(if((cmstht_type = 1 or cmstht_type = 2) and cmstht_obligation = 2 , 1,null)) as 'lccCount'", "count(if((cmstht_type = 1 or cmstht_type = 2) and cmstht_obligation = 3 , 1,null)) as 'combineCount'", "count(if((cmstht_type = 1 or cmstht_type = 2) and (cmstht_obligation = 1 or cmstht_obligation = 2 or cmstht_obligation = 3), 1,null)) as 'allCount'"])
                    ->leftJoin('cmstenderhdrtemp_tbl', 'cmstht_cmsrequisitionformdtls_fk = cmsrequisitionformdtls_pk and cmstht_obligation in (1,2,3) and cmstht_isdeleted = 2')
                    ->where('crfd_cmscontracthdr_fk=:pk and crfd_isdeleted = 2', array(':pk' => $dataPk))
                    ->asArray()
                    ->one();
        } elseif ($dataType == 3) {
            $obligatedEnquiries = CmstenderhdrtempTbl::find()
                    ->select(["count(if((cmstht_type = 1 or cmstht_type = 2) and cmstht_obligation = 1 , 1,null)) as 'msmeCount'", "count(if((cmstht_type = 1 or cmstht_type = 2) and cmstht_obligation = 2 , 1,null)) as 'lccCount'", "count(if((cmstht_type = 1 or cmstht_type = 2) and cmstht_obligation = 3 , 1,null)) as 'combineCount'", "count(if((cmstht_type = 1 or cmstht_type = 2) and (cmstht_obligation = 1 or cmstht_obligation = 2 or cmstht_obligation = 3), 1,null)) as 'allCount'"])
                    ->where('cmstht_memcompmst_fk=:pk and cmstht_obligation in (1,2,3) and cmstht_isdeleted = 2', array(':pk' => $dataPk))
                    ->asArray()
                    ->one();
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'obligatedEnquiries' => $obligatedEnquiries,
        );
        return $result;
    }

    public static function getSubConut($dataPk) {
        $model = CmscontracthdrTbl::find()
                ->select(["count(if(cmsch_type = 1 and cmsch_contracttype = 2, 1, null)) as 'subContract'", "count(if(cmsch_type = 2 and cmsch_contracttype = 2, 1, null)) as 'subOrder'",])
                ->where('cmsch_cmscontracthdr_fk=:pk and cmsch_createdon is not null and cmsch_isdeleted = 2', array(':pk' => $dataPk))
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'subContract' => $model['subContract'],
            'subOrder' => $model['subOrder'],
        );
        return $result;
    }

    public static function chkLccStatus($contractPk) {
        $loginType = \yii\db\ActiveRecord::getTokenData('reg_type', true);
        $contractTable = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $contractPk])->one();
        $lccCompArray = \Yii::$app->params['lcc']['compPk'];
        if ($loginType == 6) {
            $operatorCompPk = $contractTable->cmschCmscontracthdrFk;
            $compPk = $operatorCompPk->cmsch_memcompmst_fk;
        } else {
            $compPk = $contractTable->cmsch_memcompmst_fk;
        }
        if (in_array($compPk, $lccCompArray)) {
            $status = true;
        } else {
            $status = FALSE;
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'lccStatus' => $status,
        );
        return $result;
    }

    public function getContractArray($comPk) {
        $module = CmscontracthdrTbl::find()
                        ->select(['cmscontracthdr_pk as dataPk', 'cmsch_contracttitle as dataName', 'cmsch_contractrefno as dataRef'])
                        ->leftJoin('cmsawarddtls_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk and cmsad_isprimarycontractor = 1')
                        ->where('cmsad_memcompmst_fk=:fk and cmsch_issubcontrqmt = 1 and cmsch_contractstatus = 1', [':fk' => $comPk])
                        ->andWhere(['<>', 'cmsch_type', 3])
                        ->orderBy('dataName ASC')
                        ->groupBy('cmscontracthdr_pk')
                        ->asArray()->All();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $module ? $module : [],
        );
        return $result;
    }

    public static function getAwardedcontractList($data) {
        $size = Security::sanitizeInput($data['size'], "number");
        $sortpk = Security::sanitizeInput($data['sortby'], "number");
        $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $awardType = Security::sanitizeInput($data['awardType'], "string_spl_char");
        $listStatus = Security::sanitizeInput($data['listStatus'], "number");
        $dataType = Security::sanitizeInput($data['dataType'], "number");
        $procurementType = Security::sanitizeInput($data['procurementType'], "number");
        $obligation = Security::sanitizeInput($data['obligation'], "string_spl_char");
        $awardedStartDate = Security::sanitizeInput($data['awardedStartDate'], "string_spl_char");
        $awardedEndDate = Security::sanitizeInput($data['awardedEndDate'], "string_spl_char");
        $closingStarDate = Security::sanitizeInput($data['closingStarDate'], "string_spl_char");
        $closingEndDate = Security::sanitizeInput($data['closingEndDate'], "string_spl_char");
        $startStartDate = Security::sanitizeInput($data['startStarDate'], "string_spl_char");
        $startEndDate = Security::sanitizeInput($data['startEndDate'], "string_spl_char");
        $subContract = Security::sanitizeInput($data['subContract'], "string_spl_char");
        $eTendering = Security::sanitizeInput($data['eTendering'], "string_spl_char");
        $awardedby = Security::sanitizeInput($data['awardedby'], "string_spl_char");
        $valueStart = Security::sanitizeInput($data['valueStart'], "string_spl_char");
        $valueEnd = Security::sanitizeInput($data['valueEnd'], "string_spl_char");
        $percentage = Security::sanitizeInput($data['percentage'], "string_spl_char");
        $currency = Security::sanitizeInput($data['currency'], "string_spl_char");
        $successFeeType = Security::sanitizeInput($data['successFeeType'], "string_spl_char");
        $query = CmsawarddtlsTbl::find();
        $query->select(['cmsch_type as type',"crfd_rqprocesstype", "cmsch_contractrefno as refnumber", "cmsch_contracttitle as name", "cmsch_contractperiod as duration", "cmscontracthdr_pk as contractPk", "CurM_CurrSymbol as currency", "cmsch_contractvalue as contractvalue", "cmsch_issubcontrqmt as subcontract_enabled", "cmsad_appraisalcount as appraisalpoints", "cmsad_awardedon as awardedon", "shm_stakeholdertype as stakeholderType", "cmsch_obligation as msmeinfo", "MCM_CompanyName as awardedby", "mcm_complogo_memcompfiledtlsfk as companyFile", "cmsch_createdon as created_at", "MemberCompMst_Pk as CompPk", "MemberRegMst_Pk as MemRegPk", "jdomoduledtl_pk as jdoCardPk", "cmsch_contractstatus as cardStatus", '(CASE WHEN cmsch_createdon BETWEEN DATE(NOW() - INTERVAL 7 DAY) AND  DATE(CURRENT_DATE()) THEN "true" ELSE "false" END) as new_status', 'cmsrequisitionformdtls_pk', 'cmsch_lccpercent', 'cmsch_msmepercent', 'cmsch_isetendmandate', 'mcid_invoicestatus',new \yii\db\Expression("substring_index(substring_index(group_concat(`mcpid_pymtstatus` order by memcomppymtinfodtls_pk desc separator '***'),'***',1),'***',-(1)) as mcpid_pymtstatus"),'memcompinvoicedtls_pk','cmsch_level',
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsch_contractvalue * 2.60080, cmsch_contractvalue)),2) as 'contractValueUSD'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsch_contractvalue / 2.60080, cmsch_contractvalue)),3) as 'contractValueOMR'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt)),2) as 'awardAmtUSD'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt)),3) as 'awardAmtOMR'",'fn_contract_level(6,cmscontracthdr_pk) as overAllLevel',])
                
                ->leftJoin('cmscontracthdr_tbl', 'cmsad_cmscontracthdr_fk = cmscontracthdr_pk')
                ->leftJoin('jdomoduledtl_tbl', 'cmscontracthdr_pk = jdmd_shared_fk and jdmd_shared_type = 2')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsch_cmsrequisitionformdtls_fk')
                ->leftJoin('currencymst_tbl', 'cmsch_currencymst_fk = CurrencyMst_Pk')
                ->leftJoin('membercompanymst_tbl', 'cmsch_memcompmst_fk = MemberCompMst_Pk')
                ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                ->leftJoin('stkholdertypmst_tbl', 'mrm_stkholdertypmst_fk = stkholdertypmst_pk')
                ->leftJoin('cmsawardhsty_tbl', 'cmsah_cmsawarddtls_fk = cmsawarddtls_pk')
                ->leftJoin('memcompinvoicedtls_tbl', 'mcid_membercompmst_fk = cmsad_memcompmst_fk and mcid_shared_fk = cmscontracthdr_pk and mcid_basemodulemst_fk = 131 and mcid_module = 4')
                ->leftJoin('memcomppymtinfodtls_tbl', 'mcpid_memcompinvoicedtls_fk = memcompinvoicedtls_pk')
                ->where('cmsad_memcompmst_fk = :comPk and cmsad_isdeactivated=0 and cmsad_isprimarycontractor=1 and cmsch_isdeleted = 2 and cmsch_createdon is not null', array(':comPk' => $compPk))
                ->andWhere(['not', ['cmsch_contractstatus' => 2]])
                ->asArray();

        if (!empty($searchTxt) && $searchTxt != null) {
            $query->andFilterWhere(['OR',
                ['like', 'cmsch_contracttitle', $searchTxt],
                ['like', 'cmscontracthdr_tbl.cmsch_contractrefno', $searchTxt],
            ]);
        }
        if (!empty($awardType) && $awardType != null) {
            $query->andFilterWhere(['IN', 'cmsch_type', explode(',', $awardType)]);
        }
        if (!empty($listStatus) && $listStatus != null) {
            $query->andFilterWhere(['IN', 'cmsch_contractstatus', explode(',', $listStatus)]);
        }
        if (!empty($currency) && $currency != null) {
            $query->andFilterWhere(['IN', 'cmsch_currencymst_fk', explode(',', $currency)]);
        }
        if (!empty($dataType) && $dataType != null) {
            $query->andFilterWhere(['IN', 'crfd_rqprocesstype', explode(',', $dataType)]);
        }
        if (!empty($procurementType) && $procurementType != null) {
            $query->andFilterWhere(['IN', 'crfd_rqtype', explode(',', $procurementType)]);
        }
        if (!empty($successFeeType) && $successFeeType != null) {
            $query->andFilterWhere(['IN', 'mcpid_pymtstatus', explode(',', $successFeeType)]);
        }
        if (!empty($obligation) && $obligation != null) {
            $query->andFilterWhere(['IN', 'cmsch_obligation', explode(',', $obligation)]);
            $obligationArray = explode(',', $obligation);
            if (!empty($percentage) && $percentage != null) {
                if (in_array(1, $obligationArray) && !in_array(3, $obligationArray)) {
                    $query->andFilterWhere(['like', 'cmsch_msmepercent', $percentage]);
                }
                if (in_array(2, $obligationArray) && !in_array(3, $obligationArray)) {
                    $query->andFilterWhere(['like', 'cmsch_lccpercent', $percentage]);
                }
                if (in_array(3, $obligationArray)) {
                    $query->andFilterWhere(['or', ['like', 'cmsch_msmepercent', $percentage], ['like', 'cmsch_lccpercent', $percentage]]);
                }
            }
        }
        if (!empty($awardedStartDate) && $awardedStartDate != null && !empty($awardedEndDate) && $awardedEndDate != null) {
            $query->andFilterWhere(['between', 'STR_TO_DATE(cmsad_awardedon,"%Y-%m-%d")', $awardedStartDate, $awardedEndDate]);
        }
        if ((!empty($startStartDate) && $startStartDate != null && !empty($startEndDate) && $startEndDate != null) && (!empty($closingStarDate) && $closingStarDate != null && !empty($closingEndDate) && $closingEndDate != null)) {
            $query->andFilterWhere(['AND', ['between', 'STR_TO_DATE(cmsch_contractstartdate,"%Y-%m-%d")', $startStartDate, $startEndDate], ['between', 'STR_TO_DATE(cmsch_contractenddate,"%Y-%m-%d")', $closingStarDate, $closingEndDate]]);
        } else {
            if (!empty($startStartDate) && $startStartDate != null && !empty($startEndDate) && $startEndDate != null) {
                $query->andFilterWhere(['between', 'STR_TO_DATE(cmsch_contractstartdate,"%Y-%m-%d")', $startStartDate, $startEndDate]);
            }
            if (!empty($closingStarDate) && $closingStarDate != null && !empty($closingEndDate) && $closingEndDate != null) {
                $query->andFilterWhere(['between', 'STR_TO_DATE(cmsch_contractenddate,"%Y-%m-%d")', $closingStarDate, $closingEndDate]);
            }
        }
        if (!empty($subContract) && $subContract != null) {
            $query->andFilterWhere(['IN', 'cmsch_issubcontrqmt', explode(',', $subContract)]);
        }
        if (!empty($eTendering) && $eTendering != null) {
            $query->andFilterWhere(['IN', 'cmsch_isetendmandate', explode(',', $eTendering)]);
        }
        if (!empty($awardedby) && $awardedby != null) {
            $query->andFilterWhere(['IN', 'cmsch_memcompmst_fk', explode(',', $awardedby)]);
        }
        if (!empty($valueStart) && $valueStart != null && !empty($valueEnd) && $valueEnd != null) {
            $query->andFilterWhere(['between', 'cmsch_contractvalue', $valueStart, $valueEnd]);
        }

        if ($sortpk == 1) {
            $query->orderBy([new \yii\db\Expression("coalesce(cmsch_updatedon,cmsch_createdon) DESC")]);
        } elseif ($sortpk == 2) {
            $query->orderBy([new \yii\db\Expression("coalesce(cmsch_updatedon,cmsch_createdon) ASC")]);
        } elseif ($sortpk == 3) {
            $query->orderBy(['cmsch_contracttitle' => SORT_ASC]);
        } elseif ($sortpk == 4) {
            $query->orderBy(['cmsch_contracttitle' => SORT_DESC]);
        }
        $query->groupBy("cmscontracthdr_pk");
        $page = (!empty($size)) ? $size : 9;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' => $page]]);
        $finalData = [];
        foreach ($provider->getModels() as $listData) {
            if ($listData['contractPk'] != NULL && !empty($listData['contractPk'])) {
                $SubCount = self::getSubConut($listData['contractPk']);
                $tendercount = self::getContractBasedTenderCount($listData['contractPk']);
                $listData['subContract'] = $SubCount['subContract'];
                $listData['subOrder'] = $SubCount['subOrder'];
                $listData['tendercount'] = $tendercount['tendercount'];
                $listData['totalCount'] = number_format($SubCount['subContract']) + number_format($SubCount['subOrder']);
            } else {
                $listData['subContract'] = null;
                $listData['subOrder'] = null;
                $listData['tendercount'] = null;
            }
            if (!empty($listData['companyFile'])) {
                $listData['companylogo'] = \common\components\Drive::generateUrl($listData['companyFile'], $listData['CompPk'], $userPK);
            } else {
                $listData['companylogo'] = null;
            }
            $finalData[] = $listData;
        }
        return [
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'items' => $finalData ? $finalData : [],
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
            'page' => $pageIndex
        ];
    }

    public function getContracts($reqIds, $projectpk, $formdata) {
        $query = CmscontracthdrTbl::find();
        if ($formdata['dataType'] == 1) {
            $query->where(['in', 'cmsch_cmsrequisitionformdtls_fk', $reqIds]);
            $query->andWhere(['cmsch_cmscontracthdr_fk' => null]);
        } else {
            $query->where(['cmscontracthdr_pk' => $projectpk]);
        }

        $contracts = $query->all();
        return $contracts;
    }

    public static function getSupplyChainLevel() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $supplyChain = CmscontracthdrTbl::find()
                ->select(["cmscontracthdr_pk", 'cmsch_uid', 'cmsch_contracttitle', 'cmsch_level'])
                ->where('cmsch_memcompmst_fk=:pk and cmsch_isdeleted = 2 and cmsch_createdon is not null', array(':pk' => $companypk))
                ->orderBy('cmsch_level ASC')
                ->limit(5)
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $supplyChain ? $supplyChain : [],
        );
        return $result;
    }

    /**
     * Chk Contract/PO/Blanket Ref detail
     */
    public function chkValidRefNumber($data) {
        if (!empty($data)) {
            $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $mainType = null;
            $subType = null;
            if ($data['dataType'] == 'CO') {
                $mainType = 1;
                $subType = 1;
            } elseif ($data['dataType'] == 'PO') {
                $mainType = 2;
                $subType = 1;
            } elseif ($data['dataType'] == 'BA') {
                $mainType = 3;
                $subType = 1;
            } elseif ($data['dataType'] == 'SC') {
                $mainType = 1;
                $subType = 2;
            } elseif ($data['dataType'] == 'SO') {
                $mainType = 2;
                $subType = 2;
            }
            if(!empty($data['currentPk'])){
            $model = CmscontracthdrTbl::find()
                    ->select(['cmscontracthdr_pk', 'cmsch_contracttitle'])
                    ->where("cmsch_memcompmst_fk =:compPK and cmsch_contractrefno = :dataTitle and cmsch_type = :dataType and cmsch_contracttype = :subType and cmsch_isdeleted = 2", [':compPK' => $compPK, ':dataTitle' => $data['dataValue'], ':dataType' => $mainType, ':subType' => $subType])
                    ->andWhere(['<>', 'cmscontracthdr_pk', $data['currentPk']])
                    ->asArray()
                    ->all();
            }  else {
                $model = CmscontracthdrTbl::find()
                    ->select(['cmscontracthdr_pk', 'cmsch_contracttitle'])
                    ->where("cmsch_memcompmst_fk =:compPK and cmsch_contractrefno = :dataTitle and cmsch_type = :dataType and cmsch_contracttype = :subType and cmsch_isdeleted = 2", [':compPK' => $compPK, ':dataTitle' => $data['dataValue'], ':dataType' => $mainType, ':subType' => $subType])
                    ->asArray()
                    ->all();
            }
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'moduleData' => $model ? $model : [],
            );
        }
        return json_encode($result, true);
    }

}
