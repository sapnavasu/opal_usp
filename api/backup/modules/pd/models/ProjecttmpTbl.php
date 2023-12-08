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
 * This is the model class for table "projecttmp_tbl".
 *
 * @property int $projecttmp_pk Primary key
 * @property int $prjt_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property int $prjt_domain Projects created from 1 - Investment, 2 - Procurement
 * @property string $prjt_projectid Project id for internal reference
 * @property string $prjt_referenceno Project Reference No
 * @property string $prjt_projname Project Name
 * @property string $prjt_shortsummary Short summary about the Project
 * @property string $prjt_projdesc Project Description
 * @property int $prjt_sectormst_fk Reference to sectormst_tbl
 * @property int $prjt_industrymst_fk Reference to industrymst_tbl
 * @property int $prjt_isproposal 1- Yes. To tag if the project is converted from proposal
 * @property int $prjt_projtype Reference to projtypemst_tbl
 * @property string $prjt_otherprojtype If Project type is Others, then the value to be stored in this field
 * @property int $prjt_mfrtargmarkets 1 - Domestic, 2 - Export, 3 - Mixed
 * @property int $prjt_mfrprodlevels 1 - Complete Product, 2 - Value Chain Based
 * @property int $prjt_splcategory 1 - R&D, 2 - Innovation, 3 - Startup
 * @property string $prjt_projbanner Banner of the project. Reference to memcompfiledtls_tbl saved in comma separation
 * @property int $prjt_projcostvalue 1 - To be determined, 2 - Disclosed, 3 - Not Disclosed
 * @property string $prjt_projcost Project Cost
 * @property string $prjt_dateofinception Date of inception
 * @property string $prjt_plannedprojstrtdt Project Planned start date
 * @property string $prjt_plannedprojenddt Project Planned end date
 * @property int $prjt_projstage Reference to projstagemst_tbl
 * @property string $prjt_projdelayreason Reason for the delay in project
 * @property string $prjt_projscentralschememst_fk Reference to projschememst_tbl stored in comma separation for central scheme
 * @property string $prjt_projcentralschemeothers Value to be collected if project scheme is Central others
 * @property string $prjt_projstateschememst_fk Reference to projschememst_tbl stored in comma separation for state scheme
 * @property string $prjt_projstateschemeothers Value to be collected if project scheme is State others
 * @property int $prjt_projstatus 1 - Yet to Submit for Validation, 2 - Posted for Validation, 3 - Approved, 4 - Declined, 5 - Re-Submitted
 * @property array $prjt_sustdevelopgoal To save the sustainability development goal in JSON format
 * @property int $prjt_projmodeofimplentmst_fk Reference to projmodeofimplentmst_tbl
 * @property string $prjt_otherimplementation Value to be collected if mode of implementation is Others
 * @property int $prjt_interestfortender 1 - Yes, 2 - No
 * @property int $prjt_presentstatus 1 - Concession Agreement signed, 2 - Detailed Project Report (DPR) under progress, 3 - Financial Closure, 4 - Idea Proposal Stage, 5 - Machinery Supplier Appointed, 6 - MoU signed, 7 - Power purchase agreement (PPA) signed, 8 - PPP Contract Awarded, 9 - Prequalification bids invited, 10 - Project Allotted, 11 - RFPs invited, 12 - Statutory approvals received, 13 - Tender Re-Invited, 14 - Others
 * @property string $prjt_presentstatusothers Value to be collected if present status is others
 * @property int $prjt_projmanpower 1 - National, 2 - Expatriate, 3 - Both
 * @property int $prjt_projspend 1 - National, 2- International
 * @property string $prjt_localrepresent Local Representative
 * @property string $prjt_projfundmst_fk Reference to projfundmst_tbl
 * @property string $prjt_projotherfund Value to be collected if project funded by is Others
 * @property string $prjt_fundpercent Percentage of Fund
 * @property string $prjt_fundrefno Fund Reference No
 * @property string $prjt_debt Debt
 * @property string $prjt_amtspentsofar Amount Spent so far
 * @property string $prjt_equity Equity
 * @property string $prjt_balanceamt Balance Amount
 * @property string $prjt_debtequityratio Debt equity ratio
 * @property int $prjt_projownershipmst_fk Reference to projownershipmst_tbl
 * @property string $prjt_benefeat Project benefits & features
 * @property string $prjt_investorbenefits Investor benefits
 * @property string $prjt_projteam User Id in comma separation
 * @property string $prjt_projpromoterdtls_fk Reference to projpromoterdtls_tbl in comma separation
 * @property int $prjt_aboutlocation 1 - Finalized, 2 - Preference, 3 - Open(Govt. will decide)
 * @property string $prjt_addressline Address of project Location
 * @property string $prjt_latitude Latitude
 * @property string $prjt_longitude Longitude
 * @property int $prjt_statemst_fk Reference to statemst_tbl
 * @property int $prjt_citymst_fk Reference to citymst_tbl
 * @property string $prjt_district District
 * @property int $prjt_projzonemst_fk Reference to projzonemst_tbl
 * @property int $prjt_proptype Property Type. 1 - Residential, 2 - Industrial, 3 - Commercial
 * @property int $prjt_natureofprop 1 - Freehold, 2 - Restricted
 * @property int $prjt_landarea Land area of the project in numerals
 * @property int $prjt_unitmst_fk Reference to unitmst_tbl
 * @property int $prjt_projcategory 1 - Greenfield, 2 - Brownfield
 * @property string $prjt_contactinfo User Id in comma separation
 * @property string $prjt_projinvproced Project Investment Procedure
 * @property string $prjt_website Website of the project
 * @property array $prjt_socialmedia Social media to be stored as JSON value
 * @property string $prjt_finindicators Financial indicators
 * @property string $prjt_roi Return on investment
 * @property string $prjt_riskfactors Risk factors
 * @property string $prjt_riskdisclosures Risks & disclosures
 * @property int $prjt_projdiligenceform_fk Reference to projdiligenceform_tbl
 * @property string $prjt_financialdocs Reference to memcompfiledtls_tbl stored in comma separation
 * @property string $prjt_createdon First creation date
 * @property int $prjt_createdby
 * @property string $prjt_createdbyipaddr User IP Address
 * @property string $prjt_submittedon First Submission date
 * @property int $prjt_submittedby Submitted by user id
 * @property string $prjt_submittedbyipaddr IP Address of the user
 * @property string $prjt_updatedon Date of update
 * @property int $prjt_updatedby Updated by user id
 * @property string $prjt_updatedbyipaddr IP Address of the user
 * @property string $prjt_approvalno Approval No
 * @property string $prjt_apprdeclon Project Approval / Declined on
 * @property int $prjt_apprdeclby Approved / Declined by. Reference to usermst_tbl
 * @property string $prjt_apprdeclbyipaddr IP Address of the user
 * @property string $prjt_appldeccomments Comments if declined
 *
 * @property ProjaccachievetmpTbl[] $projaccachievetmpTbls
 * @property ProjacqlictmpTbl[] $projacqlictmpTbls
 * @property ProjectdtlsTbl[] $projectdtlsTbls
 * @property ProjecthstyTbl[] $projecthstyTbls
 * @property CitymstTbl $prjtCitymstFk
 * @property IndustrymstTbl $prjtIndustrymstFk
 * @property MemberregistrationmstTbl $prjtMemberregmstFk
 * @property SectormstTbl $prjtSectormstFk
 * @property StatemstTbl $prjtStatemstFk
 * @property UsermstTbl $prjtSubmittedby
 * @property UsermstTbl $prjtUpdatedby
 * @property ProjinvinfotmpTbl[] $projinvinfotmpTbls
 * @property ProjinvmappingtmpTbl[] $projinvmappingtmpTbls
 * @property ProjtechdocumentstmpTbl[] $projtechdocumentstmpTbls
 * @property ProjtechnicaltmpTbl[] $projtechnicaltmpTbls
 */
class ProjecttmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projecttmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prjt_memberregmst_fk', 'prjt_referenceno', 'prjt_projname', 'prjt_projstatus', 'prjt_createdon', 'prjt_createdby'], 'required'],
            [['prjt_memberregmst_fk', 'prjt_domain', 'prjt_sectormst_fk', 'prjt_industrymst_fk', 'prjt_isproposal', 'prjt_projtype', 'prjt_mfrtargmarkets', 'prjt_mfrprodlevels', 'prjt_splcategory', 'prjt_projcostvalue', 'prjt_projstage', 'prjt_projstatus', 'prjt_projmodeofimplentmst_fk', 'prjt_interestfortender', 'prjt_presentstatus', 'prjt_projmanpower', 'prjt_projspend', 'prjt_projownershipmst_fk', 'prjt_aboutlocation', 'prjt_statemst_fk', 'prjt_citymst_fk', 'prjt_projzonemst_fk', 'prjt_proptype', 'prjt_natureofprop', 'prjt_landarea', 'prjt_unitmst_fk', 'prjt_projcategory', 'prjt_projdiligenceform_fk', 'prjt_createdby', 'prjt_submittedby', 'prjt_updatedby', 'prjt_apprdeclby'], 'integer'],
            [['prjt_shortsummary', 'prjt_projdesc', 'prjt_otherprojtype', 'prjt_projbanner', 'prjt_projdelayreason', 'prjt_projscentralschememst_fk', 'prjt_projcentralschemeothers', 'prjt_projstateschememst_fk', 'prjt_projstateschemeothers', 'prjt_otherimplementation', 'prjt_presentstatusothers', 'prjt_localrepresent', 'prjt_projfundmst_fk', 'prjt_projotherfund', 'prjt_benefeat', 'prjt_investorbenefits', 'prjt_projteam', 'prjt_projpromoterdtls_fk', 'prjt_addressline', 'prjt_contactinfo', 'prjt_projinvproced', 'prjt_finindicators', 'prjt_roi', 'prjt_riskfactors', 'prjt_riskdisclosures', 'prjt_financialdocs', 'prjt_appldeccomments'], 'string'],
            [['prjt_projcost', 'prjt_fundpercent', 'prjt_debt', 'prjt_amtspentsofar', 'prjt_equity', 'prjt_balanceamt'], 'number'],
            [['prjt_dateofinception', 'prjt_plannedprojstrtdt', 'prjt_plannedprojenddt', 'prjt_sustdevelopgoal', 'prjt_socialmedia', 'prjt_createdon', 'prjt_submittedon', 'prjt_updatedon', 'prjt_apprdeclon'], 'safe'],
            [['prjt_projectid', 'prjt_referenceno', 'prjt_debtequityratio'], 'string', 'max' => 20],
            [['prjt_projname'], 'string', 'max' => 250],
            [['prjt_fundrefno', 'prjt_district'], 'string', 'max' => 30],
            [['prjt_latitude'], 'string', 'max' => 12],
            [['prjt_longitude'], 'string', 'max' => 13],
            [['prjt_website'], 'string', 'max' => 100],
            [['prjt_createdbyipaddr', 'prjt_submittedbyipaddr', 'prjt_updatedbyipaddr', 'prjt_approvalno', 'prjt_apprdeclbyipaddr'], 'string', 'max' => 50],
            [['prjt_citymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CitymstTbl::className(), 'targetAttribute' => ['prjt_citymst_fk' => 'CityMst_Pk']],
            [['prjt_industrymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IndustrymstTbl::className(), 'targetAttribute' => ['prjt_industrymst_fk' => 'IndustryMst_Pk']],
            [['prjt_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['prjt_memberregmst_fk' => 'MemberRegMst_Pk']],
            [['prjt_sectormst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => SectormstTbl::className(), 'targetAttribute' => ['prjt_sectormst_fk' => 'SectorMst_Pk']],
            [['prjt_statemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StatemstTbl::className(), 'targetAttribute' => ['prjt_statemst_fk' => 'StateMst_Pk']],
            [['prjt_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjt_submittedby' => 'UserMst_Pk']],
            [['prjt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projecttmp_pk' => 'Projecttmp Pk',
            'prjt_memberregmst_fk' => 'Prjt Memberregmst Fk',
            'prjt_domain' => 'Prjt Domain',
            'prjt_projectid' => 'Prjt Projectid',
            'prjt_referenceno' => 'Prjt Referenceno',
            'prjt_projname' => 'Prjt Projname',
            'prjt_shortsummary' => 'Prjt Shortsummary',
            'prjt_projdesc' => 'Prjt Projdesc',
            'prjt_sectormst_fk' => 'Prjt Sectormst Fk',
            'prjt_industrymst_fk' => 'Prjt Industrymst Fk',
            'prjt_isproposal' => 'Prjt Isproposal',
            'prjt_projtype' => 'Prjt Projtype',
            'prjt_otherprojtype' => 'Prjt Otherprojtype',
            'prjt_mfrtargmarkets' => 'Prjt Mfrtargmarkets',
            'prjt_mfrprodlevels' => 'Prjt Mfrprodlevels',
            'prjt_splcategory' => 'Prjt Splcategory',
            'prjt_projbanner' => 'Prjt Projbanner',
            'prjt_projcostvalue' => 'Prjt Projcostvalue',
            'prjt_projcost' => 'Prjt Projcost',
            'prjt_dateofinception' => 'Prjt Dateofinception',
            'prjt_plannedprojstrtdt' => 'Prjt Plannedprojstrtdt',
            'prjt_plannedprojenddt' => 'Prjt Plannedprojenddt',
            'prjt_projstage' => 'Prjt Projstage',
            'prjt_projdelayreason' => 'Prjt Projdelayreason',
            'prjt_projscentralschememst_fk' => 'Prjt Projscentralschememst Fk',
            'prjt_projcentralschemeothers' => 'Prjt Projcentralschemeothers',
            'prjt_projstateschememst_fk' => 'Prjt Projstateschememst Fk',
            'prjt_projstateschemeothers' => 'Prjt Projstateschemeothers',
            'prjt_projstatus' => 'Prjt Projstatus',
            'prjt_sustdevelopgoal' => 'Prjt Sustdevelopgoal',
            'prjt_projmodeofimplentmst_fk' => 'Prjt Projmodeofimplentmst Fk',
            'prjt_otherimplementation' => 'Prjt Otherimplementation',
            'prjt_interestfortender' => 'Prjt Interestfortender',
            'prjt_presentstatus' => 'Prjt Presentstatus',
            'prjt_presentstatusothers' => 'Prjt Presentstatusothers',
            'prjt_projmanpower' => 'Prjt Projmanpower',
            'prjt_projspend' => 'Prjt Projspend',
            'prjt_localrepresent' => 'Prjt Localrepresent',
            'prjt_projfundmst_fk' => 'Prjt Projfundmst Fk',
            'prjt_projotherfund' => 'Prjt Projotherfund',
            'prjt_fundpercent' => 'Prjt Fundpercent',
            'prjt_fundrefno' => 'Prjt Fundrefno',
            'prjt_debt' => 'Prjt Debt',
            'prjt_amtspentsofar' => 'Prjt Amtspentsofar',
            'prjt_equity' => 'Prjt Equity',
            'prjt_balanceamt' => 'Prjt Balanceamt',
            'prjt_debtequityratio' => 'Prjt Debtequityratio',
            'prjt_projownershipmst_fk' => 'Prjt Projownershipmst Fk',
            'prjt_benefeat' => 'Prjt Benefeat',
            'prjt_investorbenefits' => 'Prjt Investorbenefits',
            'prjt_projteam' => 'Prjt Projteam',
            'prjt_projpromoterdtls_fk' => 'Prjt Projpromoterdtls Fk',
            'prjt_aboutlocation' => 'Prjt Aboutlocation',
            'prjt_addressline' => 'Prjt Addressline',
            'prjt_latitude' => 'Prjt Latitude',
            'prjt_longitude' => 'Prjt Longitude',
            'prjt_statemst_fk' => 'Prjt Statemst Fk',
            'prjt_citymst_fk' => 'Prjt Citymst Fk',
            'prjt_district' => 'Prjt District',
            'prjt_projzonemst_fk' => 'Prjt Projzonemst Fk',
            'prjt_proptype' => 'Prjt Proptype',
            'prjt_natureofprop' => 'Prjt Natureofprop',
            'prjt_landarea' => 'Prjt Landarea',
            'prjt_unitmst_fk' => 'Prjt Unitmst Fk',
            'prjt_projcategory' => 'Prjt Projcategory',
            'prjt_contactinfo' => 'Prjt Contactinfo',
            'prjt_projinvproced' => 'Prjt Projinvproced',
            'prjt_website' => 'Prjt Website',
            'prjt_socialmedia' => 'Prjt Socialmedia',
            'prjt_finindicators' => 'Prjt Finindicators',
            'prjt_roi' => 'Prjt Roi',
            'prjt_riskfactors' => 'Prjt Riskfactors',
            'prjt_riskdisclosures' => 'Prjt Riskdisclosures',
            'prjt_projdiligenceform_fk' => 'Prjt Projdiligenceform Fk',
            'prjt_financialdocs' => 'Prjt Financialdocs',
            'prjt_createdon' => 'Prjt Createdon',
            'prjt_createdby' => 'Prjt Createdby',
            'prjt_createdbyipaddr' => 'Prjt Createdbyipaddr',
            'prjt_submittedon' => 'Prjt Submittedon',
            'prjt_submittedby' => 'Prjt Submittedby',
            'prjt_submittedbyipaddr' => 'Prjt Submittedbyipaddr',
            'prjt_updatedon' => 'Prjt Updatedon',
            'prjt_updatedby' => 'Prjt Updatedby',
            'prjt_updatedbyipaddr' => 'Prjt Updatedbyipaddr',
            'prjt_approvalno' => 'Prjt Approvalno',
            'prjt_apprdeclon' => 'Prjt Apprdeclon',
            'prjt_apprdeclby' => 'Prjt Apprdeclby',
            'prjt_apprdeclbyipaddr' => 'Prjt Apprdeclbyipaddr',
            'prjt_appldeccomments' => 'Prjt Appldeccomments',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjaccachievetmpTbls()
    {
        return $this->hasMany(ProjaccachievetmpTbl::className(), ['paat_projecttmp_fk' => 'projecttmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjacqlictmpTbls()
    {
        return $this->hasMany(ProjacqlictmpTbl::className(), ['palt_projecttmp_fk' => 'projecttmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectdtlsTbls()
    {
        return $this->hasMany(ProjectdtlsTbl::className(), ['prjd_projecttmp_fk' => 'projecttmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjecthstyTbls()
    {
        return $this->hasMany(ProjecthstyTbl::className(), ['prjh_projecttmp_fk' => 'projecttmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjtCitymstFk()
    {
        return $this->hasOne(CitymstTbl::className(), ['CityMst_Pk' => 'prjt_citymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjtIndustrymstFk()
    {
        return $this->hasOne(IndustrymstTbl::className(), ['IndustryMst_Pk' => 'prjt_industrymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjtMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'prjt_memberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjtSectormstFk()
    {
        return $this->hasOne(SectormstTbl::className(), ['SectorMst_Pk' => 'prjt_sectormst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjtStatemstFk()
    {
        return $this->hasOne(StatemstTbl::className(), ['StateMst_Pk' => 'prjt_statemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjtSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjt_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjt_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjinvinfotmpTbls()
    {
        return $this->hasMany(ProjinvinfotmpTbl::className(), ['piit_projecttmp_fk' => 'projecttmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjinvmappingtmpTbls()
    {
        return $this->hasMany(ProjinvmappingtmpTbl::className(), ['pimt_projecttmp_fk' => 'projecttmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjtechdocumentstmpTbls()
    {
        return $this->hasMany(ProjtechdocumentstmpTbl::className(), ['ptdt_projecttmp_fk' => 'projecttmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjtechnicaltmpTbls()
    {
        return $this->hasMany(ProjtechnicaltmpTbl::className(), ['ptt_projecttmp_fk' => 'projecttmp_pk']);
    }
}