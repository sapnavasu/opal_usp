<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rasvehinsponansdtls_tbl".
 *
 * @property int $rasvehinsponansdtls_pk
 * @property int $rviad_rasvehinsponquesdtls_fk Reference to rasvehinsponquesdtls_pk
 * @property string $rviad_answer_en
 * @property string $rviad_answer_ar
 * @property int $rviad_order Order of answers to be displayed
 * @property int $rviad_isselected 1-Yes, 2-No Default 2
 * @property string $rviad_comments
 * @property int $rviad_fileupload Reference to memcompfiledtls_pk
 * @property string $rviad_createdon
 * @property int $rviad_createdby
 *
 * @property RasvehinsponquesdtlsTbl $rviadRasvehinsponquesdtlsFk
 * @property RasvehinsponansdtlshstyTbl[] $rasvehinsponansdtlshstyTbls
 */
class RasvehinsponansdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rasvehinsponansdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rviad_rasvehinsponquesdtls_fk', 'rviad_answer_en', 'rviad_answer_ar', 'rviad_order', 'rviad_isselected', 'rviad_createdby'], 'required'],
            [['rviad_rasvehinsponquesdtls_fk', 'rviad_order', 'rviad_isselected',  'rviad_createdby'], 'integer'],
            [['rviad_answer_en', 'rviad_answer_ar', 'rviad_comments','rviad_fileupload'], 'string'],
            [['rviad_createdon'], 'safe'],
            [['rviad_rasvehinsponquesdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehinsponquesdtlsTbl::className(), 'targetAttribute' => ['rviad_rasvehinsponquesdtls_fk' => 'rasvehinsponquesdtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rasvehinsponansdtls_pk' => 'Rasvehinsponansdtls Pk',
            'rviad_rasvehinsponquesdtls_fk' => 'Rviad Rasvehinsponquesdtls Fk',
            'rviad_answer_en' => 'Rviad Answer En',
            'rviad_answer_ar' => 'Rviad Answer Ar',
            'rviad_order' => 'Rviad Order',
            'rviad_isselected' => 'Rviad Isselected',
            'rviad_comments' => 'Rviad Comments',
            'rviad_fileupload' => 'Rviad Fileupload',
            'rviad_createdon' => 'Rviad Createdon',
            'rviad_createdby' => 'Rviad Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRviadRasvehinsponquesdtlsFk()
    {
        return $this->hasOne(RasvehinsponquesdtlsTbl::className(), ['rasvehinsponquesdtls_pk' => 'rviad_rasvehinsponquesdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasvehinsponansdtlshstyTbls()
    {
        return $this->hasMany(RasvehinsponansdtlshstyTbl::className(), ['rviadh_rasvehinsponansdtls_fk' => 'rasvehinsponansdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return RasvehinsponansdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RasvehinsponansdtlsTblQuery(get_called_class());
    }
}

