<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "industrialestatemst_tbl".
 *
 * @property int $industrialestatemst_pk
 * @property int $iem_industrialzonemst_fk reference to industrialzonemst_tbl.industrialzonemst_pk
 * @property string $iem_estatename_en
 * @property string $iem_estatename_ar
 * @property int $iem_status Industrial Estate status. A - Active, I - Inactive
 * @property string $iem_createdon
 * @property int $iem_createdby
 * @property string $iem_updatedon
 * @property int $iem_updatedby
 */
class IndustrialestatemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'industrialestatemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iem_industrialzonemst_fk', 'iem_estatename_en', 'iem_estatename_ar', 'iem_status', 'iem_createdon', 'iem_createdby'], 'required'],
            [['iem_industrialzonemst_fk', 'iem_status', 'iem_createdby', 'iem_updatedby'], 'integer'],
            [['iem_createdon', 'iem_updatedon'], 'safe'],
            [['iem_estatename_en', 'iem_estatename_ar'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'industrialestatemst_pk' => 'Industrialestatemst Pk',
            'iem_industrialzonemst_fk' => 'Iem Industrialzonemst Fk',
            'iem_estatename_en' => 'Iem Estatename En',
            'iem_estatename_ar' => 'Iem Estatename Ar',
            'iem_status' => 'Iem Status',
            'iem_createdon' => 'Iem Createdon',
            'iem_createdby' => 'Iem Createdby',
            'iem_updatedon' => 'Iem Updatedon',
            'iem_updatedby' => 'Iem Updatedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return IndustrialestatemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IndustrialestatemstTblQuery(get_called_class());
    }
}
