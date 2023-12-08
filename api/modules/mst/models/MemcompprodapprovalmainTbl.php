<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompprodapprovalmain_tbl".
 *
 * @property int $memcompprodapprovalmain_pk
 * @property int $mcpam_membercompanymst_fk Reference to membercompanymst_tbl
 * @property int $mcpam_certapprovaldtls_fk Reference to certapprovaldtls_tbl
 * @property int $mcpam_level Level of approval
 * @property int $mcpam_status 1-Approved, 2-Decilned
 * @property int $mcpam_movedtonxtlevel 1 - not moved, 2 - moved, by default 1
 * @property int $mcpam_nxtlevel Which level the Form is moved to
 * @property string $mcpam_comments
 * @property int $mcpam_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mcpam_updatedon
 */
class MemcompprodapprovalmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompprodapprovalmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcpam_membercompanymst_fk', 'mcpam_certapprovaldtls_fk', 'mcpam_level', 'mcpam_status', 'mcpam_movedtonxtlevel', 'mcpam_apprdclnby', 'mcpam_updatedon'], 'required'],
            [['mcpam_membercompanymst_fk', 'mcpam_certapprovaldtls_fk', 'mcpam_level', 'mcpam_status', 'mcpam_movedtonxtlevel', 'mcpam_nxtlevel', 'mcpam_apprdclnby'], 'integer'],
            [['mcpam_comments'], 'string'],
            [['mcpam_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompprodapprovalmain_pk' => 'Memcompprodapprovalmain Pk',
            'mcpam_membercompanymst_fk' => 'Mcpam Membercompanymst Fk',
            'mcpam_certapprovaldtls_fk' => 'Mcpam Certapprovaldtls Fk',
            'mcpam_level' => 'Mcpam Level',
            'mcpam_status' => 'Mcpam Status',
            'mcpam_movedtonxtlevel' => 'Mcpam Movedtonxtlevel',
            'mcpam_nxtlevel' => 'Mcpam Nxtlevel',
            'mcpam_comments' => 'Mcpam Comments',
            'mcpam_apprdclnby' => 'Mcpam Apprdclnby',
            'mcpam_updatedon' => 'Mcpam Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodapprovalmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompprodapprovalmainTblQuery(get_called_class());
    }
}
