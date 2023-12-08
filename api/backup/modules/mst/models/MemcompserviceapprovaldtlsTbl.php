<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompserviceapprovaldtls_tbl".
 *
 * @property int $memcompserviceapprovaldtls_pk
 * @property int $mcsad_memcompserviceapprovalmain_fk Reference to memcompserviceapprovalmain_tbl
 * @property int $mcsad_memcompservicedtls_fk Reference to memcompservicedtls_tbl
 * @property int $mcsad_status 1-Approved, 2-Decilned
 * @property string $mcsad_comments
 * @property int $mcsad_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mcsad_updatedon
 */
class MemcompserviceapprovaldtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompserviceapprovaldtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcsad_memcompserviceapprovalmain_fk', 'mcsad_memcompservicedtls_fk', 'mcsad_status', 'mcsad_apprdclnby', 'mcsad_updatedon'], 'required'],
            [['mcsad_memcompserviceapprovalmain_fk', 'mcsad_memcompservicedtls_fk', 'mcsad_status', 'mcsad_apprdclnby'], 'integer'],
            [['mcsad_comments'], 'string'],
            [['mcsad_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompserviceapprovaldtls_pk' => 'Memcompserviceapprovaldtls Pk',
            'mcsad_memcompserviceapprovalmain_fk' => 'Mcsad Memcompserviceapprovalmain Fk',
            'mcsad_memcompservicedtls_fk' => 'Mcsad Memcompservicedtls Fk',
            'mcsad_status' => 'Mcsad Status',
            'mcsad_comments' => 'Mcsad Comments',
            'mcsad_apprdclnby' => 'Mcsad Apprdclnby',
            'mcsad_updatedon' => 'Mcsad Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompserviceapprovaldtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompserviceapprovaldtlsTblQuery(get_called_class());
    }
}
