<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rasvehinsponquesdtlshsty_tbl".
 *
 * @property int $rasvehinsponquesdtlshsty_pk
 * @property int $rviqdh_rasvehinsponquesdtls_fk Reference to rasvehinsponquesdtls_pk
 * @property int $rviqdh_vehicleinspandapprovalhsty_fk Reference to vehicleinspandapprovalhsty_pk
 * @property int $rviqdh_auditquestionmst_fk
 * @property string $rviqdh_question_en
 * @property string $rviqdh_question_ar
 * @property int $rviqdh_order Order of question to be displayed
 * @property string $rviqdh_createdon
 * @property int $rviqdh_createdby
 *
 * @property RasvehinsponansdtlshstyTbl[] $rasvehinsponansdtlshstyTbls
 * @property RasvehinsponquesdtlsTbl $rviqdhRasvehinsponquesdtlsFk
 * @property VehicleinspandapprovalhstyTbl $rviqdhVehicleinspandapprovalhstyFk
 * @property AuditquestionmstTbl $rviqdhAuditquestionmstFk
 */
class RasvehinsponquesdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rasvehinsponquesdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rviqdh_rasvehinsponquesdtls_fk', 'rviqdh_vehicleinspandapprovalhsty_fk', 'rviqdh_auditquestionmst_fk', 'rviqdh_question_en', 'rviqdh_question_ar', 'rviqdh_order', 'rviqdh_createdby'], 'required'],
            [['rviqdh_rasvehinsponquesdtls_fk', 'rviqdh_vehicleinspandapprovalhsty_fk', 'rviqdh_auditquestionmst_fk', 'rviqdh_order', 'rviqdh_createdby'], 'integer'],
            [['rviqdh_question_en', 'rviqdh_question_ar'], 'string'],
            [['rviqdh_createdon'], 'safe'],
            [['rviqdh_rasvehinsponquesdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehinsponquesdtlsTbl::className(), 'targetAttribute' => ['rviqdh_rasvehinsponquesdtls_fk' => 'rasvehinsponquesdtls_pk']],
            [['rviqdh_vehicleinspandapprovalhsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => VehicleinspandapprovalhstyTbl::className(), 'targetAttribute' => ['rviqdh_vehicleinspandapprovalhsty_fk' => 'vehicleinspandapprovalhsty_pk']],
            [['rviqdh_auditquestionmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AuditquestionmstTbl::className(), 'targetAttribute' => ['rviqdh_auditquestionmst_fk' => 'auditquestionmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rasvehinsponquesdtlshsty_pk' => 'Rasvehinsponquesdtlshsty Pk',
            'rviqdh_rasvehinsponquesdtls_fk' => 'Rviqdh Rasvehinsponquesdtls Fk',
            'rviqdh_vehicleinspandapprovalhsty_fk' => 'Rviqdh Vehicleinspandapprovalhsty Fk',
            'rviqdh_auditquestionmst_fk' => 'Rviqdh Auditquestionmst Fk',
            'rviqdh_question_en' => 'Rviqdh Question En',
            'rviqdh_question_ar' => 'Rviqdh Question Ar',
            'rviqdh_order' => 'Rviqdh Order',
            'rviqdh_createdon' => 'Rviqdh Createdon',
            'rviqdh_createdby' => 'Rviqdh Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasvehinsponansdtlshstyTbls()
    {
        return $this->hasMany(RasvehinsponansdtlshstyTbl::className(), ['rviadh_rasvehinsponquesdtlshsty_fk' => 'rasvehinsponquesdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRviqdhRasvehinsponquesdtlsFk()
    {
        return $this->hasOne(RasvehinsponquesdtlsTbl::className(), ['rasvehinsponquesdtls_pk' => 'rviqdh_rasvehinsponquesdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRviqdhVehicleinspandapprovalhstyFk()
    {
        return $this->hasOne(VehicleinspandapprovalhstyTbl::className(), ['vehicleinspandapprovalhsty_pk' => 'rviqdh_vehicleinspandapprovalhsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRviqdhAuditquestionmstFk()
    {
        return $this->hasOne(AuditquestionmstTbl::className(), ['auditquestionmst_pk' => 'rviqdh_auditquestionmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return RasvehinsponquesdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RasvehinsponquesdtlshstyTblQuery(get_called_class());
    }
    
    public static function movetohistory($data)
    {
        
        $histpk = VehicleinspandapprovalhstyTbl::find()->where(['viah_vehicleinspandapproval_fk' => $data->rviqd_vehicleinspandapproval_fk])->orderBy('vehicleinspandapprovalhsty_pk desc')->one()['vehicleinspandapprovalhsty_pk'];
        $model = new RasvehinsponquesdtlshstyTbl();
        
        $model->rviqdh_rasvehinsponquesdtls_fk = $data->rasvehinsponquesdtls_pk;
        $model->rviqdh_vehicleinspandapprovalhsty_fk = $histpk;
        $model->rviqdh_auditquestionmst_fk = $data->rviqd_auditquestionmst_fk;
        $model->rviqdh_question_en = $data->rviqd_question_en;
        $model->rviqdh_question_ar = $data->rviqd_question_ar;
        $model->rviqdh_order = $data->rviqd_order;
        $model->rviqdh_createdon = $data->rviqd_createdon;
        $model->rviqdh_createdby = $data->rviqd_createdby;
        
        if($model->save())
        {
            return $model->rasvehinsponquesdtlshsty_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
}
