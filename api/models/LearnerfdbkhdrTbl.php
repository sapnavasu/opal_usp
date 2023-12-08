<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learnerfdbkhdr_tbl".
 *
 * @property int $LearnerFdbkHdr_PK
 * @property int $lfh_LearnerRegHrdDtls_FK Reference to learnerreghrddtls_pk
 * @property int $lfh_feedbackmst_fk Reference to feedbackmst_pk
 * @property int $lfh_FdbbkStatus Feedback status: 1 - Yet to Provide, 2 - Completed
 * @property string $lfh_Comments Comments by Learner
 * @property string $lfh_submittedOn
 * @property string $lfh_SubmittedVia
 *
 * @property LearnerfdbkansdtlsTbl[] $learnerfdbkansdtlsTbls
 */
class LearnerfdbkhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learnerfdbkhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lfh_LearnerRegHrdDtls_FK', 'lfh_feedbackmst_fk', 'lfh_FdbbkStatus'], 'required'],
            [['lfh_LearnerRegHrdDtls_FK', 'lfh_feedbackmst_fk', 'lfh_FdbbkStatus'], 'integer'],
            [['lfh_Comments', 'lfh_SubmittedVia'], 'string'],
            [['lfh_submittedOn'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LearnerFdbkHdr_PK' => 'Learner Fdbk Hdr  Pk',
            'lfh_LearnerRegHrdDtls_FK' => 'Lfh  Learner Reg Hrd Dtls  Fk',
            'lfh_feedbackmst_fk' => 'Lfh Feedbackmst Fk',
            'lfh_FdbbkStatus' => 'Lfh  Fdbbk Status',
            'lfh_Comments' => 'Lfh  Comments',
            'lfh_submittedOn' => 'Lfh Submitted On',
            'lfh_SubmittedVia' => 'Lfh  Submitted Via',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerfdbkansdtlsTbls()
    {
        return $this->hasMany(LearnerfdbkansdtlsTbl::className(), ['lfdbkansd_learnerfdbkhdr_fk' => 'LearnerFdbkHdr_PK']);
    }

    /**
     * {@inheritdoc}
     * @return LearnerfdbkhdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LearnerfdbkhdrTblQuery(get_called_class());
    }
}
