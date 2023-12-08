<?php

namespace api\modules\mst\models;

use common\components\Drive;


/**
 * This is the ActiveQuery class for [[CertcatsubcatapprovaldtlsTbl]].
 *
 * @see CertcatsubcatapprovaldtlsTbl
 */
class CertcatsubcatapprovaldtlsTblQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return CertcatsubcatapprovaldtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CertcatsubcatapprovaldtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }
    
    public function getvalidatedcount($compk, $formpk) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $getcertPk = CertapprovaldtlsTbl::find()
                    ->leftJoin('approvalworkflowuserconfig_tbl', 'approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk')
                    ->where('cad_membercompanymst_fk =:compk AND awfuc_usermst_fk =:userpk', [':compk' => $compk, ':userpk' => $userPK])
                    ->orderBy('certapprovaldtls_pk DESC')
                    ->one();
        $validationDatacnt = CertcatsubcatapprovaldtlsTbl::find()
                ->leftJoin('certapprovaldtls_tbl', 'ccscad_certapprovaldtls_fk = certapprovaldtls_pk')
                ->where('certapprovaldtls_pk =:certpk', [':certpk' => $getcertPk->certapprovaldtls_pk])
                ->andWhere('ccscad_suppcertformtrntmp_fk IS NULL AND ccscad_status IN (1,2)')
                ->count();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'validatedCount' => $validationDatacnt
        );
        return $result;
    }

}
