<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use api\modules\mst\models\CurrencymstTbl;
use api\modules\pd\models\MemcompmplocationdtlsTbl;
use Yii;

/**
 * This is the model class for table "cmstenderpsmap_tbl".
 *
 * @property int $cmstenderpsmap_pk Primary key
 * @property int $ctpsm_cmsrqprodservdtls_fk Reference to cmsrqprodservdtls_tbl
 * @property int $ctpsm_shared_fk Reference to cmstenderhdr_tbl, cmscontracthdr_tbl, cmsquotationhdr_tbl
 * @property int $ctpsm_shared_type 1 - eTendering, 2 - Contract, 3 - Quotation
 * @property string $ctpsm_quantity Order Quantity of product/service
 * @property string $ctpsm_unitprice Unit Price
 * @property int $ctpsm_unitcurrency_fk Reference to currencymst_tbl
 * @property string $ctpsm_tax Tax
 * @property string $ctpsm_discount Discount
 * @property string $ctpsm_amount Amount
 * @property string $ctpsm_delivdate Delivery Date
 * @property int $ctpsm_deliv_mcmpld_fk Delivery Location:Reference to memcompmplocationdtls_tbl
 * @property string $ctpsm_deviationcomment Deviation Comments for quotation
 * @property string $ctpsm_createdon Date of creation
 * @property int $ctpsm_createdby Reference to usermst_tbl
 * @property string $ctpsm_createdbyipaddr User IP Address
 * @property string $ctpsm_updatedon Date of update
 * @property int $ctpsm_updatedby Reference to usermst_tbl
 * @property string $ctpsm_updatedbyipaddr User IP Address
 *
 * @property CmstenderpschargesTbl[] $cmstenderpschargesTbls
 * @property CmsrqprodservdtlsTbl $ctpsmCmsrqprodservdtlsFk
 * @property UsermstTbl $ctpsmCreatedby
 * @property MemcompmplocationdtlsTbl $ctpsmDelivMcmpldFk
 * @property CurrencymstTbl $ctpsmUnitcurrencyFk
 * @property UsermstTbl $ctpsmUpdatedby
 */
class CmstenderpsmapTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstenderpsmap_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctpsm_cmsrqprodservdtls_fk', 'ctpsm_shared_fk', 'ctpsm_shared_type', 'ctpsm_quantity', 'ctpsm_createdon', 'ctpsm_createdby'], 'required'],
            [['ctpsm_cmsrqprodservdtls_fk', 'ctpsm_shared_fk', 'ctpsm_shared_type', 'ctpsm_unitcurrency_fk', 'ctpsm_deliv_mcmpld_fk', 'ctpsm_createdby', 'ctpsm_updatedby'], 'integer'],
            [['ctpsm_quantity', 'ctpsm_unitprice', 'ctpsm_tax', 'ctpsm_discount', 'ctpsm_amount'], 'number'],
            [['ctpsm_delivdate', 'ctpsm_createdon', 'ctpsm_updatedon'], 'safe'],
            [['ctpsm_deviationcomment'], 'string'],
            [['ctpsm_createdbyipaddr', 'ctpsm_updatedbyipaddr'], 'string', 'max' => 50],
            [['ctpsm_cmsrqprodservdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrqprodservdtlsTbl::className(), 'targetAttribute' => ['ctpsm_cmsrqprodservdtls_fk' => 'cmsrqprodservdtls_pk']],
            [['ctpsm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctpsm_createdby' => 'UserMst_Pk']],
            [['ctpsm_deliv_mcmpld_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompmplocationdtlsTbl::className(), 'targetAttribute' => ['ctpsm_deliv_mcmpld_fk' => 'memcompmplocationdtls_pk']],
            [['ctpsm_unitcurrency_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['ctpsm_unitcurrency_fk' => 'CurrencyMst_Pk']],
            [['ctpsm_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctpsm_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstenderpsmap_pk' => 'Cmstenderpsmap Pk',
            'ctpsm_cmsrqprodservdtls_fk' => 'Ctpsm Cmsrqprodservdtls Fk',
            'ctpsm_shared_fk' => 'Ctpsm Shared Fk',
            'ctpsm_shared_type' => 'Ctpsm Shared Type',
            'ctpsm_quantity' => 'Ctpsm Quantity',
            'ctpsm_unitprice' => 'Ctpsm Unitprice',
            'ctpsm_unitcurrency_fk' => 'Ctpsm Unitcurrency Fk',
            'ctpsm_tax' => 'Ctpsm Tax',
            'ctpsm_discount' => 'Ctpsm Discount',
            'ctpsm_amount' => 'Ctpsm Amount',
            'ctpsm_delivdate' => 'Ctpsm Delivdate',
            'ctpsm_deliv_mcmpld_fk' => 'Ctpsm Deliv Mcmpld Fk',
            'ctpsm_deviationcomment' => 'Ctpsm Deviationcomment',
            'ctpsm_createdon' => 'Ctpsm Createdon',
            'ctpsm_createdby' => 'Ctpsm Createdby',
            'ctpsm_createdbyipaddr' => 'Ctpsm Createdbyipaddr',
            'ctpsm_updatedon' => 'Ctpsm Updatedon',
            'ctpsm_updatedby' => 'Ctpsm Updatedby',
            'ctpsm_updatedbyipaddr' => 'Ctpsm Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderpschargesTbls()
    {
        return $this->hasMany(CmstenderpschargesTbl::className(), ['ctpsc_cmstenderpsmap_fk' => 'cmstenderpsmap_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtpsmCmsrqprodservdtlsFk()
    {
        return $this->hasOne(CmsrqprodservdtlsTbl::className(), ['cmsrqprodservdtls_pk' => 'ctpsm_cmsrqprodservdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtpsmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctpsm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtpsmDelivMcmpldFk()
    {
        return $this->hasOne(MemcompmplocationdtlsTbl::className(), ['memcompmplocationdtls_pk' => 'ctpsm_deliv_mcmpld_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtpsmUnitcurrencyFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'ctpsm_unitcurrency_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtpsmUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctpsm_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmstenderpsmapTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmstenderpsmapTblQuery(get_called_class());
    }
    
}
