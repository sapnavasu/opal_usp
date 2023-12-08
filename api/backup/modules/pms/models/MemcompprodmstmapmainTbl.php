<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "memcompprodmstmapmain_tbl".
 *
 * @property int $memcompprodmstmapmain_pk Primary key
 * @property int $mcpmmm_memcompprodmstmap_fk reference to memcompprodmstmap_tbl
 * @property int $mcpmmm_memcompproddtls_fk Reference to memcompproddtls_tbl
 * @property int $mcpmmm_productmst_fk Reference to productmst_tbl
 * @property int $mcpmmm_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $mcpmmm_createdon Date of creation
 * @property int $mcpmmm_createdby Reference to usermst_tbl
 * @property string $mcpmmm_createdbyipaddr User IP Address
 * @property string $mcpmmm_updatedon Date of update
 * @property int $mcpmmm_updatedby Reference to usermst_tbl
 * @property string $mcpmmm_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $mcpmmmCreatedby
 * @property MemcompproddtlsTbl $mcpmmmMemcompproddtlsFk
 * @property MemcompprodmstmapTbl $mcpmmmMemcompprodmstmapFk
 * @property ProductmstTbl $mcpmmmProductmstFk
 * @property UsermstTbl $mcpmmmUpdatedby
 */
class MemcompprodmstmapmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompprodmstmapmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcpmmm_memcompprodmstmap_fk', 'mcpmmm_memcompproddtls_fk', 'mcpmmm_productmst_fk', 'mcpmmm_createdon', 'mcpmmm_createdby'], 'required'],
            [['mcpmmm_memcompprodmstmap_fk', 'mcpmmm_memcompproddtls_fk', 'mcpmmm_productmst_fk', 'mcpmmm_isdeleted', 'mcpmmm_createdby', 'mcpmmm_updatedby'], 'integer'],
            [['mcpmmm_createdon', 'mcpmmm_updatedon'], 'safe'],
            [['mcpmmm_createdbyipaddr', 'mcpmmm_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcpmmm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcpmmm_createdby' => 'UserMst_Pk']],
            [['mcpmmm_memcompproddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompproddtlsTbl::className(), 'targetAttribute' => ['mcpmmm_memcompproddtls_fk' => 'MemCompProdDtls_Pk']],
            [['mcpmmm_memcompprodmstmap_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompprodmstmapTbl::className(), 'targetAttribute' => ['mcpmmm_memcompprodmstmap_fk' => 'memcompprodmstmap_pk']],
            [['mcpmmm_productmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProductmstTbl::className(), 'targetAttribute' => ['mcpmmm_productmst_fk' => 'ProductMst_Pk']],
            [['mcpmmm_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcpmmm_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompprodmstmapmain_pk' => 'Memcompprodmstmapmain Pk',
            'mcpmmm_memcompprodmstmap_fk' => 'Mcpmmm Memcompprodmstmap Fk',
            'mcpmmm_memcompproddtls_fk' => 'Mcpmmm Memcompproddtls Fk',
            'mcpmmm_productmst_fk' => 'Mcpmmm Productmst Fk',
            'mcpmmm_isdeleted' => 'Mcpmmm Isdeleted',
            'mcpmmm_createdon' => 'Mcpmmm Createdon',
            'mcpmmm_createdby' => 'Mcpmmm Createdby',
            'mcpmmm_createdbyipaddr' => 'Mcpmmm Createdbyipaddr',
            'mcpmmm_updatedon' => 'Mcpmmm Updatedon',
            'mcpmmm_updatedby' => 'Mcpmmm Updatedby',
            'mcpmmm_updatedbyipaddr' => 'Mcpmmm Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcpmmm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmmMemcompproddtlsFk()
    {
        return $this->hasOne(MemcompproddtlsTbl::className(), ['MemCompProdDtls_Pk' => 'mcpmmm_memcompproddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmmMemcompprodmstmapFk()
    {
        return $this->hasOne(MemcompprodmstmapTbl::className(), ['memcompprodmstmap_pk' => 'mcpmmm_memcompprodmstmap_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmmProductmstFk()
    {
        return $this->hasOne(ProductmstTbl::className(), ['ProductMst_Pk' => 'mcpmmm_productmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmmUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcpmmm_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodmstmapmainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompprodmstmapmainTblQuery(get_called_class());
    }
}
