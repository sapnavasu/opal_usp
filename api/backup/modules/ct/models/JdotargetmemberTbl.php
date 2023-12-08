<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use common\components\Security;
use \common\models\UsermstTbl;

/**
 * This is the model class for table "jdotargetmember_tbl".
 *
 * @property int $jdotargetmember_pk Primary key
 * @property int $jdtm_jdomoduledtl_fk Reference to jdomoduledtl_tbl
 * @property int $jdtm_usertype Type of User (User who created the card will by default be Interanl user) : 1 - Internal User, 2 - External User
 * @property int $jdtm_target_membercompmst_fk Reference to membercompanymst_tbl
 * @property int $jdtm_target_usermst_fk Reference to usermst_tbl
 * @property int $jdtm_invitestatus Invite Status: 1 - User who created the Card, 2 - Invited, 3 - Accepted
 * @property int $jdtm_userstatus Status of the user for the card (In the beginning created user will be in Active and invited users will be in N/A): 1 - N/A (Yet to Accept), 2 - Active, 3 - Inactive
 * @property int $jdtm_createdon Date of creation
 * @property string $jdtm_createdby Reference to usermst_tbl
 * @property string $jdtm_createdbyipaddr User IP Address
 * @property string $jdtm_invitedon Date of Invite
 * @property string $jdtm_acceptedon Date of Accepted
 * @property string jdtm_rejoinedon Date of Rejoined (When user leaves a card and added by Admin again)
 * 
 */
class JdotargetmemberTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdotargetmember_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdtm_jdomoduledtl_fk', 'jdtm_usertype', 'jdtm_target_usermst_fk','jdtm_target_membercompmst_fk', 'jdtm_invitestatus', 'jdtm_createdon'], 'required'],
            [['jdtm_jdomoduledtl_fk', 'jdtm_usertype', 'jdtm_target_membercompmst_fk', 'jdtm_target_usermst_fk', 'jdtm_invitestatus', 'jdtm_userstatus'], 'integer'],
            [['jdtm_createdon', 'jdtm_invitedon', 'jdtm_acceptedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdotargetmember_pk' => 'Jdotargetmember Pk',
            'jdtm_jdomoduledtl_fk' => 'Jdtm Jdomoduledtl Fk',
            'jdtm_usertype' => 'Jdtm Usertype',
            'jdtm_target_membercompmst_fk' => 'Jdtm Membercompmst Fk',
            'jdtm_target_usermst_fk' => 'Jdtm Targetusers usermst_tbl',
            'jdtm_invitestatus' => 'Jdtm Invitestatus',
            'jdtm_userstatus' => 'Jdtm userstatus',
            'cpa_isdiscussion' => 'Jdtm Isdiscussion',
            'jdtm_createdon' => 'Jdtm Createdon',
            'jdtm_createdby' => 'Jdtm Createdby',
            'jdtm_createdbyipaddr' => 'Jdtm Createdbyipaddr',
            'jdtm_invitedon' => 'Jdtm Invitedon',
            'jdtm_acceptedon' => 'Jdtm Acceptedon',
            'jdtm_rejoinedon' =>  'Jdtm Rejoinedon'
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\UsermstTbl::className(), ['UserMst_Pk' => 'jdtm_target_membercompmst_fk']);
    }
}
