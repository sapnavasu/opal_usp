<?php

namespace app\models;

use Yii;
use api\components\Common;

/**
 * This is the model class for table "opaluserlogintrack_tbl".
 *
 * @property int $opaluserlogintrack_pk primary key
 * @property int $oult_opalusermst_fk reference to opalusermst_tbl
 * @property int $oult_loggedfrom 1 - Web, 2 - Android, 3 - IOS
 * @property string $oult_devicename Device Name
 * @property string $oult_deviceid
 * @property int $oult_loginstatus 1 - Logged in, 2 - Logged out, 3 - Session logout
 * @property string $oult_logintime Login datetime
 * @property string $oult_logouttime Logout datetime
 * @property string $oult_devipaddr Device IP Address
 */
class OpaluserlogintrackTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opaluserlogintrack_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oult_opalusermst_fk', 'oult_loggedfrom', 'oult_devicename', 'oult_logintime'], 'required'],
            [['oult_opalusermst_fk', 'oult_loggedfrom', 'oult_loginstatus'], 'integer'],
            [['oult_logintime', 'oult_logouttime'], 'safe'],
            [['oult_devicename'], 'string', 'max' => 50],
            [['oult_deviceid', 'oult_devipaddr'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opaluserlogintrack_pk' => 'Opaluserlogintrack Pk',
            'oult_opalusermst_fk' => 'Oult Opalusermst Fk',
            'oult_loggedfrom' => 'Oult Loggedfrom',
            'oult_devicename' => 'Oult Devicename',
            'oult_deviceid' => 'Oult Deviceid',
            'oult_loginstatus' => 'Oult Loginstatus',
            'oult_logintime' => 'Oult Logintime',
            'oult_logouttime' => 'Oult Logouttime',
            'oult_devipaddr' => 'Oult Devipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OpaluserlogintrackTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpaluserlogintrackTblQuery(get_called_class());
    }
    
    public function changeLogoutStatus($userpk) {
        $userIP = Common::getIpAddress();
        $model = self::find()
                ->where(['oult_opalusermst_fk' => $userpk])
                ->andWhere(['oult_devipaddr' => $userIP])
                ->one();
        $model->oult_loginstatus = 2;
        $model->oult_logouttime = Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
        return $model->save();
    }
    
    public function changeLogoutStat($userpk) {
        $userIP = Common::getIpAddress();
        $model = self::find()
                ->where(['oult_opalusermst_fk' => $userpk])
                ->andWhere(['oult_devipaddr' => $userIP])
                ->orderBy(['opaluserlogintrack_pk'=>SORT_DESC])
                ->one();
      if($model)
      {
          $model->oult_loginstatus = 2;
        $model->oult_logouttime = Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
        return $model->save();
          
      }
        
    }
}
