<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use api\modules\mst\models\MembercompanymstTbl;

use Yii;

/**
 * This is the model class for table "cmsquestionnaireformtrnxhsty_tbl".
 *
 * @property int $cmsquestionnaireformtrnxhsty_pk Primary key
 * @property int $cmsqfth_cmsquestionnaireformtrnx_fk Reference to cmsquestionnaireformtrnx_tbl.cmsquestionnaireformtrnx_pk
 * @property int $cmsqfth_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmsqfth_cmsquestionnaireformhsty_fk Reference to cmsquestionnaireformhsty_tbl
 * @property int $cmsqfth_shared_type 1 - Quotation Questionnaire, 2 - Tender Enquiry Questionnaire
 * @property int $cmsqfth_shared_fk Reference to cmsquotationhdr_tbl, cmstenderhdr_tbl
 * @property array $cmsqfth_answer response in json format
 * @property int $cmsqfth_status 1 - Active, 2 - Inactive Default: 1
 * @property string $cmsqfth_createdon Date of creation
 * @property int $cmsqfth_createdby Reference to usermst_tbl
 * @property string $cmsqfth_createdbyipaddr User IP Address
 * @property string $cmsqfth_updatedon Date of update
 * @property int $cmsqfth_updatedby Reference to usermst_tbl
 * @property string $cmsqfth_updatedbyipaddr User IP Address
 *
 * @property CmsquestionnaireformhstyTbl $cmsqfthCmsquestionnaireformhstyFk
 * @property UsermstTbl $cmsqfthCreatedby
 * @property MembercompanymstTbl $cmsqfthMemcompmstFk
 * @property UsermstTbl $cmsqfthUpdatedby
 */
class CmsquestionnaireformtrnxhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsquestionnaireformtrnxhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsqfth_cmsquestionnaireformtrnx_fk', 'cmsqfth_memcompmst_fk', 'cmsqfth_cmsquestionnaireformhsty_fk', 'cmsqfth_shared_type', 'cmsqfth_shared_fk', 'cmsqfth_answer', 'cmsqfth_createdon', 'cmsqfth_createdby'], 'required'],
            [['cmsqfth_cmsquestionnaireformtrnx_fk', 'cmsqfth_memcompmst_fk', 'cmsqfth_cmsquestionnaireformhsty_fk', 'cmsqfth_shared_type', 'cmsqfth_shared_fk', 'cmsqfth_status', 'cmsqfth_createdby', 'cmsqfth_updatedby'], 'integer'],
            [['cmsqfth_answer', 'cmsqfth_createdon', 'cmsqfth_updatedon'], 'safe'],
            [['cmsqfth_createdbyipaddr', 'cmsqfth_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmsqfth_cmsquestionnaireformhsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsquestionnaireformhstyTbl::className(), 'targetAttribute' => ['cmsqfth_cmsquestionnaireformhsty_fk' => 'cmsquestionnaireformhsty_pk']],
            [['cmsqfth_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqfth_createdby' => 'UserMst_Pk']],
            [['cmsqfth_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['cmsqfth_memcompmst_fk' => 'MemberCompMst_Pk']],
            [['cmsqfth_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqfth_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsquestionnaireformtrnxhsty_pk' => 'Cmsquestionnaireformtrnxhsty Pk',
            'cmsqfth_cmsquestionnaireformtrnx_fk' => 'Cmsqfth Cmsquestionnaireformtrnx Fk',
            'cmsqfth_memcompmst_fk' => 'Cmsqfth Memcompmst Fk',
            'cmsqfth_cmsquestionnaireformhsty_fk' => 'Cmsqfth Cmsquestionnaireformhsty Fk',
            'cmsqfth_shared_type' => 'Cmsqfth Shared Type',
            'cmsqfth_shared_fk' => 'Cmsqfth Shared Fk',
            'cmsqfth_answer' => 'Cmsqfth Answer',
            'cmsqfth_status' => 'Cmsqfth Status',
            'cmsqfth_createdon' => 'Cmsqfth Createdon',
            'cmsqfth_createdby' => 'Cmsqfth Createdby',
            'cmsqfth_createdbyipaddr' => 'Cmsqfth Createdbyipaddr',
            'cmsqfth_updatedon' => 'Cmsqfth Updatedon',
            'cmsqfth_updatedby' => 'Cmsqfth Updatedby',
            'cmsqfth_updatedbyipaddr' => 'Cmsqfth Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfthCmsquestionnaireformhstyFk()
    {
        return $this->hasOne(CmsquestionnaireformhstyTbl::className(), ['cmsquestionnaireformhsty_pk' => 'cmsqfth_cmsquestionnaireformhsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfthCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqfth_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfthMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cmsqfth_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqfthUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqfth_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformtrnxhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsquestionnaireformtrnxhstyTblQuery(get_called_class());
    }
}
