<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "timezone_tbl".
 *
 * @property int $timezone_pk Primary key
 * @property string $tz_countryname Country Name
 * @property string $tz_utcoffset Offset value
 * @property int $tz_status 1 - Active, 0 - InActive
 * @property string $tz_createdon Datetime of creation
 * @property int $tz_createdby Reference to adminusermst_tbl
 * @property string $tz_updatedon Datetime of updation
 * @property int $tz_updatedby Reference to adminusermst_tbl
 */
class TimezoneTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timezone_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tz_countryname', 'tz_utcoffset', 'tz_createdon', 'tz_createdby'], 'required'],
            [['tz_status', 'tz_createdby', 'tz_updatedby'], 'integer'],
            [['tz_createdon', 'tz_updatedon'], 'safe'],
            [['tz_countryname'], 'string', 'max' => 100],
            [['tz_utcoffset'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'timezone_pk' => 'Timezone Pk',
            'tz_countryname' => 'Tz Countryname',
            'tz_utcoffset' => 'Tz Utcoffset',
            'tz_status' => 'Tz Status',
            'tz_createdon' => 'Tz Createdon',
            'tz_createdby' => 'Tz Createdby',
            'tz_updatedon' => 'Tz Updatedon',
            'tz_updatedby' => 'Tz Updatedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TimezoneTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TimezoneTblQuery(get_called_class());
    }
	
    public static function getTimeZonesList(){
        return self::find()->select(['timezone_pk','tz_countryname','tz_utcoffset'])
                ->where('tz_status =:tz_status',[':tz_status' => 1])
                ->orderBy(['tz_utcoffset' => SORT_ASC])
                ->asArray()
                ->all();
    }

    public function getTimeZonesListCache(){
        return self::find()
            ->select(['max(tz_updatedon), count(*)'])
            ->createCommand()
            ->getRawSql();
    }
}
