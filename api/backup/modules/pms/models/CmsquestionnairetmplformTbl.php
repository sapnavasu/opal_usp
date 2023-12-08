<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsquestionnairetmplform_tbl".
 *
 * @property int $cmsquestionnairetmplform_pk Primary key
 * @property int $cmsqtf_type 1 - RFI, 2 - EOI, 3 - RFP, 4 - RFQ, 5 - PQ, 6 - RFT
 * @property string $cmsqtf_formname Name of the Form
 * @property string $cmsqtf_formdesc Description of the form
 * @property array $cmsqtf_buildertemplate builder template in json format
 * @property int $cmsqtf_formtype 1 - Template , 2 - Form, 3 - Admin Template
 * @property int $cmsqtf_status 1 - Active, 2 - Inactive
 * @property string $cmsqtf_createdon Date of creation
 * @property int $cmsqtf_createdby Reference to usermst_tbl
 * @property string $cmsqtf_createdbyipaddr User IP Address
 * @property string $cmsqtf_updatedon Date of update
 * @property int $cmsqtf_updatedby Reference to usermst_tbl
 * @property string $cmsqtf_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $cmsqtfCreatedby
 * @property UsermstTbl $cmsqtfUpdatedby
 */
class CmsquestionnairetmplformTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsquestionnairetmplform_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsqtf_type', 'cmsqtf_formname', 'cmsqtf_buildertemplate', 'cmsqtf_formtype', 'cmsqtf_createdon', 'cmsqtf_createdby'], 'required'],
            [['cmsqtf_type', 'cmsqtf_formtype', 'cmsqtf_status', 'cmsqtf_createdby', 'cmsqtf_updatedby'], 'integer'],
            [['cmsqtf_formdesc'], 'string'],
            [['cmsqtf_buildertemplate', 'cmsqtf_createdon', 'cmsqtf_updatedon'], 'safe'],
            [['cmsqtf_formname'], 'string', 'max' => 150],
            [['cmsqtf_createdbyipaddr', 'cmsqtf_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmsqtf_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqtf_createdby' => 'UserMst_Pk']],
            [['cmsqtf_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqtf_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsquestionnairetmplform_pk' => 'Cmsquestionnairetmplform Pk',
            'cmsqtf_type' => 'Cmsqtf Type',
            'cmsqtf_formname' => 'Cmsqtf Formname',
            'cmsqtf_formdesc' => 'Cmsqtf Formdesc',
            'cmsqtf_buildertemplate' => 'Cmsqtf Buildertemplate',
            'cmsqtf_formtype' => 'Cmsqtf Formtype',
            'cmsqtf_status' => 'Cmsqtf Status',
            'cmsqtf_createdon' => 'Cmsqtf Createdon',
            'cmsqtf_createdby' => 'Cmsqtf Createdby',
            'cmsqtf_createdbyipaddr' => 'Cmsqtf Createdbyipaddr',
            'cmsqtf_updatedon' => 'Cmsqtf Updatedon',
            'cmsqtf_updatedby' => 'Cmsqtf Updatedby',
            'cmsqtf_updatedbyipaddr' => 'Cmsqtf Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqtfCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqtf_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqtfUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqtf_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnairetmplformTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsquestionnairetmplformTblQuery(get_called_class());
    }
}
