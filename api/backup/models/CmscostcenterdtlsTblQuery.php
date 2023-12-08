<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CmscostcenterdtlsTbl]].
 *
 * @see CmscostcenterdtlsTbl
 */
class CmscostcenterdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmscostcenterdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmscostcenterdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getcostcentrelist($compPk){
        $model = CmscostcenterdtlsTbl::find()
                ->select(['cmscostcenterdtls_pk as dvalue','cmsccd_name as  duname', 'cmsccd_name as dname'])
                ->where('cmsccd_memcompmst_fk=:fk',array(':fk' =>  $compPk))
                ->andWhere('cmsccd_status=:status',array(':status'=>1))
                ->orderBy('cmsccd_name ASC')
                ->asArray()->all();
            return $model;
    }

    public function addcostcentredtls($value) {
        if($value) {
            $ip_address = \common\components\Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
           
            $check_duplicate = CmscostcenterdtlsTbl::find()
                ->select(['*'])
                ->where(['=', 'LOWER(cmsccd_name)', strtolower($value)])
                ->andWhere(['=', 'cmsccd_memcompmst_fk', $companypk])
                ->asArray()->one();
            if(count($check_duplicate) <= 0) {
                $model = new CmscostcenterdtlsTbl();               
                // $model->cmsccd_uid = \common\components\Common::getUniqueId('cmscostcentre');
                $model->cmsccd_createdon = $date;
                $model->cmsccd_createdby = $userPK;
                $model->cmsccd_createdbyipaddr = $ip_address;
                $model->cmsccd_name = $value;
                $model->cmsccd_status = 1;
                $model->cmsccd_memcompmst_fk = $companypk;
    
                if (!$model->save(false)) {
                    return $model->getErrors();
                } else {
                    return $model->cmscostcenterdtls_pk;
                }
            } else {
                return $check_duplicate['cmscostcenterdtls_pk'];
            //    $return['status'] = 'Failure';
            //    $return['code'] = '202';
            //    $return['msg'] = 'Duplicate cost centre value'; 
            }
            // return $return;
        }
    }
}
