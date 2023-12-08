<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "memcompservmstmaphsty_tbl".
 *
 * @property int $memcompservmstmaphsty_pk Primary key
 * @property int $mcsmmh_memcompservmstmap_fk reference to memcompservmstmap_tbl
 * @property int $mcsmmh_memcompservdtls_fk Reference to memcompservicedtls_tbl
 * @property int $mcsmmh_servicemst_fk Reference to servicemst_tbl
 * @property int $mcsmmh_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $mcsmmh_createdon Date of creation
 * @property int $mcsmmh_createdby Reference to usermst_tbl
 * @property string $mcsmmh_createdbyipaddr User IP Address
 * @property string $mcsmmh_updatedon Date of update
 * @property int $mcsmmh_updatedby Reference to usermst_tbl
 * @property string $mcsmmh_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $mcsmmhCreatedby
 * @property MemcompservicedtlsTbl $mcsmmhMemcompservdtlsFk
 * @property MemcompservmstmapTbl $mcsmmhMemcompservmstmapFk
 * @property ServicemstTbl $mcsmmhServicemstFk
 * @property UsermstTbl $mcsmmhUpdatedby
 */
class MemcompservmstmaphstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompservmstmaphsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcsmmh_memcompservmstmap_fk', 'mcsmmh_memcompservdtls_fk', 'mcsmmh_servicemst_fk', 'mcsmmh_createdon', 'mcsmmh_createdby'], 'required'],
            [['mcsmmh_memcompservmstmap_fk', 'mcsmmh_memcompservdtls_fk', 'mcsmmh_servicemst_fk', 'mcsmmh_isdeleted', 'mcsmmh_createdby', 'mcsmmh_updatedby'], 'integer'],
            [['mcsmmh_createdon', 'mcsmmh_updatedon'], 'safe'],
            [['mcsmmh_createdbyipaddr', 'mcsmmh_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcsmmh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcsmmh_createdby' => 'UserMst_Pk']],
            [['mcsmmh_memcompservdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompservicedtlsTbl::className(), 'targetAttribute' => ['mcsmmh_memcompservdtls_fk' => 'MemCompServDtls_Pk']],
            [['mcsmmh_memcompservmstmap_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompservmstmapTbl::className(), 'targetAttribute' => ['mcsmmh_memcompservmstmap_fk' => 'memcompservmstmap_pk']],
            [['mcsmmh_servicemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ServicemstTbl::className(), 'targetAttribute' => ['mcsmmh_servicemst_fk' => 'ServiceMst_Pk']],
            [['mcsmmh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcsmmh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompservmstmaphsty_pk' => 'Memcompservmstmaphsty Pk',
            'mcsmmh_memcompservmstmap_fk' => 'Mcsmmh Memcompservmstmap Fk',
            'mcsmmh_memcompservdtls_fk' => 'Mcsmmh Memcompservdtls Fk',
            'mcsmmh_servicemst_fk' => 'Mcsmmh Servicemst Fk',
            'mcsmmh_isdeleted' => 'Mcsmmh Isdeleted',
            'mcsmmh_createdon' => 'Mcsmmh Createdon',
            'mcsmmh_createdby' => 'Mcsmmh Createdby',
            'mcsmmh_createdbyipaddr' => 'Mcsmmh Createdbyipaddr',
            'mcsmmh_updatedon' => 'Mcsmmh Updatedon',
            'mcsmmh_updatedby' => 'Mcsmmh Updatedby',
            'mcsmmh_updatedbyipaddr' => 'Mcsmmh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcsmmh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmhMemcompservdtlsFk()
    {
        return $this->hasOne(MemcompservicedtlsTbl::className(), ['MemCompServDtls_Pk' => 'mcsmmh_memcompservdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmhMemcompservmstmapFk()
    {
        return $this->hasOne(MemcompservmstmapTbl::className(), ['memcompservmstmap_pk' => 'mcsmmh_memcompservmstmap_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmhServicemstFk()
    {
        return $this->hasOne(ServicemstTbl::className(), ['ServiceMst_Pk' => 'mcsmmh_servicemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcsmmh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompservmstmaphstyTbQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompservmstmaphstyTbQuery(get_called_class());
    }
}
