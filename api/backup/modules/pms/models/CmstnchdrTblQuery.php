<?php

namespace api\modules\pms\models;

use yii\data\ActiveDataProvider;
use common\components\Common;
use yii\db\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Database;
use yii\base\Exception as YiiException;

/**
 * This is the ActiveQuery class for [[CmstnchdrTbl]].
 *
 * @see CmstnchdrTbl
 */
class CmstnchdrTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmstnchdrTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstnchdrTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public static function GetSupplierUserData($type) {
        $module = CmstnchdrTbl::find()
                        ->select(['cmstnchdr_pk', 'ctnch_name', 'ctnch_ismandatory', 'ctnch_sampletext', 'ctnch_status'])
                        ->where('ctnch_type=:fk', [':fk' => $type])
                        ->andWhere("ctnch_status = 1")
                        ->orderBy('cmstnchdr_pk ASC')
                        ->asArray()->All();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $module,
        );
        return $result;
    }

}
