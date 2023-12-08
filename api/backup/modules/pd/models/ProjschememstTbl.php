<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projschememst_tbl".
 *
 * @property int $projschememst_pk Primary key
 * @property int $psm_schemetype 1 - Central, 2 - State, 3 - Central Others, 4 - State Others
 * @property string $psm_schemename Scheme Name
 * @property int $psm_status 1 - Active, 2 - Inactive
 * @property string $psm_createdon Date of creation
 * @property int $psm_createdby Reference to usermst_tbl
 * @property string $psm_createdbyipaddr IP Address of the user
 */
class ProjschememstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projschememst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['psm_schemetype', 'psm_status', 'psm_createdon', 'psm_createdby'], 'required'],
            [['psm_schemetype', 'psm_status', 'psm_createdby'], 'integer'],
            [['psm_createdon'], 'safe'],
            [['psm_schemename', 'psm_createdbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projschememst_pk' => 'Projschememst Pk',
            'psm_schemetype' => 'Psm Schemetype',
            'psm_schemename' => 'Psm Schemename',
            'psm_status' => 'Psm Status',
            'psm_createdon' => 'Psm Createdon',
            'psm_createdby' => 'Psm Createdby',
            'psm_createdbyipaddr' => 'Psm Createdbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjschememstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjschememstTblQuery(get_called_class());
    }
}
