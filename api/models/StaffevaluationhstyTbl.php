<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffevaluationhsty_tbl".
 *
 * @property int $staffevaluationhsty_pk primary key
 * @property int $seh_staffevaluationtmp_fk Reference to staffevaluationtmp_pk
 * @property int $seh_staffevaluationmain_fk Reference to staffevaluationmain_pk
 * @property int $seh_appstaffinfohsty_fk Reference to appstaffinfohsty_pk
 * @property int $seh_staffinforepo_fk Reference to staffinforepo_pk
 * @property int $seh_asmttype 1-Knowledge Assessment, 2-Practical Assessment
 * @property int $seh_asmtmode 1-Offline ,2-Online by default 1
 * @property int $seh_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $seh_standardcoursedtls_fk Reference to standardcoursedtls_pk
 * @property int $seh_rascategorymst_fk Reference to rascategorymst_pk
 * @property int $seh_asmtstatus 1-Applicable. 2-Not Applicable,3-Competent, 4-Not Yet Competent, 5-Not Applicable (Knowledge Assessment alone)
 * @property int $seh_asmtupload Reference to memcompfiledtls_pk where filemst_fk =5 for knowledge and 6 for practical, NOT NULL when sked_asmtmode= 1 
 * @property string $seh_marksecured mark secured  in assessment
 * @property string $seh_percentage
 * @property string $seh_staffevanfee
 * @property int $seh_apppytminvoicedtls_fk Reference to apppytminvoicedtls_tbl
 * @property string $seh_createdon
 * @property int $seh_createdby
 * @property string $seh_updatedon
 * @property int $seh_updatedby
 *
 * @property ApppytminvoicedtlsTbl $sehApppytminvoicedtlsFk
 * @property AppstaffinfohstyTbl $sehAppstaffinfohstyFk
 * @property RascategorymstTbl $sehRascategorymstFk
 * @property StaffevaluationmainTbl $sehStaffevaluationmainFk
 * @property StaffevaluationtmpTbl $sehStaffevaluationtmpFk
 * @property StaffinforepoTbl $sehStaffinforepoFk
 * @property StandardcoursedtlsTbl $sehStandardcoursedtlsFk
 * @property StandardcoursemstTbl $sehStandardcoursemstFk
 */
class StaffevaluationhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffevaluationhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seh_staffevaluationtmp_fk', 'seh_appstaffinfohsty_fk', 'seh_staffinforepo_fk', 'seh_asmttype', 'seh_asmtstatus', 'seh_createdby'], 'required'],
            [['seh_staffevaluationtmp_fk', 'seh_staffevaluationmain_fk', 'seh_appstaffinfohsty_fk', 'seh_staffinforepo_fk', 'seh_asmttype', 'seh_asmtmode', 'seh_standardcoursemst_fk', 'seh_standardcoursedtls_fk', 'seh_rascategorymst_fk', 'seh_asmtstatus', 'seh_asmtupload', 'seh_apppytminvoicedtls_fk', 'seh_createdby', 'seh_updatedby'], 'integer'],
            [['seh_marksecured', 'seh_percentage', 'seh_staffevanfee'], 'number'],
            [['seh_createdon', 'seh_updatedon'], 'safe'],
            [['seh_apppytminvoicedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApppytminvoicedtlsTbl::className(), 'targetAttribute' => ['seh_apppytminvoicedtls_fk' => 'apppytminvoicedtls_pk']],
            [['seh_appstaffinfohsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppstaffinfohstyTbl::className(), 'targetAttribute' => ['seh_appstaffinfohsty_fk' => 'AppStaffInfoHsty_PK']],
            [['seh_rascategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['seh_rascategorymst_fk' => 'rascategorymst_pk']],
            [['seh_staffevaluationmain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffevaluationmainTbl::className(), 'targetAttribute' => ['seh_staffevaluationmain_fk' => 'staffevaluationmain_pk']],
            [['seh_staffevaluationtmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffevaluationtmpTbl::className(), 'targetAttribute' => ['seh_staffevaluationtmp_fk' => 'staffevaluationtmp_pk']],
            [['seh_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['seh_staffinforepo_fk' => 'staffinforepo_pk']],
            [['seh_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['seh_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
            [['seh_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['seh_standardcoursemst_fk' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffevaluationhsty_pk' => 'primary key',
            'seh_staffevaluationtmp_fk' => 'Reference to staffevaluationtmp_pk',
            'seh_staffevaluationmain_fk' => 'Reference to staffevaluationmain_pk',
            'seh_appstaffinfohsty_fk' => 'Reference to appstaffinfohsty_pk',
            'seh_staffinforepo_fk' => 'Reference to staffinforepo_pk',
            'seh_asmttype' => '1-Knowledge Assessment, 2-Practical Assessment',
            'seh_asmtmode' => '1-Offline ,2-Online by default 1',
            'seh_standardcoursemst_fk' => 'Reference to standardcoursemst_pk',
            'seh_standardcoursedtls_fk' => 'Reference to standardcoursedtls_pk',
            'seh_rascategorymst_fk' => 'Reference to rascategorymst_pk',
            'seh_asmtstatus' => '1-Applicable. 2-Not Applicable,3-Competent, 4-Not Yet Competent, 5-Not Applicable (Knowledge Assessment alone)',
            'seh_asmtupload' => 'Reference to memcompfiledtls_pk where filemst_fk =5 for knowledge and 6 for practical, NOT NULL when sked_asmtmode= 1 ',
            'seh_marksecured' => 'mark secured  in assessment',
            'seh_percentage' => 'Seh Percentage',
            'seh_staffevanfee' => 'Seh Staffevanfee',
            'seh_apppytminvoicedtls_fk' => 'Reference to apppytminvoicedtls_tbl',
            'seh_createdon' => 'Seh Createdon',
            'seh_createdby' => 'Seh Createdby',
            'seh_updatedon' => 'Seh Updatedon',
            'seh_updatedby' => 'Seh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSehApppytminvoicedtlsFk()
    {
        return $this->hasOne(ApppytminvoicedtlsTbl::className(), ['apppytminvoicedtls_pk' => 'seh_apppytminvoicedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSehAppstaffinfohstyFk()
    {
        return $this->hasOne(AppstaffinfohstyTbl::className(), ['AppStaffInfoHsty_PK' => 'seh_appstaffinfohsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSehRascategorymstFk()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'seh_rascategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSehStaffevaluationmainFk()
    {
        return $this->hasOne(StaffevaluationmainTbl::className(), ['staffevaluationmain_pk' => 'seh_staffevaluationmain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSehStaffevaluationtmpFk()
    {
        return $this->hasOne(StaffevaluationtmpTbl::className(), ['staffevaluationtmp_pk' => 'seh_staffevaluationtmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSehStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'seh_staffinforepo_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSehStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'seh_standardcoursedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSehStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'seh_standardcoursemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StaffevaluationhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffevaluationhstyTblQuery(get_called_class());
    }
}
