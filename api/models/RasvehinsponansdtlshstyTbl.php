<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rasvehinsponansdtlshsty_tbl".
 *
 * @property int $rasvehinsponansdtlshsty_pk
 * @property int $rviadh_rasvehinsponansdtls_fk Reference to rasvehinsponansdtls_pk
 * @property int $rviadh_rasvehinsponquesdtlshsty_fk Reference to rasvehinsponquesdtlshsty_pk
 * @property int $rviadh_auditanswerdtls_fk
 * @property string $rviadh_answer_en
 * @property string $rviadh_answer_ar
 * @property int $rviadh_order Order of answers to be displayed
 * @property int $rviadh_isselected 1-Yes, 2-No Default 2
 * @property string $rviadh_comments
 * @property string $rviadh_fileupload Reference to memcompfiledtls_pk
 * @property string $rviadh_createdon
 * @property int $rviadh_createdby
 *
 * @property RasvehinsponquesdtlshstyTbl $rviadhRasvehinsponquesdtlshstyFk
 * @property AuditanswerdtlsTbl $rviadhAuditanswerdtlsFk
 * @property RasvehinsponansdtlsTbl $rviadhRasvehinsponansdtlsFk
 */
class RasvehinsponansdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rasvehinsponansdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rviadh_rasvehinsponansdtls_fk', 'rviadh_rasvehinsponquesdtlshsty_fk', 'rviadh_auditanswerdtls_fk', 'rviadh_answer_en', 'rviadh_answer_ar', 'rviadh_order', 'rviadh_isselected', 'rviadh_createdby'], 'required'],
            [['rviadh_rasvehinsponansdtls_fk', 'rviadh_rasvehinsponquesdtlshsty_fk', 'rviadh_auditanswerdtls_fk', 'rviadh_order', 'rviadh_isselected', 'rviadh_createdby'], 'integer'],
            [['rviadh_answer_en', 'rviadh_answer_ar', 'rviadh_comments', 'rviadh_fileupload'], 'string'],
            [['rviadh_createdon'], 'safe'],
            [['rviadh_rasvehinsponquesdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehinsponquesdtlshstyTbl::className(), 'targetAttribute' => ['rviadh_rasvehinsponquesdtlshsty_fk' => 'rasvehinsponquesdtlshsty_pk']],
            [['rviadh_auditanswerdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AuditanswerdtlsTbl::className(), 'targetAttribute' => ['rviadh_auditanswerdtls_fk' => 'auditanswerdtls_pk']],
            [['rviadh_rasvehinsponansdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehinsponansdtlsTbl::className(), 'targetAttribute' => ['rviadh_rasvehinsponansdtls_fk' => 'rasvehinsponansdtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rasvehinsponansdtlshsty_pk' => 'Rasvehinsponansdtlshsty Pk',
            'rviadh_rasvehinsponansdtls_fk' => 'Rviadh Rasvehinsponansdtls Fk',
            'rviadh_rasvehinsponquesdtlshsty_fk' => 'Rviadh Rasvehinsponquesdtlshsty Fk',
            'rviadh_auditanswerdtls_fk' => 'Rviadh Auditanswerdtls Fk',
            'rviadh_answer_en' => 'Rviadh Answer En',
            'rviadh_answer_ar' => 'Rviadh Answer Ar',
            'rviadh_order' => 'Rviadh Order',
            'rviadh_isselected' => 'Rviadh Isselected',
            'rviadh_comments' => 'Rviadh Comments',
            'rviadh_fileupload' => 'Rviadh Fileupload',
            'rviadh_createdon' => 'Rviadh Createdon',
            'rviadh_createdby' => 'Rviadh Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRviadhRasvehinsponquesdtlshstyFk()
    {
        return $this->hasOne(RasvehinsponquesdtlshstyTbl::className(), ['rasvehinsponquesdtlshsty_pk' => 'rviadh_rasvehinsponquesdtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRviadhAuditanswerdtlsFk()
    {
        return $this->hasOne(AuditanswerdtlsTbl::className(), ['auditanswerdtls_pk' => 'rviadh_auditanswerdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRviadhRasvehinsponansdtlsFk()
    {
        return $this->hasOne(RasvehinsponansdtlsTbl::className(), ['rasvehinsponansdtls_pk' => 'rviadh_rasvehinsponansdtls_fk']);
    }

    /**
     * {@inheritdoc}
     * @return RasvehinsponansdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RasvehinsponansdtlshstyTblQuery(get_called_class());
    }
    
    public static function movetohistory($data)
    {
        
        $queshst = RasvehinsponquesdtlshstyTbl::find()->where(['rviqdh_rasvehinsponquesdtls_fk'=> $data->rviad_rasvehinsponquesdtls_fk ])->orderBy('rasvehinsponquesdtlshsty_pk desc')->one()['rasvehinsponquesdtlshsty_pk'];
        
        $model = new RasvehinsponansdtlshstyTbl();
        $model->rviadh_rasvehinsponansdtls_fk = $data->rasvehinsponansdtls_pk;
        $model->rviadh_rasvehinsponquesdtlshsty_fk = $queshst;
        $model->rviadh_auditanswerdtls_fk = $data->rviad_auditanswerdtls_fk;
        $model->rviadh_answer_ar = $data->rviad_answer_ar;
        $model->rviadh_answer_en = $data->rviad_answer_en;
        $model->rviadh_order = $data->rviad_order;
        $model->rviadh_isselected = $data->rviad_isselected;
        $model->rviadh_comments = $data->rviad_comments;
        $model->rviadh_fileupload = $data->rviad_fileupload;
        $model->rviadh_createdon = $data->rviad_createdon;
        $model->rviadh_createdby = $data->rviad_createdby;
        
        if($model->save())
        {
            return $model->rasvehinsponansdtlshsty_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
        
            
    }
}
