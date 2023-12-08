<?php

namespace api\modules\mst\models;

use common\components\Search;
use yii\data\ActiveDataProvider;


/**
 * This is the ActiveQuery class for [[FamilymstTbl]].
 *
 * @see FamilymstTbl
 */
class FamilymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FamilymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FamilymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function active($db = null)
       {
       return $this->andWhere(['FamM_Status' => 'A'])->orderBy(['FamM_FamilyName' => SORT_ASC]);
       }
    public function allDetails($db = null)
       {
       return $this->joinWith("segdt")->select("*")->andWhere(['FamM_Status' => 'A']);
       }

       public function getFamily($request,$checkkey){
        

        $query = FamilymstTbl::find();
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
        $seg_inactive['segment']=0;
        if(isset($_REQUEST['searchby']))
        {

            $seg_inactive=Search::skipinactivedata('P',2);

            

        }
        $query->select(['FamilyMst_pk as item_id','FamM_FamilyName as item_value']);
        $query->where('FamM_FamilyCategory = :FamM_FamilyCategory',[':FamM_FamilyCategory' => $checkkey])
        ->andFilterWhere(['like', 'FamM_FamilyName', $request])
        ->andWhere('FamM_SegmentMst_Fk not in('.$seg_inactive['segment'].')')->asArray();
        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => FALSE
        ]); 
        return $provider;
    }

    public function findByPk($termid){
        return FamilymstTbl::findOne($termid);
    }
    public function getFamilybySegment($segmentmst_pk,$category){
        

        $query = FamilymstTbl::find();
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
        $query->where('FamM_FamilyCategory = :FamM_FamilyCategory and FamM_SegmentMst_Fk =:FamM_SegmentMst_Fk ',[':FamM_FamilyCategory' => $category, ':FamM_SegmentMst_Fk' => $segmentmst_pk])
        ->asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => FALSE
        ]); 
        return $provider;
    }
    
    public function getActiveFamilyPk($family,$type)
    {
        $query = \api\modules\mst\models\FamilyMstTbl::find()
                ->select(['FamilyMst_Pk as pk'])
                ->where(['LIKE','FamM_FamilyName',$family])
                ->andWhere(['=','FamM_FamilyCategory',$type])
                ->andWhere(['=','FamM_Status','A'])
                ->asArray()->all();
        return array_column($query, 'pk');
    }
}
