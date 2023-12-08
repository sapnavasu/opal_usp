<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projstagemst_tbl".
 *
 * @property int $projstagemst_pk Primary key
 * @property string $prsm_projstage Project Stage
 * @property int $prsm_status 1 - Active, 2 - Inactive
 * @property string $prsm_createdon Date of creation
 * @property int $prsm_createdby Reference to usermst_tbl
 * @property string $prsm_createdbyipaddr IP Address of the user
 * @property string $prsm_updatedon Date of updation
 * @property int $prsm_updatedby Reference to usermst_tbl
 * @property string $prsm_updatedbyipaddr IP Address of the user
 */
class ProjstagemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projstagemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prsm_projstage', 'prsm_status', 'prsm_createdby'], 'required'],
            [['prsm_status', 'prsm_createdby', 'prsm_updatedby'], 'integer'],
            [['prsm_createdon', 'prsm_updatedon'], 'safe'],
            [['prsm_projstage', 'prsm_createdbyipaddr', 'prsm_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projstagemst_pk' => 'Projstagemst Pk',
            'prsm_projstage' => 'Prsm Projstage',
            'prsm_status' => 'Prsm Status',
            'prsm_createdon' => 'Prsm Createdon',
            'prsm_createdby' => 'Prsm Createdby',
            'prsm_createdbyipaddr' => 'Prsm Createdbyipaddr',
            'prsm_updatedon' => 'Prsm Updatedon',
            'prsm_updatedby' => 'Prsm Updatedby',
            'prsm_updatedbyipaddr' => 'Prsm Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjstagemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjstagemstTblQuery(get_called_class());
    }
}
