<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fdbkquestmst_tbl".
 *
 * @property int $FdbkQuestMst_PK
 * @property int $fdbkqm_FeedbackMst_FK Reference to feedbackmst_pk
 * @property int $fdbkqm_feedbackcattype_fk Reference to feedbackcattype_pk
 * @property string $fdbkqm_Question_en
 * @property string $fdbkqm_question_ar
 * @property int $fdbkqm_Order Order of question to be displayed
 * @property int $fdbkqm_Status 1-Active, 2-Inactive
 * @property string $fdbkqm_CreatedOn
 * @property int $fdbkqm_CreatedBy
 * @property string $fdbkqm_UpdatedOn
 * @property int $fdbkqm_UpdatedBy
 *
 * @property FeedbackctgytypeTbl $fdbkqmFeedbackcattypeFk
 * @property FeedbackmstTbl $fdbkqmFeedbackMstFK
 */
class FdbkquestmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fdbkquestmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fdbkqm_FeedbackMst_FK', 'fdbkqm_feedbackcattype_fk', 'fdbkqm_Question_en', 'fdbkqm_question_ar', 'fdbkqm_Order', 'fdbkqm_CreatedBy'], 'required'],
            [['fdbkqm_FeedbackMst_FK', 'fdbkqm_feedbackcattype_fk', 'fdbkqm_Order', 'fdbkqm_Status', 'fdbkqm_CreatedBy', 'fdbkqm_UpdatedBy'], 'integer'],
            [['fdbkqm_Question_en', 'fdbkqm_question_ar'], 'string'],
            [['fdbkqm_CreatedOn', 'fdbkqm_UpdatedOn'], 'safe'],
            [['fdbkqm_feedbackcattype_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FeedbackctgytypeTbl::className(), 'targetAttribute' => ['fdbkqm_feedbackcattype_fk' => 'feedbackctgytype_pk']],
            [['fdbkqm_FeedbackMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => FeedbackmstTbl::className(), 'targetAttribute' => ['fdbkqm_FeedbackMst_FK' => 'FeedbackMst_PK']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FdbkQuestMst_PK' => 'Fdbk Quest Mst  Pk',
            'fdbkqm_FeedbackMst_FK' => 'Fdbkqm  Feedback Mst  Fk',
            'fdbkqm_feedbackcattype_fk' => 'Fdbkqm Feedbackcattype Fk',
            'fdbkqm_Question_en' => 'Fdbkqm  Question En',
            'fdbkqm_question_ar' => 'Fdbkqm Question Ar',
            'fdbkqm_Order' => 'Fdbkqm  Order',
            'fdbkqm_Status' => 'Fdbkqm  Status',
            'fdbkqm_CreatedOn' => 'Fdbkqm  Created On',
            'fdbkqm_CreatedBy' => 'Fdbkqm  Created By',
            'fdbkqm_UpdatedOn' => 'Fdbkqm  Updated On',
            'fdbkqm_UpdatedBy' => 'Fdbkqm  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFdbkqmFeedbackcattypeFk()
    {
        return $this->hasOne(FeedbackctgytypeTbl::className(), ['feedbackctgytype_pk' => 'fdbkqm_feedbackcattype_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFdbkqmFeedbackMstFK()
    {
        return $this->hasOne(FeedbackmstTbl::className(), ['FeedbackMst_PK' => 'fdbkqm_FeedbackMst_FK']);
    }

    /**
     * {@inheritdoc}
     * @return FdbkquestmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FdbkquestmstTblQuery(get_called_class());
    }
}
