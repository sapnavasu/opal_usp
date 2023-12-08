<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "languagemst_tbl".
 *
 * @property int $LA_id
 * @property string $LA_Code
 * @property string $LA_Name
 * @property string $LA_Status
 * @property string $LA_Createdon
 */
class LanguagemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languagemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LA_Code', 'LA_Name'], 'required'],
            [['LA_Status'], 'string'],
            [['LA_Createdon'], 'safe'],
            [['LA_Code'], 'string', 'max' => 10],
            [['LA_Name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LA_id' => 'La ID',
            'LA_Code' => 'La  Code',
            'LA_Name' => 'La  Name',
            'LA_Status' => 'La  Status',
            'LA_Createdon' => 'La  Createdon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LanguagemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LanguagemstTblQuery(get_called_class());
    }
}
