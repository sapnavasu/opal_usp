<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsrqprodservmap_tbl".
 *
 * @property int $cmsrqprodservmap_pk Primary key
 * @property int $crpsm_cmsrqprodservmaptemp_fk Reference to cmsrqprodservmaptemp_tbl
 * @property int $crpsm_cmsrqprodservdtls_fk Reference to cmsrqprodservdtls_tbl
 * @property int $crpsm_sharedmst_fk Reference to productmst_tbl,servicemst_tbl
 * @property int $crpsm_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $crpsm_createdon Date of creation
 * @property int $crpsm_createdby Reference to usermst_tbl
 * @property string $crpsm_createdbyipaddr User IP Address
 * @property string $crpsm_updatedon Date of update
 * @property int $crpsm_updatedby Reference to usermst_tbl
 * @property string $crpsm_updatedbyipaddr User IP Address
 *
 * @property CmsrqprodservdtlsTbl $crpsmCmsrqprodservdtlsFk
 * @property CmsrqprodservmaptempTbl $crpsmCmsrqprodservmaptempFk
 * @property UsermstTbl $crpsmCreatedby
 * @property UsermstTbl $crpsmUpdatedby
 * @property CmsrqprodservmaphstyTbl[] $cmsrqprodservmaphstyTbls
 */
class CmsrqprodservmapTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsrqprodservmap_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['crpsm_cmsrqprodservmaptemp_fk', 'crpsm_cmsrqprodservdtls_fk', 'crpsm_sharedmst_fk', 'crpsm_createdon', 'crpsm_createdby'], 'required'],
            [['crpsm_cmsrqprodservmaptemp_fk', 'crpsm_cmsrqprodservdtls_fk', 'crpsm_sharedmst_fk', 'crpsm_isdeleted', 'crpsm_createdby', 'crpsm_updatedby'], 'integer'],
            [['crpsm_createdon', 'crpsm_updatedon'], 'safe'],
            [['crpsm_createdbyipaddr', 'crpsm_updatedbyipaddr'], 'string', 'max' => 50],
            [['crpsm_cmsrqprodservdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrqprodservdtlsTbl::className(), 'targetAttribute' => ['crpsm_cmsrqprodservdtls_fk' => 'cmsrqprodservdtls_pk']],
            [['crpsm_cmsrqprodservmaptemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrqprodservmaptempTbl::className(), 'targetAttribute' => ['crpsm_cmsrqprodservmaptemp_fk' => 'cmsrqprodservmaptemp_pk']],
            [['crpsm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crpsm_createdby' => 'UserMst_Pk']],
            [['crpsm_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crpsm_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsrqprodservmap_pk' => 'Cmsrqprodservmap Pk',
            'crpsm_cmsrqprodservmaptemp_fk' => 'Crpsm Cmsrqprodservmaptemp Fk',
            'crpsm_cmsrqprodservdtls_fk' => 'Crpsm Cmsrqprodservdtls Fk',
            'crpsm_sharedmst_fk' => 'Crpsm Sharedmst Fk',
            'crpsm_isdeleted' => 'Crpsm Isdeleted',
            'crpsm_createdon' => 'Crpsm Createdon',
            'crpsm_createdby' => 'Crpsm Createdby',
            'crpsm_createdbyipaddr' => 'Crpsm Createdbyipaddr',
            'crpsm_updatedon' => 'Crpsm Updatedon',
            'crpsm_updatedby' => 'Crpsm Updatedby',
            'crpsm_updatedbyipaddr' => 'Crpsm Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsmCmsrqprodservdtlsFk()
    {
        return $this->hasOne(CmsrqprodservdtlsTbl::className(), ['cmsrqprodservdtls_pk' => 'crpsm_cmsrqprodservdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsmCmsrqprodservmaptempFk()
    {
        return $this->hasOne(CmsrqprodservmaptempTbl::className(), ['cmsrqprodservmaptemp_pk' => 'crpsm_cmsrqprodservmaptemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crpsm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsmUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crpsm_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsrqprodservmaphstyTbls()
    {
        return $this->hasMany(CmsrqprodservmaphstyTbl::className(), ['crpsmh_cmsrqprodservmap_fk' => 'cmsrqprodservmap_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservmapTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsrqprodservmapTblQuery(get_called_class());
    }
}
