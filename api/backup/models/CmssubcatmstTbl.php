<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cmssubcatmst_tbl".
 *
 * @property int $cmssubcatmst_pk
 * @property int $cscm_cmsgroupcatmst_fk Reference to cmsgroupcatmst_tbl
 * @property int $cscm_cmsmaincatmst_fk Reference to cmsmaincatmst_tbl
 * @property string $cscm_name
 * @property int $cscm_status 1 - Active, 2 - Inactive
 * @property string $cscm_createdon
 *
 * @property CmsgroupcatmstTbl $cscmCmsgroupcatmstFk
 * @property CmsmaincatmstTbl $cscmCmsmaincatmstFk
 */
class CmssubcatmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssubcatmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cscm_cmsgroupcatmst_fk', 'cscm_cmsmaincatmst_fk', 'cscm_name', 'cscm_status', 'cscm_createdon'], 'required'],
            [['cscm_cmsgroupcatmst_fk', 'cscm_cmsmaincatmst_fk', 'cscm_status'], 'integer'],
            [['cscm_createdon'], 'safe'],
            [['cscm_name'], 'string', 'max' => 60],
            [['cscm_cmsgroupcatmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsgroupcatmstTbl::className(), 'targetAttribute' => ['cscm_cmsgroupcatmst_fk' => 'cmsgroupcatmst_pk']],
            [['cscm_cmsmaincatmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsmaincatmstTbl::className(), 'targetAttribute' => ['cscm_cmsmaincatmst_fk' => 'cmsmaincatmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssubcatmst_pk' => 'Cmssubcatmst Pk',
            'cscm_cmsgroupcatmst_fk' => 'Cscm Cmsgroupcatmst Fk',
            'cscm_cmsmaincatmst_fk' => 'Cscm Cmsmaincatmst Fk',
            'cscm_name' => 'Cscm Name',
            'cscm_status' => 'Cscm Status',
            'cscm_createdon' => 'Cscm Createdon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCscmCmsgroupcatmstFk()
    {
        return $this->hasOne(CmsgroupcatmstTbl::className(), ['cmsgroupcatmst_pk' => 'cscm_cmsgroupcatmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCscmCmsmaincatmstFk()
    {
        return $this->hasOne(CmsmaincatmstTbl::className(), ['cmsmaincatmst_pk' => 'cscm_cmsmaincatmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmssubcatmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssubcatmstTblQuery(get_called_class());
    }
}
