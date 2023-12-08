<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cmsgroupcatmst_tbl".
 *
 * @property int $cmsgroupcatmst_pk
 * @property string $cgcm_name
 * @property int $cgcm_status 1 - Active, 2 - Inactive
 * @property string $cgcm_createdon
 *
 * @property CmsgroupcatdtlsTbl[] $cmsgroupcatdtlsTbls
 * @property CmsmaincatmstTbl[] $cmsmaincatmstTbls
 * @property CmssubcatmstTbl[] $cmssubcatmstTbls
 */
class CmsgroupcatmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsgroupcatmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cgcm_name', 'cgcm_status', 'cgcm_createdon'], 'required'],
            [['cgcm_status'], 'integer'],
            [['cgcm_createdon'], 'safe'],
            [['cgcm_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsgroupcatmst_pk' => 'Cmsgroupcatmst Pk',
            'cgcm_name' => 'Cgcm Name',
            'cgcm_status' => 'Cgcm Status',
            'cgcm_createdon' => 'Cgcm Createdon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsgroupcatdtlsTbls()
    {
        return $this->hasMany(CmsgroupcatdtlsTbl::className(), ['cgcd_cmsgroupcatmst_fk' => 'cmsgroupcatmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsmaincatmstTbls()
    {
        return $this->hasMany(CmsmaincatmstTbl::className(), ['cmcm_cmsgroupcatmst_fk' => 'cmsgroupcatmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssubcatmstTbls()
    {
        return $this->hasMany(CmssubcatmstTbl::className(), ['cscm_cmsgroupcatmst_fk' => 'cmsgroupcatmst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsgroupcatmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsgroupcatmstTblQuery(get_called_class());
    }
}
