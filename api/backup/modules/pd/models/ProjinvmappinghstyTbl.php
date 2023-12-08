<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\mst\models\MemberregistrationmstTbl;
use api\modules\pd\models\ProjecthstyTbl;
/**
 * This is the model class for table "projinvmappinghsty_tbl".
 *
 * @property int $projinvmappinghsty_pk Primary key
 * @property int $pimh_projecthsty_fk Reference to projecthsty_tbl
 * @property int $pimh_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property string $pimh_name Name of the Investor
 * @property string $pimh_emailid Email Id
 * @property int $pimh_status 0- Inactive, 1- Active
 * @property int $pimh_order Order of the investor
 * @property string $pimh_histcreatedon Date of history creation
 * @property string $pimh_appdeclon Date of approval / decline
 * @property int $pimh_appdeclby Reference to usrmst_tbl
 * @property string $pimh_appdeclbyipaddr IP Address of the user
 * @property string $pimh_submittedon Datetime of first submission
 * @property int $pimh_submittedby Reference to usermst_tbl
 * @property string $pimh_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $pimhAppdeclby
 * @property MemberregistrationmstTbl $pimhMemberregmstFk
 * @property ProjecthstyTbl $pimhProjecthstyFk
 * @property UsermstTbl $pimhSubmittedby
 */
class ProjinvmappinghstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projinvmappinghsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pimh_projecthsty_fk', 'pimh_memberregmst_fk', 'pimh_histcreatedon', 'pimh_appdeclon', 'pimh_appdeclby'], 'required'],
            [['pimh_projecthsty_fk', 'pimh_memberregmst_fk', 'pimh_status', 'pimh_order', 'pimh_appdeclby', 'pimh_submittedby'], 'integer'],
            [['pimh_histcreatedon', 'pimh_appdeclon', 'pimh_submittedon'], 'safe'],
            [['pimh_name'], 'string', 'max' => 150],
            [['pimh_emailid'], 'string', 'max' => 255],
            [['pimh_appdeclbyipaddr', 'pimh_submittedbyipaddr'], 'string', 'max' => 50],
            [['pimh_appdeclby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pimh_appdeclby' => 'UserMst_Pk']],
            [['pimh_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['pimh_memberregmst_fk' => 'MemberRegMst_Pk']],
            [['pimh_projecthsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecthstyTbl::className(), 'targetAttribute' => ['pimh_projecthsty_fk' => 'projecthsty_pk']],
            [['pimh_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pimh_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projinvmappinghsty_pk' => 'Projinvmappinghsty Pk',
            'pimh_projecthsty_fk' => 'Pimh Projecthsty Fk',
            'pimh_memberregmst_fk' => 'Pimh Memberregmst Fk',
            'pimh_name' => 'Pimh Name',
            'pimh_emailid' => 'Pimh Emailid',
            'pimh_status' => 'Pimh Status',
            'pimh_order' => 'Pimh Order',
            'pimh_histcreatedon' => 'Pimh Histcreatedon',
            'pimh_appdeclon' => 'Pimh Appdeclon',
            'pimh_appdeclby' => 'Pimh Appdeclby',
            'pimh_appdeclbyipaddr' => 'Pimh Appdeclbyipaddr',
            'pimh_submittedon' => 'Pimh Submittedon',
            'pimh_submittedby' => 'Pimh Submittedby',
            'pimh_submittedbyipaddr' => 'Pimh Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimhAppdeclby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pimh_appdeclby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimhMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'pimh_memberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimhProjecthstyFk()
    {
        return $this->hasOne(ProjecthstyTbl::className(), ['projecthsty_pk' => 'pimh_projecthsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPimhSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pimh_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvmappinghstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjinvmappinghstyTblQuery(get_called_class());
    }
}
