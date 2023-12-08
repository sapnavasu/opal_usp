<?php

namespace api\modules\mst\models;
use common\models\IncorpstylemstTbl;
use \common\models\UsermstTbl;
use \common\models\VAcchst;
use \common\models\StkholdertypmstTbl;

use Yii;

/**
 * This is the model class for table "memberregistrationmst_tbl".
 *
 * @property int $MemberRegMst_Pk Primary key
 * @property int $mrm_stkholdertypmst_fk Reference to stkholdertypmst_tbl
 * @property int $mrm_projownertyp Applicable for project owner registration alone. 1 - Free Zones , 2 -  Government Companies, 3 -  Government Organisations , 4 -  Private Sector , 5 -  Semi-Government Organisations 
 * @property int $mrm_regthru Registration done through. 1 - Portal, 2 - Backend
 * @property string $MRM_MemberStatus 'A' - Active,'I' - Inactive, 'V' - Validation pending
 * @property int $mrm_incorpstylemst_fk Reference to incorpstylemst_tbl
 * @property string $mrm_invprefloc Reference to statemst_tbl in comma separation
 * @property int $mrm_invidentity 1-Individual, 2-Corporate
 * @property int $mrm_invidentitymst_fk Reference to invidentitymst_tbl
 * @property int $mrm_invintent_fk Reference to invintent_tbl
 * @property string $mrm_comments Comments for corporate investors
 * @property string $mrm_expectations Expectation from LyPIS
 * @property int $mrm_projinvestmentdtls_fk Reference to projinvestmentdtls_tbl
 * @property int $mrm_memsubscriptionmst_fk Reference to memsubscriptionmst_tbl
 * @property int $mrm_preferredlogin 1 - Yes. Incase the stakeholder has multiple identity in the portal, based on this selection selected stakeholder dashboard will be redirected post login
 * @property string $mrm_cmplisting Is your company listed in any of the following? Select where appropriate:  1 - Listed in Forbes 500,  2 - Listed on Muscat Securities Market,  3 - Listed in any International stock exchange, 4 - Partners in any of Oman’s sovereign wealth funds
 * @property string $MRM_CreatedOn Datetime of creation
 * @property int $mrm_createdby Reference to usermst_tbl
 * @property string $mrm_createdbyipaddr IP Address of the user
 * @property string $MRM_UpdatedOn Datetime of update
 * @property int $MRM_UpdatedBy Reference to usermst_tbl
 * @property string $mrm_updatedbyipaddr IP Address
 * @property string $mrm_profupdatedon Profile updated on
 *
 * @property FavsrchmstTbl[] $favsrchmstTbls
 * @property LicensauthoritiesmstTbl[] $licensauthoritiesmstTbls
 * @property LicensinginfoTbl[] $licensinginfoTbls
 * @property MembercompanymstTbl[] $membercompanymstTbls
 * @property UsermstTbl $mrmCreatedby
 * @property StkholdertypmstTbl $mrmStkholdertypmstFk
 * @property UsermstTbl $mRMUpdatedBy
 * @property ProjectdtlsTbl[] $projectdtlsTbls
 * @property ProjecthstyTbl[] $projecthstyTbls
 * @property ProjecttmpTbl[] $projecttmpTbls
 * @property ProjinvmappingTbl[] $projinvmappingTbls
 * @property ProjinvmappinghstyTbl[] $projinvmappinghstyTbls
 * @property ProjinvmappingtmpTbl[] $projinvmappingtmpTbls
 * @property ProjshortlistTbl[] $projshortlistTbls
 * @property ProjviewingdtlsTbl[] $projviewingdtlsTbls
 * @property UsermstTbl[] $usermstTbls
 */
class MemberregistrationmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memberregistrationmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mrm_stkholdertypmst_fk', 'mrm_regthru', 'MRM_MemberStatus'], 'required'],
            [['mrm_stkholdertypmst_fk', 'mrm_projownertyp', 'mrm_regthru', 'mrm_incorpstylemst_fk', 'mrm_invidentity', 'mrm_invidentitymst_fk', 'mrm_invintent_fk', 'mrm_projinvestmentdtls_fk', 'mrm_memsubscriptionmst_fk', 'mrm_preferredlogin', 'mrm_createdby', 'MRM_UpdatedBy'], 'integer'],
            [[ 'mrm_investortypeprefmst_fk', 'MRM_MemberStatus', 'mrm_invprefloc', 'mrm_comments', 'mrm_expectations', 'mrm_cmplisting'], 'string'],
            [['MRM_CreatedOn', 'MRM_UpdatedOn', 'mrm_profupdatedon'], 'safe'],
            [['mrm_createdbyipaddr', 'mrm_updatedbyipaddr'], 'string', 'max' => 50],
            [['mrm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mrm_createdby' => 'UserMst_Pk']],
            [['mrm_stkholdertypmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StkholdertypmstTbl::className(), 'targetAttribute' => ['mrm_stkholdertypmst_fk' => 'stkholdertypmst_pk']],
            [['MRM_UpdatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['MRM_UpdatedBy' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MemberRegMst_Pk' => 'Member Reg Mst  Pk',
            'mrm_stkholdertypmst_fk' => 'Mrm Stkholdertypmst Fk',
            'mrm_projownertyp' => 'Mrm Projownertyp',
            'mrm_regthru' => 'Mrm Regthru',
            'MRM_MemberStatus' => 'Mrm  Member Status',
            'mrm_incorpstylemst_fk' => 'Mrm Incorpstylemst Fk',
            'mrm_invprefloc' => 'Mrm Invprefloc',
            'mrm_invidentity' => 'Mrm Invidentity',
            'mrm_invidentitymst_fk' => 'Mrm Invidentitymst Fk',
            'mrm_invintent_fk' => 'Mrm Invintent Fk',
            'mrm_investortypeprefmst_fk' => 'Reference to investortypeprefmst_tbl in comma separation',
            'mrm_comments' => 'Mrm Comments',
            'mrm_expectations' => 'Mrm Expectations',
            'mrm_projinvestmentdtls_fk' => 'Mrm Projinvestmentdtls Fk',
            'mrm_memsubscriptionmst_fk' => 'Mrm Memsubscriptionmst Fk',
            'mrm_preferredlogin' => 'Mrm Preferredlogin',
            'mrm_cmplisting' => 'Mrm Cmplisting',
            'MRM_CreatedOn' => 'Mrm  Created On',
            'mrm_createdby' => 'Mrm Createdby',
            'mrm_createdbyipaddr' => 'Mrm Createdbyipaddr',
            'MRM_UpdatedOn' => 'Mrm  Updated On',
            'MRM_UpdatedBy' => 'Mrm  Updated By',
            'mrm_updatedbyipaddr' => 'Mrm Updatedbyipaddr',
            'mrm_profupdatedon' => 'Mrm Profupdatedon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//incorpstylemst_tbl
    public function getIncrpstyl()
    {
        return $this->hasOne(IncorpstylemstTbl::className(), ['IncorpStyleMst_Pk' => 'mrm_incorpstylemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavsrchmstTbls()
    {
        return $this->hasMany(FavsrchmstTbl::className(), ['fsm_memberregmst_fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLicensauthoritiesmstTbls()
    {
        return $this->hasMany(LicensauthoritiesmstTbl::className(), ['lam_memberregmst_fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLicensinginfoTbls()
    {
        return $this->hasMany(LicensinginfoTbl::className(), ['li_memberregmst_fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembercompanymstTbls()
    {
        return $this->hasMany(MembercompanymstTbl::className(), ['MCM_MemberRegMst_Fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mrm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrmStkholdertypmstFk()
    {
        return $this->hasOne(StkholdertypmstTbl::className(), ['stkholdertypmst_pk' => 'mrm_stkholdertypmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMRMUpdatedBy()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'MRM_UpdatedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectdtlsTbls()
    {
        return $this->hasMany(ProjectdtlsTbl::className(), ['prjd_memberregmst_fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjecthstyTbls()
    {
        return $this->hasMany(ProjecthstyTbl::className(), ['prjh_memberregmst_fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjecttmpTbls()
    {
        return $this->hasMany(ProjecttmpTbl::className(), ['prjt_memberregmst_fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjinvmappingTbls()
    {
        return $this->hasMany(ProjinvmappingTbl::className(), ['pim_memberregmst_fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjinvmappinghstyTbls()
    {
        return $this->hasMany(ProjinvmappinghstyTbl::className(), ['pimh_memberregmst_fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjinvmappingtmpTbls()
    {
        return $this->hasMany(ProjinvmappingtmpTbl::className(), ['pimt_memberregmst_fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjshortlistTbls()
    {
        return $this->hasMany(ProjshortlistTbl::className(), ['prjsl_memberregmst_fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjviewingdtlsTbls()
    {
        return $this->hasMany(ProjviewingdtlsTbl::className(), ['pvd_memregmst_fk' => 'MemberRegMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsermstTbls()
    {
        return $this->hasMany(UsermstTbl::className(), ['UM_MemberRegMst_Fk' => 'MemberRegMst_Pk']);
    }
    
    public function getCompAdminUser()
    {
        return $this->hasOne(UsermstTbl::className(), ['UM_MemberRegMst_Fk' => 'MemberRegMst_Pk'])->andOnCondition(['UM_Type' => 'A']);
    }
    
    public function getCompJPUser()
    {
        return $this->hasOne(UsermstTbl::className(), ['UM_MemberRegMst_Fk' => 'MemberRegMst_Pk'])->andOnCondition(['um_jpcontact' => 1,'UM_Status'=>'A']);
    }
    
    public function getExpireDate()
    {
        return $this->hasOne(VAcchst::className(), ['MCAAH_MemberRegMst_Fk' => 'MemberRegMst_Pk']);
    }
}
