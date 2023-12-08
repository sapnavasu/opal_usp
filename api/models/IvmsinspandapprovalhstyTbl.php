<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ivmsinspandapprovalhsty_tbl".
 *
 * @property int $ivmsinspandapprovalhsty_pk
 * @property int $iiah_ivmsinspandapproval_fk Reference to ivmsinspandapproval_pk
 * @property int $iiah_ivmsvehicleregdtlshsty_fk  Reference to ivmsvehicleregdtlshsty_pk
 * @property int $iiah_insptype  1 - Online, 2 - Offline
 * @property string $iiah_report  Reference to memcompfiledtls_pk, if iia_insptype=2
 * @property string $iiah_comments
 * @property string $iiah_createdon
 * @property int $iiah_createdby
 * @property string $iiah_updatedon
 * @property int $iiah_updatedby
 * @property string $iiah_appdecon
 * @property int $iiah_appdecby
 * @property string $iiah_appdecComments
 *
 * @property IvmsinspandapprovalTbl $iiahIvmsinspandapprovalFk
 * @property IvmsvehicleregdtlshstyTbl $iiahIvmsvehicleregdtlshstyFk
 * @property IvmsinspquesdtlshstyTbl[] $ivmsinspquesdtlshstyTbls
 */
class IvmsinspandapprovalhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivmsinspandapprovalhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iiah_ivmsinspandapproval_fk', 'iiah_ivmsvehicleregdtlshsty_fk', 'iiah_insptype', 'iiah_createdby'], 'required'],
            [['iiah_ivmsinspandapproval_fk', 'iiah_ivmsvehicleregdtlshsty_fk', 'iiah_insptype', 'iiah_createdby', 'iiah_updatedby', 'iiah_appdecby'], 'integer'],
            [['iiah_report', 'iiah_comments', 'iiah_appdecComments'], 'string'],
            [['iiah_createdon','iiah_appdecon', 'iiah_updatedon'], 'safe'],
            [['iiah_ivmsinspandapproval_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IvmsinspandapprovalTbl::className(), 'targetAttribute' => ['iiah_ivmsinspandapproval_fk' => 'ivmsinspandapproval_pk']],
            [['iiah_ivmsvehicleregdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IvmsvehicleregdtlshstyTbl::className(), 'targetAttribute' => ['iiah_ivmsvehicleregdtlshsty_fk' => 'ivmsvehicleregdtlshsty_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ivmsinspandapprovalhsty_pk' => 'Ivmsinspandapprovalhsty Pk',
            'iiah_ivmsinspandapproval_fk' => 'Iiah Ivmsinspandapproval Fk',
            'iiah_ivmsvehicleregdtlshsty_fk' => 'Iiah Ivmsvehicleregdtlshsty Fk',
            'iiah_insptype' => 'Iiah Insptype',
            'iiah_report' => 'Iiah Report',
            'iiah_comments' => 'Iiah Comments',
            'iiah_createdon' => 'Iiah Createdon',
            'iiah_createdby' => 'Iiah Createdby',
            'iiah_updatedon' => 'Iiah Updatedon',
            'iiah_updatedby' => 'Iiah Updatedby',
            'iiah_appdecon' => 'Iiah Appdecon',
            'iiah_appdecby' => 'Iiah Appdecby',
            'iiah_appdecComments' => 'Iiah Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiahIvmsinspandapprovalFk()
    {
        return $this->hasOne(IvmsinspandapprovalTbl::className(), ['ivmsinspandapproval_pk' => 'iiah_ivmsinspandapproval_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiahIvmsvehicleregdtlshstyFk()
    {
        return $this->hasOne(IvmsvehicleregdtlshstyTbl::className(), ['ivmsvehicleregdtlshsty_pk' => 'iiah_ivmsvehicleregdtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvmsinspquesdtlshstyTbls()
    {
        return $this->hasMany(IvmsinspquesdtlshstyTbl::className(), ['iiqdh_vehicleinspandapprovalhsty_fk' => 'ivmsinspandapprovalhsty_pk']);
    }

    /**
     * {@inheritdoc}
     * @return IvmsinspandapprovalhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IvmsinspandapprovalhstyTblQuery(get_called_class());
    }
    
     public static function movetohistory($data)
    {
        $vehiclehist = IvmsvehicleregdtlshstyTbl::find()->where(['=','ivrdh_ivmsvehicleregdtls_fk',$data->iia_ivmsvehicleregdtls_fk])->orderBy('ivmsvehicleregdtlshsty_pk desc')->one()['ivmsvehicleregdtlshsty_pk'];
      
        if(!$vehiclehist)
        {
          $vehicleregmodel = IvmsvehicleregdtlsTbl::findOne($data->iia_rasvehicleregdtls_fk);
          $vehiclehist = IvmsvehicleregdtlshstyTbl::movetohistory($vehicleregmodel);  
        }
      
        $model = new IvmsinspandapprovalhstyTbl();
        $model->iiah_ivmsinspandapproval_fk = $data->ivmsinspandapproval_pk;
        $model->iiah_ivmsvehicleregdtlshsty_fk = (int)$vehiclehist;
        $model->iiah_insptype = $data->iia_insptype;
        $model->iiah_report = $data->iia_report;
        $model->iiah_comments = $data->iia_comments;
        $model->iiah_createdon = $data->iia_createdon;
        $model->iiah_createdby = $data->iia_createdby;
        $model->iiah_updatedon = $data->iia_updatedon;
        $model->iiah_updatedby = $data->iia_updatedby;
        $model->iiah_appdecon = $data->iia_appdecon;
        $model->iiah_appdecby = $data->iia_appdecby;
        $model->iiah_appdecComments = $data->iia_appdecComments;
        
        if($model->validate() && $model->save())
        {
            return $model->ivmsinspandapprovalhsty_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
        
    }
}
