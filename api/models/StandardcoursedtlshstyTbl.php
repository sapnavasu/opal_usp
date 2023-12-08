<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "standardcoursedtlshsty_tbl".
 *
 * @property int $standardcoursedtlshsty_pk
 * @property int $scdh_standardcoursedtls_fk Reference to standardcoursedtls_pk
 * @property int $scdh_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $scdh_subcoursecategorymst_fk Reference to coursecategorymst_pk
 * @property int $scdh_onjobtraining 1-Yes, 2-No, by default 2
 * @property int $scdh_printfinalpermitcard 1-Yes, 2-No, If scd_onjobtraining=2 then 1 else 2
 * @property int $scdh_limitoflearner 1-Yes, 2-No, by default 2
 * @property int $scdh_isthyclass 1-Yes, 2-No, by default 2
 * @property int $scdh_thyclasslimit if scd_isthyclass = 1, then NOTNULL else NULL
 * @property int $scdh_ispratclass -Yes, 2-No, by default 2
 * @property int $scdh_ispratclassrefresher 1-Yes, 2-No, by default 2
 * @property int $scdh_practclasslimit if scd_ispractclass = 1, then NOTNULL else NULL
 * @property int $scdh_asmtbatchlimit if NULL then batch limit is no, if != NULL then batch limit is Yes
 * @property int $scdh_hasagelimit 1-Yes, 2-No, by default 2
 * @property int $scdh_agelimit if NULL then no age limit, if != NULL then age limit is Yes
 * @property string $scdh_prerequesit Reference to standardcoursedtls_pk, separated by comma
 * @property int $scdh_iscertexpiry 1-Yes certificate has expiry, 2-No does not have expiry, by default 2
 * @property int $scdh_iscertexpirybasedonmarks 1-Yes based on marks, 2-No not based on marks by default 2
 * @property array $scdh_markpercent insert expiry based on mark in JSON format [{min:95, max:100, expinmonth:36},{min:86, max:94, expinmonth:30},{min:67, max:85, expinmonth:24} ]
 * @property int $scdh_certexpiryinmonths Not null when scd_iscertexpiry=1
 * @property int $scdh_isknwlasmt 1-Yes couse have knowledge assessment, 2-No couse do not have knowledge assessment, by default 2
 * @property int $scdh_minmarkfrknwlasmt Minimum pass mark for Knowledge Assessment. Not null when scd_isknwlasmt=1
 * @property int $scdh_totalmarkfrknwlasmt Total mark for Knowledge Assessment. Not null when scd_isknwlasmt=1
 * @property int $scdh_ispratasmt 1-Yes couse have practical assessment, 2-No couse do not have practical assessment, by default 2
 * @property int $scdh_ispartasmtmark 1-Yes couse have practical assessment based on grade/mark, 2-No couse do not have practical assessment based on grade/mark, by default 2
 * @property int $scdh_partasmtminmark Minimum pass mark for Practical Assessment. Not null when scd_ispartasmtmark=1
 * @property int $scdh_partasmttotalmark Minimum pass mark for Practical Assessment. Not null when scd_ispartasmtmark=1
 * @property int $scdh_status 1-Active, 2-In-active, 3-Suspend
 * @property string $scdh_createdon
 * @property int $scdh_createdby
 * @property string $scdh_updatedon
 * @property int $scdh_updatedby
 *
 * @property StandardcoursedtlsTbl $scdhStandardcoursedtlsFk
 * @property StandardcoursemstTbl $scdhStandardcoursemstFk
 * @property CoursecategorymstTbl $scdhSubcoursecategorymstFk
 */
class StandardcoursedtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'standardcoursedtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scdh_standardcoursedtls_fk', 'scdh_standardcoursemst_fk', 'scdh_subcoursecategorymst_fk', 'scdh_printfinalpermitcard', 'scdh_status', 'scdh_createdon', 'scdh_createdby'], 'required'],
            [['scdh_standardcoursedtls_fk', 'scdh_standardcoursemst_fk', 'scdh_subcoursecategorymst_fk', 'scdh_onjobtraining', 'scdh_printfinalpermitcard', 'scdh_limitoflearner', 'scdh_isthyclass', 'scdh_thyclasslimit', 'scdh_ispratclass', 'scdh_ispratclassrefresher', 'scdh_practclasslimit', 'scdh_asmtbatchlimit', 'scdh_hasagelimit', 'scdh_agelimit', 'scdh_iscertexpiry', 'scdh_iscertexpirybasedonmarks', 'scdh_certexpiryinmonths', 'scdh_isknwlasmt', 'scdh_minmarkfrknwlasmt', 'scdh_totalmarkfrknwlasmt', 'scdh_ispratasmt', 'scdh_ispartasmtmark', 'scdh_partasmtminmark', 'scdh_partasmttotalmark', 'scdh_status', 'scdh_createdby', 'scdh_updatedby'], 'integer'],
            [['scdh_prerequesit'], 'string'],
            [['scdh_markpercent', 'scdh_createdon', 'scdh_updatedon'], 'safe'],
            [['scdh_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['scdh_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
            [['scdh_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['scdh_standardcoursemst_fk' => 'standardcoursemst_pk']],
            [['scdh_subcoursecategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['scdh_subcoursecategorymst_fk' => 'coursecategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'standardcoursedtlshsty_pk' => 'Standardcoursedtlshsty Pk',
            'scdh_standardcoursedtls_fk' => 'Scdh Standardcoursedtls Fk',
            'scdh_standardcoursemst_fk' => 'Scdh Standardcoursemst Fk',
            'scdh_subcoursecategorymst_fk' => 'Scdh Subcoursecategorymst Fk',
            'scdh_onjobtraining' => 'Scdh Onjobtraining',
            'scdh_printfinalpermitcard' => 'Scdh Printfinalpermitcard',
            'scdh_limitoflearner' => 'Scdh Limitoflearner',
            'scdh_isthyclass' => 'Scdh Isthyclass',
            'scdh_thyclasslimit' => 'Scdh Thyclasslimit',
            'scdh_ispratclass' => 'Scdh Ispratclass',
            'scdh_ispratclassrefresher' => 'Scdh Ispratclassrefresher',
            'scdh_practclasslimit' => 'Scdh Practclasslimit',
            'scdh_asmtbatchlimit' => 'Scdh Asmtbatchlimit',
            'scdh_hasagelimit' => 'Scdh Hasagelimit',
            'scdh_agelimit' => 'Scdh Agelimit',
            'scdh_prerequesit' => 'Scdh Prerequesit',
            'scdh_iscertexpiry' => 'Scdh Iscertexpiry',
            'scdh_iscertexpirybasedonmarks' => 'Scdh Iscertexpirybasedonmarks',
            'scdh_markpercent' => 'Scdh Markpercent',
            'scdh_certexpiryinmonths' => 'Scdh Certexpiryinmonths',
            'scdh_isknwlasmt' => 'Scdh Isknwlasmt',
            'scdh_minmarkfrknwlasmt' => 'Scdh Minmarkfrknwlasmt',
            'scdh_totalmarkfrknwlasmt' => 'Scdh Totalmarkfrknwlasmt',
            'scdh_ispratasmt' => 'Scdh Ispratasmt',
            'scdh_ispartasmtmark' => 'Scdh Ispartasmtmark',
            'scdh_partasmtminmark' => 'Scdh Partasmtminmark',
            'scdh_partasmttotalmark' => 'Scdh Partasmttotalmark',
            'scdh_status' => 'Scdh Status',
            'scdh_createdon' => 'Scdh Createdon',
            'scdh_createdby' => 'Scdh Createdby',
            'scdh_updatedon' => 'Scdh Updatedon',
            'scdh_updatedby' => 'Scdh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScdhStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'scdh_standardcoursedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScdhStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'scdh_standardcoursemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScdhSubcoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'scdh_subcoursecategorymst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StandardcoursedtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StandardcoursedtlshstyTblQuery(get_called_class());
    }
}
