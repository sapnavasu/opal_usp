<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CmsdisciplinedtlsTbl]].
 *
 * @see CmsdisciplinedtlsTbl
 */
class CmsdisciplinedtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsdisciplinedtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsdisciplinedtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getdisicplinelist($compPk){
        $model = CmsdisciplinedtlsTbl::find()
                ->select(['cmsdisciplinedtls_pk as dvalue','cmsdd_name as duname', 'cmsdd_name as dname'])
                ->where('cmsdd_memcompmst_fk=:fk',array(':fk' =>  $compPk))
                ->andWhere('cmsdd_status=:status',array(':status'=>1))
                ->orderBy('cmsdd_name ASC')
                ->asArray()->all();
            return $model;
    }

    public function adddisciplinedtls($value) {
        if($value) {
            $ip_address = \common\components\Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
           
            $check_duplicate = CmsdisciplinedtlsTbl::find()
                ->select(['*'])
                ->where(['=', 'LOWER(cmsdd_name)', strtolower($value)])
                ->andWhere(['=', 'cmsdd_memcompmst_fk', $companypk])
                ->asArray()->one();
            if(count($check_duplicate) <= 0) {
                $model = new CmsdisciplinedtlsTbl();               
                // $model->cmsdd_uid = \common\components\Common::getUniqueId('cmsdiscipline');
                $model->cmsdd_createdon = $date;
                $model->cmsdd_createdby = $userPK;
                $model->cmsdd_createdbyipaddr = $ip_address;
                $model->cmsdd_name = $value;
                $model->cmsdd_status = 1;
                $model->cmsdd_memcompmst_fk = $companypk;
    
                if (!$model->save(false)) {
                    return $model->getErrors();
                } else {
                    return $model->cmsdisciplinedtls_pk;
                }
            } else {
                return $check_duplicate['cmsdisciplinedtls_pk'];
            //    $return['status'] = 'Failure';
            //    $return['code'] = '202';
            //    $return['msg'] = 'Duplicate value'; 
            }
            // return $return;
        }
    }
}
