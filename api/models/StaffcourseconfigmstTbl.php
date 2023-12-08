<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffcourseconfigmst_tbl".
 *
 * @property int $staffcourseconfigmst_pk
 * @property int $sccm_coursetype 1-Standard course,2-Customized course
 * @property int $sccm_standardcoursedtls_fk
 * @property int $sccm_coursecategorymst_fk Reference to coursecategorymst_pk
 * @property int $sccm_trainer if null should not allow to add staff in trainer role alone
 * @property int $sccm_assessor if null should not allow to add staff in assessor role alone
 * @property int $sccm_trainerandassessor if null should not allow to add staff in trainer and assessor role 
 * @property int $sccm_programmanager
 * @property int $sccm_status 1-Active, 2-Inactive
 * @property string $sccm_createdon
 * @property int $sccm_createdby
 * @property string $sccm_updatedon
 * @property int $sccm_updatedby
 *
 * @property CoursecategorymstTbl $sccmCoursecategorymstFk
 * @property StandardcoursedtlsTbl $sccmStandardcoursedtlsFk
 */
class StaffcourseconfigmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffcourseconfigmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sccm_coursetype', 'sccm_trainerandassessor', 'sccm_programmanager', 'sccm_createdby'], 'required'],
            [['sccm_coursetype', 'sccm_standardcoursedtls_fk', 'sccm_coursecategorymst_fk', 'sccm_trainer', 'sccm_assessor', 'sccm_trainerandassessor', 'sccm_programmanager', 'sccm_status', 'sccm_createdby', 'sccm_updatedby'], 'integer'],
            [['sccm_createdon', 'sccm_updatedon'], 'safe'],
            [['sccm_coursecategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['sccm_coursecategorymst_fk' => 'coursecategorymst_pk']],
            [['sccm_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['sccm_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffcourseconfigmst_pk' => 'Staffcourseconfigmst Pk',
            'sccm_coursetype' => 'Sccm Coursetype',
            'sccm_standardcoursedtls_fk' => 'Sccm Standardcoursedtls Fk',
            'sccm_coursecategorymst_fk' => 'Sccm Coursecategorymst Fk',
            'sccm_trainer' => 'Sccm Trainer',
            'sccm_assessor' => 'Sccm Assessor',
            'sccm_trainerandassessor' => 'Sccm Trainerandassessor',
            'sccm_programmanager' => 'Sccm Programmanager',
            'sccm_status' => 'Sccm Status',
            'sccm_createdon' => 'Sccm Createdon',
            'sccm_createdby' => 'Sccm Createdby',
            'sccm_updatedon' => 'Sccm Updatedon',
            'sccm_updatedby' => 'Sccm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccmCoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'sccm_coursecategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSccmStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'sccm_standardcoursedtls_fk']);
    }

    
}
