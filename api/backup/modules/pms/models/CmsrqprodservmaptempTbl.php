<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsrqprodservmaptemp_tbl".
 *
 * @property int $cmsrqprodservmaptemp_pk Primary key
 * @property int $crpsmt_cmsrqprodservdtlstemp_fk Reference to cmsrqprodservdtlstemp_tbl
 * @property int $crpsmt_sharedmst_fk Reference to productmst_tbl,servicemst_tbl
 * @property int $crpsmt_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $crpsmt_createdon Date of creation
 * @property int $crpsmt_createdby Reference to usermst_tbl
 * @property string $crpsmt_createdbyipaddr User IP Address
 * @property string $crpsmt_updatedon Date of update
 * @property int $crpsmt_updatedby Reference to usermst_tbl
 * @property string $crpsmt_updatedbyipaddr User IP Address
 *
 * @property CmsrqprodservmapTbl[] $cmsrqprodservmapTbls
 * @property CmsrqprodservdtlstempTbl $crpsmtCmsrqprodservdtlstempFk
 * @property UsermstTbl $crpsmtCreatedby
 * @property UsermstTbl $crpsmtUpdatedby
 */
class CmsrqprodservmaptempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsrqprodservmaptemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['crpsmt_cmsrqprodservdtlstemp_fk', 'crpsmt_sharedmst_fk', 'crpsmt_createdon', 'crpsmt_createdby'], 'required'],
            [['crpsmt_cmsrqprodservdtlstemp_fk', 'crpsmt_sharedmst_fk', 'crpsmt_isdeleted', 'crpsmt_createdby', 'crpsmt_updatedby'], 'integer'],
            [['crpsmt_createdon', 'crpsmt_updatedon'], 'safe'],
            [['crpsmt_createdbyipaddr', 'crpsmt_updatedbyipaddr'], 'string', 'max' => 50],
            [['crpsmt_cmsrqprodservdtlstemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrqprodservdtlstempTbl::className(), 'targetAttribute' => ['crpsmt_cmsrqprodservdtlstemp_fk' => 'cmsrqprodservdtlstemp_pk']],
            [['crpsmt_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crpsmt_createdby' => 'UserMst_Pk']],
            [['crpsmt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crpsmt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsrqprodservmaptemp_pk' => 'Cmsrqprodservmaptemp Pk',
            'crpsmt_cmsrqprodservdtlstemp_fk' => 'Crpsmt Cmsrqprodservdtlstemp Fk',
            'crpsmt_sharedmst_fk' => 'Crpsmt Sharedmst Fk',
            'crpsmt_isdeleted' => 'Crpsmt Isdeleted',
            'crpsmt_createdon' => 'Crpsmt Createdon',
            'crpsmt_createdby' => 'Crpsmt Createdby',
            'crpsmt_createdbyipaddr' => 'Crpsmt Createdbyipaddr',
            'crpsmt_updatedon' => 'Crpsmt Updatedon',
            'crpsmt_updatedby' => 'Crpsmt Updatedby',
            'crpsmt_updatedbyipaddr' => 'Crpsmt Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsrqprodservmapTbls()
    {
        return $this->hasMany(CmsrqprodservmapTbl::className(), ['crpsm_cmsrqprodservmaptemp_fk' => 'cmsrqprodservmaptemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsmtCmsrqprodservdtlstempFk()
    {
        return $this->hasOne(CmsrqprodservdtlstempTbl::className(), ['cmsrqprodservdtlstemp_pk' => 'crpsmt_cmsrqprodservdtlstemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsmtCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crpsmt_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsmtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crpsmt_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservmaptempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsrqprodservmaptempTblQuery(get_called_class());
    }
}
