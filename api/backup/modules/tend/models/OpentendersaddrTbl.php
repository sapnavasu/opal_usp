<?php

namespace api\modules\tend\models;

use Yii;

/**
 * This is the model class for table "opentendersaddr_tbl".
 *
 * @property int $opentendersaddr_pk
 * @property int $ota_opentenders_fk Reference to opentenders_tbl
 * @property array $ota_addressdtls Address saved as JSON
 */
class OpentendersaddrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opentendersaddr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ota_opentenders_fk', 'ota_addressdtls'], 'required'],
            [['ota_opentenders_fk'], 'integer'],
            [['ota_addressdtls'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opentendersaddr_pk' => 'Opentendersaddr Pk',
            'ota_opentenders_fk' => 'Reference to opentenders_tbl',
            'ota_addressdtls' => 'Address saved as JSON',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OpentendersaddrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpentendersaddrTblQuery(get_called_class());
    }
}
