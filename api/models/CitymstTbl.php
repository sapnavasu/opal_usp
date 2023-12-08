<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "citymst_tbl".
 *
 * @property int $citymst_pk
 * @property string $cm_cityname_en
 * @property string $cm_cityname_ar
 * @property int $cm_status 1-Active, 2-Inactive
 * @property string $cm_createdon
 * @property int $cm_createdby
 * @property string $cm_updatedon
 * @property int $cm_updatedby
 *
 * @property AppinstinfotmpTbl[] $appinstinfotmpTbls
 */
class CitymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'citymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cm_cityname_en', 'cm_cityname_ar', 'cm_status', 'cm_createdon', 'cm_createdby'], 'required'],
            [['cm_status', 'cm_createdby', 'cm_updatedby'], 'integer'],
            [['cm_createdon', 'cm_updatedon'], 'safe'],
            [['cm_cityname_en', 'cm_cityname_ar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'citymst_pk' => 'Citymst Pk',
            'cm_cityname_en' => 'Cm Cityname En',
            'cm_cityname_ar' => 'Cm Cityname Ar',
            'cm_status' => 'Cm Status',
            'cm_createdon' => 'Cm Createdon',
            'cm_createdby' => 'Cm Createdby',
            'cm_updatedon' => 'Cm Updatedon',
            'cm_updatedby' => 'Cm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppinstinfotmpTbls()
    {
        return $this->hasMany(AppinstinfotmpTbl::className(), ['appiit_citymst_fk' => 'citymst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CitymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CitymstTblQuery(get_called_class());
    }
}
