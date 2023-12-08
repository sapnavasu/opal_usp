<?php

namespace api\modules\mst\models;

use common\components\Search;
use yii\data\ActiveDataProvider;


/**
 * This is the ActiveQuery class for [[ClassmstTbl]].
 *
 * @see ClassmstTbl
 */
class ClassmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ClassmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ClassmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function active($db = null)
    {
        return $this->andWhere(['ClsM_Status' => 'A'])->orderBy(['ClsM_ClassName' => SORT_ASC]);
    }

    public function getClass($request, $checkkey)
    {


        $query = ClassmstTbl::find();
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
        $seg_family_inactive['family']=0;
        if(isset($_REQUEST['searchby'])) {

            $seg_family_inactive=Search::skipinactivedata('P',3);



        }
        $query->select(['ClassMst_Pk as item_id','ClsM_ClassName as item_value']);
        $query->where('ClsM_FamilyCategory = :ClsM_FamilyCategory', [':ClsM_FamilyCategory' => $checkkey])
            ->andFilterWhere(['like', 'ClsM_ClassName', $request])
            ->andWhere('ClsM_FamilyMst_Fk not in('.$seg_family_inactive['family'].')')->
            asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $provider;
    }

    public function findByPk($termid){
        return ClassmstTbl::findOne($termid);
    }

    public function getClassbySegment($segmentmst_pk,$familymst_pk,$category){
        $query = ClassmstTbl::find();
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
        $query->where('ClsM_FamilyCategory = :ClsM_FamilyCategory and ClsM_SegmentMst_Fk = :ClsM_SegmentMst_Fk and ClsM_FamilyMst_Fk = :ClsM_FamilyMst_Fk',
         [':ClsM_FamilyCategory' => $category,':ClsM_SegmentMst_Fk' => $segmentmst_pk,':ClsM_FamilyMst_Fk' => $familymst_pk])
        ->asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $provider;
    }
    
    public function getActiveClassPk($class,$type)
    {
        $query = \api\modules\mst\models\SegmentMstTbl::find()
                ->select(['ClassMst_Pk as pk'])
                ->where(['LIKE','ClsM_ClassName',$class])
                ->andWhere(['=','ClsM_FamilyCategory',$type])
                ->andWhere(['=','ClsM_Status','A'])
                ->asArray()->all();
        return array_column($query, 'pk');
    }
}
