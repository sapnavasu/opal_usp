<?php

namespace api\modules\pms\models;

use common\components\Common;
use common\components\Security;
use yii\data\ActiveDataProvider;
use Yii;
use yii\db\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Database;
use yii\base\Exception as YiiException;
use api\modules\quot\models\CmsquotationhdrTblQuery;
use api\modules\pms\models\CmstenderagreehdrTblQuery;

/**
 * This is the ActiveQuery class for [[CmspaymenttermsTbl]].
 *
 * @see CmspaymenttermsTbl
 */
class CmspaymenttermsTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmspaymenttermsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmspaymenttermsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function getAutocompleteArray($companypk) {
        $module = CmspaymenttermsTbl::find()
                        ->select(['cmspt_name', 'cmspt_value', 'cmspaymentterms_pk'])
                        ->where('cmspt_memcompmst_fk=:fk', [':fk' => $companypk])
                        ->orderBy('cmspt_name ASC')
                        ->groupBy('cmspt_name')
                        ->asArray()->All();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $module,
        );
        return $result;
    }

    public function getTermsCondition($sharedFk, $type) {
        $module = CmspaymenttermsTbl::find()
                ->select(['cmspt_name', 'cmspt_value', 'cmspaymentterms_pk'])
                ->where('cmspt_shared_fk=:pk and cmspt_type=:type', [':pk' => $sharedFk, ':type' => $type])
//                ->orderBy('cmspt_name ASC')
                ->groupBy('cmspt_name')
                ->asArray()
                ->All();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $module ? $module : [],
        );
        return $result;
    }

    public function submitTerms($formdata) {
        $formDataArray = $formdata['formData'];
        $sharedFk = $formDataArray['sharedFk'];
        $type = $formDataArray['paymentType'];
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $date = date('Y-m-d H:i:s');
        $ipaddress = \common\components\Common::getIpAddress();
        $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        if (!empty($sharedFk)) {
            if ($type == 1) {
                $model = CmstenderhdrTbl::find()->where("cmstenderhdr_pk =:pk", [':pk' => $sharedFk])->one();
                if ($model) {
                    $model->cmsth_invoiceinterval = $formDataArray['reqinterval'];
                    $model->cmsth_invoiceintervaltype = $formDataArray['reqintervaltype'];
                    if ($model->save() != TRUE) {
                        return array(
                            'status' => 200,
                            'msg' => 'Error',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'moduleData' => $model->getErrors(),
                        );
                    }
                }
            } else {
                $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $sharedFk])->one();
                if ($model) {
                    if($model->cmsch_isjsrstncaccept){
                        $comments = 'Terms & Conditions Updated Successfully!';
                        $flag = 'U';
                    }  else {
                        $comments = 'Terms & Conditions Created Successfully!';
                        $flag = 'C';
                    }
                    $model->cmsch_isjsrstncaccept = $formDataArray['agreeTerm'];
                    $model->cmsch_invoiceinterval = $formDataArray['reqinterval'];
                    $model->cmsch_invoiceintervaltype = $formDataArray['reqintervaltype'];
                    if ($model->save() != TRUE) {
                        return array(
                            'status' => 200,
                            'msg' => 'Error',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'moduleData' => $model->getErrors(),
                        );
                    }  else {
                        $result = array(
                            'status' => 200,
                            'msg' => 'success',
                            'flag' => $flag,
                            'comments' => $comments
                        );
                    }
                }
            }
        }
        foreach ($formDataArray['paymentTerms'] as $key => $dataVal) {
            if (!empty($dataVal['ptlabel']) && $dataVal['ptlabel'] != null && !empty($dataVal['ptvalue']) && $dataVal['ptvalue']) {
                if ($dataVal['ptPk']) {
                    $module = CmspaymenttermsTbl::find()
                            ->where(['cmspaymentterms_pk' => $dataVal['ptPk']])
                            ->andWhere('cmspt_shared_fk=:sharedFk', array(':sharedFk' => $sharedFk))
                            ->one();
                    $comments = 'Terms & Conditions Updated Successfully!';
                    $flag = 'U';
                } else {
                    $comments = 'Terms & Conditions Created Successfully!';
                    $flag = 'C';
                    $module = new CmspaymenttermsTbl();
                    $module->cmspt_shared_fk = $sharedFk;
                    $module->cmspt_memcompmst_fk = $compPk;
                }
                $module->cmspt_type = $type;
                $module->cmspt_name = $dataVal['ptlabel'];
                $module->cmspt_value = $dataVal['ptvalue'];
                if ($module->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $flag,
                        'comments' => $comments
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'Error',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'moduleData' => $module->getErrors(),
                    );
                }
            }
        }
        return $result;
    }

    public function saveTermsCondition($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if ($data) {
            $transaction = Yii::$app->db->beginTransaction();
            $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            try {
                if (!empty($data['paymentTerms'])) {
                    foreach ($data['paymentTerms'] as $term) {
                        if (($term['ptlabel'] != null && !empty($term['ptlabel'])) && ($term['ptvalue'] != null && !empty($term['ptvalue']))) {
                            if ($val['dataPk'] != null) {
                                $paymentTermmodel = CmspaymenttermsTbl::find()
                                        ->where(['cmspaymentterms_pk' => $val['dataPk']])
                                        ->one();
                            } else {
                                $paymentTermmodel = new CmspaymenttermsTbl();
                            }
                            $paymentTermmodel->cmspt_memcompmst_fk = $compPk;
                            $paymentTermmodel->cmspt_shared_fk = $data['currentPk'];
                            $paymentTermmodel->cmspt_type = 3;
                            $paymentTermmodel->cmspt_name = $term['ptlabel'];
                            $paymentTermmodel->cmspt_value = $term['ptvalue'];
                            if (!$paymentTermmodel->save()) {
                                $result = array(
                                    'status' => 200,
                                    'msg' => 'Error',
                                    'flag' => 'E',
                                    'comments' => 'Something went wrong!',
                                    'moduleData' => $paymentTermmodel->getErrors(),
                                );
                                break;
                            } else {
                                $result = array(
                                    'status' => true
                                );
                            }
                        }
                    }
                }

                if ($result['status']) {
                    if ((!empty($data['specificComment']) && $data['specificComment'] != null) || (!empty($data['generalComment']) && $data['generalComment'] != null)) {
                        $result = CmstenderagreehdrTblQuery::saveBuyerTerms($data);
                    }
                    if ($result['status']) {
                        $result = CmsquotationhdrTblQuery::saveTerms($data);
                    }
                    if ($result['status']) {
                        $result = CmstnctrnxTblQuery::saveBidderTerms($data);
                    }
                }

                if ($result['status']) {
                    $transaction->commit();
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => 'Terms & Conditions saved Successfully!',
                    );
                } else {
                    $transaction->rollBack();
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
        return $result;
    }

    public function updateTermsCondition($data) {

        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if ($data) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (!empty($data['formData']['payment_terms'])) {
                    $keepdata = [];
                    foreach ($data['formData']['payment_terms'] as $term) {
                        $paymentTermmodel = CmspaymenttermsTbl::findOne($term['payment_pk']);
                        $paymentTermmodel->cmspt_memcompmst_fk = $term['memcompmst_fk'];
                        $paymentTermmodel->cmspt_shared_fk = $data['formData']['quotationpk'];
                        $paymentTermmodel->cmspt_type = $term['type'];
                        $paymentTermmodel->cmspt_name = $term['name'];
                        $paymentTermmodel->cmspt_value = $term['value'];
                        if (!$paymentTermmodel->save()) {
                            $result = array(
                                'status' => 200,
                                'msg' => 'Error',
                                'flag' => 'E',
                                'comments' => 'Something went wrong!',
                                'moduleData' => $module->getErrors(),
                            );
                            break;
                        } else {
                            $result = array(
                                'status' => true
                            );
                        }
                    }
                }

                if ($result['status'] && !empty($data['formData']['buyer_terms'])) {
                    $result = CmstenderagreehdrTblQuery::saveBuyerTerms($data);
                    if ($result['status']) {
                        $result = CmsquotationhdrTblQuery::saveTerms($data);
                    }
                }

                if ($result['status']) {
                    $transaction->commit();
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Quotation Terms & Condition updated Successfully!',
                        'quotationpk' => $data['formData']['quotationpk'],
                    );
                } else {
                    $transaction->rollBack();
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
        return $result;
    }

    /**
     * delete termsCondition 
     */
    public function deleteTermsCondition($id) {
        $model = CmspaymenttermsTbl::find()->where('cmspaymentterms_pk=:id', array(':id' => Security::sanitizeInput($id, "number")))->one();
        if ($model->delete() === false) {
            $result = array(
                'status' => 422,
                'statusmsg' => 'warning',
                'flag' => 'E',
                'msg' => 'Failed to delete the object!'
            );
        } else {
            $result = array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag' => 'S',
                'msg' => 'Deleted successfully!',
            );
        }
        return json_encode($result);
    }

    public function creatTermsCondition($data, $dataPk, $dataType) {
        $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $module = new CmspaymenttermsTbl();
        $module->cmspt_shared_fk = $dataPk;
        $module->cmspt_memcompmst_fk = $compPk;
        $module->cmspt_type = $dataType;
        $module->cmspt_name = $data['cmspt_name'];
        $module->cmspt_value = $data['cmspt_value'];
        if ($module->save() === TRUE) {
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'comments' => 'success'
            );
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'Error',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'moduleData' => $module->getErrors(),
            );
        }
        return $result;
    }

}
