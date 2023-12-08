<?php

namespace api\modules\lic\models;

use Yii;

/**
 * This is the model class for table "licensetracker_tbl".
 *
 * @property int $licensetracker_pk Primary key
 * @property int $lt_licensinginfo_fk Reference to licensinginfo_tbl
 * @property int $lt_projectdtls_fk Reference to projectdtls_tbl
 * @property string $lt_referenceno Reference No
 * @property string $lt_submittedon Date of submission
 * @property string $lt_comment Comments if any
 * @property int $lt_status 1 - Applied, 2 - Pending, 3 - Declined.
 * @property string $lt_createdon Date of creation
 * @property int $lt_createdby Reference to usermst_tbl
 * @property string $lt_createdbyipaddr IP Address of the user
 */
class LicensetrackerTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licensetracker_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lt_licensinginfo_fk', 'lt_referenceno', 'lt_submittedon', 'lt_createdon', 'lt_createdby'], 'required'],
            [['lt_licensinginfo_fk', 'lt_projectdtls_fk', 'lt_status', 'lt_createdby'], 'integer'],
            [['lt_submittedon', 'lt_createdon'], 'safe'],
            [['lt_comment'], 'string'],
            [['lt_referenceno'], 'string', 'max' => 30],
            [['lt_createdbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'licensetracker_pk' => 'Licensetracker Pk',
            'lt_licensinginfo_fk' => 'Lt Licensinginfo Fk',
            'lt_projectdtls_fk' => 'Lt Projectdtls Fk',
            'lt_referenceno' => 'Lt Referenceno',
            'lt_submittedon' => 'Lt Submittedon',
            'lt_comment' => 'Lt Comment',
            'lt_status' => 'Lt Status',
            'lt_createdon' => 'Lt Createdon',
            'lt_createdby' => 'Lt Createdby',
            'lt_createdbyipaddr' => 'Lt Createdbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LicensetrackerTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LicensetrackerTblQuery(get_called_class());
    }
}
