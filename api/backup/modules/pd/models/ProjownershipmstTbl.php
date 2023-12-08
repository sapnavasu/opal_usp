<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projownershipmst_tbl".
 *
 * @property int $projownershipmst_pk Primary key
 * @property string $posm_ownership Project Ownership
 * @property int $posm_status 1 - Active, 2 - Inactive
 * @property string $posm_createdon Date of creation
 * @property int $posm_createdby Reference to usermst_tbl
 * @property string $posm_createdbyipaddr IP Address of the user
 * @property string $posm_updatedon Date of updation
 * @property int $posm_updatedby Reference to usermst_tbl
 * @property string $posm_updatedbyipaddr IP Address of the user
 */
class ProjownershipmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projownershipmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['posm_ownership', 'posm_status', 'posm_createdby'], 'required'],
            [['posm_status', 'posm_createdby', 'posm_updatedby'], 'integer'],
            [['posm_createdon', 'posm_updatedon'], 'safe'],
            [['posm_ownership', 'posm_createdbyipaddr', 'posm_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projownershipmst_pk' => 'Projownershipmst Pk',
            'posm_ownership' => 'Posm Ownership',
            'posm_status' => 'Posm Status',
            'posm_createdon' => 'Posm Createdon',
            'posm_createdby' => 'Posm Createdby',
            'posm_createdbyipaddr' => 'Posm Createdbyipaddr',
            'posm_updatedon' => 'Posm Updatedon',
            'posm_updatedby' => 'Posm Updatedby',
            'posm_updatedbyipaddr' => 'Posm Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjownershipmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjownershipmstTblQuery(get_called_class());
    }
}
