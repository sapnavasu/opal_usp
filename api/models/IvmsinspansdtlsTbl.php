<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ivmsinspansdtls_tbl".
 *
 * @property int $ivmsinspansdtls_pk
 * @property int $iiad_ivmsinspquesdtls_fk Reference to ivmsinspquesdtls_pk
 * @property int $iiad_auditanswerdtls_fk Reference to auditanswerdtls_pk
 * @property string $iiad_answer_en Label name for the answer (if text-field)
 * @property string $iiad_answer_ar Label name for the answer (if text-field)
 * @property int $iiad_order Order of answers to be displayed
 * @property string $iiad_details Details added by the user against the respective Label
 * @property int $iiad_isselected NULL 1-Yes, 2-No Default 2
 * @property string $iiad_comments
 * @property string $iiad_fileupload Reference to memcompfiledtls_pk
 * @property string $iiad_createdon
 * @property int $iiad_createdby
 *
 * @property AuditanswerdtlsTbl $iiadAuditanswerdtlsFk
 * @property IvmsinspquesdtlsTbl $iiadIvmsinspquesdtlsFk
 * @property IvmsinspansdtlshstyTbl[] $ivmsinspansdtlshstyTbls
 */
class IvmsinspansdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivmsinspansdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iiad_ivmsinspquesdtls_fk', 'iiad_auditanswerdtls_fk', 'iiad_answer_en', 'iiad_answer_ar', 'iiad_order', 'iiad_createdby'], 'required'],
            [['iiad_ivmsinspquesdtls_fk', 'iiad_auditanswerdtls_fk', 'iiad_order', 'iiad_isselected', 'iiad_createdby'], 'integer'],
            [['iiad_answer_en', 'iiad_answer_ar', 'iiad_details', 'iiad_comments', 'iiad_fileupload'], 'string'],
            [['iiad_createdon'], 'safe'],
            [['iiad_auditanswerdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AuditanswerdtlsTbl::className(), 'targetAttribute' => ['iiad_auditanswerdtls_fk' => 'auditanswerdtls_pk']],
            [['iiad_ivmsinspquesdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IvmsinspquesdtlsTbl::className(), 'targetAttribute' => ['iiad_ivmsinspquesdtls_fk' => 'ivmsinspquesdtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ivmsinspansdtls_pk' => 'Ivmsinspansdtls Pk',
            'iiad_ivmsinspquesdtls_fk' => 'Iiad Ivmsinspquesdtls Fk',
            'iiad_auditanswerdtls_fk' => 'Iiad Auditanswerdtls Fk',
            'iiad_answer_en' => 'Iiad Answer En',
            'iiad_answer_ar' => 'Iiad Answer Ar',
            'iiad_order' => 'Iiad Order',
            'iiad_details' => 'Iiad Details',
            'iiad_isselected' => 'Iiad Isselected',
            'iiad_comments' => 'Iiad Comments',
            'iiad_fileupload' => 'Iiad Fileupload',
            'iiad_createdon' => 'Iiad Createdon',
            'iiad_createdby' => 'Iiad Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiadAuditanswerdtlsFk()
    {
        return $this->hasOne(AuditanswerdtlsTbl::className(), ['auditanswerdtls_pk' => 'iiad_auditanswerdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiadIvmsinspquesdtlsFk()
    {
        return $this->hasOne(IvmsinspquesdtlsTbl::className(), ['ivmsinspquesdtls_pk' => 'iiad_ivmsinspquesdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvmsinspansdtlshstyTbls()
    {
        return $this->hasMany(IvmsinspansdtlshstyTbl::className(), ['iiadh_ivmsinspansdtls_pk' => 'ivmsinspansdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return IvmsinspansdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IvmsinspansdtlsTblQuery(get_called_class());
    }
}
