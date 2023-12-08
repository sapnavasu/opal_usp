<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learnercarddtlshsty_tbl".
 *
 * @property int $learnercarddtlshsty_pk
 * @property int $lcdh_learnercarddtls_fk Reference to learnercarddtls_pk
 * @property int $lcdh_staffinforepo_fk Reference to staffinforepo_pk Learner data to be taken from this
 * @property int $lcdh_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $lcdh_learnerreghrddtls_fk Reference to learnerreghrddtls_pk
 * @property int $lcdh_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $lcdh_standardcoursedtls_fk Reference to standardcoursedtls_pk
 * @property string $lcdh_categoryname Reference to coursecategorymst_tbl.ccm_catname_en
 * @property string $lcdh_subcategoryname Reference to coursecategorymst_tbl.ccm_catname_en
 * @property int $lcdh_isprinted 1 - Yes , 2 - No, No - means there is no card issued for this sub-category, Yes - means there is card issued for this sub-category
 * @property int $lcdh_serialno This is null when row lcd_isprintedis no and this is the number printed on the card issued to the learner, Reference to serialnomst_tbl.snm_serialnumber
 * @property string $lcdh_cardexpiry this is null when lcd_isprinted is no and when there is no expiry for the card
 * @property string $lcdh_cardissuedate this is null when lcd_isprinted is no
 * @property string $lcdh_plaincard
 * @property string $lcdh_viewcardpath
 * @property string $lcdh_verificationno this is null when lcd_isprintedis no
 * @property int $lcdh_status 1 - Active, 2 - Expired, 3 - N/A (when lcd_isprintedis no), 4 - In-active (when change is made and re-issued the card) / Destroyed and issued new card
 * @property string $lcdh_printedon
 * @property int $lcdh_printedby Reference to opalUsermst_tbl
 *
 * @property BatchmgmtdtlsTbl $lcdhBatchmgmtdtlsFk
 * @property LearnercarddtlsTbl $lcdhLearnercarddtlsFk
 * @property LearnerreghrddtlsTbl $lcdhLearnerreghrddtlsFk
 * @property StaffinforepoTbl $lcdhStaffinforepoFk
 * @property StandardcoursedtlsTbl $lcdhStandardcoursedtlsFk
 * @property StandardcoursemstTbl $lcdhStandardcoursemstFk
 */
class LearnercarddtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learnercarddtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lcdh_learnercarddtls_fk', 'lcdh_staffinforepo_fk', 'lcdh_batchmgmtdtls_fk', 'lcdh_learnerreghrddtls_fk', 'lcdh_standardcoursemst_fk', 'lcdh_standardcoursedtls_fk', 'lcdh_categoryname', 'lcdh_subcategoryname', 'lcdh_isprinted', 'lcdh_status'], 'required'],
            [['lcdh_learnercarddtls_fk', 'lcdh_staffinforepo_fk', 'lcdh_batchmgmtdtls_fk', 'lcdh_learnerreghrddtls_fk', 'lcdh_standardcoursemst_fk', 'lcdh_standardcoursedtls_fk', 'lcdh_isprinted', 'lcdh_serialno', 'lcdh_status', 'lcdh_printedby'], 'integer'],
            [['lcdh_categoryname', 'lcdh_subcategoryname', 'lcdh_plaincard', 'lcdh_viewcardpath'], 'string'],
            [['lcdh_cardexpiry', 'lcdh_cardissuedate', 'lcdh_printedon'], 'safe'],
            [['lcdh_verificationno'], 'string', 'max' => 50],
            [['lcdh_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['lcdh_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['lcdh_learnercarddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnercarddtlsTbl::className(), 'targetAttribute' => ['lcdh_learnercarddtls_fk' => 'learnercarddtls_pk']],
            [['lcdh_learnerreghrddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerreghrddtlsTbl::className(), 'targetAttribute' => ['lcdh_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']],
            [['lcdh_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['lcdh_staffinforepo_fk' => 'staffinforepo_pk']],
            [['lcdh_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['lcdh_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
            [['lcdh_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['lcdh_standardcoursemst_fk' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'learnercarddtlshsty_pk' => 'Learnercarddtlshsty Pk',
            'lcdh_learnercarddtls_fk' => 'Lcdh Learnercarddtls Fk',
            'lcdh_staffinforepo_fk' => 'Lcdh Staffinforepo Fk',
            'lcdh_batchmgmtdtls_fk' => 'Lcdh Batchmgmtdtls Fk',
            'lcdh_learnerreghrddtls_fk' => 'Lcdh Learnerreghrddtls Fk',
            'lcdh_standardcoursemst_fk' => 'Lcdh Standardcoursemst Fk',
            'lcdh_standardcoursedtls_fk' => 'Lcdh Standardcoursedtls Fk',
            'lcdh_categoryname' => 'Lcdh Categoryname',
            'lcdh_subcategoryname' => 'Lcdh Subcategoryname',
            'lcdh_isprinted' => 'Lcdh Isprinted',
            'lcdh_serialno' => 'Lcdh Serialno',
            'lcdh_cardexpiry' => 'Lcdh Cardexpiry',
            'lcdh_cardissuedate' => 'Lcdh Cardissuedate',
            'lcdh_plaincard' => 'Lcdh Plaincard',
            'lcdh_viewcardpath' => 'Lcdh Viewcardpath',
            'lcdh_verificationno' => 'Lcdh Verificationno',
            'lcdh_status' => 'Lcdh Status',
            'lcdh_printedon' => 'Lcdh Printedon',
            'lcdh_printedby' => 'Lcdh Printedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcdhBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'lcdh_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcdhLearnercarddtlsFk()
    {
        return $this->hasOne(LearnercarddtlsTbl::className(), ['learnercarddtls_pk' => 'lcdh_learnercarddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcdhLearnerreghrddtlsFk()
    {
        return $this->hasOne(LearnerreghrddtlsTbl::className(), ['learnerreghrddtls_pk' => 'lcdh_learnerreghrddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcdhStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'lcdh_staffinforepo_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcdhStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'lcdh_standardcoursedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcdhStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'lcdh_standardcoursemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return LearnercarddtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LearnercarddtlshstyTblQuery(get_called_class());
    }
}
