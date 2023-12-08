<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompbranchapprovalmain_tbl".
 *
 * @property int $memcompbranchapprovalmain_pk
 * @property int $mcbam_membercompanymst_fk Reference to membercompanymst_tbl
 * @property int $mcbam_certapprovaldtls_fk Reference to certapprovaldtls_tbl
 * @property int $mcbam_level Level of approval
 * @property int $mcbam_status 1-Approved, 2-Decilned
 * @property int $mcbam_movedtonxtlevel 1 - not moved, 2 - moved, by default 1
 * @property int $mcbam_nxtlevel Which level the Form is moved to
 * @property string $mcbam_comments
 * @property int $mcbam_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mcbam_updatedon
 */
class MemcompbranchapprovalmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompbranchapprovalmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcbam_membercompanymst_fk', 'mcbam_certapprovaldtls_fk', 'mcbam_level', 'mcbam_status', 'mcbam_movedtonxtlevel', 'mcbam_apprdclnby', 'mcbam_updatedon'], 'required'],
            [['mcbam_membercompanymst_fk', 'mcbam_certapprovaldtls_fk', 'mcbam_level', 'mcbam_status', 'mcbam_movedtonxtlevel', 'mcbam_nxtlevel', 'mcbam_apprdclnby'], 'integer'],
            [['mcbam_comments'], 'string'],
            [['mcbam_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompbranchapprovalmain_pk' => 'Memcompbranchapprovalmain Pk',
            'mcbam_membercompanymst_fk' => 'Mcbam Membercompanymst Fk',
            'mcbam_certapprovaldtls_fk' => 'Mcbam Certapprovaldtls Fk',
            'mcbam_level' => 'Mcbam Level',
            'mcbam_status' => 'Mcbam Status',
            'mcbam_movedtonxtlevel' => 'Mcbam Movedtonxtlevel',
            'mcbam_nxtlevel' => 'Mcbam Nxtlevel',
            'mcbam_comments' => 'Mcbam Comments',
            'mcbam_apprdclnby' => 'Mcbam Apprdclnby',
            'mcbam_updatedon' => 'Mcbam Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompbranchapprovalmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompbranchapprovalmainTblQuery(get_called_class());
    }
}
