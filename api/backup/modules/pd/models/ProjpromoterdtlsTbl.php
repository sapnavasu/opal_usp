<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projpromoterdtls_tbl".
 *
 * @property int $projpromoterdtls_pk Primary key
 * @property string $ppd_promotername Promoter Name
 * @property string $ppd_promoterrefno Promoter Reference Number
 * @property int $ppd_promoterlogo Reference to memcompfiledtls_tbl
 * @property string $ppd_website Promoter Website
 * @property string $ppd_address Promoter Address
 * @property int $ppd_citymst_fk Reference to citymst_tbl
 * @property int $ppd_statemst_fk Reference to statemst_tbl
 * @property int $ppd_countrymst_fk Reference to countrymst_tbl
 * @property string $ppd_latitude Latitude
 * @property string $ppd_longitude Longitude
 * @property string $ppd_others Other information
 * @property string $ppd_projectrole Project role of the promoter
 * @property string $ppd_promsummary Promoter Summary
 * @property string $ppd_createdon Submitted on
 * @property int $ppd_createdby Reference to Usermst_tbl
 * @property string $ppd_createdbyipaddr IP Address of the user
 * @property string $ppd_updatedon Dateof updation
 * @property int $ppd_updatedby Reference to usermst_tbl
 * @property string $ppd_updatedbyipaddr User IP Address
 */
class ProjpromoterdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projpromoterdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ppd_promotername', 'ppd_promoterrefno', 'ppd_createdon', 'ppd_createdby'], 'required'],
            [['ppd_promoterlogo', 'ppd_citymst_fk', 'ppd_statemst_fk', 'ppd_countrymst_fk', 'ppd_createdby', 'ppd_updatedby'], 'integer'],
            [['ppd_address', 'ppd_others', 'ppd_projectrole', 'ppd_promsummary'], 'string'],
            [['ppd_createdon', 'ppd_updatedon'], 'safe'],
            [['ppd_latitude'], 'string', 'max' => 12],
            [['ppd_longitude'], 'string', 'max' => 13],
            [['ppd_createdbyipaddr', 'ppd_updatedbyipaddr'], 'string', 'max' => 50],
            [['ppd_promoterrefno'], 'string', 'max' => 20],
            [['ppd_promotername'], 'string', 'max' => 250],
            [['ppd_website'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projpromoterdtls_pk' => 'Projpromoterdtls Pk',
            'ppd_promotername' => 'Ppd Promotername',
            'ppd_promoterrefno' => 'Ppd Promoterrefno',
            'ppd_promoterlogo' => 'Ppd Promoterlogo',
            'ppd_website' => 'Ppd Website',
            'ppd_address' => 'Ppd Address',
            'ppd_citymst_fk' => 'Ppd Citymst Fk',
            'ppd_statemst_fk' => 'Ppd Statemst Fk',
            'ppd_countrymst_fk' => 'Ppd Countrymst Fk',
            'ppd_others' => 'Ppd Others',
            'ppd_projectrole' => 'Ppd Projectrole',
            'ppd_promsummary' => 'Ppd Promsummary',
            'ppd_latitude' => 'Ppd Latitude',
            'ppd_latitude' => 'Ppd Longitude',
            'ppd_createdon' => 'Ppd Createdon',
            'ppd_createdby' => 'Ppd Createdby',
            'ppd_createdbyipaddr' => 'Ppd Createdbyipaddr',
            'ppd_updatedon' => 'Ppd Updatedon',
            'ppd_updatedby' => 'Ppd Updatedby',
            'ppd_updatedbyipaddr' => 'Ppd Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjpromoterdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjpromoterdtlsTblQuery(get_called_class());
    }
}
