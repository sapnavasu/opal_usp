<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffcompetencycardhdrhsty_tbl".
 *
 * @property int $staffcompetencycardhdrhsty_pk
 * @property int $scchh_staffcompetencycardhdr_fk Reference to staffcompetencycardhdr_pk
 * @property int $scchh_staffinforepo_fk Reference to staffinforepo_tbl
 * @property int $scchh_projectmst_fk Reference to Projectmst_tbl
 * @property int $scchh_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $scchh_appoffercoursemain_fk Reference to appoffercoursemain_pk
 * @property string $scchh_rolemst_fk Reference to rolemst_pk For all the project, the respective approved Role will be stored here
 * @property string $scchh_language Reference to referencemsttbl.rm_mastertype=10
 * @property string $scch_cardexpiry
 * @property string $scchh_cardissuedate
 * @property int $scchh_status 1 - Valid, 2 - In-active (when change is made and re-issued the card) / Destroyed and issued new card, 3 - Expired
 * @property string $scchh_verificationcode
 * @property string $scchh_plaincardpath
 * @property string $scchh_viewcardpath
 * @property int $scchh_iscardprinted 1-Yes,2-No
 * @property int $scchh_iscardviewed 1-Yes,2-No
 * @property string $scchh_printedon
 * @property int $scchh_printedby
 * @property string $scchh_createdon
 * @property int $scchh_createdby
 *
 * @property AppoffercoursemainTbl $scchhAppoffercoursemainFk
 * @property ProjectmstTbl $scchhProjectmstFk
 * @property StaffcompetencycardhdrTbl $scchhStaffcompetencycardhdrFk
 * @property StaffinforepoTbl $scchhStaffinforepoFk
 * @property StandardcoursemstTbl $scchhStandardcoursemstFk
 */
class StaffcompetencycardhdrhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffcompetencycardhdrhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scchh_staffcompetencycardhdr_fk', 'scchh_staffinforepo_fk', 'scchh_projectmst_fk', 'scchh_rolemst_fk', 'scchh_status', 'scchh_createdon', 'scchh_createdby'], 'required'],
            [['scchh_staffcompetencycardhdr_fk', 'scchh_staffinforepo_fk', 'scchh_projectmst_fk', 'scchh_standardcoursemst_fk', 'scchh_appoffercoursemain_fk', 'scchh_status', 'scchh_iscardprinted', 'scchh_iscardviewed', 'scchh_printedby', 'scchh_createdby'], 'integer'],
            [['scchh_rolemst_fk', 'scchh_language', 'scchh_plaincardpath', 'scchh_viewcardpath'], 'string'],
            [['scch_cardexpiry', 'scchh_cardissuedate', 'scchh_printedon', 'scchh_createdon'], 'safe'],
            [['scchh_verificationcode'], 'string', 'max' => 50],
            [['scchh_appoffercoursemain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursemainTbl::className(), 'targetAttribute' => ['scchh_appoffercoursemain_fk' => 'appoffercoursemain_pk']],
            [['scchh_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['scchh_projectmst_fk' => 'projectmst_pk']],
            [['scchh_staffcompetencycardhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffcompetencycardhdrTbl::className(), 'targetAttribute' => ['scchh_staffcompetencycardhdr_fk' => 'staffcompetencycardhdr_pk']],
            [['scchh_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['scchh_staffinforepo_fk' => 'staffinforepo_pk']],
            [['scchh_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['scchh_standardcoursemst_fk' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffcompetencycardhdrhsty_pk' => 'Staffcompetencycardhdrhsty Pk',
            'scchh_staffcompetencycardhdr_fk' => 'Scchh Staffcompetencycardhdr Fk',
            'scchh_staffinforepo_fk' => 'Scchh Staffinforepo Fk',
            'scchh_projectmst_fk' => 'Scchh Projectmst Fk',
            'scchh_standardcoursemst_fk' => 'Scchh Standardcoursemst Fk',
            'scchh_appoffercoursemain_fk' => 'Scchh Appoffercoursemain Fk',
            'scchh_rolemst_fk' => 'Scchh Rolemst Fk',
            'scchh_language' => 'Scchh Language',
            'scch_cardexpiry' => 'Scch Cardexpiry',
            'scchh_cardissuedate' => 'Scchh Cardissuedate',
            'scchh_status' => 'Scchh Status',
            'scchh_verificationcode' => 'Scchh Verificationcode',
            'scchh_plaincardpath' => 'Scchh Plaincardpath',
            'scchh_viewcardpath' => 'Scchh Viewcardpath',
            'scchh_iscardprinted' => 'Scchh Iscardprinted',
            'scchh_iscardviewed' => 'Scchh Iscardviewed',
            'scchh_printedon' => 'Scchh Printedon',
            'scchh_printedby' => 'Scchh Printedby',
            'scchh_createdon' => 'Scchh Createdon',
            'scchh_createdby' => 'Scchh Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScchhAppoffercoursemainFk()
    {
        return $this->hasOne(AppoffercoursemainTbl::className(), ['appoffercoursemain_pk' => 'scchh_appoffercoursemain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScchhProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'scchh_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScchhStaffcompetencycardhdrFk()
    {
        return $this->hasOne(StaffcompetencycardhdrTbl::className(), ['staffcompetencycardhdr_pk' => 'scchh_staffcompetencycardhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScchhStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'scchh_staffinforepo_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScchhStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'scchh_standardcoursemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StaffcompetencycardhdrhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffcompetencycardhdrhstyTblQuery(get_called_class());
    }
}
