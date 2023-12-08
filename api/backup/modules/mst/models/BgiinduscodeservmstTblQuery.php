<?php

namespace api\modules\mst\models;
use yii\data\ActiveDataProvider;
use api\modules\mst\models\BgiinduscodeservmstTbl;

/**
 * This is the ActiveQuery class for [[BgiinduscodeservmstTbl]].
 *
 * @see BgiinduscodeservmstTbl
 */
class BgiinduscodeservmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BgiinduscodeservmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BgiinduscodeservmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    /**
     * {@inheritdoc}
     * @return BgiinduscodeservmstTbl|array|null
     */
/*     public function active($db = null)
    {
        return $this->andWhere(['sm_status' => 1]);
    } */

    public function getbgiservicelist() {
        if(isset($_GET['subcategory']) && !empty($_GET['subcategory']))
        { 
            $category = $_GET['category'];
            $subcategory = $_GET['subcategory'];
            
            $productmodel = BgiinduscodeservmstTbl::find()
                ->select(['bgiinduscodeservmst_pk','bicsm_servicename'])
                ->where(['=', 'bicsm_bgiindcodecateg_fk', $category])
                ->andWhere(['=','bicsm_bgiindcodesubcateg_fk', $subcategory])
                ->orderBy('bicsm_servicename ASC')
                ->asArray()->all();

            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($productmodel) ? $productmodel : [],
                'total_count' => count($productmodel),
            ];
        }
    }
    
	
   

}
