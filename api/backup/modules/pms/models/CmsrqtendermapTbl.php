<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsrqtendermap_tbl".
 *
 * @property int $cmsrqtendermap_pk
 * @property int $crqtm_tender_cmsrequisitionformdtls_fk Reference to cmsrequisitionformdtls_tbl when Type = Tender
 * @property int $crqtm_rq_cmsrequisitionformdtls_fk Reference to cmsrequisitionformdtls_tbl when Type = Requisition(RQ)
 *
 * @property CmsrequisitionformdtlsTbl $crqtmRqCmsrequisitionformdtlsFk
 * @property CmsrequisitionformdtlsTbl $crqtmTenderCmsrequisitionformdtlsFk
 */
class CmsrqtendermapTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsrqtendermap_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['crqtm_tender_cmsrequisitionformdtls_fk', 'crqtm_rq_cmsrequisitionformdtls_fk'], 'required'],
            [['crqtm_tender_cmsrequisitionformdtls_fk', 'crqtm_rq_cmsrequisitionformdtls_fk'], 'integer'],
            [['crqtm_rq_cmsrequisitionformdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrequisitionformdtlsTbl::className(), 'targetAttribute' => ['crqtm_rq_cmsrequisitionformdtls_fk' => 'cmsrequisitionformdtls_pk']],
            [['crqtm_tender_cmsrequisitionformdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrequisitionformdtlsTbl::className(), 'targetAttribute' => ['crqtm_tender_cmsrequisitionformdtls_fk' => 'cmsrequisitionformdtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsrqtendermap_pk' => 'Cmsrqtendermap Pk',
            'crqtm_tender_cmsrequisitionformdtls_fk' => 'Crqtm Tender Cmsrequisitionformdtls Fk',
            'crqtm_rq_cmsrequisitionformdtls_fk' => 'Crqtm Rq Cmsrequisitionformdtls Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrqtmRqCmsrequisitionformdtlsFk()
    {
        return $this->hasOne(CmsrequisitionformdtlsTbl::className(), ['cmsrequisitionformdtls_pk' => 'crqtm_rq_cmsrequisitionformdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrqtmTenderCmsrequisitionformdtlsFk()
    {
        return $this->hasOne(CmsrequisitionformdtlsTbl::className(), ['cmsrequisitionformdtls_pk' => 'crqtm_tender_cmsrequisitionformdtls_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqtendermapTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsrqtendermapTblQuery(get_called_class());
    }
}
