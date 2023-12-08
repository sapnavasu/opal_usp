<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projdiligenceform_tbl".
 *
 * @property int $projdiligenceform_pk
 * @property string $pdf_formname
 * @property string $pdf_formdesc Description of the form
 * @property array $pdf_formtemplate
 * @property array $pdf_buildertemplate
 * @property int $pdf_formtype 1 - Template , 2 - Form
 * @property int $pdf_createdby
 * @property string $pdf_createdbyipaddr IP Address of the user
 * @property string $pdf_createdon
 * @property int $pdf_updatedby
 * @property string $pdf_updatedbyipaddr IP Address of the user
 * @property string $pdf_updatedon
 *
 * @property UsermstTbl $pdfCreatedby
 * @property UsermstTbl $pdfUpdatedby
 * @property ProjectdtlsTbl[] $projectdtlsTbls
 */
class ProjdiligenceformTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projdiligenceform_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pdf_formname', 'pdf_formtemplate', 'pdf_buildertemplate', 'pdf_formtype', 'pdf_createdby', 'pdf_createdon'], 'required'],
            [['pdf_formdesc'], 'string'],
            [['pdf_formtemplate', 'pdf_buildertemplate', 'pdf_createdon', 'pdf_updatedon'], 'safe'],
            [['pdf_formtype', 'pdf_createdby', 'pdf_updatedby'], 'integer'],
            [['pdf_formname'], 'string', 'max' => 150],
            [['pdf_createdbyipaddr', 'pdf_updatedbyipaddr'], 'string', 'max' => 50],
            [['pdf_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['pdf_createdby' => 'UserMst_Pk']],
            [['pdf_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['pdf_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projdiligenceform_pk' => 'Projdiligenceform Pk',
            'pdf_formname' => 'Pdf Formname',
            'pdf_formdesc' => 'Pdf Formdesc',
            'pdf_formtemplate' => 'Pdf Formtemplate',
            'pdf_buildertemplate' => 'Pdf Buildertemplate',
            'pdf_formtype' => 'Pdf Formtype',
            'pdf_createdby' => 'Pdf Createdby',
            'pdf_createdbyipaddr' => 'Pdf Createdbyipaddr',
            'pdf_createdon' => 'Pdf Createdon',
            'pdf_updatedby' => 'Pdf Updatedby',
            'pdf_updatedbyipaddr' => 'Pdf Updatedbyipaddr',
            'pdf_updatedon' => 'Pdf Updatedon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPdfCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pdf_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPdfUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pdf_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectdtlsTbls()
    {
        return $this->hasMany(ProjectdtlsTbl::className(), ['prjd_projdiligenceform_fk' => 'projdiligenceform_pk']);
    }

    /**
     * {@inheritdoc}
     * @return ProjdiligenceformTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjdiligenceformTblQuery(get_called_class());
    }
}
