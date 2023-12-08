<?php

namespace api\modules\mst\models;

use yii\data\ActiveDataProvider;
use \api\modules\mst\models\SectormstTbl;

/**
 * This is the ActiveQuery class for [[SectormstTbl]].
 *
 * @see SectormstTbl
 */
class SectormstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SectormstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SectormstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	  public function active($db = null)
    {
        return $this->andWhere(['SecM_Status' => 'A']);
    }

    public function getSector($request){
        $query = SectormstTbl::find();
        $query->select(['SectorMst_Pk as item_id','SecM_SectorName as item_value']);
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
        $query->where('SecM_Status = :SecM_Status',[':SecM_Status' => 'A'])
        ->andFilterWhere(['like', 'SecM_SectorName', $request])->asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $provider;
    }

    public function findByPk($pk){
        return SectormstTbl::findOne($pk);
    }
    
    public function getActiveSectorPk($sector){
        $query = SectormstTbl::find()
                ->select('SectorMst_Pk as pk')
                ->where(['LIKE','SecM_SectorName',$sector])
                ->andWhere('SecM_Status = :SecM_Status',[':SecM_Status' => 'A'])
                ->asArray()->all();
        return $query['pk'];
    }

    public function activesector(){
        return SectormstTbl::find()
                ->select(['SectorMst_Pk','SecM_SectorName'])
                ->where('SecM_Status = :SecM_Status',[':SecM_Status' => 'A'])
                ->orderBy('SecM_SectorName ASC')
                ->asArray()
                ->all();
    }

    public function activesectorCache(){
        return SectormstTbl::find()
            ->select(['max(SecM_UpdatedOn), count(*)'])
            ->createCommand()
            ->getRawSql();
    }
    
    public static function getActSector(){
        return SectormstTbl::find()
                ->select(['SectorMst_Pk as value','SecM_SectorName as name'])
                ->where('SecM_Status = :SecM_Status',[':SecM_Status' => 'A'])
                ->orderBy('SecM_SectorName ASC')
                ->asArray()
                ->all();
    }
    public function getsectordetail(){
        $sectorlist = [];
        $model = SectormstTbl::find()
                        ->select(['SectorMst_Pk', 'SecM_SectorName'])
                        ->where(['SecM_Status' => 'A'])
                        ->orderBy(['SectorMst_Pk'=>SORT_ASC])
                        ->asArray()->all();
        if(!empty($model)){
            foreach ($model as $value) {
                $sectorlist[$value['SectorMst_Pk']] = $value['SecM_SectorName'];
            }
        }
        return $sectorlist;
    }
}
