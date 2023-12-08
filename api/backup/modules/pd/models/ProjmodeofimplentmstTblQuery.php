<?php

namespace api\modules\pd\models;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;

/**
 * This is the ActiveQuery class for [[ProjmodeofimplentmstTbl]].
 *
 * @see ProjmodeofimplentmstTbl
 */
class ProjmodeofimplentmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjmodeofimplentmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjmodeofimplentmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function getmodeofdetails($data){
        $modetype=Security::sanitizeInput($data['modetypeofpk'], "number");
        $model = ProjmodeofimplentmstTbl::find()
                ->where('pmim_modetype=:modetype',array(':modetype'=>  $modetype))
                ->all();
        return $model;
    }
}
