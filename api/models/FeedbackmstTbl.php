<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedbackmst_tbl".
 *
 * @property int $FeedbackMst_PK
 * @property int $fdbkm_OpalmemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $fdbkm_StandardCourseMst_FK Reference to standardcoursemst_pk
 * @property int $fdbkm_StandardCourseDtls_FK Reference to standardcoursedtls_pk
 * @property int $fdbkm_Status 1-Active, 2-Inactive, by default 1
 * @property string $fdbkm_CreatedOn
 * @property int $fdbkm_CreatedBy
 * @property string $fdbkm_UpdatedOn
 * @property int $fdbkm_UpdatedBy
 *
 * @property FdbkquestmstTbl[] $fdbkquestmstTbls
 * @property FeedbackctgytypeTbl[] $feedbackctgytypeTbls
 * @property OpalmemberregmstTbl $fdbkmOpalmemberRegMstFK
 * @property StandardcoursedtlsTbl $fdbkmStandardCourseDtlsFK
 * @property StandardcoursemstTbl $fdbkmStandardCourseMstFK
 */
class FeedbackmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedbackmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fdbkm_OpalmemberRegMst_FK', 'fdbkm_StandardCourseMst_FK', 'fdbkm_StandardCourseDtls_FK', 'fdbkm_Status', 'fdbkm_CreatedBy', 'fdbkm_UpdatedBy'], 'integer'],
            [['fdbkm_CreatedOn', 'fdbkm_UpdatedOn'], 'safe'],
            [['fdbkm_CreatedBy'], 'required'],
            [['fdbkm_OpalmemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['fdbkm_OpalmemberRegMst_FK' => 'opalmemberregmst_pk']],
            [['fdbkm_StandardCourseDtls_FK'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['fdbkm_StandardCourseDtls_FK' => 'standardcoursedtls_pk']],
            [['fdbkm_StandardCourseMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['fdbkm_StandardCourseMst_FK' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FeedbackMst_PK' => 'Feedback Mst  Pk',
            'fdbkm_OpalmemberRegMst_FK' => 'Fdbkm  Opalmember Reg Mst  Fk',
            'fdbkm_StandardCourseMst_FK' => 'Fdbkm  Standard Course Mst  Fk',
            'fdbkm_StandardCourseDtls_FK' => 'Fdbkm  Standard Course Dtls  Fk',
            'fdbkm_Status' => 'Fdbkm  Status',
            'fdbkm_CreatedOn' => 'Fdbkm  Created On',
            'fdbkm_CreatedBy' => 'Fdbkm  Created By',
            'fdbkm_UpdatedOn' => 'Fdbkm  Updated On',
            'fdbkm_UpdatedBy' => 'Fdbkm  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFdbkquestmstTbls()
    {
        return $this->hasMany(FdbkquestmstTbl::className(), ['fdbkqm_FeedbackMst_FK' => 'FeedbackMst_PK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackctgytypeTbls()
    {
        return $this->hasMany(FeedbackctgytypeTbl::className(), ['fdbkct_feedbackmst_fk' => 'FeedbackMst_PK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFdbkmOpalmemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'fdbkm_OpalmemberRegMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFdbkmStandardCourseDtlsFK()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'fdbkm_StandardCourseDtls_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFdbkmStandardCourseMstFK()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'fdbkm_StandardCourseMst_FK']);
    }

    /**
     * {@inheritdoc}
     * @return FeedbackmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeedbackmstTblQuery(get_called_class());
    }
}
