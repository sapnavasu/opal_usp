<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cmssubcatdtls_tbl".
 *
 * @property int $cmssubcatdtls_pk Primar Key
 * @property int $cscd_cmsmaincatdtls_fk Reference to cmsmaincatdtls_tbl
 * @property int $cscd_cmssubcatmst_fk Reference to cmssubcatmst_tbl
 *
 * @property CmsmaincatdtlsTbl $cscdCmsmaincatdtlsFk
 * @property CmssubcatmstTbl $cscdCmssubcatmstFk
 */
class CmssubcatdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssubcatdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cscd_cmsmaincatdtls_fk', 'cscd_cmssubcatmst_fk'], 'required'],
            [['cscd_cmsmaincatdtls_fk', 'cscd_cmssubcatmst_fk'], 'integer'],
            [['cscd_cmsmaincatdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsmaincatdtlsTbl::className(), 'targetAttribute' => ['cscd_cmsmaincatdtls_fk' => 'cmsmaincatdtls_pk']],
            [['cscd_cmssubcatmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmssubcatmstTbl::className(), 'targetAttribute' => ['cscd_cmssubcatmst_fk' => 'cmssubcatmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssubcatdtls_pk' => 'Cmssubcatdtls Pk',
            'cscd_cmsmaincatdtls_fk' => 'Cscd Cmsmaincatdtls Fk',
            'cscd_cmssubcatmst_fk' => 'Cscd Cmssubcatmst Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCscdCmsmaincatdtlsFk()
    {
        return $this->hasOne(CmsmaincatdtlsTbl::className(), ['cmsmaincatdtls_pk' => 'cscd_cmsmaincatdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCscdCmssubcatmstFk()
    {
        return $this->hasOne(CmssubcatmstTbl::className(), ['cmssubcatmst_pk' => 'cscd_cmssubcatmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmssubcatdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssubcatdtlsTblQuery(get_called_class());
    }
}
