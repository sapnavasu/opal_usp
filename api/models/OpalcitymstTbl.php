<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opalcitymst_tbl".
 *
 * @property int $opalcitymst_pk primary key
 * @property int $ocim_opalcountrymst_Fk reference to opalcountrymst_tbl
 * @property int $ocim_opalstatemst_fk reference to opalstatemst_tbl
 * @property string $ocim_cityname_en city name english
 * @property string $ocim_cityname_ar city name arabic
 * @property string $ocim_citycode_en city code english
 * @property string $ocim_citycode_ar city code arabic
 * @property int $ocim_status city status. 1 - active, 2 - inactive
 * @property string $ocim_createdon datetime of creation
 * @property int $ocim_createdby reference to opalusermst_tbl
 * @property string $ocim_updatedon datetime of updation
 * @property int $ocim_updatedby reference to opalusermst_tbl
 *
 * @property OpalmemberregmstTbl[] $opalmemberregmstTbls
 */
class OpalcitymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalcitymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ocim_opalcountrymst_Fk', 'ocim_opalstatemst_fk', 'ocim_cityname_en', 'ocim_cityname_ar', 'ocim_status', 'ocim_createdon'], 'required'],
            [['ocim_opalcountrymst_Fk', 'ocim_opalstatemst_fk', 'ocim_status', 'ocim_createdby', 'ocim_updatedby'], 'integer'],
            [['ocim_createdon', 'ocim_updatedon'], 'safe'],
            [['ocim_cityname_en', 'ocim_cityname_ar'], 'string', 'max' => 150],
            [['ocim_citycode_en', 'ocim_citycode_ar'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalcitymst_pk' => 'Opalcitymst Pk',
            'ocim_opalcountrymst_Fk' => 'Ocim Opalcountrymst  Fk',
            'ocim_opalstatemst_fk' => 'Ocim Opalstatemst Fk',
            'ocim_cityname_en' => 'Ocim Cityname En',
            'ocim_cityname_ar' => 'Ocim Cityname Ar',
            'ocim_citycode_en' => 'Ocim Citycode En',
            'ocim_citycode_ar' => 'Ocim Citycode Ar',
            'ocim_status' => 'Ocim Status',
            'ocim_createdon' => 'Ocim Createdon',
            'ocim_createdby' => 'Ocim Createdby',
            'ocim_updatedon' => 'Ocim Updatedon',
            'ocim_updatedby' => 'Ocim Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpalmemberregmstTbls()
    {
        return $this->hasMany(OpalmemberregmstTbl::className(), ['oum_opalcitymst_fk' => 'opalcitymst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return OpalcitymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalcitymstTblQuery(get_called_class());
    }
}
