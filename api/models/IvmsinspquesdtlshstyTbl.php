<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ivmsinspquesdtlshsty_tbl".
 *
 * @property int $ivmsinspquesdtlshsty_pk
 * @property int $iiqdh_ivmsinspquesdtls_fk Reference to ivmsinspquesdtls_pk
 * @property int $iiqdh_ivmsinspandapprovalhsty_pk  Reference to ivmsinspandapprovalhsty_pk
 * @property int $iiqdh_auditquestionmst_fk  Reference to auditquestionmst_pk
 * @property string $iiqdh_question_en
 * @property string $iiqdh_question_ar
 * @property int $iiqdh_order  Order of question to be displayed
 * @property string $iiqdh_createdon
 * @property int $iiqdh_createdby
 *
 * @property IvmsinspansdtlshstyTbl[] $ivmsinspansdtlshstyTbls
 * @property AuditquestionmstTbl $iiqdhAuditquestionmstFk
 * @property IvmsinspquesdtlsTbl $iiqdhIvmsinspquesdtlsFk
 * @property IvmsinspandapprovalhstyTbl $iiqdhIvmsinspandapprovalhstyPk
 */
class IvmsinspquesdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivmsinspquesdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iiqdh_ivmsinspquesdtls_fk', 'iiqdh_ivmsinspandapprovalhsty_pk', 'iiqdh_auditquestionmst_fk', 'iiqdh_question_en', 'iiqdh_question_ar', 'iiqdh_order', 'iiqdh_createdby'], 'required'],
            [['iiqdh_ivmsinspquesdtls_fk', 'iiqdh_ivmsinspandapprovalhsty_pk', 'iiqdh_auditquestionmst_fk', 'iiqdh_order', 'iiqdh_createdby'], 'integer'],
            [['iiqdh_question_en', 'iiqdh_question_ar'], 'string'],
            [['iiqdh_createdon'], 'safe'],
            [['iiqdh_auditquestionmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AuditquestionmstTbl::className(), 'targetAttribute' => ['iiqdh_auditquestionmst_fk' => 'auditquestionmst_pk']],
            [['iiqdh_ivmsinspquesdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IvmsinspquesdtlsTbl::className(), 'targetAttribute' => ['iiqdh_ivmsinspquesdtls_fk' => 'ivmsinspquesdtls_pk']],
            [['iiqdh_ivmsinspandapprovalhsty_pk'], 'exist', 'skipOnError' => true, 'targetClass' => IvmsinspandapprovalhstyTbl::className(), 'targetAttribute' => ['iiqdh_ivmsinspandapprovalhsty_pk' => 'ivmsinspandapprovalhsty_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ivmsinspquesdtlshsty_pk' => 'Ivmsinspquesdtlshsty Pk',
            'iiqdh_ivmsinspquesdtls_fk' => 'Iiqdh Ivmsinspquesdtls Fk',
            'iiqdh_ivmsinspandapprovalhsty_pk' => 'Iiqdh Ivmsinspandapprovalhsty Pk',
            'iiqdh_auditquestionmst_fk' => 'Iiqdh Auditquestionmst Fk',
            'iiqdh_question_en' => 'Iiqdh Question En',
            'iiqdh_question_ar' => 'Iiqdh Question Ar',
            'iiqdh_order' => 'Iiqdh Order',
            'iiqdh_createdon' => 'Iiqdh Createdon',
            'iiqdh_createdby' => 'Iiqdh Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvmsinspansdtlshstyTbls()
    {
        return $this->hasMany(IvmsinspansdtlshstyTbl::className(), ['iiadh_ivmsinspquesdtlshsty_fk' => 'ivmsinspquesdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiqdhAuditquestionmstFk()
    {
        return $this->hasOne(AuditquestionmstTbl::className(), ['auditquestionmst_pk' => 'iiqdh_auditquestionmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiqdhIvmsinspquesdtlsFk()
    {
        return $this->hasOne(IvmsinspquesdtlsTbl::className(), ['ivmsinspquesdtls_pk' => 'iiqdh_ivmsinspquesdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiqdhIvmsinspandapprovalhstyPk()
    {
        return $this->hasOne(IvmsinspandapprovalhstyTbl::className(), ['ivmsinspandapprovalhsty_pk' => 'iiqdh_ivmsinspandapprovalhsty_pk']);
    }

    /**
     * {@inheritdoc}
     * @return IvmsinspquesdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IvmsinspquesdtlshstyTblQuery(get_called_class());
    }
    
    public static function movetohistory($data)
    {
        
        $histpk = IvmsinspandapprovalhstyTbl::find()->where(['iiah_ivmsinspandapproval_fk' => $data->iiqd_ivmsinspandapproval_fk])->orderBy('ivmsinspandapprovalhsty_pk desc')->one()['ivmsinspandapprovalhsty_pk'];
        $model = new IvmsinspquesdtlshstyTbl();
        
        $model->iiqdh_ivmsinspquesdtls_fk = $data->ivmsinspquesdtls_pk;
        $model->iiqdh_ivmsinspandapprovalhsty_pk = $histpk;
        $model->iiqdh_auditquestionmst_fk = $data->iiqd_auditquestionmst_fk;
        $model->iiqdh_question_en = $data->iiqd_question_en;
        $model->iiqdh_question_ar = $data->iiqd_question_ar;
        $model->iiqdh_order = $data->iiqd_order;
        $model->iiqdh_createdon = $data->iiqd_createdon;
        $model->iiqdh_createdby = $data->iiqd_createdby;
        
        if($model->save())
        {
            return $model->ivmsinspquesdtlshsty_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
}
