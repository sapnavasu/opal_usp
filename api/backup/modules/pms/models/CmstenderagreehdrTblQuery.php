<?php

namespace api\modules\pms\models;

use common\components\Common;

/**
 * This is the ActiveQuery class for [[CmstenderagreehdrTbl]].
 *
 * @see CmstenderagreehdrTbl
 */
class CmstenderagreehdrTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmstenderagreehdrTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstenderagreehdrTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function saveBuyerTerms($data) {
        $result = ['status' => true];
        if ($data) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (!empty($data['generalComment']) && $data['generalComment'] != null) {
                if (!empty($data['generalDataPk']) && $data['generalDataPk'] != null) {
                    $model = CmstenderagreehdrTbl::findOne($data['generalDataPk']);
                    $model->ctah_updatedon = $date;
                    $model->ctah_updatedby = $userPK;
                    $model->ctah_updatedbyipaddr = $ip_address;
                } else {
                    $model = new CmstenderagreehdrTbl();
                    $model->ctah_createdon = $date;
                    $model->ctah_createdby = $userPK;
                    $model->ctah_createdbyipaddr = $ip_address;
                    $model->ctah_cmsquotationhdr_fk = $data['currentPk'];
                    $model->ctah_category = 2;
                }
                $model->ctah_type = $data['generalIsAgreed'] == 'true' ? 1 : 2;
                $model->ctah_comments = $data['generalComment'];
                $model->ctah_remarks = $data['generalRemarks'];
                if (!$model->save()) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'Error',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors(),
                    );
                }
            }
            if (!empty($data['specificComment']) && $data['specificComment'] != null) {
                if (!empty($data['specificDataPk']) && $data['specificDataPk'] != null) {
                    $model = CmstenderagreehdrTbl::findOne($data['specificDataPk']);
                    $model->ctah_updatedon = $date;
                    $model->ctah_updatedby = $userPK;
                    $model->ctah_updatedbyipaddr = $ip_address;
                } else {
                    $model = new CmstenderagreehdrTbl();
                    $model->ctah_createdon = $date;
                    $model->ctah_createdby = $userPK;
                    $model->ctah_createdbyipaddr = $ip_address;
                    $model->ctah_cmsquotationhdr_fk = $data['currentPk'];
                    $model->ctah_category = 3;
                }
                $model->ctah_type = $data['specificIsAgreed'] == 'true' ? 1 : 2;
                $model->ctah_comments = $data['specificComment'];
                $model->ctah_remarks = $data['specificRemarks'];
                if (!$model->save()) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'Error',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors(),
                    );
                }
            }
        }
        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function findBySharedFk($dataPk, $dataType) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );

        if ($dataPk) {
            $data = CmstenderagreehdrTbl::find()
                    ->select(['cmstenderagreehdr_pk', 'ctah_type', 'ctah_comments', 'ctah_remarks'])
                    ->where(['ctah_cmsquotationhdr_fk' => $dataPk])
                    ->andWhere('ctah_category=:type', array(':type' => $dataType))
                    ->one();

            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $data
            );
        }
        return $result;
    }

}
