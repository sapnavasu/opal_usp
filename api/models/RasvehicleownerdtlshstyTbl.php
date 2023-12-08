<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rasvehicleownerdtlshsty_tbl".
 *
 * @property int $rasvehicleownerdtlshsty_pk
 * @property int $rvodh_rasvehicleownerdtls_fk Reference to rasvehicleownerdtls_pk
 * @property string $rvodh_ownername_en
 * @property string $rvodh_ownername_ar
 * @property string $rvodh_crnumber
 * @property int $rvodh_status 1-Active,2-Inactive default 1
 * @property string $rvodh_createdon
 * @property int $rvodh_createdby
 * @property string $rvodh_updatedon
 * @property int $rvodh_updatedby
 *
 * @property RasvehicleownerdtlsTbl $rvodhRasvehicleownerdtlsFk
 * @property RasvehicleregdtlshstyTbl[] $rasvehicleregdtlshstyTbls
 */
class RasvehicleownerdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rasvehicleownerdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rvodh_rasvehicleownerdtls_fk', 'rvodh_ownername_en', 'rvodh_ownername_ar', 'rvodh_crnumber', 'rvodh_createdon', 'rvodh_createdby'], 'required'],
            [['rvodh_rasvehicleownerdtls_fk', 'rvodh_status', 'rvodh_createdby', 'rvodh_updatedby'], 'integer'],
            [['rvodh_ownername_en', 'rvodh_ownername_ar', 'rvodh_crnumber'], 'string'],
            [['rvodh_createdon', 'rvodh_updatedon'], 'safe'],
            [['rvodh_rasvehicleownerdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehicleownerdtlsTbl::className(), 'targetAttribute' => ['rvodh_rasvehicleownerdtls_fk' => 'rasvehicleownerdtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rasvehicleownerdtlshsty_pk' => 'Rasvehicleownerdtlshsty Pk',
            'rvodh_rasvehicleownerdtls_fk' => 'Rvodh Rasvehicleownerdtls Fk',
            'rvodh_ownername_en' => 'Rvodh Ownername En',
            'rvodh_ownername_ar' => 'Rvodh Ownername Ar',
            'rvodh_crnumber' => 'Rvodh Crnumber',
            'rvodh_status' => 'Rvodh Status',
            'rvodh_createdon' => 'Rvodh Createdon',
            'rvodh_createdby' => 'Rvodh Createdby',
            'rvodh_updatedon' => 'Rvodh Updatedon',
            'rvodh_updatedby' => 'Rvodh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRvodhRasvehicleownerdtlsFk()
    {
        return $this->hasOne(RasvehicleownerdtlsTbl::className(), ['rasvehicleownerdtls_pk' => 'rvodh_rasvehicleownerdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasvehicleregdtlshstyTbls()
    {
        return $this->hasMany(RasvehicleregdtlshstyTbl::className(), ['rvrdh_rasvehicleownerdtlshsty_fk' => 'rasvehicleownerdtlshsty_pk']);
    }

    /**
     * {@inheritdoc}
     * @return RasvehicleownerdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RasvehicleownerdtlshstyTblQuery(get_called_class());
    }
    
    public static function movetohistory($data)
    {
        $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $model = new RasvehicleownerdtlshstyTbl();
        $model->rvodh_rasvehicleownerdtls_fk = $data->rasvehicleownerdtls_pk;
        $model->rvodh_ownername_en = $data->rvod_ownername_en;
        $model->rvodh_ownername_ar = $data->rvod_ownername_ar;
        $model->rvodh_crnumber = $data->rvod_crnumber;
        $model->rvodh_status = $data->rvod_status;
        $model->rvodh_createdon = date('Y-m-d H:i:s');
        $model->rvodh_createdby = $userpk;
        
        if($model->save())
        {
            return $model->rasvehicleownerdtlshsty_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
        
    }
}
