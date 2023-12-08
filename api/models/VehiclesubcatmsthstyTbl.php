<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehiclesubcatmsthsty_tbl".
 *
 * @property int $vehiclesubcatmsthsty_tbl
 * @property int $vscmh_vehiclesubcatmst_fk Reference to vehiclesubcatmst_pk
 * @property int $vscmh_rascategorymst_fk Reference to rascategorymst_pk
 * @property string $vscmh_vehiclename_en
 * @property string $vscmh_vehiclename_ar
 * @property int $vscmh_status 1-Active, 2-Inactive, by default 1
 * @property string $vscmh_createdon
 * @property int $vscmh_createdby
 * @property string $vscmh_updatedon
 * @property int $vscmh_updatedby
 *
 * @property RascategorymstTbl $vscmhRascategorymstFk
 * @property VehiclesubcatmstTbl $vscmhVehiclesubcatmstFk
 */
class VehiclesubcatmsthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehiclesubcatmsthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vscmh_vehiclesubcatmst_fk', 'vscmh_rascategorymst_fk', 'vscmh_vehiclename_en', 'vscmh_vehiclename_ar', 'vscmh_status', 'vscmh_createdon', 'vscmh_createdby'], 'required'],
            [['vscmh_vehiclesubcatmst_fk', 'vscmh_rascategorymst_fk', 'vscmh_status', 'vscmh_createdby', 'vscmh_updatedby'], 'integer'],
            [['vscmh_vehiclename_en', 'vscmh_vehiclename_ar'], 'string'],
            [['vscmh_createdon', 'vscmh_updatedon'], 'safe'],
            [['vscmh_rascategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['vscmh_rascategorymst_fk' => 'rascategorymst_pk']],
            [['vscmh_vehiclesubcatmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => VehiclesubcatmstTbl::className(), 'targetAttribute' => ['vscmh_vehiclesubcatmst_fk' => 'vehiclesubcatmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vehiclesubcatmsthsty_tbl' => 'Vehiclesubcatmsthsty Tbl',
            'vscmh_vehiclesubcatmst_fk' => 'Vscmh Vehiclesubcatmst Fk',
            'vscmh_rascategorymst_fk' => 'Vscmh Rascategorymst Fk',
            'vscmh_vehiclename_en' => 'Vscmh Vehiclename En',
            'vscmh_vehiclename_ar' => 'Vscmh Vehiclename Ar',
            'vscmh_status' => 'Vscmh Status',
            'vscmh_createdon' => 'Vscmh Createdon',
            'vscmh_createdby' => 'Vscmh Createdby',
            'vscmh_updatedon' => 'Vscmh Updatedon',
            'vscmh_updatedby' => 'Vscmh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVscmhRascategorymstFk()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'vscmh_rascategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVscmhVehiclesubcatmstFk()
    {
        return $this->hasOne(VehiclesubcatmstTbl::className(), ['vehiclesubcatmst_pk' => 'vscmh_vehiclesubcatmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return VehiclesubcatmsthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VehiclesubcatmsthstyTblQuery(get_called_class());
    }
}
