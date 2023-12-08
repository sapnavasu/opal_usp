<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ivmsdeviceinstallconfigmst_tbl".
 *
 * @property int $ivmsdeviceinstallconfigmst_pk
 * @property string $idicm_rolemst_fk Reference to rolemst_pk
 * @property int $idicm_nooftechnician
 * @property int $idicm_maxnoofinstallation
 * @property int $sccm_status 1-Active, 2-Inactive, by default 1
 * @property string $sccm_createdon
 * @property int $sccm_createdby
 * @property string $sccm_updatedon
 * @property int $sccm_updatedby
 */
class IvmsdeviceinstallconfigmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivmsdeviceinstallconfigmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idicm_rolemst_fk', 'idicm_nooftechnician', 'idicm_maxnoofinstallation', 'sccm_status', 'sccm_createdby'], 'required'],
            [['idicm_rolemst_fk'], 'string'],
            [['idicm_nooftechnician', 'idicm_maxnoofinstallation', 'sccm_status', 'sccm_createdby', 'sccm_updatedby'], 'integer'],
            [['sccm_createdon', 'sccm_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ivmsdeviceinstallconfigmst_pk' => 'Ivmsdeviceinstallconfigmst Pk',
            'idicm_rolemst_fk' => 'Idicm Rolemst Fk',
            'idicm_nooftechnician' => 'Idicm Nooftechnician',
            'idicm_maxnoofinstallation' => 'Idicm Maxnoofinstallation',
            'sccm_status' => 'Sccm Status',
            'sccm_createdon' => 'Sccm Createdon',
            'sccm_createdby' => 'Sccm Createdby',
            'sccm_updatedon' => 'Sccm Updatedon',
            'sccm_updatedby' => 'Sccm Updatedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return IvmsdeviceinstallconfigmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IvmsdeviceinstallconfigmstTblQuery(get_called_class());
    }
}
