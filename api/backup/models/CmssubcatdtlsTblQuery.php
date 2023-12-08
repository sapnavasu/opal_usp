<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CmssubcatdtlsTbl]].
 *
 * @see CmssubcatdtlsTbl
 */
class CmssubcatdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmssubcatdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssubcatdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function saveSubCategory($subcatdata,$contractpk){
        
        foreach ($subcatdata as $key => $dataVal) {
            $model = CmsmaincatdtlsTbl::find()
                    ->leftJoin("cmsgroupcatdtls_tbl",'cmcd_cmsgroupcatdtls_fk = cmsgroupcatdtls_pk')
                    ->where("cgcd_shared_fk = :contractpk and cgcd_shared_type = :type and cmcd_cmsmaincatmst_fk =:mstPk", [':contractpk'=>$contractpk, ':type'=>2,':mstPk'=>$dataVal['mstFk']])
                    ->asArray()
                    ->one();
            
            $catTable = new CmssubcatdtlsTbl;
            $catTable->cscd_cmsmaincatdtls_fk =  $model['cmsmaincatdtls_pk'];
            $catTable->cscd_cmssubcatmst_fk = $dataVal['dataPk'];   
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
    }
}
