<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompshareholderapprovalmain_tbl".
 *
 * @property int $memcompshareholderapprovalmain_pk
 * @property int $mcsham_membercompanymst_fk Reference to membercompanymst_tbl
 * @property int $mcsham_certapprovaldtls_fk Reference to certapprovaldtls_tbl
 * @property int $mcsham_level Level of approval
 * @property int $mcsham_status 1-Approved, 2-Decilned
 * @property int $mcsham_movedtonxtlevel 1 - not moved, 2 - moved, by default 1
 * @property int $mcsham_nxtlevel Which level the Form is moved to
 * @property string $mcsham_comments
 * @property int $mcsham_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $mcsham_updatedon
 */
class MemcompshareholderapprovalmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompshareholderapprovalmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcsham_membercompanymst_fk', 'mcsham_certapprovaldtls_fk', 'mcsham_level', 'mcsham_status', 'mcsham_movedtonxtlevel', 'mcsham_apprdclnby', 'mcsham_updatedon'], 'required'],
            [['mcsham_membercompanymst_fk', 'mcsham_certapprovaldtls_fk', 'mcsham_level', 'mcsham_status', 'mcsham_movedtonxtlevel', 'mcsham_nxtlevel', 'mcsham_apprdclnby'], 'integer'],
            [['mcsham_comments'], 'string'],
            [['mcsham_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompshareholderapprovalmain_pk' => 'Memcompshareholderapprovalmain Pk',
            'mcsham_membercompanymst_fk' => 'Mcsham Membercompanymst Fk',
            'mcsham_certapprovaldtls_fk' => 'Mcsham Certapprovaldtls Fk',
            'mcsham_level' => 'Mcsham Level',
            'mcsham_status' => 'Mcsham Status',
            'mcsham_movedtonxtlevel' => 'Mcsham Movedtonxtlevel',
            'mcsham_nxtlevel' => 'Mcsham Nxtlevel',
            'mcsham_comments' => 'Mcsham Comments',
            'mcsham_apprdclnby' => 'Mcsham Apprdclnby',
            'mcsham_updatedon' => 'Mcsham Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompshareholderapprovalmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompshareholderapprovalmainTblQuery(get_called_class());
    }
}
