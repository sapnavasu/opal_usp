<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcomptendbrdapprovaldtls_tbl".
 *
 * @property int $memcomptendbrdapprovaldtls_pk
 * @property int $mctbad_memcomptendbrdapprovalmain_fk Reference to memcomptendbrdapprovalmain_tbl
 * @property int $mctbad_memcomptendbrdtemp_fk Reference to memcomptendbrdtemp_tbl
 * @property int $mctbad_status 1-Approved, 2-Decilned
 * @property string $mctbad_comments approval / declined comments
 * @property int $mctbad_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mctbad_updatedon
 */
class MemcomptendbrdapprovaldtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcomptendbrdapprovaldtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mctbad_memcomptendbrdapprovalmain_fk', 'mctbad_memcomptendbrdtemp_fk', 'mctbad_status', 'mctbad_apprdclnby', 'mctbad_updatedon'], 'required'],
            [['mctbad_memcomptendbrdapprovalmain_fk', 'mctbad_memcomptendbrdtemp_fk', 'mctbad_status', 'mctbad_apprdclnby'], 'integer'],
            [['mctbad_comments'], 'string'],
            [['mctbad_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcomptendbrdapprovaldtls_pk' => 'Memcomptendbrdapprovaldtls Pk',
            'mctbad_memcomptendbrdapprovalmain_fk' => 'Mctbad Memcomptendbrdapprovalmain Fk',
            'mctbad_memcomptendbrdtemp_fk' => 'Mctbad Memcomptendbrdtemp Fk',
            'mctbad_status' => 'Mctbad Status',
            'mctbad_comments' => 'Mctbad Comments',
            'mctbad_apprdclnby' => 'Mctbad Apprdclnby',
            'mctbad_updatedon' => 'Mctbad Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcomptendbrdapprovaldtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcomptendbrdapprovaldtlsTblQuery(get_called_class());
    }
}
