<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use common\models\MemberregistrationmstTbl;
use api\modules\pd\models\ProjectdtlsTbl;

/**
 * This is the model class for table "projinvmapping_tbl".
 *
 * @property int $projinvmapping_pk Primary key
 * @property int $pim_projectdtls_fk Reference to projectdtls_tbl
 * @property int $pim_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property string $pim_name Name of the Investor
 * @property string $pim_emailid Email Id
 * @property int $pim_status 0- Inactive, 1- Active
 * @property int $pim_order Order of the investor
 * @property string $pim_approvedon Date of approval
 * @property int $pim_approvedby Reference to usrmst_tbl
 * @property string $pim_approvedbyipaddr IP Address of the user
 * @property string $pim_submittedon Datetime of update
 * @property int $pim_submittedby Reference to usermst_tbl
 * @property string $pim_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $pimApprovedby
 * @property MemberregistrationmstTbl $pimMemberregmstFk
 * @property ProjectdtlsTbl $pimProjectdtlsFk
 * @property UsermstTbl $pimSubmittedby
 */
class ProjinvmappingTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projinvmapping_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pim_projectdtls_fk', 'pim_memberregmst_fk', 'pim_approvedon', 'pim_approvedby'], 'required'],
            [['pim_projectdtls_fk', 'pim_memberregmst_fk', 'pim_status', 'pim_order', 'pim_approvedby', 'pim_submittedby'], 'integer'],
            [['pim_approvedon', 'pim_submittedon'], 'safe'],
            [['pim_name'], 'string', 'max' => 150],
            [['pim_emailid'], 'string', 'max' => 255],
            [['pim_approvedbyipaddr', 'pim_submittedbyipaddr'], 'string', 'max' => 50],
            [['pim_approvedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pim_approvedby' => 'UserMst_Pk']],
            [['pim_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['pim_memberregmst_fk' => 'MemberRegMst_Pk']],
            [['pim_projectdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectdtlsTbl::className(), 'targetAttribute' => ['pim_projectdtls_fk' => 'projectdtls_pk']],
            [['pim_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pim_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projinvmapping_pk' => 'Projinvmapping Pk',
            'pim_projectdtls_fk' => 'Pim Projectdtls Fk',
            'pim_memberregmst_fk' => 'Pim Memberregmst Fk',
            'pim_name' => 'Pim Name',
            'pim_emailid' => 'Pim Emailid',
            'pim_status' => 'Pim Status',
            'pim_order' => 'Pim Order',
            'pim_approvedon' => 'Pim Approvedon',
            'pim_approvedby' => 'Pim Approvedby',
            'pim_approvedbyipaddr' => 'Pim Approvedbyipaddr',
            'pim_submittedon' => 'Pim Submittedon',
            'pim_submittedby' => 'Pim Submittedby',
            'pim_submittedbyipaddr' => 'Pim Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimApprovedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pim_approvedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'pim_memberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimProjectdtlsFk()
    {
        return $this->hasOne(ProjectdtlsTbl::className(), ['projectdtls_pk' => 'pim_projectdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pim_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvmappingTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjinvmappingTblQuery(get_called_class());
    }
}
