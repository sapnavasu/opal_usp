<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\pd\models\ProjecthstyTbl;

/**
 * This is the model class for table "projfaqhsty_tbl".
 *
 * @property int $projfaqhsty_pk Primary key
 * @property int $pfh_projecthsty_fk Reference to projecthsty_pk
 * @property string $pfh_question Question
 * @property string $pfh_answer Answer for the question
 * @property int $pfh_type 1 - General, 2 - Project, 3 - Product, 4 - Services
 * @property int $pfh_index index of the QA
 * @property int $pfh_status 1 - Active, 2 - Inactive
 * @property string $pfh_histcreatedon Datetime of history creation
 * @property string $pfh_appdeclon Datetime of approval / declined
 * @property int $pfh_appdeclby Reference to usermst_tbl
 * @property string $pfh_appdeclbyipaddr User IP Address
 * @property string $pfh_submittedon Datetime of first submission
 * @property int $pfh_submittedby Reference to usermst_tbl
 * @property string $pfh_submittedbyipaddr User IP Address
 *
 * @property UsermstTbl $pfhAppdeclby
 * @property UsermstTbl $pfhSubmittedby
 * @property ProjecthstyTbl $pfhProjecthstyFk
 */
class ProjfaqhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projfaqhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pfh_projecthsty_fk', 'pfh_type', 'pfh_index', 'pfh_status', 'pfh_appdeclby', 'pfh_submittedby'], 'integer'],
            [['pfh_question', 'pfh_answer', 'pfh_type', 'pfh_status', 'pfh_histcreatedon', 'pfh_appdeclon', 'pfh_appdeclby'], 'required'],
            [['pfh_question', 'pfh_answer'], 'string'],
            [['pfh_histcreatedon', 'pfh_appdeclon', 'pfh_submittedon'], 'safe'],
            [['pfh_appdeclbyipaddr', 'pfh_submittedbyipaddr'], 'string', 'max' => 50],
            [['pfh_appdeclby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pfh_appdeclby' => 'UserMst_Pk']],
            [['pfh_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pfh_submittedby' => 'UserMst_Pk']],
            [['pfh_projecthsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecthstyTbl::className(), 'targetAttribute' => ['pfh_projecthsty_fk' => 'projecthsty_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projfaqhsty_pk' => 'Projfaqhsty Pk',
            'pfh_projecthsty_fk' => 'Pfh Projecthsty Fk',
            'pfh_question' => 'Pfh Question',
            'pfh_answer' => 'Pfh Answer',
            'pfh_type' => 'Pfh Type',
            'pfh_index' => 'Pfh Index',
            'pfh_status' => 'Pfh Status',
            'pfh_histcreatedon' => 'Pfh Histcreatedon',
            'pfh_appdeclon' => 'Pfh Appdeclon',
            'pfh_appdeclby' => 'Pfh Appdeclby',
            'pfh_appdeclbyipaddr' => 'Pfh Appdeclbyipaddr',
            'pfh_submittedon' => 'Pfh Submittedon',
            'pfh_submittedby' => 'Pfh Submittedby',
            'pfh_submittedbyipaddr' => 'Pfh Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPfhAppdeclby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pfh_appdeclby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPfhSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pfh_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPfhProjecthstyFk()
    {
        return $this->hasOne(ProjecthstyTbl::className(), ['projecthsty_pk' => 'pfh_projecthsty_fk']);
    }

    /**
     * {@inheritdoc}
     * @return ProjfaqhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjfaqhstyTblQuery(get_called_class());
    }
}
