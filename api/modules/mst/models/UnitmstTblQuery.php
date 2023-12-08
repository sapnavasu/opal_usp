<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[UnitmstTbl]].
 *
 * @see UnitmstTbl
 */
class UnitmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UnitmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UnitmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public static function getUnitMasterData() {
        $model = UnitmstTbl::find()
                ->select(['unm_namesg_en','unitmst_pk','unm_nameplu','unm_symbol'])
                ->where("unm_status=1")
                ->orderBy('unm_namesg_en ASC')
                ->asArray()
                ->all();        
        return $model;
    }
    public static function getUnitVal($dataPk) {
        $model = UnitmstTbl::find()
                ->select(['unm_namesg_en','unm_namesg_en'])
                ->where("unm_status=1 and unitmst_pk=$dataPk")
                ->asArray()
                ->one();        
        return $model;
    }
}
