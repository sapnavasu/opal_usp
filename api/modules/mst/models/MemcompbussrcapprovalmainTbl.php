<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompbussrcapprovalmain_tbl".
 *
 * @property int $memcompbussrcapprovalmain_pk
 * @property int $mcbsam_membercompanymst_fk Reference to membercompanymst_tbl
 * @property int $mcbsam_certapprovaldtls_fk Reference to certapprovaldtls_tbl
 * @property int $mcbsam_level
 * @property int $mcbsam_status 1-Approved, 2-Decilned
 * @property int $mcbsam_movedtonxtlevel 1 - not moved, 2 - moved, by default 1
 * @property int $mcbsam_nxtlevel Which level the Form is moved to
 * @property string $mcbsam_comments
 * @property int $mcbsam_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mcbsam_updatedon
 */
class MemcompbussrcapprovalmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompbussrcapprovalmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcbsam_membercompanymst_fk', 'mcbsam_certapprovaldtls_fk', 'mcbsam_level', 'mcbsam_status', 'mcbsam_movedtonxtlevel', 'mcbsam_apprdclnby', 'mcbsam_updatedon'], 'required'],
            [['mcbsam_membercompanymst_fk', 'mcbsam_certapprovaldtls_fk', 'mcbsam_level', 'mcbsam_status', 'mcbsam_movedtonxtlevel', 'mcbsam_nxtlevel', 'mcbsam_apprdclnby'], 'integer'],
            [['mcbsam_comments'], 'string'],
            [['mcbsam_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompbussrcapprovalmain_pk' => 'Memcompbussrcapprovalmain Pk',
            'mcbsam_membercompanymst_fk' => 'Mcbsam Membercompanymst Fk',
            'mcbsam_certapprovaldtls_fk' => 'Mcbsam Certapprovaldtls Fk',
            'mcbsam_level' => 'Mcbsam Level',
            'mcbsam_status' => 'Mcbsam Status',
            'mcbsam_movedtonxtlevel' => 'Mcbsam Movedtonxtlevel',
            'mcbsam_nxtlevel' => 'Mcbsam Nxtlevel',
            'mcbsam_comments' => 'Mcbsam Comments',
            'mcbsam_apprdclnby' => 'Mcbsam Apprdclnby',
            'mcbsam_updatedon' => 'Mcbsam Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompbussrcapprovalmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompbussrcapprovalmainTblQuery(get_called_class());
    }
}
