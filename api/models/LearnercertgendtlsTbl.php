<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learnercertgendtls_tbl".
 *
 * @property int $learnercertgendtls_pk
 * @property int $lcgd_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $lcgd_learnerreghrddtls_fk Reference to learnerreghrddtls_pk
 * @property int $lcgd_status 1=Active, 2-expired
 * @property string $lcgd_certgenon Date/time of certification generated on
 * @property int $lcgd_certgenby Reference to opalusermst_tbl
 * @property string $lcgd_certexpiry Whether the certificate expiry is to be updated or not can be decided based on standardcoursedtls_tbl -> scd_iscertexpiry, scd_iscertexpirybasedonmarks
 *
 * @property BatchmgmtdtlsTbl $lcgdBatchmgmtdtlsFk
 * @property LearnerreghrddtlsTbl $lcgdLearnerreghrddtlsFk
 * @property TrngattdntdtlsTbl[] $trngattdntdtlsTbls
 */
class LearnercertgendtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learnercertgendtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lcgd_batchmgmtdtls_fk', 'lcgd_learnerreghrddtls_fk', 'lcgd_status', 'lcgd_certgenon', 'lcgd_certgenby'], 'required'],
            [['lcgd_batchmgmtdtls_fk', 'lcgd_learnerreghrddtls_fk', 'lcgd_status', 'lcgd_certgenby'], 'integer'],
            [['lcgd_certgenon', 'lcgd_certexpiry'], 'safe'],
            [['lcgd_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['lcgd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['lcgd_learnerreghrddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerreghrddtlsTbl::className(), 'targetAttribute' => ['lcgd_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'learnercertgendtls_pk' => 'Learnercertgendtls Pk',
            'lcgd_batchmgmtdtls_fk' => 'Lcgd Batchmgmtdtls Fk',
            'lcgd_learnerreghrddtls_fk' => 'Lcgd Learnerreghrddtls Fk',
            'lcgd_status' => 'Lcgd Status',
            'lcgd_certgenon' => 'Lcgd Certgenon',
            'lcgd_certgenby' => 'Lcgd Certgenby',
            'lcgd_certexpiry' => 'Lcgd Certexpiry',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcgdBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'lcgd_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcgdLearnerreghrddtlsFk()
    {
        return $this->hasOne(LearnerreghrddtlsTbl::className(), ['learnerreghrddtls_pk' => 'lcgd_learnerreghrddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrngattdntdtlsTbls()
    {
        return $this->hasMany(TrngattdntdtlsTbl::className(), ['tad_learnercertgendtls_fk' => 'learnercertgendtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return LearnercertgendtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LearnercertgendtlsTblQuery(get_called_class());
    }
}
