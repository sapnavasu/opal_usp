<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cmsgroupcatdtls_tbl".
 *
 * @property int $cmsgroupcatdtls_pk
 * @property int $cgcd_shared_fk Reference to cmsrequisitionformdtls_tbl
 * @property int $cgcd_shared_type 1 - Requisition
 * @property int $cgcd_cmsgroupcatmst_fk Reference to cmsgroupcatmst_tbl
 *
 * @property CmsgroupcatmstTbl $cgcdCmsgroupcatmstFk
 * @property CmsmaincatdtlsTbl[] $cmsmaincatdtlsTbls
 */
class CmsgroupcatdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsgroupcatdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cgcd_shared_fk', 'cgcd_shared_type', 'cgcd_cmsgroupcatmst_fk'], 'integer'],
            [['cgcd_cmsgroupcatmst_fk'], 'required'],
            [['cgcd_cmsgroupcatmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsgroupcatmstTbl::className(), 'targetAttribute' => ['cgcd_cmsgroupcatmst_fk' => 'cmsgroupcatmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsgroupcatdtls_pk' => 'Cmsgroupcatdtls Pk',
            'cgcd_shared_fk' => 'Cgcd Shared Fk',
            'cgcd_shared_type' => 'Cgcd Shared Type',
            'cgcd_cmsgroupcatmst_fk' => 'Cgcd Cmsgroupcatmst Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCgcdCmsgroupcatmstFk()
    {
        return $this->hasOne(CmsgroupcatmstTbl::className(), ['cmsgroupcatmst_pk' => 'cgcd_cmsgroupcatmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsmaincatdtlsTbls()
    {
        return $this->hasMany(CmsmaincatdtlsTbl::className(), ['cmcd_cmsgroupcatdtls_fk' => 'cmsgroupcatdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsgroupcatdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsgroupcatdtlsTblQuery(get_called_class());
    }
}
