<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscriptionmst_tbl".
 *
 * @property int $subscriptionmst_pk Primary key
 * @property int $sm_classificationmst_fk Reference to classificationmst_tbl.ClassificationMst_Pk
 * @property string $sm_packagename Package Name
 * @property string $sm_packagedesc Package description
 * @property string $sm_valfrom Validity from
 * @property int $sm_valtospecify 1 - Yes, 2 - No
 * @property string $sm_valto Validity to
 * @property string $sm_baseprice Base price of the pack
 * @property int $sm_basecurrency Reference to currencymst_tbl
 * @property int $sm_discountval Discounted Value
 * @property int $sm_discountper Discount in percentage
 * @property int $sm_status 1 - Active, 2 - Inactive
 * @property string $sm_createdon
 * @property int $sm_createdby reference to usermst_tbl
 * @property string $sm_updatedon
 * @property int $sm_updatedby reference to usermst_tbl
 */
class SubscriptionmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscriptionmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sm_classificationmst_fk', 'sm_packagename', 'sm_valfrom', 'sm_valtospecify', 'sm_baseprice', 'sm_basecurrency', 'sm_discountval', 'sm_discountper', 'sm_status', 'sm_createdon', 'sm_createdby'], 'required'],
            [['sm_classificationmst_fk', 'sm_valtospecify', 'sm_basecurrency', 'sm_discountval', 'sm_discountper', 'sm_status', 'sm_createdby', 'sm_updatedby'], 'integer'],
            [['sm_packagedesc'], 'string'],
            [['sm_valfrom', 'sm_valto', 'sm_createdon', 'sm_updatedon'], 'safe'],
            [['sm_baseprice'], 'number'],
            [['sm_packagename'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subscriptionmst_pk' => 'Subscriptionmst Pk',
            'sm_classificationmst_fk' => 'Sm Classificationmst Fk',
            'sm_packagename' => 'Sm Packagename',
            'sm_packagedesc' => 'Sm Packagedesc',
            'sm_valfrom' => 'Sm Valfrom',
            'sm_valtospecify' => 'Sm Valtospecify',
            'sm_valto' => 'Sm Valto',
            'sm_baseprice' => 'Sm Baseprice',
            'sm_basecurrency' => 'Sm Basecurrency',
            'sm_discountval' => 'Sm Discountval',
            'sm_discountper' => 'Sm Discountper',
            'sm_status' => 'Sm Status',
            'sm_createdon' => 'Sm Createdon',
            'sm_createdby' => 'Sm Createdby',
            'sm_updatedon' => 'Sm Updatedon',
            'sm_updatedby' => 'Sm Updatedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SubscriptionmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscriptionmstTblQuery(get_called_class());
    }
}
