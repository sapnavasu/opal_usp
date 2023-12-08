<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsrqprodservmaphsty_tbl".
 *
 * @property int $cmsrqprodservmaphsty_pk Primary key
 * @property int $crpsmh_cmsrqprodservmap_fk Reference to cmsrqprodservmap_tbl
 * @property int $crpsmh_cmsrqprodservdtlshsty_fk Reference to cmsrqprodservdtlshsty_tbl
 * @property int $crpsmh_sharedmst_fk Reference to productmst_tbl,servicemst_tbl
 * @property int $crpsmh_isdeleted Is deleted default 2: 1 - Yes, 2 - No
 * @property string $crpsmh_createdon Date of creation
 * @property int $crpsmh_createdby Reference to usermst_tbl
 * @property string $crpsmh_createdbyipaddr User IP Address
 * @property string $crpsmh_updatedon Date of update
 * @property int $crpsmh_updatedby Reference to usermst_tbl
 * @property string $crpsmh_updatedbyipaddr User IP Address
 *
 * @property CmsrqprodservdtlshstyTbl $crpsmhCmsrqprodservdtlshstyFk
 * @property CmsrqprodservmapTbl $crpsmhCmsrqprodservmapFk
 * @property UsermstTbl $crpsmhCreatedby
 * @property UsermstTbl $crpsmhUpdatedby
 */
class CmsrqprodservmaphstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsrqprodservmaphsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['crpsmh_cmsrqprodservmap_fk', 'crpsmh_cmsrqprodservdtlshsty_fk', 'crpsmh_sharedmst_fk', 'crpsmh_createdon', 'crpsmh_createdby'], 'required'],
            [['crpsmh_cmsrqprodservmap_fk', 'crpsmh_cmsrqprodservdtlshsty_fk', 'crpsmh_sharedmst_fk', 'crpsmh_isdeleted', 'crpsmh_createdby', 'crpsmh_updatedby'], 'integer'],
            [['crpsmh_createdon', 'crpsmh_updatedon'], 'safe'],
            [['crpsmh_createdbyipaddr', 'crpsmh_updatedbyipaddr'], 'string', 'max' => 50],
            [['crpsmh_cmsrqprodservdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrqprodservdtlshstyTbl::className(), 'targetAttribute' => ['crpsmh_cmsrqprodservdtlshsty_fk' => 'cmsrqprodservdtlshsty_pk']],
            [['crpsmh_cmsrqprodservmap_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrqprodservmapTbl::className(), 'targetAttribute' => ['crpsmh_cmsrqprodservmap_fk' => 'cmsrqprodservmap_pk']],
            [['crpsmh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crpsmh_createdby' => 'UserMst_Pk']],
            [['crpsmh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crpsmh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsrqprodservmaphsty_pk' => 'Cmsrqprodservmaphsty Pk',
            'crpsmh_cmsrqprodservmap_fk' => 'Crpsmh Cmsrqprodservmap Fk',
            'crpsmh_cmsrqprodservdtlshsty_fk' => 'Crpsmh Cmsrqprodservdtlshsty Fk',
            'crpsmh_sharedmst_fk' => 'Crpsmh Sharedmst Fk',
            'crpsmh_isdeleted' => 'Crpsmh Isdeleted',
            'crpsmh_createdon' => 'Crpsmh Createdon',
            'crpsmh_createdby' => 'Crpsmh Createdby',
            'crpsmh_createdbyipaddr' => 'Crpsmh Createdbyipaddr',
            'crpsmh_updatedon' => 'Crpsmh Updatedon',
            'crpsmh_updatedby' => 'Crpsmh Updatedby',
            'crpsmh_updatedbyipaddr' => 'Crpsmh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsmhCmsrqprodservdtlshstyFk()
    {
        return $this->hasOne(CmsrqprodservdtlshstyTbl::className(), ['cmsrqprodservdtlshsty_pk' => 'crpsmh_cmsrqprodservdtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsmhCmsrqprodservmapFk()
    {
        return $this->hasOne(CmsrqprodservmapTbl::className(), ['cmsrqprodservmap_pk' => 'crpsmh_cmsrqprodservmap_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsmhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crpsmh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsmhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crpsmh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservmaphstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsrqprodservmaphstyTblQuery(get_called_class());
    }
}
