<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use api\modules\mst\models\MembercompanymstTbl;
use Yii;

/**
 * This is the model class for table "cmssdrldoccat_tbl".
 *
 * @property int $cmssdrldoccat_pk Primary key
 * @property int $csdrldc_cmssdrldoccattemp_fk reference to cmssdrldoccattemp_tbl
 * @property int $csdrldc_memcompmst_fk Reference to membercompanymst_tbl
 * @property string $csdrldc_doccategory Document Category
 * @property string $csdrldc_doccode Document Code
 * @property string $csdrldc_docdesc Document Description
 * @property string $csdrldc_createdon Date of creation
 * @property int $csdrldc_createdby Reference to usermst_tbl
 * @property string $csdrldc_createdbyipaddr User IP Address
 *
 * @property CmssdrldoccattempTbl $csdrldcCmssdrldoccattempFk
 * @property UsermstTbl $csdrldcCreatedby
 * @property MembercompanymstTbl $csdrldcMemcompmstFk
 * @property CmssuppdocreqlistdtlsTbl[] $cmssuppdocreqlistdtlsTbls
 * @property CmssuppdocreqlistdtlshstyTbl[] $cmssuppdocreqlistdtlshstyTbls
 * @property CmssuppdocreqlistdtlstempTbl[] $cmssuppdocreqlistdtlstempTbls
 */
class CmssdrldoccatTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssdrldoccat_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['csdrldc_cmssdrldoccattemp_fk', 'csdrldc_memcompmst_fk', 'csdrldc_createdby'], 'integer'],
            [['csdrldc_memcompmst_fk', 'csdrldc_doccategory', 'csdrldc_doccode', 'csdrldc_docdesc', 'csdrldc_createdon', 'csdrldc_createdby'], 'required'],
            [['csdrldc_docdesc'], 'string'],
            [['csdrldc_createdon'], 'safe'],
            [['csdrldc_doccategory'], 'string', 'max' => 255],
            [['csdrldc_doccode'], 'string', 'max' => 10],
            [['csdrldc_createdbyipaddr'], 'string', 'max' => 50],
            [['csdrldc_cmssdrldoccattemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmssdrldoccattempTbl::className(), 'targetAttribute' => ['csdrldc_cmssdrldoccattemp_fk' => 'cmssdrldoccattemp_pk']],
            [['csdrldc_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrldc_createdby' => 'UserMst_Pk']],
            [['csdrldc_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['csdrldc_memcompmst_fk' => 'MemberCompMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssdrldoccat_pk' => 'Cmssdrldoccat Pk',
            'csdrldc_cmssdrldoccattemp_fk' => 'Csdrldc Cmssdrldoccattemp Fk',
            'csdrldc_memcompmst_fk' => 'Csdrldc Memcompmst Fk',
            'csdrldc_doccategory' => 'Csdrldc Doccategory',
            'csdrldc_doccode' => 'Csdrldc Doccode',
            'csdrldc_docdesc' => 'Csdrldc Docdesc',
            'csdrldc_createdon' => 'Csdrldc Createdon',
            'csdrldc_createdby' => 'Csdrldc Createdby',
            'csdrldc_createdbyipaddr' => 'Csdrldc Createdbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldcCmssdrldoccattempFk()
    {
        return $this->hasOne(CmssdrldoccattempTbl::className(), ['cmssdrldoccattemp_pk' => 'csdrldc_cmssdrldoccattemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldcCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrldc_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldcMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'csdrldc_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssuppdocreqlistdtlsTbls()
    {
        return $this->hasMany(CmssuppdocreqlistdtlsTbl::className(), ['csdrld_cmssdrldoccat_fk' => 'cmssdrldoccat_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssuppdocreqlistdtlshstyTbls()
    {
        return $this->hasMany(CmssuppdocreqlistdtlshstyTbl::className(), ['csdrldh_cmssdrldoccat_fk' => 'cmssdrldoccat_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssuppdocreqlistdtlstempTbls()
    {
        return $this->hasMany(CmssuppdocreqlistdtlstempTbl::className(), ['csdrldt_cmssdrldoccat_fk' => 'cmssdrldoccat_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmssdrldoccatTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssdrldoccatTblQuery(get_called_class());
    }
}
