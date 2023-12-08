<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class for table "jdotaskhdr_tbl".
 *
 * @property int $jdotaskhdr_pk Primary key
 * @property int $jdth_jdomoduledtl_fk Reference to jdodiscussdtl_tbl
 * @property int $jdth_creator_jdotargetmember_fk created this task: Reference to jdotargetmember_tbl
 * @property string $jdth_tasktitle Task description
 * @property string $jdth_taskdesc Task description
 * @property string $jdth_task_timezone_fk Reference to timezone_tbl
 * @property string $jdth_taskdate Date of the task
 * @property int $jdth_tasktime Time of the task
 * @property int $jdth_notifybefore Notify before
 * @property int $jdth_notifyallday To Notify All Day : 1 - Yes, 2 - No
 * @property string $jdth_task_filepath Reference to memcompfiledtls_tbl in comma separation
 * @property int $jdth_status Status: 1 - In-Progress, 2 - Completed, 3 - Deleted
 * @property string $jdth_isdeleted Is Permanently Deleted: 1 - Yes, 2 - No 
 * @property string $jdth_createdon Datetime of creation  
 * @property int $jdth_createdby Reference to usermst_tbl
 * @property string $jdth_createdbyipaddr IP Address of the user
 * @property int $jdth_updatedon Date of update
 * @property int $jdth_updatedby Reference to usermst_tbl
 * @property int $jdth_updatedbyipaddr User IP Address 
 * 
 */
class JdotaskhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdotaskhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdth_jdomoduledtl_fk', 'jdth_creator_jdotargetmember_fk', 'jdth_tasktitle', 'jdth_taskdate', 'jdth_tasktime', 'jdth_taskdesc', 'jdth_createdby'], 'required'],
            [['jdth_jdomoduledtl_fk', 'jdth_creator_jdotargetmember_fk', 'jdth_status', 'jdth_isdeleted', 'jdth_createdby'], 'integer'],
            [['jdth_taskdesc','jdth_notifybefore'], 'string'],
            [['jdth_taskdate', 'jdth_tasktime', 'jdth_createdon'], 'safe'],
            [['jdth_tasktitle'], 'string', 'max' => 80],
            [['jdth_createdbyipaddr', 'jdth_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdotaskhdr_pk' => 'Jdotaskhdr Pk',
            'jdth_jdomoduledtl_fk' => 'Jdth Jdomoduledtl Fk',
            'jdth_tasktitle' => 'Jdth Tasktitle',
            'jdth_taskdesc' => 'Jdth Taskdesc',
            'jdth_taskdate' => 'Jdth Taskdate',
            'jdth_tasktime' => 'Jdth Tasktime',
            'jdth_notifybefore' => 'jdth Notify before',
            'jdth_notifyallday' => 'Jdth Notifyallday',
            'jdth_status' => 'Jdth Status',
            'jdth_task_filepath' => 'Jdth task filepath',
            'jdth_createdon' => 'Jdth Createdon',
            'jdth_createdby' => 'Jdth Createdby',
            'jdth_createdbyipaddr' => 'Jdth Createdbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserpreference()
    {
        return $this->hasOne(\api\modules\ct\models\JdouserpreferenceTbl::className(), ['jdotaskhdr_pk' => 'jdup_shared_fk']);
    }

    public function getAttachments(){
        return $this->hasMany(\api\modules\drv\models\MemcompfiledtlsTbl::class,  ['memcompfiledtls_pk' => 'jdth_task_filepath']);
    }
}
