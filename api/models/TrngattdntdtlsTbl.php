<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trngattdntdtls_tbl".
 *
 * @property int $trngattdntdtls_pk primary key
 * @property int $tad_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $tad_batchmgmtthyhdr_fk Reference to batchmgmtthyhdr_pk
 * @property int $tad_batchmgmtpracthdr_fk Reference to batchmgmtpracthdr_pk
 * @property int $tad_learnerreghrddtls_fk Reference to learnerreghrddtls_pk
 * @property int $tad_usermst_fk Reference to usermst_pk, who took the attendance for the learner
 * @property int $tad_batchmgmtdurationdtls_fk Reference to batchmgmtdurationdtls_pk
 * @property string $tad_trngdate
 * @property int $tad_attended 1-Yes attended, 2-Not attended (No show)
 *
 * @property BatchmgmtdtlsTbl $tadBatchmgmtdtlsFk
 * @property BatchmgmtdurationdtlsTbl $tadBatchmgmtdurationdtlsFk
 * @property BatchmgmtpracthdrTbl $tadBatchmgmtpracthdrFk
 * @property BatchmgmtthyhdrTbl $tadBatchmgmtthyhdrFk
 * @property LearnerreghrddtlsTbl $tadLearnerreghrddtlsFk
 * @property OpalusermstTbl $tadUsermstFk
 */
class TrngattdntdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trngattdntdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tad_batchmgmtdtls_fk', 'tad_learnerreghrddtls_fk', 'tad_usermst_fk', 'tad_trngdate', 'tad_attended'], 'required'],
            [['tad_batchmgmtdtls_fk', 'tad_batchmgmtthyhdr_fk', 'tad_batchmgmtpracthdr_fk', 'tad_learnerreghrddtls_fk', 'tad_usermst_fk', 'tad_batchmgmtdurationdtls_fk', 'tad_attended'], 'integer'],
            [['tad_trngdate'], 'safe'],
            [['tad_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['tad_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['tad_batchmgmtdurationdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdurationdtlsTbl::className(), 'targetAttribute' => ['tad_batchmgmtdurationdtls_fk' => 'batchmgmtdurationdtls_pk']],
            [['tad_batchmgmtpracthdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtpracthdrTbl::className(), 'targetAttribute' => ['tad_batchmgmtpracthdr_fk' => 'batchmgmtpracthdr_pk']],
            [['tad_batchmgmtthyhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtthyhdrTbl::className(), 'targetAttribute' => ['tad_batchmgmtthyhdr_fk' => 'batchmgmtthyhdr_pk']],
            [['tad_learnerreghrddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerreghrddtlsTbl::className(), 'targetAttribute' => ['tad_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']],
            [['tad_usermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['tad_usermst_fk' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'trngattdntdtls_pk' => 'primary key',
            'tad_batchmgmtdtls_fk' => 'Reference to batchmgmtdtls_pk',
            'tad_batchmgmtthyhdr_fk' => 'Reference to batchmgmtthyhdr_pk',
            'tad_batchmgmtpracthdr_fk' => 'Reference to batchmgmtpracthdr_pk',
            'tad_learnerreghrddtls_fk' => 'Reference to learnerreghrddtls_pk',
            'tad_usermst_fk' => 'Reference to usermst_pk, who took the attendance for the learner',
            'tad_batchmgmtdurationdtls_fk' => 'Reference to batchmgmtdurationdtls_pk',
            'tad_trngdate' => 'Tad Trngdate',
            'tad_attended' => '1-Yes attended, 2-Not attended (No show)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTadBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'tad_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTadBatchmgmtdurationdtlsFk()
    {
        return $this->hasOne(BatchmgmtdurationdtlsTbl::className(), ['batchmgmtdurationdtls_pk' => 'tad_batchmgmtdurationdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTadBatchmgmtpracthdrFk()
    {
        return $this->hasOne(BatchmgmtpracthdrTbl::className(), ['batchmgmtpracthdr_pk' => 'tad_batchmgmtpracthdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTadBatchmgmtthyhdrFk()
    {
        return $this->hasOne(BatchmgmtthyhdrTbl::className(), ['batchmgmtthyhdr_pk' => 'tad_batchmgmtthyhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTadLearnerreghrddtlsFk()
    {
        return $this->hasOne(LearnerreghrddtlsTbl::className(), ['learnerreghrddtls_pk' => 'tad_learnerreghrddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTadUsermstFk()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'tad_usermst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return TrngattdntdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TrngattdntdtlsTblQuery(get_called_class());
    }

    public function saveLearnerAttendance($requestData)
    {
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $learner_update = \app\models\LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk' => $requestData->tad_learnerreghrddtls_fk])->one();

        $model = new TrngattdntdtlsTbl();
        $model->tad_attended = $requestData->tad_attended;
        $model->tad_trngdate =  date("Y-m-d");
        $model->tad_learnerreghrddtls_fk = $requestData->tad_learnerreghrddtls_fk;
        $model->tad_batchmgmtthyhdr_fk = $learner_update->lrhd_status == 2 || $learner_update->lrhd_status == 4 ? $requestData->tad_batchmgmtthyhdr_fk : null;
        $model->tad_batchmgmtpracthdr_fk = $learner_update->lrhd_status == 3 || $learner_update->lrhd_status == 5 ? $requestData->tad_batchmgmtpracthdr_fk : null;
        $model->tad_batchmgmtdtls_fk = $requestData->tad_batchmgmtdtls_fk;
        $model->tad_batchmgmtdurationdtls_fk = $requestData->tad_batchmgmtdurationdtls_fk;
        $model->tad_usermst_fk = $userPk;

        if ($model->save()) {
            if($requestData->tad_attended == 1){
                $learner_update->lrhd_status = $model->tad_batchmgmtthyhdr_fk ? 2 : 3;
            }else{
                $learner_update->lrhd_status = $model->tad_batchmgmtthyhdr_fk ? 4 : 5;
            }
            $learner_update->lrhd_updatedon = date('Y-m-d H:i:s');
            $learner_update->lrhd_updatedby = $userPk;
            if($learner_update->save()) {
                return $learner_update;
            }else{
                echo "<pre>";
                print_r($learner_update->getErrors());
                die;
            }
        }
        else
        {
            var_dump($model->getErrors());
        }
    

        
    }
}
