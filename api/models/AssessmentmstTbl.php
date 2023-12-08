<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assessmentmst_tbl".
 *
 * @property int $AssessmentMst_PK
 * @property int $asmtm_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $asmtm_StandardCourseMst_FK Reference to standardcoursemst_pk
 * @property int $asmtm_standardcoursedtls_FK Reference to standardcoursedtls_pk
 * @property string $asmtm_AssessmentTitle
 * @property int $asmtm_InternalAsmt 1-Knowledge Assessment, 2-Practical Assessment by default 1
 * @property int $asmtm_Status 1-Active, 2-Inactive, by default 1
 * @property string $asmtm_Version
 * @property int $asmtm_Duration Duration in Minutes
 * @property int $asmtm_NoOfQuestions Number of questions to be picked for assessment
 * @property string $asmtm_CreatedOn
 * @property int $asmtm_CreatedBy
 * @property string $asmtm_UpdatedOn
 * @property int $asmtm_UpdatedBy
 *
 * @property AsmtquestionmstTbl[] $asmtquestionmstTbls
 * @property OpalmemberregmstTbl $asmtmOpalMemberRegMstFK
 * @property StandardcoursedtlsTbl $asmtmStandardcoursedtlsFK
 * @property StandardcoursemstTbl $asmtmStandardCourseMstFK
 * @property LearnerasmthdrTbl[] $learnerasmthdrTbls
 */
class AssessmentmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assessmentmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asmtm_OpalMemberRegMst_FK', 'asmtm_StandardCourseMst_FK', 'asmtm_Version', 'asmtm_Duration', 'asmtm_NoOfQuestions', 'asmtm_CreatedOn', 'asmtm_CreatedBy'], 'required'],
            [['asmtm_OpalMemberRegMst_FK', 'asmtm_StandardCourseMst_FK', 'asmtm_standardcoursedtls_FK', 'asmtm_InternalAsmt', 'asmtm_Status', 'asmtm_Duration', 'asmtm_NoOfQuestions', 'asmtm_CreatedBy', 'asmtm_UpdatedBy'], 'integer'],
            [['asmtm_Version'], 'number'],
            [['asmtm_CreatedOn', 'asmtm_UpdatedOn'], 'safe'],
            [['asmtm_AssessmentTitle'], 'string', 'max' => 255],
            [['asmtm_OpalMemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['asmtm_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']],
            [['asmtm_standardcoursedtls_FK'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['asmtm_standardcoursedtls_FK' => 'standardcoursedtls_pk']],
            [['asmtm_StandardCourseMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['asmtm_StandardCourseMst_FK' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AssessmentMst_PK' => 'Assessment Mst  Pk',
            'asmtm_OpalMemberRegMst_FK' => 'Asmtm  Opal Member Reg Mst  Fk',
            'asmtm_StandardCourseMst_FK' => 'Asmtm  Standard Course Mst  Fk',
            'asmtm_standardcoursedtls_FK' => 'Asmtm Standardcoursedtls  Fk',
            'asmtm_AssessmentTitle' => 'Asmtm  Assessment Title',
            'asmtm_InternalAsmt' => 'Asmtm  Internal Asmt',
            'asmtm_Status' => 'Asmtm  Status',
            'asmtm_Version' => 'Asmtm  Version',
            'asmtm_Duration' => 'Asmtm  Duration',
            'asmtm_NoOfQuestions' => 'Asmtm  No Of Questions',
            'asmtm_CreatedOn' => 'Asmtm  Created On',
            'asmtm_CreatedBy' => 'Asmtm  Created By',
            'asmtm_UpdatedOn' => 'Asmtm  Updated On',
            'asmtm_UpdatedBy' => 'Asmtm  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsmtquestionmstTbls()
    {
        return $this->hasMany(AsmtquestionmstTbl::className(), ['asmtqm_AssessmentMst_fk' => 'AssessmentMst_PK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsmtmOpalMemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'asmtm_OpalMemberRegMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsmtmStandardcoursedtlsFK()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'asmtm_standardcoursedtls_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsmtmStandardCourseMstFK()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'asmtm_StandardCourseMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerasmthdrTbls()
    {
        return $this->hasMany(LearnerasmthdrTbl::className(), ['lasmth_AssessmentMst_FK' => 'AssessmentMst_PK']);
    }

    /**
     * {@inheritdoc}
     * @return AssessmentmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AssessmentmstTblQuery(get_called_class());
    }
}
