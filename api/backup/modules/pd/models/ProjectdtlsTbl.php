<?php

namespace api\modules\pd\models;
use api\modules\mst\models\CitymstTbl;
use api\modules\mst\models\IndustrymstTbl;
use api\modules\mst\models\SectormstTbl;
use api\modules\mst\models\StatemstTbl;
use common\models\MemberregistrationmstTbl;
use common\models\UsermstTbl;
use Yii;
use common\components\Common;
use common\components\Security;

/**
 * This is the model class for table "projectdtls_tbl".
 *
 * @property int $projectdtls_pk Primary key
 * @property int $prjd_projecttmp_fk Reference to projecttmp_tbl
 * @property int $prjd_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property int $prjd_domain Projects created from 1 - Investment, 2 - Procurement
 * @property string $prjd_projectid Project id for internal reference
 * @property string $prjd_referenceno Project Reference No
 * @property string $prjd_projname Project Name
 * @property string $prjd_shortsummary Short summary about the Project
 * @property string $prjd_projdesc Project Description
 * @property int $prjd_classification Classification: 1 - MSME-Micro, 2 - MSME-Small, 3 - MSME-Medium, 4 - Large, 5 - Very Large
 * @property int $prjd_sectormst_fk Reference to sectormst_tbl
 * @property int $prjd_industrymst_fk Reference to industrymst_tbl
 * @property int $prjd_blockmst_fk
 * @property int $prjd_isproposal 1- Yes. To tag if the project is converted from proposal
 * @property int $prjd_projtype Reference to projtypemst_tbl
 * @property string $prjd_otherprojtype If Project type is Others, then the value to be stored in this field
 * @property int $prjd_mfrtargmarkets 1 - Domestic, 2 - Export, 3 - Mixed
 * @property int $prjd_mfrprodlevels 1 - Complete Product, 2 - Value Chain Based
 * @property int $prjd_splcategory 1 - R&D, 2 - Innovation, 3 - Startup
 * @property int $prjd_projimg_fk Reference to memcompfiledtls_tbl
 * @property string $prjd_projbanner Banner of the project. Reference to memcompfiledtls_tbl saved in comma separation
 * @property int $prjd_currencymst_fk Reference to currencymst_tbl.
 * @property int $prjd_projcostvalue 1 - To be determined, 2 - Disclosed, 3 - Not Disclosed
 * @property string $prjd_projcost Project Cost
 * @property string $prjd_dateofinception Date of inception
 * @property string $prjd_plannedprojstrtdt Project Planned start date
 * @property string $prjd_plannedprojenddt Project Planned end date
 * @property int $prjd_projstage Reference to projstagemst_tbl
 * @property string $prjd_projdelayreason Reason for the delay in project
 * @property string $prjd_projscentralschememst_fk Reference to projschememst_tbl stored in comma separation for federal scheme 
 * @property string $prjd_projcentralschemeothers Value to be collected if project scheme is Federal others
 * @property string $prjd_projstateschememst_fk Reference to projschememst_tbl stored in comma separation for state scheme
 * @property string $prjd_projstateschemeothers Value to be collected if project scheme is State others
 * @property int $prjd_projstatus 1 - Yet to Submit for Validation, 2 - Posted for Validation, 3 - Approved, 4 - Declined, 5 - Re-Submitted
 * @property array $prjd_sustdevelopgoal To save the sustainability development goal in JSON format
 * @property int $prjd_projmodeofimplentmst_fk Reference to projmodeofimplentmst_tbl
 * @property string $prjd_otherimplementation Value to be collected if mode of implementation is Others
 * @property int $prjd_interestfortender 1 - Yes, 2 - No
 * @property int $prjd_presentstatus 1 - Concession Agreement signed, 2 - Detailed Project Report (DPR) under progress, 3 - Financial Closure, 4 - Idea Proposal Stage, 5 - Machinery Supplier Appointed, 6 - MoU signed, 7 - Power purchase agreement (PPA) signed, 8 - PPP Contract Awarded, 9 - Prequalification bids invited, 10 - Project Allotted, 11 - RFPs invited, 12 - Statutory approvals received, 13 - Tender Re-Invited, 14 - Others
 * @property string $prjd_presentstatusothers Value to be collected if present status is others
 * @property int $prjd_projmanpower 1 - National, 2 - Expatriate, 3 - Both
 * @property int $prjd_projspend 1 - National, 2- International
 * @property string $prjd_localrepresent Local Representative
 * @property int $prjd_projfundmst_fk Reference to projfundmst_tbl
 * @property string $prjd_projotherfund Value to be collected if project funded by is Others
 * @property string $prjd_fundpercent Percentage of Fund
 * @property string $prjd_fundrefno Fund Reference No
 * @property string $prjd_debt Debt
 * @property string $prjd_amtspentsofar Amount Spent so far
 * @property string $prjd_equity Equity
 * @property string $prjd_balanceamt Balance Amount
 * @property string $prjd_debtequityratio Debt equity ratio
 * @property int $prjd_projownershipmst_fk Reference to projownershipmst_tbl
 * @property string $prjd_benefeat Project benefits & features
 * @property string $prjd_investorbenefits Investor benefits
 * @property string $prjd_projteam User Id in comma separation
 * @property string $prjd_projpromoterdtls_fk Reference to projpromoterdtls_tbl in comma separation
 * @property int $prjd_aboutlocation 1 - Finalized, 2 - Preference, 3 - Open(Govt. will decide)
 * @property string $prjd_addressline Address of project Location
 * @property string $prjd_latitude Latitude
 * @property string $prjd_longitude Longitude
 * @property int $prjd_countrymst_fk
 * @property int $prjd_statemst_fk Reference to statemst_tbl
 * @property int $prjd_citymst_fk Reference to citymst_tbl
 * @property string $prjd_district District
 * @property int $prjd_projzonemst_fk Reference to projzonemst_tbl
 * @property int $prjd_proptype Property Type. 1 - Residential, 2 - Industrial, 3 - Commercial
 * @property int $prjd_natureofprop 1 - Freehold, 2 - Restricted
 * @property int $prjd_landarea Land area of the project in numerals
 * @property int $prjd_unitmst_fk Reference to unitmst_tbl
 * @property int $prjd_projcategory 1 - Greenfield, 2 - Brownfield
 * @property string $prjd_contactinfo User Id in comma separation
 * @property string $prjd_projinvproced Project Investment Procedure
 * @property string $prjd_website Website of the project
 * @property array $prjd_socialmedia Social media to be stored as JSON value
 * @property string $prjd_finindicators Financial indicators
 * @property string $prjd_roi Return on investment
 * @property string $prjd_riskfactors Risk factors
 * @property string $prjd_riskdisclosures Risks & disclosures
 * @property int $prjd_projdiligenceform_fk Reference to projdiligenceform_tbl
 * @property string $prjd_financialdocs Reference to memcompfiledtls_tbl stored in comma separation
 * @property int $prjd_isdeleted Is deleted 1 - Yes, 2 - No
 * @property string $prjd_createdon First creation date
 * @property int $prjd_createdby
 * @property string $prjd_createdbyipaddr User IP Address
 * @property string $prjd_updatedon Datetime of updation
 * @property int $prjd_updatedby Reference to usermst_tbl
 * @property string $prjd_updatedbyipaddr Updated by user's IP Address
 * @property string $prjd_submittedon First Submission date
 * @property int $prjd_submittedby Submitted by user id
 * @property string $prjd_submittedbyipaddr IP Address of the user
 * @property string $prjd_approvalno Approval No
 * @property string $prjd_apprdeclon Project Approval / Declined on
 * @property int $prjd_apprdeclby Project Approval / Declined by user id
 * @property string $prjd_apprdeclbyipaddr IP Address of the user
 * @property string $prjd_appldeccomments Comments if declined
 *
 * @property CmsrequisitionformdtlsTbl[] $cmsrequisitionformdtlsTbls
 * @property ProjaccachievedtlsTbl[] $projaccachievedtlsTbls
 * @property ProjacqlicdtlsTbl[] $projacqlicdtlsTbls
 * @property ProjdilsubdtlsTbl[] $projdilsubdtlsTbls
 * @property ProjdtlsaggrTbl[] $projdtlsaggrTbls
 * @property UsermstTbl $prjdApprdeclby
 * @property CitymstTbl $prjdCitymstFk
 * @property IndustrymstTbl $prjdIndustrymstFk
 * @property MemberregistrationmstTbl $prjdMemberregmstFk
 * @property ProjdiligenceformTbl $prjdProjdiligenceformFk
 * @property ProjecttmpTbl $prjdProjecttmpFk
 * @property SectormstTbl $prjdSectormstFk
 * @property StatemstTbl $prjdStatemstFk
 * @property UsermstTbl $prjdSubmittedby
 * @property ProjecthstyTbl[] $projecthstyTbls
 * @property ProjeoisubdtlsTbl[] $projeoisubdtlsTbls
 * @property ProjinvinfodtlsTbl[] $projinvinfodtlsTbls
 * @property ProjinvmappingTbl[] $projinvmappingTbls
 * @property ProjshortlistTbl[] $projshortlistTbls
 * @property ProjtechdocumentsTbl[] $projtechdocumentsTbls
 * @property ProjtechnicalTbl[] $projtechnicalTbls
 * @property ProjviewingdtlsTbl[] $projviewingdtlsTbls
 */
class ProjectdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projectdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prjd_projecttmp_fk', 'prjd_memberregmst_fk', 'prjd_domain', 'prjd_classification', 'prjd_sectormst_fk', 'prjd_industrymst_fk', 'prjd_blockmst_fk', 'prjd_isproposal', 'prjd_projtype', 'prjd_mfrtargmarkets', 'prjd_mfrprodlevels', 'prjd_splcategory', 'prjd_projimg_fk', 'prjd_currencymst_fk', 'prjd_projcostvalue', 'prjd_projstage', 'prjd_projstatus', 'prjd_projmodeofimplentmst_fk', 'prjd_interestfortender', 'prjd_presentstatus', 'prjd_projmanpower', 'prjd_projspend', 'prjd_projfundmst_fk', 'prjd_projownershipmst_fk', 'prjd_aboutlocation', 'prjd_countrymst_fk', 'prjd_statemst_fk', 'prjd_citymst_fk', 'prjd_projzonemst_fk', 'prjd_proptype', 'prjd_natureofprop', 'prjd_landarea', 'prjd_unitmst_fk', 'prjd_projcategory', 'prjd_projdiligenceform_fk', 'prjd_isdeleted', 'prjd_createdby', 'prjd_updatedby', 'prjd_submittedby', 'prjd_apprdeclby'], 'integer'],
            [['prjd_memberregmst_fk', 'prjd_referenceno', 'prjd_projname', 'prjd_projstatus', 'prjd_countrymst_fk', 'prjd_createdon', 'prjd_createdby', 'prjd_submittedon', 'prjd_submittedby'], 'required'],
            [['prjd_shortsummary', 'prjd_projdesc', 'prjd_otherprojtype', 'prjd_projbanner', 'prjd_projdelayreason', 'prjd_projscentralschememst_fk', 'prjd_projcentralschemeothers', 'prjd_projstateschememst_fk', 'prjd_projstateschemeothers', 'prjd_otherimplementation', 'prjd_presentstatusothers', 'prjd_localrepresent', 'prjd_projotherfund', 'prjd_benefeat', 'prjd_investorbenefits', 'prjd_projteam', 'prjd_projpromoterdtls_fk', 'prjd_addressline', 'prjd_contactinfo', 'prjd_projinvproced', 'prjd_finindicators', 'prjd_roi', 'prjd_riskfactors', 'prjd_riskdisclosures', 'prjd_financialdocs', 'prjd_appldeccomments'], 'string'],
            [['prjd_projcost', 'prjd_fundpercent', 'prjd_debt', 'prjd_amtspentsofar', 'prjd_equity', 'prjd_balanceamt'], 'number'],
            [['prjd_dateofinception', 'prjd_plannedprojstrtdt', 'prjd_plannedprojenddt', 'prjd_sustdevelopgoal', 'prjd_socialmedia', 'prjd_createdon', 'prjd_updatedon', 'prjd_submittedon', 'prjd_apprdeclon'], 'safe'],
            [['prjd_projectid', 'prjd_referenceno', 'prjd_debtequityratio'], 'string', 'max' => 20],
            [['prjd_projname'], 'string', 'max' => 250],
            [['prjd_fundrefno', 'prjd_district'], 'string', 'max' => 30],
            [['prjd_latitude'], 'string', 'max' => 12],
            [['prjd_longitude'], 'string', 'max' => 13],
            [['prjd_website'], 'string', 'max' => 100],
            [['prjd_createdbyipaddr', 'prjd_updatedbyipaddr', 'prjd_submittedbyipaddr', 'prjd_approvalno', 'prjd_apprdeclbyipaddr'], 'string', 'max' => 50],
            [['prjd_apprdeclby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjd_apprdeclby' => 'UserMst_Pk']],
            [['prjd_citymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CitymstTbl::className(), 'targetAttribute' => ['prjd_citymst_fk' => 'CityMst_Pk']],
            [['prjd_industrymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IndustrymstTbl::className(), 'targetAttribute' => ['prjd_industrymst_fk' => 'IndustryMst_Pk']],
            [['prjd_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['prjd_memberregmst_fk' => 'MemberRegMst_Pk']],
            [['prjd_projdiligenceform_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjdiligenceformTbl::className(), 'targetAttribute' => ['prjd_projdiligenceform_fk' => 'projdiligenceform_pk']],
            [['prjd_projecttmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecttmpTbl::className(), 'targetAttribute' => ['prjd_projecttmp_fk' => 'projecttmp_pk']],
            [['prjd_sectormst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => SectormstTbl::className(), 'targetAttribute' => ['prjd_sectormst_fk' => 'SectorMst_Pk']],
            [['prjd_statemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StatemstTbl::className(), 'targetAttribute' => ['prjd_statemst_fk' => 'StateMst_Pk']],
            [['prjd_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjd_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projectdtls_pk' => 'Projectdtls Pk',
            'prjd_projecttmp_fk' => 'Prjd Projecttmp Fk',
            'prjd_memberregmst_fk' => 'Prjd Memberregmst Fk',
            'prjd_domain' => 'Prjd Domain',
            'prjd_projectid' => 'Prjd Projectid',
            'prjd_referenceno' => 'Prjd Referenceno',
            'prjd_projname' => 'Prjd Projname',
            'prjd_shortsummary' => 'Prjd Shortsummary',
            'prjd_projdesc' => 'Prjd Projdesc',
            'prjd_classification' => 'Prjd Classification',
            'prjd_sectormst_fk' => 'Prjd Sectormst Fk',
            'prjd_industrymst_fk' => 'Prjd Industrymst Fk',
            'prjd_blockmst_fk' => 'Prjd Blockmst Fk',
            'prjd_isproposal' => 'Prjd Isproposal',
            'prjd_projtype' => 'Prjd Projtype',
            'prjd_otherprojtype' => 'Prjd Otherprojtype',
            'prjd_mfrtargmarkets' => 'Prjd Mfrtargmarkets',
            'prjd_mfrprodlevels' => 'Prjd Mfrprodlevels',
            'prjd_splcategory' => 'Prjd Splcategory',
            'prjd_projimg_fk' => 'Prjd Projimg Fk',
            'prjd_projbanner' => 'Prjd Projbanner',
            'prjd_currencymst_fk' => 'Prjd Currencymst Fk',
            'prjd_projcostvalue' => 'Prjd Projcostvalue',
            'prjd_projcost' => 'Prjd Projcost',
            'prjd_dateofinception' => 'Prjd Dateofinception',
            'prjd_plannedprojstrtdt' => 'Prjd Plannedprojstrtdt',
            'prjd_plannedprojenddt' => 'Prjd Plannedprojenddt',
            'prjd_projstage' => 'Prjd Projstage',
            'prjd_projdelayreason' => 'Prjd Projdelayreason',
            'prjd_projscentralschememst_fk' => 'Prjd Projscentralschememst Fk',
            'prjd_projcentralschemeothers' => 'Prjd Projcentralschemeothers',
            'prjd_projstateschememst_fk' => 'Prjd Projstateschememst Fk',
            'prjd_projstateschemeothers' => 'Prjd Projstateschemeothers',
            'prjd_projstatus' => 'Prjd Projstatus',
            'prjd_sustdevelopgoal' => 'Prjd Sustdevelopgoal',
            'prjd_projmodeofimplentmst_fk' => 'Prjd Projmodeofimplentmst Fk',
            'prjd_otherimplementation' => 'Prjd Otherimplementation',
            'prjd_interestfortender' => 'Prjd Interestfortender',
            'prjd_presentstatus' => 'Prjd Presentstatus',
            'prjd_presentstatusothers' => 'Prjd Presentstatusothers',
            'prjd_projmanpower' => 'Prjd Projmanpower',
            'prjd_projspend' => 'Prjd Projspend',
            'prjd_localrepresent' => 'Prjd Localrepresent',
            'prjd_projfundmst_fk' => 'Prjd Projfundmst Fk',
            'prjd_projotherfund' => 'Prjd Projotherfund',
            'prjd_fundpercent' => 'Prjd Fundpercent',
            'prjd_fundrefno' => 'Prjd Fundrefno',
            'prjd_debt' => 'Prjd Debt',
            'prjd_amtspentsofar' => 'Prjd Amtspentsofar',
            'prjd_equity' => 'Prjd Equity',
            'prjd_balanceamt' => 'Prjd Balanceamt',
            'prjd_debtequityratio' => 'Prjd Debtequityratio',
            'prjd_projownershipmst_fk' => 'Prjd Projownershipmst Fk',
            'prjd_benefeat' => 'Prjd Benefeat',
            'prjd_investorbenefits' => 'Prjd Investorbenefits',
            'prjd_projteam' => 'Prjd Projteam',
            'prjd_projpromoterdtls_fk' => 'Prjd Projpromoterdtls Fk',
            'prjd_aboutlocation' => 'Prjd Aboutlocation',
            'prjd_addressline' => 'Prjd Addressline',
            'prjd_latitude' => 'Prjd Latitude',
            'prjd_longitude' => 'Prjd Longitude',
            'prjd_countrymst_fk' => 'Prjd Countrymst Fk',
            'prjd_statemst_fk' => 'Prjd Statemst Fk',
            'prjd_citymst_fk' => 'Prjd Citymst Fk',
            'prjd_district' => 'Prjd District',
            'prjd_projzonemst_fk' => 'Prjd Projzonemst Fk',
            'prjd_proptype' => 'Prjd Proptype',
            'prjd_natureofprop' => 'Prjd Natureofprop',
            'prjd_landarea' => 'Prjd Landarea',
            'prjd_unitmst_fk' => 'Prjd Unitmst Fk',
            'prjd_projcategory' => 'Prjd Projcategory',
            'prjd_contactinfo' => 'Prjd Contactinfo',
            'prjd_projinvproced' => 'Prjd Projinvproced',
            'prjd_website' => 'Prjd Website',
            'prjd_socialmedia' => 'Prjd Socialmedia',
            'prjd_finindicators' => 'Prjd Finindicators',
            'prjd_roi' => 'Prjd Roi',
            'prjd_riskfactors' => 'Prjd Riskfactors',
            'prjd_riskdisclosures' => 'Prjd Riskdisclosures',
            'prjd_projdiligenceform_fk' => 'Prjd Projdiligenceform Fk',
            'prjd_financialdocs' => 'Prjd Financialdocs',
            'prjd_isdeleted' => 'Prjd Isdeleted',
            'prjd_createdon' => 'Prjd Createdon',
            'prjd_createdby' => 'Prjd Createdby',
            'prjd_createdbyipaddr' => 'Prjd Createdbyipaddr',
            'prjd_updatedon' => 'Prjd Updatedon',
            'prjd_updatedby' => 'Prjd Updatedby',
            'prjd_updatedbyipaddr' => 'Prjd Updatedbyipaddr',
            'prjd_submittedon' => 'Prjd Submittedon',
            'prjd_submittedby' => 'Prjd Submittedby',
            'prjd_submittedbyipaddr' => 'Prjd Submittedbyipaddr',
            'prjd_approvalno' => 'Prjd Approvalno',
            'prjd_apprdeclon' => 'Prjd Apprdeclon',
            'prjd_apprdeclby' => 'Prjd Apprdeclby',
            'prjd_apprdeclbyipaddr' => 'Prjd Apprdeclbyipaddr',
            'prjd_appldeccomments' => 'Prjd Appldeccomments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsrequisitionformdtlsTbls()
    {
        return $this->hasMany(\api\modules\pms\models\CmsrequisitionformdtlsTbl::className(), ['crfd_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjaccachievedtlsTbls()
    {
        return $this->hasMany(ProjaccachievedtlsTbl::className(), ['paad_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjacqlicdtlsTbls()
    {
        return $this->hasMany(ProjacqlicdtlsTbl::className(), ['pald_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjdilsubdtlsTbls()
    {
        return $this->hasMany(ProjdilsubdtlsTbl::className(), ['prdsd_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjdtlsaggrTbls()
    {
        return $this->hasMany(ProjdtlsaggrTbl::className(), ['pda_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjdApprdeclby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjd_apprdeclby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjdCitymstFk()
    {
        return $this->hasOne(CitymstTbl::className(), ['CityMst_Pk' => 'prjd_citymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjdIndustrymstFk()
    {
        return $this->hasOne(IndustrymstTbl::className(), ['IndustryMst_Pk' => 'prjd_industrymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjdMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'prjd_memberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjdProjdiligenceformFk()
    {
        return $this->hasOne(ProjdiligenceformTbl::className(), ['projdiligenceform_pk' => 'prjd_projdiligenceform_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjdProjecttmpFk()
    {
        return $this->hasOne(ProjecttmpTbl::className(), ['projecttmp_pk' => 'prjd_projecttmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjdSectormstFk()
    {
        return $this->hasOne(SectormstTbl::className(), ['SectorMst_Pk' => 'prjd_sectormst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjdStatemstFk()
    {
        return $this->hasOne(StatemstTbl::className(), ['StateMst_Pk' => 'prjd_statemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjdSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjd_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjecthstyTbls()
    {
        return $this->hasMany(ProjecthstyTbl::className(), ['prjh_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjeoisubdtlsTbls()
    {
        return $this->hasMany(ProjeoisubdtlsTbl::className(), ['presd_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjinvinfodtlsTbls()
    {
        return $this->hasMany(ProjinvinfodtlsTbl::className(), ['piid_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjinvmappingTbls()
    {
        return $this->hasMany(ProjinvmappingTbl::className(), ['pim_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjshortlistTbls()
    {
        return $this->hasMany(ProjshortlistTbl::className(), ['prjsl_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjtechdocumentsTbls()
    {
        return $this->hasMany(ProjtechdocumentsTbl::className(), ['ptd_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjtechnicalTbls()
    {
        return $this->hasMany(ProjtechnicalTbl::className(), ['pt_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjviewingdtlsTbls()
    {
        return $this->hasMany(ProjviewingdtlsTbl::className(), ['pvd_projectdtls_fk' => 'projectdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectstage()
    {
        return $this->hasOne(ProjstagemstTbl::className(), ['projstagemst_pk' => 'prjd_projstage']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectdtlsTblQuery(get_called_class());
    }

    public static function getSubContracts($subcontracts, $formdata, $awarded_to,  $projectId, $level, $baseUrl){
        foreach($subcontracts as $key => $subcontract){
            $type = '';
            $parent = $subcontract->cmsch_cmscontracthdr_fk;
            if($level == 0){
                 $parent = null;
}
            if($formdata['dataType'] == 1 && $level == 1){
               $parent = $projectId;
            }
            $award = $subcontract->cmsawarddtlsTo;
            $nonjsrssupplier = [];
            $awarded_country = [];
            if(!empty($award->cmsadCmsnonjsrssupmapFk) && !empty($award->cmsadCmsnonjsrssupmapFk->cnjsmCmsnonjsrssupdtlsFk)){
                $nonjsrssupplier = $award->cmsadCmsnonjsrssupmapFk->cnjsmCmsnonjsrssupdtlsFk;
            }
            if($award->cmsadMemcompmstFk->MCM_Source_CountryMst_Fk){
                $awarded_country = $award->cmsadMemcompmstFk->mCMSourceCountryMstFk;
            }
            $company_logo = null;
            $reqTable = $subcontract->cmschCmsrequisitionformdtlsFk;
            if(!empty($award->cmsadMemcompmstFk->mcm_complogo_memcompfiledtlsfk)) {
                $userpk = $award->cmsadMemcompmstFk->mCMMemberRegMstFk->mrm_createdby;
                $company_logo = \common\components\Drive::generateUrl($award->cmsadMemcompmstFk->mcm_complogo_memcompfiledtlsfk,$award->cmsadMemcompmstFk->MemberCompMst_Pk, $userpk);
            }
            $data[] = [
                'nodeId' => $subcontract->cmscontracthdr_pk,
                'uid' => $subcontract->cmsch_uid,
                'parentNodeId' => $parent,
                'level' => $level,
                'ref_no' => $subcontract->cmsch_contractrefno,
                'type' =>  $subcontract->cmsch_type,
                'subtype' =>  $subcontract->cmsch_contracttype,
                'name' => $subcontract->cmsch_contracttitle,
                'awardStatus' => $subcontract->cmsch_createdon ? 1 : 2,
                'obligation' => $subcontract->cmsch_obligation,
                'status' => $subcontract->cmsch_contractstatus,
                'process_type' => $reqTable->crfd_rqprocesstype,
                'value' => Common::numberConversionNew($subcontract->cmsch_contractvalue),
                'currency_name' => $subcontract->cmschMemcompmstFk ? $subcontract->cmschMemcompmstFk->mCMCountryMstFk->CyM_CountryName_en : '',
                'currency_symbol' => $subcontract->cmschMemcompmstFk ? $subcontract->cmschMemcompmstFk->mCMCountryMstFk->CyM_CountryCode_en : '',
                'start_date' => $subcontract->cmsch_contractstartdate ? date('d-m-Y', strtotime($subcontract->cmsch_contractstartdate)) : '',
                'end_date' => $subcontract->cmsch_contractenddate ? date('d-m-Y', strtotime($subcontract->cmsch_contractenddate)) : '',
                'period' => $subcontract->cmsch_contractperiod,
                'awarded_to' => $award->cmsadMemcompmstFk || $award->cmsadCmsnonjsrssupmapFk  ? [
                    'dataType' => $award->cmsadMemcompmstFk ? 1 : 2,
                    'name' => $award->cmsadMemcompmstFk->MCM_CompanyName ? $award->cmsadMemcompmstFk->MCM_CompanyName: null,
                    'name_pk' => $award->cmsadMemcompmstFk->MCM_CompanyName ? $award->cmsadMemcompmstFk->MemberCompMst_Pk: null,
                    'supplier_code' => $award->cmsadMemcompmstFk->MCM_SupplierCode ?  $award->cmsadMemcompmstFk->MCM_SupplierCode: null,
                    'classification' =>  $award->cmsad_classification ? $award->cmsad_classification : null,
                    'external_profile_link' => $award->cmsadMemcompmstFk->mcm_externalproflink ? $baseUrl.'externalprofile/'. $award->cmsadMemcompmstFk->mcm_externalproflink :$baseUrl.'externalprofile/'.Security::encrypt($award->cmsadMemcompmstFk->MemberCompMst_Pk).'/1',
                    'supplier360' => $award->cmsadMemcompmstFk->MemberCompMst_Pk ? $baseUrl.'dashboard/supplier360/'. Security::encrypt($award->cmsadMemcompmstFk->MemberCompMst_Pk) :null,
                    'nonjsrs_name' => !empty($award->cmsadCmsnonjsrssupmapFk->cnjsm_orgname) ?$award->cmsadCmsnonjsrssupmapFk->cnjsm_orgname : null,
                    'nonjsrs_name_pk' => !empty($award->cmsad_cmsnonjsrssupmap_fk) ? $award->cmsad_cmsnonjsrssupmap_fk : null,
                    'awarded_on' => $award->cmsad_createdon ? date('d-m-Y', strtotime($award->cmsad_createdon)) : null,
                    'jsrssplstatus' => $award->cmsad_jsrssplstatus,
                    'supplier_status' =>  $award->cmsad_cmsnonjsrssupmap_fk

                ] : $awarded_to,
                'subContract' => $subcontract->getSubcontracts()->where(['cmsch_type' => 1])->count(),
                'subOrder' => $subcontract->getSubcontracts()->where(['cmsch_type' => 2])->count(),
                'subAgreement' => $subcontract->getSubcontracts()->where(['cmsch_type' => 3])->count(),
                'url' => $baseUrl.'contract/contractdetails/'.Security::encrypt($subcontract->cmscontracthdr_pk),
                'ICV' => $subcontract->cmsch_obligation,
                'obligation' => $subcontract->cmsch_obligation,
                'obligation_msmepercent' => $subcontract->cmsch_msmepercent,
                'obligation_lccpercent' => $subcontract->cmsch_lccpercent,
                'subcontracting' => $subcontract->cmsch_issubcontrqmt,
                'etenderingmandate' => $subcontract->cmsch_isetendmandate,
                'compnay_logo' => $company_logo,
                'quotation_pk'=> $subcontract->cmsch_cmsquotationhdr_fk,
                'jsrs_special_status' => $award->cmsad_jsrssplstatus,
                'jsrs_country' => $awarded_country ? $awarded_country->CyM_CountryName_en:'',
                'jsrs_country_pk' => $awarded_country ? $awarded_country->CountryMst_Pk:'',
                'nonjsrs_country' => $nonjsrssupplier->cmsnjsdCountrymstFk ? $nonjsrssupplier->cmsnjsdCountrymstFk->CyM_CountryName_en:'',
                'nonjsrs_country_pk' => $nonjsrssupplier->cmsnjsdCountrymstFk ? $nonjsrssupplier->cmsnjsdCountrymstFk->CountryMst_Pk:'',
                'etendering' => $subcontract->cmsch_isetendmandate,
                'procurement_type' => !empty($subcontract->cmschCmsrequisitionformdtlsFk) ? $subcontract->cmschCmsrequisitionformdtlsFk->crfd_rqtype : ''
            ];

            if($subcontract->subcontracts){
                $beta = self::getSubContracts($subcontract->subcontracts, $formdata, $awarded_to, $projectId, $level+1, $baseUrl);
                $data = array_merge($data, $beta);
            }
        }
        return $data;
    }
}
