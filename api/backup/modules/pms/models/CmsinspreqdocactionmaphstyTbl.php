<?php

namespace api\modules\pms\models;
use api\modules\mst\models\MembercompanymstTbl;
use Yii;

/**
 * This is the model class for table "cmsinspreqdocactionmaphsty_tbl".
 *
 * @property int $cmsinspreqdocactionmaphsty_pk Primary key
 * @property int $cirdamh_cmsinspreqdocactionmap_fk reference to cmsinspreqdocactionmap_tbl
 * @property int $cirdamh_cmsinspreqdocdtls_fk Reference to cmsinspreqdocdtls_tbl
 * @property int $cirdamh_quancheck_mcm_fk Reference to membercompanymst_tbl
 * @property string $cirdamh_quancheckname Quantum of Check:  supplier who is not in JSRS list
 * @property int $cirdamh_actions Actions : 1 - Review, 2 - Witness, 3 - Perform, 4 - Random Witness, 5 - Hold Point, 6 - Third Party Inspection agency, 7 - Not Applicable
 *
 * @property CmsinspreqdocdtlsTbl $cirdamhCmsinspreqdocdtlsFk
 * @property MembercompanymstTbl $cirdamhQuancheckMcmFk
 */
class CmsinspreqdocactionmaphstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsinspreqdocactionmaphsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cirdamh_cmsinspreqdocactionmap_fk', 'cirdamh_cmsinspreqdocdtls_fk', 'cirdamh_actions'], 'required'],
            [['cirdamh_cmsinspreqdocactionmap_fk', 'cirdamh_cmsinspreqdocdtls_fk', 'cirdamh_quancheck_mcm_fk', 'cirdamh_actions'], 'integer'],
            [['cirdamh_quancheckname'], 'string', 'max' => 255],
            [['cirdamh_cmsinspreqdocdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsinspreqdocdtlsTbl::className(), 'targetAttribute' => ['cirdamh_cmsinspreqdocdtls_fk' => 'cmsinspreqdocdtls_pk']],
            [['cirdamh_quancheck_mcm_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['cirdamh_quancheck_mcm_fk' => 'MemberCompMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsinspreqdocactionmaphsty_pk' => 'Cmsinspreqdocactionmaphsty Pk',
            'cirdamh_cmsinspreqdocactionmap_fk' => 'Cirdamh Cmsinspreqdocactionmap Fk',
            'cirdamh_cmsinspreqdocdtls_fk' => 'Cirdamh Cmsinspreqdocdtls Fk',
            'cirdamh_quancheck_mcm_fk' => 'Cirdamh Quancheck Mcm Fk',
            'cirdamh_quancheckname' => 'Cirdamh Quancheckname',
            'cirdamh_actions' => 'Cirdamh Actions',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdamhCmsinspreqdocdtlsFk()
    {
        return $this->hasOne(CmsinspreqdocdtlsTbl::className(), ['cmsinspreqdocdtls_pk' => 'cirdamh_cmsinspreqdocdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdamhQuancheckMcmFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cirdamh_quancheck_mcm_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocactionmaphstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsinspreqdocactionmaphstyTblQuery(get_called_class());
    }
}
