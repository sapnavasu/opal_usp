<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class for table "jdonoteshdr_tbl".
 *
 * @property int $jdonoteshdr_pk Primary key
 * @property int $jdnh_jdomoduledtl_fk Reference to jdomoduledtl_tbl
 * @property int $jdnh_creator_jdotargetmember_fk created this notes: Reference to jdotargetmember_tbl
 * @property string $jdnh_notestitle Notes title
 * @property string $jdnh_notesdesc Notes description
 * @property int $jdnh_notes_timezone_fk Reference to timezone_tbl
 * @property string $jdnh_notesdate Date of the Notes
 * @property int $jdnh_notestime Time of the Notes
 * @property int $jdnh_notifybefore Notify before
 * @property int $jdnh_notifyallday To Notify All Day : 1 - Yes, 2 - No
 * @property string $jdnh_notes_filepath Reference to memcompfiledtls_tbl in comma separation
 * @property string $jdnh_status notes Status: 1 - In-Progress, 2 - Completed, 3 - Deleted
 * @property string $jdnh_createdon Datetime of creation
 * @property string $jdnh_createdby Reference to usermst_tbl
 * @property int $jdnh_createdbyipaddr IP Address of the user
 * @property int $jdnh_updatedon Date of update
 * @property int $jdh_updatedby Reference to usermst_tbl
 * @property int $jdnh_updatedbyipaddr User IP Address 
 * 
 */

class JdonoteshdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdonoteshdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdnh_jdomoduledtl_fk', 'jdnh_creator_jdotargetmember_fk', 'jdnh_notestitle', 'jdnh_notesdesc', 'jdnh_notesdate', 'jdnh_notestime'], 'required'],
            [['jdnh_jdomoduledtl_fk', 'jdnh_creator_jdotargetmember_fk', 'jdnh_notifyallday', 'jdnh_status', 'jdnh_isdeleted','jdnh_createdby', 'jdnh_notes_timezone_fk'], 'integer'],
            [['jdnh_notesdesc', 'jdnh_notes_filepath'], 'string'],
            [['jdnh_createdon', 'jdnh_updatedon'], 'safe'],
            [['jdnh_notestitle'], 'string', 'max' => 80],
            [['jdnh_createdbyipaddr', 'jdnh_updatedbyipaddr'], 'string', 'max' => 50]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdonoteshdr_pk' => 'Jdnh Jdomoduledtl Pk',
            'jdnh_jdomoduledtl_fk' => 'Jdnh Jdomoduledtl Fk',
            'jdnh_creator_jdotargetmember_fk' => 'Jdnh jdotargetmember Fk',
            'jdnh_notestitle' => 'Jdnh Notestitle',
            'jdnh_notesdesc' => 'Jdnh Notes Desc',
            'jdnh_notes_timezone_fk' => 'Jdnh notes timezone Fk',
            'jdnh_notesdate' => 'Jdnh Reminder',
            'jdnh_notestime' => 'Jdnh Reminderdt',
            'jdnh_notifybefore' => 'Jdnh Isallday',
            'jdnh_notifyallday' => 'Jdnh Notesstatus',
            'jdnh_notes_filepath' => 'Jdnh Pinit',
            'jdnh_status' => 'Jdnh Ipaddress',
            'jdnh_createdon' => 'Jdnh Createdon',
            'jdnh_updatedon' => 'Jdnh Updatedon',
            'jdnh_createdfrom' => 'Jdnh Createdfrom',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserpreference()
    {
        return $this->hasOne(\api\modules\ct\models\JdouserpreferenceTbl::className(), ['jdonoteshdr_pk' => 'jdup_shared_fk']);
    }
}
