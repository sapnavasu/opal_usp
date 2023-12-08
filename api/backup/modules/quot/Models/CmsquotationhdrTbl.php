<?php

namespace api\modules\quot\models;
use common\models\UsermstTbl;
use api\modules\mst\models\CurrencymstTbl;
use common\models\MembercompanymstTbl;
use backend\models\IcvplanbasehdrTbl;
use api\modules\pms\models\CmstenderhdrTbl;
use api\modules\pms\models\CmstenderpsmapTbl;
use api\modules\pms\models\CmstenderpschargesTbl;
use api\modules\pms\models\CmstnctrnxTbl;
use api\modules\pms\models\CmspaymenttermsTbl;
use api\modules\pms\models\CmstenderagreehdrTbl;
use api\modules\pms\models\CmsdeviationhdrTbl;
use api\modules\pms\models\CmsquestionnaireformtrnxTbl;
use api\modules\pms\models\CmssupdocumentTbl;

use Yii;

/**
 * This is the model class for table "cmsquotationhdr_tbl".
 *
 * @property int $cmsquotationhdr_pk Primary key
 * @property int $cmsqh_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmsqh_cmstenderhdr_fk Reference to cmstenderhdr_tbl
 * @property int $cmsqh_type 1 - Quotation (from RFQ), 2 - Offers (from RFT), 3 - Proposal (from RFP)
 * @property string $cmsqh_uid Unique ID Auto generated value
 * @property string $cmsqh_quotationtitle Quotation Title
 * @property string $cmsqh_quotationrefno Quotation Reference No.
 * @property int $cmsqh_initiatedby Reference to usermst_tbl
 * @property string $cmsqh_initiateddate Initiated Date
 * @property string $cmsqh_secondary_memcompmst_fk Secondary Suppliers: Reference to membercompanymst_tbl in comma separation
 * @property string $cmsqh_scopedesc Scope Description
 * @property int $cmsqh_scope_currencymst_fk Reference to currencymst_tbl used in scope
 * @property string $cmsqh_grandtotalamount Grand total amount captured in scope accordian
 * @property string $cmsqh_delivdate Delivery Date
 * @property int $cmsqh_delivterm Delivery Term: 1 - EXW - EX WORKS ( Place Name), 2 - FCA - FREE CARRIER ( Place Name), 3 - FAS - FREE ALONGSIDE SHIP (Port of Shipment) , 4 - FOB - FREE ON BOARD (Port of Shipment), 5 - CFR - COST AND FREIGHT (Port of Destination), 6 - CIF - COST, INSURANCE AND FREIGHT (Port of Destination), 7 - CPT - CARRIAGE PAID TO  ( Place of Destination), 8 - CIP - CARRIAGE AND INSURANCE PAID TO (Place of Destination), 9 - DAF - DELIVERED AT FRONTIER (Place Name), 10 - DES - DELIVERED EX SHIP (Port of Destination), 11 - DAP - Delivered At Place (Place of Destination), 12 - DPU - Delivered At Place Unloaded (Place of Destination, 13 - DDP - DELIVERED Duty PAID ( Place of Destination)
 * @property string $cmsqh_portname Port Name is captured based on cmsqh_delivterm
 * @property string $cmsqh_deviationcomment Deviation Comments
 * @property string $cmsqh_suppdocremark Remarks for supporting document accordion
 * @property string $cmsqh_invoiceinterval Terms & Conditions --> Payment from Invoice Date --> Interval count
 * @property int $cmsqh_invoiceintervaltype Terms & Conditions --> Payment from Invoice Date --> Interval Type: 1 - Days, 2 - Weeks, 3 - Months
 * @property string $cmsqh_bidtncinterval Terms & Conditions -->Bidders Terms & Conditions --> Quotation Validity
 * @property int $cmsqh_bidtncintervaltype Terms & Conditions --> Bidders Terms & Conditions --> Interval Type: 1 - Days, 2 - Weeks, 3 - Months
 * @property string $cmsqh_bidtncdate if bidders T&C 
 * @property string $cmsqh_contact_usermst_fk Contact details: Reference to usermst_tbl in comma separation
 * @property int $cmsqh_status 1 - Draft, 2 - Submitted, 3 - Terminated, 4 - Suspended, 5 - Shortlisted, 6- Rejected,  7 - Awarded
 * @property int $cmsqh_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $cmsqh_createdon Date of creation
 * @property int $cmsqh_createdby Reference to usermst_tbl
 * @property string $cmsqh_createdbyipaddr User IP Address
 * @property string $cmsqh_updatedon Date of update
 * @property int $cmsqh_updatedby Reference to usermst_tbl
 * @property string $cmsqh_updatedbyipaddr User IP Address
 * @property string $cmsqh_latesttime On insert,update latest date & time will be captured
 *
 * @property CmscontracthdrTbl[] $cmscontracthdrTbls
 * @property CmsdeviationhdrTbl[] $cmsdeviationhdrTbls
 * @property CmsquestionnaireformtrnxTbl[] $cmsquestionnaireformtrnxTbls
 * @property CmstenderhdrTbl $cmsqhCmstenderhdrFk
 * @property UsermstTbl $cmsqhCreatedby
 * @property UsermstTbl $cmsqhInitiatedby
 * @property CurrencymstTbl $cmsqhScopeCurrencymstFk
 * @property UsermstTbl $cmsqhUpdatedby
 * @property CmstenderagreehdrTbl[] $cmstenderagreehdrTbls
 * @property IcvplanbasehdrTbl[] $icvplanbasehdrTbls
 */
class CmsquotationhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsquotationhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsqh_memcompmst_fk', 'cmsqh_cmstenderhdr_fk', 'cmsqh_type', 'cmsqh_initiatedby', 'cmsqh_scope_currencymst_fk', 'cmsqh_delivterm', 'cmsqh_invoiceintervaltype', 'cmsqh_bidtncintervaltype', 'cmsqh_status', 'cmsqh_isdeleted', 'cmsqh_createdby', 'cmsqh_updatedby'], 'integer'],
            [['cmsqh_cmstenderhdr_fk', 'cmsqh_type', 'cmsqh_uid', 'cmsqh_quotationtitle', 'cmsqh_quotationrefno'], 'required'],
            [['cmsqh_initiateddate', 'cmsqh_delivdate', 'cmsqh_bidtncdate', 'cmsqh_createdon', 'cmsqh_updatedon', 'cmsqh_latesttime'], 'safe'],
            [['cmsqh_secondary_memcompmst_fk', 'cmsqh_scopedesc', 'cmsqh_portname', 'cmsqh_deviationcomment', 'cmsqh_suppdocremark', 'cmsqh_contact_usermst_fk'], 'string'],
            [['cmsqh_grandtotalamount', 'cmsqh_invoiceinterval', 'cmsqh_bidtncinterval'], 'number'],
            [['cmsqh_uid', 'cmsqh_quotationrefno'], 'string', 'max' => 20],
            [['cmsqh_quotationtitle'], 'string', 'max' => 255],
            [['cmsqh_createdbyipaddr', 'cmsqh_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmsqh_cmstenderhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrTbl::className(), 'targetAttribute' => ['cmsqh_cmstenderhdr_fk' => 'cmstenderhdr_pk']],
            [['cmsqh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqh_createdby' => 'UserMst_Pk']],
            [['cmsqh_initiatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqh_initiatedby' => 'UserMst_Pk']],
            [['cmsqh_scope_currencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['cmsqh_scope_currencymst_fk' => 'CurrencyMst_Pk']],
            [['cmsqh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsquotationhdr_pk' => 'Cmsquotationhdr Pk',
            'cmsqh_memcompmst_fk' => 'Cmsqh Memcompmst Fk',
            'cmsqh_cmstenderhdr_fk' => 'Cmsqh Cmstenderhdr Fk',
            'cmsqh_type' => 'Cmsqh Type',
            'cmsqh_uid' => 'Cmsqh Uid',
            'cmsqh_quotationtitle' => 'Cmsqh Quotationtitle',
            'cmsqh_quotationrefno' => 'Cmsqh Quotationrefno',
            'cmsqh_initiatedby' => 'Cmsqh Initiatedby',
            'cmsqh_initiateddate' => 'Cmsqh Initiateddate',
            'cmsqh_secondary_memcompmst_fk' => 'Cmsqh Secondary Memcompmst Fk',
            'cmsqh_scopedesc' => 'Cmsqh Scopedesc',
            'cmsqh_scope_currencymst_fk' => 'Cmsqh Scope Currencymst Fk',
            'cmsqh_grandtotalamount' => 'Cmsqh Grandtotalamount',
            'cmsqh_delivdate' => 'Cmsqh Delivdate',
            'cmsqh_delivterm' => 'Cmsqh Delivterm',
            'cmsqh_portname' => 'Cmsqh Portname',
            'cmsqh_deviationcomment' => 'Cmsqh Deviationcomment',
            'cmsqh_suppdocremark' => 'Cmsqh Suppdocremark',
            'cmsqh_invoiceinterval' => 'Cmsqh Invoiceinterval',
            'cmsqh_invoiceintervaltype' => 'Cmsqh Invoiceintervaltype',
            'cmsqh_bidtncinterval' => 'Cmsqh Bidtncinterval',
            'cmsqh_bidtncintervaltype' => 'Cmsqh Bidtncintervaltype',
            'cmsqh_bidtncdate' => 'Cmsqh Bidtncdate',
            'cmsqh_contact_usermst_fk' => 'Cmsqh Contact Usermst Fk',
            'cmsqh_status' => 'Cmsqh Status',
            'cmsqh_isdeleted' => 'Cmsqh Isdeleted',
            'cmsqh_createdon' => 'Cmsqh Createdon',
            'cmsqh_createdby' => 'Cmsqh Createdby',
            'cmsqh_createdbyipaddr' => 'Cmsqh Createdbyipaddr',
            'cmsqh_updatedon' => 'Cmsqh Updatedon',
            'cmsqh_updatedby' => 'Cmsqh Updatedby',
            'cmsqh_updatedbyipaddr' => 'Cmsqh Updatedbyipaddr',
            'cmsqh_latesttime' => 'Cmsqh Latesttime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderhdrtbl(){
        return $this->hasOne(CmstenderhdrTbl::class,  ['cmstenderhdr_pk' => 'cmsqh_cmstenderhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencymsttbl(){
        return $this->hasOne(CurrencymstTbl::class,  ['CurrencyMst_Pk' => 'cmsqh_scope_currencymst_fk']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderpsmaptbl(){
        return $this->hasMany(CmstenderpsmapTbl::class,  ['ctpsm_shared_fk' => 'cmsquotationhdr_pk'])->where(['ctpsm_shared_type' => 3]);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcvplanbasehdr(){
        return $this->hasOne(IcvplanbasehdrTbl::class,  ['ipbh_cmsquotationhdr_fk' => 'cmsquotationhdr_pk']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCmstenderpschargestbl(){
        return $this->hasMany(CmstenderpschargesTbl::class,  ['ctpsc_shared_fk' => 'cmsquotationhdr_pk']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCmstnctrnxTbl(){
        return $this->hasMany(CmstnctrnxTbl::class,  ['ctnct_shared_fk' => 'cmsquotationhdr_pk'])->where(['ctnct_type' => 4]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmspaymenttermsTbl(){
        return $this->hasMany(CmspaymenttermsTbl::class,  ['cmspt_shared_fk' => 'cmsquotationhdr_pk'])->where(['cmspt_type' => 3]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportingDocuments()
    {
        return $this->hasMany(CmssupdocumentTbl::className(), ['cmssd_shared_fk' => 'cmsquotationhdr_pk'])->where(['cmssd_type' => 14]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderagreehdrTbl(){
        return $this->hasMany(CmstenderagreehdrTbl::class,  ['ctah_cmsquotationhdr_fk' => 'cmsquotationhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsdeviationhdrTbls()
    {
        return $this->hasMany(CmsdeviationhdrTbl::className(), ['cmsdh_shared_fk' => 'cmsquotationhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsquestionnaireformtrnxTbls()
    {
        return $this->hasMany(CmsquestionnaireformtrnxTbl::className(), ['cmsqft_shared_fk' => 'cmsquotationhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionnaireformtrnxTbl()
    {
        return $this->hasOne(CmsquestionnaireformtrnxTbl::className(), ['cmsqft_shared_fk' => 'cmsquotationhdr_pk'])->where(['cmsqft_shared_type' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cmsqh_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqhInitiatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqh_initiatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcvplanbasehdrTbls()
    {
        return $this->hasMany(IcvplanbasehdrTbl::className(), ['ipbh_cmsquotationhdr_fk' => 'cmsquotationhdr_pk']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqh_updatedby']);
    }
}
