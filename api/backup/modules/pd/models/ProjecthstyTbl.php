<?php

namespace api\modules\pd\models;
use api\modules\mst\models\CitymstTbl;
use api\modules\mst\models\IndustrymstTbl;
use api\modules\mst\models\SectormstTbl;
use api\modules\mst\models\StatemstTbl;
use common\models\MemberregistrationmstTbl;
use common\models\UsermstTbl;
use Yii;

/**
 * This is the model class for table "projecthsty_tbl".
 *
 * @property int $projecthsty_pk Primary key
 * @property int $prjh_projectdtls_fk Reference to projectdtls_tbl
 * @property int $prjh_projecttmp_fk Reference to projecttmp_tbl
 * @property int $prjh_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property int $prjh_domain Projects created from 1 - Investment, 2 - Procurement
 * @property string $prjh_projectid Project id for internal reference
 * @property string $prjh_referenceno Project Reference No
 * @property string $prjh_projname Project Name
 * @property string $prjh_shortsummary Short summary about the Project
 * @property string $prjh_projdesc Project Description
 * @property int $prjh_sectormst_fk Reference to sectormst_tbl
 * @property int $prjh_industrymst_fk Reference to industrymst_tbl
 * @property int $prjh_isproposal 1- Yes. To tag if the project is converted from proposal
 * @property int $prjh_projtype Reference to projtypemst_tbl
 * @property string $prjh_otherprojtype If Project type is Others, then the value to be stored in this field
 * @property int $prjh_mfrtargmarkets 1 - Domestic, 2 - Export, 3 - Mixed
 * @property int $prjh_mfrprodlevels 1 - Complete Product, 2 - Value Chain Based
 * @property int $prjh_splcategory 1 - R&D, 2 - Innovation, 3 - Startup
 * @property string $prjh_projbanner Banner of the project. Reference to memcompfiledtls_tbl saved in comma separation
 * @property int $prjh_projcostvalue 1 - To be determined, 2 - Disclosed, 3 - Not Disclosed
 * @property string $prjh_projcost Project Cost
 * @property string $prjh_dateofinception Date of inception
 * @property string $prjh_plannedprojstrtdt Project Planned start date
 * @property string $prjh_plannedprojenddt Project Planned end date
 * @property int $prjh_projstage Reference to projstagemst_tbl
 * @property string $prjh_projdelayreason Reason for the delay in project
 * @property string $prjh_projscentralschememst_fk Reference to projschememst_tbl stored in comma separation for federal scheme 
 * @property string $prjh_projcentralschemeothers Value to be collected if project scheme is Federal others
 * @property string $prjh_projstateschememst_fk Reference to projschememst_tbl stored in comma separation for state scheme
 * @property string $prjh_projstateschemeothers Value to be collected if project scheme is State others
 * @property int $prjh_projstatus 1 - Yet to Submit for Validation, 2 - Posted for Validation, 3 - Approved, 4 - Declined, 5 - Re-Submitted
 * @property array $prjh_sustdevelopgoal To save the sustainability development goal in JSON format
 * @property int $prjh_projmodeofimplentmst_fk Reference to projmodeofimplentmst_tbl
 * @property string $prjh_otherimplementation Value to be collected if mode of implementation is Others
 * @property int $prjh_interestfortender 1 - Yes, 2 - No
 * @property int $prjh_presentstatus 1 - Concession Agreement signed, 2 - Detailed Project Report (DPR) under progress, 3 - Financial Closure, 4 - Idea Proposal Stage, 5 - Machinery Supplier Appointed, 6 - MoU signed, 7 - Power purchase agreement (PPA) signed, 8 - PPP Contract Awarded, 9 - Prequalification bids invited, 10 - Project Allotted, 11 - RFPs invited, 12 - Statutory approvals received, 13 - Tender Re-Invited, 14 - Others
 * @property string $prjh_presentstatusothers Value to be collected if present status is others
 * @property int $prjh_projmanpower 1 - National, 2 - Expatriate, 3 - Both
 * @property int $prjh_projspend 1 - National, 2- International
 * @property string $prjh_localrepresent Local Representative
 * @property string $prjh_projfundmst_fk Reference to projfundmst_tbl
 * @property string $prjh_projotherfund Value to be collected if project funded by is Others
 * @property string $prjh_fundpercent Percentage of Fund
 * @property string $prjh_fundrefno Fund Reference No
 * @property string $prjh_debt Debt
 * @property string $prjh_amtspentsofar Amount Spent so far
 * @property string $prjh_equity Equity
 * @property string $prjh_balanceamt Balance Amount
 * @property string $prjh_debtequityratio Debt equity ratio
 * @property int $prjh_projownershipmst_fk Reference to projownershipmst_tbl
 * @property string $prjh_benefeat Project benefits & features
 * @property string $prjh_investorbenefits Investor benefits
 * @property string $prjh_projteam User Id in comma separation
 * @property string $prjh_projpromoterdtls_fk Reference to projpromoterdtls_tbl in comma separation
 * @property int $prjh_aboutlocation 1 - Finalized, 2 - Preference, 3 - Open(Govt. will decide)
 * @property string $prjh_addressline Address of project Location
 * @property string $prjh_latitude Latitude
 * @property string $prjh_longitude Longitude
 * @property int $prjh_statemst_fk Reference to statemst_tbl
 * @property int $prjh_citymst_fk Reference to citymst_tbl
 * @property string $prjh_district District
 * @property int $prjh_projzonemst_fk Reference to projzonemst_tbl
 * @property int $prjh_proptype Property Type. 1 - Residential, 2 - Industrial, 3 - Commercial
 * @property int $prjh_natureofprop 1 - Freehold, 2 - Restricted
 * @property int $prjh_landarea Land area of the project in numerals
 * @property int $prjh_unitmst_fk Reference to unitmst_tbl
 * @property int $prjh_projcategory 1 - Greenfield, 2 - Brownfield
 * @property string $prjh_contactinfo User Id in comma separation
 * @property string $prjh_projinvproced Project Investment Procedure
 * @property string $prjh_website Website of the project
 * @property array $prjh_socialmedia Social media to be stored as JSON value
 * @property string $prjh_finindicators Financial indicators
 * @property string $prjh_roi Return on investment
 * @property string $prjh_riskfactors Risk factors
 * @property string $prjh_riskdisclosures Risks & disclosures
 * @property int $prjh_projdiligenceform_fk Reference to projdiligenceform_tbl
 * @property string $prjh_financialdocs Reference to memcompfiledtls_tbl stored in comma separation
 * @property string $prjh_createdon First creation date
 * @property int $prjh_createdby
 * @property string $prjh_createdbyipaddr User IP Address
 * @property string $prjh_histcreatedon Datetime of history creation
 * @property string $prjh_submittedon First Submission date
 * @property int $prjh_submittedby Submitted by user id
 * @property string $prjh_submittedbyipaddr IP Address of the user
 * @property string $prjh_approvalno Approval No
 * @property string $prjh_apprdeclon Project Approval / Declined on
 * @property int $prjh_apprdeclby Project Approval / Declined by user id
 * @property string $prjh_apprdeclbyipaddr IP Address of the user
 * @property string $prjh_appldeccomments Comments if declined
 *
 * @property ProjaccachievehstyTbl[] $projaccachievehstyTbls
 * @property UsermstTbl $prjhApprdeclby
 * @property CitymstTbl $prjhCitymstFk
 * @property IndustrymstTbl $prjhIndustrymstFk
 * @property MemberregistrationmstTbl $prjhMemberregmstFk
 * @property ProjectdtlsTbl $prjhProjectdtlsFk
 * @property ProjecttmpTbl $prjhProjecttmpFk
 * @property SectormstTbl $prjhSectormstFk
 * @property StatemstTbl $prjhStatemstFk
 * @property UsermstTbl $prjhSubmittedby
 * @property ProjectpartnerhstyTbl[] $projectpartnerhstyTbls
 * @property ProjinvinfohstyTbl[] $projinvinfohstyTbls
 * @property ProjinvmappinghstyTbl[] $projinvmappinghstyTbls
 * @property ProjtechdocumentshstyTbl[] $projtechdocumentshstyTbls
 * @property ProjtechnicalhstyTbl[] $projtechnicalhstyTbls
 */
class ProjecthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projecthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prjh_projectdtls_fk', 'prjh_projecttmp_fk', 'prjh_memberregmst_fk', 'prjh_domain', 'prjh_sectormst_fk', 'prjh_industrymst_fk', 'prjh_isproposal', 'prjh_projtype', 'prjh_mfrtargmarkets', 'prjh_mfrprodlevels', 'prjh_splcategory', 'prjh_projcostvalue', 'prjh_projstage', 'prjh_projstatus', 'prjh_projmodeofimplentmst_fk', 'prjh_interestfortender', 'prjh_presentstatus', 'prjh_projmanpower', 'prjh_projspend', 'prjh_projownershipmst_fk', 'prjh_aboutlocation', 'prjh_statemst_fk', 'prjh_citymst_fk', 'prjh_projzonemst_fk', 'prjh_proptype', 'prjh_natureofprop', 'prjh_landarea', 'prjh_unitmst_fk', 'prjh_projcategory', 'prjh_projdiligenceform_fk', 'prjh_createdby', 'prjh_submittedby', 'prjh_apprdeclby'], 'integer'],
            [['prjh_memberregmst_fk', 'prjh_referenceno', 'prjh_projname', 'prjh_projstatus', 'prjh_createdon', 'prjh_createdby', 'prjh_submittedon', 'prjh_submittedby'], 'required'],
            [['prjh_shortsummary', 'prjh_projdesc', 'prjh_otherprojtype', 'prjh_projbanner', 'prjh_projdelayreason', 'prjh_projscentralschememst_fk', 'prjh_projcentralschemeothers', 'prjh_projstateschememst_fk', 'prjh_projstateschemeothers', 'prjh_otherimplementation', 'prjh_presentstatusothers', 'prjh_localrepresent', 'prjh_projfundmst_fk', 'prjh_projotherfund', 'prjh_benefeat', 'prjh_investorbenefits', 'prjh_projteam', 'prjh_projpromoterdtls_fk', 'prjh_addressline', 'prjh_contactinfo', 'prjh_projinvproced', 'prjh_finindicators', 'prjh_roi', 'prjh_riskfactors', 'prjh_riskdisclosures', 'prjh_financialdocs', 'prjh_appldeccomments'], 'string'],
            [['prjh_projcost', 'prjh_fundpercent', 'prjh_debt', 'prjh_amtspentsofar', 'prjh_equity', 'prjh_balanceamt'], 'number'],
            [['prjh_dateofinception', 'prjh_plannedprojstrtdt', 'prjh_plannedprojenddt', 'prjh_sustdevelopgoal', 'prjh_socialmedia', 'prjh_createdon', 'prjh_histcreatedon', 'prjh_submittedon', 'prjh_apprdeclon'], 'safe'],
            [['prjh_projectid', 'prjh_referenceno', 'prjh_debtequityratio'], 'string', 'max' => 20],
            [['prjh_projname'], 'string', 'max' => 250],
            [['prjh_fundrefno', 'prjh_district'], 'string', 'max' => 30],
            [['prjh_latitude'], 'string', 'max' => 12],
            [['prjh_longitude'], 'string', 'max' => 13],
            [['prjh_website'], 'string', 'max' => 100],
            [['prjh_createdbyipaddr', 'prjh_submittedbyipaddr', 'prjh_approvalno', 'prjh_apprdeclbyipaddr'], 'string', 'max' => 50],
            [['prjh_apprdeclby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjh_apprdeclby' => 'UserMst_Pk']],
            [['prjh_citymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CitymstTbl::className(), 'targetAttribute' => ['prjh_citymst_fk' => 'CityMst_Pk']],
            [['prjh_industrymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IndustrymstTbl::className(), 'targetAttribute' => ['prjh_industrymst_fk' => 'IndustryMst_Pk']],
            [['prjh_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['prjh_memberregmst_fk' => 'MemberRegMst_Pk']],
            [['prjh_projectdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectdtlsTbl::className(), 'targetAttribute' => ['prjh_projectdtls_fk' => 'projectdtls_pk']],
            [['prjh_projecttmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecttmpTbl::className(), 'targetAttribute' => ['prjh_projecttmp_fk' => 'projecttmp_pk']],
            [['prjh_sectormst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => SectormstTbl::className(), 'targetAttribute' => ['prjh_sectormst_fk' => 'SectorMst_Pk']],
            [['prjh_statemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StatemstTbl::className(), 'targetAttribute' => ['prjh_statemst_fk' => 'StateMst_Pk']],
            [['prjh_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjh_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projecthsty_pk' => 'Projecthsty Pk',
            'prjh_projectdtls_fk' => 'Prjh Projectdtls Fk',
            'prjh_projecttmp_fk' => 'Prjh Projecttmp Fk',
            'prjh_memberregmst_fk' => 'Prjh Memberregmst Fk',
            'prjh_domain' => 'Prjh Domain',
            'prjh_projectid' => 'Prjh Projectid',
            'prjh_referenceno' => 'Prjh Referenceno',
            'prjh_projname' => 'Prjh Projname',
            'prjh_shortsummary' => 'Prjh Shortsummary',
            'prjh_projdesc' => 'Prjh Projdesc',
            'prjh_sectormst_fk' => 'Prjh Sectormst Fk',
            'prjh_industrymst_fk' => 'Prjh Industrymst Fk',
            'prjh_isproposal' => 'Prjh Isproposal',
            'prjh_projtype' => 'Prjh Projtype',
            'prjh_otherprojtype' => 'Prjh Otherprojtype',
            'prjh_mfrtargmarkets' => 'Prjh Mfrtargmarkets',
            'prjh_mfrprodlevels' => 'Prjh Mfrprodlevels',
            'prjh_splcategory' => 'Prjh Splcategory',
            'prjh_projbanner' => 'Prjh Projbanner',
            'prjh_projcostvalue' => 'Prjh Projcostvalue',
            'prjh_projcost' => 'Prjh Projcost',
            'prjh_dateofinception' => 'Prjh Dateofinception',
            'prjh_plannedprojstrtdt' => 'Prjh Plannedprojstrtdt',
            'prjh_plannedprojenddt' => 'Prjh Plannedprojenddt',
            'prjh_projstage' => 'Prjh Projstage',
            'prjh_projdelayreason' => 'Prjh Projdelayreason',
            'prjh_projscentralschememst_fk' => 'Prjh Projscentralschememst Fk',
            'prjh_projcentralschemeothers' => 'Prjh Projcentralschemeothers',
            'prjh_projstateschememst_fk' => 'Prjh Projstateschememst Fk',
            'prjh_projstateschemeothers' => 'Prjh Projstateschemeothers',
            'prjh_projstatus' => 'Prjh Projstatus',
            'prjh_sustdevelopgoal' => 'Prjh Sustdevelopgoal',
            'prjh_projmodeofimplentmst_fk' => 'Prjh Projmodeofimplentmst Fk',
            'prjh_otherimplementation' => 'Prjh Otherimplementation',
            'prjh_interestfortender' => 'Prjh Interestfortender',
            'prjh_presentstatus' => 'Prjh Presentstatus',
            'prjh_presentstatusothers' => 'Prjh Presentstatusothers',
            'prjh_projmanpower' => 'Prjh Projmanpower',
            'prjh_projspend' => 'Prjh Projspend',
            'prjh_localrepresent' => 'Prjh Localrepresent',
            'prjh_projfundmst_fk' => 'Prjh Projfundmst Fk',
            'prjh_projotherfund' => 'Prjh Projotherfund',
            'prjh_fundpercent' => 'Prjh Fundpercent',
            'prjh_fundrefno' => 'Prjh Fundrefno',
            'prjh_debt' => 'Prjh Debt',
            'prjh_amtspentsofar' => 'Prjh Amtspentsofar',
            'prjh_equity' => 'Prjh Equity',
            'prjh_balanceamt' => 'Prjh Balanceamt',
            'prjh_debtequityratio' => 'Prjh Debtequityratio',
            'prjh_projownershipmst_fk' => 'Prjh Projownershipmst Fk',
            'prjh_benefeat' => 'Prjh Benefeat',
            'prjh_investorbenefits' => 'Prjh Investorbenefits',
            'prjh_projteam' => 'Prjh Projteam',
            'prjh_projpromoterdtls_fk' => 'Prjh Projpromoterdtls Fk',
            'prjh_aboutlocation' => 'Prjh Aboutlocation',
            'prjh_addressline' => 'Prjh Addressline',
            'prjh_latitude' => 'Prjh Latitude',
            'prjh_longitude' => 'Prjh Longitude',
            'prjh_statemst_fk' => 'Prjh Statemst Fk',
            'prjh_citymst_fk' => 'Prjh Citymst Fk',
            'prjh_district' => 'Prjh District',
            'prjh_projzonemst_fk' => 'Prjh Projzonemst Fk',
            'prjh_proptype' => 'Prjh Proptype',
            'prjh_natureofprop' => 'Prjh Natureofprop',
            'prjh_landarea' => 'Prjh Landarea',
            'prjh_unitmst_fk' => 'Prjh Unitmst Fk',
            'prjh_projcategory' => 'Prjh Projcategory',
            'prjh_contactinfo' => 'Prjh Contactinfo',
            'prjh_projinvproced' => 'Prjh Projinvproced',
            'prjh_website' => 'Prjh Website',
            'prjh_socialmedia' => 'Prjh Socialmedia',
            'prjh_finindicators' => 'Prjh Finindicators',
            'prjh_roi' => 'Prjh Roi',
            'prjh_riskfactors' => 'Prjh Riskfactors',
            'prjh_riskdisclosures' => 'Prjh Riskdisclosures',
            'prjh_projdiligenceform_fk' => 'Prjh Projdiligenceform Fk',
            'prjh_financialdocs' => 'Prjh Financialdocs',
            'prjh_createdon' => 'Prjh Createdon',
            'prjh_createdby' => 'Prjh Createdby',
            'prjh_createdbyipaddr' => 'Prjh Createdbyipaddr',
            'prjh_histcreatedon' => 'Prjh Histcreatedon',
            'prjh_submittedon' => 'Prjh Submittedon',
            'prjh_submittedby' => 'Prjh Submittedby',
            'prjh_submittedbyipaddr' => 'Prjh Submittedbyipaddr',
            'prjh_approvalno' => 'Prjh Approvalno',
            'prjh_apprdeclon' => 'Prjh Apprdeclon',
            'prjh_apprdeclby' => 'Prjh Apprdeclby',
            'prjh_apprdeclbyipaddr' => 'Prjh Apprdeclbyipaddr',
            'prjh_appldeccomments' => 'Prjh Appldeccomments',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjaccachievehstyTbls()
    {
        return $this->hasMany(ProjaccachievehstyTbl::className(), ['paah_projecthsty_fk' => 'projecthsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjhApprdeclby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjh_apprdeclby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjhCitymstFk()
    {
        return $this->hasOne(CitymstTbl::className(), ['CityMst_Pk' => 'prjh_citymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjhIndustrymstFk()
    {
        return $this->hasOne(IndustrymstTbl::className(), ['IndustryMst_Pk' => 'prjh_industrymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjhMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'prjh_memberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjhProjectdtlsFk()
    {
        return $this->hasOne(ProjectdtlsTbl::className(), ['projectdtls_pk' => 'prjh_projectdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjhProjecttmpFk()
    {
        return $this->hasOne(ProjecttmpTbl::className(), ['projecttmp_pk' => 'prjh_projecttmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjhSectormstFk()
    {
        return $this->hasOne(SectormstTbl::className(), ['SectorMst_Pk' => 'prjh_sectormst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjhStatemstFk()
    {
        return $this->hasOne(StatemstTbl::className(), ['StateMst_Pk' => 'prjh_statemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjhSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjh_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectpartnerhstyTbls()
    {
        return $this->hasMany(ProjectpartnerhstyTbl::className(), ['prjph_projecthsty_fk' => 'projecthsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjinvinfohstyTbls()
    {
        return $this->hasMany(ProjinvinfohstyTbl::className(), ['piih_projecthsty_fk' => 'projecthsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjinvmappinghstyTbls()
    {
        return $this->hasMany(ProjinvmappinghstyTbl::className(), ['pimh_projecthsty_fk' => 'projecthsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjtechdocumentshstyTbls()
    {
        return $this->hasMany(ProjtechdocumentshstyTbl::className(), ['ptdh_projecthsty_fk' => 'projecthsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjtechnicalhstyTbls()
    {
        return $this->hasMany(ProjtechnicalhstyTbl::className(), ['pth_projecthsty_fk' => 'projecthsty_pk']);
    }
}
