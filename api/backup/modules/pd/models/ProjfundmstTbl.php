<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projfundmst_tbl".
 *
 * @property int $projfundmst_pk Primary key
 * @property string $pfm_fundedby Project funded by name
 * @property int $pfm_status 1 - Active, 2 - Inactive
 * @property string $pfm_createdon Date of creation
 * @property int $pfm_createdby Reference to usermst_tbl
 * @property string $pfm_createdbyipaddr IP Address of the user
 */
class ProjfundmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projfundmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pfm_fundedby', 'pfm_status', 'pfm_createdon', 'pfm_createdby'], 'required'],
            [['pfm_status', 'pfm_createdby'], 'integer'],
            [['pfm_createdon'], 'safe'],
            [['pfm_fundedby'], 'string', 'max' => 80],
            [['pfm_createdbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projfundmst_pk' => 'Projfundmst Pk',
            'pfm_fundedby' => 'Pfm Fundedby',
            'pfm_status' => 'Pfm Status',
            'pfm_createdon' => 'Pfm Createdon',
            'pfm_createdby' => 'Pfm Createdby',
            'pfm_createdbyipaddr' => 'Pfm Createdbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjfundmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjfundmstTblQuery(get_called_class());
    }
}
