<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsquestionnaireformtrnxtemp_tbl".
 *
 * @property int $cmsquestionnaireformtrnxtemp_pk Primary key
 * @property int $cmsqftt_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmsqftt_cmsquestionnaireformtemp_fk Reference to cmsquestionnaireform_tbl
 * @property int $cmsqftt_shared_type 1 - Quotation Questionnaire, 2 - Tender Enquiry Questionnaire
 * @property int $cmsqftt_shared_fk Reference to cmsquotationhdr_tbl, cmstenderhdr_tbl
 * @property array $cmsqftt_answer response in json format
 * @property int $cmsqftt_status 1 - Active, 2 - Inactive Default: 1
 * @property string $cmsqftt_createdon Date of creation
 * @property int $cmsqftt_createdby Reference to usermst_tbl
 * @property string $cmsqftt_createdbyipaddr User IP Address
 * @property string $cmsqftt_updatedon Date of update
 * @property int $cmsqftt_updatedby Reference to usermst_tbl
 * @property string $cmsqftt_updatedbyipaddr User IP Address
 *
 * @property CmsquestionnaireformtempTbl $cmsqfttCmsquestionnaireformtempFk
 * @property UsermstTbl $cmsqfttCreatedby
 * @property MembercompanymstTbl $cmsqfttMemcompmstFk
 * @property UsermstTbl $cmsqfttUpdatedby
 */
class CmsquestionnaireformtrnxtempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsquestionnaireformtrnxtemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsqftt_memcompmst_fk', 'cmsqftt_cmsquestionnaireformtemp_fk', 'cmsqftt_shared_type', 'cmsqftt_shared_fk', 'cmsqftt_answer', 'cmsqftt_createdon', 'cmsqftt_createdby'], 'required'],
            [['cmsqftt_memcompmst_fk', 'cmsqftt_cmsquestionnaireformtemp_fk', 'cmsqftt_shared_type', 'cmsqftt_shared_fk', 'cmsqftt_status', 'cmsqftt_createdby', 'cmsqftt_updatedby'], 'integer'],
            [['cmsqftt_answer', 'cmsqftt_createdon', 'cmsqftt_updatedon'], 'safe'],
            [['cmsqftt_createdbyipaddr', 'cmsqftt_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmsqftt_cmsquestionnaireformtemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsquestionnaireformtempTbl::className(), 'targetAttribute' => ['cmsqftt_cmsquestionnaireformtemp_fk' => 'cmsquestionnaireformtemp_pk']],
            [['cmsqftt_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqftt_createdby' => 'UserMst_Pk']],
            [['cmsqftt_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['cmsqftt_memcompmst_fk' => 'MemberCompMst_Pk']],
            [['cmsqftt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqftt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsquestionnaireformtrnxtemp_pk' => 'Cmsquestionnaireformtrnxtemp Pk',
            'cmsqftt_memcompmst_fk' => 'Cmsqftt Memcompmst Fk',
            'cmsqftt_cmsquestionnaireformtemp_fk' => 'Cmsqftt Cmsquestionnaireformtemp Fk',
            'cmsqftt_shared_type' => 'Cmsqftt Shared Type',
            'cmsqftt_shared_fk' => 'Cmsqftt Shared Fk',
            'cmsqftt_answer' => 'Cmsqftt Answer',
            'cmsqftt_status' => 'Cmsqftt Status',
            'cmsqftt_createdon' => 'Cmsqftt Createdon',
            'cmsqftt_createdby' => 'Cmsqftt Createdby',
            'cmsqftt_createdbyipaddr' => 'Cmsqftt Createdbyipaddr',
            'cmsqftt_updatedon' => 'Cmsqftt Updatedon',
            'cmsqftt_updatedby' => 'Cmsqftt Updatedby',
            'cmsqftt_updatedbyipaddr' => 'Cmsqftt Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfttCmsquestionnaireformtempFk()
    {
        return $this->hasOne(CmsquestionnaireformtempTbl::className(), ['cmsquestionnaireformtemp_pk' => 'cmsqftt_cmsquestionnaireformtemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfttCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqftt_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfttMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cmsqftt_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfttUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqftt_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformtrnxtempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsquestionnaireformtrnxtempTblQuery(get_called_class());
    }
}
