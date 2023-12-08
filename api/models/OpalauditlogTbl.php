<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opalauditlog_tbl".
 *
 * @property int $opalauditlog_pk
 * @property int $oal_opalmemberregmst_fk
 * @property int $oal_intendforregistration 1-opal star, 2.technical assessment
 * @property int $oal_status 1-Active, 2-In active
 * @property string $oal_createdon
 * @property string $oal_updatedon
 */
class OpalauditlogTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalauditlog_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oal_opalmemberregmst_fk', 'oal_createdon'], 'required'],
            [['oal_opalmemberregmst_fk', 'oal_intendforregistration', 'oal_status'], 'integer'],
            [['oal_createdon', 'oal_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalauditlog_pk' => 'Opalauditlog Pk',
            'oal_opalmemberregmst_fk' => 'Oal Opalmemberregmst Fk',
            'oal_intendforregistration' => 'Oal Intendforregistration',
            'oal_status' => 'Oal Status',
            'oal_createdon' => 'Oal Createdon',
            'oal_updatedon' => 'Oal Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OpalauditlogTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalauditlogTblQuery(get_called_class());
    }
}
