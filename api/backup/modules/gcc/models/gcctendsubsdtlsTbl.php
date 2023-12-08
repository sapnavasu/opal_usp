<?php

namespace api\modules\gcc\models;

use Yii;

/**
 * This is the model class for table "gcctendsubsdtls_tbl".
 *
 * @property int $gcctendsubsdtls_pk
 * @property int $gtsd_membcompmst_fk Reference to the member company from which the Subscription is added
 * @property int $gtsd_subscriptionstatus If there are any subscription made. ‘1’ – Yes, ‘0’ - No
 * @property int $gtsd_totalsectorsubscription The number of subscribed sectors
 * @property string $gtsd_subscribedcountries List of Countries subscribed separated by comma
 * @property string $gtsd_createdon The date and time when the record is created
 * @property string $gtsd_updatedon The date and time when the record is last updated
 */
class gcctendsubsdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gcctendsubsdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gtsd_membcompmst_fk', 'gtsd_subscriptionstatus', 'gtsd_totalsectorsubscription', 'gtsd_createdon'], 'required'],
            [['gtsd_membcompmst_fk', 'gtsd_subscriptionstatus', 'gtsd_totalsectorsubscription'], 'integer'],
            [['gtsd_createdon', 'gtsd_updatedon'], 'safe'],
            [['gtsd_subscribedcountries'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gcctendsubsdtls_pk' => 'Gcctendsubsdtls Pk',
            'gtsd_membcompmst_fk' => 'Gtsd Membcompmst Fk',
            'gtsd_subscriptionstatus' => 'Gtsd Subscriptionstatus',
            'gtsd_totalsectorsubscription' => 'Gtsd Totalsectorsubscription',
            'gtsd_subscribedcountries' => 'Gtsd Subscribedcountries',
            'gtsd_createdon' => 'Gtsd Createdon',
            'gtsd_updatedon' => 'Gtsd Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return gcctendsectdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new gcctendsubsdtlsTblQuery(get_called_class());
    }
}
