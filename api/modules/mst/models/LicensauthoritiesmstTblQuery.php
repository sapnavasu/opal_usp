<?php

namespace api\modules\mst\models;
use Yii;
use yii\data\ActiveDataProvider;
use api\modules\mst\models\LicensauthoritiesmstTbl;
use common\components\Security;

/**
 * This is the ActiveQuery class for [[LicensauthoritiesmstTbl]].
 *
 * @see LicensauthoritiesmstTbl
 */
class LicensauthoritiesmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LicensauthoritiesmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LicensauthoritiesmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function activelicenseauthorities()
    {
        $model = LicensauthoritiesmstTbl::find()
                ->select(['licensauthoritiesmst_pk as value','lam_licenseauthname_en as display'])
                ->where(['=','lam_status',1])
                ->orderBy(['lam_licenseauthname_en'=> SORT_ASC])
                ->asArray()->All();
        return $model;
       
    }

    public function editauthoritiesprj($data)
    {
      $list = array(); 
        $a= $data['list']; 
        $a = explode (",", $a);  
        $max=sizeof($a);
        for($i=0; $i<$max; $i++) { 
            $name = LicensauthoritiesmstTbl::find()
                ->select(['licensauthoritiesmst_pk','lam_licenseauthname_en'])
                ->where(['=','lam_status',1])
                ->andwhere('licensauthoritiesmst_pk=:pk',array(':pk'=>Security::sanitizeInput($a[$i],"number")))->one()->lam_licenseauthname_en;
            // echo "$a[$i]"; 
            array_push( $list,$name);
        }
        return $list;
    }
}
