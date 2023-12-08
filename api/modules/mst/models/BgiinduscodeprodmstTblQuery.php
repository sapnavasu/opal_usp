<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[BgiinduscodeprodmstTbl]].
 *
 * @see BgiinduscodeprodmstTbl
 */
class BgiinduscodeprodmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BgiinduscodeprodmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BgiinduscodeprodmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function getbgiproductlist($request = null) {
        if(isset($_GET['subcategory']) && !empty($_GET['subcategory'])) {
            $category = $_GET['category'];
            $subcategory = $_GET['subcategory'];
        } else {
            $category = $request['category'];
            $subcategory = $request['subcategory'];
        }
        if(isset($subcategory) && !empty($subcategory))
        { 
            // $category = $_GET['category'];
            // $subcategory = $_GET['subcategory'];
            
            $productmodel = BgiinduscodeprodmstTbl::find()
                ->select(['bgiinduscodeprodmst_pk','bicpm_productname'])
                ->where(['=', 'bicpm_bgiindcodecateg_fk', $category])
                ->andWhere(['=','bicpm_bgiindcodesubcateg_fk', $subcategory])
                ->orderBy('bicpm_productcode ASC')
                ->asArray()->all();

            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($productmodel) ? $productmodel : [],
                'total_count' => count($productmodel),
            ];
        }
    }

    public static function getbgiproductlistforcompany($request = null) {
        
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        // $category = $request['category'];
        $subcategory = $request['subcategory'];
        $type = $request['type'];

        if(isset($subcategory) && !empty($subcategory)) { 
            if($type == 'P') {
                $productmodel = BgiinduscodeprodmstTbl::find()
                    ->select(['bgiinduscodeprodmst_pk','bicpm_productname'])
                    ->leftJoin('memcompproddtls_tbl','bgiinduscodeprodmst_pk = mcprd_bgiinduscodeprodmst_fk')
                    // ->where(['=', 'bicpm_bgiindcodecateg_fk', $category])
                    ->where(['=','bicpm_bgiindcodesubcateg_fk', $subcategory])
                    ->andWhere(['=','MCPrD_MemberCompMst_Fk', $company_id])
                    ->groupBy('bgiinduscodeprodmst_pk')
                    ->orderBy('bicpm_productcode ASC')
                    ->asArray()->all();
            } else {
                $productmodel = BgiinduscodeservmstTbl::find()
                    ->select(['bgiinduscodeservmst_pk','bicsm_servicename'])
                    ->leftJoin('memcompservicedtls_tbl','bgiinduscodeservmst_pk = mcsvd_bgiinduscodeservmst_fk')
                    // ->where(['=', 'bicpm_bgiindcodecateg_fk', $category])
                    ->where(['=','bicsm_bgiindcodesubcateg_fk', $subcategory])
                    ->andWhere(['=','MCSvD_MemberCompMst_Fk', $company_id])
                    ->groupBy('bgiinduscodeservmst_pk')
                    ->orderBy('bicsm_servicecode ASC')
                    ->asArray()->all();
            }
            

            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($productmodel) ? $productmodel : [],
                'total_count' => count($productmodel),
            ];
        }
    }
}