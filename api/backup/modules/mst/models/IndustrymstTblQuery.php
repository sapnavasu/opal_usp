<?php

namespace api\modules\mst\models;

use yii\data\ActiveDataProvider;


/**
 * This is the ActiveQuery class for [[IndustrymstTbl]].
 *
 * @see IndustrymstTbl
 */
class IndustrymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IndustrymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IndustrymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	  public function active($db = null)
    {
        return $this->andWhere(['IndM_Status' => 'A']);
    }

    public function getIndustry($request,$sectormst_pk = null){
        $query = IndustrymstTbl::find();
        $query->select(['IndustryMst_Pk as item_id','IndM_IndustryName as item_value']);
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
        $query->where('IndM_Status = :IndM_Status',[':IndM_Status' => 'A'])
        ->andFilterWhere(['like', 'IndM_IndustryName', $request])
        ->andFilterWhere(['=','IndM_SectorMst_Fk',$sectormst_pk])
        ->orderBy(['IndM_IndustryName' => SORT_ASC])
        ->asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $provider;
    }

    public function findByPk($pk){
        return IndustrymstTbl::findOne($pk);
    }

    public function getIndustrybySector($sectormst_pk){
        $query = IndustrymstTbl::find();
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
        $query->where('IndM_SectorMst_Fk = :IndM_SectorMst_Fk and IndM_Status = :IndM_Status',[':IndM_SectorMst_Fk' => $sectormst_pk,':IndM_Status' => 'A'])
        ->orderBy(['IndM_IndustryName' => SORT_ASC])
        ->asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $provider;
    }
    
    public function getActiveIndustryPk($industry){
        $query = \api\modules\mst\models\IndustrymstTbl::find()
                ->select('Industrymst_pk as pk')
                ->where(['LIKE','IndM_IndustryName',$industry])
                ->andWhere('IndM_Status = :IndM_Status',[':IndM_Status' => 'A'])
                ->asArray()->all();

        return array_column($query,'pk');
    }
}
