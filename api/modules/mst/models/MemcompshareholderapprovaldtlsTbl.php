<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompshareholderapprovaldtls_tbl".
 *
 * @property int $memcompshareholderapprovaldtls_pk
 * @property int $mcshad_memcompshareholderapprovalmain_fk Reference to memcompshareholderapprovalmain_tbl
 * @property int $mcshad_memcompshareholderdtls_fk Reference to memcompshareholderdtls_tbl
 * @property int $mcshad_status 1-Approved, 2-Decilned
 * @property string $mcshad_comments
 * @property int $mcshad_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mcshad_updatedon
 */
class MemcompshareholderapprovaldtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompshareholderapprovaldtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcshad_memcompshareholderapprovalmain_fk', 'mcshad_memcompshareholderdtls_fk', 'mcshad_status', 'mcshad_apprdclnby', 'mcshad_updatedon'], 'required'],
            [['mcshad_memcompshareholderapprovalmain_fk', 'mcshad_memcompshareholderdtls_fk', 'mcshad_status', 'mcshad_apprdclnby'], 'integer'],
            [['mcshad_comments'], 'string'],
            [['mcshad_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompshareholderapprovaldtls_pk' => 'Memcompshareholderapprovaldtls Pk',
            'mcshad_memcompshareholderapprovalmain_fk' => 'Mcshad Memcompshareholderapprovalmain Fk',
            'mcshad_memcompshareholderdtls_fk' => 'Mcshad Memcompshareholderdtls Fk',
            'mcshad_status' => 'Mcshad Status',
            'mcshad_comments' => 'Mcshad Comments',
            'mcshad_apprdclnby' => 'Mcshad Apprdclnby',
            'mcshad_updatedon' => 'Mcshad Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompshareholderapprovaldtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompshareholderapprovaldtlsTblQuery(get_called_class());
    }
}
