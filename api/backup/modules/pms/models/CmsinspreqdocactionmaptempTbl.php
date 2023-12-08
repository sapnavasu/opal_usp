<?php

namespace api\modules\pms\models;

use Yii;
use api\modules\mst\models\MembercompanymstTbl;

/**
 * This is the model class for table "cmsinspreqdocactionmaptemp_tbl".
 *
 * @property int $cmsinspreqdocactionmaptemp_pk Primary key
 * @property int $cirdamt_cmsinspreqdocdtlstemp_fk Reference to cmsinspreqdocdtlstemp_tbl
 * @property int $cirdamt_quancheck_mcm_fk Reference to membercompanymst_tbl
 * @property string $cirdamt_quancheckname Quantum of Check:  supplier who is not in JSRS list
 * @property int $cirdamt_actions Actions : 1 - Review, 2 - Witness, 3 - Perform, 4 - Random Witness, 5 - Hold Point, 6 - Third Party Inspection agency, 7 - Not Applicable
 *
 * @property CmsinspreqdocdtlstempTbl $cirdamtCmsinspreqdocdtlstempFk
 * @property MembercompanymstTbl $cirdamtQuancheckMcmFk
 */
class CmsinspreqdocactionmaptempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsinspreqdocactionmaptemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cirdamt_cmsinspreqdocdtlstemp_fk', 'cirdamt_actions'], 'required'],
            [['cirdamt_cmsinspreqdocdtlstemp_fk', 'cirdamt_quancheck_mcm_fk', 'cirdamt_actions'], 'integer'],
            [['cirdamt_quancheckname'], 'string', 'max' => 255],
            [['cirdamt_cmsinspreqdocdtlstemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsinspreqdocdtlstempTbl::className(), 'targetAttribute' => ['cirdamt_cmsinspreqdocdtlstemp_fk' => 'cmsinspreqdocdtlstemp_pk']],
            [['cirdamt_quancheck_mcm_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['cirdamt_quancheck_mcm_fk' => 'MemberCompMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsinspreqdocactionmaptemp_pk' => 'Cmsinspreqdocactionmaptemp Pk',
            'cirdamt_cmsinspreqdocdtlstemp_fk' => 'Cirdamt Cmsinspreqdocdtlstemp Fk',
            'cirdamt_quancheck_mcm_fk' => 'Cirdamt Quancheck Mcm Fk',
            'cirdamt_quancheckname' => 'Cirdamt Quancheckname',
            'cirdamt_actions' => 'Cirdamt Actions',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdamtCmsinspreqdocdtlstempFk()
    {
        return $this->hasOne(CmsinspreqdocdtlstempTbl::className(), ['cmsinspreqdocdtlstemp_pk' => 'cirdamt_cmsinspreqdocdtlstemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdamtQuancheckMcmFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cirdamt_quancheck_mcm_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocactionmaptempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsinspreqdocactionmaptempTblQuery(get_called_class());
    }
}
