<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjtechdocumentsTbl]].
 *
 * @see ProjtechdocumentsTbl
 */
class ProjtechdocumentsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjtechdocumentsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechdocumentsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
