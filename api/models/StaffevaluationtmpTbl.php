<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffevaluationtmp_tbl".
 *
 * @property int $staffevaluationtmp_pk primary kry
 * @property int $set_appstaffinfotmp_fk Reference to appstaffinfotmp_pk
 * @property int $set_staffinforepo_fk Reference to staffinforepo_pk
 * @property int $set_asmttype 1-Knowledge Assessment, 2-Practical Assessment
 * @property int $set_asmtmode 1-Offline ,2-Online by default 1
 * @property int $set_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $set_standardcoursedtls_fk Reference to standardcoursedtls_pk
 * @property int $set_rascategorymst_fk Reference to rascategorymst_pk
 * @property int $set_asmtstatus 1-Applicable, 2-Not Applicable,3-Competent, 4-Not Yet Competent, 5-Not Applicable (Knowledge Assessment alone)
 * @property int $set_asmtupload Reference to memcompfiledtls_pk where filemst_fk =5 for knowledge and 6 for practical, NOT NULL when sked_asmtmode= 1 
 * @property string $set_marksecured mark secured  in assessment
 * @property string $set_percentage
 * @property string $set_staffevanfee
 * @property int $set_apppytminvoicedtls_fk Reference to apppytminvoicedtls_tbl
 * @property string $set_createdon
 * @property int $set_createdby
 * @property string $set_updatedon
 * @property int $set_updatedby
 *
 * @property StaffevaluationhstyTbl[] $staffevaluationhstyTbls
 * @property StaffevaluationmainTbl[] $staffevaluationmainTbls
 * @property ApppytminvoicedtlsTbl $setApppytminvoicedtlsFk
 * @property AppstaffinfotmpTbl $setAppstaffinfotmpFk
 * @property RascategorymstTbl $setRascategorymstFk
 * @property StaffinforepoTbl $setStaffinforepoFk
 * @property StandardcoursedtlsTbl $setStandardcoursedtlsFk
 * @property StandardcoursemstTbl $setStandardcoursemstFk
 */
class StaffevaluationtmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffevaluationtmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['set_appstaffinfotmp_fk', 'set_staffinforepo_fk', 'set_asmttype', 'set_asmtstatus', 'set_createdby'], 'required'],
            [['set_appstaffinfotmp_fk', 'set_staffinforepo_fk', 'set_asmttype', 'set_asmtmode', 'set_standardcoursemst_fk', 'set_standardcoursedtls_fk', 'set_rascategorymst_fk', 'set_asmtstatus', 'set_asmtupload', 'set_apppytminvoicedtls_fk', 'set_createdby', 'set_updatedby'], 'integer'],
            [['set_marksecured', 'set_percentage', 'set_staffevanfee'], 'number'],
            [['set_createdon', 'set_updatedon'], 'safe'],
            [['set_apppytminvoicedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApppytminvoicedtlsTbl::className(), 'targetAttribute' => ['set_apppytminvoicedtls_fk' => 'apppytminvoicedtls_pk']],
            [['set_appstaffinfotmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppstaffinfotmpTbl::className(), 'targetAttribute' => ['set_appstaffinfotmp_fk' => 'appostaffinfotmp_pk']],
            [['set_rascategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['set_rascategorymst_fk' => 'rascategorymst_pk']],
            [['set_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['set_staffinforepo_fk' => 'staffinforepo_pk']],
            [['set_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['set_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
            [['set_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['set_standardcoursemst_fk' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffevaluationtmp_pk' => 'primary kry',
            'set_appstaffinfotmp_fk' => 'Reference to appstaffinfotmp_pk',
            'set_staffinforepo_fk' => 'Reference to staffinforepo_pk',
            'set_asmttype' => '1-Knowledge Assessment, 2-Practical Assessment',
            'set_asmtmode' => '1-Offline ,2-Online by default 1',
            'set_standardcoursemst_fk' => 'Reference to standardcoursemst_pk',
            'set_standardcoursedtls_fk' => 'Reference to standardcoursedtls_pk',
            'set_rascategorymst_fk' => 'Reference to rascategorymst_pk',
            'set_asmtstatus' => '1-Applicable, 2-Not Applicable,3-Competent, 4-Not Yet Competent, 5-Not Applicable (Knowledge Assessment alone)',
            'set_asmtupload' => 'Reference to memcompfiledtls_pk where filemst_fk =5 for knowledge and 6 for practical, NOT NULL when sked_asmtmode= 1 ',
            'set_marksecured' => 'mark secured  in assessment',
            'set_percentage' => 'Set Percentage',
            'set_staffevanfee' => 'Set Staffevanfee',
            'set_apppytminvoicedtls_fk' => 'Reference to apppytminvoicedtls_tbl',
            'set_createdon' => 'Set Createdon',
            'set_createdby' => 'Set Createdby',
            'set_updatedon' => 'Set Updatedon',
            'set_updatedby' => 'Set Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffevaluationhstyTbls()
    {
        return $this->hasMany(StaffevaluationhstyTbl::className(), ['seh_staffevaluationtmp_fk' => 'staffevaluationtmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffevaluationmainTbls()
    {
        return $this->hasMany(StaffevaluationmainTbl::className(), ['sem_staffevaluationtmp_fk' => 'staffevaluationtmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetApppytminvoicedtlsFk()
    {
        return $this->hasOne(ApppytminvoicedtlsTbl::className(), ['apppytminvoicedtls_pk' => 'set_apppytminvoicedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetAppstaffinfotmpFk()
    {
        return $this->hasOne(AppstaffinfotmpTbl::className(), ['appostaffinfotmp_pk' => 'set_appstaffinfotmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetRascategorymstFk()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'set_rascategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'set_staffinforepo_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'set_standardcoursedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'set_standardcoursemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StaffevaluationtmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffevaluationtmpTblQuery(get_called_class());
    }
} 