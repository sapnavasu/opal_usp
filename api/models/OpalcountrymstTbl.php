<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opalcountrymst_tbl".
 *
 * @property int $opalcountrymst_pk primary key
 * @property string $ocym_countryname_en country name english
 * @property string $ocym_countryname_ar country name arabic
 * @property string $ocym_cntrylongname_en long name of the country englsh
 * @property string $ocym_cntrylongname_ar long name of the country arabic
 * @property string $ocym_cntryshortname_en country short name english
 * @property string $ocym_cntryshortname_ar country short name arabic
 * @property string $ocym_countrycode_en country code english
 * @property string $ocym_countrycode_ar country code arabic
 * @property string $ocym_twodigitcountrycode two digit country code
 * @property string $ocym_countrydialcode country dial code
 * @property int $ocym_status country status. 1 - active, 2 - inactive
 * @property string $ocym_createdon datetime of creation
 * @property int $ocym_createdby reference to opalusemst_tbl
 * @property string $ocym_updatedon datetime of updation
 * @property int $ocym_updatedby reference to opalusermst_tbl
 *
 * @property OpalmemberregmstTbl[] $opalmemberregmstTbls
 */
class OpalcountrymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalcountrymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ocym_countryname_en', 'ocym_countryname_ar', 'ocym_countrycode_en', 'ocym_countrycode_ar', 'ocym_twodigitcountrycode', 'ocym_countrydialcode', 'ocym_status', 'ocym_createdon', 'ocym_createdby'], 'required'],
            [['ocym_cntrylongname_en', 'ocym_cntrylongname_ar'], 'string'],
            [['ocym_status', 'ocym_createdby', 'ocym_updatedby'], 'integer'],
            [['ocym_createdon', 'ocym_updatedon'], 'safe'],
            [['ocym_countryname_en', 'ocym_countryname_ar'], 'string', 'max' => 150],
            [['ocym_cntryshortname_en', 'ocym_cntryshortname_ar'], 'string', 'max' => 50],
            [['ocym_countrycode_en', 'ocym_countrycode_ar'], 'string', 'max' => 45],
            [['ocym_twodigitcountrycode'], 'string', 'max' => 2],
            [['ocym_countrydialcode'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalcountrymst_pk' => 'Opalcountrymst Pk',
            'ocym_countryname_en' => 'Ocym Countryname En',
            'ocym_countryname_ar' => 'Ocym Countryname Ar',
            'ocym_cntrylongname_en' => 'Ocym Cntrylongname En',
            'ocym_cntrylongname_ar' => 'Ocym Cntrylongname Ar',
            'ocym_cntryshortname_en' => 'Ocym Cntryshortname En',
            'ocym_cntryshortname_ar' => 'Ocym Cntryshortname Ar',
            'ocym_countrycode_en' => 'Ocym Countrycode En',
            'ocym_countrycode_ar' => 'Ocym Countrycode Ar',
            'ocym_twodigitcountrycode' => 'Ocym Twodigitcountrycode',
            'ocym_countrydialcode' => 'Ocym Countrydialcode',
            'ocym_status' => 'Ocym Status',
            'ocym_createdon' => 'Ocym Createdon',
            'ocym_createdby' => 'Ocym Createdby',
            'ocym_updatedon' => 'Ocym Updatedon',
            'ocym_updatedby' => 'Ocym Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpalmemberregmstTbls()
    {
        return $this->hasMany(OpalmemberregmstTbl::className(), ['oum_opalcountrymst_fk' => 'opalcountrymst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return OpalcountrymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalcountrymstTblQuery(get_called_class());
    }
}
