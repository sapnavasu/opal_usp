<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CmsmaincatmstTbl]].
 *
 * @see CmsmaincatmstTbl
 */
class CmsmaincatmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsmaincatmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsmaincatmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getcmscategorylist($data){
        $grpcat = $data['group_cat'];
        if($grpcat) {
            $model = CmsmaincatmstTbl::find()
                ->select(['cmcm_cmsgroupcatmst_fk', 'cgcm_name', 'cmsmaincatmst_pk as mc_pk','cmcm_name as mc_name'])
                ->leftJoin('cmsgroupcatmst_tbl', 'cmsgroupcatmst_pk = cmcm_cmsgroupcatmst_fk')
                ->where('cmcm_status=:status',array(':status' => 1))
                ->andWhere(['IN', 'cmcm_cmsgroupcatmst_fk', $grpcat])
                ->orderBy('cmcm_name ASC')
                ->asArray()->all();

                foreach ($model as $key => $value) {
                    $maincategorybygroup[$value['cmcm_cmsgroupcatmst_fk']]['grppk'] = $value['cmcm_cmsgroupcatmst_fk'];
                    $maincategorybygroup[$value['cmcm_cmsgroupcatmst_fk']]['grpname'] = $value['cgcm_name'];
                    $maincategorybygroup[$value['cmcm_cmsgroupcatmst_fk']]['grpoptions'][$key]['mc_pk'] = $value['mc_pk']; 
                    $maincategorybygroup[$value['cmcm_cmsgroupcatmst_fk']]['grpoptions'][$key]['mc_name'] = $value['mc_name']; 
                }

                foreach ($maincategorybygroup as $key => $value) {
                    $nvalue['grpoptions'] = [];
                    foreach($value['grpoptions'] as $vk => $vval) {
                        $nvalue['grpoptions'][] = $vval;
                        $value['grpoptions'] = $nvalue['grpoptions'];
                    }
                    $maincategorybygroupreturn[] = $value;
                }
            return $maincategorybygroupreturn;
        }
    }
    
    public static function getMainCategory($grpcatpk) {        
        $maincategoryMst = CmsmaincatmstTbl::find()
                ->select(['cmsmaincatmst_pk as dataPk','cmcm_name as dataName','cmcm_cmsgroupcatmst_fk as mstFk'])
                ->where('cmcm_status = 1' )
                ->andWhere("cmcm_cmsgroupcatmst_fk in ($grpcatpk)")
                ->orderBy('cmcm_name ASC')
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $maincategoryMst ? $maincategoryMst : [],
        );
        return $result;
    }
}
