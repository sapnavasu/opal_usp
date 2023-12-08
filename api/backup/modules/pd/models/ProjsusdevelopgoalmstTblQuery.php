<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjsusdevelopgoalmstTbl]].
 *
 * @see ProjsusdevelopgoalmstTbl
 */
class ProjsusdevelopgoalmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjsusdevelopgoalmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjsusdevelopgoalmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function list()
    {
  
            $model = ProjsusdevelopgoalmstTbl::find()
                ->select(['projsusdevelopgoalmst_pk','psdgm_sustaindevelopgoal'])
                ->where(['psdgm_status' => 1])
                ->asArray()->all();
            return $model;
    }
}
