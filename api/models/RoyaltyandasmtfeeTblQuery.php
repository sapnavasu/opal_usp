<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RoyaltyandasmtfeeTbl]].
 *
 * @see RoyaltyandasmtfeeTbl
 */
class RoyaltyandasmtfeeTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RoyaltyandasmtfeeTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RoyaltyandasmtfeeTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
