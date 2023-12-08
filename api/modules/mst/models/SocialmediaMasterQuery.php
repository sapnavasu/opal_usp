<?php

namespace api\modules\mst\models;
use yii\data\ActiveDataProvider;
use api\modules\mst\models\SocialmediaMaster;

/**
 * This is the ActiveQuery class for [[SocialmediaMaster]].
 *
 * @see SocialmediaMaster
 */
class SocialmediaMasterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SocialmediaMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SocialmediaMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    /**
     * {@inheritdoc}
     * @return SocialmediaMaster|array|null
     */
    public function active($db = null)
    {
        return $this->andWhere(['sm_status' => 1]);
    }
    
	
    public function chkSocialmedia($socialmediaName) {
        $socialmediaTblFind = SocialmediaMaster::find()->select(['socialmediamst_pk'])->where("sm_name ='$socialmediaName'")->asArray()->one();
        $socialmediaPk = $socialmediaTblFind['socialmediamst_pk'];
        return $socialmediaPk;
    }

}
