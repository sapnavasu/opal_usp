<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjtechnicalhstyTbl]].
 *
 * @see ProjtechnicalhstyTbl
 */
class ProjtechnicalhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjtechnicalhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechnicalhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
