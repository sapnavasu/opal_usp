<?php

namespace app\models;

use api\components\Common;
use api\components\Vehicle;
use api\modules\drv\models\MemcompfiledtlsTbl;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "opalmemberregmst_tbl".
 *
 * @property int $opalmemberregmst_pk primary key
 * @property int $omrm_stkholdertypmst_fk reference to stkholdertypmst_tb
 * @property int $omrm_intendforregistration intend for registration 1-opal star, 2.technical assessment, 3-both
 * @property int $omrm_officetype 1-Main office, 2-Branch office
 * @property string $omrm_companyname_en company name english
 * @property string $omrm_companyname_ar company name arabic
 * @property int $omrm_opalmoherigradingmst_pk refer to opalmoherigrademst_tbl
 * @property string $omrm_memberStatus a' - active,'i' - inactive(cancel by user), 'd' -deactivate
 * @property string $omrm_branch_en Centre name english
 * @property string $omrm_branch_ar Centre name arabic
 * @property string $omrm_branchname_en branch office name english
 * @property string $omrm_branchname_ar branch office name arabic
 * @property string $omrm_crnumber company registration number
 * @property int $omrm_cractivity refer to opalmemcompfiledtls_tbl
 * @property string $omrm_crregistrationexpiry company registration expiry date
 * @property string $omrm_tpname_en
 * @property string $omrm_tpname_ar
 * @property string $omrm_gmname
 * @property string $omrm_gmemailid
 * @property int $omrm_gmmobileno
 * @property string $omrm_opalmembershipregnumber opal membership register number
 * @property string $omrm_opalmembershipregexpiredate opal membership expiry date
 * @property string $omrm_opalstarregdate opal star registration date
 * @property string $omrm_opaltechassregdate technical assessment registration date
 * @property int $omrm_opalcountrymst_fk reference to opalcountrymst_tbl
 * @property int $omrm_opalstatemst_fk reference to opalstatemst_tbl
 * @property int $omrm_opalcitymst_fk reference to opalcitymst_tbl
 * @property int $omrm_cmplogo refer to memcompfiledtls_pk
 * @property int $omrm_cmpbanner Reference to memcompfiledtls_pk
 * @property string $omrm_regcode
 * @property string $omrm_regcancelon
 * @property string $omrm_address1
 * @property string $omrm_address2
 * @property string $omrm_ipaddr
 * @property string $omrm_browser
 * @property string $omrm_createdon datetime of creation
 * @property int $omrm_createdby reference to opalusermst_tbl
 * @property string $omrm_createdbyipaddr created by user's ip address
 * @property string $omrm_updatedon datetime of updation
 * @property int $omrm_updatedby reference to opalusermst_tbl
 * @property string $omrm_updatedbyipaddr updated by user's ip address
 *
 * @property AppcompanydtlshstyTbl[] $appcompanydtlshstyTbls
 * @property AppcompanydtlsmainTbl[] $appcompanydtlsmainTbls
 * @property AppcompanydtlstmpTbl[] $appcompanydtlstmpTbls
 * @property AppcoursedtlshstyTbl[] $appcoursedtlshstyTbls
 * @property AppcoursedtlsmainTbl[] $appcoursedtlsmainTbls
 * @property AppdocsubmissionhstyTbl[] $appdocsubmissionhstyTbls
 * @property AppdocsubmissionmainTbl[] $appdocsubmissionmainTbls
 * @property AppdocsubmissiontmpTbl[] $appdocsubmissiontmpTbls
 * @property AppinstinfohstyTbl[] $appinstinfohstyTbls
 * @property AppinstinfomainTbl[] $appinstinfomainTbls
 * @property AppinstinfotmpTbl[] $appinstinfotmpTbls
 * @property AppintrecoghstyTbl[] $appintrecoghstyTbls
 * @property AppintrecogmainTbl[] $appintrecogmainTbls
 * @property AppintrecogtmpTbl[] $appintrecogtmpTbls
 * @property ApplicationdtlshstyTbl[] $applicationdtlshstyTbls
 * @property ApplicationdtlsmainTbl[] $applicationdtlsmainTbls
 * @property ApplicationdtlstmpTbl[] $applicationdtlstmpTbls
 * @property AppoffercoursehstyTbl[] $appoffercoursehstyTbls
 * @property AppoffercoursemainTbl[] $appoffercoursemainTbls
 * @property AppoffercoursetmpTbl[] $appoffercoursetmpTbls
 * @property AppoprcontracthstyTbl[] $appoprcontracthstyTbls
 * @property AppoprcontractmainTbl[] $appoprcontractmainTbls
 * @property AppoprcontracttmpTbl[] $appoprcontracttmpTbls
 * @property ApppymtdtlshstyTbl[] $apppymtdtlshstyTbls
 * @property ApppymtdtlsmainTbl[] $apppymtdtlsmainTbls
 * @property ApppymtdtlstmpTbl[] $apppymtdtlstmpTbls
 * @property ApppytminvoicedtlsTbl[] $apppytminvoicedtlsTbls
 * @property AppstaffinfohstyTbl[] $appstaffinfohstyTbls
 * @property AppstaffinfomainTbl[] $appstaffinfomainTbls
 * @property AppstaffinfotmpTbl[] $appstaffinfotmpTbls
 * @property AppstaffscheddtlsTbl[] $appstaffscheddtlsTbls
 * @property AssessmentmstTbl[] $assessmentmstTbls
 * @property AuditscheddtlsTbl[] $auditscheddtlsTbls
 * @property BatchmgmtdtlsTbl[] $batchmgmtdtlsTbls
 * @property BatchmgmtdtlshstyTbl[] $batchmgmtdtlshstyTbls
 * @property FeedbackmstTbl[] $feedbackmstTbls
 * @property LearnerreghrddtlsTbl[] $learnerreghrddtlsTbls
 * @property LearnerreghrddtlshstyTbl[] $learnerreghrddtlshstyTbls
 * @property MemcompfiledtlsTbl[] $memcompfiledtlsTbls
 * @property OpalcitymstTbl $omrmOpalcitymstFk
 * @property MemcompfiledtlsTbl $omrmCmplogo
 * @property OpalcountrymstTbl $omrmOpalcountrymstFk
 * @property MemcompfiledtlsTbl $omrmCractivity
 * @property OpalmoherigrademstTbl $omrmOpalmoherigradingmstPk
 * @property OpalstatemstTbl $omrmOpalstatemstFk
 * @property OpalstkholdertypmstTbl $omrmStkholdertypmstFk
 * @property OpalusermstTbl[] $opalusermstTbls
 * @property OpalusermsthstyTbl[] $opalusermsthstyTbls
 * @property StaffinforepoTbl[] $staffinforepoTbls
 * @property StandardcoursemstTbl[] $standardcoursemstTbls
 * @property StandardcoursemsthstyTbl[] $standardcoursemsthstyTbls
 */
class OpalmemberregmstTbl extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalmemberregmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['omrm_stkholdertypmst_fk', 'omrm_companyname_en', 'omrm_opalmembershipregnumber', 'omrm_opalmembershipregexpiredate', 'omrm_opalcountrymst_fk', 'omrm_opalstatemst_fk', 'omrm_opalcitymst_fk', 'omrm_address1'], 'required'],
            [['omrm_stkholdertypmst_fk', 'omrm_intendforregistration', 'omrm_officetype', 'omrm_opalmoherigradingmst_pk', 'omrm_cractivity', 'omrm_gmmobileno', 'omrm_opalcountrymst_fk', 'omrm_opalstatemst_fk', 'omrm_opalcitymst_fk', 'omrm_cmplogo', 'omrm_cmpbanner', 'omrm_createdby', 'omrm_updatedby'], 'integer'],
            [['omrm_memberStatus', 'omrm_tpname_en', 'omrm_tpname_ar', 'omrm_gmname', 'omrm_address1', 'omrm_address2'], 'string'],
            [['omrm_crregistrationexpiry', 'omrm_opalmembershipregexpiredate', 'omrm_opalstarregdate', 'omrm_opaltechassregdate', 'omrm_regcancelon', 'omrm_createdon', 'omrm_updatedon'], 'safe'],
            [['omrm_companyname_en', 'omrm_companyname_ar', 'omrm_branch_en', 'omrm_branch_ar', 'omrm_branchname_en', 'omrm_branchname_ar', 'omrm_crnumber'], 'string', 'max' => 250],
            [['omrm_gmemailid', 'omrm_opalmembershipregnumber'], 'string', 'max' => 45],
            [['omrm_regcode', 'omrm_browser', 'omrm_createdbyipaddr', 'omrm_updatedbyipaddr'], 'string', 'max' => 50],
            [['omrm_ipaddr'], 'string', 'max' => 15],
            [['omrm_opalcitymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalcitymstTbl::className(), 'targetAttribute' => ['omrm_opalcitymst_fk' => 'opalcitymst_pk']],
            [['omrm_cmplogo'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompfiledtlsTbl::className(), 'targetAttribute' => ['omrm_cmplogo' => 'memcompfiledtls_pk']],
            [['omrm_opalcountrymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalcountrymstTbl::className(), 'targetAttribute' => ['omrm_opalcountrymst_fk' => 'opalcountrymst_pk']],
            [['omrm_cractivity'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompfiledtlsTbl::className(), 'targetAttribute' => ['omrm_cractivity' => 'memcompfiledtls_pk']],
            [['omrm_opalmoherigradingmst_pk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmoherigrademstTbl::className(), 'targetAttribute' => ['omrm_opalmoherigradingmst_pk' => 'opalmoherigradingmst_pk']],
            [['omrm_opalstatemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalstatemstTbl::className(), 'targetAttribute' => ['omrm_opalstatemst_fk' => 'opalstatemst_pk']],
            [['omrm_stkholdertypmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalstkholdertypmstTbl::className(), 'targetAttribute' => ['omrm_stkholdertypmst_fk' => 'opalstkholdertypmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalmemberregmst_pk' => 'Opalmemberregmst Pk',
            'omrm_stkholdertypmst_fk' => 'Omrm Stkholdertypmst Fk',
            'omrm_intendforregistration' => 'Omrm Intendforregistration',
            'omrm_officetype' => 'Omrm Officetype',
            'omrm_companyname_en' => 'Omrm Companyname En',
            'omrm_companyname_ar' => 'Omrm Companyname Ar',
            'omrm_opalmoherigradingmst_pk' => 'Omrm Opalmoherigradingmst Pk',
            'omrm_memberStatus' => 'Omrm Member Status',
            'omrm_branch_en' => 'Omrm Branch En',
            'omrm_branch_ar' => 'Omrm Branch Ar',
            'omrm_branchname_en' => 'Omrm Branchname En',
            'omrm_branchname_ar' => 'Omrm Branchname Ar',
            'omrm_crnumber' => 'Omrm Crnumber',
            'omrm_cractivity' => 'Omrm Cractivity',
            'omrm_crregistrationexpiry' => 'Omrm Crregistrationexpiry',
            'omrm_tpname_en' => 'Omrm Tpname En',
            'omrm_tpname_ar' => 'Omrm Tpname Ar',
            'omrm_gmname' => 'Omrm Gmname',
            'omrm_gmemailid' => 'Omrm Gmemailid',
            'omrm_gmmobileno' => 'Omrm Gmmobileno',
            'omrm_opalmembershipregnumber' => 'Omrm Opalmembershipregnumber',
            'omrm_opalmembershipregexpiredate' => 'Omrm Opalmembershipregexpiredate',
            'omrm_opalstarregdate' => 'Omrm Opalstarregdate',
            'omrm_opaltechassregdate' => 'Omrm Opaltechassregdate',
            'omrm_opalcountrymst_fk' => 'Omrm Opalcountrymst Fk',
            'omrm_opalstatemst_fk' => 'Omrm Opalstatemst Fk',
            'omrm_opalcitymst_fk' => 'Omrm Opalcitymst Fk',
            'omrm_cmplogo' => 'Omrm Cmplogo',
            'omrm_cmpbanner' => 'Omrm Cmpbanner',
            'omrm_regcode' => 'Omrm Regcode',
            'omrm_regcancelon' => 'Omrm Regcancelon',
            'omrm_address1' => 'Omrm Address1',
            'omrm_address2' => 'Omrm Address2',
            'omrm_ipaddr' => 'Omrm Ipaddr',
            'omrm_browser' => 'Omrm Browser',
            'omrm_createdon' => 'Omrm Createdon',
            'omrm_createdby' => 'Omrm Createdby',
            'omrm_createdbyipaddr' => 'Omrm Createdbyipaddr',
            'omrm_updatedon' => 'Omrm Updatedon',
            'omrm_updatedby' => 'Omrm Updatedby',
            'omrm_updatedbyipaddr' => 'Omrm Updatedbyipaddr',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAppcompanydtlshstyTbls()
    {
        return $this->hasMany(AppcompanydtlshstyTbl::className(), ['acdh_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppcompanydtlsmainTbls()
    {
        return $this->hasMany(AppcompanydtlsmainTbl::className(), ['acdm_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppcompanydtlstmpTbls()
    {
        return $this->hasMany(AppcompanydtlstmpTbl::className(), ['acdt_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppcoursedtlshstyTbls()
    {
        return $this->hasMany(AppcoursedtlshstyTbl::className(), ['appcdh_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppcoursedtlsmainTbls()
    {
        return $this->hasMany(AppcoursedtlsmainTbl::className(), ['appcdm_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppdocsubmissionhstyTbls()
    {
        return $this->hasMany(AppdocsubmissionhstyTbl::className(), ['appdsh_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppdocsubmissionmainTbls()
    {
        return $this->hasMany(AppdocsubmissionmainTbl::className(), ['appdsm_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppdocsubmissiontmpTbls()
    {
        return $this->hasMany(AppdocsubmissiontmpTbl::className(), ['appdst_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppinstinfohstyTbls()
    {
        return $this->hasMany(AppinstinfohstyTbl::className(), ['appiih_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppinstinfomainTbls()
    {
        return $this->hasMany(AppinstinfomainTbl::className(), ['appiim_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppinstinfotmpTbls()
    {
        return $this->hasMany(AppinstinfotmpTbl::className(), ['appiit_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppintrecoghstyTbls()
    {
        return $this->hasMany(AppintrecoghstyTbl::className(), ['appintih_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppintrecogmainTbls()
    {
        return $this->hasMany(AppintrecogmainTbl::className(), ['appintim_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppintrecogtmpTbls()
    {
        return $this->hasMany(AppintrecogtmpTbl::className(), ['appintit_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getApplicationdtlshstyTbls()
    {
        return $this->hasMany(ApplicationdtlshstyTbl::className(), ['appdh_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getApplicationdtlsmainTbls()
    {
        return $this->hasMany(ApplicationdtlsmainTbl::className(), ['appdm_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getApplicationdtlstmpTbls()
    {
        return $this->hasMany(ApplicationdtlstmpTbl::className(), ['appdt_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppoffercoursehstyTbls()
    {
        return $this->hasMany(AppoffercoursehstyTbl::className(), ['appoch_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppoffercoursemainTbls()
    {
        return $this->hasMany(AppoffercoursemainTbl::className(), ['appocm_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppoffercoursetmpTbls()
    {
        return $this->hasMany(AppoffercoursetmpTbl::className(), ['appoct_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppoprcontracthstyTbls()
    {
        return $this->hasMany(AppoprcontracthstyTbl::className(), ['appoprch_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppoprcontractmainTbls()
    {
        return $this->hasMany(AppoprcontractmainTbl::className(), ['appoprcm_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppoprcontracttmpTbls()
    {
        return $this->hasMany(AppoprcontracttmpTbl::className(), ['appoprct_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getApppymtdtlshstyTbls()
    {
        return $this->hasMany(ApppymtdtlshstyTbl::className(), ['apppdh_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getApppymtdtlsmainTbls()
    {
        return $this->hasMany(ApppymtdtlsmainTbl::className(), ['apppdm_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getApppymtdtlstmpTbls()
    {
        return $this->hasMany(ApppymtdtlstmpTbl::className(), ['apppdt_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getApppytminvoicedtlsTbls()
    {
        return $this->hasMany(ApppytminvoicedtlsTbl::className(), ['apid_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppstaffinfohstyTbls()
    {
        return $this->hasMany(AppstaffinfohstyTbl::className(), ['appsih_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppstaffinfomainTbls()
    {
        return $this->hasMany(AppstaffinfomainTbl::className(), ['appsim_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppstaffinfotmpTbls()
    {
        return $this->hasMany(AppstaffinfotmpTbl::className(), ['appsit_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppstaffscheddtlsTbls()
    {
        return $this->hasMany(AppstaffscheddtlsTbl::className(), ['assd_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAssessmentmstTbls()
    {
        return $this->hasMany(AssessmentmstTbl::className(), ['asmtm_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuditscheddtlsTbls()
    {
        return $this->hasMany(AuditscheddtlsTbl::className(), ['asd_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getBatchmgmtdtlsTbls()
    {
        return $this->hasMany(BatchmgmtdtlsTbl::className(), ['bmd_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getBatchmgmtdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtdtlshstyTbl::className(), ['bmh_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getFeedbackmstTbls()
    {
        return $this->hasMany(FeedbackmstTbl::className(), ['fdbkm_OpalmemberRegMst_FK' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getLearnerreghrddtlsTbls()
    {
        return $this->hasMany(LearnerreghrddtlsTbl::className(), ['lrhd_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getLearnerreghrddtlshstyTbls()
    {
        return $this->hasMany(LearnerreghrddtlshstyTbl::className(), ['lrhh_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMemcompfiledtlsTbls()
    {
        return $this->hasMany(MemcompfiledtlsTbl::className(), ['mcfd_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOmrmOpalcitymstFk()
    {
        return $this->hasOne(OpalcitymstTbl::className(), ['opalcitymst_pk' => 'omrm_opalcitymst_fk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOmrmCmplogo()
    {
        return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'omrm_cmplogo']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOmrmOpalcountrymstFk()
    {
        return $this->hasOne(OpalcountrymstTbl::className(), ['opalcountrymst_pk' => 'omrm_opalcountrymst_fk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOmrmCractivity()
    {
        return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'omrm_cractivity']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOmrmOpalmoherigradingmstPk()
    {
        return $this->hasOne(OpalmoherigrademstTbl::className(), ['opalmoherigradingmst_pk' => 'omrm_opalmoherigradingmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOmrmOpalstatemstFk()
    {
        return $this->hasOne(OpalstatemstTbl::className(), ['opalstatemst_pk' => 'omrm_opalstatemst_fk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOmrmStkholdertypmstFk()
    {
        return $this->hasOne(OpalstkholdertypmstTbl::className(), ['opalstkholdertypmst_pk' => 'omrm_stkholdertypmst_fk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOpalusermstTbls()
    {
        return $this->hasMany(OpalusermstTbl::className(), ['oum_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOpalusermsthstyTbls()
    {
        return $this->hasMany(OpalusermsthstyTbl::className(), ['oumh_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getStaffinforepoTbls()
    {
        return $this->hasMany(StaffinforepoTbl::className(), ['sir_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getStandardcoursemstTbls()
    {
        return $this->hasMany(StandardcoursemstTbl::className(), ['scm_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getStandardcoursemsthstyTbls()
    {
        return $this->hasMany(StandardcoursemsthstyTbl::className(), ['scmh_opalmemberregmst_fk' => 'opalmemberregmst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return OpalmemberregmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalmemberregmstTblQuery(get_called_class());
    }



    public static function saveCentreDtls($requestdata){
     
        $model = new OpalmemberregmstTbl();
        $model->omrm_stkholdertypmst_fk = $requestdata['stkholder_type'];
        $model->omrm_intendforregistration = $requestdata['registeras'];
        $model->omrm_projectmst_fk = $requestdata['projectpk'];
        $model->omrm_officetype = $requestdata['branchtype'];
        $model->omrm_companyname_en = !empty($requestdata['company_name_en']) ? $requestdata['company_name_en']: null;
        $model->omrm_companyname_ar = !empty($requestdata['company_name_ar']) ? $requestdata['company_name_ar']: null;
        $model->omrm_opalmoherigradingmst_pk = $requestdata['moheri_grade'];
        $model->omrm_memberStatus = 'I';
        $model->omrm_tpname_en = !empty($requestdata['tp_name_en']) ? $requestdata['tp_name_en']: null;
        $model->omrm_tpname_ar = !empty($requestdata['tp_name_ar']) ? $requestdata['tp_name_ar']: null;
        $model->omrm_branch_en =!empty($requestdata['branch_name_en']) ? $requestdata['branch_name_en']: null;
        $model->omrm_branch_ar = !empty($requestdata['branch_name_ar']) ? $requestdata['branch_name_ar']: null;
        $model->omrm_branchname_en = !empty($requestdata['branchname_en']) ? $requestdata['branchname_en']: null;
        $model->omrm_branchname_ar = !empty($requestdata['branchname_ar']) ? $requestdata['branchname_ar']: null;

        $model->omrm_gmname = !empty($requestdata['gm_name']) ? $requestdata['gm_name']: null;
        $model->omrm_gmemailid =!empty($requestdata['gm_emailid']) ? $requestdata['gm_emailid']: null;
        $model->omrm_gmmobileno = !empty($requestdata['gm_mobnum']) ? $requestdata['gm_mobnum']: null;
        $model->omrm_crnumber = !empty(trim($requestdata['comp_cr_no'])) ? trim($requestdata['comp_cr_no']): null;
        $model->omrm_crregistrationexpiry = date("Y-m-d H:i:s", strtotime($requestdata['comp_cr_expiry']));
        $model->omrm_opalmembershipregnumber = $requestdata['opal_memb_no'];
        $model->omrm_opalmembershipregexpiredate = date("Y-m-d H:i:s", strtotime($requestdata['opal_memb_expiry']));
        if($model->omrm_intendforregistration == 1)
        {
           $model->omrm_opalstarregdate = date('Y-m-d H:i:s'); 
        }
        else if($model->omrm_intendforregistration == 2)
        {
            $model->omrm_opaltechassregdate = date('Y-m-d H:i:s'); 
        }
        $model->omrm_opalcountrymst_fk = 1;
        $model->omrm_opalstatemst_fk = $requestdata['governorate'];
        $model->omrm_opalcitymst_fk = $requestdata['wilayat'];
        $model->omrm_regcode = self::newOpalRegistrationNo($model->omrm_stkholdertypmst_fk ,$model->omrm_opalmembershipregnumber );
        $model->omrm_address1 = $requestdata['address1'];
        $model->omrm_address2  = $requestdata['address2'];
        $model->omrm_ipaddr = Common::getIpAddress();   
        $getbrowser = Common::getBrowser($_SERVER['HTTP_USER_AGENT']);
        $model->omrm_browser = $getbrowser['name'] . '***' . $getbrowser['version'] . '***' . $getbrowser['platform'];
        $model->omrm_createdon = date('Y-m-d H:i:s'); 
        if($model->save())
        {
            return $model->opalmemberregmst_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
        
         
    }
    
     public function newOpalRegistrationNo($stktyp , $opalmemno) {
         
         if($stktyp == 2)
         {
             $stakeholder = 'CNT';
         }
        
         
        $opalcode = $stakeholder.$opalmemno;
        
        return $opalcode ;
    }
    
    public static function getLastJSRSRegistrationNo($queryFor = null , $stktyp=2 , $regtype =1) {
        if($queryFor == 'NOT NULL') {
            return self::find()
                    ->select(['omrm_regcode'])
                    ->where('omrm_regcode is not NULL')
                    ->andWhere('omrm_stkholdertypmst_fk = '.$stktyp)
                    ->andWhere('omrm_intendforregistration = '.$regtype)
                    ->orderBy(['opalmemberregmst_pk' => SORT_DESC])
                    ->limit(1)
                    ->asArray()->one();
        } else {
            return self::find()
                    ->select(['omrm_regcode'])
                    ->where('omrm_stkholdertypmst_fk = '.$stktyp)
                    ->andWhere('omrm_intendforregistration ='.$regtype)
                    ->orderBy(['opalmemberregmst_pk' => SORT_DESC])
                    ->limit(1)
                    ->asArray()->one();
        }
    }
    
    public static function checkIsCompanyNameAlreadyExists($dataToCheck,$regpk = '',$stkholderType = ''){
        return self::find()
                ->where('lower(omrm_companyname_en) = :compname',[':compname' => $dataToCheck])
                ->andFilterWhere(['=', 'omrm_stkholdertypmst_fk', $stkholderType])
                ->exists();
    }
    public static function checkIsCompanyNameArAlreadyExists($dataToCheck,$regpk = '',$stkholderType = ''){
        
        return self::find()
                ->where('omrm_companyname_ar like :compname',[':compname' => $dataToCheck])
                ->andFilterWhere(['=', 'omrm_stkholdertypmst_fk', $stkholderType])
                ->exists();
    }
    
    public static function checkIsOpalMemNumAlreadyExists($dataToCheck, $regpk = '', $userpk = '') {
        return self::find()->where('omrm_opalmembershipregnumber = :omrm_opalmembershipregnumber', [':omrm_opalmembershipregnumber' => $dataToCheck])
                        ->andFilterWhere(['<>', 'opalmemberregmst_pk', $regpk])
                        ->andFilterWhere(['<>', 'omrm_memberStatus', 'd'])->exists();
    }
    
    public static function checkIsCRNumberAlreadyExists($dataToCheck, $regpk = '', $userpk = '') {
        return self::find()->where('omrm_crnumber = :omrm_crnumber', [':omrm_crnumber' => $dataToCheck])
                        ->andFilterWhere(['<>', 'opalmemberregmst_pk', $regpk])
                        ->andFilterWhere(['<>', 'omrm_memberStatus', 'd'])->exists();
    }
    
     public static function getAppRegDtls($request) {
         $regPk =  ActiveRecord::getTokenData('opalmemberregmst_pk', true);
         $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
         
         if($request['projecttype'] == 1){
            $model = OpalusermstTbl::find()
            ->select(['oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2','omrm_cractivity','oum_projectmst_fk'])
            ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
            ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
            ->where('opalusermst_pk ='.$userPk)
            ->asArray()
            ->one();
         }elseif($request['projecttype'] == 4){
            $model = OpalusermstTbl::find()
            ->select(['oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2','omrm_cractivity','oum_projectmst_fk'])
            ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
            ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
            ->where('opalusermst_pk ='.$userPk)
            ->asArray()
            ->one();
         }elseif(empty($model)){
            $model = OpalusermstTbl::find()
            ->select(['oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2','omrm_cractivity','oum_projectmst_fk'])
            ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
            ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
            ->where('opalusermst_pk ='.$userPk)
            ->asArray()
            ->one();
         }else{
            $model = OpalusermstTbl::find()
            ->select(['oum_opalmemberregmst_fk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas','oum_firstname as name','oum_emailid as emailid','oum_mobno as mob_no','odsg_opaldesignationname as desig','omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_opalmoherigradingmst_pk','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','omrm_tpname_en as tpname_en','omrm_tpname_ar as tpname_ar','omrm_crnumber as cr_no','omrm_crregistrationexpiry as cr_expiry','omrm_opalmembershipregnumber as opalmem_no','omrm_opalmembershipregexpiredate as opalmem_expiry','omrm_gmname as gmname','omrm_gmemailid as gmaemailid','omrm_gmmobileno as gmmobileno','omrm_opalcountrymst_fk','omrm_opalstatemst_fk','omrm_opalcitymst_fk','omrm_cractivity','omrm_cmplogo','omrm_address1 as address1','omrm_address2 as address2','omrm_cractivity','oum_projectmst_fk'])
            ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
            ->leftJoin('opaldesignationmst_tbl', 'opaldesignationmst_pk = oum_opaldesignationmst_fk')
            ->where('opalusermst_pk ='.$userPk)
            ->asArray()
            ->one();
         }
       
        $model['cr_expiry'] = date("Y-m-d", strtotime($model['cr_expiry']));
        $model['opalmem_expiry'] = date("Y-m-d", strtotime($model['opalmem_expiry']));
        
        $data = ApplicationdtlsmainTbl::find()
        ->select(['*'])
        ->innerjoin('appinstinfotmp_tbl insinfor','insinfor.appiit_applicationdtlstmp_fk = applicationdtlsmain_tbl.appdm_applicationdtlstmp_fk')
        ->where(['appiit_officetype' => '1'])
        ->where(['appdm_opalmemberregmst_fk' => $regPk])
        ->asArray()->one();
        
        //echo '<pre>';print_r($data);exit;
        $model['app_pk'] = $data['applicationdtlsmain_pk'];

        if($model)
        {
           return $model; 
        }
         return false;
    }
    
    public static function getTrainingEvalutionCentres()
    {
     return  AppcoursedtlsmainTbl::find()
                ->select(['opalmemberregmst_pk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas', 'omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','appiim_branchname_en as branchname_en','appiim_branchname_ar as branchname_ar','b.applicationdtlsmain_pk as appmainpk','appinstinfomain_pk as instinfopk','b.appdm_issuspended as issuspended',
    'if(DATE_ADD(now(),interval +1 month) > b.appdm_certificateexpiry and now() <= b.appdm_certificateexpiry , 1 , 0) as is_nearingexpiry',
    'if(DATE_ADD(now(),interval -1 month) <= b.appdm_certificateexpiry and now()  >  b.appdm_certificateexpiry , 1 , 0) as graceperiod','applicationdtlstmp_pk as temppk',
    'if(DATE_ADD(now(),interval -1 month) > b.appdm_certificateexpiry , 1 , 0) as is_expired','DATE_FORMAT(b.appdm_certificateexpiry,"%d-%m-%Y") as nearingdate','DATE_FORMAT(DATE_ADD(b.appdm_certificateexpiry,interval +1 month),"%d-%m-%Y") as graceperioddate','if(appdt_apptype = 2 and appdt_status not in (17,19),1,0) as renewed','appdt_status as status'])
                ->innerJoin('appinstinfomain_tbl','appcdm_appinstinfomain_fk = appinstinfomain_pk')
                ->leftJoin('applicationdtlsmain_tbl a', 'appcdm_ApplicationDtlsMain_FK = a.applicationdtlsmain_pk')
                ->leftJoin('applicationdtlsmain_tbl b', 'a.appdm_opalmemberregmst_fk = b.appdm_opalmemberregmst_fk and b.appdm_projectmst_fk = 1 and appcdm_appinstinfomain_fk = appinstinfomain_pk')
                ->leftJoin('applicationdtlstmp_tbl', 'b.appdm_applicationdtlstmp_fk = applicationdtlstmp_pk')
                ->innerJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appiim_opalmemberregmst_fk')
                ->andWhere(['=','omrm_memberStatus', 'a'])
                ->andWhere(['=','a.appdm_issuspended',2])
                ->andWhere(['=','a.appdm_projectmst_fk',2])
                ->andWhere(['=','b.appdm_projectmst_fk',1])
                ->andWhere(['=','appiim_officetype',1])
               ->groupBy('appinstinfomain_pk')
                ->asArray()
                ->all();
      
       
        
    }
    public static function getTechnicalEvalutionCentres($prjPk)
    {
       
        $model =  OpalmemberregmstTbl::find()
                ->select(['opalmemberregmst_pk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas', 'omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar','applicationdtlsmain_pk as appmainpk','appdm_issuspended as issuspended','appinstinfomain_pk as instpk','if(DATE_ADD(now(),interval +1 month) > appdm_certificateexpiry and now() <= appdm_certificateexpiry , 1 , 0) as is_nearingexpiry',
    'if(DATE_ADD(now(),interval -1 month) <= appdm_certificateexpiry and now()  >  appdm_certificateexpiry , 1 , 0) as graceperiod',
    'if(DATE_ADD(now(),interval -1 month) > appdm_certificateexpiry , 1 , 0) as is_expired','DATE_FORMAT(appdm_certificateexpiry,"%d-%m-%Y") as nearingdate','DATE_FORMAT(DATE_ADD(appdm_certificateexpiry,interval +1 month),"%d-%m-%Y") as graceperioddate','if(appdt_apptype = 2 and appdt_status not in (17,19),1,0) as renewed','IF(appdt_isprimarycert = 1 , 1 , 2) as isprimary','applicationdtlstmp_pk as temppk','appdt_status as status'])
                ->leftJoin('applicationdtlsmain_tbl', 'appdm_opalmemberregmst_fk = opalmemberregmst_pk and appdm_projectmst_fk = '.$prjPk)
                ->leftJoin('appinstinfomain_tbl', 'appiim_applicationdtlsmain_fk = applicationdtlsmain_pk')
                ->leftJoin('applicationdtlstmp_tbl', 'appdm_applicationdtlstmp_fk = applicationdtlstmp_pk')
                ->where(['=','omrm_stkholdertypmst_fk', 2])
                ->andWhere(['IN','omrm_intendforregistration', [2,3]])
                ->andWhere(['=','omrm_memberStatus', 'a'])
                ->andWhere("((FIND_IN_SET('".$prjPk."', omrm_projectmst_fk)) || (omrm_projectmst_fk = ".$prjPk." ))")
                ->andWhere(['=','appiim_officetype',1])
                ->asArray()
                ->all();
        
        foreach($model as $key => $record)
        {
            $isInvoiceOverdue = Vehicle::CheckInvoiceDueRAS($record['instpk']);
            
            $model[$key]['isOverdue'] = $isInvoiceOverdue ? 1 : 2;
        }
        
        return $model;
                
                
    }
    
    public static function getTrngEvalCentresBranchByRegPk($regpk)
    {
        
        return  AppcoursedtlsmainTbl::find()
                ->select(['opalmemberregmst_pk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas', 'omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','appiim_branchname_en as branchname_en','appiim_branchname_ar as branchname_ar','b.applicationdtlsmain_pk as appmainpk','appinstinfomain_pk as instinfopk','b.appdm_issuspended as issuspended', 'if(DATE_ADD(now(),interval +1 month) > b.appdm_certificateexpiry and now() <= b.appdm_certificateexpiry , 1 , 0) as is_nearingexpiry',
    'if(DATE_ADD(now(),interval -1 month) <= b.appdm_certificateexpiry and now()  >  b.appdm_certificateexpiry , 1 , 0) as graceperiod','IF(appdt_isprimarycert = 1 , 1 , 2) as isprimary','applicationdtlstmp_pk as temppk',
    'if(DATE_ADD(now(),interval -1 month) > b.appdm_certificateexpiry , 1 , 0) as is_expired','DATE_FORMAT(b.appdm_certificateexpiry,"%d-%m-%Y") as nearingdate','DATE_FORMAT(DATE_ADD(b.appdm_certificateexpiry,interval +1 month),"%d-%m-%Y") as graceperioddate','if(appdt_apptype = 2 and appdt_status not in (17,19),1,0) as renewed','appdt_status as status'])
                ->innerJoin('appinstinfomain_tbl','appcdm_appinstinfomain_fk = appinstinfomain_pk')
                ->leftJoin('applicationdtlsmain_tbl a', 'appcdm_ApplicationDtlsMain_FK = a.applicationdtlsmain_pk')
                ->leftJoin('applicationdtlsmain_tbl b', 'a.appdm_opalmemberregmst_fk = b.appdm_opalmemberregmst_fk and b.appdm_projectmst_fk = 1 and b.applicationdtlsmain_pk in (select appiim_applicationdtlsmain_fk from appinstinfomain_tbl where appiim_officetype = 2 and appcdm_appinstinfomain_fk = appinstinfomain_pk)')
                ->leftJoin('applicationdtlstmp_tbl', 'b.appdm_applicationdtlstmp_fk = applicationdtlstmp_pk')
                ->innerJoin('opalmemberregmst_tbl','opalmemberregmst_pk = appiim_opalmemberregmst_fk')
                ->andWhere(['=','omrm_memberStatus', 'a'])
                ->andWhere(['=','a.appdm_issuspended',2])
                ->andWhere(['=','a.appdm_projectmst_fk',2])
                ->andWhere(['=','b.appdm_projectmst_fk',1])
                ->andWhere(['=','appiim_officetype',2])
                ->andWhere(['=','appiim_opalmemberregmst_fk',$regpk])
                ->groupBy('appinstinfomain_pk')
                ->asArray()
                ->all();
        
       
    }
    public static function getTechEvalCentresBranchByRegPk($regpk,$prjPk = 4)
    {
        
        $model =  OpalmemberregmstTbl::find()
                ->select(['opalmemberregmst_pk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas', 'omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','appiim_branchname_en as branchname_en','appiim_branchname_ar as branchname_ar','applicationdtlsmain_pk as appmainpk','appdm_issuspended as issuspended','appinstinfomain_pk as instpk','if(DATE_ADD(now(),interval +1 month) > appdm_certificateexpiry and now() <= appdm_certificateexpiry , 1 , 0) as is_nearingexpiry',
    'if(DATE_ADD(now(),interval -1 month) <= appdm_certificateexpiry and now()  >  appdm_certificateexpiry , 1 , 0) as graceperiod',
    'if(DATE_ADD(now(),interval -1 month) > appdm_certificateexpiry , 1 , 0) as is_expired','DATE_FORMAT(appdm_certificateexpiry,"%d-%m-%Y") as nearingdate','DATE_FORMAT(DATE_ADD(appdm_certificateexpiry,interval +1 month),"%d-%m-%Y") as graceperioddate','if(appdt_apptype = 2 and appdt_status not in (17,19),1,0) as renewed','applicationdtlstmp_pk as temppk','IF(appdt_isprimarycert = 1 , 1 , 2) as isprimary','appdt_status as status'])
                ->innerJoin('applicationdtlsmain_tbl', 'appdm_opalmemberregmst_fk = opalmemberregmst_pk and  appdm_projectmst_fk = '.$prjPk.' and applicationdtlsmain_pk in (select appiim_applicationdtlsmain_fk from appinstinfomain_tbl where appiim_officetype = 2)')
                ->innerJoin('appinstinfomain_tbl', 'applicationdtlsmain_pk = appiim_applicationdtlsmain_fk ')
                ->leftJoin('applicationdtlstmp_tbl', 'appdm_applicationdtlstmp_fk = applicationdtlstmp_pk')
                ->where(['=','appiim_opalmemberregmst_fk',$regpk])
                ->andWhere(['=','omrm_stkholdertypmst_fk', 2])
                ->andWhere(['=','appdm_projectmst_fk',$prjPk])
                ->andWhere(['IN','omrm_intendforregistration', [2,3]])
                ->andWhere(['=','omrm_memberStatus', 'a'])
                ->andWhere(['=','appiim_officetype',2])
                ->asArray()
                ->all();
        
        
         foreach($model as $key => $record)
        {
            $isInvoiceOverdue = Vehicle::CheckInvoiceDueRAS($record['instpk']);
            
            $model[$key]['isOverdue'] = $isInvoiceOverdue ? 1 : 2;
        }
        
        return $model;
    
                
    }
    
    public static function getAssessorsList()
    {
       return  OpalmemberregmstTbl::find()
                ->select(['opalmemberregmst_pk as regpk','omrm_stkholdertypmst_fk as stkpk','omrm_intendforregistration as regas', 'omrm_companyname_en as compname_en','omrm_companyname_ar as compname_ar','omrm_branch_en as branchname_en','omrm_branch_ar as branchname_ar'])
//                ->leftJoin('applicationdtlsmain_tbl', 'appdm_opalmemberregmst_fk = opalmemberregmst_pk')
//                ->leftJoin('appinstinfomain_tbl', 'appiim_applicationdtlsmain_fk = applicationdtlsmain_pk')
                ->where(['=','omrm_stkholdertypmst_fk', 2])
                ->andWhere(['=','omrm_intendforregistration', 2])
                ->andWhere(['=','omrm_memberStatus', 'a'])
//                ->andWhere(['=','appiim_officetype',1])
                ->asArray()
                ->all();
    }


    public static function getbranchinfo($regpk,$offtype)
    {
        
        return  AppinstinfomainTbl::find()
                ->select(['appiim_branchname_en as branchname_en','appiim_branchname_ar as branchname_ar','appinstinfomain_pk','appdm_issuspended'])
                ->leftjoin('applicationdtlsmain_tbl','applicationdtlsmain_pk = appiim_applicationdtlsmain_fk')
                // ->innerJoin('applicationdtlsmain_tbl', 'appdm_opalmemberregmst_fk = opalmemberregmst_pk')
                // ->innerJoin('appinstinfomain_tbl', 'applicationdtlsmain_pk = appiim_applicationdtlsmain_fk')
                ->where(['=','appiim_opalmemberregmst_fk',$regpk])
                // ->andWhere(['=','omrm_stkholdertypmst_fk', 2])
                // ->andWhere(['=','omrm_intendforregistration', 1])
                // ->andWhere(['=','omrm_memberStatus', 'a'])
                ->andWhere(['=','appiim_officetype',$offtype])
                ->asArray()
                ->all();
                // ->createCommand()->getRawSql();
                
    
                
    }
    
    public static function getFocalPointByMemregPK($regpk,$projectpk = null)
    {
        $model = OpalmemberregmstTbl::find()
                ->select(['opalusermst_pk as focalpk'])
                ->leftJoin('opalusermst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                ->where(['=','opalmemberregmst_pk',$regpk])
                ->andWhere(['=','oum_isfocalpoint',1]);
                if($projectpk)
                {
                    $model->andWhere(['=','oum_projectmst_fk',$projectpk]);
                }
                
               $focalpoint = $model->asArray()->one()['focalpk'];
        

        
        return $focalpoint;
    }
}
