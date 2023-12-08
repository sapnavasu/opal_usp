<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appoprcontractmain_tbl".
 *
 * @property int $AppOprContractMain_PK
 * @property int $appoprcm_AppOprContractTmp_FK Reference to appoprcontracttmp_pk
 * @property int $appoprcm_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $appoprcm_ApplicationDtlsMain_FK Reference to applicationdtlsmain_pk
 * @property int $appoprcm_OperatorName Reference to referencemst_pk where rm_mastertype=2
 * @property int $appoprcm_ContType 1-Contract, 2-sub contract
 * @property string $appoprcm_ContStartdate
 * @property string $appoprcm_ContendDate
 * @property string $appoprcm_UpdatedOn
 * @property int $appoprcm_UpdatedBy
 *
 * @property AppoprcontracthstyTbl[] $appoprcontracthstyTbls
 * @property ApplicationdtlsmainTbl $appoprcmApplicationDtlsMainFK
 * @property AppoprcontracttmpTbl $appoprcmAppOprContractTmpFK
 * @property OpalmemberregmstTbl $appoprcmOpalMemberRegMstFK
 */
class AppoprcontractmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appoprcontractmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appoprcm_AppOprContractTmp_FK', 'appoprcm_OpalMemberRegMst_FK', 'appoprcm_ApplicationDtlsMain_FK', 'appoprcm_OperatorName', 'appoprcm_ContType', 'appoprcm_ContStartdate', 'appoprcm_ContendDate'], 'required'],
            [['appoprcm_AppOprContractTmp_FK', 'appoprcm_OpalMemberRegMst_FK', 'appoprcm_ApplicationDtlsMain_FK', 'appoprcm_OperatorName', 'appoprcm_ContType', 'appoprcm_UpdatedBy'], 'integer'],
            [['appoprcm_ContStartdate', 'appoprcm_ContendDate', 'appoprcm_UpdatedOn'], 'safe'],
            [['appoprcm_ApplicationDtlsMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlsmainTbl::className(), 'targetAttribute' => ['appoprcm_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']],
            [['appoprcm_AppOprContractTmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppoprcontracttmpTbl::className(), 'targetAttribute' => ['appoprcm_AppOprContractTmp_FK' => 'appoprcontracttmp_pk']],
            [['appoprcm_OpalMemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appoprcm_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppOprContractMain_PK' => 'App Opr Contract Main  Pk',
            'appoprcm_AppOprContractTmp_FK' => 'Appoprcm  App Opr Contract Tmp  Fk',
            'appoprcm_OpalMemberRegMst_FK' => 'Appoprcm  Opal Member Reg Mst  Fk',
            'appoprcm_ApplicationDtlsMain_FK' => 'Appoprcm  Application Dtls Main  Fk',
            'appoprcm_OperatorName' => 'Appoprcm  Operator Name',
            'appoprcm_ContType' => 'Appoprcm  Cont Type',
            'appoprcm_ContStartdate' => 'Appoprcm  Cont Startdate',
            'appoprcm_ContendDate' => 'Appoprcm  Contend Date',
            'appoprcm_UpdatedOn' => 'Appoprcm  Updated On',
            'appoprcm_UpdatedBy' => 'Appoprcm  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprcontracthstyTbls()
    {
        return $this->hasMany(AppoprcontracthstyTbl::className(), ['appoprch_AppOprContractMain_FK' => 'AppOprContractMain_PK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprcmApplicationDtlsMainFK()
    {
        return $this->hasOne(ApplicationdtlsmainTbl::className(), ['applicationdtlsmain_pk' => 'appoprcm_ApplicationDtlsMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprcmAppOprContractTmpFK()
    {
        return $this->hasOne(AppoprcontracttmpTbl::className(), ['appoprcontracttmp_pk' => 'appoprcm_AppOprContractTmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprcmOpalMemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appoprcm_OpalMemberRegMst_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppoprcontractmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppoprcontractmainTblQuery(get_called_class());
    }
}
