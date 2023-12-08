<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProjectmstTbl]].
 *
 * @see ProjectmstTbl
 */
class ProjectmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
