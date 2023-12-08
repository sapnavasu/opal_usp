<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchmgmtthydtls_tbl".
 *
 * @property int $batchmgmtthydtls_pk primary key
 * @property int $bmtd_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $bmtd_batchmgmtthyhdr_fk Reference to batchmgmtthyhdr_pk
 * @property int $bmtd_learnerreghrddtls_fk Reference to learnerreghrddtls_pk
 * @property int $bmtd_status 1-Active, 2-Inactive, by default 1
 * @property string $bmtd_createdon
 * @property int $bmtd_createdby
 * @property string $bmtd_updatedon
 * @property int $bmtd_updatedby
 *
 * @property BatchmgmtdtlsTbl $bmtdBatchmgmtdtlsFk
 * @property BatchmgmtthyhdrTbl $bmtdBatchmgmtthyhdrFk
 * @property LearnerreghrddtlsTbl $bmtdLearnerreghrddtlsFk
 */
class BatchmgmtthydtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtthydtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmtd_batchmgmtdtls_fk', 'bmtd_batchmgmtthyhdr_fk', 'bmtd_learnerreghrddtls_fk', 'bmtd_createdby'], 'required'],
            [['bmtd_batchmgmtdtls_fk', 'bmtd_batchmgmtthyhdr_fk', 'bmtd_learnerreghrddtls_fk', 'bmtd_status', 'bmtd_createdby', 'bmtd_updatedby'], 'integer'],
            [['bmtd_createdon', 'bmtd_updatedon'], 'safe'],
            [['bmtd_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['bmtd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['bmtd_batchmgmtthyhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtthyhdrTbl::className(), 'targetAttribute' => ['bmtd_batchmgmtthyhdr_fk' => 'batchmgmtthyhdr_pk']],
            [['bmtd_learnerreghrddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerreghrddtlsTbl::className(), 'targetAttribute' => ['bmtd_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtthydtls_pk' => 'primary key',
            'bmtd_batchmgmtdtls_fk' => 'Reference to batchmgmtdtls_pk',
            'bmtd_batchmgmtthyhdr_fk' => 'Reference to batchmgmtthyhdr_pk',
            'bmtd_learnerreghrddtls_fk' => 'Reference to learnerreghrddtls_pk',
            'bmtd_status' => '1-Active, 2-Inactive, by default 1',
            'bmtd_createdon' => 'Bmtd Createdon',
            'bmtd_createdby' => 'Bmtd Createdby',
            'bmtd_updatedon' => 'Bmtd Updatedon',
            'bmtd_updatedby' => 'Bmtd Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmtdBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'bmtd_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmtdBatchmgmtthyhdrFk()
    {
        return $this->hasOne(BatchmgmtthyhdrTbl::className(), ['batchmgmtthyhdr_pk' => 'bmtd_batchmgmtthyhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmtdLearnerreghrddtlsFk()
    {
        return $this->hasOne(LearnerreghrddtlsTbl::className(), ['learnerreghrddtls_pk' => 'bmtd_learnerreghrddtls_fk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtthydtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtthydtlsTblQuery(get_called_class());
    }
    
  
}
