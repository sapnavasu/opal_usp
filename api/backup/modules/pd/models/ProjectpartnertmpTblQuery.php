<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjectpartnertmpTbl]].
 *
 * @see ProjectpartnertmpTbl
 */
class ProjectpartnertmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectpartnertmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectpartnertmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
