<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsconttypemst_tbl".
 *
 * @property int $cmsconttypemst_pk
 * @property string $cmsctm_epcconttype
 * @property string $cmsctm_status A-Active,I-In-active
 * @property string $cmsctm_createdon
 * @property int $cmsctm_createdby
 *
 * @property CmscontracthdrTbl[] $cmscontracthdrTbls
 */
class CmsconttypemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsconttypemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsctm_epcconttype', 'cmsctm_createdon', 'cmsctm_createdby'], 'required'],
            [['cmsctm_status'], 'string'],
            [['cmsctm_createdon'], 'safe'],
            [['cmsctm_createdby'], 'integer'],
            [['cmsctm_epcconttype'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsconttypemst_pk' => 'Cmsconttypemst Pk',
            'cmsctm_epcconttype' => 'Cmsctm Epcconttype',
            'cmsctm_status' => 'Cmsctm Status',
            'cmsctm_createdon' => 'Cmsctm Createdon',
            'cmsctm_createdby' => 'Cmsctm Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscontracthdrTbls()
    {
        return $this->hasMany(CmscontracthdrTbl::className(), ['cmsconttypemst_fk' => 'cmsconttypemst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsconttypemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsconttypemstTblQuery(get_called_class());
    }
}
