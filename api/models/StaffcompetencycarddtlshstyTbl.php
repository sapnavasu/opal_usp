<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffcompetencycarddtlshsty_tbl".
 *
 * @property int $staffcompetencycarddtlshsty_pk
 * @property int $sccdh_staffcompetencycarddtls_fk Reference to staffcompetencycarddtls_pk
 * @property int $sccdh_staffcompetencycardhdr_fk Reference to staffcompetencycardhdr_pk
 * @property int $sccdh_standardcoursedtls_fk Reference to standardcoursedtls_pk If standard course, store the approved sub-categories here
 * @property int $sccdh_appcoursetrnstmp_fk Reference to appcoursetrnstmp_pk If customized course, store offered courses sub-categories here
 * @property int $sccdh_rascategorymst_fk Reference to rascategorymst_pk.  If RAS, store RAS Inspection Categories here
 * @property string $sccdh_cardexpiry
 * @property int $sccdh_status 1 - Active, 2 - Expired
 * @property string $sccdh_createdon
 * @property int $sccdh_createdby
 *
 * @property AppcoursetrnstmpTbl $sccdhAppcoursetrnstmpFk
 * @property RascategorymstTbl $sccdhRascategorymstFk
 * @property StaffcompetencycarddtlsTbl $sccdhStaffcompetencycarddtlsFk
 * @property StaffcompetencycardhdrTbl $sccdhStaffcompetencycardhdrFk
 * @property StandardcoursedtlsTbl $sccdhStandardcoursedtlsFk
 */
class StaffcompetencycarddtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffcompetencycarddtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sccdh_staffcompetencycarddtls_fk', 'sccdh_staffcompetencycardhdr_fk', 'sccdh_status', 'sccdh_createdon', 'sccdh_createdby'], 'required'],
            [['sccdh_staffcompetencycarddtls_fk', 'sccdh_staffcompetencycardhdr_fk', 'sccdh_standardcoursedtls_fk', 'sccdh_appcoursetrnstmp_fk', 'sccdh_rascategorymst_fk', 'sccdh_status', 'sccdh_createdby'], 'integer'],
            [['sccdh_cardexpiry', 'sccdh_createdon'], 'safe'],
            [['sccdh_appcoursetrnstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursetrnstmpTbl::className(), 'targetAttribute' => ['sccdh_appcoursetrnstmp_fk' => 'appcoursetrnstmp_pk']],
            [['sccdh_rascategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['sccdh_rascategorymst_fk' => 'rascategorymst_pk']],
            [['sccdh_staffcompetencycarddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffcompetencycarddtlsTbl::className(), 'targetAttribute' => ['sccdh_staffcompetencycarddtls_fk' => 'staffcompetencycarddtls_pk']],
            [['sccdh_staffcompetencycardhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffcompetencycardhdrTbl::className(), 'targetAttribute' => ['sccdh_staffcompetencycardhdr_fk' => 'staffcompetencycardhdr_pk']],
            [['sccdh_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['sccdh_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffcompetencycarddtlshsty_pk' => 'Staffcompetencycarddtlshsty Pk',
            'sccdh_staffcompetencycarddtls_fk' => 'Sccdh Staffcompetencycarddtls Fk',
            'sccdh_staffcompetencycardhdr_fk' => 'Sccdh Staffcompetencycardhdr Fk',
            'sccdh_standardcoursedtls_fk' => 'Sccdh Standardcoursedtls Fk',
            'sccdh_appcoursetrnstmp_fk' => 'Sccdh Appcoursetrnstmp Fk',
            'sccdh_rascategorymst_fk' => 'Sccdh Rascategorymst Fk',
            'sccdh_cardexpiry' => 'Sccdh Cardexpiry',
            'sccdh_status' => 'Sccdh Status',
            'sccdh_createdon' => 'Sccdh Createdon',
            'sccdh_createdby' => 'Sccdh Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccdhAppcoursetrnstmpFk()
    {
        return $this->hasOne(AppcoursetrnstmpTbl::className(), ['appcoursetrnstmp_pk' => 'sccdh_appcoursetrnstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccdhRascategorymstFk()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'sccdh_rascategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccdhStaffcompetencycarddtlsFk()
    {
        return $this->hasOne(StaffcompetencycarddtlsTbl::className(), ['staffcompetencycarddtls_pk' => 'sccdh_staffcompetencycarddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccdhStaffcompetencycardhdrFk()
    {
        return $this->hasOne(StaffcompetencycardhdrTbl::className(), ['staffcompetencycardhdr_pk' => 'sccdh_staffcompetencycardhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccdhStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'sccdh_standardcoursedtls_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StaffcompetencycarddtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffcompetencycarddtlshstyTblQuery(get_called_class());
    }
}
