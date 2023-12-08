<?php

namespace app\models;

use common\components\Common;

/**
 * This is the ActiveQuery class for [[CmsgroupcatdtlsTbl]].
 *
 * @see CmsgroupcatdtlsTbl
 */
class CmsgroupcatdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsgroupcatdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsgroupcatdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getcmscategroydetails($data) {
        $type = $data['type'];
        $req_id = $data['req_id'];
        $main_array = [];
        $categories_pk = [];
        if($data) {
            $cmsgroupcategory = CmsgroupcatdtlsTbl::find()
                ->select(['cmsgroupcatmst_pk as gcat_pk','cgcm_name as gcat_name', 'cmsgroupcatdtls_pk'])
                ->leftJoin('cmsgroupcatmst_tbl','cmsgroupcatmst_pk=cgcd_cmsgroupcatmst_fk and cgcd_shared_type = "' . $type  . '"')
                ->where('cgcd_shared_fk=:req_id',array(':req_id' => $req_id))
                ->asArray()->all();
            
                if($cmsgroupcategory) {
                    foreach ($cmsgroupcategory as $key1 => $value1) {
                        $cmsmaincategory = CmsmaincatdtlsTbl::find()
                        ->select(['cmsmaincatmst_pk as mcat_pk','cmcm_name as mcat_name', 'cmsmaincatdtls_pk'])
                        ->leftJoin('cmsmaincatmst_tbl','cmcd_cmsmaincatmst_fk=cmsmaincatmst_pk')
                        ->where('cmcd_cmsgroupcatdtls_fk=:group_id',array(':group_id' => $value1['cmsgroupcatdtls_pk']))
                        ->asArray()->all();
                        
                        if($cmsmaincategory) {
                            foreach ($cmsmaincategory as $key2 => $value2) {
                                $cmssubcategory = CmssubcatdtlsTbl::find()
                                ->select(['cmssubcatmst_pk as scat_pk','cscm_name as scat_name'])
                                ->leftJoin('cmssubcatmst_tbl','cscd_cmssubcatmst_fk = cmssubcatmst_pk')
                                ->where('cscd_cmsmaincatdtls_fk=:main_id',array(':main_id' => $value2['cmsmaincatdtls_pk']))
                                ->asArray()
                                ->all();
                                if($cmssubcategory) {
                                    $main_key = count($main_array);
                                    foreach ($cmssubcategory as $key3 => $value3) {
                                        $categories_pk['group_cat_pk'][] = $value1['gcat_pk'];
                                        $categories_pk['group_main_pk'][$value1['gcat_pk']][] = $value2['mcat_pk'];
                                        $categories_pk['group_sub_pk'][$value2['mcat_pk']][] = $value3['scat_pk'];
                                        $categories_pk['group_main_pk_alone'][] = $value2['mcat_pk'];
                                        $categories_pk['group_sub_pk_alone'][] = $value3['scat_pk'];
                                        $main_array[$main_key]['groupcate'] = $value1['gcat_name'];
                                        $main_array[$main_key]['maincategory'] = $value2['mcat_name'];
                                        $main_array[$main_key]['subcategory'] = $value3['scat_name'];
                                        $main_key++;
                                    }
                                } else {
                                    $main_key = count($main_array);
                                    foreach ($cmsmaincategory as $key => $mvalue) {
                                        $categories_pk['group_cat_pk'][] = $value1['gcat_pk'];
                                        $categories_pk['group_main_pk'][$value1['gcat_pk']][] = $value2['mcat_pk'];
                                        $categories_pk['group_main_pk_alone'][] = $value2['mcat_pk'];
                                        $main_array[$main_key]['groupcate'] = $value1['gcat_name'];
                                        $main_array[$main_key]['maincategory'] = $value2['mcat_name'];
                                        $main_array[$main_key]['subcategory'] = 'All';
                                    }
                                }
                            }
                        } else {
                            $main_key = count($main_array);
                            $categories_pk['group_cat_pk'][] = $value1['gcat_pk'];
                            // foreach ($cmsgroupcategory as $key => $gvalue) {
                                $main_array[$main_key]['groupcate'] = $value1['gcat_name'];
                                $main_array[$main_key]['maincategory'] = 'All';
                                $main_array[$main_key]['subcategory'] = 'All';
                            // }
                        }
                    }
                } 
            }
            // foreach ($categories_pk['group_main_pk'] as $key => $value) {
            //     $categories_pk['group_main_pk'][$key] = json_decode(json_encode(array_unique($value)), true);
            // }
            // $categories_pk['group_cat_pk'] = json_decode(json_encode(array_unique($categories_pk['group_cat_pk'])), true);
            
        return array('main_array' => $main_array, 'categories_pk' => $categories_pk) ;
    }
    
    public function saveGrpCategory($formdata){
        if(!empty($formdata)){
            if(!empty($formdata['ContractPk']) && $formdata['ContractPk'] != null && !empty($formdata['Groupcategory']) && $formdata['Groupcategory'] != null){
                $model_grp = CmsgroupcatdtlsTbl::find()
                        ->where("cgcd_shared_fk = :ContractPk", [':ContractPk'=>$formdata['ContractPk']])
                        ->all();
                if(!empty($model_grp)){
                    $model_main = CmsmaincatdtlsTbl::find()
                            ->leftJoin("cmsgroupcatdtls_tbl",'cmcd_cmsgroupcatdtls_fk = cmsgroupcatdtls_pk')
                            ->where("cgcd_shared_fk = :ContractPk", [':ContractPk'=>$formdata['ContractPk']])
                            ->all();
                    if(!empty($model_main)){
                        $model_sub = CmssubcatdtlsTbl::find()
                                ->leftJoin("cmsmaincatdtls_tbl",'cmsmaincatdtls_pk = cscd_cmsmaincatdtls_fk')
                                ->leftJoin("cmsgroupcatdtls_tbl",'cmcd_cmsgroupcatdtls_fk = cmsgroupcatdtls_pk')
                                ->where("cgcd_shared_fk = :ContractPk", [':ContractPk'=>$formdata['ContractPk']])
                                ->all();
                        foreach($model_sub as $val){
                            $val->delete();
                        }
                    }
                    foreach($model_main as $val){
                        $val->delete();
                    }
                }
                foreach($model_grp as $val){
                            $val->delete();
                }  
                
                foreach ($formdata['Groupcategory'] as $key => $dataVal) {
                    $catTable = new CmsgroupcatdtlsTbl;
                    $catTable->cgcd_shared_fk = $formdata['ContractPk'];
                    $catTable->cgcd_shared_type = 2;
                    $catTable->cgcd_cmsgroupcatmst_fk = $dataVal;                        
                    if(!$catTable->save()){
                        $result = array(
                            'status' => 200,
                            'msg' => 'warning',
                            'flag' => 'E',
                            'comments' => 'Something went wrong',
                            'returndata' => $catTable->getErrors()
                        );
                        return $result;
                    }
                }
                if(!empty($formdata['Maincategory']) && $formdata['Maincategory'] != null){
                    $maincatdata = CmsmaincatdtlsTblQuery::saveMainCategory($formdata['Maincategory'],$formdata['ContractPk']);
                }
                if(!empty($formdata['Subcategory']) && $formdata['Subcategory'] != null){
                    $subcatdata = CmssubcatdtlsTblQuery::saveSubCategory($formdata['Subcategory'],$formdata['ContractPk']);
                }                
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'All Categories Added Successfully!',
                );
            }
        }else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                    'returndata' => $model->getErrors()
                );
            }
            return $result;
    }
    
    public static function getselectedCategory($contractpk) {
        $groupcategorydtls = CmsgroupcatdtlsTbl::find()
                ->select(["cmsgroupcatdtls_pk as dataPk", 'cgcm_name as grpdataName','cmsgroupcatmst_pk as MstPk'])
                ->leftJoin("cmsgroupcatmst_tbl",'cmsgroupcatmst_pk = cgcd_cmsgroupcatmst_fk ')
                ->where('cgcd_shared_fk =:dataPK and cgcd_shared_type = 2',array(':dataPK' =>$contractpk))
                ->orderBy('cgcm_name ASC')
                ->asArray()
                ->all();
        
        $maincategorydtls = CmsmaincatdtlsTbl::find()
                ->select(["cmsmaincatdtls_pk as dataPk", 'cmcm_name as maindataName','cmsmaincatmst_pk as MstPk','cmcd_cmsgroupcatdtls_fk as catMstFk'])
                ->leftJoin("cmsmaincatmst_tbl",'cmsmaincatmst_pk = cmcd_cmsmaincatmst_fk')
                ->leftJoin("cmsgroupcatdtls_tbl",'cmsgroupcatdtls_pk = cmcd_cmsgroupcatdtls_fk')
                ->where('cgcd_shared_fk =:contractpk',array(':contractpk' =>$contractpk))
                ->orderBy('cmcm_name ASC')
                ->asArray()
                ->all();
        
        $subcategorydtls = CmssubcatdtlsTbl::find()
                ->select(["cmssubcatdtls_pk as dataPk", 'cscm_name as subdataName','cmssubcatmst_pk as MstPk','cscd_cmsmaincatdtls_fk as mainCatFk'])
                ->leftJoin("cmssubcatmst_tbl",'cmssubcatmst_pk = cscd_cmssubcatmst_fk')
                ->leftJoin("cmsmaincatdtls_tbl",'cmsmaincatdtls_pk = cscd_cmsmaincatdtls_fk')
                ->leftJoin("cmsgroupcatdtls_tbl",'cmsgroupcatdtls_pk = cmcd_cmsgroupcatdtls_fk')
                ->where('cgcd_shared_fk =:contractpk',array(':contractpk' =>$contractpk))
                ->orderBy('cscm_name ASC')
                ->asArray()
                ->all();
        $selectedPoCategories =[];
        
        if (!empty($groupcategorydtls)) {
            $groupPK = [];
            foreach ($groupcategorydtls as $grpkey => $grpval) {
                $mainCatArray = [];
            $mainPK = [];
                foreach ($maincategorydtls as $mainkey => $mainval) {
                    if ($grpval['dataPk'] == $mainval['catMstFk']) {
                        $mainCatArray[] = $mainval;
                        if (!in_array($mainval['dataPk'], $mainPK)) {
                            $mainPK[] = $mainval['dataPk'];
                        }
                    }
                }     
                $subCatArray = [];
                foreach ($subcategorydtls as $subkey => $subval) {
                    if (in_array($subval['mainCatFk'], $mainPK)) {
                        $subCatArray[] = $subval;
                    }     
                }
                if (!in_array($grpval['dataPk'], $groupPK)) {
                    $resultArray[] = ['groupCat' => $grpval, 'mainCat' => $mainCatArray,'subCat'=>$subCatArray];
                    $groupPK[] = $grpval['dataPk'];
                }
            }            
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'grpmoduleData' => $groupcategorydtls ? $groupcategorydtls : [],
            'mainmoduleData' => $maincategorydtls ? $maincategorydtls : [],
            'submoduleData' => $subcategorydtls ? $subcategorydtls : [],
            'resultArray' => !empty($resultArray) ? $resultArray : []
        );
        return $result;
    }
}
