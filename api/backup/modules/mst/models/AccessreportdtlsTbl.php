<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "accessreportdtls_tbl".
 *
 * @property int $accessreportdtls_pk Used as primary key
 * @property int $ard_publicationtype 1 - OBG, 2 - TBY
 * @property int $ard_memcompmst_fk Reference to membercompanymst_tbl
 * @property string $ard_createdon Datetime of creation
 * @property int $ard_createdby Reference to usermst_tbl
 */
class AccessreportdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accessreportdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ard_publicationtype', 'ard_memcompmst_fk', 'ard_createdon', 'ard_createdby'], 'required'],
            [['ard_publicationtype', 'ard_memcompmst_fk', 'ard_createdby'], 'integer'],
            [['ard_createdon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'accessreportdtls_pk' => 'Accessreportdtls Pk',
            'ard_publicationtype' => 'Ard Publicationtype',
            'ard_memcompmst_fk' => 'Ard Memcompmst Fk',
            'ard_createdon' => 'Ard Createdon',
            'ard_createdby' => 'Ard Createdby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AccessreportdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccessreportdtlsTblQuery(get_called_class());
    }
}
