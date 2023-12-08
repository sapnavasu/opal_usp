<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appinstinfohsty_tbl".
 *
 * @property int $AppInstInfoHsty_PK
 * @property int $appiih_AppInstInfoTmp_FK Reference to appinstinfotmp_pk
 * @property int $appiih_AppInstInfoMain_FK Reference to appinstinfomain_pk
 * @property int $appiih_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $appiih_ApplicationDtlsHsty_FK Reference to applicationdtlstmp_pk
 * @property string $appiih_BranchName_en
 * @property string $appiih_BranchName_ar
 * @property int $appiih_OfficeType 1-Main office, 2-branch office
 * @property int $appiih_NoOfExpAt
 * @property int $appiih_NoOfOmani
 * @property string $appiih_LocLatitude
 * @property string $appiih_LocLongitude
 * @property string $appiih_LocMapUrl
 * @property string $appiih_MolPercent
 * @property int $appiih_NoOfTechStaff
 * @property int $appiih_NoOfCurLearners
 * @property int $appiih_MaxCapacity
 * @property string $appiih_AddrLine1
 * @property string $appiih_AddrLine2
 * @property int $appiih_StateMst_FK Reference to opalstatemst_pk
 * @property int $appiih_Citymst_FK Reference to opalcitymst_pk
 * @property string $appiih_CreatedOn
 * @property int $appiih_CreatedBy
 * @property string $appiih_UpdatedOn
 * @property int $appiih_UpdatedBy
 * @property int $appiih_Status 1-New,2-Updated,3-Approved, 4-Declined
 * @property string $appiih_AppDecOn
 * @property int $appiih_AppDecBy
 * @property string $appiih_AppDecComments
 *
 * @property AppinstinfomainTbl $appiihAppInstInfoMainFK
 * @property AppinstinfotmpTbl $appiihAppInstInfoTmpFK
 * @property ApplicationdtlstmpTbl $appiihApplicationDtlsHstyFK
 * @property OpalcitymstTbl $appiihCitymstFK
 * @property OpalstatemstTbl $appiihStateMstFK
 */
class AppinstinfohstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appinstinfohsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appiih_AppInstInfoTmp_FK', 'appiih_OpalMemberRegMst_FK', 'appiih_ApplicationDtlsHsty_FK', 'appiih_OfficeType', 'appiih_NoOfExpAt', 'appiih_NoOfOmani', 'appiih_MolPercent', 'appiih_NoOfTechStaff', 'appiih_NoOfCurLearners', 'appiih_MaxCapacity', 'appiih_CreatedOn', 'appiih_CreatedBy', 'appiih_Status'], 'required'],
            [['appiih_AppInstInfoTmp_FK', 'appiih_AppInstInfoMain_FK', 'appiih_OpalMemberRegMst_FK', 'appiih_ApplicationDtlsHsty_FK', 'appiih_OfficeType', 'appiih_NoOfExpAt', 'appiih_NoOfOmani', 'appiih_NoOfTechStaff', 'appiih_NoOfCurLearners', 'appiih_MaxCapacity', 'appiih_StateMst_FK', 'appiih_Citymst_FK', 'appiih_CreatedBy', 'appiih_UpdatedBy', 'appiih_Status', 'appiih_AppDecBy'], 'integer'],
            [['appiih_LocLatitude', 'appiih_LocLongitude', 'appiih_LocMapUrl', 'appiih_AddrLine1', 'appiih_AddrLine2', 'appiih_AppDecComments'], 'string'],
            [['appiih_MolPercent'], 'number'],
            [['appiih_CreatedOn', 'appiih_UpdatedOn', 'appiih_AppDecOn'], 'safe'],
            [['appiih_BranchName_en', 'appiih_BranchName_ar'], 'string', 'max' => 100],
            [['appiih_AppInstInfoMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfomainTbl::className(), 'targetAttribute' => ['appiih_AppInstInfoMain_FK' => 'appinstinfomain_pk']],
            [['appiih_AppInstInfoTmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfotmpTbl::className(), 'targetAttribute' => ['appiih_AppInstInfoTmp_FK' => 'appinstinfotmp_pk']],
            [['appiih_ApplicationDtlsHsty_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appiih_ApplicationDtlsHsty_FK' => 'applicationdtlstmp_pk']],
            [['appiih_Citymst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalcitymstTbl::className(), 'targetAttribute' => ['appiih_Citymst_FK' => 'opalcitymst_pk']],
            [['appiih_StateMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalstatemstTbl::className(), 'targetAttribute' => ['appiih_StateMst_FK' => 'opalstatemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppInstInfoHsty_PK' => 'App Inst Info Hsty  Pk',
            'appiih_AppInstInfoTmp_FK' => 'Appiih  App Inst Info Tmp  Fk',
            'appiih_AppInstInfoMain_FK' => 'Appiih  App Inst Info Main  Fk',
            'appiih_OpalMemberRegMst_FK' => 'Appiih  Opal Member Reg Mst  Fk',
            'appiih_ApplicationDtlsHsty_FK' => 'Appiih  Application Dtls Hsty  Fk',
            'appiih_BranchName_en' => 'Appiih  Branch Name En',
            'appiih_BranchName_ar' => 'Appiih  Branch Name Ar',
            'appiih_OfficeType' => 'Appiih  Office Type',
            'appiih_NoOfExpAt' => 'Appiih  No Of Exp At',
            'appiih_NoOfOmani' => 'Appiih  No Of Omani',
            'appiih_LocLatitude' => 'Appiih  Loc Latitude',
            'appiih_LocLongitude' => 'Appiih  Loc Longitude',
            'appiih_LocMapUrl' => 'Appiih  Loc Map Url',
            'appiih_MolPercent' => 'Appiih  Mol Percent',
            'appiih_NoOfTechStaff' => 'Appiih  No Of Tech Staff',
            'appiih_NoOfCurLearners' => 'Appiih  No Of Cur Learners',
            'appiih_MaxCapacity' => 'Appiih  Max Capacity',
            'appiih_AddrLine1' => 'Appiih  Addr Line1',
            'appiih_AddrLine2' => 'Appiih  Addr Line2',
            'appiih_StateMst_FK' => 'Appiih  State Mst  Fk',
            'appiih_Citymst_FK' => 'Appiih  Citymst  Fk',
            'appiih_CreatedOn' => 'Appiih  Created On',
            'appiih_CreatedBy' => 'Appiih  Created By',
            'appiih_UpdatedOn' => 'Appiih  Updated On',
            'appiih_UpdatedBy' => 'Appiih  Updated By',
            'appiih_Status' => 'Appiih  Status',
            'appiih_AppDecOn' => 'Appiih  App Dec On',
            'appiih_AppDecBy' => 'Appiih  App Dec By',
            'appiih_AppDecComments' => 'Appiih  App Dec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppiihAppInstInfoMainFK()
    {
        return $this->hasOne(AppinstinfomainTbl::className(), ['appinstinfomain_pk' => 'appiih_AppInstInfoMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppiihAppInstInfoTmpFK()
    {
        return $this->hasOne(AppinstinfotmpTbl::className(), ['appinstinfotmp_pk' => 'appiih_AppInstInfoTmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppiihApplicationDtlsHstyFK()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'appiih_ApplicationDtlsHsty_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppiihCitymstFK()
    {
        return $this->hasOne(OpalcitymstTbl::className(), ['opalcitymst_pk' => 'appiih_Citymst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppiihStateMstFK()
    {
        return $this->hasOne(OpalstatemstTbl::className(), ['opalstatemst_pk' => 'appiih_StateMst_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppinstinfohstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppinstinfohstyTblQuery(get_called_class());
    }
}
