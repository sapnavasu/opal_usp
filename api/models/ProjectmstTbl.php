<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projectmst_tbl".
 *
 * @property int $projectmst_pk
 * @property int $pm_projtype 1-OPAL STAR, 2-Technical Evaluation
 * @property string $pm_projectname_en
 * @property string $pm_projectname_ar
 * @property int $pm_status 1-Active, 2-Inactive
 * @property string $pm_createdon
 * @property int $pm_createdby
 * @property string $pm_updatedon
 * @property int $pm_updatedby
 *
 * @property ApplicationdtlshstyTbl[] $applicationdtlshstyTbls
 * @property ApplicationdtlsmainTbl[] $applicationdtlsmainTbls
 * @property ApplicationdtlstmpTbl[] $applicationdtlstmpTbls
 * @property AuditchklstmstTbl[] $auditchklstmstTbls
 * @property AuditscheddtlsTbl[] $auditscheddtlsTbls
 * @property AuditschedhstyTbl[] $auditschedhstyTbls
 * @property AuditschedmainTbl[] $auditschedmainTbls
 * @property DocumentdtlsmstTbl[] $documentdtlsmstTbls
 * @property RolemstTbl[] $rolemstTbls
 * @property StandardcoursemstTbl[] $standardcoursemstTbls
 */
class ProjectmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projectmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pm_projtype', 'pm_projectname_en', 'pm_projectname_ar', 'pm_createdby'], 'required'],
            [['pm_projtype', 'pm_status', 'pm_createdby', 'pm_updatedby'], 'integer'],
            [['pm_createdon', 'pm_updatedon'], 'safe'],
            [['pm_projectname_en', 'pm_projectname_ar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projectmst_pk' => 'Projectmst Pk',
            'pm_projtype' => 'Pm Projtype',
            'pm_projectname_en' => 'Pm Projectname En',
            'pm_projectname_ar' => 'Pm Projectname Ar',
            'pm_status' => 'Pm Status',
            'pm_createdon' => 'Pm Createdon',
            'pm_createdby' => 'Pm Createdby',
            'pm_updatedon' => 'Pm Updatedon',
            'pm_updatedby' => 'Pm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationdtlshstyTbls()
    {
        return $this->hasMany(ApplicationdtlshstyTbl::className(), ['appdh_projectmst_fk' => 'projectmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationdtlsmainTbls()
    {
        return $this->hasMany(ApplicationdtlsmainTbl::className(), ['appdm_projectmst_fk' => 'projectmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationdtlstmpTbls()
    {
        return $this->hasMany(ApplicationdtlstmpTbl::className(), ['appdt_projectmst_fk' => 'projectmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditchklstmstTbls()
    {
        return $this->hasMany(AuditchklstmstTbl::className(), ['acm_projectmst_fk' => 'projectmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditscheddtlsTbls()
    {
        return $this->hasMany(AuditscheddtlsTbl::className(), ['asd_projectmst_fk' => 'projectmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditschedhstyTbls()
    {
        return $this->hasMany(AuditschedhstyTbl::className(), ['ash_ProjectMst_FK' => 'projectmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditschedmainTbls()
    {
        return $this->hasMany(AuditschedmainTbl::className(), ['asm_ProjectMst_FK' => 'projectmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentdtlsmstTbls()
    {
        return $this->hasMany(DocumentdtlsmstTbl::className(), ['ddm_projectmst_fk' => 'projectmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolemstTbls()
    {
        return $this->hasMany(RolemstTbl::className(), ['rm_projectmst_fk' => 'projectmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStandardcoursemstTbls()
    {
        return $this->hasMany(StandardcoursemstTbl::className(), ['scm_projectmst_fk' => 'projectmst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectmstTblQuery(get_called_class());
    }

    public function getProject(){
        return self::find()->andwhere(['!=','projectmst_pk','2'])->andwhere(['!=','projectmst_pk','3'])->asArray()->all();
    }
}
