<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appoffercourseunitmain_tbl".
 *
 * @property int $AppOfferCourseUnitMain_pk
 * @property int $appocum_AppOfferCourseUnitTmp_FK Reference to appoffercourseunittmp_pk
 * @property int $appocum_AppOfferCourseMain_FK Reference to appoffercoursemain_pk
 * @property string $appocum_UnitCode
 * @property string $appocum_UnitTitle
 * @property string $appocum_UpdatedOn
 * @property int $appocum_UpdatedBy
 *
 * @property AppoffercourseunithstyTbl[] $appoffercourseunithstyTbls
 * @property AppoffercoursemainTbl $appocumAppOfferCourseMainFK
 * @property AppoffercourseunittmpTbl $appocumAppOfferCourseUnitTmpFK
 */
class AppoffercourseunitmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appoffercourseunitmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appocum_AppOfferCourseUnitTmp_FK', 'appocum_AppOfferCourseMain_FK', 'appocum_UnitCode', 'appocum_UnitTitle'], 'required'],
            [['appocum_AppOfferCourseUnitTmp_FK', 'appocum_AppOfferCourseMain_FK', 'appocum_UpdatedBy'], 'integer'],
            [['appocum_UnitCode', 'appocum_UnitTitle'], 'string'],
            [['appocum_UpdatedOn'], 'safe'],
            [['appocum_AppOfferCourseMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursemainTbl::className(), 'targetAttribute' => ['appocum_AppOfferCourseMain_FK' => 'appoffercoursemain_pk']],
            [['appocum_AppOfferCourseUnitTmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercourseunittmpTbl::className(), 'targetAttribute' => ['appocum_AppOfferCourseUnitTmp_FK' => 'appoffercourseunittmp_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppOfferCourseUnitMain_pk' => 'App Offer Course Unit Main Pk',
            'appocum_AppOfferCourseUnitTmp_FK' => 'Appocum  App Offer Course Unit Tmp  Fk',
            'appocum_AppOfferCourseMain_FK' => 'Appocum  App Offer Course Main  Fk',
            'appocum_UnitCode' => 'Appocum  Unit Code',
            'appocum_UnitTitle' => 'Appocum  Unit Title',
            'appocum_UpdatedOn' => 'Appocum  Updated On',
            'appocum_UpdatedBy' => 'Appocum  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoffercourseunithstyTbls()
    {
        return $this->hasMany(AppoffercourseunithstyTbl::className(), ['appocuh_AppOfferCourseUnitMain_FK' => 'AppOfferCourseUnitMain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppocumAppOfferCourseMainFK()
    {
        return $this->hasOne(AppoffercoursemainTbl::className(), ['appoffercoursemain_pk' => 'appocum_AppOfferCourseMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppocumAppOfferCourseUnitTmpFK()
    {
        return $this->hasOne(AppoffercourseunittmpTbl::className(), ['appoffercourseunittmp_pk' => 'appocum_AppOfferCourseUnitTmp_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppoffercourseunitmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppoffercourseunitmainTblQuery(get_called_class());
    }
}
