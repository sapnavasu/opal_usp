<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl; 
use common\models\DepartmentmstTbl; 
use common\models\MemcompsectordtlsTbl; 
use api\modules\pd\models\ProjectdtlsTbl; 
use app\models\CmscostcenterdtlsTbl; 
use app\models\CmsdisciplinedtlsTbl; 
use api\modules\pd\models\MemcompmplocationdtlsTbl;
use api\modules\mst\models\MembercompanymstTbl;

use Yii;

/**
 * This is the model class for table "cmsrequisitionformdtls_tbl".
 *
 * @property int $cmsrequisitionformdtls_pk Primary key
 * @property int $crfd_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $crfd_cmscontracthdr_fk Reference to cmscontracthdr_tbl When Supplier creates tender sub contract pk will be stored
 * @property int $crfd_type 1 - Requisition, 2 - Tender, 3 - Supplier Tender (when created from cmscontracthdr_tbl)
 * @property int $crfd_formtype Type of Form when crfd_type = 2: 1 - Quick Form, 2 - Advanced Form. by default : 0 when crfd_type = 1
 * @property string $crfd_rqtitle Requisition Title
 * @property string $crfd_rqid Requisition ID
 * @property string $crfd_rqrefno Requisition Ref.No
 * @property int $crfd_rqrevisionno Revision No. after published if any changes in rq then it increase
 * @property int $crfd_requester Reference to usermst_tbl
 * @property int $crfd_rqprocesstype Process Type when selected crfd_type = Tender: 1 - Direct Award, 2 - Offline Tendering, 3 - Online Tendering, 4 - Single Source
 * @property string $crfd_rqprocesstypefile crfd_rqprocesstype = 2 (Offline) then Reference to memcompfiledtls_tbl (comma separate if multiple)
 * @property int $crfd_rqpriority 1 - Low, 2 - Medium, 3 - High
 * @property int $crfd_rqtype 1 - Product, 2 - Service
 * @property int $crfd_cmsdisciplinedtls_fk Reference to cmsdisciplinedtls_tbl
 * @property int $crfd_cmscostcenterdtls_fk Reference to cmscostcenterdtls_tbl
 * @property string $crfd_rqdate Date of Requisition
 * @property int $crfd_projectdtls_fk Reference to projectdtls_tbl
 * @property string $crfd_departmentmst_fk Reference to departmentmst_tbl
 * @property string $crfd_rqdesc Requisition Description
 * @property int $crfd_deliv_mcmpld_fk Reference to memcompmplocationdtls_tbl (Quick Form)
 * @property string $crfd_delivreqdate ROS Date (Required On-Site) (Quick Form)
 * @property int $crfd_shared_agreetype Agreement selection applicabe  1 - Online, 2 - Offline (Quick Form)
 * @property int $crfd_shared_agreefk Reference to cmscontracthdr_tbl, cmscontractagreementhdr_tbl (Quick Form)
 * @property string $crfd_rqstatement Statment of Need
 * @property string $crfd_rqapproxvalue Approximate Requisition value
 * @property int $crfd_isblanketrq 1 - Yes, 2 - No
 * @property string $crfd_recurinterval Reccuring Interval
 * @property int $crfd_recurintervaltype Reccuring Interval 1 - Daily, 2 - Monthly, 3 - Quarterly, 4 - Half-yearly, 5 - Yearly
 * @property int $crfd_rqclassification 1 - MSME, 2 - LCC, 3 - MSME & LCC, 4 - Others
 * @property string $crfd_reqpercent Required Percentage
 * @property int $crfd_reqdeliverable Require Deliverables
 * @property int $crfd_document 1 - Multiple Quality Control Plan, 2 - Inspection, 3 - Testing and Certification
 * @property string $crfd_spares Spares
 * @property string $crfd_sparesothers If selected Others in crfd_spares
 * @property string $crfd_remarks Remarks for supporting document accordion
 * @property int $crfd_rqstatus 1 - Draft, 2 - Submitted, 3 - Approved, 4 - Declined, 5 - In-progress, 6 - Completed, 7 - Terminated, 8 - Suspended
 * @property int $crfd_tenderstatus Tender status when crfd_type = 2: 1 - Yet to Start, 2 - In-progress, 3 - Partially Awarded, 4 - Awarded
 * @property int $crfd_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $crfd_createdon Date of creation
 * @property int $crfd_createdby Reference to usermst_tbl
 * @property string $crfd_createdbyipaddr User IP Address
 * @property string $crfd_updatedon Date of update
 * @property int $crfd_updatedby Reference to usermst_tbl
 * @property string $crfd_updatedbyipaddr User IP Address
 * @property string $crfd_latesttime On insert,update latest date & time will be captured
 *
 * @property CmscontracthdrTbl[] $cmscontracthdrTbls
 * @property CmscontracthdrTbl $crfdCmscontracthdrFk
 * @property CmscostcenterdtlsTbl $crfdCmscostcenterdtlsFk
 * @property CmsdisciplinedtlsTbl $crfdCmsdisciplinedtlsFk
 * @property UsermstTbl $crfdCreatedby
 * @property MemcompmplocationdtlsTbl $crfdDelivMcmpldFk
 * @property ProjectdtlsTbl $crfdProjectdtlsFk
 * @property UsermstTbl $crfdRequester
 * @property UsermstTbl $crfdUpdatedby
 * @property CmsrqtendermapTbl[] $cmsrqtendermapTbls
 * @property CmsrqtendermapTbl[] $cmsrqtendermapTbls0
 * @property CmstenderhdrTbl[] $cmstenderhdrTbls
 */
class CmsrequisitionformdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsrequisitionformdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['crfd_memcompmst_fk', 'crfd_cmscontracthdr_fk', 'crfd_type', 'crfd_formtype', 'crfd_rqrevisionno', 'crfd_requester', 'crfd_rqprocesstype', 'crfd_rqpriority', 'crfd_rqtype', 'crfd_cmsdisciplinedtls_fk', 'crfd_cmscostcenterdtls_fk', 'crfd_projectdtls_fk', 'crfd_deliv_mcmpld_fk', 'crfd_shared_agreetype', 'crfd_shared_agreefk', 'crfd_isblanketrq', 'crfd_recurintervaltype', 'crfd_rqclassification', 'crfd_reqdeliverable', 'crfd_rqstatus', 'crfd_tenderstatus', 'crfd_isdeleted', 'crfd_createdby', 'crfd_updatedby'], 'integer'],
            [['crfd_type', 'crfd_rqtitle', 'crfd_rqid', 'crfd_rqrefno', 'crfd_requester', 'crfd_rqtype', 'crfd_rqdate'], 'required'],
            [['crfd_rqprocesstypefile', 'crfd_departmentmst_fk', 'crfd_rqdesc', 'crfd_rqstatement', 'crfd_spares', 'crfd_sparesothers', 'crfd_remarks', 'crfd_document'], 'string'],
            [['crfd_rqdate', 'crfd_delivreqdate', 'crfd_createdon', 'crfd_updatedon', 'crfd_latesttime'], 'safe'],
            [['crfd_rqapproxvalue', 'crfd_recurinterval', 'crfd_reqpercent'], 'number'],
            [['crfd_rqtitle'], 'string', 'max' => 255],
            [['crfd_rqid', 'crfd_rqrefno'], 'string', 'max' => 20],
            [['crfd_createdbyipaddr', 'crfd_updatedbyipaddr'], 'string', 'max' => 50],
            [['crfd_cmscontracthdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmscontracthdrTbl::className(), 'targetAttribute' => ['crfd_cmscontracthdr_fk' => 'cmscontracthdr_pk']],
            [['crfd_cmscostcenterdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmscostcenterdtlsTbl::className(), 'targetAttribute' => ['crfd_cmscostcenterdtls_fk' => 'cmscostcenterdtls_pk']],
            [['crfd_cmsdisciplinedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsdisciplinedtlsTbl::className(), 'targetAttribute' => ['crfd_cmsdisciplinedtls_fk' => 'cmsdisciplinedtls_pk']],
            [['crfd_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crfd_createdby' => 'UserMst_Pk']],
            [['crfd_deliv_mcmpld_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompmplocationdtlsTbl::className(), 'targetAttribute' => ['crfd_deliv_mcmpld_fk' => 'memcompmplocationdtls_pk']],
            [['crfd_projectdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectdtlsTbl::className(), 'targetAttribute' => ['crfd_projectdtls_fk' => 'projectdtls_pk']],
            [['crfd_requester'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crfd_requester' => 'UserMst_Pk']],
            [['crfd_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crfd_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsrequisitionformdtls_pk' => 'Cmsrequisitionformdtls Pk',
            'crfd_memcompmst_fk' => 'Crfd Memcompmst Fk',
            'crfd_cmscontracthdr_fk' => 'Crfd Cmscontracthdr Fk',
            'crfd_type' => 'Crfd Type',
            'crfd_formtype' => 'Crfd Formtype',
            'crfd_rqtitle' => 'Crfd Rqtitle',
            'crfd_rqid' => 'Crfd Rqid',
            'crfd_rqrefno' => 'Crfd Rqrefno',
            'crfd_rqrevisionno' => 'Crfd Rqrevisionno',
            'crfd_requester' => 'Crfd Requester',
            'crfd_rqprocesstype' => 'Crfd Rqprocesstype',
            'crfd_rqprocesstypefile' => 'Crfd Rqprocesstypefile',
            'crfd_rqpriority' => 'Crfd Rqpriority',
            'crfd_rqtype' => 'Crfd Rqtype',
            'crfd_cmsdisciplinedtls_fk' => 'Crfd Cmsdisciplinedtls Fk',
            'crfd_cmscostcenterdtls_fk' => 'Crfd Cmscostcenterdtls Fk',
            'crfd_rqdate' => 'Crfd Rqdate',
            'crfd_projectdtls_fk' => 'Crfd Projectdtls Fk',
            'crfd_departmentmst_fk' => 'Crfd Departmentmst Fk',
            'crfd_rqdesc' => 'Crfd Rqdesc',
            'crfd_deliv_mcmpld_fk' => 'Crfd Deliv Mcmpld Fk',
            'crfd_delivreqdate' => 'Crfd Delivreqdate',
            'crfd_shared_agreetype' => 'Crfd Shared Agreetype',
            'crfd_shared_agreefk' => 'Crfd Shared Agreefk',
            'crfd_rqstatement' => 'Crfd Rqstatement',
            'crfd_rqapproxvalue' => 'Crfd Rqapproxvalue',
            'crfd_isblanketrq' => 'Crfd Isblanketrq',
            'crfd_recurinterval' => 'Crfd Recurinterval',
            'crfd_recurintervaltype' => 'Crfd Recurintervaltype',
            'crfd_rqclassification' => 'Crfd Rqclassification',
            'crfd_reqpercent' => 'Crfd Reqpercent',
            'crfd_reqdeliverable' => 'Crfd Reqdeliverable',
            'crfd_document' => 'Crfd Document',
            'crfd_spares' => 'Crfd Spares',
            'crfd_sparesothers' => 'Crfd Sparesothers',
            'crfd_remarks' => 'Crfd Remarks',
            'crfd_rqstatus' => 'Crfd Rqstatus',
            'crfd_tenderstatus' => 'Crfd Tenderstatus',
            'crfd_isdeleted' => 'Crfd Isdeleted',
            'crfd_createdon' => 'Crfd Createdon',
            'crfd_createdby' => 'Crfd Createdby',
            'crfd_createdbyipaddr' => 'Crfd Createdbyipaddr',
            'crfd_updatedon' => 'Crfd Updatedon',
            'crfd_updatedby' => 'Crfd Updatedby',
            'crfd_updatedbyipaddr' => 'Crfd Updatedbyipaddr',
            'crfd_latesttime' => 'Crfd Latesttime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscontracthdrTbls()
    {
        return $this->hasMany(CmscontracthdrTbl::className(), ['cmsch_cmsrequisitionformdtls_fk' => 'cmsrequisitionformdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrfdCmscontracthdrFk()
    {
        return $this->hasOne(CmscontracthdrTbl::className(), ['cmscontracthdr_pk' => 'crfd_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembercompanymst()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'crfd_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrfdCmscostcenterdtlsFk()
    {
        return $this->hasOne(CmscostcenterdtlsTbl::className(), ['cmscostcenterdtls_pk' => 'crfd_cmscostcenterdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrfdCmsdisciplinedtlsFk()
    {
        return $this->hasOne(CmsdisciplinedtlsTbl::className(), ['cmsdisciplinedtls_pk' => 'crfd_cmsdisciplinedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrfdCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crfd_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrfdDelivMcmpldFk()
    {
        return $this->hasOne(MemcompmplocationdtlsTbl::className(), ['memcompmplocationdtls_pk' => 'crfd_deliv_mcmpld_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrfdProjectdtlsFk()
    {
        return $this->hasOne(ProjectdtlsTbl::className(), ['projectdtls_pk' => 'crfd_projectdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrfdRequester()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crfd_requester']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrfdUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crfd_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsrqtendermapTbls()
    {
        return $this->hasMany(CmsrqtendermapTbl::className(), ['crqtm_rq_cmsrequisitionformdtls_fk' => 'cmsrequisitionformdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsrqtendermapTbls0()
    {
        return $this->hasMany(CmsrqtendermapTbl::className(), ['crqtm_tender_cmsrequisitionformdtls_fk' => 'cmsrequisitionformdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderhdrTbls()
    {
        return $this->hasMany(CmstenderhdrTbl::className(), ['cmsth_cmsrequisitionformdtls_fk' => 'cmsrequisitionformdtls_pk']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderhdrtempTbls()
    {
        return $this->hasMany(CmstenderhdrtempTbl::className(), ['cmstht_cmsrequisitionformdtls_fk' => 'cmsrequisitionformdtls_pk'])->where(['cmstht_isdeleted' => 2]);;
    }
}
