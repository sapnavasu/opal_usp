<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "natlookoutsubcatmst_tbl".
 *
 * @property int $NatLookOutSubCatMst_Pk
 * @property int $NLKSCM_NatLookOutCatMst_Fk
 * @property string $NLKSCM_SubCategory
 * @property string $NLKSCM_Status
 * @property string $NLKSCM_CreatedOn
 * @property int $NLKSCM_CreatedBy
 * @property string $NLKSCM_UpdatedOn
 * @property int $NLKSCM_UpdatedBy
 */
class NatlookoutsubcatmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'natlookoutsubcatmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NLKSCM_NatLookOutCatMst_Fk', 'NLKSCM_CreatedBy', 'NLKSCM_UpdatedBy'], 'integer'],
            [['NLKSCM_Status'], 'string'],
            [['NLKSCM_CreatedOn', 'NLKSCM_UpdatedOn'], 'safe'],
            [['NLKSCM_SubCategory'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NatLookOutSubCatMst_Pk' => 'Nat Look Out Sub Cat Mst  Pk',
            'NLKSCM_NatLookOutCatMst_Fk' => 'Nlkscm  Nat Look Out Cat Mst  Fk',
            'NLKSCM_SubCategory' => 'Nlkscm  Sub Category',
            'NLKSCM_Status' => 'Nlkscm  Status',
            'NLKSCM_CreatedOn' => 'Nlkscm  Created On',
            'NLKSCM_CreatedBy' => 'Nlkscm  Created By',
            'NLKSCM_UpdatedOn' => 'Nlkscm  Updated On',
            'NLKSCM_UpdatedBy' => 'Nlkscm  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return NatlookoutsubcatmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NatlookoutsubcatmstTblQuery(get_called_class());
    }
}
