<?php

namespace api\modules\inv\models;
use yii\data\ActiveDataProvider;
use common\components\Security;



/**
 * This is the ActiveQuery class for [[LicprocedurepinupTbl]].
 *
 * @see LicprocedurepinupTbl
 */
class LicprocedurepinupTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LicprocedurepinupTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LicprocedurepinupTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public static function getpinnedlist($data){
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $searchname = Security::sanitizeInput($data['search'], "string");
        $model = LicprocedurepinupTbl::find();
        $model->all();
        $model->select([
            'licprocedurepinup_pk',
            'lppu_licensinginfo_fk',
            'lppu_sectorprocedure_fk',
            'lppu_pinned_on',
            'lppu_pinnedby',
            'lppu_memcompmst_fk',
            'SectorMst_Pk',
            'SecM_SectorName',
            'IndustryMst_Pk',
            'IndM_IndustryName',
            'um_firstname',
            'li_referenceno',
            'li_lictitleen',
            'lpm_splicauth_fk',
        ]);
        $model->leftJoin('licensinginfo_tbl','licensinginfo_tbl.licensinginfo_pk=licprocedurepinup_tbl.lppu_licensinginfo_fk');
        $model->leftJoin('licproceduremst_tbl','licproceduremst_tbl.licproceduremst_pk=licprocedurepinup_tbl.lppu_sectorprocedure_fk');
        $model->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=licprocedurepinup_tbl.lppu_pinnedby');
        $model->leftJoin('industrymst_tbl','industrymst_tbl.IndustryMst_Pk=licensinginfo_tbl.li_industrymst_fk');
        $model->leftJoin('sectormst_tbl','sectormst_tbl.SectorMst_Pk=licensinginfo_tbl.li_sectormst_fk'); 
        $model->andWhere('licprocedurepinup_tbl.lppu_memcompmst_fk=:id',array(':id' =>  $companypk));
        $model->asArray();
        $sortpk = $data['sort'];
        if($sortpk==1){
            $model->orderBy('lppu_pinned_on DESC');
            }else {
            $model->orderBy('lppu_pinned_on ASC');    
            }
            if($searchname != ''){
                $model->andFilterWhere(['or',['LIKE','li_referenceno', ':value',array(':value' =>  $searchname)],['LIKE','li_lictitleen', ':value',array(':value' =>  $searchname)]]);
            }
    

    if($data['filter'] =='filter')
    {
        unset($data['page']);
        unset($data['size']);
        unset($data['filter']);
        unset($data['sort']);
        unset($data['search']);

        foreach(array_filter($data) as $key =>$val)
        {
            if($val !=null)
            {
                  $model->andOnCondition("$key IN ($val)");
            }
        }
    }

        $page = (!empty($_REQUEST['size'])) ? $_REQUEST['size'] : 10; 
        $provider = new ActiveDataProvider([
            'query' => $model, 
            'pagination' => ['pageSize' => $page],
        ]);
        
        $model2 = LicprocedurepinupTbl::find();
        $model2->andWhere('licprocedurepinup_tbl.lppu_memcompmst_fk=:id',array(':id' =>  $companypk));
        $model2->asArray();

        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'total' => count($model2)
        ];


    }

    public static function unpinlicense($pk){
        $unpin = LicprocedurepinupTbl::deleteAll(['=','licprocedurepinup_pk',$pk]);
        return $unpin;
    }



}
