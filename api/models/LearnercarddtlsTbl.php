<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learnercarddtls_tbl".
 *
 * @property int $learnercarddtls_pk
 * @property int $lcd_staffinforepo_fk Reference to staffinforepo_pk,Learner data to be taken from this
 * @property int $lcd_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $lcd_learnerreghrddtls_fk Reference to learnerreghrddtls_pk
 * @property int $lcd_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $lcd_standardcoursedtls_fk Reference to standardcoursedtls_pk
 * @property string $lcd_categoryname Reference to coursecategorymst_tbl.ccm_catname_en
 * @property string $lcd_subcategoryname Reference to coursecategorymst_tbl.ccm_catname_en
 * @property int $lcd_isprinted 1 - Yes , 2 - No, No - means there is no card issued for this sub-category, Yes - means there is card issued for this sub-category
 * @property int $lcd_serialno This is null when row alcd_ismentionedprint is no and this is the number printed on the card issued to the learner,Reference to serialnomst_tbl.snm_serialnumber
 * @property string $lcd_cardexpiry this is null when alcd_ismentionedprint is no and when there is no expiry for the card
 * @property string $lcd_cardissuedate this is null when alcd_ismentionedprint is no
 * @property int $lcd_plaincard Reference to memcompfiledtls_pk,this is null when alcd_ismentionedprint is no
 * @property string $lcd_verificationno this is null when alcd_ismentionedprint is no
 * @property int $lcd_status 1 - Active, 2 - Expired, 3 - N/A (when alcd_ismentionedprint is no), 4 - In-active (when change is made and re-issued the card) / Destroyed and issued new card
 * @property string $lcd_printedon
 * @property int $lcd_printedby Reference to opalUsermst_tbl
 * @property string $lcd_createdon
 * @property int $lcd_createdby
 *
 * @property BatchmgmtdtlsTbl $lcdBatchmgmtdtlsFk
 * @property LearnerreghrddtlsTbl $lcdLearnerreghrddtlsFk
 * @property string $lcdPlaincard
 * @property StaffinforepoTbl $lcdStaffinforepoFk
 * @property StandardcoursedtlsTbl $lcdStandardcoursedtlsFk
 * @property StandardcoursemstTbl $lcdStandardcoursemstFk
 */
class LearnercarddtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learnercarddtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lcd_staffinforepo_fk', 'lcd_batchmgmtdtls_fk', 'lcd_learnerreghrddtls_fk', 'lcd_standardcoursemst_fk', 'lcd_standardcoursedtls_fk', 'lcd_categoryname', 'lcd_subcategoryname', 'lcd_isprinted', 'lcd_status', 'lcd_createdon', 'lcd_createdby'], 'required'],
            [['lcd_staffinforepo_fk', 'lcd_batchmgmtdtls_fk', 'lcd_learnerreghrddtls_fk', 'lcd_standardcoursemst_fk', 'lcd_standardcoursedtls_fk', 'lcd_isprinted', 'lcd_serialno', 'lcd_status', 'lcd_printedby', 'lcd_createdby'], 'integer'],
            [['lcd_categoryname', 'lcd_subcategoryname'], 'string'],
            [['lcd_cardexpiry', 'lcd_cardissuedate', 'lcd_printedon', 'lcd_createdon'], 'safe'],
            [['lcd_verificationno','lcd_plaincard','lcd_viewcardpath'], 'string', 'max' => 100],
            [['lcd_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['lcd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['lcd_learnerreghrddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerreghrddtlsTbl::className(), 'targetAttribute' => ['lcd_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']],
            [['lcd_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['lcd_staffinforepo_fk' => 'staffinforepo_pk']],
            [['lcd_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['lcd_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
            [['lcd_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['lcd_standardcoursemst_fk' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'learnercarddtls_pk' => 'Learnercarddtls Pk',
            'lcd_staffinforepo_fk' => 'Lcd Staffinforepo Fk',
            'lcd_batchmgmtdtls_fk' => 'Lcd Batchmgmtdtls Fk',
            'lcd_learnerreghrddtls_fk' => 'Lcd Learnerreghrddtls Fk',
            'lcd_standardcoursemst_fk' => 'Lcd Standardcoursemst Fk',
            'lcd_standardcoursedtls_fk' => 'Lcd Standardcoursedtls Fk',
            'lcd_categoryname' => 'Lcd Categoryname',
            'lcd_subcategoryname' => 'Lcd Subcategoryname',
            'lcd_isprinted' => 'Lcd Isprinted',
            'lcd_serialno' => 'Lcd Serialno',
            'lcd_cardexpiry' => 'Lcd Cardexpiry',
            'lcd_cardissuedate' => 'Lcd Cardissuedate',
            'lcd_plaincard' => 'Lcd Plaincard',
            'lcd_viewcardpath' => 'Lcd viewcard',
            'lcd_verificationno' => 'Lcd Verificationno',
            'lcd_status' => 'Lcd Status',
            'lcd_printedon' => 'Lcd Printedon',
            'lcd_printedby' => 'Lcd Printedby',
            'lcd_createdon' => 'Lcd Createdon',
            'lcd_createdby' => 'Lcd Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcdBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'lcd_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcdLearnerreghrddtlsFk()
    {
        return $this->hasOne(LearnerreghrddtlsTbl::className(), ['learnerreghrddtls_pk' => 'lcd_learnerreghrddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcdStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'lcd_staffinforepo_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcdStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'lcd_standardcoursedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcdStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'lcd_standardcoursemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return LearnercarddtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LearnercarddtlsTblQuery(get_called_class());
    }
}
