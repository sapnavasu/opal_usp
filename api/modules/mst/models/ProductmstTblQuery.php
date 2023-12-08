<?php

namespace api\modules\mst\models;

use common\components\Search;
use yii\data\ActiveDataProvider;


/**
 * This is the ActiveQuery class for [[ProductmstTbl]].
 *
 * @see ProductmstTbl
 */
class ProductmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProductmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProductmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getProduct($request, $checkkey)
    {

        $query = ProductmstTbl::find();
        if ($_REQUEST['type'] == 'filter') {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach (array_filter($_REQUEST) as $key => $val) {
                if (!is_null($val)) {
                    $query->andFilterWhere(['LIKE', Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query->select(['ProductMst_Pk as item_id',
            'PrdM_ProductName as item_value',
            'concat(`PrdM_ProductCode`,"-",`PrdM_ProductName`) as productlist']);

        $incative_class_segment_family['segment']=0;
        $incative_class_segment_family['family']=0;
        $incative_class_segment_family['class']=0;
        if(isset($_REQUEST['searchby']))
        {
            $incative_class_segment_family=Search::skipinactivedata('P',4);

        }


        
        $query->filterWhere(['like', 'PrdM_ProductName', $request])
            ->orFilterWhere(['like', 'PrdM_ProductCode', $request])
            ->andWhere('PrdM_SegmentMst_Fk not in('.$incative_class_segment_family['segment'].') and PrdM_FamilyMst_Fk not in ('.$incative_class_segment_family['family'].') and PrdM_ClassMst_Fk not in('.$incative_class_segment_family['class'].')')
            ->asArray();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $provider;
    }

    public function findByPk($termid){
        return ProductmstTbl::findOne($termid);
    }

    public function getProductBySegment($segmentmst_pk,$familymst_pk,$classmst_pk)
    {

        $query = ProductmstTbl::find();
        if ($_REQUEST['type'] == 'filter') {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach (array_filter($_REQUEST) as $key => $val) {
                if (!is_null($val)) {
                    $query->andFilterWhere(['LIKE', Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query->where('PrdM_SegmentMst_Fk = :PrdM_SegmentMst_Fk and PrdM_FamilyMst_Fk = :PrdM_FamilyMst_Fk and PrdM_ClassMst_Fk = :PrdM_ClassMst_Fk',
        [':PrdM_SegmentMst_Fk' => $segmentmst_pk,':PrdM_FamilyMst_Fk' => $familymst_pk,':PrdM_ClassMst_Fk' => $classmst_pk])
       ->asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $provider;
    }
    
    public function getActiveProductPk($product)
    {
        $query = \api\modules\mst\models\SegmentMstTbl::find()
                ->select(['ProductMst_Pk as pk'])
                ->where(['LIKE','PrdM_ProductName',$product])
                ->andWhere(['=','PrdM_Status','A'])
                ->asArray()->all();
        return array_column($query, 'pk');
    }
    public function GetProductMstData($product)
    {
        $query = ProductmstTbl::find()
                ->select(['PrdM_ProductCode', 'PrdM_ProductName', 'ProductMst_Pk','PrdM_SegmentMst_Fk','PrdM_FamilyMst_Fk','PrdM_ClassMst_Fk'])
                ->where("ProductMst_Pk =:pk", [':pk' => $product])
                ->asArray()->one();
        return $query;
    }
}
