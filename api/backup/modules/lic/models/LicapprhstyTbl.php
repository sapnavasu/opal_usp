<?php

namespace api\modules\lic\models;

use Yii;

/**
 * This is the model class for table "licapprhsty_tbl".
 *
 * @property int $licapprhsty_pk Primary key
 * @property int $lah_licinvapplied_fk Reference to licinvapplied_tbl
 * @property int $lah_status 1 - Approved, 2 - Declined, 3 - Cancelled, 4 - Re-Submitted, 5 - Not Applicable, 6 - Submitted
 * @property string $lah_comments Approval Comments
 * @property string $lah_submittedon Date of submission
 * @property int $lah_submittedby
 * @property string $lah_submittedbyipaddr IP Address of the user
 * @property string $lah_apprdeclon Approved / Declined on
 * @property int $lah_apprdeclby Approved / Declined by user id
 * @property string $lah_apprdeclbyipaddr IP Address of the user
 */
class LicapprhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licapprhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lah_licinvapplied_fk', 'lah_status', 'lah_submittedon', 'lah_submittedby'], 'required'],
            [['lah_licinvapplied_fk', 'lah_status', 'lah_submittedby', 'lah_apprdeclby'], 'integer'],
            [['lah_comments'], 'string'],
            [['lah_submittedon', 'lah_apprdeclon'], 'safe'],
            [['lah_submittedbyipaddr', 'lah_apprdeclbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'licapprhsty_pk' => 'Licapprhsty Pk',
            'lah_licinvapplied_fk' => 'Lah Licinvapplied Fk',
            'lah_status' => 'Lah Status',
            'lah_comments' => 'Lah Comments',
            'lah_submittedon' => 'Lah Submittedon',
            'lah_submittedby' => 'Lah Submittedby',
            'lah_submittedbyipaddr' => 'Lah Submittedbyipaddr',
            'lah_apprdeclon' => 'Lah Apprdeclon',
            'lah_apprdeclby' => 'Lah Apprdeclby',
            'lah_apprdeclbyipaddr' => 'Lah Apprdeclbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LicapprhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LicapprhstyTblQuery(get_called_class());
    }
}
