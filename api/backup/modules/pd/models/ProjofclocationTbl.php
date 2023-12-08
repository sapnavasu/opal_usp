<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projofclocation_tbl".
 *
 * @property int $projofclocation_pk
 * @property int $pol_projectdtls_fk Reference to projectdtls_tbl
 * @property string $pol_addressline Address of the user
 * @property string $pol_latitude Latitude
 * @property string $pol_longitude Longitude
 * @property int $pol_statemst_fk Reference to statemst_tbl
 * @property int $pol_citymst_fk Reference to citymst_tbl
 * @property string $pol_createdon Date of Creation
 * @property int $pol_createdby Created by user id
 * @property string $pol_createdbyipaddr Created by user's IP Address
 * @property string $pol_updatedon Date of Update
 * @property int $pol_updatedby Updated by user id
 * @property string $pol_updatedbyipaddr Updated by user's IP Address
 */
class ProjofclocationTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projofclocation_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pol_projectdtls_fk', 'pol_addressline', 'pol_latitude', 'pol_longitude', 'pol_statemst_fk', 'pol_citymst_fk', 'pol_createdby'], 'required'],
            [['pol_projectdtls_fk', 'pol_statemst_fk', 'pol_citymst_fk', 'pol_createdby', 'pol_updatedby'], 'integer'],
            [['pol_addressline'], 'string'],
            [['pol_latitude', 'pol_longitude'], 'number'],
            [['pol_createdon', 'pol_updatedon'], 'safe'],
            [['pol_createdbyipaddr', 'pol_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projofclocation_pk' => 'Projofclocation Pk',
            'pol_projectdtls_fk' => 'Pol Projectdtls Fk',
            'pol_addressline' => 'Pol Addressline',
            'pol_latitude' => 'Pol Latitude',
            'pol_longitude' => 'Pol Longitude',
            'pol_statemst_fk' => 'Pol Statemst Fk',
            'pol_citymst_fk' => 'Pol Citymst Fk',
            'pol_createdon' => 'Pol Createdon',
            'pol_createdby' => 'Pol Createdby',
            'pol_createdbyipaddr' => 'Pol Createdbyipaddr',
            'pol_updatedon' => 'Pol Updatedon',
            'pol_updatedby' => 'Pol Updatedby',
            'pol_updatedbyipaddr' => 'Pol Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjofclocationTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjofclocationTblQuery(get_called_class());
    }
}
