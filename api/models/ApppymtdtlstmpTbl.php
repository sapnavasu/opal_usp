<?php

namespace app\models;

use Yii;
use app\models\OpalusermstTbl;
/**
 * This is the model class for table "apppymtdtlstmp_tbl".
 *
 * @property int $apppymtdtlstmp_pk Primary Key
 * @property int $apppdt_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $apppdt_apppytminvoicedtls_fk Reference to apppytminvoicedtls_pk
 * @property int $apppdt_applicationdtlstmp_fk Reference to applicationdtlstmp_fk
 * @property int $apppdt_paymenttype 1-Online, 2-Offline
 * @property int $apppdt_paymentmode 1-Cheque, 2-Bank Transfer, 3-Cash
 * @property string $apppdt_bankname
 * @property string $apppdt_dateofpymt
 * @property string $apppdt_offlinerefno
 * @property int $apppdt_pymtproof Payment proof file will be stored here. Reference to memcompfiledtls_tbl
 * @property string $apppdt_orderrefno
 * @property string $apppdt_transuniqueId
 * @property int $apppdt_currency 1-OMR, 2-USD
 * @property string $apppdt_amount
 * @property string $apppdt_addchrgs
 * @property string $apppdt_vatchrgs
 * @property string $apppdt_vatpercent
 * @property int $apppdt_requesttype reference to Projectmst_pk
 * @property string $apppdt_comment
 * @property string $apppdt_payURL
 * @property string $apppdt_ressenton Response sent back to requestor date
 * @property int $apppdt_opalusermst_fk Payment Requested by
 * @property string $apppdt_reqfrmurl Request from URL
 * @property string $apppdt_bankrturl Return URL from Bank
 * @property string $apppdt_paymenttoken
 * @property string $apppdt_cardno
 * @property string $apppdt_cardexpiry
 * @property string $apppdt_createdon
 * @property int $apppdt_createdby
 * @property string $apppdt_updatedon
 * @property int $apppdt_updatedby
 * @property int $apppdt_status 1-Inprogress/Ye to Submit, 2-Success/Submitted, 3-Approved, 4-Declined, 5-updated, 6-Cancelled, 7-Failed,
 * @property string $apppdt_appdecon
 * @property int $apppdt_appdecby
 * @property string $apppdt_appdeccomment
 *
 * @property ApppymtdtlshstyTbl[] $apppymtdtlshstyTbls
 * @property ApppymtdtlsmainTbl[] $apppymtdtlsmainTbls
 * @property ApplicationdtlstmpTbl $apppdtApplicationdtlstmpFk
 * @property ApppytminvoicedtlsTbl $apppdtApppytminvoicedtlsFk
 * @property OpalmemberregmstTbl $apppdtOpalmemberregmstFk
 * @property OpalusermstTbl $apppdtOpalusermstFk
 * @property MemcompfiledtlsTbl $apppdtPymtproof
 */
class ApppymtdtlstmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apppymtdtlstmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apppdt_opalmemberregmst_fk', 'apppdt_apppytminvoicedtls_fk', 'apppdt_applicationdtlstmp_fk', 'apppdt_amount', 'apppdt_requesttype', 'apppdt_status'], 'required'],
            [['apppdt_opalmemberregmst_fk', 'apppdt_apppytminvoicedtls_fk', 'apppdt_applicationdtlstmp_fk', 'apppdt_paymenttype', 'apppdt_paymentmode', 'apppdt_pymtproof', 'apppdt_currency', 'apppdt_requesttype', 'apppdt_opalusermst_fk', 'apppdt_createdby', 'apppdt_updatedby', 'apppdt_status', 'apppdt_appdecby'], 'integer'],
            [['apppdt_dateofpymt', 'apppdt_ressenton', 'apppdt_createdon', 'apppdt_updatedon', 'apppdt_appdecon'], 'safe'],
            [['apppdt_amount', 'apppdt_addchrgs', 'apppdt_vatchrgs', 'apppdt_vatpercent'], 'number'],
            [['apppdt_comment', 'apppdt_payURL', 'apppdt_reqfrmurl', 'apppdt_bankrturl', 'apppdt_appdeccomment'], 'string'],
            [['apppdt_bankname'], 'string', 'max' => 500],
            [['apppdt_offlinerefno', 'apppdt_orderrefno'], 'string', 'max' => 50],
            [['apppdt_transuniqueId'], 'string', 'max' => 80],
            [['apppdt_paymenttoken'], 'string', 'max' => 255],
            [['apppdt_cardno', 'apppdt_cardexpiry'], 'string', 'max' => 45],
            [['apppdt_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['apppdt_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            // [['apppdt_apppytminvoicedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApppytminvoicedtlsTbl::className(), 'targetAttribute' => ['apppdt_apppytminvoicedtls_fk' => 'apppytminvoicedtls_pk']],
            [['apppdt_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['apppdt_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['apppdt_opalusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['apppdt_opalusermst_fk' => 'opalusermst_pk']],
            // [['apppdt_pymtproof'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompfiledtlsTbl::className(), 'targetAttribute' => ['apppdt_pymtproof' => 'memcompfiledtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'apppymtdtlstmp_pk' => 'Apppymtdtlstmp Pk',
            'apppdt_opalmemberregmst_fk' => 'Apppdt Opalmemberregmst Fk',
            'apppdt_apppytminvoicedtls_fk' => 'Apppdt Apppytminvoicedtls Fk',
            'apppdt_applicationdtlstmp_fk' => 'Apppdt Applicationdtlstmp Fk',
            'apppdt_paymenttype' => 'Apppdt Paymenttype',
            'apppdt_paymentmode' => 'Apppdt Paymentmode',
            'apppdt_bankname' => 'Apppdt Bankname',
            'apppdt_dateofpymt' => 'Apppdt Dateofpymt',
            'apppdt_offlinerefno' => 'Apppdt Offlinerefno',
            'apppdt_pymtproof' => 'Apppdt Pymtproof',
            'apppdt_orderrefno' => 'Apppdt Orderrefno',
            'apppdt_transuniqueId' => 'Apppdt Transunique ID',
            'apppdt_currency' => 'Apppdt Currency',
            'apppdt_amount' => 'Apppdt Amount',
            'apppdt_addchrgs' => 'Apppdt Addchrgs',
            'apppdt_vatchrgs' => 'Apppdt Vatchrgs',
            'apppdt_vatpercent' => 'Apppdt Vatpercent',
            'apppdt_requesttype' => 'Apppdt Requesttype',
            'apppdt_comment' => 'Apppdt Comment',
            'apppdt_payURL' => 'Apppdt Pay Url',
            'apppdt_ressenton' => 'Apppdt Ressenton',
            'apppdt_opalusermst_fk' => 'Apppdt Opalusermst Fk',
            'apppdt_reqfrmurl' => 'Apppdt Reqfrmurl',
            'apppdt_bankrturl' => 'Apppdt Bankrturl',
            'apppdt_paymenttoken' => 'Apppdt Paymenttoken',
            'apppdt_cardno' => 'Apppdt Cardno',
            'apppdt_cardexpiry' => 'Apppdt Cardexpiry',
            'apppdt_createdon' => 'Apppdt Createdon',
            'apppdt_createdby' => 'Apppdt Createdby',
            'apppdt_updatedon' => 'Apppdt Updatedon',
            'apppdt_updatedby' => 'Apppdt Updatedby',
            'apppdt_status' => 'Apppdt Status',
            'apppdt_appdecon' => 'Apppdt Appdecon',
            'apppdt_appdecby' => 'Apppdt Appdecby',
            'apppdt_appdeccomment' => 'Apppdt Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppymtdtlshstyTbls()
    {
        return $this->hasMany(ApppymtdtlshstyTbl::className(), ['apppdh_AppPymtDtlsTmp_FK' => 'apppymtdtlstmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppymtdtlsmainTbls()
    {
        return $this->hasMany(ApppymtdtlsmainTbl::className(), ['apppdm_appPymtDtlsTmp_FK' => 'apppymtdtlstmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppdtApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'apppdt_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppdtApppytminvoicedtlsFk()
    {
        return $this->hasOne(ApppytminvoicedtlsTbl::className(), ['apppytminvoicedtls_pk' => 'apppdt_apppytminvoicedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppdtOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'apppdt_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppdtOpalusermstFk()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'apppdt_opalusermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppdtPymtproof()
    {
        return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'apppdt_pymtproof']);
    }    
}
