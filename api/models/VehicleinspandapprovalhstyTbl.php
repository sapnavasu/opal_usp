<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehicleinspandapprovalhsty_tbl".
 *
 * @property int $vehicleinspandapprovalhsty_pk
 * @property int $viah_vehicleinspandapproval_fk Reference to vehicleinspandapproval_pk
 * @property int $viah_rasvehicleregdtlshsty_fk Reference to rasvehicleregdtlshsty_pk
 * @property int $viah_insptype 1 - Online, 2 - Offline
 * @property string $viah_report Reference to memcompfiledtls_pk, if via_insptype=2
 * @property string $viah_comments
 * @property string $viah_createdon
 * @property int $viah_createdby
 * @property string $viah_updatedon
 * @property int $viah_updatedby
 * @property int $viah_appdecon
 * @property int $viah_appdecby
 * @property string $viah_appdecComments
 *
 * @property RasvehinsponquesdtlshstyTbl[] $rasvehinsponquesdtlshstyTbls
 * @property VehicleinspandapprovalTbl $viahVehicleinspandapprovalFk
 * @property RasvehicleregdtlshstyTbl $viahRasvehicleregdtlshstyFk
 */
class VehicleinspandapprovalhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicleinspandapprovalhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['viah_vehicleinspandapproval_fk', 'viah_rasvehicleregdtlshsty_fk', 'viah_insptype', 'viah_createdby'], 'required'],
            [['viah_vehicleinspandapproval_fk', 'viah_rasvehicleregdtlshsty_fk', 'viah_insptype', 'viah_createdby', 'viah_updatedby',  'viah_appdecby'], 'integer'],
            [['viah_report', 'viah_comments', 'viah_appdecComments'], 'string'],
            [['viah_createdon', 'viah_updatedon', 'viah_appdecon'], 'safe'],
            [['viah_vehicleinspandapproval_fk'], 'exist', 'skipOnError' => true, 'targetClass' => VehicleinspandapprovalTbl::className(), 'targetAttribute' => ['viah_vehicleinspandapproval_fk' => 'vehicleinspandapproval_pk']],
            [['viah_rasvehicleregdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehicleregdtlshstyTbl::className(), 'targetAttribute' => ['viah_rasvehicleregdtlshsty_fk' => 'rasvehicleregdtlshsty_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vehicleinspandapprovalhsty_pk' => 'Vehicleinspandapprovalhsty Pk',
            'viah_vehicleinspandapproval_fk' => 'Viah Vehicleinspandapproval Fk',
            'viah_rasvehicleregdtlshsty_fk' => 'Viah Rasvehicleregdtlshsty Fk',
            'viah_insptype' => 'Viah Insptype',
            'viah_report' => 'Viah Report',
            'viah_comments' => 'Viah Comments',
            'viah_createdon' => 'Viah Createdon',
            'viah_createdby' => 'Viah Createdby',
            'viah_updatedon' => 'Viah Updatedon',
            'viah_updatedby' => 'Viah Updatedby',
            'viah_appdecon' => 'Viah Appdecon',
            'viah_appdecby' => 'Viah Appdecby',
            'viah_appdecComments' => 'Viah Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasvehinsponquesdtlshstyTbls()
    {
        return $this->hasMany(RasvehinsponquesdtlshstyTbl::className(), ['rviqdh_vehicleinspandapprovalhsty_fk' => 'vehicleinspandapprovalhsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViahVehicleinspandapprovalFk()
    {
        return $this->hasOne(VehicleinspandapprovalTbl::className(), ['vehicleinspandapproval_pk' => 'viah_vehicleinspandapproval_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViahRasvehicleregdtlshstyFk()
    {
        return $this->hasOne(RasvehicleregdtlshstyTbl::className(), ['rasvehicleregdtlshsty_pk' => 'viah_rasvehicleregdtlshsty_fk']);
    }

    /**
     * {@inheritdoc}
     * @return VehicleinspandapprovalhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VehicleinspandapprovalhstyTblQuery(get_called_class());
    }
    
    public static function movetohistory($data)
    {
        $vehiclehist = RasvehicleregdtlshstyTbl::find()->where(['=','rvrdh_rasvehicleregdtls_fk',$data->via_rasvehicleregdtls_fk])->orderBy('rasvehicleregdtlshsty_pk desc')->one()['rasvehicleregdtlshsty_pk'];
      
        if(!$vehiclehist)
        {
          $vehicleregmodel = RasvehicleregdtlsTbl::findOne($data->via_rasvehicleregdtls_fk);
          $vehiclehist = RasvehicleregdtlshstyTbl::movetohistory($vehicleregmodel);  
        }
      
        $model = new VehicleinspandapprovalhstyTbl();
        $model->viah_vehicleinspandapproval_fk = $data->vehicleinspandapproval_pk;
        $model->viah_rasvehicleregdtlshsty_fk = (int)$vehiclehist;
        $model->viah_insptype = $data->via_insptype;
        $model->viah_report = $data->via_report;
        $model->viah_comments = $data->via_comments;
        $model->viah_createdon = $data->via_createdon;
        $model->viah_createdby = $data->via_createdby;
        $model->viah_updatedon = $data->via_updatedon;
        $model->viah_updatedby = $data->via_updatedby;
        $model->viah_appdecon = $data->via_appdecon;
        $model->viah_appdecby = $data->via_appdecby;
        $model->viah_appdecComments = $data->via_appdecComments;
        
        if($model->save())
        {
            return $model->vehicleinspandapprovalhsty_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
        
    }
}
