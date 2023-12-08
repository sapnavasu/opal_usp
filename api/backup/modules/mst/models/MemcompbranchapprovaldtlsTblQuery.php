<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[MemcompbranchapprovaldtlsTbl]].
 *
 * @see MemcompbranchapprovaldtlsTbl
 */
class MemcompbranchapprovaldtlsTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return MemcompbranchapprovaldtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompbranchapprovaldtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function getbranchdtls($compk, $branchdtlspk, $formid, $userpk) {
        $levelUser = \api\modules\mst\models\MemcompbranchapprovaldtlsTbl::find()
                        ->select(["mcbam_comments","mcbam_status",'mcbad_status','mcbad_comments'])
                        ->leftJoin("memcompbranchapprovalmain_tbl", "memcompbranchapprovalmain_pk=mcbad_memcompbranchapprovalmain_fk")
                        ->leftJoin('certapprovaldtls_tbl','mcbam_certapprovaldtls_fk = certapprovaldtls_pk')
                        ->where("mcbad_memcompbranchdtlstemp_fk=:branchtemp",
                        [':branchtemp'=>$branchdtlspk])->orderby('certapprovaldtls_pk desc')->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'result' => $levelUser
        );
        return $result;
    }

}
