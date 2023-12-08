<?php

namespace api\modules\mst\models;

use \common\models\MemcompcontactdtlsTbl;
use \common\models\MemcomplcccerthdrTbl;
use \common\models\CertmaphdrTbl;
use api\modules\pd\models\MemcompmplocationdtlsTbl;
use \common\models\MemcompproddtlsTbl;
use \common\models\MemcompservicedtlsTbl;
use api\modules\drv\models\MemcompfiledtlsTbl;
use Yii;

/**
 * This is the model class for table "membercompanymst_tbl".
 *
 * @property int $MemberCompMst_Pk
 * @property int $MCM_MemberRegMst_Fk
 * @property string $MCM_CompanyName
 * @property string $mcm_referenceno Randomly Auto generated value
 * @property string $MCM_crnumber
 * @property string $MCM_RegistrationYear
 * @property string $MCM_RegistrationExpiry
 * @property string $MCM_CoC_CtftNo
 * @property string $mcm_cocissuedt COC Issued date
 * @property string $MCM_CoC_CtftExpiry
 * @property string $mcm_cocctftfiledtls_fk COC Certificate. Reference to memcompfiledtls_tbl
 * @property string $MCM_CompLogoFilePath
 * @property int $mcm_complogo_memcompfiledtlsfk
 * @property string $MCM_OfficialAdd
 * @property string $MCM_OfficialAdd2
 * @property string $MCM_OfficialAdd3
 * @property string $MCM_PostalAdd
 * @property string $MCM_PostalAdd2
 * @property string $MCM_PostalAdd3
 * @property string $MCM_PostalAddStatus
 * @property string $MCM_Origin
 * @property int $MCM_Source_CountryMst_Fk
 * @property int $MCM_CountryMst_Fk
 * @property int $MCM_StateMst_Fk
 * @property int $MCM_CityMst_Fk
 * @property string $MCM_Pincode
 * @property string $mcm_officaltelephone Offical Telephone Number
 * @property string $mcm_officalfax Offical Fax  
 * @property int $MCM_PostalCountryMst_Fk
 * @property int $MCM_PostalStateMst_Fk
 * @property int $MCM_PostalCityMst_Fk
 * @property string $MCM_PostalPincode
 * @property string $mcm_postaltelephone
 * @property string $mcm_postalfax
 * @property string $MCM_PriMobCC
 * @property string $MCM_MobileNo
 * @property string $MCM_AltMobCC
 * @property string $MCM_MobileNo2
 * @property string $MCM_PriPhoneCC
 * @property string $MCM_PhoneNo
 * @property string $MCM_PriPhoneExt1
 * @property string $MCM_AltPhoneCC
 * @property string $MCM_PhoneNo2
 * @property string $MCM_AltPhoneExt1
 * @property string $MCM_FaxNo
 * @property string $MCM_FaxCC
 * @property string $MCM_website
 * @property array $mcm_socialmedia To save the Social Media information in JSON format as {"FB":"www.facebook.com/test"}
 * @property string $MCM_LocMapFilePath
 * @property string $MCM_EmailID
 * @property int $MCM_DomainMst_Fk
 * @property string $MCM_BannerImageFilePath
 * @property string $MCM_BannerImageStatus
 * @property string $MCM_HomeImageFilePath
 * @property string $MCM_HomeImageStatus 'D' - Default, 'U' - Upload
 * @property string $MCM_ThemeImageFilePath
 * @property string $MCM_OriginAppNo
 * @property string $MCM_SupplierCode

 * @property string $mcm_privacypermissions
 * @property int $mcm_classificationmst_fk Reference to classificationmst_tbl
 * @property int $mcm_paidupcurrencymst_fk Reference to currencymst_tbl
 * @property string $mcm_paidupcapital Paid up capital
 * @property string $mcm_crregnofiledtls_fk Commercial Registration No, Reference to memcompfiledtls_tbl
 * @property string $mcm_crissuedt CR issue date
 * @property string $mcm_crexpirydt CR expiry date
 * @property string $mcm_municipfiledtls_fk Municipality No. Reference to memcompfiledtls_tbl
 * @property string $mcm_municipcertissuedt Municipality Certificate date of issue
 * @property string $mcm_municipcertexpdt Municipality Certificate date of expiry
 * @property string $mcm_municiplicnumber Municipality license number
 * @property string $mcm_aboutus About us
 * @property string $mcm_vision Vision
 * @property string $mcm_mission Mission
 * @property array $mcm_otherdocs Other document information such as Issued by, Issued on & Expires on to be captured
 * @property string $mcm_internalrecno
 * @property string $mcm_externalproflink External profile link
 * @property int $mcm_stakeholderstatus 1 - Guest,2 - Explorer,3 - Family,4 - Champion
 * @property string $mcm_explorercreatedon Date on which the investor was explorer
 * @property string $mcm_championcreatedon Date on which the investor was champion
 * @property string $mcm_familycreatedon Date on which the investor was Family
 * @property string $mcm_follow_usermst_fk
 * @property string $mcm_vatinno VATIN Number 

 *
 * @property BoardmemberdtlsTbl[] $boardofdirectorsTbls
 * @property MembcompauditordtlsTbl[] $membcompauditordtlsTbls
 * @property CountrymstTbl $mCMCountryMstFk
 * @property MemberregistrationmstTbl $mCMMemberRegMstFk
 * @property CurrencymstTbl $mcmPaidupcurrencymstFk
 * @property CountrymstTbl $mCMSourceCountryMstFk
 * @property MemcompacomplishdtlsTbl[] $memcompacomplishdtlsTbls
 * @property MemcompbankerdetailsTbl[] $memcompbankerdetailsTbls
 * @property MemcompbussrcdtlsTbl[] $memcompbussrcdtlsTbls
 * @property MemcompcontactdtlsTbl[] $memcompcontactdtlsTbls
 * @property MemcompfiledtlsTbl[] $memcompfiledtlsTbls
 * @property MemcompgendtlsTbl[] $memcompgendtlsTbls
 * @property MemcompmplocationdtlsTbl[] $memcompmplocationdtlsTbls
 * @property MemcompprdserfollowdtlsTbl[] $memcompprdserfollowdtlsTbls
 * @property MemcompproddtlsTbl[] $memcompproddtlsTbls
 * @property MemcompprofachvdtlsTbl[] $memcompprofachvdtlsTbls
 * @property MemcompprofcertfdtlsTbl[] $memcompprofcertfdtlsTbls
 * @property MemcompsectordtlsTbl[] $memcompsectordtlsTbls
 * @property MemcompservicedtlsTbl[] $memcompservicedtlsTbls
 * @property SuppcertformmembdtlsTbl[] $suppcertformmembdtlsTbls
 * @property SuppcertformmembtmpTbl[] $suppcertformmembtmpTbls
 * @property SuppcertformpartrnTbl[] $suppcertformpartrnTbls
 * @property SuppcertformpartrnhstyTbl[] $suppcertformpartrnhstyTbls
 * @property SuppcertformpartrntmpTbl[] $suppcertformpartrntmpTbls
 * @property SuppcertmandatorydtlsTbl[] $suppcertmandatorydtlsTbls
 * @property SupportcollateraldtlsTbl[] $supportcollateraldtlsTbls
 * @property WorkflowmgmtTbl[] $workflowmgmtTbls
 */
class MembercompanymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'membercompanymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MCM_MemberRegMst_Fk', 'MCM_DomainMst_Fk', 'mcm_memcompbranchdtlstemp_fk', 'mcm_complogo_memcompfiledtlsfk', 'MCM_Source_CountryMst_Fk', 'MCM_CountryMst_Fk', 'mcm_classificationmst_fk', 'mcm_stakeholderstatus', 'mcm_groupcmpstatus', 'mcm_howdoyouknowmst_fk'], 'integer'],
            [['MCM_RegistrationYear', 'MCM_RegistrationExpiry', 'mcm_socialmedia', 'mcm_otherdocs', 'mcm_explorercreatedon', 'mcm_championcreatedon', 'mcm_familycreatedon', 'mcm_accexpirydate'], 'safe'],
            [['mcm_memcompbranchdtlstemp_fk'], 'required'],
            [['MCM_Origin', 'mcm_aboutus', 'mcm_vision', 'mcm_mission', 'mcm_externalproflink', 'mcm_externalprofbanner', 'mcm_visitorloungebanner', 'mcm_follow_usermst_fk', 'mcm_howdoothers', 'mcm_wikilink', 'mcm_facebook', 'mcm_instagram', 'mcm_twitter', 'mcm_linkedin'], 'string'],
            [['mcm_supplierrating'], 'number'],
            [['MCM_CompanyName', 'MCM_CompanyName_ar', 'mcm_brandname', 'MCM_crnumber', 'mcm_groupcmpname', 'mcm_incorpstyleother'], 'string', 'max' => 250],
            [['mcm_RegistrationNo'], 'string', 'max' => 20],
            [['MCM_website'], 'string', 'max' => 255],
            [['mcm_compmailaddr', 'mcm_vatinno'], 'string', 'max' => 45],
            [['mcm_groupcmpcode'], 'string', 'max' => 50],
            [['MCM_SupplierCode'], 'string', 'max' => 100],
            [['MCM_CountryMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => CountrymstTbl::className(), 'targetAttribute' => ['MCM_CountryMst_Fk' => 'CountryMst_Pk']],
            [['MCM_MemberRegMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['MCM_MemberRegMst_Fk' => 'MemberRegMst_Pk']],
            [['MCM_Source_CountryMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => CountrymstTbl::className(), 'targetAttribute' => ['MCM_Source_CountryMst_Fk' => 'CountryMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MemberCompMst_Pk' => 'Member Comp Mst  Pk',
            'MCM_MemberRegMst_Fk' => 'Mcm  Member Reg Mst  Fk',
            'MCM_CompanyName' => 'Mcm  Company Name',
            'mcm_referenceno' => 'Mcm Referenceno',
            'MCM_crnumber' => 'Mcm  Registration No',
            'MCM_RegistrationYear' => 'Mcm  Registration Year',
            'MCM_RegistrationExpiry' => 'Mcm  Registration Expiry',
            'MCM_CoC_CtftNo' => 'Mcm  Co C  Ctft No',
            'mcm_cocissuedt' => 'Mcm Cocissuedt',
            'MCM_CoC_CtftExpiry' => 'Mcm  Co C  Ctft Expiry',
            'mcm_cocctftfiledtls_fk' => 'Mcm Cocctftfiledtls Fk',
            'MCM_CompLogoFilePath' => 'Mcm  Comp Logo File Path',
            'mcm_complogo_memcompfiledtlsfk' => 'Mcm Complogo Memcompfiledtlsfk',
            'MCM_OfficialAdd' => 'Mcm  Official Add',
            'MCM_OfficialAdd2' => 'Mcm  Official Add2',
            'MCM_OfficialAdd3' => 'Mcm  Official Add3',
            'MCM_PostalAdd' => 'Mcm  Postal Add',
            'MCM_PostalAdd2' => 'Mcm  Postal Add2',
            'MCM_PostalAdd3' => 'Mcm  Postal Add3',
            'MCM_PostalAddStatus' => 'Mcm  Postal Add Status',
            'MCM_Origin' => 'Mcm  Origin',
            'MCM_Source_CountryMst_Fk' => 'Mcm  Source  Country Mst  Fk',
            'MCM_CountryMst_Fk' => 'Mcm  Country Mst  Fk',
            'MCM_Pincode' => 'Mcm  Pincode',
            'mcm_officaltelephone' => 'Mcm Officaltelephone',
            'mcm_officalfax' => 'Mcm Officalfax',
            'MCM_PostalCountryMst_Fk' => 'Mcm  Postal Country Mst  Fk',
            'MCM_PostalStateMst_Fk' => 'Mcm  Postal State Mst  Fk',
            'MCM_PostalCityMst_Fk' => 'Mcm  Postal City Mst  Fk',
            'MCM_PostalPincode' => 'Mcm  Postal Pincode',
            'mcm_postaltelephone' => 'Mcm Postaltelephone',
            'mcm_postalfax' => 'Mcm Postalfax',
            'MCM_PriMobCC' => 'Mcm  Pri Mob Cc',
            'MCM_MobileNo' => 'Mcm  Mobile No',
            'MCM_AltMobCC' => 'Mcm  Alt Mob Cc',
            'MCM_MobileNo2' => 'Mcm  Mobile No2',
            'MCM_PriPhoneCC' => 'Mcm  Pri Phone Cc',
            'MCM_PhoneNo' => 'Mcm  Phone No',
            'MCM_PriPhoneExt1' => 'Mcm  Pri Phone Ext1',
            'MCM_AltPhoneCC' => 'Mcm  Alt Phone Cc',
            'MCM_PhoneNo2' => 'Mcm  Phone No2',
            'MCM_AltPhoneExt1' => 'Mcm  Alt Phone Ext1',
            'MCM_FaxNo' => 'Mcm  Fax No',
            'MCM_FaxCC' => 'Mcm  Fax Cc',
            'MCM_website' => 'Mcm Website',
            'mcm_socialmedia' => 'Mcm Socialmedia',
            'MCM_LocMapFilePath' => 'Mcm  Loc Map File Path',
            'MCM_EmailID' => 'Mcm  Email ID',
            'MCM_DomainMst_Fk' => 'Mcm  Domain Mst  Fk',
            'MCM_BannerImageFilePath' => 'Mcm  Banner Image File Path',
            'MCM_BannerImageStatus' => 'Mcm  Banner Image Status',
            'MCM_HomeImageFilePath' => 'Mcm  Home Image File Path',
            'MCM_HomeImageStatus' => 'Mcm  Home Image Status',
            'MCM_ThemeImageFilePath' => 'Mcm  Theme Image File Path',
            'MCM_OriginAppNo' => 'Mcm  Origin App No',
            'MCM_SupplierCode' => 'Mcm  Supplier Code',
            'mcm_privacypermissions' => 'Mcm Privacypermissions',
            'mcm_classificationmst_fk' => 'Mcm Classificationmst Fk',
            'mcm_paidupcurrencymst_fk' => 'Mcm Paidupcurrencymst Fk',
            'mcm_paidupcapital' => 'Mcm Paidupcapital',
            'mcm_crregnofiledtls_fk' => 'Mcm Crregnofiledtls Fk',
            'mcm_crissuedt' => 'Mcm Crissuedt',
            'mcm_crexpirydt' => 'Mcm Crexpirydt',
            'mcm_municipfiledtls_fk' => 'Mcm Municipfiledtls Fk',
            'mcm_municipcertissuedt' => 'Mcm Municipcertissuedt',
            'mcm_municipcertexpdt' => 'Mcm Municipcertexpdt',
            'mcm_municiplicnumber' => 'Mcm Municiplicnumber',
            'mcm_aboutus' => 'Mcm Aboutus',
            'mcm_vision' => 'Mcm Vision',
            'mcm_mission' => 'Mcm Mission',
            'mcm_otherdocs' => 'Mcm Otherdocs',
            'mcm_internalrecno' => 'Mcm Internalrecno',
            'mcm_externalproflink' => 'Mcm Externalproflink',
            'mcm_stakeholderstatus' => 'Mcm Stakeholderstatus',
            'mcm_explorercreatedon' => 'Mcm Explorercreatedon',
            'mcm_championcreatedon' => 'Mcm Championcreatedon',
            'mcm_familycreatedon' => 'Mcm Familycreatedon',
            'mcm_follow_usermst_fk' => 'Mcm Follow Usermst Fk',
            'mcm_vatinno' => 'Mcm Vatinno',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoardmemberdtlsTbls()
    {
        return $this->hasMany(\common\models\BoardmemberdtlsTbl::className(), ['bod_memcompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembcompauditordtlsTbls()
    {
        return $this->hasMany(MembcompauditordtlsTbl::className(), ['mcacd_membcompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMCMCountryMstFk()
    {
        return $this->hasOne(CountrymstTbl::className(), ['CountryMst_Pk' => 'MCM_CountryMst_Fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMCMMemberRegMstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'MCM_MemberRegMst_Fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcmPaidupcurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'mcm_paidupcurrencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMCMSourceCountryMstFk()
    {
        return $this->hasOne(CountrymstTbl::className(), ['CountryMst_Pk' => 'MCM_Source_CountryMst_Fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompacomplishdtlsTbls()
    {
        return $this->hasMany(MemcompacomplishdtlsTbl::className(), ['mcad_membercompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompbankerdetailsTbls()
    {
        return $this->hasMany(MemcompbankerdetailsTbl::className(), ['mcbd_memcompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompbussrcdtlsTbls()
    {
        return $this->hasMany(MemcompbussrcdtlsTbl::className(), ['mcbsd_membercompanymst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompcontactdtlsTbls()
    {
        return $this->hasMany(MemcompcontactdtlsTbl::className(), ['MCCD_MemberCompMst_Fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompfiledtlsTbls()
    {
        return $this->hasMany(MemcompfiledtlsTbl::className(), ['mcfd_memcompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogo()
    {
        return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'mcm_complogo_memcompfiledtlsfk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompgendtlsTbls()
    {
        return $this->hasMany(MemcompgendtlsTbl::className(), ['MemberCompMst_Fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompmplocationdtlsTbls()
    {
        return $this->hasMany(MemcompmplocationdtlsTbl::className(), ['mcmpld_membercompmst_fk' => 'MemberCompMst_Pk']);
    }

    public function getMemcompmplocationdtlsTblsPrimary()
    {
        return $this->hasOne(MemcompmplocationdtlsTbl::className(), ['mcmpld_membercompmst_fk' => 'MemberCompMst_Pk'])->andOnCondition(['mcmpld_locationtype' => 1]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompprdserfollowdtlsTbls()
    {
        return $this->hasMany(MemcompprdserfollowdtlsTbl::className(), ['mcpsfd_followmemcompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompproddtlsTbls()
    {
        return $this->hasMany(MemcompproddtlsTbl::className(), ['MCPrD_MemberCompMst_Fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompprofachvdtlsTbls()
    {
        return $this->hasMany(MemcompprofachvdtlsTbl::className(), ['MCPAvD_MemberCompMst_Fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompprofcertfdtlsTbls()
    {
        return $this->hasMany(MemcompprofcertfdtlsTbl::className(), ['MCPCD_MemberCompMst_Fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompsectordtlsTbls()
    {
        return $this->hasMany(MemcompsectordtlsTbl::className(), ['MCSD_MemberCompMst_Fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompservicedtlsTbls()
    {
        return $this->hasMany(MemcompservicedtlsTbl::className(), ['MCSvD_MemberCompMst_Fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppcertformmembdtlsTbls()
    {
        return $this->hasMany(SuppcertformmembdtlsTbl::className(), ['scfmd_membercompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppcertformmembtmpTbls()
    {
        return $this->hasMany(SuppcertformmembtmpTbl::className(), ['scfmt_membercompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppcertformpartrnTbls()
    {
        return $this->hasMany(SuppcertformpartrnTbl::className(), ['scfpt_membercompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppcertformpartrnhstyTbls()
    {
        return $this->hasMany(SuppcertformpartrnhstyTbl::className(), ['scfpth_membercompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppcertformpartrntmpTbls()
    {
        return $this->hasMany(SuppcertformpartrntmpTbl::className(), ['scfptt_membercompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppcertmandatorydtlsTbls()
    {
        return $this->hasMany(SuppcertmandatorydtlsTbl::className(), ['scmd_membercompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportcollateraldtlsTbls()
    {
        return $this->hasMany(SupportcollateraldtlsTbl::className(), ['scd_memcompmst_fk' => 'MemberCompMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkflowmgmtTbls()
    {
        return $this->hasMany(WorkflowmgmtTbl::className(), ['wfm_memcompmst_fk' => 'MemberCompMst_Pk']);
    }
    
    
    public function getMemcomplcccerthdrTblsCCED()
    {
        return $this->hasOne(MemcomplcccerthdrTbl::className(), ['mclch_membercompmst_fk' => 'MemberCompMst_Pk'])->andOnCondition(['mclch_lcctype'=>1,'mclch_status' => 1]);
    }
    
    public function getMemcomplcccerthdrTblsDUQM()
    {
        return $this->hasOne(MemcomplcccerthdrTbl::className(), ['mclch_membercompmst_fk' => 'MemberCompMst_Pk'])->andOnCondition(['mclch_lcctype'=>2,'mclch_status' => 1]);
    }
    
    public function getMemcomplcccerthdrTblsOXY()
    {
        return $this->hasOne(MemcomplcccerthdrTbl::className(), ['mclch_membercompmst_fk' => 'MemberCompMst_Pk'])->andOnCondition(['mclch_lcctype'=>3,'mclch_status' => 1]);
    }
    
    public function getMemcomplcccerthdrTblsPDO()
    {
        return $this->hasOne(MemcomplcccerthdrTbl::className(), ['mclch_membercompmst_fk' => 'MemberCompMst_Pk'])->andOnCondition(['mclch_lcctype'=>4,'mclch_status' => 1]);
    }
    public function getClassification()
    {
        return $this->hasOne(\api\modules\mst\models\ClassificationmstTbl::className(), ['classificationmst_pk' => 'mcm_classificationmst_fk']);
    }
    
     public function getCertmaphdrTblSEZAD()
    {
        return $this->hasOne(CertmaphdrTbl::className(), ['cmph_memcompmst_fk' => 'MemberCompMst_Pk'])->andOnCondition(['cmph_type'=>1,'cmph_status' => 1]);
    }

    /**
     * {@inheritdoc}
     * @return MembercompanymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MembercompanymstTblQuery(get_called_class());
    }
}