<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opalcontactquerymst_tbl".
 *
 * @property int $opalcontactquerymst_pk Primary key
 * @property string $ocqm_contactquery Contact Query value
 * @property int $ocqm_status 1 - Active, 2 - Inactive
 * @property string $ocqm_createdon Created on datetime
 * @property int $ocqm_createdby Reference to opalusermst_tbl
 * @property string $ocqm_updatedon Updation datetime
 * @property int $ocqm_updatedby Reference to opalusermst_tbl
 */
class OpalcontactquerymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalcontactquerymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ocqm_contactquery', 'ocqm_status', 'ocqm_createdby'], 'required'],
            [['ocqm_status', 'ocqm_createdby', 'ocqm_updatedby'], 'integer'],
            [['ocqm_createdon', 'ocqm_updatedon'], 'safe'],
            [['ocqm_contactquery'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalcontactquerymst_pk' => 'Opalcontactquerymst Pk',
            'ocqm_contactquery' => 'Ocqm Contactquery',
            'ocqm_status' => 'Ocqm Status',
            'ocqm_createdon' => 'Ocqm Createdon',
            'ocqm_createdby' => 'Ocqm Createdby',
            'ocqm_updatedon' => 'Ocqm Updatedon',
            'ocqm_updatedby' => 'Ocqm Updatedby',
        ];
    }
    
    public static function contactQueryCache(){
        return self::find()
        ->select(['max(ocqm_updatedon), count(*)'])
        ->createCommand()
        ->getRawSql();
    }
}
