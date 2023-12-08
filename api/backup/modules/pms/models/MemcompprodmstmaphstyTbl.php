<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "memcompprodmstmaphsty_tbl".
 *
 * @property int $memcompprodmstmaphsty_pk Primary key
 * @property int $mcpmmh_memcompprodmstmap_fk reference to memcompprodmstmap_tbl
 * @property int $mcpmmh_memcompproddtls_fk Reference to memcompproddtls_tbl
 * @property int $mcpmmh_productmst_fk Reference to productmst_tbl
 * @property int $mcpmmh_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $mcpmmh_createdon Date of creation
 * @property int $mcpmmh_createdby Reference to usermst_tbl
 * @property string $mcpmmh_createdbyipaddr User IP Address
 * @property string $mcpmmh_updatedon Date of update
 * @property int $mcpmmh_updatedby Reference to usermst_tbl
 * @property string $mcpmmh_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $mcpmmhCreatedby
 * @property MemcompproddtlsTbl $mcpmmhMemcompproddtlsFk
 * @property MemcompprodmstmapTbl $mcpmmhMemcompprodmstmapFk
 * @property ProductmstTbl $mcpmmhProductmstFk
 * @property UsermstTbl $mcpmmhUpdatedby
 */
class MemcompprodmstmaphstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompprodmstmaphsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcpmmh_memcompprodmstmap_fk', 'mcpmmh_memcompproddtls_fk', 'mcpmmh_productmst_fk', 'mcpmmh_createdon', 'mcpmmh_createdby'], 'required'],
            [['mcpmmh_memcompprodmstmap_fk', 'mcpmmh_memcompproddtls_fk', 'mcpmmh_productmst_fk', 'mcpmmh_isdeleted', 'mcpmmh_createdby', 'mcpmmh_updatedby'], 'integer'],
            [['mcpmmh_createdon', 'mcpmmh_updatedon'], 'safe'],
            [['mcpmmh_createdbyipaddr', 'mcpmmh_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcpmmh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcpmmh_createdby' => 'UserMst_Pk']],
            [['mcpmmh_memcompproddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompproddtlsTbl::className(), 'targetAttribute' => ['mcpmmh_memcompproddtls_fk' => 'MemCompProdDtls_Pk']],
            [['mcpmmh_memcompprodmstmap_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompprodmstmapTbl::className(), 'targetAttribute' => ['mcpmmh_memcompprodmstmap_fk' => 'memcompprodmstmap_pk']],
            [['mcpmmh_productmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProductmstTbl::className(), 'targetAttribute' => ['mcpmmh_productmst_fk' => 'ProductMst_Pk']],
            [['mcpmmh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcpmmh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompprodmstmaphsty_pk' => 'Memcompprodmstmaphsty Pk',
            'mcpmmh_memcompprodmstmap_fk' => 'Mcpmmh Memcompprodmstmap Fk',
            'mcpmmh_memcompproddtls_fk' => 'Mcpmmh Memcompproddtls Fk',
            'mcpmmh_productmst_fk' => 'Mcpmmh Productmst Fk',
            'mcpmmh_isdeleted' => 'Mcpmmh Isdeleted',
            'mcpmmh_createdon' => 'Mcpmmh Createdon',
            'mcpmmh_createdby' => 'Mcpmmh Createdby',
            'mcpmmh_createdbyipaddr' => 'Mcpmmh Createdbyipaddr',
            'mcpmmh_updatedon' => 'Mcpmmh Updatedon',
            'mcpmmh_updatedby' => 'Mcpmmh Updatedby',
            'mcpmmh_updatedbyipaddr' => 'Mcpmmh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcpmmh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmhMemcompproddtlsFk()
    {
        return $this->hasOne(MemcompproddtlsTbl::className(), ['MemCompProdDtls_Pk' => 'mcpmmh_memcompproddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmhMemcompprodmstmapFk()
    {
        return $this->hasOne(MemcompprodmstmapTbl::className(), ['memcompprodmstmap_pk' => 'mcpmmh_memcompprodmstmap_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmhProductmstFk()
    {
        return $this->hasOne(ProductmstTbl::className(), ['ProductMst_Pk' => 'mcpmmh_productmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpmmhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcpmmh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodmstmaphstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompprodmstmaphstyTblQuery(get_called_class());
    }
}
