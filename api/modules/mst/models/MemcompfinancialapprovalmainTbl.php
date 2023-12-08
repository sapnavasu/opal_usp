<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompfinancialapprovalmain_tbl".
 *
 * @property int $memcompfinancialapprovalmain_pk
 * @property int $mcfam_membercompanymst_fk Reference to membercompanymst_tbl
 * @property int $mcfam_certapprovaldtls_fk Reference to certapprovaldtls_tbl
 * @property int $mcfam_level Level of approval
 * @property int $mcfam_status 1-Approved, 2-Decilned
 * @property int $mcfam_movedtonxtlevel 1 - not moved, 2 - moved, by default 1
 * @property int $mcfam_nxtlevel Which level the Form is moved to
 * @property string $mcfam_comments
 * @property int $mcfam_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mcfam_updatedon
 */
class MemcompfinancialapprovalmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompfinancialapprovalmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcfam_membercompanymst_fk', 'mcfam_certapprovaldtls_fk', 'mcfam_level', 'mcfam_status', 'mcfam_movedtonxtlevel', 'mcfam_apprdclnby', 'mcfam_updatedon'], 'required'],
            [['mcfam_membercompanymst_fk', 'mcfam_certapprovaldtls_fk', 'mcfam_level', 'mcfam_status', 'mcfam_movedtonxtlevel', 'mcfam_nxtlevel', 'mcfam_apprdclnby'], 'integer'],
            [['mcfam_comments'], 'string'],
            [['mcfam_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompfinancialapprovalmain_pk' => 'Memcompfinancialapprovalmain Pk',
            'mcfam_membercompanymst_fk' => 'Mcfam Membercompanymst Fk',
            'mcfam_certapprovaldtls_fk' => 'Mcfam Certapprovaldtls Fk',
            'mcfam_level' => 'Mcfam Level',
            'mcfam_status' => 'Mcfam Status',
            'mcfam_movedtonxtlevel' => 'Mcfam Movedtonxtlevel',
            'mcfam_nxtlevel' => 'Mcfam Nxtlevel',
            'mcfam_comments' => 'Mcfam Comments',
            'mcfam_apprdclnby' => 'Mcfam Apprdclnby',
            'mcfam_updatedon' => 'Mcfam Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompfinancialapprovalmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompfinancialapprovalmainTblQuery(get_called_class());
    }
}
