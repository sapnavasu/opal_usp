<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appoffercourseunithsty_tbl".
 *
 * @property int $AppOfferCourseUnitHsty_pk
 * @property int $appocuh_AppOffercourseUnitTmp_FK Reference to appoffercourseunittmp_pk
 * @property int $appocuh_AppOfferCourseUnitMain_FK Reference to appoffercourseunitmain_pk
 * @property int $appocuh_AppOfferCourseHsty_FK Reference to appoffercoursehsty_pk
 * @property string $appocuh_Unitcode
 * @property string $appocuh_UnitTitle
 * @property string $appocuh_CreatedOn
 * @property int $appocuh_CreatedBy
 * @property string $appocuh_UpdatedOn
 * @property int $appocuh_UpdatedBy
 * @property int $appocuh_Status 1-New,2-Updated,3-Approved, 4-Declined
 * @property string $appocuh_AppDecOn
 * @property int $appocuh_AppDecBy
 * @property string $appocuh_AppDecComments
 *
 * @property AppoffercoursehstyTbl $appocuhAppOfferCourseHstyFK
 * @property AppoffercourseunitmainTbl $appocuhAppOfferCourseUnitMainFK
 * @property AppoffercourseunittmpTbl $appocuhAppOffercourseUnitTmpFK
 */
class AppoffercourseunithstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appoffercourseunithsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appocuh_AppOffercourseUnitTmp_FK', 'appocuh_AppOfferCourseHsty_FK', 'appocuh_Unitcode', 'appocuh_UnitTitle', 'appocuh_CreatedOn', 'appocuh_CreatedBy', 'appocuh_Status'], 'required'],
            [['appocuh_AppOffercourseUnitTmp_FK', 'appocuh_AppOfferCourseUnitMain_FK', 'appocuh_AppOfferCourseHsty_FK', 'appocuh_CreatedBy', 'appocuh_UpdatedBy', 'appocuh_Status', 'appocuh_AppDecBy'], 'integer'],
            [['appocuh_Unitcode', 'appocuh_UnitTitle', 'appocuh_AppDecComments'], 'string'],
            [['appocuh_CreatedOn', 'appocuh_UpdatedOn', 'appocuh_AppDecOn'], 'safe'],
            [['appocuh_AppOfferCourseHsty_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursehstyTbl::className(), 'targetAttribute' => ['appocuh_AppOfferCourseHsty_FK' => 'AppOfferCourseHsty_PK']],
            [['appocuh_AppOfferCourseUnitMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercourseunitmainTbl::className(), 'targetAttribute' => ['appocuh_AppOfferCourseUnitMain_FK' => 'AppOfferCourseUnitMain_pk']],
            [['appocuh_AppOffercourseUnitTmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercourseunittmpTbl::className(), 'targetAttribute' => ['appocuh_AppOffercourseUnitTmp_FK' => 'appoffercourseunittmp_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppOfferCourseUnitHsty_pk' => 'App Offer Course Unit Hsty Pk',
            'appocuh_AppOffercourseUnitTmp_FK' => 'Appocuh  App Offercourse Unit Tmp  Fk',
            'appocuh_AppOfferCourseUnitMain_FK' => 'Appocuh  App Offer Course Unit Main  Fk',
            'appocuh_AppOfferCourseHsty_FK' => 'Appocuh  App Offer Course Hsty  Fk',
            'appocuh_Unitcode' => 'Appocuh  Unitcode',
            'appocuh_UnitTitle' => 'Appocuh  Unit Title',
            'appocuh_CreatedOn' => 'Appocuh  Created On',
            'appocuh_CreatedBy' => 'Appocuh  Created By',
            'appocuh_UpdatedOn' => 'Appocuh  Updated On',
            'appocuh_UpdatedBy' => 'Appocuh  Updated By',
            'appocuh_Status' => 'Appocuh  Status',
            'appocuh_AppDecOn' => 'Appocuh  App Dec On',
            'appocuh_AppDecBy' => 'Appocuh  App Dec By',
            'appocuh_AppDecComments' => 'Appocuh  App Dec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppocuhAppOfferCourseHstyFK()
    {
        return $this->hasOne(AppoffercoursehstyTbl::className(), ['AppOfferCourseHsty_PK' => 'appocuh_AppOfferCourseHsty_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppocuhAppOfferCourseUnitMainFK()
    {
        return $this->hasOne(AppoffercourseunitmainTbl::className(), ['AppOfferCourseUnitMain_pk' => 'appocuh_AppOfferCourseUnitMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppocuhAppOffercourseUnitTmpFK()
    {
        return $this->hasOne(AppoffercourseunittmpTbl::className(), ['appoffercourseunittmp_pk' => 'appocuh_AppOffercourseUnitTmp_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppoffercourseunithstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppoffercourseunithstyTblQuery(get_called_class());
    }
}
