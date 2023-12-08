<?php

namespace api\modules\pms\models;

use common\models\UsermstTbl;
use Yii;
use common\models\MembercompanymstTbl;

/**
 * This is the model class for table "cmstenderresponse_tbl".
 *
 * @property int $cmstenderresponse_pk Primary key
 * @property int $ctr_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $ctr_cmstenderhdr_fk Reference to cmstenderhdr_tbl
 * @property int $ctr_status 1 - Yet to Acknowledge/Draft, 2 - Acknowledged/Submitted, 3 - Terminated(who Created), 4 - Suspended(Backend), 5 - Shortlisted(Operator End), 6- Rejected(Operator End),  7 - Awarded(Operator End), 8 - Declined(EOI)
 * @property int $ctr_cmsquestionnaireformtrnx_fk Reference to cmsquestionnaireformtrnx_tbl
 * @property string $ctr_doctitle Document Title
 * @property string $ctr_comment Comments or short summary
 * @property array $ctr_supdoc_filepath Reference to memcompfiledtls_tbl in comma separation
 * @property string $ctr_createdon Date of creation
 * @property int $ctr_createdby Reference to usermst_tbl
 * @property string $ctr_createdbyipaddr User IP Addresse
 * @property string $ctr_updatedon Date of update
 * @property int $ctr_updatedby Reference to usermst_tbl
 * @property string $ctr_updatedbyipaddr User IP Address
 *
 * @property MembercompanymstTbl $ctr_memcompmst_fk
 * @property CmstenderhdrTbl $ctr_cmstenderhdr_fk
 * @property CmsquestionnaireformtrnxTbl $ctr_cmsquestionnaireformtrnx_fk
 * @property UsermstTbl $cmsqftCreatedby
 * @property CmsquotationhdrTbl $cmsqftSharedFk
 * @property UsermstTbl $cmsqftUpdatedby
 */
class CmstenderresponseTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstenderresponse_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctr_memcompmst_fk', 'ctr_cmstenderhdr_fk', 'ctr_status', 'ctr_createdon', 'ctr_createdby'], 'required'],
            [['ctr_memcompmst_fk', 'ctr_cmstenderhdr_fk', 'ctr_cmsquestionnaireformtrnx_fk', 'ctr_createdby', 'ctr_updatedby'], 'integer'],
            [['ctr_createdon', 'ctr_updatedon'], 'safe'],
            [['ctr_createdbyipaddr', 'ctr_updatedbyipaddr'], 'string', 'max' => 50],
            [['ctr_cmsquestionnaireformtrnx_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsquestionnaireformtrnxTbl::className(), 'targetAttribute' => ['ctr_cmsquestionnaireformtrnx_fk' => 'cmsquestionnaireformtrnx_pk']],
            [['ctr_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctr_createdby' => 'UserMst_Pk']],
            [['ctr_cmstenderhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrTbl::className(), 'targetAttribute' => ['ctr_cmstenderhdr_fk' => 'cmstenderhdr_pk']],
            [['ctr_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctr_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstenderresponse_pk' => 'Cmstenderresponse Pk',
            'ctr_memcompmst_fk' => 'Ctr Memcompmst Fk',
            'ctr_cmstenderhdr_fk' => 'Ctr Cmstenderhdr Fk',
            'ctr_cmsquestionnaireformtrnx_fk' => 'Ctr Cmsquestionnaireformtrnx Fk',
            'ctr_status' => 'Ctr Isacknowledge',
            'ctr_doctitle' => 'Ctr Doctitle',
            'ctr_comment' => 'Ctr Comment',
            'ctr_supdoc_filepath' => 'Ctr Supdoc Filepath',
            'ctr_createdon' => 'Cmsqft Createdon',
            'ctr_createdby' => 'Cmsqft Createdby',
            'ctr_createdbyipaddr' => 'Cmsqft Createdbyipaddr',
            'ctr_updatedon' => 'Cmsqft Updatedon',
            'ctr_updatedby' => 'Cmsqft Updatedby',
            'ctr_updatedbyipaddr' => 'Cmsqft Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqftCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctr_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqftUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctr_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'ctr_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponselist()
    {
        return $this->hasMany(CmstenderhdrTbl::className(), ['cmstenderhdr_pk' => 'ctr_cmstenderhdr_fk']);
    }
}
