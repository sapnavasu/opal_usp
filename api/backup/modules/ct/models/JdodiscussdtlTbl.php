<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class for table "jdodiscussdtl_tbl".
 *
 * @property int $jdodiscussdtl_pk Primary key
 * @property int $jddd_jdodiscusshdr_fk Reference to jdodiscusshdr_tbl
 * @property int $jddd_jdodiscussmember_fk Reference to jdodiscussmember_tbl
 * @property string $jddd_reply_message Reference to Reply message
 * @property int $jddd_reply_filepath Reference to memcompfiledtls_tbl
 * @property int $jddd_isdeleted Read status. 1 - Yes, 2 - No 
 * @property int $cdd_isread Read status. 0 - Unread,1 - Read, 2 - Deleted
 * @property string $jddd_createdbyipaddr IP Address of the user
 * @property int $jddd_createdby refert to usermst_tbl
 * @property string $jddd_createdon Date of creation
 * @property string $jddd_updatedon Date of updation 
 * @property int $jddd_updatedby refert to usermst_tbl 
 * @property string $jddd_updatedbyipaddr IP Address of the user 
 */
class JdodiscussdtlTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdodiscussdtl_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jddd_jdodiscusshdr_fk', 'jddd_jdodiscussmember_fk', 'jddd_reply_message','jddd_createdbyipaddr', 'jddd_createdon'], 'required'],
            [['jddd_jdodiscusshdr_fk', 'jddd_jdodiscussmember_fk'], 'integer'],//'jddd_reply_filepath'
            [['jddd_reply_message','jddd_reply_filepath'], 'string'],
            [['jddd_createdon'], 'safe'],
            [['jddd_createdbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdodiscussdtl_pk' => 'Coldiscussdtls Pk',
            'jddd_jdodiscusshdr_fk' => 'Jdd Jdodiscusshdr Fk',
            'cdd_replyfromprojaudience_fk' => 'Cdd Replyfromprojaudience Fk',
            'jddd_reply_message' => 'Jddd Replymessage',
            'jddd_reply_filepath' => 'Jddd Reply path',
            'jddd_createdbyipaddr' => 'Cdd Ipaddress',
            'jddd_createdon' => 'Jddd Createdon',
            'jddd_createdby' => 'Jddd Createdby',
            'cdd_createdfrom' => 'Cdd Createdfrom',
        ];
    }

}
