<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appcompanydtlstmp_tbl".
 *
 * @property int $appcompanydtlstmp_pk
 * @property int $acdt_opalmemberregmst_fk Reference to opalmemberregmst_fk
 * @property int $acdt_opalusermst_fk Reference to opalusermst_pk
 * @property string $acdt_gmname General manager name
 * @property string $acdt_gmemailid General manager mail id
 * @property string $acdt_gmmobileno General manager mobile number
 * @property int $acdt_gmmoherigrading
 * @property string $acdt_addrline1
 * @property string $acdt_addrline2
 * @property int $acdt_statemst_fk Reference to statemst_pk
 * @property int $acdt_citymst_fk Reference to citymst_pk
 * @property string $acdt_createdon
 * @property int $acdt_createdby
 * @property string $acdt_updatedon
 * @property int $acdt_updatedby
 * @property int $acdt_status 1-New,2-Updated,3-Approved, 4-Declined
 * @property string $acdt_appdecon
 * @property int $acdt_appdecby
 * @property string $acdt_appdecComments
 *
 * @property OpalmemberregmstTbl $acdtOpalmemberregmstFk
 * @property OpalusermstTbl $acdtOpalusermstFk
 */
class AppcompanydtlstmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appcompanydtlstmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['acdt_opalmemberregmst_fk', 'acdt_opalusermst_fk', 'acdt_gmname', 'acdt_gmemailid', 'acdt_gmmobileno','acdt_addrline1', 'acdt_statemst_fk', 'acdt_citymst_fk', 'acdt_createdon', 'acdt_createdby', 'acdt_status'], 'required'],
            [['acdt_opalmemberregmst_fk', 'acdt_opalusermst_fk', 'acdt_gmmoherigrading', 'acdt_statemst_fk', 'acdt_citymst_fk', 'acdt_createdby', 'acdt_updatedby', 'acdt_status', 'acdt_appdecby'], 'integer'],
            [['acdt_addrline1', 'acdt_addrline2', 'acdt_appdecComments'], 'string'],
            [['acdt_createdon', 'acdt_updatedon', 'acdt_appdecon'], 'safe'],
            [['acdt_gmname', 'acdt_gmemailid', 'acdt_gmmobileno'], 'string', 'max' => 100],
            [['acdt_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['acdt_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['acdt_opalusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['acdt_opalusermst_fk' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appcompanydtlstmp_pk' => 'Appcompanydtlstmp Pk',
            'acdt_opalmemberregmst_fk' => 'Acdt Opalmemberregmst Fk',
            'acdt_opalusermst_fk' => 'Acdt Opalusermst Fk',
            'acdt_gmname' => 'Acdt Gmname',
            'acdt_gmemailid' => 'Acdt Gmemailid',
            'acdt_gmmobileno' => 'Acdt Gmmobileno',
            'acdt_gmmoherigrading' => 'Acdt Gmmoherigrading',
            'acdt_addrline1' => 'Acdt Addrline1',
            'acdt_addrline2' => 'Acdt Addrline2',
            'acdt_statemst_fk' => 'Acdt Statemst Fk',
            'acdt_citymst_fk' => 'Acdt Citymst Fk',
            'acdt_createdon' => 'Acdt Createdon',
            'acdt_createdby' => 'Acdt Createdby',
            'acdt_updatedon' => 'Acdt Updatedon',
            'acdt_updatedby' => 'Acdt Updatedby',
            'acdt_status' => 'Acdt Status',
            'acdt_appdecon' => 'Acdt Appdecon',
            'acdt_appdecby' => 'Acdt Appdecby',
            'acdt_appdecComments' => 'Acdt Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcdtOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'acdt_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcdtOpalusermstFk()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'acdt_opalusermst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AppcompanydtlstmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppcompanydtlstmpTblQuery(get_called_class());
    }
}
