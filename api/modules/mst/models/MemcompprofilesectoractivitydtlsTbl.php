<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompsectoractivitydtls_tbl".
 *
 * @property int $MemCompSecActDtls_Pk
 * @property int $MCSAD_MemCompSecDtls_Fk
 * @property int $mcsad_activitiesmst_fk
 */
class MemcompprofilesectoractivitydtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompsectoractivitydtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MCSAD_MemCompSecDtls_Fk', 'mcsad_activitiesmst_fk'], 'required'],
            [['MCSAD_MemCompSecDtls_Fk', 'mcsad_activitiesmst_fk'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MemCompSecActDtls_Pk' => 'Mem Comp Sec Act Dtls  Pk',
            'MCSAD_MemCompSecDtls_Fk' => 'Mcsad  Mem Comp Sec Dtls  Fk',
            'mcsad_activitiesmst_fk' => 'Mcsad  Activities Mst  Fk',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompprofilesectoractivitydtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompprofilesectoractivitydtlsTblQuery(get_called_class());
    }

    public function getActivity()
    {
        return $this->hasOne(ActivitiesmstTbl::className(),['ActivitiesMst_Pk'=>'mcsad_activitiesmst_fk']);
    }

}
