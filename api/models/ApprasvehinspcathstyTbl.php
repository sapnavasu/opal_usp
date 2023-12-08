<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apprasvehinspcathsty_tbl".
 *
 * @property int $apprasvehinspcathsty_pk
 * @property int $arvich_apprasvehinspcattmp_fk Reference to apprasvehinspcattmp_pk
 * @property int $avrich_apprasvehinspcatmain_fk Reference to apprasvehinspcatmain_pk
 * @property int $arvich_applicationdtlshsty_fk Reference to applicationdtlshsty_pk
 * @property int $arvich_appinstinfohsty_fk Reference to appinstinfohsty_pk
 * @property int $arvich_rascategorymst_fk Reference to rascategorymst_pk
 * @property string $arvich_createdon
 * @property int $arvich_createdby
 * @property string $arvich_updatedon
 * @property int $arvich_updatedby
 * @property int $arvich_status 1-Yet to submit. 2-Submitted for Approval, 3-Approved, 4-Declined, 5-updated
 * @property string $arvich_appdecon
 * @property int $arvich_appdecby
 * @property string $arvich_appdecComments
 *
 * @property AppinstinfohstyTbl $arvichAppinstinfohstyFk
 * @property ApplicationdtlshstyTbl $arvichApplicationdtlshstyFk
 * @property ApprasvehinspcattmpTbl $arvichApprasvehinspcattmpFk
 * @property RascategorymstTbl $arvichRascategorymstFk
 * @property ApprasvehinspcatmainTbl $avrichApprasvehinspcatmainFk
 */
class ApprasvehinspcathstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apprasvehinspcathsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['arvich_apprasvehinspcattmp_fk', 'arvich_applicationdtlshsty_fk', 'arvich_appinstinfohsty_fk', 'arvich_rascategorymst_fk', 'arvich_createdon', 'arvich_createdby', 'arvich_status'], 'required'],
            [['arvich_apprasvehinspcattmp_fk', 'avrich_apprasvehinspcatmain_fk', 'arvich_applicationdtlshsty_fk', 'arvich_appinstinfohsty_fk', 'arvich_rascategorymst_fk', 'arvich_createdby', 'arvich_updatedby', 'arvich_status', 'arvich_appdecby'], 'integer'],
            [['arvich_createdon', 'arvich_updatedon', 'arvich_appdecon'], 'safe'],
            [['arvich_appdecComments'], 'string'],
            [['arvich_appinstinfohsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfohstyTbl::className(), 'targetAttribute' => ['arvich_appinstinfohsty_fk' => 'AppInstInfoHsty_PK']],
            [['arvich_applicationdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlshstyTbl::className(), 'targetAttribute' => ['arvich_applicationdtlshsty_fk' => 'applicationdtlshsty_pk']],
            [['arvich_apprasvehinspcattmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApprasvehinspcattmpTbl::className(), 'targetAttribute' => ['arvich_apprasvehinspcattmp_fk' => 'apprasvehinspcattmp_pk']],
            [['arvich_rascategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['arvich_rascategorymst_fk' => 'rascategorymst_pk']],
            [['avrich_apprasvehinspcatmain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApprasvehinspcatmainTbl::className(), 'targetAttribute' => ['avrich_apprasvehinspcatmain_fk' => 'apprasvehinspcatmain_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'apprasvehinspcathsty_pk' => 'Apprasvehinspcathsty Pk',
            'arvich_apprasvehinspcattmp_fk' => 'Arvich Apprasvehinspcattmp Fk',
            'avrich_apprasvehinspcatmain_fk' => 'Avrich Apprasvehinspcatmain Fk',
            'arvich_applicationdtlshsty_fk' => 'Arvich Applicationdtlshsty Fk',
            'arvich_appinstinfohsty_fk' => 'Arvich Appinstinfohsty Fk',
            'arvich_rascategorymst_fk' => 'Arvich Rascategorymst Fk',
            'arvich_createdon' => 'Arvich Createdon',
            'arvich_createdby' => 'Arvich Createdby',
            'arvich_updatedon' => 'Arvich Updatedon',
            'arvich_updatedby' => 'Arvich Updatedby',
            'arvich_status' => 'Arvich Status',
            'arvich_appdecon' => 'Arvich Appdecon',
            'arvich_appdecby' => 'Arvich Appdecby',
            'arvich_appdecComments' => 'Arvich Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArvichAppinstinfohstyFk()
    {
        return $this->hasOne(AppinstinfohstyTbl::className(), ['AppInstInfoHsty_PK' => 'arvich_appinstinfohsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArvichApplicationdtlshstyFk()
    {
        return $this->hasOne(ApplicationdtlshstyTbl::className(), ['applicationdtlshsty_pk' => 'arvich_applicationdtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArvichApprasvehinspcattmpFk()
    {
        return $this->hasOne(ApprasvehinspcattmpTbl::className(), ['apprasvehinspcattmp_pk' => 'arvich_apprasvehinspcattmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArvichRascategorymstFk()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'arvich_rascategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvrichApprasvehinspcatmainFk()
    {
        return $this->hasOne(ApprasvehinspcatmainTbl::className(), ['apprasvehinspcatmain_pk' => 'avrich_apprasvehinspcatmain_fk']);
    }
}
