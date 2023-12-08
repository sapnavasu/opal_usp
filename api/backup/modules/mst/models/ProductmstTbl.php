<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "productmst_tbl".
 *
 * @property int $ProductMst_Pk
 * @property int $PrdM_SegmentMst_Fk
 * @property int $PrdM_FamilyMst_Fk
 * @property int $PrdM_ClassMst_Fk
 * @property string $PrdM_ProductCode
 * @property string $PrdM_ProductName
 * @property string $PrdM_Status
 * @property string $PrdM_CreatedOn
 * @property int $PrdM_CreatedBy
 * @property string $PrdM_UpdatedOn
 * @property int $PrdM_UpdatedBy
 *
 * @property MemcomplookoutproddtlsTbl[] $memcomplookoutproddtlsTbls
 * @property MemcompproddtlsTbl[] $memcompproddtlsTbls
 */
class ProductmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PrdM_SegmentMst_Fk', 'PrdM_FamilyMst_Fk', 'PrdM_ClassMst_Fk', 'prdm_iscovid', 'PrdM_CreatedBy', 'PrdM_UpdatedBy'], 'integer'],
            [['PrdM_ProductCode', 'PrdM_ProductName', 'PrdM_Status', 'PrdM_CreatedOn', 'PrdM_CreatedBy'], 'required'],
            [['PrdM_Status'], 'string'],
            [['PrdM_CreatedOn', 'PrdM_UpdatedOn'], 'safe'],
            [['PrdM_ProductCode'], 'string', 'max' => 45],
            [['PrdM_ProductName'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
   {
       return [
           'ProductMst_Pk' => 'Product Mst  Pk',
           'PrdM_SegmentMst_Fk' => 'Prd M  Segment Mst  Fk',
           'PrdM_FamilyMst_Fk' => 'Prd M  Family Mst  Fk',
           'PrdM_ClassMst_Fk' => 'Prd M  Class Mst  Fk',
           'PrdM_ProductCode' => 'Prd M  Product Code',
           'PrdM_ProductName' => 'Prd M  Product Name',
           'PrdM_Status' => 'Prd M  Status',
           'prdm_iscovid' => 'Prdm Iscovid',
           'PrdM_CreatedOn' => 'Prd M  Created On',
           'PrdM_CreatedBy' => 'Prd M  Created By',
           'PrdM_UpdatedOn' => 'Prd M  Updated On',
           'PrdM_UpdatedBy' => 'Prd M  Updated By',
       ];
   }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcomplookoutproddtlsTbls()
    {
        return $this->hasMany(MemcomplookoutproddtlsTbl::className(), ['MCLPD_ProductMst_Fk' => 'ProductMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompproddtlsTbls()
    {
        return $this->hasMany(\common\models\MemcompproddtlsTbl::className(), ['MCPrD_ProductMst_Fk' => 'ProductMst_Pk']);
    }

    /**
     * {@inheritdoc}
     * @return ProductmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductmstTblQuery(get_called_class());
    }

    public static function getproductlisting()
    {
        if(isset($_GET['family']) && isset($_GET['class']) && isset($_GET['segment']))
        {
            $family=$_GET['family'];
            $family = explode(",",$family);
            $class=$_GET['class'];
            $class = explode(",",$class);
            $segment=$_GET['segment'];
            $segment = explode(",", $segment);
            $frbizsearch = $_GET['frbizsearch'];
            
            if($frbizsearch){
                $productmodel=ProductmstTbl::find()
                    ->select(['ProductMst_Pk','PrdM_ProductCode','concat(PrdM_ProductCode,"-",PrdM_ProductName) as PrdM_ProductName','ClsM_ClassName','PrdM_SegmentMst_Fk'])
                    ->leftJoin('classmst_tbl','ClassMst_Pk = PrdM_ClassMst_Fk')
                    ->leftJoin('familymst_tbl','FamilyMst_Pk = ClsM_FamilyMst_Fk')
                    ->leftJoin('segmentmst_tbl','segmentmst_pk = FamM_SegmentMst_Fk')
                    ->where(['IN','PrdM_FamilyMst_Fk',$family])
                    ->where(['=','PrdM_Status','A'])
                    ->andWhere(['IN','PrdM_SegmentMst_Fk',$segment])
                    ->andWhere(['IN','PrdM_ClassMst_Fk',$class])
                    ->orderBy([
                            'ClsM_ClassName' => SORT_ASC,
                            'PrdM_ProductName' => SORT_ASC
                        ])
                    ->asArray()->all();
            }else{
                $productmodel=ProductmstTbl::find()
                    ->select(['ProductMst_Pk','PrdM_ProductCode','PrdM_ProductName','ClsM_ClassName','PrdM_SegmentMst_Fk'])
                    ->leftJoin('classmst_tbl','ClassMst_Pk = PrdM_ClassMst_Fk')
                    ->leftJoin('familymst_tbl','FamilyMst_Pk = ClsM_FamilyMst_Fk')
                    ->leftJoin('segmentmst_tbl','segmentmst_pk = FamM_SegmentMst_Fk')
                    ->where(['IN','PrdM_FamilyMst_Fk',$family])
                    ->where(['=','PrdM_Status','A'])
                    ->andWhere(['IN','PrdM_SegmentMst_Fk',$segment])
                    ->andWhere(['IN','PrdM_ClassMst_Fk',$class])
                    ->asArray()->all();
            }
            
            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($productmodel)?$productmodel:[],
                'total_count' =>count($productmodel),
            ];
}
    }
    
    public function getProduct($company_id, $cat_type) {
        $productlist = self::find()  
            ->select(['ProductMst_Pk','PrdM_ProductName'])
            ->leftJoin('memcompproddtls_tbl','MCPrD_ProductMst_Fk = ProductMst_Pk')  
            ->where('MCPrD_MemberCompMst_Fk = :memcompk',['memcompk' => $company_id]) 
            ->orderBy('PrdM_ProductName ASC')
            ->asArray()
            ->all(); 
        
        
        return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($productlist) ? $productlist : [],
                'total_count' => count($productlist),
            ];
    }
    
    public function getallProduct($company_id) {
        
        $productlist = self::find()  
            ->select(['productmst_tbl.*', 'memcompproddtls_tbl.*'])
            ->leftJoin('memcompproddtls_tbl','MCPrD_ProductMst_Fk = ProductMst_Pk')  
            ->where('MCPrD_MemberCompMst_Fk = :memcompk',['memcompk' => $company_id]) 
            ->orderBy('PrdM_ProductName ASC')
            ->asArray();
        $provider = new ActiveDataProvider(['query' => $productlist, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'pagination' => false,
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
        
//        echo "<pre>"; print_r($productlist);exit;
//        return [
//                'msg' => "successaaaa",
//                'status' => 1,
//                'items' => !empty($productlist) ? $productlist : [],
//                'total_count' => count($productlist),
//            ];
    }
    
    public static function isAlreadyAvailable($colName,$colValue,$pk = ''){
        return self::find()
                ->where([$colName => $colValue])
                ->andFilterWhere(['<>','ProductMst_Pk',$pk])
                ->exists();
    }

    public function getproductonsearch($searchkey) {
        
        $productlist = BgiindcodecategTbl::find()  
            ->select(['bgiindcodecateg_pk','bgiindcodesubcateg_pk','bgiinduscodeprodmst_pk','bicc_categoryname','bicsc_subcategoryname','bicpm_productname', 'CONCAT(PrdM_ProductCode, "/", PrdM_ProductName)',
            'CONCAT(bicc_categoryname," > ",bicsc_subcategoryname," > ",bicpm_productname," > ",PrdM_ProductName) as breadcrumb',
            'CONCAT(PrdM_ProductCode, "/", PrdM_ProductName) as unpscproduct',
            'ProductMst_Pk', 'PrdM_ProductName','ubpm_bgiinduscodeprodmst_fk','bicpm_bgiindcodecateg_fk', 'bicpm_bgiindcodesubcateg_fk'])
            ->innerJoin('bgiindcodesubcateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')  
            ->innerJoin('bgiinduscodeprodmst_tbl','bgiindcodesubcateg_pk = bicpm_bgiindcodesubcateg_fk')  
            ->innerJoin('unspcbipcmapping_tbl','bgiinduscodeprodmst_pk = ubpm_bgiinduscodeprodmst_fk')  
            ->innerJoin('productmst_tbl','ubpm_productmst_fk = ProductMst_Pk')  
            ->Where('PrdM_ProductName like :ProductName', [':ProductName' => '%' . $searchkey . '%'])
            ->orWhere('PrdM_ProductCode like :ProductCode', [':ProductCode' => '%' . $searchkey . '%'])
            ->orderBy('PrdM_ProductName ASC')
            ->asArray()
            ->all();
        return $productlist;
    }

    public function getproductdetails($propk) {
        
        $productdetail = BgiindcodecategTbl::find()  
            ->select(['bgiindcodecateg_pk','bgiindcodesubcateg_pk','bgiinduscodeprodmst_pk','bicc_categoryname','bicsc_subcategoryname','bicpm_productname', 'CONCAT(PrdM_ProductCode, "/", PrdM_ProductName)',
            'CONCAT(bicc_categoryname," > ",bicsc_subcategoryname," > ",bicpm_productname," > ",PrdM_ProductName) as breadcrumb',
            'CONCAT(PrdM_ProductCode, "/", PrdM_ProductName) as unpscproduct',
            'ProductMst_Pk', 'PrdM_ProductName','ubpm_bgiinduscodeprodmst_fk','bicpm_bgiindcodecateg_fk', 'bicpm_bgiindcodesubcateg_fk'])
            ->innerJoin('bgiindcodesubcateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')  
            ->innerJoin('bgiinduscodeprodmst_tbl','bgiindcodesubcateg_pk = bicpm_bgiindcodesubcateg_fk')  
            ->innerJoin('unspcbipcmapping_tbl','bgiinduscodeprodmst_pk = ubpm_bgiinduscodeprodmst_fk')  
            ->innerJoin('productmst_tbl','ubpm_productmst_fk = ProductMst_Pk')  
            ->where('ProductMst_Pk =:pk',[':pk'=>$propk])
            ->asArray()
            ->all();
        return $productdetail;
    }
}
