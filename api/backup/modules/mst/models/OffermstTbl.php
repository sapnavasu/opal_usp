<?php
namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
/**
 * This is the model class for table "offermst_tbl".
 *
 * @property string $OfferMst_Pk
 * @property string $OM_OfferName
 * @property string $OM_OfferDescription
 * @property string $OM_ValFrOM
 * @property string $OM_ValThru
 * @property int $OM_Discount
 * @property string $OM_PrOMocode
 * @property string $OM_CreatedOn
 * @property int $OM_CreatedBy
 * @property string $OM_UpdatedOn
 * @property int $OM_UpdatedBy
 */
class OffermstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offermst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['OM_ValFrom', 'OM_ValThru'], 'safe'],
            [['OM_Discount', 'OM_CreatedBy', 'OM_UpdatedBy'], 'integer'],
            [['OM_OfferName'], 'string', 'max' => 50],
            [['OM_OfferDescription'], 'string', 'max' => 255],
            [['OM_Promocode'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'OfferMst_Pk' => 'Offer Mst  Pk',
            'OM_OfferName' => 'Om  Offer Name',
            'OM_OfferDescription' => 'Om  Offer Description',
            'OM_ValFrom' => 'Om  Val Fr Om',
            'OM_ValThru' => 'Om  Val Thru',
            'OM_Discount' => 'Om  Discount',
            'OM_PrOMocode' => 'Om  Pr Omocode',
            'OM_CreatedOn' => 'Om  Created On',
            'OM_CreatedBy' => 'Om  Created By',
            'OM_UpdatedOn' => 'Om  Updated On',
            'OM_UpdatedBy' => 'Om  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OffermstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OffermstTblQuery(get_called_class());
    }
    public function behaviors()
    {
        // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
        return [
            [
                'class' => TimeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['OM_CreatedOn'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['OM_UpdatedOn'],
                ],
            ],
            [
                'class' => UserBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['OM_CreatedBy'],
                    //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['CyM_UpdatedOn'],
                ],
            ],
        ];
    }
}
