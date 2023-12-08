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

/**
 * This is the model class for table "cmstenderhdrtemp_tbl".
 *
 * @property int $cmstenderhdrtemp_pk Primary key
 * @property int $cmstht_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmstht_cmsrequisitionformdtls_fk Reference to cmsrequisitionformdtls_tbl
 * @property int $cmstht_type 1 - RFI, 2 - EOI, 3 - PQ, 4 - RFP, 5 - RFQ, 6 - RFT, 7 - eTender, 8 - eAuction
 * @property int $cmstht_cmstenderhdrtemp_fk From which Rfx this created Reference to cmstenderhdrtemp_tbl
 * @property string $cmstht_title Title
 * @property string $cmstht_uid Unique ID Auto generated value
 * @property string $cmstht_refno Reference Number
 * @property int $cmstht_initiatedby Reference to usermst_tbl
 * @property string $cmstht_initiateddate Initiated Date
 * @property int $cmstht_cmsdisciplinedtls_fk Reference to cmsdisciplinedtls_tbl
 * @property string $cmstht_shortdesc Short Description
 * @property string $cmstht_csstartdate Completion Schedule Start Date (Applicable for RFT)
 * @property string $cmstht_csenddate Completion Schedule End Date (Applicable for RFT)
 * @property string $cmstht_statement Statment of Need
 * @property string $cmstht_instruction Instructions
 * @property string $cmstht_mineligibility Minimum Eligibility
 * @property string $cmstht_scopeofwork Scope of Work
 * @property string $cmstht_specdrawing Specification and Drawing
 * @property string $cmstht_milestone Milestones
 * @property string $cmstht_reqdate Required Date
 * @property string $cmstht_reqincoterms Required Incoterms
 * @property string $cmstht_portname Port Name is captured when it has cmstht_reqincoterms
 * @property int $cmstht_joblocation List to be provided
 * @property int $cmstht_currencymst_fk Currency Type Reference to currencymst_tbl
 * @property int $cmstht_cmsquestionnaireformtemp_fk Reference to cmsquestionnaireformtemp_tbl
 * @property string $cmstht_remarks Remarks for supporting document accordion
 * @property int $cmstht_skdtype 1 - Schedule Now, 2 - Schedule Later
 * @property string $cmstht_skdstartdate Schedule later Date and time
 * @property int $cmstht_skd_timezone_fk Reference to timezone_tbl
 * @property string $cmstht_skdclosedate Closing Date and time
 * @property int $cmstht_setreminder Set Reminder 1 - Yes, 2 - No
 * @property string $cmstht_closeintvl Interval for Before Closing
 * @property int $cmstht_closeintvltype Type of Interval for closing date 1 - Daily, 2 - Monthly, 3 - Quarterly, 4 - Half-yearly, 5 - Yearly
 * @property string $cmstht_openintvl Interval for After Opening
 * @property int $cmstht_openintvltype Type of Interval for opening date 1 - Daily, 2 - Monthly, 3 - Quarterly, 4 - Half-yearly, 5 - Yearly
 * @property string $cmstht_config_usermst_fk Notify users: Reference to usermst_tbl in comma separation
 * @property string $cmstht_tgtcriteria Targetted criteria in encrypted
 * @property array $cmstht_tgtcriteriabag Targetted criteria in json
 * @property int $cmstht_tgtmailstatus Overall Mail Status whether sent / not sent for all the targetees 1- Sent, 2 - Not Sent Default : 2
 * @property string $cmstht_tgtmailcount Total count of targetted suppliers default: 0
 * @property int $cmstht_issubcontrqmt Sub Contracting Requirement 1 - Yes, 2 - No
 * @property int $cmstht_obligation 1 - MSME, 2 - LCC, 3 - MSME & LCC, 4 - Others, 5- Not Applicable
 * @property string $cmstht_msmepercent MSME Obligation Percentage
 * @property string $cmstht_lccpercent LCC Obligation Percentage
 * @property string $cmstht_obligationscope Scope of Obligation
 * @property int $cmstht_isicv 1 - Yes, 2 - No
 * @property string $cmstht_icv_startyear ICV Plan Start Year Format (ex: 2021)
 * @property int $cmstht_icv_startquarter ICV Plan Start Quarter: 1 - Q1, 2 - Q2, 3 - Q3, 4 - Q4
 * @property string $cmstht_icv_endyear ICV Plan End Year Format (ex: 2021)
 * @property int $cmstht_icv_endquarter ICV Plan End Quarter: 1 - Q1, 2 - Q2, 3 - Q3, 4 - Q4
 * @property int $cmstht_isetendmandate eTendering Manadate 1 - Yes, 2 - No
 * @property int $cmstht_approvauth Approval Authority 1 - Contractor, 2 - Buyer
 * @property string $cmstht_invoiceinterval Terms & Conditions --> Payment from Invoice Date --> Interval count
 * @property int $cmstht_invoiceintervaltype Terms & Conditions --> Payment from Invoice Date --> Interval Type: 1 - Days, 2 - Weeks, 3 - Months
 * @property string $cmstht_contact_usermst_fk Contact Details Reference to usermst_tbl in comma separation
 * @property string $cmstht_attachlink Additional Documents --> Attachment Link
 * @property string $cmstht_attachclosedate Additional Documents --> Attachment Closing Date
 * @property int $cmstht_tenderstatus 1 - Yet to Submit, 2 - Submitted, 3 - Shortlisted, 4 - Rejected, 5 - Awarded, 6 - Terminated, 7 - Closed, 8 - Yet to Award, 9 - Yet to Shortlist, 10 - Shortlisting in Progress
 * @property string $cmstht_tendercomments Comments to be collected when there is a change in tender status
 * @property int $cmstht_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $cmstht_createdon Date of creation
 * @property int $cmstht_createdby Reference to usermst_tbl
 * @property string $cmstht_createdbyipaddr User IP Address
 * @property string $cmstht_updatedon Date of update
 * @property int $cmstht_updatedby Reference to usermst_tbl
 * @property string $cmstht_updatedbyipaddr User IP Address
 * @property string $cmstht_terminatedon Date of Termination
 * @property int $cmstht_terminatedby Reference to usermst_tbl
 * @property string $cmstht_terminatedbyipaddr User IP Address
 * @property string $cmstht_latesttime On insert,update latest date & time will be captured
 *
 * @property CmsquestionnaireformtempTbl $cmsthtCmsquestionnaireformtempFk
 * @property CmstenderhdrtempTbl $cmsthtCmstenderhdrtempFk
 * @property CmstenderhdrtempTbl[] $cmstenderhdrtempTbls
 * @property UsermstTbl $cmsthtCreatedby
 * @property CurrencymstTbl $cmsthtCurrencymstFk
 * @property UsermstTbl $cmsthtInitiatedby
 * @property TimezoneTbl $cmsthtSkdTimezoneFk
 * @property UsermstTbl $cmsthtUpdatedby
 */
class CmstenderhdrtempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstenderhdrtemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmstht_memcompmst_fk', 'cmstht_cmsrequisitionformdtls_fk', 'cmstht_type', 'cmstht_title', 'cmstht_uid', 'cmstht_refno', 'cmstht_initiatedby', 'cmstht_initiateddate'], 'required'],
            [['cmstht_memcompmst_fk', 'cmstht_cmsrequisitionformdtls_fk', 'cmstht_type', 'cmstht_cmstenderhdrtemp_fk', 'cmstht_initiatedby', 'cmstht_cmsdisciplinedtls_fk', 'cmstht_joblocation', 'cmstht_currencymst_fk', 'cmstht_cmsquestionnaireformtemp_fk', 'cmstht_skdtype', 'cmstht_skd_timezone_fk', 'cmstht_setreminder', 'cmstht_closeintvltype', 'cmstht_openintvltype', 'cmstht_tgtmailstatus', 'cmstht_issubcontrqmt', 'cmstht_obligation', 'cmstht_isicv', 'cmstht_icv_startquarter', 'cmstht_icv_endquarter', 'cmstht_isetendmandate', 'cmstht_approvauth', 'cmstht_invoiceintervaltype', 'cmstht_tenderstatus', 'cmstht_isdeleted', 'cmstht_createdby', 'cmstht_updatedby', 'cmstht_terminatedby'], 'integer'],
            [['cmstht_initiateddate', 'cmstht_csstartdate', 'cmstht_csenddate', 'cmstht_reqdate', 'cmstht_skdstartdate', 'cmstht_skdclosedate', 'cmstht_tgtcriteriabag', 'cmstht_icv_startyear', 'cmstht_icv_endyear', 'cmstht_attachclosedate', 'cmstht_createdon', 'cmstht_updatedon', 'cmstht_terminatedon', 'cmstht_latesttime'], 'safe'],
            [['cmstht_shortdesc', 'cmstht_statement', 'cmstht_instruction', 'cmstht_mineligibility', 'cmstht_scopeofwork', 'cmstht_specdrawing', 'cmstht_milestone', 'cmstht_reqincoterms', 'cmstht_portname', 'cmstht_remarks', 'cmstht_config_usermst_fk', 'cmstht_tgtcriteria', 'cmstht_obligationscope', 'cmstht_contact_usermst_fk', 'cmstht_attachlink', 'cmstht_tendercomments'], 'string'],
            [['cmstht_closeintvl', 'cmstht_openintvl', 'cmstht_tgtmailcount', 'cmstht_msmepercent', 'cmstht_lccpercent', 'cmstht_invoiceinterval'], 'number'],
            [['cmstht_title'], 'string', 'max' => 255],
            [['cmstht_uid', 'cmstht_refno'], 'string', 'max' => 20],
            [['cmstht_createdbyipaddr', 'cmstht_updatedbyipaddr', 'cmstht_terminatedbyipaddr'], 'string', 'max' => 50],
            [['cmstht_uid'], 'unique'],
            [['cmstht_cmsquestionnaireformtemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsquestionnaireformtempTbl::className(), 'targetAttribute' => ['cmstht_cmsquestionnaireformtemp_fk' => 'cmsquestionnaireformtemp_pk']],
            [['cmstht_cmstenderhdrtemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrtempTbl::className(), 'targetAttribute' => ['cmstht_cmstenderhdrtemp_fk' => 'cmstenderhdrtemp_pk']],
            [['cmstht_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmstht_createdby' => 'UserMst_Pk']],
            [['cmstht_currencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['cmstht_currencymst_fk' => 'CurrencyMst_Pk']],
            [['cmstht_initiatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmstht_initiatedby' => 'UserMst_Pk']],
            [['cmstht_skd_timezone_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TimezoneTbl::className(), 'targetAttribute' => ['cmstht_skd_timezone_fk' => 'timezone_pk']],
            [['cmstht_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmstht_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstenderhdrtemp_pk' => 'Cmstenderhdrtemp Pk',
            'cmstht_memcompmst_fk' => 'Cmstht Memcompmst Fk',
            'cmstht_cmsrequisitionformdtls_fk' => 'Cmstht Cmsrequisitionformdtls Fk',
            'cmstht_type' => 'Cmstht Type',
            'cmstht_cmstenderhdrtemp_fk' => 'Cmstht Cmstenderhdrtemp Fk',
            'cmstht_title' => 'Cmstht Title',
            'cmstht_uid' => 'Cmstht Uid',
            'cmstht_refno' => 'Cmstht Refno',
            'cmstht_initiatedby' => 'Cmstht Initiatedby',
            'cmstht_initiateddate' => 'Cmstht Initiateddate',
            'cmstht_cmsdisciplinedtls_fk' => 'Cmstht Cmsdisciplinedtls Fk',
            'cmstht_shortdesc' => 'Cmstht Shortdesc',
            'cmstht_csstartdate' => 'Cmstht Csstartdate',
            'cmstht_csenddate' => 'Cmstht Csenddate',
            'cmstht_statement' => 'Cmstht Statement',
            'cmstht_instruction' => 'Cmstht Instruction',
            'cmstht_mineligibility' => 'Cmstht Mineligibility',
            'cmstht_scopeofwork' => 'Cmstht Scopeofwork',
            'cmstht_specdrawing' => 'Cmstht Specdrawing',
            'cmstht_milestone' => 'Cmstht Milestone',
            'cmstht_reqdate' => 'Cmstht Reqdate',
            'cmstht_reqincoterms' => 'Cmstht Reqincoterms',
            'cmstht_portname' => 'Cmstht Portname',
            'cmstht_joblocation' => 'Cmstht Joblocation',
            'cmstht_currencymst_fk' => 'Cmstht Currencymst Fk',
            'cmstht_cmsquestionnaireformtemp_fk' => 'Cmstht Cmsquestionnaireformtemp Fk',
            'cmstht_remarks' => 'Cmstht Remarks',
            'cmstht_skdtype' => 'Cmstht Skdtype',
            'cmstht_skdstartdate' => 'Cmstht Skdstartdate',
            'cmstht_skd_timezone_fk' => 'Cmstht Skd Timezone Fk',
            'cmstht_skdclosedate' => 'Cmstht Skdclosedate',
            'cmstht_setreminder' => 'Cmstht Setreminder',
            'cmstht_closeintvl' => 'Cmstht Closeintvl',
            'cmstht_closeintvltype' => 'Cmstht Closeintvltype',
            'cmstht_openintvl' => 'Cmstht Openintvl',
            'cmstht_openintvltype' => 'Cmstht Openintvltype',
            'cmstht_config_usermst_fk' => 'Cmstht Config Usermst Fk',
            'cmstht_tgtcriteria' => 'Cmstht Tgtcriteria',
            'cmstht_tgtcriteriabag' => 'Cmstht Tgtcriteriabag',
            'cmstht_tgtmailstatus' => 'Cmstht Tgtmailstatus',
            'cmstht_tgtmailcount' => 'Cmstht Tgtmailcount',
            'cmstht_issubcontrqmt' => 'Cmstht Issubcontrqmt',
            'cmstht_obligation' => 'Cmstht Obligation',
            'cmstht_msmepercent' => 'Cmstht Msmepercent',
            'cmstht_lccpercent' => 'Cmstht Lccpercent',
            'cmstht_obligationscope' => 'Cmstht Obligationscope',
            'cmstht_isicv' => 'Cmstht Isicv',
            'cmstht_icv_startyear' => 'Cmstht Icv Startyear',
            'cmstht_icv_startquarter' => 'Cmstht Icv Startquarter',
            'cmstht_icv_endyear' => 'Cmstht Icv Endyear',
            'cmstht_icv_endquarter' => 'Cmstht Icv Endquarter',
            'cmstht_isetendmandate' => 'Cmstht Isetendmandate',
            'cmstht_approvauth' => 'Cmstht Approvauth',
            'cmstht_invoiceinterval' => 'Cmstht Invoiceinterval',
            'cmstht_invoiceintervaltype' => 'Cmstht Invoiceintervaltype',
            'cmstht_contact_usermst_fk' => 'Cmstht Contact Usermst Fk',
            'cmstht_attachlink' => 'Cmstht Attachlink',
            'cmstht_attachclosedate' => 'Cmstht Attachclosedate',
            'cmstht_tenderstatus' => 'Cmstht Tenderstatus',
            'cmstht_tendercomments' => 'Cmstht Tendercomments',
            'cmstht_isdeleted' => 'Cmstht Isdeleted',
            'cmstht_createdon' => 'Cmstht Createdon',
            'cmstht_createdby' => 'Cmstht Createdby',
            'cmstht_createdbyipaddr' => 'Cmstht Createdbyipaddr',
            'cmstht_updatedon' => 'Cmstht Updatedon',
            'cmstht_updatedby' => 'Cmstht Updatedby',
            'cmstht_updatedbyipaddr' => 'Cmstht Updatedbyipaddr',
            'cmstht_terminatedon' => 'Cmstht Terminatedon',
            'cmstht_terminatedby' => 'Cmstht Terminatedby',
            'cmstht_terminatedbyipaddr' => 'Cmstht Terminatedbyipaddr',
            'cmstht_latesttime' => 'Cmstht Latesttime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthtCmsquestionnaireformtempFk()
    {
        return $this->hasOne(CmsquestionnaireformtempTbl::className(), ['cmsquestionnaireformtemp_pk' => 'cmstht_cmsquestionnaireformtemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsaddinfodtlstempTbls()
    {
        return $this->hasMany(CmsaddinfodtlstempTbl::className(), ['caidt_cmstenderhdrtemp_fk' => 'cmstenderhdrtemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthtCmstenderhdrtempFk()
    {
        return $this->hasOne(CmstenderhdrtempTbl::className(), ['cmstenderhdrtemp_pk' => 'cmstht_cmstenderhdrtemp_fk']);
    }
     public function getCmsthCmstenderhdrtbl()
    {
        return $this->hasOne(CmstenderhdrTbl::className(), ['cmstenderhdr_pk' => 'cmstht_cmstenderhdrtemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderhdrtempTbls()
    {
        return $this->hasMany(CmstenderhdrtempTbl::className(), ['cmstht_cmstenderhdrtemp_fk' => 'cmstenderhdrtemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthtCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmstht_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthtCurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'cmstht_currencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthtInitiatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmstht_initiatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthtSkdTimezoneFk()
    {
        return $this->hasOne(TimezoneTbl::className(), ['timezone_pk' => 'cmstht_skd_timezone_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmstht_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmstenderhdrtempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmstenderhdrtempTblQuery(get_called_class());
    }

      /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsaddinfodtlsTbls()
    {
        return $this->hasMany(CmsaddinfodtlstempTbl::className(), ['caidt_cmstenderhdrtemp_fk' => 'cmstenderhdrtemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscontracthdrTbls()
    {
        return $this->hasMany(CmscontracthdrTbl::className(), ['cmsch_cmstenderhdr_fk' => 'cmstenderhdrtemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsquotationhdrTbls()
    {
        return $this->hasMany(CmsquotationhdrTbl::className(), ['cmsqh_cmstenderhdr_fk' => 'cmstenderhdrtemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthCmsquestionnaireformFk()
    {
        return $this->hasOne(CmsquestionnaireformTbl::className(), ['cmsquestionnaireform_pk' => 'cmstht_cmsquestionnaireformtemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthCmsrequisitionformdtlsFk()
    {
        return $this->hasOne(CmsrequisitionformdtlsTbl::className(), ['cmsrequisitionformdtls_pk' => 'cmstht_cmsrequisitionformdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmstht_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsdisciplined()
    {
        return $this->hasOne(CmsdisciplinedtlsTbl::className(), ['cmsdisciplinedtls_pk' => 'cmstht_cmsdisciplinedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthInitiatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmstht_initiatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthCurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'cmstht_currencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthSkdTimezoneFk()
    {
        return $this->hasOne(TimezoneTbl::className(), ['timezone_pk' => 'cmstht_skd_timezone_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmstht_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstendertargethdrTbls()
    {
        return $this->hasMany(CmstendertargethdrtempTbl::className(), ['cmsttht_cmstenderhdrtemp_fk' => 'cmstenderhdrtemp_pk']);
    }
    public function getNewcmstendertargethdrTbls()
    {
        return $this->hasMany(CmstendertargethdrtempTbl::className(), ['cmsttht_cmstenderhdrtemp_fk' => 'cmstenderhdrtemp_pk'])->where(['cmsttht_targetsuptype' => 1])->count();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJsrsnonbidderhstyTbls()
    {
        return $this->hasMany(JsrsnonbidderhstyTbl::className(), ['jnbh_cmstenderhdr_fk' => 'cmstenderhdrtemp_pk']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembercompanymsttbl(){
        return $this->hasOne(CmsmembercompanymstTbl::class,  ['MemberCompMst_Pk' => 'cmstht_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelfPrevoius()
    {
        return $this->hasOne(self::className(), ['cmstenderhdrtemp_pk' => 'cmstht_cmstenderhdrtemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderpsmaps()
    {
        return $this->hasMany(CmstenderpsmapTbl::className(), ['ctpsm_shared_fk' => 'cmstenderhdrtemp_pk'])->where(['ctpsm_shared_type' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsrqprodservdtlstemp()
    {
        return $this->hasMany(CmsrqprodservdtlstempTbl::className(), ['crpsdt_shared_fk' => 'cmstenderhdrtemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportingDocuments()
    {
        return $this->hasMany(CmssupdocumenttempTbl::className(), ['cmssdt_shared_fk' => 'cmstenderhdrtemp_pk'])->where(['cmssdt_type' => 3]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductNServiceList()
    {
        return $this->hasMany(CmsrqprodservdtlsTbl::className(), ['crpsd_shared_fk' => 'cmstenderhdrtemp_pk'])->where(['crpsd_shared_type' => 3]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTt()
    {
        return $this->hasMany(CmssupdocumentTbl::className(), ['cmssd_shared_fk' => 'cmstenderhdrtemp_pk'])->where(['cmssd_type' => 3]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalDocuments()
    {
        return $this->hasMany(CmssupdocumenttempTbl::className(), ['cmssdt_shared_fk' => 'cmstenderhdrtemp_pk'])->where(['cmssdt_type' => 6]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstnctrnxs()
    {
        return $this->hasMany(CmstnctrnxtempTbl::className(), ['ctnctt_shared_fk' => 'cmstenderhdrtemp_pk'])->where(['ctnctt_type' => 2])->andOnCondition('ctnctt_cmstnchdr_fk != 8 and ctnctt_status = 1')->orderBy(['ctnctt_cmstnchdr_fk'=>SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecAndDraw()
    {
        return $this->hasMany(CmstnctrnxtempTbl::className(), ['ctnctt_shared_fk' => 'cmstenderhdrtemp_pk'])->where(['ctnctt_type' => 2, 'ctnctt_cmstnchdr_fk' => 8]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmspaymentterms()
    {
        return $this->hasMany(CmspaymenttermstempTbl::className(), ['cmsptt_shared_fk' => 'cmstenderhdrtemp_pk'])->where(['cmsptt_type' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfigUsers()
    {
        return UsermstTbl::findAll(explode(',', $this->attributes['cmstht_config_usermst_fk']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactUsers()
    {
        return UsermstTbl::findAll(explode(',', $this->attributes['cmstht_contact_usermst_fk']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssuppdocreqlisthdr()
    {
        return $this->hasOne(CmssuppdocreqlisthdrtempTbl::className(), ['csdrlht_shared_fk' => 'cmstenderhdrtemp_pk'])->where(['csdrlht_shared_type' => 2]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsinspreqdochdr()
    {
        return $this->hasOne(CmsinspreqdochdrtempTbl::className(), ['cirdht_shared_fk' => 'cmstenderhdrtemp_pk'])->where(['cirdht_shared_type' => 2]);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderresponseTbls()
    {
        return $this->hasMany(CmstenderresponseTbl::className(), ['ctr_cmstenderhdr_fk' => 'cmstenderhdrtemp_pk']);
        // return $this->hasMany(CmstenderresponseTbl::className(), ['ctr_cmstenderhdr_fk' => 'cmstenderhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthterminatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmstht_terminatedby']);
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalandSupportDocuments()
    {
        return $this->hasMany(CmssupdocumenttempTbl::className(), ['cmssdt_shared_fk' => 'cmstenderhdrtemp_pk'])->where(['cmssdt_type' => [3,6]]);
    }
}
