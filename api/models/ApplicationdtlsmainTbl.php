<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "applicationdtlsmain_tbl".
 *
 * @property int $applicationdtlsmain_pk
 * @property int $appdm_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $appdm_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $appdm_projectmst_fk Reference to projectmst_pk
 * @property int $appdm_grademst_fk Reference to grademst_pk
 * @property int $appdm_apptype 1-Fresh, 2-Renewal
 * @property int $appdm_appupdated 1-updated during Fresh application, 2-updated during Renewal application
 * @property string $appdm_submittedon
 * @property int $appdm_submittedby
 * @property string $appdm_updatedon
 * @property int $appdm_updatedby
 * @property string $appdm_certificategenon Certificate generated on
 * @property string $appdm_certificatepath
 * @property string $appdm_certificateexpiry
 *
 * @property AppauditschedmainTbl[] $appauditschedmainTbls
 * @property AppcoursedtlshstyTbl[] $appcoursedtlshstyTbls
 * @property AppcoursedtlsmainTbl[] $appcoursedtlsmainTbls
 * @property AppcoursedtlstmpTbl[] $appcoursedtlstmpTbls
 * @property AppdocsubmissionmainTbl[] $appdocsubmissionmainTbls
 * @property AppinstinfomainTbl[] $appinstinfomainTbls
 * @property AppintrecogmainTbl[] $appintrecogmainTbls
 * @property ApplicationdtlshstyTbl[] $applicationdtlshstyTbls
 * @property ApplicationdtlstmpTbl $appdmApplicationdtlstmpFk
 * @property GrademstTbl $appdmGrademstFk
 * @property OpalmemberregmstTbl $appdmOpalmemberregmstFk
 * @property ProjectmstTbl $appdmProjectmstFk
 * @property AppoffercoursemainTbl[] $appoffercoursemainTbls
 * @property AppoprcontractmainTbl[] $appoprcontractmainTbls
 * @property ApppymtdtlsmainTbl[] $apppymtdtlsmainTbls
 */
class ApplicationdtlsmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'applicationdtlsmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appdm_applicationdtlstmp_fk', 'appdm_opalmemberregmst_fk', 'appdm_projectmst_fk', 'appdm_apptype'], 'required'],
            [['appdm_applicationdtlstmp_fk', 'appdm_opalmemberregmst_fk', 'appdm_projectmst_fk', 'appdm_grademst_fk', 'appdm_apptype', 'appdm_submittedby', 'appdm_updatedby'], 'integer'],
            [['appdm_submittedon', 'appdm_updatedon', 'appdm_certificategenon', 'appdm_certificateexpiry'], 'safe'],
            [['appdm_certificatepath'], 'string'],
            [['appdm_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appdm_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['appdm_grademst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => GrademstTbl::className(), 'targetAttribute' => ['appdm_grademst_fk' => 'grademst_pk']],
            [['appdm_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appdm_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['appdm_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['appdm_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'applicationdtlsmain_pk' => 'Applicationdtlsmain Pk',
            'appdm_applicationdtlstmp_fk' => 'Appdm Applicationdtlstmp Fk',
            'appdm_opalmemberregmst_fk' => 'Appdm Opalmemberregmst Fk',
            'appdm_projectmst_fk' => 'Appdm Projectmst Fk',
            'appdm_grademst_fk' => 'Appdm Grademst Fk',
            'appdm_apptype' => 'Appdm Apptype',
            'appdm_submittedon' => 'Appdm Submittedon',
            'appdm_submittedby' => 'Appdm Submittedby',
            'appdm_updatedon' => 'Appdm Updatedon',
            'appdm_updatedby' => 'Appdm Updatedby',
            'appdm_certificategenon' => 'Appdm Certificategenon',
            'appdm_certificatepath' => 'Appdm Certificatepath',
            'appdm_certificateexpiry' => 'Appdm Certificateexpiry',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppauditschedmainTbls()
    {
        return $this->hasMany(AppauditschedmainTbl::className(), ['appasdm_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursedtlshstyTbls()
    {
        return $this->hasMany(AppcoursedtlshstyTbl::className(), ['appcdh_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursedtlsmainTbls()
    {
        return $this->hasMany(AppcoursedtlsmainTbl::className(), ['appcdm_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursedtlstmpTbls()
    {
        return $this->hasMany(AppcoursedtlstmpTbl::className(), ['appcdt_applicationdtlsmain_fk' => 'applicationdtlsmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdocsubmissionmainTbls()
    {
        return $this->hasMany(AppdocsubmissionmainTbl::className(), ['appdsm_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppinstinfomainTbls()
    {
        return $this->hasMany(AppinstinfomainTbl::className(), ['appiim_applicationdtlsmain_fk' => 'applicationdtlsmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintrecogmainTbls()
    {
        return $this->hasMany(AppintrecogmainTbl::className(), ['appintim_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationdtlshstyTbls()
    {
        return $this->hasMany(ApplicationdtlshstyTbl::className(), ['appdh_applicationdtlsmain_fk' => 'applicationdtlsmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdmApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'appdm_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdmGrademstFk()
    {
        return $this->hasOne(GrademstTbl::className(), ['grademst_pk' => 'appdm_grademst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdmOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appdm_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdmProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'appdm_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoffercoursemainTbls()
    {
        return $this->hasMany(AppoffercoursemainTbl::className(), ['appocm_applicationdtlsmain_fk' => 'applicationdtlsmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprcontractmainTbls()
    {
        return $this->hasMany(AppoprcontractmainTbl::className(), ['appoprcm_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppymtdtlsmainTbls()
    {
        return $this->hasMany(ApppymtdtlsmainTbl::className(), ['apppdm_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']);
    }

    /**
     * {@inheritdoc}
     * @return ApplicationdtlsmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApplicationdtlsmainTblQuery(get_called_class());
    }
}
