<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ivmsinspansdtlshsty_tbl".
 *
 * @property int $ivmsinspansdtlshsty_pk
 * @property int $iiadh_ivmsinspansdtls_pk Reference to ivmsinspansdtls_pk
 * @property int $iiadh_ivmsinspquesdtlshsty_fk  Reference to ivmsinspquesdtlshsty_pk
 * @property int $iiadh_auditanswerdtls_fk  Reference to auditanswerdtls_pk
 * @property string $iiadh_answer_en  Label name for the answer (if text-field)
 * @property string $iiadh_answer_ar  Label name for the answer (if text-field)
 * @property int $iiadh_order  Order of answers to be displayed
 * @property string $iiadh_details  Details added by the user against the respective Label
 * @property int $iiadh_isselected  1-Yes, 2-No Default 2
 * @property string $iiadh_comments
 * @property string $iiadh_fileupload Reference to memcompfiledtls_pk
 * @property string $iiadh_createdon
 * @property int $iiadh_createdby
 *
 * @property AuditanswerdtlsTbl $iiadhAuditanswerdtlsFk
 * @property IvmsinspansdtlsTbl $iiadhIvmsinspansdtlsPk
 * @property IvmsinspquesdtlshstyTbl $iiadhIvmsinspquesdtlshstyFk
 */
class IvmsinspansdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivmsinspansdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iiadh_ivmsinspansdtls_pk', 'iiadh_ivmsinspquesdtlshsty_fk', 'iiadh_auditanswerdtls_fk', 'iiadh_answer_en', 'iiadh_answer_ar', 'iiadh_order', 'iiadh_createdby'], 'required'],
            [['iiadh_ivmsinspansdtls_pk', 'iiadh_ivmsinspquesdtlshsty_fk', 'iiadh_auditanswerdtls_fk', 'iiadh_order', 'iiadh_isselected', 'iiadh_createdby'], 'integer'],
            [['iiadh_answer_en', 'iiadh_answer_ar', 'iiadh_details', 'iiadh_comments', 'iiadh_fileupload'], 'string'],
            [['iiadh_createdon'], 'safe'],
            [['iiadh_auditanswerdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AuditanswerdtlsTbl::className(), 'targetAttribute' => ['iiadh_auditanswerdtls_fk' => 'auditanswerdtls_pk']],
            [['iiadh_ivmsinspansdtls_pk'], 'exist', 'skipOnError' => true, 'targetClass' => IvmsinspansdtlsTbl::className(), 'targetAttribute' => ['iiadh_ivmsinspansdtls_pk' => 'ivmsinspansdtls_pk']],
            [['iiadh_ivmsinspquesdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IvmsinspquesdtlshstyTbl::className(), 'targetAttribute' => ['iiadh_ivmsinspquesdtlshsty_fk' => 'ivmsinspquesdtlshsty_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ivmsinspansdtlshsty_pk' => 'Ivmsinspansdtlshsty Pk',
            'iiadh_ivmsinspansdtls_pk' => 'Iiadh Ivmsinspansdtls Pk',
            'iiadh_ivmsinspquesdtlshsty_fk' => 'Iiadh Ivmsinspquesdtlshsty Fk',
            'iiadh_auditanswerdtls_fk' => 'Iiadh Auditanswerdtls Fk',
            'iiadh_answer_en' => 'Iiadh Answer En',
            'iiadh_answer_ar' => 'Iiadh Answer Ar',
            'iiadh_order' => 'Iiadh Order',
            'iiadh_details' => 'Iiadh Details',
            'iiadh_isselected' => 'Iiadh Isselected',
            'iiadh_comments' => 'Iiadh Comments',
            'iiadh_fileupload' => 'Iiadh Fileupload',
            'iiadh_createdon' => 'Iiadh Createdon',
            'iiadh_createdby' => 'Iiadh Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiadhAuditanswerdtlsFk()
    {
        return $this->hasOne(AuditanswerdtlsTbl::className(), ['auditanswerdtls_pk' => 'iiadh_auditanswerdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiadhIvmsinspansdtlsPk()
    {
        return $this->hasOne(IvmsinspansdtlsTbl::className(), ['ivmsinspansdtls_pk' => 'iiadh_ivmsinspansdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIiadhIvmsinspquesdtlshstyFk()
    {
        return $this->hasOne(IvmsinspquesdtlshstyTbl::className(), ['ivmsinspquesdtlshsty_pk' => 'iiadh_ivmsinspquesdtlshsty_fk']);
    }

    /**
     * {@inheritdoc}
     * @return IvmsinspansdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IvmsinspansdtlshstyTblQuery(get_called_class());
    }
    
    public static function movetohistory($data)
    {
        
        $queshst = IvmsinspquesdtlshstyTbl::find()->where(['iiqdh_ivmsinspquesdtls_fk'=> $data->iiad_ivmsinspquesdtls_fk ])->orderBy('ivmsinspquesdtlshsty_pk desc')->one()['ivmsinspquesdtlshsty_pk'];
        
        $model = new IvmsinspansdtlshstyTbl();
        $model->iiadh_ivmsinspansdtls_pk = $data->ivmsinspansdtls_pk;
        $model->iiadh_ivmsinspquesdtlshsty_fk = $queshst;
        $model->iiadh_auditanswerdtls_fk = $data->iiad_auditanswerdtls_fk;
        $model->iiadh_answer_en = $data->iiad_answer_en;
        $model->iiadh_answer_ar = $data->iiad_answer_ar;
        $model->iiadh_order = $data->iiad_order;
        $model->iiadh_details = $data->iiad_details;
        $model->iiadh_isselected = $data->iiad_isselected;
        $model->iiadh_comments = $data->iiad_comments;
        $model->iiadh_fileupload = $data->iiad_fileupload;
        $model->iiadh_createdon = $data->iiad_createdon;
        $model->iiadh_createdby = $data->iiad_createdby;
        
        if($model->save())
        {
            return $model->ivmsinspansdtlshsty_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
        
            
    }
}
