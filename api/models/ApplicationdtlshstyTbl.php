<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "applicationdtlshsty_tbl".
 *
 * @property int $applicationdtlshsty_pk
 * @property int $appdh_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $appdh_applicationdtlsmain_fk Reference to applicationdtlsmain_pk
 * @property int $appdh_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $appdh_projectmst_fk Reference to projectmst_pk
 * @property int $appdh_grademst_fk Reference to grademst_pk
 * @property int $appdh_apptype 1-Fresh, 2-Renewal
 * @property int $appdt_appupdated 1-updated during Fresh application, 2-updated during Renewal application
 * @property int $appdh_status 1-Yet to Submit for Desktop Review. 2- Submitted for Desktop Review, 3- Declined during Desktop Review, 4- Re-submitted for Desktop Review, 5- Yet to Pay, 6- Paid - Confirmation Pending,7- Awaiting for Site Audit Date,8- Confirm Site Audit Date,9- Ready for Audit,10-Submitted for Quality Manager Approval,11-Submitted for Authority Approval,12-Submitted for CEO Approval,13-Site Audit Declined,14-Re-Submitted for Quality Manager Approval,15-Re-Submitted for Authority Approval,16-Re-Submitted for CEO Approval,17-Approved
 * @property string $appdh_submittedon
 * @property int $appdh_submittedby
 * @property string $appdh_updatedon
 * @property int $appdh_updatedby
 * @property string $appdh_certificategenon Certificate generated on
 * @property string $appdh_certificatepath
 * @property string $appdh_certificateexpiry
 * @property string $appdt_appdecon
 * @property int $appdt_appdecby
 * @property string $appdt_appdecComments
 *
 * @property AppauditschedhstyTbl[] $appauditschedhstyTbls
 * @property AppcoursedtlshstyTbl[] $appcoursedtlshstyTbls
 * @property AppdocsubmissionhstyTbl[] $appdocsubmissionhstyTbls
 * @property AppintrecoghstyTbl[] $appintrecoghstyTbls
 * @property ApplicationdtlsmainTbl $appdhApplicationdtlsmainFk
 * @property ApplicationdtlstmpTbl $appdhApplicationdtlstmpFk
 * @property GrademstTbl $appdhGrademstFk
 * @property OpalmemberregmstTbl $appdhOpalmemberregmstFk
 * @property ProjectmstTbl $appdhProjectmstFk
 * @property AppoffercoursehstyTbl[] $appoffercoursehstyTbls
 * @property AppoprcontracthstyTbl[] $appoprcontracthstyTbls
 * @property ApppymtdtlshstyTbl[] $apppymtdtlshstyTbls
 * @property AppstaffinfohstyTbl[] $appstaffinfohstyTbls
 */
class ApplicationdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'applicationdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appdh_applicationdtlstmp_fk', 'appdh_opalmemberregmst_fk', 'appdh_projectmst_fk', 'appdh_apptype', 'appdh_status'], 'required'],
            [['appdh_applicationdtlstmp_fk', 'appdh_applicationdtlsmain_fk', 'appdh_opalmemberregmst_fk', 'appdh_projectmst_fk', 'appdh_grademst_fk', 'appdh_apptype', 'appdh_status', 'appdh_submittedby', 'appdh_updatedby'], 'integer'],
            [['appdh_submittedon', 'appdh_updatedon', 'appdh_certificategenon', 'appdh_certificateexpiry', 'appdt_appdecon'], 'safe'],
            [['appdh_certificatepath'], 'string'],
            [['appdh_applicationdtlsmain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlsmainTbl::className(), 'targetAttribute' => ['appdh_applicationdtlsmain_fk' => 'applicationdtlsmain_pk']],
            [['appdh_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appdh_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['appdh_grademst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => GrademstTbl::className(), 'targetAttribute' => ['appdh_grademst_fk' => 'grademst_pk']],
            [['appdh_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appdh_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['appdh_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['appdh_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'applicationdtlshsty_pk' => 'Applicationdtlshsty Pk',
            'appdh_applicationdtlstmp_fk' => 'Appdh Applicationdtlstmp Fk',
            'appdh_applicationdtlsmain_fk' => 'Appdh Applicationdtlsmain Fk',
            'appdh_opalmemberregmst_fk' => 'Appdh Opalmemberregmst Fk',
            'appdh_projectmst_fk' => 'Appdh Projectmst Fk',
            'appdh_grademst_fk' => 'Appdh Grademst Fk',
            'appdh_apptype' => 'Appdh Apptype',
            'appdh_status' => 'Appdh Status',
            'appdh_submittedon' => 'Appdh Submittedon',
            'appdh_submittedby' => 'Appdh Submittedby',
            'appdh_updatedon' => 'Appdh Updatedon',
            'appdh_updatedby' => 'Appdh Updatedby',
            'appdh_certificategenon' => 'Appdh Certificategenon',
            'appdh_certificatepath' => 'Appdh Certificatepath',
            'appdh_certificateexpiry' => 'Appdh Certificateexpiry',
            'appdt_appdecon' => 'Appdt Appdecon',
            'appdt_appdecby' => 'Appdt Appdecby',
            'appdt_appdecComments' => 'Appdt Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppauditschedhstyTbls()
    {
        return $this->hasMany(AppauditschedhstyTbl::className(), ['appasdh_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursedtlshstyTbls()
    {
        return $this->hasMany(AppcoursedtlshstyTbl::className(), ['appcdh_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdocsubmissionhstyTbls()
    {
        return $this->hasMany(AppdocsubmissionhstyTbl::className(), ['appdsh_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintrecoghstyTbls()
    {
        return $this->hasMany(AppintrecoghstyTbl::className(), ['appintih_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdhApplicationdtlsmainFk()
    {
        return $this->hasOne(ApplicationdtlsmainTbl::className(), ['applicationdtlsmain_pk' => 'appdh_applicationdtlsmain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdhApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'appdh_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdhGrademstFk()
    {
        return $this->hasOne(GrademstTbl::className(), ['grademst_pk' => 'appdh_grademst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdhOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appdh_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdhProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'appdh_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoffercoursehstyTbls()
    {
        return $this->hasMany(AppoffercoursehstyTbl::className(), ['appoch_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprcontracthstyTbls()
    {
        return $this->hasMany(AppoprcontracthstyTbl::className(), ['appoprch_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppymtdtlshstyTbls()
    {
        return $this->hasMany(ApppymtdtlshstyTbl::className(), ['apppdh_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfohstyTbls()
    {
        return $this->hasMany(AppstaffinfohstyTbl::className(), ['appsih_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']);
    }

    /**
     * {@inheritdoc}
     * @return ApplicationdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApplicationdtlshstyTblQuery(get_called_class());
    }

    public static function saveApplicationHst($requestdata){

        $model = new ApplicationdtlshstyTbl();
        $model->appdh_applicationdtlstmp_fk = $requestdata['applicationdtlstmp_pk'];
        $model->appdh_opalmemberregmst_fk = $requestdata['appdt_opalmemberregmst_fk'];
        $model->appdh_projectmst_fk = $requestdata['appdt_projectmst_fk'];
        $model->appdh_grademst_fk = $requestdata['appdt_grademst_fk'];
        $model->appdh_apptype = $requestdata['appdt_apptype'];
        $model->appdh_gradingreason = $requestdata['appdt_gradingreason'];
        $model->appdh_recommendation = $requestdata['appdt_recommendation'];
        $model->appdh_status = $requestdata['appdt_status'];
        $model->appdh_submittedon = $requestdata['appdt_submittedon'];
        $model->appdh_submittedby = $requestdata['appdt_submittedby'];
        $model->appdh_updatedon = $requestdata['appdt_updatedon'];
        $model->appdh_updatedby = $requestdata['appdt_updatedby'];
        $model->appdh_verificationno = $requestdata['appdt_verificationno'];
     

        if($model->save()){
            return $model->applicationdtlshsty_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }  
    }
}
