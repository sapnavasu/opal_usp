<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompfinancialapprovaldtls_tbl".
 *
 * @property int $memcomptendbrdapprovaldtls_pk
 * @property int $mcfad_memcompfinancialapprovalmain_fk Reference to memcompfinancialapprovalmain_tbl
 * @property int $mcfad_memcompfinancialtemp_fk Reference to memcompfinancialtemp_tbl
 * @property int $mcfad_status 1-Approved, 2-Decilned
 * @property string $mcfad_comments
 * @property int $mcfad_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mcfad_updatedon
 */
class MemcompfinancialapprovaldtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompfinancialapprovaldtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcfad_memcompfinancialapprovalmain_fk', 'mcfad_memcompfinancialtemp_fk', 'mcfad_status', 'mcfad_apprdclnby', 'mcfad_updatedon'], 'required'],
            [['mcfad_memcompfinancialapprovalmain_fk', 'mcfad_memcompfinancialtemp_fk', 'mcfad_status', 'mcfad_apprdclnby'], 'integer'],
            [['mcfad_comments'], 'string'],
            [['mcfad_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcomptendbrdapprovaldtls_pk' => 'Memcomptendbrdapprovaldtls Pk',
            'mcfad_memcompfinancialapprovalmain_fk' => 'Mcfad Memcompfinancialapprovalmain Fk',
            'mcfad_memcompfinancialtemp_fk' => 'Mcfad Memcompfinancialtemp Fk',
            'mcfad_status' => 'Mcfad Status',
            'mcfad_comments' => 'Mcfad Comments',
            'mcfad_apprdclnby' => 'Mcfad Apprdclnby',
            'mcfad_updatedon' => 'Mcfad Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompfinancialapprovaldtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompfinancialapprovaldtlsTblQuery(get_called_class());
    }
}
