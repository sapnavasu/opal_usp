<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apppytminvoicedtls_tbl".
 *
 * @property int $apppytminvoicedtls_pk
 * @property int $apid_opalmemberregmst_fk Reference to opalmemberregmst_pk,The centre who have to make the payment
 * @property int $apid_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $apid_feesubscriptionmst_fk Reference to feesubscriptionmst_pk
 * @property int $apid_appcoursedtlstmp_fk Reference to appcoursedtlstmp_pk
 * @property int $apid_appcoursetrnstmp_fk Reference to appcoursetrnstmp_pk
 * @property string $apid_invoiceno
 * @property string $apid_raisedon
 * @property string $apid_coursecertfee
 * @property string $apid_staffevalfee
 * @property string $apid_vatamount
 * @property string $apid_vatpercent
 * @property string $apid_additionalcharges Additional Charges
 * @property int $apid_paymenttype 1-Online, 2-Offline
 * @property int $apid_paymentmode 1-Cheque, 2-Bank Transfer, 3-Cash
 * @property string $apid_transuniqueId
 * @property string $apid_bankname
 * @property string $apid_dateofpymt
 * @property string $apid_offlinerefno
 * @property int $apid_pymtproof Payment proof file will be stored here. Reference to memcompfiledtls_tbl
 * @property int $apid_invoicestatus 1 - Pending, 2 - Paid - Verification Pending, 3 - Approved, 4 - Declined
 * @property string $apid_appdecon
 * @property int $apid_appdecby
 * @property string $apid_appdecComments
 *
 * @property AppcoursedtlstmpTbl $apidAppcoursedtlstmpFk
 * @property AppcoursetrnstmpTbl $apidAppcoursetrnstmpFk
 * @property ApplicationdtlstmpTbl $apidApplicationdtlstmpFk
 * @property FeesubscriptionmstTbl $apidFeesubscriptionmstFk
 * @property OpalmemberregmstTbl $apidOpalmemberregmstFk
 * @property MemcompfiledtlsTbl $apidPymtproof
 */
class OpalInvoiceTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apppytminvoicedtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apid_opalmemberregmst_fk', 'apid_applicationdtlstmp_fk', 'apid_feesubscriptionmst_fk', 'apid_raisedon'], 'required'],
            [['apid_opalmemberregmst_fk', 'apid_applicationdtlstmp_fk', 'apid_feesubscriptionmst_fk', 'apid_appcoursedtlstmp_fk', 'apid_appcoursetrnstmp_fk', 'apid_paymenttype', 'apid_paymentmode', 'apid_pymtproof', 'apid_invoicestatus', 'apid_appdecby'], 'integer'],
            [['apid_raisedon', 'apid_dateofpymt', 'apid_appdecon'], 'safe'],
            [['apid_coursecertfee', 'apid_staffevalfee', 'apid_vatpercent', 'apid_additionalcharges'], 'number'],
            [['apid_appdecComments'], 'string'],
            [['apid_invoiceno'], 'string', 'max' => 30],
         //   [['apid_vatamount', 'apid_offlinerefno'], 'string', 'max' => 50],
            [['apid_transuniqueId'], 'string', 'max' => 80],
            [['apid_bankname'], 'string', 'max' => 500],
            [['apid_appcoursedtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursedtlstmpTbl::className(), 'targetAttribute' => ['apid_appcoursedtlstmp_fk' => 'appcoursedtlstmp_pk']],
            [['apid_appcoursetrnstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursetrnstmpTbl::className(), 'targetAttribute' => ['apid_appcoursetrnstmp_fk' => 'appcoursetrnstmp_pk']],
            [['apid_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['apid_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['apid_feesubscriptionmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FeesubscriptionmstTbl::className(), 'targetAttribute' => ['apid_feesubscriptionmst_fk' => 'feesubscriptionmst_pk']],
            [['apid_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['apid_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
         //   [['apid_pymtproof'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompfiledtlsTbl::className(), 'targetAttribute' => ['apid_pymtproof' => 'memcompfiledtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'apppytminvoicedtls_pk' => 'Apppytminvoicedtls Pk',
            'apid_opalmemberregmst_fk' => 'Apid Opalmemberregmst Fk',
            'apid_applicationdtlstmp_fk' => 'Apid Applicationdtlstmp Fk',
            'apid_feesubscriptionmst_fk' => 'Apid Feesubscriptionmst Fk',
            'apid_appcoursedtlstmp_fk' => 'Apid Appcoursedtlstmp Fk',
            'apid_appcoursetrnstmp_fk' => 'Apid Appcoursetrnstmp Fk',
            'apid_invoiceno' => 'Apid Invoiceno',
            'apid_raisedon' => 'Apid Raisedon',
            'apid_coursecertfee' => 'Apid Coursecertfee',
            'apid_staffevalfee' => 'Apid Staffevalfee',
            'apid_vatamount' => 'Apid Vatamount',
            'apid_vatpercent' => 'Apid Vatpercent',
            'apid_additionalcharges' => 'Apid Additionalcharges',
            'apid_paymenttype' => 'Apid Paymenttype',
            'apid_paymentmode' => 'Apid Paymentmode',
            'apid_transuniqueId' => 'Apid Transunique ID',
            'apid_bankname' => 'Apid Bankname',
            'apid_dateofpymt' => 'Apid Dateofpymt',
            'apid_offlinerefno' => 'Apid Offlinerefno',
            'apid_pymtproof' => 'Apid Pymtproof',
            'apid_invoicestatus' => 'Apid Invoicestatus',
            'apid_appdecon' => 'Apid Appdecon',
            'apid_appdecby' => 'Apid Appdecby',
            'apid_appdecComments' => 'Apid Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidAppcoursedtlstmpFk()
    {
        return $this->hasOne(AppcoursedtlstmpTbl::className(), ['appcoursedtlstmp_pk' => 'apid_appcoursedtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidAppcoursetrnstmpFk()
    {
        return $this->hasOne(AppcoursetrnstmpTbl::className(), ['appcoursetrnstmp_pk' => 'apid_appcoursetrnstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'apid_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidFeesubscriptionmstFk()
    {
        return $this->hasOne(FeesubscriptionmstTbl::className(), ['feesubscriptionmst_pk' => 'apid_feesubscriptionmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'apid_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidPymtproof()
    {
        return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'apid_pymtproof']);
    }

    public static function saveInvoice($requestdata){
        $model = new OpalInvoiceTbl();
        $model->apid_opalmemberregmst_fk = $requestdata['apid_opalmemberregmst_fk'];
        $model->apid_applicationdtlstmp_fk = $requestdata['apid_applicationdtlstmp_fk'];
        $model->apid_feesubscriptionmst_fk = $requestdata['apid_feesubscriptionmst_fk'];
    //    $model->apid_invoiceno = $requestdata['apid_invoiceno'];
        $model->apid_raisedon = $requestdata['apid_raisedon'];
        $model->apid_coursecertfee = $requestdata['apid_coursecertfee'];
        $model->apid_vatamount = $requestdata['apid_vatamount'];
        $model->apid_vatpercent = $requestdata['apid_vatpercent'];
        $model->apid_invoicestatus = 1;
        $model->apid_noofstaffeval = $requestdata['apid_noofstaffeval'];
        $model->apid_staffevalfee = $requestdata['apid_staffevalfee'];
         
        if($model->save()){
            return $model->apppytminvoicedtls_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }  
    }

  
    public static function updateInvoice($requestdata){
        // echo '<pre>';print_r($requestdata);exit;
        $model = OpalInvoiceTbl::find()->where(['apppytminvoicedtls_pk' => $requestdata['apppytminvoicedtls_pk']])->one();
        if($model){
        $model->apid_opalmemberregmst_fk = $requestdata['apid_opalmemberregmst_fk'];
        $model->apid_applicationdtlstmp_fk = $requestdata['apid_applicationdtlstmp_fk'];
        $model->apid_feesubscriptionmst_fk = $requestdata['apid_feesubscriptionmst_fk'];
        $model->apid_raisedon = $requestdata['apid_raisedon'];
        $model->apid_coursecertfee = $requestdata['apid_coursecertfee'];
        $model->apid_vatamount = $requestdata['apid_vatamount'];
        $model->apid_vatpercent = $requestdata['apid_vatpercent'];
        $model->apid_invoicestatus = 1;
        $model->apid_noofstaffeval = $requestdata['apid_noofstaffeval'];
        $model->apid_staffevalfee = $requestdata['apid_staffevalfee'];

        if($model->save()){
            return $model->apppytminvoicedtls_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
    }

    public static function updateInvoiceNo($requestdata){  
        $model = OpalInvoiceTbl::find()->where(['apppytminvoicedtls_pk' => $requestdata['apppytminvoicedtls_pk']])->one();
        if($model){
        $model->apid_invoiceno = $requestdata['apid_invoiceno'];
     
        if($model->save()){
            return $model->apppytminvoicedtls_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
    }

}
