<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CmssubcatmstTbl]].
 *
 * @see CmssubcatmstTbl
 */
class CmssubcatmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmssubcatmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssubcatmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getcmssubcategorylist($data){
        $maincat = $data['main_category_val'];
        $subcategoryarr = [];
        foreach($maincat as $key => $value) {
            if($value != null) {
                $group_val = $key;
                $model = CmssubcatmstTbl::find()
                        ->select(['cscm_cmsmaincatmst_fk as mainpk', 'cmssubcatmst_pk as subc_pk','cscm_name as subc_name'])
                        ->where('cscm_status=:status',array(':status' => 1))
                        ->andWhere('cscm_cmsgroupcatmst_fk=:gc_pk',array(':gc_pk' => $key))
                        ->andWhere(['IN', 'cscm_cmsmaincatmst_fk', $value])
                        ->orderBy('cscm_name ASC')
                        ->asArray()->all();
                        
                foreach ($model as $key1 => $value) {
                    $smodel = CmsmaincatmstTbl::find()
                        ->select(['cmsmaincatmst_pk', 'cmcm_name'])
                        ->where('cmsmaincatmst_pk=:mc_pk',array(':mc_pk' => $value['mainpk']))
                        ->asArray()->all();

                    $subcategoryarr[$value['mainpk']]['grppk'] = $group_val;
                    $subcategoryarr[$value['mainpk']]['mainpk'] = $value['mainpk'];
                    $subcategoryarr[$value['mainpk']]['grpname'] = $smodel[0]['cmcm_name'];
                    $subcategoryarr[$value['mainpk']]['grpoptions'][$key1]['subc_pk'] = $value['subc_pk']; 
                    $subcategoryarr[$value['mainpk']]['grpoptions'][$key1]['subc_name'] = $value['subc_name']; 
                }
                
            }
        }
        foreach ($subcategoryarr as $key => $value) {
            $nvalue['grpoptions'] = [];
            foreach($value['grpoptions'] as $vk => $vval) {
                $nvalue['grpoptions'][] = $vval;
                $value['grpoptions'] = $nvalue['grpoptions'];
            }
            $subcategoryarrreturn[] = $value;
        }
        return $subcategoryarrreturn;
    }
    
    public static function getSubCategory($maincatpk) {        
        $subcategoryMst = CmssubcatmstTbl::find()
                ->select(['cmssubcatmst_pk as dataPk','cscm_name as dataName','cscm_cmsmaincatmst_fk as mstFk'])
                ->where('cscm_status = 1' )
                ->andWhere("cscm_cmsmaincatmst_fk in ($maincatpk)")
                ->orderBy('cscm_name ASC')
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $subcategoryMst ? $subcategoryMst : [],
        );
        return $result;
    }
}
