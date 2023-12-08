<?php

namespace api\modules\gcc\models;

use Yii;

/**
 * This is the model class for table "gcctendsectmst_tbl".
 *
 * @property int $gcctendsectmst_pk
 * @property string $gtsm_sectorcode Sector Code
 * @property string $gtsm_sectorname Sector Name
 * @property int $gtsm_status If the Sector is active or not. Active - 1, Inactive – 0
 * @property string $gtsm_createdon
 */
class ggcctendsectmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gcctendsectmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gtsm_sectorcode', 'gtsm_sectorname', 'gtsm_status'], 'required'],
            [['gtsm_status'], 'integer'],
            [['gtsm_createdon'], 'safe'],
            [['gtsm_sectorcode'], 'string', 'max' => 10],
            [['gtsm_sectorname'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gcctendsectmst_pk' => 'Gcctendsectmst Pk',
            'gtsm_sectorcode' => 'Gtsm Sectorcode',
            'gtsm_sectorname' => 'Gtsm Sectorname',
            'gtsm_status' => 'Gtsm Status',
            'gtsm_createdon' => 'Gtsm Createdon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return gcctendsectmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new gcctendsectmstTblQuery(get_called_class());
    }
}
