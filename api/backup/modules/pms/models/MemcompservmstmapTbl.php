<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;
use common\models\MemcompservicedtlsTbl;
use api\modules\mst\models\ServicemstTbl;

/**
 * This is the model class for table "memcompservmstmap_tbl".
 *
 * @property int $memcompservmstmap_pk Primary key
 * @property int $mcsmm_memcompservdtls_fk Reference to memcompservicedtls_tbl
 * @property int $mcsmm_servicemst_fk Reference to servicemst_tbl
 * @property int $mcsmm_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $mcsmm_createdon Date of creation
 * @property int $mcsmm_createdby Reference to usermst_tbl
 * @property string $mcsmm_createdbyipaddr User IP Address
 * @property string $mcsmm_updatedon Date of update
 * @property int $mcsmm_updatedby Reference to usermst_tbl
 * @property string $mcsmm_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $mcsmmCreatedby
 * @property MemcompservicedtlsTbl $mcsmmMemcompservdtlsFk
 * @property ServicemstTbl $mcsmmServicemstFk
 * @property UsermstTbl $mcsmmUpdatedby
 * @property MemcompservmstmaphstyTbl[] $memcompservmstmaphstyTbls
 * @property MemcompservmstmapmainTbl[] $memcompservmstmapmainTbls
 */
class MemcompservmstmapTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompservmstmap_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcsmm_memcompservdtls_fk', 'mcsmm_servicemst_fk', 'mcsmm_createdon', 'mcsmm_createdby'], 'required'],
            [['mcsmm_memcompservdtls_fk', 'mcsmm_servicemst_fk', 'mcsmm_isdeleted', 'mcsmm_createdby', 'mcsmm_updatedby'], 'integer'],
            [['mcsmm_createdon', 'mcsmm_updatedon'], 'safe'],
            [['mcsmm_createdbyipaddr', 'mcsmm_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcsmm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcsmm_createdby' => 'UserMst_Pk']],
            [['mcsmm_memcompservdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompservicedtlsTbl::className(), 'targetAttribute' => ['mcsmm_memcompservdtls_fk' => 'MemCompServDtls_Pk']],
            [['mcsmm_servicemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ServicemstTbl::className(), 'targetAttribute' => ['mcsmm_servicemst_fk' => 'ServiceMst_Pk']],
            [['mcsmm_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcsmm_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompservmstmap_pk' => 'Memcompservmstmap Pk',
            'mcsmm_memcompservdtls_fk' => 'Mcsmm Memcompservdtls Fk',
            'mcsmm_servicemst_fk' => 'Mcsmm Servicemst Fk',
            'mcsmm_isdeleted' => 'Mcsmm Isdeleted',
            'mcsmm_createdon' => 'Mcsmm Createdon',
            'mcsmm_createdby' => 'Mcsmm Createdby',
            'mcsmm_createdbyipaddr' => 'Mcsmm Createdbyipaddr',
            'mcsmm_updatedon' => 'Mcsmm Updatedon',
            'mcsmm_updatedby' => 'Mcsmm Updatedby',
            'mcsmm_updatedbyipaddr' => 'Mcsmm Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcsmm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmMemcompservdtlsFk()
    {
        return $this->hasOne(MemcompservicedtlsTbl::className(), ['MemCompServDtls_Pk' => 'mcsmm_memcompservdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmServicemstFk()
    {
        return $this->hasOne(ServicemstTbl::className(), ['ServiceMst_Pk' => 'mcsmm_servicemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsmmUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcsmm_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompservmstmaphstyTbls()
    {
        return $this->hasMany(MemcompservmstmaphstyTbl::className(), ['mcsmmh_memcompservmstmap_fk' => 'memcompservmstmap_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompservmstmapmainTbls()
    {
        return $this->hasMany(MemcompservmstmapmainTbl::className(), ['mcsmmm_memcompservmstmap_fk' => 'memcompservmstmap_pk']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompservmstmapTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompservmstmapTblQuery(get_called_class());
    }
}
