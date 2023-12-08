<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projmodeofimplentmst_tbl".
 *
 * @property int $projmodeofimplentmst_pk Primary key
 * @property int $pmim_modetype 1 - PPP, 2 - EPC, 3 - Turnkey, 4 - Others
 * @property string $pmim_modesubtype Mode of implementation sub type
 * @property string $pmim_createdon Date of creation
 * @property int $pmim_createdby Reference to usermst_tbl
 * @property string $pmim_createdbyipaddr IP Address of the user
 */
class ProjmodeofimplentmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projmodeofimplentmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pmim_modetype', 'pmim_createdon', 'pmim_createdby'], 'required'],
            [['pmim_modetype', 'pmim_createdby'], 'integer'],
            [['pmim_createdon'], 'safe'],
            [['pmim_modesubtype'], 'string', 'max' => 80],
            [['pmim_createdbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projmodeofimplentmst_pk' => 'Projmodeofimplentmst Pk',
            'pmim_modetype' => 'Pmim Modetype',
            'pmim_modesubtype' => 'Pmim Modesubtype',
            'pmim_createdon' => 'Pmim Createdon',
            'pmim_createdby' => 'Pmim Createdby',
            'pmim_createdbyipaddr' => 'Pmim Createdbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjmodeofimplentmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjmodeofimplentmstTblQuery(get_called_class());
    }
}
