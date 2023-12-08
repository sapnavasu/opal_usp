<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchmgmtpracthdrhsty_tbl".
 *
 * @property int $batchmgmtpracthdrhsty_pk primary key
 * @property int $bmphh_batchmgmtpracthdr_fk Reference to batchmgmtpracthdr_pk
 * @property int $bmphh_batchmgmtdtlshsty_fk Reference to batchmgmtdtlshsty_pk
 * @property int $bmphh_batchcount Batch count for the Practical class on Training the learner
 * @property int $bmphh_tutor Reference to  opalusermst_pk
 * @property string $bmphh_startdate
 * @property string $bmphh_enddate
 * @property int $bmphh_status 1-Active, 2-Inactive, by default 1
 * @property string $bmphh_createdon
 * @property int $bmphh_createdby
 * @property string $bmphh_updatedon
 * @property int $bmphh_updatedby
 *
 * @property BatchmgmtdurationdtlshstyTbl[] $batchmgmtdurationdtlshstyTbls
 * @property BatchmgmtpractdtlshstyTbl[] $batchmgmtpractdtlshstyTbls
 * @property BatchmgmtdtlshstyTbl $bmphhBatchmgmtdtlshstyFk
 * @property BatchmgmtpracthdrTbl $bmphhBatchmgmtpracthdrFk
 * @property OpalusermstTbl $bmphhTutor
 * @property TrngattdntdtlshstyTbl[] $trngattdntdtlshstyTbls
 */
class BatchmgmtpracthdrhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtpracthdrhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmphh_batchmgmtpracthdr_fk', 'bmphh_batchmgmtdtlshsty_fk', 'bmphh_batchcount', 'bmphh_tutor', 'bmphh_startdate', 'bmphh_enddate', 'bmphh_createdby'], 'required'],
            [['bmphh_batchmgmtpracthdr_fk', 'bmphh_batchmgmtdtlshsty_fk', 'bmphh_batchcount', 'bmphh_tutor', 'bmphh_status', 'bmphh_createdby', 'bmphh_updatedby'], 'integer'],
            [['bmphh_startdate', 'bmphh_enddate', 'bmphh_createdon', 'bmphh_updatedon'], 'safe'],
            [['bmphh_batchmgmtdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlshstyTbl::className(), 'targetAttribute' => ['bmphh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']],
            [['bmphh_batchmgmtpracthdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtpracthdrTbl::className(), 'targetAttribute' => ['bmphh_batchmgmtpracthdr_fk' => 'batchmgmtpracthdr_pk']],
            [['bmphh_tutor'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['bmphh_tutor' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtpracthdrhsty_pk' => 'Batchmgmtpracthdrhsty Pk',
            'bmphh_batchmgmtpracthdr_fk' => 'Bmphh Batchmgmtpracthdr Fk',
            'bmphh_batchmgmtdtlshsty_fk' => 'Bmphh Batchmgmtdtlshsty Fk',
            'bmphh_batchcount' => 'Bmphh Batchcount',
            'bmphh_tutor' => 'Bmphh Tutor',
            'bmphh_startdate' => 'Bmphh Startdate',
            'bmphh_enddate' => 'Bmphh Enddate',
            'bmphh_status' => 'Bmphh Status',
            'bmphh_createdon' => 'Bmphh Createdon',
            'bmphh_createdby' => 'Bmphh Createdby',
            'bmphh_updatedon' => 'Bmphh Updatedon',
            'bmphh_updatedby' => 'Bmphh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtdurationdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtdurationdtlshstyTbl::className(), ['bmddh_batchmgmtpracthdrhsty_fk' => 'batchmgmtpracthdrhsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtpractdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtpractdtlshstyTbl::className(), ['bmpdh_batchmgmtpracthdrhsty_fk' => 'batchmgmtpracthdrhsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmphhBatchmgmtdtlshstyFk()
    {
        return $this->hasOne(BatchmgmtdtlshstyTbl::className(), ['batchmgmtdtlshsty_pk' => 'bmphh_batchmgmtdtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmphhBatchmgmtpracthdrFk()
    {
        return $this->hasOne(BatchmgmtpracthdrTbl::className(), ['batchmgmtpracthdr_pk' => 'bmphh_batchmgmtpracthdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmphhTutor()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'bmphh_tutor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrngattdntdtlshstyTbls()
    {
        return $this->hasMany(TrngattdntdtlshstyTbl::className(), ['tadh_batchmgmtpracthdrhsty_fk' => 'batchmgmtpracthdrhsty_pk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtpracthdrhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtpracthdrhstyTblQuery(get_called_class());
    }
    
    public static function movetohistory($data,$historypk)
    {
        
        $model = new BatchmgmtpracthdrhstyTbl();
        $model->bmphh_batchmgmtpracthdr_fk = $data->batchmgmtpracthdr_pk;
        $model->bmphh_batchmgmtdtlshsty_fk = $historypk;
        $model->bmphh_batchcount = $data->bmph_batchcount;
        $model->bmphh_tutor = $data->bmph_tutor;
        $model->bmphh_startdate = $data->bmph_startdate;
        $model->bmphh_enddate = $data->bmph_enddate;
        $model->bmphh_status = $data->bmph_status;
        $model->bmphh_createdon = $data->bmph_createdon;
        $model->bmphh_createdby = $data->bmph_createdby;
        $model->bmphh_updatedon = $data->bmph_updatedon;
        $model->bmphh_updatedby = $data->bmph_updatedby;
        
       
        if($model->save())
        {
            return $model->batchmgmtpracthdrhsty_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
}
