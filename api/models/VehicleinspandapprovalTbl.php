<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehicleinspandapproval_tbl".
 *
 * @property int $vehicleinspandapproval_pk
 * @property int $via_rasvehicleregdtls_fk Reference to rasvehicleregdtls_pk
 * @property int $via_insptype 1 - Online, 2 - Offline
 * @property string $via_report Reference to memcompfiledtls_pk, if via_insptype=2
 * @property string $via_comments
 * @property string $via_createdon
 * @property int $via_createdby
 * @property string $via_updatedon
 * @property int $via_updatedby
 * @property string $via_appdecon
 * @property int $via_appdecby
 * @property string $via_appdecComments
 *
 * @property RasvehinsponquesdtlsTbl[] $rasvehinsponquesdtlsTbls
 * @property RasvehicleregdtlsTbl $viaRasvehicleregdtlsFk
 * @property VehicleinspandapprovalhstyTbl[] $vehicleinspandapprovalhstyTbls
 */
class VehicleinspandapprovalTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicleinspandapproval_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['via_rasvehicleregdtls_fk', 'via_insptype', 'via_createdby'], 'required'],
            [['via_rasvehicleregdtls_fk', 'via_insptype', 'via_createdby', 'via_updatedby', 'via_appdecby'], 'integer'],
            [['via_report', 'via_comments', 'via_appdecComments'], 'string'],
            [['via_createdon', 'via_updatedon', 'via_appdecon'], 'safe'],
            [['via_rasvehicleregdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehicleregdtlsTbl::className(), 'targetAttribute' => ['via_rasvehicleregdtls_fk' => 'rasvehicleregdtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vehicleinspandapproval_pk' => 'Vehicleinspandapproval Pk',
            'via_rasvehicleregdtls_fk' => 'Via Rasvehicleregdtls Fk',
            'via_insptype' => 'Via Insptype',
            'via_report' => 'Via Report',
            'via_comments' => 'Via Comments',
            'via_createdon' => 'Via Createdon',
            'via_createdby' => 'Via Createdby',
            'via_updatedon' => 'Via Updatedon',
            'via_updatedby' => 'Via Updatedby',
            'via_appdecon' => 'Via Appdecon',
            'via_appdecby' => 'Via Appdecby',
            'via_appdecComments' => 'Via Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasvehinsponquesdtlsTbls()
    {
        return $this->hasMany(RasvehinsponquesdtlsTbl::className(), ['rviqd_vehicleinspandapproval_fk' => 'vehicleinspandapproval_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViaRasvehicleregdtlsFk()
    {
        return $this->hasOne(RasvehicleregdtlsTbl::className(), ['rasvehicleregdtls_pk' => 'via_rasvehicleregdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicleinspandapprovalhstyTbls()
    {
        return $this->hasMany(VehicleinspandapprovalhstyTbl::className(), ['viah_vehicleinspandapproval_fk' => 'vehicleinspandapproval_pk']);
    }

    /**
     * {@inheritdoc}
     * @return VehicleinspandapprovalTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VehicleinspandapprovalTblQuery(get_called_class());
    }


}
