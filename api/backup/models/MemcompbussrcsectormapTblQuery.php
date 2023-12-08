<?php

namespace app\models;
use Yii;

/**
 * This is the ActiveQuery class for [[MemcompbussrcsectormapTbl]].
 *
 * @see MemcompbussrcsectormapTbl
 */
class MemcompbussrcsectormapTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompbussrcsectormapTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompbussrcsectormapTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function addbssectors($bsd_id, $sector_ids) {
        if($bsd_id && $sector_ids) {
            try {
                $sectorremove = MemcompbussrcsectormapTbl::deleteAll(['=', 'mcbssm_memcompbussrcdtls_fk', $bsd_id]);

                $sectormapids = [];
                $transcation = Yii::$app->db->beginTransaction();
                foreach($sector_ids as $key => $value) {
                    $model = new MemcompbussrcsectormapTbl; 
                    $model->mcbssm_memcompbussrcdtls_fk = $bsd_id;
                    $model->mcbssm_sectormst_fk = $value;
                    $model->save();
                    $sectormapids[] = $model->memcompbussrcsectormap_pk;
                }
                $transcation->commit();
                $return = ['status' => 'Success', 'code' => 'E200', 'msg' => 'Success',  'data' => $sectormapids];
            } catch(\yii\base\Exception $exception) {
                $error[] = $exception->getMessage();
                $return = ['status' => 'Error', 'code' => 'E202', 'msg' => $error];
                $transcation->rollBack();
            }
            return $return;
        }
    }
}
