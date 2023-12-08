<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompserviceapprovalmain_tbl".
 *
 * @property int $memcompserviceapprovalmain_pk
 * @property int $mcsam_membercompanymst_fk Reference to membercompanymst_tbl
 * @property int $mcsam_certapprovaldtls_fk Reference to certapprovaldtls_tbl
 * @property int $mcsam_level
 * @property int $mcsam_status 1-Approved, 2-Decilned
 * @property int $mcsam_movedtonxtlevel 1 - not moved, 2 - moved, by default 1
 * @property int $mcsam_nxtlevel Which level the Form is moved to
 * @property string $mcsam_comments
 * @property int $mcsam_apprdclnby
 * @property string $mcsam_updatedon Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 */
class MemcompserviceapprovalmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompserviceapprovalmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcsam_membercompanymst_fk', 'mcsam_certapprovaldtls_fk', 'mcsam_level', 'mcsam_status', 'mcsam_movedtonxtlevel', 'mcsam_apprdclnby', 'mcsam_updatedon'], 'required'],
            [['mcsam_membercompanymst_fk', 'mcsam_certapprovaldtls_fk', 'mcsam_level', 'mcsam_status', 'mcsam_movedtonxtlevel', 'mcsam_nxtlevel', 'mcsam_apprdclnby'], 'integer'],
            [['mcsam_comments'], 'string'],
            [['mcsam_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompserviceapprovalmain_pk' => 'Memcompserviceapprovalmain Pk',
            'mcsam_membercompanymst_fk' => 'Mcsam Membercompanymst Fk',
            'mcsam_certapprovaldtls_fk' => 'Mcsam Certapprovaldtls Fk',
            'mcsam_level' => 'Mcsam Level',
            'mcsam_status' => 'Mcsam Status',
            'mcsam_movedtonxtlevel' => 'Mcsam Movedtonxtlevel',
            'mcsam_nxtlevel' => 'Mcsam Nxtlevel',
            'mcsam_comments' => 'Mcsam Comments',
            'mcsam_apprdclnby' => 'Mcsam Apprdclnby',
            'mcsam_updatedon' => 'Mcsam Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompserviceapprovalmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompserviceapprovalmainTblQuery(get_called_class());
    }
}
