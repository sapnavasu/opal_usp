<?php

namespace api\modules\mst\models;

use yii\data\ActiveDataProvider;
use \api\modules\mst\models\ActivitiesmstTbl;


/**
 * This is the ActiveQuery class for [[ActivitiesmstTbl]].
 *
 * @see ActivitiesmstTbl
 */
class ActivitiesmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ActivitiesmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ActivitiesmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	  public function active($db = null)
    {
        return $this->andWhere(['ActM_Status' => 'A']);
    }

    public function getActivties($request,$sectormst_pk = null,$industrymst_pk = null){
        $query = ActivitiesmstTbl::find();
        $query->select(['ActivitiesMst_Pk as item_id','ActM_ActivityName as item_value']);
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
        
        if(isset($_GET['term']))
        {
           // $query->where('ActM_SectorMst_Fk =:ActM_SectorMst_Fk and ActM_IndustryMst_Fk =:ActM_IndustryMst_Fk and ActM_Status = :ActM_Status',['ActM_SectorMst_Fk' => $_GET['sector'],'ActM_IndustryMst_Fk' => $_GET['industry'],':ActM_Status' => 'A'])
            $query->andFilterWhere(['LIKE', 'ActM_ActivityName', $request])->asArray();
        }
        else{
            $query->where('ActM_SectorMst_Fk =:ActM_SectorMst_Fk and ActM_IndustryMst_Fk =:ActM_IndustryMst_Fk and ActM_Status = :ActM_Status',['ActM_SectorMst_Fk' => $_GET['sector'],'ActM_IndustryMst_Fk' => $_GET['industry'],':ActM_Status' => 'A'])
            ->asArray();
        }
       

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $provider;
    }

    public function findByPk($pk){
        return ActivitiesmstTbl::findOne($pk);
    }
    
    public static function getBsearchActivityList($search_term,$sort,$recentlyJoined,$filter = null,$queryAllData = false) {
        $query = \common\models\MembercompanyMstTbl::find()
        ->select(['distinct(MemberCompMst_Pk) as company_pk','memcompsecdtls_pk as pk', 'MCM_CompanyName as company_name',
            'MCM_SupplierCode as supplier_code', 'CyM_CountryName_en as country','CountryMst_Pk as countrypk',
            'CM_CityName_en as city', 'MemberCompMst_Pk as favourites',
            'MemberCompMst_Pk as recommended',
            "if((MRM_ValSubStatus = 'A' AND MRM_MemberStatus = 'A'),1,0) as jsrsts"])
        ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
        ->innerJoin('memcompsectordtls_tbl', 'MCSD_MemberCompMst_FK =  MemberCompMst_Pk')
        ->innerJoin('memcompsectoractivitydtls_tbl', 'MCSAD_MemCompSecDtls_Fk =  memcompsecdtls_pk')
//        $query->leftJoin('activitiesmst_tbl', 'MCSAD_activitiesmst_fk = Activitiesmst_Pk');
        ->leftJoin('countrymst_tbl', 'CountryMst_Pk = MCM_Source_CountryMst_Fk')
        ->leftJoin('CityMst_tbl', 'CityMst_Pk = MCM_CityMst_Fk');
        $sectorpks = \api\modules\mst\models\SectorMstTblQuery::getActiveSectorPk($search_term);
        $industrypks = \api\modules\mst\models\IndustryMstTblQuery::getActiveIndustryPk($search_term);
        $activitypks = self::getActiveActivityPk($search_term);
        if(!empty($sectorpks) || !empty($industrypks) || !empty($activitypks)){
            $query->andFilterWhere(['or',
                ['IN', 'MCSD_SectorMst_Fk', $sectorpks],
                ['IN', 'MCSD_IndustryMst_Fk', $industrypks],
                ['IN', 'MCSAD_ActivitiesMst_Fk', $activitypks]
            ]);
        }else{
            $query->where('0');
        }
        $query->bizfilter($query,$filter);
        $query->bizadditionalfilter($query,$filter);
        if ($recentlyJoined) {
            $query->orderBy(['MemberCompMst_Pk' => SORT_DESC]);
        } else {
            $query->orderBy(['MCM_CompanyName' => ($sort == 'asc') ? SORT_ASC : SORT_DESC]);
        }
        $query->andWhere('MRM_MemberStatus =:MRM_MemberStatus and MRM_ProfileStatus =:MRM_ProfileStatus', [':MRM_MemberStatus' => 'A', ':MRM_ProfileStatus' => 'C']);
        $query->groupBy(['MemberCompMst_Pk']);
        $query->asArray();
        $query->all();
        if($queryAllData){
            $page = false;
        }else{
            $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 10;
        }

        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => $page]
        ]);

        return $provider->getModels();
    }

    public function get_activities_list($companyPk)
    {
        $activityList = ActivitiesmstTbl::find()
            ->select(['ActM_ActivityName','ActivitiesMst_Pk'])
            ->leftJoin('memcompsectoractivitydtls_tbl','mcsad_activitiesmst_fk = ActivitiesMst_Pk')
            ->leftJoin('memcompsectordtls_tbl','memcompsecdtls_pk = mcsad_memcompsecdtls_fk')
            ->leftJoin('membercompanymst_tbl','membercompmst_pk = MCSD_MemberCompMst_Fk')
            ->where(['MemberCompMst_Pk' => $companyPk])
            ->asArray()->all();
        
        return $activityList;
    }
    
    public function getActiveActivityPk($activity){
        $query = \api\modules\mst\models\ActivitiesmstTbl::find()
                ->select('Activitiesmst_pk as pk')
                ->where(['LIKE','ActM_ActivityName',$activity])
                ->andWhere('ActM_Status = :ActM_Status',[':ActM_Status' => 'A'])
                ->asArray()->all();
        
        return array_column($query,'pk');
    }
}
