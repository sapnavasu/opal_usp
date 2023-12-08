<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompgendtls_tbl".
 *
 * @property int $MemCompGenDtls_Pk
 * @property int $MemberCompMst_Fk
 * @property string $MCGD_IncorpStyle
 * @property string $MCGD_OtherIncorpStyle
 * @property int $MCGD_TotEmployee
 * @property string $MCGD_NationalsPer
 * @property string $MCGD_ExpatriatesPer
 * @property string $MCGD_AnnualTurnOver
 * @property string $MCGD_Classification 'SS' - Small, 'MS' - Medium, 'SM' - Micro, 'L' - Large, 'VL' - Very Large
 * @property string $MCGD_SMECert
 * @property string $MCGD_RuwardCard
 * @property string $MCGD_PACard
 * @property string $MCGD_SMESupDoc
 * @property string $MCGD_PaidUpCapitalLoc
 * @property int $MCGD_PaidUpCapitalCurr_Fk
 * @property string $MCGD_BankerName
 * @property string $MCGD_BankerAddress
 * @property string $MCGD_AuditorName
 * @property string $MCGD_AuditorAddress
 *
 * @property MembercompanymstTbl $memberCompMstFk
 * @property CurrencymstTbl $mCGDPaidUpCapitalCurrFk
 */
class MemcompgendtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompgendtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MemberCompMst_Fk'], 'required'],
            [['MemberCompMst_Fk', 'MCGD_TotEmployee', 'MCGD_PaidUpCapitalCurr_Fk'], 'integer'],
            [['MCGD_BankerAddress', 'MCGD_AuditorAddress'], 'string'],
            [['MCGD_IncorpStyle', 'MCGD_OtherIncorpStyle', 'MCGD_AnnualTurnOver', 'MCGD_Classification', 'MCGD_PaidUpCapitalLoc'], 'string', 'max' => 45],
            [['MCGD_NationalsPer', 'MCGD_ExpatriatesPer', 'MCGD_BankerName', 'MCGD_AuditorName'], 'string', 'max' => 250],
            [['MCGD_SMECert', 'MCGD_RuwardCard', 'MCGD_PACard', 'MCGD_SMESupDoc'], 'string', 'max' => 100],
            [['MemberCompMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['MemberCompMst_Fk' => 'MemberCompMst_Pk']],
            [['MCGD_PaidUpCapitalCurr_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['MCGD_PaidUpCapitalCurr_Fk' => 'CurrencyMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MemCompGenDtls_Pk' => 'Mem Comp Gen Dtls  Pk',
            'MemberCompMst_Fk' => 'Member Comp Mst  Fk',
            'MCGD_IncorpStyle' => 'Mcgd  Incorp Style',
            'MCGD_OtherIncorpStyle' => 'Mcgd  Other Incorp Style',
            'MCGD_TotEmployee' => 'Mcgd  Tot Employee',
            'MCGD_NationalsPer' => 'Mcgd  Nationals Per',
            'MCGD_ExpatriatesPer' => 'Mcgd  Expatriates Per',
            'MCGD_AnnualTurnOver' => 'Mcgd  Annual Turn Over',
            'MCGD_Classification' => 'Mcgd  Classification',
            'MCGD_SMECert' => 'Mcgd  Smecert',
            'MCGD_RuwardCard' => 'Mcgd  Ruward Card',
            'MCGD_PACard' => 'Mcgd  Pacard',
            'MCGD_SMESupDoc' => 'Mcgd  Smesup Doc',
            'MCGD_PaidUpCapitalLoc' => 'Mcgd  Paid Up Capital Loc',
            'MCGD_PaidUpCapitalCurr_Fk' => 'Mcgd  Paid Up Capital Curr  Fk',
            'MCGD_BankerName' => 'Mcgd  Banker Name',
            'MCGD_BankerAddress' => 'Mcgd  Banker Address',
            'MCGD_AuditorName' => 'Mcgd  Auditor Name',
            'MCGD_AuditorAddress' => 'Mcgd  Auditor Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberCompMstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'MemberCompMst_Fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMCGDPaidUpCapitalCurrFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'MCGD_PaidUpCapitalCurr_Fk']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompgendtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompgendtlsTblQuery(get_called_class());
    }
}
