<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projachievement_tbl".
 *
 * @property int $projachievement_pk Primary Key
 * @property int $pachv_projectdtls_fk Reference to projectdtls_tbl
 * @property int $pachv_filemst_fk Reference to filemst_tbl
 * @property string $pachv_title Title
 * @property string $pachv_year Year of achievement
 * @property string $pachv_description Description
 * @property int $pachv_index
 * @property string $pachv_createdon
 * @property int $pachv_createdby Created by user id
 * @property string $pachv_createdbyipaddr Created by user's IP Address
 * @property string $pachv_updatedon Date of Update
 * @property int $pachv_updatedby Updated by user id
 * @property string $pachv_updatedbyipaddr Updated by user's IP Address
 */
class ProjachievementTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projachievement_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pachv_projectdtls_fk', 'pachv_title', 'pachv_index', 'pachv_createdby'], 'required'],
            [['pachv_projectdtls_fk', 'pachv_filemst_fk', 'pachv_index', 'pachv_createdby', 'pachv_updatedby'], 'integer'],
            [['pachv_year', 'pachv_createdon', 'pachv_updatedon'], 'safe'],
            [['pachv_description'], 'string'],
            [['pachv_title'], 'string', 'max' => 150],
            [['pachv_createdbyipaddr', 'pachv_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projachievement_pk' => 'Projachievement Pk',
            'pachv_projectdtls_fk' => 'Pachv Projectdtls Fk',
            'pachv_filemst_fk' => 'Pachv Filemst Fk',
            'pachv_title' => 'Pachv Title',
            'pachv_year' => 'Pachv Year',
            'pachv_description' => 'Pachv Description',
            'pachv_index' => 'Pachv Index',
            'pachv_createdon' => 'Pachv Createdon',
            'pachv_createdby' => 'Pachv Createdby',
            'pachv_createdbyipaddr' => 'Pachv Createdbyipaddr',
            'pachv_updatedon' => 'Pachv Updatedon',
            'pachv_updatedby' => 'Pachv Updatedby',
            'pachv_updatedbyipaddr' => 'Pachv Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjachievementTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjachievementTblQuery(get_called_class());
    }
}
