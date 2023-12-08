<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffevaluationmain_tbl".
 *
 * @property int $staffevaluationmain_pk primary key
 * @property int $sem_staffevaluationtmp_fk Reference to staffevaluationtmp_pk
 * @property int $sem_appstaffinfomain_fk Reference to appstaffinfomain_pk
 * @property int $sem_staffinforepo_fk Reference to staffinforepo_pk
 * @property int $sem_asmttype 1-Knowledge Assessment, 2-Practical Assessment
 * @property int $sem_asmtmode 1-Offline ,2-Online by default 1
 * @property int $sem_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $sem_standardcoursedtls_fk Reference to standardcoursedtls_pk
 * @property int $sem_rascategorymst_fk Reference to rascategorymst_pk
 * @property int $sem_asmtstatus 1-Applicable. 2-Not Applicable,3-Competent, 4-Not Yet Competent, 5-Not Applicable (Knowledge Assessment alone)
 * @property int $sem_asmtupload Reference to memcompfiledtls_pk where filemst_fk =5 for knowledge and 6 for practical, NOT NULL when sked_asmtmode= 1 
 * @property string $sem_marksecured mark secured  in assessment
 * @property string $sem_percentage
 * @property string $sem_staffevanfee
 * @property int $sem_apppytminvoicedtls_fk Reference to apppytminvoicedtls_tbl
 * @property string $sem_updatedon
 * @property int $sem_updatedby
 *
 * @property StaffevaluationhstyTbl[] $staffevaluationhstyTbls
 * @property ApppytminvoicedtlsTbl $semApppytminvoicedtlsFk
 * @property AppstaffinfomainTbl $semAppstaffinfomainFk
 * @property RascategorymstTbl $semRascategorymstFk
 * @property StaffevaluationtmpTbl $semStaffevaluationtmpFk
 * @property StaffinforepoTbl $semStaffinforepoFk
 * @property StandardcoursedtlsTbl $semStandardcoursedtlsFk
 * @property StandardcoursemstTbl $semStandardcoursemstFk
 */
class StaffevaluationmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffevaluationmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sem_staffevaluationtmp_fk', 'sem_appstaffinfomain_fk', 'sem_staffinforepo_fk', 'sem_asmttype', 'sem_asmtstatus'], 'required'],
            [['sem_staffevaluationtmp_fk', 'sem_appstaffinfomain_fk', 'sem_staffinforepo_fk', 'sem_asmttype', 'sem_asmtmode', 'sem_standardcoursemst_fk', 'sem_standardcoursedtls_fk', 'sem_rascategorymst_fk', 'sem_asmtstatus', 'sem_asmtupload', 'sem_apppytminvoicedtls_fk', 'sem_updatedby'], 'integer'],
            [['sem_marksecured', 'sem_percentage', 'sem_staffevanfee'], 'number'],
            [['sem_updatedon'], 'safe'],
            [['sem_apppytminvoicedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApppytminvoicedtlsTbl::className(), 'targetAttribute' => ['sem_apppytminvoicedtls_fk' => 'apppytminvoicedtls_pk']],
            [['sem_appstaffinfomain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppstaffinfomainTbl::className(), 'targetAttribute' => ['sem_appstaffinfomain_fk' => 'AppStaffInfoMain_PK']],
            [['sem_rascategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['sem_rascategorymst_fk' => 'rascategorymst_pk']],
            [['sem_staffevaluationtmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffevaluationtmpTbl::className(), 'targetAttribute' => ['sem_staffevaluationtmp_fk' => 'staffevaluationtmp_pk']],
            [['sem_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['sem_staffinforepo_fk' => 'staffinforepo_pk']],
            [['sem_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['sem_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
            [['sem_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['sem_standardcoursemst_fk' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffevaluationmain_pk' => 'primary key',
            'sem_staffevaluationtmp_fk' => 'Reference to staffevaluationtmp_pk',
            'sem_appstaffinfomain_fk' => 'Reference to appstaffinfomain_pk',
            'sem_staffinforepo_fk' => 'Reference to staffinforepo_pk',
            'sem_asmttype' => '1-Knowledge Assessment, 2-Practical Assessment',
            'sem_asmtmode' => '1-Offline ,2-Online by default 1',
            'sem_standardcoursemst_fk' => 'Reference to standardcoursemst_pk',
            'sem_standardcoursedtls_fk' => 'Reference to standardcoursedtls_pk',
            'sem_rascategorymst_fk' => 'Reference to rascategorymst_pk',
            'sem_asmtstatus' => '1-Applicable. 2-Not Applicable,3-Competent, 4-Not Yet Competent, 5-Not Applicable (Knowledge Assessment alone)',
            'sem_asmtupload' => 'Reference to memcompfiledtls_pk where filemst_fk =5 for knowledge and 6 for practical, NOT NULL when sked_asmtmode= 1 ',
            'sem_marksecured' => 'mark secured  in assessment',
            'sem_percentage' => 'Sem Percentage',
            'sem_staffevanfee' => 'Sem Staffevanfee',
            'sem_apppytminvoicedtls_fk' => 'Reference to apppytminvoicedtls_tbl',
            'sem_updatedon' => 'Sem Updatedon',
            'sem_updatedby' => 'Sem Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffevaluationhstyTbls()
    {
        return $this->hasMany(StaffevaluationhstyTbl::className(), ['seh_staffevaluationmain_fk' => 'staffevaluationmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemApppytminvoicedtlsFk()
    {
        return $this->hasOne(ApppytminvoicedtlsTbl::className(), ['apppytminvoicedtls_pk' => 'sem_apppytminvoicedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemAppstaffinfomainFk()
    {
        return $this->hasOne(AppstaffinfomainTbl::className(), ['AppStaffInfoMain_PK' => 'sem_appstaffinfomain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemRascategorymstFk()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'sem_rascategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemStaffevaluationtmpFk()
    {
        return $this->hasOne(StaffevaluationtmpTbl::className(), ['staffevaluationtmp_pk' => 'sem_staffevaluationtmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'sem_staffinforepo_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'sem_standardcoursedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'sem_standardcoursemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StaffevaluationmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffevaluationmainTblQuery(get_called_class());
    }
}
