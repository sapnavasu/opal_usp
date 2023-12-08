<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opalmoherigrademsthsty_tbl".
 *
 * @property int $opalmoherigrademsthsty_pk
 * @property int $omgmh_opalmoherigradingmst_fk Reference to opalmoherigradingmst_pk
 * @property string $omgmh_gradename_en grade name english
 * @property string $omgmh_gradename_ar grade name arabic
 * @property int $omgmh_status 1-active, 2-inactive
 * @property string $omgmh_createdon datetime of creation
 * @property int $omgmh_createdby reference to opalusermst_tbl
 * @property string $omgmh_updatedon datetime of updation
 * @property int $omgmh_updatedby reference to opalusermst_tbl
 *
 * @property OpalusermstTbl $omgmhCreatedby
 * @property OpalmoherigrademstTbl $omgmhOpalmoherigradingmstFk
 * @property OpalusermstTbl $omgmhUpdatedby
 */
class OpalmoherigrademsthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalmoherigrademsthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['omgmh_opalmoherigradingmst_fk', 'omgmh_gradename_en', 'omgmh_gradename_ar', 'omgmh_status', 'omgmh_createdon', 'omgmh_createdby'], 'required'],
            [['omgmh_opalmoherigradingmst_fk', 'omgmh_status', 'omgmh_createdby', 'omgmh_updatedby'], 'integer'],
            [['omgmh_createdon', 'omgmh_updatedon'], 'safe'],
            [['omgmh_gradename_en', 'omgmh_gradename_ar'], 'string', 'max' => 100],
            [['omgmh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['omgmh_createdby' => 'opalusermst_pk']],
            [['omgmh_opalmoherigradingmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmoherigrademstTbl::className(), 'targetAttribute' => ['omgmh_opalmoherigradingmst_fk' => 'opalmoherigradingmst_pk']],
            [['omgmh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['omgmh_updatedby' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalmoherigrademsthsty_pk' => 'Opalmoherigrademsthsty Pk',
            'omgmh_opalmoherigradingmst_fk' => 'Omgmh Opalmoherigradingmst Fk',
            'omgmh_gradename_en' => 'Omgmh Gradename En',
            'omgmh_gradename_ar' => 'Omgmh Gradename Ar',
            'omgmh_status' => 'Omgmh Status',
            'omgmh_createdon' => 'Omgmh Createdon',
            'omgmh_createdby' => 'Omgmh Createdby',
            'omgmh_updatedon' => 'Omgmh Updatedon',
            'omgmh_updatedby' => 'Omgmh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOmgmhCreatedby()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'omgmh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOmgmhOpalmoherigradingmstFk()
    {
        return $this->hasOne(OpalmoherigrademstTbl::className(), ['opalmoherigradingmst_pk' => 'omgmh_opalmoherigradingmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOmgmhUpdatedby()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'omgmh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return OpalmoherigrademsthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalmoherigrademsthstyTblQuery(get_called_class());
    }
}
