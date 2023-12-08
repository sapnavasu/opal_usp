<?php

namespace api\modules\mst\models;
use yii\data\ActiveDataProvider;
use api\modules\mst\models\IncorpstyleMaster;

/**
 * This is the ActiveQuery class for [[IncorpstyleMaster]].
 *
 * @see IncorpstyleMaster
 */
class IncorpstyleMasterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IncorpstyleMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IncorpstyleMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    /**
     * {@inheritdoc}
     * @return IncorpstyleMaster|array|null
     */
/*     public function active($db = null)
    {
        return $this->andWhere(['sm_status' => 1]);
    } */
    
	
    public function chkIncorpstyle($incorpstyleName) {
        $incorpstyleTblFind = IncorpstyleMaster::find()->select(['MemCompIncorpStyleMst_Pk'])->where("MCISM_IncorpStyleEntity ='$incorpstyleName'")->asArray()->one();
        $incorpstylePk = $incorpstyleTblFind['MemCompIncorpStyleMst_Pk'];
        return $incorpstylePk;
    }
    
    public static function getIncorplist(){        
        $model = Incorpstylemaster::find()
                ->select(['IncorpStyleMst_Pk','ISM_IncorpStyleEntity'])
                ->where(['=','ISM_Status','A'])
                ->andWhere(['=','ISM_CountryMst_Fk', 31])
                ->andWhere(['=','ism_stkholdertypmst_fk', 6])
                ->orderBy(['ISM_IncorpStyleEntity'=> SORT_ASC])
                ->asArray()->all();
        return $model;
    }

    public function incorpstyleCacheQuery(){
        return Incorpstylemaster::find()
        ->select('count(*)')
        ->createCommand()
        ->getRawSql();
    }
}
