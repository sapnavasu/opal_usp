<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appdocsubmissionhsty_tbl".
 *
 * @property int $appdocsubmissionhsty_pk
 * @property int $appdsh_AppDocSubmissionTmp_FK Reference to appdocsubmissiontmp_pk
 * @property int $appdsh_AppDocSubmissionMain_FK Referebce to appdocsubmissionmain_pk
 * @property int $appdsh_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $appdsh_ApplicationDtlsHsty_FK Reference to applicationdtlshsty_pk
 * @property int $appdsh_DocumentdtlsMst_FK
 * @property int $appdsh_SubmissionStatus 1-Yes, 2-No
 * @property string $appdsh_Upload
 * @property string $appdsh_Remarks
 * @property string $appdsh_CreatedOn
 * @property int $appdsh_createdBy
 * @property string $appdsh_UpdatedOn
 * @property int $appdsh_UpdatedBy
 * @property int $appdsh_Status 1-New,2-Updated,3-Approved, 4-Declined
 * @property string $appdsh_AppDecOn
 * @property int $appdsh_AppDecBy
 * @property string $appdsh_AppDecComments
 *
 * @property AppdocsubmissionmainTbl $appdshAppDocSubmissionMainFK
 * @property AppdocsubmissiontmpTbl $appdshAppDocSubmissionTmpFK
 * @property ApplicationdtlshstyTbl $appdshApplicationDtlsHstyFK
 * @property DocumentdtlsmstTbl $appdshDocumentdtlsMstFK
 * @property OpalmemberregmstTbl $appdshOpalMemberRegMstFK
 */
class AppdocsubmissionhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appdocsubmissionhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appdsh_AppDocSubmissionTmp_FK', 'appdsh_OpalMemberRegMst_FK', 'appdsh_ApplicationDtlsHsty_FK', 'appdsh_DocumentdtlsMst_FK', 'appdsh_SubmissionStatus', 'appdsh_CreatedOn', 'appdsh_createdBy', 'appdsh_Status'], 'required'],
            [['appdsh_AppDocSubmissionTmp_FK', 'appdsh_AppDocSubmissionMain_FK', 'appdsh_OpalMemberRegMst_FK', 'appdsh_ApplicationDtlsHsty_FK', 'appdsh_DocumentdtlsMst_FK', 'appdsh_SubmissionStatus', 'appdsh_createdBy', 'appdsh_UpdatedBy', 'appdsh_Status', 'appdsh_AppDecBy'], 'integer'],
            [['appdsh_Remarks', 'appdsh_AppDecComments'], 'string'],
            [['appdsh_CreatedOn', 'appdsh_UpdatedOn', 'appdsh_AppDecOn'], 'safe'],
            [['appdsh_Upload'], 'string', 'max' => 255],
            [['appdsh_AppDocSubmissionMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppdocsubmissionmainTbl::className(), 'targetAttribute' => ['appdsh_AppDocSubmissionMain_FK' => 'AppDocSubmissionMain_PK']],
            [['appdsh_AppDocSubmissionTmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppdocsubmissiontmpTbl::className(), 'targetAttribute' => ['appdsh_AppDocSubmissionTmp_FK' => 'appdocsubmissiontmp_pk']],
            [['appdsh_ApplicationDtlsHsty_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlshstyTbl::className(), 'targetAttribute' => ['appdsh_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']],
            [['appdsh_DocumentdtlsMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentdtlsmstTbl::className(), 'targetAttribute' => ['appdsh_DocumentdtlsMst_FK' => 'documentdtlsmst_pk']],
            [['appdsh_OpalMemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appdsh_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appdocsubmissionhsty_pk' => 'Appdocsubmissionhsty Pk',
            'appdsh_AppDocSubmissionTmp_FK' => 'Appdsh  App Doc Submission Tmp  Fk',
            'appdsh_AppDocSubmissionMain_FK' => 'Appdsh  App Doc Submission Main  Fk',
            'appdsh_OpalMemberRegMst_FK' => 'Appdsh  Opal Member Reg Mst  Fk',
            'appdsh_ApplicationDtlsHsty_FK' => 'Appdsh  Application Dtls Hsty  Fk',
            'appdsh_DocumentdtlsMst_FK' => 'Appdsh  Documentdtls Mst  Fk',
            'appdsh_SubmissionStatus' => 'Appdsh  Submission Status',
            'appdsh_Upload' => 'Appdsh  Upload',
            'appdsh_Remarks' => 'Appdsh  Remarks',
            'appdsh_CreatedOn' => 'Appdsh  Created On',
            'appdsh_createdBy' => 'Appdsh Created By',
            'appdsh_UpdatedOn' => 'Appdsh  Updated On',
            'appdsh_UpdatedBy' => 'Appdsh  Updated By',
            'appdsh_Status' => 'Appdsh  Status',
            'appdsh_AppDecOn' => 'Appdsh  App Dec On',
            'appdsh_AppDecBy' => 'Appdsh  App Dec By',
            'appdsh_AppDecComments' => 'Appdsh  App Dec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdshAppDocSubmissionMainFK()
    {
        return $this->hasOne(AppdocsubmissionmainTbl::className(), ['AppDocSubmissionMain_PK' => 'appdsh_AppDocSubmissionMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdshAppDocSubmissionTmpFK()
    {
        return $this->hasOne(AppdocsubmissiontmpTbl::className(), ['appdocsubmissiontmp_pk' => 'appdsh_AppDocSubmissionTmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdshApplicationDtlsHstyFK()
    {
        return $this->hasOne(ApplicationdtlshstyTbl::className(), ['applicationdtlshsty_pk' => 'appdsh_ApplicationDtlsHsty_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdshDocumentdtlsMstFK()
    {
        return $this->hasOne(DocumentdtlsmstTbl::className(), ['documentdtlsmst_pk' => 'appdsh_DocumentdtlsMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdshOpalMemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appdsh_OpalMemberRegMst_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppdocsubmissionhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppdocsubmissionhstyTblQuery(get_called_class());
    }
}
