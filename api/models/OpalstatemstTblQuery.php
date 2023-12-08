<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalstatemstTbl]].
 *
 * @see OpalstatemstTbl
 */
class OpalstatemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalstatemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalstatemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function active($db = null)
    {
        return $this->andWhere(['osm_status' => 1]);
    }
}
