<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "royaltyandasmtfeehsty_tbl".
 *
 * @property int $royaltyandasmtfeehsty_pk
 * @property int $rasfh_royaltyandasmtfee_fk Reference to royaltyandasmtfee_pk
 * @property int $rasfh_projectmst_fk Reference to projectmst_pk
 * @property int $rasfh_appcoursedtlsmain_fk Reference to appcoursedtlsmain_pk
 * @property int $rasfh_feesubscriptionmst_fk Reference to feesubscriptionmst_pk
 * @property int $rasfh_feetype 1-Royalty Fee,2- Assessment Fee
 * @property string $rasfh_invoiceno
 * @property string $rasfh_raisedon
 * @property int $rasfh_totrecord If it is Technical eveluation then total learner, if it is RAS then it is total vehicle count
 * @property string $rasfh_invoicedamount without VAT
 * @property string $rasfh_vatamount
 * @property string $rasfh_vatpercent
 * @property string $rasfh_invoiceexpiry
 * @property int $rasfh_paymenttype 1-Online, 2-Offline
 * @property int $rasfh_paymentmode If rasfh_paymenttype = then 1-Cheque, 2-Bank Transfer, 3-Cash
 * @property string $rasfh_transuniqueId
 * @property string $rasfh_offlinerefno
 * @property string $rasfh_bankname If rasfh_paymenttype = then rasfh_bankname is not null
 * @property string $rasfh_dateofpymt
 * @property string $rasfh_Comments
 * @property string $rasfh_payURL
 * @property int $rasfh_pymtproof Payment proof file will be stored here. Reference to memcompfiledtls_tbl
 * @property string $rasfh_ressenton Response sent back to requestor date
 * @property int $rasfh_opalusermst_fk Payment Requested by
 * @property string $rasfh_reqfrmurl Request from URL
 * @property string $rasfh_bankrturl Return URL from Bank
 * @property string $rasfh_paymenttoken
 * @property string $rasfh_cardno
 * @property string $rasfh_cardexpiry
 * @property int $rasfh_pymtstatus 1-Pending,2-Paid Confirmation Pending,3-Overdue,4-Received,5-Declined default 1
 * @property int $rasfh_invoicestatus 1-Active,2-Inactive default 1
 * @property int $rasfh_paidby Reference to appinstinfomain_pk, from which centre the payment was processed
 * @property int $rasfh_paidto Reference to opalmemberreg_pk, to which centre the payment was sent to
 * @property string $rasfh_createdon
 * @property int $rasfh_createdby Reference to opalusermst_tbl
 * @property string $rasfh_appdecon
 * @property int $rasfh_appdecby
 * @property string $rasfh_appdecComments
 *
 * @property AppcoursedtlsmainTbl $rasfhAppcoursedtlsmainFk
 * @property FeesubscriptionmstTbl $rasfhFeesubscriptionmstFk
 * @property ProjectmstTbl $rasfhProjectmstFk
 * @property RoyaltyandasmtfeeTbl $rasfhRoyaltyandasmtfeeFk
 */
class RoyaltyandasmtfeehstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'royaltyandasmtfeehsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rasfh_royaltyandasmtfee_fk', 'rasfh_projectmst_fk', 'rasfh_invoiceno', 'rasfh_raisedon', 'rasfh_totrecord', 'rasfh_invoicedamount', 'rasfh_paidby', 'rasfh_createdon', 'rasfh_createdby'], 'required'],
            [['rasfh_royaltyandasmtfee_fk', 'rasfh_projectmst_fk', 'rasfh_feetype', 'rasfh_totrecord', 'rasfh_paymenttype', 'rasfh_paymentmode', 'rasfh_pymtproof', 'rasfh_opalusermst_fk', 'rasfh_pymtstatus', 'rasfh_invoicestatus', 'rasfh_paidby', 'rasfh_paidto', 'rasfh_createdby', 'rasfh_appdecby'], 'integer'],
            [['rasfh_invoiceno', 'rasfh_vatpercent', 'rasfh_Comments', 'rasfh_payURL', 'rasfh_reqfrmurl', 'rasfh_bankrturl', 'rasfh_appdecComments'], 'string'],
            [['rasfh_raisedon', 'rasfh_invoiceexpiry', 'rasfh_dateofpymt', 'rasfh_ressenton', 'rasfh_createdon', 'rasfh_appdecon','rasfh_updatedon','rasfh_updatedby','rasfh_feesubscriptionmst_fk','rasfh_appcoursedtlsmain_fk'], 'safe'],
            [['rasfh_invoicedamount', 'rasfh_vatamount'], 'number'],
            [['rasfh_transuniqueId'], 'string', 'max' => 80],
            [['rasfh_offlinerefno'], 'string', 'max' => 50],
            [['rasfh_bankname'], 'string', 'max' => 500],
            [['rasfh_paymenttoken'], 'string', 'max' => 255],
            [['rasfh_cardno', 'rasfh_cardexpiry'], 'string', 'max' => 45],
            [['rasfh_feesubscriptionmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FeesubscriptionmstTbl::className(), 'targetAttribute' => ['rasfh_feesubscriptionmst_fk' => 'feesubscriptionmst_pk']],
            [['rasfh_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['rasfh_projectmst_fk' => 'projectmst_pk']],
            // [['rasfh_royaltyandasmtfee_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RoyaltyandasmtfeeTbl::className(), 'targetAttribute' => ['rasfh_royaltyandasmtfee_fk' => 'royaltyandasmtfee_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'royaltyandasmtfeehsty_pk' => 'Royaltyandasmtfeehsty Pk',
            'rasfh_royaltyandasmtfee_fk' => 'Rasfh Royaltyandasmtfee Fk',
            'rasfh_projectmst_fk' => 'Rasfh Projectmst Fk',
            'rasfh_appcoursedtlsmain_fk' => 'Rasfh Appcoursedtlsmain Fk',
            'rasfh_feesubscriptionmst_fk' => 'Rasfh Feesubscriptionmst Fk',
            'rasfh_feetype' => 'Rasfh Feetype',
            'rasfh_invoiceno' => 'Rasfh Invoiceno',
            'rasfh_raisedon' => 'Rasfh Raisedon',
            'rasfh_totrecord' => 'Rasfh Totrecord',
            'rasfh_invoicedamount' => 'Rasfh Invoicedamount',
            'rasfh_vatamount' => 'Rasfh Vatamount',
            'rasfh_vatpercent' => 'Rasfh Vatpercent',
            'rasfh_invoiceexpiry' => 'Rasfh Invoiceexpiry',
            'rasfh_paymenttype' => 'Rasfh Paymenttype',
            'rasfh_paymentmode' => 'Rasfh Paymentmode',
            'rasfh_transuniqueId' => 'Rasfh Transunique ID',
            'rasfh_offlinerefno' => 'Rasfh Offlinerefno',
            'rasfh_bankname' => 'Rasfh Bankname',
            'rasfh_dateofpymt' => 'Rasfh Dateofpymt',
            'rasfh_Comments' => 'Rasfh  Comments',
            'rasfh_payURL' => 'Rasfh Pay Url',
            'rasfh_pymtproof' => 'Rasfh Pymtproof',
            'rasfh_ressenton' => 'Rasfh Ressenton',
            'rasfh_opalusermst_fk' => 'Rasfh Opalusermst Fk',
            'rasfh_reqfrmurl' => 'Rasfh Reqfrmurl',
            'rasfh_bankrturl' => 'Rasfh Bankrturl',
            'rasfh_paymenttoken' => 'Rasfh Paymenttoken',
            'rasfh_cardno' => 'Rasfh Cardno',
            'rasfh_cardexpiry' => 'Rasfh Cardexpiry',
            'rasfh_pymtstatus' => 'Rasfh Pymtstatus',
            'rasfh_invoicestatus' => 'Rasfh Invoicestatus',
            'rasfh_paidby' => 'Rasfh Paidby',
            'rasfh_paidto' => 'Rasfh Paidto',
            'rasfh_createdon' => 'Rasfh Createdon',
            'rasfh_createdby' => 'Rasfh Createdby',
            'rasfh_appdecon' => 'Rasfh Appdecon',
            'rasfh_appdecby' => 'Rasfh Appdecby',
            'rasfh_appdecComments' => 'Rasfh Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasfhAppcoursedtlsmainFk()
    {
        return $this->hasOne(AppcoursedtlsmainTbl::className(), ['AppCourseDtlsMain_PK' => 'rasfh_appcoursedtlsmain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasfhFeesubscriptionmstFk()
    {
        return $this->hasOne(FeesubscriptionmstTbl::className(), ['feesubscriptionmst_pk' => 'rasfh_feesubscriptionmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasfhProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'rasfh_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasfhRoyaltyandasmtfeeFk()
    {
        return $this->hasOne(RoyaltyandasmtfeeTbl::className(), ['royaltyandasmtfee_pk' => 'rasfh_royaltyandasmtfee_fk']);
    }

    /**
     * {@inheritdoc}
     * @return RoyaltyandasmtfeehstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoyaltyandasmtfeehstyTblQuery(get_called_class());
    }
}
