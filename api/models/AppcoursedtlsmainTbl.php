<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appcoursedtlsmain_tbl".
 *
 * @property int $AppCourseDtlsMain_PK
 * @property int $appcdm_AppCourseDtlsTmp_FK Reference to appcoursedtlstmp_pk
 * @property int $appcdm_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $appcdm_ApplicationDtlsTmp_FK Reference to applicationdtlstmp_pk
 * @property int $appcdm_ApplicationDtlsMain_FK Reference to applicationdtlsmain_pk
 * @property int $appcdm_StandardCoursemst_FK Reference to standardcoursemst_pk
 * @property int $appcdm_RequestFor Reference to referencemst_pk where rm_mastertype=13
 * @property string $appcdm_UpdatedOn
 * @property int $appcdm_UpdatedBy
 *
 * @property AppcoursedtlstmpTbl $appcdmAppCourseDtlsTmpFK
 * @property ApplicationdtlsmainTbl $appcdmApplicationDtlsMainFK
 * @property ApplicationdtlstmpTbl $appcdmApplicationDtlsTmpFK
 * @property OpalmemberregmstTbl $appcdmOpalMemberRegMstFK
 * @property StandardcoursemstTbl $appcdmStandardCoursemstFK
 */
class AppcoursedtlsmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appcoursedtlsmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appcdm_AppCourseDtlsTmp_FK', 'appcdm_OpalMemberRegMst_FK', 'appcdm_ApplicationDtlsTmp_FK', 'appcdm_ApplicationDtlsMain_FK', 'appcdm_StandardCoursemst_FK', 'appcdm_RequestFor'], 'required'],
            [['appcdm_AppCourseDtlsTmp_FK', 'appcdm_OpalMemberRegMst_FK', 'appcdm_ApplicationDtlsTmp_FK', 'appcdm_ApplicationDtlsMain_FK', 'appcdm_StandardCoursemst_FK', 'appcdm_RequestFor', 'appcdm_UpdatedBy'], 'integer'],
            [['appcdm_UpdatedOn'], 'safe'],
            [['appcdm_AppCourseDtlsTmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursedtlstmpTbl::className(), 'targetAttribute' => ['appcdm_AppCourseDtlsTmp_FK' => 'appcoursedtlstmp_pk']],
            [['appcdm_ApplicationDtlsMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlsmainTbl::className(), 'targetAttribute' => ['appcdm_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']],
            [['appcdm_ApplicationDtlsTmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appcdm_ApplicationDtlsTmp_FK' => 'applicationdtlstmp_pk']],
            [['appcdm_OpalMemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appcdm_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']],
            [['appcdm_StandardCoursemst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['appcdm_StandardCoursemst_FK' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppCourseDtlsMain_PK' => 'App Course Dtls Main  Pk',
            'appcdm_AppCourseDtlsTmp_FK' => 'Appcdm  App Course Dtls Tmp  Fk',
            'appcdm_OpalMemberRegMst_FK' => 'Appcdm  Opal Member Reg Mst  Fk',
            'appcdm_ApplicationDtlsTmp_FK' => 'Appcdm  Application Dtls Tmp  Fk',
            'appcdm_ApplicationDtlsMain_FK' => 'Appcdm  Application Dtls Main  Fk',
            'appcdm_StandardCoursemst_FK' => 'Appcdm  Standard Coursemst  Fk',
            'appcdm_RequestFor' => 'Appcdm  Request For',
            'appcdm_UpdatedOn' => 'Appcdm  Updated On',
            'appcdm_UpdatedBy' => 'Appcdm  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcdmAppCourseDtlsTmpFK()
    {
        return $this->hasOne(AppcoursedtlstmpTbl::className(), ['appcoursedtlstmp_pk' => 'appcdm_AppCourseDtlsTmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcdmApplicationDtlsMainFK()
    {
        return $this->hasOne(ApplicationdtlsmainTbl::className(), ['applicationdtlsmain_pk' => 'appcdm_ApplicationDtlsMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcdmApplicationDtlsTmpFK()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'appcdm_ApplicationDtlsTmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcdmOpalMemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appcdm_OpalMemberRegMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppcdmStandardCoursemstFK()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'appcdm_StandardCoursemst_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppcoursedtlsmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppcoursedtlsmainTblQuery(get_called_class());
    }
}
