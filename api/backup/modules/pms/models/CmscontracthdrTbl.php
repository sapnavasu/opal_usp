<?php

namespace api\modules\pms\models;

use common\models\UsermstTbl;
use api\modules\mst\models\CurrencymstTbl;
use api\modules\mst\models\TimezoneTbl;
use api\modules\pd\models\MemcompmplocationdtlsTbl;
use api\modules\mst\models\MembercompanymstTbl;
use api\modules\quot\models\CmsquotationhdrTbl;
use api\modules\pms\models\CmsconttypemstTbl;
use common\components\Security;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use Yii;

/**
 * This is the model class for table "cmscontracthdr_tbl".
 *
 * @property int $cmscontracthdr_pk Primary key
 * @property int $cmsch_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmsch_cmsrequisitionformdtls_fk Reference to cmsrequisitionformdtls_tbl
 * @property int $cmsch_type 1 - Contract, 2 - Purchase Order, 3 - Blanket Agreement
 * @property int $cmsch_contracttype Type of Contract or Purchase Order or Agreement: when cmsch_type = 1 [1 - Contract, 2 - Sub Contract], when cmsch_type = 2 [1 - Order, 2 - Sub Order], when cmsch_type = 3 [1 - Agreement, 2 - Sub Agreement]
 * @property int $cmsch_cmscontracthdr_fk Reference to cmscontracthdr_tbl On Sub contract / Sub Order it's parent pk will be stored
 * @property int $cmsch_level Level of the Contract
 * @property int $cmsch_contractsalone 1 - Yes, 2 - No (Applicable only for stkholdertypmst_tbl = 7 (Operator/ Buyer) Allow them to create Contract/ Purchase Order directly without Project or Tender).
 * @property string $cmsch_uid Unique ID Auto generated value
 * @property string $cmsch_contracttitle Contract Title
 * @property string $cmsch_contractrefno Contract Reference No.
 * @property string $cmsch_contractdate Contract Date
 * @property int $cmsch_initiatedby Reference to usermst_tbl
 * @property string $cmsch_initiateddate Initiated Date
 * @property int $cmsch_shared_agreetype Agreement selection: 1 - Online, 2 - Offline
 * @property int $cmsch_shared_agreefk Reference to cmscontracthdr_tbl, cmscontractagreementhdr_tbl
 * @property int $cmsch_cmstenderhdr_fk Reference to cmstenderhdr_tbl
 * @property int $cmsch_cmsquotationhdr_fk Quotation Select: Reference to cmsquotationhdr_tbl
 * @property string $cmsch_contractdesc Contract Description
 * @property string $cmsch_contractvalue Contract Value (Targetted)
 * @property string $cmsch_contractactualvalue Contract actual value/ Already Spend Value(Offline)
 * @property string $cmsch_scopeofwork Scope of Work
 * @property int $cmsch_currencymst_fk Reference to currencymst_tbl used in scope
 * @property string $cmsch_contractstartdate Contract Start Date
 * @property string $cmsch_contractenddate Contract End Date/ Completion Date
 * @property int $cmsconttypemst_fk
 * @property string $cmsch_contractperiod Contract Period
 * @property int $cmsch_consignee_mcmpld_fk Consignee Details( PO) : Reference to memcompmplocationdtls_tbl 
 * @property int $cmsch_notiparty_mcmpld_fk Notifying Party (PO) : Reference to memcompmplocationdtls_tbl 
 * @property string $cmsch_supdocremarks Remarks for supporting document accordion
 * @property string $cmsch_config_usermst_fk Notify Users : Reference to usermst_tbl in comma separation
 * @property int $cmsch_issubcontrqmt Subcontract Requirement 1 - Yes, 2 - No
 * @property int $cmsch_obligation 1 - MSME, 2 - LCC, 3 - MSME & LCC, 4 - Others, 5- Not Applicable
 * @property string $cmsch_msmepercent MSME Obligation Percentage
 * @property string $cmsch_lccpercent LCC Obligation Percentage
 * @property string $cmsch_obligationscope Scope of Obligation
 * @property int $cmsch_isetendmandate eTendering Manadate 1 - Yes, 2 - No
 * @property int $cmsch_isjsrstncaccept Is JSRS Terms and conditions Accepted Default NULL: 1: Yes, 2 - No
 * @property string $cmsch_invoiceinterval Terms & Conditions --> Payment from Invoice Date --> Interval count
 * @property int $cmsch_invoiceintervaltype Terms & Conditions --> Payment from Invoice Date --> Interval Type: 1 - Days, 2 - Weeks, 3 - Months
 * @property string $cmsch_icvcommitmentvalue ICV Commitment Value
 * @property string $cmsch_icvpercent ICV Percentage
 * @property string $cmsch_icvfileupload ICV file upload: Reference to memcompfiledtls_tbl in comma separation
 * @property string $cmsch_contact_usermst_fk Reference to usermst_tbl in comma separation
 * @property int $cmsch_skdtype 1 - Schedule Now, 2 - Schedule Later
 * @property string $cmsch_skdsubmiton Schedule later: Submit Date and time
 * @property int $cmsch_skd_timezone_fk Reference to timezone_tbl
 * @property int $cmsch_contractstatus 1 - Active, 2 - Inactive, 3 - Terminated, 4 - Suspended, 5 - Ongoing, 6 - Floated, 7 - Completed, 8 - Closed
 * @property string $cmsch_contractcomments Comments to be collected when there is a change in Contract status
 * @property int $cmsch_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $cmsch_createdon Date of creation
 * @property int $cmsch_createdby Reference to usermst_tbl
 * @property string $cmsch_createdbyipaddr User IP Address
 * @property string $cmsch_updatedon Date of update
 * @property int $cmsch_updatedby Reference to usermst_tbl
 * @property string $cmsch_updatedbyipaddr User IP Address
 * @property string $cmsch_latesttime On insert,update latest date & time will be captured
 *
 * @property CmsawarddtlsTbl[] $cmsawarddtlsTbls
 * @property CmscontracthdrTbl $cmschCmscontracthdrFk
 * @property CmscontracthdrTbl[] $cmscontracthdrTbls
 * @property CmsquotationhdrTbl $cmschCmsquotationhdrFk
 * @property CmsrequisitionformdtlsTbl $cmschCmsrequisitionformdtlsFk
 * @property CmstenderhdrTbl $cmschCmstenderhdrFk
 * @property MemcompmplocationdtlsTbl $cmschConsigneeMcmpldFk
 * @property UsermstTbl $cmschCreatedby
 * @property CurrencymstTbl $cmschCurrencymstFk
 * @property UsermstTbl $cmschInitiatedby
 * @property MembercompanymstTbl $cmschMemcompmstFk
 * @property MemcompmplocationdtlsTbl $cmschNotipartyMcmpldFk
 * @property TimezoneTbl $cmschSkdTimezoneFk
 * @property UsermstTbl $cmschUpdatedby
 * @property CmsconttypemstTbl $cmsconttypemstFk
 * @property CmsinvoicerefTbl[] $cmsinvoicerefTbls
 * @property CmsrequisitionformdtlsTbl[] $cmsrequisitionformdtlsTbls
 */
class CmscontracthdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmscontracthdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsch_memcompmst_fk', 'cmsch_cmsrequisitionformdtls_fk', 'cmsch_contracttype', 'cmsch_level', 'cmsch_uid', 'cmsch_contracttitle', 'cmsch_contractrefno', 'cmsch_contractdate'], 'required'],
            [['cmsch_memcompmst_fk', 'cmsch_cmsrequisitionformdtls_fk', 'cmsch_type', 'cmsch_contracttype', 'cmsch_cmscontracthdr_fk', 'cmsch_level', 'cmsch_contractsalone', 'cmsch_initiatedby', 'cmsch_shared_agreetype', 'cmsch_shared_agreefk', 'cmsch_cmstenderhdr_fk', 'cmsch_cmsquotationhdr_fk', 'cmsch_currencymst_fk', 'cmsconttypemst_fk', 'cmsch_consignee_mcmpld_fk', 'cmsch_notiparty_mcmpld_fk', 'cmsch_issubcontrqmt', 'cmsch_obligation', 'cmsch_isetendmandate', 'cmsch_isjsrstncaccept', 'cmsch_invoiceintervaltype', 'cmsch_skdtype', 'cmsch_skd_timezone_fk', 'cmsch_contractstatus', 'cmsch_isdeleted', 'cmsch_createdby', 'cmsch_updatedby'], 'integer'],
            [['cmsch_contractdate', 'cmsch_initiateddate', 'cmsch_contractstartdate', 'cmsch_contractenddate', 'cmsch_skdsubmiton', 'cmsch_createdon', 'cmsch_updatedon', 'cmsch_latesttime'], 'safe'],
            [['cmsch_contractdesc', 'cmsch_scopeofwork', 'cmsch_contractperiod', 'cmsch_supdocremarks', 'cmsch_config_usermst_fk', 'cmsch_obligationscope', 'cmsch_icvfileupload', 'cmsch_contact_usermst_fk', 'cmsch_contractcomments'], 'string'],
            [['cmsch_contractvalue', 'cmsch_contractactualvalue', 'cmsch_msmepercent', 'cmsch_lccpercent', 'cmsch_invoiceinterval', 'cmsch_icvcommitmentvalue', 'cmsch_icvpercent'], 'number'],
            [['cmsch_uid', 'cmsch_contractrefno'], 'string', 'max' => 20],
            [['cmsch_contracttitle'], 'string', 'max' => 255],
            [['cmsch_createdbyipaddr', 'cmsch_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmsch_uid'], 'unique'],
            [['cmsch_cmscontracthdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmscontracthdrTbl::className(), 'targetAttribute' => ['cmsch_cmscontracthdr_fk' => 'cmscontracthdr_pk']],
            [['cmsch_cmsquotationhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsquotationhdrTbl::className(), 'targetAttribute' => ['cmsch_cmsquotationhdr_fk' => 'cmsquotationhdr_pk']],
            [['cmsch_cmsrequisitionformdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrequisitionformdtlsTbl::className(), 'targetAttribute' => ['cmsch_cmsrequisitionformdtls_fk' => 'cmsrequisitionformdtls_pk']],
            [['cmsch_cmstenderhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrTbl::className(), 'targetAttribute' => ['cmsch_cmstenderhdr_fk' => 'cmstenderhdr_pk']],
            [['cmsch_consignee_mcmpld_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompmplocationdtlsTbl::className(), 'targetAttribute' => ['cmsch_consignee_mcmpld_fk' => 'memcompmplocationdtls_pk']],
            [['cmsch_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsch_createdby' => 'UserMst_Pk']],
            [['cmsch_currencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['cmsch_currencymst_fk' => 'CurrencyMst_Pk']],
            [['cmsch_initiatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsch_initiatedby' => 'UserMst_Pk']],
            [['cmsch_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['cmsch_memcompmst_fk' => 'MemberCompMst_Pk']],
            [['cmsch_notiparty_mcmpld_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompmplocationdtlsTbl::className(), 'targetAttribute' => ['cmsch_notiparty_mcmpld_fk' => 'memcompmplocationdtls_pk']],
            [['cmsch_skd_timezone_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TimezoneTbl::className(), 'targetAttribute' => ['cmsch_skd_timezone_fk' => 'timezone_pk']],
            [['cmsch_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsch_updatedby' => 'UserMst_Pk']],
            [['cmsconttypemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsconttypemstTbl::className(), 'targetAttribute' => ['cmsconttypemst_fk' => 'cmsconttypemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmscontracthdr_pk' => 'Cmscontracthdr Pk',
            'cmsch_memcompmst_fk' => 'Cmsch Memcompmst Fk',
            'cmsch_cmsrequisitionformdtls_fk' => 'Cmsch Cmsrequisitionformdtls Fk',
            'cmsch_type' => 'Cmsch Type',
            'cmsch_contracttype' => 'Cmsch Contracttype',
            'cmsch_cmscontracthdr_fk' => 'Cmsch Cmscontracthdr Fk',
            'cmsch_level' => 'Cmsch Level',
            'cmsch_contractsalone' => 'Cmsch Contractsalone',
            'cmsch_uid' => 'Cmsch Uid',
            'cmsch_contracttitle' => 'Cmsch Contracttitle',
            'cmsch_contractrefno' => 'Cmsch Contractrefno',
            'cmsch_contractdate' => 'Cmsch Contractdate',
            'cmsch_initiatedby' => 'Cmsch Initiatedby',
            'cmsch_initiateddate' => 'Cmsch Initiateddate',
            'cmsch_shared_agreetype' => 'Cmsch Shared Agreetype',
            'cmsch_shared_agreefk' => 'Cmsch Shared Agreefk',
            'cmsch_cmstenderhdr_fk' => 'Cmsch Cmstenderhdr Fk',
            'cmsch_cmsquotationhdr_fk' => 'Cmsch Cmsquotationhdr Fk',
            'cmsch_contractdesc' => 'Cmsch Contractdesc',
            'cmsch_contractvalue' => 'Cmsch Contractvalue',
            'cmsch_contractactualvalue' => 'Cmsch Contractactualvalue',
            'cmsch_scopeofwork' => 'Cmsch Scopeofwork',
            'cmsch_currencymst_fk' => 'Cmsch Currencymst Fk',
            'cmsch_contractstartdate' => 'Cmsch Contractstartdate',
            'cmsch_contractenddate' => 'Cmsch Contractenddate',
            'cmsconttypemst_fk' => 'Cmsconttypemst Fk',
            'cmsch_contractperiod' => 'Cmsch Contractperiod',
            'cmsch_consignee_mcmpld_fk' => 'Cmsch Consignee Mcmpld Fk',
            'cmsch_notiparty_mcmpld_fk' => 'Cmsch Notiparty Mcmpld Fk',
            'cmsch_supdocremarks' => 'Cmsch Supdocremarks',
            'cmsch_config_usermst_fk' => 'Cmsch Config Usermst Fk',
            'cmsch_issubcontrqmt' => 'Cmsch Issubcontrqmt',
            'cmsch_obligation' => 'Cmsch Obligation',
            'cmsch_msmepercent' => 'Cmsch Msmepercent',
            'cmsch_lccpercent' => 'Cmsch Lccpercent',
            'cmsch_obligationscope' => 'Cmsch Obligationscope',
            'cmsch_isetendmandate' => 'Cmsch Isetendmandate',
            'cmsch_isjsrstncaccept' => 'Cmsch Isjsrstncaccept',
            'cmsch_invoiceinterval' => 'Cmsch Invoiceinterval',
            'cmsch_invoiceintervaltype' => 'Cmsch Invoiceintervaltype',
            'cmsch_icvcommitmentvalue' => 'Cmsch Icvcommitmentvalue',
            'cmsch_icvpercent' => 'Cmsch Icvpercent',
            'cmsch_icvfileupload' => 'Cmsch Icvfileupload',
            'cmsch_contact_usermst_fk' => 'Cmsch Contact Usermst Fk',
            'cmsch_skdtype' => 'Cmsch Skdtype',
            'cmsch_skdsubmiton' => 'Cmsch Skdsubmiton',
            'cmsch_skd_timezone_fk' => 'Cmsch Skd Timezone Fk',
            'cmsch_contractstatus' => 'Cmsch Contractstatus',
            'cmsch_contractcomments' => 'Cmsch Contractcomments',
            'cmsch_isdeleted' => 'Cmsch Isdeleted',
            'cmsch_createdon' => 'Cmsch Createdon',
            'cmsch_createdby' => 'Cmsch Createdby',
            'cmsch_createdbyipaddr' => 'Cmsch Createdbyipaddr',
            'cmsch_updatedon' => 'Cmsch Updatedon',
            'cmsch_updatedby' => 'Cmsch Updatedby',
            'cmsch_updatedbyipaddr' => 'Cmsch Updatedbyipaddr',
            'cmsch_latesttime' => 'Cmsch Latesttime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsawarddtlsTbls()
    {
        return $this->hasMany(CmsawarddtlsTbl::className(), ['cmsad_cmscontracthdr_fk' => 'cmscontracthdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschCmscontracthdrFk()
    {
        return $this->hasOne(CmscontracthdrTbl::className(), ['cmscontracthdr_pk' => 'cmsch_cmscontracthdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscontracthdrTbls()
    {
        return $this->hasMany(CmscontracthdrTbl::className(), ['cmsch_cmscontracthdr_fk' => 'cmscontracthdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschCmsquotationhdrFk()
    {
        return $this->hasOne(CmsquotationhdrTbl::className(), ['cmsquotationhdr_pk' => 'cmsch_cmsquotationhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschCmsrequisitionformdtlsFk()
    {
        return $this->hasOne(CmsrequisitionformdtlsTbl::className(), ['cmsrequisitionformdtls_pk' => 'cmsch_cmsrequisitionformdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschCmstenderhdrFk()
    {
        return $this->hasOne(CmstenderhdrTbl::className(), ['cmstenderhdr_pk' => 'cmsch_cmstenderhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschConsigneeMcmpldFk()
    {
        return $this->hasOne(MemcompmplocationdtlsTbl::className(), ['memcompmplocationdtls_pk' => 'cmsch_consignee_mcmpld_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsch_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschCurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'cmsch_currencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschInitiatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsch_initiatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cmsch_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschNotipartyMcmpldFk()
    {
        return $this->hasOne(MemcompmplocationdtlsTbl::className(), ['memcompmplocationdtls_pk' => 'cmsch_notiparty_mcmpld_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschSkdTimezoneFk()
    {
        return $this->hasOne(TimezoneTbl::className(), ['timezone_pk' => 'cmsch_skd_timezone_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmschUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsch_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsrequisitionformdtlsTbls()
    {
        return $this->hasMany(CmsrequisitionformdtlsTbl::className(), ['crfd_cmscontracthdr_fk' => 'cmscontracthdr_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmscontracthdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmscontracthdrTblQuery(get_called_class());
    }

    public static function getContractReceivedBy() {
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $CmscontracthdrTbl = CmscontracthdrTbl::find()
                ->select([
                    'MemberCompMst_Pk as filterPk',
                    'MCM_CompanyName as filterName'
                ])
                ->innerJoin('cmsawarddtls_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->innerJoin('usermst_tbl', 'UserMst_Pk = cmsch_createdby')
                ->innerJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                ->where([
                    'cmsad_memcompmst_fk' => $cmpPK
                ])
                ->groupBy('MemberCompMst_Pk')
                ->asArray()
                ->all();
        return $CmscontracthdrTbl;
}

    public static function contractCreatedAwardedTo() {
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $CmscontracthdrTbl = CmscontracthdrTbl::find()
                ->select([
                    'MemberCompMst_Pk as filterPk',
                    'MCM_CompanyName as filterName'
                ])
                ->innerJoin('cmsawarddtls_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->innerJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsad_memcompmst_fk')
                ->where([
                    'cmsch_memcompmst_fk' => $cmpPK
                ])
                ->groupBy('MemberCompMst_Pk')
                ->asArray()
                ->all();
        return $CmscontracthdrTbl;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsawarddtlsTo()
    {
        return $this->hasOne(CmsawarddtlsTbl::className(), ['cmsad_cmscontracthdr_fk' => 'cmscontracthdr_pk']);
    }

    public function getSubcontracts(){
        return $this->hasMany(self::className(), ['cmsch_cmscontracthdr_fk' => 'cmscontracthdr_pk']);
    }

    public function validateCategory($contractPk,$data=FALSE,$import=null){
        $groupCategory=[];
        $savecategory=FALSE;
        if($data){
            if($import){
            $grpCategory=$data['mainCategory'];
            $mainCategory=$data['category'];
            $subCategory=$data['subCategory'];
            }else{
               $grpCategory=$data['mainCategory'][0];
                $mainCategory=$data['category'][0];
                $subCategory=$data['subCategory'][0];  
            }
        }else{
            $grpCategory=$_REQUEST['mainCategory'];
            $mainCategory=$_REQUEST['category'];
            $subCategory=$_REQUEST['subCategory'];    
        }
//        echo "<pre>";
//        print_r($grpCategory);
//        print_r($mainCategory);
////        print_r($subCategory);
//        exit;
     if(!empty($import))
     {
        
        if(is_array($grpCategory) && count($grpCategory) > 0){
            
//            echo "<pre>";
//            print_r($grpCategory);
//            exit;
            foreach($grpCategory as $keys => $grpCat){
                if(is_array($grpCat))
                {
                    foreach ($grpCat as $value) {
                         $groupCategory[$value] = [];
                    }
                }else{
                     $groupCategory[$grpCat] = [];
                }
               
                
            }
        }
        if(is_array($mainCategory) && count($mainCategory)>0){
            foreach($mainCategory as $category){
                if(is_array($category))
                {
                    foreach ($category as $value) {
                        $catExplode=explode('-',$value);
                        $groupCategory[$catExplode[0]][$catExplode[1]]=[];
                    }
                
                }else{
                 $catExplode=explode('-',$category);
                $groupCategory[$catExplode[0]][$catExplode[1]]=[];
                }
            }
        }
        if(is_array($subCategory) && count($subCategory)>0){
            foreach($subCategory as $scategory){
                
                if(is_array($scategory))
                {
                    foreach ($scategory as $value) {
                        $scatExplode=explode('-',$value);
                        $groupCategory[$scatExplode[0]][$scatExplode[1]][$scatExplode[2]]=true;
                    }
                }else{
                     $scatExplode=explode('-',$scategory);
                     $groupCategory[$scatExplode[0]][$scatExplode[1]][$scatExplode[2]]=true;
                }
            }
        }
      
     }else{
         
          if(is_array($mainCategory) && count($mainCategory)>0){
            foreach($mainCategory as $category){
                $catExplode=explode('-',$category);
                $groupCategory[$catExplode[0]][$catExplode[1]]=[];
            }
        }
//        echo "<pre>";
//        print_r($grpCategory);
//        exit;
        if(is_array($grpCategory) && count($grpCategory) > 0){
            
            foreach($grpCategory as $grpCat){
                $groupCategory[$grpCat] = [];
                
            }
        }
        
        if(is_array($mainCategory) && count($mainCategory)>0){
            foreach($mainCategory as $category){
                $catExplode=explode('-',$category);
                $groupCategory[$catExplode[0]][$catExplode[1]]=[];
            }
        }
        if(is_array($subCategory) && count($subCategory)>0){
            foreach($subCategory as $scategory){
                $scatExplode=explode('-',$scategory);
                $groupCategory[$scatExplode[0]][$scatExplode[1]][$scatExplode[2]]=true;
            }
        }
         
     }

           if(is_array($groupCategory) && count($groupCategory)>0){
            foreach($groupCategory as $gCategory=>$mainCategory){
             if(is_array($mainCategory) && count($mainCategory)>0){
       
                        /*$groupCat=new EpcgrpcategorydtlsTbl();
                        $groupCat->egcd_epccontdtls_fk=$contractPk;
                        $groupCat->egcd_epccontractgrpcatmst_fk=$gCategory;
                        $groupCat->egcd_epcmaincatstatus='S';
                        if($groupCat->validate())
                        {
                            $savecategory=TRUE;
                        }*/
                        if(($contractPk!=''&&is_numeric($contractPk)) && ($gCategory!=''&&is_numeric($gCategory))){
                            $savecategory=TRUE;
                        }
            
             }else{
                        /*$groupCat=new EpcgrpcategorydtlsTbl();
                        $groupCat->egcd_epccontdtls_fk=$contractPk;
                        $groupCat->egcd_epccontractgrpcatmst_fk=$gCategory;
                        $groupCat->egcd_epcmaincatstatus='A';
                        if($groupCat->validate())
                        {
                            $savecategory=TRUE;
                        }*/
                        if(($contractPk!=''&&is_numeric($contractPk)) && ($gCategory!=''&&is_numeric($gCategory))){
                            $savecategory=TRUE;
                        }
             }
        } 
        }
        return $savecategory;  
    }
    
}
