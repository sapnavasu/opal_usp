<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjtechdocumentstmpTbl]].
 *
 * @see ProjtechdocumentstmpTbl
 */
class ProjtechdocumentstmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjtechdocumentstmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechdocumentstmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
