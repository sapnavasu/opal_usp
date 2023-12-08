<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "offerrulemst_tbl".
 *
 * @property string $OfferRuleMst_Pk
 * @property int $ORM_OfferMst_Fk
 * @property string $ORM_OfferRule
 */
class OfferrulemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offerrulemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ORM_OfferMst_Fk'], 'integer'],
            [['ORM_OfferRule'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'OfferRuleMst_Pk' => 'Offer Rule Mst  Pk',
            'ORM_OfferMst_Fk' => 'Orm  Offer Mst  Fk',
            'ORM_OfferRule' => 'Orm  Offer Rule',
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
}
