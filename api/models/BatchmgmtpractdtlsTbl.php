<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchmgmtpractdtls_tbl".
 *
 * @property int $batchmgmtpractdtls_pk primary key
 * @property int $bmpd_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $bmpd_batchmgmtpracthdr_fk Reference to batchmgmtpracthdr_pk
 * @property int $bmpd_learnerreghrddtls_fk Reference to learnerreghrddtls_pk
 * @property int $bmpd_status 1-Active, 2-Inactive, by default 1
 * @property string $bmpd_createdon
 * @property int $bmpd_createdby
 * @property string $bmpd_updatedon
 * @property int $bmcd_updatedby
 *
 * @property BatchmgmtdtlsTbl $bmpdBatchmgmtdtlsFk
 * @property BatchmgmtpracthdrTbl $bmpdBatchmgmtpracthdrFk
 * @property LearnerreghrddtlsTbl $bmpdLearnerreghrddtlsFk
 */
class BatchmgmtpractdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtpractdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmpd_batchmgmtdtls_fk', 'bmpd_batchmgmtpracthdr_fk', 'bmpd_learnerreghrddtls_fk', 'bmpd_createdby'], 'required'],
            [['bmpd_batchmgmtdtls_fk', 'bmpd_batchmgmtpracthdr_fk', 'bmpd_learnerreghrddtls_fk', 'bmpd_status', 'bmpd_createdby', 'bmcd_updatedby'], 'integer'],
            [['bmpd_createdon', 'bmpd_updatedon'], 'safe'],
            [['bmpd_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['bmpd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['bmpd_batchmgmtpracthdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtpracthdrTbl::className(), 'targetAttribute' => ['bmpd_batchmgmtpracthdr_fk' => 'batchmgmtpracthdr_pk']],
            [['bmpd_learnerreghrddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerreghrddtlsTbl::className(), 'targetAttribute' => ['bmpd_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtpractdtls_pk' => 'primary key',
            'bmpd_batchmgmtdtls_fk' => 'Reference to batchmgmtdtls_pk',
            'bmpd_batchmgmtpracthdr_fk' => 'Reference to batchmgmtpracthdr_pk',
            'bmpd_learnerreghrddtls_fk' => 'Reference to learnerreghrddtls_pk',
            'bmpd_status' => '1-Active, 2-Inactive, by default 1',
            'bmpd_createdon' => 'Bmpd Createdon',
            'bmpd_createdby' => 'Bmpd Createdby',
            'bmpd_updatedon' => 'Bmpd Updatedon',
            'bmcd_updatedby' => 'Bmcd Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmpdBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'bmpd_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmpdBatchmgmtpracthdrFk()
    {
        return $this->hasOne(BatchmgmtpracthdrTbl::className(), ['batchmgmtpracthdr_pk' => 'bmpd_batchmgmtpracthdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmpdLearnerreghrddtlsFk()
    {
        return $this->hasOne(LearnerreghrddtlsTbl::className(), ['learnerreghrddtls_pk' => 'bmpd_learnerreghrddtls_fk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtpractdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtpractdtlsTblQuery(get_called_class());
    }
}
