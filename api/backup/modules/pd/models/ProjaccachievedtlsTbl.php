<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\pd\models\ProjectdtlsTbl;

/**
 * This is the model class for table "projaccachievedtls_tbl".
 *
 * @property int $projaccachievedtls_pk Primary key
 * @property int $paad_projectdtls_fk Reference to projectdtls_tbl
 * @property string $paad_memcompacomplishdtls_fk Reference to memcompacomplishdtls_tbl
 * @property int $paad_type 1 - Accreditation, 2 - Achievement, 3 - Award, 4 - Certificate
 * @property string $paad_memcompfiledtls_fk Memcompfiledtls_pk stored in comma separation
 * @property int $paad_index For sorting purpose
 * @property string $paad_approvedon Datetime of approval
 * @property int $paad_approvedby Reference to usermst_tbl
 * @property string $paad_approvedbyipaddr IP Address of the user
 * @property string $paad_submittedon Datetime of first submission
 * @property int $paad_submittedby Reference to usermst_tbl
 * @property string $paad_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $paadApprovedby
 * @property MemcompacomplishdtlsTbl $paadMemcompacomplishdtlsFk
 * @property ProjectdtlsTbl $paadProjectdtlsFk
 * @property UsermstTbl $paadSubmittedby
 */
class ProjaccachievedtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projaccachievedtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paad_projectdtls_fk', 'paad_memcompacomplishdtls_fk', 'paad_type', 'paad_index', 'paad_approvedon', 'paad_approvedby'], 'required'],
            [['paad_projectdtls_fk', 'paad_memcompacomplishdtls_fk', 'paad_type', 'paad_index', 'paad_approvedby', 'paad_submittedby'], 'integer'],
            [['paad_memcompfiledtls_fk'], 'string'],
            [['paad_approvedon', 'paad_submittedon'], 'safe'],
            [['paad_approvedbyipaddr', 'paad_submittedbyipaddr'], 'string', 'max' => 50],
            [['paad_approvedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['paad_approvedby' => 'UserMst_Pk']],
            [['paad_memcompacomplishdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompacomplishdtlsTbl::className(), 'targetAttribute' => ['paad_memcompacomplishdtls_fk' => 'memcompacomplishdtls_pk']],
            [['paad_projectdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectdtlsTbl::className(), 'targetAttribute' => ['paad_projectdtls_fk' => 'projectdtls_pk']],
            [['paad_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['paad_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projaccachievedtls_pk' => 'Projaccachievedtls Pk',
            'paad_projectdtls_fk' => 'Paad Projectdtls Fk',
            'paad_memcompacomplishdtls_fk' => 'Paad Memcompacomplishdtls Fk',
            'paad_type' => 'Paad Type',
            'paad_memcompfiledtls_fk' => 'Paad Memcompfiledtls Fk',
            'paad_index' => 'Paad Index',
            'paad_approvedon' => 'Paad Approvedon',
            'paad_approvedby' => 'Paad Approvedby',
            'paad_approvedbyipaddr' => 'Paad Approvedbyipaddr',
            'paad_submittedon' => 'Paad Submittedon',
            'paad_submittedby' => 'Paad Submittedby',
            'paad_submittedbyipaddr' => 'Paad Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaadApprovedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'paad_approvedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaadProjectdtlsFk()
    {
        return $this->hasOne(ProjectdtlsTbl::className(), ['projectdtls_pk' => 'paad_projectdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaadSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'paad_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjaccachievedtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjaccachievedtlsTblQuery(get_called_class());
    }
}
