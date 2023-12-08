<?php

namespace api\modules\pd\models;

use Yii;
use api\modules\mst\models\MemberregistrationmstTbl;
use api\modules\pd\models\ProjecttmpTbl;
use common\models\UsermstTbl;

/**
 * This is the model class for table "projinvmappingtmp_tbl".
 *
 * @property int $projinvmappingtmp_pk Primary key
 * @property int $pimt_projecttmp_fk Reference to projecttmp_tbl
 * @property int $pimt_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property string $pimt_name Name of the Investor
 * @property string $pimt_emailid Email Id
 * @property int $pimt_status 0- Inactive, 1- Active
 * @property int $pimt_order Order of the investor
 * @property string $pimt_submittedon First date of submission
 * @property int $pimt_submittedby Reference to usrmst_tbl
 * @property string $pimt_submittedbyipaddr IP Address of the user
 * @property string $pimt_updatedon Datetime of update
 * @property int $pimt_updatedby Reference to usermst_tbl
 * @property string $pimt_updatedbyipaddr IP Address of the user
 *
 * @property MemberregistrationmstTbl $pimtMemberregmstFk
 * @property ProjecttmpTbl $pimtProjecttmpFk
 * @property UsermstTbl $pimtSubmittedby
 * @property UsermstTbl $pimtUpdatedby
 */
class ProjinvmappingtmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projinvmappingtmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pimt_projecttmp_fk', 'pimt_memberregmst_fk'], 'required'],
            [['pimt_projecttmp_fk', 'pimt_memberregmst_fk', 'pimt_status', 'pimt_order', 'pimt_submittedby', 'pimt_updatedby'], 'integer'],
            [['pimt_submittedon', 'pimt_updatedon'], 'safe'],
            [['pimt_name'], 'string', 'max' => 150],
            [['pimt_emailid'], 'string', 'max' => 255],
            [['pimt_submittedbyipaddr', 'pimt_updatedbyipaddr'], 'string', 'max' => 50],
            [['pimt_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['pimt_memberregmst_fk' => 'MemberRegMst_Pk']],
            [['pimt_projecttmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecttmpTbl::className(), 'targetAttribute' => ['pimt_projecttmp_fk' => 'projecttmp_pk']],
            [['pimt_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pimt_submittedby' => 'UserMst_Pk']],
            [['pimt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pimt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projinvmappingtmp_pk' => 'Projinvmappingtmp Pk',
            'pimt_projecttmp_fk' => 'Pimt Projecttmp Fk',
            'pimt_memberregmst_fk' => 'Pimt Memberregmst Fk',
            'pimt_name' => 'Pimt Name',
            'pimt_emailid' => 'Pimt Emailid',
            'pimt_status' => 'Pimt Status',
            'pimt_order' => 'Pimt Order',
            'pimt_submittedon' => 'Pimt Submittedon',
            'pimt_submittedby' => 'Pimt Submittedby',
            'pimt_submittedbyipaddr' => 'Pimt Submittedbyipaddr',
            'pimt_updatedon' => 'Pimt Updatedon',
            'pimt_updatedby' => 'Pimt Updatedby',
            'pimt_updatedbyipaddr' => 'Pimt Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimtMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'pimt_memberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimtProjecttmpFk()
    {
        return $this->hasOne(ProjecttmpTbl::className(), ['projecttmp_pk' => 'pimt_projecttmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimtSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pimt_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pimt_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvmappingtmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjinvmappingtmpTblQuery(get_called_class());
    }
}
