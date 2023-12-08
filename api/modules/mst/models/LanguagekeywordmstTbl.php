<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "languagekeywordmst_tbl".
 *
 * @property int $LAK_id
 * @property string $LAK_keyword
 * @property string $LAK_Createdon
 * @property string $LAK_Updatedon
 */
class LanguagekeywordmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languagekeywordmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LAK_keyword', 'LAK_Createdon', 'LAK_Updatedon'], 'required'],
            [['LAK_Createdon', 'LAK_Updatedon'], 'safe'],
            [['LAK_keyword'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LAK_id' => 'Lak ID',
            'LAK_keyword' => 'Lak Keyword',
            'LAK_Createdon' => 'Lak  Createdon',
            'LAK_Updatedon' => 'Lak  Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LanguagekeywordmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LanguagekeywordmstTblQuery(get_called_class());
    }
}
