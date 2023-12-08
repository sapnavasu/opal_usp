<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "industrialzonemst_tbl".
 *
 * @property int $industrialzonemst_pk
 * @property string $izm_zonename_en
 * @property string $izm_zonename_ar
 * @property int $izm_status Industrial Zone  status. A - Active, I - Inactive
 * @property string $izm_createdon
 * @property int $izm_createdby
 * @property string $izm_updatedon
 * @property int $izm_updatedby
 */
class IndustrialzonemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'industrialzonemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['izm_zonename_en', 'izm_zonename_ar', 'izm_status', 'izm_createdon', 'izm_createdby'], 'required'],
            [['izm_status', 'izm_createdby', 'izm_updatedby'], 'integer'],
            [['izm_createdon', 'izm_updatedon'], 'safe'],
            [['izm_zonename_en', 'izm_zonename_ar'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'industrialzonemst_pk' => 'Industrialzonemst Pk',
            'izm_zonename_en' => 'Izm Zonename En',
            'izm_zonename_ar' => 'Izm Zonename Ar',
            'izm_status' => 'Izm Status',
            'izm_createdon' => 'Izm Createdon',
            'izm_createdby' => 'Izm Createdby',
            'izm_updatedon' => 'Izm Updatedon',
            'izm_updatedby' => 'Izm Updatedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return IndustrialzonemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IndustrialzonemstTblQuery(get_called_class());
    }
}
