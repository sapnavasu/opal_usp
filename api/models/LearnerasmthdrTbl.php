<?php

namespace app\models;

use Yii;
use api\modules\drv\models\MemcompfiledtlsTbl;

/**
 * This is the model class for table "learnerasmthdr_tbl".
 *
 * @property int $LearnerAsmtHdr_PK
 * @property int $lasmth_LearnerRegHrdDtls_FK Reference to learnerreghrddtls_pk
 * @property int $lasmth_AsmtType 1-Offline, 2-Online
 * @property int $lasmth_AsmtUpload Reference to memcompfiledtls_pk, NOT NULL when lasmth_asmttype = 1
 * @property int $lasmth_AssessmentMst_FK Reference to assessmentmst_pk, NOT NULL when lasmth_asmttype = 2
 * @property string $lasmth_TotalMarks Calculate as assessmentmst_tbl.asmtm_noofquestions * asmtquestionmst_tbl.asmtqm_mark
 * @property string $lasmth_MarkSecured Calculate as asmtquestionmst_tbl.asmtqm_mark * lasmtqd_quesresult=1
 * @property string $lasmth_percentage
 * @property int $lasmth_AsmtStatus assessment status 1-Not yet appeared, 2-Appeared
 * @property int $lasmth_Status Reference to referencemst_pk where rm_mastertype=15
 * @property string $lasmth_AppdecOn
 * @property int $lasmth_AppdecBy
 * @property string $lasmth_AppdecComments
 * @property string $lasmth_Createdon NULL when lasmth_asmttype = 1
 * @property int $lasmth_CreatedBy NULL when lasmth_asmttype = 1
 * @property string $lasmth_updatedon NULL when lasmth_asmttype = 1
 * @property int $lasmth_updatedby NULL when lasmth_asmttype = 1
 *
 * @property MemcompfiledtlsTbl $lasmthAsmtUpload
 * @property AssessmentmstTbl $lasmthAssessmentMstFK
 * @property LearnerreghrddtlsTbl $lasmthLearnerRegHrdDtlsFK
 * @property LearnerasmtquesdtlsTbl[] $learnerasmtquesdtlsTbls
 */
class LearnerasmthdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learnerasmthdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lasmth_LearnerRegHrdDtls_FK', 'lasmth_AsmtStatus', 'lasmth_Status'], 'required'],
            [['lasmth_LearnerRegHrdDtls_FK', 'lasmth_AsmtType', 'lasmth_AsmtUpload', 'lasmth_AssessmentMst_FK', 'lasmth_AsmtStatus', 'lasmth_Status', 'lasmth_AppdecBy', 'lasmth_CreatedBy', 'lasmth_updatedby'], 'integer'],
            [['lasmth_TotalMarks', 'lasmth_MarkSecured', 'lasmth_percentage'], 'number'],
            [['lasmth_AppdecOn', 'lasmth_Createdon', 'lasmth_updatedon'], 'safe'],
            [['lasmth_AppdecComments'], 'string'],
            [['lasmth_AsmtUpload'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompfiledtlsTbl::className(), 'targetAttribute' => ['lasmth_AsmtUpload' => 'memcompfiledtls_pk']],
            [['lasmth_AssessmentMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AssessmentmstTbl::className(), 'targetAttribute' => ['lasmth_AssessmentMst_FK' => 'AssessmentMst_PK']],
            [['lasmth_LearnerRegHrdDtls_FK'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerreghrddtlsTbl::className(), 'targetAttribute' => ['lasmth_LearnerRegHrdDtls_FK' => 'learnerreghrddtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LearnerAsmtHdr_PK' => 'Learner Asmt Hdr  Pk',
            'lasmth_LearnerRegHrdDtls_FK' => 'Lasmth  Learner Reg Hrd Dtls  Fk',
            'lasmth_AsmtType' => 'Lasmth  Asmt Type',
            'lasmth_AsmtUpload' => 'Lasmth  Asmt Upload',
            'lasmth_AssessmentMst_FK' => 'Lasmth  Assessment Mst  Fk',
            'lasmth_TotalMarks' => 'Lasmth  Total Marks',
            'lasmth_MarkSecured' => 'Lasmth  Mark Secured',
            'lasmth_percentage' => 'Lasmth  Percentage',
            'lasmth_AsmtStatus' => 'Lasmth  Asmt Status',
            'lasmth_Status' => 'Lasmth  Status',
            'lasmth_AppdecOn' => 'Lasmth  Appdec On',
            'lasmth_AppdecBy' => 'Lasmth  Appdec By',
            'lasmth_AppdecComments' => 'Lasmth  Appdec Comments',
            'lasmth_Createdon' => 'Lasmth  Createdon',
            'lasmth_CreatedBy' => 'Lasmth  Created By',
            'lasmth_updatedon' => 'Lasmth Updatedon',
            'lasmth_updatedby' => 'Lasmth Updatedby',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getLasmthAsmtUpload()
    {
        return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'lasmth_AsmtUpload']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLasmthAssessmentMstFK()
    {
        return $this->hasOne(AssessmentmstTbl::className(), ['AssessmentMst_PK' => 'lasmth_AssessmentMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLasmthLearnerRegHrdDtlsFK()
    {
        return $this->hasOne(LearnerreghrddtlsTbl::className(), ['learnerreghrddtls_pk' => 'lasmth_LearnerRegHrdDtls_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerasmtquesdtlsTbls()
    {
        return $this->hasMany(LearnerasmtquesdtlsTbl::className(), ['lasmtqd_LearnerAsmtHdr_FK' => 'LearnerAsmtHdr_PK']);
    }

    /**
     * {@inheritdoc}
     * @return LearnerasmthdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LearnerasmthdrTblQuery(get_called_class());
    }

    
}
