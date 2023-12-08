<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appdocsubmissionmain_tbl".
 *
 * @property int $AppDocSubmissionMain_PK
 * @property int $appdsm_AppDocSubmissionTmp_FK Reference to appdocsubmissiontmp_pk
 * @property int $appdsm_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $appdsm_ApplicationDtlsMain_FK Reference to applicationdtlsmain_pk
 * @property int $appdsm_DocumentDtlsMst_FK
 * @property int $appdsm_SubmissionStatus 1-Yes, 2-No
 * @property string $appdsm_Upload
 * @property string $appdsm_Remarks
 * @property string $appdsm_UpdatedOn
 * @property int $appdsm_UpdatedBy
 *
 * @property AppdocsubmissionhstyTbl[] $appdocsubmissionhstyTbls
 * @property AppdocsubmissiontmpTbl $appdsmAppDocSubmissionTmpFK
 * @property ApplicationdtlsmainTbl $appdsmApplicationDtlsMainFK
 * @property DocumentdtlsmstTbl $appdsmDocumentDtlsMstFK
 * @property OpalmemberregmstTbl $appdsmOpalMemberRegMstFK
 */
class AppdocsubmissionmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appdocsubmissionmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appdsm_AppDocSubmissionTmp_FK', 'appdsm_OpalMemberRegMst_FK', 'appdsm_ApplicationDtlsMain_FK', 'appdsm_DocumentDtlsMst_FK', 'appdsm_SubmissionStatus'], 'required'],
            [['appdsm_AppDocSubmissionTmp_FK', 'appdsm_OpalMemberRegMst_FK', 'appdsm_ApplicationDtlsMain_FK', 'appdsm_DocumentDtlsMst_FK', 'appdsm_SubmissionStatus', 'appdsm_UpdatedBy'], 'integer'],
            [['appdsm_Remarks'], 'string'],
            [['appdsm_UpdatedOn'], 'safe'],
            [['appdsm_Upload'], 'string', 'max' => 255],
            [['appdsm_AppDocSubmissionTmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppdocsubmissiontmpTbl::className(), 'targetAttribute' => ['appdsm_AppDocSubmissionTmp_FK' => 'appdocsubmissiontmp_pk']],
            [['appdsm_ApplicationDtlsMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlsmainTbl::className(), 'targetAttribute' => ['appdsm_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']],
            [['appdsm_DocumentDtlsMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentdtlsmstTbl::className(), 'targetAttribute' => ['appdsm_DocumentDtlsMst_FK' => 'documentdtlsmst_pk']],
            [['appdsm_OpalMemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appdsm_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppDocSubmissionMain_PK' => 'App Doc Submission Main  Pk',
            'appdsm_AppDocSubmissionTmp_FK' => 'Appdsm  App Doc Submission Tmp  Fk',
            'appdsm_OpalMemberRegMst_FK' => 'Appdsm  Opal Member Reg Mst  Fk',
            'appdsm_ApplicationDtlsMain_FK' => 'Appdsm  Application Dtls Main  Fk',
            'appdsm_DocumentDtlsMst_FK' => 'Appdsm  Document Dtls Mst  Fk',
            'appdsm_SubmissionStatus' => 'Appdsm  Submission Status',
            'appdsm_Upload' => 'Appdsm  Upload',
            'appdsm_Remarks' => 'Appdsm  Remarks',
            'appdsm_UpdatedOn' => 'Appdsm  Updated On',
            'appdsm_UpdatedBy' => 'Appdsm  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdocsubmissionhstyTbls()
    {
        return $this->hasMany(AppdocsubmissionhstyTbl::className(), ['appdsh_AppDocSubmissionMain_FK' => 'AppDocSubmissionMain_PK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdsmAppDocSubmissionTmpFK()
    {
        return $this->hasOne(AppdocsubmissiontmpTbl::className(), ['appdocsubmissiontmp_pk' => 'appdsm_AppDocSubmissionTmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdsmApplicationDtlsMainFK()
    {
        return $this->hasOne(ApplicationdtlsmainTbl::className(), ['applicationdtlsmain_pk' => 'appdsm_ApplicationDtlsMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdsmDocumentDtlsMstFK()
    {
        return $this->hasOne(DocumentdtlsmstTbl::className(), ['documentdtlsmst_pk' => 'appdsm_DocumentDtlsMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdsmOpalMemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appdsm_OpalMemberRegMst_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppdocsubmissionmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppdocsubmissionmainTblQuery(get_called_class());
    }
}
