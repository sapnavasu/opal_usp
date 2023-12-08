<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjownershipmstTbl]].
 *
 * @see ProjownershipmstTbl
 */
class ProjownershipmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjownershipmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjownershipmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function projownerlist(){
        return ProjownershipmstTbl::find()
                ->select(['projownershipmst_pk','posm_ownership'])
                ->asArray()
                ->all();
    }
}
