<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cmsmaincatdtls_tbl".
 *
 * @property int $cmsmaincatdtls_pk Primary Key
 * @property int $cmcd_cmsgroupcatdtls_fk Reference to cmsgroupcatdtls_tbl
 * @property int $cmcd_cmsmaincatmst_fk Reference to cmsmaincatmst_tbl
 *
 * @property CmsgroupcatdtlsTbl $cmcdCmsgroupcatdtlsFk
 * @property CmsmaincatmstTbl $cmcdCmsmaincatmstFk
 * @property CmssubcatdtlsTbl[] $cmssubcatdtlsTbls
 */
class CmsmaincatdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsmaincatdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmcd_cmsgroupcatdtls_fk', 'cmcd_cmsmaincatmst_fk'], 'required'],
            [['cmcd_cmsgroupcatdtls_fk', 'cmcd_cmsmaincatmst_fk'], 'integer'],
            [['cmcd_cmsgroupcatdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsgroupcatdtlsTbl::className(), 'targetAttribute' => ['cmcd_cmsgroupcatdtls_fk' => 'cmsgroupcatdtls_pk']],
            [['cmcd_cmsmaincatmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsmaincatmstTbl::className(), 'targetAttribute' => ['cmcd_cmsmaincatmst_fk' => 'cmsmaincatmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsmaincatdtls_pk' => 'Cmsmaincatdtls Pk',
            'cmcd_cmsgroupcatdtls_fk' => 'Cmcd Cmsgroupcatdtls Fk',
            'cmcd_cmsmaincatmst_fk' => 'Cmcd Cmsmaincatmst Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmcdCmsgroupcatdtlsFk()
    {
        return $this->hasOne(CmsgroupcatdtlsTbl::className(), ['cmsgroupcatdtls_pk' => 'cmcd_cmsgroupcatdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmcdCmsmaincatmstFk()
    {
        return $this->hasOne(CmsmaincatmstTbl::className(), ['cmsmaincatmst_pk' => 'cmcd_cmsmaincatmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssubcatdtlsTbls()
    {
        return $this->hasMany(CmssubcatdtlsTbl::className(), ['cscd_cmsmaincatdtls_fk' => 'cmsmaincatdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsmaincatdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsmaincatdtlsTblQuery(get_called_class());
    }
}
