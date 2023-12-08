<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class JdomeetskdmemberTbl extends \yii\db\ActiveRecord{

/**
 * This is the model class for table "jdomeetskdmember_tbl"
 * @property int $jdomeetskdmember_pk Primary key
 * @property int $jdmsm_jdomeetingskdhdr_fk Reference to jdomeetingskdhdr_tbl
 * @property int $jdmsm_jdotargetmember_fk Targetted Internal members: Reference to jdotargetmember_tbl
 * @property int $jdmsm_response Response: 1 - Invited, 2 - Attending, 3 - Not Attending, 4 - Rescheduled
 * @property string $jdmsm_responsecomment Comments if not attending
 * @property int $jdmsm_status 1 - Active, 2 - Inactive
 * @property string $jdmsm_createdon Datetime of creation
 * @property int $jdmsm_createdby Reference to usermst_tbl
 * @property string $jdmsm_createdbyipaddr IP Address of the user
 * @property string $jdmsm_updatedon Date of update
 * @property int $jdmsm_updatedby Reference to usermst_tbl
 * @property string $jdmsm_updatedbyipaddr User IP Address
 */


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdomeetskdmember_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdmsm_jdomeetingskdhdr_fk', 'jdmsm_jdotargetmember_fk', 'jdmsm_response', 'jdmsm_status'], 'required'],
            [['jdmsm_jdomeetingskdhdr_fk', 'jdmsm_jdotargetmember_fk', 'jdmsm_status'], 'integer'],
            [['jdmsm_responsecomment'], 'string']
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdmsm_jdomeetingskdhdr_fk' => 'Jdmsm Jdomeetinghdr Fk',
            'jdmsm_jdotargetmember_fk' => 'Jdmsm Jdotargetmember Fk',
            'jdmsm_response' => 'Jdmsm Response',
            'jdmsm_status' => 'Jdmsm Status',
        ];
    }

    public function getTargetmember(){
        return $this->hasOne(\api\modules\ct\models\JdotargetmemberTbl::class, ['jdotargetmember_pk' => 'jdmsm_jdotargetmember_fk']);
    }
}