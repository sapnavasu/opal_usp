<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcomptendbrdapprovalmain_tbl".
 *
 * @property int $memcomptendbrdapprovalmain_pk
 * @property int $mctbam_membercompanymst_fk Reference to membercompanymst_tbl
 * @property int $mctbam_certapprovaldtls_fk Reference to certapprovaldtls_tbl
 * @property int $mctbam_level Level of approval
 * @property int $mctbam_status 1-Approved, 2-Decilned
 * @property int $mctbam_movedtonxtlevel 1 - not moved, 2 - moved, by default 1
 * @property int $mctbam_nxtlevel Which level the Form is moved to
 * @property string $mctbam_comments
 * @property int $mctbam_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mctbam_updatedon
 */
class MemcomptendbrdapprovalmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcomptendbrdapprovalmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mctbam_membercompanymst_fk', 'mctbam_certapprovaldtls_fk', 'mctbam_level', 'mctbam_status', 'mctbam_movedtonxtlevel', 'mctbam_apprdclnby', 'mctbam_updatedon'], 'required'],
            [['mctbam_membercompanymst_fk', 'mctbam_certapprovaldtls_fk', 'mctbam_level', 'mctbam_status', 'mctbam_movedtonxtlevel', 'mctbam_nxtlevel', 'mctbam_apprdclnby'], 'integer'],
            [['mctbam_comments'], 'string'],
            [['mctbam_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcomptendbrdapprovalmain_pk' => 'Memcomptendbrdapprovalmain Pk',
            'mctbam_membercompanymst_fk' => 'Mctbam Membercompanymst Fk',
            'mctbam_certapprovaldtls_fk' => 'Mctbam Certapprovaldtls Fk',
            'mctbam_level' => 'Mctbam Level',
            'mctbam_status' => 'Mctbam Status',
            'mctbam_movedtonxtlevel' => 'Mctbam Movedtonxtlevel',
            'mctbam_nxtlevel' => 'Mctbam Nxtlevel',
            'mctbam_comments' => 'Mctbam Comments',
            'mctbam_apprdclnby' => 'Mctbam Apprdclnby',
            'mctbam_updatedon' => 'Mctbam Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcomptendbrdapprovalmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcomptendbrdapprovalmainTblQuery(get_called_class());
    }
}
