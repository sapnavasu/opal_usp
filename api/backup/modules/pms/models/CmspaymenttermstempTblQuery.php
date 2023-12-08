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
 * This is the ActiveQuery class for [[CmspaymenttermstempTbl]].
 *
 * @see CmspaymenttermstempTbl
 */
class CmspaymenttermstempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmspaymenttermstempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmspaymenttermstempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function submitTermstemp($formdata) {
        $formDataArray = $formdata['formData'];
        $sharedFk = $formDataArray['sharedFk'];
        $type = $formDataArray['paymentType'];
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $date = date('Y-m-d H:i:s');
        $ipaddress = \common\components\Common::getIpAddress();
        $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        if (!empty($sharedFk)) {
            if ($type == 1) {
                $model = CmstenderhdrtempTbl::find()->where("cmstenderhdrtemp_pk =:pk", [':pk' => $sharedFk])->one();
                if ($model) {
                    $model->cmstht_invoiceinterval = $formDataArray['reqinterval'];
                    $model->cmstht_invoiceintervaltype = $formDataArray['reqintervaltype'];
                    if ($model->save() != TRUE) {
                       
                        return array(
                            'status' => 200,
                            'msg' => 'Error',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'moduleData' => $model->getErrors(),
                        );
                    }
                    $isupdated = \api\modules\pms\models\CmstenderhdrtempTblQuery::isUpdate('payment_term',$formDataArray);
                    if($isupdated){
                        $model->cmstht_mailfor = $isupdated;
                        $model->save();
                    }
                }
            } else {
                $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $sharedFk])->one();
                if ($model) {
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
                    }
                }
            }
        } 
        
        if($formDataArray['paymentTerms']) {
            $model = CmspaymenttermstempTbl::deleteAll(['cmsptt_shared_fk' => Security::sanitizeInput($sharedFk, "number")]);
        }  

        foreach ($formDataArray['paymentTerms'] as $key => $dataVal) {

            if (!empty($dataVal['ptlabel']) && $dataVal['ptlabel'] != null && !empty($dataVal['ptvalue']) && $dataVal['ptvalue']) {
                if ($dataVal['ptPk']) {
                    $comments = 'Terms & Conditions Updated Successfully!';
                    $flag = 'U';
                } else {
                    $comments = 'Terms & Conditions Created Successfully!';
                    $flag = 'U';
                }
                $module = new CmspaymenttermstempTbl();
                $module->cmsptt_shared_fk = $sharedFk;
                $module->cmsptt_memcompmst_fk = $compPk;
                $module->cmsptt_type = $type;
                $module->cmsptt_name = $dataVal['ptlabel'];
                $module->cmsptt_value = $dataVal['ptvalue'];
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

    public function getTermsConditiontemp($sharedFk, $type) {
        $module = CmspaymenttermstempTbl::find()
                ->select(['cmsptt_name', 'cmsptt_value', 'cmspaymenttermstemp_pk'])
                ->where('cmsptt_shared_fk=:pk and cmsptt_type=:type', [':pk' => $sharedFk, ':type' => $type])
                ->orderBy('cmspaymenttermstemp_pk ASC')
                ->groupBy('cmsptt_name')
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
}
