<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dashboardcountmst_tbl".
 *
 * @property int $dashboardcountmst_pk
 * @property string $dcm_dashboardtype
 * @property string $dcm_spname
 * @property int $dcm_opalmemberreg
 * @property array $dcm_dashboardcount
 * @property string $dcm_lastupdateon
 */
class DashboardcountmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dashboardcountmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dcm_opalmemberreg'], 'required'],
            [['dcm_opalmemberreg'], 'integer'],
            [['dcm_dashboardcount'], 'safe'],
            [['dcm_dashboardtype', 'dcm_spname', 'dcm_lastupdateon'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dashboardcountmst_pk' => 'Dashboardcountmst Pk',
            'dcm_dashboardtype' => 'Dcm Dashboardtype',
            'dcm_spname' => 'Dcm Spname',
            'dcm_opalmemberreg' => 'Dcm Opalmemberreg',
            'dcm_dashboardcount' => 'Dcm Dashboardcount',
            'dcm_lastupdateon' => 'Dcm Lastupdateon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DashboardcountmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DashboardcountmstTblQuery(get_called_class());
    }
}
