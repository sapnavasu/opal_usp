<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "countrymst_tbl".
 *
 * @property int $CountryMst_Pk Primary key
 * @property int $cym_globalportalmst_fk Reference to globalportalmst_tbl
 * @property string $CyM_CountryName_en Country Name
 * @property string $CyM_CountryCode_en Country Code
 * @property string $CyM_CountryDialCode Country Dial code
 * @property string $CyM_Status Country status. A - Active, I - Inactive
 * @property string $CyM_CreatedOn Datetime of creation
 * @property int $CyM_CreatedBy Reference to adminusermst_tbl
 * @property string $CyM_UpdatedOn Datetime of updation
 * @property int $CyM_UpdatedBy Reference to adminusermst_tbl
 *
 * @property CitymstTbl[] $citymstTbls
 * @property UsermstTbl $cyMCreatedBy
 * @property GlobalportalmstTbl $cymGlobalportalmstFk
 * @property UsermstTbl $cyMUpdatedBy
 * @property MembercompanymstTbl[] $membercompanymstTbls
 * @property MembercompanymstTbl[] $membercompanymstTbls0
 * @property MemcompmplocationdtlsTbl[] $memcompmplocationdtlsTbls
 * @property StatemstTbl[] $statemstTbls
 */
class CountrymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countrymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cym_globalportalmst_fk', 'CyM_CountryName_en', 'CyM_CountryCode_en', 'CyM_CountryDialCode', 'CyM_Status', 'CyM_CreatedBy'], 'required'],
            [['cym_globalportalmst_fk', 'CyM_CreatedBy', 'CyM_UpdatedBy'], 'integer'],
            [['CyM_Status'], 'string'],
            [['CyM_CreatedOn', 'CyM_UpdatedOn'], 'safe'],
            [['CyM_CountryName_en'], 'string', 'max' => 150],
            [['CyM_CountryCode_en'], 'string', 'max' => 45],
            [['CyM_CountryDialCode'], 'string', 'max' => 5],
            [['CyM_CreatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['CyM_CreatedBy' => 'UserMst_Pk']],
            [['cym_globalportalmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => GlobalportalmstTbl::className(), 'targetAttribute' => ['cym_globalportalmst_fk' => 'globalportalmst_pk']],
            [['CyM_UpdatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['CyM_UpdatedBy' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CountryMst_Pk' => 'Country Mst  Pk',
            'cym_globalportalmst_fk' => 'Cym Globalportalmst Fk',
            'CyM_CountryName_en' => 'Cy M  Country Name',
            'CyM_CountryCode_en' => 'Cy M  Country Code',
            'CyM_CountryDialCode' => 'Cy M  Country Dial Code',
            'CyM_Status' => 'Cy M  Status',
            'CyM_CreatedOn' => 'Cy M  Created On',
            'CyM_CreatedBy' => 'Cy M  Created By',
            'CyM_UpdatedOn' => 'Cy M  Updated On',
            'CyM_UpdatedBy' => 'Cy M  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCitymstTbls()
    {
        return $this->hasMany(CitymstTbl::className(), ['CM_CountryMst_Fk' => 'CountryMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCyMCreatedBy()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'CyM_CreatedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCymGlobalportalmstFk()
    {
        return $this->hasOne(GlobalportalmstTbl::className(), ['globalportalmst_pk' => 'cym_globalportalmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCyMUpdatedBy()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'CyM_UpdatedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembercompanymstTbls()
    {
        return $this->hasMany(MembercompanymstTbl::className(), ['MCM_CountryMst_Fk' => 'CountryMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembercompanymstTbls0()
    {
        return $this->hasMany(MembercompanymstTbl::className(), ['MCM_Source_CountryMst_Fk' => 'CountryMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompmplocationdtlsTbls()
    {
        return $this->hasMany(MemcompmplocationdtlsTbl::className(), ['mcmpld_countrymst_fk' => 'CountryMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatemstTbls()
    {
        return $this->hasMany(StatemstTbl::className(), ['SM_CountryMst_Fk' => 'CountryMst_Pk']);
    }

    /**
     * {@inheritdoc}
     * @return CountrymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountrymstTblQuery(get_called_class());
    }
    
    public static function getCountryNameByPk($pk){
        $data = self::findOne($pk);
        return $data['CyM_CountryName_en'];
    }
}
