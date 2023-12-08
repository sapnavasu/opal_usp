<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;
/**
 * This is the model class for table "cmsquestionnaireform_tbl".
 *
 * @property int $cmsquestionnaireform_pk Primary key
 * @property int $cmsqf_type 1 - RFI, 2 - EOI, 3 - RFP, 4 - RFQ 
 * @property string $cmsqf_formname Name of the Form
 * @property string $cmsqf_formdesc Description of the form
 * @property array $cmsqf_buildertemplate builder template in json format
 * @property int $cmsqf_formtype 1 - Template , 2 - Form
 * @property string $cmsqf_createdon Date of creation
 * @property int $cmsqf_createdby Reference to usermst_tbl
 * @property string $cmsqf_createdbyipaddr User IP Address
 * @property string $cmsqf_updatedon Date of update
 * @property int $cmsqf_updatedby Reference to usermst_tbl
 * @property string $cmsqf_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $cmsqfCreatedby
 * @property UsermstTbl $cmsqfUpdatedby
 * @property CmstenderhdrTbl[] $cmstenderhdrTbls
 */
class CmsquestionnaireformTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsquestionnaireform_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsqf_type', 'cmsqf_formname', 'cmsqf_buildertemplate', 'cmsqf_formtype', 'cmsqf_createdon', 'cmsqf_createdby'], 'required'],
            [['cmsqf_type', 'cmsqf_formtype', 'cmsqf_createdby', 'cmsqf_updatedby'], 'integer'],
            [['cmsqf_formdesc'], 'string'],
            [['cmsqf_buildertemplate', 'cmsqf_createdon', 'cmsqf_updatedon'], 'safe'],
            [['cmsqf_formname'], 'string', 'max' => 150],
            [['cmsqf_createdbyipaddr', 'cmsqf_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmsqf_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqf_createdby' => 'UserMst_Pk']],
            [['cmsqf_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqf_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsquestionnaireform_pk' => 'Cmsquestionnaireform Pk',
            'cmsqf_type' => 'Cmsqf Type',
            'cmsqf_formname' => 'Cmsqf Formname',
            'cmsqf_formdesc' => 'Cmsqf Formdesc',
            'cmsqf_buildertemplate' => 'Cmsqf Buildertemplate',
            'cmsqf_formtype' => 'Cmsqf Formtype',
            'cmsqf_createdon' => 'Cmsqf Createdon',
            'cmsqf_createdby' => 'Cmsqf Createdby',
            'cmsqf_createdbyipaddr' => 'Cmsqf Createdbyipaddr',
            'cmsqf_updatedon' => 'Cmsqf Updatedon',
            'cmsqf_updatedby' => 'Cmsqf Updatedby',
            'cmsqf_updatedbyipaddr' => 'Cmsqf Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqf_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqf_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderhdrTbls()
    {
        return $this->hasMany(CmstenderhdrTbl::className(), ['cmsth_cmsquestionnaireform_fk' => 'cmsquestionnaireform_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsquestionnaireformtrnxTbl()
    {
        return $this->hasMany(CmsquestionnaireformtrnxTbl::className(), ['cmsqft_cmsquestionnaireform_fk' => 'cmsquestionnaireform_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsquestionnaireformTblQuery(get_called_class());
    }
}
