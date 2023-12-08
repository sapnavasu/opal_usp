<?php

namespace api\modules\gcc\models;

use Yii;

/**
 * This is the model class for table "gcctendcpvmst_tbl".
 *
 * @property int $gcctendcpvmst_pk
 * @property int $gtcm_gcctendsectmst_fk Reference to GCC Tender Sector Master table
 * @property string $gtcm_cpvcode CPV Code
 * @property string $gtcm_cpvdetails CPV (Product  Service Name)
 * @property int $gtcm_status If the CPV is active or not. Active - 1, Inactive - 0
 * @property string $gtcm_createdon The date and time when the record is created
 */
class gcctendcpvmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gcctendcpvmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gtcm_gcctendsectmst_fk', 'gtcm_cpvcode', 'gtcm_cpvdetails', 'gtcm_status'], 'required'],
            [['gtcm_gcctendsectmst_fk', 'gtcm_status'], 'integer'],
            [['gtcm_cpvdetails'], 'string'],
            [['gtcm_createdon'], 'safe'],
            [['gtcm_cpvcode'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gcctendcpvmst_pk' => 'Gcctendcpvmst Pk',
            'gtcm_gcctendsectmst_fk' => 'Gtcm Gcctendsectmst Fk',
            'gtcm_cpvcode' => 'Gtcm Cpvcode',
            'gtcm_cpvdetails' => 'Gtcm Cpvdetails',
            'gtcm_status' => 'Gtcm Status',
            'gtcm_createdon' => 'Gtcm Createdon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return gcctendcpvmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new gcctendcpvmstTblQuery(get_called_class());
    }
}
