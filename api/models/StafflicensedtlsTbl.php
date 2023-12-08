<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stafflicensedtls_tbl".
 *
 * @property int $stafflicensedtls_pk
 * @property int $sld_staffinforepo_fk Reference to staffinforepo_pk
 * @property string $sld_ROPlicense
 * @property int $sld_ROPlicenseupload Reference to memcompfiledtls_pk
 * @property int $sld_hasROPlightlicense 1-yes,2-no
 * @property int $sld_hasROPheavylicense 1-yes,2-no
 * @property string $sld_ROPlightlicense
 * @property string $sld_ROPheavylicense
 * @property string $sld_createdon
 * @property int $sld_createdby
 * @property string $sld_updatedon
 * @property int $sld_updatedby
 *
 * @property MemcompfiledtlsTbl $sldROPlicenseupload
 * @property StaffinforepoTbl $sldStaffinforepoFk
 */
class StafflicensedtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stafflicensedtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sld_staffinforepo_fk', 'sld_hasROPlightlicense', 'sld_hasROPheavylicense', 'sld_createdby'], 'required'],
            [['sld_staffinforepo_fk', 'sld_hasROPlightlicense', 'sld_hasROPheavylicense', 'sld_createdby', 'sld_updatedby'], 'integer'],
            [['sld_ROPlightlicense', 'sld_ROPheavylicense', 'sld_createdon', 'sld_updatedon'], 'safe'],
            [['sld_ROPlicense'], 'string', 'max' => 20],
            // [['sld_ROPlicenseupload'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompfiledtlsTbl::className(), 'targetAttribute' => ['sld_ROPlicenseupload' => 'memcompfiledtls_pk']],
            [['sld_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['sld_staffinforepo_fk' => 'staffinforepo_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'stafflicensedtls_pk' => 'Stafflicensedtls Pk',
            'sld_staffinforepo_fk' => 'Reference to staffinforepo_pk',
            'sld_ROPlicense' => 'Sld  Roplicense',
            'sld_ROPlicenseupload' => 'Reference to memcompfiledtls_pk',
            'sld_hasROPlightlicense' => '1-yes,2-no',
            'sld_hasROPheavylicense' => '1-yes,2-no',
            'sld_ROPlightlicense' => 'Sld  Roplightlicense',
            'sld_ROPheavylicense' => 'Sld  Ropheavylicense',
            'sld_createdon' => 'Sld Createdon',
            'sld_createdby' => 'Sld Createdby',
            'sld_updatedon' => 'Sld Updatedon',
            'sld_updatedby' => 'Sld Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSldROPlicenseupload()
    {
        // return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'sld_ROPlicenseupload']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSldStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'sld_staffinforepo_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StafflicensedtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StafflicensedtlsTblQuery(get_called_class());
    }
}
