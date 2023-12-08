<?php

namespace api\modules\mst\models;

use common\components\Search;
use yii\data\ActiveDataProvider;


/**
 * This is the ActiveQuery class for [[ServicemstTbl]].
 *
 * @see ServicemstTbl
 */
class ServicemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ServicemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ServicemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function active($db = null)
    {
        return $this->andWhere(['SrvM_Status' => 'A']);
    }

    public function getService($request,$checkkey){
        $query = ServicemstTbl::find();
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
        $query->select(['ServiceMst_Pk as item_id','SrvM_ServiceName as item_value', 'concat(`SrvM_ServiceCode`,"-",`SrvM_ServiceName`) as servicelist']);

        $seg_family_class_inactive['class']=0;
        $seg_family_class_inactive['family']=0;
        $seg_family_class_inactive['segment']=0;
        if(isset($_REQUEST['searchby']))
        {
            $seg_family_class_inactive=Search::skipinactivedata('S',4);
        }

        $query->filterWhere(['like', 'SrvM_ServiceName', $request])
            ->orFilterWhere(['like', 'SrvM_ServiceCode', $request])
            ->andWhere('SrvM_ClassMst_Fk not in('.$seg_family_class_inactive['class'].') and SrvM_FamilyMst_Fk not in('.$seg_family_class_inactive['family'].') and SrvM_SegmentMst_Fk not in('.$seg_family_class_inactive['segment'].')')
            ->asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $provider;
    }

    public function findByPk($termid){
        return ServicemstTbl::findOne($termid);
    }
    
    public function getActiveServicePk($service)
    {
        $query = \api\modules\mst\models\SegmentMstTbl::find()
                ->select(['ServiceMst_Pk as pk'])
                ->where(['LIKE','SrvM_ServiceName',$service])
                ->andWhere(['=','SrvM_Status','A'])
                ->asArray()->all();
        return array_column($query, 'pk');
    }

    public function GetServiceMstData($service)
    {
        $query = ServicemstTbl::find()
                ->where("ServiceMst_Pk =:pk", [':pk' => $service])
                ->asArray()->one();
        return $query;
    }
}
