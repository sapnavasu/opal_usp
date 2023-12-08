<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appoffercoursemain_tbl".
 *
 * @property int $appoffercoursemain_pk
 * @property int $appocm_appoffercoursetmp_fk Reference to appoffercoursetmp_pk
 * @property int $appocm_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $appocm_applicationdtlsmain_fk Reference to applicationdtlsmain_pk
 * @property string $appocm_coursename_en
 * @property string $appocm_coursename_ar
 * @property string $appocm_courseduration
 * @property int $appocm_foundationprog 1-Yes, 2-No
 * @property int $appocm_courselevel Reference to referencemst_pk where rm_mastertype=3
 * @property int $appocm_coursecategorymst_fk Reference to coursecategorymst_pk
 * @property int $appocm_coursesubcategorymst_fk Reference to coursecategorymst_pk
 * @property string $appocm_coursetested Reference to referencemst_pk where rm_mastertype=8
 * @property string $appocm_appintrecogtmp_fk Reference to appintrecogtmp_pk, separated by comma Enable this only when at least one International recognition and accreditation added.
 * @property string $appocm_updatedon
 * @property int $appocm_updatedby
 *
 * @property AppoffercoursehstyTbl[] $appoffercoursehstyTbls
 * @property ApplicationdtlsmainTbl $appocmApplicationdtlsmainFk
 * @property AppoffercoursetmpTbl $appocmAppoffercoursetmpFk
 * @property CoursecategorymstTbl $appocmCoursecategorymstFk
 * @property CoursecategorymstTbl $appocmCoursesubcategorymstFk
 * @property OpalmemberregmstTbl $appocmOpalmemberregmstFk
 * @property AppoffercourseunitmainTbl[] $appoffercourseunitmainTbls
 * @property AppstaffinfomainTbl[] $appstaffinfomainTbls
 * @property StandardcoursemstTbl[] $standardcoursemstTbls
 */
class AppoffercoursemainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appoffercoursemain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appocm_appoffercoursetmp_fk', 'appocm_opalmemberregmst_fk', 'appocm_applicationdtlsmain_fk', 'appocm_coursename_en', 'appocm_coursename_ar', 'appocm_courseduration', 'appocm_foundationprog', 'appocm_courselevel', 'appocm_coursecategorymst_fk', 'appocm_coursesubcategorymst_fk', 'appocm_coursetested'], 'required'],
            [['appocm_appoffercoursetmp_fk', 'appocm_opalmemberregmst_fk', 'appocm_applicationdtlsmain_fk', 'appocm_foundationprog', 'appocm_courselevel', 'appocm_coursecategorymst_fk', 'appocm_coursesubcategorymst_fk', 'appocm_updatedby'], 'integer'],
            [['appocm_coursetested', 'appocm_appintrecogtmp_fk'], 'string'],
            [['appocm_updatedon'], 'safe'],
            [['appocm_coursename_en', 'appocm_coursename_ar', 'appocm_courseduration'], 'string', 'max' => 255],
            [['appocm_applicationdtlsmain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlsmainTbl::className(), 'targetAttribute' => ['appocm_applicationdtlsmain_fk' => 'applicationdtlsmain_pk']],
            [['appocm_appoffercoursetmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursetmpTbl::className(), 'targetAttribute' => ['appocm_appoffercoursetmp_fk' => 'appoffercoursetmp_pk']],
            [['appocm_coursecategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['appocm_coursecategorymst_fk' => 'coursecategorymst_pk']],
            [['appocm_coursesubcategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['appocm_coursesubcategorymst_fk' => 'coursecategorymst_pk']],
            [['appocm_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appocm_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appoffercoursemain_pk' => 'Appoffercoursemain Pk',
            'appocm_appoffercoursetmp_fk' => 'Appocm Appoffercoursetmp Fk',
            'appocm_opalmemberregmst_fk' => 'Appocm Opalmemberregmst Fk',
            'appocm_applicationdtlsmain_fk' => 'Appocm Applicationdtlsmain Fk',
            'appocm_coursename_en' => 'Appocm Coursename En',
            'appocm_coursename_ar' => 'Appocm Coursename Ar',
            'appocm_courseduration' => 'Appocm Courseduration',
            'appocm_foundationprog' => 'Appocm Foundationprog',
            'appocm_courselevel' => 'Appocm Courselevel',
            'appocm_coursecategorymst_fk' => 'Appocm Coursecategorymst Fk',
            'appocm_coursesubcategorymst_fk' => 'Appocm Coursesubcategorymst Fk',
            'appocm_coursetested' => 'Appocm Coursetested',
            'appocm_appintrecogtmp_fk' => 'Appocm Appintrecogtmp Fk',
            'appocm_updatedon' => 'Appocm Updatedon',
            'appocm_updatedby' => 'Appocm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoffercoursehstyTbls()
    {
        return $this->hasMany(AppoffercoursehstyTbl::className(), ['appoch_AppOfferCourseMain_PK' => 'appoffercoursemain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppocmApplicationdtlsmainFk()
    {
        return $this->hasOne(ApplicationdtlsmainTbl::className(), ['applicationdtlsmain_pk' => 'appocm_applicationdtlsmain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppocmAppoffercoursetmpFk()
    {
        return $this->hasOne(AppoffercoursetmpTbl::className(), ['appoffercoursetmp_pk' => 'appocm_appoffercoursetmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppocmCoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'appocm_coursecategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppocmCoursesubcategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'appocm_coursesubcategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppocmOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appocm_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoffercourseunitmainTbls()
    {
        return $this->hasMany(AppoffercourseunitmainTbl::className(), ['appocum_AppOfferCourseMain_FK' => 'appoffercoursemain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfomainTbls()
    {
        return $this->hasMany(AppstaffinfomainTbl::className(), ['appsim_ApplicationDtlsMain_FK' => 'appoffercoursemain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStandardcoursemstTbls()
    {
        return $this->hasMany(StandardcoursemstTbl::className(), ['scm_appoffercoursemain_fk' => 'appoffercoursemain_pk']);
    }

    /**
     * {@inheritdoc}
     * @return AppoffercoursemainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppoffercoursemainTblQuery(get_called_class());
    }
}
