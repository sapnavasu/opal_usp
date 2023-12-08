<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class JdomeetreskdTbl extends \yii\db\ActiveRecord
{

/**
 * This is the model class for table "jdomeetreskd_tbl"
 * @property int $jdomeetreskd_pk Primary key
 * @property int $jdmrs_jdomeetskdmember_fk Reference to Reference to jdomeetskdmember_tbl
 * @property string $jdmrs_reskddate Reschedule Meeting Date
 * @property int $jdmrs_reskd_timezone_fk Reference to timezone_tbl
 * @property string $jdmrs_reskd_starttime Reschedule Meeting start time
 * @property int $jdmrs_reskd_endtime Reschedule Meeting end time
 * @property string $jdmrs_status 1 - Submitted (Confirmation Pending), 2 - Approved, 3 - Declined, 4 - Meeting Overdue
 * @property int $jdmrs_appdeccomment Approve/ Decline Comment 
 * @property string $jdmrs_appdecon Datetime of creation
 * @property string $jdmrs_appdecby Reference to usermst_tbl
 * @property int $jdmrs_appdecipaddr IP Address of the user
 * @property string $jdmrs_createdon Datetime of creation
 * @property int $jdmrs_createdby Reference to usermst_tbl
 * @property string $jdmrs_createdbyipaddr IP Address of the user
 * @property string $jdmrs_updatedon Date of update
 * @property int $jdmrs_updatedby Reference to usermst_tbl
 * @property string $jdmrs_updatedbyipaddr User IP Address
 */


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdomeetreskd_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdmrs_jdomeetskdmember_fk', 'jdmrs_reskddate', 'jdmrs_reskd_timezone_fk', 'jdmrs_reskd_starttime', 'jdmrs_reskd_endtime', 'jdmrs_status'], 'required'],
            [['jdmrs_jdomeetskdmember_fk', 'jdmrs_reskd_timezone_fk', 'jdmrs_status', 'jdmrs_status', 'jdmrs_createdby'], 'integer'],
            [['jdmrs_reskddate', 'jdmrs_appdeccomment'], 'string']
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdmrs_jdomeetskdmember_fk' => 'Jdmrs Jdomeetskdmember Fk',
            'jdmrs_reskd_timezone_fk' => 'Jdmrs Reskd Timezone Fk',
            'jdmrs_reskddate' => 'Jdmsm Reskddate',
            'jdmrs_reskd_starttime' => 'Jdmsm Start Time',
            'jdmrs_reskd_endtime' => 'Jdmsm End Time'
        ];
    }
}
    