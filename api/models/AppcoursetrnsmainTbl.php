<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appcoursetrnsmain_tbl".
 *
 * @property int $AppCourseTrnsMain_pk primary key
 * @property int $appctm_ApCourseTrnsTmp_FK Reference to appcoursetrnstmp_pk
 * @property int $appctm_AppCourseDtlsMain_FK Refernce to appcoursedtlsmain_pk
 * @property int $appctm_coursecategorymst_fk Reference to coursecategorymst_pk
 * @property string $appctm_UpdatedOn
 * @property int $appctm_UpdatedBy
 *
 * @property AppcoursetrnshstyTbl[] $appcoursetrnshstyTbls
 * @property AppcoursetrnstmpTbl $appctmApCourseTrnsTmpFK
 * @property AppcoursedtlsmainTbl $appctmAppCourseDtlsMainFK
 * @property CoursecategorymstTbl $appctmCoursecategorymstFk
 */
class AppcoursetrnsmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appcoursetrnsmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appctm_ApCourseTrnsTmp_FK', 'appctm_AppCourseDtlsMain_FK', 'appctm_coursecategorymst_fk'], 'required'],
            [['appctm_ApCourseTrnsTmp_FK', 'appctm_AppCourseDtlsMain_FK', 'appctm_coursecategorymst_fk', 'appctm_UpdatedBy'], 'integer'],
            [['appctm_UpdatedOn'], 'safe'],
            [['appctm_ApCourseTrnsTmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursetrnstmpTbl::className(), 'targetAttribute' => ['appctm_ApCourseTrnsTmp_FK' => 'appcoursetrnstmp_pk']],
            [['appctm_AppCourseDtlsMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursedtlsmainTbl::className(), 'targetAttribute' => ['appctm_AppCourseDtlsMain_FK' => 'AppCourseDtlsMain_PK']],
            [['appctm_coursecategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['appctm_coursecategorymst_fk' => 'coursecategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppCourseTrnsMain_pk' => 'App Course Trns Main Pk',
            'appctm_ApCourseTrnsTmp_FK' => 'Appctm  Ap Course Trns Tmp  Fk',
            'appctm_AppCourseDtlsMain_FK' => 'Appctm  App Course Dtls Main  Fk',
            'appctm_coursecategorymst_fk' => 'Appctm Coursecategorymst Fk',
            'appctm_UpdatedOn' => 'Appctm  Updated On',
            'appctm_UpdatedBy' => 'Appctm  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcoursetrnshstyTbls()
    {
        return $this->hasMany(AppcoursetrnshstyTbl::className(), ['appcth_AppCourseTrnsMain_FK' => 'AppCourseTrnsMain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppctmApCourseTrnsTmpFK()
    {
        return $this->hasOne(AppcoursetrnstmpTbl::className(), ['appcoursetrnstmp_pk' => 'appctm_ApCourseTrnsTmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppctmAppCourseDtlsMainFK()
    {
        return $this->hasOne(AppcoursedtlsmainTbl::className(), ['AppCourseDtlsMain_PK' => 'appctm_AppCourseDtlsMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppctmCoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'appctm_coursecategorymst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AppcoursetrnsmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppcoursetrnsmainTblQuery(get_called_class());
    }
}
