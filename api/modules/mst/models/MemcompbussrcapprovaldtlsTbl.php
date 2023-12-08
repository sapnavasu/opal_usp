<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompbussrcapprovaldtls_tbl".
 *
 * @property int $memcompbussrcapprovaldtls_pk
 * @property int $mcbsad_memcompbussrcapprovalmain_fk Reference to memcompbussrcapprovalmain_tbl
 * @property int $mcbsad_memcompbussrcdtls_fk Reference to memcompbussrcdtls_tbl
 * @property int $mcbsad_status 1-Approved, 2-Decilned
 * @property string $mcbsad_comments
 * @property int $mcbsad_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mcbsad_updatedon
 */
class MemcompbussrcapprovaldtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompbussrcapprovaldtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcbsad_memcompbussrcapprovalmain_fk', 'mcbsad_memcompbussrcdtls_fk', 'mcbsad_status', 'mcbsad_apprdclnby', 'mcbsad_updatedon'], 'required'],
            [['mcbsad_memcompbussrcapprovalmain_fk', 'mcbsad_memcompbussrcdtls_fk', 'mcbsad_status', 'mcbsad_apprdclnby'], 'integer'],
            [['mcbsad_comments'], 'string'],
            [['mcbsad_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompbussrcapprovaldtls_pk' => 'Memcompbussrcapprovaldtls Pk',
            'mcbsad_memcompbussrcapprovalmain_fk' => 'Mcbsad Memcompbussrcapprovalmain Fk',
            'mcbsad_memcompbussrcdtls_fk' => 'Mcbsad Memcompbussrcdtls Fk',
            'mcbsad_status' => 'Mcbsad Status',
            'mcbsad_comments' => 'Mcbsad Comments',
            'mcbsad_apprdclnby' => 'Mcbsad Apprdclnby',
            'mcbsad_updatedon' => 'Mcbsad Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompbussrcapprovaldtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompbussrcapprovaldtlsTblQuery(get_called_class());
    }
}
