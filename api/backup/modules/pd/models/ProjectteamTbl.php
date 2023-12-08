<?php

namespace api\modules\pd\models;
use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
use yii\data\ActiveDataProvider;



/**
 * This is the model class for table "projectteam_tbl".
 *
 * @property int $projectteam_pk Primary Key 
 * @property int $pt_projectdtls_fk Reference to projectdtls_tbl
 * @property int $pt_usermst_fk Reference to usermst_tbl
 * @property string $pt_role Role
 * @property string $pt_bio Short Bio
 * @property int $pt_index
 * @property int $pt_status Current Status of the User  0 - Inactive, 1 - Active, 2 - Delete
 * @property string $pt_createdon Date of Creation
 * @property int $pt_createdby Created by user id
 * @property string $pt_createdbyipaddr Created by user's IP Address
 * @property string $pt_updatedon Date of Update
 * @property int $pt_updatedby Updated by user id
 * @property string $pt_updatedbyipaddr Updated by user's IP Address
 * @property string $pt_deletedon Date of deletion
 * @property int $pt_deletedby Deleted by user id
 * @property string $pt_deletedbyipaddr Deleted by user's IP Address
 */
class ProjectteamTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projectteam_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pt_projectdtls_fk', 'pt_usermst_fk', 'pt_role', 'pt_bio', 'pt_index', 'pt_createdby'], 'required'],
            [['pt_projectdtls_fk', 'pt_usermst_fk', 'pt_index', 'pt_status', 'pt_createdby', 'pt_updatedby', 'pt_deletedby'], 'integer'],
            [['pt_createdon', 'pt_updatedon', 'pt_deletedon'], 'safe'],
            [['pt_role'], 'string', 'max' => 50],
            [['pt_bio'], 'string', 'max' => 250],
            [['pt_createdbyipaddr', 'pt_updatedbyipaddr', 'pt_deletedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projectteam_pk' => 'Projectteam Pk',
            'pt_projectdtls_fk' => 'Pt Projectdtls Fk',
            'pt_usermst_fk' => 'Pt Usermst Fk',
            'pt_role' => 'Pt Role',
            'pt_bio' => 'Pt Bio',
            'pt_index' => 'Pt Index',
            'pt_status' => 'Pt Status',
            'pt_createdon' => 'Pt Createdon',
            'pt_createdby' => 'Pt Createdby',
            'pt_createdbyipaddr' => 'Pt Createdbyipaddr',
            'pt_updatedon' => 'Pt Updatedon',
            'pt_updatedby' => 'Pt Updatedby',
            'pt_updatedbyipaddr' => 'Pt Updatedbyipaddr',
            'pt_deletedon' => 'Pt Deletedon',
            'pt_deletedby' => 'Pt Deletedby',
            'pt_deletedbyipaddr' => 'Pt Deletedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjectteamTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectteamTblQuery(get_called_class());
    }
}