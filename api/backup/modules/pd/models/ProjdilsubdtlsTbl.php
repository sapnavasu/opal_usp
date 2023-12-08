<?php

namespace api\modules\pd\models;
use \common\models\UsermstTbl;

use Yii;

/**
 * This is the model class for table "projdilsubdtls_tbl".
 *
 * @property int $projdilsubdtls_pk Primary key
 * @property int $prdsd_projectdtls_fk Reference to projectdtls_tbl
 * @property int $prdsd_projeoisubdtls_fk Reference to projeoisubdtls_tbl
 * @property array $prdsd_onlineform Online form
 * @property string $prdsd_submittedon Date of first submission
 * @property int $prdsd_submittedby Submitted by user id
 * @property string $prdsd_submittedbyipaddr IP Address of the user
 * @property int $prdsd_status 1 - Posted for validation,2 - Approved, 3 - Declined, 4 - Resubmitted
 * @property string $prdsd_intamtforinv
 * @property string $prdsd_resubmittedon Resubmission date
 * @property int $prdsd_resubmittedby Resubmission by user id
 * @property string $prdsd_resubmittedbyipaddr IP Address of the user
 * @property string $prdsd_withdrawon Withdrawn datetime
 * @property int $prdsd_withdrawby Withdrawn by user id
 * @property string $prdsd_withdrawbyipaddr IP Addressof the user who has withdrawn the Diligence form
 * @property string $prdsd_appdeclon Approved / Declined on
 * @property int $prdsd_appdeclby Approved / Declined by user id
 * @property string $prdsd_appdeclbyipaddr IP Address of the user
 * @property string $prdsd_comments Comments for decline
 * @property string $prdsd_updatedon Datetime of creation
 * @property int $prdsd_updatedby Reference to usermst_tbl
 * @property string $prdsd_updatedbyipaddr IP address of the user
 *
 * @property UsermstTbl $prdsdAppdeclby
 * @property ProjectdtlsTbl $prdsdProjectdtlsFk
 * @property ProjeoisubdtlsTbl $prdsdProjeoisubdtlsFk
 * @property UsermstTbl $prdsdResubmittedby
 * @property UsermstTbl $prdsdSubmittedby
 * @property UsermstTbl $prdsdWithdrawby
 */
class ProjdilsubdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projdilsubdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prdsd_projectdtls_fk', 'prdsd_projeoisubdtls_fk', 'prdsd_submittedon', 'prdsd_submittedby'], 'required'],
            [['prdsd_projectdtls_fk', 'prdsd_projeoisubdtls_fk', 'prdsd_submittedby', 'prdsd_status', 'prdsd_resubmittedby', 'prdsd_withdrawby', 'prdsd_appdeclby', 'prdsd_updatedby'], 'integer'],
            [['prdsd_onlineform', 'prdsd_submittedon', 'prdsd_resubmittedon', 'prdsd_withdrawon', 'prdsd_appdeclon', 'prdsd_updatedon'], 'safe'],
            [['prdsd_intamtforinv'], 'number'],
            [['prdsd_comments'], 'string'],
            [['prdsd_submittedbyipaddr', 'prdsd_resubmittedbyipaddr', 'prdsd_withdrawbyipaddr', 'prdsd_appdeclbyipaddr', 'prdsd_updatedbyipaddr'], 'string', 'max' => 50],
            [['prdsd_appdeclby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prdsd_appdeclby' => 'UserMst_Pk']],
            [['prdsd_projectdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectdtlsTbl::className(), 'targetAttribute' => ['prdsd_projectdtls_fk' => 'projectdtls_pk']],
            [['prdsd_projeoisubdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjeoisubdtlsTbl::className(), 'targetAttribute' => ['prdsd_projeoisubdtls_fk' => 'projeoisubdtls_pk']],
            [['prdsd_resubmittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prdsd_resubmittedby' => 'UserMst_Pk']],
            [['prdsd_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prdsd_submittedby' => 'UserMst_Pk']],
            [['prdsd_withdrawby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prdsd_withdrawby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projdilsubdtls_pk' => 'Projdilsubdtls Pk',
            'prdsd_projectdtls_fk' => 'Prdsd Projectdtls Fk',
            'prdsd_projeoisubdtls_fk' => 'Prdsd Projeoisubdtls Fk',
            'prdsd_onlineform' => 'Prdsd Onlineform',
            'prdsd_submittedon' => 'Prdsd Submittedon',
            'prdsd_submittedby' => 'Prdsd Submittedby',
            'prdsd_submittedbyipaddr' => 'Prdsd Submittedbyipaddr',
            'prdsd_status' => 'Prdsd Status',
            'prdsd_intamtforinv' => 'Prdsd Intamtforinv',
            'prdsd_resubmittedon' => 'Prdsd Resubmittedon',
            'prdsd_resubmittedby' => 'Prdsd Resubmittedby',
            'prdsd_resubmittedbyipaddr' => 'Prdsd Resubmittedbyipaddr',
            'prdsd_withdrawon' => 'Prdsd Withdrawon',
            'prdsd_withdrawby' => 'Prdsd Withdrawby',
            'prdsd_withdrawbyipaddr' => 'Prdsd Withdrawbyipaddr',
            'prdsd_appdeclon' => 'Prdsd Appdeclon',
            'prdsd_appdeclby' => 'Prdsd Appdeclby',
            'prdsd_appdeclbyipaddr' => 'Prdsd Appdeclbyipaddr',
            'prdsd_comments' => 'Prdsd Comments',
            'prdsd_updatedon' => 'Prdsd Updatedon',
            'prdsd_updatedby' => 'Prdsd Updatedby',
            'prdsd_updatedbyipaddr' => 'Prdsd Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrdsdAppdeclby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prdsd_appdeclby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrdsdProjectdtlsFk()
    {
        return $this->hasOne(ProjectdtlsTbl::className(), ['projectdtls_pk' => 'prdsd_projectdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrdsdProjeoisubdtlsFk()
    {
        return $this->hasOne(ProjeoisubdtlsTbl::className(), ['projeoisubdtls_pk' => 'prdsd_projeoisubdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrdsdResubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prdsd_resubmittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrdsdSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prdsd_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrdsdWithdrawby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prdsd_withdrawby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjdilsubdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjdilsubdtlsTblQuery(get_called_class());
    }
}
