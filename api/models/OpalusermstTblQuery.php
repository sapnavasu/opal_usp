<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalusermstTbl]].
 *
 * @see OpalusermstTbl
 */
class OpalusermstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalusermstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalusermstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function getuseraccess($userpk){
        $response = [];
        if (!empty($userpk)) {
            $model = OpalusermstTbl::find()
                ->select(["rad_OpalModuleMst_FK as module_id","rad_OpalSubModuleMst_FK as submodule_id","rad_Access	as access","omm_name_en	as module","osmm_name_en as submodule"])
                ->leftJoin('roleallocationdtls_tbl','FIND_IN_SET(rad_RoleMst_FK, oum_rolemst_fk)')
                ->leftJoin('rolemst_tbl','rolemst_pk = oum_rolemst_fk')
                ->leftJoin('opalmodulemst_tbl', 'opalmodulemst_pk = rad_OpalModuleMst_FK')
                ->leftJoin('opalsubmodulemst_tbl', 'opalsubmodulemst_pk = rad_OpalSubModuleMst_FK')
                ->where(['opalusermst_pk'=>$userpk])
                ->andWhere(['rm_status'=>1])
                ->groupBy(['RoleAllocationDtls_pk'])
                ->asArray()->all();
            if(!empty($model)){
                $pre = [];
                foreach ($model as $key => $value) {
                    $access = json_decode($value['access'], true); 
                    $access = json_decode($access, true); 
                    //$access = json_decode($access);
                   // var_dump($access);
                    
                    if(empty($response))
                    {
                        $response[$value['module_id']][$value['submodule_id']]['modules'] = $value['module'];
                        $response[$value['module_id']][$value['submodule_id']]['submodules'] = $value['submodule'];
                        $response[$value['module_id']][$value['submodule_id']]['module_id'] = $value['module_id'];
                        $response[$value['module_id']][$value['submodule_id']]['submodule_id'] = $value['submodule_id'];
                        $response[$value['module_id']][$value['submodule_id']]['create'] = (in_array(1, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['read'] = (in_array(2, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['update'] =(in_array(3, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['delete'] = (in_array(4, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['approval'] = (in_array(5, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['download'] = (in_array(6, $access) ? "Y" : "N");
                    }
                    elseif($response[$value['module_id']][$value['submodule_id']]['module_id'] == $value['module_id'] )
                    {
                        if($response[$value['module_id']][$value['submodule_id']]['submodule_id'] == $value['submodule_id'] )
                        {
                            $response[$value['module_id']][$value['submodule_id']]['create'] = $response[$value['module_id']][$value['submodule_id']]['create'] == "Y" ? "Y" : (in_array(1, $access) ? "Y" : "N");
                            $response[$value['module_id']][$value['submodule_id']]['read'] = $response[$value['module_id']][$value['submodule_id']]['read'] == "Y" ? "Y" : (in_array(2, $access) ? "Y" : "N");
                            $response[$value['module_id']][$value['submodule_id']]['update'] = $response[$value['module_id']][$value['submodule_id']]['update'] == "Y" ? "Y" : (in_array(3, $access) ? "Y" : "N");
                            $response[$value['module_id']][$value['submodule_id']]['delete'] = $response[$value['module_id']][$value['submodule_id']]['delete'] == "Y" ? "Y" : (in_array(4, $access) ? "Y" : "N");
                            $response[$value['module_id']][$value['submodule_id']]['approval'] = $response[$value['module_id']][$value['submodule_id']]['approval'] == "Y" ? "Y" : (in_array(5, $access) ? "Y" : "N");
                            $response[$value['module_id']][$value['submodule_id']]['download'] = $response[$value['module_id']][$value['submodule_id']]['download'] == "Y" ? "Y" : (in_array(6, $access) ? "Y" : "N");
                        }
                        else
                        {
                        $response[$value['module_id']][$value['submodule_id']]['modules'] = $value['module'];
                        $response[$value['module_id']][$value['submodule_id']]['submodules'] = $value['submodule'];
                        $response[$value['module_id']][$value['submodule_id']]['module_id'] = $value['module_id'];
                        $response[$value['module_id']][$value['submodule_id']]['submodule_id'] = $value['submodule_id'];
                        $response[$value['module_id']][$value['submodule_id']]['create'] = (in_array(1, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['read'] = (in_array(2, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['update'] =(in_array(3, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['delete'] = (in_array(4, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['approval'] = (in_array(5, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['download'] = (in_array(6, $access) ? "Y" : "N");
                        }
                        
                    }
                    else
                    {
                        $response[$value['module_id']][$value['submodule_id']]['modules'] = $value['module'];
                        $response[$value['module_id']][$value['submodule_id']]['submodules'] = $value['submodule'];
                        $response[$value['module_id']][$value['submodule_id']]['module_id'] = $value['module_id'];
                        $response[$value['module_id']][$value['submodule_id']]['submodule_id'] = $value['submodule_id'];
                        $response[$value['module_id']][$value['submodule_id']]['create'] = (in_array(1, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['read'] = (in_array(2, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['update'] =(in_array(3, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['delete'] = (in_array(4, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['approval'] = (in_array(5, $access) ? "Y" : "N");
                        $response[$value['module_id']][$value['submodule_id']]['download'] = (in_array(6, $access) ? "Y" : "N");
                    }
                  
                }
            }
        
        }
        return $response;
    }
}
