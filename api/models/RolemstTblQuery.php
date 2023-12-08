<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RolemstTbl]].
 *
 * @see RolemstTbl
 */
class RolemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RolemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RolemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function gethigerroles(){
        $gethigherroledata = [];
        $gethighrroles = \app\models\RolemstTbl::find()
                ->select(['group_concat(DISTINCT rm_higherrole) as higherrrole'])
                ->where("rm_status = 1")->asArray()->one();
        $higherdata = $gethighrroles['higherrrole'];
        if(!empty($higherdata)){
            $higdata = trim(implode(',',array_unique(explode(',', $higherdata))),',');
            $gethigherroledata = \app\models\RolemstTbl::find()->select(['rolemst_pk','rm_rolename_en  as hgeren','rm_rolename_ar as hgerar'])
                   ->where("rolemst_pk in ($higdata)")->asArray()->all();
        }
        return $gethigherroledata;
    }
}
