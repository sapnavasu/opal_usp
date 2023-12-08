<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appstafflocationtmp_tbl".
 *
 * @property int $appstaffLocationtmp_pk Primary Key
 * @property int $aslt_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $aslt_appostaffinfotmp_fk Reference to appostaffinfotmp_pk
 * @property int $aslt_opalstatemst_fk Reference to opalstatemst_pk
 * @property string $aslt_opalcitymst_fk Reference to opalcitymst_pk
 * @property int $aslt_status 1-Active still remains in same branch, 2-Inactive staff moved to another branch
 * @property string $aslt_createdon
 * @property int $aslt_createdby
 * @property string $aslt_updatedon
 * @property int $aslt_updatedby
 * @property string $aslt_appdecon
 * @property int $aslt_appdecby
 * @property string $aslt_appdecComments
 *
 * @property AppstafflocationhstyTbl[] $appstafflocationhstyTbls
 * @property AppstafflocationmainTbl[] $appstafflocationmainTbls
 * @property ApplicationdtlstmpTbl $asltApplicationdtlstmpFk
 * @property AppstaffinfotmpTbl $asltAppostaffinfotmpFk
 * @property OpalstatemstTbl $asltOpalstatemstFk
 */
class AppstafflocationtmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appstafflocationtmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aslt_applicationdtlstmp_fk', 'aslt_appostaffinfotmp_fk', 'aslt_opalstatemst_fk', 'aslt_opalcitymst_fk', 'aslt_status', 'aslt_createdby'], 'required'],
            [['aslt_applicationdtlstmp_fk', 'aslt_appostaffinfotmp_fk', 'aslt_opalstatemst_fk', 'aslt_status', 'aslt_createdby', 'aslt_updatedby', 'aslt_appdecby'], 'integer'],
            [['aslt_opalcitymst_fk', 'aslt_appdecComments'], 'string'],
            [['aslt_createdon', 'aslt_updatedon', 'aslt_appdecon'], 'safe'],
            [['aslt_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['aslt_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['aslt_appostaffinfotmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppstaffinfotmpTbl::className(), 'targetAttribute' => ['aslt_appostaffinfotmp_fk' => 'appostaffinfotmp_pk']],
            [['aslt_opalstatemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalstatemstTbl::className(), 'targetAttribute' => ['aslt_opalstatemst_fk' => 'opalstatemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appstaffLocationtmp_pk' => 'Appstaff Locationtmp Pk',
            'aslt_applicationdtlstmp_fk' => 'Aslt Applicationdtlstmp Fk',
            'aslt_appostaffinfotmp_fk' => 'Aslt Appostaffinfotmp Fk',
            'aslt_opalstatemst_fk' => 'Aslt Opalstatemst Fk',
            'aslt_opalcitymst_fk' => 'Aslt Opalcitymst Fk',
            'aslt_status' => 'Aslt Status',
            'aslt_createdon' => 'Aslt Createdon',
            'aslt_createdby' => 'Aslt Createdby',
            'aslt_updatedon' => 'Aslt Updatedon',
            'aslt_updatedby' => 'Aslt Updatedby',
            'aslt_appdecon' => 'Aslt Appdecon',
            'aslt_appdecby' => 'Aslt Appdecby',
            'aslt_appdecComments' => 'Aslt Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstafflocationhstyTbls()
    {
        return $this->hasMany(AppstafflocationhstyTbl::className(), ['aslh_appstaffLocationtmp_fk' => 'appstaffLocationtmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstafflocationmainTbls()
    {
        return $this->hasMany(AppstafflocationmainTbl::className(), ['aslm_appstaffLocationtmp_fk' => 'appstaffLocationtmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsltApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'aslt_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsltAppostaffinfotmpFk()
    {
        return $this->hasOne(AppstaffinfotmpTbl::className(), ['appostaffinfotmp_pk' => 'aslt_appostaffinfotmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsltOpalstatemstFk()
    {
        return $this->hasOne(OpalstatemstTbl::className(), ['opalstatemst_pk' => 'aslt_opalstatemst_fk']);
    }
}
