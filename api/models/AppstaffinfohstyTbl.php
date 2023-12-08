<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appstaffinfohsty_tbl".
 *
 * @property int $AppStaffInfoHsty_PK
 * @property int $appsih_AppoStaffInfotmp_FK Reference to appostaffinfo_pk
 * @property int $appsih_AppStaffInfomain_FK Reference to appstaffinfomain_pk
 * @property int $appsih_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $appsih_ApplicationDtlsHsty_FK Reference to applicationdtlshsty_pk
 * @property int $appsih_AppInstInfoMain_FK Reference to appinstinfomain_pk
 * @property int $appsih_AppOfferCourseHsty_FK Reference to appoffercoursetmp_pk, NULL when staff map to standard course
 * @property int $appsih_StaffInfoRepo_FK Reference to staffinforepo_pk
 * @property int $appsih_standardcoursemst_fk NOTNULL only when training institue submitted Course application
 * @property int $appsih_mainrole Reference to rolemst_pk
 * @property string $appsih_jobtitle
 * @property int $appsih_contracttype 1-Temporary, 2-Permanent, by default 1
 * @property int $appsih_roleforcourse 1-Tutor, 2-Trainer, by default 1
 * @property int $appsih_language Reference to referencemst_pk where rm_mastertype=10
 * @property string $appsih_CreatedOn
 * @property int $appsih_CreatedBy
 * @property string $appsih_UpdatedOn
 * @property int $appsih_UpdatedBy
 * @property int $appsih_Status 1-New,2-Updated,3-Approved, 4-Declined,5-Failed
 * @property string $appsih_AppDecOn
 * @property int $appsih_AppDecBy
 * @property string $appsih_AppDecComments
 *
 * @property AppinstinfomainTbl $appsihAppInstInfoMainFK
 * @property ApplicationdtlshstyTbl $appsihApplicationDtlsHstyFK
 * @property AppoffercoursehstyTbl $appsihAppOfferCourseHstyFK
 * @property AppstaffinfotmpTbl $appsihAppoStaffInfotmpFK
 * @property AppstaffinfomainTbl $appsihAppStaffInfomainFK
 * @property RolemstTbl $appsihMainrole
 * @property OpalmemberregmstTbl $appsihOpalMemberRegMstFK
 * @property StaffinforepoTbl $appsihStaffInfoRepoFK
 */
class AppstaffinfohstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appstaffinfohsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appsih_AppoStaffInfotmp_FK', 'appsih_OpalMemberRegMst_FK', 'appsih_ApplicationDtlsHsty_FK', 'appsih_AppInstInfoMain_FK', 'appsih_AppOfferCourseHsty_FK', 'appsih_StaffInfoRepo_FK', 'appsih_mainrole', 'appsih_jobtitle', 'appsih_language', 'appsih_CreatedOn', 'appsih_CreatedBy', 'appsih_Status'], 'required'],
            [['appsih_AppoStaffInfotmp_FK', 'appsih_AppStaffInfomain_FK', 'appsih_OpalMemberRegMst_FK', 'appsih_ApplicationDtlsHsty_FK', 'appsih_AppInstInfoMain_FK', 'appsih_AppOfferCourseHsty_FK', 'appsih_StaffInfoRepo_FK', 'appsih_standardcoursemst_fk', 'appsih_mainrole', 'appsih_contracttype', 'appsih_roleforcourse', 'appsih_language', 'appsih_CreatedBy', 'appsih_UpdatedBy', 'appsih_Status', 'appsih_AppDecBy'], 'integer'],
            [['appsih_jobtitle', 'appsih_AppDecComments'], 'string'],
            [['appsih_CreatedOn', 'appsih_UpdatedOn', 'appsih_AppDecOn'], 'safe'],
            [['appsih_AppInstInfoMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfomainTbl::className(), 'targetAttribute' => ['appsih_AppInstInfoMain_FK' => 'appinstinfomain_pk']],
            [['appsih_ApplicationDtlsHsty_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlshstyTbl::className(), 'targetAttribute' => ['appsih_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']],
            [['appsih_AppOfferCourseHsty_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursehstyTbl::className(), 'targetAttribute' => ['appsih_AppOfferCourseHsty_FK' => 'AppOfferCourseHsty_PK']],
            [['appsih_AppoStaffInfotmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppstaffinfotmpTbl::className(), 'targetAttribute' => ['appsih_AppoStaffInfotmp_FK' => 'appostaffinfotmp_pk']],
            [['appsih_AppStaffInfomain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppstaffinfomainTbl::className(), 'targetAttribute' => ['appsih_AppStaffInfomain_FK' => 'AppStaffInfoMain_PK']],
            [['appsih_mainrole'], 'exist', 'skipOnError' => true, 'targetClass' => RolemstTbl::className(), 'targetAttribute' => ['appsih_mainrole' => 'rolemst_pk']],
            [['appsih_OpalMemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appsih_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']],
            [['appsih_StaffInfoRepo_FK'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['appsih_StaffInfoRepo_FK' => 'staffinforepo_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppStaffInfoHsty_PK' => 'App Staff Info Hsty  Pk',
            'appsih_AppoStaffInfotmp_FK' => 'Appsih  Appo Staff Infotmp  Fk',
            'appsih_AppStaffInfomain_FK' => 'Appsih  App Staff Infomain  Fk',
            'appsih_OpalMemberRegMst_FK' => 'Appsih  Opal Member Reg Mst  Fk',
            'appsih_ApplicationDtlsHsty_FK' => 'Appsih  Application Dtls Hsty  Fk',
            'appsih_AppInstInfoMain_FK' => 'Appsih  App Inst Info Main  Fk',
            'appsih_AppOfferCourseHsty_FK' => 'Appsih  App Offer Course Hsty  Fk',
            'appsih_StaffInfoRepo_FK' => 'Appsih  Staff Info Repo  Fk',
            'appsih_standardcoursemst_fk' => 'Appsih Standardcoursemst Fk',
            'appsih_mainrole' => 'Appsih Mainrole',
            'appsih_jobtitle' => 'Appsih Jobtitle',
            'appsih_contracttype' => 'Appsih Contracttype',
            'appsih_roleforcourse' => 'Appsih Roleforcourse',
            'appsih_language' => 'Appsih Language',
            'appsih_CreatedOn' => 'Appsih  Created On',
            'appsih_CreatedBy' => 'Appsih  Created By',
            'appsih_UpdatedOn' => 'Appsih  Updated On',
            'appsih_UpdatedBy' => 'Appsih  Updated By',
            'appsih_Status' => 'Appsih  Status',
            'appsih_AppDecOn' => 'Appsih  App Dec On',
            'appsih_AppDecBy' => 'Appsih  App Dec By',
            'appsih_AppDecComments' => 'Appsih  App Dec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsihAppInstInfoMainFK()
    {
        return $this->hasOne(AppinstinfomainTbl::className(), ['appinstinfomain_pk' => 'appsih_AppInstInfoMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsihApplicationDtlsHstyFK()
    {
        return $this->hasOne(ApplicationdtlshstyTbl::className(), ['applicationdtlshsty_pk' => 'appsih_ApplicationDtlsHsty_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsihAppOfferCourseHstyFK()
    {
        return $this->hasOne(AppoffercoursehstyTbl::className(), ['AppOfferCourseHsty_PK' => 'appsih_AppOfferCourseHsty_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsihAppoStaffInfotmpFK()
    {
        return $this->hasOne(AppstaffinfotmpTbl::className(), ['appostaffinfotmp_pk' => 'appsih_AppoStaffInfotmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsihAppStaffInfomainFK()
    {
        return $this->hasOne(AppstaffinfomainTbl::className(), ['AppStaffInfoMain_PK' => 'appsih_AppStaffInfomain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsihMainrole()
    {
        return $this->hasOne(RolemstTbl::className(), ['rolemst_pk' => 'appsih_mainrole']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsihOpalMemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appsih_OpalMemberRegMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsihStaffInfoRepoFK()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'appsih_StaffInfoRepo_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppstaffinfohstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppstaffinfohstyTblQuery(get_called_class());
    }
}
