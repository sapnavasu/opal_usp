<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchmgmtthyhdrhsty_tbl".
 *
 * @property int $batchmgmtthyhdrhsty_pk primary key
 * @property int $bmthh_batchmgmtthyhdr_fk Reference to batchmgmtthyhdr_pk
 * @property int $bmthh_batchmgmtdtlshsty_fk Reference to batchmgmtdtlshsty_pk
 * @property int $bmthh_batchcount Batch count for the Theory class on Training the learner
 * @property int $bmthh_tutor Reference to  opalusermst_pk
 * @property string $bmthh_startdate
 * @property string $bmthh_enddate
 * @property int $bmthh_status 1-Active, 2-Inactive, by default 1
 * @property string $bmthh_createdon
 * @property int $bmthh_createdby
 * @property string $bmthh_updatedon
 * @property int $bmthh_updatedby
 *
 * @property BatchmgmtdurationdtlshstyTbl[] $batchmgmtdurationdtlshstyTbls
 * @property BatchmgmtthydtlshstyTbl[] $batchmgmtthydtlshstyTbls
 * @property BatchmgmtdtlshstyTbl $bmthhBatchmgmtdtlshstyFk
 * @property BatchmgmtthyhdrTbl $bmthhBatchmgmtthyhdrFk
 * @property OpalusermstTbl $bmthhTutor
 * @property TrngattdntdtlshstyTbl[] $trngattdntdtlshstyTbls
 */
class BatchmgmtthyhdrhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtthyhdrhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmthh_batchmgmtthyhdr_fk', 'bmthh_batchmgmtdtlshsty_fk', 'bmthh_batchcount', 'bmthh_tutor', 'bmthh_startdate', 'bmthh_enddate', 'bmthh_createdby'], 'required'],
            [['bmthh_batchmgmtthyhdr_fk', 'bmthh_batchmgmtdtlshsty_fk', 'bmthh_batchcount', 'bmthh_tutor', 'bmthh_status', 'bmthh_createdby', 'bmthh_updatedby'], 'integer'],
            [['bmthh_startdate', 'bmthh_enddate', 'bmthh_createdon', 'bmthh_updatedon'], 'safe'],
            [['bmthh_batchmgmtdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlshstyTbl::className(), 'targetAttribute' => ['bmthh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']],
            [['bmthh_batchmgmtthyhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtthyhdrTbl::className(), 'targetAttribute' => ['bmthh_batchmgmtthyhdr_fk' => 'batchmgmtthyhdr_pk']],
            [['bmthh_tutor'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['bmthh_tutor' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtthyhdrhsty_pk' => 'Batchmgmtthyhdrhsty Pk',
            'bmthh_batchmgmtthyhdr_fk' => 'Bmthh Batchmgmtthyhdr Fk',
            'bmthh_batchmgmtdtlshsty_fk' => 'Bmthh Batchmgmtdtlshsty Fk',
            'bmthh_batchcount' => 'Bmthh Batchcount',
            'bmthh_tutor' => 'Bmthh Tutor',
            'bmthh_startdate' => 'Bmthh Startdate',
            'bmthh_enddate' => 'Bmthh Enddate',
            'bmthh_status' => 'Bmthh Status',
            'bmthh_createdon' => 'Bmthh Createdon',
            'bmthh_createdby' => 'Bmthh Createdby',
            'bmthh_updatedon' => 'Bmthh Updatedon',
            'bmthh_updatedby' => 'Bmthh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtdurationdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtdurationdtlshstyTbl::className(), ['bmddh_batchmgmtthyhdrhsty_fk' => 'batchmgmtthyhdrhsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtthydtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtthydtlshstyTbl::className(), ['bmtdh_batchmgmtthyhdrhsty_fk' => 'batchmgmtthyhdrhsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmthhBatchmgmtdtlshstyFk()
    {
        return $this->hasOne(BatchmgmtdtlshstyTbl::className(), ['batchmgmtdtlshsty_pk' => 'bmthh_batchmgmtdtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmthhBatchmgmtthyhdrFk()
    {
        return $this->hasOne(BatchmgmtthyhdrTbl::className(), ['batchmgmtthyhdr_pk' => 'bmthh_batchmgmtthyhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmthhTutor()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'bmthh_tutor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrngattdntdtlshstyTbls()
    {
        return $this->hasMany(TrngattdntdtlshstyTbl::className(), ['tadh_batchmgmtthyhdrhsty_fk' => 'batchmgmtthyhdrhsty_pk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtthyhdrhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtthyhdrhstyTblQuery(get_called_class());
    }
     
             
    public static function movetohistory($data,$historypk)
    {
         
        $model = new BatchmgmtthyhdrhstyTbl();
        $model->bmthh_batchmgmtthyhdr_fk = $data->batchmgmtthyhdr_pk;
        $model->bmthh_batchmgmtdtlshsty_fk = $historypk;
        $model->bmthh_batchcount = $data->bmth_batchcount;
        $model->bmthh_tutor = $data->bmth_tutor;
        $model->bmthh_startdate = $data->bmth_startdate;
        $model->bmthh_enddate = $data->bmth_enddate;
        $model->bmthh_status = $data->bmth_status;
        $model->bmthh_createdon = $data->bmth_createdon;
        $model->bmthh_createdby = $data->bmth_createdby;
        $model->bmthh_updatedon = $data->bmth_updatedon;
        $model->bmthh_updatedby = $data->bmth_updatedby;
        
        if($model->save())
        {
            return $model->batchmgmtthyhdrhsty_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
}
