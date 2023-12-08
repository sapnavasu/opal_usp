<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\pd\models\ProjecthstyTbl;
/**
 * This is the model class for table "projaccachievehsty_tbl".
 *
 * @property int $projaccachievehsty_pk Primary key
 * @property int $paah_projecthsty_fk Reference to projecthsty_tbl
 * @property string $paah_memcompacomplishdtls_fk Reference to memcompacomplishdtls_tbl
 * @property int $paah_type 1 - Accreditation, 2 - Achievement, 3 - Award, 4 - Certificate
 * @property string $paah_memcompfiledtls_fk Memcompfiledtls_pk stored in comma separation
 * @property int $paah_index For sorting purpose
 * @property string $paah_histcreatedon Datetime of history creation
 * @property string $paah_appdeclon Datetime of approval / decline
 * @property int $paah_appdeclby Reference to usermst_tbl
 * @property string $paah_appdeclbyipaddr IP Address of the user
 * @property string $paah_submittedon Datetime of First submission
 * @property int $paah_submittedby Reference to usermst_tbl
 * @property string $paah_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $paahAppdeclby
 * @property MemcompacomplishdtlsTbl $paahMemcompacomplishdtlsFk
 * @property ProjecthstyTbl $paahProjecthstyFk
 * @property UsermstTbl $paahSubmittedby
 */
class ProjaccachievehstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projaccachievehsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paah_projecthsty_fk', 'paah_memcompacomplishdtls_fk', 'paah_type', 'paah_index', 'paah_histcreatedon', 'paah_appdeclon', 'paah_appdeclby'], 'required'],
            [['paah_projecthsty_fk', 'paah_memcompacomplishdtls_fk', 'paah_type', 'paah_index', 'paah_appdeclby', 'paah_submittedby'], 'integer'],
            [['paah_memcompfiledtls_fk'], 'string'],
            [['paah_histcreatedon', 'paah_appdeclon', 'paah_submittedon'], 'safe'],
            [['paah_appdeclbyipaddr', 'paah_submittedbyipaddr'], 'string', 'max' => 50],
            [['paah_appdeclby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['paah_appdeclby' => 'UserMst_Pk']],
            [['paah_memcompacomplishdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompacomplishdtlsTbl::className(), 'targetAttribute' => ['paah_memcompacomplishdtls_fk' => 'memcompacomplishdtls_pk']],
            [['paah_projecthsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecthstyTbl::className(), 'targetAttribute' => ['paah_projecthsty_fk' => 'projecthsty_pk']],
            [['paah_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['paah_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projaccachievehsty_pk' => 'Projaccachievehsty Pk',
            'paah_projecthsty_fk' => 'Paah Projecthsty Fk',
            'paah_memcompacomplishdtls_fk' => 'Paah Memcompacomplishdtls Fk',
            'paah_type' => 'Paah Type',
            'paah_memcompfiledtls_fk' => 'Paah Memcompfiledtls Fk',
            'paah_index' => 'Paah Index',
            'paah_histcreatedon' => 'Paah Histcreatedon',
            'paah_appdeclon' => 'Paah Appdeclon',
            'paah_appdeclby' => 'Paah Appdeclby',
            'paah_appdeclbyipaddr' => 'Paah Appdeclbyipaddr',
            'paah_submittedon' => 'Paah Submittedon',
            'paah_submittedby' => 'Paah Submittedby',
            'paah_submittedbyipaddr' => 'Paah Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaahAppdeclby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'paah_appdeclby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaahProjecthstyFk()
    {
        return $this->hasOne(ProjecthstyTbl::className(), ['projecthsty_pk' => 'paah_projecthsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaahSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'paah_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjaccachievehstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjaccachievehstyTblQuery(get_called_class());
    }
}
