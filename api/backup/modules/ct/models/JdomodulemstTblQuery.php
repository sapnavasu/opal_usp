<?php

namespace api\modules\ct\models;

use Exception;

/**
 * This is the ActiveQuery class for [[JdomodulemstTbl]].
 *
 * @see JdomodulemstTbl
 */
class JdomodulemstTblQuery extends \yii\db\ActiveQuery {

    public function getMasterModule() {
        $module = JdomodulemstTbl::find()
                        ->select(['jdomodulemst_pk as dataPk', 'jdmm_modulename as dataName'])
                        ->where('jdmm_status = 1')
                        ->asArray()->All();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $module ? $module : [],
        );
        return $result;
    }

}
