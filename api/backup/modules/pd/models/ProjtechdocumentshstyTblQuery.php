<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjtechdocumentshstyTbl]].
 *
 * @see ProjtechdocumentshstyTbl
 */
class ProjtechdocumentshstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjtechdocumentshstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechdocumentshstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
