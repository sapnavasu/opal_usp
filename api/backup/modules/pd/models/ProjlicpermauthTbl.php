<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projlicpermauth_tbl".
 *
 * @property int $projlicpermauth_pk Primary key
 * @property int $plpa_projectdtls_fk Reference to projectdtls_tbl
 * @property string $plpa_licensauthoritiesmst_fk licensauthoritiesmst_pk in comma separation
 * @property int $plpa_createdby Created by user id
 * @property string $plpa_createdbyipaddr IP Address of the user
 * @property string $plpa_createdon Date of creation
 * @property int $plpa_updatedby Updated by user id
 * @property string $plpa_updatedbyipaddr IP Address of the user
 * @property string $plpa_updatedon Date of update
 */
class ProjlicpermauthTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projlicpermauth_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plpa_projectdtls_fk', 'plpa_licensauthoritiesmst_fk', 'plpa_createdby'], 'required'],
            [['plpa_projectdtls_fk', 'plpa_createdby', 'plpa_updatedby'], 'integer'],
            [['plpa_licensauthoritiesmst_fk'], 'string'],
            [['plpa_createdon', 'plpa_updatedon'], 'safe'],
            [['plpa_createdbyipaddr', 'plpa_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projlicpermauth_pk' => 'Projlicpermauth Pk',
            'plpa_projectdtls_fk' => 'Plpa Projectdtls Fk',
            'plpa_licensauthoritiesmst_fk' => 'Plpa Licensauthoritiesmst Fk',
            'plpa_createdby' => 'Plpa Createdby',
            'plpa_createdbyipaddr' => 'Plpa Createdbyipaddr',
            'plpa_createdon' => 'Plpa Createdon',
            'plpa_updatedby' => 'Plpa Updatedby',
            'plpa_updatedbyipaddr' => 'Plpa Updatedbyipaddr',
            'plpa_updatedon' => 'Plpa Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjlicpermauthTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjlicpermauthTblQuery(get_called_class());
    }
}
