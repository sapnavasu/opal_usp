<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\pd\models\ProjectdtlsTbl;

/**
 * This is the model class for table "projfaqdtls_tbl".
 *
 * @property int $projfaqdtls_pk Primary key
 * @property int $pfd_projectdtls_fk Reference to projectdtls_pk
 * @property string $pfd_question Question
 * @property string $pfd_answer Answer for the question
 * @property int $pfd_type 1 - General, 2 - Project, 3 - Product, 4 - Services
 * @property int $pfd_index index of the QA
 * @property int $pfd_status 1 - Active, 2 - Inactive
 * @property string $pfd_approvedon Datetime of approval
 * @property int $pfd_approvedby Reference to usermst_tbl
 * @property string $pfd_approvedbyipaddr User IP Address
 * @property string $pfd_submittedon Datetime of first submission
 * @property int $pfd_submittedby Reference to usermst_tbl
 * @property string $pfd_submittedbyipaddr User IP Address
 *
 * @property UsermstTbl $pfdApprovedby
 * @property ProjectdtlsTbl $pfdProjectdtlsFk
 * @property UsermstTbl $pfdSubmittedby
 */
class ProjfaqdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projfaqdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pfd_projectdtls_fk', 'pfd_type', 'pfd_index', 'pfd_status', 'pfd_approvedby', 'pfd_submittedby'], 'integer'],
            [['pfd_question', 'pfd_answer', 'pfd_type', 'pfd_status', 'pfd_approvedon', 'pfd_approvedby'], 'required'],
            [['pfd_question', 'pfd_answer'], 'string'],
            [['pfd_approvedon', 'pfd_submittedon'], 'safe'],
            [['pfd_approvedbyipaddr', 'pfd_submittedbyipaddr'], 'string', 'max' => 50],
            [['pfd_approvedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pfd_approvedby' => 'UserMst_Pk']],
            [['pfd_projectdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectdtlsTbl::className(), 'targetAttribute' => ['pfd_projectdtls_fk' => 'projectdtls_pk']],
            [['pfd_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pfd_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projfaqdtls_pk' => 'Projfaqdtls Pk',
            'pfd_projectdtls_fk' => 'Pfd Projectdtls Fk',
            'pfd_question' => 'Pfd Question',
            'pfd_answer' => 'Pfd Answer',
            'pfd_type' => 'Pfd Type',
            'pfd_index' => 'Pfd Index',
            'pfd_status' => 'Pfd Status',
            'pfd_approvedon' => 'Pfd Approvedon',
            'pfd_approvedby' => 'Pfd Approvedby',
            'pfd_approvedbyipaddr' => 'Pfd Approvedbyipaddr',
            'pfd_submittedon' => 'Pfd Submittedon',
            'pfd_submittedby' => 'Pfd Submittedby',
            'pfd_submittedbyipaddr' => 'Pfd Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPfdApprovedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pfd_approvedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPfdProjectdtlsFk()
    {
        return $this->hasOne(ProjectdtlsTbl::className(), ['projectdtls_pk' => 'pfd_projectdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPfdSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pfd_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjfaqdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjfaqdtlsTblQuery(get_called_class());
    }

    public static function deletefaq($pk) {
        try {
            if($pk) {
                $log_action = 3;
                $log_url  = '/j3/api/pm/profile/deletefaq';
                $model= self::findOne($pk);
                if($model->pfd_type == 3) {
                    $log_msg = 'Product FAQ Deleted';
                } else if($model->pfd_type == 4) {
                    $log_msg = 'Service FAQ Deleted';
                }

                $deletefaq = self::deleteAll('projfaqdtls_pk=:pk',[':pk'=>$pk]);
                \common\components\UserActivityLog::logUserActivity($log_action, $log_msg, $log_url,22);
            }
        } catch (\yii\base\Exception $ex) {
            $return = ['status' => 'Error', 'code' => 'E202', 'msg' => $ex->getMessage()];
        }
        return $return;
    }
}
