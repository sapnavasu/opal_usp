<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CmsmaincatdtlsTbl]].
 *
 * @see CmsmaincatdtlsTbl
 */
class CmsmaincatdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsmaincatdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsmaincatdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function saveMainCategory($maincatdata,$contractpk){
       
        foreach ($maincatdata as $key => $dataVal) {
            $model = CmsgroupcatdtlsTbl::find()
                    ->where("cgcd_shared_fk = :contractpk and cgcd_shared_type = :type and cgcd_cmsgroupcatmst_fk =:mstPk", [':contractpk'=>$contractpk, ':type'=>2,':mstPk'=>$dataVal['mstFk']])
                    ->asArray()
                    ->one();
            $catTable = new CmsmaincatdtlsTbl;
            $catTable->cmcd_cmsgroupcatdtls_fk =  $model['cmsgroupcatdtls_pk'];
            $catTable->cmcd_cmsmaincatmst_fk = $dataVal['dataPk'];   
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
    
    public static function getselectedMainCategory($contractpk) {
        $maincategorydtls = CmsmaincatdtlsTbl::find()
                ->select(["cmsmaincatdtls_pk as dataPk", 'cmcm_name as dataName'])
                ->leftJoin("cmsmaincatmst_tbl",'cmsmaincatmst_pk = cmcd_cmsmaincatmst_fk')
                ->leftJoin("cmsgroupcatdtls_tbl",'cmsgroupcatdtls_pk = cmcd_cmsgroupcatdtls_fk')
                ->where('cgcd_shared_fk =:contractpk',array(':contractpk' =>$contractPk))
                ->orderBy('cmcm_name ASC')
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $maincategorydtls ? $maincategorydtls : [],
        );
        return $result;
    }
}
