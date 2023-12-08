<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appauditschedtmp_tbl".
 *
 * @property int $appauditschedtmp_pk Primary Key
 * @property int $appasdt_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $appasdt_auditscheddtls_fk Reference to auditscheddtls_pk
 * @property string $appasdt_createdon
 * @property int $appasdt_createdby
 * @property string $appasdt_updatedon
 * @property int $appasdt_updatedby
 * @property int $appasdt_status 1 - Audit Pending, 2 - Audit Report Approval In-progress, 3 - Approved
 * @property string $appasdt_appdecon
 * @property int $appasdt_appdecby
 * @property string $appasdt_appdeccomment
 *
 * @property AppauditschedhstyTbl[] $appauditschedhstyTbls
 * @property AppauditschedmainTbl[] $appauditschedmainTbls
 * @property ApplicationdtlstmpTbl $appasdtApplicationdtlstmpFk
 * @property AuditscheddtlsTbl $appasdtAuditscheddtlsFk
 * @property AppsiteauditreportcatmainTbl[] $appsiteauditreportcatmainTbls
 * @property AuditscheddtlsTbl[] $auditscheddtlsTbls
 */
class AppauditschedtmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appauditschedtmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appasdt_applicationdtlstmp_fk', 'appasdt_createdby', 'appasdt_status'], 'required'],
            [['appasdt_applicationdtlstmp_fk', 'appasdt_auditscheddtls_fk', 'appasdt_createdby', 'appasdt_updatedby', 'appasdt_status', 'appasdt_appdecby'], 'integer'],
            [['appasdt_createdon', 'appasdt_updatedon', 'appasdt_appdecon'], 'safe'],
            [['appasdt_appdeccomment'], 'string'],
            [['appasdt_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appasdt_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            //[['appasdt_auditscheddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AuditscheddtlsTbl::className(), 'targetAttribute' => ['appasdt_auditscheddtls_fk' => 'auditscheddtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appauditschedtmp_pk' => 'Appauditschedtmp Pk',
            'appasdt_applicationdtlstmp_fk' => 'Appasdt Applicationdtlstmp Fk',
            'appasdt_auditscheddtls_fk' => 'Appasdt Auditscheddtls Fk',
            'appasdt_createdon' => 'Appasdt Createdon',
            'appasdt_createdby' => 'Appasdt Createdby',
            'appasdt_updatedon' => 'Appasdt Updatedon',
            'appasdt_updatedby' => 'Appasdt Updatedby',
            'appasdt_status' => 'Appasdt Status',
            'appasdt_appdecon' => 'Appasdt Appdecon',
            'appasdt_appdecby' => 'Appasdt Appdecby',
            'appasdt_appdeccomment' => 'Appasdt Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppauditschedhstyTbls()
    {
        return $this->hasMany(AppauditschedhstyTbl::className(), ['appasdh_AppAuditSchedTmp_FK' => 'appauditschedtmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppauditschedmainTbls()
    {
        return $this->hasMany(AppauditschedmainTbl::className(), ['appasdm_AppAuditSchedTmp_FK' => 'appauditschedtmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppasdtApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'appasdt_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppasdtAuditscheddtlsFk()
    {
        //return $this->hasOne(AuditscheddtlsTbl::className(), ['auditscheddtls_pk' => 'appasdt_auditscheddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditreportcatmainTbls()
    {
        return $this->hasMany(AppsiteauditreportcatmainTbl::className(), ['asarcm_appauditschedtmp_fk' => 'appauditschedtmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditscheddtlsTbls()
    {
        //return $this->hasMany(AuditscheddtlsTbl::className(), ['asd_appauditschedtmp_fk' => 'appauditschedtmp_pk']);
    }

    /**
     * {@inheritdoc}
     * @return AppauditschedtmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppauditschedtmpTblQuery(get_called_class());
    }
}
