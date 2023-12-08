<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsawardfeependingTbl]].
 *
 * @see CmsawardfeependingTbl
 */
class CmsawardfeependingTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsawardfeependingTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsawardfeependingTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    /**
     * Get Quotation Details
     */
    public static function restrictAwardingContract($formData) {
        if (!empty($formData['tenderPk'])) {
            $model = CmsawardfeependingTbl::find()->where("cafp_cmsrequisitionformdtls_fk =:tenderPk and cafp_awarder_memregmst_fk = :regPk and cafp_awardee_memregmst_fk = :supplierRegPk", [':tenderPk' => $formData['tenderPk'], ':regPk' => $formData['regPk'], ':supplierRegPk' => $formData['supplierRegPk']])->one();
            if (empty($model)) {
                $result = self::newDataAdding($formData);
            } else {
                if ($model->cafp_isfeepaidmailsent == 1) {
                    $result = self::newDataAdding($formData);
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'returndata' => 'Already record is there!',
                    );
                }
            }
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
                'returndata' => 'Tender Pk Not Valid'
            );
        }
        return $result;
    }

    /**
     * New Data Adding
     */
    public static function newDataAdding($formData) {
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $model = new CmsawardfeependingTbl;
        $model->cafp_cmsrequisitionformdtls_fk = $formData['tenderPk'];
        $model->cafp_awarder_memregmst_fk = $formData['regPk'];
        $model->cafp_awardee_memregmst_fk = $formData['supplierRegPk'];
        $model->cafp_createdby = $userPK;
        $model->cafp_createdon = $date;
        if ($model->save() === TRUE) {
            self::sentSupplierMail($formData);
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => 'Data Added Successfully!',
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

    public function sentSupplierMail($formData) {
        $supplierData = \api\modules\mst\models\MembercompanymstTbl::find()
                ->select(['MCM_CompanyName', 'MCM_SupplierCode', 'mcmpld_emailid'])
                ->leftJoin('memcompmplocationdtls_tbl', 'mcmpld_membercompmst_fk = MemberCompMst_Pk and mcmpld_locationtype = 1')
                ->where('MCM_MemberRegMst_Fk=:dataPK', array(':dataPK' => $formData['supplierRegPk']))
                ->asArray()
                ->one();
        $operatiorData = \api\modules\mst\models\MembercompanymstTbl::find()
                ->select(['MCM_CompanyName', 'MCM_SupplierCode', 'mcmpld_emailid'])
                ->leftJoin('memcompmplocationdtls_tbl', 'mcmpld_membercompmst_fk = MemberCompMst_Pk and mcmpld_locationtype = 1')
                ->where('MCM_MemberRegMst_Fk=:dataPK', array(':dataPK' => $formData['regPk']))
                ->asArray()
                ->one();
        $content = "JSRS-CMS: Contract Success Fee Payment Overdue (" . $supplierData['MCM_SupplierCode'] . ")<br>" . $supplierData['MCM_CompanyName'] . ",<br>" . $operatiorData['MCM_CompanyName'] . " is unable to complete the awarding process, since you have Overdue payment of Contract Success Fee. <br>We request you to complete the payment process for all the pending payments in JSRS and get it approved at the earliest to enable your status for any further awards and to continue participating in ongoing enquiries. <br>Make Payment<br> Note:- If you have already completed the payment process (online or offline), we request you to send the payment proof to accounts@businessgateways.com along with your invoice copy. For queries, please write to us at accounts@businessgateways.com or call us at +968 2410 6123.";
        return \Yii::$app->mailer->compose()
                        ->setFrom('noreply@businessgateways.com')
                        ->setTo(\Yii::$app->params['testMailIDs'])
                        ->setSubject('JSRS-CMS: Contract Success Fee Payment Overdue (' . $supplierData['MCM_SupplierCode'] . ')')
                        ->setHTMLBody($content)
                        ->send();
    }

    public function pendingInvoiceStatusUpdate($comPk, $regPk) {
        $date = date('Y-m-d H:i:s');
        $chkSuccessFee = \common\models\MemcompinvoicedtlsTblQuery::chkSuccessFeeStatus($comPk);
        if ($chkSuccessFee != 1) {
            $awardFeePendingList = CmsawardfeependingTbl::find()
                    ->where('cafp_awardee_memregmst_fk=:dataPK and cafp_isfeepaidmailsent = 0', array(':dataPK' => $regPk))
                    ->all();
            foreach ($awardFeePendingList as $dataVal) {
                $dataVal->cafp_isfeepaidmailsent = 1;
                $dataVal->cafp_feepaidmailsenton = $date;
                if ($dataVal->save() === TRUE) {
                    self::sentOperatorMail($dataVal);
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'returndata' => 'Data Updated Successfully!',
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
            }
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => 'Some Other Pending Invoice there.',
            );
        }
        return $result;
    }

    public function sentOperatorMail($formData) {
        $supplierData = \api\modules\mst\models\MembercompanymstTbl::find()
                ->select(['MCM_CompanyName', 'MCM_SupplierCode', 'mcmpld_emailid'])
                ->leftJoin('memcompmplocationdtls_tbl', 'mcmpld_membercompmst_fk = MemberCompMst_Pk and mcmpld_locationtype = 1')
                ->where('MCM_MemberRegMst_Fk=:dataPK', array(':dataPK' => $formData->cafp_awardee_memregmst_fk))
                ->asArray()
                ->one();
        $operatiorData = \api\modules\mst\models\MembercompanymstTbl::find()
                ->select(['MCM_CompanyName', 'MCM_SupplierCode', 'mcmpld_emailid'])
                ->leftJoin('memcompmplocationdtls_tbl', 'mcmpld_membercompmst_fk = MemberCompMst_Pk and mcmpld_locationtype = 1')
                ->where('MCM_MemberRegMst_Fk=:dataPK', array(':dataPK' => $formData->cafp_awarder_memregmst_fk))
                ->asArray()
                ->one();
        $content = "JSRS-CMS: Contract Success Fee Payments are completed by " . $supplierData['MCM_CompanyName'] . "<br>" . $operatiorData['MCM_CompanyName'] . "<br>" . $supplierData['MCM_CompanyName'] . " has paid all their overdue Contract Success Fee. You may now complete the awarding process on JSRS Contracts Management System (JSRS-CMS).<br>Login to Award Contract";
        return \Yii::$app->mailer->compose()
                        ->setFrom('noreply@businessgateways.com')
                        ->setTo(\Yii::$app->params['testMailIDs'])
                        ->setSubject('JSRS-CMS: Award feature is enabled to ' . $supplierData['MCM_SupplierCode'])
                        ->setHTMLBody($content)
                        ->send();
    }

}
