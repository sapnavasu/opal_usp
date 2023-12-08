<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ivmsinspandapproval_tbl".
 *
 * @property int $ivmsinspandapproval_pk
 * @property int $iia_ivmsvehicleregdtls_fk  Reference to ivmsvehicleregdtls_pk
 * @property int $iia_insptype  1 - Online, 2 - Offline
 * @property string $iia_report Reference to memcompfiledtls_pk, if iia_insptype=2
 * @property string $iia_comments
 * @property string $iia_createdon
 * @property int $iia_createdby
 * @property string $iia_updatedon
 * @property int $iia_updatedby
 * @property string $iia_appdecon
 * @property int $iia_appdecby
 * @property string $iia_appdecComments
 *
 * @property IvmsvehicleregdtlsTbl $iiaIvmsvehicleregdtlsFk
 * @property IvmsinspandapprovalhstyTbl[] $ivmsinspandapprovalhstyTbls
 * @property IvmsinspquesdtlsTbl[] $ivmsinspquesdtlsTbls
 */
class IvmsinspandapprovalTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivmsinspandapproval_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iia_ivmsvehicleregdtls_fk', 'iia_insptype', 'iia_createdby'], 'required'],
            [['iia_ivmsvehicleregdtls_fk', 'iia_insptype', 'iia_createdby', 'iia_updatedby',  'iia_appdecby'], 'integer'],
            [['iia_report', 'iia_comments', 'iia_appdecComments'], 'string'],
            [['iia_createdon', 'iia_appdecon','iia_updatedon'], 'safe'],
            [['iia_ivmsvehicleregdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IvmsvehicleregdtlsTbl::className(), 'targetAttribute' => ['iia_ivmsvehicleregdtls_fk' => 'ivmsvehicleregdtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ivmsinspandapproval_pk' => 'Ivmsinspandapproval Pk',
            'iia_ivmsvehicleregdtls_fk' => 'Iia Ivmsvehicleregdtls Fk',
            'iia_insptype' => 'Iia Insptype',
            'iia_report' => 'Iia Report',
            'iia_comments' => 'Iia Comments',
            'iia_createdon' => 'Iia Createdon',
            'iia_createdby' => 'Iia Createdby',
            'iia_updatedon' => 'Iia Updatedon',
            'iia_updatedby' => 'Iia Updatedby',
            'iia_appdecon' => 'Iia Appdecon',
            'iia_appdecby' => 'Iia Appdecby',
            'iia_appdecComments' => 'Iia Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiaIvmsvehicleregdtlsFk()
    {
        return $this->hasOne(IvmsvehicleregdtlsTbl::className(), ['ivmsvehicleregdtls_pk' => 'iia_ivmsvehicleregdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvmsinspandapprovalhstyTbls()
    {
        return $this->hasMany(IvmsinspandapprovalhstyTbl::className(), ['iiah_ivmsinspandapproval_fk' => 'ivmsinspandapproval_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvmsinspquesdtlsTbls()
    {
        return $this->hasMany(IvmsinspquesdtlsTbl::className(), ['iiqd_vehicleinspandapproval_fk' => 'ivmsinspandapproval_pk']);
    }

    /**
     * {@inheritdoc}
     * @return IvmsinspandapprovalTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IvmsinspandapprovalTblQuery(get_called_class());
    }
}
