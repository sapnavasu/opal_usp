<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "memcompservmstmapmain_tbl".
 *
 * @property int $memcompservmstmapmain_pk Primary key
 * @property int $mcsmmm_memcompservmstmap_fk reference to memcompservmstmap_tbl
 * @property int $mcsmmm_memcompservdtls_fk Reference to memcompservicedtls_tbl
 * @property int $mcsmmm_servicemst_fk Reference to servicemst_tbl
 * @property int $mcsmmm_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $mcsmmm_createdon Date of creation
 * @property int $mcsmmm_createdby Reference to usermst_tbl
 * @property string $mcsmmm_createdbyipaddr User IP Address
 * @property string $mcsmmm_updatedon Date of update
 * @property int $mcsmmm_updatedby Reference to usermst_tbl
 * @property string $mcsmmm_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $mcsmmmCreatedby
 * @property MemcompservicedtlsTbl $mcsmmmMemcompservdtlsFk
 * @property MemcompservmstmapTbl $mcsmmmMemcompservmstmapFk
 * @property ServicemstTbl $mcsmmmServicemstFk
 * @property UsermstTbl $mcsmmmUpdatedby
 */
class MemcompservmstmapmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompservmstmapmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcsmmm_memcompservmstmap_fk', 'mcsmmm_memcompservdtls_fk', 'mcsmmm_servicemst_fk', 'mcsmmm_createdon', 'mcsmmm_createdby'], 'required'],
            [['mcsmmm_memcompservmstmap_fk', 'mcsmmm_memcompservdtls_fk', 'mcsmmm_servicemst_fk', 'mcsmmm_isdeleted', 'mcsmmm_createdby', 'mcsmmm_updatedby'], 'integer'],
            [['mcsmmm_createdon', 'mcsmmm_updatedon'], 'safe'],
            [['mcsmmm_createdbyipaddr', 'mcsmmm_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcsmmm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcsmmm_createdby' => 'UserMst_Pk']],
            [['mcsmmm_memcompservdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompservicedtlsTbl::className(), 'targetAttribute' => ['mcsmmm_memcompservdtls_fk' => 'MemCompServDtls_Pk']],
            [['mcsmmm_memcompservmstmap_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompservmstmapTbl::className(), 'targetAttribute' => ['mcsmmm_memcompservmstmap_fk' => 'memcompservmstmap_pk']],
            [['mcsmmm_servicemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ServicemstTbl::className(), 'targetAttribute' => ['mcsmmm_servicemst_fk' => 'ServiceMst_Pk']],
            [['mcsmmm_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcsmmm_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompservmstmapmain_pk' => 'Memcompservmstmapmain Pk',
            'mcsmmm_memcompservmstmap_fk' => 'Mcsmmm Memcompservmstmap Fk',
            'mcsmmm_memcompservdtls_fk' => 'Mcsmmm Memcompservdtls Fk',
            'mcsmmm_servicemst_fk' => 'Mcsmmm Servicemst Fk',
            'mcsmmm_isdeleted' => 'Mcsmmm Isdeleted',
            'mcsmmm_createdon' => 'Mcsmmm Createdon',
            'mcsmmm_createdby' => 'Mcsmmm Createdby',
            'mcsmmm_createdbyipaddr' => 'Mcsmmm Createdbyipaddr',
            'mcsmmm_updatedon' => 'Mcsmmm Updatedon',
            'mcsmmm_updatedby' => 'Mcsmmm Updatedby',
            'mcsmmm_updatedbyipaddr' => 'Mcsmmm Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcsmmm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmmMemcompservdtlsFk()
    {
        return $this->hasOne(MemcompservicedtlsTbl::className(), ['MemCompServDtls_Pk' => 'mcsmmm_memcompservdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmmMemcompservmstmapFk()
    {
        return $this->hasOne(MemcompservmstmapTbl::className(), ['memcompservmstmap_pk' => 'mcsmmm_memcompservmstmap_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmmServicemstFk()
    {
        return $this->hasOne(ServicemstTbl::className(), ['ServiceMst_Pk' => 'mcsmmm_servicemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmmUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcsmmm_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompservmstmapmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompservmstmapmainTblQuery(get_called_class());
    }
}
