<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opalintegconfigmst_tbl".
 *
 * @property int $opalintegconfigmst_pk primary key
 * @property string $oicm_integrationtask
 * @property array $ocim_integrationdetails Any configuration related details can be stored as json
 * @property int $oicm_integstatus Integration status 1-enabled, 2-disabled
 * @property int $oicm_status city status. 1 - active, 2 - inactive
 * @property string $oicm_maintenancemsg If oicm_integstatus=2, then show text in this column to the user
 * @property string $oicm_createdon datetime of creation
 * @property int $oicm_createdby reference to opalusermst_tbl
 * @property string $oicm_updatedon datetime of updation
 * @property int $oicm_updatedby reference to opalusermst_tbl
 */
class OpalintegconfigmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalintegconfigmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oicm_integrationtask', 'oicm_integstatus', 'oicm_status', 'oicm_createdon'], 'required'],
            [['ocim_integrationdetails', 'oicm_createdon', 'oicm_updatedon'], 'safe'],
            [['oicm_integstatus', 'oicm_status', 'oicm_createdby', 'oicm_updatedby'], 'integer'],
            [['oicm_maintenancemsg'], 'string'],
            [['oicm_integrationtask'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalintegconfigmst_pk' => 'Opalintegconfigmst Pk',
            'oicm_integrationtask' => 'Oicm Integrationtask',
            'ocim_integrationdetails' => 'Ocim Integrationdetails',
            'oicm_integstatus' => 'Oicm Integstatus',
            'oicm_status' => 'Oicm Status',
            'oicm_maintenancemsg' => 'Oicm Maintenancemsg',
            'oicm_createdon' => 'Oicm Createdon',
            'oicm_createdby' => 'Oicm Createdby',
            'oicm_updatedon' => 'Oicm Updatedon',
            'oicm_updatedby' => 'Oicm Updatedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OpalintegconfigmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalintegconfigmstTblQuery(get_called_class());
    }
}
