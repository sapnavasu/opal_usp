<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class for table "jdomeetingskdhdr_tbl"
 * @property int $jdomeetingskdhdr_pk Primary key
 * @property int $jdmsh_jdomoduledtl_fk Reference to jdomoduledtl_tbl
 * @property int $jdmsh_creator_jdotargetmember_fk created this notes: Reference to jdotargetmember_tbl
 * @property string $jdmsh_title Meeting Title
 * @property int $jdmsh_type Meeting Type: 1 - Online, 2 - Offline
 * @property int $jdmsh_presencetype Presence Type (Online): 1 - Skype, 2 - Zoom, 3 - Google Meet
 * @property string $jdmsh_meetingurl Meeting URL
 * @property string $jdmsh_meetingdate Meeting Date
 * @property int $jdmsh_meeting_timezone_fk Reference to timezone_tbl
 * @property string $jdmsh_starttime Meeting start time
 * @property string $jdmesh_endtime Meeting end time
 * @property string $jdmsh_notifybefore Notify before
 * @property string $jdmsh_meetingpurpose Purpose of the meeting
 * @property string $jdmsh_meetlocation Meeting Location
 * @property int $jdmsh_tomeet_mcm_fk Whom to meet: Reference to membercompanymst_tbl
 * @property string jdmsh_createdon Datetime of creation
 * @property int $jdmsh_createdby Reference to usermst_tbl
 * @property string $jdmsh_createdbyipaddr IP Address of the user
 * @property string $jdmsh_updatedon Date of update
 * @property int $jdmsh_updatedby Reference to usermst_tbl
 * @property string $jdmsh_updatedbyipaddr User IP Address
 */

class JdomeetingskdhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdomeetingskdhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdmsh_jdomoduledtl_fk', 'jdmsh_creator_jdotargetmember_fk', 'jdmsh_title', 'jdmsh_type', 'jdmsh_presencetype', 'jdmsh_starttime', 'jdmsh_endtime', 'jdmsh_meetingpurpose', 'jdmsh_tomeet_mcm_fk'], 'required'],
            [['jdmsh_jdomoduledtl_fk', 'jdmsh_creator_jdotargetmember_fk', 'jdmsh_type', 'jdmsh_presencetype', 'jdmsh_meeting_timezone_fk', 'jdmsh_tomeet_mcm_fk'], 'integer'],
            [['jdmsh_title', 'jdmsh_meetingpurpose'], 'string'],
            [['jdmsh_meetingdate', 'jdmsh_starttime', 'jdmsh_endtime'], 'safe'],
            [['jdmsh_title'], 'string', 'max' => 80],
            [['jdmsh_meetlocation'], 'string', 'max' => 50]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdomeetingskdhdr_pk' => 'Jdomeetingskdhdr Pk',
            'jdmsh_jdomoduledtl_fk' => 'Jdmsh Jdomoduledtl Fk',
            'jdmsh_creator_jdotargetmember_fk' => 'Jdmsh Creator Jdotargetmember Fk',
            'cmd_colprojaudience_fk' => 'Jdmsh Colprojaudience Fk',
            'jdmsh_title' => 'Jdmsh Meetingtitle',
            'jdmsh_type' => 'Jdmsh Meetingtype',
            'jdmsh_presencetype' => 'Jdmsh Presencetype',
            'jdmsh_meetingdate' => 'Jdmsh Meetingdate',
            'jdmsh_starttime' => 'Jdmsh Meetingstarttime',
            'jdmsh_endtime' => 'Jdmsh Meetingendtime',
            'jdmsh_notifybefore' => 'Jdmsh Notiftype',
            'jdmsh_meetlocation' => 'Jdmsh Meetlocation',
            'jdmsh_meetingpurpose' => 'Jdmsh Purposemeeting'
        ];
    }

      /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserpreference()
    {
        return $this->hasOne(\api\modules\ct\models\JdouserpreferenceTbl::className(), ['jdomeetingskdhdr_pk' => 'jdup_shared_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(\api\modules\ct\models\JdomeetskdmemberTbl::className(), ['jdmsm_jdomeetingskdhdr_fk' => 'jdomeetingskdhdr_pk']);
    }

}
