<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class for table "jdodiscusshdr_tbl".
 *
 * @property int $jdodiscusshdr_pk Primary key
 * @property int $jddh_jdomoduledtl_fk Reference to jdomoduledtl_tbl
 * @property int $jddh_creator_jdotargetmember_fk Initiated by (User who created this discussion): Reference to jdotargetmember_tbl
 * @property string $jddh_topic Discussion Topic
 * @property string $jddh_desc Discussion Description
 * @property string $jddh_filepath Reference to memcompfiledtls_tbl in comma separation
 * @property int $jddh_status Discussion status. 1 - Active, 2 - Inactive, 3 - Closed (can be closed only who created the discussion)
 * @property string $jddh_createdon Date of creation
 * @property int $jddh_createdby Reference to timezone_tbl
 * @property string $jddh_createdbyipaddr User IP Address
 * @property string $jddh_createdon Date of creation
 * @property string $jddh_updatedon Date of update
 * @property int $jddh_updatedby Reference to usermst_tbl
 * @property string $jddh_updatedbyipaddr User IP Address
 * @property string jddh_closedon Date of closed
 * @property int jddh_closedby Reference to usermst_tbl
 * @property string jddh_closedbyipaddr User IP Address
 */
class JdodiscusshdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdodiscusshdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jddh_jdomoduledtl_fk', 'jddh_topic', 'jddh_desc', 'jddh_status', 'jddh_creator_jdotargetmember_fk'], 'required'],
            [['jddh_jdomoduledtl_fk', 'jddh_status', 'jddh_creator_jdotargetmember_fk'], 'integer'],
            [['jddh_topic', 'jddh_desc'], 'string'],
            [['jddh_createdon'], 'safe'],
            [['jddh_createdbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdodiscusshdr_pk' => 'Jdodiscusshdr Pk',
            'jddh_jdomoduledtl_fk' => 'Jddh Jdomoduledtl Fk',
            'jddh_creator_jdotargetmember_fk' => 'Jddh jdotargetmember Fk',
            'jddh_topic' => 'Jddh Topic',
            'jddh_desc' => 'jddh desc',
            'jddh_filepath' => 'jddh Replypath',
            'jddh_status' => 'jddh Isread',
            'jddh_createdon' => 'Jddh Ipaddress',
            'jddh_createdby' => 'Jddh Timezone',
            'jddh_createdbyipaddr' => 'Jddh Createdon',
            'jddh_updatedon' => 'Jddh updatedon',
            'jddh_updatedby' => 'Jddh Updatedby',
            'jddh_updatedbyipaddr' => 'Jddh Updatedbyipaddress',
            'jddh_closedon' => 'Jddh Closedon',
            'jddh_closedby' => 'Jddh Colsedby',
            'jddh_closedbyipaddr' => 'jddh Closedbyipadr'
        ];
    }
    
    public function getMembers(){
        return $this->hasMany(\api\modules\ct\models\JdodiscussmemberTbl::class, ['jddm_jdodiscusshdr_fk' => 'jdodiscusshdr_pk']);
    }
}
