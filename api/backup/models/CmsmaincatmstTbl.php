<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cmsmaincatmst_tbl".
 *
 * @property int $cmsmaincatmst_pk
 * @property int $cmcm_cmsgroupcatmst_fk Reference to cmsgroupcatmst_tbl
 * @property string $cmcm_name
 * @property int $cmcm_status 1 - Active, 2 - Inactive
 * @property string $cmcm_createdon
 *
 * @property CmsgroupcatmstTbl $cmcmCmsgroupcatmstFk
 * @property CmssubcatmstTbl[] $cmssubcatmstTbls
 */
class CmsmaincatmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsmaincatmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmcm_cmsgroupcatmst_fk', 'cmcm_name', 'cmcm_status', 'cmcm_createdon'], 'required'],
            [['cmcm_cmsgroupcatmst_fk', 'cmcm_status'], 'integer'],
            [['cmcm_createdon'], 'safe'],
            [['cmcm_name'], 'string', 'max' => 50],
            [['cmcm_cmsgroupcatmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsgroupcatmstTbl::className(), 'targetAttribute' => ['cmcm_cmsgroupcatmst_fk' => 'cmsgroupcatmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsmaincatmst_pk' => 'Cmsmaincatmst Pk',
            'cmcm_cmsgroupcatmst_fk' => 'Cmcm Cmsgroupcatmst Fk',
            'cmcm_name' => 'Cmcm Name',
            'cmcm_status' => 'Cmcm Status',
            'cmcm_createdon' => 'Cmcm Createdon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmcmCmsgroupcatmstFk()
    {
        return $this->hasOne(CmsgroupcatmstTbl::className(), ['cmsgroupcatmst_pk' => 'cmcm_cmsgroupcatmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssubcatmstTbls()
    {
        return $this->hasMany(CmssubcatmstTbl::className(), ['cscm_cmsmaincatmst_fk' => 'cmsmaincatmst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsmaincatmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsmaincatmstTblQuery(get_called_class());
    }
}
