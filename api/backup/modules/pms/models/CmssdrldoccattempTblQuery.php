<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmssdrldoccattempTbl]].
 *
 * @see CmssdrldoccattempTbl
 */
class CmssdrldoccattempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmssdrldoccattempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssdrldoccattempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function newDocumentCatSave($formdata) {
        if (!empty($formdata)) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $ip_address = Common::getIpAddress();
            $model = new CmssdrldoccattempTbl;
            $model->csdrldct_memcompmst_fk = $compPk;
            $model->csdrldct_doccategory = $formdata['documentCategory'];
            $model->csdrldct_doccode = $formdata['documentCode'];
            $model->csdrldct_docdesc = $formdata['description'];
            $model->csdrldct_createdon = $date;
            $model->csdrldct_createdby = $userPK;
            $model->csdrldct_createdbyipaddr = $ip_address;
            if ($model->save() === TRUE) {
                return $model->cmssdrldoccattemp_pk;
            }
        }
    }

    public function getDocumentCategory() {
        $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $query = [];
        if (!empty($compPk)) {
            $query = CmssdrldoccattempTbl::find()
                    ->select(['cmssdrldoccattemp_pk', 'csdrldct_doccategory', 'csdrldct_doccode', 'csdrldct_docdesc'])
                    ->where("csdrldct_memcompmst_fk=:compPk", [':compPk' => $compPk])
                    ->groupBy('csdrldct_doccategory')
                    ->orderBy(['csdrldct_doccategory' => SORT_ASC])
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
            $query = CmssdrldoccattempTbl::find()
                    ->select(['cmssdrldoccattemp_pk', 'csdrldct_doccategory', 'csdrldct_doccode', 'csdrldct_docdesc'])
                    ->where("csdrldct_memcompmst_fk=:compPk", [':compPk' => $compPk])
                    ->andFilterWhere(['IN', 'csdrldct_doccategory', $docVal])
                    ->groupBy('csdrldct_doccode')
                    ->orderBy(['csdrldct_doccode' => SORT_ASC])
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
