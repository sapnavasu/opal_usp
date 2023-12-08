<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appintrecoghsty_tbl".
 *
 * @property int $AppIntRecogHsty_PK
 * @property int $appintih_AppIntRecogTmp_FK Reference to appintrecogtmp_pk
 * @property int $appintih_AppIntRecogMain_FK Reference to appintrecogmain_pk
 * @property int $appintih_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $appintih_ApplicationDtlsHsty_FK Reference to applicationdtlshsty_pk
 * @property int $appintih_IntnatRecogMst_FK
 * @property string $appintih_LastAuditDate
 * @property string $appintih_Doc
 * @property string $appintih_CreatedOn
 * @property int $appintih_CreatedBy
 * @property string $appintih_UpdatedOn
 * @property int $appintih_UpdatedBy
 * @property int $appintih_Status 1-New,2-Updated,3-Approved, 4-Declined
 * @property string $appintih_AppDecOn
 * @property int $appintih_AppDecBy
 * @property string $appintih_AppDecComments
 *
 * @property AppintrecogmainTbl $appintihAppIntRecogMainFK
 * @property AppintrecogtmpTbl $appintihAppIntRecogTmpFK
 * @property ApplicationdtlshstyTbl $appintihApplicationDtlsHstyFK
 * @property OpalmemberregmstTbl $appintihOpalMemberRegMstFK
 */
class AppintrecoghstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appintrecoghsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appintih_AppIntRecogTmp_FK', 'appintih_OpalMemberRegMst_FK', 'appintih_ApplicationDtlsHsty_FK', 'appintih_IntnatRecogMst_FK', 'appintih_LastAuditDate', 'appintih_Doc', 'appintih_CreatedOn', 'appintih_CreatedBy', 'appintih_Status'], 'required'],
            [['appintih_AppIntRecogTmp_FK', 'appintih_AppIntRecogMain_FK', 'appintih_OpalMemberRegMst_FK', 'appintih_ApplicationDtlsHsty_FK', 'appintih_IntnatRecogMst_FK', 'appintih_CreatedBy', 'appintih_UpdatedBy', 'appintih_Status', 'appintih_AppDecBy'], 'integer'],
            [['appintih_LastAuditDate', 'appintih_CreatedOn', 'appintih_UpdatedOn', 'appintih_AppDecOn'], 'safe'],
            [['appintih_AppDecComments'], 'string'],
            //[['appintih_Doc'], 'string', 'max' => 255],
            [['appintih_AppIntRecogMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppintrecogmainTbl::className(), 'targetAttribute' => ['appintih_AppIntRecogMain_FK' => 'AppIntRecogMain_PK']],
            [['appintih_AppIntRecogTmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppintrecogtmpTbl::className(), 'targetAttribute' => ['appintih_AppIntRecogTmp_FK' => 'appintrecogtmp_pk']],
            [['appintih_ApplicationDtlsHsty_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlshstyTbl::className(), 'targetAttribute' => ['appintih_ApplicationDtlsHsty_FK' => 'applicationdtlshsty_pk']],
            [['appintih_OpalMemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appintih_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppIntRecogHsty_PK' => 'App Int Recog Hsty  Pk',
            'appintih_AppIntRecogTmp_FK' => 'Appintih  App Int Recog Tmp  Fk',
            'appintih_AppIntRecogMain_FK' => 'Appintih  App Int Recog Main  Fk',
            'appintih_OpalMemberRegMst_FK' => 'Appintih  Opal Member Reg Mst  Fk',
            'appintih_ApplicationDtlsHsty_FK' => 'Appintih  Application Dtls Hsty  Fk',
            'appintih_IntnatRecogMst_FK' => 'Appintih  Intnat Recog Mst  Fk',
            'appintih_LastAuditDate' => 'Appintih  Last Audit Date',
            'appintih_Doc' => 'Appintih  Doc',
            'appintih_CreatedOn' => 'Appintih  Created On',
            'appintih_CreatedBy' => 'Appintih  Created By',
            'appintih_UpdatedOn' => 'Appintih  Updated On',
            'appintih_UpdatedBy' => 'Appintih  Updated By',
            'appintih_Status' => 'Appintih  Status',
            'appintih_AppDecOn' => 'Appintih  App Dec On',
            'appintih_AppDecBy' => 'Appintih  App Dec By',
            'appintih_AppDecComments' => 'Appintih  App Dec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintihAppIntRecogMainFK()
    {
        return $this->hasOne(AppintrecogmainTbl::className(), ['AppIntRecogMain_PK' => 'appintih_AppIntRecogMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintihAppIntRecogTmpFK()
    {
        return $this->hasOne(AppintrecogtmpTbl::className(), ['appintrecogtmp_pk' => 'appintih_AppIntRecogTmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintihApplicationDtlsHstyFK()
    {
        return $this->hasOne(ApplicationdtlshstyTbl::className(), ['applicationdtlshsty_pk' => 'appintih_ApplicationDtlsHsty_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintihOpalMemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appintih_OpalMemberRegMst_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppintrecoghstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppintrecoghstyTblQuery(get_called_class());
    }
}
