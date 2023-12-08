<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appcompanydtlshsty_tbl".
 *
 * @property int $appcompanydtlshsty_pk
 * @property int $acdh_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $acdh_appcompanydtlstmp_fk Reference to companydtlstmp_pk
 * @property int $acdh_appcompanydtlsmain_fk Reference to companydtlsmain_pk
 * @property int $acdh_opalmemberregmst_fk Reference to opalmemberregmst_fk
 * @property int $acdh_opalusermst_fk Reference to opalusermst_pk
 * @property string $acdh_gmname General manager name
 * @property string $acdh_gmemailid General manager mail id
 * @property string $acdh_gmmobileno General manager mobile number
 * @property int $acdh_gmmoherigrading
 * @property string $acdh_addrline1
 * @property string $acdh_addrline2
 * @property int $acdh_statemst_fk Reference to statemst_pk
 * @property int $acdh_citymst_fk Reference to citymst_pk
 * @property string $acdh_createdon
 * @property int $acdh_createdby
 * @property string $acdh_updatedon
 * @property int $acdh_updatedby
 * @property int $acdh_status 1-New,2-Updated,3-Approved, 4-Declined
 * @property string $acdh_appdecon
 * @property int $acdh_appdecby
 * @property string $acdh_appdecComments
 *
 * @property ApplicationdtlstmpTbl $acdhApplicationdtlstmpFk
 * @property OpalmemberregmstTbl $acdhOpalmemberregmstFk
 * @property OpalusermstTbl $acdhOpalusermstFk
 */
class AppcompanydtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appcompanydtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['acdh_appcompanydtlstmp_fk', 'acdh_opalmemberregmst_fk', 'acdh_opalusermst_fk', 'acdh_gmname', 'acdh_gmemailid', 'acdh_gmmobileno', 'acdh_gmmoherigrading', 'acdh_addrline1', 'acdh_statemst_fk', 'acdh_citymst_fk', 'acdh_createdon', 'acdh_createdby', 'acdh_status'], 'required'],
            [['acdh_appcompanydtlstmp_fk', 'acdh_appcompanydtlsmain_fk', 'acdh_opalmemberregmst_fk', 'acdh_opalusermst_fk', 'acdh_gmmoherigrading', 'acdh_statemst_fk', 'acdh_citymst_fk', 'acdh_createdby', 'acdh_updatedby', 'acdh_status', 'acdh_appdecby','acdh_applicationdtlshsty_fk'], 'integer'],
            [['acdh_addrline1', 'acdh_addrline2', 'acdh_appdecComments'], 'string'],
            [['acdh_createdon', 'acdh_updatedon', 'acdh_appdecon'], 'safe'],
            [['acdh_gmname', 'acdh_gmemailid', 'acdh_gmmobileno'], 'string', 'max' => 100],
            //[['acdh_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['acdh_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['acdh_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['acdh_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['acdh_opalusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['acdh_opalusermst_fk' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appcompanydtlshsty_pk' => 'Appcompanydtlshsty Pk',
            //'acdh_applicationdtlstmp_fk' => 'Acdh Applicationdtlstmp Fk',
            'acdh_appcompanydtlstmp_fk' => 'Acdh Companydtlstmp Fk',
            'acdh_appcompanydtlsmain_fk' => 'Acdh Companydtlsmain Fk',
            'acdh_opalmemberregmst_fk' => 'Acdh Opalmemberregmst Fk',
            'acdh_opalusermst_fk' => 'Acdh Opalusermst Fk',
            'acdh_gmname' => 'Acdh Gmname',
            'acdh_gmemailid' => 'Acdh Gmemailid',
            'acdh_gmmobileno' => 'Acdh Gmmobileno',
            'acdh_gmmoherigrading' => 'Acdh Gmmoherigrading',
            'acdh_addrline1' => 'Acdh Addrline1',
            'acdh_addrline2' => 'Acdh Addrline2',
            'acdh_statemst_fk' => 'Acdh Statemst Fk',
            'acdh_citymst_fk' => 'Acdh Citymst Fk',
            'acdh_createdon' => 'Acdh Createdon',
            'acdh_createdby' => 'Acdh Createdby',
            'acdh_updatedon' => 'Acdh Updatedon',
            'acdh_updatedby' => 'Acdh Updatedby',
            'acdh_status' => 'Acdh Status',
            'acdh_appdecon' => 'Acdh Appdecon',
            'acdh_appdecby' => 'Acdh Appdecby',
            'acdh_appdecComments' => 'Acdh Appdec Comments',
        ];
    }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getAcdhApplicationdtlstmpFk()
    // {
    //     return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'acdh_applicationdtlstmp_fk']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcdhOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'acdh_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcdhOpalusermstFk()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'acdh_opalusermst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AppcompanydtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppcompanydtlshstyTblQuery(get_called_class());
    }
}
