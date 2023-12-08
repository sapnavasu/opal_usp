<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appcompanydtlsmain_tbl".
 *
 * @property int $appcompanydtlsmain_pk
 * @property int $acdm_appcompanydtlstmp_fk Reference to companydtlstmp_pk
 * @property int $acdm_applicationdtlsmain_fk Reference to applicationdtlsmain_pk
 * @property int $acdm_opalmemberregmst_fk Reference to opalmemberregmst_fk
 * @property int $acdm_opalusermst_fk Reference to opalusermst_pk
 * @property string $acdm_gmname General manager name
 * @property string $acdm_gmemailid General manager mail id
 * @property string $acdm_gmmobileno General manager mobile number
 * @property int $acdm_gmmoherigrading
 * @property string $acdm_addrline1
 * @property string $acdm_addrline2
 * @property int $acdm_statemst_fk Reference to statemst_pk
 * @property int $acdm_citymst_fk Reference to citymst_pk
 * @property string $acdm_updatedon
 * @property int $acdm_updatedby
 *
 * @property ApplicationdtlsmainTbl $acdmApplicationdtlsmainFk
 * @property AppcompanydtlstmpTbl $acdmAppcompanydtlstmpFk
 * @property OpalmemberregmstTbl $acdmOpalmemberregmstFk
 * @property OpalusermstTbl $acdmOpalusermstFk
 */
class AppcompanydtlsmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appcompanydtlsmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['acdm_appcompanydtlstmp_fk', 'acdm_applicationdtlsmain_fk', 'acdm_opalmemberregmst_fk', 'acdm_opalusermst_fk', 'acdm_gmname', 'acdm_gmemailid', 'acdm_gmmobileno', 'acdm_gmmoherigrading', 'acdm_addrline1', 'acdm_addrline2', 'acdm_statemst_fk', 'acdm_citymst_fk'], 'required'],
            [['acdm_appcompanydtlstmp_fk', 'acdm_applicationdtlsmain_fk', 'acdm_opalmemberregmst_fk', 'acdm_opalusermst_fk', 'acdm_gmmoherigrading', 'acdm_statemst_fk', 'acdm_citymst_fk', 'acdm_updatedby'], 'integer'],
            [['acdm_addrline1', 'acdm_addrline2'], 'string'],
            [['acdm_updatedon'], 'safe'],
            [['acdm_gmname', 'acdm_gmemailid', 'acdm_gmmobileno'], 'string', 'max' => 100],
            [['acdm_appcompanydtlstmp_fk'], 'unique'],
            [['acdm_applicationdtlsmain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlsmainTbl::className(), 'targetAttribute' => ['acdm_applicationdtlsmain_fk' => 'applicationdtlsmain_pk']],
            [['acdm_appcompanydtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppcompanydtlstmpTbl::className(), 'targetAttribute' => ['acdm_appcompanydtlstmp_fk' => 'appcompanydtlstmp_pk']],
            [['acdm_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['acdm_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['acdm_opalusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['acdm_opalusermst_fk' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appcompanydtlsmain_pk' => 'Appcompanydtlsmain Pk',
            'acdm_appcompanydtlstmp_fk' => 'Acdm Appcompanydtlstmp Fk',
            'acdm_applicationdtlsmain_fk' => 'Acdm Applicationdtlsmain Fk',
            'acdm_opalmemberregmst_fk' => 'Acdm Opalmemberregmst Fk',
            'acdm_opalusermst_fk' => 'Acdm Opalusermst Fk',
            'acdm_gmname' => 'Acdm Gmname',
            'acdm_gmemailid' => 'Acdm Gmemailid',
            'acdm_gmmobileno' => 'Acdm Gmmobileno',
            'acdm_gmmoherigrading' => 'Acdm Gmmoherigrading',
            'acdm_addrline1' => 'Acdm Addrline1',
            'acdm_addrline2' => 'Acdm Addrline2',
            'acdm_statemst_fk' => 'Acdm Statemst Fk',
            'acdm_citymst_fk' => 'Acdm Citymst Fk',
            'acdm_updatedon' => 'Acdm Updatedon',
            'acdm_updatedby' => 'Acdm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcdmApplicationdtlsmainFk()
    {
        return $this->hasOne(ApplicationdtlsmainTbl::className(), ['applicationdtlsmain_pk' => 'acdm_applicationdtlsmain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcdmAppcompanydtlstmpFk()
    {
        return $this->hasOne(AppcompanydtlstmpTbl::className(), ['appcompanydtlstmp_pk' => 'acdm_appcompanydtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcdmOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'acdm_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcdmOpalusermstFk()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'acdm_opalusermst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AppcompanydtlsmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppcompanydtlsmainTblQuery(get_called_class());
    }
}
