<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appoprcontracthsty_tbl".
 *
 * @property int $AppOprContractHsty_PK
 * @property int $appoprch_Appoprcontracttmp_FK Reference to appoprcontracttmp_pk
 * @property int $appoprch_AppOprContractMain_FK Reference to appoprcontractmain_pk
 * @property int $appoprch_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $appoprch_ApplicationDtlsHsty_FK Reference to applicationdtlshsty_pk
 * @property int $appoprch_OperatorName Reference to referencemst_pk where rm_mastertype=2
 * @property int $appoprch_ContType 1-Contract, 2-sub contract
 * @property string $appoprch_ContStartDate
 * @property string $appoprch_ContendDate
 * @property string $appoprch_CreatedOn
 * @property int $appoprch_CreatedBy
 * @property string $appoprch_UpdatedOn
 * @property int $appoprch_UpdatedBy
 * @property int $appoprch_Status 1-New,2-Updated,3-Approved, 4-Declined
 * @property string $appoprch_AppDecOn
 * @property int $appoprch_AppDecBy
 * @property string $appoprch_AppDecComments
 *
 * @property ApplicationdtlshstyTbl $appoprchApplicationDtlsHstyFK
 * @property AppoprcontractmainTbl $appoprchAppOprContractMainFK
 * @property AppoprcontracttmpTbl $appoprchAppoprcontracttmpFK
 * @property OpalmemberregmstTbl $appoprchOpalMemberRegMstFK
 */
class AppoprcontracthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appoprcontracthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appoprch_Appoprcontracttmp_FK', 'appoprch_OpalMemberRegMst_FK', 'appoprch_ApplicationDtlsHsty_FK', 'appoprch_OperatorName', 'appoprch_ContType', 'appoprch_ContStartDate', 'appoprch_ContendDate', 'appoprch_CreatedOn', 'appoprch_CreatedBy', 'appoprch_Status'], 'required'],
            [['appoprch_Appoprcontracttmp_FK', 'appoprch_AppOprContractMain_FK', 'appoprch_OpalMemberRegMst_FK', 'appoprch_ApplicationDtlsHsty_FK', 'appoprch_OperatorName', 'appoprch_ContType', 'appoprch_CreatedBy', 'appoprch_UpdatedBy', 'appoprch_Status', 'appoprch_AppDecBy'], 'integer'],
            [['appoprch_ContStartDate', 'appoprch_ContendDate', 'appoprch_CreatedOn', 'appoprch_UpdatedOn', 'appoprch_AppDecOn'], 'safe'],
            [['appoprch_AppDecComments'], 'string'],
            [['appoprch_ApplicationDtlsHsty_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlshstyTbl::className(), 'targetAttribute' => ['appoprch_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']],
            [['appoprch_AppOprContractMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppoprcontractmainTbl::className(), 'targetAttribute' => ['appoprch_AppOprContractMain_FK' => 'AppOprContractMain_PK']],
            [['appoprch_Appoprcontracttmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppoprcontracttmpTbl::className(), 'targetAttribute' => ['appoprch_Appoprcontracttmp_FK' => 'appoprcontracttmp_pk']],
            [['appoprch_OpalMemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appoprch_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppOprContractHsty_PK' => 'App Opr Contract Hsty  Pk',
            'appoprch_Appoprcontracttmp_FK' => 'Appoprch  Appoprcontracttmp  Fk',
            'appoprch_AppOprContractMain_FK' => 'Appoprch  App Opr Contract Main  Fk',
            'appoprch_OpalMemberRegMst_FK' => 'Appoprch  Opal Member Reg Mst  Fk',
            'appoprch_ApplicationDtlsHsty_FK' => 'Appoprch  Application Dtls Hsty  Fk',
            'appoprch_OperatorName' => 'Appoprch  Operator Name',
            'appoprch_ContType' => 'Appoprch  Cont Type',
            'appoprch_ContStartDate' => 'Appoprch  Cont Start Date',
            'appoprch_ContendDate' => 'Appoprch  Contend Date',
            'appoprch_CreatedOn' => 'Appoprch  Created On',
            'appoprch_CreatedBy' => 'Appoprch  Created By',
            'appoprch_UpdatedOn' => 'Appoprch  Updated On',
            'appoprch_UpdatedBy' => 'Appoprch  Updated By',
            'appoprch_Status' => 'Appoprch  Status',
            'appoprch_AppDecOn' => 'Appoprch  App Dec On',
            'appoprch_AppDecBy' => 'Appoprch  App Dec By',
            'appoprch_AppDecComments' => 'Appoprch  App Dec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprchApplicationDtlsHstyFK()
    {
        return $this->hasOne(ApplicationdtlshstyTbl::className(), ['applicationdtlshsty_pk' => 'appoprch_ApplicationDtlsHsty_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprchAppOprContractMainFK()
    {
        return $this->hasOne(AppoprcontractmainTbl::className(), ['AppOprContractMain_PK' => 'appoprch_AppOprContractMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprchAppoprcontracttmpFK()
    {
        return $this->hasOne(AppoprcontracttmpTbl::className(), ['appoprcontracttmp_pk' => 'appoprch_Appoprcontracttmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprchOpalMemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appoprch_OpalMemberRegMst_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppoprcontracthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppoprcontracthstyTblQuery(get_called_class());
    }
}
