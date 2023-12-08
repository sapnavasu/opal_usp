<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\mst\models\MembercompanymstTbl;

/**
 * This is the model class for table "cmsquestionnaireformtrnx_tbl".
 *
 * @property int $cmsquestionnaireformtrnx_pk Primary key
 * @property int $cmsqft_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmsqft_cmsquestionnaireform_fk Reference to cmsquestionnaireform_tbl
 * @property int $cmsqft_shared_type 1 - Quotation Questionnaire, 2 - Tender Enquiry Questionnaire
 * @property int $cmsqft_shared_fk Reference to cmsquotationhdr_tbl, cmstenderhdr_tbl
 * @property array $cmsqft_answer response in json format
 * @property int $cmsqft_status 1 - Active, 2 - Inactive Default: 1
 * @property string $cmsqft_createdon Date of creation
 * @property int $cmsqft_createdby Reference to usermst_tbl
 * @property string $cmsqft_createdbyipaddr User IP Address
 * @property string $cmsqft_updatedon Date of update
 * @property int $cmsqft_updatedby Reference to usermst_tbl
 * @property string $cmsqft_updatedbyipaddr User IP Address
 *
 * @property CmsquestionnaireformTbl $cmsqftCmsquestionnaireformFk
 * @property UsermstTbl $cmsqftCreatedby
 * @property MembercompanymstTbl $cmsqftMemcompmstFk
 * @property UsermstTbl $cmsqftUpdatedby
 * @property CmstenderresponseTbl[] $cmstenderresponseTbls
 */
class CmsquestionnaireformtrnxTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsquestionnaireformtrnx_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsqft_memcompmst_fk', 'cmsqft_cmsquestionnaireform_fk', 'cmsqft_shared_type', 'cmsqft_shared_fk', 'cmsqft_answer', 'cmsqft_createdon', 'cmsqft_createdby'], 'required'],
            [['cmsqft_memcompmst_fk', 'cmsqft_cmsquestionnaireform_fk', 'cmsqft_shared_type', 'cmsqft_shared_fk', 'cmsqft_status', 'cmsqft_createdby', 'cmsqft_updatedby'], 'integer'],
            [['cmsqft_answer', 'cmsqft_createdon', 'cmsqft_updatedon'], 'safe'],
            [['cmsqft_createdbyipaddr', 'cmsqft_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmsqft_cmsquestionnaireform_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsquestionnaireformTbl::className(), 'targetAttribute' => ['cmsqft_cmsquestionnaireform_fk' => 'cmsquestionnaireform_pk']],
            [['cmsqft_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqft_createdby' => 'UserMst_Pk']],
            [['cmsqft_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['cmsqft_memcompmst_fk' => 'MemberCompMst_Pk']],
            [['cmsqft_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqft_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsquestionnaireformtrnx_pk' => 'Cmsquestionnaireformtrnx Pk',
            'cmsqft_memcompmst_fk' => 'Cmsqft Memcompmst Fk',
            'cmsqft_cmsquestionnaireform_fk' => 'Cmsqft Cmsquestionnaireform Fk',
            'cmsqft_shared_type' => 'Cmsqft Shared Type',
            'cmsqft_shared_fk' => 'Cmsqft Shared Fk',
            'cmsqft_answer' => 'Cmsqft Answer',
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
    public function getCmsqftCmsquestionnaireformFk()
    {
        return $this->hasOne(CmsquestionnaireformTbl::className(), ['cmsquestionnaireform_pk' => 'cmsqft_cmsquestionnaireform_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqftCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqft_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqftMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cmsqft_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqftUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqft_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderresponseTbls()
    {
        return $this->hasMany(CmstenderresponseTbl::className(), ['ctr_cmsquestionnaireformtrnx_fk' => 'cmsquestionnaireformtrnx_pk']);
    }
}
