<?php

namespace api\modules\pms\models;
use api\modules\mst\models\CountrymstTbl;
use Yii;

/**
 * This is the model class for table "cmsnonjsrssupdtls_tbl".
 *
 * @property int $cmsnonjsrssupdtls_pk Primary key
 * @property string $cmsnjsd_crregno Commercial Registration Number
 * @property int $cmsnjsd_countrymst_fk Reference to countrymst_tbl
 * @property int $cmsnjsd_memberregmst_fk Reference to memberregistrationmst_tbl default 0
 *
 * @property CountrymstTbl $cmsnjsdCountrymstFk
 * @property CmsnonjsrssupmapTbl[] $cmsnonjsrssupmapTbls
 */
class CmsnonjsrssupdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsnonjsrssupdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsnjsd_crregno', 'cmsnjsd_countrymst_fk'], 'required'],
            [['cmsnjsd_countrymst_fk', 'cmsnjsd_memberregmst_fk'], 'integer'],
            [['cmsnjsd_crregno'], 'string', 'max' => 250],
            [['cmsnjsd_countrymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CountrymstTbl::className(), 'targetAttribute' => ['cmsnjsd_countrymst_fk' => 'CountryMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsnonjsrssupdtls_pk' => 'Cmsnonjsrssupdtls Pk',
            'cmsnjsd_crregno' => 'Cmsnjsd Crregno',
            'cmsnjsd_countrymst_fk' => 'Cmsnjsd Countrymst Fk',
            'cmsnjsd_memberregmst_fk' => 'Cmsnjsd Memberregmst Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsnjsdCountrymstFk()
    {
        return $this->hasOne(CountrymstTbl::className(), ['CountryMst_Pk' => 'cmsnjsd_countrymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsnonjsrssupmapTbl()
    {
        return $this->hasOne(CmsnonjsrssupmapTbl::className(), ['cnjsm_cmsnonjsrssupdtls_fk' => 'cmsnonjsrssupdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsnonjsrssupmapTbls()
    {
        return $this->hasMany(CmsnonjsrssupmapTbl::className(), ['cnjsm_cmsnonjsrssupdtls_fk' => 'cmsnonjsrssupdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsnonjsrssupdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsnonjsrssupdtlsTblQuery(get_called_class());
    }
}
