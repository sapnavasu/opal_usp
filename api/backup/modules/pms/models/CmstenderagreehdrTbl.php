<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmstenderagreehdr_tbl".
 *
 * @property int $cmstenderagreehdr_pk Primary key
 * @property int $ctah_cmsquotationhdr_fk Reference to cmsquotationhdr_tbl
 * @property int $ctah_category 1 - Specification, 2 - General T&C, 3 - Specific T&C	
 * @property int $ctah_type 1 - Agree, 2 - Disagree
 * @property string $ctah_comments Comments if Disagree
 * @property string $ctah_remarks Remarks additional information
 * @property string $ctah_createdon Date of creation
 * @property int $ctah_createdby Reference to usermst_tbl
 * @property string $ctah_createdbyipaddr User IP Address
 * @property string $ctah_updatedon Date of update
 * @property int $ctah_updatedby Reference to usermst_tbl
 * @property string $ctah_updatedbyipaddr User IP Address
 *
 * @property CmsquotationhdrTbl $ctahCmsquotationhdrFk
 * @property UsermstTbl $ctahCreatedby
 * @property UsermstTbl $ctahUpdatedby
 * @property CmstnctrnxTbl[] $cmstnctrnxTbls
 */
class CmstenderagreehdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstenderagreehdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctah_cmsquotationhdr_fk', 'ctah_category', 'ctah_createdon', 'ctah_createdby'], 'required'],
            [['ctah_cmsquotationhdr_fk', 'ctah_category', 'ctah_type', 'ctah_createdby', 'ctah_updatedby'], 'integer'],
            [['ctah_comments', 'ctah_remarks'], 'string'],
            [['ctah_createdon', 'ctah_updatedon'], 'safe'],
            [['ctah_createdbyipaddr', 'ctah_updatedbyipaddr'], 'string', 'max' => 50],
            [['ctah_cmsquotationhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\quot\models\CmsquotationhdrTbl::className(), 'targetAttribute' => ['ctah_cmsquotationhdr_fk' => 'cmsquotationhdr_pk']],
            [['ctah_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['ctah_createdby' => 'UserMst_Pk']],
            [['ctah_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['ctah_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstenderagreehdr_pk' => 'Cmstenderagreehdr Pk',
            'ctah_cmsquotationhdr_fk' => 'Ctah Cmsquotationhdr Fk',
            'ctah_category' => 'Ctah Category',
            'ctah_type' => 'Ctah Type',
            'ctah_comments' => 'Ctah Comments',
            'ctah_remarks' => 'Ctah Remarks',
            'ctah_createdon' => 'Ctah Createdon',
            'ctah_createdby' => 'Ctah Createdby',
            'ctah_createdbyipaddr' => 'Ctah Createdbyipaddr',
            'ctah_updatedon' => 'Ctah Updatedon',
            'ctah_updatedby' => 'Ctah Updatedby',
            'ctah_updatedbyipaddr' => 'Ctah Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtahCmsquotationhdrFk()
    {
        return $this->hasOne(CmsquotationhdrTbl::className(), ['cmsquotationhdr_pk' => 'ctah_cmsquotationhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtahCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctah_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtahUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctah_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstnctrnxTbls()
    {
        return $this->hasMany(CmstnctrnxTbl::className(), ['ctnct_cmstenderagreehdr_fk' => 'cmstenderagreehdr_pk']);
    }
}
