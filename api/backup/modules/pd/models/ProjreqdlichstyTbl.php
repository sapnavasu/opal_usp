<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projreqdlichsty_tbl".
 *
 * @property int $projreqdlichsty_pk Primary key
 * @property int $prlh_projecthsty_fk Reference to projecthsty_tbl
 * @property int $prlh_licensinginfo_fk Reference to licensinginfo_tbl
 * @property int $prlh_order Order of the license
 * @property string $prlh_submittedon Date of first submission
 * @property int $prlh_submittedby Reference to usermst_tbl
 * @property string $prlh_submittedbyipaddr IP Address of the user
 * @property string $prlh_histcreatedon Date of history creation
 * @property string $prlh_approvedon Date of Approval
 * @property int $prlh_approvedby Reference to usermst_tbl
 * @property string $prlh_approvedbyipaddr IP Address of the user
 */
class ProjreqdlichstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projreqdlichsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prlh_projecthsty_fk', 'prlh_licensinginfo_fk', 'prlh_order', 'prlh_histcreatedon'], 'required'],
            [['prlh_projecthsty_fk', 'prlh_licensinginfo_fk', 'prlh_order', 'prlh_submittedby', 'prlh_approvedby'], 'integer'],
            [['prlh_submittedon', 'prlh_histcreatedon', 'prlh_approvedon'], 'safe'],
            [['prlh_submittedbyipaddr', 'prlh_approvedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projreqdlichsty_pk' => 'Projreqdlichsty Pk',
            'prlh_projecthsty_fk' => 'Prlh Projecthsty Fk',
            'prlh_licensinginfo_fk' => 'Prlh Licensinginfo Fk',
            'prlh_order' => 'Prlh Order',
            'prlh_submittedon' => 'Prlh Submittedon',
            'prlh_submittedby' => 'Prlh Submittedby',
            'prlh_submittedbyipaddr' => 'Prlh Submittedbyipaddr',
            'prlh_histcreatedon' => 'Prlh Histcreatedon',
            'prlh_approvedon' => 'Prlh Approvedon',
            'prlh_approvedby' => 'Prlh Approvedby',
            'prlh_approvedbyipaddr' => 'Prlh Approvedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjreqdlichstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjreqdlichstyTblQuery(get_called_class());
    }
}
