<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchmgmtasmthdrhsty_tbl".
 *
 * @property int $batchmgmtasmthdrhsty_pk primary key
 * @property int $bmahh_batchmgmtasmthdr_fk Reference to batchmgmtasmthdr_pk
 * @property int $bmahh_batchmgmtdtlshsty_fk Reference to batchmgmtdtlshsty_pk
 * @property int $bmahh_batchcount Batch count to do assessment
 * @property int $bmahh_assessor Reference to  opalusermst_pk
 * @property int $bmahh_ivqastaff Reference to  opalusermst_pk
 * @property string $bmahh_assessmentdate
 * @property string $bmahh_assessstarttime
 * @property string $bmahh_assessendtime
 * @property int $bmahh_reqstatus 1 - Requested for Assessor Change, 2 - Assessor Changed
 * @property int $bmahh_status 1-Active, 2-Inactive, by default 1
 * @property string $bmahh_createdon
 * @property int $bmahh_createdby
 * @property string $bmahh_updatedon
 * @property int $bmahh_updatedby
 *
 * @property BatchmgmtasmtdtlshstyTbl[] $batchmgmtasmtdtlshstyTbls
 * @property OpalusermstTbl $bmahhAssessor
 * @property BatchmgmtasmthdrTbl $bmahhBatchmgmtasmthdrFk
 * @property BatchmgmtdtlshstyTbl $bmahhBatchmgmtdtlshstyFk
 * @property OpalusermstTbl $bmahhIvqastaff
 */
class BatchmgmtasmthdrhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtasmthdrhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmahh_batchmgmtasmthdr_fk', 'bmahh_batchmgmtdtlshsty_fk', 'bmahh_batchcount', 'bmahh_assessor', 'bmahh_ivqastaff', 'bmahh_assessmentdate', 'bmahh_assessstarttime', 'bmahh_assessendtime', 'bmahh_createdby'], 'required'],
            [['bmahh_batchmgmtasmthdr_fk', 'bmahh_batchmgmtdtlshsty_fk', 'bmahh_batchcount', 'bmahh_assessor', 'bmahh_ivqastaff', 'bmahh_reqstatus', 'bmahh_status', 'bmahh_createdby', 'bmahh_updatedby'], 'integer'],
            [['bmahh_assessmentdate', 'bmahh_assessstarttime', 'bmahh_assessendtime', 'bmahh_createdon', 'bmahh_updatedon'], 'safe'],
            [['bmahh_assessor'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['bmahh_assessor' => 'opalusermst_pk']],
            [['bmahh_batchmgmtasmthdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtasmthdrTbl::className(), 'targetAttribute' => ['bmahh_batchmgmtasmthdr_fk' => 'batchmgmtasmthdr_pk']],
            [['bmahh_batchmgmtdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlshstyTbl::className(), 'targetAttribute' => ['bmahh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']],
            [['bmahh_ivqastaff'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['bmahh_ivqastaff' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtasmthdrhsty_pk' => 'Batchmgmtasmthdrhsty Pk',
            'bmahh_batchmgmtasmthdr_fk' => 'Bmahh Batchmgmtasmthdr Fk',
            'bmahh_batchmgmtdtlshsty_fk' => 'Bmahh Batchmgmtdtlshsty Fk',
            'bmahh_batchcount' => 'Bmahh Batchcount',
            'bmahh_assessor' => 'Bmahh Assessor',
            'bmahh_ivqastaff' => 'Bmahh Ivqastaff',
            'bmahh_assessmentdate' => 'Bmahh Assessmentdate',
            'bmahh_assessstarttime' => 'Bmahh Assessstarttime',
            'bmahh_assessendtime' => 'Bmahh Assessendtime',
            'bmahh_reqstatus' => 'Bmahh Reqstatus',
            'bmahh_status' => 'Bmahh Status',
            'bmahh_createdon' => 'Bmahh Createdon',
            'bmahh_createdby' => 'Bmahh Createdby',
            'bmahh_updatedon' => 'Bmahh Updatedon',
            'bmahh_updatedby' => 'Bmahh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtasmtdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtasmtdtlshstyTbl::className(), ['bmadh_batchmgmtasmthdrhsty_fk' => 'batchmgmtasmthdrhsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmahhAssessor()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'bmahh_assessor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmahhBatchmgmtasmthdrFk()
    {
        return $this->hasOne(BatchmgmtasmthdrTbl::className(), ['batchmgmtasmthdr_pk' => 'bmahh_batchmgmtasmthdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmahhBatchmgmtdtlshstyFk()
    {
        return $this->hasOne(BatchmgmtdtlshstyTbl::className(), ['batchmgmtdtlshsty_pk' => 'bmahh_batchmgmtdtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmahhIvqastaff()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'bmahh_ivqastaff']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtasmthdrhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtasmthdrhstyTblQuery(get_called_class());
    }
    
     public static function movetohistory($data,$history)
    {
        $model = new BatchmgmtasmthdrhstyTbl();
        $model->bmahh_batchmgmtasmthdr_fk = $data->batchmgmtasmthdr_pk;
        $model->bmahh_batchmgmtdtlshsty_fk = $history;
        $model->bmahh_batchcount = $data->bmah_batchcount;
        $model->bmahh_assessor = $data->bmah_assessor;
        $model->bmahh_ivqastaff = $data->bmah_ivqastaff;
        $model->bmahh_assessmentdate = $data->bmah_assessmentdate;
        $model->bmahh_assessstarttime = $data->bmah_assessstarttime;
        $model->bmahh_assessendtime = $data->bmah_assessendtime;
        $model->bmahh_reqstatus = $data->bmah_reqstatus;
        $model->bmahh_status = $data->bmah_status;
        $model->bmahh_createdon = $data->bmah_createdon;
        $model->bmahh_createdby = $data->bmah_createdby;
        $model->bmahh_updatedon = $data->bmah_updatedon;
        $model->bmahh_updatedby = $data->bmah_updatedby;
        
        if($model->save())
        {
            return $model->batchmgmtasmthdrhsty_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
}
