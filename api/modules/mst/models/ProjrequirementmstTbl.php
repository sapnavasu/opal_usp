<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "projrequirementmst_tbl".
 *
 * @property int $projrequirementmst_pk Primary key
 * @property string $prm_projrequirement Project Requirement
 * @property int $prm_status 1 - Active, 2 - Inactive
 * @property string $prm_createdon Date of creation
 * @property int $prm_createdby Reference to usermst_tbl
 * @property string $prm_createdbyipaddr IP Address of the user
 * @property string $prm_updatedon Date of updation
 * @property int $prm_updatedby Reference to usermst_tbl
 * @property string $prm_updatedbyipaddr IP Address of the user
 */
class ProjrequirementmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projrequirementmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prm_projrequirement', 'prm_status', 'prm_createdby'], 'required'],
            [['prm_status', 'prm_createdby', 'prm_updatedby'], 'integer'],
            [['prm_createdon', 'prm_updatedon'], 'safe'],
            [['prm_projrequirement', 'prm_createdbyipaddr', 'prm_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projrequirementmst_pk' => 'Projrequirementmst Pk',
            'prm_projrequirement' => 'Prm Projrequirement',
            'prm_status' => 'Prm Status',
            'prm_createdon' => 'Prm Createdon',
            'prm_createdby' => 'Prm Createdby',
            'prm_createdbyipaddr' => 'Prm Createdbyipaddr',
            'prm_updatedon' => 'Prm Updatedon',
            'prm_updatedby' => 'Prm Updatedby',
            'prm_updatedbyipaddr' => 'Prm Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjrequirementmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjrequirementmstTblQuery(get_called_class());
    }
}
