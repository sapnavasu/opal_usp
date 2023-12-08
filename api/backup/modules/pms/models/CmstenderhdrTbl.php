<?php
namespace api\modules\pms\models;

use Yii;
use api\modules\mst\models\ClassificationmstTbl;
use api\modules\mst\models\TimezoneTbl;
use api\modules\mst\models\CurrencymstTbl;
use common\models\UsermstTbl;
use api\modules\quot\models\CmsmembercompanymstTbl;
use app\models\CmsdisciplinedtlsTbl;
use api\modules\quot\models\CmsquotationhdrTbl;
use api\modules\pms\models\CmstenderhdrhstyTbl;


/**
 * This is the model class for table "cmstenderhdr_tbl".
 *
 * @property int $cmstenderhdr_pk Primary key
 * @property int $cmsth_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmsth_cmsrequisitionformdtls_fk Reference to cmsrequisitionformdtls_tbl
 * @property int $cmsth_type 1 - RFI, 2 - EOI, 3 - RFP, 4 - RFQ 
 * @property string $cmsth_title Title
 * @property string $cmsth_uid Unique ID Auto generated value
 * @property string $cmsth_refno Reference Number
 * @property int $cmsth_initiatedby Reference to usermst_tbl
 * @property string $cmsth_initiateddate Initiated Date
 * @property string $cmsth_shortdesc Short Description
 * @property string $cmsth_statement Statment of Need
 * @property string $cmsth_instruction Instructions
 * @property string $cmsth_mineligibility Minimum Eligibility
 * @property string $cmsth_scopeofwork Scope of Work
 * @property string $cmsth_specdrawing Specification and Drawing
 * @property string $cmsth_milestone Milestones
 * @property string $cmsth_reqdate Required Date
 * @property string $cmsth_reqincoterms Required Incoterms
 * @property int $cmsth_joblocation List to be provided
 * @property int $cmsth_currencymst_fk Currency Type Reference to currencymst_tbl
 * @property int $cmsth_cmsquestionnaireform_fk Reference to cmsquestionnaireform_tbl
 * @property string $cmsth_remarks Remarks for supporting document accordion
 * @property int $cmsth_skdtype 1 - Schedule Now, 2 - Schedule Later
 * @property string $cmsth_skdstartdate Schedule later Date and time
 * @property int $cmsth_skd_timezone_fk Reference to timezone_tbl
 * @property string $cmsth_skdclosedate Closing Date and time
 * @property int $cmsth_setreminder Set Reminder 1 - Yes, 2 - No
 * @property string $cmsth_closeintvl Interval for Before Closing
 * @property int $cmsth_closeintvltype Type of Interval for closing date 1 - Daily, 2 - Monthly, 3 - Quarterly, 4 - Half-yearly, 5 - Yearly
 * @property string $cmsth_openintvl Interval for After Opening
 * @property int $cmsth_openintvltype Type of Interval for opening date 1 - Daily, 2 - Monthly, 3 - Quarterly, 4 - Half-yearly, 5 - Yearly
 * @property string $cmsth_config_usermst_fk Notify users: Reference to usermst_tbl in comma separation
 * @property string $cmsth_tgtcriteria Targetted criteria in encrypted
 * @property array $cmsth_tgtcriteriabag Targetted criteria in json
 * @property int $cmsth_tgtmailstatus Overall Mail Status whether sent / not sent for all the targetees 1- Sent, 2 - Not Sent Default : 2
 * @property string $cmsth_tgtmailcount Total count of targetted suppliers default: 0
 * @property int $cmsth_issubcontrqmt Sub Contracting Requirement 1 - Yes, 2 - No
 * @property int $cmsth_obligation 1 - MSME, 2 - LCC, 3 - MSME & LCC, 4 - Others, 5- Not Applicable
 * @property string $cmsth_percent Required Percentage
 * @property string $cmsth_obligationscope Scope of Obligation
 * @property int $cmsth_isicv 1 - Yes, 2 - No
 * @property int $cmsth_isetendmandate eTendering Manadate 1 - Yes, 2 - No
 * @property int $cmsth_approvauth Approval Authority 1 - Contractor, 2 - Buyer
 * @property string $cmsth_contact_usermst_fk Contact Details Reference to usermst_tbl in comma separation
 * @property int $cmsth_tenderstatus 1 - Yet to Submit, 2 - Submitted, 3 - Shortlisted, 4 - Rejected, 5 - Awarded, 6 - Terminated, 7 - Closed
 * @property string $cmsth_tendercomments Comments to be collected when there is a change in tender status
 * @property string $cmsth_createdon Date of creation
 * @property int $cmsth_createdby Reference to usermst_tbl
 * @property string $cmsth_createdbyipaddr User IP Address
 * @property string $cmsth_updatedon Date of update
 * @property int $cmsth_updatedby Reference to usermst_tbl
 * @property string $cmsth_updatedbyipaddr User IP Address
 * @property string $cmsth_latesttime On insert,update latest date & time will be captured
 *
 * @property CmsaddinfodtlsTbl[] $cmsaddinfodtlsTbls
 * @property Cms hdrTbl[] $cmscontracthdrTbls
 * @property CmsquotationhdrTbl[] $cmsquotationhdrTbls
 * @property CmsquestionnaireformTbl $cmsthCmsquestionnaireformFk
 * @property CmsrequisitionformdtlsTbl $cmsthCmsrequisitionformdtlsFk
 * @property UsermstTbl $cmsthCreatedby
 * @property CurrencymstTbl $cmsthCurrencymstFk
 * @property UsermstTbl $cmsthInitiatedby
 * @property TimezoneTbl $cmsthSkdTimezoneFk
 * @property UsermstTbl $cmsthUpdatedby
 * @property CmstendertargethdrTbl[] $cmstendertargethdrTbls
 * @property JsrsnonbidderhstyTbl[] $jsrsnonbidderhstyTbls
 */
class CmstenderhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstenderhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsth_memcompmst_fk', 'cmsth_cmsrequisitionformdtls_fk', 'cmsth_type', 'cmsth_initiatedby', 'cmsth_joblocation', 'cmsth_currencymst_fk', 'cmsth_cmsquestionnaireform_fk', 'cmsth_skdtype', 'cmsth_skd_timezone_fk', 'cmsth_setreminder', 'cmsth_closeintvltype', 'cmsth_openintvltype', 'cmsth_tgtmailstatus', 'cmsth_issubcontrqmt', 'cmsth_obligation', 'cmsth_isicv', 'cmsth_isetendmandate', 'cmsth_approvauth', 'cmsth_tenderstatus', 'cmsth_createdby', 'cmsth_updatedby'], 'integer'],
            [['cmsth_cmsrequisitionformdtls_fk', 'cmsth_type', 'cmsth_title', 'cmsth_uid', 'cmsth_refno', 'cmsth_initiatedby', 'cmsth_initiateddate'], 'required'],
            [['cmsth_initiateddate', 'cmsth_reqdate', 'cmsth_skdstartdate', 'cmsth_skdclosedate', 'cmsth_tgtcriteriabag', 'cmsth_createdon', 'cmsth_updatedon', 'cmsth_latesttime', 'cmsth_attachclosedate'], 'safe'],
            [['cmsth_shortdesc', 'cmsth_statement', 'cmsth_instruction', 'cmsth_mineligibility', 'cmsth_scopeofwork', 'cmsth_specdrawing', 'cmsth_milestone', 'cmsth_reqincoterms', 'cmsth_remarks', 'cmsth_config_usermst_fk', 'cmsth_tgtcriteria', 'cmsth_obligationscope', 'cmsth_contact_usermst_fk', 'cmsth_tendercomments', 'cmsth_attachlink'], 'string'],
            [['cmsth_closeintvl', 'cmsth_openintvl', 'cmsth_tgtmailcount'], 'number'],
            [['cmsth_title'], 'string', 'max' => 255],
            [['cmsth_uid', 'cmsth_refno'], 'string', 'max' => 20],
            [['cmsth_createdbyipaddr', 'cmsth_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmsth_uid'], 'unique'],
            [['cmsth_cmsquestionnaireform_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsquestionnaireformTbl::className(), 'targetAttribute' => ['cmsth_cmsquestionnaireform_fk' => 'cmsquestionnaireform_pk']],
            [['cmsth_cmsrequisitionformdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrequisitionformdtlsTbl::className(), 'targetAttribute' => ['cmsth_cmsrequisitionformdtls_fk' => 'cmsrequisitionformdtls_pk']],
            [['cmsth_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsth_createdby' => 'UserMst_Pk']],
            [['cmsth_currencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['cmsth_currencymst_fk' => 'CurrencyMst_Pk']],
            [['cmsth_initiatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsth_initiatedby' => 'UserMst_Pk']],
            [['cmsth_skd_timezone_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TimezoneTbl::className(), 'targetAttribute' => ['cmsth_skd_timezone_fk' => 'timezone_pk']],
            [['cmsth_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsth_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstenderhdr_pk' => 'Cmstenderhdr Pk',
            'cmsth_memcompmst_fk' => 'Cmsth Memcompmst Fk',
            'cmsth_cmsrequisitionformdtls_fk' => 'Cmsth Cmsrequisitionformdtls Fk',
            'cmsth_type' => 'Cmsth Type',
            'cmsth_title' => 'Cmsth Title',
            'cmsth_uid' => 'Cmsth Uid',
            'cmsth_refno' => 'Cmsth Refno',
            'cmsth_initiatedby' => 'Cmsth Initiatedby',
            'cmsth_initiateddate' => 'Cmsth Initiateddate',
            'cmsth_shortdesc' => 'Cmsth Shortdesc',
            'cmsth_statement' => 'Cmsth Statement',
            'cmsth_instruction' => 'Cmsth Instruction',
            'cmsth_mineligibility' => 'Cmsth Mineligibility',
            'cmsth_scopeofwork' => 'Cmsth Scopeofwork',
            'cmsth_specdrawing' => 'Cmsth Specdrawing',
            'cmsth_milestone' => 'Cmsth Milestone',
            'cmsth_reqdate' => 'Cmsth Reqdate',
            'cmsth_reqincoterms' => 'Cmsth Reqincoterms',
            'cmsth_joblocation' => 'Cmsth Joblocation',
            'cmsth_currencymst_fk' => 'Cmsth Currencymst Fk',
            'cmsth_cmsquestionnaireform_fk' => 'Cmsth Cmsquestionnaireform Fk',
            'cmsth_remarks' => 'Cmsth Remarks',
            'cmsth_skdtype' => 'Cmsth Skdtype',
            'cmsth_skdstartdate' => 'Cmsth Skdstartdate',
            'cmsth_skd_timezone_fk' => 'Cmsth Skd Timezone Fk',
            'cmsth_skdclosedate' => 'Cmsth Skdclosedate',
            'cmsth_setreminder' => 'Cmsth Setreminder',
            'cmsth_closeintvl' => 'Cmsth Closeintvl',
            'cmsth_closeintvltype' => 'Cmsth Closeintvltype',
            'cmsth_openintvl' => 'Cmsth Openintvl',
            'cmsth_openintvltype' => 'Cmsth Openintvltype',
            'cmsth_config_usermst_fk' => 'Cmsth Config Usermst Fk',
            'cmsth_tgtcriteria' => 'Cmsth Tgtcriteria',
            'cmsth_tgtcriteriabag' => 'Cmsth Tgtcriteriabag',
            'cmsth_tgtmailstatus' => 'Cmsth Tgtmailstatus',
            'cmsth_tgtmailcount' => 'Cmsth Tgtmailcount',
            'cmsth_issubcontrqmt' => 'Cmsth Issubcontrqmt',
            'cmsth_obligation' => 'Cmsth Obligation',
            // 'cmsth_percent' => 'Cmsth Percent',
            'cmsth_obligationscope' => 'Cmsth Obligationscope',
            'cmsth_isicv' => 'Cmsth Isicv',
            'cmsth_isetendmandate' => 'Cmsth Isetendmandate',
            'cmsth_approvauth' => 'Cmsth Approvauth',
            'cmsth_contact_usermst_fk' => 'Cmsth Contact Usermst Fk',
            'cmsth_tenderstatus' => 'Cmsth Tenderstatus',
            'cmsth_tendercomments' => 'Cmsth Tendercomments',
            'cmsth_createdon' => 'Cmsth Createdon',
            'cmsth_createdby' => 'Cmsth Createdby',
            'cmsth_createdbyipaddr' => 'Cmsth Createdbyipaddr',
            'cmsth_updatedon' => 'Cmsth Updatedon',
            'cmsth_updatedby' => 'Cmsth Updatedby',
            'cmsth_updatedbyipaddr' => 'Cmsth Updatedbyipaddr',
            'cmsth_latesttime' => 'Cmsth Latesttime',
            'cmsth_attachlink' => 'Cmsth attachlink',
            'cmsth_attachclosedate' => 'Cmsth attachclosedate'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsaddinfodtlsTbls()
    {
        return $this->hasMany(CmsaddinfodtlsTbl::className(), ['caid_cmstenderhdr_fk' => 'cmstenderhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscontracthdrTbls()
    {
        return $this->hasMany(CmscontracthdrTbl::className(), ['cmsch_cmstenderhdr_fk' => 'cmstenderhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsquotationhdrTbls()
    {
        return $this->hasMany(CmsquotationhdrTbl::className(), ['cmsqh_cmstenderhdr_fk' => 'cmstenderhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthCmsquestionnaireformFk()
    {
        return $this->hasOne(CmsquestionnaireformTbl::className(), ['cmsquestionnaireform_pk' => 'cmsth_cmsquestionnaireform_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthCmsrequisitionformdtlsFk()
    {
        return $this->hasOne(CmsrequisitionformdtlsTbl::className(), ['cmsrequisitionformdtls_pk' => 'cmsth_cmsrequisitionformdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsth_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsdisciplined()
    {
        return $this->hasOne(CmsdisciplinedtlsTbl::className(), ['cmsdisciplinedtls_pk' => 'cmsth_cmsdisciplinedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthInitiatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsth_initiatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthCurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'cmsth_currencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthSkdTimezoneFk()
    {
        return $this->hasOne(TimezoneTbl::className(), ['timezone_pk' => 'cmsth_skd_timezone_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsth_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstendertargethdrTbls()
    {
        return $this->hasMany(CmstendertargethdrTbl::className(), ['cmstth_cmstenderhdr_fk' => 'cmstenderhdr_pk']);
    }
    public function getCmstendertargethdrTblsnew()
    {
        return $this->hasMany(CmstendertargethdrTbl::className(), ['cmstth_cmstenderhdr_fk' => 'cmstenderhdr_pk'])->where(['cmstth_targetsuptype' => 1]);
    }
    public function getCmstendertargethdrTblsold()
    {
        return $this->hasMany(CmstendertargethdrTbl::className(), ['cmstth_cmstenderhdr_fk' => 'cmstenderhdr_pk'])->where(['cmstth_targetsuptype' => 2]);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJsrsnonbidderhstyTbls()
    {
        return $this->hasMany(JsrsnonbidderhstyTbl::className(), ['jnbh_cmstenderhdr_fk' => 'cmstenderhdr_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmstenderhdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmstenderhdrTblQuery(get_called_class());
    }
    
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembercompanymsttbl(){
        return $this->hasOne(CmsmembercompanymstTbl::class,  ['MemberCompMst_Pk' => 'cmsth_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelfPrevoius()
    {
        return $this->hasOne(self::className(), ['cmstenderhdr_pk' => 'cmsth_cmstenderhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderpsmaps()
    {
        return $this->hasMany(CmstenderpsmapTbl::className(), ['ctpsm_shared_fk' => 'cmstenderhdr_pk'])->where(['ctpsm_shared_type' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportingDocuments()
    {
        return $this->hasMany(CmssupdocumentTbl::className(), ['cmssd_shared_fk' => 'cmstenderhdr_pk'])->where(['cmssd_type' => 3]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductNServiceList()
    {
        return $this->hasMany(CmsrqprodservdtlsTbl::className(), ['crpsd_shared_fk' => 'cmstenderhdr_pk'])->where(['crpsd_shared_type' => 3]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTt()
    {
        return $this->hasMany(CmssupdocumentTbl::className(), ['cmssd_shared_fk' => 'cmstenderhdr_pk'])->where(['cmssd_type' => 3]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalDocuments()
    {
        return $this->hasMany(CmssupdocumentTbl::className(), ['cmssd_shared_fk' => 'cmstenderhdr_pk'])->where(['cmssd_type' => 6]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstnctrnxs()
    {
        return $this->hasMany(CmstnctrnxTbl::className(), ['ctnct_shared_fk' => 'cmstenderhdr_pk'])->where(['ctnct_type' => 2])->andOnCondition('ctnct_cmstnchdr_fk != 8 and ctnct_status = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecAndDraw()
    {
        return $this->hasMany(CmstnctrnxTbl::className(), ['ctnct_shared_fk' => 'cmstenderhdr_pk'])->where(['ctnct_type' => 2, 'ctnct_cmstnchdr_fk' => 8]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmspaymentterms()
    {
        return $this->hasMany(CmspaymenttermsTbl::className(), ['cmspt_shared_fk' => 'cmstenderhdr_pk'])->where(['cmspt_type' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfigUsers()
    {
        return UsermstTbl::findAll(explode(',', $this->attributes['cmsth_config_usermst_fk']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactUsers()
    {
        return UsermstTbl::findAll(explode(',', $this->attributes['cmsth_contact_usermst_fk']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssuppdocreqlisthdr()
    {
        return $this->hasOne(CmssuppdocreqlisthdrTbl::className(), ['csdrlh_shared_fk' => 'cmstenderhdr_pk'])->where(['csdrlh_shared_type' => 2]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsinspreqdochdr()
    {
        return $this->hasOne(CmsinspreqdochdrTbl::className(), ['cirdh_shared_fk' => 'cmstenderhdr_pk'])->where(['cirdh_shared_type' => 2]);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderresponseTbls()
    {
        return $this->hasMany(CmstenderresponseTbl::className(), ['ctr_cmstenderhdr_fk' => 'cmstenderhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderhdrhstyTbls()
    {
        return $this->hasMany(CmstenderhdrhstyTbl::className(), ['cmsthh_cmstenderhdr_fk' => 'cmstenderhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalandSupportDocuments()
    {
        return $this->hasMany(CmssupdocumentTbl::className(), ['cmssd_shared_fk' => 'cmstenderhdr_pk'])->where(['cmssd_type' => [3,6]]);
    }
}
