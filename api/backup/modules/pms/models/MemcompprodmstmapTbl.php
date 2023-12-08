<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;
use common\models\MemcompproddtlsTbl;
use api\modules\mst\models\ProductmstTbl;
/**
 * This is the model class for table "memcompprodmstmap_tbl".
 *
 * @property int $memcompprodmstmap_pk Primary key
 * @property int $mcpmm_memcompproddtls_fk Reference to memcompproddtls_tbl
 * @property int $mcpmm_productmst_fk Reference to productmst_tbl
 * @property int $mcpmm_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $mcpmm_createdon Date of creation
 * @property int $mcpmm_createdby Reference to usermst_tbl
 * @property string $mcpmm_createdbyipaddr User IP Address
 * @property string $mcpmm_updatedon Date of update
 * @property int $mcpmm_updatedby Reference to usermst_tbl
 * @property string $mcpmm_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $mcpmmCreatedby
 * @property MemcompproddtlsTbl $mcpmmMemcompproddtlsFk
 * @property ProductmstTbl $mcpmmProductmstFk
 * @property UsermstTbl $mcpmmUpdatedby
 * @property MemcompprodmstmaphstyTbl[] $memcompprodmstmaphstyTbls
 * @property MemcompprodmstmapmainTbl[] $memcompprodmstmapmainTbls
 */
class MemcompprodmstmapTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompprodmstmap_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcpmm_memcompproddtls_fk', 'mcpmm_productmst_fk', 'mcpmm_createdon', 'mcpmm_createdby'], 'required'],
            [['mcpmm_memcompproddtls_fk', 'mcpmm_productmst_fk', 'mcpmm_isdeleted', 'mcpmm_createdby', 'mcpmm_updatedby'], 'integer'],
            [['mcpmm_createdon', 'mcpmm_updatedon'], 'safe'],
            [['mcpmm_createdbyipaddr', 'mcpmm_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcpmm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcpmm_createdby' => 'UserMst_Pk']],
            [['mcpmm_memcompproddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompproddtlsTbl::className(), 'targetAttribute' => ['mcpmm_memcompproddtls_fk' => 'MemCompProdDtls_Pk']],
            [['mcpmm_productmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProductmstTbl::className(), 'targetAttribute' => ['mcpmm_productmst_fk' => 'ProductMst_Pk']],
            [['mcpmm_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcpmm_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompprodmstmap_pk' => 'Memcompprodmstmap Pk',
            'mcpmm_memcompproddtls_fk' => 'Mcpmm Memcompproddtls Fk',
            'mcpmm_productmst_fk' => 'Mcpmm Productmst Fk',
            'mcpmm_isdeleted' => 'Mcpmm Isdeleted',
            'mcpmm_createdon' => 'Mcpmm Createdon',
            'mcpmm_createdby' => 'Mcpmm Createdby',
            'mcpmm_createdbyipaddr' => 'Mcpmm Createdbyipaddr',
            'mcpmm_updatedon' => 'Mcpmm Updatedon',
            'mcpmm_updatedby' => 'Mcpmm Updatedby',
            'mcpmm_updatedbyipaddr' => 'Mcpmm Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcpmm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmMemcompproddtlsFk()
    {
        return $this->hasOne(MemcompproddtlsTbl::className(), ['MemCompProdDtls_Pk' => 'mcpmm_memcompproddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmProductmstFk()
    {
        return $this->hasOne(ProductmstTbl::className(), ['ProductMst_Pk' => 'mcpmm_productmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcpmm_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompprodmstmaphstyTbls()
    {
        return $this->hasMany(MemcompprodmstmaphstyTbl::className(), ['mcpmmh_memcompprodmstmap_fk' => 'memcompprodmstmap_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompprodmstmapmainTbls()
    {
        return $this->hasMany(MemcompprodmstmapmainTbl::className(), ['mcpmmm_memcompprodmstmap_fk' => 'memcompprodmstmap_pk']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodmstmapTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompprodmstmapTblQuery(get_called_class());
    }
}
