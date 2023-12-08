<?php

namespace api\modules\pd\models;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
/**
 * This is the ActiveQuery class for [[ProjschememstTbl]].
 *
 * @see ProjschememstTbl
 */
class ProjschememstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjschememstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjschememstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function getprrojscheme($data) {
        if($data['schemetype']==1)
        {
            $typevalue='1,3';
        }else{
            $typevalue='2,4';
        }
        $model = ProjschememstTbl::find()
                ->where("psm_schemetype IN ($typevalue)")
                ->all();
        return $model;
    }
}
