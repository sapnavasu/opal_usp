<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "areamst_tbl".
 *
 * @property int $AreaMst_Pk
 * @property int $AM_CityMst_Fk
 * @property string $AM_AreaName
 * @property string $AM_AreaCoordinates
 * @property string $AM_PinCode
 * @property string $AM_Status
 * @property string $AM_CreatedOn
 * @property int $AM_CreatedBy
 * @property string $AM_UpdatedOn
 * @property int $AM_UpdatedBy
 *
 * @property CitymstTbl $aMCityMstFk
 */
class AreamstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'areamst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AM_CityMst_Fk', 'AM_AreaName', 'AM_AreaCoordinates'], 'required'],
            [['AM_CityMst_Fk', 'AM_CreatedBy', 'AM_UpdatedBy'], 'integer'],
            [['AM_Status'], 'string'],
            [['AM_CreatedOn', 'AM_UpdatedOn'], 'safe'],
            [['AM_AreaName', 'AM_AreaCoordinates'], 'string', 'max' => 100],
            [['AM_PinCode'], 'string', 'max' => 8],
            [['AM_CityMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => CitymstTbl::className(), 'targetAttribute' => ['AM_CityMst_Fk' => 'CityMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AreaMst_Pk' => 'Area Mst  Pk',
            'AM_CityMst_Fk' => 'Am  City Mst  Fk',
            'AM_AreaName' => 'Am  Area Name',
            'AM_AreaCoordinates' => 'Am  Area Coordinates',
            'AM_PinCode' => 'Am  Pin Code',
            'AM_Status' => 'Am  Status',
            'AM_CreatedOn' => 'Am  Created On',
            'AM_CreatedBy' => 'Am  Created By',
            'AM_UpdatedOn' => 'Am  Updated On',
            'AM_UpdatedBy' => 'Am  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAMCityMstFk()
    {
        return $this->hasOne(CitymstTbl::className(), ['CityMst_Pk' => 'AM_CityMst_Fk']);
    }

    /**
     * {@inheritdoc}
     * @return AreamstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AreamstTblQuery(get_called_class());
    }
	 public function behaviors()
    {
        // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
        return [
                [
                     'class' => TimeBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['AM_CreatedOn'],
                         ActiveRecord::EVENT_BEFORE_UPDATE => ['AM_UpdatedOn'],
                     ],
                 ],
                [
                     'class' => UserBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['AM_CreatedBy'],
//                         ActiveRecord::EVENT_BEFORE_UPDATE => ['CyM_UpdatedOn'],
                     ],
                 ],
        ];
    }
}

