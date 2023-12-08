<?php

namespace api\modules\gcc\models;

use Yii;

/**
 * This is the model class for table "gcctendsectorsubsdtls_tbl".
 *
 * @property int $gcctendsectorsubsdtls_pk Used as primary key
 * @property int $gtssd_gcctendsubsdtls_fk Reference to the GCC tender subscription details table
 * @property int $gtssd_gcctendsectmst_fk Reference to GCC tender sector master table
 * @property int $gtssd_jsrst3invoicedtls_fk Reference to jsrst3invoicedtls_tbl
 * @property int $gtssd_gccsubstrnsdtls_fk Reference to gccsubstrnsdtls_tbl
 * @property int $gtssd_pymttype 1 - Online, 2 - Offline
 * @property int $gtssd_totaltenders Total number of received tenders which are not deleted
 * @property int $gtssd_unreadtend Total number of unread tenders which are not deleted
 * @property int $gtssd_subscriptiontype Subscription Type. 1 - Paid , 0 - Free
 * @property int $gtssd_subscriptionstatus Subscription status. 1 - Yet to pay (Fresh), 2 - Paid - Verification pending, 3 - Approved, 4 - Declined, 5 - Posted for Renewal, 6 - Yet to pay (Renew), 7 - N/A, 8 - In-Progress(Fresh), 9 - In-Progress(Renew)
 * @property string $gtssd_subscribedfrom Subscription from date
 * @property string $gtssd_subscribedto Subscription to date
 * @property string $gtssd_appdeclon Approval / Declined on
 * @property int $gtssd_appdeclby Reference to usermst_tbl
 * @property string $gtssd_appdeclcmt Approval / Declined Comment
 * @property string $gtssd_appdeclipaddr IP Address of the approval / declined by user
 * @property string $gtssd_createdon The date and time when the record is created
 * @property int $gtssd_createdby The ID of the login session ID when the record is created. Reference to UserMasterPk
 * @property string $gtssd_createdbyipaddr IP Address of the created by user
 * @property string $gtssd_updatedon The date and time when the record is updated
 * @property int $gtssd_updatedby The ID of the login session ID when the record is updated. Reference to UserMasterPk
 * @property string $gtssd_updatedbyipaddr IP Address of the updated by user
 */
class gcctendsectorsubsdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gcctendsectorsubsdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gtssd_gcctendsubsdtls_fk', 'gtssd_gcctendsectmst_fk', 'gtssd_totaltenders', 'gtssd_unreadtend', 'gtssd_subscriptiontype', 'gtssd_createdon', 'gtssd_createdby'], 'required'],
            [['gtssd_gcctendsubsdtls_fk', 'gtssd_gcctendsectmst_fk', 'gtssd_jsrst3invoicedtls_fk', 'gtssd_gccsubstrnsdtls_fk', 'gtssd_pymttype', 'gtssd_totaltenders', 'gtssd_unreadtend', 'gtssd_subscriptiontype', 'gtssd_subscriptionstatus', 'gtssd_appdeclby', 'gtssd_createdby', 'gtssd_updatedby'], 'integer'],
            [['gtssd_subscribedfrom', 'gtssd_subscribedto', 'gtssd_appdeclon', 'gtssd_createdon', 'gtssd_updatedon'], 'safe'],
            [['gtssd_appdeclcmt'], 'string'],
            [['gtssd_appdeclipaddr', 'gtssd_createdbyipaddr', 'gtssd_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gcctendsectorsubsdtls_pk' => 'Gcctendsectorsubsdtls Pk',
            'gtssd_gcctendsubsdtls_fk' => 'Gtssd Gcctendsubsdtls Fk',
            'gtssd_gcctendsectmst_fk' => 'Gtssd Gcctendsectmst Fk',
            'gtssd_jsrst3invoicedtls_fk' => 'Gtssd Jsrst3invoicedtls Fk',
            'gtssd_gccsubstrnsdtls_fk' => 'Gtssd Gccsubstrnsdtls Fk',
            'gtssd_pymttype' => 'Gtssd Pymttype',
            'gtssd_totaltenders' => 'Gtssd Totaltenders',
            'gtssd_unreadtend' => 'Gtssd Unreadtend',
            'gtssd_subscriptiontype' => 'Gtssd Subscriptiontype',
            'gtssd_subscriptionstatus' => 'Gtssd Subscriptionstatus',
            'gtssd_subscribedfrom' => 'Gtssd Subscribedfrom',
            'gtssd_subscribedto' => 'Gtssd Subscribedto',
            'gtssd_appdeclon' => 'Gtssd Appdeclon',
            'gtssd_appdeclby' => 'Gtssd Appdeclby',
            'gtssd_appdeclcmt' => 'Gtssd Appdeclcmt',
            'gtssd_appdeclipaddr' => 'Gtssd Appdeclipaddr',
            'gtssd_createdon' => 'Gtssd Createdon',
            'gtssd_createdby' => 'Gtssd Createdby',
            'gtssd_createdbyipaddr' => 'Gtssd Createdbyipaddr',
            'gtssd_updatedon' => 'Gtssd Updatedon',
            'gtssd_updatedby' => 'Gtssd Updatedby',
            'gtssd_updatedbyipaddr' => 'Gtssd Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return gcctendsectorsubsdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new gcctendsectorsubsdtlsTblQuery(get_called_class());
    }
}
