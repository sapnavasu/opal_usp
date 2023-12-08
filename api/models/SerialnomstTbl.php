<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "serialnomst_tbl".
 *
 * @property int $serialnomst_pk
 * @property int $snm_serialnumber
 * @property int $snm_status 1 - Available, 2 - Taken
 * @property string $snm_takenon
 */
class SerialnomstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'serialnomst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['snm_serialnumber', 'snm_status', 'snm_takenon'], 'required'],
            [['snm_serialnumber', 'snm_status'], 'integer'],
            [['snm_takenon'], 'safe'],
            [['snm_serialnumber'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'serialnomst_pk' => 'Serialnomst Pk',
            'snm_serialnumber' => 'Snm Serialnumber',
            'snm_status' => 'Snm Status',
            'snm_takenon' => 'Snm Takenon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SerialnomstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SerialnomstTblQuery(get_called_class());
    }
}
