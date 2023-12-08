<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmssdrldoccathsty_tbl".
 *
 * @property int $cmssdrldoccathsty_pk Primary key
 * @property int $csdrldch_cmssdrldoccat_fk reference to cmssdrldoccat_tbl
 * @property int $csdrldch_memcompmst_fk Reference to membercompanymst_tbl
 * @property string $csdrldch_doccategory Document Category
 * @property string $csdrldch_doccode Document Code
 * @property string $csdrldch_docdesc Document Description
 * @property string $csdrldch_createdon Date of creation
 * @property int $csdrldch_createdby Reference to usermst_tbl
 * @property string $csdrldch_createdbyipaddr User IP Address
 *
 * @property UsermstTbl $csdrldchCreatedby
 * @property MembercompanymstTbl $csdrldchMemcompmstFk
 */
class CmssdrldoccathstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssdrldoccathsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['csdrldch_cmssdrldoccat_fk', 'csdrldch_memcompmst_fk', 'csdrldch_doccategory', 'csdrldch_doccode', 'csdrldch_docdesc', 'csdrldch_createdon', 'csdrldch_createdby'], 'required'],
            [['csdrldch_cmssdrldoccat_fk', 'csdrldch_memcompmst_fk', 'csdrldch_createdby'], 'integer'],
            [['csdrldch_docdesc'], 'string'],
            [['csdrldch_createdon'], 'safe'],
            [['csdrldch_doccategory'], 'string', 'max' => 255],
            [['csdrldch_doccode'], 'string', 'max' => 10],
            [['csdrldch_createdbyipaddr'], 'string', 'max' => 50],
            [['csdrldch_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrldch_createdby' => 'UserMst_Pk']],
            [['csdrldch_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['csdrldch_memcompmst_fk' => 'MemberCompMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssdrldoccathsty_pk' => 'Cmssdrldoccathsty Pk',
            'csdrldch_cmssdrldoccat_fk' => 'Csdrldch Cmssdrldoccat Fk',
            'csdrldch_memcompmst_fk' => 'Csdrldch Memcompmst Fk',
            'csdrldch_doccategory' => 'Csdrldch Doccategory',
            'csdrldch_doccode' => 'Csdrldch Doccode',
            'csdrldch_docdesc' => 'Csdrldch Docdesc',
            'csdrldch_createdon' => 'Csdrldch Createdon',
            'csdrldch_createdby' => 'Csdrldch Createdby',
            'csdrldch_createdbyipaddr' => 'Csdrldch Createdbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldchCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrldch_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldchMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'csdrldch_memcompmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmssdrldoccathstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssdrldoccathstyTblQuery(get_called_class());
    }
}
