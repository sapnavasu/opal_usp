<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpaldesignationmstTbl]].
 *
 * @see OpaldesignationmstTbl
 */
class OpaldesignationmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpaldesignationmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpaldesignationmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
