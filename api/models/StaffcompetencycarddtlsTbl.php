<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffcompetencycarddtls_tbl".
 *
 * @property int $staffcompetencycarddtls_pk primary key
 * @property int $sccd_staffcompetencycardhdr_fk Reference to staffcompetencycardhdr_pk
 * @property int $sccd_standardcoursedtls_fk Reference to standardcoursedtls_pk If standard course, store the approved sub-categories here
 * @property int $sccd_appcoursetrnstmp_fk Reference to appcoursetrnstmp_pk If customized course, store offered course's sub-categories here
 * @property int $sccd_rascategorymst_fk Reference to rascategorymst_pk.  If RAS, store RAS Inspection Categories here
 * @property string $sccd_cardexpiry
 * @property int $sccd_status 1 - Active, 2 - Expired
 * @property string $sccd_createdon
 * @property int $sccd_createdby
 *
 * @property AppcoursetrnstmpTbl $sccdAppcoursetrnstmpFk
 * @property RascategorymstTbl $sccdRascategorymstFk
 * @property StaffcompetencycardhdrTbl $sccdStaffcompetencycardhdrFk
 * @property StandardcoursedtlsTbl $sccdStandardcoursedtlsFk
 */
class StaffcompetencycarddtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffcompetencycarddtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sccd_staffcompetencycardhdr_fk', 'sccd_status', 'sccd_createdby'], 'required'],
            [['sccd_staffcompetencycardhdr_fk', 'sccd_standardcoursedtls_fk', 'sccd_appcoursetrnstmp_fk', 'sccd_rascategorymst_fk', 'sccd_status', 'sccd_createdby'], 'integer'],
            [['sccd_cardexpiry', 'sccd_createdon'], 'safe'],
            [['sccd_appcoursetrnstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursetrnstmpTbl::className(), 'targetAttribute' => ['sccd_appcoursetrnstmp_fk' => 'appcoursetrnstmp_pk']],
            [['sccd_rascategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['sccd_rascategorymst_fk' => 'rascategorymst_pk']],
            [['sccd_staffcompetencycardhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffcompetencycardhdrTbl::className(), 'targetAttribute' => ['sccd_staffcompetencycardhdr_fk' => 'staffcompetencycardhdr_pk']],
            [['sccd_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['sccd_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffcompetencycarddtls_pk' => 'primary key',
            'sccd_staffcompetencycardhdr_fk' => 'Reference to staffcompetencycardhdr_pk',
            'sccd_standardcoursedtls_fk' => 'Reference to standardcoursedtls_pk If standard course, store the approved sub-categories here',
            'sccd_appcoursetrnstmp_fk' => 'Reference to appcoursetrnstmp_pk If customized course, store offered course\'s sub-categories here',
            'sccd_rascategorymst_fk' => 'Reference to rascategorymst_pk.  If RAS, store RAS Inspection Categories here',
            'sccd_cardexpiry' => 'Sccd Cardexpiry',
            'sccd_status' => '1 - Active, 2 - Expired',
            'sccd_createdon' => 'Sccd Createdon',
            'sccd_createdby' => 'Sccd Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccdAppcoursetrnstmpFk()
    {
        return $this->hasOne(AppcoursetrnstmpTbl::className(), ['appcoursetrnstmp_pk' => 'sccd_appcoursetrnstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccdRascategorymstFk()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'sccd_rascategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccdStaffcompetencycardhdrFk()
    {
        return $this->hasOne(StaffcompetencycardhdrTbl::className(), ['staffcompetencycardhdr_pk' => 'sccd_staffcompetencycardhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccdStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'sccd_standardcoursedtls_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StaffcompetencycarddtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffcompetencycarddtlsTblQuery(get_called_class());
    }
}
