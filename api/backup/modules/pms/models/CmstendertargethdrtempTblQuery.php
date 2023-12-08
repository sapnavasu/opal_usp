<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmstendertargethdrtempTbl]].
 *
 * @see CmstendertargethdrtempTbl
 */
class CmstendertargethdrtempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmstendertargethdrtempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstendertargethdrtempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public static function saveData($data) {
        $model = new CmstendertargethdrtempTbl();     
        $model->attributes = $data;
        $model->save();
    }
}
