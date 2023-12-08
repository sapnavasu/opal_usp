<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projaccreditation_tbl".
 *
 * @property int $projaccreditation_pk Primary Key
 * @property int $pacr_projectdtls_fk Reference to projectdtls_tbl
 * @property string $pacr_accreditationname Accreditation Name
 * @property string $pacr_governingbody Governing Body
 * @property string $pacr_regno Registration No.
 * @property string $pacr_regdate Date of Registration
 * @property int $pacr_index
 * @property string $pacr_createdon Date of Creation
 * @property int $pacr_createdby Created by user id
 * @property string $pacr_createdbyipaddr Created by user's IP Address
 * @property string $pacr_updatedon Date of Update
 * @property int $pacr_updatedby Updated by user id
 * @property string $pacr_updatedbyipaddr Updated by user's IP Address
 */
class ProjaccreditationTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projaccreditation_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pacr_projectdtls_fk', 'pacr_accreditationname', 'pacr_index', 'pacr_createdby'], 'required'],
            [['pacr_projectdtls_fk', 'pacr_index', 'pacr_createdby', 'pacr_updatedby'], 'integer'],
            [['pacr_regdate', 'pacr_createdon', 'pacr_updatedon'], 'safe'],
            [['pacr_accreditationname', 'pacr_governingbody', 'pacr_regno'], 'string', 'max' => 150],
            [['pacr_createdbyipaddr', 'pacr_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projaccreditation_pk' => 'Projaccreditation Pk',
            'pacr_projectdtls_fk' => 'Pacr Projectdtls Fk',
            'pacr_accreditationname' => 'Pacr Accreditationname',
            'pacr_governingbody' => 'Pacr Governingbody',
            'pacr_regno' => 'Pacr Regno',
            'pacr_regdate' => 'Pacr Regdate',
            'pacr_index' => 'Pacr Index',
            'pacr_createdon' => 'Pacr Createdon',
            'pacr_createdby' => 'Pacr Createdby',
            'pacr_createdbyipaddr' => 'Pacr Createdbyipaddr',
            'pacr_updatedon' => 'Pacr Updatedon',
            'pacr_updatedby' => 'Pacr Updatedby',
            'pacr_updatedbyipaddr' => 'Pacr Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjaccreditationTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjaccreditationTblQuery(get_called_class());
    }
}
