<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projacqlichsty_tbl".
 *
 * @property int $projacqlichsty_pk Primary key
 * @property int $palh_projecthsty_fk Reference to projecthsty_tbl
 * @property int $palh_licensinginfo_fk Reference to licensinginfo_tbl
 * @property int $palh_order Order of the license
 * @property string $palh_submittedon Date of first submission
 * @property int $palh_submittedby Reference to usermst_tbl
 * @property string $palh_submittedbyipaddr IP Address of the user
 * @property string $palh_histcreatedon Datetime of history creation
 * @property string $palh_approvedon Date of Approval
 * @property int $palh_approvedby Reference to usermst_tbl
 * @property string $palh_approvedbyipaddr IP Address of the user
 */
class ProjacqlichstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projacqlichsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['palh_projecthsty_fk', 'palh_licensinginfo_fk', 'palh_order', 'palh_histcreatedon'], 'required'],
            [['palh_projecthsty_fk', 'palh_licensinginfo_fk', 'palh_order', 'palh_submittedby', 'palh_approvedby'], 'integer'],
            [['palh_submittedon', 'palh_histcreatedon', 'palh_approvedon'], 'safe'],
            [['palh_submittedbyipaddr', 'palh_approvedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projacqlichsty_pk' => 'Projacqlichsty Pk',
            'palh_projecthsty_fk' => 'Palh Projecthsty Fk',
            'palh_licensinginfo_fk' => 'Palh Licensinginfo Fk',
            'palh_order' => 'Palh Order',
            'palh_submittedon' => 'Palh Submittedon',
            'palh_submittedby' => 'Palh Submittedby',
            'palh_submittedbyipaddr' => 'Palh Submittedbyipaddr',
            'palh_histcreatedon' => 'Palh Histcreatedon',
            'palh_approvedon' => 'Palh Approvedon',
            'palh_approvedby' => 'Palh Approvedby',
            'palh_approvedbyipaddr' => 'Palh Approvedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjacqlichstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjacqlichstyTblQuery(get_called_class());
    }
}
