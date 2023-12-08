<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[BgiindcodecategTbl]].
 *
 * @see BgiindcodecategTbl
 */
class BgiindcodecategTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BgiindcodecategTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BgiindcodecategTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function active($db = null)
    {
        return $this->andWhere(['bicc_categorystatus' => 1]);
    }

    public static function getlist($category = null, $searchkey) {
        $type = $category;
        // if($type == 'P') {
        //     $type = 1; 
        // } else {
        //     $type = 2; 
        // }
        if($searchkey == '') {
            $listofdata = BgiindcodecategTbl::find()->select(['bgiindcodecateg_pk','bicc_categoryname'])->where(['bicc_categorytype'=> $type,'bicc_categorystatus'=>1])->orderBy(['bicc_categoryname'=>SORT_ASC])->asArray()->all();
        } else {
            $listofdata = BgiindcodecategTbl::find()
                ->select(['bgiindcodecateg_pk','bicc_categoryname'])
                ->where(['bicc_categorytype'=> $type,'bicc_categorystatus'=>1, 'bicc_categoryname' => $searchkey])
                ->orderBy(['bicc_categoryname'=>SORT_ASC])
                ->asArray()
                ->all();
        }
        
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($listofdata)?$listofdata:[],
            'total_count' =>count($listofdata), 
        ];
    }

    public static function getcatlistforcompany($category = null) {
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $type = $category;
        if($type == 'P') {
            $type = 1; 
        } else {
            $type = 2; 
        }

        if($type == 1) {
            $listofdata = BgiindcodecategTbl::find()
                ->select(['bgiindcodecateg_pk','bicc_categoryname'])
                ->leftJoin('memcompproddtls_tbl', 'bgiindcodecateg_pk = mcprd_bgiindcodecateg_fk')
                ->where(['bicc_categorytype'=> $type, 'bicc_categorystatus'=>1])
                ->andWhere(['MCPrD_MemberCompMst_Fk'=> $company_id])
                ->andWhere('bgiindcodecateg_pk is not null')
                ->groupBy(['bgiindcodecateg_pk'])
                ->orderBy(['bicc_categoryname'=>SORT_ASC])
                ->asArray()
                ->all();
        } else {
            $listofdata = BgiindcodecategTbl::find()
                ->select(['bgiindcodecateg_pk','bicc_categoryname'])
                ->leftJoin('memcompservicedtls_tbl', 'bgiindcodecateg_pk = mcsvd_bgiindcodecateg_fk')
                ->where(['bicc_categorytype'=> $type, 'bicc_categorystatus'=>1])
                ->andWhere(['MCSvD_MemberCompMst_Fk'=> $company_id])
                ->andWhere('bgiindcodecateg_pk is not null')
                ->groupBy(['bgiindcodecateg_pk'])
                ->orderBy(['bicc_categoryname'=>SORT_ASC])
                ->asArray()
                ->all();
        }
        
        
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($listofdata)?$listofdata:[],
            'total_count' =>count($listofdata), 
        ];
    }

    public function getproductonsearch($searchkey, $type) {
        if($type  == 'product') {
            $productlist = BgiindcodecategTbl::find()->select(['PrdM_ProductCode','bgiindcodecateg_pk','bgiindcodesubcateg_pk','bgiinduscodeprodmst_pk','bicc_categoryname','bicsc_subcategoryname','bicpm_productname', 'CONCAT(PrdM_ProductCode, "/", PrdM_ProductName)',
                'CONCAT(bicc_categoryname," > ",bicsc_subcategoryname," > ",bicpm_productname," > ",PrdM_ProductName) as breadcrumb',
                'CONCAT(bicc_categoryname," > ",bicsc_subcategoryname," > ",bicpm_productname," > ") as paritialbreadcrumb',
                'CONCAT(PrdM_ProductCode, "/", PrdM_ProductName) as unpscproduct',
                'CONCAT(PrdM_ProductCode, "-", PrdM_ProductName) as productcodeandname',
                'ProductMst_Pk', 'PrdM_ProductName','ubpm_bgiinduscodeprodmst_fk','bicpm_bgiindcodecateg_fk', 'bicpm_bgiindcodesubcateg_fk'])
                ->innerJoin('bgiindcodesubcateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')  
                ->innerJoin('bgiinduscodeprodmst_tbl','bgiindcodesubcateg_pk = bicpm_bgiindcodesubcateg_fk')  
                ->innerJoin('unspcbipcmapping_tbl','bgiinduscodeprodmst_pk = ubpm_bgiinduscodeprodmst_fk')  
                ->innerJoin('productmst_tbl','ubpm_productmst_fk = ProductMst_Pk')  
                ->FilterWhere(['or',
                    ['like','PrdM_ProductName', $searchkey],
                    ['like','PrdM_ProductCode', $searchkey]
                ])
                ->andWhere(['=', 'bicc_categorytype', 'P'])
                ->orderBy('PrdM_ProductName ASC')
                ->groupBy(['breadcrumb'])
                ->createCommand()->queryAll(); 
        } else if($type  == 'Segment') {
            $productlist = BgiindcodecategTbl::find()->select(['bgiindcodecateg_pk', 'bicc_categoryname','CONCAT(bicc_categoryname) as breadcrumb'])
                ->FilterWhere(['and',
                    ['like','bicc_categoryname', $searchkey]
                ])
                ->orderBy('bicc_categoryname ASC')
                ->groupBy(['breadcrumb'])
                ->createCommand()->queryAll(); 
        } else if($type  == 'Family') {
            $productlist = BgiindcodecategTbl::find()->select(['bgiindcodecateg_pk','bgiindcodesubcateg_pk','bicc_categoryname','bicsc_subcategoryname',
                'CONCAT(bicc_categoryname," > ",bicsc_subcategoryname) as breadcrumb'])
                ->innerJoin('bgiindcodesubcateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')  
                ->FilterWhere(['or',
                    ['like','bicsc_subcategoryname', $searchkey],
                ])
                ->orderBy('bicsc_subcategoryname ASC')
                ->groupBy(['breadcrumb'])
                ->createCommand()->queryAll(); 
        }  else if($type  == 'Class') {
            $productlist = BgiindcodecategTbl::find()->select(['bgiindcodecateg_pk','bgiindcodesubcateg_pk','bgiinduscodeprodmst_pk',
                'bicc_categoryname','bicsc_subcategoryname','bicpm_productname',
                'CONCAT(bicc_categoryname," > ",bicsc_subcategoryname," > ",bicpm_productname) as breadcrumb'])
                ->innerJoin('bgiindcodesubcateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')  
                ->innerJoin('bgiinduscodeprodmst_tbl','bgiindcodesubcateg_pk = bicpm_bgiindcodesubcateg_fk')  
                ->innerJoin('unspcbipcmapping_tbl','bgiinduscodeprodmst_pk = ubpm_bgiinduscodeprodmst_fk')  
                ->FilterWhere(['or',
                    ['like','bicpm_productname', $searchkey],
                ])
            ->orderBy('bicpm_productname ASC')
            ->groupBy(['breadcrumb'])
            ->createCommand()
            ->queryAll(); 
        }
        
        return $productlist;
    }
}