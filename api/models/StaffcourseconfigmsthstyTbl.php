<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffcourseconfigmsthsty_tbl".
 *
 * @property int $staffcourseconfigmsthsty_pk
 * @property int $sccmh_staffcourseconfigmst_fk Reference to staffcourseconfigmst_pk
 * @property int $sccmh_coursetype 1-Standard course,2-Customized course
 * @property int $sccmh_standardcoursedtls_fk Reference to standardcoursedtls_pk
 * @property int $sccmh_coursecategorymst_fk Reference to coursecategorymst_pk
 * @property int $sccmh_trainer if null should not allow to add staff in trainer role alone
 * @property int $sccmh_assessor if null should not allow to add staff in assessor role alone
 * @property int $sccmh_trainerandassessor if null should not allow to add staff in trainer and assessor role
 * @property int $sccmh_programmanager
 * @property int $sccmh_status 1-Active, 2-Inactive, by default 1
 * @property string $sccmh_createdon
 * @property int $sccmh_createdby
 * @property string $sccmh_updatedon
 * @property int $sccmh_updatedby
 *
 * @property StaffcourseconfigmstTbl $sccmhStaffcourseconfigmstFk
 */
class StaffcourseconfigmsthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffcourseconfigmsthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sccmh_staffcourseconfigmst_fk', 'sccmh_coursetype', 'sccmh_programmanager', 'sccmh_createdon', 'sccmh_createdby'], 'required'],
            [['sccmh_staffcourseconfigmst_fk', 'sccmh_coursetype', 'sccmh_standardcoursedtls_fk', 'sccmh_coursecategorymst_fk', 'sccmh_trainer', 'sccmh_assessor', 'sccmh_trainerandassessor', 'sccmh_programmanager', 'sccmh_status', 'sccmh_createdby', 'sccmh_updatedby'], 'integer'],
            [['sccmh_createdon', 'sccmh_updatedon'], 'safe'],
            [['sccmh_staffcourseconfigmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffcourseconfigmstTbl::className(), 'targetAttribute' => ['sccmh_staffcourseconfigmst_fk' => 'staffcourseconfigmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffcourseconfigmsthsty_pk' => 'Staffcourseconfigmsthsty Pk',
            'sccmh_staffcourseconfigmst_fk' => 'Sccmh Staffcourseconfigmst Fk',
            'sccmh_coursetype' => 'Sccmh Coursetype',
            'sccmh_standardcoursedtls_fk' => 'Sccmh Standardcoursedtls Fk',
            'sccmh_coursecategorymst_fk' => 'Sccmh Coursecategorymst Fk',
            'sccmh_trainer' => 'Sccmh Trainer',
            'sccmh_assessor' => 'Sccmh Assessor',
            'sccmh_trainerandassessor' => 'Sccmh Trainerandassessor',
            'sccmh_programmanager' => 'Sccmh Programmanager',
            'sccmh_status' => 'Sccmh Status',
            'sccmh_createdon' => 'Sccmh Createdon',
            'sccmh_createdby' => 'Sccmh Createdby',
            'sccmh_updatedon' => 'Sccmh Updatedon',
            'sccmh_updatedby' => 'Sccmh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccmhStaffcourseconfigmstFk()
    {
        return $this->hasOne(StaffcourseconfigmstTbl::className(), ['staffcourseconfigmst_pk' => 'sccmh_staffcourseconfigmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StaffcourseconfigmsthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffcourseconfigmsthstyTblQuery(get_called_class());
    }
}
