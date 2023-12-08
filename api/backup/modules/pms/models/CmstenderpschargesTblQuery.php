<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmstenderpschargesTbl]].
 *
 * @see CmstenderpschargesTbl
 */
class CmstenderpschargesTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmstenderpschargesTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstenderpschargesTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function tenderPSCharges($formdata) {
        $sharedFk = $formdata['contractPk'];
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        foreach ($formdata['additionalArray'] as $key => $dataVal) {
            if (($dataVal['lableName'] != null && !empty($dataVal['lableName'])) && ($dataVal['lableVal'] != null && !empty($dataVal['lableVal']))) {
                if ($dataVal['dataPk'] != null) {
                    $module = CmstenderpschargesTbl::find()
                            ->where(['cmstenderpscharges_pk' => $dataVal['dataPk']])
                            ->one();
                    $module->ctpsc_updatedon = $date;
                    $module->ctpsc_updatedby = $userPK;
                    $module->ctpsc_updatedbyipaddr = $ip_address;
                } else {
                    $module = new CmstenderpschargesTbl();
                    $module->ctpsc_shared_fk = $sharedFk;
                    $module->ctpsc_shared_type = 2;
                    $module->ctpsc_createdon = $date;
                    $module->ctpsc_createdby = $userPK;
                    $module->ctpsc_createdbyipaddr = $ip_address;
                }
                $module->ctpsc_type = $dataVal['additionalVal'] == '+' ? 1 : 2;
                $module->ctpsc_name = $dataVal['lableName'];
                $module->ctpsc_amount = $dataVal['lableVal'];
                if ($module->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'moduleData' => '',
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'Error',
                        'flag' => 'E',
                        'moduleData' => $module->getErrors(),
                    );
                }
            }
        }

        return $result;
    }

    public static function getTenderPSCharges($contractPk, $dataType) {
        $query = CmstenderpschargesTbl::find()
                ->select(['cmstenderpscharges_pk', 'ctpsc_type', 'ctpsc_name', 'ctpsc_amount'])
                ->where('ctpsc_shared_fk=:pk and ctpsc_shared_type = :dataType', [':pk' => $contractPk, ':dataType' => $dataType])
                ->asArray()
                ->all();
        $onlyCount = CmstenderpschargesTbl::find()
                ->select(['sum(if(ctpsc_type =1,ctpsc_amount,null)) as additionalAmount', 'sum(if(ctpsc_type =2,ctpsc_amount,null)) as deductionAmount',])
                ->where('ctpsc_shared_fk=:pk and ctpsc_shared_type = :dataType', [':pk' => $contractPk, ':dataType' => $dataType])
                ->asArray()
                ->one();

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $query,
            'onlyValue' => $onlyCount,
        );
        return $result;
    }
    public static function deleteTenderPScharges($dataPK) {
        $model = CmstenderpschargesTbl::find()->where('cmstenderpscharges_pk=:id', array(':id' => $dataPK))->one();
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

}
