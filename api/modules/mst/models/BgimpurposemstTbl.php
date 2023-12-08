<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
/**
 * This is the model class for table "bgimpurposemst_tbl".
 *
 * @property int $BGIMPurposeMst_Pk
 * @property string $BGIMPM_Purpose
 * @property string $BGIMPM_Status
 * @property string $BGIMPM_CreatedOn
 * @property int $BGIMPM_CreatedBy
 */
class BgimpurposemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bgimpurposemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BGIMPM_Purpose'], 'required'],
            [['BGIMPM_Purpose'], 'unique'],
            [['BGIMPM_Status'], 'string'],
            [['BGIMPM_CreatedOn'], 'safe'],
            [['BGIMPM_CreatedBy'], 'integer'],
            [['BGIMPM_Purpose'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'BGIMPurposeMst_Pk' => 'Bgimpurpose Mst  Pk',
            'BGIMPM_Purpose' => 'Bgimpm  Purpose',
            'BGIMPM_Status' => 'Bgimpm  Status',
            'BGIMPM_CreatedOn' => 'Bgimpm  Created On',
            'BGIMPM_CreatedBy' => 'Bgimpm  Created By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BgimpurposemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BgimpurposemstTblQuery(get_called_class());
    }
	public function behaviors()
    {
            // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
            return [
               [
                    'class' => TimeBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['BGIMPM_CreatedOn'],
                    ],
                ],
               [
                    'class' => UserBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['BGIMPM_CreatedBy'],
            //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['FamM_UpdatedOn'],
                    ],
                ],
            ];
    }
}
