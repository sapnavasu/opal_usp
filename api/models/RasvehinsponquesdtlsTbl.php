<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rasvehinsponquesdtls_tbl".
 *
 * @property int $rasvehinsponquesdtls_pk
 * @property int $rviqd_vehicleinspandapproval_fk Reference to vehicleinspandapproval_pk
 * @property string $rviqd_question_en
 * @property string $rviqd_question_ar
 * @property int $rviqd_order Order of question to be displayed
 * @property string $rviqd_createdon
 * @property int $rviqd_createdby
 *
 * @property RasvehinsponansdtlsTbl[] $rasvehinsponansdtlsTbls
 * @property VehicleinspandapprovalTbl $rviqdVehicleinspandapprovalFk
 * @property RasvehinsponquesdtlshstyTbl[] $rasvehinsponquesdtlshstyTbls
 */
class RasvehinsponquesdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rasvehinsponquesdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rviqd_vehicleinspandapproval_fk', 'rviqd_question_en', 'rviqd_question_ar', 'rviqd_order', 'rviqd_createdby'], 'required'],
            [['rviqd_vehicleinspandapproval_fk', 'rviqd_order', 'rviqd_createdby'], 'integer'],
            [['rviqd_question_en', 'rviqd_question_ar'], 'string'],
            [['rviqd_createdon'], 'safe'],
            [['rviqd_vehicleinspandapproval_fk'], 'exist', 'skipOnError' => true, 'targetClass' => VehicleinspandapprovalTbl::className(), 'targetAttribute' => ['rviqd_vehicleinspandapproval_fk' => 'vehicleinspandapproval_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rasvehinsponquesdtls_pk' => 'Rasvehinsponquesdtls Pk',
            'rviqd_vehicleinspandapproval_fk' => 'Rviqd Vehicleinspandapproval Fk',
            'rviqd_question_en' => 'Rviqd Question En',
            'rviqd_question_ar' => 'Rviqd Question Ar',
            'rviqd_order' => 'Rviqd Order',
            'rviqd_createdon' => 'Rviqd Createdon',
            'rviqd_createdby' => 'Rviqd Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasvehinsponansdtlsTbls()
    {
        return $this->hasMany(RasvehinsponansdtlsTbl::className(), ['rviad_rasvehinsponquesdtls_fk' => 'rasvehinsponquesdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRviqdVehicleinspandapprovalFk()
    {
        return $this->hasOne(VehicleinspandapprovalTbl::className(), ['vehicleinspandapproval_pk' => 'rviqd_vehicleinspandapproval_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasvehinsponquesdtlshstyTbls()
    {
        return $this->hasMany(RasvehinsponquesdtlshstyTbl::className(), ['rviqdh_rasvehinsponquesdtls_fk' => 'rasvehinsponquesdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return RasvehinsponquesdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RasvehinsponquesdtlsTblQuery(get_called_class());
    }
}
