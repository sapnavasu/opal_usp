<?php


namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "socialmediamst_tbl".
 *
 * @property int $socialmediamst_pk
 * @property string $sm_name
 * @property string $sm_icons
 * @property int $sm_order
 * @property int $sm_status 1 - Active 0 - Inactive
 */
class Socialmediamaster extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'socialmediamst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sm_name', 'sm_order', 'sm_status'], 'required'],
            [['sm_order', 'sm_status'], 'integer'],
            [['sm_name', 'sm_icons'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'socialmediamst_pk' => 'Socialmedia mst Pk',
            'sm_name' => 'Sm Name',
            'sm_icons' => 'Sm Icons',
            'sm_order' => 'Sm Order',
            'sm_status' => 'Sm Status',
        ];
    }


    /**
     * {@inheritdoc}
     * @return CountryMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountryMasterQuery(get_called_class());
    }
}