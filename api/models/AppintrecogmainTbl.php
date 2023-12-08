<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appintrecogmain_tbl".
 *
 * @property int $AppIntRecogMain_PK
 * @property int $appintim_AppIntRecogTmp_FK Reference to appintrecogtmp_pk
 * @property int $appintim_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $appintim_ApplicationDtlsMain_FK Reference to applicationdtlsmain_pk
 * @property int $appintim_IntnatRecogMst_FK
 * @property string $appintim_LastAuditDate
 * @property string $appintim_Doc
 * @property string $appintim_UpdatedOn
 * @property int $appintim_UpdatedBy
 *
 * @property AppintrecoghstyTbl[] $appintrecoghstyTbls
 * @property AppintrecogtmpTbl $appintimAppIntRecogTmpFK
 * @property ApplicationdtlsmainTbl $appintimApplicationDtlsMainFK
 * @property OpalmemberregmstTbl $appintimOpalMemberRegMstFK
 */
class AppintrecogmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appintrecogmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appintim_AppIntRecogTmp_FK', 'appintim_OpalMemberRegMst_FK', 'appintim_ApplicationDtlsMain_FK', 'appintim_IntnatRecogMst_FK', 'appintim_LastAuditDate', 'appintim_Doc'], 'required'],
            [['appintim_AppIntRecogTmp_FK', 'appintim_OpalMemberRegMst_FK', 'appintim_ApplicationDtlsMain_FK', 'appintim_IntnatRecogMst_FK', 'appintim_UpdatedBy'], 'integer'],
            [['appintim_LastAuditDate', 'appintim_UpdatedOn'], 'safe'],
            [['appintim_Doc'], 'string', 'max' => 255],
            [['appintim_AppIntRecogTmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppintrecogtmpTbl::className(), 'targetAttribute' => ['appintim_AppIntRecogTmp_FK' => 'appintrecogtmp_pk']],
            [['appintim_ApplicationDtlsMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlsmainTbl::className(), 'targetAttribute' => ['appintim_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']],
            [['appintim_OpalMemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appintim_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppIntRecogMain_PK' => 'App Int Recog Main  Pk',
            'appintim_AppIntRecogTmp_FK' => 'Appintim  App Int Recog Tmp  Fk',
            'appintim_OpalMemberRegMst_FK' => 'Appintim  Opal Member Reg Mst  Fk',
            'appintim_ApplicationDtlsMain_FK' => 'Appintim  Application Dtls Main  Fk',
            'appintim_IntnatRecogMst_FK' => 'Appintim  Intnat Recog Mst  Fk',
            'appintim_LastAuditDate' => 'Appintim  Last Audit Date',
            'appintim_Doc' => 'Appintim  Doc',
            'appintim_UpdatedOn' => 'Appintim  Updated On',
            'appintim_UpdatedBy' => 'Appintim  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintrecoghstyTbls()
    {
        return $this->hasMany(AppintrecoghstyTbl::className(), ['appintih_AppIntRecogMain_FK' => 'AppIntRecogMain_PK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintimAppIntRecogTmpFK()
    {
        return $this->hasOne(AppintrecogtmpTbl::className(), ['appintrecogtmp_pk' => 'appintim_AppIntRecogTmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintimApplicationDtlsMainFK()
    {
        return $this->hasOne(ApplicationdtlsmainTbl::className(), ['applicationdtlsmain_pk' => 'appintim_ApplicationDtlsMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintimOpalMemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appintim_OpalMemberRegMst_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppintrecogmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppintrecogmainTblQuery(get_called_class());
    }
}
