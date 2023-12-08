<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projsusdevelopgoalmst_tbl".
 *
 * @property int $projsusdevelopgoalmst_pk Primary key
 * @property string $psdgm_sustaindevelopgoal Sustainable Goal Development
 * @property int $psdgm_status 1 - Active, 2 - Inactive
 * @property string $psdgm_createdon Date of creation
 * @property int $psdgm_createdby Reference to usermst_tbl
 * @property string $psdgm_createdbyipaddr IP Address of the user
 * @property string $psdgm_updatedon Date of updation
 * @property int $psdgm_updatedby Reference to usermst_tbl
 * @property string $psdgm_updatedbyipaddr IP Address of the user
 */
class ProjsusdevelopgoalmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projsusdevelopgoalmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['psdgm_sustaindevelopgoal', 'psdgm_status', 'psdgm_createdby'], 'required'],
            [['psdgm_status', 'psdgm_createdby', 'psdgm_updatedby'], 'integer'],
            [['psdgm_createdon', 'psdgm_updatedon'], 'safe'],
            [['psdgm_sustaindevelopgoal', 'psdgm_createdbyipaddr', 'psdgm_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projsusdevelopgoalmst_pk' => 'Projsusdevelopgoalmst Pk',
            'psdgm_sustaindevelopgoal' => 'Psdgm Sustaindevelopgoal',
            'psdgm_status' => 'Psdgm Status',
            'psdgm_createdon' => 'Psdgm Createdon',
            'psdgm_createdby' => 'Psdgm Createdby',
            'psdgm_createdbyipaddr' => 'Psdgm Createdbyipaddr',
            'psdgm_updatedon' => 'Psdgm Updatedon',
            'psdgm_updatedby' => 'Psdgm Updatedby',
            'psdgm_updatedbyipaddr' => 'Psdgm Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjsusdevelopgoalmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjsusdevelopgoalmstTblQuery(get_called_class());
    }
}
