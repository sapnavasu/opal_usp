<?php

namespace api\modules\pd\models;

use Yii;
use api\modules\pd\models\ProjectdtlsTbl;
use common\models\UsermstTbl;

/**
 * This is the model class for table "projtechdocuments_tbl".
 *
 * @property int $projtechdocuments_pk Primary key
 * @property int $ptd_projectdtls_fk Reference to projectdtls_tbl
 * @property int $ptd_typeofdoc 1- Project plan, 2 - Feasibility report, 3 - Legal
 * @property string $ptd_techdoc Memcompfiledtls_pk stored as comma separation
 * @property string $ptd_approvedon Datetime of approved
 * @property int $ptd_approvedby Reference to usermst_tbl
 * @property string $ptd_approvedbyipaddr IP Address of the user
 * @property string $ptd_submittedon First date of submission
 * @property int $ptd_submittedby Reference to usermst_tbl
 * @property string $ptd_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $ptdApprovedby
 * @property ProjectdtlsTbl $ptdProjectdtlsFk
 * @property UsermstTbl $ptdSubmittedby
 */
class ProjtechdocumentsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projtechdocuments_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ptd_projectdtls_fk', 'ptd_typeofdoc', 'ptd_techdoc', 'ptd_approvedon', 'ptd_approvedby'], 'required'],
            [['ptd_projectdtls_fk', 'ptd_typeofdoc', 'ptd_approvedby', 'ptd_submittedby'], 'integer'],
            [['ptd_techdoc'], 'string'],
            [['ptd_approvedon', 'ptd_submittedon'], 'safe'],
            [['ptd_approvedbyipaddr', 'ptd_submittedbyipaddr'], 'string', 'max' => 50],
            [['ptd_approvedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ptd_approvedby' => 'UserMst_Pk']],
            [['ptd_projectdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectdtlsTbl::className(), 'targetAttribute' => ['ptd_projectdtls_fk' => 'projectdtls_pk']],
            [['ptd_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ptd_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projtechdocuments_pk' => 'Projtechdocuments Pk',
            'ptd_projectdtls_fk' => 'Ptd Projectdtls Fk',
            'ptd_typeofdoc' => 'Ptd Typeofdoc',
            'ptd_techdoc' => 'Ptd Techdoc',
            'ptd_approvedon' => 'Ptd Approvedon',
            'ptd_approvedby' => 'Ptd Approvedby',
            'ptd_approvedbyipaddr' => 'Ptd Approvedbyipaddr',
            'ptd_submittedon' => 'Ptd Submittedon',
            'ptd_submittedby' => 'Ptd Submittedby',
            'ptd_submittedbyipaddr' => 'Ptd Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtdApprovedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ptd_approvedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtdProjectdtlsFk()
    {
        return $this->hasOne(ProjectdtlsTbl::className(), ['projectdtls_pk' => 'ptd_projectdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtdSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ptd_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechdocumentsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjtechdocumentsTblQuery(get_called_class());
    }
}
