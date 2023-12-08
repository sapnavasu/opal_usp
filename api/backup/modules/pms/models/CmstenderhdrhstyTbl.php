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
 * This is the model class for table "cmstenderhdrhsty_tbl".
 *
 * @property int $cmstenderhdrhsty_pk Primary key
 * @property int $cmsthh_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmsthh_cmsrequisitionformdtls_fk Reference to cmsrequisitionformdtls_tbl
 * @property int $cmsthh_contracthdr_fk reference to cmscontracthdr_tbl.cmscontracthdr_pk. to be used at supplier end
 * @property int $cmsthh_type 1 - RFI, 2 - EOI, 3 - PQ, 4 - RFP, 5 - RFQ, 6 - RFT, 7 - eTender, 8 - eAuction
 * @property int $cmsthh_cmstenderhdr_fk From which Rfx this created Reference to cmstenderhdr_tbl
 * @property string $cmsthh_title Title
 * @property string $cmsthh_uid Unique ID Auto generated value
 * @property string $cmsthh_refno Reference Number
 * @property int $cmsthh_initiatedby Reference to usermst_tbl
 * @property string $cmsthh_initiateddate Initiated Date
 * @property int $cmsthh_cmsdisciplinedtls_fk Reference to cmsdisciplinedtls_tbl
 * @property string $cmsthh_shortdesc Short Description
 * @property string $cmsthh_csstartdate Completion Schedule Start Date (Applicable for RFT)
 * @property string $cmsthh_csenddate Completion Schedule End Date (Applicable for RFT)
 * @property string $cmsthh_statement Statment of Need
 * @property string $cmsthh_instruction Instructions
 * @property string $cmsthh_mineligibility Minimum Eligibility
 * @property string $cmsthh_scopeofwork Scope of Work
 * @property string $cmsthh_specdrawing Specification and Drawing
 * @property string $cmsthh_milestone Milestones
 * @property string $cmsthh_reqdate Required Date
 * @property string $cmsthh_reqincoterms Required Incoterms
 * @property string $cmsthh_portname Port Name is captured when it has cmsth_reqincoterms
 * @property int $cmsthh_joblocation List to be provided
 * @property int $cmsthh_currencymst_fk Currency Type Reference to currencymst_tbl
 * @property int $cmsthh_cmsquestionnaireformhsty_fk Reference to cmsquestionnaireformhsty_tbl
 * @property string $cmsthh_remarks Remarks for supporting document accordion
 * @property int $cmsthh_skdtype 1 - Schedule Now, 2 - Schedule Later
 * @property string $cmsthh_skdstartdate Schedule later Date and time
 * @property int $cmsthh_skd_timezone_fk Reference to timezone_tbl
 * @property string $cmsthh_skdclosedate Closing Date and time
 * @property int $cmsthh_setreminder Set Reminder 1 - Yes, 2 - No
 * @property string $cmsthh_closeintvl Interval for Before Closing
 * @property int $cmsthh_closeintvltype Type of Interval for closing date 1 - Daily, 2 - Monthly, 3 - Quarterly, 4 - Half-yearly, 5 - Yearly
 * @property string $cmsthh_openintvl Interval for After Opening
 * @property int $cmsthh_openintvltype Type of Interval for opening date 1 - Daily, 2 - Monthly, 3 - Quarterly, 4 - Half-yearly, 5 - Yearly
 * @property string $cmsthh_config_usermst_fk Notify users: Reference to usermst_tbl in comma separation
 * @property string $cmsthh_tgtcriteria Targetted criteria in encrypted
 * @property array $cmsthh_tgtcriteriabag Targetted criteria in json
 * @property int $cmsthh_tgtmailstatus Overall Mail Status whether sent / not sent for all the targetees 1- Sent, 2 - Not Sent Default : 2
 * @property string $cmsthh_tgtmailcount Total count of targetted suppliers default: 0
 * @property int $cmsthh_issubcontrqmt Sub Contracting Requirement 1 - Yes, 2 - No
 * @property int $cmsthh_obligation 1 - MSME, 2 - LCC, 3 - MSME & LCC, 4 - Others, 5- Not Applicable
 * @property string $cmsthh_msmepercent MSME Obligation Percentage
 * @property string $cmsthh_lccpercent LCC Obligation Percentage
 * @property string $cmsthh_obligationscope Scope of Obligation
 * @property int $cmsthh_isicv 1 - Yes, 2 - No
 * @property string $cmsthh_icv_startyear ICV Plan Start Year Format (ex: 2021)
 * @property int $cmsthh_icv_startquarter ICV Plan Start Quarter: 1 - Q1, 2 - Q2, 3 - Q3, 4 - Q4
 * @property string $cmsthh_icv_endyear ICV Plan End Year Format (ex: 2021)
 * @property int $cmsthh_icv_endquarter ICV Plan End Quarter: 1 - Q1, 2 - Q2, 3 - Q3, 4 - Q4
 * @property int $cmsthh_isetendmandate eTendering Manadate 1 - Yes, 2 - No
 * @property int $cmsthh_approvauth Approval Authority 1 - Contractor, 2 - Buyer
 * @property string $cmsthh_invoiceinterval Terms & Conditions --> Payment from Invoice Date --> Interval count
 * @property int $cmsthh_invoiceintervaltype Terms & Conditions --> Payment from Invoice Date --> Interval Type: 1 - Days, 2 - Weeks, 3 - Months
 * @property string $cmsthh_contact_usermst_fk Contact Details Reference to usermst_tbl in comma separation
 * @property string $cmsthh_attachlink Additional Documents --> Attachment Link
 * @property string $cmsthh_attachclosedate Additional Documents --> Attachment Closing Date
 * @property int $cmsthh_tenderstatus 1 - Yet to Submit, 2 - Submitted, 3 - Shortlisted, 4 - Rejected, 5 - Awarded, 6 - Terminated, 7 - Closed, 8 - Yet to Award, 9 - Yet to Shortlist, 10 - Shortlisting in Progress
 * @property string $cmsthh_tendercomments Comments to be collected when there is a change in tender status
 * @property int $cmsthh_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $cmsthh_createdon Date of creation
 * @property int $cmsthh_createdby Reference to usermst_tbl
 * @property string $cmsthh_createdbyipaddr User IP Address
 * @property string $cmsthh_updatedon Date of update
 * @property int $cmsthh_updatedby Reference to usermst_tbl
 * @property string $cmsthh_updatedbyipaddr User IP Address
 * @property string $cmsthh_terminatedon Date of Termination
 * @property int $cmsthh_terminatedby Reference to usermst_tbl
 * @property string $cmsthh_terminatedbyipaddr User IP Address
 * @property string $cmsthh_latesttime On insert,update latest date & time will be captured
 *
 * @property CmsaddinfodtlshstyTbl[] $cmsaddinfodtlshstyTbls
 * @property CmsquestionnaireformhstyTbl $cmsthhCmsquestionnaireformhstyFk
 * @property CmsrequisitionformdtlsTbl $cmsthhCmsrequisitionformdtlsFk
 * @property CmstenderhdrTbl $cmsthhCmstenderhdrFk
 * @property UsermstTbl $cmsthhCreatedby
 * @property CurrencymstTbl $cmsthhCurrencymstFk
 * @property UsermstTbl $cmsthhInitiatedby
 * @property TimezoneTbl $cmsthhSkdTimezoneFk
 * @property UsermstTbl $cmsthhUpdatedby
 * @property CmstendertargethdrhstyTbl[] $cmstendertargethdrhstyTbls
 */
class CmstenderhdrhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstenderhdrhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsthh_memcompmst_fk', 'cmsthh_cmsrequisitionformdtls_fk', 'cmsthh_contracthdr_fk', 'cmsthh_type', 'cmsthh_cmstenderhdr_fk', 'cmsthh_initiatedby', 'cmsthh_cmsdisciplinedtls_fk', 'cmsthh_joblocation', 'cmsthh_currencymst_fk', 'cmsthh_cmsquestionnaireformhsty_fk', 'cmsthh_skdtype', 'cmsthh_skd_timezone_fk', 'cmsthh_setreminder', 'cmsthh_closeintvltype', 'cmsthh_openintvltype', 'cmsthh_tgtmailstatus', 'cmsthh_issubcontrqmt', 'cmsthh_obligation', 'cmsthh_isicv', 'cmsthh_icv_startquarter', 'cmsthh_icv_endquarter', 'cmsthh_isetendmandate', 'cmsthh_approvauth', 'cmsthh_invoiceintervaltype', 'cmsthh_tenderstatus', 'cmsthh_isdeleted', 'cmsthh_createdby', 'cmsthh_updatedby', 'cmsthh_terminatedby'], 'integer'],
            [['cmsthh_cmsrequisitionformdtls_fk', 'cmsthh_type', 'cmsthh_title', 'cmsthh_uid', 'cmsthh_refno', 'cmsthh_initiatedby', 'cmsthh_initiateddate'], 'required'],
            [['cmsthh_initiateddate', 'cmsthh_csstartdate', 'cmsthh_csenddate', 'cmsthh_reqdate', 'cmsthh_skdstartdate', 'cmsthh_skdclosedate', 'cmsthh_tgtcriteriabag', 'cmsthh_icv_startyear', 'cmsthh_icv_endyear', 'cmsthh_attachclosedate', 'cmsthh_createdon', 'cmsthh_updatedon', 'cmsthh_terminatedon', 'cmsthh_latesttime'], 'safe'],
            [['cmsthh_shortdesc', 'cmsthh_statement', 'cmsthh_instruction', 'cmsthh_mineligibility', 'cmsthh_scopeofwork', 'cmsthh_specdrawing', 'cmsthh_milestone', 'cmsthh_reqincoterms', 'cmsthh_portname', 'cmsthh_remarks', 'cmsthh_config_usermst_fk', 'cmsthh_tgtcriteria', 'cmsthh_obligationscope', 'cmsthh_contact_usermst_fk', 'cmsthh_attachlink', 'cmsthh_tendercomments'], 'string'],
            [['cmsthh_closeintvl', 'cmsthh_openintvl', 'cmsthh_tgtmailcount', 'cmsthh_msmepercent', 'cmsthh_lccpercent', 'cmsthh_invoiceinterval'], 'number'],
            [['cmsthh_title'], 'string', 'max' => 255],
            [['cmsthh_uid', 'cmsthh_refno'], 'string', 'max' => 20],
            [['cmsthh_createdbyipaddr', 'cmsthh_updatedbyipaddr', 'cmsthh_terminatedbyipaddr'], 'string', 'max' => 50],
            [['cmsthh_uid'], 'unique'],
            [['cmsthh_cmsquestionnaireformhsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsquestionnaireformhstyTbl::className(), 'targetAttribute' => ['cmsthh_cmsquestionnaireformhsty_fk' => 'cmsquestionnaireformhsty_pk']],
            [['cmsthh_cmsrequisitionformdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrequisitionformdtlsTbl::className(), 'targetAttribute' => ['cmsthh_cmsrequisitionformdtls_fk' => 'cmsrequisitionformdtls_pk']],
            [['cmsthh_cmstenderhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrTbl::className(), 'targetAttribute' => ['cmsthh_cmstenderhdr_fk' => 'cmstenderhdr_pk']],
            [['cmsthh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsthh_createdby' => 'UserMst_Pk']],
            [['cmsthh_currencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['cmsthh_currencymst_fk' => 'CurrencyMst_Pk']],
            [['cmsthh_initiatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsthh_initiatedby' => 'UserMst_Pk']],
            [['cmsthh_skd_timezone_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TimezoneTbl::className(), 'targetAttribute' => ['cmsthh_skd_timezone_fk' => 'timezone_pk']],
            [['cmsthh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsthh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstenderhdrhsty_pk' => 'Cmstenderhdrhsty Pk',
            'cmsthh_memcompmst_fk' => 'Cmsthh Memcompmst Fk',
            'cmsthh_cmsrequisitionformdtls_fk' => 'Cmsthh Cmsrequisitionformdtls Fk',
            'cmsthh_contracthdr_fk' => 'Cmsthh Contracthdr Fk',
            'cmsthh_type' => 'Cmsthh Type',
            'cmsthh_cmstenderhdr_fk' => 'Cmsthh Cmstenderhdr Fk',
            'cmsthh_title' => 'Cmsthh Title',
            'cmsthh_uid' => 'Cmsthh Uid',
            'cmsthh_refno' => 'Cmsthh Refno',
            'cmsthh_initiatedby' => 'Cmsthh Initiatedby',
            'cmsthh_initiateddate' => 'Cmsthh Initiateddate',
            'cmsthh_cmsdisciplinedtls_fk' => 'Cmsthh Cmsdisciplinedtls Fk',
            'cmsthh_shortdesc' => 'Cmsthh Shortdesc',
            'cmsthh_csstartdate' => 'Cmsthh Csstartdate',
            'cmsthh_csenddate' => 'Cmsthh Csenddate',
            'cmsthh_statement' => 'Cmsthh Statement',
            'cmsthh_instruction' => 'Cmsthh Instruction',
            'cmsthh_mineligibility' => 'Cmsthh Mineligibility',
            'cmsthh_scopeofwork' => 'Cmsthh Scopeofwork',
            'cmsthh_specdrawing' => 'Cmsthh Specdrawing',
            'cmsthh_milestone' => 'Cmsthh Milestone',
            'cmsthh_reqdate' => 'Cmsthh Reqdate',
            'cmsthh_reqincoterms' => 'Cmsthh Reqincoterms',
            'cmsthh_portname' => 'Cmsthh Portname',
            'cmsthh_joblocation' => 'Cmsthh Joblocation',
            'cmsthh_currencymst_fk' => 'Cmsthh Currencymst Fk',
            'cmsthh_cmsquestionnaireformhsty_fk' => 'Cmsthh Cmsquestionnaireformhsty Fk',
            'cmsthh_remarks' => 'Cmsthh Remarks',
            'cmsthh_skdtype' => 'Cmsthh Skdtype',
            'cmsthh_skdstartdate' => 'Cmsthh Skdstartdate',
            'cmsthh_skd_timezone_fk' => 'Cmsthh Skd Timezone Fk',
            'cmsthh_skdclosedate' => 'Cmsthh Skdclosedate',
            'cmsthh_setreminder' => 'Cmsthh Setreminder',
            'cmsthh_closeintvl' => 'Cmsthh Closeintvl',
            'cmsthh_closeintvltype' => 'Cmsthh Closeintvltype',
            'cmsthh_openintvl' => 'Cmsthh Openintvl',
            'cmsthh_openintvltype' => 'Cmsthh Openintvltype',
            'cmsthh_config_usermst_fk' => 'Cmsthh Config Usermst Fk',
            'cmsthh_tgtcriteria' => 'Cmsthh Tgtcriteria',
            'cmsthh_tgtcriteriabag' => 'Cmsthh Tgtcriteriabag',
            'cmsthh_tgtmailstatus' => 'Cmsthh Tgtmailstatus',
            'cmsthh_tgtmailcount' => 'Cmsthh Tgtmailcount',
            'cmsthh_issubcontrqmt' => 'Cmsthh Issubcontrqmt',
            'cmsthh_obligation' => 'Cmsthh Obligation',
            'cmsthh_msmepercent' => 'Cmsthh Msmepercent',
            'cmsthh_lccpercent' => 'Cmsthh Lccpercent',
            'cmsthh_obligationscope' => 'Cmsthh Obligationscope',
            'cmsthh_isicv' => 'Cmsthh Isicv',
            'cmsthh_icv_startyear' => 'Cmsthh Icv Startyear',
            'cmsthh_icv_startquarter' => 'Cmsthh Icv Startquarter',
            'cmsthh_icv_endyear' => 'Cmsthh Icv Endyear',
            'cmsthh_icv_endquarter' => 'Cmsthh Icv Endquarter',
            'cmsthh_isetendmandate' => 'Cmsthh Isetendmandate',
            'cmsthh_approvauth' => 'Cmsthh Approvauth',
            'cmsthh_invoiceinterval' => 'Cmsthh Invoiceinterval',
            'cmsthh_invoiceintervaltype' => 'Cmsthh Invoiceintervaltype',
            'cmsthh_contact_usermst_fk' => 'Cmsthh Contact Usermst Fk',
            'cmsthh_attachlink' => 'Cmsthh Attachlink',
            'cmsthh_attachclosedate' => 'Cmsthh Attachclosedate',
            'cmsthh_tenderstatus' => 'Cmsthh Tenderstatus',
            'cmsthh_tendercomments' => 'Cmsthh Tendercomments',
            'cmsthh_isdeleted' => 'Cmsthh Isdeleted',
            'cmsthh_createdon' => 'Cmsthh Createdon',
            'cmsthh_createdby' => 'Cmsthh Createdby',
            'cmsthh_createdbyipaddr' => 'Cmsthh Createdbyipaddr',
            'cmsthh_updatedon' => 'Cmsthh Updatedon',
            'cmsthh_updatedby' => 'Cmsthh Updatedby',
            'cmsthh_updatedbyipaddr' => 'Cmsthh Updatedbyipaddr',
            'cmsthh_terminatedon' => 'Cmsthh Terminatedon',
            'cmsthh_terminatedby' => 'Cmsthh Terminatedby',
            'cmsthh_terminatedbyipaddr' => 'Cmsthh Terminatedbyipaddr',
            'cmsthh_latesttime' => 'Cmsthh Latesttime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsaddinfodtlshstyTbls()
    {
        return $this->hasMany(CmsaddinfodtlshstyTbl::className(), ['caidh_cmstenderhdrhsty_fk' => 'cmstenderhdrhsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthhCmsquestionnaireformhstyFk()
    {
        return $this->hasOne(CmsquestionnaireformhstyTbl::className(), ['cmsquestionnaireformhsty_pk' => 'cmsthh_cmsquestionnaireformhsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthhCmsrequisitionformdtlsFk()
    {
        return $this->hasOne(CmsrequisitionformdtlsTbl::className(), ['cmsrequisitionformdtls_pk' => 'cmsthh_cmsrequisitionformdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthhCmstenderhdrFk()
    {
        return $this->hasOne(CmstenderhdrTbl::className(), ['cmstenderhdr_pk' => 'cmsthh_cmstenderhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsthh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthhCurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'cmsthh_currencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthhInitiatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsthh_initiatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthhSkdTimezoneFk()
    {
        return $this->hasOne(TimezoneTbl::className(), ['timezone_pk' => 'cmsthh_skd_timezone_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsthhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsthh_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstendertargethdrhstyTbls()
    {
        return $this->hasMany(CmstendertargethdrhstyTbl::className(), ['cmstthh_cmstenderhdrhsty_fk' => 'cmstenderhdrhsty_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmstenderhdrhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmstenderhdrhstyTblQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalandSupportDocuments()
    {
        return $this->hasMany(CmssupdocumenthstyTbl::className(), ['cmssd_shared_fk' => 'cmstenderhdr_pk'])->where(['cmssd_type' => [3,6]]);
    }
}
