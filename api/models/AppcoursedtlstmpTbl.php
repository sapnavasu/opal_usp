<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appcoursedtlstmp_tbl".
 *
 * @property int $appcoursedtlstmp_pk
 * @property int $appcdt_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $appcdt_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $appcdt_appinstinfomain_fk Reference to appinstinfomain_fk, which main/branch office this course is added
 * @property int $appcdt_appoffercoursemain_fk Reference to appoffercoursemain_pk, NOTNULL only if offered course is selected
 * @property int $appcdt_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $appcdt_deliverto Reference to referencemst_pk where rm_mastertype=2
 * @property int $appcdt_requestfor Reference to referencemst_pk where rm_mastertype=13
 * @property string $appcdt_createdon
 * @property int $appcdt_createdby
 * @property string $appcdt_updatedon
 * @property int $appcdt_updatedby
 * @property int $appcdt_status 1-Yet to submit. 2-Submitted for Approval, 3-Approved, 4-Declined, 5-updated
 * @property string $appcdt_appdecon
 * @property int $appcdt_appdecby
 * @property string $appcdt_appdeccomment
 *
 * @property AppcoursedtlshstyTbl[] $appcoursedtlshstyTbls
 * @property AppcoursedtlsmainTbl[] $appcoursedtlsmainTbls
 * @property AppinstinfomainTbl $appcdtAppinstinfomainFk
 * @property ApplicationdtlstmpTbl $appcdtApplicationdtlstmpFk
 * @property AppoffercoursemainTbl $appcdtAppoffercoursemainFk
 * @property StandardcoursemstTbl $appcdtStandardcoursemstFk
 * @property AppcoursetrnstmpTbl[] $appcoursetrnstmpTbls
 */
class AppcoursedtlstmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appcoursedtlstmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appcdt_opalmemberregmst_fk', 'appcdt_applicationdtlstmp_fk', 'appcdt_appinstinfomain_fk', 'appcdt_createdby', 'appcdt_status'], 'required'],
            [['appcdt_opalmemberregmst_fk', 'appcdt_applicationdtlstmp_fk', 'appcdt_appinstinfomain_fk', 'appcdt_appoffercoursemain_fk', 'appcdt_standardcoursemst_fk', 'appcdt_deliverto', 'appcdt_requestfor', 'appcdt_createdby', 'appcdt_updatedby', 'appcdt_status', 'appcdt_appdecby'], 'integer'],
            [['appcdt_createdon', 'appcdt_updatedon', 'appcdt_appdecon'], 'safe'],
            [['appcdt_appdeccomment'], 'string'],
            [['appcdt_appinstinfomain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfomainTbl::className(), 'targetAttribute' => ['appcdt_appinstinfomain_fk' => 'appinstinfomain_pk']],
            [['appcdt_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appcdt_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['appcdt_appoffercoursemain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursemainTbl::className(), 'targetAttribute' => ['appcdt_appoffercoursemain_fk' => 'appoffercoursemain_pk']],
            [['appcdt_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['appcdt_standardcoursemst_fk' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appcoursedtlstmp_pk' => 'Appcoursedtlstmp Pk',
            'appcdt_opalmemberregmst_fk' => 'Appcdt Opalmemberregmst Fk',
            'appcdt_applicationdtlstmp_fk' => 'Appcdt Applicationdtlstmp Fk',
            'appcdt_appinstinfomain_fk' => 'Appcdt Appinstinfomain Fk',
            'appcdt_appoffercoursemain_fk' => 'Appcdt Appoffercoursemain Fk',
            'appcdt_standardcoursemst_fk' => 'Appcdt Standardcoursemst Fk',
            'appcdt_deliverto' => 'Appcdt Deliverto',
            'appcdt_requestfor' => 'Appcdt Requestfor',
            'appcdt_createdon' => 'Appcdt Createdon',
            'appcdt_createdby' => 'Appcdt Createdby',
            'appcdt_updatedon' => 'Appcdt Updatedon',
            'appcdt_updatedby' => 'Appcdt Updatedby',
            'appcdt_status' => 'Appcdt Status',
            'appcdt_appdecon' => 'Appcdt Appdecon',
            'appcdt_appdecby' => 'Appcdt Appdecby',
            'appcdt_appdeccomment' => 'Appcdt Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursedtlshstyTbls()
    {
        return $this->hasMany(AppcoursedtlshstyTbl::className(), ['appcdh_AppCourseDtlstmp_FK' => 'appcoursedtlstmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursedtlsmainTbls()
    {
        return $this->hasMany(AppcoursedtlsmainTbl::className(), ['appcdm_AppCourseDtlsTmp_FK' => 'appcoursedtlstmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcdtAppinstinfomainFk()
    {
        return $this->hasOne(AppinstinfomainTbl::className(), ['appinstinfomain_pk' => 'appcdt_appinstinfomain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcdtApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'appcdt_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcdtAppoffercoursemainFk()
    {
        return $this->hasOne(AppoffercoursemainTbl::className(), ['appoffercoursemain_pk' => 'appcdt_appoffercoursemain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcdtStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'appcdt_standardcoursemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursetrnstmpTbls()
    {
        return $this->hasMany(AppcoursetrnstmpTbl::className(), ['appctt_appcoursedtlstmp_fk' => 'appcoursedtlstmp_pk']);
    }
}
