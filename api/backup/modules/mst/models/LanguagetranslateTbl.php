<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "languagetranslate_tbl".
 *
 * @property int $LAT_id
 * @property int $LAT_keyfk
 * @property int $LAT_lanfk
 * @property int $LAT_value
 */
class LanguagetranslateTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languagetranslate_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LAT_keyfk', 'LAT_lanfk', 'LAT_value'], 'required'],
            [['LAT_keyfk', 'LAT_lanfk'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LAT_id' => 'Lat ID',
            'LAT_keyfk' => 'Lat Keyfk',
            'LAT_lanfk' => 'Lat Lanfk',
            'LAT_value' => 'Lat Value',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LanguagetranslateTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LanguagetranslateTblQuery(get_called_class());
    }
}
