<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appcoursetrnstmp_tbl".
 *
 * @property int $appcoursetrnstmp_pk
 * @property int $appctt_appcoursedtlstmp_fk Refernce to appcoursedtlstmp_pk
 * @property int $appctt_coursecategorymst_fk Reference to coursecategorymst_pk
 * @property string $appctt_createdon
 * @property int $appctt_createdby
 * @property string $appctt_updatedon
 * @property int $appctt_updatedby
 * @property int $appctt_status 1-Yet to submit. 2-Submitted for Approval, 3-Approved, 4-Declined, 5-updated
 * @property string $appctt_appdecon
 * @property int $appctt_appdecby
 * @property string $appctt_appdeccomment
 *
 * @property AppcoursetrnshstyTbl[] $appcoursetrnshstyTbls
 * @property AppcoursetrnsmainTbl[] $appcoursetrnsmainTbls
 * @property AppcoursedtlstmpTbl $appcttAppcoursedtlstmpFk
 * @property CoursecategorymstTbl $appcttCoursecategorymstFk
 */
class AppcoursetrnstmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appcoursetrnstmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appctt_appcoursedtlstmp_fk', 'appctt_coursecategorymst_fk', 'appctt_createdby', 'appctt_status'], 'required'],
            [['appctt_appcoursedtlstmp_fk', 'appctt_coursecategorymst_fk', 'appctt_createdby', 'appctt_updatedby', 'appctt_status', 'appctt_appdecby'], 'integer'],
            [['appctt_createdon', 'appctt_updatedon', 'appctt_appdecon'], 'safe'],
            [['appctt_appdeccomment'], 'string'],
            [['appctt_appcoursedtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursedtlstmpTbl::className(), 'targetAttribute' => ['appctt_appcoursedtlstmp_fk' => 'appcoursedtlstmp_pk']],
            [['appctt_coursecategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['appctt_coursecategorymst_fk' => 'coursecategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appcoursetrnstmp_pk' => 'Appcoursetrnstmp Pk',
            'appctt_appcoursedtlstmp_fk' => 'Appctt Appcoursedtlstmp Fk',
            'appctt_coursecategorymst_fk' => 'Appctt Coursecategorymst Fk',
            'appctt_createdon' => 'Appctt Createdon',
            'appctt_createdby' => 'Appctt Createdby',
            'appctt_updatedon' => 'Appctt Updatedon',
            'appctt_updatedby' => 'Appctt Updatedby',
            'appctt_status' => 'Appctt Status',
            'appctt_appdecon' => 'Appctt Appdecon',
            'appctt_appdecby' => 'Appctt Appdecby',
            'appctt_appdeccomment' => 'Appctt Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursetrnshstyTbls()
    {
        return $this->hasMany(AppcoursetrnshstyTbl::className(), ['appcth_AppCourseTrnsTmp_FK' => 'appcoursetrnstmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursetrnsmainTbls()
    {
        return $this->hasMany(AppcoursetrnsmainTbl::className(), ['appctm_ApCourseTrnsTmp_FK' => 'appcoursetrnstmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcttAppcoursedtlstmpFk()
    {
        return $this->hasOne(AppcoursedtlstmpTbl::className(), ['appcoursedtlstmp_pk' => 'appctt_appcoursedtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcttCoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'appctt_coursecategorymst_fk']);
    }
}
