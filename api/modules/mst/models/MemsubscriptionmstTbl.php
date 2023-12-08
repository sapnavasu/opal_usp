<?php

namespace api\modules\mst\models;

use Yii;
use api\modules\mst\models\CurrencymstTbl;

/**
 * This is the model class for table "memsubscriptionmst_tbl".
 *
 * @property int $memsubscriptionmst_pk Primary key
 * @property int $msm_classificationmst_fk Reference to classificationmst_tbl.ClassificationMst_Pk
 * @property int $msm_isbasepack 1 - Yes, 2 - No
 * @property int $msm_origin 1 - National, 2 - International
 * @property string $msm_packagename Package Name
 * @property string $msm_packagedesc Package description
 * @property string $msm_valfrom Validity from
 * @property int $msm_valtospecify 1 - Yes, 2 - No
 * @property string $msm_valto Validity to
 * @property int $msm_discountval
 * @property int $msm_discountper
 * @property int $msm_duration Duration of the pack in days
 * @property string $msm_baseprice Base price of the pack
 * @property int $msm_basecurrency Reference to currencymst_tbl
 * @property int $msm_status 1 - Active, 2 - Inactive
 * @property string $msm_createdon
 * @property int $msm_createdby
 * @property string $msm_updatedon
 * @property int $msm_updatedby
 *
 * @property CurrencymstTbl $msmBasecurrency
 */
class MemsubscriptionmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memsubscriptionmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['msm_classificationmst_fk', 'msm_packagename', 'msm_valfrom', 'msm_valtospecify', 'msm_duration', 'msm_baseprice', 'msm_basecurrency', 'msm_status', 'msm_createdon', 'msm_createdby'], 'required'],
            [['msm_classificationmst_fk', 'msm_isbasepack', 'msm_origin', 'msm_valtospecify', 'msm_discountval', 'msm_discountper', 'msm_duration', 'msm_basecurrency', 'msm_status', 'msm_createdby', 'msm_updatedby'], 'integer'],
            [['msm_packagedesc'], 'string'],
            [['msm_valfrom', 'msm_valto', 'msm_createdon', 'msm_updatedon'], 'safe'],
            [['msm_baseprice'], 'number'],
            [['msm_packagename'], 'string', 'max' => 50],
            [['msm_basecurrency'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['msm_basecurrency' => 'CurrencyMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memsubscriptionmst_pk' => 'Memsubscriptionmst Pk',
            'msm_classificationmst_fk' => 'Msm Classificationmst Fk',
            'msm_isbasepack' => 'Msm Isbasepack',
            'msm_origin' => 'Msm Origin',
            'msm_packagename' => 'Msm Packagename',
            'msm_packagedesc' => 'Msm Packagedesc',
            'msm_valfrom' => 'Msm Valfrom',
            'msm_valtospecify' => 'Msm Valtospecify',
            'msm_valto' => 'Msm Valto',
            'msm_discountval' => 'Msm Discountval',
            'msm_discountper' => 'Msm Discountper',
            'msm_duration' => 'Msm Duration',
            'msm_baseprice' => 'Msm Baseprice',
            'msm_basecurrency' => 'Msm Basecurrency',
            'msm_status' => 'Msm Status',
            'msm_createdon' => 'Msm Createdon',
            'msm_createdby' => 'Msm Createdby',
            'msm_updatedon' => 'Msm Updatedon',
            'msm_updatedby' => 'Msm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'msm_basecurrency']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getAdditionalpackage()
    // {
    //     return $this->hasMany(MemsubscriptionmstTbl::className(), ['memsubscriptionmst_pk' => 'msm_memsubscriptionmst_fk']);
    // }

    /**
     * {@inheritdoc}
     * @return MemsubscriptionmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemsubscriptionmstTblQuery(get_called_class());
    }
    
    public function isPaymentEnabledForTheUser($stkholderType) {
        $data = ClassificationmstTbl::find()
            ->where('find_in_set(:stkholderType,CIM_stkholdertypmst_fk) > 0',
                    [':stkholderType' => $stkholderType])
            ->asArray()->all();
        return ($data) ? true : false;
    }
    
    public static function getSubscriptionTblDtlsForReg($colName = 'ClM_HeadCount',$stkpk = null) {
        $valfrom = $_REQUEST['valFrom'] ? $_REQUEST['valFrom'] : 1;
        $stkpk = $stkpk ? $stkpk : 6 ;
        return self::find()
            ->select(['ClM_ClassificationType as Cl','ClM_HeadCount','ClM_HeadCount_ar','ClM_AnnualSales','ClM_AnnualSales_ar','ClM_ClassificationType','ClM_ClassificationType_ar','msm_duration','msm_baseprice','msm_valtospecify','msm_valto','msm_discountval','msm_discountper'])
            ->leftJoin('memsubsbyclassif_tbl msc','msc.msbc_memsubscriptionmst_fk= memsubscriptionmst_pk')
            ->leftJoin('classificationmst_tbl clm', 'clm.ClassificationMst_Pk=msc.mcbc_classificationmst_fk')
            ->where(['msm_valfrom' => $valfrom])
            ->andWhere(['CIM_stkholdertypmst_fk' => $stkpk])
            ->andWhere('ClM_HeadCount IS NOT NULL')
            ->groupBy($colName)
            ->asArray()->all();
    }
}
