<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projtendtmp_tbl".
 *
 * @property int $projtendtmp_pk Primary key
 * @property int $ptt_projecttmp_fk Reference to projecttmp_tbl
 * @property int $ptt_tendertype 1 - Global,2 - Limited/Restricted,3 - EOI,4 - Empanelment,5 - Open
 * @property int $ptt_bidstage 1 - Single Stage,2 - Two Stage,3 - Three Stage
 * @property int $ptt_bidprocess 1 - Online/e-tendering,2 - Offline
 * @property string $ptt_tenderid Tender id / Tender Reference number
 * @property string $ptt_engagementcost Project / Engagement Cost
 * @property int $ptt_compltime Time for Completion (In Months)
 * @property string $ptt_tendportal Etender / Portal
 * @property int $ptt_noticeperiod RFP Notice Period
 * @property string $ptt_bidduedt Due Date for the Bid
 * @property string $ptt_tendopeningdt Tender opening date
 * @property string $ptt_agreesign Agreement signing date
 * @property string $ptt_memcompfiledtls_fk Reference to memcompfiledtls_tbl
 * @property string $ptt_submittedon Date of submission
 * @property int $ptt_submittedby Reference to usermst
 * @property string $ptt_submittedbyipaddr IP Address of the user
 * @property string $ptt_updatedon Date of updation
 * @property int $ptt_updatedby Reference to usermst_tbl
 * @property string $ptt_updatedbyipaddr IP Address of the user
 */
class ProjtendtmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projtendtmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ptt_projecttmp_fk', 'ptt_submittedon', 'ptt_submittedby'], 'required'],
            [['ptt_projecttmp_fk', 'ptt_tendertype', 'ptt_bidstage', 'ptt_bidprocess', 'ptt_compltime', 'ptt_noticeperiod', 'ptt_submittedby', 'ptt_updatedby'], 'integer'],
            [['ptt_engagementcost'], 'number'],
            [['ptt_tendportal', 'ptt_memcompfiledtls_fk'], 'string'],
            [['ptt_bidduedt', 'ptt_tendopeningdt', 'ptt_agreesign', 'ptt_submittedon', 'ptt_updatedon'], 'safe'],
            [['ptt_tenderid'], 'string', 'max' => 30],
            [['ptt_submittedbyipaddr', 'ptt_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projtendtmp_pk' => 'Projtendtmp Pk',
            'ptt_projecttmp_fk' => 'Ptt Projecttmp Fk',
            'ptt_tendertype' => 'Ptt Tendertype',
            'ptt_bidstage' => 'Ptt Bidstage',
            'ptt_bidprocess' => 'Ptt Bidprocess',
            'ptt_tenderid' => 'Ptt Tenderid',
            'ptt_engagementcost' => 'Ptt Engagementcost',
            'ptt_compltime' => 'Ptt Compltime',
            'ptt_tendportal' => 'Ptt Tendportal',
            'ptt_noticeperiod' => 'Ptt Noticeperiod',
            'ptt_bidduedt' => 'Ptt Bidduedt',
            'ptt_tendopeningdt' => 'Ptt Tendopeningdt',
            'ptt_agreesign' => 'Ptt Agreesign',
            'ptt_memcompfiledtls_fk' => 'Ptt Memcompfiledtls Fk',
            'ptt_submittedon' => 'Ptt Submittedon',
            'ptt_submittedby' => 'Ptt Submittedby',
            'ptt_submittedbyipaddr' => 'Ptt Submittedbyipaddr',
            'ptt_updatedon' => 'Ptt Updatedon',
            'ptt_updatedby' => 'Ptt Updatedby',
            'ptt_updatedbyipaddr' => 'Ptt Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjtendtmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjtendtmpTblQuery(get_called_class());
    }
}
