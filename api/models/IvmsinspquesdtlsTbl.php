<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ivmsinspquesdtls_tbl".
 *
 * @property int $ivmsinspquesdtls_pk
 * @property int $iiqd_ivmsinspandapproval_fk  Reference to ivmsinspandapproval_pk
 * @property int $iiqd_auditquestionmst_fk  Reference to auditquestionmst_pk
 * @property string $iiqd_question_en
 * @property string $iiqd_question_ar
 * @property int $iiqd_order Order of question to be displayed
 * @property string $iiqd_createdon
 * @property int $iiqd_createdby
 *
 * @property IvmsinspansdtlsTbl[] $ivmsinspansdtlsTbls
 * @property AuditquestionmstTbl $iiqdAuditquestionmstFk
 * @property IvmsinspandapprovalTbl $iiqdVehicleinspandapprovalFk
 */
class IvmsinspquesdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivmsinspquesdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iiqd_ivmsinspandapproval_fk', 'iiqd_auditquestionmst_fk', 'iiqd_question_en', 'iiqd_question_ar', 'iiqd_order', 'iiqd_createdby'], 'required'],
            [['iiqd_ivmsinspandapproval_fk', 'iiqd_auditquestionmst_fk', 'iiqd_order', 'iiqd_createdby'], 'integer'],
            [['iiqd_question_en', 'iiqd_question_ar'], 'string'],
            [['iiqd_createdon'], 'safe'],
            [['iiqd_auditquestionmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AuditquestionmstTbl::className(), 'targetAttribute' => ['iiqd_auditquestionmst_fk' => 'auditquestionmst_pk']],
            [['iiqd_ivmsinspandapproval_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IvmsinspandapprovalTbl::className(), 'targetAttribute' => ['iiqd_ivmsinspandapproval_fk' => 'ivmsinspandapproval_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ivmsinspquesdtls_pk' => 'Ivmsinspquesdtls Pk',
            'iiqd_ivmsinspandapproval_fk' => 'Iiqd Vehicleinspandapproval Fk',
            'iiqd_auditquestionmst_fk' => 'Iiqd Auditquestionmst Fk',
            'iiqd_question_en' => 'Iiqd Question En',
            'iiqd_question_ar' => 'Iiqd Question Ar',
            'iiqd_order' => 'Iiqd Order',
            'iiqd_createdon' => 'Iiqd Createdon',
            'iiqd_createdby' => 'Iiqd Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvmsinspansdtlsTbls()
    {
        return $this->hasMany(IvmsinspansdtlsTbl::className(), ['iiad_rasvehinsponquesdtls_fk' => 'ivmsinspquesdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiqdAuditquestionmstFk()
    {
        return $this->hasOne(AuditquestionmstTbl::className(), ['auditquestionmst_pk' => 'iiqd_auditquestionmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiqdVehicleinspandapprovalFk()
    {
        return $this->hasOne(IvmsinspandapprovalTbl::className(), ['ivmsinspandapproval_pk' => 'iiqd_ivmsinspandapproval_fk']);
    }

    /**
     * {@inheritdoc}
     * @return IvmsinspquesdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IvmsinspquesdtlsTblQuery(get_called_class());
    }
}
