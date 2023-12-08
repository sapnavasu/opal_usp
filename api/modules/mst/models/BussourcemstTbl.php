<?php

namespace api\modules\mst\models;
use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "bussourcemst_tbl".
 *
 * @property int $BusSourceMst_Pk
 * @property string $BSM_BusSource
 * @property string $BSM_BSCategory
 * @property string $BSM_Status
 * @property string $BSM_CreatedOn
 * @property int $BSM_CreatedBy
 * @property string $BSM_UpdatedOn
 * @property int $BSM_UpdatedBy
 */
class BussourcemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bussourcemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BSM_BusSource', 'BSM_BSCategory', 'BSM_Status'], 'required'],
            [['BusSourceMst_Pk', 'BSM_CreatedBy', 'BSM_UpdatedBy'], 'integer'],
            [['BSM_BSCategory', 'BSM_Status'], 'string'],
            [['BSM_CreatedOn', 'BSM_UpdatedOn'], 'safe'],
            [['BSM_BusSource'], 'string', 'max' => 50],
            [['BusSourceMst_Pk'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'BusSourceMst_Pk' => 'Bus Source Mst  Pk',
            'BSM_BusSource' => 'Bsm  Bus Source',
            'BSM_BSCategory' => 'Bsm  Bscategory',
            'BSM_Status' => 'Bsm  Status',
            'BSM_CreatedOn' => 'Bsm  Created On',
            'BSM_CreatedBy' => 'Bsm  Created By',
            'BSM_UpdatedOn' => 'Bsm  Updated On',
            'BSM_UpdatedBy' => 'Bsm  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BussourcemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BussourcemstTblQuery(get_called_class());
    }
    public function behaviors()
    {
        // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
        return [
            [
                'class' => TimeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['BSM_CreatedOn'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['BSM_UpdatedOn'],
                ],
            ],
            [
                'class' => UserBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['BSM_CreatedBy'],
                    //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['FamM_UpdatedOn'],
                ],
            ],
        ];
    }
}
