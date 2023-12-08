<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompbranchapprovaldtls_tbl".
 *
 * @property int $memcompbranchapprovaldtls_pk
 * @property int $mcbad_memcompbranchapprovalmain_fk Reference to memcompbranchapprovalmain_tbl
 * @property int $mcbad_memcompbranchdtlstemp_fk Reference to memcompbranchdtlstemp_tbl
 * @property int $mcbad_status 1-Approved, 2-Decilned
 * @property string $mcbad_comments
 * @property int $mcbad_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mcbad_updatedon
 */
class MemcompbranchapprovaldtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompbranchapprovaldtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcbad_memcompbranchapprovalmain_fk', 'mcbad_memcompbranchdtlstemp_fk', 'mcbad_status', 'mcbad_apprdclnby', 'mcbad_updatedon'], 'required'],
            [['mcbad_memcompbranchapprovalmain_fk', 'mcbad_memcompbranchdtlstemp_fk', 'mcbad_status', 'mcbad_apprdclnby'], 'integer'],
            [['mcbad_comments'], 'string'],
            [['mcbad_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompbranchapprovaldtls_pk' => 'Memcompbranchapprovaldtls Pk',
            'mcbad_memcompbranchapprovalmain_fk' => 'Mcbad Memcompbranchapprovalmain Fk',
            'mcbad_memcompbranchdtlstemp_fk' => 'Mcbad Memcompbranchdtlstemp Fk',
            'mcbad_status' => 'Mcbad Status',
            'mcbad_comments' => 'Mcbad Comments',
            'mcbad_apprdclnby' => 'Mcbad Apprdclnby',
            'mcbad_updatedon' => 'Mcbad Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompbranchapprovaldtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompbranchapprovaldtlsTblQuery(get_called_class());
    }
}
