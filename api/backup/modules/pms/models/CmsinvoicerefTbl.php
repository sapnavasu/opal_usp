<?php

namespace api\modules\pms\models;
use api\modules\mst\models;
use Yii;

/**
 * This is the model class for table "cmsinvoiceref_tbl".
 *
 
 */
class CmsinvoicerefTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsinvoiceref_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsir_cmscontracthdr_fk', 'cmsir_memcompmst_fk', 'cmsir_invoicerefno', 'cmsir_invoicedate', 'cmsir_paymentterm', 'cmsir_currencymst_fk', 'cmsir_amount','cmsir_duedate','cmsir_status','cmsir_createdon','cmsir_createdbyipaddr'], 'required'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsinvoiceref_pk' => 'cmsinvoiceref pk',
            'cmsir_cmscontracthdr_fk' => 'cmsir cmscontracthdr fk',
           
           
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	 
	public function getCmsir_currencymst_fk()
    {
        return $this->hasOne(\api\modules\mst\models\CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'cmsir_currencymst_fk']);
    } 
	
	
	public function getCmsir_cmscontracthdr_fk()
    {
        return $this->hasOne(\api\modules\pms\models\CmscontracthdrTbl::className(), ['cmscontracthdr_pk' => 'cmsir_cmscontracthdr_fk']);
    } 
	
    

    
}
