<?php

namespace api\modules\pms\models;

use Yii;
use api\modules\mst\models\MembercompanymstTbl;

/**
 * This is the model class for table "cmsinspreqdocactionmap_tbl".
 *
 * @property int $cmsinspreqdocactionmap_pk Primary key
 * @property int $cirdam_cmsinspreqdocactionmaptemp_fk reference to cmsinspreqdocactionmaptemp_tbl
 * @property int $cirdam_cmsinspreqdocdtls_fk Reference to cmsinspreqdocdtls_tbl
 * @property int $cirdam_quancheck_mcm_fk Reference to membercompanymst_tbl
 * @property string $cirdam_quancheckname Quantum of Check:  supplier who is not in JSRS list
 * @property int $cirdam_actions Actions : 1 - Review, 2 - Witness, 3 - Perform, 4 - Random Witness, 5 - Hold Point, 6 - Third Party Inspection agency, 7 - Not Applicable
 *
 * @property CmsinspreqdocactionmaptempTbl $cirdamCmsinspreqdocactionmaptempFk
 * @property CmsinspreqdocdtlsTbl $cirdamCmsinspreqdocdtlsFk
 * @property MembercompanymstTbl $cirdamQuancheckMcmFk
 */
class CmsinspreqdocactionmapTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsinspreqdocactionmap_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cirdam_cmsinspreqdocactionmaptemp_fk', 'cirdam_cmsinspreqdocdtls_fk', 'cirdam_quancheck_mcm_fk', 'cirdam_actions'], 'integer'],
            [['cirdam_cmsinspreqdocdtls_fk', 'cirdam_actions'], 'required'],
            [['cirdam_quancheckname'], 'string', 'max' => 255],
            [['cirdam_cmsinspreqdocactionmaptemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsinspreqdocactionmaptempTbl::className(), 'targetAttribute' => ['cirdam_cmsinspreqdocactionmaptemp_fk' => 'cmsinspreqdocactionmaptemp_pk']],
            [['cirdam_cmsinspreqdocdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsinspreqdocdtlsTbl::className(), 'targetAttribute' => ['cirdam_cmsinspreqdocdtls_fk' => 'cmsinspreqdocdtls_pk']],
            [['cirdam_quancheck_mcm_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['cirdam_quancheck_mcm_fk' => 'MemberCompMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsinspreqdocactionmap_pk' => 'Cmsinspreqdocactionmap Pk',
            'cirdam_cmsinspreqdocactionmaptemp_fk' => 'Cirdam Cmsinspreqdocactionmaptemp Fk',
            'cirdam_cmsinspreqdocdtls_fk' => 'Cirdam Cmsinspreqdocdtls Fk',
            'cirdam_quancheck_mcm_fk' => 'Cirdam Quancheck Mcm Fk',
            'cirdam_quancheckname' => 'Cirdam Quancheckname',
            'cirdam_actions' => 'Cirdam Actions',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdamCmsinspreqdocactionmaptempFk()
    {
        return $this->hasOne(CmsinspreqdocactionmaptempTbl::className(), ['cmsinspreqdocactionmaptemp_pk' => 'cirdam_cmsinspreqdocactionmaptemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdamCmsinspreqdocdtlsFk()
    {
        return $this->hasOne(CmsinspreqdocdtlsTbl::className(), ['cmsinspreqdocdtls_pk' => 'cirdam_cmsinspreqdocdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdamQuancheckMcmFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cirdam_quancheck_mcm_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocactionmapTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsinspreqdocactionmapTblQuery(get_called_class());
    }
}
