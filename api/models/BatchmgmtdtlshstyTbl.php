<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchmgmtdtlshsty_tbl".
 *
 * @property int $batchmgmtdtlshsty_pk primary key
 * @property int $bmh_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $bmh_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $bmh_appinstinfomain_fk Reference to appinstinfomain_pk
 * @property int $bmh_appcoursedtlsmain_fk Reference to appcoursedtlsmain_pk
 * @property int $bmh_standardcoursedtls_fk Reference to standardcoursedtls_pk
 * @property string $bmh_Batchno
 * @property int $bmh_batchtype Reference to referencemst_pk where rm_mastertype=9
 * @property int $bmh_traininglang Reference to referencemst_pk where rm_mastertype=10
 * @property int $bmh_batchcount
 * @property string $bmh_comment Store Cancelled comments here, when a Batch is cancelled.
 * @property int $bmh_status 1-New, 2-Teaching(Theory),3-Teaching(practical), 4-Assessment, 6-Quality Check, 7-Cancelled, 8-Print,9- Assessor changed
 * @property string $bmd_createdon
 * @property string $bmd_createdby
 * @property string $bmh_updatedon
 * @property int $bmh_updatedby Reference to  usermst_pk
 *
 * @property BatchmgmtasmtdtlshstyTbl[] $batchmgmtasmtdtlshstyTbls
 * @property BatchmgmtasmthdrhstyTbl[] $batchmgmtasmthdrhstyTbls
 * @property AppcoursedtlsmainTbl $bmhAppcoursedtlsmainFk
 * @property AppinstinfomainTbl $bmhAppinstinfomainFk
 * @property BatchmgmtdtlsTbl $bmhBatchmgmtdtlsFk
 * @property OpalmemberregmstTbl $bmhOpalmemberregmstFk
 * @property StandardcoursedtlsTbl $bmhStandardcoursedtlsFk
 * @property BatchmgmtdurationdtlshstyTbl[] $batchmgmtdurationdtlshstyTbls
 * @property BatchmgmtpractdtlshstyTbl[] $batchmgmtpractdtlshstyTbls
 * @property BatchmgmtpracthdrhstyTbl[] $batchmgmtpracthdrhstyTbls
 * @property BatchmgmtthydtlshstyTbl[] $batchmgmtthydtlshstyTbls
 * @property BatchmgmtthyhdrhstyTbl[] $batchmgmtthyhdrhstyTbls
 * @property LearnerasmthdrhstyTbl[] $learnerasmthdrhstyTbls
 * @property TrngattdntdtlshstyTbl[] $trngattdntdtlshstyTbls
 */
class BatchmgmtdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmh_batchmgmtdtls_fk', 'bmh_opalmemberregmst_fk', 'bmh_appinstinfomain_fk', 'bmh_appcoursedtlsmain_fk', 'bmh_standardcoursedtls_fk', 'bmh_Batchno', 'bmh_batchtype', 'bmh_traininglang', 'bmh_batchcount', 'bmh_status', 'bmd_createdon', 'bmd_createdby'], 'required'],
            [['bmh_batchmgmtdtls_fk', 'bmh_opalmemberregmst_fk', 'bmh_appinstinfomain_fk', 'bmh_appcoursedtlsmain_fk', 'bmh_standardcoursedtls_fk', 'bmh_batchtype', 'bmh_traininglang', 'bmh_batchcount', 'bmh_status', 'bmh_updatedby'], 'integer'],
            [['bmh_comment'], 'string'],
            [['bmd_createdon', 'bmh_updatedon'], 'safe'],
            [['bmh_Batchno'], 'string', 'max' => 100],
            [['bmd_createdby'], 'string', 'max' => 45],
            [['bmh_appcoursedtlsmain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursedtlsmainTbl::className(), 'targetAttribute' => ['bmh_appcoursedtlsmain_fk' => 'AppCourseDtlsMain_PK']],
            [['bmh_appinstinfomain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfomainTbl::className(), 'targetAttribute' => ['bmh_appinstinfomain_fk' => 'appinstinfomain_pk']],
            [['bmh_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['bmh_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['bmh_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['bmh_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['bmh_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['bmh_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtdtlshsty_pk' => 'Batchmgmtdtlshsty Pk',
            'bmh_batchmgmtdtls_fk' => 'Bmh Batchmgmtdtls Fk',
            'bmh_opalmemberregmst_fk' => 'Bmh Opalmemberregmst Fk',
            'bmh_appinstinfomain_fk' => 'Bmh Appinstinfomain Fk',
            'bmh_appcoursedtlsmain_fk' => 'Bmh Appcoursedtlsmain Fk',
            'bmh_standardcoursedtls_fk' => 'Bmh Standardcoursedtls Fk',
            'bmh_Batchno' => 'Bmh  Batchno',
            'bmh_batchtype' => 'Bmh Batchtype',
            'bmh_traininglang' => 'Bmh Traininglang',
            'bmh_batchcount' => 'Bmh Batchcount',
            'bmh_comment' => 'Bmh Comment',
            'bmh_status' => 'Bmh Status',
            'bmd_createdon' => 'Bmd Createdon',
            'bmd_createdby' => 'Bmd Createdby',
            'bmh_updatedon' => 'Bmh Updatedon',
            'bmh_updatedby' => 'Bmh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtasmtdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtasmtdtlshstyTbl::className(), ['bmadh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtasmthdrhstyTbls()
    {
        return $this->hasMany(BatchmgmtasmthdrhstyTbl::className(), ['bmahh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmhAppcoursedtlsmainFk()
    {
        return $this->hasOne(AppcoursedtlsmainTbl::className(), ['AppCourseDtlsMain_PK' => 'bmh_appcoursedtlsmain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmhAppinstinfomainFk()
    {
        return $this->hasOne(AppinstinfomainTbl::className(), ['appinstinfomain_pk' => 'bmh_appinstinfomain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmhBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'bmh_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmhOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'bmh_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmhStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'bmh_standardcoursedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtdurationdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtdurationdtlshstyTbl::className(), ['bmddh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtpractdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtpractdtlshstyTbl::className(), ['bmpdh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtpracthdrhstyTbls()
    {
        return $this->hasMany(BatchmgmtpracthdrhstyTbl::className(), ['bmphh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtthydtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtthydtlshstyTbl::className(), ['bmtdh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtthyhdrhstyTbls()
    {
        return $this->hasMany(BatchmgmtthyhdrhstyTbl::className(), ['bmthh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerasmthdrhstyTbls()
    {
        return $this->hasMany(LearnerasmthdrhstyTbl::className(), ['lasmthh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrngattdntdtlshstyTbls()
    {
        return $this->hasMany(TrngattdntdtlshstyTbl::className(), ['tadh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtdtlshstyTblQuery(get_called_class());
    }
    
     public static function movetohistory($data){
        
        $model = new BatchmgmtdtlshstyTbl();
        $model->bmh_batchmgmtdtls_fk = $data->batchmgmtdtls_pk;
        $model->bmh_opalmemberregmst_fk = $data->bmd_opalmemberregmst_fk;
        $model->bmh_appinstinfomain_fk = $data->bmd_appinstinfomain_fk;
        $model->bmh_appcoursedtlsmain_fk = $data->bmd_appcoursedtlsmain_fk;
        $model->bmh_standardcoursedtls_fk = $data->bmd_standardcoursedtls_fk;
        $model->bmh_Batchno = $data->bmd_Batchno;
        $model->bmh_batchtype = $data->bmd_batchtype;
        $model->bmh_traininglang = $data->bmd_traininglang;
        $model->bmh_batchcount = $data->bmd_batchcount;
        $model->bmh_comment = $data->bmd_comment;
        $model->bmh_status = $data->bmd_status;
        $model->bmh_updatedon = $data->bmd_updatedon;
        $model->bmh_updatedby = $data->bmd_updatedby;
        $model->bmd_createdon = $data->bmd_createdon;
        $model->bmd_createdby = (string)$data->bmd_createdby;
        if( $model->save())
        {
            return $model->batchmgmtdtlshsty_pk;
            
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
       
    }
}
