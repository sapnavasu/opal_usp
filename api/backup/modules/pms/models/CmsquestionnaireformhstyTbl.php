<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;

/**
 * This is the model class for table "cmsquestionnaireformhsty_tbl".
 *
 * @property int $cmsquestionnaireformhsty_pk Primary key
 * @property int $cmsqfh_cmsquestionnaireform_fk Reference to cmsquestionnaireform_tbl.cmsquestionnaireform_pk
 * @property int $cmsqfh_type 1 - RFI, 2 - EOI, 3 - RFP, 4 - RFQ, 5 - PQ, 6 - RFT
 * @property string $cmsqfh_formname Name of the Form
 * @property string $cmsqfh_formdesc Description of the form
 * @property array $cmsqfh_buildertemplate builder template in json format
 * @property int $cmsqfh_formtype 1 - Template , 2 - Form, 3 - Admin Template
 * @property int $cmsqfh_status 1 - Active, 2 - Inactive
 * @property string $cmsqfh_createdon Date of creation
 * @property int $cmsqfh_createdby Reference to usermst_tbl
 * @property string $cmsqfh_createdbyipaddr User IP Address
 * @property string $cmsqfh_updatedon Date of update
 * @property int $cmsqfh_updatedby Reference to usermst_tbl
 * @property string $cmsqfh_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $cmsqfhCreatedby
 * @property UsermstTbl $cmsqfhUpdatedby
 * @property CmsquestionnaireformtrnxhstyTbl[] $cmsquestionnaireformtrnxhstyTbls
 * @property CmstenderhdrhstyTbl[] $cmstenderhdrhstyTbls
 */
class CmsquestionnaireformhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsquestionnaireformhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsqfh_cmsquestionnaireform_fk', 'cmsqfh_type', 'cmsqfh_formname', 'cmsqfh_buildertemplate', 'cmsqfh_formtype', 'cmsqfh_createdon', 'cmsqfh_createdby'], 'required'],
            [['cmsqfh_cmsquestionnaireform_fk', 'cmsqfh_type', 'cmsqfh_formtype', 'cmsqfh_status', 'cmsqfh_createdby', 'cmsqfh_updatedby'], 'integer'],
            [['cmsqfh_formdesc'], 'string'],
            [['cmsqfh_buildertemplate', 'cmsqfh_createdon', 'cmsqfh_updatedon'], 'safe'],
            [['cmsqfh_formname'], 'string', 'max' => 150],
            [['cmsqfh_createdbyipaddr', 'cmsqfh_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmsqfh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqfh_createdby' => 'UserMst_Pk']],
            [['cmsqfh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqfh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsquestionnaireformhsty_pk' => 'Cmsquestionnaireformhsty Pk',
            'cmsqfh_cmsquestionnaireform_fk' => 'Cmsqfh Cmsquestionnaireform Fk',
            'cmsqfh_type' => 'Cmsqfh Type',
            'cmsqfh_formname' => 'Cmsqfh Formname',
            'cmsqfh_formdesc' => 'Cmsqfh Formdesc',
            'cmsqfh_buildertemplate' => 'Cmsqfh Buildertemplate',
            'cmsqfh_formtype' => 'Cmsqfh Formtype',
            'cmsqfh_status' => 'Cmsqfh Status',
            'cmsqfh_createdon' => 'Cmsqfh Createdon',
            'cmsqfh_createdby' => 'Cmsqfh Createdby',
            'cmsqfh_createdbyipaddr' => 'Cmsqfh Createdbyipaddr',
            'cmsqfh_updatedon' => 'Cmsqfh Updatedon',
            'cmsqfh_updatedby' => 'Cmsqfh Updatedby',
            'cmsqfh_updatedbyipaddr' => 'Cmsqfh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqfh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqfh_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsquestionnaireformtrnxhstyTbls()
    {
        return $this->hasMany(CmsquestionnaireformtrnxhstyTbl::className(), ['cmsqfth_cmsquestionnaireformhsty_fk' => 'cmsquestionnaireformhsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderhdrhstyTbls()
    {
        return $this->hasMany(CmstenderhdrhstyTbl::className(), ['cmsthh_cmsquestionnaireformhsty_fk' => 'cmsquestionnaireformhsty_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsquestionnaireformhstyTblQuery(get_called_class());
    }
}
