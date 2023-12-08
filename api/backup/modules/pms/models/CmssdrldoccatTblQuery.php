<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmssdrldoccatTbl]].
 *
 * @see CmssdrldoccatTbl
 */
class CmssdrldoccatTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmssdrldoccatTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssdrldoccatTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function newDocumentCatSave($formdata) {
        if (!empty($formdata)) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $ip_address = Common::getIpAddress();
            $model = new CmssdrldoccatTbl;
            $model->csdrldc_memcompmst_fk = $compPk;
            $model->csdrldc_doccategory = $formdata['documentCategory'];
            $model->csdrldc_doccode = $formdata['documentCode'];
            $model->csdrldc_docdesc = $formdata['description'];
            $model->csdrldc_createdon = $date;
            $model->csdrldc_createdby = $userPK;
            $model->csdrldc_createdbyipaddr = $ip_address;
            if ($model->save() === TRUE) {
                return $model->cmssdrldoccat_pk;
            }  else {
                return $model->getErrors();
            }
        }
    }

    public function getDocumentCategory() {
        $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $query = [];
        if (!empty($compPk)) {
            $query = CmssdrldoccatTbl::find()
                    ->select(['cmssdrldoccat_pk', 'csdrldc_doccategory', 'csdrldc_doccode', 'csdrldc_docdesc'])
                    ->where("csdrldc_memcompmst_fk=:compPk", [':compPk' => $compPk])
                    ->groupBy('csdrldc_doccategory')
                    ->orderBy(['csdrldc_doccategory' => SORT_ASC])
                    ->asArray()
                    ->all();
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'documentArray' => $query,
        );
        return $result;
    }

    public function getDocumentCode($docVal) {
        $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $query = [];
        if (!empty($compPk)) {
            $query = CmssdrldoccatTbl::find()
                    ->select(['cmssdrldoccat_pk', 'csdrldc_doccategory', 'csdrldc_doccode', 'csdrldc_docdesc'])
                    ->where("csdrldc_memcompmst_fk=:compPk", [':compPk' => $compPk])
                    ->andFilterWhere(['IN', 'csdrldc_doccategory', $docVal])
                    ->groupBy('csdrldc_doccode')
                    ->orderBy(['csdrldc_doccode' => SORT_ASC])
                    ->asArray()
                    ->all();
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'documentCodeArray' => $query,
        );
        return $result;
    }

}
