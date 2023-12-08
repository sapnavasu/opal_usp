<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompprodapprovaldtls_tbl".
 *
 * @property int $memcompprodapprovaldtls_pk
 * @property int $mcpad_memcompprodapprovalmain_fk Reference to memcompprodapprovalmain_tbl
 * @property int $mcpad_memcompproddtls_fk Reference to memcompproddtls_tbl
 * @property int $mcpad_status 1-Approved, 2-Decilned
 * @property string $mcpad_comments
 * @property int $mcpad_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mcpad_updatedon
 */
class MemcompprodapprovaldtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompprodapprovaldtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcpad_memcompprodapprovalmain_fk', 'mcpad_memcompproddtls_fk', 'mcpad_status', 'mcpad_apprdclnby', 'mcpad_updatedon'], 'required'],
            [['mcpad_memcompprodapprovalmain_fk', 'mcpad_memcompproddtls_fk', 'mcpad_status', 'mcpad_apprdclnby'], 'integer'],
            [['mcpad_comments'], 'string'],
            [['mcpad_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompprodapprovaldtls_pk' => 'Memcompprodapprovaldtls Pk',
            'mcpad_memcompprodapprovalmain_fk' => 'Mcpad Memcompprodapprovalmain Fk',
            'mcpad_memcompproddtls_fk' => 'Mcpad Memcompproddtls Fk',
            'mcpad_status' => 'Mcpad Status',
            'mcpad_comments' => 'Mcpad Comments',
            'mcpad_apprdclnby' => 'Mcpad Apprdclnby',
            'mcpad_updatedon' => 'Mcpad Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodapprovaldtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompprodapprovaldtlsTblQuery(get_called_class());
    }
}
