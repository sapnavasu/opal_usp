<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appoffercoursehsty_tbl".
 *
 * @property int $AppOfferCourseHsty_PK
 * @property int $appoch_AppOfferCoursetmp_FK Reference to appoffercoursetmp_pk
 * @property int $appoch_AppOfferCourseMain_PK Reference to appoffercoursemain_pk
 * @property int $appoch_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $appoch_ApplicationDtlsHsty_FK Reference to applicationdtlshsty_pk
 * @property string $appoch_CourseName_en
 * @property string $appoch_CourseName_ar
 * @property string $appoch_courseDuration
 * @property int $appoch_FoundationProg 1-Yes, 2-No
 * @property int $appoch_CourseLevel Reference to referencemst_pk where rm_mastertype=3
 * @property int $appoch_CourseCategoryMst_FK Reference to coursecategorymst_pk
 * @property int $appoch_CourseSubcategoryMst_FK Reference to coursecategorymst_pk
 * @property int $appoch_CourseTested Reference to referencemst_pk where rm_mastertype=8
 * @property string $appoch_AppIntRecogTmp_FK Reference to appintrecogtmp_pk, separated by comma Enable this only when at least one International recognition and accreditation added.
 * @property string $appoch_CreatedOn
 * @property int $appoch_CreatedBy
 * @property string $appoch_UpdatedOn
 * @property int $appocm_UpdatedBy
 * @property int $appoch_status 1-New,2-Updated,3-Approved, 4-Declined
 * @property string $appoch_AppDecOn
 * @property int $appoch_AppDecBy
 * @property string $appoch_AppDecComments
 *
 * @property ApplicationdtlshstyTbl $appochApplicationDtlsHstyFK
 * @property AppoffercoursemainTbl $appochAppOfferCourseMainPK
 * @property AppoffercoursetmpTbl $appochAppOfferCoursetmpFK
 * @property OpalmemberregmstTbl $appochOpalMemberRegMstFK
 * @property AppoffercourseunithstyTbl[] $appoffercourseunithstyTbls
 * @property AppstaffinfohstyTbl[] $appstaffinfohstyTbls
 */
class AppoffercoursehstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appoffercoursehsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appoch_AppOfferCoursetmp_FK', 'appoch_OpalMemberRegMst_FK', 'appoch_ApplicationDtlsHsty_FK', 'appoch_CourseName_en', 'appoch_CourseName_ar', 'appoch_courseDuration', 'appoch_FoundationProg', 'appoch_CourseLevel', 'appoch_CourseCategoryMst_FK', 'appoch_CourseSubcategoryMst_FK', 'appoch_CourseTested', 'appoch_CreatedOn', 'appoch_CreatedBy', 'appoch_status'], 'required'],
            [['appoch_AppOfferCoursetmp_FK', 'appoch_AppOfferCourseMain_PK', 'appoch_OpalMemberRegMst_FK', 'appoch_ApplicationDtlsHsty_FK', 'appoch_FoundationProg', 'appoch_CourseLevel', 'appoch_CourseCategoryMst_FK', 'appoch_CourseSubcategoryMst_FK', 'appoch_CourseTested', 'appoch_CreatedBy', 'appocm_UpdatedBy', 'appoch_status', 'appoch_AppDecBy'], 'integer'],
            [['appoch_AppIntRecogTmp_FK', 'appoch_AppDecComments'], 'string'],
            [['appoch_CreatedOn', 'appoch_UpdatedOn', 'appoch_AppDecOn'], 'safe'],
            [['appoch_CourseName_en', 'appoch_CourseName_ar', 'appoch_courseDuration'], 'string', 'max' => 255],
            [['appoch_ApplicationDtlsHsty_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlshstyTbl::className(), 'targetAttribute' => ['appoch_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']],
            [['appoch_AppOfferCourseMain_PK'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursemainTbl::className(), 'targetAttribute' => ['appoch_AppOfferCourseMain_PK' => 'appoffercoursemain_pk']],
            [['appoch_AppOfferCoursetmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursetmpTbl::className(), 'targetAttribute' => ['appoch_AppOfferCoursetmp_FK' => 'appoffercoursetmp_pk']],
            [['appoch_OpalMemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appoch_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppOfferCourseHsty_PK' => 'App Offer Course Hsty  Pk',
            'appoch_AppOfferCoursetmp_FK' => 'Appoch  App Offer Coursetmp  Fk',
            'appoch_AppOfferCourseMain_PK' => 'Appoch  App Offer Course Main  Pk',
            'appoch_OpalMemberRegMst_FK' => 'Appoch  Opal Member Reg Mst  Fk',
            'appoch_ApplicationDtlsHsty_FK' => 'Appoch  Application Dtls Hsty  Fk',
            'appoch_CourseName_en' => 'Appoch  Course Name En',
            'appoch_CourseName_ar' => 'Appoch  Course Name Ar',
            'appoch_courseDuration' => 'Appoch Course Duration',
            'appoch_FoundationProg' => 'Appoch  Foundation Prog',
            'appoch_CourseLevel' => 'Appoch  Course Level',
            'appoch_CourseCategoryMst_FK' => 'Appoch  Course Category Mst  Fk',
            'appoch_CourseSubcategoryMst_FK' => 'Appoch  Course Subcategory Mst  Fk',
            'appoch_CourseTested' => 'Appoch  Course Tested',
            'appoch_AppIntRecogTmp_FK' => 'Appoch  App Int Recog Tmp  Fk',
            'appoch_CreatedOn' => 'Appoch  Created On',
            'appoch_CreatedBy' => 'Appoch  Created By',
            'appoch_UpdatedOn' => 'Appoch  Updated On',
            'appocm_UpdatedBy' => 'Appocm  Updated By',
            'appoch_status' => 'Appoch Status',
            'appoch_AppDecOn' => 'Appoch  App Dec On',
            'appoch_AppDecBy' => 'Appoch  App Dec By',
            'appoch_AppDecComments' => 'Appoch  App Dec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppochApplicationDtlsHstyFK()
    {
        return $this->hasOne(ApplicationdtlshstyTbl::className(), ['applicationdtlshsty_pk' => 'appoch_ApplicationDtlsHsty_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppochAppOfferCourseMainPK()
    {
        return $this->hasOne(AppoffercoursemainTbl::className(), ['appoffercoursemain_pk' => 'appoch_AppOfferCourseMain_PK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppochAppOfferCoursetmpFK()
    {
        return $this->hasOne(AppoffercoursetmpTbl::className(), ['appoffercoursetmp_pk' => 'appoch_AppOfferCoursetmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppochOpalMemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appoch_OpalMemberRegMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoffercourseunithstyTbls()
    {
        return $this->hasMany(AppoffercourseunithstyTbl::className(), ['appocuh_AppOfferCourseHsty_FK' => 'AppOfferCourseHsty_PK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfohstyTbls()
    {
        return $this->hasMany(AppstaffinfohstyTbl::className(), ['appsih_AppOfferCourseHsty_FK' => 'AppOfferCourseHsty_PK']);
    }

    /**
     * {@inheritdoc}
     * @return AppoffercoursehstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppoffercoursehstyTblQuery(get_called_class());
    }
}
