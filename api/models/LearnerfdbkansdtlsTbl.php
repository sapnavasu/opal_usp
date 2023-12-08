<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learnerfdbkansdtls_tbl".
 *
 * @property int $lfddbkansdtls_pk
 * @property int $lfdbkansd_learnerfdbkhdr_fk Reference to learnerfdbkhdr_pk
 * @property int $lfdbkansd_fdbkquestmst_fk Reference to fdbkquestmst_pk
 * @property int $lfdbkansd_agree 1-Selected,0-Not Selected, by default 0
 * @property int $lfdbkansd_disagree 1-Selected,0-Not Selected, by default 0
 * @property int $lfdbkansd_stronglyagree 1-Selected,0-Not Selected, by default 0
 *
 * @property FdbkquestmstTbl $lfdbkansdFdbkquestmstFk
 * @property LearnerfdbkhdrTbl $lfdbkansdLearnerfdbkhdrFk
 */
class LearnerfdbkansdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learnerfdbkansdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lfdbkansd_learnerfdbkhdr_fk', 'lfdbkansd_fdbkquestmst_fk', 'lfdbkansd_agree', 'lfdbkansd_disagree', 'lfdbkansd_stronglyagree'], 'required'],
            [['lfdbkansd_learnerfdbkhdr_fk', 'lfdbkansd_fdbkquestmst_fk', 'lfdbkansd_agree', 'lfdbkansd_disagree', 'lfdbkansd_stronglyagree'], 'integer'],
            [['lfdbkansd_fdbkquestmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FdbkquestmstTbl::className(), 'targetAttribute' => ['lfdbkansd_fdbkquestmst_fk' => 'FdbkQuestMst_PK']],
            [['lfdbkansd_learnerfdbkhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerfdbkhdrTbl::className(), 'targetAttribute' => ['lfdbkansd_learnerfdbkhdr_fk' => 'LearnerFdbkHdr_PK']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lfddbkansdtls_pk' => 'Lfddbkansdtls Pk',
            'lfdbkansd_learnerfdbkhdr_fk' => 'Lfdbkansd Learnerfdbkhdr Fk',
            'lfdbkansd_fdbkquestmst_fk' => 'Lfdbkansd Fdbkquestmst Fk',
            'lfdbkansd_agree' => 'Lfdbkansd Agree',
            'lfdbkansd_disagree' => 'Lfdbkansd Disagree',
            'lfdbkansd_stronglyagree' => 'Lfdbkansd Stronglyagree',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLfdbkansdFdbkquestmstFk()
    {
        return $this->hasOne(FdbkquestmstTbl::className(), ['FdbkQuestMst_PK' => 'lfdbkansd_fdbkquestmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLfdbkansdLearnerfdbkhdrFk()
    {
        return $this->hasOne(LearnerfdbkhdrTbl::className(), ['LearnerFdbkHdr_PK' => 'lfdbkansd_learnerfdbkhdr_fk']);
    }

    /**
     * {@inheritdoc}
     * @return LearnerfdbkansdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LearnerfdbkansdtlsTblQuery(get_called_class());
    }
}
