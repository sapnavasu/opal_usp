<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchmgmthsty_tbl".
 *
 * @property int $batchmgmthsty_pk primary key
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
 * @property int $bmh_status 1-New, 2-Teaching(Theory),3-Teaching(practical), 4-Assessment, 5-Requested for Back Track, 6-Quality Check, 7-Cancelled, 8-Print,9-Requested for Assessor change
 * @property string $bmh_updatedon
 * @property int $bmh_updatedby Reference to  usermst_pk
 *
 * @property AppcoursedtlsmainTbl $bmhAppcoursedtlsmainFk
 * @property AppinstinfomainTbl $bmhAppinstinfomainFk
 * @property BatchmgmtdtlsTbl $bmhBatchmgmtdtlsFk
 * @property OpalmemberregmstTbl $bmhOpalmemberregmstFk
 * @property StandardcoursedtlsTbl $bmhStandardcoursedtlsFk
 */
class BatchmgmthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmh_batchmgmtdtls_fk', 'bmh_opalmemberregmst_fk', 'bmh_appinstinfomain_fk', 'bmh_appcoursedtlsmain_fk', 'bmh_standardcoursedtls_fk', 'bmh_Batchno', 'bmh_batchtype', 'bmh_traininglang', 'bmh_batchcount', 'bmh_status'], 'required'],
            [['bmh_batchmgmtdtls_fk', 'bmh_opalmemberregmst_fk', 'bmh_appinstinfomain_fk', 'bmh_appcoursedtlsmain_fk', 'bmh_standardcoursedtls_fk', 'bmh_batchtype', 'bmh_traininglang', 'bmh_batchcount', 'bmh_status', 'bmh_updatedby'], 'integer'],
            [['bmh_comment'], 'string'],
            [['bmh_updatedon'], 'safe'],
            [['bmh_Batchno'], 'string', 'max' => 100],
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
            'batchmgmthsty_pk' => 'Batchmgmthsty Pk',
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
            'bmh_updatedon' => 'Bmh Updatedon',
            'bmh_updatedby' => 'Bmh Updatedby',
        ];
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
     * {@inheritdoc}
     * @return BatchmgmthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmthstyTblQuery(get_called_class());
    }
}
