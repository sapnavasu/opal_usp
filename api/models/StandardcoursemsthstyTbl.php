<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "standardcoursemsthsty_tbl".
 *
 * @property int $standardcoursemsthsty_pk
 * @property int $scmh_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $scmh_projectmst_fk reference to projectmst_pk
 * @property int $scmh_opalmemberregmst_fk reference to opalmemberregmst_pk
 * @property int $scmh_coursetype 1-Standard Course, 2-Customized Course, by default 2. If course created by opalstkholdertypmst_pk = 1 then 1 if opalstkholdertypmst_pk = 2 then 2
 * @property int $scmh_appoffercoursemain_fk Reference to appoffercoursemain_pk, not null when scm_coursettype=2 else NULL
 * @property string $scmh_coursename_en
 * @property string $scmh_coursename_ar
 * @property string $scmh_coursecertcontent certificate content
 * @property int $scmh_assessmentin Reference to referencemst_pk where rm_mastertype=14
 * @property int $scmh_isintlreorgreq 1-Yes, 2- No, default by 1
 * @property string $scmh_requestfor Reference to referencemst_pk where rm_mastertype=13
 * @property int $scmh_courselevel Reference to referencemst_pk where rm_mastertype=3
 * @property int $scmh_coursecategorymst_fk Reference to coursecategorymst_pk
 * @property int $scmh_status 1-Active, 2-Inactive, 3-Suspend if no more training providers allowed to register for the course approval
 * @property string $scmh_createdon
 * @property int $scmh_createdby
 * @property string $scmh_updatedon
 * @property int $scmh_updatedby
 *
 * @property AppoffercoursemainTbl $scmhAppoffercoursemainFk
 * @property CoursecategorymstTbl $scmhCoursecategorymstFk
 * @property OpalmemberregmstTbl $scmhOpalmemberregmstFk
 * @property ProjectmstTbl $scmhProjectmstFk
 * @property StandardcoursemstTbl $scmhStandardcoursemstFk
 */
class StandardcoursemsthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'standardcoursemsthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scmh_standardcoursemst_fk', 'scmh_projectmst_fk', 'scmh_opalmemberregmst_fk', 'scmh_coursetype', 'scmh_coursename_en', 'scmh_coursename_ar', 'scmh_coursecertcontent', 'scmh_assessmentin', 'scmh_requestfor', 'scmh_courselevel', 'scmh_coursecategorymst_fk', 'scmh_status', 'scmh_createdon', 'scmh_createdby'], 'required'],
            [['scmh_standardcoursemst_fk', 'scmh_projectmst_fk', 'scmh_opalmemberregmst_fk', 'scmh_coursetype', 'scmh_appoffercoursemain_fk', 'scmh_assessmentin', 'scmh_isintlreorgreq', 'scmh_courselevel', 'scmh_coursecategorymst_fk', 'scmh_status', 'scmh_createdby', 'scmh_updatedby'], 'integer'],
            [['scmh_coursecertcontent', 'scmh_requestfor'], 'string'],
            [['scmh_createdon', 'scmh_updatedon'], 'safe'],
            [['scmh_coursename_en', 'scmh_coursename_ar'], 'string', 'max' => 255],
            [['scmh_appoffercoursemain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursemainTbl::className(), 'targetAttribute' => ['scmh_appoffercoursemain_fk' => 'appoffercoursemain_pk']],
            [['scmh_coursecategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['scmh_coursecategorymst_fk' => 'coursecategorymst_pk']],
            [['scmh_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['scmh_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['scmh_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['scmh_projectmst_fk' => 'projectmst_pk']],
            [['scmh_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['scmh_standardcoursemst_fk' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'standardcoursemsthsty_pk' => 'Standardcoursemsthsty Pk',
            'scmh_standardcoursemst_fk' => 'Scmh Standardcoursemst Fk',
            'scmh_projectmst_fk' => 'Scmh Projectmst Fk',
            'scmh_opalmemberregmst_fk' => 'Scmh Opalmemberregmst Fk',
            'scmh_coursetype' => 'Scmh Coursetype',
            'scmh_appoffercoursemain_fk' => 'Scmh Appoffercoursemain Fk',
            'scmh_coursename_en' => 'Scmh Coursename En',
            'scmh_coursename_ar' => 'Scmh Coursename Ar',
            'scmh_coursecertcontent' => 'Scmh Coursecertcontent',
            'scmh_assessmentin' => 'Scmh Assessmentin',
            'scmh_isintlreorgreq' => 'Scmh Isintlreorgreq',
            'scmh_requestfor' => 'Scmh Requestfor',
            'scmh_courselevel' => 'Scmh Courselevel',
            'scmh_coursecategorymst_fk' => 'Scmh Coursecategorymst Fk',
            'scmh_status' => 'Scmh Status',
            'scmh_createdon' => 'Scmh Createdon',
            'scmh_createdby' => 'Scmh Createdby',
            'scmh_updatedon' => 'Scmh Updatedon',
            'scmh_updatedby' => 'Scmh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScmhAppoffercoursemainFk()
    {
        return $this->hasOne(AppoffercoursemainTbl::className(), ['appoffercoursemain_pk' => 'scmh_appoffercoursemain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScmhCoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'scmh_coursecategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScmhOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'scmh_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScmhProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'scmh_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScmhStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'scmh_standardcoursemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StandardcoursemsthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StandardcoursemsthstyTblQuery(get_called_class());
    }
}
