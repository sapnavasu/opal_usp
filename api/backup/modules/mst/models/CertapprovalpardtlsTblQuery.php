<?php

namespace api\modules\mst\models;

use common\components\Drive;


/**
 * This is the ActiveQuery class for [[CertapprovalpardtlsTbl]].
 *
 * @see CertapprovalpardtlsTbl
 */
class CertapprovalpardtlsTblQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return CertapprovalpardtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CertapprovalpardtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }
}
