<?php

namespace api\modules\mst\models;

use yii\data\ActiveDataProvider;


/**
 * This is the ActiveQuery class for [[SegmentmstTbl]].
 *
 * @see SegmentmstTbl
 */
class SegmentmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SegmentmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SegmentmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active($db = null)
    {
        return $this->andWhere(['SegM_Status' => 'A'])->orderBy(['SegM_SegName' => SORT_ASC]);
    }

    public function getSegment($request,$checkkey){
        

        $query = SegmentmstTbl::find();
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
        $query->select(['SegmentMst_pk as item_id','SegM_SegName as item_value']);
        $query->where('SegM_SegCategory = :SegM_SegCategory',[':SegM_SegCategory' => $checkkey])
        ->andFilterWhere(['like', 'SegM_SegName', $request])->asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => FALSE
        ]); 
        return $provider;
    }

    public function findByPk($termid){
        return SegmentmstTbl::findOne($termid);
    }
    
    public function getActiveSegmentPk($segment,$type)
    {
        $query = \api\modules\mst\models\SegmentMstTbl::find()
                ->select(['Segmentmst_pk as pk'])
                ->where(['LIKE','SegM_SegmentName',$segment])
                ->andWhere(['=','SegM_SegCategory',$type])
                ->andWhere(['=','SegM_Status','A'])
                ->asArray()->all();
        return array_column($query, 'pk');
    }
}
