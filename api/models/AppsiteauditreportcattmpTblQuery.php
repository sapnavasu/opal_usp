<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppsiteauditreportcattmpTbl]].
 *
 * @see AppsiteauditreportcattmpTbl
 */
class AppsiteauditreportcattmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AppsiteauditreportcattmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AppsiteauditreportcattmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
