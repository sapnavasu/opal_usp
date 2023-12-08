<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchmgmtasmtdtls_tbl".
 *
 * @property int $batchmgmtasmtdtls_pk primary key
 * @property int $bmad_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $bmad_batchmgmtasmthdr_fk Reference to batchmgmtasmthdr_pk
 * @property int $bmad_learnerreghrddtls_fk Reference to learnerreghrddtls_pk
 * @property int $bmad_staffinforepo_fk Reference to  usermst_pk
 * @property int $bmad_status 1-Active, 2-Inactive, by default 1
 * @property string $bmad_createdon
 * @property int $bmad_createdby
 * @property string $bmad_updatedon
 * @property int $bmad_updatedby
 *
 * @property BatchmgmtasmthdrTbl $bmadBatchmgmtasmthdrFk
 * @property BatchmgmtdtlsTbl $bmadBatchmgmtdtlsFk
 * @property LearnerreghrddtlsTbl $bmadLearnerreghrddtlsFk
 * @property StaffinforepoTbl $bmadStaffinforepoFk
 */
class BatchmgmtasmtdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtasmtdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmad_batchmgmtdtls_fk', 'bmad_batchmgmtasmthdr_fk', 'bmad_learnerreghrddtls_fk', 'bmad_staffinforepo_fk', 'bmad_createdby'], 'required'],
            [['bmad_batchmgmtdtls_fk', 'bmad_batchmgmtasmthdr_fk', 'bmad_learnerreghrddtls_fk', 'bmad_staffinforepo_fk', 'bmad_status', 'bmad_createdby', 'bmad_updatedby'], 'integer'],
            [['bmad_createdon', 'bmad_updatedon'], 'safe'],
            [['bmad_batchmgmtasmthdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtasmthdrTbl::className(), 'targetAttribute' => ['bmad_batchmgmtasmthdr_fk' => 'batchmgmtasmthdr_pk']],
            [['bmad_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['bmad_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['bmad_learnerreghrddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerreghrddtlsTbl::className(), 'targetAttribute' => ['bmad_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']],
            [['bmad_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['bmad_staffinforepo_fk' => 'staffinforepo_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtasmtdtls_pk' => 'primary key',
            'bmad_batchmgmtdtls_fk' => 'Reference to batchmgmtdtls_pk',
            'bmad_batchmgmtasmthdr_fk' => 'Reference to batchmgmtasmthdr_pk',
            'bmad_learnerreghrddtls_fk' => 'Reference to learnerreghrddtls_pk',
            'bmad_staffinforepo_fk' => 'Reference to  usermst_pk',
            'bmad_status' => '1-Active, 2-Inactive, by default 1',
            'bmad_createdon' => 'Bmad Createdon',
            'bmad_createdby' => 'Bmad Createdby',
            'bmad_updatedon' => 'Bmad Updatedon',
            'bmad_updatedby' => 'Bmad Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmadBatchmgmtasmthdrFk()
    {
        return $this->hasOne(BatchmgmtasmthdrTbl::className(), ['batchmgmtasmthdr_pk' => 'bmad_batchmgmtasmthdr_fk']);
    }

    public function getBatchDetails(){
         return BatchmgmtasmtdtlsTbl::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmadBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'bmad_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmadLearnerreghrddtlsFk()
    {
        return $this->hasOne(LearnerreghrddtlsTbl::className(), ['learnerreghrddtls_pk' => 'bmad_learnerreghrddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmadStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'bmad_staffinforepo_fk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtasmtdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtasmtdtlsTblQuery(get_called_class());
    }
}
