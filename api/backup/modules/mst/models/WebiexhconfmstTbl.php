<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "webiexhconfmst_tbl".
 *
 * @property int $webiexhconfmst_pk
 * @property int $wec_type 1 - Webinar, 2 - Exhibition, 3 - Conference
 * @property string $wec_sharedname
 * @property int $wec_status 1 - Active, 2 -Inactive
 * @property string $wec_createdon Creation Datetime
 * @property int $wec_createdby Reference to usermst_tbl
 * @property string $wec_createdbyipaddr IP Address of the user
 * @property string $wec_updatedon Datetime of updation
 * @property int $wec_updatedby Reference to usermst_tbl
 * @property string $wec_updatedbyipaddr IP Address of the user
 */
class WebiexhconfmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'webiexhconfmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wec_type', 'wec_sharedname', 'wec_status', 'wec_createdby'], 'required'],
            [['wec_type', 'wec_status', 'wec_createdby', 'wec_updatedby'], 'integer'],
            [['wec_createdon', 'wec_updatedon'], 'safe'],
            [['wec_sharedname', 'wec_createdbyipaddr', 'wec_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'webiexhconfmst_pk' => 'Webiexhconfmst Pk',
            'wec_type' => 'Wec Type',
            'wec_sharedname' => 'Wec Sharedname',
            'wec_status' => 'Wec Status',
            'wec_createdon' => 'Wec Createdon',
            'wec_createdby' => 'Wec Createdby',
            'wec_createdbyipaddr' => 'Wec Createdbyipaddr',
            'wec_updatedon' => 'Wec Updatedon',
            'wec_updatedby' => 'Wec Updatedby',
            'wec_updatedbyipaddr' => 'Wec Updatedbyipaddr',
        ];
    }
}
