<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsquestionnaireformtemp_tbl".
 *
 * @property int $cmsquestionnaireformtemp_pk Primary key
 * @property int $cmsqft_type 1 - RFI, 2 - EOI, 3 - RFP, 4 - RFQ, 5 - PQ, 6 - RFT
 * @property string $cmsqft_formname Name of the Form
 * @property string $cmsqft_formdesc Description of the form
 * @property array $cmsqft_buildertemplate builder template in json format
 * @property int $cmsqft_formtype 1 - Template , 2 - Form, 3 - Admin Template
 * @property int $cmsqft_status 1 - Active, 2 - Inactive
 * @property string $cmsqft_createdon Date of creation
 * @property int $cmsqft_createdby Reference to usermst_tbl
 * @property string $cmsqft_createdbyipaddr User IP Address
 * @property string $cmsqft_updatedon Date of update
 * @property int $cmsqft_updatedby Reference to usermst_tbl
 * @property string $cmsqft_updatedbyipaddr User IP Address
 *
 * @property CmsquestionnaireformtrnxtempTbl[] $cmsquestionnaireformtrnxtempTbls
 * @property CmstenderhdrtempTbl[] $cmstenderhdrtempTbls
 */
class CmsquestionnaireformtempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsquestionnaireformtemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsqft_type', 'cmsqft_formname', 'cmsqft_buildertemplate', 'cmsqft_formtype', 'cmsqft_createdon', 'cmsqft_createdby'], 'required'],
            [['cmsqft_type', 'cmsqft_formtype', 'cmsqft_status', 'cmsqft_createdby', 'cmsqft_updatedby'], 'integer'],
            [['cmsqft_formdesc'], 'string'],
            [['cmsqft_buildertemplate', 'cmsqft_createdon', 'cmsqft_updatedon'], 'safe'],
            [['cmsqft_formname'], 'string', 'max' => 150],
            [['cmsqft_createdbyipaddr', 'cmsqft_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsquestionnaireformtemp_pk' => 'Cmsquestionnaireformtemp Pk',
            'cmsqft_type' => 'Cmsqft Type',
            'cmsqft_formname' => 'Cmsqft Formname',
            'cmsqft_formdesc' => 'Cmsqft Formdesc',
            'cmsqft_buildertemplate' => 'Cmsqft Buildertemplate',
            'cmsqft_formtype' => 'Cmsqft Formtype',
            'cmsqft_status' => 'Cmsqft Status',
            'cmsqft_createdon' => 'Cmsqft Createdon',
            'cmsqft_createdby' => 'Cmsqft Createdby',
            'cmsqft_createdbyipaddr' => 'Cmsqft Createdbyipaddr',
            'cmsqft_updatedon' => 'Cmsqft Updatedon',
            'cmsqft_updatedby' => 'Cmsqft Updatedby',
            'cmsqft_updatedbyipaddr' => 'Cmsqft Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsquestionnaireformtrnxtempTbls()
    {
        return $this->hasMany(CmsquestionnaireformtrnxtempTbl::className(), ['cmsqftt_cmsquestionnaireformtemp_fk' => 'cmsquestionnaireformtemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderhdrtempTbls()
    {
        return $this->hasMany(CmstenderhdrtempTbl::className(), ['cmstht_cmsquestionnaireformtemp_fk' => 'cmsquestionnaireformtemp_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformtempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsquestionnaireformtempTblQuery(get_called_class());
    }
}
