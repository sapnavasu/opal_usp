<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\pd\models\ProjecthstyTbl;

/**
 * This is the model class for table "projtechdocumentshsty_tbl".
 *
 * @property int $projtechdocumentshsty_pk Primary key
 * @property int $ptdh_projecthsty_fk Reference to projecthsty_tbl
 * @property int $ptdh_typeofdoc Technical documents.Reference to memcompfiledtls_tbl
 * @property string $ptdh_techdoc Memcompfiledtls_pk stored as comma separation
 * @property string $ptdh_histcreatedon Datetime of creation
 * @property string $ptdh_appdeclon Datetime of approval / decline
 * @property int $ptdh_appdeclby Reference to usermst_tbl
 * @property string $ptdh_appdeclbyipaddr IP Address of the user
 * @property string $ptdh_submittedon First date of submission
 * @property int $ptdh_submittedby Reference to usermst_tbl
 * @property string $ptdh_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $ptdhAppdeclby
 * @property ProjecthstyTbl $ptdhProjecthstyFk
 * @property UsermstTbl $ptdhSubmittedby
 */
class ProjtechdocumentshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projtechdocumentshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ptdh_projecthsty_fk', 'ptdh_typeofdoc', 'ptdh_histcreatedon', 'ptdh_appdeclon', 'ptdh_appdeclby'], 'required'],
            [['ptdh_projecthsty_fk', 'ptdh_typeofdoc', 'ptdh_appdeclby', 'ptdh_submittedby'], 'integer'],
            [['ptdh_techdoc'], 'string'],
            [['ptdh_histcreatedon', 'ptdh_appdeclon', 'ptdh_submittedon'], 'safe'],
            [['ptdh_appdeclbyipaddr', 'ptdh_submittedbyipaddr'], 'string', 'max' => 50],
            [['ptdh_appdeclby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ptdh_appdeclby' => 'UserMst_Pk']],
            [['ptdh_projecthsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecthstyTbl::className(), 'targetAttribute' => ['ptdh_projecthsty_fk' => 'projecthsty_pk']],
            [['ptdh_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ptdh_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projtechdocumentshsty_pk' => 'Projtechdocumentshsty Pk',
            'ptdh_projecthsty_fk' => 'Ptdh Projecthsty Fk',
            'ptdh_typeofdoc' => 'Ptdh Typeofdoc',
            'ptdh_techdoc' => 'Ptdh Techdoc',
            'ptdh_histcreatedon' => 'Ptdh Histcreatedon',
            'ptdh_appdeclon' => 'Ptdh Appdeclon',
            'ptdh_appdeclby' => 'Ptdh Appdeclby',
            'ptdh_appdeclbyipaddr' => 'Ptdh Appdeclbyipaddr',
            'ptdh_submittedon' => 'Ptdh Submittedon',
            'ptdh_submittedby' => 'Ptdh Submittedby',
            'ptdh_submittedbyipaddr' => 'Ptdh Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtdhAppdeclby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ptdh_appdeclby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtdhProjecthstyFk()
    {
        return $this->hasOne(ProjecthstyTbl::className(), ['projecthsty_pk' => 'ptdh_projecthsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtdhSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ptdh_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechdocumentshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjtechdocumentshstyTblQuery(get_called_class());
    }
}
